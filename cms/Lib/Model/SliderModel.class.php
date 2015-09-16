<?php

class SliderModel extends Model
{
    public function get_slider_by_key($cat_key, $limit)
    {
        $database_slider_category = D("Slider_category");
        $condition_slider_category["cat_key"] = $cat_key;
        $now_slider_category = $database_slider_category->field("`cat_id`")->where($condition_slider_category)->find();
        
        if ($now_slider_category) {
            
            $condition_slider["cat_id"] = $now_slider_category["cat_id"];
            $condition_slider["status"] = "1";
            $slidr_list = $this->field(true)->where($condition_slider)->order("`sort` DESC,`id` ASC")->limit($limit)->select();

            foreach ($slidr_list as $key => $value ) {
                $slidr_list[$key]["pic"] = C("config.site_url") . "/upload/slider/" . $value["pic"];
            }
            
            return $slidr_list;
        }
        else {
            return false;
        }
    }
}


?>
