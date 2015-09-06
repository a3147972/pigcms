<?php
class AreaModel extends Model{
	/*得到所有区域*/
	public function get_area_list($limit='',$cat_url='', $type = 'category'){
		$condition_area['area_pid'] = C('config.now_city');
		$condition_area['is_open'] = '1';
		$area_list = $this->field(true)->where($condition_area)->order('`area_sort` DESC,`area_id` ASC')->limit($limit)->select();
		if(is_array($area_list)){
			foreach($area_list as $key=>$value){
				$area_list[$key]['url'] = $this->get_area_url($value,$cat_url, $type);
			}
		}
		return $area_list;
	}
	
	/*通过父级ID得到子区域*/
	public function get_arealist_by_areaPid($area_pid=0,$is_open=false,$cat_url='', $type = 'category'){
		$cacha_name = 'area_pid_'.$area_pid.'_'.strval($is_open).'_'.$cat_url;
		$area_list = S($cacha_name);
		if(empty($area_list)){
			$condition_area['area_pid'] = $area_pid;
			if($is_open){
				$condition_area['is_open'] = '1';
			}
			$area_list = $this->field(true)->where($condition_area)->order('`area_sort` DESC,`area_id` ASC')->limit($limit)->select();
			if(is_array($area_list)){
				foreach($area_list as $key=>$value){
					$area_list[$key]['url'] = $this->get_area_url($value,$cat_url, $type);
				}
				S($cacha_name,$area_list,86400);
			}
		}
		return $area_list;
	}
	
	public function get_area_by_areaUrl($area_url,$cat_url='', $type = 'category'){
		$condition_area['area_url'] = $area_url;
		$condition_area['is_open'] = '1';
		//$condition_area['area_pid'] = C('config.now_city');
		$now_area = $this->field(true)->where($condition_area)->find();
		if(!empty($now_area)){
			$now_area['url'] = $this->get_area_url($now_area,$cat_url, $type);
		}
		return $now_area;
	}
	public function get_area_by_areaId($area_id,$is_open=true,$cat_url='', $type = 'category'){
		$condition_area['area_id'] = $area_id;
		if($is_open){
			$condition_area['is_open'] = '1';
		}
		$now_area = $this->field(true)->where($condition_area)->find();
		if(!empty($now_area)){
			$now_area['url'] = $this->get_area_url($now_area,$cat_url, $type);
		}
		return $now_area;
	}
	public function get_circle_list($limit='12',$cat_url='', $type = 'category'){
		$area_list = $this->get_area_list($limit, $cat_url, $type);
		$area_pid_arr = array();
		foreach($area_list as $key=>$value){
			array_push($area_pid_arr,$value['area_id']);
		}
		$condition_area['area_pid'] = array('in',implode(',',$area_pid_arr));
		$circle_list = $this->field(true)->where($condition_area)->order('`area_sort` DESC,`area_id` ASC')->limit($limit)->select();
		if(is_array($circle_list)){
			foreach($circle_list as $key=>$value){
				$circle_list[$key]['url'] = $this->get_area_url($value,$cat_url, $type);
			}
		}
		return $circle_list;
	}
	
	/* 得到区域的URL */
	protected function get_area_url($area,$cat_url='', $type = 'category'){
		if($type == 'category'){
			if(empty($cat_url)){
				return C('config.site_url').'/'.$type.'/all/'.$area['area_url'];
			}else{
				return C('config.site_url').'/'.$type.'/'.$cat_url.'/'.$area['area_url'];
			}
		}else if($type == 'activity'){
			if(empty($cat_url)){
				return C('config.site_url').'/'.$type.'/all/'.$area['area_url'];
			}else{
				return C('config.site_url').'/'.$type.'/'.$cat_url.'/'.$area['area_url'];
			}
		}
	}
	
	public function get_all_area_list($limit='',$cat_url='', $type = 'category')
	{
		$condition_area['area_pid'] = C('config.now_city');
		$condition_area['is_open'] = '1';
		$area_list = $this->field(true)->where($condition_area)->order('`area_sort` DESC,`area_id` ASC')->select();
		$result = $area_pid = array();
		
		foreach($area_list as $value){
			$value['url'] = $this->get_area_url($value,$cat_url, $type);
			$area_pid[] = $value['area_id'];
			$value['area_list'] = array();
			$value['area_count'] = 0;
			$result[$value['area_id']] = $value;
		}
		
		if ($area_pid) {
			unset($condition_area['area_pid']);
			$condition_area['area_pid'] = array('in', $area_pid);
			$area_list = $this->field(true)->where($condition_area)->order('`area_sort` DESC,`area_id` ASC')->select();
			foreach ($area_list as $row) {
				$row['url'] = $this->get_area_url($row,$cat_url, $type);
				if (isset($result[$row['area_pid']])) {
					$result[$row['area_pid']]['area_list'][] = $row;
					$result[$row['area_pid']]['area_count']++;
				}
			}
		}
		return $result;
	}
}
?>