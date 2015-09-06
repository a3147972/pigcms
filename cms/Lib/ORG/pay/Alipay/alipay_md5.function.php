<?php

function md5Sign($prestr, $key)
{
    $prestr = $prestr . $key;
    return md5($prestr);
}

function md5Verify($prestr, $sign, $key)
{
    $prestr = $prestr . $key;
    $mysgin = md5($prestr);

    if ($mysgin == $sign) {
        return true;
    }
    else {
        return false;
    }
}


?>
