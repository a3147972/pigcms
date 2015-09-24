<?php

class User_adressModel extends Model
{
    public function get_adress_list($uid)
    {
        $condition_user_adress["uid"] = $uid;
        $user_adress_list = $this->field(true)->where($condition_user_adress)->order("`default` DESC,`adress_id` ASC")->select();

        foreach ($user_adress_list as $key => $value ) {
            $province = D("Area")->get_area_by_areaId($value["province"], false);
            $user_adress_list[$key]["province_txt"] = $province["area_name"];
            $city = D("Area")->get_area_by_areaId($value["city"], false);
            $user_adress_list[$key]["city_txt"] = $city["area_name"];
            $area = D("Area")->get_area_by_areaId($value["area"], false);
            $user_adress_list[$key]["area_txt"] = $area["area_name"];
        }

        return $user_adress_list;
    }

    public function set_default($uid, $adress_id)
    {
        $condition_default_user_adress["uid"] = $uid;
        $this->where($condition_default_user_adress)->setField("default", "0");
        $condition_user_adress["adress_id"] = $adress_id;
        $condition_user_adress["uid"] = $uid;
        return $this->where($condition_user_adress)->setField("default", "1");
    }

    public function post_form_save($uid)
    {
        if ($_POST["adress_id"]) {
            $condition_user_adress["adress_id"] = $_POST["adress_id"];
            $condition_user_adress["uid"] = $uid;
            unset($_POST["adress_id"]);
 
            if (!empty($_POST["default"])) { //反转
                $condition_default_user_adress["uid"] = $uid;
                $this->where($condition_default_user_adress)->setField("default", "0");
            }
            else {
                $_POST["default"] = 0;
            }

            return $this->where($condition_user_adress)->data($_POST)->save();
        }
        else {
            $_POST["uid"] = $uid;

            if (!empty($_POST["default"])) { //反转   
                $condition_default_user_adress["uid"] = $uid;
                $this->where($condition_default_user_adress)->setField("default", "0");
            }
            else {
                $_POST["default"] = 0;
            }

            return $this->data($_POST)->add();
        }
    }

    public function delete_adress($uid, $adress_id)
    {
        $condition_user_adress["uid"] = $uid;
        $condition_user_adress["adress_id"] = $adress_id;
        return $this->where($condition_user_adress)->delete();
    }

    public function get_adress($uid, $adress_id)
    {
        $condition_user_adress["uid"] = $uid;
        $condition_user_adress["adress_id"] = $adress_id;
        return $this->field(true)->where($condition_user_adress)->find();
    }

    public function get_one_adress($uid, $adress_id)
    {
        $condition_user_adress["uid"] = $uid;

        if (!empty($adress_id)) {
            $condition_user_adress["adress_id"] = $adress_id;
        }

        $user_adress = $this->field(true)->where($condition_user_adress)->order("`default` DESC,`adress_id` ASC")->find();
        $province = D("Area")->get_area_by_areaId($user_adress["province"], false);
        $user_adress["province_txt"] = $province["area_name"];
        $city = D("Area")->get_area_by_areaId($user_adress["city"], false);
        $user_adress["city_txt"] = $city["area_name"];
        $area = D("Area")->get_area_by_areaId($user_adress["area"], false);
        $user_adress["area_txt"] = $area["area_name"];
        return $user_adress;
    }
}


?>
