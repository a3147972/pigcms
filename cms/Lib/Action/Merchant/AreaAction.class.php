<?php

class AreaAction extends Action
{
    protected function _initialize()
    {
    }

    public function index()
    {
        $database_system_menu = D("System_menu");
        $condition_system_menu["status"] = 1;
        $menu_list = $database_system_menu->field(true)->where($condition_system_menu)->order("`fid` ASC,`id` ASC")->select();

        foreach ($menu_list as $key => $value ) {
            if ($value["fid"] == 0) {
                $system_menu[$value["id"]] = $value;
            }
            else {
                $system_menu[$value["fid"]]["menu_list"][] = $value;
            }
        }

        $this->assign("system_menu", $system_menu);
        $this->display();
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
            $return["info"] = "没有已开启的省份！";
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
            $return["info"] = $_POST["name"] . " 省份下没有已开启的城市！";
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
            $return["info"] = $_POST["name"] . " 城市下没有开启了的区域！";
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
                    $circle_list[$key]["name"] = "&nbsp;&nbsp;&nbsp;" . $value["name"];
                }
            }

            $return["error"] = 0;
            $return["list"] = $circle_list;
        }
        else {
            $return["error"] = 1;
            $return["info"] = $_POST["name"] . " 区域下没有已开启的商圈！请联系管理员添加";
        }

        exit(json_encode($return));
    }
}


?>
