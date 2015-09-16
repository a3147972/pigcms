<?php

class store_image
{
    public function get_image_by_path($path)
    {
        if ($path) {
            $image_tmp = explode(",", $path);
            $return = C("config.site_url") . "/upload/store/" . $image_tmp[0] . "/" . $image_tmp[1];
            return $return;
        }
        else {
            return false;
        }
    }

    public function get_allImage_by_path($path)
    {
        if ($path) {
            $tmp_pic_arr = explode(";", $path);

            foreach ($tmp_pic_arr as $key => $value ) {
                $image_tmp = explode(",", $value);
                $return[$key] = C("config.site_url") . "/upload/store/" . $image_tmp[0] . "/" . $image_tmp[1];
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
            unlink("./upload/store/" . $image_tmp[0] . "/" . $image_tmp[1]);
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
