<?php

class InvitationAction extends BaseAction
{
    private $_lat = 0;
    private $_long = 0;
    private $_im_appid = "";
    private $_im_appkey = "";
    private $from_user_id = 0;
    private $from_user_name = "";
    private $from_user_avatar = "";
    private $no_header = "0";
    private $im_url = "";

    public function __construct()
    {
        parent::__construct();

        if (empty($this->user_session)) {
            $location_param = array();
            $location_param["referer"] = urlencode($this->config["site_url"] . "/wap.php?c=Invitation&a=datelist");
            redirect(U("Login/index", $location_param));
        }

        if (empty($_SESSION['openid'])) {
            $this->error_tips("该功能只能在微信中使用！", U("Login/index"));
        }

        $key = $this->get_encrypt_key(array("app_id" => $this->config["im_appid"], "openid" => $_SESSION["openid"]), $this->config["im_appkey"]);
        //$this->im_url = "http://im-link.meihua.com/?app_id=" . $this->config["im_appid"] . "&openid=" . $_SESSION["openid"] . "&key=" . $key;
        //$this->assign("my_im", $this->im_url);
        $this->assign("my_im", "");
        if ($long_lat = D("User_long_lat")->field("long, lat")->where(array("open_id" => $_SESSION["openid"]))->find()) {
            $this->_long = $long_lat["long"];
            $this->_lat = $long_lat["lat"];
        }
    }

    public function index()
    {
        $mensql = "SELECT i.pigcms_id, u.avatar, u.uid, u.nickname FROM " . C("DB_PREFIX") . "user as u INNER JOIN " . C("DB_PREFIX") . "invitation as i ON i.uid=u.uid WHERE i.status=0 AND i.invite_time>" . time() . " AND u.sex=1 ORDER BY i.pigcms_id DESC limit 0,6";
        $womensql = "SELECT i.pigcms_id, u.avatar, u.uid, u.nickname FROM " . C("DB_PREFIX") . "user as u INNER JOIN " . C("DB_PREFIX") . "invitation as i ON i.uid=u.uid WHERE i.status=0 AND i.invite_time>" . time() . " AND u.sex=2 ORDER BY i.pigcms_id DESC limit 0,6";
        $mode = new Model();
        $men = $mode->query($mensql);
        $women = $mode->query($womensql);

        if (count($men) < 6) {
            $uids = array();

            foreach ($men as $m ) {
                $uids[] = $m["uid"];
            }

            $l = 6 - count($men);

            if ($uids) {
                $othermen = D("User")->field("uid, nickname, avatar")->where(array(
    "sex" => 1,
    "uid" => array("not in", $uids)
    ))->order("uid DESC")->limit("0," . $l)->select();
            }
            else {
                $othermen = D("User")->field("uid, nickname, avatar")->where(array("sex" => 1))->order("uid DESC")->limit("0," . $l)->select();
            }

            $men = ($men ? array_merge($men, $othermen) : $othermen);

            for ($i = count($men) + 1; $i < 7; $i++) {
                $men[] = array("avatar" => $this->config["site_url"] . "/tpl/Wap/static/images/jr.png", "uid" => 0, "nickname" => "");
            }
        }

        if (count($women) < 6) {
            $uids = array();

            foreach ($women as $m ) {
                $uids[] = $m["uid"];
            }

            $l = 6 - count($women);

            if ($uids) {
                $otherwomen = D("User")->field("uid, nickname, avatar")->where(array(
    "sex" => 2,
    "uid" => array("not in", $uids)
    ))->order("uid DESC")->limit("0," . $l)->select();
            }
            else {
                $otherwomen = D("User")->field("uid, nickname, avatar")->where(array("sex" => 2))->order("uid DESC")->limit("0," . $l)->select();
            }

            $women = ($women ? array_merge($women, $otherwomen) : $otherwomen);

            for ($i = count($women) + 1; $i < 7; $i++) {
                $women[] = array("avatar" => $this->config["site_url"] . "/tpl/Wap/static/images/jr.png", "uid" => 0, "nickname" => "");
            }
        }

        $this->assign("men", $men);
        $this->assign("women", $women);
        $this->display();
    }

    public function more()
    {
        $sex = ($_GET["sex"] ? intval($_GET["sex"]) : 2);
        $users = D("User")->field("uid, nickname, avatar")->where(array("sex" => $sex))->order("uid DESC")->limit("0, 6")->select();
        $count = D("User")->where(array("sex" => $sex))->count();
        $this->assign("count", $count);
        $this->assign("user_list", $users);

        if ($sex == 1) {
            $this->assign("title", "高富帅");
        }
        else {
            $this->assign("title", "女神");
        }

        $this->assign("sex", $sex);
        $this->display();
    }

    public function ajaxmore()
    {
        $page = ($_GET["page"] && (1 < intval($_GET["page"])) ? intval($_GET["page"]) : 2);
        $pagesize = ($_GET["pagesize"] && (1 < intval($_GET["pagesize"])) ? intval($_GET["pagesize"]) : 6);
        $sex = ($_GET["sex"] ? intval($_GET["sex"]) : 2);
        $start = ($page - 1) * $pagesize;
        $users = D("User")->field("uid, nickname, avatar")->where(array("sex" => $sex))->order("uid DESC")->limit("$start, $pagesize")->select();
        $count = D("User")->where(array("sex" => $sex))->count();
        exit(json_encode(array("data" => $users, "count" => $count)));
    }

    public function datelist()
    {
        if ($_GET["activity_type"]) {
            $data = D("Invitation")->get_list($this->_lat, $this->_long, 1, 10, intval($_GET["activity_type"]));
            $this->assign("activity_type", $activity_type);
        }
        else {
            $data = D("Invitation")->get_list($this->_lat, $this->_long, 1, 10);
        }

        $this->assign("date_list", $data["data"]);
        $this->assign("count", $data["total"]);
        $this->display();
    }

    public function ajaxlist()
    {
        $page = ($_GET["page"] && (1 < intval($_GET["page"])) ? intval($_GET["page"]) : 2);
        $pagesize = ($_GET["pagesize"] && (1 < intval($_GET["pagesize"])) ? intval($_GET["pagesize"]) : 10);
        if ($_GET["activity_type"] && ($_GET["activity_type"] != "")) {
            $res = D("Invitation")->get_list($this->_lat, $this->_long, $page, $pagesize, intval($_GET["activity_type"]));
        }
        else {
            $res = D("Invitation")->get_list($this->_lat, $this->_long, $page, $pagesize);
        }

        exit(json_encode($res));
    }

    public function release_date()
    {
        $store_id = ($_GET["store_id"] ? intval($_GET["store_id"]) : 0);

        if ($merchant_store = M("Merchant_store")->where(array("store_id" => $store_id))->find()) {
            $this->assign("store", $merchant_store);
        }

        $week = array("周日", "周一", "周二", "周三", "周四", "周五", "周六");
        $date = array(
            array(date("Y-m-d"), date("n月j日 ") . $week[date("w")])
            );

        for ($i = 1; $i < 16; $i++) {
            $date[] = array(date("Y-m-d", strtotime("+$i day")), date("n月j日 ", strtotime("+$i day")) . $week[date("w", strtotime("+$i day"))]);
        }

        $this->assign("date", $date);
        $this->display();
    }

    public function save_date()
    {
        $store_id = ($_POST["store_id"] ? intval($_POST["store_id"]) : 0);
            $merchant_store = M("Merchant_store")->where(array("store_id" => $store_id))->find();
        if (empty($merchant_store)) { //反转
            exit(json_encode(array("error_code" => 1, "msg" => "不存在的门店")));
        }

        if ($invitation = D("Invitation")->field(true)->where(array(
            "uid"         => $this->user_session["uid"],
            "status"      => 0,
            "invite_time" => array("gt", time())
            ))->find()) {
            exit(json_encode(array("error_code" => 1, "msg" => "您已经有一个约会了，不能再发布约会了")));
        }

        $minute = ($_POST["minute"] ? $_POST["minute"] : "");
        $hour = ($_POST["hour"] ? $_POST["hour"] : "");
        $date = ($_POST["date"] ? $_POST["date"] : "");
        $data["invite_time"] = strtotime($date . $hour . $minute . "00");
        $data["store_id"] = $merchant_store["store_id"];
        $store_image_class = new store_image();
        $merchant_store["images"] = $store_image_class->get_allImage_by_path($merchant_store["pic_info"]);
        $data["store_image"] = ($merchant_store["images"] ? array_shift($merchant_store["images"]) : "");
        $data["address"] = $merchant_store["name"];
        $data["obj_sex"] = ($_POST["obj_sex"] ? intval($_POST["obj_sex"]) : 0);
        $data["pay_type"] = ($_POST["pay_type"] ? intval($_POST["pay_type"]) : 0);
        $data["activity_type"] = ($_POST["activity_type"] ? intval($_POST["activity_type"]) : 0);
        $data["note"] = ($_POST["note"] ? htmlspecialchars($_POST["note"]) : "");
        $data["uid"] = $this->user_session["uid"];
        $data["long"] = $this->_long;
        $data["lat"] = $this->_lat;

        if ($pigcms_id = D("Invitation")->add($data)) {
            exit(json_encode(array("error_code" => 0)));
        }
        else {
            exit(json_encode(array("error_code" => 1, "msg" => "发布失败")));
        }
    }

    public function info()
    {
        $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

        if ($invitation = D("Invitation")->field(true)->where(array("pigcms_id" => $pigcms_id))->find()) {
            $today = strtotime(date("Y-m-d")) + 86400;
            $tomorrow = $today + 86400;
            $lastday = $tomorrow + 86400;
            $invitation["status"] = ($invitation["invite_time"] < time() ? 1 : $invitation["status"]);
            $invitation["juli"] = ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(((($this->_lat * PI()) / 180) - (($invitation["lat"] * PI()) / 180)) / 2), 2) + (COS(($this->_lat * PI()) / 180) * COS(($invitation["lat"] * PI()) / 180) * POW(SIN(((($this->_long * PI()) / 180) - (($invitation["long"] * PI()) / 180)) / 2), 2)))) * 1000);
            $invitation["juli"] = (1000 < $invitation["juli"] ? number_format($invitation["juli"] / 1000, 1) . "km" : ($invitation["juli"] < 100 ? "<100m" : $invitation["juli"] . "m"));
            $invitation["invite_time"] = ($invitation["invite_time"] < $today ? "今天 " . date("H:i", $invitation["invite_time"]) : ($invitation["invite_time"] < $tomorrow ? "明天  " . date("H:i", $invitation["invite_time"]) : ($invitation["invite_time"] < $lastday ? "后天  " . date("H:i", $invitation["invite_time"]) : date("m-d H:i", $invitation["invite_time"]))));
            $user = D("User")->field(true)->where(array("uid" => $invitation["uid"]))->find();
            $user["birthday"] && ($user["age"] = date("Y") - date("Y", strtotime($user["birthday"])));
            $user["age"] = ((100 < $user["age"]) || ($user["age"] < 0) ? "保密" : $user["age"] . "岁");
            $store = D("Merchant_store")->field(true)->where(array("store_id" => $invitation["store_id"]))->find();
            $looks = D("")->field("`u`.*")->table(array(C("DB_PREFIX") . "user" => "u", C("DB_PREFIX") . "invitation_look" => "l"))->where("`l`.`uid`=`u`.`uid` AND `l`.`invid`=" . $invitation["pigcms_id"])->limit("0, 20")->select();

            if ($this->user_session["uid"] != $invitation["uid"]) {
                if ($look = D("Invitation_look")->field("invid")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->find()) {
                    D("Invitation_look")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->save(array("avatar" => $this->user_session["avatar"], "dateline" => time()));
                }
                else {
                    D("Invitation_look")->add(array("avatar" => $this->user_session["avatar"], "uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"], "dateline" => time()));
                    D("Invitation")->where(array("pigcms_id" => $pigcms_id))->setInc("look_num", 1);
                }
            }

            $this->assign("looks", $looks);
            $this->assign("store", $store);
            $this->assign("invitation", $invitation);
            $this->assign("user", $user);

            if ($this->user_session["uid"] == $user["uid"]) {
                $signs = D("")->field("`u`.*")->table(array(C("DB_PREFIX") . "user" => "u", C("DB_PREFIX") . "invitation_sign" => "s"))->where("`s`.`uid`=`u`.`uid` AND `s`.`invid`=" . $invitation["pigcms_id"])->limit("0, 20")->select();

                foreach ($signs as &$v ) {
                    ($v["birthday"] != "0000-00-00") && ($v["age"] = date("Y") - date("Y", strtotime($v["birthday"])));
                    $v["age"] = ($v["age"] ? ((100 < $v["age"]) || ($v["age"] < 0) ? "保密" : $v["age"] . "岁") : "保密");
                    $v["im_url"] = $this->im_url . "#group_" . $v["openid"];
                }

                $this->assign("is_edit", 1);
                $this->assign("signs", $signs);
                $this->display("myinfo");
            }
            else {
                $this->assign("im_url", $this->im_url . "#group_" . $user["openid"]);
                $sign = D("Invitation_sign")->field("invid")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->find();
                $this->assign("is_edit", 0);
                $this->assign("sign", $sign);
                $this->display();
            }
        }
        else {
            $this->error_tips("没有相关的约会信息请确认！", U("Invitation/datelist"));
            exit();
        }
    }

    public function sign()
    {
        $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

        if ($invitation = D("Invitation")->field(true)->where(array("pigcms_id" => $pigcms_id))->find()) {
            if ($invitation["obj_sex"] && ($invitation["obj_sex"] != $this->user_session["sex"])) {
                if ($invitation["obj_sex"] == 1) {
                    exit(json_encode(array("error_code" => 1, "msg" => "该约会限男生报名", "status" => 0)));
                }
                else if ($invitation["obj_sex"] == 2) {
                    exit(json_encode(array("error_code" => 1, "msg" => "该约会限妹子报名", "status" => 0)));
                }
            }

            if ($this->user_session["uid"] != $invitation["uid"]) {
                if ($sign = D("Invitation_sign")->field("invid")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->find()) {
                    D("Invitation_sign")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->delete();
                    D("Invitation")->where(array("pigcms_id" => $pigcms_id))->setDec("sign_num", 1);
                    exit(json_encode(array("error_code" => 0, "msg" => "放弃约会", "status" => 0)));
                }
                else {
                    D("Invitation_sign")->add(array("avatar" => $this->user_session["avatar"], "uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"], "dateline" => time()));
                    D("Invitation")->where(array("pigcms_id" => $pigcms_id))->setInc("sign_num", 1);
                    exit(json_encode(array("error_code" => 0, "msg" => "约会成功", "status" => 1)));
                }
            }
        }

        exit(json_encode(array("error_code" => 1, "msg" => "操作失败")));
    }

    public function mydate()
    {
        $invitations = D("Invitation")->field(true)->where(array("uid" => $this->user_session["uid"]))->order("pigcms_id DESC")->select();
        $today = strtotime(date("Y-m-d")) + 86400;
        $tomorrow = $today + 86400;
        $lastday = $tomorrow + 86400;

        foreach ($invitations as &$i ) {
            $i["status"] = ($i["invite_time"] < time() ? 1 : $i["status"]);
            $i["invite_time"] = ($i["invite_time"] < $today ? "今天 " . date("H:i", $i["invite_time"]) : ($i["invite_time"] < $tomorrow ? "明天  " . date("H:i", $i["invite_time"]) : ($i["invite_time"] < $lastday ? "后天  " . date("H:i", $v["invite_time"]) : date("m-d H:i", $i["invite_time"]))));
        }

        $this->assign("invitations", $invitations);
        $this->display();
    }

    public function mysign()
    {
        $invitation_signs = D("Invitation_sign")->field("invid")->where(array("uid" => $this->user_session["uid"]))->order("invid DESC")->select();
        $invids = $pre = "";

        foreach ($invitation_signs as $is ) {
            $invids .= $pre . $is["invid"];
            $pre = ",";
        }

        $today = strtotime(date("Y-m-d")) + 86400;
        $tomorrow = $today + 86400;
        $lastday = $tomorrow + 86400;

        if ($invids) {
            $sql = "SELECT i.*, u.* FROM " . C("DB_PREFIX") . "user as u INNER JOIN " . C("DB_PREFIX") . "invitation as i ON i.uid=u.uid WHERE i.pigcms_id IN ($invids) ORDER BY i.pigcms_id DESC, u.sex DESC";
            $mode = new Model();
            $res = $mode->query($sql);

            foreach ($res as &$v ) {
                $v["_time"] = date("Y-m-d H:i", $v["invite_time"]);
                $v["juli"] = ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(((($this->_lat * PI()) / 180) - (($v["lat"] * PI()) / 180)) / 2), 2) + (COS(($this->_lat * PI()) / 180) * COS(($v["lat"] * PI()) / 180) * POW(SIN(((($this->_long * PI()) / 180) - (($v["long"] * PI()) / 180)) / 2), 2)))) * 1000);
                $v["juli"] = (1000 < $v["juli"] ? number_format($v["juli"] / 1000, 1) . "km" : ($v["juli"] < 100 ? "<100m" : $v["juli"] . "m"));
                $v["invite_time"] = ($v["invite_time"] < $today ? "今天 " . date("H:i", $v["invite_time"]) : ($v["invite_time"] < $tomorrow ? "明天  " . date("H:i", $v["invite_time"]) : ($v["invite_time"] < $lastday ? "后天  " . date("H:i", $v["invite_time"]) : date("m-d H:i", $v["invite_time"]))));
                $v["birthday"] && ($v["age"] = date("Y") - date("Y", strtotime($v["birthday"])));
            }

            $this->assign("date_list", $res);
        }

        $this->display();
    }

    public function userinfo()
    {
        $uid = ($_GET["uid"] ? intval($_GET["uid"]) : 0);

        if ($user = D("User")->field(true)->where(array("uid" => $uid))->find()) {
            if ($invitation = D("Invitation")->field(true)->where(array(
    "uid"         => $uid,
    "status"      => 0,
    "invite_time" => array("gt", time())
    ))->find()) {
                $today = strtotime(date("Y-m-d")) + 86400;
                $tomorrow = $today + 86400;
                $lastday = $tomorrow + 86400;
                $invitation["invite_time"] = ($invitation["invite_time"] < $today ? "今天 " . date("H:i", $invitation["invite_time"]) : ($invitation["invite_time"] < $tomorrow ? "明天  " . date("H:i", $invitation["invite_time"]) : ($invitation["invite_time"] < $lastday ? "后天  " . date("H:i", $invitation["invite_time"]) : date("m-d H:i", $invitation["invite_time"]))));

                if ($this->user_session["uid"] != $user["uid"]) {
                    if ($look = D("Invitation_look")->field("invid")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->find()) {
                        D("Invitation_look")->where(array("uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"]))->save(array("avatar" => $this->user_session["avatar"], "dateline" => time()));
                    }
                    else {
                        D("Invitation_look")->add(array("avatar" => $this->user_session["avatar"], "uid" => $this->user_session["uid"], "invid" => $invitation["pigcms_id"], "dateline" => time()));
                        D("Invitation")->where(array("pigcms_id" => $invitation["pigcms_id"]))->setInc("look_num", 1);
                    }
                }

                $this->assign("invitation", $invitation);
            }

            if ($this->user_session["uid"] == $user["uid"]) {
                $im_url = $this->im_url;
                $this->assign("is_edit", 1);
            }
            else {
                $im_url = $this->im_url . "#group_" . $user["openid"];
                $this->assign("is_edit", 0);
            }

            $this->assign("im_url", $im_url);
            ($user["birthday"] != "0000-00-00") && ($user["age"] = date("Y") - date("Y", strtotime($user["birthday"])));
            $user["age"] = ($user["age"] ? ((100 < $user["age"]) || ($user["age"] < 0) ? "保密" : $user["age"] . "岁") : "保密");
            $occupation = D("Occupation")->field(true)->where(array("pigcms_id" => $user["occupation"]))->find();
            $this->assign("occupation", $occupation);
            $this->assign("user", $user);
            $this->display();
        }
        else {
            $this->error_tips("不存在的用户信息请确认！", U("Invitation/datelist"));
        }
    }

    public function editinfo()
    {
        $occupations = D("Occupation")->field(true)->select();
        $this->assign("occupations", $occupations);
        $user = D("User")->field(true)->where(array("uid" => $this->user_session["uid"]))->find();
        $birthday = explode("-", $user["birthday"]);
        $user["year"] = $birthday[0];
        $user["month"] = $birthday[1];
        $user["day"] = $birthday[2];
        $this->assign("info", $user);
        $this->display();
    }

    public function saveinfo()
    {
        $this->user_session["message"] = (isset($_POST["message"]) ? htmlspecialchars($_POST["message"]) : "");
        $this->user_session["nickname"] = (isset($_POST["nickname"]) ? htmlspecialchars($_POST["nickname"]) : "");
        $this->user_session["avatar"] = (isset($_POST["avatar"]) ? htmlspecialchars($_POST["avatar"]) : "");
        $this->user_session["sex"] = (isset($_POST["sex"]) ? intval($_POST["sex"]) : 1);
        $year = (isset($_POST["year"]) ? intval($_POST["year"]) : "1990");
        $month = (isset($_POST["month"]) ? intval($_POST["month"]) : "1");
        $day = (isset($_POST["day"]) ? intval($_POST["day"]) : "1");
        $this->user_session["occupation"] = (isset($_POST["occupation"]) ? intval($_POST["occupation"]) : "1");
        $this->user_session["birthday"] = $year . "-" . str_pad($month, 2, 0, STR_PAD_LEFT) . "-" . str_pad($day, 2, 0, STR_PAD_LEFT);
        $this->user_session["last_time"] = time();

        if (D("User")->where(array("uid" => $this->user_session["uid"]))->save($this->user_session)) {
            session("user", $this->user_session);
            exit(json_encode(array("error_code" => 0, "msg" => "ok", "uid" => $this->user_session["uid"])));
        }
        else {
            exit(json_encode(array("error_code" => 1, "msg" => "编辑失败")));
        }
    }

    public function cancel()
    {
        $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

        if (D("Invitation")->where(array("pigcms_id" => $pigcms_id, "uid" => $this->user_session["uid"]))->save(array("status" => 1))) {
            exit(json_encode(array("error_code" => 0)));
        }
        else {
            exit(json_encode(array("error_code" => 1, "msg" => "oh,sorry!服务器开小差了。")));
        }
    }

    public function isrelease()
    {
        if ($invitation = D("Invitation")->field("pigcms_id")->where("`uid`='{$this->user_session["uid"]}' AND `status`=0 AND `invite_time`>" . time())->find()) {
            exit(json_encode(array("error_code" => 1, "pigcmsid" => $invitation["pigcms_id"])));
        }
        else {
            exit(json_encode(array("error_code" => 0)));
        }
    }
}


?>
