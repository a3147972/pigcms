<?php

class LifeserviceAction extends BaseAction
{
	protected $liveServiceTypeArr;
	protected $api_path = 'http://life-service.meihua.com/api/';

	public function __construct()
	{
		parent::__construct();

		if (empty($this->config['live_service_type'])) {
			$this->error_tips('暂不支持生活缴费！');
		}

		$this->liveServiceTypeArr = explode(',', $this->config['live_service_type']);
	}

	public function index()
	{
		$this->assign('liveServiceTypeArr', $this->liveServiceTypeArr);
		$this->display();
	}

	public function query()
	{
		if (!(true == in_array($_GET['type'], $this->liveServiceTypeArr))) {
			$this->error_tips('暂不支持缴水费！');
		}

		if ($this->user_session) {
			$last_order = d('Service_order')->field('`info`')->where(array('type' => $this->get_type_num($_GET['type']), 'uid' => $this->user_session['uid']))->order('`order_id` DESC')->find();

			if ($last_order) {
				$this->assign('user_info', unserialize($last_order['info']));
			}
		}

		$now_city = d('Area')->field('`area_id`,`area_name`')->where(array('area_id' => $this->config['now_city']))->find();
		$this->assign('now_city', $now_city);
		$this->assign('query_type', $this->get_type_txt($_GET['type']));
		$this->display();
	}

	public function post()
	{
		header('Content-type: application/json');

		if (empty($this->user_session)) {
			exit(json_encode(array('err_code' => 99, 'err_msg' => '您需要先进行登录')));
		}

		if (IS_POST && (true == IS_AJAX)) {
			switch ($_POST['type']) {
			case 'water':
			case 'electric':
			case 'gas':
				exit(in_array($_POST['type'], $this->liveServiceTypeArr) ? $this->get_debt($_POST['account'], $_POST['type']) : json_encode(array('err_code' => 1001, 'err_msg' => '不支持该类型欠费的信息查询')));
			case 'water_recharge':
			case 'electric_recharge':
			case 'gas_recharge':
				exit(in_array(str_replace('_recharge', '', $_POST['type']), $this->liveServiceTypeArr) ? $this->recharge($_POST['id'], $_POST['balance']) : json_encode(array('err_code' => 1002, 'err_msg' => '不支持该类型的缴费')));
			case 'water_check':
			case 'electric_check':
			case 'gas_check':
				exit(in_array(str_replace('_check', '', $_POST['type']), $this->liveServiceTypeArr) ? $this->check($_POST['id']) : json_encode(array('err_code' => 1002, 'err_msg' => '不支持该类型缴费的信息查询')));
			}
		}
		else {
			exit(json_encode(array('err_code' => 1000, 'err_msg' => '非法访问')));
		}
	}

	protected function get_debt($account, $type)
	{
		$api_data = array();
		$api_data['app_id'] = $this->config['live_service_appid'];
		$api_data['type'] = $type;
		$api_data['city_id'] = $this->config['now_city'];
		$api_data['account'] = $account;
		$api_data['key'] = $this->get_encrypt_key($api_data, $this->config['live_service_appkey']);
		$return = $this->curl_post($this->api_path . 'app_debt.php', $api_data);
		$returnArr = json_decode($return, true);

		if (!(true == isset($returnArr['err_code']))) {
			return json_encode(array('err_code' => 1003, 'err_msg' => '请求查询失败，请重试'));
		}

		if (0 == $returnArr['err_code']) {
			$data_service_order['third_id'] = $returnArr['orderId'];
			$data_service_order['status'] = 0;
			$data_service_order['uid'] = $this->user_session['uid'];
			$data_service_order['balance'] = $returnArr['balance'];
			$data_service_order['type'] = ($type == 'water' ? '1' : ($type == 'electric' ? '2' : '3'));
			$data_service_order['add_time'] = $_SERVER['REQUEST_TIME'];
			$data_service_order['info'] = serialize(array('account' => $returnArr['account'], 'accountName' => $returnArr['accountName'], 'cityName' => $returnArr['cityName'], 'contractNo' => $returnArr['contractNo'], 'payType' => $returnArr['payType'], 'payUnitName' => $returnArr['payUnitName'], 'provinceName' => $returnArr['provinceName']));

			if ($returnArr['orderId'] = d('Service_order')->data($data_service_order)->add()) {
				return json_encode($returnArr);
			}
			else {
				return json_encode(array('err_code' => 1004, 'err_msg' => '网站内部异常，请重试'));
			}
		}

		return $return;
	}

	protected function recharge($id, $balance)
	{
		if (empty($id)) {
			return json_encode(array('err_code' => 1005, 'err_msg' => '网站内部异常，请重试'));
		}

		if (empty($balance)) {
			return json_encode(array('err_code' => 1006, 'err_msg' => '请求时没有携带缴费金额参数'));
		}

		$now_user = d('User')->get_user($this->user_session['uid']);

		if ($now_user['now_money'] < $balance) {
			return json_encode(array('err_code' => 98, 'recharge_money' => $balance - $now_user['now_money'], 'err_msg' => '您的帐户余额为 <span>' . $now_user['now_money'] . '</span> 元，请先充值帐户余额！需要充值 ' . ($balance - $now_user['now_money']) . ' 元'));
		}

		$now_order = d('Service_order')->field(true)->where(array('order_id' => $id))->find();

		if (empty($now_order)) {
			return json_encode(array('err_code' => 1009, 'err_msg' => '该订单不存在'));
		}

		if (1 == $now_order['status']) {
			return json_encode(array('err_code' => 1010, 'err_msg' => '该订单已经付款'));
		}

		$api_data = array();
		$api_data['app_id'] = $this->config['live_service_appid'];
		$api_data['order_id'] = $now_order['third_id'];
		$api_data['key'] = $this->get_encrypt_key($api_data, $this->config['live_service_appkey']);
		$return = $this->curl_post($this->api_path . 'app_recharge.php', $api_data);
		$returnArr = json_decode($return, true);

		if (!(true == isset($returnArr['err_code']))) {
			return json_encode(array('err_code' => 1003, 'err_msg' => '请求查询失败，请重试'));
		}

		if (0 == $returnArr['err_code']) {
			d('Service_order')->where(array('order_id' => $id))->data(array('status' => $returnArr['status'], 'pay_time' => $returnArr['pay_time'], 'pay_money' => $returnArr['ordercash']))->save();
			$money_pay_result = d('User')->user_money($now_user['uid'], $returnArr['ordercash'], '充值 ' . $this->get_type_txt($now_order['type']));

			if ($now_user['openid']) {
				$href = $this->config['site_url'] . '/wap.php?c=My&a=lifeservice_detail&id=' . $id;
				$model = new templateNews($this->config['wechat_appid'], $this->config['wechat_appsecret']);
				$model->sendTempMsg('TM01008', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->get_type_txt($now_order['type']) . '缴费 下单成功', 'keynote1' => $returnArr['unitName'], 'keynote2' => '户号 ' . $returnArr['account'], 'remark' => '下单时间：' . date('Y年n月j日 H:i', $returnArr['pay_time']) . '\\n' . '缴费金额：￥' . $returnArr['ordercash']));
			}

			return json_encode(array('err_code' => 0, 'err_msg' => '已成功下订单'));
		}

		return $return;
	}

	protected function check($id)
	{
		if (empty($id)) {
			return json_encode(array('err_code' => 1005, 'err_msg' => '网站内部异常，请重试'));
		}

		$now_user = d('User')->get_user($this->user_session['uid']);
		$now_order = d('Service_order')->field(true)->where(array('order_id' => $id))->find();

		if (2 == $now_order['status']) {
			return json_encode(array('err_code' => 1006, 'err_msg' => '该订单已经缴费到帐'));
		}

		if (3 == $now_order['status']) {
			return json_encode(array('err_code' => 1007, 'err_msg' => '该订单充值失败，钱已经回到您的帐户余额中'));
		}

		$api_data = array();
		$api_data['app_id'] = $this->config['live_service_appid'];
		$api_data['order_id'] = $now_order['third_id'];
		$api_data['key'] = $this->get_encrypt_key($api_data, $this->config['live_service_appkey']);
		$return = $this->curl_post($this->api_path . 'app_check.php', $api_data);
		$returnArr = json_decode($return, true);

		if (!(true == isset($returnArr['err_code']))) {
			return json_encode(array('err_code' => 1003, 'err_msg' => '请求查询失败，请重试'));
		}

		if (0 == $returnArr['err_code']) {
			d('Service_order')->where(array('order_id' => $id))->data(array('status' => $returnArr['status'], 'transfer_time' => $returnArr['transfer_time']))->save();

			if ($now_user['openid']) {
				$href = $this->config['site_url'] . '/wap.php?c=My&a=lifeservice_detail&id=' . $id;
				$model = new templateNews($this->config['wechat_appid'], $this->config['wechat_appsecret']);
				$model->sendTempMsg('TM01008', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->get_type_txt($now_order['type']) . '缴费成功提醒', 'keynote1' => $returnArr['unitName'], 'keynote2' => '户号 ' . $returnArr['account'], 'remark' => '缴费时间：' . date('Y年n月j日 H:i', $returnArr['transfer_time']) . '\\n' . '缴费金额：￥' . $now_order['pay_money']));
			}

			return json_encode(array('err_code' => 0, 'err_msg' => '充值成功，缴费已到帐！'));
		}
		else {
			if (10001 == $returnArr['err_code']) {
				if (d('Service_order')->where(array('order_id' => $id))->data(array('status' => 3, 'error_time' => $returnArr['err_msg']))->save()) {
					$money_pay_result = d('User')->add_money($now_user['uid'], $now_order['pay_money'], '充值 ' . $this->get_type_txt($now_order['type']) . '失败，返回到帐户中');
				}

				return json_encode(array('err_code' => 10001, 'err_msg' => '充值失败，钱已经回到您的帐户余额中'));
			}
		}

		return $return;
	}

	protected function get_type_txt($type)
	{
		switch ($type) {
		case '1':
		case 'water':
			$type_txt = '水费';
			break;

		case '2':
		case 'electric':
			$type_txt = '电费';
			break;

		case '3':
		case 'gas':
			$type_txt = '煤气费';
			break;

		default:
			$type_txt = '生活服务';
		}

		return $type_txt;
	}

	protected function get_type_num($type)
	{
		switch ($type) {
		case 'water':
			$type_num = 1;
			break;
		case 'electric':
			$type_num = 2;
			break;

		case 'gas':
			$type_num = 3;
			break;
		default:
			$type_num = 0;
		}

		return $type_num;
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
