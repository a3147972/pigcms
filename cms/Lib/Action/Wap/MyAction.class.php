<?php
class MyAction extends BaseAction{
	public $now_user;
	public $user_level;
	public function __construct(){
		parent::__construct();

		if(empty($this->user_session)){
			$location_param = array();
			if($_SERVER['HTTP_REFERER']){
				$location_param['referer'] = urlencode($_SERVER['HTTP_REFERER']);
			}
			redirect(U('Login/index',$location_param));
		}
		
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			session('user',null);
			$this->error_tips('未获取到您的帐号信息，请重新登录！',U('Login/index'));
		}
		$now_user['now_money'] = floatval($now_user['now_money']);
		$this->now_user = $now_user;
		$this->assign('now_user',$now_user);
		$levelDb=M('User_level');
		$tmparr=$levelDb->where('22=22')->order('id ASC')->select();
		$levelarr=array();
		if($tmparr){
		   foreach($tmparr as $vv){
		      $levelarr[$vv['level']]=$vv;
		   }
		}
		
		$this->user_level=$levelarr;
		unset($tmparr,$levelarr);
		$this->assign('levelarr', $this->user_level);
	}
	public function index(){
		$this->display();
	}
	public function myinfo(){
		$this->display();
	}
	public function username(){
		if(IS_POST){
			if(empty($_POST['nickname'])){
				$this->assign('error','请输入新用户名！');
			}else if($_POST['nickname'] == $this->now_user['nickname']){
				$this->assign('error','您还没有修改用户名！');
			}else{
				$result = D('User')->save_user($this->now_user['uid'],'nickname',$_POST['nickname']);
				if($result['error']){
					$this->assign('error',$result['msg']);
				}else{
					redirect(U('My/myinfo',array('OkMsg'=>urlencode('昵称修改成功'))));
				}
			}
		}
		$this->display();
	}
	public function password(){
		if(IS_POST){
			if(!empty($this->now_user['pwd']) && md5($_POST['currentpassword']) != $this->now_user['pwd']){
				$this->assign('error','当前密码输入错误！');
			}else if($_POST['currentpassword'] == $_POST['password']){
				$this->assign('error','新密码不能和当前密码相同！');
			}else if($_POST['password2'] != $_POST['password']){
				$this->assign('error','两次新密码输入不一致！');
			}else{
				$result = D('User')->save_user($this->now_user['uid'],'pwd',md5($_POST['password']));
				if($result['error']){
					$this->assign('error',$result['msg']);
				}else{
					redirect(U('My/myinfo',array('OkMsg'=>urlencode('密码修改成功'))));
				}
			}
		}
		$this->display();
	}
	public function bind_user(){
		if(IS_POST){
			if(!empty($this->now_user['phone'])){
				$_SESSION['user']['phone'] = $this->now_user['phone'];
				$this->error('您已经绑定过手机号！不允许多次绑定。');
			}
			if(empty($_POST['phone'])){
				$this->error('请输入手机号码！');
			}
			if(empty($_POST['password'])){
				$this->error('请输入密码！');
			}
			$database_user = D('User');
			$condition_user['phone'] = $_POST['phone'];
			if($database_user->field('`uid`')->where($condition_user)->find()){
				$this->error('手机号码已经存在！');
			}
			$condition_save_user['uid'] = $this->now_user['uid'];
			$data_save_user['phone'] = $_POST['phone'];
			$data_save_user['pwd'] = md5($_POST['password']);
			if($database_user->where($condition_save_user)->data($data_save_user)->save()){
				$_SESSION['user']['phone'] = $_POST['phone'];
				$this->success('手机号码绑定成功！');
			}else{
				$this->error('手机号码绑定失败！请重试。');
			}
		}
		if(!empty($this->now_user['phone'])){
			$this->error_tips('您已经绑定过手机号！不允许多次绑定。');
		}
		$referer = !empty($_GET['referer']) ? $_GET['referer'] : $_SERVER['HTTP_REFERER'];
		$this->assign('referer',$referer);
		$this->display();
	}
	/*优惠券操作*/
	public function card(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$coupon_list = D('Member_card_coupon')->get_all_coupon($this->user_session['uid']);
		$this->assign('coupon_list',$coupon_list);
		
		$this->display();
	}
	
	/*选择优惠券*/
	public function select_card(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		//以下代码是为了得到商户的mer_id ，并且判断此订单是否存在！
		if($_GET['type'] == 'group'){
			$now_order = D('Group_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else if($_GET['type'] == 'meal'){
			$now_order = D('Meal_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else if($_GET['type'] == 'weidian'){
			$now_order = D('Weidian_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else{
			$this->error_tips('来源非法，请检查后再访问。');
		}
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}
		
		$this->assign('back_url',U('Pay/check',$_GET));
		
		$card_list = D('Member_card_coupon')->get_coupon($now_order['mer_id'],$this->user_session['uid']);
		if(!empty($card_list)){
			$param = $_GET;
			foreach($card_list as &$value){
				$param['card_id'] =$value['record_id'];
				$value['select_url'] = U('Pay/check',$param);
			}
			$this->assign('card_list',$card_list);
		}
		$this->display();
	}
	
	/*地址操作*/
	public function adress(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$adress_list = D('User_adress')->get_adress_list($this->user_session['uid']);

		if(empty($adress_list)){
			redirect(U('My/edit_adress',$_GET));
		}else{
			if($_GET['group_id']){
				$select_url = 'Group/buy';
			} elseif ($_GET['store_id']) {
				if ($_GET['buy_type'] == 'waimai') {
					$select_url = 'Takeout/sureOrder';
				} else {
					$select_url = 'Meal/cart';
				}
			}
			if($select_url){
				$this->assign('back_url',U($select_url,$_GET));
			}else{
				$this->assign('back_url',U('My/myinfo'));
			}
			
			$param = $_GET;
				
			foreach($adress_list as $key=>$value){
				$param['adress_id'] = $value['adress_id'];
				if(!empty($select_url)){
					$adress_list[$key]['select_url'] = U($select_url,$param);
				}
				$adress_list[$key]['edit_url'] = U('My/edit_adress',$param);
				$adress_list[$key]['del_url'] = U('My/del_adress',$param);
			}
			
			
			$this->assign('adress_list',$adress_list);
			$this->display();
		}
	}
	/*添加编辑地址*/
	public function edit_adress(){
		if(IS_POST){
			if(D('User_adress')->post_form_save($this->user_session['uid'])){
				$this->success('保存成功！');
			}else{
				$this->error('地址保存失败！请重试');
			}
		}else{
			$database_area = D('Area');
			if($_GET['adress_id']){
				$now_adress = D('User_adress')->get_adress($this->user_session['uid'],$_GET['adress_id']);
				if(empty($now_adress)){
					$this->error_tips('该地址不存在');
				}
				$this->assign('now_adress',$now_adress);
				
				$province_list = $database_area->get_arealist_by_areaPid(0);
				$this->assign('province_list',$province_list);
					
				$city_list = $database_area->get_arealist_by_areaPid($now_adress['province']);
				$this->assign('city_list',$city_list);
					
				$area_list = $database_area->get_arealist_by_areaPid($now_adress['city']);
				$this->assign('area_list',$area_list);
			}else{
				$now_city_area = $database_area->where(array('area_id'=>$this->config['now_city']))->find();
				$this->assign('now_city_area',$now_city_area);
				
				$province_list = $database_area->get_arealist_by_areaPid(0);
				$this->assign('province_list',$province_list);
					
				$city_list = $database_area->get_arealist_by_areaPid($now_city_area['area_pid']);
				$this->assign('city_list',$city_list);
					
				$area_list = $database_area->get_arealist_by_areaPid($now_city_area['area_id']);
				$this->assign('area_list',$area_list);
			}
			
			$params = $_GET;
			unset($params['adress_id']);
			$this->assign('params',$params);
		}
		
		$this->display();
	}
	/*删除地址*/
	public function del_adress(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$result = D('User_adress')->delete_adress($this->user_session['uid'],$_GET['adress_id']);
		if($result){
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
	public function select_area(){
		$area_list = D('Area')->get_arealist_by_areaPid($_POST['pid']);
		if(!empty($area_list)){
			$return['error'] = 0;
			$return['list'] = $area_list;
		}else{
			$return['error'] = 1;
		}
		echo json_encode($return);
	}
	/*全部团购*/
	public function group_order_list(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$order_list = D('Group')->wap_get_order_list($this->user_session['uid'],intval($_GET['status']));
		$this->assign('order_list',$order_list);

		$this->display();
	}
	/*团购收藏*/
	public function group_collect(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$this->assign(D('Group')->wap_get_group_collect_list($this->user_session['uid']));
		
		$this->display();
	}
	/*团购详情*/
	public function group_order(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$otherrm = isset($_GET['otherrm']) ? intval($_GET['otherrm']) : 0;
		$otherrm && $_SESSION['otherwc'] = null;
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$now_order['status_txt'] = '未付款';
		}else if(empty($now_order['third_id']) && $now_order['pay_type'] == 'offline'){
			$now_order['status_txt'] = '线下未付款';
		}else if(empty($now_order['status'])){
			if($now_order['tuan_type'] != 2){
				$now_order['status_txt'] = '未消费';
			}else{
				$now_order['status_txt'] = '未发货';
			}
		}else if($now_order['status'] == '1'){
			$now_order['status_txt'] = '待评价';
		}else if($now_order['status'] == '2'){
			$now_order['status_txt'] = '已完成';
		}else if($now_order['status'] == '3'){
			$now_order['status_txt'] = '已退款';
			$now_order['group_pass_txt'] = '退款订单无法查看';
		}
		$this->assign('now_order',$now_order);
		// dump($now_order);

		$this->display();
	}
	/*团购详情*/
	public function meal_order_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$orderid = intval($_GET['orderid']);
		$store_id = intval($_GET['store_id']);
		$now_order = M("Meal_order")->where(array('order_id' => $orderid, 'mer_id' => $this->mer_id, 'store_id' => $store_id))->find();
		if (empty($now_order)) {
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			if ($now_order['meal_type']) {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			} else {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			}
		}
		$now_order['price'] = $now_order['pay_money'];
		$this->assign('now_order',$now_order);
		$this->display();
	}
	//取消订单
	public function meal_order_check_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$orderid = intval($_GET['orderid']);
		$store_id = intval($_GET['store_id']);
		$now_order = M("Meal_order")->where(array('order_id' => $orderid, 'mer_id' => $this->mer_id, 'store_id' => $store_id))->find();
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			if ($now_order['meal_type']) {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			} else {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			}
		}
		$now_order['price'] = $now_order['pay_money'];
		$data_meal_order['pay_money'] = 0;
		$data_meal_order['paid'] = 0;
		//在线付款退款
		if($now_order['pay_type'] == 'offline'){
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize(array('refund_time'=>time()));
			$data_meal_order['status'] = 3;
			if(D('Meal_order')->data($data_meal_order)->save()){
				if ($now_order['meal_type']) {
					$this->success_tips('您使用的是线下支付！订单状态已修改为已退款。',U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
				} else {
					$this->success_tips('您使用的是线下支付！订单状态已修改为已退款。',U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
				}
				exit;
			}else{
				$this->error_tips('取消订单失败！请重试。');
			}
		}
		if($now_order['payment_money'] != '0.00'){
			$pay_method = D('Config')->get_pay_method();
			if(empty($pay_method)){
				$this->error_tips('系统管理员没开启任一一种支付方式！');
			}
			if(empty($pay_method[$now_order['pay_type']])){
				$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
			}
		
			$pay_class_name = ucfirst($now_order['pay_type']);
			$import_result = import('@.ORG.pay.'.$pay_class_name);
			if(empty($import_result)){
				$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
			}
			$now_order['order_type'] = 'meal';
			$pay_class = new $pay_class_name($now_order,$now_order['payment_money'],$now_order['pay_type'],$pay_method[$now_order['pay_type']]['config'],$this->user_session,1);
			$go_refund_param = $pay_class->refund();
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($go_refund_param['refund_param']);
			if(empty($go_refund_param['error']) && $go_refund_param['type'] == 'ok'){
				$data_meal_order['status'] = 3;			
			}
			D('Meal_order')->data($data_meal_order)->save();
			if($data_meal_order['status'] != 3){	
				$this->error_tips($go_refund_param['msg']);
			}
		}
		//如果使用了优惠券
		if($now_order['card_id']){
			$result = D('Member_card_coupon')->add_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_meal_order['status'] = 3;
			D('Meal_order')->data($data_meal_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		//平台余额退款
		if($now_order['balance_pay'] != '0.00'){
			$add_result = D('User')->add_money($now_order['uid'],$now_order['balance_pay'],'退款 '.$now_order['order_name'].' 增加余额');
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_meal_order['status'] = 3;
			D('Meal_order')->data($data_meal_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
			
// 			if($add_result['error_code']){
// 				$this->error_tips($add_result['msg']);
// 			}
// 			$go_refund_param['msg'] = $add_result['msg'];
			
// 			$data_meal_order['order_id'] = $now_order['order_id'];
// 			$data_meal_order['refund_detail'] = serialize(array('refund_time'=>time()));
// 			$data_meal_order['status'] = 3;
// 			D('Meal_order')->data($data_meal_order)->save();
		}
		//商家会员卡余额退款
		if($now_order['merchant_balance'] != '0.00'){
			$result = D('Member_card')->add_card($now_order['uid'],$now_order['mer_id'],$now_order['merchant_balance'],'退款 '.$now_order['order_name'].' 增加余额');
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_meal_order['status'] = 3;
			D('Meal_order')->data($data_meal_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		
		//退款打印
		$mer_store = D('Merchant_store')->where(array('mer_id' => $this->mer_id, 'store_id' => $store_id))->find();
		$msg = array();
		$msg['user_name'] = $now_order['name'];
		$msg['user_phone'] = $now_order['phone'];
		$msg['user_address'] = $now_order['address'];
		$msg['user_message'] = $now_order['note'];
		$msg['buy_time'] = date("Y-m-d H:i:s", $now_order['dateline']);
		$msg['goods_list'] = unserialize($now_order['info']);
		$msg['goods_count'] = $now_order['total'];
		$msg['goods_price'] = $now_order['price'];
		$msg['orderid'] = $now_order['order_id'];
		$msg['pay_status'] = '客户退款';
		$msg['pay_type'] = $now_order['pay_type'];
		$msg['store_name'] = $mer_store['name'];
		$msg['store_phone'] = $mer_store['phone'];
		$msg['store_address'] = $mer_store['adress'];
		$msg = ArrayToStr::array_to_str($msg, 0, $this->config['print_format']);
		$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
		$op->printit($this->mer_id, $store_id, $msg, 1);
		
		$sms_data = array('mer_id' => $mer_store['mer_id'], 'store_id' => $mer_store['store_id'], 'type' => 'food');
		if ($this->config['sms_cancel_order'] == 1 || $this->config['sms_cancel_order'] == 3) {
			$sms_data['uid'] = $now_order['uid'];
			$sms_data['mobile'] = $now_order['phone'];
			$sms_data['sendto'] = 'user';
			$sms_data['content'] = '您在 ' . $mer_store['name'] . '店中下的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已被您取消并退款，欢迎再次光临！';
			Sms::sendSms($sms_data);
		}
		if ($this->config['sms_cancel_order'] == 2 || $this->config['sms_cancel_order'] == 3) {
			$sms_data['uid'] = 0;
			$sms_data['mobile'] = $merchant['phone'];
			$sms_data['sendto'] = 'merchant';
			$sms_data['content'] = '顾客' . $now_order['name'] . '的预定订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已客户取消并退款！';
			Sms::sendSms($sms_data);
		}
		
		if ($now_order['meal_type']) {
			$this->success_tips($go_refund_param['msg'], U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
		} else {
			$this->success_tips($go_refund_param['msg'], U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
		}
	}
	/*团购详情*/
	public function group_order_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			$this->error_tips('订单必须是未消费状态才能取消！',U('My/group_order',array('order_id'=>$now_order['order_id'])));
		}
		$this->assign('now_order',$now_order);
		$this->display();
	}
	//取消订单
	public function group_order_check_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			$this->error_tips('订单必须是未消费状态才能取消！',U('My/group_order',array('order_id'=>$now_order['order_id'])));
		}
		//在线付款退款
		if($now_order['pay_type'] == 'offline'){
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize(array('refund_time'=>time()));
			$data_group_order['status'] = 3;
			if(D('Group_order')->data($data_group_order)->save()){
				$this->success_tips('您使用的是线下支付！订单状态已修改为已退款。',U('My/group_order',array('order_id'=>$now_order['order_id'])));
				exit;
			}else{
				$this->error_tips('取消订单失败！请重试。');
			}
		}
		if($now_order['payment_money'] != '0.00'){
			$pay_method = D('Config')->get_pay_method();
			if(empty($pay_method)){
				$this->error_tips('系统管理员没开启任一一种支付方式！');
			}
			if(empty($pay_method[$now_order['pay_type']])){
				$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
			}
		
			$pay_class_name = ucfirst($now_order['pay_type']);
			$import_result = import('@.ORG.pay.'.$pay_class_name);
			if(empty($import_result)){
				$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
			}
			$now_order['order_type'] = 'group';
			$pay_class = new $pay_class_name($now_order,$now_order['payment_money'],$now_order['pay_type'],$pay_method[$now_order['pay_type']]['config'],$this->user_session,1);
			$go_refund_param = $pay_class->refund();
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($go_refund_param['refund_param']);
			if(empty($go_refund_param['error']) && $go_refund_param['type'] == 'ok'){
				$data_group_order['status'] = 3;			
			}
			D('Group_order')->data($data_group_order)->save();
			if($data_group_order['status'] != 3){	
				$this->error_tips($go_refund_param['msg']);
			}
		}
		//如果使用了优惠券
		if($now_order['card_id']){
			$result = D('Member_card_coupon')->add_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_group_order['status'] = 3;
			D('Group_order')->data($data_group_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
// 			$use_result = D('Member_card_coupon')->add_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
// 			if($use_result['error_code']){
// 				$this->error_tips($use_result['msg']);
// 			}
			
		}
		//平台余额退款
		if($now_order['balance_pay'] != '0.00'){
			$add_result = D('User')->add_money($now_order['uid'],$now_order['balance_pay'],'退款 '.$now_order['order_name'].' 增加余额');
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_group_order['status'] = 3;
			D('Group_order')->data($data_group_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		//商家会员卡余额退款
		if($now_order['merchant_balance'] != '0.00'){
			$result = D('Member_card')->add_card($now_order['uid'],$now_order['mer_id'],$now_order['merchant_balance'],'退款 '.$now_order['order_name'].' 增加余额');
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_group_order['status'] = 3;
			D('Group_order')->data($data_group_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		
		$sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
		if ($this->config['sms_cancel_order'] == 1 || $this->config['sms_cancel_order'] == 3) {
			$sms_data['uid'] = $now_order['uid'];
			$sms_data['mobile'] = $now_order['phone'];
			$sms_data['sendto'] = 'user';
			$sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已被您取消并退款，欢迎再次光临！';
			Sms::sendSms($sms_data);
		}
		if ($this->config['sms_cancel_order'] == 2 || $this->config['sms_cancel_order'] == 3) {
			$merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
			$sms_data['uid'] = 0;
			$sms_data['mobile'] = $merchant['phone'];
			$sms_data['sendto'] = 'merchant';
			$sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已被客户取消并退款！';
			Sms::sendSms($sms_data);
		}
		$this->success_tips($go_refund_param['msg'],U('My/group_order',array('order_id'=>$now_order['order_id'])));
	}
	
	/*删除团购订单*/
	public function group_order_del(){
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']));
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}else if($now_order['paid']){
			$this->error_tips('当前订单已付款，不能删除。');
		}
		$condition_group_order['order_id'] = $now_order['order_id'];
		$data_group_order['status'] = 4;
		if(D('Group_order')->where($condition_group_order)->data($data_group_order)->save()){
			$this->success_tips('删除成功！',U('My/group_order_list'));
		}else{
			$this->error_tips('删除失败！请重试。');
		}
	}
	/*店铺收藏*/
	public function group_store_collect(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$this->assign(D('Merchant_store')->wap_get_store_collect_list($this->user_session['uid']));
		$this->display();
	}
	    /*     * *图片上传** */

    public function ajaxImgUpload() {
		$mulu=isset($_GET['ml']) ? trim($_GET['ml']):'group';
		$mulu=!empty($mulu) ? $mulu : 'group';
        $filename = trim($_POST['filename']);
        $img = $_POST[$filename];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imgdata = base64_decode($img);
		$img_order_id = sprintf("%09d",$this->user_session['uid']);
		$rand_num = mt_rand(10,99).'/'.substr($img_order_id,0,3).'/'.substr($img_order_id,3,3).'/'.substr($img_order_id,6,3);
        $getupload_dir = "/upload/reply/".$mulu."/" .$rand_num;

        $upload_dir = "." . $getupload_dir;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $newfilename = $mulu.'_' . date('YmdHis') . '.jpg';
        $save = file_put_contents($upload_dir . '/' . $newfilename, $imgdata);
		$save = file_put_contents($upload_dir . '/m_' . $newfilename, $imgdata);
		$save = file_put_contents($upload_dir . '/s_' . $newfilename, $imgdata);
        if ($save) {
            $this->dexit(array('error' => 0, 'data' => array('code' => 1, 'siteurl'=>$this->config['site_url'],'imgurl' =>$getupload_dir . '/' . $newfilename, 'msg' => '')));
        } else {
            $this->dexit(array('error' => 1, 'data' => array('code' => 0, 'url' => '', 'msg' => '保存失败！')));
        }
    }
	/*团购评价*/
	public function group_feedback(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		$this->assign('now_order',$now_order);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单未付款！无法评论');
		}
		if(empty($now_order['status'])){
			$this->error_tips('当前订单未消费！无法评论');
		}
		if($now_order['status'] == 2){
			$this->error_tips('当前订单已评论');
		}
		if(IS_POST){
			$score = intval($_POST['score']);
			if($score > 5 || $score < 1){
				$this->error_tips('评分只能1到5分');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$pic_ids=array();
			if(!empty($inputimg)){
				$database_reply_pic = D('Reply_pic');
				foreach($inputimg as $imgv){
					$imgv=str_replace('/upload/reply/group/','',$imgv);
					$imgtmp=explode('/',$imgv);
					$imgname=$imgtmp[count($imgtmp)-1];
					$reply_pic['name'] = $imgname;
					$reply_pic['pic'] = str_replace('/'.$imgname,'',$imgv).','.$imgname;
					$reply_pic['uid'] = $this->user_session['uid'];
					$reply_pic['order_type'] = '0';
					$reply_pic['order_id'] = intval($now_order['order_id']);
					$reply_pic['add_time'] = $_SERVER['REQUEST_TIME'];
					$pic_ids[] = $database_reply_pic->data($reply_pic)->add();
				}
			 }
			$database_reply = D('Reply');
			$data_reply['parent_id'] = $now_order['group_id'];
			$data_reply['store_id'] = $now_order['store_id'];
			$data_reply['mer_id'] = $now_order['mer_id'];
			$data_reply['score'] = $score;
			$data_reply['order_type'] = '0';
			$data_reply['order_id'] = intval($now_order['order_id']);
			$data_reply['anonymous'] = intval($_POST['anonymous']);
			$data_reply['comment'] = $_POST['comment'];
			$data_reply['uid'] = $this->user_session['uid'];
			$data_reply['pic'] = !empty($pic_ids) ? implode(',',$pic_ids):'';
			$data_reply['add_time'] = $_SERVER['REQUEST_TIME'];
			$data_reply['add_ip'] = get_client_ip(1);
			if($database_reply->data($data_reply)->add()){
				D('Group')->setInc_group_reply($now_order,$score);
				D('Group_order')->change_status($now_order['order_id'],2);
			$database_merchant_score = D('Merchant_score');
			$now_merchant_score = $database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['mer_id'],'type'=>'1'))->find();
			if(empty($now_merchant_score)){
				$data_merchant_score['parent_id'] = $now_order['mer_id'];
				$data_merchant_score['type'] = '1';
				$data_merchant_score['score_all'] = $score;
				$data_merchant_score['reply_count'] = 1;
				$database_merchant_score->data($data_merchant_score)->add();
			}else{
				$data_merchant_score['score_all'] = $now_merchant_score['score_all']+$score;
				$data_merchant_score['reply_count'] = $now_merchant_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_merchant_score['pigcms_id']))->data($data_merchant_score)->save();
			}
			$now_store_score=$database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['store_id'],'type'=>'2'))->find();
			if(empty($now_store_score)){
				$data_store_score['parent_id'] = $now_order['store_id'];
				$data_store_score['type'] = '2';
				$data_store_score['score_all'] = $score;
				$data_store_score['reply_count'] = 1;
				$database_merchant_score->data($data_store_score)->add();
			}else{
				$data_store_score['score_all'] = $now_store_score['score_all']+$score;
				$data_store_score['reply_count'] = $now_store_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_store_score['pigcms_id']))->data($data_store_score)->save();
			}
				$this->success_tips('评论成功',U('My/group_order',array('order_id'=>$now_order['order_id'])));
			}else{
				$this->error_tips('评论失败');
			}
		}
		$this->display();
	}
	/*订餐OR外卖评价*/
	public function meal_feedback(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Meal_order')->where(array('uid' => $this->user_session['uid'], 'order_id' => intval($_GET['order_id'])))->find();
		$this->assign('now_order',$now_order);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单未付款！无法评论');
		}
		if(empty($now_order['status'])){
			$this->error_tips('当前订单未消费！无法评论');
		}
		if($now_order['status'] == 2){
			$this->error_tips('当前订单已评论');
		}
		if(IS_POST){
			$score = intval($_POST['score']);
			if($score > 5 || $score < 1){
				$this->error_tips('评分只能1到5分');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$pic_ids=array();
			if(!empty($inputimg)){
				$database_reply_pic = D('Reply_pic');
				foreach($inputimg as $imgv){
					$imgv=str_replace('/upload/reply/meal/','',$imgv);
					$imgtmp=explode('/',$imgv);
					$imgname=$imgtmp[count($imgtmp)-1];
					$reply_pic['name'] = $imgname;
					$reply_pic['pic'] = str_replace('/'.$imgname,'',$imgv).','.$imgname;
					$reply_pic['uid'] = $this->user_session['uid'];
					$reply_pic['order_type'] = '1';
					$reply_pic['order_id'] = intval($now_order['order_id']);
					$reply_pic['add_time'] = $_SERVER['REQUEST_TIME'];
					$pic_ids[] = $database_reply_pic->data($reply_pic)->add();
				}
			 }
			$database_reply = D('Reply');
			$data_reply['parent_id'] = $now_order['store_id'];
			$data_reply['store_id'] = $now_order['store_id'];
			$data_reply['mer_id'] = $now_order['mer_id'];
			$data_reply['score'] = $score;
			$data_reply['order_type'] = '1';
			$data_reply['order_id'] = intval($now_order['order_id']);
			$data_reply['anonymous'] = intval($_POST['anonymous']);
			$data_reply['comment'] = $_POST['comment'];
			$data_reply['uid'] = $this->user_session['uid'];
			$data_reply['pic'] = !empty($pic_ids) ? implode(',',$pic_ids):'';
			$data_reply['add_time'] = $_SERVER['REQUEST_TIME'];
			$data_reply['add_ip'] = get_client_ip(1);
			if ($database_reply->data($data_reply)->add()) {
				D('Merchant_store')->setInc_meal_reply($now_order,$score);
				D('Meal_order')->change_status($now_order['order_id'],2);

			$database_merchant_score = D('Merchant_score');
			$now_merchant_score = $database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['mer_id'],'type'=>'1'))->find();
			if(empty($now_merchant_score)){
				$data_merchant_score['parent_id'] = $now_order['mer_id'];
				$data_merchant_score['type'] = '1';
				$data_merchant_score['score_all'] = $score;
				$data_merchant_score['reply_count'] = 1;
				$database_merchant_score->data($data_merchant_score)->add();
			}else{
				$data_merchant_score['score_all'] = $now_merchant_score['score_all']+$score;
				$data_merchant_score['reply_count'] = $now_merchant_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_merchant_score['pigcms_id']))->data($data_merchant_score)->save();
			}
			$now_store_score=$database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['store_id'],'type'=>'2'))->find();
			if(empty($now_store_score)){
				$data_store_score['parent_id'] = $now_order['store_id'];
				$data_store_score['type'] = '2';
				$data_store_score['score_all'] = $score;
				$data_store_score['reply_count'] = 1;
				$database_merchant_score->data($data_store_score)->add();
			}else{
				$data_store_score['score_all'] = $now_store_score['score_all']+$score;
				$data_store_score['reply_count'] = $now_store_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_store_score['pigcms_id']))->data($data_store_score)->save();
			}

				if ($now_order['meal_type']) {
					$this->success_tips('评论成功', U('Takeout/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
				} else {
					$this->success_tips('评论成功', U('Food/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
				}
			} else{
				$this->error_tips('评论失败');
			}
		}
		$this->display();
	}
	/*全部订餐订单列表*/
	public function meal_order_list(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$status = isset($_GET['status']) ? intval($_GET['status']) : 0;
		$where = " uid={$this->user_session['uid']} AND status<=3";//array('uid' => $this->user_session['uid'], 'status' => array('lt', 3));
		if ($status == -1) {
			$where .= " AND paid=0";
			$where['paid'] = 0;
		} elseif ($status == 1) {
			$where .= " AND paid=1 AND status=0";
		} elseif ($status == 2) {
			$where .= " AND paid=1 AND status=1";
		}
// 		$status == -1 && $where['paid'] = 0;
// 		$status == 1 && $where['status'] = 0;
// 		$status == 2 && $where['status'] = 1;
		$order_list = D("Meal_order")->field(true)->where($where)->order('order_id DESC')->select();
		$temp = $store_ids = array();
		foreach ($order_list as $st) {
			$store_ids[] = $st['store_id'];
		}
		$m = array();
		if ($store_ids) {
			$store_image_class = new store_image();
			$merchant_list = D("Merchant_store")->where(array('store_id' => array('in', $store_ids)))->select();
			foreach ($merchant_list as $li) {
				$images = $store_image_class->get_allImage_by_path($li['pic_info']);
				$li['image'] = $images ? array_shift($images) : array();
				unset($li['status']);
				$m[$li['store_id']] = $li;
			}
		}
		$list = array();
		foreach ($order_list as $ol) {
			if (isset($m[$ol['store_id']]) && $m[$ol['store_id']]) {
				$list[] = array_merge($ol, $m[$ol['store_id']]);
			} else {
				$list[] = $ol;
			}
		}
		$this->assign('order_list', $list);
		
		$this->display();
	}
	
	/*优惠券列表*/
	public function card_list(){
		// if(!$this->is_wexin_browser){
			// $this->error_tips('请使用微信浏览优惠券！');
		// }
		$use = empty($_GET['use']) ? '0' : '1';
		$card_list = D('Member_card_coupon')->get_all_coupon($this->user_session['uid'],$use);

		$this->assign('card_list',$card_list);
		
		$this->display();
	}
	
	
	public function cards()
	{

		$card_list = D('Member_card_set')->get_all_card($this->user_session['uid']);
		
		$this->assign('card_list',$card_list);
		
		$this->display();
	}
	public function order_list()
	{
		$type = isset($_GET['type']) ? intval($_GET['type']) : 1 ;
		if ($type == 1) {
			$order_list = D('Group')->wap_get_order_list($this->user_session['uid']);
			$this->assign('order_list',$order_list);
		} else {
			$where = array('uid' => $this->user_session['uid'], 'status' => array('lt', 3));
			$order_list = D("Meal_order")->field(true)->where($where)->order('order_id DESC')->select();
			$temp = $store_ids = array();
			foreach ($order_list as $st) {
				$store_ids[] = $st['store_id'];
			}
			$m = array();
			if ($store_ids) {
				$store_image_class = new store_image();
				$merchant_list = D("Merchant_store")->where(array('store_id' => array('in', $store_ids)))->select();
				foreach ($merchant_list as $li) {
					$images = $store_image_class->get_allImage_by_path($li['pic_info']);
					$li['image'] = $images ? array_shift($images) : array();
					unset($li['status']);
					$m[$li['store_id']] = $li;
				}
			}
			$list = array();
			foreach ($order_list as $ol) {
				if (isset($m[$ol['store_id']]) && $m[$ol['store_id']]) {
					$list[] = array_merge($ol, $m[$ol['store_id']]);
				} else {
					$list[] = $ol;
				}
			}
			$this->assign('order_list', $list);
		}
		$this->assign('type', $type);
		$this->display();
	}
	
	public function join_lottery()
	{
		$result = D('Lottery')->join_lottery($this->user_session['uid']);
		$this->assign($result);
		$this->display();
	}
	
	public function follow_merchant()
	{
		$mod = new Model();
		//$_SESSION['openid'] = 'onfo6tySRgO5tYJtkJ4tAueQI51g';
		$sql = "SELECT b.* FROM  ". C('DB_PREFIX') . "merchant_user_relation AS a INNER JOIN  ". C('DB_PREFIX') . "merchant as b ON a.mer_id=b.mer_id WHERE a.openid='{$_SESSION['openid']}'";
		$res = $mod->query($sql);
		
		$merchant_image_class = new merchant_image();
		foreach ($res as &$r) {
			$images = explode(";", $r['pic_info']);
			$images = explode(";", $images[0]);
			$r['img'] = $merchant_image_class->get_image_by_path($images[0]);
			$r['url'] = C('config.site_url').'/wap.php?c=Index&a=index&token=' . $r['mer_id'];
		}
		$this->assign('follow_list', $res);
		$this->display();
	}
	
	public function cancel_follow()
	{
		$mer_id = isset($_GET['mer_id']) ? intval($_GET['mer_id']) : 0;
		if (D('Merchant_user_relation')->where(array('mer_id' => $mer_id, 'openid' => $_SESSION['openid']))->delete()) {
			D('Merchant')->where(array('mer_id' => $mer_id))->setDec('fans_count');
			$this->success_tips('取消关注成功', U('My/follow_merchant'));
		} else {
			$this->error_tips('取消关注失败，请稍后重试', U('My/follow_merchant'));
		}
	}
	
	public function recharge(){
		if(IS_POST){
			$data_user_recharge_order['uid'] = $this->now_user['uid'];
			$money = floatval($_POST['money']);
			if(empty($money) || $money > 10000){
				$this->error('请输入有效的金额！最高不能超过1万元。');
			}
			$data_user_recharge_order['money'] = $money;
			// $data_user_recharge_order['order_name'] = '帐户余额在线充值';
			$data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
			if($order_id = D('User_recharge_order')->data($data_user_recharge_order)->add()){
				redirect(U('Pay/check',array('order_id'=>$order_id,'type'=>'recharge')));
			}
		}else{
			$this->display();
		}
	}
	public function lifeservice(){
		$order_list = D('Service_order')->field(true)->where(array('uid'=>$this->user_session['uid'],'status'=>array('neq','0')))->order('`order_id` DESC')->select();
		foreach($order_list as &$value){
			$value['type_txt'] = $this->lifeservice_type_txt($value['type']);
			$value['type_eng'] = $this->lifeservice_type_eng($value['type']);
			$value['infoArr'] = unserialize($value['info']);
			$value['order_url'] = U('My/lifeservice_detail',array('id'=>$value['order_id']));
		}
		$this->assign('order_list', $order_list);
		// dump($order_list);
		$this->display();
	}
	public function lifeservice_detail(){
		$now_order = D('Service_order')->field(true)->where(array('order_id'=>$_GET['id']))->find();
		$now_order['infoArr'] = unserialize($now_order['info']);
		$now_order['type_txt'] = $this->lifeservice_type_txt($now_order['type']);
		$now_order['type_eng'] = $this->lifeservice_type_eng($now_order['type']);
		$now_order['pay_money'] = floatval($now_order['pay_money']);
		$this->assign('now_order', $now_order);
		// dump($order_list);
		$this->display();
	}
	protected function lifeservice_type_txt($type){
		switch($type){
			case '1':
				$type_txt = '水费';
				break;
			case '2':
				$type_txt = '电费';
				break;
			case '3':
				$type_txt = '煤气费';
				break;
			default:
				$type_txt = '生活服务';
		}
		return $type_txt;
	}
	protected function lifeservice_type_eng($type){
		switch($type){
			case '1':
				$type_txt = 'water';
				break;
			case '2':
				$type_txt = 'electric';
				break;
			case '3':
				$type_txt = 'gas';
				break;
			default:
				$type_txt = 'life';
		}
		return $type_txt;
	}

    /****等级升级****/
	public function levelUpdate(){
	    
	   $this->display();
	}

	/*     * json 格式封装函数* */

    private function dexit($data = '') {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }

}
	
?>