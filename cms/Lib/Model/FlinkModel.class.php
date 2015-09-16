<?php

class FlinkModel extends Model
{
    public function get_flink_list($limit)
    {
        $condition_flink["status"] = 1;
        return $this->field(true)->where($condition_flink)->order("`sort` DESC,`id` ASC")->select();
    }
}


?>
