<?php

class AreaAction extends BaseAction
{
    public function index()
    {
        if ($_GET["type"] != 4) {
            $_GET["type"] = 3;
        }

        $_GET["pid"] = (isset($_GET["pid"]) ? $_GET["pid"] : $this->config["now_city"]);
        $database_area = D("Area");
        $condition_area["area_pid"] = $_GET["pid"];
        $condition_area["area_type"] = $_GET["type"];

        if ($_GET["type"] == 4) {
            $order = "`area_sort` DESC,`is_open` DESC,`first_pinyin` ASC";
        }
        else {
            $order = "`area_sort` DESC,`is_open` DESC,`area_id` ASC";
        }

        $area_list = $database_area->field(true)->where($condition_area)->order($order)->select();
        $this->assign("area_list", $area_list);

        switch ($_GET["type"]) {
        case 1:
            $now_type_str = "省份";
            break;

        case 2:
            $now_type_str = "城市";
            break;

        case 3:
            $now_type_str = "区域";
            break;

        default:
            $now_type_str = "商圈";
        }

        $this->assign("now_type_str", $now_type_str);
        $this->display();
    }

    public function add()
    {
        $this->assign("bg_color", "#F3F3F3");
        $this->display();
    }

    public function modify()
    {
        if (IS_POST) {
            $database_area = D("Area");
            $condition_area["area_url"] = $_POST["area_url"];

            if ($database_area->where($condition_area)->find()) {
                $this->error("数据库中已存在相同的网址标识，请更换。");
            }

            if ($database_area->data($_POST)->add()) {
                $this->success("添加成功！");
            }
            else {
                $this->error("添加失败！请重试~");
            }
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }

    public function edit()
    {
        $this->assign("bg_color", "#F3F3F3");
        $database_area = D("Area");
        $condition_area["area_id"] = $_GET["area_id"];
        $now_area = $database_area->field(true)->where($condition_area)->find();

        if (empty($now_area)) {
            $this->frame_error_tips("数据库中没有查询到该信息！");
        }

        $this->assign("now_area", $now_area);
        $this->display();
    }

    public function amend()
    {
        if (IS_POST) {
            $database_area = D("Area");
            $condition_area["area_url"] = $_POST["area_url"];

            if ($database_area->data($_POST)->save()) {
                $this->success("修改成功！");
            }
            else {
                $this->error("修改失败！请重试~");
            }
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }

    public function del()
    {
        if (IS_POST) {
            $return = $this->recursive_del($_POST["area_id"]);
            $this->success("删除成功！");
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }

    protected function recursive_del($area_id)
    {
        $database_area = D("Area");
        $condition_area["area_pid"] = $area_id;
        $now_area = $database_area->field("`area_id`")->where($condition_area)->select();

        if (is_array($now_area)) {
            foreach ($now_area as $key => $value ) {
                $this->recursive_del($value["area_id"]);
            }
        }

        $condition_del_area["area_id"] = $area_id;
        $database_area->where($condition_del_area)->delete();
    }

    public function ajax_province()
    {
        $database_area = D("Area");
        $condition_area["area_type"] = 1;
        $condition_area["is_open"] = 1;
        $province_list = $database_area->field("`area_id` `id`,`area_name` `name`")->where($condition_area)->order("`area_sort` DESC,`area_id` ASC")->select();

        if (count($province_list) == 1) {
            $return["error"] = 2;
            $return["id"] = $province_list[0]["id"];
            $return["name"] = $province_list[0]["name"];
        }
        else if (!empty($province_list)) {
            $return["error"] = 0;
            $return["list"] = $province_list;
        }
        else {
            $return["error"] = 1;
            $return["info"] = "没有开启了的省份！请先开启。";
        }

        exit(json_encode($return));
    }

    public function ajax_city()
    {
        $database_area = D("Area");
        $condition_area["area_pid"] = intval($_POST["id"]);
        $condition_area["is_open"] = 1;
        $city_list = $database_area->field("`area_id` `id`,`area_name` `name`")->where($condition_area)->order("`area_sort` DESC,`area_id` ASC")->select();
        if ((count($city_list) == 1) && !empty($_POST["type"])) {
            $return["error"] = 2;
            $return["id"] = $city_list[0]["id"];
            $return["name"] = $city_list[0]["name"];
        }
        else if (!empty($city_list)) {
            $return["error"] = 0;
            $return["list"] = $city_list;
        }
        else {
            $return["error"] = 1;
            $return["info"] = "［ <b>" . $_POST["name"] . "</b> ］ 省份下没有已开启的城市！请先开启城市或删除此省份";
        }

        exit(json_encode($return));
    }

    public function ajax_area()
    {
        $database_area = D("Area");
        $condition_area["area_pid"] = intval($_POST["id"]);
        $condition_area["is_open"] = 1;
        $area_list = $database_area->field("`area_id` `id`,`area_name` `name`")->where($condition_area)->order("`area_sort` DESC,`area_id` ASC")->select();
        if (!empty($area_list)) {
            $return["error"] = 0;
            $return["list"] = $area_list;
        }
        else {
            $return["error"] = 1;
            $return["info"] = "［ <b>" . $_POST["name"] . "</b> ］ 城市下没有已开启的区域！请先开启区域或删除此城市";
        }

        exit(json_encode($return));
    }

    public function ajax_circle()
    {
        $database_area = D("Area");
        $condition_area["area_pid"] = intval($_POST["id"]);
        $condition_area["is_open"] = 1;
        $circle_list = $database_area->field("`area_id` `id`,`area_name` `name`,`first_pinyin`")->where($condition_area)->order("`area_sort` DESC,`first_pinyin` ASC")->select();
        
        if (!empty($circle_list)) {
            $tmp_list = array();

            foreach ($circle_list as $key => $value ) {
                if ($tmp_list[$value["first_pinyin"]]) {
                    $circle_list[$key]["name"] = $value["first_pinyin"] . ". " . $value["name"];
                    $tmp_list[$value["first_pinyin"]] = true;
                }
                else {
                    $circle_list[$key]["name"] = "&nbsp;&nbsp;&nbsp;&nbsp;" . $value["name"];
                }
            }

            $return["error"] = 0;
            $return["list"] = $circle_list;
        }
        else {
            $return["error"] = 1;
            $return["info"] = "［ <b>" . $_POST["name"] . "</b> ］ 区域下没有已开启的商圈！请先开启商圈或删除此区域";
        }

        exit(json_encode($return));
    }

    public function admin()
    {
        $area_id = ($_GET["area_id"] ? intval($_GET["area_id"]) : 0);
        $area = D("Area")->field(true)->where(array("area_id" => $area_id, "is_open" => 1))->find();

        if (empty($area)) {
            $this->error("不存在的区域或该区域没有被开通,请查证后重新操作~");
        }

        $admin = D("Admin")->field(true)->where(array("area_id" => $area_id))->select();
        $this->assign("admin", $admin);
        $this->display();
    }

    public function addadmin()
    {
        $id = ($_GET["id"] ? intval($_GET["id"]) : 0);
        $admin = D("Admin")->field(true)->where(array("id" => $id))->find();
        $this->assign("admin", $admin);
        $this->assign("bg_color", "#F3F3F3");
        $this->display();
    }

    public function saveAdmin()
    {
        if (IS_POST) {
            $database_area = D("Admin");
            $id = (isset($_POST["id"]) ? intval($_POST["id"]) : 0);
            $account = htmlspecialchars($_POST["account"]);

            if ($database_area->where("`id`<>'$id' AND `account`='$account'")->find()) {
                $this->error("数据库中已存在相同的账号，请更换。");
            }

            unset($_POST["id"]);
            $_POST["level"] = 1;

            if ($id) {
                if ($_POST["pwd"]) {
                    $_POST["pwd"] = md5($_POST["pwd"]);
                }
                else {
                    unset($_POST["pwd"]);
                }

                $database_area->where(array("id" => $id))->data($_POST)->save();
                $this->success("修改成功！");
            }
            else {
                if (empty($_POST["pwd"])) {//-- re
                    $this->error("密码不能为空~");
                }

                $_POST["pwd"] = md5($_POST["pwd"]);

                if ($database_area->data($_POST)->add()) {
                    $this->success("添加成功！");
                }
                else {
                    $this->error("添加失败！请重试~");
                }
            }
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }
}


?>
