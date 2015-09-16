<?php

class WeidianAction extends BaseAction
{
    public $weidian_wap_url = "";//"http://v.meihua.com/wap/";
    public $weidian_api_url = "";//"http://v.meihua.com/api/";

    public function redirect()
    {
        if (empty($this->user_session)) {
	    if (!empty($_GET['return_url'])) {
				$_SESSION['weidian_return_url'] = $_GET['return_url'];
            }

            $this->error_tips("请先登录！", U("Login/index", array("referer" => urlencode(U("Weidian/redirect", array("token" => $_GET["token"], "store_id" => $_GET["store_id"]))))));
        }

		if ((false == empty($_GET['token'])) && (false == empty($_GET['store_id']))) {
			$data = array('token' => $_GET['token'], 'wecha_id' => $this->user_session['uid'], 'wechaname' => $this->user_session['nickname'], 'portrait' => $this->user_session['avatar'], 'tel' => $this->user_session['phone'], 'return_url' => $_GET['return_url'] ? $_GET['return_url'] : ($_SESSION['weidian_return_url'] ? $_SESSION['weidian_return_url'] : ''), 'address' => '', 'store_id' => $_GET['store_id']);
            $sort_data = $data;
			$sort_data['salt'] = 'pigcms';
            ksort($sort_data);
            $sign_key = sha1(http_build_query($sort_data));
			$data['sign_key'] = $sign_key;
			$data['request_time'] = $_SERVER['REQUEST_TIME'];
			$result = $this->curl_post($this->weidian_api_url . 'fans.php', $data);

            if ($result) {
                $json_arr = json_decode($result, true);

				if ($json_arr['error_code']) {
					$this->error('操作失败，请重试。');
                }
                else {
					redirect($json_arr['return_url']);
                }
            }
            else {
				$this->error_tips('操作失败，请重试。');
            }
        }
        else {
            $this->error_tips("参数缺失，无法跳转！请返回重试。");
        }
    }

    public function near_store_redirect()
    {
		redirect($this->weidian_wap_url . 'nearweidian.php?domain=' . urlencode($this->config['site_url']));
    }

	public function getImUrl()
	{
		if ($_GET['token'] && (true == $_GET['wecha_id'])) {
			$services = d('Customer_service')->where(array('mer_id' => $_GET['token']))->select();
			if (empty($services)) {
				$this->error_tips('该商家未设置客服');
			}
			$now_user = d('User')->get_user($_GET['wecha_id']);
			if (empty($now_user) || (true == empty($now_user['openid']))) {
				$this->error_tips('系统中没有查找到您的用户信息');
			}
			$key = $this->get_encrypt_key(array('app_id' => $this->config['im_appid'], 'openid' => $now_user['openid']), $this->config['im_appkey']);
			$kf_url = 'http://im-link.meihua.com/?app_id=' . $this->config['im_appid'] . '&openid=' . $now_user['openid'] . '&key=' . $key . '#serviceList_' . $_GET['token'];
			redirect($kf_url);
		}
		else {
			$this->error_tips('访问方式不对，请返回重试');
		}
	}
    public function api_msg()
    {
        if ($_POST["type"] == 3) {
            $now_user = D("User")->get_user($_POST["wecha_id"]);
            if ($now_user && !empty($now_user["openid"])) {
                $model = new templateNews(C("config.wechat_appid"), C("config.wechat_appsecret"));
                $model->sendTempMsg("OPENTM202521011", array("href" => $_POST["href"], "wecha_id" => $now_user["openid"], "first" => "尊敬的用户您好，您的订单已完成。", "keyword1" => $_POST["order_detail"]["order_no"], "keyword2" => date("m月d日,H:i", $_POST["order_detail"]["complate_time"]), "remark" => "如有任何疑问，请您及时联系商家"));
            }
        }
    }

    protected function curl_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        return curl_exec($ch);
    }
}


?>
