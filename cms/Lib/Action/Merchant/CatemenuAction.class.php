<?php
class CatemenuAction extends BaseAction
{
	public $fid;

	public function _initialize()
	{
		parent::_initialize();
		$this->fid = isset($_REQUEST['fid']) ? intval($_REQUEST['fid']) : 0;
		$this->assign('fid', $this->fid);

		if ($this->fid) {
			$thisCatemenu = M('Catemenu')->find($this->fid);
			$this->assign('thisCatemenu', $thisCatemenu);
		}
	}

	public function index()
	{
		$db = D('catemenu');
		$where['token'] = $this->token;
		$where['fid'] = intval($_GET['fid']);
		$count = $db->where($where)->count();
		$page = new Page($count, 25);
		$info = $db->where($where)->order('orderss desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('countMenu', $count);
		$this->assign('page', $page->show());
		$this->assign('info', $info);
		$this->display();
	}

	public function add()
	{
		$this->display();
	}

	public function edit()
	{
		$id = $this->_get('id', 'intval');
		$info = M('Catemenu')->where(array('id' => $id, 'token' => $this->token))->find();
		$this->assign('info', $info);
		$this->display('add');
	}

	public function del()
	{
		$where['id'] = $this->_get('id', 'intval');
		$where['token'] = $this->token;

		if (D(MODULE_NAME)->where($where)->delete()) {
			$fidwhere['fid'] = intval($where['id']);
			D('Catemenu')->where($fidwhere)->delete();
			$this->success('操作成功', U(MODULE_NAME . 'Catemenu/index', array('fid' => $_GET['fid'])));
		}
		else {
			$this->error('操作失败', U(MODULE_NAME . 'Catemenu/index', array('fid' => $_GET['fid'])));
		}
	}

	public function insert()
	{
		$db = D('Catemenu');
		$id = (isset($_POST['id']) ? intval($_POST['id']) : 0);
		$name = (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '');

		if (empty($name)) {
			$this->error('菜单名不能为空!');
		}

		$old = $db->where('`name`=\'' . $name . ' AND `token`=\'' . $this->token . '\' AND `id`<>\'' . $id . '\'')->find();

		if ($old) {
			$this->error('菜单名已经存在!');
		}

		$orderss = (isset($_POST['orderss']) ? intval($_POST['orderss']) : 0);
		$status = (isset($_POST['status']) ? intval($_POST['status']) : 0);
		$url = (isset($_POST['url']) ? $_POST['url'] : '');
		$picurl = (isset($_POST['picurl']) ? $_POST['picurl'] : '');
		$fid = (isset($_POST['fid']) ? intval($_POST['fid']) : 0);
		$data = array('name' => $name, 'status' => $status, 'orderss' => $orderss, 'url' => $url, 'fid' => $fid);
		$images = $this->upload();

		if (empty($images['error'])) {
			foreach ($images['msg'] as $image) {
				$data[$image['key']] = substr($image['savepath'] . $image['savename'], 1);
			}
		}

		$data['picurl'] = $picurl ? $picurl : ($data['img'] ? $data['img'] : '');

		if ($id) {
			$res = $db->where(array('id' => $id, 'token' => $this->token))->save($data);
		}
		else {
			$data['token'] = $this->token;
			$res = $db->add($data);
		}

		if ($res) {
			$this->success('操作成功', U('Catemenu/index', array('fid' => $_POST['fid'])));
		}
		else {
			$this->error('操作失败', U('Catemenu/index', array('fid' => $_POST['fid'])));
		}
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
		$upload_dir = './upload/catemenu/' . $rand_num . '/';

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
		$token = session('token');
		S('bottomMenus_' . $token, NULL);
		$this->all_save();
	}

	public function styleSet()
	{
		$db = D('Home');
		$RadioGroup1 = $db->where(array('token' => $this->token))->getfield('RadioGroup');
		$this->assign('RadioGroup1', $RadioGroup1);
		$this->assign('radiogroup', $RadioGroup1);
		$this->display();
	}

	public function styleChange()
	{
		$db = D('Home');
		$info = $db->where(array('token' => $this->token))->find();
		$radiogroup = $this->_get('radiogroup');
		$token = $this->token;
		$data['radiogroup'] = $radiogroup;

		if ($info == false) {
			$data['token'] = $this->token;
			$res = $db->add($data);
		}
		else {
			$data['id'] = $info['id'];
			$res = $db->save($data);
		}

		import('ORG.Util.Dir');
		Dir::delDirnotself('./runtime');
	}

	public function colorChange()
	{
		$db = M('styleset');
		$info = $db->where(array('token' => $this->token))->find();
		$plugmenucolor = $this->_get('themestyle');
		$data['plugmenucolor'] = $plugmenucolor;

		if ($info == false) {
			$res = $db->add($data);
		}
		else {
			$data['id'] = $info['id'];
			$res = $db->save($data);
		}
	}

	public function chooseMenu()
	{
		$tpid = (isset($_GET['tpid']) ? intval($_GET['tpid']) : 0);
		include './PigCms/Lib/ORG/radiogroup.php';
		$this->assign('info', $bottomMenu[$tpid]);
		$this->assign('menu', $bottomMenu);
		$this->display();
	}

	public function plugmenu()
	{
		$where = array('token' => $this->token);
		$home = D('Home')->where(array('token' => $this->token))->find();

		if (IS_POST) {
			if ($home) {
				D('Home')->where($where)->save(array('plugmenucolor' => $this->_post('plugmenucolor'), 'copyright' => $this->_post('copyright')));
			}
			else {
				D('Home')->add(array('token' => $this->token, 'plugmenucolor' => $this->_post('plugmenucolor'), 'copyright' => $this->_post('copyright')));
			}

			$this->success('设置成功', U('Catemenu/plugmenu', array('token' => $this->token)));
		}
		else {
			if (!$home['plugmenucolor']) {
				$home['plugmenucolor'] = '#ff0000';
			}

			$this->assign('homeInfo', $home);
			$this->display();
		}
	}
}

?>
