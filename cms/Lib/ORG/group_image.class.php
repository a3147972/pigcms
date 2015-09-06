<?php

class group_image
{
    public function get_image_by_path($path, $image_type)
    {
        if (!empty($path)) {
            $image_tmp = explode(",", $path);

            if ($image_type == "-1") {
                $return["image"] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/" . $image_tmp[1];
                $return["m_image"] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/m_" . $image_tmp[1];
                $return["s_image"] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/s_" . $image_tmp[1];
            }
            else {
                $return = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/" . $image_type . "_" . $image_tmp[1];
            }
            return $return;
        }
        else {
            return false;
        }
    }

    public function get_allImage_by_path($path, $image_type)
    {
        if ($path) {
            $tmp_pic_arr = explode(";", $path);

            foreach ($tmp_pic_arr as $key => $value ) {
                $image_tmp = explode(",", $value);

                if ($image_type != "-1") {  //-- 修改了原来是==
                    $return[$key]["image"] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/" . $image_tmp[1];
                    $return[$key]["m_image"] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/m_" . $image_tmp[1];
                    $return[$key]["s_image"] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/s_" . $image_tmp[1];
                }
                else {
                    $return[$key] = C("config.site_url") . "/upload/group/" . $image_tmp[0] . "/" . $image_type . "_" . $image_tmp[1];
                }
            }

            return $return;
        }
        else {
            return false;
        }
    }

    public function get_image_by_id($id, $image_type)
    {
        $database_meal = D("Meal");
        $condition_meal["meal_id"] = $id;
        $now_meal = $database_meal->field("`image`")->where($condition_meal)->find();
        return $this->get_image_by_path($now_meal["image"], $image_type);
    }

    public function del_image_by_path($path)
    {
        if ($path) {
            $image_tmp = explode(",", $path);
            unlink("./upload/group/" . $image_tmp[0] . "/" . $image_tmp[1]);
            unlink("./upload/group/" . $image_tmp[0] . "/m_" . $image_tmp[1]);
            unlink("./upload/group/" . $image_tmp[0] . "/s_" . $image_tmp[1]);
            return true;
        }
        else {
            return false;
        }
    }

    public function del_image_by_id($id)
    {
        $database_meal = D("Meal");
        $condition_meal["meal_id"] = $id;
        $now_meal = $database_meal->field("`image`")->where($condition_meal)->find();
        return $this->del_image_by_path($now_meal["image"]);
    }
}


?>
