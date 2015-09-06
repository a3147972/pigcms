<?php

class Allinpay
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
        if ($this->pay_config["pay_allinpay_merchantid"] || $this->pay_config["pay_allinpay_merchantkey"]) {
            return array("error" => 1, "msg" => "通联支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_pay();
        }
        else {
            return $this->web_pay();
        }
    }

    public function mobile_pay()
    {
        import("@.ORG.pay.Allinpay.allinpayCore");
        $allinpayClass = new allinpayCore();
        $allinpayClass->setParameter("payUrl", "http://ceshi.allinpay.com/mobilepayment/mobile/SaveMchtOrderServlet.action");
        $allinpayClass->setParameter("pickupUrl", C("config.site_url") . "/wap.php?c=Pay&a=return_url&pay_type=allinpay&is_mobile=1");
        $allinpayClass->setParameter("receiveUrl", C("config.site_url") . "/wap.php?c=Pay&a=notify_url&pay_type=allinpay&is_mobile=1");
        $allinpayClass->setParameter("merchantId", $this->pay_config["pay_allinpay_merchantid"]);
        $allinpayClass->setParameter("orderNo", $this->order_info["order_type"] . "_" . $this->order_info["order_id"]);
        $allinpayClass->setParameter("orderAmount", floatval($this->pay_money * 100));
        $allinpayClass->setParameter("orderDatetime", date("YmdHis", $_SERVER["REQUEST_TIME"]));
        $allinpayClass->setParameter("productName", $this->order_info["order_name"]);
        $allinpayClass->setParameter("payType", 0);
        $allinpayClass->setParameter("key", $this->pay_config["pay_allinpay_merchantkey"]);
        $form = $allinpayClass->sendRequestForm();
        return array("error" => 0, "form" => $form);
    }

    public function web_pay()
    {
        import("@.ORG.pay.Allinpay.allinpayCore");
        $allinpayClass = new allinpayCore();
        $allinpayClass->setParameter("payUrl", "http://ceshi.allinpay.com/gateway/index.do");
        $allinpayClass->setParameter("pickupUrl", C("config.site_url") . "/index.php?c=Pay&a=return_url&pay_type=allinpay");
        $allinpayClass->setParameter("receiveUrl", C("config.site_url") . "/index.php?c=Pay&a=notify_url&pay_type=allinpay");
        $allinpayClass->setParameter("merchantId", $this->pay_config["pay_allinpay_merchantid"]);
        $allinpayClass->setParameter("orderNo", $this->order_info["order_type"] . "_" . $this->order_info["order_id"]);
        $allinpayClass->setParameter("orderAmount", floatval($this->pay_money * 100));
        $allinpayClass->setParameter("orderDatetime", date("YmdHis", $_SERVER["REQUEST_TIME"]));
        $allinpayClass->setParameter("productName", $this->order_info["order_name"]);
        $allinpayClass->setParameter("payType", 0);
        $allinpayClass->setParameter("key", $this->pay_config["pay_allinpay_merchantkey"]);
        $form = $allinpayClass->sendRequestForm();
        return array("error" => 0, "form" => $form);
    }

    public function notice_url()
    {
        if ($this->pay_config["pay_allinpay_merchantid"] || $this->pay_config["pay_allinpay_merchantkey"]) {
            return array("error" => 1, "msg" => "通联支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_notice();
        }
        else {
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
        if ($this->pay_config["pay_allinpay_merchantid"] || $this->pay_config["pay_allinpay_merchantkey"]) {
            return array("error" => 1, "msg" => "通联支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        import("@.ORG.pay.Allinpay.allinpayCore");
        $allinpayClass = new allinpayCore();
        $verify_result = $allinpayClass->verify_pay($this->pay_config["pay_allinpay_merchantkey"]);

        if ($verify_result["error"]) {
            $order_id_arr = explode("_", $verify_result["order_id"]);
            $order_param["pay_type"] = "allinpay";
            $order_param["is_mobile"] = $this->is_mobile;
            $order_param["order_type"] = $order_id_arr[0];
            $order_param["order_id"] = $order_id_arr[1];
            $order_param["third_id"] = $verify_result["paymentOrderId"];
            $order_param["pay_money"] = $verify_result["pay_money"];
            return array("error" => 0, "order_param" => $order_param);
        }
        else {
            return array("error" => 1, "msg" => $verify_result["msg"]);
        }
    }

    public function refund()
    {
        if ($this->pay_config["pay_allinpay_merchantid"] || $this->pay_config["pay_allinpay_merchantkey"]) {
            return array("error" => 1, "msg" => "通联支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        import("@.ORG.pay.Allinpay.allinpayCore");
        $allinpayClass = new allinpayCore();
        $allinpayClass->setParameter("refundHost", "ceshi.allinpay.com");
        $allinpayClass->setParameter("key", $this->pay_config["pay_allinpay_merchantkey"]);
        $allinpayClass->setParameter("merchantId", $this->pay_config["pay_allinpay_merchantid"]);
        $allinpayClass->setParameter("orderNo", $this->order_info["order_type"] . "_" . $this->order_info["order_id"]);
        $allinpayClass->setParameter("orderDatetime", date("YmdHis", $this->order_info["submit_order_time"]));
        $allinpayClass->setParameter("refundAmount", $this->pay_money * 100);
        $verify_result = $allinpayClass->refund($this->order_info, $this->pay_money, $this->pay_config);
        return $verify_result;
    }
}


?>
