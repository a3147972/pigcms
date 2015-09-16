<?php

if (!class_exists("Crypt_DES")) {
    require_once "DES.php";
}
class Crypt_TripleDES extends Crypt_DES
{
    /**
     * The Crypt_DES objects
     *
     * @var Array
     * @access private
     */
    public $des;

    public function Crypt_TripleDES($mode)
    {
        if (!defined("CRYPT_DES_MODE")) {
            switch (true) {
            case extension_loaded("mcrypt") && in_array("tripledes", mcrypt_list_algorithms()):
                define("CRYPT_DES_MODE", CRYPT_DES_MODE_MCRYPT);
                break;

            default:
                define("CRYPT_DES_MODE", CRYPT_DES_MODE_INTERNAL);
            }
        }

        if ($mode == CRYPT_DES_MODE_3CBC) {
            $this->mode = CRYPT_DES_MODE_3CBC;
            $this->des = array(new Crypt_DES(CRYPT_DES_MODE_CBC), new Crypt_DES(CRYPT_DES_MODE_CBC), new Crypt_DES(CRYPT_DES_MODE_CBC));
            $this->paddable = true;
            $this->des[0]->disablePadding();
            $this->des[1]->disablePadding();
            $this->des[2]->disablePadding();
            return NULL;
        }

        switch (CRYPT_DES_MODE) {
        case CRYPT_DES_MODE_MCRYPT:
            switch ($mode) {
            case CRYPT_DES_MODE_ECB:
                $this->paddable = true;
                $this->mode = MCRYPT_MODE_ECB;
                break;

            case CRYPT_DES_MODE_CTR:
                $this->mode = "ctr";
                break;

            case CRYPT_DES_MODE_CFB:
                $this->mode = "ncfb";
                $this->ecb = mcrypt_module_open(MCRYPT_3DES, "", MCRYPT_MODE_ECB, "");
                break;

            case CRYPT_DES_MODE_OFB:
                $this->mode = MCRYPT_MODE_NOFB;
                break;

            case CRYPT_DES_MODE_CBC:
            default:
                $this->paddable = true;
                $this->mode = MCRYPT_MODE_CBC;
            }

            $this->enmcrypt = mcrypt_module_open(MCRYPT_3DES, "", $this->mode, "");
            $this->demcrypt = mcrypt_module_open(MCRYPT_3DES, "", $this->mode, "");
            break;

        default:
            $this->des = array(new Crypt_DES(CRYPT_DES_MODE_ECB), new Crypt_DES(CRYPT_DES_MODE_ECB), new Crypt_DES(CRYPT_DES_MODE_ECB));
            $this->des[0]->disablePadding();
            $this->des[1]->disablePadding();
            $this->des[2]->disablePadding();

            switch ($mode) {
            case CRYPT_DES_MODE_ECB:
            case CRYPT_DES_MODE_CBC:
                $this->paddable = true;
                $this->mode = $mode;
                break;

            case CRYPT_DES_MODE_CTR:
            case CRYPT_DES_MODE_CFB:
            case CRYPT_DES_MODE_OFB:
                $this->mode = $mode;
                break;

            default:
                $this->paddable = true;
                $this->mode = CRYPT_DES_MODE_CBC;
            }

            if (function_exists("create_function") && is_callable("create_function")) {
                $this->inline_crypt_setup(3);
                $this->use_inline_crypt = true;
            }
        }

        CRYPT_DES_MODE;
    }

    public function setKey($key)
    {
        $length = strlen($key);

        if (8 < $length) {
            $key = str_pad($key, 24, chr(0));
        }
        else {
            $key = str_pad($key, 8, chr(0));
        }

        $this->key = $key;

        switch (true) {
        case CRYPT_DES_MODE == CRYPT_DES_MODE_INTERNAL:
        case :
            $this->des[0]->setKey(substr($key, 0, 8));
            $this->des[1]->setKey(substr($key, 8, 8));
            $this->des[2]->setKey(substr($key, 16, 8));
            if ($this->use_inline_crypt && ($this->mode != CRYPT_DES_MODE_3CBC)) {
                $this->keys = array(CRYPT_DES_ENCRYPT_1DIM => array_merge($this->des[0]->keys[CRYPT_DES_ENCRYPT_1DIM], $this->des[1]->keys[CRYPT_DES_DECRYPT_1DIM], $this->des[2]->keys[CRYPT_DES_ENCRYPT_1DIM]), CRYPT_DES_DECRYPT_1DIM => array_merge($this->des[2]->keys[CRYPT_DES_DECRYPT_1DIM], $this->des[1]->keys[CRYPT_DES_ENCRYPT_1DIM], $this->des[0]->keys[CRYPT_DES_DECRYPT_1DIM]));
            }
        }

        $this->enchanged = $this->dechanged = true;
    }

    public function setPassword($password, $method)
    {
        $key = "";

        switch (1) {
        default:
            list(, , $hash, $salt, $count) = func_get_args();

            if (!$hash) {
                $hash = "sha1";
            }

            if (!$salt) {
                $salt = "phpseclib";
            }

            if (!$count) {
                $count = 1000;
            }

            if (!class_exists("Crypt_Hash")) {
                require_once "Crypt/Hash.php";
            }

            $i = 1;

            while (strlen($key) < 24) {
                $hmac = new Crypt_Hash();
                $hmac->setHash($hash);
                $hmac->setKey($password);
                $f = $u = $hmac->hash($salt . pack("N", $i++));

                for ($j = 2; $j <= $count; $j++) {
                    $u = $hmac->hash($u);
                    $f ^= $u;
                }

                $key .= $f;
            }
        }

        $this->setKey($key);
    }

    public function setIV($iv)
    {
        $this->encryptIV = $this->decryptIV = $this->iv = str_pad(substr($iv, 0, 8), 8, chr(0));

        if ($this->mode == CRYPT_DES_MODE_3CBC) {
            $this->des[0]->setIV($iv);
            $this->des[1]->setIV($iv);
            $this->des[2]->setIV($iv);
        }

        $this->enchanged = $this->dechanged = true;
    }

    public function encrypt($plaintext)
    {
        if ($this->paddable) {
            $plaintext = $this->_pad($plaintext);
        }

        if (($this->mode == CRYPT_DES_MODE_3CBC) && (8 < strlen($this->key))) {
            $ciphertext = $this->des[2]->encrypt($this->des[1]->decrypt($this->des[0]->encrypt($plaintext)));
            return $ciphertext;
        }

        if (CRYPT_DES_MODE == CRYPT_DES_MODE_MCRYPT) {
            if ($this->enchanged) {
                mcrypt_generic_init($this->enmcrypt, $this->key, $this->encryptIV);

                if ($this->mode == "ncfb") {
                    mcrypt_generic_init($this->ecb, $this->key, "\000\000\000\000\000\000\000\000");
                }

                $this->enchanged = false;
            }

            if (($this->mode != "ncfb") || !$this->continuousBuffer) {
                $ciphertext = mcrypt_generic($this->enmcrypt, $plaintext);
            }
            else {
                $iv = &$this->encryptIV;
                $pos = &$this->enbuffer["pos"];
                $len = strlen($plaintext);
                $ciphertext = "";
                $i = 0;

                if ($pos) {
                    $orig_pos = $pos;
                    $max = 8 - $pos;

                    if ($max <= $len) {
                        $i = $max;
                        $len -= $max;
                        $pos = 0;
                    }
                    else {
                        $i = $len;
                        $pos += $len;
                        $len = 0;
                    }

                    $ciphertext = substr($iv, $orig_pos) ^ $plaintext;
                    $iv = substr_replace($iv, $ciphertext, $orig_pos, $i);
                    $this->enbuffer["enmcrypt_init"] = true;
                }

                if (8 <= $len) {
                    if (($this->enbuffer["enmcrypt_init"] === false) || (950 < $len)) {
                        if ($this->enbuffer["enmcrypt_init"] === true) {
                            mcrypt_generic_init($this->enmcrypt, $this->key, $iv);
                            $this->enbuffer["enmcrypt_init"] = false;
                        }

                        $ciphertext .= mcrypt_generic($this->enmcrypt, substr($plaintext, $i, $len - ($len % 8)));
                        $iv = substr($ciphertext, -8);
                        $i = strlen($ciphertext);
                        $len %= 8;
                    }
                    else {
                        while (8 <= $len) {
                            $iv = mcrypt_generic($this->ecb, $iv) ^ substr($plaintext, $i, 8);
                            $ciphertext .= $iv;
                            $len -= 8;
                            $i += 8;
                        }
                    }
                }

                if ($len) {
                    $iv = mcrypt_generic($this->ecb, $iv);
                    $block = $iv ^ substr($plaintext, $i);
                    $iv = substr_replace($iv, $block, 0, $len);
                    $ciphertext .= $block;
                    $pos = $len;
                }

                return $ciphertext;
            }

            if (!$this->continuousBuffer) {
                mcrypt_generic_init($this->enmcrypt, $this->key, $this->encryptIV);
            }

            return $ciphertext;
        }

        if (strlen($this->key) <= 8) {
            $this->des[0]->mode = $this->mode;
            return $this->des[0]->encrypt($plaintext);
        }

        if ($this->use_inline_crypt) {
            $inline = $this->inline_crypt;
            return $inline("encrypt", $this, $plaintext);
        }

        $des = $this->des;
        $buffer = &$this->enbuffer;
        $continuousBuffer = $this->continuousBuffer;
        $ciphertext = "";

        switch ($this->mode) {
        case CRYPT_DES_MODE_ECB:
            for ($i = 0; $i < strlen($plaintext); $i += 8) {
                $block = substr($plaintext, $i, 8);
                $block = $des[0]->_processBlock($block, CRYPT_DES_ENCRYPT);
                $block = $des[1]->_processBlock($block, CRYPT_DES_DECRYPT);
                $block = $des[2]->_processBlock($block, CRYPT_DES_ENCRYPT);
                $ciphertext .= $block;
            }

            break;

        case CRYPT_DES_MODE_CBC:
            $xor = $this->encryptIV;

            for ($i = 0; $i < strlen($plaintext); $i += 8) {
                $block = substr($plaintext, $i, 8) ^ $xor;
                $block = $des[0]->_processBlock($block, CRYPT_DES_ENCRYPT);
                $block = $des[1]->_processBlock($block, CRYPT_DES_DECRYPT);
                $block = $des[2]->_processBlock($block, CRYPT_DES_ENCRYPT);
                $xor = $block;
                $ciphertext .= $block;
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $xor;
            }

            break;

        case CRYPT_DES_MODE_CTR:
            $xor = $this->encryptIV;

            if (strlen($buffer["encrypted"])) {
                for ($i = 0; $i < strlen($plaintext); $i += 8) {
                    $block = substr($plaintext, $i, 8);

                    if (strlen($buffer["encrypted"]) < strlen($block)) {
                        $key = $this->_generate_xor($xor);
                        $key = $des[0]->_processBlock($key, CRYPT_DES_ENCRYPT);
                        $key = $des[1]->_processBlock($key, CRYPT_DES_DECRYPT);
                        $key = $des[2]->_processBlock($key, CRYPT_DES_ENCRYPT);
                        $buffer["encrypted"] .= $key;
                    }

                    $key = $this->_string_shift($buffer["encrypted"]);
                    $ciphertext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($plaintext); $i += 8) {
                    $block = substr($plaintext, $i, 8);
                    $key = $this->_generate_xor($xor);
                    $key = $des[0]->_processBlock($key, CRYPT_DES_ENCRYPT);
                    $key = $des[1]->_processBlock($key, CRYPT_DES_DECRYPT);
                    $key = $des[2]->_processBlock($key, CRYPT_DES_ENCRYPT);
                    $ciphertext .= $block ^ $key;
                }
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $xor;
                $start = strlen($plaintext);

                if ($start & 7) {
                    $buffer["encrypted"] = substr($key, $start) . $buffer["encrypted"];
                }
            }

            break;

        case CRYPT_DES_MODE_CFB:
            if (strlen($buffer["xor"])) {
                $ciphertext = $plaintext ^ $buffer["xor"];
                $iv = $buffer["encrypted"] . $ciphertext;
                $start = strlen($ciphertext);
                $buffer["encrypted"] .= $ciphertext;
                $buffer["xor"] = substr($buffer["xor"], strlen($ciphertext));
            }
            else {
                $ciphertext = "";
                $iv = $this->encryptIV;
                $start = 0;
            }

            for ($i = $start; $i < strlen($plaintext); $i += 8) {
                $block = substr($plaintext, $i, 8);
                $iv = $des[0]->_processBlock($iv, CRYPT_DES_ENCRYPT);
                $iv = $des[1]->_processBlock($iv, CRYPT_DES_DECRYPT);
                $xor = $des[2]->_processBlock($iv, CRYPT_DES_ENCRYPT);
                $iv = $block ^ $xor;
                if ($continuousBuffer && (strlen($iv) != 8)) {
                    $buffer = array("encrypted" => $iv, "xor" => substr($xor, strlen($iv)));
                }

                $ciphertext .= $iv;
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $iv;
            }

            break;

        case CRYPT_DES_MODE_OFB:
            $xor = $this->encryptIV;

            if (strlen($buffer["xor"])) {
                for ($i = 0; $i < strlen($plaintext); $i += 8) {
                    $block = substr($plaintext, $i, 8);

                    if (strlen($buffer["xor"]) < strlen($block)) {
                        $xor = $des[0]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                        $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                        $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                        $buffer["xor"] .= $xor;
                    }

                    $key = $this->_string_shift($buffer["xor"]);
                    $ciphertext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($plaintext); $i += 8) {
                    $xor = $des[0]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                    $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                    $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                    $ciphertext .= substr($plaintext, $i, 8) ^ $xor;
                }

                $key = $xor;
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $xor;
                $start = strlen($plaintext);

                if ($start & 7) {
                    $buffer["xor"] = substr($key, $start) . $buffer["xor"];
                }
            }
        }

        return $ciphertext;
    }

    public function decrypt($ciphertext)
    {
        if (($this->mode == CRYPT_DES_MODE_3CBC) && (8 < strlen($this->key))) {
            $plaintext = $this->des[0]->decrypt($this->des[1]->encrypt($this->des[2]->decrypt($ciphertext)));
            return $this->_unpad($plaintext);
        }

        if ($this->paddable) {
            $ciphertext = str_pad($ciphertext, (strlen($ciphertext) + 7) & 4294967288, chr(0));
        }

        if (CRYPT_DES_MODE == CRYPT_DES_MODE_MCRYPT) {
            if ($this->dechanged) {
                mcrypt_generic_init($this->demcrypt, $this->key, $this->decryptIV);

                if ($this->mode == "ncfb") {
                    mcrypt_generic_init($this->ecb, $this->key, "\000\000\000\000\000\000\000\000");
                }

                $this->dechanged = false;
            }

            if (($this->mode != "ncfb") || !$this->continuousBuffer) {
                $plaintext = mdecrypt_generic($this->demcrypt, $ciphertext);
            }
            else {
                $iv = &$this->decryptIV;
                $pos = &$this->debuffer["pos"];
                $len = strlen($ciphertext);
                $plaintext = "";
                $i = 0;

                if ($pos) {
                    $orig_pos = $pos;
                    $max = 8 - $pos;

                    if ($max <= $len) {
                        $i = $max;
                        $len -= $max;
                        $pos = 0;
                    }
                    else {
                        $i = $len;
                        $pos += $len;
                        $len = 0;
                    }

                    $plaintext = substr($iv, $orig_pos) ^ $ciphertext;
                    $iv = substr_replace($iv, substr($ciphertext, 0, $i), $orig_pos, $i);
                }

                if (8 <= $len) {
                    $cb = substr($ciphertext, $i, $len - ($len % 8));
                    $plaintext .= mcrypt_generic($this->ecb, $iv . $cb) ^ $cb;
                    $iv = substr($cb, -8);
                    $len %= 8;
                }

                if ($len) {
                    $iv = mcrypt_generic($this->ecb, $iv);
                    $cb = substr($ciphertext, -$len);
                    $plaintext .= $iv ^ $cb;
                    $iv = substr_replace($iv, $cb, 0, $len);
                    $pos = $len;
                }

                return $plaintext;
            }

            if (!$this->continuousBuffer) {
                mcrypt_generic_init($this->demcrypt, $this->key, $this->decryptIV);
            }

            return $this->paddable ? $this->_unpad($plaintext) : $plaintext;
        }

        if (strlen($this->key) <= 8) {
            $this->des[0]->mode = $this->mode;
            $plaintext = $this->des[0]->decrypt($ciphertext);
            return $this->paddable ? $this->_unpad($plaintext) : $plaintext;
        }

        if ($this->use_inline_crypt) {
            $inline = $this->inline_crypt;
            return $inline("decrypt", $this, $ciphertext);
        }

        $des = $this->des;
        $buffer = &$this->debuffer;
        $continuousBuffer = $this->continuousBuffer;
        $plaintext = "";

        switch ($this->mode) {
        case CRYPT_DES_MODE_ECB:
            for ($i = 0; $i < strlen($ciphertext); $i += 8) {
                $block = substr($ciphertext, $i, 8);
                $block = $des[2]->_processBlock($block, CRYPT_DES_DECRYPT);
                $block = $des[1]->_processBlock($block, CRYPT_DES_ENCRYPT);
                $block = $des[0]->_processBlock($block, CRYPT_DES_DECRYPT);
                $plaintext .= $block;
            }

            break;

        case CRYPT_DES_MODE_CBC:
            $xor = $this->decryptIV;

            for ($i = 0; $i < strlen($ciphertext); $i += 8) {
                $orig = $block = substr($ciphertext, $i, 8);
                $block = $des[2]->_processBlock($block, CRYPT_DES_DECRYPT);
                $block = $des[1]->_processBlock($block, CRYPT_DES_ENCRYPT);
                $block = $des[0]->_processBlock($block, CRYPT_DES_DECRYPT);
                $plaintext .= $block ^ $xor;
                $xor = $orig;
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $xor;
            }

            break;

        case CRYPT_DES_MODE_CTR:
            $xor = $this->decryptIV;

            if (strlen($buffer["ciphertext"])) {
                for ($i = 0; $i < strlen($ciphertext); $i += 8) {
                    $block = substr($ciphertext, $i, 8);

                    if (strlen($buffer["ciphertext"]) < strlen($block)) {
                        $key = $this->_generate_xor($xor);
                        $key = $des[0]->_processBlock($key, CRYPT_DES_ENCRYPT);
                        $key = $des[1]->_processBlock($key, CRYPT_DES_DECRYPT);
                        $key = $des[2]->_processBlock($key, CRYPT_DES_ENCRYPT);
                        $buffer["ciphertext"] .= $key;
                    }

                    $key = $this->_string_shift($buffer["ciphertext"]);
                    $plaintext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($ciphertext); $i += 8) {
                    $block = substr($ciphertext, $i, 8);
                    $key = $this->_generate_xor($xor);
                    $key = $des[0]->_processBlock($key, CRYPT_DES_ENCRYPT);
                    $key = $des[1]->_processBlock($key, CRYPT_DES_DECRYPT);
                    $key = $des[2]->_processBlock($key, CRYPT_DES_ENCRYPT);
                    $plaintext .= $block ^ $key;
                }
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $xor;
                $start = strlen($plaintext);

                if ($start & 7) {
                    $buffer["ciphertext"] = substr($key, $start) . $buffer["ciphertext"];
                }
            }

            break;

        case CRYPT_DES_MODE_CFB:
            if (strlen($buffer["ciphertext"])) {
                $plaintext = $ciphertext ^ substr($this->decryptIV, strlen($buffer["ciphertext"]));
                $buffer["ciphertext"] .= substr($ciphertext, 0, strlen($plaintext));

                if (strlen($buffer["ciphertext"]) != 8) {
                    $block = $this->decryptIV;
                }
                else {
                    $block = $buffer["ciphertext"];
                    $xor = $des[0]->_processBlock($buffer["ciphertext"], CRYPT_DES_ENCRYPT);
                    $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                    $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                    $buffer["ciphertext"] = "";
                }

                $start = strlen($plaintext);
            }
            else {
                $plaintext = "";
                $xor = $des[0]->_processBlock($this->decryptIV, CRYPT_DES_ENCRYPT);
                $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                $start = 0;
            }

            for ($i = $start; $i < strlen($ciphertext); $i += 8) {
                $block = substr($ciphertext, $i, 8);
                $plaintext .= $block ^ $xor;
                if ($continuousBuffer && (strlen($block) != 8)) {
                    $buffer["ciphertext"] .= $block;
                    $block = $xor;
                }
                else if (strlen($block) == 8) {
                    $xor = $des[0]->_processBlock($block, CRYPT_DES_ENCRYPT);
                    $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                    $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                }
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $block;
            }

            break;

        case CRYPT_DES_MODE_OFB:
            $xor = $this->decryptIV;

            if (strlen($buffer["xor"])) {
                for ($i = 0; $i < strlen($ciphertext); $i += 8) {
                    $block = substr($ciphertext, $i, 8);

                    if (strlen($buffer["xor"]) < strlen($block)) {
                        $xor = $des[0]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                        $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                        $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                        $buffer["xor"] .= $xor;
                    }

                    $key = $this->_string_shift($buffer["xor"]);
                    $plaintext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($ciphertext); $i += 8) {
                    $xor = $des[0]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                    $xor = $des[1]->_processBlock($xor, CRYPT_DES_DECRYPT);
                    $xor = $des[2]->_processBlock($xor, CRYPT_DES_ENCRYPT);
                    $plaintext .= substr($ciphertext, $i, 8) ^ $xor;
                }

                $key = $xor;
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $xor;
                $start = strlen($ciphertext);

                if ($start & 7) {
                    $buffer["xor"] = substr($key, $start) . $buffer["xor"];
                }
            }
        }

        return $this->paddable ? $this->_unpad($plaintext) : $plaintext;
    }

    public function enableContinuousBuffer()
    {
        $this->continuousBuffer = true;

        if ($this->mode == CRYPT_DES_MODE_3CBC) {
            $this->des[0]->enableContinuousBuffer();
            $this->des[1]->enableContinuousBuffer();
            $this->des[2]->enableContinuousBuffer();
        }
    }

    public function disableContinuousBuffer()
    {
        $this->continuousBuffer = false;
        $this->encryptIV = $this->iv;
        $this->decryptIV = $this->iv;
        $this->enchanged = true;
        $this->dechanged = true;
        $this->enbuffer = array("encrypted" => "", "xor" => "", "pos" => 0, "enmcrypt_init" => true);
        $this->debuffer = array("ciphertext" => "", "xor" => "", "pos" => 0, "demcrypt_init" => true);

        if ($this->mode == CRYPT_DES_MODE_3CBC) {
            $this->des[0]->disableContinuousBuffer();
            $this->des[1]->disableContinuousBuffer();
            $this->des[2]->disableContinuousBuffer();
        }
    }
}


define("CRYPT_DES_MODE_3CBC", -2);
define("CRYPT_DES_MODE_CBC3", CRYPT_DES_MODE_CBC);

?>
