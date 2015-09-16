<?php
class PointAction extends BaseAction
{
	public function index()
	{
		$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
		$this->assign('web_index_slider', $web_index_slider);
		$search_hot_list = D('Search_hot')->get_list(12);
		$this->assign('search_hot_list', $search_hot_list);
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list', $all_category_list);
		$this->assign(D('User_score_list')->get_list($this->now_user['uid']));
		$this->display();
	}
}

?>
