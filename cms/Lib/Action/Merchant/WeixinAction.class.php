<?php

class WeixinAction extends BaseAction
{
    public function _initialize()
    {
        parent::_initialize();
        if (empty($this->config['is_open_oauth']) && (true == empty($this->merchant_session['is_open_oauth']))) {
            $this->error("你没有这个使用权限", U("Index/index"));
        }
    }

    public function index()
    {
        $weixin_bind = array();

        if ($weixin_bind = D("Weixin_bind")->where(array("mer_id" => $this->merchant_session["mer_id"]))->find()) {
            if (($weixin_bind["service_type_info"] == 0) || ($weixin_bind["service_type_info"] == 1)) {
                if ($weixin_bind["verify_type_info"] == -1) {
                    $weixin_bind["type_info"] = "未认证的订阅号";
                }
                else {
                    $weixin_bind["type_info"] = "认证的订阅号";
                }
            }
            else if ($weixin_bind["verify_type_info"] == -1) {
                $weixin_bind["type_info"] = "未认证服务号";
            }
            else {
                $weixin_bind["type_info"] = "认证服务号";
            }
        }
        else {
            import("ORG.Net.Http");
            $result = $_SESSION["component_access_token"];
            if ($result && (time() < $result[0])) {
                $result["component_access_token"] = $result[1];
            }
            else {
                $url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
                $data = array("component_appid" => $this->config["wx_appid"], "component_appsecret" => $this->config["wx_appsecret"], "component_verify_ticket" => $this->config["wx_componentverifyticket"]);
                $result = Http::curlPost($url, json_encode($data));

                if ($result["errcode"]) {
                    $_SESSION["component_access_token"] = array($result["expires_in"] + time(), $result["component_access_token"]);
                }
            }

            $url = "https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token=" . $result["component_access_token"];
            $data = array("component_appid" => $this->config["wx_appid"]);
            $auth_code = Http::curlPost($url, json_encode($data));

            if ($auth_code["errcode"]) {
                $url = "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=" . $this->config["wx_appid"] . "&pre_auth_code=" . $auth_code["pre_auth_code"] . "&redirect_uri=" . urlencode($this->config["site_url"] . "/merchant.php?g=Merchant&c=Weixin&a=auth_back");
                $this->assign("url", $url);
            }
            else {
                $this->assign("url", "");
            }
        }

        $this->assign("bind", $weixin_bind);
        $this->display();
    }

    public function menu()
    {
        $weixin = D("Weixin_bind")->get_account_type($this->merchant_session["mer_id"]);
        if ($weixin["code"] && (0 < $weixin["code"])) {
            $diymenus = D("Diymenu_class")->where(array("mer_id" => $this->merchant_session["mer_id"]))->order("sort ASC")->select();
            $lists = array();

            foreach ($diymenus as $diy ) {
                if ($diy["pid"]) {
                    if (empty($lists[$diy["pid"]]["list"])) { //反转
                        $lists[$diy["pid"]]["list"] = array(1 => $diy);
                    }
                    else {
                        $lists[$diy["pid"]]["list"][] = $diy;
                    }
                }
                else if ($lists[$diy["id"]]) {
                    $lists[$diy["id"]] = array_merge($lists[$diy["id"]], $diy);
                }
                else {
                    $lists[$diy["id"]] = $diy;
                }
            }

            $dlists = array();
            $i = 0;

            foreach ($lists as $l ) {
                $dlists[++$i] = $l;
            }

            $this->assign("dlists", $dlists);
        }

        $this->assign("weixin", $weixin);
        $this->display();
    }

    public function savemenu()
    {
        $data = ($_POST["custommenu"] ? $_POST["custommenu"] : array());

        foreach ($data as $index => $val ) {
            $val["url"] = htmlspecialchars_decode($val["url"]);
            if ($val["url"] && !strstr($val["url"], $this->config["site_url"])) {
                exit(json_encode(array("errcode" => 1, "errmsg" => "URL地址不合法")));
            }

            unset($val["type"]);
            $val["is_show"] = 1;

            if (10 < $index) {
                $pindex = $index / 10;
                if ($val["title"] && $data[$pindex]["id"] && $data[$pindex]["id"]) {
                    if ($val["id"] && ($diymenu = D("Diymenu_class")->where(array("mer_id" => $this->merchant_session["mer_id"], "id" => $val["id"]))->find())) {
                        $id = $val["id"];
                        unset($val["id"]);
                        $val["pid"] = $data[$pindex]["id"];
                        D("Diymenu_class")->where(array("mer_id" => $this->merchant_session["mer_id"], "id" => $id))->save($val);
                    }
                    else {
                        unset($val["id"]);
                        $val["mer_id"] = $this->merchant_session["mer_id"];
                        $val["pid"] = $data[$pindex]["id"];
                        D("Diymenu_class")->add($val);
                    }
                }
            }
            else if ($val["title"]) {
                if ($val["id"] && ($diymenu = D("Diymenu_class")->where(array("mer_id" => $this->merchant_session["mer_id"], "id" => $val["id"]))->find())) {
                    $id = $val["id"];
                    unset($val["id"]);
                    D("Diymenu_class")->where(array("mer_id" => $this->merchant_session["mer_id"], "id" => $id))->save($val);
                }
                else {
                    unset($val["id"]);
                    $val["mer_id"] = $this->merchant_session["mer_id"];
                    $data[$index]["id"] = D("Diymenu_class")->add($val);
                }
            }
        }

        $result = $this->class_send();
        exit($result);
    }

    public function get_url()
    {
        import("ORG.Net.Http");
        $result = $_SESSION["component_access_token"];
        if ($result && (time() < $result[0])) {
            $result["component_access_token"] = $result[1];
        }
        else {
            $url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
            $data = array("component_appid" => $this->config["wx_appid"], "component_appsecret" => $this->config["wx_appsecret"], "component_verify_ticket" => $this->config["wx_componentverifyticket"]);
            $result = Http::curlPost($url, json_encode($data));

            if ($result["errcode"]) {
                $_SESSION["component_access_token"] = array($result["expires_in"] + time(), $result["component_access_token"]);
            }
            else {
                exit(json_encode(array("err_code" => 1, "err_msg" => "获取授权地址失败")));
            }
        }

        $url = "https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token=" . $result["component_access_token"];
        $data = array("component_appid" => $this->config["wx_appid"]);
        $auth_code = Http::curlPost($url, json_encode($data));

        if ($auth_code["errcode"]) {
            $url = "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid=" . $this->config["wx_appid"] . "&pre_auth_code=" . $auth_code["pre_auth_code"] . "&redirect_uri=" . urlencode($this->config["site_url"] . "/merchant.php?g=Merchant&c=Weixin&a=auth_back");
            exit(json_encode(array("err_code" => 0, "err_msg" => $url)));
        }

        exit(json_encode(array("err_code" => 1, "err_msg" => "获取授权地址失败")));
    }

    public function auth_back()
    {
        if ($_GET["auth_code"] && $_GET["expires_in"]) {
            import("ORG.Net.Http");
            $result = $_SESSION["component_access_token"];
            if ($result && (time() < $result[0])) {
                $result["component_access_token"] = $result[1];
            }
            else {
                $url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
                $data = array("component_appid" => $this->config["wx_appid"], "component_appsecret" => $this->config["wx_appsecret"], "component_verify_ticket" => $this->config["wx_componentverifyticket"]);
                $result = Http::curlPost($url, json_encode($data));

                if ($result["errcode"]) {
                    $this->assign("errmsg", $result["errmsg"]);
                    $this->display("fail");
                    exit();
                }
            }

            $url = "https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=" . $result["component_access_token"];
            $data = array("component_appid" => $this->config["wx_appid"], "authorization_code" => $_GET["auth_code"]);
            $result1 = Http::curlPost($url, json_encode($data));

            if ($result1["errcode"]) {
                $this->assign("errmsg", $result1["errmsg"]);
                $this->display("fail");
                exit();
            }

            $_SESSION["authorizer_access_token"] = array($result1["authorization_info"]["expires_in"] + time(), $result1["authorization_info"]["authorizer_access_token"]);
            $url = "https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token=" . $result["component_access_token"];
            $data = array("component_appid" => $this->config["wx_appid"], "authorizer_appid" => $result1["authorization_info"]["authorizer_appid"]);
            $result2 = Http::curlPost($url, json_encode($data));

            if ($result2["errcode"]) {
                $this->assign("errmsg", $result2["errmsg"]);
                $this->display("fail");
                exit();
            }
            else {
                $data = array();
                $data = $result2["authorizer_info"];
                $data["service_type_info"] = $data["service_type_info"]["id"];
                $data["verify_type_info"] = $data["verify_type_info"]["id"];
                $pre = "";
                $func_info = "";

                foreach ($result2["authorization_info"]["func_info"] as $val ) {
                    $func_info .= $pre . $val["funcscope_category"]["id"];
                    $pre = ",";
                }

                $data["func_info"] = $func_info;
                $data["authorizer_appid"] = $result1["authorization_info"]["authorizer_appid"];
                $data["authorizer_refresh_token"] = $result1["authorization_info"]["authorizer_refresh_token"];
                $data["mer_id"] = $this->merchant_session["mer_id"];

                if ($is_bind = D("Weixin_bind")->where(array("user_name" => $data["user_name"]))->find()) {
                    if ($is_bind["mer_id"] != $this->merchant_session["mer_id"]) {
                        $this->assign("errmsg", "该微信公众号已在其他店铺完成绑定，无法绑定到当前店铺！");
                        $this->display("fail");
                        exit();
                    }
                }

                if ($weixin_bind = D("Weixin_bind")->where(array("mer_id" => $this->merchant_session["mer_id"]))->find()) {
                    D("Weixin_bind")->where(array("mer_id" => $this->merchant_session["mer_id"]))->data($data)->save();
                }
                else {
                    D("Weixin_bind")->data($data)->add();
                }

                $this->display("success");
            }
        }
        else {
            $this->assign("errmsg", "不合法的请求授权");
            $this->display("fail");
        }
    }

    public function class_send()
    {
        $token_data = D("Weixin_bind")->get_access_token($this->merchant_session["mer_id"]);

        if ($token_data["errcode"]) {
            exit(json_encode($token_data));
        }

        $class = D("Diymenu_class")->where(array("pid" => 0, "mer_id" => $this->merchant_session["mer_id"]))->limit(3)->order("sort asc")->select();
        $kcount = D("Diymenu_class")->where(array("pid" => 0, "mer_id" => $this->merchant_session["mer_id"]))->count("id");
        $k = 1;
        $data = "{\"button\":[";

        foreach ($class as $key => $vo ) {
            $data .= "{\"name\":\"" . $vo["title"] . "\",";
            $c = D("Diymenu_class")->where(array("pid" => $vo["id"], "mer_id" => $this->merchant_session["mer_id"]))->limit(5)->order("sort asc")->select();
            $count = D("Diymenu_class")->where(array("pid" => $vo["id"], "mer_id" => $this->merchant_session["mer_id"]))->count("id");

            if ($c != false) {
                $data .= "\"sub_button\":[";
            }
            else if ($vo["url"]) {
                $data .= "\"type\":\"view\",\"url\":\"" . $vo["url"] . "\"";
            }
            else if ($vo["keyword"]) {
                $data .= "\"type\":\"click\",\"key\":\"" . $vo["keyword"] . "\"";
            }
            else {
                if (($vo["wxsys"] != 0) && ($vo["wxsys"] != 1)) {
                    $data .= "\"type\":\"" . $vo["wxsys"] . "\",\"key\":\"" . $vo["wxsys"] . "\"";
                }
            }

            $i = 1;

            foreach ($c as $voo ) {
                if ($i == $count) {
                    if ($voo["url"]) {
                        $data .= "{\"type\":\"view\",\"name\":\"" . $voo["title"] . "\",\"url\":\"" . $voo["url"] . "\"}";
                    }
                    else if ($voo["keyword"]) {
                        $data .= "{\"type\":\"click\",\"name\":\"" . $voo["title"] . "\",\"key\":\"" . $voo["keyword"] . "\"}";
                    }
                    else {
                        if (($voo["wxsys"] != 0) && ($voo["wxsys"] != 1)) {
                            $data .= "{\"type\":\"" . $voo["wxsys"] . "\",\"name\":\"" . $voo["title"] . "\",\"key\":\"" . $voo["wxsys"] . "\"}";
                        }
                    }
                }
                else if ($voo["url"]) {
                    $data .= "{\"type\":\"view\",\"name\":\"" . $voo["title"] . "\",\"url\":\"" . $voo["url"] . "\"},";
                }
                else if ($voo["keyword"]) {
                    $data .= "{\"type\":\"click\",\"name\":\"" . $voo["title"] . "\",\"key\":\"" . $voo["keyword"] . "\"},";
                }
                else {
                    if (($voo["wxsys"] != 0) && ($voo["wxsys"] != 1)) {
                        $data .= "{\"type\":\"" . $voo["wxsys"] . "\",\"name\":\"" . $voo["title"] . "\",\"key\":\"" . $voo["wxsys"] . "\"},";
                    }
                }

                $i++;
            }

            if ($c != false) {
                $data .= "]";
            }

            if ($k == $kcount) {
                $data .= "}";
            }
            else {
                $data .= "},";
            }

            $k++;
        }

        $data .= "]}";
        file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $token_data["access_token"]);
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $token_data["access_token"];
        import("ORG.Net.Http");
        $rt = Http::curlPost($url, $data);

        if ($rt["errcode"]) {
            return json_encode($rt);
        }
        else {
            return json_encode(array("errcode" => 0, "errmsg" => "自定义菜单生产成功"));
        }
    }

    private function _get_sys($type, $key)
    {
        $wxsys = array("扫码带提示", "扫码推事件", "系统拍照发图", "拍照或者相册发图", "微信相册发图", "发送位置");

        if ($type == "send") {
            $wxsys = array("扫码带提示" => "scancode_waitmsg", "扫码推事件" => "scancode_push", "系统拍照发图" => "pic_sysphoto", "拍照或者相册发图" => "pic_photo_or_album", "微信相册发图" => "pic_weixin", "发送位置" => "location_select");
            return $wxsys[$key];
            exit();
        }

        return $wxsys;
    }

    public function reply_txt()
    {
        if (IS_POST) {
            $pigcms_id = ($_POST["pigcms_id"] ? intval($_POST["pigcms_id"]) : 0);
            $keyword = ($_POST["keyword"] ? htmlspecialchars($_POST["keyword"]) : "");
            $content = ($_POST["content"] ? htmlspecialchars($_POST["content"]) : "");
            $this->assign("keyword", array("pigcms_id" => $pigcms_id, "content" => $content, "keyword" => $keyword));

            if ($keyword) {
                $this->assign("error", "关键词 不可为空白.");
                $this->display();
                exit();
            }

            if ($content) {
                $this->assign("error", "回复内容 不可为空白.");
                $this->display();
                exit();
            }

            if ($keyobj = D("Keyword")->where(array("mer_id" => $this->merchant_session["mer_id"], "content" => $keyword))->find()) {
                if ($keyobj["pigcms_id"] != $pigcms_id) {
                    $this->assign("error", "关键词 \"" . $keyword . "\" 已被取用.");
                    $this->display();
                    exit();
                }
            }

            if ($pigcms_id && ($keyword = D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->find())) {
                $txt = D($keyword["table"])->where(array("pigcms_id" => $keyword["from_id"], "mer_id" => $this->merchant_session["mer_id"]))->find();

                if ($txt) {
                    D($keyword["table"])->where(array("pigcms_id" => $keyword["from_id"], "mer_id" => $this->merchant_session["mer_id"]))->save(array("content" => $content));
                    $txtid = $keyword["from_id"];
                }
                else {
                    $txtid = D($keyword["table"])->add(array("mer_id" => $this->merchant_session["mer_id"], "content" => $content));
                }

                if ($txtid) {
                    $this->assign("error", "创建失败");
                    $this->display();
                    exit();
                }

                D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->save(array("content" => $keyword, "from_id" => $txtid, "table" => "Text"));
            }
            else {
                $txtid = D("Text")->add(array("mer_id" => $this->merchant_session["mer_id"], "content" => $content));
                D("Keyword")->add(array("mer_id" => $this->merchant_session["mer_id"], "content" => $keyword, "from_id" => $txtid, "table" => "Text"));
            }

            $this->redirect(U("Weixin/txt"));
        }
        else {
            $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

            if ($keyword = D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->find()) {
                $keyword["keyword"] = $keyword["content"];
                $content = D($keyword["table"])->where(array("pigcms_id" => $keyword["from_id"], "mer_id" => $this->merchant_session["mer_id"]))->find();
                $keyword["content"] = ($content ? $content["content"] : "");
                $this->assign("keyword", $keyword);
            }
        }

        $this->display();
    }

    public function del_txt()
    {
        $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

        if ($keyword = D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->find()) {
            $content = D($keyword["table"])->where(array("pigcms_id" => $keyword["from_id"], "mer_id" => $this->merchant_session["mer_id"]))->delete();
            D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->delete();
            $this->redirect(U("Weixin/txt"));
        }
        else {
            $this->error("不合法的请求");
        }
    }

    public function txt()
    {
        $count = D("Keyword")->where(array("mer_id" => $this->merchant_session["mer_id"], "table" => "Text"))->count("pigcms_id");
        import("@.ORG.merchant_page");
        $p = new Page($count, 10);
        $list = D("Keyword")->where(array("mer_id" => $this->merchant_session["mer_id"], "table" => "Text"))->order("pigcms_id DESC")->limit($p->firstRow . "," . $p->listRows)->select();
        $temp = $result = array();

        foreach ($list as $l ) {
            $temp[] = $l["from_id"];
        }

        $tmp = array();

        if ($temp) {
            $texts = D("Text")->where(array(
    "mer_id"    => $this->merchant_session["mer_id"],
    "pigcms_id" => array("in", $temp)
    ))->select();

            foreach ($texts as $t ) {
                $tmp[$t["pigcms_id"]] = $t;
            }
        }

        foreach ($list as &$v ) {
            $v["keyword"] = $v["content"];
            $v["content"] = ($tmp[$v["from_id"]] ? $tmp[$v["from_id"]]["content"] : "");
        }

        $this->assign("lists", $list);
        $this->assign("page", $p->show());
        $this->display();
    }

    public function reply_img()
    {
        $list = D("Source_material")->where(array("mer_id" => $this->merchant_session["mer_id"]))->order("pigcms_id DESC")->select();
        $it_ids = array();
        $temp = array();

        foreach ($list as $l ) {
            foreach (unserialize($l["it_ids"]) as $id ) {
                if (!in_array($id, $it_ids)) {
                    $it_ids[] = $id;
                }
            }
        }

        $result = array();
        $image_text = D("Image_text")->field("pigcms_id, title")->where(array(
    "pigcms_id" => array("in", $it_ids)
    ))->order("pigcms_id asc")->select();

        foreach ($image_text as $txt ) {
            $result[$txt["pigcms_id"]] = $txt;
        }

        foreach ($list as &$l ) {
            $l["dateline"] = date("Y-m-d H:i:s", $l["dateline"]);

            foreach (unserialize($l["it_ids"]) as $id ) {
                $l["list"][] = ($result[$id] ? $result[$id] : array());
            }
        }

        $this->assign("list", $list);

        if (IS_POST) {
            $pigcms_id = ($_POST["pigcms_id"] ? intval($_POST["pigcms_id"]) : 0);
            $keyword = ($_POST["keyword"] ? htmlspecialchars($_POST["keyword"]) : "");
            $source_id = ($_POST["source_id"] ? intval($_POST["source_id"]) : 0);
            $this->assign("keyword", array("pigcms_id" => $pigcms_id, "from_id" => $source_id, "keyword" => $keyword));

            if ($keyword) {
                $this->assign("error", "关键词 不可为空白.");
                $this->display();
                exit();
            }

            if ($keyobj = D("Keyword")->where(array("mer_id" => $this->merchant_session["mer_id"], "content" => $keyword))->find()) {
                if ($keyobj["pigcms_id"] != $pigcms_id) {
                    $this->assign("error", "关键词 \"" . $keyword . "\" 已被取用.");
                    $this->display();
                    exit();
                }
            }

            if (!$obj = D("Source_material")->where(array("pigcms_id" => $source_id, "mer_id" => $this->merchant_session["mer_id"]))->find()) {
                $this->assign("error", "选择了不存在的文图.");
                $this->display();
                exit();
            }

            if ($pigcms_id && ($keyword = D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->find())) {
                D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->save(array("content" => $keyword, "from_id" => $source_id, "table" => "Source_material"));
            }
            else {
                D("Keyword")->add(array("mer_id" => $this->merchant_session["mer_id"], "content" => $keyword, "from_id" => $source_id, "table" => "Source_material"));
            }

            $this->redirect(U("Weixin/img"));
        }
        else {
            $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

            if ($keyword = D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->find()) {
                $keyword["keyword"] = $keyword["content"];
                $this->assign("keyword", $keyword);
            }
        }

        $this->display();
    }

    public function del_img()
    {
        $pigcms_id = ($_GET["pigcms_id"] ? intval($_GET["pigcms_id"]) : 0);

        if ($keyword = D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->find()) {
            D("Keyword")->where(array("pigcms_id" => $pigcms_id, "mer_id" => $this->merchant_session["mer_id"]))->delete();
            $this->redirect(U("Weixin/img"));
        }
        else {
            $this->error("不合法的请求");
        }
    }

    public function img()
    {
        $count = D("Keyword")->where(array("mer_id" => $this->merchant_session["mer_id"], "table" => "Source_material"))->count("pigcms_id");
        import("@.ORG.merchant_page");
        $p = new Page($count, 10);
        $list = D("Keyword")->where(array("mer_id" => $this->merchant_session["mer_id"], "table" => "Source_material"))->order("pigcms_id DESC")->limit($p->firstRow . "," . $p->listRows)->select();
        $ids = array();

        foreach ($list as $l ) {
            $ids[] = $l["from_id"];
        }

        $sources = D("Source_material")->where(array(
    "pigcms_id" => array("in", $ids)
    ))->order("pigcms_id DESC")->limit($p->firstRow . "," . $p->listRows)->select();
        $it_ids = array();
        $temp = array();

        foreach ($sources as $so ) {
            foreach (unserialize($so["it_ids"]) as $id ) {
                if (!in_array($id, $it_ids)) {
                    $it_ids[] = $id;
                }
            }
        }

        $result = array();
        $image_text = D("Image_text")->field("pigcms_id, title")->where(array(
    "pigcms_id" => array("in", $it_ids)
    ))->order("pigcms_id asc")->select();

        foreach ($image_text as $txt ) {
            $result[$txt["pigcms_id"]] = $txt;
        }

        $tuwen_list = array();

        foreach ($sources as $s ) {
            $s["dateline"] = date("Y-m-d H:i:s", $s["dateline"]);

            foreach (unserialize($s["it_ids"]) as $id ) {
                $s["list"][] = ($result[$id] ? $result[$id] : array());
            }

            $tuwen_list[$s["pigcms_id"]] = $s;
        }

        foreach ($list as &$li ) {
            $li["list"] = ($tuwen_list[$li["from_id"]]["list"] ? $tuwen_list[$li["from_id"]]["list"] : array());
        }

        $this->assign("lists", $list);
        $this->assign("page", $p->show());
        $this->display();
    }

    public function auto()
    {
        $type = ($_REQUEST["type"] ? intval($_REQUEST["type"]) : 0);

        if ($type == 0) {
            $this->assign("tips", "关注时");
        }
        else if ($type == 1) {
            $this->assign("tips", "无效词");
        }
        else {
            $this->assign("tips", "图片");
        }

        $this->assign("type", $type);

        if (IS_POST) {
            $type = ($_POST["type"] ? intval($_POST["type"]) : 0);
            $reply_type = ($_POST["reply_type"] ? intval($_POST["reply_type"]) : 0);
            $is_open = ($_POST["is_open"] ? intval($_POST["is_open"]) : 0);
            $source_id = ($_POST["source_id"] ? intval($_POST["source_id"]) : 0);
            $content = ($_POST["content"] ? htmlspecialchars($_POST["content"]) : "");
            if ($reply_type && $content) {
                $this->assign("error", "回复内容 不可为空白.");
                $this->display();
                exit();
            }

            if ($reply_type == 1) {
                $data = D("Source_material")->where(array("mer_id" => $this->merchant_session["mer_id"], "pigcms_id" => $source_id))->find();

                if ($data) {
                    $this->assign("error", "选择了不存在的文图.");
                    $this->display();
                    exit();
                }
            }

            if ($other = D("Reply_other")->where(array("mer_id" => $this->merchant_session["mer_id"], "type" => $type))->find()) {
                D("Reply_other")->where(array("mer_id" => $this->merchant_session["mer_id"], "type" => $type))->data(array("content" => $content, "from_id" => $source_id, "reply_type" => $reply_type, "is_open" => $is_open))->save();
                $this->success("更新成功");
            }
            else {
                D("Reply_other")->data(array("mer_id" => $this->merchant_session["mer_id"], "type" => $type, "content" => $content, "from_id" => $source_id, "reply_type" => $reply_type, "is_open" => $is_open))->add();
                $this->success("创建成功");
            }
        }
        else {
            $list = D("Source_material")->where(array("mer_id" => $this->merchant_session["mer_id"]))->order("pigcms_id DESC")->select();
            $it_ids = array();
            $temp = array();

            foreach ($list as $l ) {
                foreach (unserialize($l["it_ids"]) as $id ) {
                    if (!in_array($id, $it_ids)) {
                        $it_ids[] = $id;
                    }
                }
            }

            $result = array();
            $image_text = D("Image_text")->field("pigcms_id, title")->where(array(
    "pigcms_id" => array("in", $it_ids)
    ))->order("pigcms_id asc")->select();

            foreach ($image_text as $txt ) {
                $result[$txt["pigcms_id"]] = $txt;
            }

            foreach ($list as &$l ) {
                $l["dateline"] = date("Y-m-d H:i:s", $l["dateline"]);

                foreach (unserialize($l["it_ids"]) as $id ) {
                    $l["list"][] = ($result[$id] ? $result[$id] : array());
                }
            }

            $this->assign("list", $list);
            $other = D("Reply_other")->where(array("mer_id" => $this->merchant_session["mer_id"], "type" => $type))->find();
            $this->assign("other", $other);
            $this->display();
        }
    }
}


?>
