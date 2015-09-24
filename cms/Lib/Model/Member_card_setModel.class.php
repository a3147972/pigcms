<?php

class Member_card_setModel extends Model
{
    public function get_all_card($uid)
    {
        $sql = "SELECT c.*, m.*, s.* FROM " . C("DB_PREFIX") . "member_card_create AS c INNER JOIN " . C("DB_PREFIX") . "member_card_set AS s ON c.cardid=s.id INNER JOIN " . C("DB_PREFIX") . "merchant AS m ON s.token=m.mer_id  WHERE c.wecha_id='$uid'";
        $mod = new Model();
        $result = $mod->query($sql);

        if ($result) {
            return $result;
        }

        return false;
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
}


?>
