<?php

class Yeepay
{
    protected $order_info;
    protected $pay_money;
    protected $pay_type;
    protected $is_mobile;
    protected $pay_config;
    protected $user_info;

    public function __construct($order_info, $pay_money, $pay_type, $pay_config, $user_info, $is_mobile)
    {
        $this->order_info = $order_info;
        $this->pay_money = $pay_money;
        $this->pay_type = $pay_type;
        $this->is_mobile = $is_mobile;
        $this->pay_config = $pay_config;
        $this->user_info = $user_info;
    }

    public function pay()
    {
        if (empty($this->pay_config["pay_yeepay_merchantaccount"]) || empty($this->pay_config["pay_yeepay_merchantprivatekey"]) || empty($this->pay_config["pay_yeepay_merchantpublickey"]) || empty($this->pay_config["pay_yeepay_yeepaypublickey"]) || empty($this->pay_config["pay_yeepay_productcatalog"])) {
            return array("error" => 1, "msg" => "易宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_pay();
        } else {
            return $this->web_pay();
        }
    }

    public function mobile_pay()
    {
        import("@.ORG.pay.Yeepay.yeepayMPay");
        $yeepay = new yeepayMPay($this->pay_config["pay_yeepay_merchantaccount"], $this->pay_config["pay_yeepay_merchantpublickey"], $this->pay_config["pay_yeepay_merchantprivatekey"], $this->pay_config["pay_yeepay_yeepaypublickey"]);
        $order_id = $this->order_info["order_type"] . "_" . $this->order_info["order_id"];
        $transtime = $_SERVER["REQUEST_TIME"];
        $product_catalog = $this->pay_config["pay_yeepay_productcatalog"];
        $identity_id = "user_" . $this->user_info["uid"];
        $identity_type = 0;
        $user_ip = get_client_ip();
        $user_ua = $_SERVER["HTTP_USER_AGENT"];
        $callbackurl = C("config.site_url") . "/wap.php?c=Pay&a=return_url&pay_type=yeepay&is_mobile=1";
        $fcallbackurl = C("config.site_url") . "/source/m_yeepay.php";
        $product_name = $this->order_info["order_name"];
        $product_desc = $this->order_info["order_name"] . "_" . $this->order_info["order_num"];
        $other = "";
        $amount = floatval($this->order_info["order_total_money"] * 100);
        $url = $yeepay->webPay($order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $callbackurl, $fcallbackurl, $currency = 156, $product_name, $product_desc, $other);
        return array("error" => 0, "url" => $url);
    }

    public function web_pay()
    {
        import("@.ORG.pay.Yeepay.yeepayMPay");
        $yeepay = new yeepayMPay($this->pay_config["pay_yeepay_merchantaccount"], $this->pay_config["pay_yeepay_merchantpublickey"], $this->pay_config["pay_yeepay_merchantprivatekey"], $this->pay_config["pay_yeepay_yeepaypublickey"]);
        $order_id = $this->order_info["order_type"] . "_" . $this->order_info["order_id"];
        $transtime = $_SERVER["REQUEST_TIME"];
        $product_catalog = $this->pay_config["pay_yeepay_productcatalog"];
        $identity_id = "user_" . $this->user_info["uid"];
        $identity_type = 0;
        $user_ip = get_client_ip(0);
        $user_ua = $_SERVER["HTTP_USER_AGENT"];
        $callbackurl = C("config.site_url") . "/index.php?c=Pay&a=return_url&pay_type=yeepay";
        $fcallbackurl = C("config.site_url") . "/source/web_yeepay.php";
        $product_name = $this->order_info["order_name"];
        $product_desc = $this->order_info["order_name"] . "_" . $this->order_info["order_num"];
        $terminaltype = 3;
        $terminalid = "05-16-DC-59-C2-34";
        $amount = floatval($this->order_info["order_total_money"] * 100);
        $url = $yeepay->pcWebPay($order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $terminaltype, $terminalid, $paytypes = "1|2", $orderexp_date = 60, $callbackurl, $fcallbackurl, 156, $product_name, $product_desc);
        return array("error" => 0, "url" => $url);
    }

    public function notice_url()
    {
        if (empty($this->pay_config["pay_yeepay_merchantaccount"]) || empty($this->pay_config["pay_yeepay_merchantprivatekey"]) || empty($this->pay_config["pay_yeepay_merchantpublickey"]) || empty($this->pay_config["pay_yeepay_yeepaypublickey"]) || empty($this->pay_config["pay_yeepay_productcatalog"])) {
            return array("error" => 1, "msg" => "易宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_notice();
        } else {
            return $this->web_notice();
        }
    }

    public function mobile_notice()
    {
        exit("success");
    }

    public function web_notice()
    {
        exit("success");
    }

    public function return_url()
    {
        if (empty($this->pay_config["pay_yeepay_merchantaccount"]) || empty($this->pay_config["pay_yeepay_merchantprivatekey"]) || empty($this->pay_config["pay_yeepay_merchantpublickey"]) || empty($this->pay_config["pay_yeepay_yeepaypublickey"]) || empty($this->pay_config["pay_yeepay_productcatalog"])) {
            return array("error" => 1, "msg" => "易宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }
        import("@.ORG.pay.Yeepay.yeepayMPay");
        $yeepay = new yeepayMPay($this->pay_config["pay_yeepay_merchantaccount"], $this->pay_config["pay_yeepay_merchantpublickey"], $this->pay_config["pay_yeepay_merchantprivatekey"], $this->pay_config["pay_yeepay_yeepaypublickey"]);

        try {
            $return = $yeepay->callback($_GET["data"], $_GET["encryptkey"]);
            $order_id_arr = explode("_", $return["orderid"]);
            $order_param["pay_type"] = "yeepay";
            $order_param["is_mobile"] = $this->is_mobile;
            $order_param["order_type"] = $order_id_arr[0];
            $order_param["order_id"] = $order_id_arr[1];
            $order_param["third_id"] = $return["yborderid"];
            $order_param["pay_money"] = $return["amount"] / 100;
            return array("error" => 0, "order_param" => $order_param);
        } catch (yeepayMPayException $e) {
            return array("error" => 1, "msg" => "支付时发生错误！<br/>错误提示：" . $e->GetMessage() . "<br/>错误代码：" . $e->Getcode());
        }
    }

    public function refund()
    {
        if (empty($this->pay_config["pay_yeepay_merchantaccount"]) || empty($this->pay_config["pay_yeepay_merchantprivatekey"]) || empty($this->pay_config["pay_yeepay_merchantpublickey"]) || empty($this->pay_config["pay_yeepay_yeepaypublickey"]) || empty($this->pay_config["pay_yeepay_productcatalog"])) {
            return array("error" => 1, "msg" => "易宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        import("@.ORG.pay.Yeepay.yeepayMPay");
        $yeepay = new yeepayMPay($this->pay_config["pay_yeepay_merchantaccount"], $this->pay_config["pay_yeepay_merchantpublickey"], $this->pay_config["pay_yeepay_merchantprivatekey"], $this->pay_config["pay_yeepay_yeepaypublickey"]);
        $refund_param = array();

        try {
            $refundResult = $yeepay->refund(floatval($this->pay_money * 100), $this->order_info["order_type"] . "_" . $this->order_info["order_id"], $this->order_info["third_id"]);
            $refund_param["refund_id"] = $refundResult["yborderid"];
            $refund_param["refund_time"] = $refundResult["timestamp"];
            return array("error" => 0, "type" => "ok", "msg" => "退款申请成功！5到10个工作日款项会自动流入您支付时使用的银行卡内。", "refund_param" => $refund_param);
        } catch (yeepayMPayException $e) {
            $refund_param["err_msg"] = "退款时发生错误！<br/>错误提示：" . $e->GetMessage() . "<br/>错误代码：" . $e->Getcode();
            $refund_param["refund_time"] = time();
            return array("error" => 1, "type" => "fail", "msg" => "退款申请失败！如果重试多次还是失败请联系系统管理员。", "refund_param" => $refund_param);
        }
    }
}
