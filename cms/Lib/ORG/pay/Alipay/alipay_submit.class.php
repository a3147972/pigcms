<?php

class AlipaySubmit
{
    public $alipay_config;
    /**
     *支付宝网关地址（新）
     */
    public $alipay_gateway_new = "https://mapi.alipay.com/gateway.do?";

    public function __construct($alipay_config)
    {
        $this->alipay_config = $alipay_config;
    }

    public function AlipaySubmit($alipay_config)
    {
        $this->__construct($alipay_config);
    }

    public function buildRequestMysign($para_sort)
    {
        $prestr = createLinkstring($para_sort);
        $mysign = "";

        switch (strtoupper(trim($this->alipay_config["sign_type"]))) {
        case "MD5":
            $mysign = md5Sign($prestr, $this->alipay_config["key"]);
            break;

        default:
            $mysign = "";
        }

        return $mysign;
    }

    public function buildRequestPara($para_temp)
    {
        $para_filter = paraFilter($para_temp);
        $para_sort = argSort($para_filter);
        $mysign = $this->buildRequestMysign($para_sort);
        $para_sort["sign"] = $mysign;
        $para_sort["sign_type"] = strtoupper(trim($this->alipay_config["sign_type"]));
        return $para_sort;
    }

    public function buildRequestParaToString($para_temp)
    {
        $para = $this->buildRequestPara($para_temp);
        $request_data = createLinkstringUrlencode($para);
        return $request_data;
    }

    public function buildRequestForm($para_temp, $method, $button_name)
    {
        $para = $this->buildRequestPara($para_temp);
        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='" . $this->alipay_gateway_new . "_input_charset=" . trim(strtolower($this->alipay_config["input_charset"])) . "' method='" . $method . "' style='display:none;'>";

        while (list($key, $val) = each($para)) {
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }

        $sHtml = $sHtml . "<input type='submit' value='" . $button_name . "'></form>";
        $sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script>";
        return $sHtml;
    }

    public function buildRequestHttp($para_temp)
    {
        $sResult = "";
        $request_data = $this->buildRequestPara($para_temp);
        $sResult = getHttpResponsePOST($this->alipay_gateway_new, $this->alipay_config["cacert"], $request_data, trim(strtolower($this->alipay_config["input_charset"])));
        return $sResult;
    }

    public function buildRequestHttpInFile($para_temp, $file_para_name, $file_name)
    {
        $para = $this->buildRequestPara($para_temp);
        $para[$file_para_name] = "@" . $file_name;
        $sResult = getHttpResponsePOST($this->alipay_gateway_new, $this->alipay_config["cacert"], $para, trim(strtolower($this->alipay_config["input_charset"])));
        return $sResult;
    }

    public function query_timestamp()
    {
        $url = $this->alipay_gateway_new . "service=query_timestamp&partner=" . trim(strtolower($this->alipay_config["partner"])) . "&_input_charset=" . trim(strtolower($this->alipay_config["input_charset"]));
        $encrypt_key = "";
        $doc = new DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName("encrypt_key");
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
        return $encrypt_key;
    }
}

require_once "alipay_core.function.php";
require_once "alipay_md5.function.php";

?>
