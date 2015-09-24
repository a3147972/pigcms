<?php

class RequestHandler
{
    /** 网关url地址 */
    public $gateUrl;
    /** 密钥 */
    public $key;
    /** 请求的参数 */
    public $parameters;
    /** debug信息 */
    public $debugInfo;

    public function __construct()
    {
        $this->RequestHandler();
    }

    public function RequestHandler()
    {
        $this->gateUrl = "https://www.tenpay.com/cgi-bin/v1.0/service_gate.cgi";
        $this->key = "";
        $this->parameters = array();
        $this->debugInfo = "";
    }

    public function init()
    {
    }

    public function getGateURL()
    {
        return $this->gateUrl;
    }

    public function setGateURL($gateUrl)
    {
        $this->gateUrl = $gateUrl;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    public function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$parameter] = $parameterValue;
    }

    public function getAllParameters()
    {
        return $this->parameters;
    }

    public function getRequestURL()
    {
        $this->createSign();
        $reqPar = "";
        ksort($this->parameters);

        foreach ($this->parameters as $k => $v ) {
            $reqPar .= $k . "=" . urlencode($v) . "&";
        }

        $reqPar = substr($reqPar, 0, strlen($reqPar) - 1);
        $requestURL = $this->getGateURL() . "?" . $reqPar;
        return $requestURL;
    }

    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

    public function doSend()
    {
        header("Location:" . $this->getRequestURL());
        exit();
    }

    public function createSign()
    {
        $signPars = "";
        ksort($this->parameters);

        foreach ($this->parameters as $k => $v ) {
            if (("" != $v) && ("sign" != $k)) {
                $signPars .= $k . "=" . $v . "&";
            }
        }

        $signPars .= "key=" . $this->getKey();
        $sign = strtoupper(md5($signPars));
        $this->setParameter("sign", $sign);
        $this->_setDebugInfo($signPars . " => sign:" . $sign);
    }

    public function _setDebugInfo($debugInfo)
    {
        $this->debugInfo = $debugInfo;
    }
}


?>
