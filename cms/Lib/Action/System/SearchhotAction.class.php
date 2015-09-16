<?php
class SearchhotAction extends BaseAction
{
	public function index()
	{
		$database_search_hot = D('Search_hot');
		$search_hot_list = $database_search_hot->field(true)->order('`sort` DESC,`id` ASC')->select();
		$this->assign('search_hot_list', $search_hot_list);
		$this->display();
	}

	public function add()
	{
		$this->assign('bg_color', '#F3F3F3');
		$this->display();
	}

	public function modify()
	{
		if (IS_POST) {
			$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
			$database_search_hot = D('Search_hot');

			if ($database_search_hot->data($_POST)->add()) {
				S('search_hot_list', NULL);
				$this->success('添加成功！');
			}
			else {
				$this->error('添加失败！请重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}

	public function edit()
	{
		$this->assign('bg_color', '#F3F3F3');
		$database_search_hot = D('Search_hot');
		$condition_search_hot['id'] = intval($_GET['id']);
		$search_hot = $database_search_hot->field(true)->where($condition_search_hot)->find();
		$this->assign('search_hot', $search_hot);
		$this->display();
	}

	public function amend()
	{
		if (IS_POST) {
			$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
			$database_search_hot = D('Search_hot');

			if ($database_search_hot->data($_POST)->save()) {
				S('search_hot_list', NULL);
				$this->success('修改成功！');
			}
			else {
				$this->error('修改失败！请重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}

	public function del()
	{
		if (IS_POST) {
			$database_search_hot = D('Search_hot');
			$condition_search_hot['id'] = intval($_POST['id']);

			if ($database_search_hot->where($condition_search_hot)->delete()) {
				S('search_hot_list', NULL);
				$this->success('删除成功！');
			}
			else {
				$this->error('删除失败！请重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}
}

?>
