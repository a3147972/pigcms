<?php

class Crypt_Rijndael
{
    /**
     * The Encryption Mode
     *
     * @see Crypt_Rijndael::Crypt_Rijndael()
     * @var Integer
     * @access private
     */
    public $mode;
    /**
     * The Key
     *
     * @see Crypt_Rijndael::setKey()
     * @var String
     * @access private
     */
    public $key = "\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000\000";
    /**
     * The Initialization Vector
     *
     * @see Crypt_Rijndael::setIV()
     * @var String
     * @access private
     */
    public $iv = "";
    /**
     * A "sliding" Initialization Vector
     *
     * @see Crypt_Rijndael::enableContinuousBuffer()
     * @var String
     * @access private
     */
    public $encryptIV = "";
    /**
     * A "sliding" Initialization Vector
     *
     * @see Crypt_Rijndael::enableContinuousBuffer()
     * @var String
     * @access private
     */
    public $decryptIV = "";
    /**
     * Continuous Buffer status
     *
     * @see Crypt_Rijndael::enableContinuousBuffer()
     * @var Boolean
     * @access private
     */
    public $continuousBuffer = false;
    /**
     * Padding status
     *
     * @see Crypt_Rijndael::enablePadding()
     * @var Boolean
     * @access private
     */
    public $padding = true;
    /**
     * Does the key schedule need to be (re)calculated?
     *
     * @see setKey()
     * @see setBlockLength()
     * @see setKeyLength()
     * @var Boolean
     * @access private
     */
    public $changed = true;
    /**
     * Has the key length explicitly been set or should it be derived from the key, itself?
     *
     * @see setKeyLength()
     * @var Boolean
     * @access private
     */
    public $explicit_key_length = false;
    /**
     * The Key Schedule
     *
     * @see _setup()
     * @var Array
     * @access private
     */
    public $w;
    /**
     * The Inverse Key Schedule
     *
     * @see _setup()
     * @var Array
     * @access private
     */
    public $dw;
    /**
     * The Block Length
     *
     * @see setBlockLength()
     * @var Integer
     * @access private
     * @internal The max value is 32, the min value is 16.  All valid values are multiples of 4.  Exists in conjunction with
     *     $Nb because we need this value and not $Nb to pad strings appropriately.  
     */
    public $block_size = 16;
    /**
     * The Block Length divided by 32
     *
     * @see setBlockLength()
     * @var Integer
     * @access private
     * @internal The max value is 256 / 32 = 8, the min value is 128 / 32 = 4.  Exists in conjunction with $block_size 
     *    because the encryption / decryption / key schedule creation requires this number and not $block_size.  We could 
     *    derive this from $block_size or vice versa, but that'd mean we'd have to do multiple shift operations, so in lieu
     *    of that, we'll just precompute it once.
     *
     */
    public $Nb = 4;
    /**
     * The Key Length
     *
     * @see setKeyLength()
     * @var Integer
     * @access private
     * @internal The max value is 256 / 8 = 32, the min value is 128 / 8 = 16.  Exists in conjunction with $key_size
     *    because the encryption / decryption / key schedule creation requires this number and not $key_size.  We could 
     *    derive this from $key_size or vice versa, but that'd mean we'd have to do multiple shift operations, so in lieu
     *    of that, we'll just precompute it once.
     */
    public $key_size = 16;
    /**
     * The Key Length divided by 32
     *
     * @see setKeyLength()
     * @var Integer
     * @access private
     * @internal The max value is 256 / 32 = 8, the min value is 128 / 32 = 4
     */
    public $Nk = 4;
    /**
     * The Number of Rounds
     *
     * @var Integer
     * @access private
     * @internal The max value is 14, the min value is 10.
     */
    public $Nr;
    /**
     * Shift offsets
     *
     * @var Array
     * @access private
     */
    public $c;
    /**
     * Precomputed mixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $t0;
    /**
     * Precomputed mixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $t1;
    /**
     * Precomputed mixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $t2;
    /**
     * Precomputed mixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $t3;
    /**
     * Precomputed invMixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $dt0;
    /**
     * Precomputed invMixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $dt1;
    /**
     * Precomputed invMixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $dt2;
    /**
     * Precomputed invMixColumns table
     *
     * @see Crypt_Rijndael()
     * @var Array
     * @access private
     */
    public $dt3;
    /**
     * The SubByte S-Box
     *
     * @see Crypt_Rijndael::_encryptBlock()
     * @var Array
     * @access private
     */
    public $sbox;
    /**
     * The inverse SubByte S-Box
     *
     * @see Crypt_Rijndael::_decryptBlock()
     * @var Array
     * @access private
     */
    public $isbox;
    /**
     * Performance-optimized callback function for en/decrypt()
     *
     * @see Crypt_Rijndael::encrypt()
     * @see Crypt_Rijndael::decrypt()
     * @see Crypt_Rijndael::inline_crypt_setup()
     * @see Crypt_Rijndael::$use_inline_crypt
     * @var Callback
     * @access private
     */
    public $inline_crypt;
    /**
     * Holds whether performance-optimized $inline_crypt should be used or not.
     *
     * @see Crypt_Rijndael::Crypt_Rijndael()
     * @see Crypt_Rijndael::inline_crypt_setup()
     * @see Crypt_Rijndael::$inline_crypt
     * @var Boolean
     * @access private
     */
    public $use_inline_crypt = true;
    /**
     * Is the mode one that is paddable?
     *
     * @see Crypt_Rijndael::Crypt_Rijndael()
     * @var Boolean
     * @access private
     */
    public $paddable = false;
    /**
     * Encryption buffer for CTR, OFB and CFB modes
     *
     * @see Crypt_Rijndael::encrypt()
     * @var String
     * @access private
     */
    public $enbuffer = array("encrypted" => "", "xor" => "", "pos" => 0);
    /**
     * Decryption buffer for CTR, OFB and CFB modes
     *
     * @see Crypt_Rijndael::decrypt()
     * @var String
     * @access private
     */
    public $debuffer = array("ciphertext" => "", "xor" => "", "pos" => 0);

    public function Crypt_Rijndael($mode)
    {
        switch ($mode) {
        case CRYPT_RIJNDAEL_MODE_ECB:
        case CRYPT_RIJNDAEL_MODE_CBC:
            $this->paddable = true;
            $this->mode = $mode;
            break;

        case CRYPT_RIJNDAEL_MODE_CTR:
        case CRYPT_RIJNDAEL_MODE_CFB:
        case CRYPT_RIJNDAEL_MODE_OFB:
            $this->mode = $mode;
            break;

        default:
            $this->paddable = true;
            $this->mode = CRYPT_RIJNDAEL_MODE_CBC;
        }

        $t3 = &$this->t3;
        $t2 = &$this->t2;
        $t1 = &$this->t1;
        $t0 = &$this->t0;
        $dt3 = &$this->dt3;
        $dt2 = &$this->dt2;
        $dt1 = &$this->dt1;
        $dt0 = &$this->dt0;
        $t3 = array(1667474886, 2088535288, 2004326894, 2071694838, 4075949567, 1802223062, 1869591006, 3318043793, 808472672, 16843522, 1734846926, 724270422, 4278065639, 3621216949, 2880169549, 1987484396, 3402253711, 2189597983, 3385409673, 2105378810, 4210693615, 1499065266, 1195886990, 4042263547, 2913856577, 3570689971, 2728590687, 2947541573, 2627518243, 2762274643, 1920112356, 3233831835, 3082273397, 4261223649, 2475929149, 640051788, 909531756, 1061110142, 4160160501, 3435941763, 875846760, 2779116625, 3857003729, 4059105529, 1903268834, 3638064043, 825316194, 353713962, 67374088, 3351728789, 589522246, 3284360861, 404236336, 2526454071, 84217610, 2593830191, 117901582, 303183396, 2155911963, 3806477791, 3958056653, 656894286, 2998062463, 1970642922, 151591698, 2206440989, 741110872, 437923380, 454765878, 1852748508, 1515908788, 2694904667, 1381168804, 993742198, 3604373943, 3014905469, 690584402, 3823320797, 791638366, 2223281939, 1398011302, 3520161977, 0, 3991743681, 538992704, 4244381667, 2981218425, 1532751286, 1785380564, 3419096717, 3200178535, 960056178, 1246420628, 1280103576, 1482221744, 3486468741, 3503319995, 4025428677, 2863326543, 4227536621, 1128514950, 1296947098, 859002214, 2240123921, 1162203018, 4193849577, 33687044, 2139062782, 1347481760, 1010582648, 2678045221, 2829640523, 1364325282, 2745433693, 1077985408, 2408548869, 2459086143, 2644360225, 943212656, 4126475505, 3166494563, 3065430391, 3671750063, 555836226, 269496352, 4294908645, 4092792573, 3537006015, 3452783745, 202118168, 320025894, 3974901699, 1600119230, 2543297077, 1145359496, 387397934, 3301201811, 2812801621, 2122220284, 1027426170, 1684319432, 1566435258, 421079858, 1936954854, 1616945344, 2172753945, 1330631070, 3705438115, 572679748, 707427924, 2425400123, 2290647819, 1179044492, 4008585671, 3099120491, 336870440, 3739122087, 1583276732, 185277718, 3688593069, 3772791771, 842159716, 976899700, 168435220, 1229577106, 101059084, 606366792, 1549591736, 3267517855, 3553849021, 2897014595, 1650632388, 2442242105, 2509612081, 3840161747, 2038008818, 3890688725, 3368567691, 926374254, 1835907034, 2374863873, 3587531953, 1313788572, 2846482505, 1819063512, 1448540844, 4109633523, 3941213647, 1701162954, 2054852340, 2930698567, 134748176, 3132806511, 2021165296, 623210314, 774795868, 471606328, 2795958615, 3031746419, 3334885783, 3907527627, 3722280097, 1953799400, 522133822, 1263263126, 3183336545, 2341176845, 2324333839, 1886425312, 1044267644, 3048588401, 1718004428, 1212733584, 50529542, 4143317495, 235803164, 1633788866, 892690282, 1465383342, 3115962473, 2256965911, 3250673817, 488449850, 2661202215, 3789633753, 4177007595, 2560144171, 286339874, 1768537042, 3654906025, 2391705863, 2492770099, 2610673197, 505291324, 2273808917, 3924369609, 3469625735, 1431699370, 673740880, 3755965093, 2358021891, 2711746649, 2307489801, 218961690, 3217021541, 3873845719, 1111672452, 1751693520, 1094828930, 2576986153, 757954394, 252645662, 2964376443, 1414855848, 3149649517, 370555436);
        $dt3 = array(4104605777, 1097159550, 396673818, 660510266, 2875968315, 2638606623, 4200115116, 3808662347, 821712160, 1986918061, 3430322568, 38544885, 3856137295, 718002117, 893681702, 1654886325, 2975484382, 3122358053, 3926825029, 4274053469, 796197571, 1290801793, 1184342925, 3556361835, 2405426947, 2459735317, 1836772287, 1381620373, 3196267988, 1948373848, 3764988233, 3385345166, 3263785589, 2390325492, 1480485785, 3111247143, 3780097726, 2293045232, 548169417, 3459953789, 3746175075, 439452389, 1362321559, 1400849762, 1685577905, 1806599355, 2174754046, 137073913, 1214797936, 1174215055, 3731654548, 2079897426, 1943217067, 1258480242, 529487843, 1437280870, 3945269170, 3049390895, 3313212038, 923313619, 679998000, 3215307299, 57326082, 377642221, 3474729866, 2041877159, 133361907, 1776460110, 3673476453, 96392454, 878845905, 2801699524, 777231668, 4082475170, 2330014213, 4142626212, 2213296395, 1626319424, 1906247262, 1846563261, 562755902, 3708173718, 1040559837, 3871163981, 1418573201, 3294430577, 114585348, 1343618912, 2566595609, 3186202582, 1078185097, 3651041127, 3896688048, 2307622919, 425408743, 3371096953, 2081048481, 1108339068, 2216610296, 0, 2156299017, 736970802, 292596766, 1517440620, 251657213, 2235061775, 2933202493, 758720310, 265905162, 1554391400, 1532285339, 908999204, 174567692, 1474760595, 4002861748, 2610011675, 3234156416, 3693126241, 2001430874, 303699484, 2478443234, 2687165888, 585122620, 454499602, 151849742, 2345119218, 3064510765, 514443284, 4044981591, 1963412655, 2581445614, 2137062819, 19308535, 1928707164, 1715193156, 4219352155, 1126790795, 600235211, 3992742070, 3841024952, 836553431, 1669664834, 2535604243, 3323011204, 1243905413, 3141400786, 4180808110, 698445255, 2653899549, 2989552604, 2253581325, 3252932727, 3004591147, 1891211689, 2487810577, 3915653703, 4237083816, 4030667424, 2100090966, 865136418, 1229899655, 953270745, 3399679628, 3557504664, 4118925222, 2061379749, 3079546586, 2915017791, 983426092, 2022837584, 1607244650, 2118541908, 2366882550, 3635996816, 972512814, 3283088770, 1568718495, 3499326569, 3576539503, 621982671, 2895723464, 410887952, 2623762152, 1002142683, 645401037, 1494807662, 2595684844, 1335535747, 2507040230, 4293295786, 3167684641, 367585007, 3885750714, 1865862730, 2668221674, 2960971305, 2763173681, 1059270954, 2777952454, 2724642869, 1320957812, 2194319100, 2429595872, 2815956275, 77089521, 3973773121, 3444575871, 2448830231, 1305906550, 4021308739, 2857194700, 2516901860, 3518358430, 1787304780, 740276417, 1699839814, 1592394909, 2352307457, 2272556026, 188821243, 1729977011, 3687994002, 274084841, 3594982253, 3613494426, 2701949495, 4162096729, 322734571, 2837966542, 1640576439, 484830689, 1202797690, 3537852828, 4067639125, 349075736, 3342319475, 4157467219, 4255800159, 1030690015, 1155237496, 2951971274, 1757691577, 607398968, 2738905026, 499347990, 3794078908, 1011452712, 227885567, 2818666809, 213114376, 3034881240, 1455525988, 3414450555, 850817237, 1817998408, 3092726480);

        for ($i = 0; $i < 256; $i++) {
            $t2[] = (($t3[$i] << 8) & 4294967040) | (($t3[$i] >> 24) & 255);
            $t1[] = (($t3[$i] << 16) & 4294901760) | (($t3[$i] >> 16) & 65535);
            $t0[] = (($t3[$i] << 24) & 4278190080) | (($t3[$i] >> 8) & 16777215);
            $dt2[] = (($dt3[$i] << 8) & 4294967040) | (($dt3[$i] >> 24) & 255);
            $dt1[] = (($dt3[$i] << 16) & 4294901760) | (($dt3[$i] >> 16) & 65535);
            $dt0[] = (($dt3[$i] << 24) & 4278190080) | (($dt3[$i] >> 8) & 16777215);
        }

        $this->sbox = array(99, 124, 119, 123, 242, 107, 111, 197, 48, 1, 103, 43, 254, 215, 171, 118, 202, 130, 201, 125, 250, 89, 71, 240, 173, 212, 162, 175, 156, 164, 114, 192, 183, 253, 147, 38, 54, 63, 247, 204, 52, 165, 229, 241, 113, 216, 49, 21, 4, 199, 35, 195, 24, 150, 5, 154, 7, 18, 128, 226, 235, 39, 178, 117, 9, 131, 44, 26, 27, 110, 90, 160, 82, 59, 214, 179, 41, 227, 47, 132, 83, 209, 0, 237, 32, 252, 177, 91, 106, 203, 190, 57, 74, 76, 88, 207, 208, 239, 170, 251, 67, 77, 51, 133, 69, 249, 2, 127, 80, 60, 159, 168, 81, 163, 64, 143, 146, 157, 56, 245, 188, 182, 218, 33, 16, 255, 243, 210, 205, 12, 19, 236, 95, 151, 68, 23, 196, 167, 126, 61, 100, 93, 25, 115, 96, 129, 79, 220, 34, 42, 144, 136, 70, 238, 184, 20, 222, 94, 11, 219, 224, 50, 58, 10, 73, 6, 36, 92, 194, 211, 172, 98, 145, 149, 228, 121, 231, 200, 55, 109, 141, 213, 78, 169, 108, 86, 244, 234, 101, 122, 174, 8, 186, 120, 37, 46, 28, 166, 180, 198, 232, 221, 116, 31, 75, 189, 139, 138, 112, 62, 181, 102, 72, 3, 246, 14, 97, 53, 87, 185, 134, 193, 29, 158, 225, 248, 152, 17, 105, 217, 142, 148, 155, 30, 135, 233, 206, 85, 40, 223, 140, 161, 137, 13, 191, 230, 66, 104, 65, 153, 45, 15, 176, 84, 187, 22);
        $this->isbox = array(82, 9, 106, 213, 48, 54, 165, 56, 191, 64, 163, 158, 129, 243, 215, 251, 124, 227, 57, 130, 155, 47, 255, 135, 52, 142, 67, 68, 196, 222, 233, 203, 84, 123, 148, 50, 166, 194, 35, 61, 238, 76, 149, 11, 66, 250, 195, 78, 8, 46, 161, 102, 40, 217, 36, 178, 118, 91, 162, 73, 109, 139, 209, 37, 114, 248, 246, 100, 134, 104, 152, 22, 212, 164, 92, 204, 93, 101, 182, 146, 108, 112, 72, 80, 253, 237, 185, 218, 94, 21, 70, 87, 167, 141, 157, 132, 144, 216, 171, 0, 140, 188, 211, 10, 247, 228, 88, 5, 184, 179, 69, 6, 208, 44, 30, 143, 202, 63, 15, 2, 193, 175, 189, 3, 1, 19, 138, 107, 58, 145, 17, 65, 79, 103, 220, 234, 151, 242, 207, 206, 240, 180, 230, 115, 150, 172, 116, 34, 231, 173, 53, 133, 226, 249, 55, 232, 28, 117, 223, 110, 71, 241, 26, 113, 29, 41, 197, 137, 111, 183, 98, 14, 170, 24, 190, 27, 252, 86, 62, 75, 198, 210, 121, 32, 154, 219, 192, 254, 120, 205, 90, 244, 31, 221, 168, 51, 136, 7, 199, 49, 177, 18, 16, 89, 39, 128, 236, 95, 96, 81, 127, 169, 25, 181, 74, 13, 45, 229, 122, 159, 147, 201, 156, 239, 160, 224, 59, 77, 174, 42, 245, 176, 200, 235, 187, 60, 131, 83, 153, 97, 23, 43, 4, 126, 186, 119, 214, 38, 225, 105, 20, 99, 85, 33, 12, 125);
        if (!function_exists("create_function") || !is_callable("create_function")) {
            $this->use_inline_crypt = false;
        }
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->changed = true;
    }

    public function setIV($iv)
    {
        $this->encryptIV = $this->decryptIV = $this->iv = str_pad(substr($iv, 0, $this->block_size), $this->block_size, chr(0));
    }

    public function setKeyLength($length)
    {
        $length >>= 5;

        if (8 < $length) {
            $length = 8;
        }
        else if ($length < 4) {
            $length = 4;
        }

        $this->Nk = $length;
        $this->key_size = $length << 2;
        $this->explicit_key_length = true;
        $this->changed = true;
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

            while (strlen($key) < $this->key_size) {
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

        $this->setKey(substr($key, 0, $this->key_size));
    }

    public function setBlockLength($length)
    {
        $length >>= 5;

        if (8 < $length) {
            $length = 8;
        }
        else if ($length < 4) {
            $length = 4;
        }

        $this->Nb = $length;
        $this->block_size = $length << 2;
        $this->changed = true;
    }

    public function _generate_xor($length, &$iv)
    {
        $xor = "";
        $block_size = $this->block_size;
        $num_blocks = floor(($length + ($block_size - 1)) / $block_size);

        for ($i = 0; $i < $num_blocks; $i++) {
            $xor .= $iv;

            for ($j = 4; $j <= $block_size; $j += 4) {
                $temp = substr($iv, -$j, 4);

                switch ($temp) {
                case "":
                    $iv = substr_replace($iv, "\000\000\000\000", -$j, 4);
                    break;

                case "":
                    $iv = substr_replace($iv, "€\000\000\000", -$j, 4);
                    break 2;

                default:
                    $_unpacked = unpack("Ncount", $temp);
                    $iv = substr_replace($iv, pack("N", $_unpacked["count"] + 1), -$j, 4);
                    break 2;
                }
            }
        }

        return $xor;
    }

    public function encrypt($plaintext)
    {
        if ($this->changed) {
            $this->_setup();
        }

        if ($this->use_inline_crypt) {
            $inline = $this->inline_crypt;
            return $inline("encrypt", $this, $plaintext);
        }

        if ($this->paddable) {
            $plaintext = $this->_pad($plaintext);
        }

        $block_size = $this->block_size;
        $buffer = &$this->enbuffer;
        $ciphertext = "";

        switch ($this->mode) {
        case CRYPT_RIJNDAEL_MODE_ECB:
            for ($i = 0; $i < strlen($plaintext); $i += $block_size) {
                $ciphertext .= $this->_encryptBlock(substr($plaintext, $i, $block_size));
            }

            break;

        case CRYPT_RIJNDAEL_MODE_CBC:
            $xor = $this->encryptIV;

            for ($i = 0; $i < strlen($plaintext); $i += $block_size) {
                $block = substr($plaintext, $i, $block_size);
                $block = $this->_encryptBlock($block ^ $xor);
                $xor = $block;
                $ciphertext .= $block;
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $xor;
            }

            break;

        case CRYPT_RIJNDAEL_MODE_CTR:
            $xor = $this->encryptIV;

            if (strlen($buffer["encrypted"])) {
                for ($i = 0; $i < strlen($plaintext); $i += $block_size) {
                    $block = substr($plaintext, $i, $block_size);

                    if (strlen($buffer["encrypted"]) < strlen($block)) {
                        $buffer["encrypted"] .= $this->_encryptBlock($this->_generate_xor($block_size, $xor));
                    }

                    $key = $this->_string_shift($buffer["encrypted"], $block_size);
                    $ciphertext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($plaintext); $i += $block_size) {
                    $block = substr($plaintext, $i, $block_size);
                    $key = $this->_encryptBlock($this->_generate_xor($block_size, $xor));
                    $ciphertext .= $block ^ $key;
                }
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $xor;
                $start = strlen($plaintext) % $block_size;

                if ($start) {
                    $buffer["encrypted"] = substr($key, $start) . $buffer["encrypted"];
                }
            }

            break;

        case CRYPT_RIJNDAEL_MODE_CFB:
            if ($this->continuousBuffer) {
                $iv = &$this->encryptIV;
                $pos = &$buffer["pos"];
            }
            else {
                $iv = $this->encryptIV;
                $pos = 0;
            }

            $len = strlen($plaintext);
            $i = 0;

            if ($pos) {
                $orig_pos = $pos;
                $max = $block_size - $pos;

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
            }

            while ($block_size <= $len) {
                $iv = $this->_encryptBlock($iv) ^ substr($plaintext, $i, $block_size);
                $ciphertext .= $iv;
                $len -= $block_size;
                $i += $block_size;
            }

            if ($len) {
                $iv = $this->_encryptBlock($iv);
                $block = $iv ^ substr($plaintext, $i);
                $iv = substr_replace($iv, $block, 0, $len);
                $ciphertext .= $block;
                $pos = $len;
            }

            break;

        case CRYPT_RIJNDAEL_MODE_OFB:
            $xor = $this->encryptIV;

            if (strlen($buffer["xor"])) {
                for ($i = 0; $i < strlen($plaintext); $i += $block_size) {
                    $block = substr($plaintext, $i, $block_size);

                    if (strlen($buffer["xor"]) < strlen($block)) {
                        $xor = $this->_encryptBlock($xor);
                        $buffer["xor"] .= $xor;
                    }

                    $key = $this->_string_shift($buffer["xor"], $block_size);
                    $ciphertext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($plaintext); $i += $block_size) {
                    $xor = $this->_encryptBlock($xor);
                    $ciphertext .= substr($plaintext, $i, $block_size) ^ $xor;
                }

                $key = $xor;
            }

            if ($this->continuousBuffer) {
                $this->encryptIV = $xor;
                $start = strlen($plaintext) % $block_size;

                if ($start) {
                    $buffer["xor"] = substr($key, $start) . $buffer["xor"];
                }
            }
        }

        return $ciphertext;
    }

    public function decrypt($ciphertext)
    {
        if ($this->changed) {
            $this->_setup();
        }

        if ($this->use_inline_crypt) {
            $inline = $this->inline_crypt;
            return $inline("decrypt", $this, $ciphertext);
        }

        if ($this->paddable) {
            $ciphertext = str_pad($ciphertext, strlen($ciphertext) + (($this->block_size - (strlen($ciphertext) % $this->block_size)) % $this->block_size), chr(0));
        }

        $block_size = $this->block_size;
        $buffer = &$this->debuffer;
        $plaintext = "";

        switch ($this->mode) {
        case CRYPT_RIJNDAEL_MODE_ECB:
            for ($i = 0; $i < strlen($ciphertext); $i += $block_size) {
                $plaintext .= $this->_decryptBlock(substr($ciphertext, $i, $block_size));
            }

            break;

        case CRYPT_RIJNDAEL_MODE_CBC:
            $xor = $this->decryptIV;

            for ($i = 0; $i < strlen($ciphertext); $i += $block_size) {
                $block = substr($ciphertext, $i, $block_size);
                $plaintext .= $this->_decryptBlock($block) ^ $xor;
                $xor = $block;
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $xor;
            }

            break;

        case CRYPT_RIJNDAEL_MODE_CTR:
            $xor = $this->decryptIV;

            if (strlen($buffer["ciphertext"])) {
                for ($i = 0; $i < strlen($ciphertext); $i += $block_size) {
                    $block = substr($ciphertext, $i, $block_size);

                    if (strlen($buffer["ciphertext"]) < strlen($block)) {
                        $buffer["ciphertext"] .= $this->_encryptBlock($this->_generate_xor($block_size, $xor));
                    }

                    $key = $this->_string_shift($buffer["ciphertext"], $block_size);
                    $plaintext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($ciphertext); $i += $block_size) {
                    $block = substr($ciphertext, $i, $block_size);
                    $key = $this->_encryptBlock($this->_generate_xor($block_size, $xor));
                    $plaintext .= $block ^ $key;
                }
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $xor;
                $start = strlen($ciphertext) % $block_size;

                if ($start) {
                    $buffer["ciphertext"] = substr($key, $start) . $buffer["ciphertext"];
                }
            }

            break;

        case CRYPT_RIJNDAEL_MODE_CFB:
            if ($this->continuousBuffer) {
                $iv = &$this->decryptIV;
                $pos = &$buffer["pos"];
            }
            else {
                $iv = $this->decryptIV;
                $pos = 0;
            }

            $len = strlen($ciphertext);
            $i = 0;

            if ($pos) {
                $orig_pos = $pos;
                $max = $block_size - $pos;

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

            while ($block_size <= $len) {
                $iv = $this->_encryptBlock($iv);
                $cb = substr($ciphertext, $i, $block_size);
                $plaintext .= $iv ^ $cb;
                $iv = $cb;
                $len -= $block_size;
                $i += $block_size;
            }

            if ($len) {
                $iv = $this->_encryptBlock($iv);
                $plaintext .= $iv ^ substr($ciphertext, $i);
                $iv = substr_replace($iv, substr($ciphertext, $i), 0, $len);
                $pos = $len;
            }

            break;

        case CRYPT_RIJNDAEL_MODE_OFB:
            $xor = $this->decryptIV;

            if (strlen($buffer["xor"])) {
                for ($i = 0; $i < strlen($ciphertext); $i += $block_size) {
                    $block = substr($ciphertext, $i, $block_size);

                    if (strlen($buffer["xor"]) < strlen($block)) {
                        $xor = $this->_encryptBlock($xor);
                        $buffer["xor"] .= $xor;
                    }

                    $key = $this->_string_shift($buffer["xor"], $block_size);
                    $plaintext .= $block ^ $key;
                }
            }
            else {
                for ($i = 0; $i < strlen($ciphertext); $i += $block_size) {
                    $xor = $this->_encryptBlock($xor);
                    $plaintext .= substr($ciphertext, $i, $block_size) ^ $xor;
                }

                $key = $xor;
            }

            if ($this->continuousBuffer) {
                $this->decryptIV = $xor;
                $start = strlen($ciphertext) % $block_size;

                if ($start) {
                    $buffer["xor"] = substr($key, $start) . $buffer["xor"];
                }
            }
        }

        return $this->paddable ? $this->_unpad($plaintext) : $plaintext;
    }

    public function _encryptBlock($in)
    {
        $state = array();
        $words = unpack("N*word", $in);
        $w = $this->w;
        $t0 = $this->t0;
        $t1 = $this->t1;
        $t2 = $this->t2;
        $t3 = $this->t3;
        $Nb = $this->Nb;
        $Nr = $this->Nr;
        $c = $this->c;
        $i = -1;

        foreach ($words as $word ) {
            $state[] = $word ^ $w[0][++$i];
        }

        $temp = array();

        for ($round = 1; $round < $Nr; ++$round) {
            $i = 0;
            $j = $c[1];
            $k = $c[2];
            $l = $c[3];

            while ($i < $Nb) {
                $temp[$i] = $t0[($state[$i] >> 24) & 255] ^ $t1[($state[$j] >> 16) & 255] ^ $t2[($state[$k] >> 8) & 255] ^ $t3[$state[$l] & 255] ^ $w[$round][$i];
                ++$i;
                $j = ($j + 1) % $Nb;
                $k = ($k + 1) % $Nb;
                $l = ($l + 1) % $Nb;
            }

            $state = $temp;
        }

        for ($i = 0; $i < $Nb; ++$i) {
            $state[$i] = $this->_subWord($state[$i]);
        }

        $i = 0;
        $j = $c[1];
        $k = $c[2];
        $l = $c[3];

        while ($i < $Nb) {
            $temp[$i] = ($state[$i] & 4278190080) ^ ($state[$j] & 16711680) ^ ($state[$k] & 65280) ^ ($state[$l] & 255) ^ $w[$Nr][$i];
            ++$i;
            $j = ($j + 1) % $Nb;
            $k = ($k + 1) % $Nb;
            $l = ($l + 1) % $Nb;
        }

        switch ($Nb) {
        case 8:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5], $temp[6], $temp[7]);
        case 7:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5], $temp[6]);
        case 6:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5]);
        case 5:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4]);
        default:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3]);
        }
    }

    public function _decryptBlock($in)
    {
        $state = array();
        $words = unpack("N*word", $in);
        $dw = $this->dw;
        $dt0 = $this->dt0;
        $dt1 = $this->dt1;
        $dt2 = $this->dt2;
        $dt3 = $this->dt3;
        $Nb = $this->Nb;
        $Nr = $this->Nr;
        $c = $this->c;
        $i = -1;

        foreach ($words as $word ) {
            $state[] = $word ^ $dw[$Nr][++$i];
        }

        $temp = array();

        for ($round = $Nr - 1; 0 < $round; --$round) {
            $i = 0;
            $j = $Nb - $c[1];
            $k = $Nb - $c[2];
            $l = $Nb - $c[3];

            while ($i < $Nb) {
                $temp[$i] = $dt0[($state[$i] >> 24) & 255] ^ $dt1[($state[$j] >> 16) & 255] ^ $dt2[($state[$k] >> 8) & 255] ^ $dt3[$state[$l] & 255] ^ $dw[$round][$i];
                ++$i;
                $j = ($j + 1) % $Nb;
                $k = ($k + 1) % $Nb;
                $l = ($l + 1) % $Nb;
            }

            $state = $temp;
        }

        $i = 0;
        $j = $Nb - $c[1];
        $k = $Nb - $c[2];
        $l = $Nb - $c[3];

        while ($i < $Nb) {
            $temp[$i] = $dw[0][$i] ^ $this->_invSubWord(($state[$i] & 4278190080) | ($state[$j] & 16711680) | ($state[$k] & 65280) | ($state[$l] & 255));
            ++$i;
            $j = ($j + 1) % $Nb;
            $k = ($k + 1) % $Nb;
            $l = ($l + 1) % $Nb;
        }

        switch ($Nb) {
        case 8:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5], $temp[6], $temp[7]);
        case 7:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5], $temp[6]);
        case 6:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4], $temp[5]);
        case 5:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3], $temp[4]);
        default:
            return pack("N*", $temp[0], $temp[1], $temp[2], $temp[3]);
        }
    }

    public function _setup()
    {
        static $rcon = array(0, 16777216, 33554432, 67108864, 134217728, 268435456, 536870912, 1073741824, 2147483648, 452984832, 905969664, 1811939328, 3623878656, 2868903936, 1291845632, 2583691264, 788529152, 1577058304, 3154116608, 1660944384, 3321888768, 2533359616, 889192448, 1778384896, 3556769792, 3003121664, 2097152000, 4194304000, 4009754624, 3305111552, 2432696320);

        if (!$this->explicit_key_length) {
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

        $this->key = str_pad(substr($this->key, 0, $this->key_size), $this->key_size, chr(0));
        $this->encryptIV = $this->decryptIV = $this->iv = str_pad(substr($this->iv, 0, $this->block_size), $this->block_size, chr(0));
        $this->Nr = max($this->Nk, $this->Nb) + 6;

        switch ($this->Nb) {
        case 4:
        case 5:
        case 6:
            $this->c = array(0, 1, 2, 3);
            break;

        case 7:
            $this->c = array(0, 1, 2, 4);
            break;

        case 8:
            $this->c = array(0, 1, 3, 4);
        }

        $key = $this->key;
        $w = array_values(unpack("N*words", $key));
        $length = $this->Nb * ($this->Nr + 1);

        for ($i = $this->Nk; $i < $length; $i++) {
            $temp = $w[$i - 1];

            if (($i % $this->Nk) == 0) {
                $temp = (($temp << 8) & 4294967040) | (($temp >> 24) & 255);
                $temp = $this->_subWord($temp) ^ $rcon[$i / $this->Nk];
            }
            else {
                if ((6 < $this->Nk) && (($i % $this->Nk) == 4)) {
                    $temp = $this->_subWord($temp);
                }
            }

            $w[$i] = $w[$i - $this->Nk] ^ $temp;
        }

        $temp = $this->w = $this->dw = array();

        for ($i = $row = $col = 0; $i < $length; $i++, $col++) {
            if ($col == $this->Nb) {
                if ($row == 0) {
                    $this->dw[0] = $this->w[0];
                }
                else {
                    $j = 0;

                    while ($j < $this->Nb) {
                        $dw = $this->_subWord($this->w[$row][$j]);
                        $temp[$j] = $this->dt0[($dw >> 24) & 255] ^ $this->dt1[($dw >> 16) & 255] ^ $this->dt2[($dw >> 8) & 255] ^ $this->dt3[$dw & 255];
                        $j++;
                    }

                    $this->dw[$row] = $temp;
                }

                $col = 0;
                $row++;
            }

            $this->w[$row][$col] = $w[$i];
        }

        $this->dw[$row] = $this->w[$row];

        if ($this->use_inline_crypt) {
            $this->dw = array_reverse($this->dw);
            $w = array_pop($this->w);
            $dw = array_pop($this->dw);

            foreach ($this->w as $r => $wr ) {
                foreach ($wr as $c => $wc ) {
                    $w[] = $wc;
                    $dw[] = $this->dw[$r][$c];
                }
            }

            $this->w = $w;
            $this->dw = $dw;
            $this->inline_crypt_setup();
        }

        $this->changed = false;
    }

    public function _subWord($word)
    {
        $sbox = $this->sbox;
        return $sbox[$word & 255] | ($sbox[($word >> 8) & 255] << 8) | ($sbox[($word >> 16) & 255] << 16) | ($sbox[($word >> 24) & 255] << 24);
    }

    public function _invSubWord($word)
    {
        $isbox = $this->isbox;
        return $isbox[$word & 255] | ($isbox[($word >> 8) & 255] << 8) | ($isbox[($word >> 16) & 255] << 16) | ($isbox[($word >> 24) & 255] << 24);
    }

    public function enablePadding()
    {
        $this->padding = true;
    }

    public function disablePadding()
    {
        $this->padding = false;
    }

    public function _pad($text)
    {
        $length = strlen($text);

        if (!$this->padding) {
            if (($length % $this->block_size) == 0) {
                return $text;
            }
            else {
                user_error("The plaintext's length ($length) is not a multiple of the block size ($this->block_size)");
                $this->padding = true;
            }
        }

        $pad = $this->block_size - ($length % $this->block_size);
        return str_pad($text, $length + $pad, chr($pad));
    }

    public function _unpad($text)
    {
        if (!$this->padding) {
            return $text;
        }

        $length = ord($text[strlen($text) - 1]);
        if (!$length || ($this->block_size < $length)) {
            return false;
        }

        return substr($text, 0, -$length);
    }

    public function enableContinuousBuffer()
    {
        $this->continuousBuffer = true;
    }

    public function disableContinuousBuffer()
    {
        $this->continuousBuffer = false;
        $this->encryptIV = $this->iv;
        $this->decryptIV = $this->iv;
        $this->enbuffer = array("encrypted" => "", "xor" => "", "pos" => 0);
        $this->debuffer = array("ciphertext" => "", "xor" => "", "pos" => 0);
    }

    public function _string_shift(&$string, $index)
    {
        $substr = substr($string, 0, $index);
        $string = substr($string, $index);
        return $substr;
    }

    public function inline_crypt_setup()
    {
        $lambda_functions = &Crypt_Rijndael::get_lambda_functions();
        $block_size = $this->block_size;
        $mode = $this->mode;

        if (count($lambda_functions) < 5) {
            $w = $this->w;
            $dw = $this->dw;
            $init_encryptBlock = "";
            $init_decryptBlock = "";
        }
        else {
            $i = 0;

            for ($cw = count($this->w); $i < $cw; ++$i) {
                $w[] = "\$w_" . $i;
                $dw[] = "\$dw_" . $i;
            }

            $init_encryptBlock = "extract(\$self->w,  EXTR_PREFIX_ALL, \"w\");";
            $init_decryptBlock = "extract(\$self->dw, EXTR_PREFIX_ALL, \"dw\");";
        }

        $code_hash = md5("$mode, $block_size, " . implode(",", $w));

        if (!$lambda_functions[$code_hash]) {
            $Nr = $this->Nr;
            $Nb = $this->Nb;
            $c = $this->c;
            $init_encryptBlock .= "\n                \$t0 = \$self->t0;\n                \$t1 = \$self->t1;\n                \$t2 = \$self->t2;\n                \$t3 = \$self->t3;\n                \$sbox = \$self->sbox;";
            $s = "e";
            $e = "s";
            $wc = $Nb - 1;
            $_encryptBlock = "\$in = unpack(\"N*\", \$in);\n";

            for ($i = 0; $i < $Nb; ++$i) {
                $_encryptBlock .= "\$s" . $i . " = \$in[" . ($i + 1) . "] ^ " . $w[++$wc] . ";\n";
            }

            for ($round = 1; $round < $Nr; ++$round) {
                list($s, $e) = array($e, $s);

                for ($i = 0; $i < $Nb; ++$i) {
                    $_encryptBlock .= "\$" . $e . $i . " =\n                        \$t0[(\$" . $s . $i . " >> 24) & 0xff] ^\n                        \$t1[(\$" . $s . (($i + $c[1]) % $Nb) . " >> 16) & 0xff] ^\n                        \$t2[(\$" . $s . (($i + $c[2]) % $Nb) . " >>  8) & 0xff] ^\n                        \$t3[ \$" . $s . (($i + $c[3]) % $Nb) . "        & 0xff] ^\n                        " . $w[++$wc] . ";\n";
                }
            }

            for ($i = 0; $i < $Nb; ++$i) {
                $_encryptBlock .= "\$" . $e . $i . " =\n                     \$sbox[ \$" . $e . $i . "        & 0xff]        |\n                    (\$sbox[(\$" . $e . $i . " >>  8) & 0xff] <<  8) |\n                    (\$sbox[(\$" . $e . $i . " >> 16) & 0xff] << 16) |\n                    (\$sbox[(\$" . $e . $i . " >> 24) & 0xff] << 24);\n";
            }

            $_encryptBlock .= "\$in = pack(\"N*\"\n";

            for ($i = 0; $i < $Nb; ++$i) {
                $_encryptBlock .= ",\n                    (\$" . $e . $i . " & 0xFF000000) ^\n                    (\$" . $e . (($i + $c[1]) % $Nb) . " & 0x00FF0000) ^\n                    (\$" . $e . (($i + $c[2]) % $Nb) . " & 0x0000FF00) ^\n                    (\$" . $e . (($i + $c[3]) % $Nb) . " & 0x000000FF) ^\n                    " . $w[$i] . "\n";
            }

            $_encryptBlock .= ");";
            $init_decryptBlock .= "\n                \$dt0 = \$self->dt0;\n                \$dt1 = \$self->dt1;\n                \$dt2 = \$self->dt2;\n                \$dt3 = \$self->dt3;\n                \$isbox = \$self->isbox;";
            $s = "e";
            $e = "s";
            $wc = $Nb - 1;
            $_decryptBlock = "\$in = unpack(\"N*\", \$in);\n";

            for ($i = 0; $i < $Nb; ++$i) {
                $_decryptBlock .= "\$s" . $i . " = \$in[" . ($i + 1) . "] ^ " . $dw[++$wc] . ";\n";
            }

            for ($round = 1; $round < $Nr; ++$round) {
                list($s, $e) = array($e, $s);

                for ($i = 0; $i < $Nb; ++$i) {
                    $_decryptBlock .= "\$" . $e . $i . " =\n                        \$dt0[(\$" . $s . $i . " >> 24) & 0xff] ^\n                        \$dt1[(\$" . $s . ((($Nb + $i) - $c[1]) % $Nb) . " >> 16) & 0xff] ^\n                        \$dt2[(\$" . $s . ((($Nb + $i) - $c[2]) % $Nb) . " >>  8) & 0xff] ^\n                        \$dt3[ \$" . $s . ((($Nb + $i) - $c[3]) % $Nb) . "        & 0xff] ^\n                        " . $dw[++$wc] . ";\n";
                }
            }

            for ($i = 0; $i < $Nb; ++$i) {
                $_decryptBlock .= "\$" . $e . $i . " =\n                     \$isbox[ \$" . $e . $i . "        & 0xff]        |\n                    (\$isbox[(\$" . $e . $i . " >>  8) & 0xff] <<  8) |\n                    (\$isbox[(\$" . $e . $i . " >> 16) & 0xff] << 16) |\n                    (\$isbox[(\$" . $e . $i . " >> 24) & 0xff] << 24);\n";
            }

            $_decryptBlock .= "\$in = pack(\"N*\"\n";

            for ($i = 0; $i < $Nb; ++$i) {
                $_decryptBlock .= ",\n                    (\$" . $e . $i . " & 0xFF000000) ^\n                    (\$" . $e . ((($Nb + $i) - $c[1]) % $Nb) . " & 0x00FF0000) ^\n                    (\$" . $e . ((($Nb + $i) - $c[2]) % $Nb) . " & 0x0000FF00) ^\n                    (\$" . $e . ((($Nb + $i) - $c[3]) % $Nb) . " & 0x000000FF) ^\n                    " . $dw[$i] . "\n";
            }

            $_decryptBlock .= ");";

            switch ($mode) {
            case CRYPT_RIJNDAEL_MODE_ECB:
                $encrypt = $init_encryptBlock . "\n                        \$ciphertext = \"\";\n                        \$text = \$self->_pad(\$text);\n                        \$plaintext_len = strlen(\$text);\n\n                        for (\$i = 0; \$i < \$plaintext_len; \$i+= " . $block_size . ") {\n                            \$in = substr(\$text, \$i, " . $block_size . ");\n                            " . $_encryptBlock . "\n                            \$ciphertext.= \$in;\n                        }\n                       \n                        return \$ciphertext;\n                        ";
                $decrypt = $init_decryptBlock . "\n                        \$plaintext = \"\";\n                        \$text = str_pad(\$text, strlen(\$text) + (" . $block_size . " - strlen(\$text) % " . $block_size . ") % " . $block_size . ", chr(0));\n                        \$ciphertext_len = strlen(\$text);\n\n                        for (\$i = 0; \$i < \$ciphertext_len; \$i+= " . $block_size . ") {\n                            \$in = substr(\$text, \$i, " . $block_size . ");\n                            " . $_decryptBlock . "\n                            \$plaintext.= \$in;\n                        }\n\n                        return \$self->_unpad(\$plaintext);\n                        ";
                break;

            case CRYPT_RIJNDAEL_MODE_CBC:
                $encrypt = $init_encryptBlock . "\n                        \$ciphertext = \"\";\n                        \$text = \$self->_pad(\$text);\n                        \$plaintext_len = strlen(\$text);\n\n                        \$in = \$self->encryptIV;\n\n                        for (\$i = 0; \$i < \$plaintext_len; \$i+= " . $block_size . ") {\n                            \$in = substr(\$text, \$i, " . $block_size . ") ^ \$in;\n                            " . $_encryptBlock . "\n                            \$ciphertext.= \$in;\n                        }\n\n                        if (\$self->continuousBuffer) {\n                            \$self->encryptIV = \$in;\n                        }\n\n                        return \$ciphertext;\n                        ";
                $decrypt = $init_decryptBlock . "\n                        \$plaintext = \"\";\n                        \$text = str_pad(\$text, strlen(\$text) + (" . $block_size . " - strlen(\$text) % " . $block_size . ") % " . $block_size . ", chr(0));\n                        \$ciphertext_len = strlen(\$text);\n\n                        \$iv = \$self->decryptIV;\n\n                        for (\$i = 0; \$i < \$ciphertext_len; \$i+= " . $block_size . ") {\n                            \$in = \$block = substr(\$text, \$i, " . $block_size . ");\n                            " . $_decryptBlock . "\n                            \$plaintext.= \$in ^ \$iv;\n                            \$iv = \$block;\n                        }\n\n                        if (\$self->continuousBuffer) {\n                            \$self->decryptIV = \$iv;\n                        }\n\n                        return \$self->_unpad(\$plaintext);\n                        ";
                break;

            case CRYPT_RIJNDAEL_MODE_CTR:
                $encrypt = $init_encryptBlock . "\n                        \$ciphertext = \"\";\n                        \$plaintext_len = strlen(\$text);\n                        \$xor = \$self->encryptIV;\n                        \$buffer = &\$self->enbuffer;\n\n                        if (strlen(\$buffer[\"encrypted\"])) {\n                            for (\$i = 0; \$i < \$plaintext_len; \$i+= " . $block_size . ") {\n                                \$block = substr(\$text, \$i, " . $block_size . ");\n                                if (strlen(\$block) > strlen(\$buffer[\"encrypted\"])) {\n                                    \$in = \$self->_generate_xor(" . $block_size . ", \$xor);\n                                    " . $_encryptBlock . "\n                                    \$buffer[\"encrypted\"].= \$in;\n                                }\n                                \$key = \$self->_string_shift(\$buffer[\"encrypted\"], " . $block_size . ");\n                                \$ciphertext.= \$block ^ \$key;\n                            }\n                        } else {\n                            for (\$i = 0; \$i < \$plaintext_len; \$i+= " . $block_size . ") {\n                                \$block = substr(\$text, \$i, " . $block_size . ");\n                                \$in = \$self->_generate_xor(" . $block_size . ", \$xor);\n                                " . $_encryptBlock . "\n                                \$key = \$in;\n                                \$ciphertext.= \$block ^ \$key;\n                            }\n                        }\n                        if (\$self->continuousBuffer) {\n                            \$self->encryptIV = \$xor;\n                            if (\$start = \$plaintext_len % " . $block_size . ") {\n                                \$buffer[\"encrypted\"] = substr(\$key, \$start) . \$buffer[\"encrypted\"];\n                            }\n                        }\n\n                        return \$ciphertext;\n                    ";
                $decrypt = $init_encryptBlock . "\n                        \$plaintext = \"\";\n                        \$ciphertext_len = strlen(\$text);\n                        \$xor = \$self->decryptIV;\n                        \$buffer = &\$self->debuffer;\n\n                        if (strlen(\$buffer[\"ciphertext\"])) {\n                            for (\$i = 0; \$i < \$ciphertext_len; \$i+= " . $block_size . ") {\n                                \$block = substr(\$text, \$i, " . $block_size . ");\n                                if (strlen(\$block) > strlen(\$buffer[\"ciphertext\"])) {\n                                    \$in = \$self->_generate_xor(" . $block_size . ", \$xor);\n                                    " . $_encryptBlock . "\n                                    \$buffer[\"ciphertext\"].= \$in;\n                                }\n                                \$key = \$self->_string_shift(\$buffer[\"ciphertext\"], " . $block_size . ");\n                                \$plaintext.= \$block ^ \$key;\n                            }\n                        } else {\n                            for (\$i = 0; \$i < \$ciphertext_len; \$i+= " . $block_size . ") {\n                                \$block = substr(\$text, \$i, " . $block_size . ");\n                                \$in = \$self->_generate_xor(" . $block_size . ", \$xor);\n                                " . $_encryptBlock . "\n                                \$key = \$in;\n                                \$plaintext.= \$block ^ \$key;\n                            }\n                        }\n                        if (\$self->continuousBuffer) {\n                            \$self->decryptIV = \$xor;\n                            if (\$start = \$ciphertext_len % " . $block_size . ") {\n                                \$buffer[\"ciphertext\"] = substr(\$key, \$start) . \$buffer[\"ciphertext\"];\n                            }\n                        }\n                       \n                        return \$plaintext;\n                        ";
                break;

            case CRYPT_RIJNDAEL_MODE_CFB:
                $encrypt = $init_encryptBlock . "\n                        \$ciphertext = \"\";\n                        \$buffer = &\$self->enbuffer;\n\n                        if (\$self->continuousBuffer) {\n                            \$iv = &\$self->encryptIV;\n                            \$pos = &\$buffer[\"pos\"];\n                        } else {\n                            \$iv = \$self->encryptIV;\n                            \$pos = 0;\n                        }\n                        \$len = strlen(\$text);\n                        \$i = 0;\n                        if (\$pos) {\n                            \$orig_pos = \$pos;\n                            \$max = " . $block_size . " - \$pos;\n                            if (\$len >= \$max) {\n                                \$i = \$max;\n                                \$len-= \$max;\n                                \$pos = 0;\n                            } else {\n                                \$i = \$len;\n                                \$pos+= \$len;\n                                \$len = 0;\n                            }\n                            \$ciphertext = substr(\$iv, \$orig_pos) ^ \$text;\n                            \$iv = substr_replace(\$iv, \$ciphertext, \$orig_pos, \$i);\n                        }\n                        while (\$len >= " . $block_size . ") {\n                            \$in = \$iv;\n                            " . $_encryptBlock . ";\n                            \$iv = \$in ^ substr(\$text, \$i, " . $block_size . ");\n                            \$ciphertext.= \$iv;\n                            \$len-= " . $block_size . ";\n                            \$i+= " . $block_size . ";\n                        }\n                        if (\$len) {\n                            \$in = \$iv;\n                            " . $_encryptBlock . "\n                            \$iv = \$in;\n                            \$block = \$iv ^ substr(\$text, \$i);\n                            \$iv = substr_replace(\$iv, \$block, 0, \$len);\n                            \$ciphertext.= \$block;\n                            \$pos = \$len;\n                        }\n                        return \$ciphertext;\n                    ";
                $decrypt = $init_encryptBlock . "\n                        \$plaintext = \"\";\n                        \$buffer = &\$self->debuffer;\n\n                        if (\$self->continuousBuffer) {\n                            \$iv = &\$self->decryptIV;\n                            \$pos = &\$buffer[\"pos\"];\n                        } else {\n                            \$iv = \$self->decryptIV;\n                            \$pos = 0;\n                        }\n                        \$len = strlen(\$text);\n                        \$i = 0;\n                        if (\$pos) {\n                            \$orig_pos = \$pos;\n                            \$max = " . $block_size . " - \$pos;\n                            if (\$len >= \$max) {\n                                \$i = \$max;\n                                \$len-= \$max;\n                                \$pos = 0;\n                            } else {\n                                \$i = \$len;\n                                \$pos+= \$len;\n                                \$len = 0;\n                            }\n                            \$plaintext = substr(\$iv, \$orig_pos) ^ \$text;\n                            \$iv = substr_replace(\$iv, substr(\$text, 0, \$i), \$orig_pos, \$i);\n                        }\n                        while (\$len >= " . $block_size . ") {\n                            \$in = \$iv;\n                            " . $_encryptBlock . "\n                            \$iv = \$in;\n                            \$cb = substr(\$text, \$i, " . $block_size . ");\n                            \$plaintext.= \$iv ^ \$cb;\n                            \$iv = \$cb;\n                            \$len-= " . $block_size . ";\n                            \$i+= " . $block_size . ";\n                        }\n                        if (\$len) {\n                            \$in = \$iv;\n                            " . $_encryptBlock . "\n                            \$iv = \$in;\n                            \$plaintext.= \$iv ^ substr(\$text, \$i);\n                            \$iv = substr_replace(\$iv, substr(\$text, \$i), 0, \$len);\n                            \$pos = \$len;\n                        }\n\n                        return \$plaintext;\n                        ";
                break;

            case CRYPT_RIJNDAEL_MODE_OFB:
                $encrypt = $init_encryptBlock . "\n                        \$ciphertext = \"\";\n                        \$plaintext_len = strlen(\$text);\n                        \$xor = \$self->encryptIV;\n                        \$buffer = &\$self->enbuffer;\n\n                        if (strlen(\$buffer[\"xor\"])) {\n                            for (\$i = 0; \$i < \$plaintext_len; \$i+= " . $block_size . ") {\n                                \$block = substr(\$text, \$i, " . $block_size . ");\n                                if (strlen(\$block) > strlen(\$buffer[\"xor\"])) {\n                                    \$in = \$xor;\n                                    " . $_encryptBlock . "\n                                    \$xor = \$in;\n                                    \$buffer[\"xor\"].= \$xor;\n                                }\n                                \$key = \$self->_string_shift(\$buffer[\"xor\"], " . $block_size . ");\n                                \$ciphertext.= \$block ^ \$key;\n                            }\n                        } else {\n                            for (\$i = 0; \$i < \$plaintext_len; \$i+= " . $block_size . ") {\n                                \$in = \$xor;\n                                " . $_encryptBlock . "\n                                \$xor = \$in;\n                                \$ciphertext.= substr(\$text, \$i, " . $block_size . ") ^ \$xor;\n                            }\n                            \$key = \$xor;\n                        }\n                        if (\$self->continuousBuffer) {\n                            \$self->encryptIV = \$xor;\n                            if (\$start = \$plaintext_len % " . $block_size . ") {\n                                 \$buffer[\"xor\"] = substr(\$key, \$start) . \$buffer[\"xor\"];\n                            }\n                        }\n                        return \$ciphertext;\n                        ";
                $decrypt = $init_encryptBlock . "\n                        \$plaintext = \"\";\n                        \$ciphertext_len = strlen(\$text);\n                        \$xor = \$self->decryptIV;\n                        \$buffer = &\$self->debuffer;\n\n                        if (strlen(\$buffer[\"xor\"])) {\n                            for (\$i = 0; \$i < \$ciphertext_len; \$i+= " . $block_size . ") {\n                                \$block = substr(\$text, \$i, " . $block_size . ");\n                                if (strlen(\$block) > strlen(\$buffer[\"xor\"])) {\n                                    \$in = \$xor;\n                                    " . $_encryptBlock . "\n                                    \$xor = \$in;\n                                    \$buffer[\"xor\"].= \$xor;\n                                }\n                                \$key = \$self->_string_shift(\$buffer[\"xor\"], " . $block_size . ");\n                                \$plaintext.= \$block ^ \$key;\n                            }\n                        } else {\n                            for (\$i = 0; \$i < \$ciphertext_len; \$i+= " . $block_size . ") {\n                                \$in = \$xor;\n                                " . $_encryptBlock . "\n                                \$xor = \$in;\n                                \$plaintext.= substr(\$text, \$i, " . $block_size . ") ^ \$xor;\n                            }\n                            \$key = \$xor;\n                        }\n                        if (\$self->continuousBuffer) {\n                            \$self->decryptIV = \$xor;\n                            if (\$start = \$ciphertext_len % " . $block_size . ") {\n                                 \$buffer[\"xor\"] = substr(\$key, \$start) . \$buffer[\"xor\"];\n                            }\n                        }\n                        return \$plaintext;\n                        ";
                break;
            }

            $lambda_functions[$code_hash] = create_function("\$action, &\$self, \$text", "if (\$action == \"encrypt\") { " . $encrypt . " } else { " . $decrypt . " }");
        }

        $this->inline_crypt = $lambda_functions[$code_hash];
    }

    public function get_lambda_functions()
    {
        static $functions = array();
        return $functions;
    }
}

define("CRYPT_RIJNDAEL_MODE_CTR", -1);
define("CRYPT_RIJNDAEL_MODE_ECB", 1);
define("CRYPT_RIJNDAEL_MODE_CBC", 2);
define("CRYPT_RIJNDAEL_MODE_CFB", 3);
define("CRYPT_RIJNDAEL_MODE_OFB", 4);
define("CRYPT_RIJNDAEL_MODE_INTERNAL", 1);
define("CRYPT_RIJNDAEL_MODE_MCRYPT", 2);

?>
