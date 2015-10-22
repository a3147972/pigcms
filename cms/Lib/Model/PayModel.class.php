<?php

class PayModel extends Model
{
    public function get_pay_name($pay_type, $is_mobile_pay)
    {
        switch ($pay_type) {
        case "alipay":
            $pay_type_txt = "支付宝";
            break;

        case "tenpay":
            $pay_type_txt = "财付通";
            break;

        case "yeepay":
            $pay_type_txt = "易宝支付";
            break;

        case "allinpay":
            $pay_type_txt = "通联支付";
            break;

        case "chinabank":
            $pay_type_txt = "网银在线";
            break;

        case "weixin":
            $pay_type_txt = "微信支付";
            break;

        case "offline":
            $pay_type_txt = "货到付款";
            break;

        default:
            $pay_type_txt = "余额支付";
        }

        if ($is_mobile_pay) {
            $pay_type_txt .= "(移动端)";
        }

        return $pay_type_txt;
    }
}


?>
