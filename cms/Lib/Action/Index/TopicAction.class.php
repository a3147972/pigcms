<?php
/*
 * 活动界面
 *
 * 采用空方法处理，可以自定义页面。
 * 
 */
class TopicAction extends BaseAction{
	public function _empty(){
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		$this->display(ACTION_NAME);
	}
}