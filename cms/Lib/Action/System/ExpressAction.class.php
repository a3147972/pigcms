<?php
class ExpressAction extends BaseAction
{
	public function index()
	{
		$database_express = D('Express');
		$express_list = $database_express->field(true)->order('`sort` DESC,`id` ASC')->select();
		$this->assign('express_list', $express_list);
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
			$database_express = D('Express');

			if ($database_express->data($_POST)->add()) {
				S('express_list', NULL);
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
		$database_express = D('Express');
		$condition_express['id'] = intval($_GET['id']);
		$express = $database_express->field(true)->where($condition_express)->find();
		$this->assign('express', $express);
		$this->display();
	}

	public function amend()
	{
		if (IS_POST) {
			$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
			$database_express = D('Express');

			if ($database_express->data($_POST)->save()) {
				S('express_list', NULL);
				$this->success('修改成功！');
			}
			else {
				$this->error('修改失败！请检查是否有过修改后重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}

	public function del()
	{
		if (IS_POST) {
			$database_express = D('Express');
			$condition_express['id'] = intval($_POST['id']);

			if ($database_express->where($condition_express)->delete()) {
				S('express_list', NULL);
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
