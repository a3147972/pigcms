<?php
class HomeAction extends BaseAction
{
	public function set()
	{
		$home = D('Home')->where(array('token' => $this->merchant_session['mer_id']))->find();

		if (IS_POST) {
			$data = array();
			$data['token'] = $this->merchant_session['mer_id'];
			$data['picurl'] = isset($_POST['picurl']) ? htmlspecialchars($_POST['picurl']) : '';
			$data['title'] = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
			$data['info'] = isset($_POST['info']) ? htmlspecialchars($_POST['info']) : '';

			if ($home == false) {
				D('Home')->add($data);
			}
			else {
				D('Home')->where(array('token' => $this->merchant_session['mer_id']))->save($data);
			}

			$this->success('设置成功');
		}
		else {
			$this->assign('info', $home);
			$this->display();
		}
	}
}

?>
