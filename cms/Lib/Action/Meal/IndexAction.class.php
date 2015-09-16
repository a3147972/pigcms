<?php
/*
 * 餐饮首页
 *
 */
class IndexAction extends BaseAction
{
	
    public function index()
    {
    	//右侧广告
    	$index_right_adver = D('Adver')->get_adver_by_key('index_right',3);
    	$this->assign('index_right_adver', $index_right_adver);
    	
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		/* //所有分类 包含2级分类
		$all_category_list = D('Meal_store_category')->get_category();
		$this->assign('all_category_list',$all_category_list); */
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//所有分类 页面上
		$list_all_category_list = D('Meal_store_category')->get_all_category();
		$this->assign('list_all_category_list',$list_all_category_list);
		
		$pigcms_param = $this->get_uri_param();
		$order = $_GET['order'];
		$attrs = urldecode($pigcms_param['attrs']);
		
		$order = isset($_GET['order']) && $_GET['order'] ? htmlspecialchars($_GET['order']) : '';

		$area_url = isset($_GET['area_url']) && $_GET['area_url']? htmlspecialchars($_GET['area_url']) : 'all';
		$cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : 'all';
// 		echo $_GET['cat_url'];die;
		if ($area_url != 'all') {
			$tmp_area = D('Area')->get_area_by_areaUrl($area_url, $cat_url, 'meal');
			if(empty($tmp_area)){
				$this->error('当前区域不存在！');
			}
			if($tmp_area['area_type'] == 3){
				$now_area = $tmp_area;
			}else{
				$now_circle = $tmp_area;
				$this->assign('now_circle',$now_circle);
				$now_area = D('Area')->get_area_by_areaId($tmp_area['area_pid'],true, $cat_url, 'meal');
				if(empty($tmp_area)){
					$this->error('当前区域不存在！');
				}
				$circle_url = $now_circle['area_url'];
				$area_url = $now_area['area_url'];
			}
			$area_id = $now_area['area_id'];
			$circle_list = D('Area')->get_arealist_by_areaPid($now_area['area_id'],true, $cat_url, 'meal');
			if($now_circle && $circle_list){
				foreach($circle_list as &$value){
					if($value['area_id'] == $now_circle['area_id']){
						$vlaue['is_hover'] = true;
					}
				}
			}
			$this->assign('now_area',$now_area);
			$this->assign('circle_list',$circle_list);
			
			$now_area = D('Area')->get_area_by_areaUrl($area_url, $cat_url, 'meal');
			if(empty($now_area)){
				$this->error('当前区域不存在！');
			}
			$area_id = $now_area['area_id'];
		} else {
			$area_id = 0;
		}
		
		
		
		//判断分类信息
		if($cat_url != 'all'){
			$now_category = D('Meal_store_category')->get_category_by_catUrl($cat_url);
			if(empty($now_category)){
				$this->error('此分类不存在！');
			}
			$this->assign('now_category',$now_category);
			if(!empty($now_category['cat_fid'])){
				$f_category = D('Meal_store_category')->get_category_by_id($now_category['cat_fid']);
				$all_category_url = $f_category['cat_url'];
				
				$top_category = $f_category;
				$this->assign('top_category',$f_category);
				
				$cat_fid = 0;
				$cat_id = $now_category['cat_id'];
			}else{
				$all_category_url = $now_category['cat_url'];
				$top_category = $now_category;
				$this->assign('top_category',$now_category);
				
				$cat_fid = $now_category['cat_id'];
				$cat_id = 0;
			}
			$son_category_list = D('Meal_store_category')->get_son_category_list_byid($now_category['cat_fid'],$now_category['cat_id']);
// 			$this->assign('son_category_list',$son_category_list);

			//小于等于一个子分类的不显示
// 			if(count($son_category_list) > 1 && $now_category['cat_id'] == $top_category['cat_id']){
				array_unshift($son_category_list,array('cat_name'=>'全部','cat_url'=>$all_category_url));
				$cat_option_list[] = array('txt_desc'=>'分类','row_type'=>'category','category_list'=>$son_category_list);
// 			}

		}else{
			$cat_id = 0;
			$cat_fid = 0;
			

			
			
			$category_list = $list_all_category_list;
			array_unshift($category_list,array('cat_name'=>'全部','cat_url'=>'all'));
			$cat_option_list[] = array('txt_desc'=>'分类','row_type'=>'category','category_list'=>$category_list);
			
			
		}
		
		//所有区域
		$all_area_list = D('Area')->get_area_list('', '', 'meal');
		$this->assign('all_area_list', $all_area_list);
		
		if(empty($circle_list)){
			array_unshift($all_area_list,array('area_name'=>'全部','area_url'=>'all'));
			$cat_option_list[] = array('txt_desc'=>'区域','row_type'=>'area','area_list'=>$all_area_list);
		}else{
			$this->assign('area_list',$all_area_list);
			array_unshift($circle_list,array('area_name'=>'全部商圈','area_url'=>''));
			$cat_option_list[] = array('txt_desc'=>'商圈','row_type'=>'circle','circle_list'=>$circle_list);
		}
		
		
		
		
		//顶部广告
		$index_top_adver = D('Adver')->get_adver_by_key('index_top');
		$this->assign('index_top_adver', $index_top_adver);

		
		//得到区域下的店铺列表
		$this->assign('default_url', C('config.site_url').'/meal/all/all');
		$t = D('Merchant_store')->get_list_by_option_pc($area_id,$now_circle['area_id'], $order, $cat_id, $cat_fid);
// 		echo "<pre/>";
// 		print_r($t);die;
		$this->assign($t);
	
		$cat_option_html = $this->get_cat_option_html($cat_option_list,$cat_url,$area_url,$circle_url,$order,$attrs);
		$this->assign('cat_option_html',$cat_option_html);
		
		$cat_sort_url = $this->get_cat_sort_url($cat_url, $area_url, $attrs);
		$this->assign($cat_sort_url);
		
		$this->display();
    }
    protected function get_cat_option_html($cat_option_list,$cat_url,$area_url,$circle_url,$order,$attrs){
		if(!empty($attrs)){
			$attr_tmp_arr = explode(';',$attrs);
			if(!empty($attr_tmp_arr)){
				foreach($attr_tmp_arr as $key=>$value){
					$attr_tmp_value = explode(':',$value);
					$attrs_arr[$attr_tmp_value[0]] = $attr_tmp_value[1];
				}
			}
		}
		$cat_option_html = '';
		foreach($cat_option_list as $key=>$value){
			$cat_option_html .= '<div class="filter-label-list filter-section category-filter-wrapper log-mod-viewed '.($key==0 ? 'first-filter' :'').($value['row_type']=='custom_1' ? 'filter-sect--multi' : '').'">';
			$cat_option_html .= '<div class="label has-icon">'.$value['txt_desc'].'：</div>';
			$cat_option_html .= '<ul class="filter-sect-list">';
			
			if($value['row_type'] == 'category'){
				foreach($value['category_list'] as $k=>$v){
					$cat_option_html .= '<li class="item'.($cat_url==$v['cat_url'] ? ' current' : '').'"><a '.($v['is_hot'] ? 'class="briber"' : '').' href="'.$this->get_cat_option_url($v['cat_url'],$area_url,$order,$attrs).'">'.$v['cat_name'].'</a></li>';
				}
			}else if($value['row_type'] == 'area'){
				foreach($value['area_list'] as $k=>$v){
					$cat_option_html .= '<li '.($area_url==$v['area_url'] ? 'class="current"' : '').'><a href="'.$this->get_cat_option_url($cat_url,$v['area_url'],$order,$attrs).'">'.$v['area_name'].'</a></li>';
				}
			}else if($value['row_type'] == 'custom_0'){
				foreach($value['attr_arr'] as $k=>$v){
					$cat_option_html .= '<li '.((($attrs_arr[$value['custom_field']] === null && $v['value'] == '-1') || ($attrs_arr[$value['custom_field']] !== null && $attrs_arr[$value['custom_field']]==$v['value'])) ? 'class="current"' : '').'><a href="'.$this->get_cat_option_url($cat_url,$area_url,$order,$v['url']).'">'.$v['name'].'</a></li>';
				}
			}else if($value['row_type'] == 'custom_1'){
				if($attrs_arr[$value['custom_field']] !== null){
					$custom_field_arr = explode(',',$attrs_arr[$value['custom_field']]);
				}
				foreach($value['attr_arr'] as $k=>$v){
					$cat_option_html .= '<li><a class="inline-block checkbox '.(in_array($k,$custom_field_arr) ? 'checkbox-checked' : '').'" href="'.$this->get_cat_option_url($cat_url,$area_url,$order,$v['url']).'">'.$v['name'].'</a></li>';
				}
			}else if($value['row_type'] == 'circle'){
				foreach($value['circle_list'] as $k=>$v){
					if(empty($v) && empty($circle_url)){
						$tmp_current = true;
						$v['area_url'] = $area_url;
					}else if($circle_url == $v['area_url']){
						$tmp_current = true;
					}else{
						$tmp_current = false;
					}
					$v['area_url'] = empty($v['area_url']) ? $area_url : $v['area_url'];
					$cat_option_html .= '<li '.($tmp_current ? 'class="current"' : '').'><a href="'.$this->get_cat_option_url($cat_url,$v['area_url'],$order,$attrs).'">'.$v['area_name'].'</a></li>';
				}
			}
			$cat_option_html .= '</ul>';
			$cat_option_html .= '</div>';
		}
		return $cat_option_html;
	}
	protected function get_cat_option_url($cat_url,$area_url,$order,$attrs){
		if($order){
			if($attrs){
				return C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/'.$order.'?attrs='.urlencode($attrs);
			}else{
				return C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/'.$order;
			}
		}else{
			if($attrs){
				return C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'?attrs='.urlencode($attrs);
			}else{
				return C('config.site_url').'/meal/'.$cat_url.'/'.$area_url;
			}
		}
	}
	protected function get_cat_sort_url($cat_url,$area_url,$attrs){
		if($attrs){
			$return['default_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'?attrs='.urlencode($attrs);
			$return['hot_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/hot?attrs='.urlencode($attrs);
			$return['price_asc_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/price-asc?attrs='.urlencode($attrs);
			$return['price_desc_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/price-desc?attrs='.urlencode($attrs);
			$return['rating_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/rating?attrs='.urlencode($attrs);
			$return['time_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/time?attrs='.urlencode($attrs);
		}else{
			$return['default_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url;
			$return['hot_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/hot';
			$return['price_asc_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/price-asc';
			$return['price_desc_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/price-desc';
			$return['rating_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/rating';
			$return['time_sort_url'] = C('config.site_url').'/meal/'.$cat_url.'/'.$area_url.'/time';
		}
		return $return;
	}
}