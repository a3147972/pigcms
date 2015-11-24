<?php

class Tenpay
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
        if (empty($this->pay_config["pay_tenpay_partnerid"]) || empty($this->pay_config["pay_tenpay_partnerkey"])) {
            return array("error" => 1, "msg" => "财付通支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_pay();
        } else {
            return $this->web_pay();
        }
    }

    public function mobile_pay()
    {
        import("@.ORG.pay.Tenpay.RequestHandler");
        import("@.ORG.pay.Tenpay.client.ClientResponseHandler");
        import("@.ORG.pay.Tenpay.client.TenpayHttpClient");
        $reqHandler = new RequestHandler();
        $reqHandler->init();
        $reqHandler->setKey($this->pay_config["pay_tenpay_partnerkey"]);
        $reqHandler->setGateUrl("http://wap.tenpay.com/cgi-bin/wappayv2.0/wappay_init.cgi");
        $httpClient = new TenpayHttpClient();
        $resHandler = new ClientResponseHandler();
        $callback_url = C("config.site_url") . "/wap.php?c=Pay&a=return_url&pay_type=tenpay";
        $notify_url = C("config.site_url") . "/wap.php?c=Pay&a=notify_url&pay_type=tenpay";
        $desc = $this->order_info["order_name"] . "_" . $this->order_info["order_num"];
        $reqHandler->setParameter("total_fee", floatval($this->pay_money * 100));
        $reqHandler->setParameter("spbill_create_ip", get_client_ip());
        $reqHandler->setParameter("ver", "2.0");
        $reqHandler->setParameter("bank_type", "0");
        $reqHandler->setParameter("callback_url", $callback_url);
        $reqHandler->setParameter("bargainor_id", $this->pay_config["pay_tenpay_partnerid"]);
        $reqHandler->setParameter("sp_billno", $this->order_info["order_type"] . "_" . $this->order_info["order_id"]);
        $reqHandler->setParameter("notify_url", $notify_url);
        $reqHandler->setParameter("desc", $desc);
        $reqHandler->setParameter("attach", "1");
        $httpClient->setReqContent($reqHandler->getRequestURL());

        if ($httpClient->call()) {
            $resHandler->setContent($httpClient->getResContent());

            if ($resHandler->parameters["err_info"]) {
                return array("error" => 1, "msg" => "财付通异常返回：<b>" . $resHandler->parameters["err_info"] . "</b>");
            }

            $token_id = $resHandler->getParameter("token_id");
            $reqHandler->setParameter("token_id", $token_id);
            $reqUrl = "http://wap.tenpay.com/cgi-bin/wappayv2.0/wappay_gate.cgi?token_id=" . $token_id;
            return array("error" => 0, "url" => $reqUrl);
        } else {
            return array("error" => 1, "msg" => "财付通信息校验失败，请重试。");
        }
    }

    public function web_pay()
    {
        import("@.ORG.pay.TenpayComputer.RequestHandler");
        $reqHandler = new RequestHandler();
        $reqHandler->init();
        $reqHandler->setKey($this->pay_config["pay_tenpay_partnerkey"]);
        $reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");
        $return_url = C("config.site_url") . "/index.php?c=Pay&a=return_url&pay_type=tenpay";
        $notify_url = C("config.site_url") . "/index.php?c=Pay&a=notify_url&pay_type=tenpay";
        $body = "订单编号：" . $this->order_info["order_id"];
        $reqHandler->setParameter("partner", $this->pay_config["pay_tenpay_partnerid"]);
        $reqHandler->setParameter("out_trade_no", $this->order_info["order_type"] . "_" . $this->order_info["order_id"]);
        $reqHandler->setParameter("total_fee", floatval($this->pay_money * 100));
        $reqHandler->setParameter("return_url", $return_url);
        $reqHandler->setParameter("notify_url", $notify_url);
        $reqHandler->setParameter("body", $body);
        $reqHandler->setParameter("bank_type", "DEFAULT");
        $reqHandler->setParameter("spbill_create_ip", get_client_ip());
        $reqHandler->setParameter("fee_type", "1");
        $reqHandler->setParameter("subject", "订单编号：" . $this->order_info["order_id"]);
        $reqHandler->setParameter("sign_type", "MD5");
        $reqHandler->setParameter("service_version", "1.0");
        $reqHandler->setParameter("input_charset", "utf-8");
        $reqHandler->setParameter("sign_key_index", "1");
        $reqUrl = $reqHandler->getRequestURL();
        $debugInfo = $reqHandler->getDebugInfo();
        return array("error" => 0, "url" => $reqUrl);
    }

    public function notice_url()
    {
        if (empty($this->pay_config["pay_tenpay_partnerid"]) || empty($this->pay_config["pay_tenpay_partnerkey"])) {
            return array("error" => 1, "msg" => "财付通支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
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
        if (empty($this->pay_config["pay_tenpay_partnerid"]) || empty($this->pay_config["pay_tenpay_partnerkey"])) {
            return array("error" => 1, "msg" => "财付通支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        if ($this->is_mobile) {
            return $this->mobile_return();
        } else {
            return $this->web_return();
        }
    }

    public function mobile_return()
    {
        import("@.ORG.pay.Tenpay.ResponseHandler");
        import("@.ORG.pay.Tenpay.WapResponseHandler");
        $resHandler = new WapResponseHandler();
        $resHandler->setKey($this->pay_config["pay_tenpay_partnerkey"]);

        if ($resHandler->isTenpaySign()) {
            $bargainor_id = $resHandler->getParameter("bargainor_id");
            $sp_billno = $resHandler->getParameter("sp_billno");
            $transaction_id = $resHandler->getParameter("transaction_id");
            $total_fee = $resHandler->getParameter("total_fee");
            $pay_result = $resHandler->getParameter("pay_result");

            if ("0" == $pay_result) {
                $order_id_arr = explode("_", $sp_billno);
                $order_param["pay_type"] = "tenpay";
                $order_param["is_mobile"] = "1";
                $order_param["order_type"] = $order_id_arr[0];
                $order_param["order_id"] = $order_id_arr[1];
                $order_param["third_id"] = $transaction_id;
                $order_param["pay_money"] = $total_fee / 100;
                return array("error" => 0, "order_param" => $order_param);
            } else {
                return array("error" => 1, "msg" => "支付错误：付款失败！请联系管理员。");
            }
        } else {
            return array("error" => 1, "msg" => "支付错误：认证签名失败！请联系管理员。");
        }
    }

    public function web_return()
    {
        unset($_GET["pay_type"]);
        import("@.ORG.pay.TenpayComputer.ResponseHandler");
        $resHandler = new ResponseHandler();
        $resHandler->setKey($this->pay_config["pay_tenpay_partnerkey"]);

        if ($resHandler->isTenpaySign()) {
            $notify_id = $resHandler->getParameter("notify_id");
            $out_trade_no = $resHandler->getParameter("out_trade_no");
            $transaction_id = $resHandler->getParameter("transaction_id");
            $total_fee = $resHandler->getParameter("total_fee");
            $discount = $resHandler->getParameter("discount");
            $trade_state = $resHandler->getParameter("trade_state");
            $trade_mode = $resHandler->getParameter("trade_mode");

            if ("0" == $trade_state) {
                $order_id_arr = explode("_", $out_trade_no);
                $order_param["pay_type"] = "tenpay";
                $order_param["is_mobile"] = "0";
                $order_param["order_type"] = $order_id_arr[0];
                $order_param["order_id"] = $order_id_arr[1];
                $order_param["third_id"] = $transaction_id;
                $order_param["pay_money"] = $total_fee / 100;
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
        if (empty($this->pay_config["pay_tenpay_partnerid"]) || empty($this->pay_config["pay_tenpay_partnerkey"])) {
            return array("error" => 1, "msg" => "财付通支付缺少配置信息！请联系管理员处理或选择其他支付方式。");
        }

        return $this->mobile_refund();
    }

    public function web_refund()
    {
    }

    public function mobile_refund()
    {
        import("@.ORG.pay.Tenpay.RequestHandler");
        import("@.ORG.pay.Tenpay.client.ClientResponseHandler");
        import("@.ORG.pay.Tenpay.client.TenpayHttpClient");
        $reqHandler = new RequestHandler();
        $httpClient = new TenpayHttpClient();
        $resHandler = new ClientResponseHandler();
        $reqHandler = new RequestHandler();
        $reqHandler->init();
        $reqHandler->setKey($this->pay_config["pay_tenpay_partnerkey"]);
        $reqHandler->setGateUrl("https://gw.tenpay.com/gateway/normalrefundquery.xml");
        $httpClient = new TenpayHttpClient();
        $resHandler = new ClientResponseHandler();
        $reqHandler->setParameter("partner", $this->pay_config["pay_tenpay_partnerid"]);
        $reqHandler->setParameter("out_trade_no", $this->order_info["order_type"] . "_" . $this->order_info["order_id"]);
        $reqHandler->setParameter("input_charset", "utf-8");
        $httpClient->setTimeOut(30);
        $httpClient->setMethod("POST");
        $httpClient->setReqContent($reqHandler->getRequestURL());

        if ($httpClient->call()) {
            $resHandler->setContent($httpClient->getResContent());
            $resHandler->setKey($this->pay_config["pay_tenpay_partnerkey"]);
            if ($resHandler->isTenpaySign() && ($resHandler->getParameter("retcode") == 0)) {
                $refund_param["refund_id"] = $resHandler->getParameter("out_refund_no_0");
                $refund_param["refund_time"] = $refundResult["timestamp"];
                return array("error" => 0, "type" => "ok", "msg" => "退款申请成功！5到10个工作日款项会自动流入您支付时使用的银行卡内。", "refund_param" => $refund_param);
            } else {
                $refund_param["err_msg"] = "验证签名失败 或 业务错误信息:retcode= " . $resHandler->getParameter("retcode") . ",retmsg= " . $resHandler->getParameter("retmsg");
                $refund_param["refund_time"] = time();
                return array("error" => 1, "type" => "fail", "msg" => "退款申请失败！如果重试多次还是失败请联系系统管理员。", "refund_param" => $refund_param);
            }
        } else {
            $refund_param["err_msg"] = "call err:" . $httpClient->getResponseCode() . "," . $httpClient->getErrInfo();
            $refund_param["refund_time"] = time();
            return array("error" => 1, "type" => "fail", "msg" => "退款申请失败！如果重试多次还是失败请联系系统管理员。", "refund_param" => $refund_param);
        }
    }
}
