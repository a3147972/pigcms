<?php

class ApiAction extends CommonAction
{

    public function index()
    {
		$data['app_id'] = $_POST['app_id'];
		$data['from_openid'] = $_POST['from_openid'];
		$data['from_nickname'] = $_POST['from_nickname'];
		$data['from_avatar'] = $_POST['from_avatar'];
		$data['to_openid'] = $_POST['to_openid'];
		$data['msg'] = $_POST['msg'];
		$data['time'] = $_POST['time'];
		$data['url'] = htmlspecialchars_decode($_POST['url']);
		$post_key = $_POST['key'];
		$create_key = $this->get_im_encrypt_key($data, $this->config['im_appkey']);

        if ($post_key == $create_key) {
			$model = new templateNews($this->config['wechat_appid'], $this->config['wechat_appsecret']);
			$model->sendTempMsg('TM00356', array('href' => $data['url'], 'wecha_id' => $data['to_openid'], 'first' => '您的好友“' . $data['from_nickname'] . '”给您发来了一条新消息！', 'work' => '请点击查看', 'remark' => ''));
			echo 'success';
        }
        else {
			$html = '';

			foreach ($data as $key => $value) {
				$html .= $key . '=>' . $value;
			}
			echo 'error';
        }
    }

    public function my()
    {
        $activity_arr = array();
        $activity_arr[] = array(
			array('title' => $this->config['group_alias_name'] . '订单', 'intro' => $this->config['group_alias_name'] . '订单', 'image' => $this->config['site_url'] . '/static/images/im/tubaio1_03.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=My&a=group_order_list'),
			array('title' => '我的收藏', 'intro' => '我的收藏', 'image' => $this->config['site_url'] . '/static/images/im/tubaio1_06.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=My&a=group_collect')
            );
		$activity_arr[] = array('title' => $this->config['meal_alias_name'] . '订单', 'intro' => $this->config['meal_alias_name'] . '订单', 'image' => $this->config['site_url'] . '/static/images/im/tubaio1_08.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=My&a=meal_order_list');
		$activity_arr[] = array('title' => '我的优惠券', 'intro' => '我的优惠券', 'image' => $this->config['site_url'] . '/static/images/im/tubaio1_10.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=My&a=card_list');
		$this->ok_jsonp_return(array('data' => $activity_arr));
    }

    public function activity()
    {
        $activity_arr = array();
		$activity_arr[] = array('title' => '附近优惠', 'intro' => '附近优惠', 'image' => $this->config['site_url'] . '/static/images/im/tubiao_03.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=Group&a=around');
        $activity_arr[] = array(
			array('title' => '找餐厅', 'intro' => '找餐厅', 'image' => $this->config['site_url'] . '/static/images/im/tubiao_06.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=Meal_list&a=index'),
			array('title' => '找活动', 'intro' => '找活动', 'image' => $this->config['site_url'] . '/static/images/im/tubiao_08.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=Activity&a=index'),
			array('title' => '看商家', 'intro' => '看商家', 'image' => $this->config['site_url'] . '/static/images/im/tubiao_10.png', 'url' => $this->config['site_url'] . '/wap.php?c=Merchant&a=around')
            );
		$activity_arr[] = array('title' => '平台中心', 'intro' => '平台中心', 'image' => $this->config['site_url'] . '/static/images/im/tubiao_12.png', 'url' => $this->config['site_url'] . '/wap.php?g=Wap&c=Home&a=index');
		$this->ok_jsonp_return(array('data' => $activity_arr));
    }

	public function test()
    	{
		$xml = file_get_contents('php://input');
		$xml = new SimpleXMLElement($xml);
		$xml || exit();
		foreach ($xml as $key => $value) {
			$data[$key] = strval($value);
   		 }

		$wechat = new Wetest($data);
		$t = array('test', 'text');
		$type = $t[1];
		$content = $t[0];

		if ($content) {
			exit($wechat->response($content, $type));
        	}
		else {
			exit();
		}
    	}
}


?>
