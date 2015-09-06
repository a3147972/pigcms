<?php

class Crypt_AES extends Crypt_Rijndael
{
    /**
     * mcrypt resource for encryption
     *
     * The mcrypt resource can be recreated every time something needs to be created or it can be created just once.
     * Since mcrypt operates in continuous mode, by default, it'll need to be recreated when in non-continuous mode.
     *
     * @see Crypt_AES::encrypt()
     * @var String
     * @access private
     */
    public $enmcrypt;
    /**
     * mcrypt resource for decryption
     *
     * The mcrypt resource can be recreated every time something needs to be created or it can be created just once.
     * Since mcrypt operates in continuous mode, by default, it'll need to be recreated when in non-continuous mode.
     *
     * @see Crypt_AES::decrypt()
     * @var String
     * @access private
     */
    public $demcrypt;
    /**
     * mcrypt resource for CFB mode
     *
     * @see Crypt_AES::encrypt()
     * @see Crypt_AES::decrypt()
     * @var String
     * @access private
     */
    public $ecb;

    public function Crypt_AES($mode)
    {
        if (!defined("CRYPT_AES_MODE")) {
            switch (true) {
            case extension_loaded("mcrypt") && in_array("rijndael-128", mcrypt_list_algorithms()):
                define("CRYPT_AES_MODE", CRYPT_AES_MODE_MCRYPT);
                break;

            default:
                define("CRYPT_AES_MODE", CRYPT_AES_MODE_INTERNAL);
            }
        }

        switch (CRYPT_AES_MODE) {
        case CRYPT_AES_MODE_MCRYPT:
            switch ($mode) {
            case CRYPT_AES_MODE_ECB:
                $this->paddable = true;
                $this->mode = MCRYPT_MODE_ECB;
                break;

            case CRYPT_AES_MODE_CTR:
                $this->mode = "ctr";
                break;

            case CRYPT_AES_MODE_CFB:
                $this->mode = "ncfb";
                break;

            case CRYPT_AES_MODE_OFB:
                $this->mode = MCRYPT_MODE_NOFB;
                break;

            case CRYPT_AES_MODE_CBC:
            default:
                $this->paddable = true;
                $this->mode = MCRYPT_MODE_CBC;
            }

            break;

        default:
            switch ($mode) {
            case CRYPT_AES_MODE_ECB:
                $this->paddable = true;
                $this->mode = CRYPT_RIJNDAEL_MODE_ECB;
                break;

            case CRYPT_AES_MODE_CTR:
                $this->mode = CRYPT_RIJNDAEL_MODE_CTR;
                break;

            case CRYPT_AES_MODE_CFB:
                $this->mode = CRYPT_RIJNDAEL_MODE_CFB;
                break;

            case CRYPT_AES_MODE_OFB:
                $this->mode = CRYPT_RIJNDAEL_MODE_OFB;
                break;

            case CRYPT_AES_MODE_CBC:
            default:
                $this->paddable = true;
                $this->mode = CRYPT_RIJNDAEL_MODE_CBC;
            }
        }

        CRYPT_AES_MODE;

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_INTERNAL) {
            parent::Crypt_Rijndael($this->mode);
        }
    }

    public function setBlockLength($length)
    {
        return NULL;
    }

    public function setIV($iv)
    {
        parent::setIV($iv);

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->changed = true;
        }
    }

    public function encrypt($plaintext)
    {
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->_mcryptSetup();
            if (($this->mode == "ncfb") && $this->continuousBuffer) {
                $iv = &$this->encryptIV;
                $pos = &$this->enbuffer["pos"];
                $len = strlen($plaintext);
                $ciphertext = "";
                $i = 0;

                if ($pos) {
                    $orig_pos = $pos;
                    $max = 16 - $pos;

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

                if (16 <= $len) {
                    if (($this->enbuffer["enmcrypt_init"] === false) || (280 < $len)) {
                        if ($this->enbuffer["enmcrypt_init"] === true) {
                            mcrypt_generic_init($this->enmcrypt, $this->key, $iv);
                            $this->enbuffer["enmcrypt_init"] = false;
                        }

                        $ciphertext .= mcrypt_generic($this->enmcrypt, substr($plaintext, $i, $len - ($len % 16)));
                        $iv = substr($ciphertext, -16);
                        $len %= 16;
                    }
                    else {
                        while (16 <= $len) {
                            $iv = mcrypt_generic($this->ecb, $iv) ^ substr($plaintext, $i, 16);
                            $ciphertext .= $iv;
                            $len -= 16;
                            $i += 16;
                        }
                    }
                }

                if ($len) {
                    $iv = mcrypt_generic($this->ecb, $iv);
                    $block = $iv ^ substr($plaintext, -$len);
                    $iv = substr_replace($iv, $block, 0, $len);
                    $ciphertext .= $block;
                    $pos = $len;
                }

                return $ciphertext;
            }

            if ($this->paddable) {
                $plaintext = $this->_pad($plaintext);
            }

            $ciphertext = mcrypt_generic($this->enmcrypt, $plaintext);

            if (empty($this->continuousBuffer)) { //反转
                mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);
            }

            return $ciphertext;
        }

        return parent::encrypt($plaintext);
    }

    public function decrypt($ciphertext)
    {
        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->_mcryptSetup();
            if (($this->mode == "ncfb") && $this->continuousBuffer) {
                $iv = &$this->decryptIV;
                $pos = &$this->debuffer["pos"];
                $len = strlen($ciphertext);
                $plaintext = "";
                $i = 0;

                if ($pos) {
                    $orig_pos = $pos;
                    $max = 16 - $pos;

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

                if (16 <= $len) {
                    $cb = substr($ciphertext, $i, $len - ($len % 16));
                    $plaintext .= mcrypt_generic($this->ecb, $iv . $cb) ^ $cb;
                    $iv = substr($cb, -16);
                    $len %= 16;
                }

                if ($len) {
                    $iv = mcrypt_generic($this->ecb, $iv);
                    $plaintext .= $iv ^ substr($ciphertext, -$len);
                    $iv = substr_replace($iv, substr($ciphertext, -$len), 0, $len);
                    $pos = $len;
                }

                return $plaintext;
            }

            if ($this->paddable) {
                $ciphertext = str_pad($ciphertext, (strlen($ciphertext) + 15) & 4294967280, chr(0));
            }

            $plaintext = mdecrypt_generic($this->demcrypt, $ciphertext);

            if (empty($this->continuousBuffer)) { //反转
                mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
            }

            return $this->paddable ? $this->_unpad($plaintext) : $plaintext;
        }

        return parent::decrypt($ciphertext);
    }

    public function _mcryptSetup()
    {
        if (empty($this->changed)) { //反转
            return NULL;
        }

        if (1 < $this->explicit_key_length) { //反转
            $length = strlen($this->key) >> 2;

            if (8 < $length) {
                $length = 8;
            }
            else if ($length < 4) {
                $length = 4;
            }

            $this->Nk = $length;
            $this->key_size = $length << 2;
        }

        switch ($this->Nk) {
        case 4:
            $this->key_size = 16;
            break;

        case 5:
        case 6:
            $this->key_size = 24;
            break;

        case 7:
        case 8:
            $this->key_size = 32;
        }

        $this->key = str_pad(substr($this->key, 0, $this->key_size), $this->key_size, chr(0));
        $this->encryptIV = $this->decryptIV = $this->iv = str_pad(substr($this->iv, 0, 16), 16, chr(0));

        if (empty($this->enmcrypt)) { //反转
            $mode = $this->mode;
            $this->demcrypt = mcrypt_module_open(MCRYPT_RIJNDAEL_128, "", $mode, "");
            $this->enmcrypt = mcrypt_module_open(MCRYPT_RIJNDAEL_128, "", $mode, "");

            if ($mode == "ncfb") {
                $this->ecb = mcrypt_module_open(MCRYPT_RIJNDAEL_128, "", MCRYPT_MODE_ECB, "");
            }
        }

        mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
        mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);

        if ($this->mode == "ncfb") {
            mcrypt_generic_init($this->ecb, $this->key, "\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000");
        }

        $this->changed = false;
    }

    public function enableContinuousBuffer()
    {
        parent::enableContinuousBuffer();

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            $this->enbuffer["enmcrypt_init"] = true;
            $this->debuffer["demcrypt_init"] = true;
        }
    }

    public function disableContinuousBuffer()
    {
        parent::disableContinuousBuffer();

        if (CRYPT_AES_MODE == CRYPT_AES_MODE_MCRYPT) {
            mcrypt_generic_init($this->enmcrypt, $this->key, $this->iv);
            mcrypt_generic_init($this->demcrypt, $this->key, $this->iv);
        }
    }
}

define("CRYPT_AES_MODE_CTR", -1);
define("CRYPT_AES_MODE_ECB", 1);
define("CRYPT_AES_MODE_CBC", 2);
define("CRYPT_AES_MODE_CFB", 3);
define("CRYPT_AES_MODE_OFB", 4);
define("CRYPT_AES_MODE_INTERNAL", 1);
define("CRYPT_AES_MODE_MCRYPT", 2);

?>
