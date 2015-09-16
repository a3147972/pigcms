<?php

class WapPayRequest extends CommonRequest
{
    public $serialVersionUID = 6.4630490839894E+18;

    public function WapPayRequest($secretKey)
    {
        parent::__construct($secretKey);
    }

    public function getURL()
    {
        $paraString = parent::genParaStr();
        $domain = parent::getDomain();
        $url = $domain . $this->WAP_PAY_OPPOSITE_ADDRESS . "?" . $paraString;

        try {
            $http = new HttpClientUtil();
            $util = new XmlParseUtil();
            $str = $http->httpClientCall($url, "utf-8");
            $wapPayInitResponse = new WapPayInitResponse($util->openapiXmlToMap($str, "utf-8"), parent::getSecretKey());
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
            throw new SDKRuntimeException("Wap支付中心连接异常." . $e->getMessage(), e);
        }

        if () {
            return $wapPayInitResponse->getURL();
        }
        else {
            throw new SDKRuntimeException("Wap支付中心初始化返回异常." . $wapPayInitResponse->getMessage());
        }
    }

    public function send()
    {
        return NULL;
    }
}

require_once "common/CommonRequest.class.php";
require_once "common/CommonResponse.class.php";
require_once "common/util/XmlParseUtil.php";
require_once "common/util/HttpClientUtil.php";
require_once "WapPayInitResponse.class.php";
require_once "common/SDKRuntimeException.class.php";

?>
