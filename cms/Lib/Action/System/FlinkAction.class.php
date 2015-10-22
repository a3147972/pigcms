<?php
class FlinkAction extends BaseAction
{
	public function index()
	{
		$database_flink = D('Flink');
		$count_flink = $database_flink->count();
		import('@.ORG.system_page');
		$p = new Page($count_flink, 15);
		$flink_list = $database_flink->field(true)->order('`sort` DESC,`id` ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('flink_list', $flink_list);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
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
			$database_flink = D('Flink');

			if ($database_flink->data($_POST)->add()) {
				S('flink_list', NULL);
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
		$database_flink = D('Flink');
		$condition['id'] = intval($_GET['id']);
		$flink = $database_flink->field(true)->where($condition)->find();
		$this->assign('flink', $flink);
		$this->display();
	}

	public function amend()
	{
		if (IS_POST) {
			$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
			$database_flink = D('Flink');

			if ($database_flink->data($_POST)->save()) {
				S('flink_list', NULL);
				$this->success('链接修改成功！');
			}
			else {
				$this->error('链接修改失败！请检查是否有过修改后重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}

	public function del()
	{
		if (IS_POST) {
			$database_flink = D('Flink');
			$condition_flink['id'] = intval($_POST['id']);

			if ($database_flink->where($condition_flink)->delete()) {
				S('flink_list', NULL);
				$this->success('链接删除成功！');
			}
			else {
				$this->error('链接删除失败！请重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}
}

?>
