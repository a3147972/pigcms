<?php

class CommonRequest
{
    public $SIGN_TYPE = "sign_type";
    public $SERVICE_VERSION = "service_version";
    public $INPUT_CHARSET = "input_charset";
    public $APPID = "appid";
    public $SIGN_KEY_INDEX = "sign_key_index";
    public $SIGN = "sign";
    public $SANDBOX_ADDRESS = "https://sandbox.tenpay.com/api";
    public $API_ADDRESS = "https://api.tenpay.com";
    public $PAY_OPPOSITE_ADDRESS = "/gateway/pay.htm";
    public $NORMALQUERY_OPPOSITE_ADDRESS = "/gateway/normalorderquery.xml";
    public $VERIFY_NOTIFY_OPPOSITE_ADDRESS = "/gateway/verifynotifyid.xml";
    public $DELIVERADDRESS_QUERY_OPPOSITE_ADDRESS = "/gateway/querydeliveryaddress.xml";
    public $WAP_PAY_OPPOSITE_ADDRESS = "/gateway/wappayinit.xml";
    public $SMS_SEND_ADDRESS = "/sms/sender.xml";
    public $secretKey;
    public $inSandBox = false;
    public $connectTimeout = 3000;
    public $timeout = 10000;
    public $parameters = array();

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function genParaStr()
    {
        try {
            if (NULL == $this->getAppid()) {
                throw new SDKRuntimeException("appid不能为空！<br>");
            }

            if (NULL == $this->getSecretKey()) {
                throw new SDKRuntimeException("密钥不能为空！<br>");
            }

            $commonUtil = new CommonUtil();
            ksort($this->parameters);
            $unSignParaString = $commonUtil->formatQueryParaMap($this->parameters, false);
            $paraString = $commonUtil->formatQueryParaMap($this->parameters, true);
            $md5SignUtil = new MD5SignUtil();
            return $paraString . "&sign=" . $md5SignUtil->sign($unSignParaString, $commonUtil->trimString($this->getSecretKey()));
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
        }
    }

    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    public function setParameter($parameter, $parameterValue)
    {
        $commonUtil = new CommonUtil();
        $this->parameters[$commonUtil->trimString($parameter)] = $commonUtil->trimString($parameterValue);
    }

    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    public function setConnectTimeout($connectTimeout)
    {
        $this->connectTimeout = $connectTimeout;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function getSignType()
    {
        return $this->getParameter($this->SIGN_TYPE);
    }

    public function setSignType($signType)
    {
        $this->setParameter($this->SIGN_TYPE, $signType);
    }

    public function getServiceVersion()
    {
        return $this->getParameter($this->SERVICE_VERSION);
    }

    public function setServiceVersion($serviceVersion)
    {
        $this->setParameter($this->SERVICE_VERSION, $serviceVersion);
    }

    public function getInputCharset()
    {
        $charSet = NULL;

        if (array_key_exists($this->INPUT_CHARSET, $this->parameters)) {
            $charSet = $this->getParameter($this->INPUT_CHARSET);
        }

        if (NULL == $charSet) {
            $constants = new Constants();
            $charSet = $constants->DEFAULT_CHARSET;
        }

        return $charSet;
    }

    public function setInputCharset($inputCharset)
    {
        $this->setParameter($this->INPUT_CHARSET, $inputCharset);
    }

    public function getSign()
    {
        return $this->getParameter($this->SIGN);
    }

    public function setSign($sign)
    {
        $this->setParameter($this->SIGN, $sign);
    }

    public function getAppid()
    {
        return $this->getParameter($this->APPID);
    }

    public function setAppid($appid)
    {
        $this->setParameter($this->APPID, $appid);
    }

    public function getSignKeyIndex()
    {
        return $this->getParameter($this->SIGN_KEY_INDEX);
    }

    public function setSignKeyIndex($signKeyIndex)
    {
        $this->setParameter($this->SIGN_KEY_INDEX, $signKeyIndex);
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function isInSandBox()
    {
        return $this->inSandBox;
    }

    public function setInSandBox($inSandBox)
    {
        $this->inSandBox = $inSandBox;
    }

    public function getDomain()
    {
        if ($this->isInSandBox()) {
            $domain = $this->SANDBOX_ADDRESS;
        }
        else {
            $domain = $this->API_ADDRESS;
        }

        return $domain;
    }

    protected function send()
    {
    }
}

require_once "Constants.class.php";
require_once "SDKRuntimeException.class.php";
require_once "util/CommonUtil.php";
require_once "util/MD5SignUtil.php";

?>
