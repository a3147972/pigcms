<?php
/*
 * 团购搜索
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/18 11:43
 * 
 */
class SearchAction extends BaseAction{
    public function index(){
		$keywords = htmlspecialchars($_REQUEST['w']);
		$this->assign('keywords',$keywords);

    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12,0);
    	$this->assign('search_hot_list',$search_hot_list);
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
	
		//顶部广告
		$index_top_adver = D('Adver')->get_adver_by_key('index_top');
		$this->assign('index_top_adver',$index_top_adver);
		
		//所有区域
		$all_area_list = D('Area')->get_area_list();
		$this->assign('all_area_list',$all_area_list);
		
		//猜您喜欢
		$like_group_list = D('Group')->get_grouplist_by_catId(0,0,5);
		$this->assign('like_group_list',$like_group_list);

		$this->assign($this->get_cat_sort_url(urlencode($keywords)));
		
		//得到搜索的团购列表
		$group_return = D('Group')->get_group_list_by_keywords($keywords,$_GET['order']);
		if(empty($group_return['group_list'])){
			//手动首页排序团购
			$index_sort_group_list = D('Group')->get_group_list('index_sort',8);
			$this->assign('index_sort_group_list',$index_sort_group_list);
		}else{
			$this->assign($group_return);
		}
		
		$this->display();
    }
	protected function get_cat_sort_url($keywords){
		$return['default_sort_url'] = C('config.site_url').'/search/group/'.$keywords.'/all';
		$return['hot_sort_url'] = C('config.site_url').'/search/group/'.$keywords.'/hot';
		$return['price_asc_sort_url'] = C('config.site_url').'/search/group/'.$keywords.'/price-asc';
		$return['price_desc_sort_url'] = C('config.site_url').'/search/group/'.$keywords.'/price-desc';
		$return['rating_sort_url'] = C('config.site_url').'/search/group/'.$keywords.'/rating';
		$return['time_sort_url'] = C('config.site_url').'/search/group/'.$keywords.'/time';

		return $return;
	}
}