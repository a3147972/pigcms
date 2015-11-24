<?php

class Alipay
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
        if (empty($this->pay_config["pay_alipay_name"]) || empty($this->pay_config["pay_alipay_pid"]) || empty($this->pay_config["pay_alipay_key"])) {
            return array("error" => 1, "msg" => "支付宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_pay();
        } else {
            return $this->web_pay();
        }
    }

    public function mobile_pay()
    {
        return array("error" => 1, "msg" => "支付宝手机支付暂未开通");
    }

    public function web_pay()
    {
        import("@.ORG.pay.Alipay.alipay_submit");
        $alipay_config["partner"] = $this->pay_config["pay_alipay_pid"];
        $alipay_config["seller_email"] = $this->pay_config["pay_alipay_name"];
        $alipay_config["key"] = $this->pay_config["pay_alipay_key"];
        $alipay_config["sign_type"] = "MD5";
        $alipay_config["input_charset"] = "utf-8";
        $alipay_config["transport"] = "http";
        $parameter = array("service" => "create_direct_pay_by_user", "partner" => $this->pay_config["pay_alipay_pid"], "seller_email" => $this->pay_config["pay_alipay_name"], "payment_type" => "1", "notify_url" => C("config.site_url") . "/source/web_alipay_notice.php", "return_url" => C("config.site_url") . "/source/web_alipay_return.php", "out_trade_no" => $this->order_info["order_type"] . "_" . $this->order_info["order_id"], "subject" => "订单编号：" . $this->order_info["order_id"], "total_fee" => $this->pay_money, "body" => "订单编号：" . $this->order_info["order_id"], "show_url" => C("config.site_url"), "anti_phishing_key" => "", "exter_invoke_ip" => "", "_input_charset" => "utf-8");
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $form = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        return array("error" => 0, "form" => $form);
    }

    public function notice_url()
    {
        if (empty($this->pay_config["pay_alipay_name"]) || empty($this->pay_config["pay_alipay_pid"]) || empty($this->pay_config["pay_alipay_key"])) {
            return array("error" => 1, "msg" => "支付宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
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
        if (empty($this->pay_config["pay_alipay_name"]) || empty($this->pay_config["pay_alipay_pid"]) || empty($this->pay_config["pay_alipay_key"])) {
            return array("error" => 1, "msg" => "支付宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_return();
        } else {
            return $this->web_return();
        }
    }

    public function mobile_return()
    {
    }

    public function web_return()
    {
        unset($_GET["pay_type"]);
        import("@.ORG.pay.Alipay.alipay_notify");
        $alipay_config["partner"] = $this->pay_config["pay_alipay_pid"];
        $alipay_config["seller_email"] = $this->pay_config["pay_alipay_name"];
        $alipay_config["key"] = $this->pay_config["pay_alipay_key"];
        $alipay_config["sign_type"] = "MD5";
        $alipay_config["input_charset"] = "utf-8";
        $alipay_config["transport"] = "http";
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if ($verify_result) {
            $out_trade_no = $_POST["out_trade_no"];
            $trade_no = $_POST["trade_no"];
            $trade_status = $_POST["trade_status"];
            $total_fee = $_POST["total_fee"];

            if ($_POST["trade_status"] == "TRADE_SUCCESS") {
                $order_id_arr = explode("_", $out_trade_no);
                $order_param["pay_type"] = "alipay";
                $order_param["is_mobile"] = "0";
                $order_param["order_type"] = $order_id_arr[0];
                $order_param["order_id"] = $order_id_arr[1];
                $order_param["third_id"] = $trade_no;
                $order_param["pay_money"] = $total_fee;
                return array("error" => 0, "order_param" => $order_param);
            } else {
                return array("error" => 1, "msg" => "支付错误：付款失败！请联系管理员。");
            }
        } else {
            return array("error" => 1, "msg" => "支付错误：认证签名失败！请联系管理员。");
        }
    }

    public function query_order()
    {
        if ($this->pay_config["pay_alipay_name"] || $this->pay_config["pay_alipay_pid"] || $this->pay_config["pay_alipay_key"]) {
            return array("error" => 1, "msg" => "支付宝支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_query_order();
        } else {
            return $this->web_query_order();
        }
    }

    public function mobile_query_order()
    {
    }

    public function web_query_order()
    {
        unset($_GET["pay_type"]);
        import("@.ORG.pay.Alipay.alipay_notify");
        $alipay_config["partner"] = $this->pay_config["pay_alipay_pid"];
        $alipay_config["seller_email"] = $this->pay_config["pay_alipay_name"];
        $alipay_config["key"] = $this->pay_config["pay_alipay_key"];
        $alipay_config["sign_type"] = "MD5";
        $alipay_config["input_charset"] = "utf-8";
        $alipay_config["transport"] = "http";
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if ($verify_result) {
            $out_trade_no = $_GET["out_trade_no"];
            $trade_no = $_GET["trade_no"];
            $trade_status = $_GET["trade_status"];
            $total_fee = $_GET["total_fee"];

            if ($_GET["trade_status"] == "TRADE_SUCCESS") {
                $order_id_arr = explode("_", $out_trade_no);
                $order_param["pay_type"] = "alipay";
                $order_param["is_mobile"] = "0";
                $order_param["order_type"] = $order_id_arr[0];
                $order_param["order_id"] = $order_id_arr[1];
                $order_param["third_id"] = $trade_no;
                $order_param["pay_money"] = $total_fee;
                return array("error" => 0, "order_param" => $order_param);
            } else {
                return array("error" => 1, "msg" => "支付错误：付款失败！请联系管理员。");
            }
        } else {
            return array("error" => 1, "msg" => "支付错误：认证签名失败！请联系管理员。");
        }
    }

    public function refund()
    {
        return array("error" => 1, "msg" => "支付宝退款暂未开通");
    }
}
