<?php
class MealAction extends BaseAction
{
	public $store_id = 0;
	
	public $_store = null;
	public function __construct()
	{
		parent::__construct();
		$this->store_id = isset($_REQUEST['store_id']) ? intval($_REQUEST['store_id']) : 0;
		$this->assign('store_id', $this->store_id);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($this->mer_id,array('meal_hits'=>1));
		
		$merchant_store = M("Merchant_store")->where(array('store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
		$merchant_store['office_time'] = unserialize($merchant_store['office_time']);
		$store_image_class = new store_image();
		$merchant_store['images'] = $store_image_class->get_allImage_by_path($merchant_store['pic_info']);
		$t = $merchant_store['images'];
		$merchant_store['image'] = array_shift($t);
		$this->_store = $merchant_store;
		$this->assign('store', $this->_store);
		
		$this->redirect(U('Food/shop', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id)));
		if ($services = D('Customer_service')->where(array('mer_id' => $this->mer_id))->select()) {
			$key = $this->get_im_encrypt_key(array('app_id'=>$this->config['im_appid'],'openid' => $_SESSION['openid']), $this->config['im_appkey']);
			$kf_url = 'http://im-link.meihua.com/?app_id=' . $this->config['im_appid'] . '&openid=' . $_SESSION['openid'] . '&key=' . $key . '#serviceList_' . $this->mer_id;
			$this->assign('kf_url', $kf_url);
		}
	}
	
	public function index(){
		$merchant_store_meal = M("Merchant_store_meal")->where(array('store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
		$merchant_store = $merchant_store_meal ? array_merge($this->_store, $merchant_store_meal) : $this->_store;
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		
		$this->assign('store', $merchant_store);
		$this->assign('class', 1);
		$this->assign('title', '店铺介绍');
		$this->display();
	}
	
	public function meal_detail()
	{
		$id = isset($_GET['meal_id']) ? intval($_GET['meal_id']) : 0;
		$meal = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => $id))->find();
		if (empty($meal)) {
			exit(json_encode(array('error_code' => 1, 'msg' => '不存在的美味')));
		}
		$meal_image_class = new meal_image();
		$meal['image'] = $meal_image_class->get_image_by_path($meal['image'],$this->config['site_url'],'s');
		exit(json_encode(array('error_code' => 0, 'data' => $meal)));
	}
	public function menu()
	{
		if (empty($this->_store)) {
			$this->error_tips("不存在的商家店铺!");
		}
		$merchant_store_meal = M("Merchant_store_meal")->where(array('store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
		$merchant_store = $merchant_store_meal ? array_merge($this->_store, $merchant_store_meal) : $this->_store;
		$this->assign('store', $merchant_store);
		$sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->order('sort ASC')->select();
		$list = $temp = array();
		$id = 0;
		foreach ($sorts as $sort) {
			if ($sort['is_weekshow']) {
				$week = explode(",", $sort['week']);
				if (in_array(date("w"), $week)) {
					$list[] = $sort;
					$id || $id = $sort['sort_id'];
				}
			} else {
				$list[] = $sort;
				$id || $id = $sort['sort_id'];
			}
			$temp[$sort['sort_id']] = $sort['sort_name'];
		}

		$meal_image_class = new meal_image();
		$meals = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => $id, 'status' => 1))->select();
		foreach ($meals as &$m) {
			$m['image'] = $meal_image_class->get_image_by_path($m['image'],$this->config['site_url'],'s');
		}
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id,'keyword'=>strval($_GET['keywords'])));
		
		$this->assign('sort_id', $id);
		$this->assign('meals', $meals);
		$this->assign("categories", json_encode($temp));
		$this->assign("sortlist", $list);
		$this->assign('class', 2);
		$this->assign('title', '菜单');
		$this->display();
	}
	
	public function thissort()
	{
		$sort_id = intval($_GET['sort_id']);
		$meals = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => $sort_id, 'status' => 1))->select();
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $sort_id));
		
		$meal_image_class = new meal_image();
		$html = '';
		foreach ($meals as $meal) {
			$meal['image'] = $meal_image_class->get_image_by_path($meal['image'], $this->config['site_url'], 's');
			$html .= '<dd><span class="count_zero" id="num_' . $meal['meal_id'] . '_1">0</span><div class="tupian">' .
		'<img src="' . $meal['image'] . '" onclick="htmlit(' . $meal['meal_id'] . ')">' .
			'<div class="add" data-foodid="' . $meal['meal_id'] . '_1">' .
				'<h3>' . $meal['name'] . '</h3>' .
				'<em>' . $meal['price'] . '元/' . $meal['unit'] . '</em>' .
// 				'<p class="dpNum">' . $meal['sell_count'] . '人点过</p>' .
				'<div onclick="addProduct(\'' . $meal['meal_id'] . '\',\'1\',\'' . $meal['name'] . '\',\'' . $meal['price'] . '\',\'' . $sort_id . '\',1);" class="reduce2"><span class="ico_increase">加一份</span></div>' .
				'<div>' .
					'<a href="javascript:reduceProduct(\'' . $meal['meal_id'] . '\',\'1\',1,\'' . $sort_id . '\');" class="reduce" id="del_' . $meal['meal_id'] . '_1" style="display: none;"><span class="ico_reduce">减一份</span></a>' .
				'</div></div></div></dd>';
		}
		echo $html;
	}
	
	public function cart()
	{
		$this->wapIsLogin();
		if (IS_POST) {
			$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
			$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$note = isset($_POST['note']) ? htmlspecialchars($_POST['note']) : '';
			if (empty($name)) {
				$this->error('联系人不能为空');
			}
			if (empty($phone)) {
				$this->error('联系电话不能为空');
			}
			$goodsData = isset($_POST['goodsData']) ? htmlspecialchars($_POST['goodsData']) : '';
			if (empty($goodsData)) {
				$this->error('您还没有点菜');
			}
			$products = explode(";", $goodsData);
			$dish = array();
			$meal = array();
			foreach ($products as $p) {
				$t = explode(",", $p);
				$dish[$t[0]] = $t[1];
				$meal[] = $t[0];
			}
			$total = $price = 0;
			if ($meal) {
				$meals = M("Meal")->where(array('meal_id' => array('in', $meal), 'store_id' => $this->store_id))->select();
				$info = array();
				foreach ($meals as $m) {
					$info[] = array('id' => $m['meal_id'],'name' => $m['name'], 'num' => $dish[$m['meal_id']], 'price' => $m['price']);
					$total += $dish[$m['meal_id']];
					$price += $dish[$m['meal_id']] * $m['price'];
				}
			}
			
			$data = array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'name' => $name, 'phone' => $phone, 'address' => $address, 'note' => $note, 'info' => serialize($info), 'dateline' => time(), 'total' => $total, 'price' => $price);
			$data['orderid'] = $this->mer_id . $this->store_id . date("YmdHis") . rand(1000000, 9999999);
// 			$data['wecha_id'] = $this->wecha_id;
			$data['uid'] = $this->user_session['uid'];
			$data['note'] = isset($_POST['note']) ? htmlspecialchars($_POST['note']) : '';
			$orderid = D("Meal_order")->add($data);
			if ($orderid) {
				if ($this->user_session['openid']) {
					$keyword2 = '';
					$pre = '';
					foreach (unserialize($data['info']) as $menu) {
						$keyword2 .= $pre . $menu['name'] . ':' . $menu['price'] . '*' . $menu['num'];
						$pre = '\n\t\t\t';
					}
					$href = C('config.site_url').'/wap.php?c=Meal&a=detail&orderid='. $orderid . '&mer_id=' . $data['mer_id'] . '&store_id=' . $data['store_id'];
					$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
					$model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $this->user_session['openid'], 'first' => '您好，您的订单已生成', 'keyword3' => $orderid, 'keyword1' => date('Y-m-d H:i:s'), 'keyword2' => $keyword2, 'remark' => '您的该次'.$this->config['meal_alias_name'].'下单成功，感谢您的使用！'));
				}

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
				$msg['store_name'] = $this->_store['name'];
				$msg['store_phone'] = $this->_store['phone'];
				$msg['store_address'] = $this->_store['adress'];
				$msg = ArrayToStr::array_to_str($msg, 0, $this->config['print_format']);
				$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
				$op->printit($this->mer_id, $this->store_id, $msg, 0);
				
				/* 粉丝行为分析 */
				$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $orderid));
				
				redirect(U('Pay/check',array('order_id' => $orderid, 'type'=>'meal')));
				//$this->success('订餐成功', U("Meal/detail", array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'orderid' => $orderid)));
			}
		} else {
			$now_group['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'],intval($_GET['adress_id']));
			
			$this->assign('now_group',$now_group);
			
			$sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->select();
			$temp = array();
			foreach ($sorts as $sort) {
				$temp[$sort['sort_id']] = $sort['sort_name'];
			}
			
			$this->assign("categories", json_encode($temp));
			$this->assign('class', 3);
			$this->assign('title', '购物车');
			$this->display();
		}
		
	}
	public function detail()
	{
		$this->wapIsLogin();
		$orderid = intval($_GET['orderid']);
		$otherrm = isset($_GET['otherrm']) ? intval($_GET['otherrm']) : 0;
		$otherrm && $_SESSION['otherwc'] = null;
		$order = M("Meal_order")->where(array('order_id' => $orderid, 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->find();
		if (empty($order)) {
			$this->error_tips('错误的订单信息', U('Meal/index'));
		}
		$meallist = unserialize($order['info']);
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		$this->assign('meallist', $meallist);
		$this->assign('order', $order);
		$this->assign('class', 4);
		$this->assign('title', '订单详情');
		$this->display();
	}
	
	public function my()
	{
		$this->wapIsLogin();
		$count = M("Meal_order")->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->count();
		$userInfo = M("User")->where(array('uid' => $this->user_session['uid']))->find();
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		
		$this->assign('count', $count);
		$this->assign('class', 5);
		$this->assign('title', '个人中心');
		$this->assign('userinfo', $userInfo);
		$this->display();
	}
	
	public function order()
	{
		$this->wapIsLogin();
		$paid = isset($_GET['paid']) ? intval($_GET['paid']) : -1;
		$status = isset($_GET['status']) ? intval($_GET['status']) : -1;
		$where = array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'status' => array('lt', 2));
		if ($paid != -1) $where['paid'] = $paid;
		if ($status != -1) $where['status'] = $status;
		$orders = M("Meal_order")->where($where)->order('order_id DESC')->select();
		$allcount = M("Meal_order")->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'status' => array('lt', 2)))->count();
		$nopaid = M("Meal_order")->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'paid' => 0, 'status' => array('lt', 2)))->count();
		$nosend = M("Meal_order")->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'status' => 0))->count();
		$successcount = $allcount - $nosend;

		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		
		$this->assign('allcount', $allcount);
		$this->assign('nopaid', $nopaid);
		$this->assign('nosend', $nosend);
		$this->assign('successcount', $successcount);
		
		$this->assign('orders', $orders);
		$this->assign('class', 4);
		$this->assign('paid', $paid);
		$this->assign('status', $status);
		$this->assign('title', '订单列表');
		$this->display();
		
	}
	
	public function orderdel()
	{
		$this->wapIsLogin();
		$id = isset($_GET['orderid']) ? intval($_GET['orderid']) : 0;
		if ($order = M('Meal_order')->where(array('order_id' => $id, 'uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->find()) {

			/* 粉丝行为分析 */
			$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
			
			M('Meal_order')->where(array('order_id' => $id, 'uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->delete();
			$this->success('订单取消成功', U('Meal/order', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id)));
		} else {
			$this->error_tips('订单取消失败！');
		}
		
	}
	public function addressinfo()
	{
// 		$now_store = D('Merchant_store')->get_store_by_storeId($_GET['store_id']);
		if(empty($this->_store)){
			$this->error_tips('该店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		$this->assign('class', 1);
		$this->display();
	}
	public function get_route()
	{
// 		$now_store = D('Merchant_store')->get_store_by_storeId($_GET['store_id']);
		if(empty($this->_store)){
			$this->error_tips('该店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		
		$this->assign('no_gotop',true);
		
		$this->display();
	}
	
	/**
	 * 点菜
	 */
	public function selectmeal()
	{
		$meal_id = isset($_GET['meal_id']) ? intval($_GET['meal_id']) : 0;
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $meal_id));
		echo 1;
	}
}
	
?>