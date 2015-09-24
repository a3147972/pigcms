<?php
/*
 * 订餐
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/06 16:47
 * 
 */
class DetailAction extends BaseAction
{
    public function index()
    {
    	//判断登录
    	if(empty($this->user_session)){
//     		$this->assign('jumpUrl',U('Index/Login/index'));
//     		$this->error('请先登录！');
    	}
    	//右侧广告
    	$index_right_adver = D('Adver')->get_adver_by_key('index_right',3);
    	$this->assign('index_right_adver',$index_right_adver);
    	
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		$store_id = intval($_GET['store_id']);
		//店铺信息
		$store = D('Merchant_store')->where(array('store_id' => $store_id))->find();
		if (empty($store)) {
			$this->group_noexit_tips();
		}
		$store['office_time'] = unserialize($store['office_time']);
		$pre = $str = '';
		$store['state'] = 0;
		$now_time = time();
		foreach ($store['office_time'] as $time) {
			$str = $pre . $time['open'] . '-' . $time['close'];
			$pre = ',';
			$open = strtotime(date("Y-m-d ") . $time['open'] . ':00');
			$close = strtotime(date("Y-m-d ") . $time['close'] . ':00');
			if ($open < $now_time && $now_time < $close) {
				$store['state'] = 1;//根据营业时间判断
			}
		}
		$store['office_time'] = $str;
		$store_image_class = new store_image();
		$store['images'] = $store_image_class->get_allImage_by_path($store['pic_info']);
		$store_meal = D('Merchant_store_meal')->where(array('store_id' => $store_id))->find();
		$store_meal['deliver_time'] = unserialize($store['deliver_time']);
		$store_meal['width'] = 72 / 5 * $store_meal['score_mean'];
		$store = array_merge($store, $store_meal);

		//商家信息
		$merchant = M("Merchant")->where(array('mer_id' => $store['mer_id']))->find();
		
		$merchant_image = new merchant_image();
		
		$merchant['merchant_pic'] = $merchant_image->get_allImage_by_path($merchant['pic_info']);
		
		$sorts = M("Meal_sort")->where(array('store_id' => $store_id))->order('sort ASC')->select();
		$list = $temp = array();
		$id = 0;
		$sids = array();
		foreach ($sorts as $sort) {
			if ($sort['is_weekshow']) {
				$week = explode(",", $sort['week']);
				if (in_array(date("w"), $week)) {
					$sids[] = $sort['sort_id'];
				}
			} else {
				$sids[] = $sort['sort_id'];
			}
		}
		
		$sort_type = isset($_GET['sort_type']) ? intval($_GET['sort_type']) : 0;
		$this->assign('sort_type', $sort_type);
		switch ($sort_type) {
			case 0:
				$order = 'meal_id DESC';
				break;
			case 1:
				$order = 'price DESC';
				break;
			case 2:
				$order = 'price ASC';
				break;
		}
		//菜单信息
		$meals = M('Meal')->field(true)->where(array('store_id' => $store_id, 'sort_id' => array('in', $sids), 'status' => 1))->order($order)->select();
		$meal_image_class = new meal_image();
		$txt = $pic = array();
		foreach ($meals as &$m) {
			$m['image'] = $meal_image_class->get_image_by_path($m['image'],$this->config['site_url'],'s');
// 			$temp[$m['sort_id']] = isset($temp[$m['sort_id']]) ? $temp[$m['sort_id']] : array();
// 			if ($m['image']) {
// 				array
// 			}
			$pic[$m['sort_id']] = isset($pic[$m['sort_id']]) ? $pic[$m['sort_id']] : array();
			$txt[$m['sort_id']] = isset($txt[$m['sort_id']]) ? $txt[$m['sort_id']] : array();
			$lst[$m['sort_id']] = isset($lst[$m['sort_id']]) ? $lst[$m['sort_id']] : array();
			if ($m['image']) {
				$pic[$m['sort_id']][] = $m;
			} else {
				$txt[$m['sort_id']][] = $m;
			}
			$lst[$m['sort_id']][] = $m;
		}
		$list = array();
		foreach ($sorts as &$s) {
			$s['meals']['pic'] = isset($pic[$s['sort_id']]) ? $pic[$s['sort_id']] : '';
			$s['meals']['txt'] = isset($txt[$s['sort_id']]) ? $txt[$s['sort_id']] : '';
			$s['meals']['list'] = isset($lst[$s['sort_id']]) ? $lst[$s['sort_id']] : '';
		}
		//被收藏的次数
		$collect_count = D('User_collect')->where(array('type' => 'meal_detail', 'id' => $store_id))->count();
		
		$is_collect = 0;
		if ($collect = D('User_collect')->where(array('type' => 'meal_detail', 'id' => $store_id, 'uid' => $this->user_session['uid']))->find()) {
			$is_collect = 1;
		}
		$this->assign('collect_count', $collect_count);
		$this->assign('is_collect', $is_collect);
		
		
		//菜品分类信息
// 		$sorts = M('Meal_sort')->where(array('store_id' => $store_id))->select();
		$area = M("Area")->where(array('area_id' => $store['circle_id']))->find();
		$this->assign('area', $area);
		$this->assign('merchant', $merchant);
		$this->assign('store', $store);
		$this->assign('sorts', $sorts);
		
		$this->display();
    }
    
	public function group_noexit_tips()
	{
// 		$this->error('您查看的餐厅不存在！');
	}
	
	public function addcart()
	{
		$shop_cart = isset($_POST['shop_cart']) ? htmlspecialchars($_POST['shop_cart']) : '';
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
		$total = 0;
		$food_list = array();
		foreach ($meals as $meal) {
			$tt = array();
			$tt['food_id'] = $meal['meal_id'];
			$tt['food_name'] = $meal['name'];
			$tt['unit'] = $meal['unit'];
			$tt['count'] = 1;
			$tt['box_num'] = 1;
			$tt['box_price'] = 0;
			$tt['single_price'] = $meal['price'];
			$tt['price'] = $meal['price'];
			$tt['food_score'] = 0;
			$tt['foodComment'] = '';
			$tt['is_online_special_meal'] = '';
			$tt['original_price'] = $meal['price'];
			$total += $meal['price'] * $list[$meal['meal_id']];
			$food_list[] = $tt;
		}
		
		echo json_encode(array('data' => array('foodlist' => $food_list, 'total' => $total, 'food_count' => $food_count, 'origin_total' => $total, 'isSatisfyMinPrice' => 1, 'act_info' => array('has_full_discount' => 0, 'has_meals_donation' => 0)), 'msg' => '成功', 'code' => 0));
	}
}