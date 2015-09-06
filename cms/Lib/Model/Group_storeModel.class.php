<?php

class Group_storeModel extends Model
{
    public function get_storelist_by_groupId($group_id)
    {
        $store_list = D("")->table(array(C("DB_PREFIX") . "group_store" => "gc", 
            C("DB_PREFIX") . "merchant_store" => "mc", 
            C("DB_PREFIX") . "area" => "a"))->where("`gc`.`group_id`='$group_id' AND`gc`.`store_id`=`mc`.`store_id` AND `gc`.`area_id`=`a`.`area_id`")->order("`mc`.`store_id` ASC")->select();
        return $store_list;
    }
}


?>
