<?php

class meal_image
{
    public function get_image_by_path($path, $site_url, $image_type)
    {
        if ($path) {
            $image_tmp = explode(",", $path);

            if ($image_type == "-1") {
                $return["image"] = $site_url . "/upload/meal/" . $image_tmp[0] . "/" . $image_tmp[1];
                $return["m_image"] = $site_url . "/upload/meal/" . $image_tmp[0] . "/m_" . $image_tmp[1];
                $return["s_image"] = $site_url . "/upload/meal/" . $image_tmp[0] . "/s_" . $image_tmp[1];
            }
            else {
                $return = $site_url . "/upload/meal/" . $image_tmp[0] . "/" . $image_type . "_" . $image_tmp[1];
            }

            return $return;
        }
        else {
            return false;
        }
    }

    public function get_image_by_id($id, $site_url, $image_type)
    {
        $database_meal = D("Meal");
        $condition_meal["meal_id"] = $id;
        $now_meal = $database_meal->field("`image`")->where($condition_meal)->find();
        return $this->get_image_by_path($now_meal["image"], $site_url, $image_type);
    }

    public function del_image_by_path($path)
    {
        if ($path) {
            $image_tmp = explode(",", $path);
            unlink("./upload/meal/" . $image_tmp[0] . "/" . $image_tmp[1]);
            unlink("./upload/meal/" . $image_tmp[0] . "/m_" . $image_tmp[1]);
            unlink("./upload/meal/" . $image_tmp[0] . "/s_" . $image_tmp[1]);
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
