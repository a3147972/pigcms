<?php
class FlashAction extends BaseAction
{
	public $tip;

	public function _initialize()
	{
		parent::_initialize();
		$this->tip = isset($_REQUEST['tip']) ? intval($_REQUEST['tip']) : 1;
		$this->assign('tip', $this->tip);
	}

	public function index()
	{
		$db = D('Flash');
		$where['token'] = $this->token;
		$where['tip'] = $this->tip;
		$count = $db->where($where)->count();
		import('@.ORG.merchant_page');
		$page = new Page($count, 25);
		$info = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id DESC')->select();
		$this->assign('page', $page->show());
		$this->assign('info', $info);
		$this->display();
	}

	public function back()
	{
		$this->tip = 2;
		$db = D('Flash');
		$where['token'] = $this->token;
		$where['tip'] = $this->tip;
		$count = $db->where($where)->count();
		import('@.ORG.merchant_page');
		$page = new Page($count, 25);
		$info = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id DESC')->select();
		$this->assign('page', $page->show());
		$this->assign('info', $info);
		$this->assign('tip', $this->tip);
		$this->display('index');
	}

	public function add()
	{
		$this->display();
	}

	public function edit()
	{
		$where['id'] = $this->_get('id', 'intval');
		$where['token'] = $this->token;
		$res = D('Flash')->where($where)->find();
		$this->assign('info', $res);
		$this->assign('id', $this->_get('id', 'intval'));
		$this->display('add');
	}

	public function del()
	{
		$where['id'] = $this->_get('id', 'intval');
		$where['token'] = $this->token;

		if (D('Flash')->where($where)->delete()) {
			$this->success('操作成功', U('Flash/index', array('tip' => $this->tip)));
		}
		else {
			$this->error('操作失败', U('Flash/index', array('tip' => $this->tip)));
		}
	}

	public function insert()
	{
		$flash = D('Flash');
		$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0);
		$arr = array();
		$arr['token'] = $this->token;
		$arr['url'] = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : '';
		$arr['info'] = isset($_POST['info']) ? htmlspecialchars($_POST['info']) : '';
		$arr['tip'] = $this->tip;
		$images = $this->upload();

		if (empty($images['error'])) {
			foreach ($images['msg'] as $image) {
				$arr[$image['key']] = $image['savepath'] . $image['savename'];
			}
		}

		if ($id) {
			$flash->where(array('id' => $id, 'token' => $this->token))->save($arr);
		}
		else {
			$flash->add($arr);
		}

		$this->success('操作成功', U('Flash/index', array('tip' => $this->tip)));
	}

	private function upload()
	{
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize = 5 * 1024 * 1024;
		$upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
		$upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
		$img_mer_id = sprintf('%09d', $this->merchant_session['mer_id']);
		$rand_num = substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
		$upload_dir = './upload/flash/' . $rand_num . '/';

		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 511, true);
		}

		$upload->savePath = $upload_dir;

		if (!$upload->upload()) {
			$error = 1;
			$msg = $upload->getErrorMsg();
		}
		else {
			$error = 0;
			$msg = $upload->getUploadFileInfo();
		}

		return array('error' => $error, 'msg' => $msg);
	}

	public function upsave()
	{
		$flash = D('Flash');
		$id = $this->_get('id', 'intval');
		$tip = $this->tip;
		$arr = array();
		$arr['img'] = $this->_post('img');
		$arr['url'] = $this->_post('url');
		$arr['info'] = $this->_post('info');
		$flash->where(array('id' => $id))->save($arr);
		$this->success('操作成功', U(MODULE_NAME . '/index', array('tip' => $this->tip)));
	}
}

?>
