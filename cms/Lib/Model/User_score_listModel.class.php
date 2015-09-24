<?php

class User_score_listModel extends Model
{
    public function add_row($uid, $type, $score, $msg, $record_ip)
    {
        $data_user_score_list["uid"] = $uid;
        $data_user_score_list["type"] = $type;
        $data_user_score_list["score"] = $score;
        $data_user_score_list["desc"] = $msg;
        $data_user_score_list["time"] = $_SERVER["REQUEST_TIME"];

        if ($record_ip) {
            $data_user_score_list["ip"] = get_client_ip(1);
        }

        if ($this->data($data_user_score_list)->add()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function get_list($uid)
    {
        $condition_user_score_list["uid"] = $uid;
        import("@.ORG.user_page");
        $count = $this->where($condition_user_score_list)->count();
        $p = new Page($count, 10);
        $return["score_list"] = $this->field(true)->where($condition_user_score_list)->order("`time` DESC")->limit($p->firstRow . ",10")->select();
        $return["pagebar"] = $p->show();
        return $return;
    }
}


?>
