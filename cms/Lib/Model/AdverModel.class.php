<?php
class AdverModel extends Model{
	/*通过分类的KEY得到广告列表*/
	public function get_adver_by_key($cat_key,$limit=3){
		$database_adver_category = D('Adver_category');
		$condition_adver_category['cat_key'] = $cat_key;
		$now_adver_category = $database_adver_category->field('`cat_id`')->where($condition_adver_category)->find();
		if($now_adver_category){
			$condition_adver['cat_id'] = $now_adver_category['cat_id'];
			$condition_adver['status'] = '1';
			$adver_list = $this->field(true)->where($condition_adver)->order('`id` DESC')->limit($limit)->select();
			foreach($adver_list as $key=>$value){
				$adver_list[$key]['pic'] = C('config.site_url').'/upload/adver/'.$value['pic'];
			}
			return $adver_list;
		}else{
			return false;
		}
	}
	public function get_one_adver($cat_key){
		
		$adver_list = $this->get_adver_by_key($cat_key,1);
		if($adver_list){
			return $adver_list[0];
		}else{
			return false;
		}
	}
}

?>