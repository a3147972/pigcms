<?php
/*
 * 订餐
 *
 */
class OrderAction extends BaseAction
{
    public function index()
    {
    	$store_id = intval($_GET['store_id']);
    	$shop_cart = isset($_POST['shop_cart']) ? htmlspecialchars($_POST['shop_cart']) : '';
    	
    	if ($shop_cart) {
    		session('shop_cart', $shop_cart);
    	} else {
    		$shop_cart = session('shop_cart');
    	}
		if(empty($shop_cart)){
			$this->assign('jumpUrl',$this->config['site_url'].'/meal/'.$store_id.'.html');
			$this->error('购物车没有商品，请重新下单');
		}
    	$temp = explode(":", $shop_cart);
    	$store_id = $temp[0];
    	$menus = explode("|", $temp[1]);
    	$ids = $list = array();
    	$food_count = 0;
    	foreach ($menus as $m){
    		$t = explode(",", $m);
    		$ids[] = $t[0];
    		$list[$t[0]] = $t[1];
    		$food_count += $t[1];
    	}
    	$meals = D("Meal")->field(true)->where(array('store_id' => $store_id, 'meal_id' => array('in', $ids)))->select();
		if(empty($meals)){
			$this->assign('jumpUrl',$this->config['site_url'].'/meal/'.$store_id.'.html');
			$this->error('购物车的商品不存在，请重新下单');
		}
    	$total = 0;
    	$food_list = array();
    	foreach ($meals as $meal) {
    		$tt = array();
    		$tt['food_id'] = $meal['meal_id'];
    		$tt['food_name'] = $meal['name'];
    		$tt['unit'] = $meal['unit'];
    		$tt['count'] = $list[$meal['meal_id']];
//     		$tt['box_num'] = 1;
//     		$tt['box_price'] = 0;
//     		$tt['single_price'] = $meal['price'];
    		$tt['price'] = $meal['price'];
    		$tt['total'] = $meal['price'] * $tt['count'];
//     		$tt['food_score'] = 0;
//     		$tt['foodComment'] = '';
//     		$tt['is_online_special_meal'] = '';
//     		$tt['original_price'] = $meal['price'];
    		$total += $meal['price'] * $list[$meal['meal_id']];
    		$food_list[] = $tt;
    	}

         //用户等级 优惠
		$finaltotalprice=0;
		$level_off=false;
		$store_meal = D('Merchant_store_meal')->where(array('store_id' => $store_id))->find();
		if(!empty($this->user_level) && !empty($store_meal) && !empty($store_meal['leveloff'])){
			$leveloff=unserialize($store_meal['leveloff']);	
			if(!empty($this->user_session) && isset($this->user_session['level'])){
				/****type:0无优惠 1百分比 2立减*******/
				if(!empty($leveloff) && is_array($leveloff) && isset($this->user_level[$this->user_session['level']]) && isset($leveloff[$this->user_session['level']])){
					$level_off=$leveloff[$this->user_session['level']];
					if($level_off['type']==1){
					  $finaltotalprice = $total *($level_off['vv']/100);
					  $finaltotalprice = $finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
					}elseif($level_off['type']==2){
					  $finaltotalprice = $total-$level_off['vv'];
					  $finaltotalprice = $finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr'] = '此次总价立减'.$level_off['vv'].'元';
					}
				}
			}
			unset($leveloff);
		}
		
		$this->assign('minus_money', 0);
		if (!empty($store_meal['minus_money']) && $total > $store_meal['full_money']) {
			$this->assign('minus_money', $store_meal['minus_money']);
			$this->assign('full_money', $store_meal['full_money']);
		}

		$this->assign('leveloff',$level_off);
    	$this->assign('shop_cart', $shop_cart);
    	$this->assign('total', $total);
		$this->assign('finaltotalprice', round($finaltotalprice,2));
    	$this->assign('food_list', $food_list);
    	
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
    	
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
		
		
		//店铺信息
		$store = D('Merchant_store')->where(array('store_id' => $store_id))->find();
		$this->assign('store', $store);
		$this->display();
    }
	
	public function saveorder()
	{
    	//判断登录
    	if(empty($this->user_session)){
    		$this->assign('jumpUrl',U('Index/Login/index'));
    		$this->error('请先登录！');
    	}
		$store_id = intval($_POST['store_id']);
		$store = D('Merchant_store')->where(array('store_id' => $store_id))->find();
		if (empty($store)) {
			exit(json_encode(array('error_code' => 1, 'msg' => '您查看的餐厅不存在！')));
		}
		if(empty($this->user_session)){
			exit(json_encode(array('error_code' => 1, 'msg' => '请先进行登录！', 'data' => U('Login/index'))));
		}
// 		$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
// 		$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
		
		$address_id = isset($_POST['address_id']) ? intval($_POST['address_id']) : 0;
		$note = isset($_POST['note']) ? htmlspecialchars($_POST['note']) : '';
		if (empty($address_id)) {
			exit(json_encode(array('error_code' => 1, 'msg' => '联系信息不能为空')));
		}

		$now_adress = D('User_adress')->get_one_adress($this->user_session['uid'], $address_id);
		if(empty($now_adress)){
			exit(json_encode(array('error_code'=>1,'msg'=>'请先添加联系信息！')));
		}
		
		$products = isset($_POST['products']) ? $_POST['products'] : '';
		if (empty($products)) {
			exit(json_encode(array('error_code' => 1, 'msg' => '您还没有点菜')));
		}
		$total = $price = 0;
		if ($products) {
// 			$info = array();
// 			foreach ($products as $m) {
// 				$info[] = array('id' => $m['id'],'name' => $m['name'], 'num' => $m['number'], 'price' => $m['price']);
// 				$total += $m['number'];
// 				$price += $m['number'] * $m['price'];
// 			}
			
			
			$temp = explode(":", $products);
			$store_id = $temp[0];
			$menus = explode("|", $temp[1]);
			$ids = $list = array();
			$food_count = 0;
			foreach ($menus as $m){
				$t = explode(",", $m);
				$ids[] = $t[0];
				$list[$t[0]] = $t[1];
				$food_count += $t[1];
			}
			$meals = D("Meal")->field(true)->where(array('store_id' => $store_id, 'meal_id' => array('in', $ids)))->select();
			$info = array();
			foreach ($meals as $m) {
				$info[] = array('id' => $m['meal_id'],'name' => $m['name'], 'num' => $list[$m['meal_id']], 'price' => $m['price']);
				$total +=  $list[$m['meal_id']];
				$price +=  $list[$m['meal_id']] * $m['price'];
			}
			
		}

		
	    //用户等级 优惠
		$finaltotalprice=0;
		$level_off=false;
		$store_meal = D('Merchant_store_meal')->where(array('store_id' => $store_id))->find();
		if(!empty($this->user_level) && !empty($store_meal) && !empty($store_meal['leveloff'])){
			$leveloff=unserialize($store_meal['leveloff']);	
			if(!empty($this->user_session) && isset($this->user_session['level'])){
				/****type:0无优惠 1百分比 2立减*******/
				if(!empty($leveloff) && is_array($leveloff) && isset($this->user_level[$this->user_session['level']]) && isset($leveloff[$this->user_session['level']])){
					$level_off=$leveloff[$this->user_session['level']];
					if($level_off['type']==1){
					  $finaltotalprice=$price *($level_off['vv']/100);
					  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
					}elseif($level_off['type']==2){
					  $finaltotalprice=$price-$level_off['vv'];
					  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='此次总价立减'.$level_off['vv'].'元';
					}
				}
			}
			unset($leveloff);
		}
		
		$price = $finaltotalprice > 0 ? round($finaltotalprice,2) : $price;
		
		$total_price = $price;
		$minus_price = 0;
		
		if ($store_meal && !empty($store_meal['minus_money']) && $price > $store_meal['full_money']) {
			$price = $price - $store_meal['minus_money'];
			$minus_price = $store_meal['minus_money'];
		}
		
		is_array($level_off) && $level_off['totalprice']=$price;
		$data = array('mer_id' => $store['mer_id'], 'store_id' => $store_id, 'name' => $now_adress['name'], 'phone' => $now_adress['phone'], 'address' => $now_adress['province_txt'] . $now_adress['city_txt'] . $now_adress['area_txt'] . $now_adress['adress'], 'note' => $note, 'info' => serialize($info), 'dateline' => time(), 'total' => $total, 'price' => $price);
		$data['total_price'] = $total_price;
		$data['minus_price'] = $minus_price;
		
		$data['orderid'] = $store['mer_id'] . $store_id . date("YmdHis") . rand(1000000, 9999999);
		$data['uid'] = $this->user_session['uid'];
		$level_off && is_array($level_off) && $data['leveloff'] = serialize($level_off);
		$orderid = D("Meal_order")->add($data);
		if ($orderid) {
			$msg = array();
			$msg['user_name'] = $data['name'];
			$msg['user_phone'] = $data['phone'];
			$msg['user_address'] = $data['address'];
			$msg['user_message'] = $data['note'];
			$msg['buy_time'] = date("Y-m-d H:i:s", $data['dateline']);
			$msg['goods_list'] = $info;
			$msg['goods_count'] = $data['total'];
			$msg['goods_price'] = $data['price'];
			$msg['orderid'] = $orderid;
			$msg['pay_status'] = '';
			$msg['pay_type'] = '';
			$msg['store_name'] = $store['name'];
			$msg['store_phone'] = $store['phone'];
			$msg['store_address'] = $store['adress'];
			$msg = ArrayToStr::array_to_str($msg, 0, $this->config['print_format']);
			$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
			$op->printit($store['mer_id'], $store['store_id'], $msg, 0);
			
			$sms_data = array('mer_id' => $store['mer_id'], 'store_id' => $store['store_id'], 'type' => 'food');
			if ($this->config['sms_place_order'] == 1 || $this->config['sms_place_order'] == 3) {
				$sms_data['uid'] = $this->user_session['uid'];
				$sms_data['mobile'] = $data['phone'];
				$sms_data['sendto'] = 'user';
				$sms_data['content'] = '您在' . $store['name'] . '中下单成功，订单号：' . $orderid;
				Sms::sendSms($sms_data);
			}
			if ($this->config['sms_place_order'] == 2 || $this->config['sms_place_order'] == 3) {
				$sms_data['uid'] = 0;
				$sms_data['mobile'] = $store['phone'];
				$sms_data['sendto'] = 'merchant';
				$sms_data['content'] = '客户' . $data['name'] . '刚刚下了一个订单，订单号：' . $orderid . '，请您注意查看并处理';
				Sms::sendSms($sms_data);
			}
			
			session('shop_cart', null);
			exit(json_encode(array('error_code' => 0, 'msg' => '', 'data' => U('Index/Pay/check',array('order_id' => $orderid,'type'=>'meal')))));
		} else {
			exit(json_encode(array('error_code' => 1, 'msg' => D("Meal_order")->getError())));
		}
	}
}