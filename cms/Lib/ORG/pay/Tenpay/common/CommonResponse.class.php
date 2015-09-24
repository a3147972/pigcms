<?php

class CommonResponse
{
    public $RETCODE = "retcode";
    public $RETMSG = "retmsg";
    public $TRADE_STATE = "trade_state";
    public $TRADE_STATE_SUCCESS = "0";
    /** 密钥 */
    public $secretKey;
    public $parameters = array();
    public $hasRetcode = true;
    public $hasSign = true;

    public function __call($method, $arguments)
    {
        if ($method == "CommonResponse") {
            if (count($arguments) == 2) {
                $this->CommonResponse2($arguments[0], $arguments[1]);
            }

            if (count($arguments) == 3) {
                $this->CommonResponse3($arguments[0], $arguments[1], $arguments[2]);
            }

            if (count($arguments) == 4) {
                $this->CommonResponse4($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
            }

            if (count($arguments) == 5) {
                $this->CommonResponse5($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4]);
            }
        }
    }

    public function CommonResponse2($paraMap, $secretKey)
    {
        $this->CommonResponse($paraMap, $secretKey, true);
    }

    public function CommonResponse3($paraMap, $secretKey, $hasRetcode)
    {
        $this->CommonResponse($paraMap, $secretKey, $hasRetcode, true);
    }

    public function CommonResponse4($paraMap, $secretKey, $hasRetcode, $hasSign)
    {
        $this->hasRetcode = $hasRetcode;
        $this->hasSign = $hasSign;
        $this->secretKey = $secretKey;
        unset(->parameters);
        $this->parameters = $paraMap;

        if ($this->checkSign()) {
            $this->verifySign();
        }
    }

    public function CommonResponse5($xml, $charset, $secretKey, $hasRetcode, $hasSign)
    {
        $xmlUtil = new XmlParseUtil();
        $this->CommonResponse4($xmlUtil->openapiXmlToMap($xml, $charset), $secretKey, $hasRetcode, $hasSign);
    }

    protected function verifySign()
    {
        try {
            if (NULL == $this->parameters) {
                throw new SDKRuntimeException("parameters为空!<br>");
            }

            $sign = $this->getParameter("sign");

            if (NULL == $sign) {
                throw new SDKRuntimeException("sign为空!<br>");
            }

            $charSet = $this->getParameter("input_charset");

            if (NULL == $charSet) {
                $charSet = Constants::DEFAULT_CHARSET;
            }

            $signStr = CommonUtil::formatQueryParaMap($this->parameters, false);

            if (NULL == $this->secretKey) {
                throw new SDKRuntimeException("签名key为空!<br>");
            }

            if (false == (MD5SignUtil::verifySignature($signStr, $sign, $this->secretKey))) {
                throw new SDKRuntimeException("返回值签名验证失败!<br>");
            }

            return true;
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
        }
    }

    public function getSecretKey()
    {
        return $this->key;
    }

    public function setSecretKey($secretKey)
    {
        $this->key = $secretKey;
    }

    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    public function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$parameter] = $parameterValue;
    }

    public function checkSign()
    {
        return $this->isRetCodeOK() && $this->hasSign;
    }

    public function isRetCodeOK()
    {
        $code = (bool) $this->hasRetcode;
        return ("0" == $this->getRetCode()) || !$code;
    }

    public function isPayed()
    {
        return $this->isRetCodeOK() && ($this->TRADE_STATE_SUCCESS == $this->getParameter($this->TRADE_STATE));
    }

    public function getRetCode()
    {
        return $this->getParameter($this->RETCODE);
    }

    public function getPayInfo()
    {
        $info = $this->getParameter($this->RETMSG);
        if ((NULL == CommonUtil::trimString($info)) && !$this->isPayed()) {
            $info = "订单尚未支付成功";
        }

        return $info;
    }
}

include_once "SDKRuntimeException.class.php";
include_once "util/CommonUtil.php";
include_once "util/MD5SignUtil.php";
include_once "util/XmlParseUtil.php";

?>
