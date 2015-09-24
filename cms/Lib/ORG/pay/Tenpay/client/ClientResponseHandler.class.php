<?php

class ClientResponseHandler
{
    /** 密钥 */
    public $key;
    /** 应答的参数 */
    public $parameters;
    /** debug信息 */
    public $debugInfo;
    public $content;

    public function __construct()
    {
        $this->ClientResponseHandler();
    }

    public function ClientResponseHandler()
    {
        $this->key = "";
        $this->parameters = array();
        $this->debugInfo = "";
        $this->content = "";
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $xml = simplexml_load_string($this->content);
        $encode = $this->getXmlEncode($this->content);
        if ($xml && $xml->children()) {
            foreach ($xml->children() as $node ) {
                if ($node->children()) {
                    $k = $node->getName();
                    $nodeXml = $node->asXML();
                    $v = substr($nodeXml, strlen($k) + 2, strlen($nodeXml) - (2 * strlen($k)) - 5);
                }
                else {
                    $k = $node->getName();
                    $v = (string) $node;
                }

                if (($encode != "") && ($encode != "UTF-8")) {
                    $k = iconv("UTF-8", $encode, $k);
                    $v = iconv("UTF-8", $encode, $v);
                }

                $this->setParameter($k, $v);
            }
        }
    }

    public function getContent()
    {
        return $this->content;
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

    public function isTenpaySign()
    {
        $signPars = "";
        ksort($this->parameters);

        foreach ($this->parameters as $k => $v ) {
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

    public function getDebugInfo()
    {
        return $this->debugInfo;
    }

    public function getXmlEncode($xml)
    {
        $ret = preg_match("/<?xml[^>]* encoding=\"(.*)\"[^>]* ?>/i", $xml, $arr);

        if ($ret) {
            return strtoupper($arr[1]);
        }
        else {
            return "";
        }
    }

    public function _setDebugInfo($debugInfo)
    {
        $this->debugInfo = $debugInfo;
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
}


?>
