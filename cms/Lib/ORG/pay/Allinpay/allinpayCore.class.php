<?php

class allinpayCore
{
    /** 支付需要的参数 */
    public $parameters;

    public function __construct()
    {
        $this->parameters = array();
    }

    public function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$parameter] = $parameterValue;
    }

    public function setSignMsg()
    {
        $bufSignSrc = "inputCharset=1&";
        $bufSignSrc .= "pickupUrl=" . $this->parameters["pickupUrl"] . "&";
        $bufSignSrc .= "receiveUrl=" . $this->parameters["receiveUrl"] . "&";
        $bufSignSrc .= "version=v1.0&";
        $bufSignSrc .= "signType=0&";
        $bufSignSrc .= "merchantId=" . $this->parameters["merchantId"] . "&";
        $bufSignSrc .= "orderNo=" . $this->parameters["orderNo"] . "&";
        $bufSignSrc .= "orderAmount=" . $this->parameters["orderAmount"] . "&";
        $bufSignSrc .= "orderDatetime=" . $this->parameters["orderDatetime"] . "&";
        $bufSignSrc .= "productName=" . $this->parameters["productName"] . "&";
        $bufSignSrc .= "payType=" . $this->parameters["payType"] . "&";
        $bufSignSrc .= "tradeNature=GOODS&";
        $bufSignSrc .= "key=" . $this->parameters["key"];
        $this->parameters["signMsg"] = strtoupper(md5($bufSignSrc));
    }

    public function sendRequestForm()
    {
        $this->setSignMsg();
        $param = $this->parameters;
        $formHtml .= "<div style=\"display:none;\">";
        $formHtml .= "<form id=\"allinpaysubmit\" name=\"allinpaysubmit\" action=\"" . $param["payUrl"] . "\" method=\"post\">";
        $formHtml .= "<input type=\"hidden\" name=\"inputCharset\" value=\"1\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"pickupUrl\" value=\"" . $param["pickupUrl"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"receiveUrl\" value=\"" . $param["receiveUrl"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"version\" value=\"v1.0\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"language\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"signType\" value=\"0\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"merchantId\" value=\"" . $param["merchantId"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"payerName\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"payerEmail\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"payerTelephone\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"payerIDCard\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"pid\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"orderNo\" value=\"" . $param["orderNo"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"orderAmount\" value=\"" . $param["orderAmount"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"orderCurrency\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"orderDatetime\" value=\"" . $param["orderDatetime"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"orderExpireDatetime\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"productName\" value=\"" . $param["productName"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"productPrice\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"productNum\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"productId\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"productDesc\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"ext1\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"ext2\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"extTL\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"payType\" value=\"" . $param["payType"] . "\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"issuerId\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"pan\" value=\"\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"tradeNature\" value=\"GOODS\"/>";
        $formHtml .= "<input type=\"hidden\" name=\"signMsg\" value=\"" . $param["signMsg"] . "\"/>";
        $formHtml .= "<input type=\"submit\" value=\"进行支付\">";
        $formHtml .= "<script>document.forms['allinpaysubmit'].submit();</script>";
        $formHtml .= "</form>";
        $formHtml .= "</div>";
        return $formHtml;
    }

    public function verify_pay($key)
    {
        $bufSignSrc = "";

        if ($_POST["merchantId"] != "") {
            $bufSignSrc .= "merchantId=" . $_POST["merchantId"] . "&";
        }

        if ($_POST["version"] != "") {
            $bufSignSrc .= "version=" . $_POST["version"] . "&";
        }

        if ($_POST["language"] != "") {
            $bufSignSrc .= "language=" . $_POST["language"] . "&";
        }

        if ($_POST["signType"] != "") {
            $bufSignSrc .= "signType=" . $_POST["signType"] . "&";
        }

        if ($_POST["payType"] != "") {
            $bufSignSrc .= "payType=" . $_POST["payType"] . "&";
        }

        if ($_POST["issuerId"] != "") {
            $bufSignSrc .= "issuerId=" . $_POST["issuerId"] . "&";
        }

        if ($_POST["paymentOrderId"] != "") {
            $bufSignSrc .= "paymentOrderId=" . $_POST["paymentOrderId"] . "&";
        }

        if ($_POST["orderNo"] != "") {
            $bufSignSrc .= "orderNo=" . $_POST["orderNo"] . "&";
        }

        if ($_POST["orderDatetime"] != "") {
            $bufSignSrc .= "orderDatetime=" . $_POST["orderDatetime"] . "&";
        }

        if ($_POST["orderAmount"] != "") {
            $bufSignSrc .= "orderAmount=" . $_POST["orderAmount"] . "&";
        }

        if ($_POST["payDatetime"] != "") {
            $bufSignSrc .= "payDatetime=" . $_POST["payDatetime"] . "&";
        }

        if ($_POST["payAmount"] != "") {
            $bufSignSrc .= "payAmount=" . $_POST["payAmount"] . "&";
        }

        if ($_POST["ext1"] != "") {
            $bufSignSrc .= "ext1=" . $_POST["ext1"] . "&";
        }

        if ($_POST["ext2"] != "") {
            $bufSignSrc .= "ext2=" . $_POST["ext2"] . "&";
        }

        if ($_POST["payResult"] != "") {
            $bufSignSrc .= "payResult=" . $_POST["payResult"] . "&";
        }

        if ($_POST["returnDatetime"] != "") {
            $bufSignSrc .= "returnDatetime=" . $_POST["returnDatetime"] . "&";
        }

        $bufSignSrc .= "key=" . $key;
        $verify_signMsg = strtoupper(md5($bufSignSrc));

        if ($_POST["signMsg"] == $verify_signMsg) {
            if ($_POST["payResult"] == 1) {
                return array("error" => 0, "order_id" => $_POST["orderNo"], "paymentOrderId" => $_POST["paymentOrderId"], "pay_money" => $_POST["orderAmount"] / 100);
            }
            else {
                return array("error" => 1, "msg" => "订单支付失败！");
            }
        }
        else {
            return array("error" => 1, "msg" => "报文验签失败！");
        }
    }

    public function refund()
    {
        $bufSignSrc = "version=v1.3&signType=0&";
        $bufSignSrc = $bufSignSrc . "merchantId=" . $this->parameters["merchantId"] . "&";
        $bufSignSrc = $bufSignSrc . "orderNo=" . $this->parameters["orderNo"] . "&";
        $bufSignSrc = $bufSignSrc . "refundAmount=" . $this->parameters["refundAmount"] . "&";
        $bufSignSrc = $bufSignSrc . "orderDatetime=" . $this->parameters["orderDatetime"] . "&";
        $bufSignSrc = $bufSignSrc . "key=" . $this->parameters["key"];
        $signMsg = strtoupper(md5($bufSignSrc));
        $params = "version=v1.3&signType=0&merchantId=" . $this->parameters["merchantId"] . "&orderNo=" . $this->parameters["orderNo"] . "&refundAmount=" . $this->parameters["refundAmount"] . "&orderDatetime=" . $this->parameters["orderDatetime"] . "&signMsg=" . $signMsg;
        $length = strlen($params);
        $header = array();
        $header[] = "POST /gateway/index.do HTTP/1.0";
        $header[] = "Host: " . $this->parameters["refundHost"];
        $header[] = "Accept: text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*";
        $header[] = "Accept-encoding: gzip";
        $header[] = "Accept-language: en-us";
        $header[] = "Content-Type: application/x-www-form-urlencoded";
        $header[] = "Content-Length: " . $length;
        $request = implode("\r\n", $header) . "\r\n\r\n" . $params;
        $pageContents = "";
        $fp = pfsockopen($this->parameters["refundHost"], 80, $errno, $errstr, 10);
        //反转
        if (empty($fp)) {
            return array("error" => 1, "msg" => "无法连接通联支付服务器<br/>$errstr($errno)");
        }
        else {
            fwrite($fp, $request);
            $inHeaders = true;
            $atStart = true;
            $ERROR = false;

            while (!feof($fp)) {
                $line = fgets($fp, 2048);

                if ($atStart) {
                    $atStart = false;
                    preg_match("/HTTP\/(\d\.\d)\s*(\d+)\s*(.*)/", $line, $m);
                    $responseStatus = $m[2];
                    continue;
                }

                if ($inHeaders) {
                    if (strlen(trim($line)) == 0) {
                        $inHeaders = false;
                    }

                    continue;
                }

                if (empty($inHeaders) && ($responseStatus == 200)) { //反转
                    $pageContents = $line;
                }
            }

            fclose($fp);
        }

        $resultArr = array();
        $result = explode("&", $pageContents);

        if (is_array($result)) {
            foreach ($result as $element ) {
                $temp = explode("=", $element);

                if (count($temp) == 2) {
                    $resultArr[$temp[0]] = $temp[1];
                }
            }
        }

        $refund_param = array();

        if ($resultArr["refundResult"] != "20") {
            $refund_param["err_msg"] = $resultArr["ERRORMSG"];
            $refund_param["refund_time"] = time();
            return array("error" => 1, "type" => "fail", "msg" => "退款申请失败！如果重试多次还是失败请联系系统管理员。", "refund_param" => $refund_param);
        }
        else {
            $refund_param["refund_time"] = $resultArr["refundDatetime"];
            return array("error" => 0, "type" => "ok", "msg" => "退款申请成功！5到10个工作日款项会自动流入您支付时使用的银行卡内。", "refund_param" => $refund_param);
        }
    }
}


?>
