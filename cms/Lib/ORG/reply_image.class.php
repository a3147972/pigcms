<?php

class reply_image
{
    public function get_image_by_path($path, $type, $image_type)
    {
        if ($path) {
            $image_tmp = explode(",", $path);

            if ($image_type == "-1") {
                $return["image"] = C("config.site_url") . "/upload/reply/" . $type . "/" . $image_tmp[0] . "/" . $image_tmp[1];
                $return["m_image"] = C("config.site_url") . "/upload/reply/" . $type . "/" . $image_tmp[0] . "/m_" . $image_tmp[1];
                $return["s_image"] = C("config.site_url") . "/upload/reply/" . $type . "/" . $image_tmp[0] . "/s_" . $image_tmp[1];
            }
            else {
                $return = C("config.site_url") . "/upload/reply/" . $type . "/" . $image_tmp[0] . "/" . $image_type . "_" . $image_tmp[1];
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

                if ($image_type == "-1") {
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

    public function get_image_by_id($order_id, $order_type)
    {
        $database_reply_pic = D("Reply_pic");
        $condition_reply_pic["order_id"] = $order_id;
        $condition_reply_pic["order_type"] = $order_type;
        $pic_list = $database_reply_pic->field("`pic`")->where($condition_reply_pic)->order("`pigcms_id` ASC")->select();

        if ($order_type == 0) {
            $file_path = "group";
        }
        else {
            $file_path = "meal";
        }

        $new_pic_list = array();

        foreach ($pic_list as $key => $value ) {
            array_push($new_pic_list, $this->get_image_by_path($value["pic"], $file_path));
        }

        return $new_pic_list;
    }

    public function get_image_by_ids($pigcms_ids, $order_type)
    {
        $database_reply_pic = D("Reply_pic");
        $condition_reply_pic["pigcms_id"] = array("in", $pigcms_ids);
        $pic_list = $database_reply_pic->field("`pic`")->where($condition_reply_pic)->order("`pigcms_id` ASC")->select();

        if ($order_type == 0) {
            $file_path = "group";
        }
        else {
            $file_path = "meal";
        }

        $new_pic_list = array();

        foreach ($pic_list as $key => $value ) {
            array_push($new_pic_list, $this->get_image_by_path($value["pic"], $file_path));
        }

        return $new_pic_list;
    }

    public function del_image_by_path($path, $type)
    {
        if ($path) {
            $image_tmp = explode(",", $path);
            unlink("./upload/reply/" . $type . "/" . $image_tmp[0] . "/" . $image_tmp[1]);
            unlink("./upload/reply/" . $type . "/" . $image_tmp[0] . "/m_" . $image_tmp[1]);
            unlink("./upload/reply/" . $type . "/" . $image_tmp[0] . "/s_" . $image_tmp[1]);
            return true;
        }
        else {
            return false;
        }
    }

    public function del_image_by_id($order_id, $order_type)
    {
        $database_reply_pic = D("Reply_pic");
        $condition_reply_pic["order_id"] = $order_id;
        $condition_reply_pic["order_type"] = $order_type;
        $pic_list = $database_reply_pic->field("`pic`")->where($condition_reply_pic)->order("`pigcms_id` ASC")->select();

        if ($order_type == 0) {
            $file_path = "group";
        }
        else {
            $file_path = "meal";
        }

        $new_pic_list = array();

        foreach ($pic_list as $value ) {
            $image_tmp = explode(",", $value["pic"]);
            unlink("./upload/reply/" . $file_path . "/" . $image_tmp[0] . "/" . $image_tmp[1]);
            unlink("./upload/reply/" . $file_path . "/" . $image_tmp[0] . "/m_" . $image_tmp[1]);
            unlink("./upload/reply/" . $file_path . "/" . $image_tmp[0] . "/s_" . $image_tmp[1]);
        }
    }
}


?>
