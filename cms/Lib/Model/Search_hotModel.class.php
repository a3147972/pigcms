<?php

class Search_hotModel extends Model
{
    public function get_list($limit, $type = 0, $is_wap = 0)
    {
        if ($is_wap) {
            $condition_hot_list["url"] = "";
        }

        if ($type != -1) {
            $condition_hot_list["type"] = $type;
        }

        $search_hot_list = $this->field(true)->order("`sort` DESC,`id` ASC")->where($condition_hot_list)->limit($limit)->select();
       
        foreach ($search_hot_list as $key => $value ) {
            if (empty($value["url"])) {
                if ($is_wap) {
                    if ($value["type"] == 0) {
                        $search_hot_list[$key]["url"] = U("Search/group", array("w" => urlencode($value["name"])));
                    }
                    else {
                        $search_hot_list[$key]["url"] = U("Search/meal", array("w" => urlencode($value["name"])));
                    }
                }
                else if ($value["type"] == 0) {
                    $search_hot_list[$key]["url"] = U("Group/Search/index", array("w" => urlencode($value["name"])));
                }
                else {
                    $search_hot_list[$key]["url"] = U("Meal/Search/index", array("w" => urlencode($value["name"])));
                }
            }
        }

        return $search_hot_list;
    }
}


?>
