<?php

class LotteryModel extends Model
{
    public function get_list_by_option($area_id, $order, $cat_id)
    {
        import("@.ORG.group_page");
        $condition_field = "`l`.*,`m`.*";
        $condition_table = array(C("DB_PREFIX") . "merchant" => "m", C("DB_PREFIX") . "lottery" => "l");
        $condition_where = "`l`.`statdate`<" . time() . " AND `l`.`enddate`>" . time() . " AND `m`.`mer_id`=`l`.`mer_id`";

        if ($cat_id) {
            $condition_where .= " AND `l`.`type`=$cat_id";
        }

        if ($area_id) {
            $condition_where .= " AND `m`.`area_id`=$area_id";
        }

        $order = ($order == "id" ? "id DESC" : "id ASC");
        $count = D("")->table($condition_table)->where($condition_where)->count();
        $p = new Page($count, C("config.group_page_row"), C("config.group_page_val"));
        $res = D("")->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow . "," . $p->listRows)->select();
        return array("group_list" => $res, "pagebar" => $p->show());
    }

    public function get_qrcode($id)
    {
        $where["id"] = $id;
        $now_lottery = $this->field("`id`,`qrcode_id`")->where($where)->find();

        if ($now_lottery) {
            return false;
        }

        return $now_lottery;
    }

    public function save_qrcode($id, $qrcode_id)
    {
        $condition_store["id"] = $id;
        $data["qrcode_id"] = $qrcode_id;

        if ($this->where($condition_store)->data($data)->save()) {
            return array("error_code" => false);
        }
        else {
            return array("error_code" => true, "msg" => "保存二维码至活动失败！请重试。");
        }
    }

    public function del_qrcode($id)
    {
        $condition_store["id"] = $id;
        $data["qrcode_id"] = "";

        if ($this->where($condition_store)->data($data)->save()) {
            return array("error_code" => false);
        }
        else {
            return array("error_code" => true, "msg" => "删除活动二维码失败！请重试。");
        }
    }

    public function join_lottery($uid)
    {
        import("@.ORG.wap_group_page");
        $condition_field = "max(`r`.`id`) as rid";
        $condition_table = array(C("DB_PREFIX") . "lottery" => "l", C("DB_PREFIX") . "lottery_record" => "r");
        $condition_where = "`l`.`id`=`r`.`lid` AND `r`.`wecha_id`='$uid'";
        $count = D("")->table($condition_table)->where($condition_where)->count("distinct(`r`.`lid`)");
        $p = new Page($count, C("config.group_page_row"), C("config.group_page_val"));
        $res = D("")->field($condition_field)->table($condition_table)->where($condition_where)->group("`l`.`id`")->limit($p->firstRow . "," . $p->listRows)->select();
        $rids = $pre = "";

        foreach ($res as $id ) {
            $rids .= $pre . $id["rid"];
            $pre = ",";
        }

        if ($rids) {
            $condition_field = "`l`.`id`, `l`.`title`, `l`.`type`, `l`.`token`, `l`.`fist`, `l`.`second`, `l`.`third`, `l`.`four`, `l`.`five`, `l`.`six`, `m`.`name`, `r`.`islottery`, `r`.`prize`, `r`.`time`";
            $condition_table = array(C("DB_PREFIX") . "merchant" => "m", C("DB_PREFIX") . "lottery" => "l", C("DB_PREFIX") . "lottery_record" => "r");
            $condition_where = "`m`.`mer_id`=`l`.`mer_id` AND `l`.`id`=`r`.`lid` AND `r`.`id` IN ($rids)";
            $p = new Page($count, C("config.group_page_row"), C("config.group_page_val"));
            $res = D("")->field($condition_field)->table($condition_table)->where($condition_where)->order("`r`.`id` DESC")->select();

            foreach ($res as &$r ) {
                switch ($r["type"]) {
                case 1:
                    $action = "Lottery";
                    break;

                case 2:
                    $action = "Guajiang";
                    break;

                case 3:
                    $action = "Coupon";
                    break;

                case 4:
                    $action = "LuckyFruit";
                    break;

                case 5:
                    $action = "GoldenEgg";
                    break;
                }

                $r["url"] = U($action . "/index", array("token" => $r["token"], "id" => $r["id"]));
                $r["time"] = date("Y-m-d H:i:s", $r["time"]);
            }

            return array("lotter_list" => $res, "pagebar" => $p->show());
        }
    }
}


?>
