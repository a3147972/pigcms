<?php

class WechatShare
{
    private $appId = "";
    private $appSecret = "";
    public $error = array();
    public $token = "";
    public $wecha_id = "";
    public $share_ticket = "";
    public $share_dated = 0;

    public function __construct($config, $wechat_id)
    {
        $this->appId = $config["wechat_appid"] ? $config["wechat_appid"] : "";
        $this->appSecret = $config["wechat_appsecret"] ? $config["wechat_appsecret"] : "";
        $this->token = $config["wechat_token"] ? $config["wechat_token"] : "";
        $this->share_ticket = $config["share_ticket"] ? $config["share_ticket"] : "";
        $this->share_dated = $config["share_dated"] ? $config["share_dated"] : 0;
        $this->wecha_id = $wechat_id;
    }

    public function getSgin()
    {
        $this->checkTicket();
        $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $sign_data = $this->addSign($this->share_ticket, $url);
        $share_html = $this->createHtml($sign_data);
        return $share_html;
    }

    private function checkTicket()
    {
        $now = time();
        if ($this->share_ticket || ($this->share_dated < $now)) {
            $tokenData = D("Access_token_expires")->get_access_token();

            if ($tokenData["errcode"]) {
                $this->error["token_error"] = array("errcode" => $tokenData["errcode"], "errmsg" => $tokenData["errmsg"]);
            }
            else {
                $access_token = $tokenData["access_token"];
                $ticketData = $this->getTicket($access_token);

                if (0 < $ticketData["errcode"]) {
                    $this->error["ticket_error"] = array("errcode" => $ticketData["errcode"], "errmsg" => $ticketData["errmsg"]);
                }
                else {
                    $this->share_ticket = $ticket = $ticketData["ticket"];

                    if ($config = D("Config")->field("name, value")->where(array("name" => "share_ticket"))->find()) {
                        D("Config")->where(array("name" => "share_ticket"))->save(array("value" => $ticketData["ticket"]));
                    }
                    else {
                        D("Config")->add(array("name" => "share_ticket", "value" => $ticketData["ticket"], "gid" => 0));
                    }

                    $this->share_dated = $now + $ticketData["expires_in"];

                    if ($config = D("Config")->field("name, value")->where(array("name" => "share_dated"))->find()) {
                        D("Config")->where(array("name" => "share_dated"))->save(array("value" => $this->share_dated));
                    }
                    else {
                        D("Config")->add(array("name" => "share_dated", "value" => $this->share_dated, "gid" => 0));
                    }

                    S("config", NULL);
                }
            }
        }
    }

    public function gethideOptionMenu()
    {
        $this->checkTicket();
        $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        $sign_data = $this->addSign($this->share_ticket, $url);
        $hide_html = $this->hideOptionMenu($sign_data);
        return $hide_html;
    }

    public function getError()
    {
        dump($this->error);
    }

    public function addSign($ticket, $url)
    {
        $timestamp = time();
        $nonceStr = rand(100000, 999999);
        $array = array("noncestr" => $nonceStr, "jsapi_ticket" => $ticket, "timestamp" => $timestamp, "url" => $url);
        ksort($array);
        $signPars = "";

        foreach ($array as $k => $v ) {
            if (("" != $v) && ("sign" != $k)) {
                if ($signPars == "") {
                    $signPars .= $k . "=" . $v;
                }
                else {
                    $signPars .= "&" . $k . "=" . $v;
                }
            }
        }

        $result = array("appId" => $this->appId, "timestamp" => $timestamp, "nonceStr" => $nonceStr, "url" => $url, "signature" => SHA1($signPars));
        return $result;
    }

    public function getUrl()
    {
        $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        if ($_GET["code"] && $_GET["state"] && ($_GET["state"] == "oauth")) {
            $url = $this->clearUrl($url);

            if ($_GET["wecha_id"]) {
                $url .= "&wecha_id=" . $this->wecha_id;
            }

            return $url;
        }
        else {
            return $url;
        }
    }

    public function clearUrl($url)
    {
        $param = explode("&", $url);
        $i = 0;

        for ($count = count($param); $i < $count; $i++) {
            if (preg_match("/^(code=|state=|wecha_id=).*/", $param[$i])) {
                unset($param[$i]);
            }
        }

        return join("&", $param);
    }

    public function getToken()
    {
        return D("Access_token_expires")->get_access_token();
    }

    public function getTicket($token)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $token . "&type=jsapi";
        return $this->https_request($url);
    }

    public function hideOptionMenu($sign_data)
    {
        $html = "\t<script type=\"text/javascript\" src=\"http://res.wx.qq.com/open/js/jweixin-1.0.0.js\"></script>\r\n\t<script type=\"text/javascript\">\r\n\t\twx.config({\r\n\t\t  debug: false,\r\n\t\t  appId: \t'{$sign_data["appId"]}',\r\n\t\t  timestamp: {$sign_data["timestamp"]},\r\n\t\t  nonceStr: '{$sign_data["nonceStr"]}',\r\n\t\t  signature: '{$sign_data["signature"]}',\r\n\t\t  jsApiList: [\r\n\t\t    'checkJsApi',\r\n\t\t    'onMenuShareTimeline',\r\n\t\t    'onMenuShareAppMessage',\r\n\t\t    'onMenuShareQQ',\r\n\t\t    'onMenuShareWeibo',\r\n\t\t    'scanQRCode',\r\n\t\t    'previewImage'\r\n\t\t  ]\r\n\t\t});\r\n\t</script>\r\n\t<script type=\"text/javascript\">\r\n\twx.ready(function(){wx.hideOptionMenu();});\r\n\t</script>";
        return $html;
    }

    public function createHtml($sign_data)
    {
        $html = "\t<script type=\"text/javascript\" src=\"http://res.wx.qq.com/open/js/jweixin-1.0.0.js\"></script>\r\n\t<script type=\"text/javascript\">\r\n\t\twx.config({\r\n\t\t  debug: false,\r\n\t\t  appId: \t'{$sign_data["appId"]}',\r\n\t\t  timestamp: {$sign_data["timestamp"]},\r\n\t\t  nonceStr: '{$sign_data["nonceStr"]}',\r\n\t\t  signature: '{$sign_data["signature"]}',\r\n\t\t  jsApiList: [\r\n\t\t    'checkJsApi',\r\n\t\t    'onMenuShareTimeline',\r\n\t\t    'onMenuShareAppMessage',\r\n\t\t    'onMenuShareQQ',\r\n\t\t    'onMenuShareWeibo',\r\n\t\t    'scanQRCode',\r\n\t\t    'previewImage'\r\n\t\t  ]\r\n\t\t});\r\n\t</script>\r\n\t<script type=\"text/javascript\">\r\n\twx.ready(function () {\r\n\t  // 1 判断当前版本是否支持指定 JS 接口，支持批量判断\r\n\t  /*document.querySelector('#checkJsApi').onclick = function () {\r\n\t    wx.checkJsApi({\r\n\t      jsApiList: [\r\n\t        'getNetworkType',\r\n\t        'previewImage'\r\n\t      ],\r\n\t      success: function (res) {\r\n\t        //alert(JSON.stringify(res));\r\n\t      }\r\n\t    });\r\n\t  };*/\r\n\r\n\t  // 2. 分享接口\r\n\t  // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口\r\n\t    wx.onMenuShareAppMessage({\r\n\t\t\ttitle: window.shareData.tTitle,\r\n\t\t\tdesc: window.shareData.tContent,\r\n\t\t\tlink: window.shareData.sendFriendLink + '&openid=' + '$this->wecha_id',\r\n\t\t\timgUrl: window.shareData.imgUrl,\r\n\t\t    type: '', // 分享类型,music、video或link，不填默认为link\r\n\t\t    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空\r\n\t\t    success: function () { \r\n\t\t\t\tshareHandle('frined');\r\n\t\t        //alert('分享朋友成功');\r\n\t\t    },\r\n\t\t    cancel: function () { \r\n\t\t        //alert('分享朋友失败');\r\n\t\t    }\r\n\t\t});\r\n\r\n\r\n\t  // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口\r\n\t\twx.onMenuShareTimeline({\r\n\t\t\ttitle: window.shareData.tTitle,\r\n\t\t\tlink: window.shareData.sendFriendLink + '&openid=' + '$this->wecha_id',\r\n\t\t\timgUrl: window.shareData.imgUrl,\r\n\t\t    success: function () { \r\n\t\t\t\tshareHandle('frineds');\r\n\t\t        //alert('分享朋友圈成功');\r\n\t\t    },\r\n\t\t    cancel: function () { \r\n\t\t        //alert('分享朋友圈失败');\r\n\t\t    }\r\n\t\t});\t\r\n\r\n\t  // 2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口\r\n\t\twx.onMenuShareWeibo({\r\n\t\t\ttitle: window.shareData.tTitle,\r\n\t\t\tdesc: window.shareData.tContent,\r\n\t\t\tlink: window.shareData.sendFriendLink + '&openid=' + '$this->wecha_id',\r\n\t\t\timgUrl: window.shareData.imgUrl,\r\n\t\t    success: function () { \r\n\t\t\t\tshareHandle('weibo');\r\n\t\t       \t//alert('分享微博成功');\r\n\t\t    },\r\n\t\t    cancel: function () { \r\n\t\t        //alert('分享微博失败');\r\n\t\t    }\r\n\t\t});\r\n\t\t\r\n\t});\r\n\t\t\r\n\tfunction shareHandle(to) {\r\n\t\tvar submitData = {\r\n\t\t\tmodule: window.shareData.moduleName,\r\n\t\t\tmoduleid: window.shareData.moduleID,\r\n\t\t\ttoken:'$this->token',\r\n\t\t\twecha_id:'$this->wecha_id',\r\n\t\t\turl: window.shareData.sendFriendLink,\r\n\t\t\tto:to\r\n\t\t};\r\n\t\t\r\n\t}\r\n</script>";
        return $html;
    }

    protected function https_request($url, $data)
    {
        $curl = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $errorno = curl_errno($curl);
        curl_close($curl);

        if ($errorno) {
            return array("curl" => false, "errorno" => $errorno);
        }
        else {
            $res = json_decode($output, 1);

            if ($res["errcode"]) {
                return array("errcode" => $res["errcode"], "errmsg" => $res["errmsg"]);
            }
            else {
                return $res;
            }
        }
    }
}


?>
