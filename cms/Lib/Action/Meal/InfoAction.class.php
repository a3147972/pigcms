<?php

class InfoAction extends BaseAction
{
    public function index()
    {
        if ($this->user_session) {
        }

        $index_right_adver = D("Adver")->get_adver_by_key("index_right", 3);
        $this->assign("index_right_adver", $index_right_adver);
        $web_index_slider = D("Slider")->get_slider_by_key("web_slider");
        $this->assign("web_index_slider", $web_index_slider);
        $all_category_list = D("Group_category")->get_category();
        $this->assign("all_category_list", $all_category_list);
        $store_id = intval($_GET["store_id"]);
        $store = D("Merchant_store")->where(array("store_id" => $store_id))->find();

        if (empty($store)) {
            $this->group_noexit_tips();
        }

        $store["office_time"] = unserialize($store["office_time"]);
        $pre = $str = "";

        foreach ($store["office_time"] as $time ) {
            $str = $pre . $time["open"] . "-" . $time["close"];
            $pre = ",";
        }

        $store["office_time"] = $str;
        $store_image_class = new store_image();
        $store["images"] = $store_image_class->get_allImage_by_path($store["pic_info"]);
        $store_meal = D("Merchant_store_meal")->where(array("store_id" => $store_id))->find();
        $store_meal["deliver_time"] = unserialize($store["deliver_time"]);
        $store_meal["width"] = (72 / 5) * $store_meal["score_mean"];
        $store = array_merge($store, $store_meal);
        $merchant = M("Merchant")->where(array("mer_id" => $store["mer_id"]))->find();
        $merchant_image = new merchant_image();
        $merchant["merchant_pic"] = $merchant_image->get_allImage_by_path($merchant["pic_info"]);
        $collect_count = D("User_collect")->where(array("type" => "meal_detail", "id" => $store_id))->count();
        $is_collect = 0;

        if ($collect = D("User_collect")->where(array("type" => "meal_detail", "id" => $store_id, "uid" => $this->user_session["uid"]))->find()) {
            $is_collect = 1;
        }

        $this->assign("collect_count", $collect_count);
        $this->assign("is_collect", $is_collect);
        $area = M("Area")->where(array("area_id" => $store["circle_id"]))->find();
        $this->assign("area", $area);
        $this->assign("merchant", $merchant);
        $this->assign("store", $store);
        $this->display();
    }

    public function group_noexit_tips()
    {
        $this->error("您查看的餐厅不存在！");
    }

    public function addcart()
    {
        $shop_cart = ($_POST["shop_cart"] ? htmlspecialchars($_POST["shop_cart"]) : "");
        $temp = explode(":", $shop_cart);
        $store_id = $temp[0];
        $menus = explode("|", $temp[1]);
        $ids = $list = array();
        $food_count = 0;

        foreach ($menus as $m ) {
            $t = explode(",", $m);
            $ids[] = $t[0];
            $list[$t[0]] = $t[1];
            $food_count += $t[1];
        }

        $meals = D("Meal")->field(true)->where(array(
            "store_id" => $store_id,
            "meal_id"  => array("in", $ids)
        ))->select();
        $total = 0;
        $food_list = array();

        foreach ($meals as $meal ) {
            $tt = array();
            $tt["food_id"] = $meal["meal_id"];
            $tt["food_name"] = $meal["name"];
            $tt["unit"] = $meal["unit"];
            $tt["count"] = 1;
            $tt["box_num"] = 1;
            $tt["box_price"] = 0;
            $tt["single_price"] = $meal["price"];
            $tt["price"] = $meal["price"];
            $tt["food_score"] = 0;
            $tt["foodComment"] = "";
            $tt["is_online_special_meal"] = "";
            $tt["original_price"] = $meal["price"];
            $total += $meal["price"] * $list[$meal["meal_id"]];
            $food_list[] = $tt;
        }

        echo json_encode(array(
            "data" => array(
                "foodlist"          => $food_list,
                "total"             => $total,
                "food_count"        => $food_count,
                "origin_total"      => $total,
                "isSatisfyMinPrice" => 1,
                "act_info"          => array("has_full_discount" => 0, "has_meals_donation" => 0)
            ),
            "msg"  => "成功",
            "code" => 0
        ));
    }
}


?>
