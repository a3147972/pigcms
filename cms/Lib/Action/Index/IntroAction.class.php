<?php
/*
 * 关于我们
 *
 */
class IntroAction extends BaseAction{
    public function index(){
		$now_link = D('Footer_link')->get_link($_GET['id']);
		if(empty($now_link)){
			redirect($this->config['site_url']);
		}
		$this->assign('now_link',$now_link);
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);

		$this->display();
    }
}