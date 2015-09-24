<?php

class Meal_listAction extends BaseAction
{
    public function index()
    {
        $area_url = ($_GET["area_url"] && $_GET["area_url"] ? htmlspecialchars($_GET["area_url"]) : "all");
        $cat_url = ($_GET["cat_url"] && $_GET["cat_url"] ? htmlspecialchars($_GET["cat_url"]) : "all");
        $all_area_list = D("Area")->get_all_area_list();
        $this->assign("all_area_list", $all_area_list);
        $this->assign("now_area_url", $area_url);
        $this->assign("now_category_url", $cat_url);
        $circle_id = 0;

        if ($area_url != "all") {
            $tmp_area = D("Area")->get_area_by_areaUrl($area_url);

            if (empty($tmp_area)) {
                $this->error("当前区域不存在！");
            }

            $this->assign("now_area", $tmp_area);

            if ($tmp_area["area_type"] == 3) {
                $now_area = $tmp_area;
            }
            else {
                $now_circle = $tmp_area;
                $this->assign("now_circle", $now_circle);
                $now_area = D("Area")->get_area_by_areaId($tmp_area["area_pid"], true, $cat_url);

                if (empty($tmp_area)) {
                    $this->error("当前区域不存在！");
                }

                $circle_url = $now_circle["area_url"];
                $circle_id = $now_circle["area_id"];
                $area_url = $now_area["area_url"];
            }

            $this->assign("top_area", $now_area);
            $area_id = $now_area["area_id"];
        }
        else {
            $area_id = 0;
        }

        $sort_id = (isset($_GET["sort_id"]) ? $_GET["sort_id"] : "juli");
        $long_lat = array("lat" => 0, "long" => 0);
        $_SESSION["openid"] && ($long_lat = D("User_long_lat")->field("long,lat")->where(array("open_id" => $_SESSION["openid"]))->find());
        if (0 == $long_lat["long"] || 0 == $long_lat["lat"]) {
            $sort_id = ($sort_id == "juli" ? "store_id" : $sort_id);
            $sort_array = array(
                array("sort_id" => "store_id", "sort_value" => "默认排序"),
                array("sort_id" => "hot", "sort_value" => "人气最高"),
                array("sort_id" => "price-asc", "sort_value" => "价格最低"),
                array("sort_id" => "price-desc", "sort_value" => "价格最高"),
                array("sort_id" => "time", "sort_value" => "最近开业")
                );
        }
        else {
            import("@.ORG.longlat");
            $longlat_class = new longlat();
            $location2 = $longlat_class->gpsToBaidu($long_lat["lat"], $long_lat["long"]);
            $long_lat["lat"] = $location2["lat"];
            $long_lat["long"] = $location2["lng"];
            $sort_array = array(
                array("sort_id" => "juli", "sort_value" => "离我最近"),
                array("sort_id" => "hot", "sort_value" => "人气最高"),
                array("sort_id" => "price-asc", "sort_value" => "价格最低"),
                array("sort_id" => "price-desc", "sort_value" => "价格最高"),
                array("sort_id" => "time", "sort_value" => "最近开业")
                );
        }

        foreach ($sort_array as $key => $value ) {
            if ($sort_id == $value["sort_id"]) {
                $now_sort_array = $value;
                break;
            }
        }

        $this->assign("sort_array", $sort_array);
        $this->assign("now_sort_array", $now_sort_array);
        $cat_id = 0;

        if ($cat_url != "all") {
            $now_category = D("Meal_store_category")->get_category_by_catUrl($cat_url);

            if (empty($now_category)) {
                $this->error("此分类不存在！");
            }

            $this->assign("now_category", $now_category);
            $cat_id = $now_category["cat_id"];
        }
        $arr = D("Merchant_store")->get_list_by_option($area_id, $circle_id, $sort_id, true, $long_lat["lat"], $long_lat["long"], $cat_id);
        $category_list = D("Meal_store_category")->where("cat_status = '1'")->order('cat_sort DESC')->select();
        $this->assign("category_list", $category_list);
        $this->assign($arr);//- daiding 
        
        $this->display();
    }

    public function around()
    {
        $long_lat["lat"] = $_COOKIE["meal_around_lat"];
        $long_lat["long"] = $_COOKIE["meal_around_long"];
        if ($long_lat["lat"] || $long_lat["long"]) {
            $_SESSION["openid"] && ($long_lat = D("User_long_lat")->field("long,lat")->where(array("open_id" => $_SESSION["openid"]))->find());
        }

        if ($long_lat["lat"] || $long_lat["long"]) {
            redirect(U("Meal_list/around_adress"));
        }

        $this->assign("lat_long", $long_lat["lat"] . "," . $long_lat["long"]);
        $around_range = $this->config["group_around_range"];
        $stores = D("Merchant_store")->field("*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$long_lat["lat"]}*PI()/180-`lat`*PI()/180)/2),2)+COS({$long_lat["lat"]}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$long_lat["long"]}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_meal`='1' AND ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$long_lat["lat"]}*PI()/180-`lat`*PI()/180)/2),2)+COS({$long_lat["lat"]}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$long_lat["long"]}*PI()/180-`long`*PI()/180)/2),2)))*1000) < '$around_range'")->select();
        $store_ids = array();
        $ids = array();
        $temp_store = array();
        $store_image_class = new store_image();

        foreach ($stores as $store ) {
            if (!in_array($store["circle_id"], $ids)) {
                $ids[] = $store["circle_id"];
            }

            if (!in_array($store["store_id"], $store_ids)) {
                $store_ids[] = $store["store_id"];
            }

            $images = $store_image_class->get_allImage_by_path($store["pic_info"]);
            $store["image"] = ($images ? array_shift($images) : array());
            $temp_store[] = $store;
        }

        $temp = array();

        if ($ids) {
            $areas = M("Area")->where(array(
    "area_id" => array("in", $ids)
    ))->select();

            foreach ($areas as $a ) {
                $temp[$a["area_id"]] = $a;
            }
        }

        $t_store_meals = array();
        $store_meals = D("Merchant_store_meal")->field(true)->where(array(
            "store_id" => array("in", $store_ids)
        ))->select();

        foreach ($store_meals as $meal ) {
            $t_store_meals[$meal["store_id"]] = $meal;
        }

        foreach ($temp_store as &$s ) {
            if ($t_store_meals[$s["store_id"]]) {
                $s = array_merge($s, $t_store_meals[$s["store_id"]]);
            }

            $s["area_name"] = ($temp[$s["circle_id"]] ? $temp[$s["circle_id"]]["area_name"] : "");
        }

        $this->assign("group_list", $temp_store);
        $this->display();
    }

    public function around_adress()
    {
        if (isset($_GET["long"]) && isset($_GET["lat"])) {
            $map_center = "new BMap.Point(" . $_GET["long"] . "," . $_GET["lat"] . ")";
        }
        else {
            import("ORG.Net.IpLocation");
            $IpLocation = new IpLocation();
            $last_location = $IpLocation->getlocation();
            $map_center = "\"" . iconv("GBK", "UTF-8", $last_location["country"]) . "\"";
        }

        $this->assign("map_center", $map_center);
        $this->display();
    }
}


?>
