<?php
/*
 * 截取中文字符串
 */
function msubstr($str, $start = 0, $length, $suffix = true, $charset = "utf-8")
{
    if (function_exists("mb_substr")) {
        if ($suffix && strlen($str) > $length) {
            return mb_substr($str, $start, $length, $charset) . "...";
        } else {
            return mb_substr($str, $start, $length, $charset);
        }

    } elseif (function_exists('iconv_substr')) {
        if ($suffix && strlen($str) > $length) {
            return iconv_substr($str, $start, $length, $charset) . "...";
        } else {
            return iconv_substr($str, $start, $length, $charset);
        }

    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix) {
        return $slice . "…";
    }

    return $slice;
}

function arr_htmlspecialchars(&$value)
{
    $value = htmlspecialchars($value);
}

function fulltext_filter($value)
{
    return htmlspecialchars_decode($value);
}

/**
 * 加密和解密函数
 *
 * <code>
 * // 加密用户ID和用户名
 * $auth = authcode("{$uid}\t{$username}", 'ENCODE');
 * // 解密用户ID和用户名
 * list($uid, $username) = explode("\t", authcode($auth, 'DECODE'));
 * </code>
 *
 * @access public
 * @param  string  $string    需要加密或解密的字符串
 * @param  string  $operation 默认是DECODE即解密 ENCODE是加密
 * @param  string  $key       加密或解密的密钥 参数为空的情况下取全局配置encryption_key
 * @param  integer $expiry    加密的有效期(秒)0是永久有效 注意这个参数不需要传时间戳
 * @return string
 */
function Encryptioncode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    $ckey_length = 4;
    $key = md5($key != '' ? $key : 'lhs_simple_encryption_code_45120');
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

/*****
 **生成简单的随机数
 **$length 需要的长度
 **$onlynum 生成纯数字的
 **$nouppLetter  不需要大写的，数字和小写的混合
 **/
function createRandomStr($length = 6, $onlynum = false, $nouppLetter = false)
{
    if (!($length > 0)) {
        return false;
    }

    $returnstr = '';
    if ($onlynum) {
        for ($i = 0; $i < $length; $i++) {
            $returnstr .= rand(0, 9);
        }
    } else if ($nouppLetter) {
        $strarr = array_merge(range(0, 9), range('a', 'z'));
        shuffle($strarr);
        shuffle($strarr);
        $returnstr = implode('', array_slice($strarr, 0, $length));
    } else {
        $strarr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($strarr);
        shuffle($strarr);
        $returnstr = implode('', array_slice($strarr, 0, $length));
    }
    return $returnstr;
}

/**
 * 生成guid
 * @method create_guid
 * @return string      生成的guid
 */
function create_guid()
{
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $uuid = substr($charid, 0, 8)
    . substr($charid, 8, 4)
    . substr($charid, 12, 4)
    . substr($charid, 16, 4)
    . substr($charid, 20, 12);
    return $uuid;
}
