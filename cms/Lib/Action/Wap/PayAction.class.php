<?php
class PayAction extends BaseAction{
	public function check(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		if(empty($this->user_session['phone'])){
			$this->error_tips('为了保护您的权益，在付款之前您必须绑定手机号码！',U('My/bind_user',array('referer'=>urlencode(U('Pay/check',$_GET)))));
		}
		if(!in_array($_GET['type'],array('group','meal','weidian','takeout', 'food','recharge'))){
			$this->error_tips('订单来源无法识别，请重试。');
		}
		if($_GET['type'] == 'group'){
			$now_order = D('Group_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']));
		}else if($_GET['type'] == 'meal' || $_GET['type'] == 'takeout' || $_GET['type'] == 'food'){
			$now_order = D('Meal_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']), false, $_GET['type']);
		}else if($_GET['type'] == 'weidian'){
			$now_order = D('Weidian_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']));
		}else if($_GET['type'] == 'recharge'){
			$now_order = D('User_recharge_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']));
		}else{
			$this->error_tips('非法的订单');
		}
		
		if($now_order['error'] == 1){
			if($now_order['url']){
				$this->error_tips($now_order['msg'],$now_order['url']);
			}else{
				$this->error_tips($now_order['msg']);
			}
		}
		$order_info = $now_order['order_info'];
		$this->assign('order_info',$order_info);
		
		//得到微信优惠金额,判断用户能否购买此团购
		$cheap_info = array('can_buy'=>true,'can_cheap'=>false,'wx_cheap'=>0);
		if($_GET['type'] == 'group'){
			$now_user = D('User')->get_user($this->user_session['uid']);
			if($this->config['weixin_buy_follow_wechat'] == 2 && !empty($_SESSION['openid']) && empty($now_user['is_follow'])){
				$cheap_info['can_buy'] = false;
			}
			$cheap_info['wx_cheap'] = D('Group')->get_group_cheap($order_info['group_id']);
			$cheap_info['wx_cheap'] = $cheap_info['wx_cheap']*$order_info['order_num'];
			if($cheap_info['wx_cheap']){
				$cheap_info['can_cheap'] = true;
				if($_SESSION['openid']){
					if($this->config['weixin_buy_follow_wechat'] == 1 && empty($now_user['is_follow'])){
						$cheap_info['can_cheap'] = false;
					}
				}else{
					$cheap_info['can_cheap'] = false;
				}
			}
		}
		$this->assign('cheap_info',$cheap_info);
		
		//用户信息
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			$this->error_tips('未获取到您的帐号信息，请重试！');
		}
		$now_user['now_money'] = floatval($now_user['now_money']);
		$this->assign('now_user',$now_user);
		
		if($_GET['type'] != 'recharge'){
			//优惠券
			if(!empty($_GET['card_id'])){
				$now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($_GET['card_id'],$this->user_session['uid']);
				$this->assign('now_coupon',$now_coupon);
			}
			//商家会员卡余额
			$merchant_balance = D('Member_card')->get_balance($this->user_session['uid'],$order_info['mer_id']);
			$this->assign('merchant_balance',$merchant_balance);
			
			$pay_money = $order_info['order_total_money'] - $now_coupon['price'] - $merchant_balance - $now_user['now_money'];
		}else{
			$pay_money = $order_info['order_total_money'];
		}
		//需要支付的钱
		$this->assign('pay_money',$pay_money);
		
		//调出支付方式
		$notOnline = intval($_GET['notOnline']);
		if($_GET['type'] != 'recharge'){
			$notOffline = intval($_GET['notOffline']);
		}else{
			$notOffline = 1;
		}
		$pay_method = D('Config')->get_pay_method($notOnline,$notOffline,true);
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}		
		unset($pay_method['alipay']);
		if(empty($_SESSION['openid'])){
			unset($pay_method['weixin']);
		}
		if(empty($pay_method)){
			$this->error_tips('暂时没有可使用的支付方式');
		}
		$this->assign('pay_method',$pay_method);
		
		if($_GET['type'] == 'group'){
			$this->behavior(array('model'=>'Pay_group','mer_id'=>$order_info['mer_id'],'biz_id'=>$order_info['order_id']),true);
		}else if($_GET['type'] == 'meal'){
			$this->behavior(array('model'=>'Play_meal','mer_id'=>$order_info['mer_id'],'biz_id'=>$order_info['order_id']),true);
		}
		
		$this->display();
	}
	public function go_pay(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		if(!in_array($_POST['order_type'],array('group','meal','weidian','takeout','food','recharge'))){
			$this->error_tips('订单来源无法识别，请重试。');
		}
		switch($_POST['order_type']){
			case 'group':
				$now_order = D('Group_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']));
				break;
			case 'meal':
			case 'takeout':
			case 'food':
				$now_order = D('Meal_order')->get_pay_order($this->user_session['uid'], intval($_POST['order_id']), false,  $_POST['order_type']);
				break;
			case 'weidian':
				$now_order = D('Weidian_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']));
				break;
			case 'recharge':
				$now_order = D('User_recharge_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']));
				break;
			default:
				$this->error_tips('非法的订单');
		}
		if($now_order['error'] == 1){
			$this->error_tips($now_order['msg'],$now_order['url']);
		}
		$order_info = $now_order['order_info'];
		
		if($_POST['order_type'] != 'recharge'){
			//优惠券
			if(!empty($_POST['card_id'])){
				$now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($_POST['card_id'],$this->user_session['uid']);
			}
			
			//商家会员卡余额
			$merchant_balance = D('Member_card')->get_balance($this->user_session['uid'],$order_info['mer_id']);
			$this->assign('merchant_balance',$merchant_balance);
		}
		
		//用户信息
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			$this->error_tips('未获取到您的帐号信息，请重试！');
		}

		//如果用户存在余额或使用了优惠券，则保存至订单信息。如果金额满足订单总价，则实时扣除并返回支付成功！若不够则不实时扣除，防止用户在付款过程中取消支付
		$wx_cheap = 0;
		if($order_info['order_type'] == 'group'){
			//判断有没有使用微信，如果是微信，则检测此团购有没有微信优惠！
			if($this->config['weixin_buy_follow_wechat'] == 2 && empty($now_user['is_follow'])){
				$this->error_tips('您未关注公众号，不能购买！请先关注公众号。');
			}elseif($this->config['weixin_buy_follow_wechat'] == 1 && empty($now_user['is_follow'])){
				$wx_cheap = 0;
			}elseif($_SESSION['openid']){
				$now_group = M('Group')->field('`group_id`,`wx_cheap`')->where(array('group_id'=>$order_info['group_id']))->find();
				$wx_cheap = $order_info['order_num'] * $now_group['wx_cheap'];
			}
			$save_result = D('Group_order')->wap_befor_pay($order_info,$now_coupon,$merchant_balance,$now_user,$wx_cheap);
		}else if($order_info['order_type'] == 'meal' || $order_info['order_type'] == 'takeout' || $order_info['order_type'] == 'food'){
			$save_result = D('Meal_order')->wap_befor_pay($order_info,$now_coupon,$merchant_balance,$now_user, $order_info['order_type']);
		}else if($order_info['order_type'] == 'weidian'){
			$save_result = D('Weidian_order')->wap_befor_pay($order_info,$now_coupon,$merchant_balance,$now_user);
		}else if($order_info['order_type'] == 'recharge'){
			$save_result = D('User_recharge_order')->web_befor_pay($order_info,$now_user);
		}
		
		if($save_result['error_code']){
			$this->error_tips($save_result['msg']);
		}else if($save_result['url']){
			$this->success_tips($save_result['msg'],$save_result['url']);
		}

		//需要支付的钱
		$pay_money = $save_result['pay_money'];
		
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$_POST['pay_type']])){
			$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
		}
		
		
		$pay_class_name = ucfirst($_POST['pay_type']);
		$otherwc = session('otherwc');
// 		if ($pay_class_name == 'Weixin' && $otherwc) {
// 			if($_POST['order_type'] == 'group'){
// 				$tid = intval(2000000000+$_POST['order_id']);
// 			} elseif($_POST['order_type'] == 'meal'){
// 				$tid = intval(3000000000+$_POST['order_id']);
// 			}
// 			$qrcode_return = D('Recognition')->get_tmp_qrcode($tid);
// 			if($qrcode_return['error_code']){
// 				echo '<html><head></head><body>'.$qrcode_return['msg'].'<br/><br/><font color="red">请关闭此窗口再打开重试。</font></body></html>';
// 				die;
// 			}else{
// 				$this->assign($qrcode_return);
// 				$this->display('see_tmp_qrcode');
// 				die;
// 			}
// 		}
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
		
		$pay_class = new $pay_class_name($order_info,$pay_money,$_POST['pay_type'],$pay_method[$_POST['pay_type']]['config'],$this->user_session,1);
		$go_pay_param = $pay_class->pay();
		
		if(empty($go_pay_param['error'])){
			if(!empty($go_pay_param['url'])){
				$this->assign('url',$go_pay_param['url']);
				$this->display();
			}else if(!empty($go_pay_param['form'])){
				$this->assign('form',$go_pay_param['form']);
				$this->display();
			}else if(!empty($go_pay_param['weixin_param'])){
				$redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Pay&a=weixin_back&order_type='.$order_info['order_type'].'&order_id='.$order_info['order_id'];
				$this->assign('redirctUrl',$redirctUrl);
				$this->assign('pay_money',$pay_money);
				$this->assign('weixin_param',json_decode($go_pay_param['weixin_param']));
				$this->display('weixin_pay');
			}else{
				$this->error_tips('调用支付发生错误，请重试。');
			}
		}else{
			$this->error_tips($go_pay_param['msg']);
		}
	}
	//微信同步回调页面
	public function weixin_back(){
		switch($_GET['order_type']){
			case 'group':
				$now_order = D('Group_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'meal':
			case 'takeout':
			case 'food':
				$now_order = D('Meal_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'weidian':
				$now_order = D('Weidian_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'recharge':
				$now_order = D('User_recharge_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			default:
				$this->error_tips('非法的订单');
		}
		$now_order['order_type'] = $_GET['order_type'];
		if(empty($now_order)){
			$this->error_tips('该订单不存在');
		}
		if($now_order['paid']){
			switch($_GET['order_type']){
				case 'group':
					$redirctUrl = C('config.site_url').'/wap.php?c=My&a=group_order&order_id='.$now_order['order_id'];
					break;
				case 'meal':
					$redirctUrl = C('config.site_url').'/wap.php?c=Meal&a=detail&orderid='.$now_order['order_id'].'&mer_id='.$now_order['mer_id'].'&store_id='.$now_order['store_id'];
					break;
				case 'takeout':
					$redirctUrl = C('config.site_url').'/wap.php?c=Takeout&a=order_detail&order_id='.$now_order['order_id'].'&mer_id='.$now_order['mer_id'].'&store_id='.$now_order['store_id'];
					break;
				case 'food':
					$redirctUrl = C('config.site_url').'/wap.php?c=Food&a=order_detail&order_id='.$now_order['order_id'].'&mer_id='.$now_order['mer_id'].'&store_id='.$now_order['store_id'];
					break;
				case 'weidian':
					$redirctUrl = D('Weidian_order')->get_weidian_url(array('wecha_id'=>$now_order['uid'],'order_no'=>$now_order['weidian_order_id'],'pay_money'=>$now_order['money'],'third_id'=>$now_order['third_id'],'payment_method'=>$now_order['pay_type']));
					break;
				case 'recharge':
					$redirctUrl = C('config.site_url').'/wap.php?c=My&a=index';
					break;
			}
			redirect($redirctUrl);exit;
		}
		$import_result = import('@.ORG.pay.Weixin');
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		$pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->user_session,1);
		$go_query_param = $pay_class->query_order();
		if($go_query_param['error'] === 0){
			switch($_GET['order_type']){
				case 'group':
					D('Group_order')->after_pay($go_query_param['order_param']);
					break;
				case 'meal':
				case 'takeout':
				case 'food':
					D('Meal_order')->after_pay($go_query_param['order_param'], $_GET['order_type']);
					break;
				case 'weidian':
					D('Weidian_order')->after_pay($go_query_param['order_param']);
					break;
				case 'recharge':
					D('User_recharge_order')->after_pay($go_query_param['order_param']);
					break;
			}
		}
		switch($_GET['order_type']){
			case 'group':
				$redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=My&a=group_order&order_id='.$now_order['order_id'];
				break;
			case 'meal':
				$redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Meal&a=detail&orderid='.$now_order['order_id'].'&mer_id='.$now_order['mer_id'].'&store_id='.$now_order['store_id'];
				break;
			case 'takeout':
				$redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Takeout&a=order_detail&order_id='.$now_order['order_id'].'&mer_id='.$now_order['mer_id'].'&store_id='.$now_order['store_id'];
				break;
			case 'food':
				$redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Food&a=order_detail&order_id='.$now_order['order_id'].'&mer_id='.$now_order['mer_id'].'&store_id='.$now_order['store_id'];
				break;
			case 'weidian':
				$redirctUrl = D('Weidian_order')->get_weidian_url(array('wecha_id'=>$now_order['uid'],'order_no'=>$now_order['weidian_order_id'],'pay_money'=>$now_order['money'],'third_id'=>$go_query_param['order_param']['third_id'],'payment_method'=>$go_query_param['order_param']['pay_type']));
				break;
			case 'recharge':
					$redirctUrl = C('config.site_url').'/wap.php?c=My&a=index';
					break;
		}
		redirect($redirctUrl);
	}
	//异步通知
	public function notify_url(){
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$_GET['pay_type']])){
			$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
		}
		
		$pay_class_name = ucfirst($_GET['pay_type']);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
		
		$pay_class = new $pay_class_name('','',$_GET['pay_type'],$pay_method[$_GET['pay_type']]['config'],$this->user_session,1);
		$notify_return = $pay_class->notice_url();
		
		if(empty($notify_return['error'])){

		}else{
			$this->error_tips($notify_return['msg']);
		}
	}
	
	//跳转通知
	public function return_url(){
		$pay_type = $_GET['pay_type'];
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$pay_type])){
			$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
		}

		$pay_class_name = ucfirst($pay_type);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
	
		$pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,1);
		$get_pay_param = $pay_class->return_url();
		if(empty($get_pay_param['error'])){
			if($get_pay_param['order_param']['order_type'] == 'group'){
				$pay_info = D('Group_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'meal' || $get_pay_param['order_param']['order_type'] == 'takeout' || $get_pay_param['order_param']['order_type'] == 'food'){
				$pay_info = D('Meal_order')->after_pay($get_pay_param['order_param'], $get_pay_param['order_param']['order_type']);			
			}else if($get_pay_param['order_param']['order_type'] == 'weidian'){
				$pay_info = D('Weidian_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'recharge'){
				$pay_info = D('User_recharge_order')->after_pay($get_pay_param['order_param']);			
			}else{
				$this->error_tips('订单类型非法！请重新下单。');
			}
			if(empty($pay_info['error'])){
				if($get_pay_param['order_param']['pay_type'] == 'weixin'){
					exit('<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>');
				}
				$pay_info['msg'] = '订单付款成功！现在跳转.';
			}
			if(empty($pay_info['url'])){
				$this->error_tips($pay_info['msg']);
			}else{
				$pay_info['url'] = preg_replace('#/source/(\w+).php#','/wap.php',$pay_info['url']);
				$this->assign('pay_info',$pay_info);
				$this->display('after_pay');
			}
		}else{
			$this->error_tips($get_pay_param['msg']);
		}
	}
}
?>