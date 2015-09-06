<?php

class Math_BigInteger
{
    /**
     * Holds the BigInteger's value.
     *
     * @var Array
     * @access private
     */
    public $value;
    /**
     * Holds the BigInteger's magnitude.
     *
     * @var Boolean
     * @access private
     */
    public $is_negative = false;
    /**
     * Random number generator function
     *
     * @see setRandomGenerator()
     * @access private
     */
    public $generator = "mt_rand";
    /**
     * Precision
     *
     * @see setPrecision()
     * @access private
     */
    public $precision = -1;
    /**
     * Precision Bitmask
     *
     * @see setPrecision()
     * @access private
     */
    public $bitmask = false;
    /**
     * Mode independent value used for serialization.
     *
     * If the bcmath or gmp extensions are installed $this->value will be a non-serializable resource, hence the need for 
     * a variable that'll be serializable regardless of whether or not extensions are being used.  Unlike $this->value,
     * however, $this->hex is only calculated when $this->__sleep() is called.
     *
     * @see __sleep()
     * @see __wakeup()
     * @var String
     * @access private
     */
    public $hex;

    public function Math_BigInteger($x, $base)
    {
        if (!defined("MATH_BIGINTEGER_MODE")) {
            switch (true) {
            case extension_loaded("gmp"):
                define("MATH_BIGINTEGER_MODE", MATH_BIGINTEGER_MODE_GMP);
                break;

            case :
                define("MATH_BIGINTEGER_MODE", MATH_BIGINTEGER_MODE_BCMATH);
                break;

            default:
                define("MATH_BIGINTEGER_MODE", MATH_BIGINTEGER_MODE_INTERNAL);
            }
        }

        if (function_exists("openssl_public_encrypt") && !defined("MATH_BIGINTEGER_OPENSSL_DISABLE") && !defined("MATH_BIGINTEGER_OPENSSL_ENABLED")) {
            define("MATH_BIGINTEGER_OPENSSL_ENABLED", true);
        }

        if (!defined("PHP_INT_SIZE")) {
            define("PHP_INT_SIZE", 4);
        }

        if (!defined("MATH_BIGINTEGER_BASE") && (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_INTERNAL)) {
            switch (PHP_INT_SIZE) {
            case PHP_INT_SIZE:
                define("MATH_BIGINTEGER_BASE", 31);
                define("MATH_BIGINTEGER_BASE_FULL", 2147483648);
                define("MATH_BIGINTEGER_MAX_DIGIT", 2147483647);
                define("MATH_BIGINTEGER_MSB", 1073741824);
                define("MATH_BIGINTEGER_MAX10", 1000000000);
                define("MATH_BIGINTEGER_MAX10_LEN", 9);
                define("MATH_BIGINTEGER_MAX_DIGIT2", pow(2, 62));
                break;

            default:
                define("MATH_BIGINTEGER_BASE", 26);
                define("MATH_BIGINTEGER_BASE_FULL", 67108864);
                define("MATH_BIGINTEGER_MAX_DIGIT", 67108863);
                define("MATH_BIGINTEGER_MSB", 33554432);
                define("MATH_BIGINTEGER_MAX10", 10000000);
                define("MATH_BIGINTEGER_MAX10_LEN", 7);
                define("MATH_BIGINTEGER_MAX_DIGIT2", pow(2, 52));
            }

            PHP_INT_SIZE;
        }

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            if (is_resource($x) && (get_resource_type($x) == "GMP integer")) {
                $this->value = $x;
                MATH_BIGINTEGER_MODE;
                return NULL;
            }

            $this->value = gmp_init(0);
            break;

        case MATH_BIGINTEGER_MODE_BCMATH:
            $this->value = "0";
            break;

        default:
            $this->value = array();
        }

        if ($x && ((abs($base) != 256) || ($x !== "0"))) {
            return NULL;
        }

        switch ($base) {
        case -256:
            if (ord($x[0]) & 128) {
                $x = ~$x;
                $this->is_negative = true;
            }
        case 256:
            switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $sign = ($this->is_negative ? "-" : "");
                $this->value = gmp_init($sign . "0x" . bin2hex($x));
                break;

            case MATH_BIGINTEGER_MODE_BCMATH:
                $len = (strlen($x) + 3) & 4294967292;
                $x = str_pad($x, $len, chr(0), STR_PAD_LEFT);

                for ($i = 0; $i < $len; $i += 4) {
                    $this->value = bcmul($this->value, "4294967296", 0);
                    $this->value = bcadd($this->value, (16777216 * ord($x[$i])) + ((ord($x[$i + 1]) << 16) | (ord($x[$i + 2]) << 8) | ord($x[$i + 3])), 0);
                }

                if ($this->is_negative) {
                    $this->value = "-" . $this->value;
                }

                break;

            default:
                while (strlen($x)) {
                    $this->value[] = $this->_bytes2int($this->_base256_rshift($x, MATH_BIGINTEGER_BASE));
                }
            }

            MATH_BIGINTEGER_MODE;

            if ($this->is_negative) {
                if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL) {
                    $this->is_negative = false;
                }

                $temp = $this->add(new Math_BigInteger("-1"));
                $this->value = $temp->value;
            }

            break;

        case 16:
        case -16:
            if ((0 < $base) && ($x[0] == "-")) {
                $this->is_negative = true;
                $x = substr($x, 1);
            }

            $x = preg_replace("#^(?:0x)?([A-Fa-f0-9]*).*#", "\$1", $x);
            $is_negative = false;
            if (($base < 0) && (8 <= hexdec($x[0]))) {
                $this->is_negative = $is_negative = true;
                $x = bin2hex(~pack("H*", $x));
            }

            switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $temp = ($this->is_negative ? "-0x" . $x : "0x" . $x);
                $this->value = gmp_init($temp);
                $this->is_negative = false;
                break;

            case MATH_BIGINTEGER_MODE_BCMATH:
                $x = (strlen($x) & 1 ? "0" . $x : $x);
                $temp = new Math_BigInteger(pack("H*", $x), 256);
                $this->value = $this->is_negative ? "-" . $temp->value : $temp->value;
                $this->is_negative = false;
                break;

            default:
                $x = (strlen($x) & 1 ? "0" . $x : $x);
                $temp = new Math_BigInteger(pack("H*", $x), 256);
                $this->value = $temp->value;
            }

            MATH_BIGINTEGER_MODE;

            if ($is_negative) {
                $temp = $this->add(new Math_BigInteger("-1"));
                $this->value = $temp->value;
            }

            break;

        case 10:
        case -10:
            $x = preg_replace("#(?<!^)(?:-).*|(?<=^|-)0*|[^-0-9].*#", "", $x);

            switch (MATH_BIGINTEGER_MODE) {
            case MATH_BIGINTEGER_MODE_GMP:
                $this->value = gmp_init($x);
                break;

            case MATH_BIGINTEGER_MODE_BCMATH:
                $this->value = $x === "-" ? "0" : (string) $x;
                break;

            default:
                $temp = new Math_BigInteger();
                $multiplier = new Math_BigInteger();
                $multiplier->value = array(MATH_BIGINTEGER_MAX10);

                if ($x[0] == "-") {
                    $this->is_negative = true;
                    $x = substr($x, 1);
                }

                $x = str_pad($x, strlen($x) + (((MATH_BIGINTEGER_MAX10_LEN - 1) * strlen($x)) % MATH_BIGINTEGER_MAX10_LEN), 0, STR_PAD_LEFT);

                while (strlen($x)) {
                    $temp = $temp->multiply($multiplier);
                    $temp = $temp->add(new Math_BigInteger($this->_int2bytes(substr($x, 0, MATH_BIGINTEGER_MAX10_LEN)), 256));
                    $x = substr($x, MATH_BIGINTEGER_MAX10_LEN);
                }

                $this->value = $temp->value;
            }

            MATH_BIGINTEGER_MODE;
            break;

        case 2:
        case -2:
            if ((0 < $base) && ($x[0] == "-")) {
                $this->is_negative = true;
                $x = substr($x, 1);
            }

            $x = preg_replace("#^([01]*).*#", "\$1", $x);
            $x = str_pad($x, strlen($x) + ((3 * strlen($x)) % 4), 0, STR_PAD_LEFT);
            $str = "0x";

            while (strlen($x)) {
                $part = substr($x, 0, 4);
                $str .= dechex(bindec($part));
                $x = substr($x, 4);
            }

            if ($this->is_negative) {
                $str = "-" . $str;
            }

            $temp = new Math_BigInteger($str, 8 * $base);
            $this->value = $temp->value;
            $this->is_negative = $temp->is_negative;
            break;

        default:
        }
    }

    public function toBytes($twos_compliment)
    {
        if ($twos_compliment) {
            $comparison = $this->compare(new Math_BigInteger());

            if ($comparison == 0) {
                return 0 < $this->precision ? str_repeat(chr(0), ($this->precision + 1) >> 3) : "";
            }

            $temp = ($comparison < 0 ? $this->add(new Math_BigInteger(1)) : $this->copy());
            $bytes = $temp->toBytes();

            if ($bytes) {
                $bytes = chr(0);
            }

            if (ord($bytes[0]) & 128) {
                $bytes = chr(0) . $bytes;
            }

            return $comparison < 0 ? ~$bytes : $bytes;
        }

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            if (gmp_cmp($this->value, gmp_init(0)) == 0) {
                MATH_BIGINTEGER_MODE;
                return 0 < $this->precision ? str_repeat(chr(0), ($this->precision + 1) >> 3) : "";
            }

            $temp = gmp_strval(gmp_abs($this->value), 16);
            $temp = (strlen($temp) & 1 ? "0" . $temp : $temp);
            $temp = pack("H*", $temp);
            return 0 < $this->precision ? substr(str_pad($temp, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($temp, chr(0));
        case MATH_BIGINTEGER_MODE_BCMATH:
            if ($this->value === "0") {
                return 0 < $this->precision ? str_repeat(chr(0), ($this->precision + 1) >> 3) : "";
            }

            $value = "";
            $current = $this->value;

            if ($current[0] == "-") {
                $current = substr($current, 1);
            }

            while (0 < bccomp($current, "0", 0)) {
                $temp = bcmod($current, "16777216");
                $value = chr($temp >> 16) . chr($temp >> 8) . chr($temp) . $value;
                $current = bcdiv($current, "16777216", 0);
            }

            return 0 < $this->precision ? substr(str_pad($value, $this->precision >> 3, chr(0), STR_PAD_LEFT), -($this->precision >> 3)) : ltrim($value, chr(0));
        }

        if (!count($this->value)) {
            return 0 < $this->precision ? str_repeat(chr(0), ($this->precision + 1) >> 3) : "";
        }

        $result = $this->_int2bytes($this->value[count($this->value) - 1]);
        $temp = $this->copy();

        for ($i = count($temp->value) - 2; 0 <= $i; --$i) {
            $temp->_base256_lshift($result, MATH_BIGINTEGER_BASE);
            $result = $result | str_pad($temp->_int2bytes($temp->value[$i]), strlen($result), chr(0), STR_PAD_LEFT);
        }

        return 0 < $this->precision ? str_pad(substr($result, -(($this->precision + 7) >> 3)), ($this->precision + 7) >> 3, chr(0), STR_PAD_LEFT) : $result;
    }

    public function toHex($twos_compliment)
    {
        return bin2hex($this->toBytes($twos_compliment));
    }

    public function toBits($twos_compliment)
    {
        $hex = $this->toHex($twos_compliment);
        $bits = "";
        $i = strlen($hex) - 8;

        for ($start = strlen($hex) & 7; $start <= $i; $i -= 8) {
            $bits = str_pad(decbin(hexdec(substr($hex, $i, 8))), 32, "0", STR_PAD_LEFT) . $bits;
        }

        if ($start) {
            $bits = str_pad(decbin(hexdec(substr($hex, 0, $start))), 8, "0", STR_PAD_LEFT) . $bits;
        }

        $result = (0 < $this->precision ? substr($bits, -$this->precision) : ltrim($bits, "0"));
        if ($twos_compliment && (0 < $this->compare(new Math_BigInteger())) && ($this->precision <= 0)) {
            return "0" . $result;
        }

        return $result;
    }

    public function toString()
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            MATH_BIGINTEGER_MODE;
            return gmp_strval($this->value);
        case MATH_BIGINTEGER_MODE_BCMATH:
            if ($this->value === "0") {
                return "0";
            }

            return ltrim($this->value, "0");
        }

        if (!count($this->value)) {
            return "0";
        }

        $temp = $this->copy();
        $temp->is_negative = false;
        $divisor = new Math_BigInteger();
        $divisor->value = array(MATH_BIGINTEGER_MAX10);
        $result = "";

        while (count($temp->value)) {
            list($temp, $mod) = $temp->divide($divisor);
            $result = str_pad($mod->value[0] ? $mod->value[0] : "", MATH_BIGINTEGER_MAX10_LEN, "0", STR_PAD_LEFT) . $result;
        }

        $result = ltrim($result, "0");

        if ($result) {
            $result = "0";
        }

        if ($this->is_negative) {
            $result = "-" . $result;
        }

        return $result;
    }

    public function copy()
    {
        $temp = new Math_BigInteger();
        $temp->value = $this->value;
        $temp->is_negative = $this->is_negative;
        $temp->generator = $this->generator;
        $temp->precision = $this->precision;
        $temp->bitmask = $this->bitmask;
        return $temp;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function __clone()
    {
        return $this->copy();
    }

    public function __sleep()
    {
        $this->hex = $this->toHex(true);
        $vars = array("hex");

        if ($this->generator != "mt_rand") {
            $vars[] = "generator";
        }

        if (0 < $this->precision) {
            $vars[] = "precision";
        }

        return $vars;
    }

    public function __wakeup()
    {
        $temp = new Math_BigInteger($this->hex, -16);
        $this->value = $temp->value;
        $this->is_negative = $temp->is_negative;
        $this->setRandomGenerator($this->generator);

        if (0 < $this->precision) {
            $this->setPrecision($this->precision);
        }
    }

    public function add($y)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_add($this->value, $y->value);
            MATH_BIGINTEGER_MODE;
            return $this->_normalize($temp);
        case MATH_BIGINTEGER_MODE_BCMATH:
            $temp = new Math_BigInteger();
            $temp->value = bcadd($this->value, $y->value, 0);
            return $this->_normalize($temp);
        }

        $temp = $this->_add($this->value, $this->is_negative, $y->value, $y->is_negative);
        $result = new Math_BigInteger();
        $result->value = $temp[MATH_BIGINTEGER_VALUE];
        $result->is_negative = $temp[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($result);
    }

    public function _add($x_value, $x_negative, $y_value, $y_negative)
    {
        $x_size = count($x_value);
        $y_size = count($y_value);

        if ($x_size == 0) {
            return array(MATH_BIGINTEGER_VALUE => $y_value, MATH_BIGINTEGER_SIGN => $y_negative);
        }
        else if ($y_size == 0) {
            return array(MATH_BIGINTEGER_VALUE => $x_value, MATH_BIGINTEGER_SIGN => $x_negative);
        }

        if ($x_negative != $y_negative) {
            if ($x_value == $y_value) {
                return array(
    MATH_BIGINTEGER_VALUE => array(),
    MATH_BIGINTEGER_SIGN  => false
    );
            }

            $temp = $this->_subtract($x_value, false, $y_value, false);
            $temp[MATH_BIGINTEGER_SIGN] = (0 < $this->_compare($x_value, false, $y_value, false) ? $x_negative : $y_negative);
            return $temp;
        }

        if ($x_size < $y_size) {
            $size = $x_size;
            $value = $y_value;
        }
        else {
            $size = $y_size;
            $value = $x_value;
        }

        $value[] = 0;
        $carry = 0;
        $i = 0;

        for ($j = 1; $j < $size; $i += 2, $j += 2) {
            $sum = ($x_value[$j] * MATH_BIGINTEGER_BASE_FULL) + $x_value[$i] + ($y_value[$j] * MATH_BIGINTEGER_BASE_FULL) + $y_value[$i] + $carry;
            $carry = MATH_BIGINTEGER_MAX_DIGIT2 <= $sum;
            $sum = ($carry ? $sum - MATH_BIGINTEGER_MAX_DIGIT2 : $sum);
            $temp = (int) $sum / MATH_BIGINTEGER_BASE_FULL;
            $value[$i] = (int) $sum - (MATH_BIGINTEGER_BASE_FULL * $temp);
            $value[$j] = $temp;
        }

        if ($j == $size) {
            $sum = $x_value[$i] + $y_value[$i] + $carry;
            $carry = MATH_BIGINTEGER_BASE_FULL <= $sum;
            $value[$i] = ($carry ? $sum - MATH_BIGINTEGER_BASE_FULL : $sum);
            ++$i;
        }

        if ($carry) {
            for (; $value[$i] == MATH_BIGINTEGER_MAX_DIGIT; ++$i) {
                $value[$i] = 0;
            }

            ++$value[$i];
        }

        return array(MATH_BIGINTEGER_VALUE => $this->_trim($value), MATH_BIGINTEGER_SIGN => $x_negative);
    }

    public function subtract($y)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_sub($this->value, $y->value);
            MATH_BIGINTEGER_MODE;
            return $this->_normalize($temp);
        case MATH_BIGINTEGER_MODE_BCMATH:
            $temp = new Math_BigInteger();
            $temp->value = bcsub($this->value, $y->value, 0);
            return $this->_normalize($temp);
        }

        $temp = $this->_subtract($this->value, $this->is_negative, $y->value, $y->is_negative);
        $result = new Math_BigInteger();
        $result->value = $temp[MATH_BIGINTEGER_VALUE];
        $result->is_negative = $temp[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($result);
    }

    public function _subtract($x_value, $x_negative, $y_value, $y_negative)
    {
        $x_size = count($x_value);
        $y_size = count($y_value);

        if ($x_size == 0) {
            return array(MATH_BIGINTEGER_VALUE => $y_value, MATH_BIGINTEGER_SIGN => !$y_negative);
        }
        else if ($y_size == 0) {
            return array(MATH_BIGINTEGER_VALUE => $x_value, MATH_BIGINTEGER_SIGN => $x_negative);
        }

        if ($x_negative != $y_negative) {
            $temp = $this->_add($x_value, false, $y_value, false);
            $temp[MATH_BIGINTEGER_SIGN] = $x_negative;
            return $temp;
        }

        $diff = $this->_compare($x_value, $x_negative, $y_value, $y_negative);

        if (!$diff) {
            return array(
    MATH_BIGINTEGER_VALUE => array(),
    MATH_BIGINTEGER_SIGN  => false
    );
        }

        if ((!$x_negative && ($diff < 0)) || ($x_negative && (0 < $diff))) {
            $temp = $x_value;
            $x_value = $y_value;
            $y_value = $temp;
            $x_negative = !$x_negative;
            $x_size = count($x_value);
            $y_size = count($y_value);
        }

        $carry = 0;
        $i = 0;

        for ($j = 1; $j < $y_size; $i += 2, $j += 2) {
            $sum = (($x_value[$j] * MATH_BIGINTEGER_BASE_FULL) + $x_value[$i]) - ($y_value[$j] * MATH_BIGINTEGER_BASE_FULL) - $y_value[$i] - $carry;
            $carry = $sum < 0;
            $sum = ($carry ? $sum + MATH_BIGINTEGER_MAX_DIGIT2 : $sum);
            $temp = (int) $sum / MATH_BIGINTEGER_BASE_FULL;
            $x_value[$i] = (int) $sum - (MATH_BIGINTEGER_BASE_FULL * $temp);
            $x_value[$j] = $temp;
        }

        if ($j == $y_size) {
            $sum = $x_value[$i] - $y_value[$i] - $carry;
            $carry = $sum < 0;
            $x_value[$i] = ($carry ? $sum + MATH_BIGINTEGER_BASE_FULL : $sum);
            ++$i;
        }

        if ($carry) {
            for (; !$x_value[$i]; ++$i) {
                $x_value[$i] = MATH_BIGINTEGER_MAX_DIGIT;
            }

            --$x_value[$i];
        }

        return array(MATH_BIGINTEGER_VALUE => $this->_trim($x_value), MATH_BIGINTEGER_SIGN => $x_negative);
    }

    public function multiply($x)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_mul($this->value, $x->value);
            MATH_BIGINTEGER_MODE;
            return $this->_normalize($temp);
        case MATH_BIGINTEGER_MODE_BCMATH:
            $temp = new Math_BigInteger();
            $temp->value = bcmul($this->value, $x->value, 0);
            return $this->_normalize($temp);
        }

        $temp = $this->_multiply($this->value, $this->is_negative, $x->value, $x->is_negative);
        $product = new Math_BigInteger();
        $product->value = $temp[MATH_BIGINTEGER_VALUE];
        $product->is_negative = $temp[MATH_BIGINTEGER_SIGN];
        return $this->_normalize($product);
    }

    public function _multiply($x_value, $x_negative, $y_value, $y_negative)
    {
        $x_length = count($x_value);
        $y_length = count($y_value);
        if (!$x_length || !$y_length) {
            return array(
    MATH_BIGINTEGER_VALUE => array(),
    MATH_BIGINTEGER_SIGN  => false
    );
        }

        return array(MATH_BIGINTEGER_VALUE => min($x_length, $y_length) < (2 * MATH_BIGINTEGER_KARATSUBA_CUTOFF) ? $this->_trim($this->_regularMultiply($x_value, $y_value)) : $this->_trim($this->_karatsuba($x_value, $y_value)), MATH_BIGINTEGER_SIGN => $x_negative != $y_negative);
    }

    public function _regularMultiply($x_value, $y_value)
    {
        $x_length = count($x_value);
        $y_length = count($y_value);
        if (!$x_length || !$y_length) {
            return array();
        }

        if ($x_length < $y_length) {
            $temp = $x_value;
            $x_value = $y_value;
            $y_value = $temp;
            $x_length = count($x_value);
            $y_length = count($y_value);
        }

        $product_value = $this->_array_repeat(0, $x_length + $y_length);
        $carry = 0;

        for ($j = 0; $j < $x_length; ++$j) {
            $temp = ($x_value[$j] * $y_value[0]) + $carry;
            $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
            $product_value[$j] = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * $carry);
        }

        $product_value[$j] = $carry;

        for ($i = 1; $i < $y_length; ++$i) {
            $carry = 0;
            $j = 0;

            for ($k = $i; $j < $x_length; ++$j, ++$k) {
                $temp = $product_value[$k] + ($x_value[$j] * $y_value[$i]) + $carry;
                $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
                $product_value[$k] = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * $carry);
            }

            $product_value[$k] = $carry;
        }

        return $product_value;
    }

    public function _karatsuba($x_value, $y_value)
    {
        $m = min(count($x_value) >> 1, count($y_value) >> 1);

        if ($m < MATH_BIGINTEGER_KARATSUBA_CUTOFF) {
            return $this->_regularMultiply($x_value, $y_value);
        }

        $x1 = array_slice($x_value, $m);
        $x0 = array_slice($x_value, 0, $m);
        $y1 = array_slice($y_value, $m);
        $y0 = array_slice($y_value, 0, $m);
        $z2 = $this->_karatsuba($x1, $y1);
        $z0 = $this->_karatsuba($x0, $y0);
        $z1 = $this->_add($x1, false, $x0, false);
        $temp = $this->_add($y1, false, $y0, false);
        $z1 = $this->_karatsuba($z1[MATH_BIGINTEGER_VALUE], $temp[MATH_BIGINTEGER_VALUE]);
        $temp = $this->_add($z2, false, $z0, false);
        $z1 = $this->_subtract($z1, false, $temp[MATH_BIGINTEGER_VALUE], false);
        $z2 = array_merge(array_fill(0, 2 * $m, 0), $z2);
        $z1[MATH_BIGINTEGER_VALUE] = array_merge(array_fill(0, $m, 0), $z1[MATH_BIGINTEGER_VALUE]);
        $xy = $this->_add($z2, false, $z1[MATH_BIGINTEGER_VALUE], $z1[MATH_BIGINTEGER_SIGN]);
        $xy = $this->_add($xy[MATH_BIGINTEGER_VALUE], $xy[MATH_BIGINTEGER_SIGN], $z0, false);
        return $xy[MATH_BIGINTEGER_VALUE];
    }

    public function _square($x)
    {
        return count($x) < (2 * MATH_BIGINTEGER_KARATSUBA_CUTOFF) ? $this->_trim($this->_baseSquare($x)) : $this->_trim($this->_karatsubaSquare($x));
    }

    public function _baseSquare($value)
    {
        if ($value) {
            return array();
        }

        $square_value = $this->_array_repeat(0, 2 * count($value));
        $i = 0;

        for ($max_index = count($value) - 1; $i <= $max_index; ++$i) {
            $i2 = $i << 1;
            $temp = $square_value[$i2] + ($value[$i] * $value[$i]);
            $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
            $square_value[$i2] = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * $carry);
            $j = $i + 1;

            for ($k = $i2 + 1; $j <= $max_index; ++$j, ++$k) {
                $temp = $square_value[$k] + (2 * $value[$j] * $value[$i]) + $carry;
                $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
                $square_value[$k] = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * $carry);
            }

            $square_value[$i + $max_index + 1] = $carry;
        }

        return $square_value;
    }

    public function _karatsubaSquare($value)
    {
        $m = count($value) >> 1;

        if ($m < MATH_BIGINTEGER_KARATSUBA_CUTOFF) {
            return $this->_baseSquare($value);
        }

        $x1 = array_slice($value, $m);
        $x0 = array_slice($value, 0, $m);
        $z2 = $this->_karatsubaSquare($x1);
        $z0 = $this->_karatsubaSquare($x0);
        $z1 = $this->_add($x1, false, $x0, false);
        $z1 = $this->_karatsubaSquare($z1[MATH_BIGINTEGER_VALUE]);
        $temp = $this->_add($z2, false, $z0, false);
        $z1 = $this->_subtract($z1, false, $temp[MATH_BIGINTEGER_VALUE], false);
        $z2 = array_merge(array_fill(0, 2 * $m, 0), $z2);
        $z1[MATH_BIGINTEGER_VALUE] = array_merge(array_fill(0, $m, 0), $z1[MATH_BIGINTEGER_VALUE]);
        $xx = $this->_add($z2, false, $z1[MATH_BIGINTEGER_VALUE], $z1[MATH_BIGINTEGER_SIGN]);
        $xx = $this->_add($xx[MATH_BIGINTEGER_VALUE], $xx[MATH_BIGINTEGER_SIGN], $z0, false);
        return $xx[MATH_BIGINTEGER_VALUE];
    }

    public function divide($y)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $quotient = new Math_BigInteger();
            $remainder = new Math_BigInteger();
            $remainder->value = gmp_div_qr($this->value, $y->value)[1];
            $quotient->value = gmp_div_qr($this->value, $y->value)[0];

            if (gmp_sign($remainder->value) < 0) {
                $remainder->value = gmp_add($remainder->value, gmp_abs($y->value));
            }

            MATH_BIGINTEGER_MODE;
            return array($this->_normalize($quotient), $this->_normalize($remainder));
        case MATH_BIGINTEGER_MODE_BCMATH:
            $quotient = new Math_BigInteger();
            $remainder = new Math_BigInteger();
            $quotient->value = bcdiv($this->value, $y->value, 0);
            $remainder->value = bcmod($this->value, $y->value);

            if ($remainder->value[0] == "-") {
                $remainder->value = bcadd($remainder->value, $y->value[0] == "-" ? substr($y->value, 1) : $y->value, 0);
            }

            return array($this->_normalize($quotient), $this->_normalize($remainder));
        }

        if (count($y->value) == 1) {
            list($q, $r) = $this->_divide_digit($this->value, $y->value[0]);
            $quotient = new Math_BigInteger();
            $remainder = new Math_BigInteger();
            $quotient->value = $q;
            $remainder->value = array($r);
            $quotient->is_negative = $this->is_negative != $y->is_negative;
            return array($this->_normalize($quotient), $this->_normalize($remainder));
        }

        static $zero;

        if (!$zero) {
            $zero = new Math_BigInteger();
        }

        $x = $this->copy();
        $y = $y->copy();
        $x_sign = $x->is_negative;
        $y_sign = $y->is_negative;
        $x->is_negative = $y->is_negative = false;
        $diff = $x->compare($y);

        if (!$diff) {
            $temp = new Math_BigInteger();
            $temp->value = array(1);
            $temp->is_negative = $x_sign != $y_sign;
            return array($this->_normalize($temp), $this->_normalize(new Math_BigInteger()));
        }

        if ($diff < 0) {
            if ($x_sign) {
                $x = $y->subtract($x);
            }

            return array($this->_normalize(new Math_BigInteger()), $this->_normalize($x));
        }

        $msb = $y->value[count($y->value) - 1];

        for ($shift = 0; !$msb & MATH_BIGINTEGER_MSB; ++$shift) {
            $msb <<= 1;
        }

        $x->_lshift($shift);
        $y->_lshift($shift);
        $y_value = &$y->value;
        $x_max = count($x->value) - 1;
        $y_max = count($y->value) - 1;
        $quotient = new Math_BigInteger();
        $quotient_value = &$quotient->value;
        $quotient_value = $this->_array_repeat(0, ($x_max - $y_max) + 1);
        static $temp;
        static $lhs;
        static $rhs;

        if (!$temp) {
            $temp = new Math_BigInteger();
            $lhs = new Math_BigInteger();
            $rhs = new Math_BigInteger();
        }

        $temp_value = &$temp->value;
        $rhs_value = &$rhs->value;
        $temp_value = array_merge($this->_array_repeat(0, $x_max - $y_max), $y_value);

        while (0 <= $x->compare($temp)) {
            ++$quotient_value[$x_max - $y_max];
            $x = $x->subtract($temp);
            $x_max = count($x->value) - 1;
        }

        for ($i = $x_max; ($y_max + 1) <= $i; --$i) {
            $x_value = &$x->value;
            $x_window = array($x_value[$i] ? $x_value[$i] : 0, $x_value[$i - 1] ? $x_value[$i - 1] : 0, $x_value[$i - 2] ? $x_value[$i - 2] : 0);
            $y_window = array($y_value[$y_max], 0 < $y_max ? $y_value[$y_max - 1] : 0);
            $q_index = $i - $y_max - 1;

            if ($x_window[0] == $y_window[0]) {
                $quotient_value[$q_index] = MATH_BIGINTEGER_MAX_DIGIT;
            }
            else {
                $quotient_value[$q_index] = (int) (($x_window[0] * MATH_BIGINTEGER_BASE_FULL) + $x_window[1]) / $y_window[0];
            }

            $temp_value = array($y_window[1], $y_window[0]);
            $lhs->value = array($quotient_value[$q_index]);
            $lhs = $lhs->multiply($temp);
            $rhs_value = array($x_window[2], $x_window[1], $x_window[0]);

            while (0 < $lhs->compare($rhs)) {
                --$quotient_value[$q_index];
                $lhs->value = array($quotient_value[$q_index]);
                $lhs = $lhs->multiply($temp);
            }

            $adjust = $this->_array_repeat(0, $q_index);
            $temp_value = array($quotient_value[$q_index]);
            $temp = $temp->multiply($y);
            $temp_value = &$temp->value;
            $temp_value = array_merge($adjust, $temp_value);
            $x = $x->subtract($temp);

            if ($x->compare($zero) < 0) {
                $temp_value = array_merge($adjust, $y_value);
                $x = $x->add($temp);
                --$quotient_value[$q_index];
            }

            $x_max = count($x_value) - 1;
        }

        $x->_rshift($shift);
        $quotient->is_negative = $x_sign != $y_sign;

        if ($x_sign) {
            $y->_rshift($shift);
            $x = $y->subtract($x);
        }

        return array($this->_normalize($quotient), $this->_normalize($x));
    }

    public function _divide_digit($dividend, $divisor)
    {
        $carry = 0;
        $result = array();

        for ($i = count($dividend) - 1; 0 <= $i; --$i) {
            $temp = (MATH_BIGINTEGER_BASE_FULL * $carry) + $dividend[$i];
            $result[$i] = (int) $temp / $divisor;
            $carry = (int) $temp - ($divisor * $result[$i]);
        }

        return array($result, $carry);
    }

    public function modPow($e, $n)
    {
        $n = (($this->bitmask !== false) && ($this->bitmask->compare($n) < 0) ? $this->bitmask : $n->abs());

        if ($e->compare(new Math_BigInteger()) < 0) {
            $e = $e->abs();
            $temp = $this->modInverse($n);

            if ($temp === false) {
                return false;
            }

            return $this->_normalize($temp->modPow($e, $n));
        }

        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_GMP) {
            $temp = new Math_BigInteger();
            $temp->value = gmp_powm($this->value, $e->value, $n->value);
            return $this->_normalize($temp);
        }

        if (($this->compare(new Math_BigInteger()) < 0) || (0 < $this->compare($n))) {
            list(, $temp) = $this->divide($n);
            return $temp->modPow($e, $n);
        }

        if (defined("MATH_BIGINTEGER_OPENSSL_ENABLED")) {
            $components = array("modulus" => $n->toBytes(true), "publicExponent" => $e->toBytes(true));
            $components = array("modulus" => pack("Ca*a*", 2, $this->_encodeASN1Length(strlen($components["modulus"])), $components["modulus"]), "publicExponent" => pack("Ca*a*", 2, $this->_encodeASN1Length(strlen($components["publicExponent"])), $components["publicExponent"]));
            $RSAPublicKey = pack("Ca*a*a*", 48, $this->_encodeASN1Length(strlen($components["modulus"]) + strlen($components["publicExponent"])), $components["modulus"], $components["publicExponent"]);
            $rsaOID = pack("H*", "300d06092a864886f70d0101010500");
            $RSAPublicKey = chr(0) . $RSAPublicKey;
            $RSAPublicKey = chr(3) . $this->_encodeASN1Length(strlen($RSAPublicKey)) . $RSAPublicKey;
            $encapsulated = pack("Ca*a*", 48, $this->_encodeASN1Length(strlen($rsaOID . $RSAPublicKey)), $rsaOID . $RSAPublicKey);
            $RSAPublicKey = "-----BEGIN PUBLIC KEY-----\r\n" . chunk_split(base64_encode($encapsulated)) . "-----END PUBLIC KEY-----";
            $plaintext = str_pad($this->toBytes(), strlen($n->toBytes(true)) - 1, "\000", STR_PAD_LEFT);

            if (openssl_public_encrypt($plaintext, $result, $RSAPublicKey, OPENSSL_NO_PADDING)) {
                return new Math_BigInteger($result, 256);
            }
        }

        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
            $temp = new Math_BigInteger();
            $temp->value = bcpowmod($this->value, $e->value, $n->value, 0);
            return $this->_normalize($temp);
        }

        if ($e->value) {
            $temp = new Math_BigInteger();
            $temp->value = array(1);
            return $this->_normalize($temp);
        }

        if ($e->value == array(1)) {
            list(, $temp) = $this->divide($n);
            return $this->_normalize($temp);
        }

        if ($e->value == array(2)) {
            $temp = new Math_BigInteger();
            $temp->value = $this->_square($this->value);
            list(, $temp) = $temp->divide($n);
            return $this->_normalize($temp);
        }

        return $this->_normalize($this->_slidingWindow($e, $n, MATH_BIGINTEGER_BARRETT));

        if ($n->value[0] & 1) {
            return $this->_normalize($this->_slidingWindow($e, $n, MATH_BIGINTEGER_MONTGOMERY));
        }

        for ($i = 0; $i < count($n->value); ++$i) {
            if ($n->value[$i]) {
                $temp = decbin($n->value[$i]);
                $j = strlen($temp) - strrpos($temp, "1") - 1;
                $j += 26 * $i;
                break;
            }
        }

        $mod1 = $n->copy();
        $mod1->_rshift($j);
        $mod2 = new Math_BigInteger();
        $mod2->value = array(1);
        $mod2->_lshift($j);
        $part1 = ($mod1->value != array(1) ? $this->_slidingWindow($e, $mod1, MATH_BIGINTEGER_MONTGOMERY) : new Math_BigInteger());
        $part2 = $this->_slidingWindow($e, $mod2, MATH_BIGINTEGER_POWEROF2);
        $y1 = $mod2->modInverse($mod1);
        $y2 = $mod1->modInverse($mod2);
        $result = $part1->multiply($mod2);
        $result = $result->multiply($y1);
        $temp = $part2->multiply($mod1);
        $temp = $temp->multiply($y2);
        $result = $result->add($temp);
        list(, $result) = $result->divide($n);
        return $this->_normalize($result);
    }

    public function powMod($e, $n)
    {
        return $this->modPow($e, $n);
    }

    public function _slidingWindow($e, $n, $mode)
    {
        static $window_ranges = array(7, 25, 81, 241, 673, 1793);
        $e_value = $e->value;
        $e_length = count($e_value) - 1;
        $e_bits = decbin($e_value[$e_length]);

        for ($i = $e_length - 1; 0 <= $i; --$i) {
            $e_bits .= str_pad(decbin($e_value[$i]), MATH_BIGINTEGER_BASE, "0", STR_PAD_LEFT);
        }

        $e_length = strlen($e_bits);
        $i = 0;

        for ($window_size = 1; $i < count($window_ranges); ++$window_size, ++$i) {
        }

        $n_value = $n->value;
        $powers = array();
        $powers[1] = $this->_prepareReduce($this->value, $n_value, $mode);
        $powers[2] = $this->_squareReduce($powers[1], $n_value, $mode);
        $temp = 1 << ($window_size - 1);

        for ($i = 1; $i < $temp; ++$i) {
            $i2 = $i << 1;
            $powers[$i2 + 1] = $this->_multiplyReduce($powers[$i2 - 1], $powers[2], $n_value, $mode);
        }

        $result = array(1);
        $result = $this->_prepareReduce($result, $n_value, $mode);

        for ($i = 0; $i < $e_length; ) {
            if (!$e_bits[$i]) {
                $result = $this->_squareReduce($result, $n_value, $mode);
                ++$i;
            }
            else {
                for ($j = $window_size - 1; 0 < $j; --$j) {
                    if (!$e_bits[$i + $j]) {
                        break;
                    }
                }

                for ($k = 0; $k <= $j; ++$k) {
                    $result = $this->_squareReduce($result, $n_value, $mode);
                }

                $result = $this->_multiplyReduce($result, $powers[bindec(substr($e_bits, $i, $j + 1))], $n_value, $mode);
                $i += $j + 1;
            }
        }

        $temp = new Math_BigInteger();
        $temp->value = $this->_reduce($result, $n_value, $mode);
        return $temp;
    }

    public function _reduce($x, $n, $mode)
    {
        switch ($mode) {
        case MATH_BIGINTEGER_MONTGOMERY:
            return $this->_montgomery($x, $n);
        case MATH_BIGINTEGER_BARRETT:
            return $this->_barrett($x, $n);
        case MATH_BIGINTEGER_POWEROF2:
            $lhs = new Math_BigInteger();
            $lhs->value = $x;
            $rhs = new Math_BigInteger();
            $rhs->value = $n;
            return $x->_mod2($n);
        case MATH_BIGINTEGER_CLASSIC:
            $lhs = new Math_BigInteger();
            $lhs->value = $x;
            $rhs = new Math_BigInteger();
            $rhs->value = $n;
            list(, $temp) = $lhs->divide($rhs);
            return $temp->value;
        case MATH_BIGINTEGER_NONE:
            return $x;
        default:
        }
    }

    public function _prepareReduce($x, $n, $mode)
    {
        if ($mode == MATH_BIGINTEGER_MONTGOMERY) {
            return $this->_prepMontgomery($x, $n);
        }

        return $this->_reduce($x, $n, $mode);
    }

    public function _multiplyReduce($x, $y, $n, $mode)
    {
        if ($mode == MATH_BIGINTEGER_MONTGOMERY) {
            return $this->_montgomeryMultiply($x, $y, $n);
        }

        $temp = $this->_multiply($x, false, $y, false);
        return $this->_reduce($temp[MATH_BIGINTEGER_VALUE], $n, $mode);
    }

    public function _squareReduce($x, $n, $mode)
    {
        if ($mode == MATH_BIGINTEGER_MONTGOMERY) {
            return $this->_montgomeryMultiply($x, $x, $n);
        }

        return $this->_reduce($this->_square($x), $n, $mode);
    }

    public function _mod2($n)
    {
        $temp = new Math_BigInteger();
        $temp->value = array(1);
        return $this->bitwise_and($n->subtract($temp));
    }

    public function _barrett($n, $m)
    {
        static $cache = array(
            "MATH_BIGINTEGER_VARIABLE\000\030" => array(),
            "MATH_BIGINTEGER_DATA\000\030"     => array()
            );
        $m_length = count($m);

        if ((2 * $m_length) < count($n)) {
            $lhs = new Math_BigInteger();
            $rhs = new Math_BigInteger();
            $lhs->value = $n;
            $rhs->value = $m;
            list(, $temp) = $lhs->divide($rhs);
            return $temp->value;
        }

        if ($m_length < 5) {
            return $this->_regularBarrett($n, $m);
        }

        if (($key = array_search($m, $cache[MATH_BIGINTEGER_VARIABLE])) === false) {
            $key = count($cache[MATH_BIGINTEGER_VARIABLE]);
            $cache[MATH_BIGINTEGER_VARIABLE][] = $m;
            $lhs = new Math_BigInteger();
            $lhs_value = &$lhs->value;
            $lhs_value = $this->_array_repeat(0, $m_length + ($m_length >> 1));
            $lhs_value[] = 1;
            $rhs = new Math_BigInteger();
            $rhs->value = $m;
            list($u, $m1) = $lhs->divide($rhs);
            $u = $u->value;
            $m1 = $m1->value;
            $cache[MATH_BIGINTEGER_DATA][] = array("u" => $u, "m1" => $m1);
        }
        else {
            extract($cache[MATH_BIGINTEGER_DATA][$key]);
        }

        $cutoff = $m_length + ($m_length >> 1);
        $lsd = array_slice($n, 0, $cutoff);
        $msd = array_slice($n, $cutoff);
        $lsd = $this->_trim($lsd);
        $temp = $this->_multiply($msd, false, $m1, false);
        $n = $this->_add($lsd, false, $temp[MATH_BIGINTEGER_VALUE], false);

        if ($m_length & 1) {
            return $this->_regularBarrett($n[MATH_BIGINTEGER_VALUE], $m);
        }

        $temp = array_slice($n[MATH_BIGINTEGER_VALUE], $m_length - 1);
        $temp = $this->_multiply($temp, false, $u, false);
        $temp = array_slice($temp[MATH_BIGINTEGER_VALUE], ($m_length >> 1) + 1);
        $temp = $this->_multiply($temp, false, $m, false);
        $result = $this->_subtract($n[MATH_BIGINTEGER_VALUE], false, $temp[MATH_BIGINTEGER_VALUE], false);

        while (0 <= $this->_compare($result[MATH_BIGINTEGER_VALUE], $result[MATH_BIGINTEGER_SIGN], $m, false)) {
            $result = $this->_subtract($result[MATH_BIGINTEGER_VALUE], $result[MATH_BIGINTEGER_SIGN], $m, false);
        }

        return $result[MATH_BIGINTEGER_VALUE];
    }

    public function _regularBarrett($x, $n)
    {
        static $cache = array(
            "MATH_BIGINTEGER_VARIABLE\000\030" => array(),
            "MATH_BIGINTEGER_DATA\000\030"     => array()
            );
        $n_length = count($n);

        if ((2 * $n_length) < count($x)) {
            $lhs = new Math_BigInteger();
            $rhs = new Math_BigInteger();
            $lhs->value = $x;
            $rhs->value = $n;
            list(, $temp) = $lhs->divide($rhs);
            return $temp->value;
        }

        if (($key = array_search($n, $cache[MATH_BIGINTEGER_VARIABLE])) === false) {
            $key = count($cache[MATH_BIGINTEGER_VARIABLE]);
            $cache[MATH_BIGINTEGER_VARIABLE][] = $n;
            $lhs = new Math_BigInteger();
            $lhs_value = &$lhs->value;
            $lhs_value = $this->_array_repeat(0, 2 * $n_length);
            $lhs_value[] = 1;
            $rhs = new Math_BigInteger();
            $rhs->value = $n;
            list($temp) = $lhs->divide($rhs);
            $cache[MATH_BIGINTEGER_DATA][] = $temp->value;
        }

        $temp = array_slice($x, $n_length - 1);
        $temp = $this->_multiply($temp, false, $cache[MATH_BIGINTEGER_DATA][$key], false);
        $temp = array_slice($temp[MATH_BIGINTEGER_VALUE], $n_length + 1);
        $result = array_slice($x, 0, $n_length + 1);
        $temp = $this->_multiplyLower($temp, false, $n, false, $n_length + 1);

        if ($this->_compare($result, false, $temp[MATH_BIGINTEGER_VALUE], $temp[MATH_BIGINTEGER_SIGN]) < 0) {
            $corrector_value = $this->_array_repeat(0, $n_length + 1);
            $corrector_value[] = 1;
            $result = $this->_add($result, false, $corrector_value, false);
            $result = $result[MATH_BIGINTEGER_VALUE];
        }

        $result = $this->_subtract($result, false, $temp[MATH_BIGINTEGER_VALUE], $temp[MATH_BIGINTEGER_SIGN]);

        while (0 < $this->_compare($result[MATH_BIGINTEGER_VALUE], $result[MATH_BIGINTEGER_SIGN], $n, false)) {
            $result = $this->_subtract($result[MATH_BIGINTEGER_VALUE], $result[MATH_BIGINTEGER_SIGN], $n, false);
        }

        return $result[MATH_BIGINTEGER_VALUE];
    }

    public function _multiplyLower($x_value, $x_negative, $y_value, $y_negative, $stop)
    {
        $x_length = count($x_value);
        $y_length = count($y_value);
        if (!$x_length || !$y_length) {
            return array(
    MATH_BIGINTEGER_VALUE => array(),
    MATH_BIGINTEGER_SIGN  => false
    );
        }

        if ($x_length < $y_length) {
            $temp = $x_value;
            $x_value = $y_value;
            $y_value = $temp;
            $x_length = count($x_value);
            $y_length = count($y_value);
        }

        $product_value = $this->_array_repeat(0, $x_length + $y_length);
        $carry = 0;

        for ($j = 0; $j < $x_length; ++$j) {
            $temp = ($x_value[$j] * $y_value[0]) + $carry;
            $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
            $product_value[$j] = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * $carry);
        }

        if ($j < $stop) {
            $product_value[$j] = $carry;
        }

        for ($i = 1; $i < $y_length; ++$i) {
            $carry = 0;
            $j = 0;

            for ($k = $i; $k < $stop; ++$j, ++$k) {
                $temp = $product_value[$k] + ($x_value[$j] * $y_value[$i]) + $carry;
                $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
                $product_value[$k] = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * $carry);
            }

            if ($k < $stop) {
                $product_value[$k] = $carry;
            }
        }

        return array(MATH_BIGINTEGER_VALUE => $this->_trim($product_value), MATH_BIGINTEGER_SIGN => $x_negative != $y_negative);
    }

    public function _montgomery($x, $n)
    {
        static $cache = array(
            "MATH_BIGINTEGER_VARIABLE\000\030" => array(),
            "MATH_BIGINTEGER_DATA\000\030"     => array()
            );

        if (($key = array_search($n, $cache[MATH_BIGINTEGER_VARIABLE])) === false) {
            $key = count($cache[MATH_BIGINTEGER_VARIABLE]);
            $cache[MATH_BIGINTEGER_VARIABLE][] = $x;
            $cache[MATH_BIGINTEGER_DATA][] = $this->_modInverse67108864($n);
        }

        $k = count($n);
        $result = array(MATH_BIGINTEGER_VALUE => $x);

        for ($i = 0; $i < $k; ++$i) {
            $temp = $result[MATH_BIGINTEGER_VALUE][$i] * $cache[MATH_BIGINTEGER_DATA][$key];
            $temp = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * (int) $temp / MATH_BIGINTEGER_BASE_FULL);
            $temp = $this->_regularMultiply(array($temp), $n);
            $temp = array_merge($this->_array_repeat(0, $i), $temp);
            $result = $this->_add($result[MATH_BIGINTEGER_VALUE], false, $temp, false);
        }

        $result[MATH_BIGINTEGER_VALUE] = array_slice($result[MATH_BIGINTEGER_VALUE], $k);

        if (0 <= $this->_compare($result, false, $n, false)) {
            $result = $this->_subtract($result[MATH_BIGINTEGER_VALUE], false, $n, false);
        }

        return $result[MATH_BIGINTEGER_VALUE];
    }

    public function _montgomeryMultiply($x, $y, $m)
    {
        $temp = $this->_multiply($x, false, $y, false);
        return $this->_montgomery($temp[MATH_BIGINTEGER_VALUE], $m);
        static $cache = array(
            "MATH_BIGINTEGER_VARIABLE\000\030" => array(),
            "MATH_BIGINTEGER_DATA\000\030"     => array()
            );

        if (($key = array_search($m, $cache[MATH_BIGINTEGER_VARIABLE])) === false) {
            $key = count($cache[MATH_BIGINTEGER_VARIABLE]);
            $cache[MATH_BIGINTEGER_VARIABLE][] = $m;
            $cache[MATH_BIGINTEGER_DATA][] = $this->_modInverse67108864($m);
        }

        $n = max(count($x), count($y), count($m));
        $x = array_pad($x, $n, 0);
        $y = array_pad($y, $n, 0);
        $m = array_pad($m, $n, 0);
        $a = array(MATH_BIGINTEGER_VALUE => $this->_array_repeat(0, $n + 1));

        for ($i = 0; $i < $n; ++$i) {
            $temp = $a[MATH_BIGINTEGER_VALUE][0] + ($x[$i] * $y[0]);
            $temp = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * (int) $temp / MATH_BIGINTEGER_BASE_FULL);
            $temp = $temp * $cache[MATH_BIGINTEGER_DATA][$key];
            $temp = (int) $temp - (MATH_BIGINTEGER_BASE_FULL * (int) $temp / MATH_BIGINTEGER_BASE_FULL);
            $temp = $this->_add($this->_regularMultiply(array($x[$i]), $y), false, $this->_regularMultiply(array($temp), $m), false);
            $a = $this->_add($a[MATH_BIGINTEGER_VALUE], false, $temp[MATH_BIGINTEGER_VALUE], false);
            $a[MATH_BIGINTEGER_VALUE] = array_slice($a[MATH_BIGINTEGER_VALUE], 1);
        }

        if (0 <= $this->_compare($a[MATH_BIGINTEGER_VALUE], false, $m, false)) {
            $a = $this->_subtract($a[MATH_BIGINTEGER_VALUE], false, $m, false);
        }

        return $a[MATH_BIGINTEGER_VALUE];
    }

    public function _prepMontgomery($x, $n)
    {
        $lhs = new Math_BigInteger();
        $lhs->value = array_merge($this->_array_repeat(0, count($n)), $x);
        $rhs = new Math_BigInteger();
        $rhs->value = $n;
        list(, $temp) = $lhs->divide($rhs);
        return $temp->value;
    }

    public function _modInverse67108864($x)
    {
        $x = -$x[0];
        $result = $x & 3;
        $result = ($result * (2 - ($x * $result))) & 15;
        $result = ($result * (2 - (($x & 255) * $result))) & 255;
        $result = ($result * ((2 - (($x & 65535) * $result)) & 65535)) & 65535;
        $result = fmod($result * (2 - fmod($x * $result, MATH_BIGINTEGER_BASE_FULL)), MATH_BIGINTEGER_BASE_FULL);
        return $result & MATH_BIGINTEGER_MAX_DIGIT;
    }

    public function modInverse($n)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_invert($this->value, $n->value);
            MATH_BIGINTEGER_MODE;
            return $temp->value === false ? false : $this->_normalize($temp);
        }

        static $zero;
        static $one;

        if (!$zero) {
            $zero = new Math_BigInteger();
            $one = new Math_BigInteger(1);
        }

        $n = $n->abs();

        if ($this->compare($zero) < 0) {
            $temp = $this->abs();
            $temp = $temp->modInverse($n);
            return $this->_normalize($n->subtract($temp));
        }

        $extendedGCD = $this->extendedGCD($n);
        $gcd = $extendedGCD["gcd"];
        $x = $extendedGCD["x"];
        $y = $extendedGCD["y"];

        if (!$gcd->equals($one)) {
            return false;
        }

        $x = ($x->compare($zero) < 0 ? $x->add($n) : $x);
        return $this->compare($zero) < 0 ? $this->_normalize($n->subtract($x)) : $this->_normalize($x);
    }

    public function extendedGCD($n)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $_gmp_gcdext = gmp_gcdext($this->value, $n->value);
            $g = $_gmp_gcdext["g"];
            $s = $_gmp_gcdext["s"];
            $t = $_gmp_gcdext["t"];
            MATH_BIGINTEGER_MODE;
            return array("gcd" => $this->_normalize(new Math_BigInteger($g)), "x" => $this->_normalize(new Math_BigInteger($s)), "y" => $this->_normalize(new Math_BigInteger($t)));
        case MATH_BIGINTEGER_MODE_BCMATH:
            $u = $this->value;
            $v = $n->value;
            $a = "1";
            $b = "0";
            $c = "0";
            $d = "1";

            while (bccomp($v, "0", 0) != 0) {
                $q = bcdiv($u, $v, 0);
                $temp = $u;
                $u = $v;
                $v = bcsub($temp, bcmul($v, $q, 0), 0);
                $temp = $a;
                $a = $c;
                $c = bcsub($temp, bcmul($a, $q, 0), 0);
                $temp = $b;
                $b = $d;
                $d = bcsub($temp, bcmul($b, $q, 0), 0);
            }

            return array("gcd" => $this->_normalize(new Math_BigInteger($u)), "x" => $this->_normalize(new Math_BigInteger($a)), "y" => $this->_normalize(new Math_BigInteger($b)));
        }

        $y = $n->copy();
        $x = $this->copy();
        $g = new Math_BigInteger();
        $g->value = array(1);
        while (!($x->value[0] & 1) || ($y->value[0] & 1)) {
            $x->_rshift(1);
            $y->_rshift(1);
            $g->_lshift(1);
        }

        $u = $x->copy();
        $v = $y->copy();
        $a = new Math_BigInteger();
        $b = new Math_BigInteger();
        $c = new Math_BigInteger();
        $d = new Math_BigInteger();
        $a->value = $d->value = $g->value = array(1);
        $b->value = $c->value = array();

        while (!$u->value) {
            while (!$u->value[0] & 1) {
                $u->_rshift(1);
                if ((!$a->value && ($a->value[0] & 1)) || (!$b->value && ($b->value[0] & 1))) {
                    $a = $a->add($y);
                    $b = $b->subtract($x);
                }

                $a->_rshift(1);
                $b->_rshift(1);
            }

            while (!$v->value[0] & 1) {
                $v->_rshift(1);
                if ((!$d->value && ($d->value[0] & 1)) || (!$c->value && ($c->value[0] & 1))) {
                    $c = $c->add($y);
                    $d = $d->subtract($x);
                }

                $c->_rshift(1);
                $d->_rshift(1);
            }

            if (0 <= $u->compare($v)) {
                $u = $u->subtract($v);
                $a = $a->subtract($c);
                $b = $b->subtract($d);
            }
            else {
                $v = $v->subtract($u);
                $c = $c->subtract($a);
                $d = $d->subtract($b);
            }
        }

        return array("gcd" => $this->_normalize($g->multiply($v)), "x" => $this->_normalize($c), "y" => $this->_normalize($d));
    }

    public function gcd($n)
    {
        $_extendedGCD = $this->extendedGCD($n);
        return $_extendedGCD["gcd"];
    }

    public function abs()
    {
        $temp = new Math_BigInteger();

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp->value = gmp_abs($this->value);
            break;

        case MATH_BIGINTEGER_MODE_BCMATH:
            $temp->value = bccomp($this->value, "0", 0) < 0 ? substr($this->value, 1) : $this->value;
            break;

        default:
            $temp->value = $this->value;
        }

        MATH_BIGINTEGER_MODE;
        return $temp;
    }

    public function compare($y)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            MATH_BIGINTEGER_MODE;
            return gmp_cmp($this->value, $y->value);
        case MATH_BIGINTEGER_MODE_BCMATH:
            return bccomp($this->value, $y->value, 0);
        }

        return $this->_compare($this->value, $this->is_negative, $y->value, $y->is_negative);
    }

    public function _compare($x_value, $x_negative, $y_value, $y_negative)
    {
        if ($x_negative != $y_negative) {
            return !$x_negative && $y_negative ? 1 : -1;
        }

        $result = ($x_negative ? -1 : 1);

        if (count($x_value) != count($y_value)) {
            return count($y_value) < count($x_value) ? $result : -$result;
        }

        $size = max(count($x_value), count($y_value));
        $x_value = array_pad($x_value, $size, 0);
        $y_value = array_pad($y_value, $size, 0);

        for ($i = count($x_value) - 1; 0 <= $i; --$i) {
            if ($x_value[$i] != $y_value[$i]) {
                return $y_value[$i] < $x_value[$i] ? $result : -$result;
            }
        }

        return 0;
    }

    public function equals($x)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            MATH_BIGINTEGER_MODE;
            return gmp_cmp($this->value, $x->value) == 0;
        default:
            return ($this->value === $x->value) && ($this->is_negative == $x->is_negative);
        }
    }

    public function setPrecision($bits)
    {
        $this->precision = $bits;

        if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_BCMATH) {
            $this->bitmask = new Math_BigInteger(chr((1 << ($bits & 7)) - 1) . str_repeat(chr(255), $bits >> 3), 256);
        }
        else {
            $this->bitmask = new Math_BigInteger(bcpow("2", $bits, 0));
        }

        $temp = $this->_normalize($this);
        $this->value = $temp->value;
    }

    public function bitwise_and($x)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_and($this->value, $x->value);
            MATH_BIGINTEGER_MODE;
            return $this->_normalize($temp);
        case MATH_BIGINTEGER_MODE_BCMATH:
            $left = $this->toBytes();
            $right = $x->toBytes();
            $length = max(strlen($left), strlen($right));
            $left = str_pad($left, $length, chr(0), STR_PAD_LEFT);
            $right = str_pad($right, $length, chr(0), STR_PAD_LEFT);
            return $this->_normalize(new Math_BigInteger($left & $right, 256));
        }

        $result = $this->copy();
        $length = min(count($x->value), count($this->value));
        $result->value = array_slice($result->value, 0, $length);

        for ($i = 0; $i < $length; ++$i) {
            $result->value[$i] &= $x->value[$i];
        }

        return $this->_normalize($result);
    }

    public function bitwise_or($x)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_or($this->value, $x->value);
            MATH_BIGINTEGER_MODE;
            return $this->_normalize($temp);
        case MATH_BIGINTEGER_MODE_BCMATH:
            $left = $this->toBytes();
            $right = $x->toBytes();
            $length = max(strlen($left), strlen($right));
            $left = str_pad($left, $length, chr(0), STR_PAD_LEFT);
            $right = str_pad($right, $length, chr(0), STR_PAD_LEFT);
            return $this->_normalize(new Math_BigInteger($left | $right, 256));
        }

        $length = max(count($this->value), count($x->value));
        $result = $this->copy();
        $result->value = array_pad($result->value, $length, 0);
        $x->value = array_pad($x->value, $length, 0);

        for ($i = 0; $i < $length; ++$i) {
            $result->value[$i] |= $x->value[$i];
        }

        return $this->_normalize($result);
    }

    public function bitwise_xor($x)
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            $temp = new Math_BigInteger();
            $temp->value = gmp_xor($this->value, $x->value);
            MATH_BIGINTEGER_MODE;
            return $this->_normalize($temp);
        case MATH_BIGINTEGER_MODE_BCMATH:
            $left = $this->toBytes();
            $right = $x->toBytes();
            $length = max(strlen($left), strlen($right));
            $left = str_pad($left, $length, chr(0), STR_PAD_LEFT);
            $right = str_pad($right, $length, chr(0), STR_PAD_LEFT);
            return $this->_normalize(new Math_BigInteger($left ^ $right, 256));
        }

        $length = max(count($this->value), count($x->value));
        $result = $this->copy();
        $result->value = array_pad($result->value, $length, 0);
        $x->value = array_pad($x->value, $length, 0);

        for ($i = 0; $i < $length; ++$i) {
            $result->value[$i] ^= $x->value[$i];
        }

        return $this->_normalize($result);
    }

    public function bitwise_not()
    {
        $temp = $this->toBytes();
        $pre_msb = decbin(ord($temp[0]));
        $temp = ~$temp;
        $msb = decbin(ord($temp[0]));

        if (strlen($msb) == 8) {
            $msb = substr($msb, strpos($msb, "0"));
        }

        $temp[0] = chr(bindec($msb));
        $current_bits = (strlen($pre_msb) + (8 * strlen($temp))) - 8;
        $new_bits = $this->precision - $current_bits;

        if ($new_bits <= 0) {
            return $this->_normalize(new Math_BigInteger($temp, 256));
        }

        $leading_ones = chr((1 << ($new_bits & 7)) - 1) . str_repeat(chr(255), $new_bits >> 3);
        $this->_base256_lshift($leading_ones, $current_bits);
        $temp = str_pad($temp, ceil($this->bits / 8), chr(0), STR_PAD_LEFT);
        return $this->_normalize(new Math_BigInteger($leading_ones | $temp, 256));
    }

    public function bitwise_rightShift($shift)
    {
        $temp = new Math_BigInteger();

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            static $two;

            if (!$two) {
                $two = gmp_init("2");
            }

            $temp->value = gmp_div_q($this->value, gmp_pow($two, $shift));
            break;

        case MATH_BIGINTEGER_MODE_BCMATH:
            $temp->value = bcdiv($this->value, bcpow("2", $shift, 0), 0);
            break;

        default:
            $temp->value = $this->value;
            $temp->_rshift($shift);
        }

        MATH_BIGINTEGER_MODE;
        return $this->_normalize($temp);
    }

    public function bitwise_leftShift($shift)
    {
        $temp = new Math_BigInteger();

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            static $two;

            if (!$two) {
                $two = gmp_init("2");
            }

            $temp->value = gmp_mul($this->value, gmp_pow($two, $shift));
            break;

        case MATH_BIGINTEGER_MODE_BCMATH:
            $temp->value = bcmul($this->value, bcpow("2", $shift, 0), 0);
            break;

        default:
            $temp->value = $this->value;
            $temp->_lshift($shift);
        }

        MATH_BIGINTEGER_MODE;
        return $this->_normalize($temp);
    }

    public function bitwise_leftRotate($shift)
    {
        $bits = $this->toBytes();

        if (0 < $this->precision) {
            $precision = $this->precision;

            if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
                $mask = $this->bitmask->subtract(new Math_BigInteger(1));
                $mask = $mask->toBytes();
            }
            else {
                $mask = $this->bitmask->toBytes();
            }
        }
        else {
            $temp = ord($bits[0]);

            for ($i = 0; $temp >> $i; ++$i) {
            }

            $precision = ((8 * strlen($bits)) - 8) + $i;
            $mask = chr((1 << ($precision & 7)) - 1) . str_repeat(chr(255), $precision >> 3);
        }

        if ($shift < 0) {
            $shift += $precision;
        }

        $shift %= $precision;

        if (!$shift) {
            return $this->copy();
        }

        $left = $this->bitwise_leftShift($shift);
        $left = $left->bitwise_and(new Math_BigInteger($mask, 256));
        $right = $this->bitwise_rightShift($precision - $shift);
        $result = (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_BCMATH ? $left->bitwise_or($right) : $left->add($right));
        return $this->_normalize($result);
    }

    public function bitwise_rightRotate($shift)
    {
        return $this->bitwise_leftRotate(-$shift);
    }

    public function setRandomGenerator($generator)
    {
    }

    public function random($min, $max)
    {
        if ($min === false) {
            $min = new Math_BigInteger(0);
        }

        if ($max === false) {
            $max = new Math_BigInteger(2147483647);
        }

        $compare = $max->compare($min);

        if (!$compare) {
            return $this->_normalize($min);
        }
        else if ($compare < 0) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }

        $max = $max->subtract($min);
        $max = ltrim($max->toBytes(), chr(0));
        $size = strlen($max) - 1;
        $random = "";

        if ($size & 1) {
            $random .= chr(mt_rand(0, 255));
        }

        $blocks = $size >> 1;

        for ($i = 0; $i < $blocks; ++$i) {
            $random .= pack("n", mt_rand(0, 65535));
        }

        $fragment = new Math_BigInteger($random, 256);
        $leading = (0 < $fragment->compare(new Math_BigInteger(substr($max, 1), 256)) ? ord($max[0]) - 1 : ord($max[0]));
        $msb = chr(mt_rand(0, $leading));
        $random = new Math_BigInteger($msb . $random, 256);
        return $this->_normalize($random->add($min));
    }

    public function randomPrime($min, $max, $timeout)
    {
        if ($min === false) {
            $min = new Math_BigInteger(0);
        }

        if ($max === false) {
            $max = new Math_BigInteger(2147483647);
        }

        $compare = $max->compare($min);

        if (!$compare) {
            return $min->isPrime() ? $min : false;
        }
        else if ($compare < 0) {
            $temp = $max;
            $max = $min;
            $min = $temp;
        }

        static $one;
        static $two;

        if (!$one) {
            $one = new Math_BigInteger(1);
            $two = new Math_BigInteger(2);
        }

        $start = time();
        $x = $this->random($min, $max);

        if ($x->equals($two)) {
            return $x;
        }

        $x->_make_odd();

        if (0 < $x->compare($max)) {
            if ($min->equals($max)) {
                return false;
            }

            $x = $min->copy();
            $x->_make_odd();
        }

        $initial_x = $x->copy();

        while (true) {
            if (($timeout !== false) && ($timeout < (time() - $start))) {
                return false;
            }

            if ($x->isPrime()) {
                return $x;
            }

            $x = $x->add($two);

            if (0 < $x->compare($max)) {
                $x = $min->copy();

                if ($x->equals($two)) {
                    return $x;
                }

                $x->_make_odd();
            }

            if ($x->equals($initial_x)) {
                return false;
            }
        }
    }

    public function _make_odd()
    {
        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            gmp_setbit($this->value, 0);
            break;

        case MATH_BIGINTEGER_MODE_BCMATH:
            if (($this->value[strlen($this->value) - 1] % 2) == 0) {
                $this->value = bcadd($this->value, "1");
            }

            break;

        default:
            $this->value[0] |= 1;
        }

        MATH_BIGINTEGER_MODE;
    }

    public function isPrime($t)
    {
        $length = strlen($this->toBytes());

        if (!$t) {
            if (163 <= $length) {
                $t = 2;
            }
            else if (106 <= $length) {
                $t = 3;
            }
            else if (81 <= $length) {
                $t = 4;
            }
            else if (68 <= $length) {
                $t = 5;
            }
            else if (56 <= $length) {
                $t = 6;
            }
            else if (50 <= $length) {
                $t = 7;
            }
            else if (43 <= $length) {
                $t = 8;
            }
            else if (37 <= $length) {
                $t = 9;
            }
            else if (31 <= $length) {
                $t = 12;
            }
            else if (25 <= $length) {
                $t = 15;
            }
            else if (18 <= $length) {
                $t = 18;
            }
            else {
                $t = 27;
            }
        }

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            MATH_BIGINTEGER_MODE;
            return gmp_prob_prime($this->value, $t) != 0;
        case MATH_BIGINTEGER_MODE_BCMATH:
            if ($this->value === "2") {
                return true;
            }

            if (($this->value[strlen($this->value) - 1] % 2) == 0) {
                return false;
            }

            break;

        default:
            if ($this->value == array(2)) {
                return true;
            }

            if (~$this->value[0] & 1) {
                return false;
            }
        }

        static $primes;
        static $zero;
        static $one;
        static $two;

        if (!$primes) {
            $primes = array(3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97, 101, 103, 107, 109, 113, 127, 131, 137, 139, 149, 151, 157, 163, 167, 173, 179, 181, 191, 193, 197, 199, 211, 223, 227, 229, 233, 239, 241, 251, 257, 263, 269, 271, 277, 281, 283, 293, 307, 311, 313, 317, 331, 337, 347, 349, 353, 359, 367, 373, 379, 383, 389, 397, 401, 409, 419, 421, 431, 433, 439, 443, 449, 457, 461, 463, 467, 479, 487, 491, 499, 503, 509, 521, 523, 541, 547, 557, 563, 569, 571, 577, 587, 593, 599, 601, 607, 613, 617, 619, 631, 641, 643, 647, 653, 659, 661, 673, 677, 683, 691, 701, 709, 719, 727, 733, 739, 743, 751, 757, 761, 769, 773, 787, 797, 809, 811, 821, 823, 827, 829, 839, 853, 857, 859, 863, 877, 881, 883, 887, 907, 911, 919, 929, 937, 941, 947, 953, 967, 971, 977, 983, 991, 997);

            if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL) {
                for ($i = 0; $i < count($primes); ++$i) {
                    $primes[$i] = new Math_BigInteger($primes[$i]);
                }
            }

            $zero = new Math_BigInteger();
            $one = new Math_BigInteger(1);
            $two = new Math_BigInteger(2);
        }

        if ($this->equals($one)) {
            return false;
        }

        if (MATH_BIGINTEGER_MODE != MATH_BIGINTEGER_MODE_INTERNAL) {
            foreach ($primes as $prime ) {
                list(, $r) = $this->divide($prime);

                if ($r->equals($zero)) {
                    return $this->equals($prime);
                }
            }
        }
        else {
            $value = $this->value;

            foreach ($primes as $prime ) {
                list(, $r) = $this->_divide_digit($value, $prime);

                if (!$r) {
                    return (count($value) == 1) && ($value[0] == $prime);
                }
            }
        }

        $n = $this->copy();
        $n_1 = $n->subtract($one);
        $n_2 = $n->subtract($two);
        $r = $n_1->copy();
        $r_value = $r->value;

        if (MATH_BIGINTEGER_MODE == MATH_BIGINTEGER_MODE_BCMATH) {
            $s = 0;

            while (($r->value[strlen($r->value) - 1] % 2) == 0) {
                $r->value = bcdiv($r->value, "2", 0);
                ++$s;
            }
        }
        else {
            $i = 0;

            for ($r_length = count($r_value); $i < $r_length; ++$i) {
                $temp = ~$r_value[$i] & 16777215;

                for ($j = 1; ($temp >> $j) & 1; ++$j) {
                }

                if ($j != 25) {
                    break;
                }
            }

            $s = ((26 * $i) + $j) - 1;
            $r->_rshift($s);
        }

        for ($i = 0; $i < $t; ++$i) {
            $a = $this->random($two, $n_2);
            $y = $a->modPow($r, $n);
            if (!$y->equals($one) && !$y->equals($n_1)) {
                for ($j = 1; !$y->equals($n_1); ++$j) {
                    $y = $y->modPow($two, $n);

                    if ($y->equals($one)) {
                        return false;
                    }
                }

                if (!$y->equals($n_1)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function _lshift($shift)
    {
        if ($shift == 0) {
            return NULL;
        }

        $num_digits = (int) $shift / MATH_BIGINTEGER_BASE;
        $shift %= MATH_BIGINTEGER_BASE;
        $shift = 1 << $shift;
        $carry = 0;

        for ($i = 0; $i < count($this->value); ++$i) {
            $temp = ($this->value[$i] * $shift) + $carry;
            $carry = (int) $temp / MATH_BIGINTEGER_BASE_FULL;
            $this->value[$i] = (int) $temp - ($carry * MATH_BIGINTEGER_BASE_FULL);
        }

        if ($carry) {
            $this->value[] = $carry;
        }

        while ($num_digits--) {
            array_unshift($this->value, 0);
        }
    }

    public function _rshift($shift)
    {
        if ($shift == 0) {
            return NULL;
        }

        $num_digits = (int) $shift / MATH_BIGINTEGER_BASE;
        $shift %= MATH_BIGINTEGER_BASE;
        $carry_shift = MATH_BIGINTEGER_BASE - $shift;
        $carry_mask = (1 << $shift) - 1;

        if ($num_digits) {
            $this->value = array_slice($this->value, $num_digits);
        }

        $carry = 0;

        for ($i = count($this->value) - 1; 0 <= $i; --$i) {
            $temp = ($this->value[$i] >> $shift) | $carry;
            $carry = ($this->value[$i] & $carry_mask) << $carry_shift;
            $this->value[$i] = $temp;
        }

        $this->value = $this->_trim($this->value);
    }

    public function _normalize($result)
    {
        $result->precision = $this->precision;
        $result->bitmask = $this->bitmask;

        switch (MATH_BIGINTEGER_MODE) {
        case MATH_BIGINTEGER_MODE_GMP:
            if (!$result->bitmask->value) {
                $result->value = gmp_and($result->value, $result->bitmask->value);
            }

            MATH_BIGINTEGER_MODE;
            return $result;
        case MATH_BIGINTEGER_MODE_BCMATH:
            if (!$result->bitmask->value) {
                $result->value = bcmod($result->value, $result->bitmask->value);
            }

            return $result;
        }

        $value = &$result->value;

        if (!count($value)) {
            return $result;
        }

        $value = $this->_trim($value);

        if (!$result->bitmask->value) {
            $length = min(count($value), count($this->bitmask->value));
            $value = array_slice($value, 0, $length);

            for ($i = 0; $i < $length; ++$i) {
                $value[$i] = $value[$i] & $this->bitmask->value[$i];
            }
        }

        return $result;
    }

    public function _trim($value)
    {
        for ($i = count($value) - 1; 0 <= $i; --$i) {
            if ($value[$i]) {
                break;
            }

            unset($value[$i]);
        }

        return $value;
    }

    public function _array_repeat($input, $multiplier)
    {
        return $multiplier ? array_fill(0, $multiplier, $input) : array();
    }

    public function _base256_lshift(&$x, $shift)
    {
        if ($shift == 0) {
            return NULL;
        }

        $num_bytes = $shift >> 3;
        $shift &= 7;
        $carry = 0;

        for ($i = strlen($x) - 1; 0 <= $i; --$i) {
            $temp = (ord($x[$i]) << $shift) | $carry;
            $x[$i] = chr($temp);
            $carry = $temp >> 8;
        }

        $carry = ($carry != 0 ? chr($carry) : "");
        $x = $carry . $x . str_repeat(chr(0), $num_bytes);
    }

    public function _base256_rshift(&$x, $shift)
    {
        if ($shift == 0) {
            $x = ltrim($x, chr(0));
            return "";
        }

        $num_bytes = $shift >> 3;
        $shift &= 7;
        $remainder = "";

        if ($num_bytes) {
            $start = (strlen($x) < $num_bytes ? -strlen($x) : -$num_bytes);
            $remainder = substr($x, $start);
            $x = substr($x, 0, -$num_bytes);
        }

        $carry = 0;
        $carry_shift = 8 - $shift;

        for ($i = 0; $i < strlen($x); ++$i) {
            $temp = (ord($x[$i]) >> $shift) | $carry;
            $carry = (ord($x[$i]) << $carry_shift) & 255;
            $x[$i] = chr($temp);
        }

        $x = ltrim($x, chr(0));
        $remainder = chr($carry >> $carry_shift) . $remainder;
        return ltrim($remainder, chr(0));
    }

    public function _int2bytes($x)
    {
        return ltrim(pack("N", $x), chr(0));
    }

    public function _bytes2int($x)
    {
        $temp = unpack("Nint", str_pad($x, 4, chr(0), STR_PAD_LEFT));
        return $temp["int"];
    }

    public function _encodeASN1Length($length)
    {
        if ($length <= 127) {
            return chr($length);
        }

        $temp = ltrim(pack("N", $length), chr(0));
        return pack("Ca*", 128 | strlen($temp), $temp);
    }
}

define("MATH_BIGINTEGER_MONTGOMERY", 0);
define("MATH_BIGINTEGER_BARRETT", 1);
define("MATH_BIGINTEGER_POWEROF2", 2);
define("MATH_BIGINTEGER_CLASSIC", 3);
define("MATH_BIGINTEGER_NONE", 4);
define("MATH_BIGINTEGER_VALUE", 0);
define("MATH_BIGINTEGER_SIGN", 1);
define("MATH_BIGINTEGER_VARIABLE", 0);
define("MATH_BIGINTEGER_DATA", 1);
define("MATH_BIGINTEGER_MODE_INTERNAL", 1);
define("MATH_BIGINTEGER_MODE_BCMATH", 2);
define("MATH_BIGINTEGER_MODE_GMP", 3);
define("MATH_BIGINTEGER_KARATSUBA_CUTOFF", 25);

?>
