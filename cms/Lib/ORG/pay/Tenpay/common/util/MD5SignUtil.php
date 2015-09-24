<?php

class MD5SignUtil
{
    public function sign($content, $key)
    {
        try {
            if (NULL == $key) {
                throw new SDKRuntimeException("签名key为空！<br>");
            }

            if (NULL == $content) {
                throw new SDKRuntimeException("加密串为空！<br>");
            }

            $signStr = $content . "&key=" . $key;
            return md5($signStr);
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
        }
    }

    public function verifySignature($content, $sign, $md5Key)
    {
        $signStr = $content . "&key=" . $md5Key;
        $calculateSign = strtolower(md5($signStr));
        $tenpaySign = strtolower($sign);
        return $calculateSign == $tenpaySign;
    }
}


?>
