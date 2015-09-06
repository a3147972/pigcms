<?php
class StoreAction extends BaseAction{
	public function __construct()
	{
		parent::__construct();
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！', U('Login/index'));
		}
		if (empty($_SESSION['openid'])) {
// 			$this->error_tips('该功能只能在微信中使用！', U('Login/index'));
		}
	}
	public function index(){
		
		//判断分类信息
		$cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : '';
		$this->assign('now_cat_url',$cat_url);
		
		//判断地区信息
		$area_url = !empty($_GET['area_url']) ? $_GET['area_url'] : '';
		if(!empty($area_url)){
			$now_area = D('Area')->get_area_by_areaUrl($area_url);
			if(empty($now_area)){
				$this->error('当前区域不存在！');
			}
			$this->assign('now_area',$now_area);
			$area_id = $now_area['area_id'];
		}else{
			$area_id = 0;
		}
		
		$this->assign('now_area_url',$area_url);
		
		//判断排序信息
		$sort_id = !empty($_GET['sort_id']) ? $_GET['sort_id'] : 'defaults';
		$sort_array = array(
				array('sort_id'=>'defaults','sort_value'=>'默认排序'),
				array('sort_id'=>'distance','sort_value'=>'附近优先 '),	
		);
		foreach($sort_array as $key=>$value){
			if($sort_id == $value['sort_id']){
				$now_sort_array = $value;
				break;
			}
		}
		$this->assign('sort_array',$sort_array);
		$this->assign('now_sort_array',$now_sort_array);
		
		//根据分类信息获取分类
		if(!empty($cat_url)){
			$now_category = D('Group_category')->get_category_by_catUrl($cat_url);
			if(empty($now_category)){
				$this->error_tips('此分类不存在！');
			}
			$this->assign('now_category',$now_category);
			
		
			$all_category_url = $now_category['cat_url'];
			$category_cat_field = $now_category['cat_field'];
			$top_category = $now_category;
			$this->assign('top_category',$now_category);
			
			$all_category_list = D('Group_category')->get_category(false, $now_category['cat_id']);
			$this->assign('all_category_list',$all_category_list);
			
			$get_grouplist_catfid = $now_category['cat_id'];
			$get_grouplist_catid = 0;
			
			if(!empty($category_cat_field)){
				$cat_field = unserialize($category_cat_field);
				foreach($cat_field as $key=>$value){
					//包含区域
					if($value['use_field'] && $value['use_field'] == 'area'){
						$all_area_list = D('Area')->get_area_list();
						$this->assign('all_area_list',$all_area_list);
					}
				}
			}
		}else{
			//所有区域
			$all_area_list = D('Area')->get_area_list();
			$this->assign('all_area_list',$all_area_list);
		}
// 		$long_lat['lat'] = 31.823283;
// 		$long_lat['long'] = 117.235267;
		$_SESSION['openid'] && $long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find();
// 		dump(D('Merchant_store')->wap_get_store_list_by_catid($get_grouplist_catid, $area_id, $sort_id, $long_lat['lat'], $long_lat['long']));
		$this->assign(D('Merchant_store')->wap_get_store_list_by_catid($get_grouplist_catid, $area_id, $sort_id, $long_lat['lat'], $long_lat['long'], $cat_url));
		
		/* 粉丝行为分析 */
		$this->behavior(array('model'=>'Store_index'));
		
		$this->display();
	}
	public function detail(){
		$set = isset($_GET['set']) ? htmlspecialchars($_GET['set']) : '';
		$store_id = isset($_GET['store_id']) ? intval($_GET['store_id']) : 0;
		$merchant_store = M("Merchant_store")->where(array('store_id' => $store_id))->find();
		$merchant_store['office_time'] = unserialize($merchant_store['office_time']);
		$store_image_class = new store_image();
		$merchant_store['images'] = $store_image_class->get_allImage_by_path($merchant_store['pic_info']);
		$merchant_store_meal = M("Merchant_store_meal")->where(array('store_id' => $store_id))->find();
		$merchant_store_meal && $merchant_store = array_merge($merchant_store, $merchant_store_meal);
		if ($merchant_store['have_group']) {
			$group_list = D('Group')->get_store_group_list($merchant_store['store_id'], 10,true);
			$this->assign('group_list', $group_list);			
		}
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		
		$this->assign('store', $merchant_store);
		$this->assign('set', $set);
		$this->assign('title', '店铺介绍');
		$this->display();
	}
}
	
?>