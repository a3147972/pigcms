<?php
class HardwareAction extends BaseAction
{
	public function index()
	{
		$list = D('Orderprinter')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
		$stores = D('Merchant_store')->field('store_id, name')->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
		$tmp = array();

		foreach ($stores as $s) {
			$tmp[$s['store_id']] = $s;
		}

		foreach ($list as &$o) {
			$o['name'] = isset($tmp[$o['store_id']]['name']) ? $tmp[$o['store_id']]['name'] : '';
		}

		$this->assign('list', $list);
		$this->display();
	}

	public function addprint()
	{
		$pigcms_id = (isset($_REQUEST['pigcms_id']) ? intval($_REQUEST['pigcms_id']) : 0);
		$pigcms_id && ($orderprint = D('Orderprinter')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $pigcms_id))->find());

		if (IS_POST) {
			$data['store_id'] = isset($_POST['store_id']) ? intval($_POST['store_id']) : 0;
			$data['username'] = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
			$data['mp'] = isset($_POST['mp']) ? htmlspecialchars($_POST['mp']) : '';
			$data['mcode'] = isset($_POST['mcode']) ? htmlspecialchars($_POST['mcode']) : '';
			$data['mkey'] = isset($_POST['mkey']) ? htmlspecialchars($_POST['mkey']) : '';
			$data['qrcode'] = isset($_POST['qrcode']) ? $_POST['qrcode'] : '';
			$data['count'] = isset($_POST['count']) ? intval($_POST['count']) : 1;
			$data['paid'] = isset($_POST['paid']) ? intval($_POST['paid']) : 0;
			$data['mer_id'] = intval($this->merchant_session['mer_id']);
			$data['count'] = min($data['count'], 100);

			if ($tobj = D('Orderprinter')->field(true)->where('`mer_id`=\'' . $this->merchant_session['mer_id'] . '\' AND `store_id`=\'' . $data['store_id'] . '\' AND `pigcms_id`<>\'' . $pigcms_id . '\'')->find()) {
				$this->error('该店铺已经添加了打印机');
			}

			if ($orderprint) {
				D('Orderprinter')->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $pigcms_id))->save($data);
			}
			else {
				D('Orderprinter')->add($data);
			}

			$this->success('操作成功', U('Hardware/index'));
		}
		else {
			$stores = D('Merchant_store')->field('store_id, name')->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
			$this->assign('orderprint', $orderprint);
			$this->assign('stores', $stores);
			$this->display();
		}
	}

	public function delprint()
	{
		$pigcms_id = (isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0);

		if ($orderprint = D('Orderprinter')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $pigcms_id))->find()) {
			D('Orderprinter')->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $pigcms_id))->delete();
			$this->success('打印机删除设置成功', U('Hardware/index'));
		}
		else {
			$this->error('不合法的参数请求', U('Hardware/index'));
		}
	}

	public function wifi()
	{
		$this->display();
	}
}

?>
