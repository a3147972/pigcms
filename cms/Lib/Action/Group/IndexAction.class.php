<?php
/*
 * 团购首页
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/06 16:47
 * 
 */
class IndexAction extends BaseAction{
    public function index(){
		
    	//右侧广告
    	$index_right_adver = D('Adver')->get_adver_by_key('index_right',3);
    	$this->assign('index_right_adver',$index_right_adver);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12,0);
    	$this->assign('search_hot_list',$search_hot_list);
		
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//所有分类 页面上
		$list_all_category_list = D('Group_category')->get_all_category();
		$this->assign('list_all_category_list',$list_all_category_list);
		
		$pigcms_param = $this->get_uri_param();
		$order = $_GET['order'];
		$attrs = urldecode($pigcms_param['attrs']);

		$area_url = !empty($_GET['area_url']) ? $_GET['area_url'] : 'all';
		$cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : 'all';
		
		
		if($area_url != 'all'){
			$tmp_area = D('Area')->get_area_by_areaUrl($area_url,$cat_url);
			if(empty($tmp_area)){
				$this->error('当前区域不存在！');
			}
			if($tmp_area['area_type'] == 3){
				$now_area = $tmp_area;
			}else{
				$now_circle = $tmp_area;
				$this->assign('now_circle',$now_circle);
				$now_area = D('Area')->get_area_by_areaId($tmp_area['area_pid'],true,$cat_url);
				if(empty($tmp_area)){
					$this->error('当前区域不存在！');
				}
				$circle_url = $now_circle['area_url'];
				$area_url = $now_area['area_url'];
			}
			$area_id = $now_area['area_id'];
			$circle_list = D('Area')->get_arealist_by_areaPid($now_area['area_id'],true,$cat_url);
			if($now_circle && $circle_list){
				foreach($circle_list as &$value){
					if($value['area_id'] == $now_circle['area_id']){
						$vlaue['is_hover'] = true;
					}
				}
			}
			$this->assign('now_area',$now_area);
			$this->assign('circle_list',$circle_list);
		}else{
			$area_id = 0;
		}
		
		//判断分类信息
		if($cat_url != 'all'){
			$now_category = D('Group_category')->get_category_by_catUrl($cat_url);
			if(empty($now_category)){
				$this->error('此分类不存在！');
			}
			$this->assign('now_category',$now_category);
			if(!empty($now_category['cat_fid'])){
				$f_category = D('Group_category')->get_category_by_id($now_category['cat_fid']);
				$all_category_url = $f_category['cat_url'];
				$category_cat_field = $f_category['cat_field'];
				
				$top_category = $f_category;
				$this->assign('top_category',$f_category);
				
				$get_grouplist_catfid = 0;
				$get_grouplist_catid = $now_category['cat_id'];
			}else{
				$all_category_url = $now_category['cat_url'];
				$category_cat_field = $now_category['cat_field'];
				$top_category = $now_category;
				$this->assign('top_category',$now_category);
				
				$get_grouplist_catfid = $now_category['cat_id'];
				$get_grouplist_catid = 0;
			}
			$son_category_list = D('Group_category')->get_son_category_list_byid($now_category['cat_fid'],$now_category['cat_id']);
			$this->assign('son_category_list',$son_category_list);

			//小于等于一个子分类的不显示
			if(count($son_category_list) > 1 && $now_category['cat_id'] == $top_category['cat_id']){
				array_unshift($son_category_list,array('cat_name'=>'全部','cat_url'=>$all_category_url));
				$cat_option_list[] = array('txt_desc'=>'分类','row_type'=>'category','category_list'=>$son_category_list);
			}

			if(!empty($category_cat_field)){
				$cat_field = unserialize($category_cat_field);
				if($attrs){
					$attrs_tmp_arr_old = explode(';',$attrs);
					if(!empty($attrs_tmp_arr_old)){
						foreach($attrs_tmp_arr_old as $key=>$value){
							$attrs_tmp_str = explode(':',$value);
							$attrs_arr[$attrs_tmp_str[0]] = $attrs_tmp_str[1];
						}
					}
				}
				foreach($cat_field  as $key=>$value){
					if($value['use_field']){
						//所有区域
						if($value['use_field'] == 'area'){
							$all_area_list = D('Area')->get_area_list('',$cat_url);
							if($area_url == 'all'){
								array_unshift($all_area_list,array('area_name'=>'全部','area_url'=>'all'));
								$cat_option_list[] = array('txt_desc'=>'区域','row_type'=>'area','area_list'=>$all_area_list);
							}else{
								$this->assign('area_list',$all_area_list);
							}
							
							if($circle_list){
								array_unshift($circle_list,array('area_name'=>'全部商圈','area_url'=>''));
								$cat_option_list[] = array('txt_desc'=>'商圈','row_type'=>'circle','circle_list'=>$circle_list);
							}
						}
					}else{
						$attrs_tmp_arr = $attrs_tmp_arr_old;
						
						if($value['type'] == 0){
							if($attrs_tmp_arr){
								foreach($attrs_tmp_arr as $k=>$v){
									if(strpos($v,$value['url']) !== false){
										unset($attrs_tmp_arr[$k]);
									}
								}
							}
							if(!empty($attrs_tmp_arr)){
								$attrs_tmp_str = implode(';',$attrs_tmp_arr).';';
							}else{
								$attrs_tmp_str = '';
							}
						
							$tmp_attr_arr = array();
							foreach($value['value'] as $k=>$v){
								array_push($tmp_attr_arr,array('name'=>$v,'value'=>$k,'url'=>$attrs_tmp_str.$value['url'].':'.$k));
							}
							array_unshift($tmp_attr_arr,array('name'=>'全部','value'=>'-1','url'=>rtrim($attrs_tmp_str,';')));
							
							$cat_option_list[] = array('txt_desc'=>$value['name'],'row_type'=>'custom_0','custom_field'=>$value['url'],'attr_arr'=>$tmp_attr_arr);
						}else if($value['type'] == 1){
							$value_tmp_arr = array();
							if($attrs_tmp_arr){
								foreach($attrs_tmp_arr as $k=>$v){
									if(strpos($v,$value['url']) !== false){
										$field_tmp_arr = explode(':',$v);
										$value_tmp_arr = explode(',',$field_tmp_arr[1]);
										unset($attrs_tmp_arr[$k]);
									}
								}
							}
							if(!empty($attrs_tmp_arr)){
								$attrs_tmp_str = implode(';',$attrs_tmp_arr).';';
							}else{
								$attrs_tmp_str = '';
							}
							$tmp_attr_arr = array();
							foreach($value['value'] as $k=>$v){
								if(in_array($k,$value_tmp_arr)){
									$tmp_value_tmp_arr = $value_tmp_arr;
									foreach($tmp_value_tmp_arr as $ka=>$ja){
										if($ja == $k){
											unset($tmp_value_tmp_arr[$ka]);
										}
									}
									if(!empty($tmp_value_tmp_arr)){
										array_push($tmp_attr_arr,array('name'=>$v,'value'=>$k,'url'=>$attrs_tmp_str.$value['url'].':'.implode(',',$tmp_value_tmp_arr)));
									}else{
										array_push($tmp_attr_arr,array('name'=>$v,'value'=>$k,'url'=>rtrim($attrs_tmp_str,';')));
									}
								}else{
									$tmp_value_tmp_arr = $value_tmp_arr;
									array_push($tmp_value_tmp_arr,$k);
									array_push($tmp_attr_arr,array('name'=>$v,'value'=>$k,'url'=>$attrs_tmp_str.$value['url'].':'.implode(',',$tmp_value_tmp_arr)));
								}
							}

							$cat_option_list[] = array('txt_desc'=>$value['name'],'row_type'=>'custom_1','custom_field'=>$value['url'],'attr_arr'=>$tmp_attr_arr);
						}
					}	
				}
			}
			
			//顶部广告
			$category_top_adver = D('Adver')->get_adver_by_key('cat_'.$top_category['cat_id'].'_top');
			$this->assign('category_top_adver',$category_top_adver);
			
			//猜您喜欢
			$like_group_list = D('Group')->get_grouplist_by_catId($now_category['cat_id'],$now_category['cat_fid'],5);
		}else{
			$get_grouplist_catid = 0;
			$get_grouplist_catfid = 0;
			
			//顶部广告
			$index_top_adver = D('Adver')->get_adver_by_key('index_top');
			$this->assign('index_top_adver',$index_top_adver);
			
			//所有区域
			$all_area_list = D('Area')->get_area_list();
			$this->assign('all_area_list',$all_area_list);
			
			//猜您喜欢
			$like_group_list = D('Group')->get_grouplist_by_catId(0,0,5);
			
			
			$category_list = $list_all_category_list;
			array_unshift($category_list,array('cat_name'=>'全部','cat_url'=>'all'));
			$cat_option_list[] = array('txt_desc'=>'分类','row_type'=>'category','category_list'=>$category_list);
			
			if(empty($circle_list)){
				array_unshift($all_area_list,array('area_name'=>'全部','area_url'=>'all'));
				$cat_option_list[] = array('txt_desc'=>'区域','row_type'=>'area','area_list'=>$all_area_list);
			}else{
				$this->assign('area_list',$all_area_list);
				array_unshift($circle_list,array('area_name'=>'全部商圈','area_url'=>''));
				$cat_option_list[] = array('txt_desc'=>'商圈','row_type'=>'circle','circle_list'=>$circle_list);
			}
		}
		
		$this->assign('like_group_list',$like_group_list);

		//得到分类下的团购列表
		$this->assign(D('Group')->get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$cat_url,$area_id,$now_circle['area_id'],$order,$attrs,$category_cat_field));
	
		$cat_option_html = $this->get_cat_option_html($cat_option_list,$cat_url,$area_url,$circle_url,$order,$attrs);
		$this->assign('cat_option_html',$cat_option_html);
		
		$cat_sort_url = $this->get_cat_sort_url($cat_url,$area_url,$attrs);
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
					}else if($circle_url == $v['area_url']){
						$tmp_current = true;
					}else{
						$tmp_current = false;
					}
					$cat_option_html .= '<li '.($tmp_current ? 'class="current"' : '').'><a href="'.$this->get_cat_option_url($cat_url,$v['area_url'],$order,$attrs,$area_url).'">'.$v['area_name'].'</a></li>';
				}
			}
			$cat_option_html .= '</ul>';
			$cat_option_html .= '</div>';
		}
		return $cat_option_html;
	}
	protected function get_cat_option_url($cat_url,$area_url,$order,$attrs,$p_url=''){
		if($order){
			if($attrs){
				return C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/'.$order.'?attrs='.urlencode($attrs);
			}else{
				return C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/'.$order;
			}
		}else{
			if($attrs){
				return C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'?attrs='.urlencode($attrs);
			}else if(!empty($area_url)){
				return C('config.site_url').'/category/'.$cat_url.'/'.$area_url;
			}else{
				return C('config.site_url').'/category/'.$cat_url.'/'.$p_url;
			}
		}
	}
	protected function get_cat_sort_url($cat_url,$area_url,$attrs){
		if($attrs){
			$return['default_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'?attrs='.urlencode($attrs);
			$return['hot_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/hot?attrs='.urlencode($attrs);
			$return['price_asc_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/price-asc?attrs='.urlencode($attrs);
			$return['price_desc_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/price-desc?attrs='.urlencode($attrs);
			$return['rating_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/rating?attrs='.urlencode($attrs);
			$return['time_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/time?attrs='.urlencode($attrs);
		}else{
			$return['default_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url;
			$return['hot_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/hot';
			$return['price_asc_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/price-asc';
			$return['price_desc_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/price-desc';
			$return['rating_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/rating';
			$return['time_sort_url'] = C('config.site_url').'/category/'.$cat_url.'/'.$area_url.'/time';
		}
		return $return;
	}
}