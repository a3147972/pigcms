<?php
class Group_categoryModel extends Model{
	/*得到分类*/
	public function get_category($get_all=true,$cat_fid=0,$limit_num=0){
		if(empty($limit_num)){
			$limit_num = '';
		}
		if($get_all){
			$condition_group_category['cat_status'] = '1';
			$tmp_group_category = $this->field(true)->where($condition_group_category)->order('`cat_sort` DESC')->limit($limit_num)->select();
			$group_category = array();
			$tmp_category = array();
			foreach($tmp_group_category as $key=>$value){
				if(empty($value['cat_fid'])){
					$tmp_category[$value['cat_id']] = $key;
					
					$value['cat_count'] = 0;
					$value['url'] = $this->get_category_url($value);
					if(!empty($value['cat_pic'])){
						$value['cat_pic'] = C('config.site_url').'/upload/system/'.$value['cat_pic'];
					}
					$group_category[$key] = $value;
					unset($tmp_group_category[$key]);
				}
			}
			foreach($tmp_group_category as $key=>$value){
				$value['url'] = $this->get_category_url($value);
				
				$group_category[$tmp_category[$value['cat_fid']]]['cat_count'] += 1;
				$group_category[$tmp_category[$value['cat_fid']]]['category_list'][$key] = $value;
			}
			$web_category_show_limit = C('config.web_category_show_limit');
			if($web_category_show_limit){
				$new_group_category = array();
				$i = 1;
				foreach($group_category as $key=>$value){
					if($i > $web_category_show_limit){
						break;
					}else{
						$new_group_category[] = $value;
					}
					$i++;
				}
				$group_category = $new_group_category;
			}			
			return $group_category;
		}else{
			$condition_group_category['cat_status'] = '1';
			$condition_group_category['cat_fid'] = $cat_fid;
			$tmp_group_category = $this->field(true)->where($condition_group_category)->order('`cat_sort` DESC')->limit($limit_num)->select();
			foreach($tmp_group_category as &$value){
					$value['url'] = $this->get_category_url($value);
			}
			return $tmp_group_category;
		}
	}
	/*得到列表所有分类*/
	public function get_all_category(){
		$condition_group_category['cat_status'] = '1';
		$tmp_group_category = $this->field(true)->where($condition_group_category)->order('`cat_sort` DESC')->limit()->select();
		$group_category = array();
		$tmp_category = array();
		foreach($tmp_group_category as $key=>$value){
			if(empty($value['cat_fid'])){
				$tmp_category[$value['cat_id']] = $key;
				
				$value['cat_count'] = 0;
				$value['url'] = $this->get_category_url($value);
				
				$group_category[$key] = $value;
				unset($tmp_group_category[$key]);
			}
		}
		foreach($tmp_group_category as $key=>$value){
			$value['url'] = $this->get_category_url($value);
			
			$group_category[$tmp_category[$value['cat_fid']]]['cat_count'] += 1;
			$group_category[$tmp_category[$value['cat_fid']]]['category_list'][$key] = $value;
		}
		foreach($group_category as $key=>$value){
			if(empty($value['cat_id'])){
				unset($group_category[$key]);
			}
		}
		return $group_category;

	}
	/*得到热门的二级分类，不足将以不热门的补上*/
	public function get_hot_category($limit=10,$rand_hot=true){
		$condition_group_category['cat_fid'] = array('neq','0');
		$condition_group_category['cat_status'] = '1';
		$hot_group_category = $this->field(true)->where($condition_group_category)->order('`is_hot` DESC,`cat_sort` DESC')->limit($limit)->select();
		
		foreach($hot_group_category as $key=>$value){
			if($rand_hot){
				if(mt_rand(1,2) == 1){
					$hot_group_category[$key]['is_hot'] = 1;
				}else{
					$hot_group_category[$key]['is_hot'] = 0;
				}
			}
			$hot_group_category[$key]['url'] = $this->get_category_url($value);
		}
		
		return $hot_group_category;
	}
	/*根据cat_url得到分类*/
	public function get_category_by_catUrl($cat_url){
		$condition_group_category['cat_url'] = $cat_url;
		$condition_group_category['cat_status'] = '1';
		$now_category = $this->field(true)->where($condition_group_category)->find();
		if(!empty($now_category)){
			$now_category['url'] = $this->get_category_url($now_category);
		}
		return $now_category;
	}
	/*根据cat_id得到分类*/
	public function get_category_by_id($cat_id){
		$condition_group_category['cat_id'] = $cat_id;
		$condition_group_category['cat_status'] = '1';
		$now_category = $this->field(true)->where($condition_group_category)->find();
		if(!empty($now_category)){
			$now_category['url'] = $this->get_category_url($now_category);
		}
		return $now_category;
	}
	/*根据顶级ID或子分类ID 得到子分类或子分类的同级分类*/
	public function get_son_category_list_byid($cat_fid,$cat_id){
		if(!empty($cat_fid)){
			$son_category_list = $this->get_son_category_list_byfid($cat_fid);
		}else{
			$son_category_list = $this->get_son_category_list_bycid($cat_id);
		}
		
		foreach($son_category_list as $key=>$value){
			$son_category_list[$key]['url'] = $this->get_category_url($value);
		}
		return $son_category_list;
	}
	/*根据顶级ID获得子分类列表*/
	public function get_son_category_list_byfid($cat_fid){
		$condition_group_category['cat_fid'] = $cat_fid;
		$condition_group_category['cat_status'] = '1';
		return $this->field(true)->where($condition_group_category)->order('`cat_sort` DESC')->select();
	}
	/*根据子分类ID获得同级分类列表*/
	public function get_son_category_list_bycid($cat_id){
		$condition_group_category['cat_fid'] = $cat_id;
		$condition_group_category['cat_status'] = '1';
		return $this->field(true)->where($condition_group_category)->order('`cat_sort` DESC')->select();
	}
	/* 得到分类的URL */
	protected function get_category_url($category){
		return C('config.site_url').'/category/'.$category['cat_url'];
	}
}

?>