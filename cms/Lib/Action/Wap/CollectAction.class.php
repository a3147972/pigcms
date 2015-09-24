<?php

class CollectAction extends BaseAction
{
    public function collect()
    {
        if (empty($this->user_session)) {
            $this->error("请先进行登录！");
        }

        if (!in_array($_POST["type"], array("group_detail", "group_shop"))) {
            $this->error("参数错误！请重试。");
        }

        $database_user_collect = D("User_collect");

        if ($_POST["action"] == "add") {
            $data_user_collect["type"] = $_POST["type"];
            $data_user_collect["id"] = $_POST["id"];
            $data_user_collect["uid"] = $this->user_session["uid"];

            if ($database_user_collect->field("collect_id")->where($data_user_collect)->find()) {
                $this->error("已收藏过");
            }

            if ($database_user_collect->data($data_user_collect)->add()) {
                if ($_POST["type"] == "group_detail") {
                    $condition_group["group_id"] = $_POST["id"];
                    D("Group")->where($condition_group)->setInc("collect_count");
                }

                $this->success("收藏成功");
            }
            else {
                $this->error("收藏失败！请重试");
            }
        }
        else if ($_POST["action"] == "del") {
            $condition_user_collect["type"] = $_POST["type"];
            $condition_user_collect["id"] = $_POST["id"];
            $condition_user_collect["uid"] = $this->user_session["uid"];

            if ($database_user_collect->where($condition_user_collect)->delete()) {
                if ($_POST["type"] == "group_detail") {
                    $condition_group["group_id"] = $_POST["id"];
                    D("Group")->where($condition_group)->setDec("collect_count");
                }

                $this->success("取消收藏成功");
            }
            else {
                $this->error("取消收藏失败！请重试");
            }
        }
        else {
            $this->error("您要做什么？");
        }
    }
}


?>
