<?php

class MapAction extends BaseAction
{
    public function frame_map()
    {
        $long_lat = $_GET["long_lat"];

        if (empty($long_lat)) { //反转
            $long_lat = "110.418183,21.202745"; //坐标修改为湛江
        }

        $this->assign("long_lat", $long_lat);
        $this->display();
    }
}


?>
