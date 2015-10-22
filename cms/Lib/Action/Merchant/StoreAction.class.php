<?php
class StoreAction extends BaseAction
{
	protected $staff_session;
	protected $store;

	protected function _initialize()
	{
		parent::_initialize();
		$this->staff_session = session('staff');

		if (ACTION_NAME != 'login') {
			if (empty($this->staff_session)) {
				redirect(U('Store/login'));
				exit();
			}
			else {
				$this->assign('staff_session', $this->staff_session);
				$database_merchant_store = D('Merchant_store');
				$condition_merchant_store['store_id'] = $this->staff_session['store_id'];
				$this->store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();

				if (empty($this->store)) {
					$this->error('店铺不存在！');
				}
			}
		}
	}

	public function login()
	{
		if (IS_POST) {
			if (md5($_POST['verify']) != $_SESSION['merchant_store_login_verify']) {
				exit(json_encode(array('error' => '1', 'msg' => '验证码不正确！', 'dom_id' => 'verify')));
			}

			$database_store_staff = D('Merchant_store_staff');
			$condition_store_staff['username'] = $_POST['account'];
			$now_staff = $database_store_staff->field(true)->where($condition_store_staff)->find();

			if (empty($now_staff)) {
				exit(json_encode(array('error' => '2', 'msg' => '帐号不存在！', 'dom_id' => 'account')));
			}

			$pwd = md5($_POST['pwd']);

			if ($pwd != $now_staff['password']) {
				exit(json_encode(array('error' => '3', 'msg' => '密码错误！', 'dom_id' => 'pwd')));
			}

			$data_store_staff['id'] = $now_staff['id'];
			$data_store_staff['last_time'] = $_SERVER['REQUEST_TIME'];

			if ($database_store_staff->data($data_store_staff)->save()) {
				session('staff', $now_staff);
				exit(json_encode(array('error' => '0', 'msg' => '登录成功,现在跳转~', 'dom_id' => 'account')));
			}
			else {
				exit(json_encode(array('error' => '6', 'msg' => '登录信息保存失败,请重试！', 'dom_id' => 'account')));
			}
		}
		else {
			$this->display();
		}
	}

	public function index()
	{
		if (!empty($this->store['have_group'])) {
			redirect(U('Store/group_list'));
		}
		else {
			redirect(U('Store/meal_list'));
		}

		exit();
	}

	protected function check_group()
	{
		if (empty($this->store['have_group'])) {
			$this->error('您访问的店铺没有开通团购功能！');
		}
	}

	public function group_list()
	{
		$this->check_group();
		$store_id = $this->store['store_id'];
		$condition_where = '`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`store_id`=\'' . $store_id . '\'';
		$condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o', C('DB_PREFIX') . 'user' => 'u');
		$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();
		$this->assign('order_list', $order_list);
		$this->display();
	}

	public function group_find()
	{
		if (IS_POST) {
			$mer_id = $this->store['mer_id'];
			$condition_where = '`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`mer_id`=\'' . $mer_id . '\'';
			$find_value = $_POST['find_value'];
			$store_id = $this->store['store_id'];
			if (($_POST['find_type'] == 1) && (strlen($find_value) == 14)) {
				$condition_where .= ' AND `o`.`group_pass`=\'' . $find_value . '\'';
			}
			else {
				$condition_where .= ' AND `o`.`store_id`=\'' . $store_id . '\'';

				if ($_POST['find_type'] == 1) {
					$condition_where .= ' AND `o`.`group_pass` like \'' . $find_value . '%\'';
				}
				else if ($_POST['find_type'] == 2) {
					$condition_where .= ' AND `o`.`express_id` like \'' . $find_value . '%\'';
				}
				else if ($_POST['find_type'] == 3) {
					$condition_where .= ' AND `o`.`order_id`=\'' . $find_value . '\'';
				}
				else if ($_POST['find_type'] == 4) {
					$condition_where .= ' AND `o`.`group_id`=\'' . $find_value . '\'';
				}
				else if ($_POST['find_type'] == 5) {
					$condition_where .= ' AND `o`.`uid`=\'' . $find_value . '\'';
				}
				else if ($_POST['find_type'] == 6) {
					$condition_where .= ' AND `u`.`nickname` like \'' . $find_value . '%\'';
				}
				else if ($_POST['find_type'] == 7) {
					$condition_where .= ' AND `o`.`phone` like \'' . $find_value . '%\'';
				}
			}

			$condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o', C('DB_PREFIX') . 'user' => 'u');
			$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();

			if ($order_list) {
				foreach ($order_list as $key => $value) {
					$order_list[$key]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
					$order_list[$key]['pay_time'] = date('Y-m-d H:i:s', $value['pay_time']);
				}
			}

			$return['list'] = $order_list;
			$return['row_count'] = count($order_list);
			echo json_encode($return);
		}
		else {
			$this->check_group();
			$this->display();
		}
	}

	public function group_verify()
	{
		$this->check_group();
		$database_group_order = D('Group_order');
		$now_order = $database_group_order->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], false);

		if (empty($now_order)) {
			$this->error('当前订单不存在！');
		}
		else {
			if ($now_order['paid'] && ($now_order['status'] == 0)) {
				$condition_group_order['order_id'] = $now_order['order_id'];
				if (empty($now_order['third_id']) && ($now_order['pay_type'] == 'offline')) {
					$data_group_order['third_id'] = $now_order['order_id'];
				}

				$data_group_order['status'] = '1';
				$data_group_order['store_id'] = $this->store['store_id'];
				$data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
				$data_group_order['last_staff'] = $this->staff_session['name'];

				if ($database_group_order->where($condition_group_order)->data($data_group_order)->save()) {
					$this->success('验证成功！');
				}
				else {
					$this->error('验证失败！请重试。');
				}
			}
			else {
				$this->error('当前订单的状态并不是未消费。');
			}
		}
	}

	public function group_edit()
	{
		$this->check_group();
		$now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], false);
		$this->assign('now_order', $now_order);

		if (empty($now_order)) {
			exit('此订单不存在！');
		}

		if (($now_order['tuan_type'] == 2) && ($now_order['paid'] == 1)) {
			$express_list = D('Express')->get_express_list();
			$this->assign('express_list', $express_list);
		}

		$this->display();
	}

	public function group_express()
	{
		$this->check_group();
		$now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], false);

		if (empty($now_order)) {
			$this->error('此订单不存在！');
		}

		if (empty($now_order['paid'])) {
			$this->error('此订单尚未支付！');
		}

		$condition_group_order['order_id'] = $now_order['order_id'];
		$data_group_order['express_type'] = $_POST['express_type'];
		$data_group_order['express_id'] = $_POST['express_id'];
		$data_group_order['last_staff'] = $this->staff_session['name'];
		if (($now_order['paid'] == 1) && ($now_order['status'] == 0)) {
			$data_group_order['status'] = 1;
			$data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
			$data_group_order['store_id'] = $this->store['store_id'];
		}

		if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
			$this->success('修改成功！');
		}
		else {
			$this->error('修改失败！请重试。');
		}
	}

	public function group_remark()
	{
		$this->check_group();
		$now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], true, false);

		if (empty($now_order)) {
			$this->error('此订单不存在！');
		}

		if (empty($now_order['paid'])) {
			$this->error('此订单尚未支付！');
		}

		$condition_group_order['order_id'] = $now_order['order_id'];
		$data_group_order['merchant_remark'] = $_POST['merchant_remark'];

		if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
			$this->success('修改成功！');
		}
		else {
			$this->error('修改失败！请重试。');
		}
	}

	protected function check_meal()
	{
		if (empty($this->store['have_meal'])) {
			$this->error('您访问的店铺没有开通订餐功能！');
		}
	}

	public function meal_list()
	{
		$this->check_meal();
		$store_id = intval($this->store['store_id']);
		$where = array('mer_id' => $this->store['mer_id'], 'store_id' => $store_id);

		if (IS_POST) {
			$order_id = (isset($_POST['order_id']) ? htmlspecialchars($_POST['order_id']) : '');
			$name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');
			$phone = (isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '');
			$meal_pass = (isset($_POST['meal_pass']) ? htmlspecialchars($_POST['meal_pass']) : '');
			$order_id && $where['order_id'] = array('like', '%' . $order_id . '%');
			$name && $where['name'] = array('like', '%' . $name . '%');
			$phone && $where['phone'] = array('like', '%' . $phone . '%');
			$meal_pass && $where['meal_pass'] = array('like', '%' . $meal_pass . '%');
			$this->assign('meal_pass', $meal_pass);
			$this->assign('order_id', $order_id);
			$this->assign('name', $name);
			$this->assign('phone', $phone);
		}

		$count = D('Meal_order')->where($where)->count();
		import('@.ORG.merchant_page');
		$p = new Page($count, 20);
		$list = D('Meal_order')->where($where)->order('order_id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();

		foreach ($list as &$l) {
			$l['info'] = unserialize($l['info']);
		}

		$this->assign('order_list', $list);
		$this->assign('now_store', $this->store);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$this->display();
	}

	public function meal_edit()
	{
		$order_id = (isset($_GET['order_id']) ? intval($_GET['order_id']) : 0);
		$store_id = intval($this->store['store_id']);

		if (IS_POST) {
			if (isset($_POST['status'])) {
				$status = intval($_POST['status']);

				if ($order = D('Meal_order')->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find()) {
					$data = array('store_uid' => $this->staff_session['id'], 'status' => $status);
					if (empty($order['third_id']) && ($order['pay_type'] == 'offline')) {
						$order['paid'] = 0;
					}

					if ($status && ($order['paid'] == 0)) {
						$data['third_id'] = $order['order_id'];
						$data['pay_type'] = 'offline';
						$data['paid'] = 1;
					}

					D('Meal_order')->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->save($data);
					$this->success('更新成功', U('Store/meal_list'));
				}
				else {
					$this->error('不合法的请求');
				}
			}
			else {
				$this->redirect(U('Store/meal_list'));
			}
		}
		else {
			$order = D('Meal_order')->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find();
			$order['info'] = unserialize($order['info']);

			if ($order['store_uid']) {
				$staff = D('Merchant_store_staff')->where(array('id' => $order['store_uid']))->find();
				$order['store_uname'] = $staff['name'];
			}

			if (empty($order['third_id']) && ($order['pay_type'] == 'offline')) {
				$order['paid'] = 0;
			}

			$this->assign('order', $order);
			$this->display();
		}
	}

	public function logout()
	{
		session('staff_session', NULL);
		redirect(U('Store/login'));
	}
}

?>
