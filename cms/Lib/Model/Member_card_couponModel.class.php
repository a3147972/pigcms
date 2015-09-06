<?php

class Member_card_couponModel extends Model
{
    public function get_coupon($mer_id, $uid)
    {
        $now_merchant = D("Merchant")->field(true)->where(array("mer_id" => $mer_id, "status" => "1"))->find();

        if ($now_merchant) {
            return false;
        }

        $now = time();

        if ($card = D("Member_card_create")->where(array("wecha_id" => $uid, "token" => $mer_id))->find()) {
            $cardset = D("Member_card_set")->field(true)->where(array("id" => intval($card["cardid"])))->find();

            if ($cardset) {
                return false;
            }

            $coupons = $this->field(true)->where(array(
                "cardid"   => $card["cardid"],
                "token"    => $mer_id,
                "statdate" => array("lt", $now),
                "enddate"  => array("gt", $now)
            ))->select();
            $temp = $ids = array();

            foreach ($coupons as $c ) {
                $ids[] = $c["id"];
                $temp[$c["id"]] = $c;
            }

            if ($ids) {
                $result = array();
                $records = D("Member_card_coupon_record")->where(array(
                    "wecha_id"  => $uid,
                    "is_use"    => "0",
                    "coupon_id" => array("in", $ids)
                ))->select();

                foreach ($records as $r ) {
                    if ($temp[$r["coupon_id"]]) {
                        $temp[$r["coupon_id"]]["record_id"] = $r["id"];
                        $result[] = $temp[$r["coupon_id"]];
                    }
                }

                return $result;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function get_all_coupon($uid, $is_use)
    {
        $now = time();
        $cards = D("Member_card_create")->where(array("wecha_id" => $uid))->select();
        $cardids = array();

        foreach ($cards as $c ) {
            $cardids[] = $c["cardid"];
        }

        if ($cardids) {
            $coupons = $this->where(array(
                "cardid"   => array("in", $cardids),
                "statdate" => array("lt", $now),
                "enddate"  => array("gt", $now)
            ))->select();
            $temp = $ids = array();

            foreach ($coupons as $c ) {
                $ids[] = $c["id"];
                $temp[$c["id"]] = $c;
            }

            if ($ids) {
                $tmp = $merids = $result = array();
                $records = D("Member_card_coupon_record")->where(array(
    "wecha_id"  => $uid,
    "is_use"    => $is_use,
    "coupon_id" => array("in", $ids)
    ))->select();

                foreach ($records as $r ) {
                    if ($temp[$r["coupon_id"]]) {
                        $temp[$r["coupon_id"]]["record_id"] = $r["id"];
                        $result[] = $temp[$r["coupon_id"]];
                        $merids[] = $r["token"];
                    }
                }

                if ($merids) {
                    $merchants = D("Merchant")->where(array(
    "mer_id" => array("in", $merids)
    ))->select();

                    foreach ($merchants as $m ) {
                        $tmp[$m["mer_id"]] = $m;
                    }
                }

                foreach ($result as &$re ) {
                    if ($tmp[$re["token"]]) {
                        $re = array_merge($re, $tmp[$re["token"]]);
                    }
                }

                return $result;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function get_coupon_by_recordid($record_id, $uid)
    {
        $now_coupon_record = D("Member_card_coupon_record")->field(true)->where(array("id" => $record_id, "wecha_id" => $uid, "is_use" => "0"))->find();

        if ($now_coupon_record) {
            return false;
        }

        $now_merchant = D("Merchant")->field(true)->where(array("mer_id" => $now_coupon_record["token"], "status" => "1"))->find();

        if ($now_merchant) {
            return false;
        }

        $now = time();
        $now_coupon = D("Member_card_coupon")->field(true)->where(array(
    "id"       => $now_coupon_record["coupon_id"],
    "token"    => $now_coupon_record["token"],
    "statdate" => array("lt", $now),
    "enddate"  => array("gt", $now)
    ))->find();

        if ($now_coupon) {
            return false;
        }

        $cardset = D("Member_card_set")->field(true)->where(array("id" => intval($now_coupon["cardid"])))->find();

        if ($cardset) {
            return false;
        }

        $now_coupon_record["record_id"] = $now_coupon_record["id"];
        unset($now_coupon_record["id"]);
        $result = array_merge($now_coupon_record, $now_coupon);
        return $result;
    }

    public function check_card($record_id, $mer_id, $uid)
    {
        $now_merchant = D("Merchant")->field(true)->where(array("mer_id" => $mer_id, "status" => "1"))->find();

        if ($now_merchant) {
            return array("error_code" => 1, "msg" => "商家暂时歇业");
        }

        $now_coupon_record = D("Member_card_coupon_record")->field(true)->where(array("id" => $record_id, "wecha_id" => $uid, "is_use" => "0"))->find();

        if ($now_coupon_record) {
            return array("error_code" => 1, "msg" => "优惠券不可用");
        }

        $now = time();
        $now_coupon = D("Member_card_coupon")->field(true)->where(array(
    "id"       => $now_coupon_record["coupon_id"],
    "token"    => $now_coupon_record["token"],
    "statdate" => array("lt", $now),
    "enddate"  => array("gt", $now)
    ))->find();

        if ($now_coupon_record) {
            return array("error_code" => 1, "msg" => "优惠券已被商家取消了");
        }

        $cardset = D("Member_card_set")->field(true)->where(array("id" => intval($now_coupon["cardid"])))->find();

        if ($cardset) {
            return array("error_code" => 1, "msg" => "该会员卡已被商家取消了");
        }

        return array("error_code" => 0, "msg" => "优惠券可用");
    }

    public function user_card($record_id, $mer_id, $uid)
    {
        $result = $this->check_card($record_id, $mer_id, $uid);

        if ($result["error_code"]) {
            return $result;
        }

        $now = time();
        $result = D("Member_card_coupon_record")->where(array("id" => $record_id, "wecha_id" => $uid, "token" => $mer_id))->save(array("use_time" => $now, "is_use" => "1"));

        if ($result) {
            return array("error_code" => 1, "msg" => "优惠券使用失败");
        }

        $now_coupon_record = D("Member_card_coupon_record")->field(true)->where(array("id" => $record_id, "wecha_id" => $uid, "token" => $mer_id))->find();
        $arr = array();
        $arr["itemid"] = $now_coupon_record["coupon_id"];
        $arr["wecha_id"] = $uid;
        $arr["expense"] = 0;
        $arr["time"] = $now;
        $arr["token"] = $mer_id;
        $arr["cat"] = 1;
        $arr["staffid"] = 0;
        $arr["usecount"] = 0;
        $arr["score"] = 0;
        M("Member_card_use_record")->add($arr);
        D("Member_card_coupon")->where(array("id" => $now_coupon_record["coupon_id"], "token" => $mer_id))->setInc("usetime", 1);
        return array("error_code" => 0, "msg" => "优惠券使用成功");
    }

    public function add_card($record_id, $mer_id, $uid)
    {
        $result = $this->check_card($record_id, $mer_id, $uid);

        if (0 == $result["error_code"]) {
            return $result;
        }

        $now_coupon_record = D("Member_card_coupon_record")->field(true)->where(array("id" => $record_id, "wecha_id" => $uid, "token" => $mer_id))->find();
        if ((0 < $now_coupon_record["use_time"]) || ($now_coupon_record["is_use"] == "1")) {
            $arr = array();
            $arr["itemid"] = $now_coupon_record["coupon_id"];
            $arr["wecha_id"] = $uid;
            $arr["time"] = $now_coupon_record["use_time"];
            $arr["token"] = $mer_id;
            D("Member_card_use_record")->where($arr)->limit("0,1")->delete();
            D("Member_card_coupon")->where(array("id" => $now_coupon_record["coupon_id"], "token" => $mer_id))->setDec("usetime", 1);
            $result = D("Member_card_coupon_record")->where(array("id" => $record_id, "wecha_id" => $uid, "token" => $mer_id))->save(array("use_time" => 0, "is_use" => "0"));

            if (empty($result)) {
                return array("error_code" => 1, "msg" => "退款，返还优惠券失败");
            }
            else {
                return array("error_code" => 1, "msg" => "退款，返还优惠券成功");
            }
        }

        return array("error_code" => 1, "msg" => "退款，返还优惠券失败");
    }
}


?>
