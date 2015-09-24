<?php
class Footer_linkModel extends Model{
	/*得到底部导航*/
	public function get_list(){
		$footer_link_list = $this->field(true)->order('`id` ASC')->select();
		if($footer_link_list){
			foreach($footer_link_list as &$value){
				if(empty($value['url'])){
					$value['url'] = C('config.site_url').'/intro/'.$value['id'].'.html';
					$value['out_link'] = false;
				}else{
					$value['out_link'] = true;
				}
			}
		}
		return $footer_link_list;
	}
	/*得到单个底部导航*/
	public function get_link($id){
		$footer_link = $this->field(true)->where(array('id'=>$id))->find();
		if($footer_link){
			if(empty($footer_link['url'])){
				$footer_link['url'] = C('config.site_url').'/intro/'.$footer_link['id'].'.html';
				$footer_link['out_link'] = false;
			}else{
				$footer_link['out_link'] = true;
			}
			if(empty($footer_link['title'])){
				$footer_link['title'] = $footer_link['name'];
			}
		}
		return $footer_link;
	}
}

?>