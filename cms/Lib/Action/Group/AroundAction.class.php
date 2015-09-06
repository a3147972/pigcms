<?php
/*
 * 周边团购
 *
 */
class AroundAction extends BaseAction{
    public function index(){
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12,0);
    	$this->assign('search_hot_list',$search_hot_list);
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);

		
		$this->display();
    }
	public function around(){
		$x = $_COOKIE['around_lat'];
		$y = $_COOKIE['around_long'];
		$adress = $_COOKIE['around_adress'];
		
		if(empty($x) || empty($y) || empty($adress)){
			redirect(U('Around/index'));
		}
		
		$around_range = $this->config['group_around_range'];
		$stores = D("Merchant_store")->field("`store_id`,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_group`='1' AND ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) < '$around_range'")->select();
		$store_ids = array();
		foreach ($stores as $store){
			$store_ids[] = $store['store_id'];
			$store_around_range[$store['store_id']] = $store['juli'];
		}
		$groupids = array();
		if ($store_ids) {
			$gslist = D('Group_store')->field('`group_id`,`store_id`')->where(array('store_id' => array('in', $store_ids)))->select();
			foreach ($gslist as $gs){
				$groupids[] = $gs['group_id'];
				$group_around_range[$gs['group_id']] = $store_around_range[$gs['store_id']];
			}
		}
		$this->assign('group_around_range',$group_around_range);
		
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
	
		//顶部广告
		$index_top_adver = D('Adver')->get_adver_by_key('index_top');
		$this->assign('index_top_adver',$index_top_adver);
		
		//所有区域
		$all_area_list = D('Area')->get_area_list();
		$this->assign('all_area_list',$all_area_list);

		$this->assign($this->get_cat_sort_url());
		
		//得到搜索的团购列表
		$groupids && $group_return = D('Group')->get_group_list_by_group_ids($groupids,$_GET['order']);
		if(empty($groupids) || empty($group_return['group_list'])){
			//手动首页排序团购
			$index_sort_group_list = D('Group')->get_group_list('index_sort',8);
			$this->assign('index_sort_group_list',$index_sort_group_list);
		}else{
			$this->assign($group_return);
		}
		
		$this->display();
	}
	
	protected function get_cat_sort_url(){
		$return['default_sort_url'] = C('config.site_url').'/group/around';
		$return['hot_sort_url'] = C('config.site_url').'/group/around/hot';
		$return['price_asc_sort_url'] = C('config.site_url').'/group/around/price-asc';
		$return['price_desc_sort_url'] = C('config.site_url').'/group/around/price-desc';
		$return['rating_sort_url'] = C('config.site_url').'/group/around/rating';
		$return['time_sort_url'] = C('config.site_url').'/group/around/time';

		return $return;
	}
}