<?php

class ResponseHandler
{
    /** 密钥 */
    public $key;
    /** 应答的参数 */
    public $parameters;
    /** debug信息 */
    public $debugInfo;

    public function __construct()
    {
        $this->ResponseHandler();
    }

    public function ResponseHandler()
    {
        $this->key = "";
        $this->parameters = array();
        $this->debugInfo = "";

        foreach ($_GET as $k => $v ) {
            $this->setParameter($k, $v);
        }

        foreach ($_POST as $k => $v ) {
            $this->setParameter($k, $v);
        }
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

    public function isTenpaySign($keyArr)
    {
        $signPars = "";
        ksort($this->parameters);

        foreach ($this->parameters as $k => $v ) {
            if (("sign" != $k) && ("" != $v) && !$keyArr) {
                $signPars .= $k . "=" . $v . "&";
            }
            else {
                if (("sign" != $k) && ("" != $v) && $keyArr) {
                    if (in_array($k, $keyArr)) {
                        $signPars .= $k . "=" . $v . "&";
                    }
                }
            }
        }

        $signPars .= "key=" . $this->getKey();
        $sign = strtolower(md5($signPars));
        $tenpaySign = strtolower($this->getParameter("sign"));
        $this->_setDebugInfo($signPars . " => sign:" . $sign . " tenpaySign:" . $this->getParameter("sign"));
        return $sign == $tenpaySign;
    }

    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

    public function doShow($show_url)
    {
        $strHtml = "<html><head>\r\n<meta name=\"TENCENT_ONLINE_PAYMENT\" content=\"China TENCENT\"><script language=\"javascript\">\r\nwindow.location.href='" . $show_url . "';\r\n</script>\r\n</head><body></body></html>";
        echo $strHtml;
        exit();
    }

    public function _isTenpaySign($signParameterArray)
    {
        $signPars = "";

        foreach ($signParameterArray as $k ) {
            $v = $this->getParameter($k);
            if (("sign" != $k) && ("" != $v)) {
                $signPars .= $k . "=" . $v . "&";
            }
        }

        $signPars .= "key=" . $this->getKey();
        $sign = strtolower(md5($signPars));
        $tenpaySign = strtolower($this->getParameter("sign"));
        $this->_setDebugInfo($signPars . " => sign:" . $sign . " tenpaySign:" . $this->getParameter("sign"));
        return $sign == $tenpaySign;
    }

    public function _setDebugInfo($debugInfo)
    {
        $this->debugInfo = $debugInfo;
    }
}


?>
