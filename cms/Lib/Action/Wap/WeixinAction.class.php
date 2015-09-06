<?php

class WeixinAction extends CommonAction
{
    public $config = "";

    public function _initialize()
    {
        $this->config = D("Config")->get_config();
        C("config", $this->config);
        ob_end_clean();
    }

    public function index()
    {
        $wechat = new Wechat($this->config);
        $data = $wechat->request();       
        
        
        list($content, $type) = $this->reply($data);
        
        if (!empty($content)) {
            $wechat->response($content, $type);
        }
        else {
            exit();
        }
    }

    private function reply($data)
    {
        $keyword = ($data["Content"] ? $data["Content"] : ($data["EventKey"] ? $data["EventKey"] : ""));
        $mer_id = 0;
        if (empty($data["Event"]) || ("UNSUBSCRIBE" != strtoupper($data["Event"]))) { //反转
            D("User")->where(array("openid" => $data["FromUserName"]))->save(array("is_follow" => 1));
        }
        
        if ($data["MsgType"] == "event") {
            $id = $data["EventKey"];
            switch (strtoupper($data["Event"])) {
            case "SCAN":
                return $this->scan($id, $data["FromUserName"]);
                break;
            case "CLICK":
                $return = $this->special_keyword($id, $data);
                return $return;
                break;

            case "SUBSCRIBE":
                $this->route();

                if ($data["Ticket"]) {
                    $id = substr($data["EventKey"], 8);
                    return $this->scan($id, $data["FromUserName"]);
                }

                $first = D("First")->field(true)->find();

                if ($first) { //反转
                    if ($first["type"] == 0) {
                        return array($first["content"], "text");
                    }
                    else if ($first["type"] == 1) {
                        $return[] = array($first["title"], $first["info"], $this->config["site_url"] . $first["pic"], $first["url"]);
                        return array($return, "news");
                    }
                    else if ($first["type"] == 2) {
                        if ($first["fromid"] == 1) {
                            return $this->special_keyword("首页", $data);
                        }
                        else if ($first["fromid"] == 2) {
                            return $this->special_keyword("团购", $data);
                        }
                        else {
                            return $this->special_keyword("订餐", $data);
                        }
                    }
                    else if ($first["type"] == 3) {
                        $group_list = D("Group")->field(true)->where(array(
                            "begin_time" => array("lt", time()),
                            "end_time"   => array("gt", time()),
                            "status"     => 1
                        ))->order("index_sort DESC")->limit("0, 9")->select();
                        $group_image_class = new group_image();

                        foreach ($group_list as $g ) {
                            $tmp_pic_arr = explode(";", $g["pic"]);
                            $image = $group_image_class->get_image_by_path($tmp_pic_arr[0], "s");
                            $return[] = array("[团购]" . $g["s_name"], $g["name"], $image, $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=detail&group_id=".$g["group_id"]."");
                        }

                        return array($return, "news");
                    }
                }
                else {
                    return array("感谢您的关注，我们将竭诚为您服务！", "text");
                }

                break;

            case "UNSUBSCRIBE":
                D("User")->where(array("openid" => $data["FromUserName"]))->save(array("is_follow" => 0));
                $this->route();
                return array("BYE-BYE", "text");
                break;

            case "LOCATION":
                if ($long_lat = D("User_long_lat")->field(true)->where(array("open_id" => $data["FromUserName"]))->find()) {
                    D("User_long_lat")->where(array("open_id" => $data["FromUserName"]))->save(array("long" => $data["Longitude"], "lat" => $data["Latitude"], "dateline" => time()));
                }
                else {
                    D("User_long_lat")->add(array("long" => $data["Longitude"], "lat" => $data["Latitude"], "dateline" => time(), "open_id" => $data["FromUserName"]));
                }

                break;

            default:
            }
        }
        else if ($data["MsgType"] == "text") {
            $content = $data["Content"];
            $return = $this->special_keyword($content, $data);

            if (strtolower(trim($content)) == "go") {
                $t_data = $this->route();

                if ($return[0] == "亲，暂时没有找到与“" . $content . "”相关的内容！请更换内容。") {
                    header("Content-type: text/xml");
                    exit($t_data);
                }
            }
	    /*
	    if ($return[0] == "亲，暂时没有找到与“" . $content . "”相关的内容！请更换内容。") {				
                    return array('多客服',"transfer_customer_service");//多客服
             }
*/

            return $return;
        }
        else if ($data["MsgType"] == "location") {
            import("@.ORG.longlat");
            $longlat_class = new longlat();
            $location2 = $longlat_class->gpsToBaidu($data["Location_X"], $data["Location_Y"]);
            $x = $location2["lat"];
            $y = $location2["lng"];
            $meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(($x*PI()/180-`lat`*PI()/180)/2),2)+COS($x*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(($y*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_meal`=1")->order("juli ASC")->limit("0, 10")->select();
            $store_image_class = new store_image();

            foreach ($meals as $meal ) {
                $images = $store_image_class->get_allImage_by_path($meal["pic_info"]);
                $meal["image"] = ($images ? array_shift($images) : "");
                $len = (1000 <= $meal["juli"] ? number_format($meal["juli"] / 1000, 2) . "千米" : $meal["juli"] . "米");
                $return[] = array($meal["name"] . "[".$meal["adress"]."]约$len", $meal["txt_info"], $meal["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id=".$meal["mer_id"]."&store_id=".$meal["store_id"]."");
            }

            $meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(($x*PI()/180-`lat`*PI()/180)/2),2)+COS($x*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(($y*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_group`=1")->order("juli ASC")->limit("0, 10")->select();
            $store_image_class = new store_image();

            foreach ($meals as $meal ) {
                $images = $store_image_class->get_allImage_by_path($meal["pic_info"]);
                $meal["image"] = ($images ? array_shift($images) : "");
                $len = (1000 <= $meal["juli"] ? number_format($meal["juli"] / 1000, 2) . "千米" : $meal["juli"] . "米");
                $return[] = array($meal["name"] . "[".$meal["adress"]."]约$len", $meal["txt_info"], $meal["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=shop&store_id=".$meal["store_id"]."");
            }

            if (10 < count($return)) {
                $return = array_slice($return, 0, 9);
            }

            return array($return, "news");
        }

        return false;
    }

    private function scan($id, $openid)
    {
        if ((4000000000 < $id) && $openid) {
            $id -= 4000000000;

            if ($lottery = D("Lottery")->field(true)->where(array("id" => $id))->find()) {
                switch ($lottery["type"]) {
                case 1:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Lottery&a=index&token=".$lottery["mer_id"]."&id=".$lottery["id"]."");
                    break;

                case 2:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Guajiang&a=index&token=".$lottery["mer_id"]."&id=".$lottery["id"]."");
                    break;

                case 3:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Coupon&a=index&token=".$lottery["mer_id"]."&id=".$lottery["id"]."");
                    break;

                case 4:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=LuckyFruit&a=index&token=".$lottery["mer_id"]."&id=".$lottery["id"]."");
                    break;

                case 5:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=GoldenEgg&a=index&token=".$lottery["mer_id"]."&id=".$lottery["id"]."");
                    break;
                }

                return array($return, "news");
            }

            return array("很抱歉，暂时获取不到该二维码的信息!", "text");
        }
        else {
            if ((3000000000 < $id) && $openid) {
                $id -= 3000000000;

                if ($meal_order = D("Meal_order")->field("order_id, mer_id, store_id")->where(array("order_id" => $id))->find()) {
                    return array("<a href=\"" . $this->config["site_url"] . "/wap.php?c=Meal&a=detail&orderid=" . $id . "&mer_id=" . $meal_order["mer_id"] . "&store_id=" . $meal_order["store_id"] . "&otherrm=1\">查看订餐订单详情</a>", "text");
                }
                else {
                    return array("获取不到该订单信息", "text");
                }
            }
            else {
            
                if ((2000000000 < $id) && $openid) {
                    $id -= 2000000000;
                    return array("<a href=\"" . $this->config["site_url"] . "/wap.php?c=My&a=group_order&order_id=" . $id . "&otherrm=1\">查看团购订单详情</a>", "text");
                }
                else {
                    if ((1000000000 < $id) && $openid) {
                        if ($user = D("User")->field("uid")->where(array("openid" => $openid))->find()) {
                            D("Login_qrcode")->where(array("id" => $id))->save(array("uid" => $user["uid"]));
                            return array("登陆成功", "text");
                        }
                        else {
                            D("Login_qrcode")->where(array("id" => $id))->save(array("uid" => -1));
                            $return[] = array("点击授权登录", "", $this->config["site_logo"], $this->config["site_url"] . "/wap.php?c=Web_bind&a=ajax_web_login&qrcode_id=" . $id);
                            return array($return, "news");
                        }
                    }
                }
            }
        }

        if ($recognition = M("Recognition")->field(true)->where(array("id" => $id))->find()) {
            switch ($recognition["third_type"]) {
            case "group":
                $now_group = D("Group")->field(true)->where(array("group_id" => $recognition["third_id"]))->find();
                $group_image_class = new group_image();
                $tmp_pic_arr = explode(";", $now_group["pic"]);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0], "s");
                $return[] = array("[团购]" . $now_group["s_name"], $now_group["name"], $image, $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=detail&group_id=".$now_group["group_id"]."");
                $this->saverelation($openid, $now_group["mer_id"], 0);
                $return = $this->other_message($return, $now_group["mer_id"], $now_group["group_id"]);
                
                break;

            case "merchant":
                $now_merchant = D("Merchant")->field(true)->where(array("mer_id" => $recognition["third_id"]))->find();
                $pic = "";

                if ($now_merchant["pic_info"]) {
                    $images = explode(";", $now_merchant["pic_info"]);
                    $merchant_image_class = new merchant_image();
                    $images = explode(";", $images[0]);
                    $pic = $merchant_image_class->get_image_by_path($images[0]);
                }

                $return[] = array("[商家]" . $now_merchant["name"], $now_merchant["txt_info"], $pic, $this->config["site_url"] . "/wap.php?g=Wap&c=Index&a=index&token={$recognition["third_id"]}");
                $return = $this->other_message($return, $now_merchant["mer_id"]);
                $this->saverelation($openid, $now_merchant["mer_id"], 1);
                break;

            case "meal":
                $now_store = D("Merchant_store")->field(true)->where(array("store_id" => $recognition["third_id"]))->find();

                if ($now_store["have_meal"]) {
                    $store_image_class = new store_image();
                    $images = $store_image_class->get_allImage_by_path($now_store["pic_info"]);
                    $now_store["image"] = ($images ? array_shift($images) : "");
                    $return[] = array("[订餐]" . $now_store["name"], $now_store["txt_info"], $now_store["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id=".$now_store["mer_id"]."&store_id=".$now_store["store_id"]."");
                }

                $this->saverelation($openid, $now_store["mer_id"], 0);
                $return = $this->other_message($return, $now_store["mer_id"], 0, $now_store["store_id"]);
                break;

            case "lottery":
                $lottery = D("Lottery")->field(true)->where(array("id" => $recognition["third_id"]))->find();

                switch ($lottery["type"]) {
                case 1:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Lottery&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                    break;

                case 2:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Guajiang&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                    break;

                case 3:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Coupon&a=index&token=".$lottery["token"]/"&id=".$lottery["id"]."");
                    break;

                case 4:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=LuckyFruit&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                    break;

                case 5:
                    $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=GoldenEgg&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                    break;
                }

                break;
            }
        }

        if ($return) {
            return array($return, "news");
        }

        return array("很抱歉，暂时获取不到该二维码的信息!", "text");
    }

    private function other_message($return, $token, $group_id, $store_id)
    {
        $nowtime = time();
        $group_list = D("Group")->field(true)->where("`mer_id`='$token' AND `group_id`<>'$group_id' AND `status`=1 AND `begin_time`<$nowtime AND `end_time`>$nowtime")->select();
        $group_image_class = new group_image();

        foreach ($group_list as $g ) {
            $tmp_pic_arr = explode(";", $g["pic"]);
            $image = $group_image_class->get_image_by_path($tmp_pic_arr[0], "s");
            $return[] = array("[团购]" . $g["s_name"], $g["name"], $image, $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=detail&group_id=".$g["group_id"]."");
        }

        if (10 < count($return)) {
            return array_slice($return, 0, 9);
        }

        if ($card = D("Member_card_set")->field(true)->where(array("token" => $token))->limit("0,1")->find()) {
            $return[] = array("[会员卡]" . $card["cardname"], $card["msg"], $this->config["site_url"] . $card["logo"], $this->config["site_url"] . "/wap.php?c=Card&a=index&token=$token");
        }

        if (10 < count($return)) {
            return array_slice($return, 0, 9);
        }

        $lotterys = D("Lottery")->field(true)->where(array(
        "token"    => $token,
        "statdate" => array("lt", time()),
        "enddate"  => array("gt", time())
        ))->select();

        foreach ($lotterys as $lottery ) {
            switch ($lottery["type"]) {
            case 1:
                $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Lottery&a=index&token=$token&id=".$lottery["id"]."");
                break;

            case 2:
                $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Guajiang&a=index&token=$token&id=".$lottery["id"]."");
                break;

            case 3:
                $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Coupon&a=index&token=$token&id=".$lottery["id"]."");
                break;

            case 4:
                $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=LuckyFruit&a=index&token=$token&id=".$lottery["id"]."");
                break;

            case 5:
                $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=GoldenEgg&a=index&token=$token&id=".$lottery["id"]."");
                break;
            }
        }

        if (10 < count($return)) {
            return array_slice($return, 0, 9);
        }

        $stores = D("Merchant_store")->field(true)->where("`mer_id`='$token' AND `status`=1 AND `have_meal`=1 AND `store_id`<>'$store_id'")->select();
        $store_image_class = new store_image();

        foreach ($stores as $store ) {
            if ($store["have_meal"]) {
                $images = $store_image_class->get_allImage_by_path($store["pic_info"]);
                $img = array_shift($images);
                $return[] = array("[订餐]" . $store["name"], $store["txt_info"], $img, $this->config["site_url"] . "/wap.php?c=Meal&a=menu&mer_id=".$store["mer_id"]."&store_id=".$store["store_id"]."");
            }
        }

        if (10 < count($return)) {
            return array_slice($return, 0, 9);
        }
        else {
            return $return;
        }
    }

    private function special_keyword($key, $data)
    {
        $return = array();
        if (($key == "附近团购") || ($key == "附近订餐")) {
            $dateline = time() - (3600 * 2);

            if ($long_lat = D("User_long_lat")->field(true)->where("`open_id`='{$data["FromUserName"]}' AND `dateline`>'$dateline'")->find()) {
                import("@.ORG.longlat");
                $longlat_class = new longlat();
                $location2 = $longlat_class->gpsToBaidu($long_lat["lat"], $long_lat["long"]);
                $x = $location2["lat"];
                $y = $location2["lng"];

                if ($key == "附近订餐") {
                    $meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(($x*PI()/180-`lat`*PI()/180)/2),2)+COS($x*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(($y*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_meal`=1")->order("juli ASC")->limit("0, 10")->select();
                    $store_image_class = new store_image();

                    foreach ($meals as $meal ) {
                        $images = $store_image_class->get_allImage_by_path($meal["pic_info"]);
                        $meal["image"] = ($images ? array_shift($images) : "");
                        $len = (1000 <= $meal["juli"] ? number_format($meal["juli"] / 1000, 1) . "千米" : $meal["juli"] . "米");
                        $return[] = array($meal["name"] . "[".$meal["adress"]."]约$len", $meal["txt_info"], $meal["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id=".$meal["mer_id"]."&store_id=".$meal["store_id"]."");
                    }
                }
                else {
                    $meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(($x*PI()/180-`lat`*PI()/180)/2),2)+COS($x*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(($y*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_group`=1")->order("juli ASC")->limit("0, 10")->select();
                    $store_image_class = new store_image();

                    foreach ($meals as $meal ) {
                        $images = $store_image_class->get_allImage_by_path($meal["pic_info"]);
                        $meal["image"] = ($images ? array_shift($images) : "");
                        $len = (1000 <= $meal["juli"] ? number_format($meal["juli"] / 1000, 1) . "千米" : $meal["juli"] . "米");
                        $return[] = array($meal["name"] . "[".$meal["adress"]."]约$len", $meal["txt_info"], $meal["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=shop&store_id=".$meal["store_id"]."");
                    }
                }
            }

            if ($return) {
                return array($return, "news");
            }
            else {
                return array("主人【小猪猪】已经接收到你的指令请发送您的地理位置(对话框右下角点击＋号，然后点击“位置”)给我哈", "text");
            }
        }

        if ($key == "交友") {
            $return[] = array("交友约会", "结交一些朋友吃喝玩乐", $this->config["site_url"] . "/static/images/jiaoyou.jpg", $this->config["site_url"] . "/wap.php?c=Invitation&a=datelist");
            return array($return, "news");
        }

        $platform = D("Platform")->field(true)->where(array("key" => $key))->find();

        if ($platform) {
            $return[] = array($platform["title"], $platform["info"], $this->config["site_url"] . $platform["pic"], $platform["url"]);
        }
        else {
            $keys = D("Keywords")->field(true)->where(array("keyword" => $key))->order("id DESC")->limit("0,9")->select();
            $lotteryids = $mealids = $groupids = array();

            foreach ($keys as $k ) {
                if ($k["third_type"] == "group") {
                    $groupids[] = $k["third_id"];
                }
                else if ($k["third_type"] == "Merchant_store") {
                    $mealids[] = $k["third_id"];
                }
                else if ($k["third_type"] == "lottery") {
                    $lotteryids[] = $k["third_id"];
                }
            }

            if ($groupids) {
                $list = D("Group")->field(true)->where(array(
    "group_id" => array("in", $groupids)
    ))->select();
                $group_image_class = new group_image();

                foreach ($list as $li ) {
                    $image = $group_image_class->get_image_by_path($li["pic"], "s");
                    $return[] = array($li["s_name"], $li["name"], $image, $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=detail&group_id=".$li["group_id"]."");
                }
            }

            if ($mealids) {
                $list = D("Merchant_store")->field(true)->where(array(
                    "store_id" => array("in", $mealids)
                ))->select();
                $store_image_class = new store_image();

                foreach ($list as $now_store ) {
                    $images = $store_image_class->get_allImage_by_path($now_store["pic_info"]);
                    $now_store["image"] = ($images ? array_shift($images) : "");

                    if ($now_store["have_meal"]) {
                        $return[] = array($now_store["name"], $now_store["txt_info"], $now_store["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id=".$now_store["mer_id"]."&store_id=".$now_store["store_id"]."");
                    }
                    else {
                        $return[] = array($now_store["name"], $now_store["txt_info"], $now_store["image"], $this->config["site_url"] . "/wap.php?g=Wap&c=Group&a=shop&store_id=".$now_store["store_id"]."");
                    }
                }
            }

            if ($lotteryids) {
                $lotterys = D("Lottery")->field(true)->where(array(
                "id"       => array("in", $lotteryids),
                "statdate" => array("lt", time()),
                "enddate"  => array("gt", time())
                ))->select();

                foreach ($lotterys as $lottery ) {
                    switch ($lottery["type"]) {
                    case 1:
                        $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Lottery&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                        break;

                    case 2:
                        $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Guajiang&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                        break;

                    case 3:
                        $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=Coupon&a=index&token=".$lottery["token"]/"&id=".$lottery["id"]."");
                        break;

                    case 4:
                        $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=LuckyFruit&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                        break;

                    case 5:
                        $return[] = array("[活动]" . $lottery["title"], $lottery["info"], $this->config["site_url"] . $lottery["starpicurl"], $this->config["site_url"] . "/wap.php?c=GoldenEgg&a=index&token=".$lottery["token"]."&id=".$lottery["id"]."");
                        break;
                    }
                }
            }
        }

        if ($return) {
            return array($return, "news");
        }

        return array("亲，暂时没有找到与“" . $key . "”相关的内容！请更换内容。", "text");
    }

    private function saverelation($openid, $mer_id, $from_merchant)
    {
        $relation = D("Merchant_user_relation")->field("mer_id")->where(array("openid" => $openid, "mer_id" => $mer_id))->find();
        $where = array("img_num" => 1);		
		
        if (false == $relation) {
            $relation = array("openid" => $openid, "mer_id" => $mer_id, "dateline" => time(), "from_merchant" => $from_merchant);
            D("Merchant_user_relation")->add($relation);
            $where["follow_num"] = 1;
            $from_merchant && D("Merchant")->update_group_indexsort($mer_id);	
			
        }
        else {
            if ($relation["from_merchant"] && $from_merchant) {
                D("Merchant")->update_group_indexsort($mer_id);
                D("Merchant_user_relation")->where(array("openid" => $openid, "mer_id" => $mer_id))->save(array("from_merchant" => $from_merchant));
            }
        }
		
		//统计粉丝		
		$fans_count = M('')->table(array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u'))->where("`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='$mer_id'")->count();			
		$data['fans_count'] = $fans_count;
		$condition_merchant['mer_id'] = $mer_id;
		D("Merchant")->where($condition_merchant)->save($data);
		
        D("Merchant_request")->add_request($mer_id, $where);
    }

    private function route()
    {
        $xml = $GLOBALS["HTTP_RAW_POST_DATA"];
        $data = $this->api_notice_increment("http://we-cdn.net", $xml);
        return $data;
    }

    private function api_notice_increment($url, $data)
    {
        $ch = curl_init();
        $headers = array("User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1", "Accept-Language: en-us,en;q=0.5", "Referer:http://mp.weixin.qq.com/", "Content-type: text/xml");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        $error = curl_errno($ch);
        curl_close($ch);

        if ($error) {
            return false;
        }
        else {
            return $tmpInfo;
        }
    }
}


?>
