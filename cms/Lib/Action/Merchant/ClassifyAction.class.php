<?php
class ClassifyAction extends BaseAction
{
	public $fid;
	public $token;

	public function _initialize()
	{
		parent::_initialize();
		$this->fid = intval($_GET['fid']);
		$this->assign('fid', $this->fid);
		$this->token = $this->merchant_session['mer_id'];

		if ($this->fid) {
			$thisClassify = M('Classify')->find($this->fid);
			$this->assign('thisClassify', $thisClassify);
		}
	}

	public function index()
	{
		$db = D('Classify');
		$where['token'] = $this->token;
		$fid = $where['fid'] = isset($_GET['fid']) ? intval($_GET['fid']) : 0;
		$count = $db->where($where)->count();
		import('@.ORG.merchant_page');
		$page = new Page($count, 25);
		$info = $db->where($where)->order('sorts desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('page', $page->show());
		$this->assign('fid', $fid);
		$this->assign('info', $info);
		$this->display();
	}

	public function add()
	{
		include './cms/Lib/ORG/index.Tpl.php';
		include './cms/Lib/ORG/cont.Tpl.php';
		$this->assign('tpl', $tpl);
		$this->assign('contTpl', $contTpl);
		$queryname = M('token_open')->where(array('token' => $this->token))->getField('queryname');

		if (strpos(strtolower($queryname), strtolower('website')) !== false) {
			$this->assign('has_website', true);
		}

		$this->display();
	}

	public function edit()
	{
		$id = $this->_get('id', 'intval');
		$info = M('Classify')->find($id);
		include './cms/Lib/ORG/index.Tpl.php';
		include './cms/Lib/ORG/cont.Tpl.php';

		foreach ($tpl as $k => $v) {
			if ($v['tpltypeid'] == $info['tpid']) {
				$info['tplview'] = $v['tplview'];
			}
		}

		foreach ($contTpl as $key => $val) {
			if ($val['tpltypeid'] == $info['conttpid']) {
				$info['tplview2'] = $val['tplview'];
			}
		}

		$this->assign('contTpl', $contTpl);
		$this->assign('tpl', $tpl);
		$this->assign('info', $info);
		$this->display('add');
	}

	public function del()
	{
		$where['id'] = $this->_get('id', 'intval');
		$where['token'] = $this->token;

		if (D('Classify')->where($where)->delete()) {
			$fidwhere['fid'] = intval($where['id']);
			$fidwhere['token'] = $this->token;
			D('Classify')->where($fidwhere)->delete();
			$this->success('操作成功', U('Classify/index', array('fid' => $_GET['fid'])));
		}
		else {
			$this->error('操作失败', U('Classify/index', array('fid' => $_GET['fid'])));
		}
	}

	public function insert()
	{
		$db = D('Classify');
		$fid = (isset($_POST['fid']) ? intval($_POST['fid']) : 0);
		$id = (isset($_POST['id']) ? intval($_POST['id']) : 0);
		$_POST['info'] = str_replace('&quot;', '', $_POST['info']);
		$_POST['token'] = $this->token;
		$data = array('fid' => $fid, 'name' => htmlspecialchars($_POST['name']), 'info' => htmlspecialchars($_POST['info']), 'sorts' => intval($_POST['sorts']), 'tpid' => intval($_POST['tpid']), 'conttpid' => intval($_POST['conttpid']));
		$data['url'] = $_POST['url'];
		$data['status'] = intval($_POST['status']);

		if ($fid != '') {
			$f = $db->field('path')->where('id = ' . $fid)->find();
			$data['path'] = $f['path'] . '-' . $fid;
		}

		$images = $this->upload();

		if (empty($images['error'])) {
			foreach ($images['msg'] as $image) {
				$data[$image['key']] = $image['savepath'] . $image['savename'];
			}
		}

		$data['token'] = $this->token;

		if ($id) {
			$res = $db->where(array('token' => $this->token, 'id' => $id))->save($data);
		}
		else {
			$res = $db->add($data);
		}

		if ($res) {
			$this->success('操作成功', U('Classify/index', array('fid' => $_POST['fid'])));
		}
		else {
			$this->error('操作失败', U('Classify/index', array('fid' => $_POST['fid'])));
		}
	}

	private function upload()
	{
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize = 5 * 1024 * 1024;
		$upload->allowExts = array('jpg', 'jpeg', 'png', 'gif', 'mp3');
		$upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'audio/mp3');
		$img_mer_id = sprintf('%09d', $this->merchant_session['mer_id']);
		$rand_num = substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
		$upload_dir = './upload/site/' . $rand_num . '/';

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
		$_POST['info'] = str_replace('&quot;', '', $_POST['info']);
		$fid = $this->_post('fid', 'intval');

		if ($_POST['pc_show']) {
			$_POST['pc_cat_id'] = 0;
		}

		if ($fid == '') {
			$this->all_save();
		}
		else {
			$this->all_save('', '/index?fid=' . $fid);
		}
	}

	public function chooseTpl()
	{
		include './cms/Lib/ORG/index.Tpl.php';
		include './cms/Lib/ORG/cont.Tpl.php';
		$tpl = array_reverse($tpl);
		$filter = $this->_get('filter');
		if (isset($filter) && ($filter !== 'all') && ($filter != 'mix')) {
			foreach ($tpl as $kk => $vv) {
				if (strpos($vv['attr'], $filter)) {
					$filterTpl[$kk] = $vv;
				}
			}

			$tpl = $filterTpl;
		}

		$contTpl = array_reverse($contTpl);
		$tpid = $this->_get('tpid', 'intval');

		foreach ($tpl as $k => $v) {
			$sort[$k] = $v['sort'];
			$tpltypeid[$k] = $v['tpltypeid'];

			if ($v['tpltypeid'] == $tpid) {
				$info['tplview'] = $v['tplview'];
			}
		}

		foreach ($contTpl as $key => $val) {
			if ($val['tpltypeid'] == $tpid) {
				$info['tplview2'] = $val['tplview'];
			}
		}

		$this->assign('info', $info);
		$this->assign('contTpl', $contTpl);
		$this->assign('tpl', $tpl);
		$this->display();
	}

	public function changeClassifyTpl()
	{
		$tid = $this->_post('tid', 'intval');
		$cid = $this->_post('cid', 'intval');
		M('Classify')->where(array('token' => $this->token, 'id' => $cid))->setField('tpid', $tid);
		echo 200;
	}

	public function changeClassifyContTpl()
	{
		$tid = $this->_post('tid', 'intval');
		$cid = $this->_post('cid', 'intval');
		M('Classify')->where(array('token' => $this->token, 'id' => $cid))->setField('conttpid', $tid);
		echo 200;
	}

	public function flash()
	{
		$tip = $this->_get('tip', 'intval');
		$id = $this->_get('id', 'intval');
		$fid = $this->_get('fid', 'intval');

		if (empty($fid)) {
			$fid = 0;
		}

		$token = $this->token;
		$fl = M('Classify')->where(array('token' => $this->token, 'id' => $id, 'fid' => $fid))->find();
		$db = D('Flash');
		$where['uid'] = session('uid');
		$where['token'] = session('token');
		$where['tip'] = $tip;
		$where['did'] = $id;
		$where['fid'] = $fid;
		$count = $db->where($where)->count();
		$page = new Page($count, 25);
		$info = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('id DESC')->select();
		$this->assign('page', $page->show());
		$this->assign('fl', $fl);
		$this->assign('info', $info);
		$this->assign('id', $id);
		$this->assign('fid', $fid);
		$this->assign('tip', $tip);
		$this->display();
	}

	public function addflash()
	{
		$tip = $this->_get('tip', 'intval');
		$id = $this->_get('id', 'intval');
		$fid = $this->_get('fid', 'intval');
		$token = $this->token;
		$fl = M('Classify')->where(array('token' => $this->token, 'id' => $id))->getField('name');
		$this->assign('fl', $fl);
		$this->assign('tip', $tip);
		$this->assign('id', $id);
		$this->assign('fid', $fid);
		$this->display();
	}

	public function inserts()
	{
		$flash = D('Flash');
		$arr = array();
		$arr['token'] = $this->token;
		$arr['img'] = $this->_post('img');
		$arr['url'] = $this->_post('url');
		$arr['info'] = $this->_post('info');
		$arr['tip'] = $this->_get('tip', 'intval');
		$arr['did'] = $this->_get('id', 'intval');
		$arr['fid'] = $this->_get('fid', 'intval');

		if (empty($_POST['img'])) {
			$this->error('请先添加图片');
		}

		if ($flash->add($arr)) {
			$this->success('操作成功', U(MODULE_NAME . '/flash', array('tip' => $this->_GET('tip', 'intval'), 'id' => $this->_get('id'), 'fid' => $this->_get('fid'))));
		}
		else {
			$this->error('操作失败');
		}
	}

	public function editflash()
	{
		$tip = $this->_get('tip', 'intval');
		$where['id'] = $this->_get('id', 'intval');
		$where['uid'] = session('uid');
		$res = D('Flash')->where($where)->find();
		$this->assign('info', $res);
		$this->assign('tip', $tip);
		$this->assign('id', $this->_get('id', 'intval'));
		$this->display();
	}

	public function delflash()
	{
		$where['id'] = $this->_get('id', 'intval');
		$where['token'] = $this->token;

		if (D('Flash')->where($where)->delete()) {
			$this->success('操作成功');
		}
		else {
			$this->error('操作失败');
		}
	}

	public function updeit()
	{
		$flash = D('Flash');
		$id = $this->_get('id', 'intval');
		$tip = $this->_get('tip', 'intval');
		$list = $flash->where(array('id' => $id))->find();
		$arr = array();
		$arr['img'] = $this->_post('img');
		$arr['url'] = $this->_post('url');
		$arr['info'] = $this->_post('info');
		$data = $flash->where(array('id' => $id))->save($arr);

		if ($data) {
			$this->success('操作成功', U(MODULE_NAME . '/flash', array('tip' => $tip, 'id' => $list['did'], 'fid' => $list['fid'])));
		}
		else {
			$this->error('操作失败');
		}
	}

	public function essay()
	{
		$token = $this->token;
		$classid = $this->_get('id', 'intval');
		$name = M('Classify')->where(array('id' => $classid, 'token' => $token))->getField('name');
		$essay = M('Img')->where(array('classid' => $classid, 'token' => $token))->order('usort DESC')->select();
		$this->assign('info', $essay);
		$this->assign('name', $name);
		$this->display();
	}

	public function editUsort()
	{
		$token = $this->_post('token', 'htmlspecialchars');
		unset($_POST['__hash__']);

		foreach ($_POST as $k => $v) {
			$k = str_replace('usort', '', $k);
			$data[$k] = $v;
			M('Img')->where(array('token' => $token, 'id' => $k))->setField('usort', $v);
		}

		$this->success('保存成功');
	}

	public function set()
	{
		$home = M('Home')->where(array('token' => $this->token))->find();

		if (IS_POST) {
			$data['title'] = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
			$data['homeurl'] = isset($_POST['homeurl']) ? htmlspecialchars($_POST['homeurl']) : '';
			$data['info'] = isset($_POST['info']) ? htmlspecialchars($_POST['info']) : '';
			$data['gzhurl'] = isset($_POST['gzhurl']) ? htmlspecialchars($_POST['gzhurl']) : '';
			$data['apiurl'] = isset($_POST['apiurl']) ? htmlspecialchars($_POST['apiurl']) : '';
			$images = $this->upload();

			if (empty($images['error'])) {
				foreach ($images['msg'] as $image) {
					$data[$image['key']] = $image['savepath'] . $image['savename'];
				}
			}
			else {
				$this->error($images['msg'], U('Classify/set'));
			}

			if ($home) {
				$res = D('Home')->where(array('token' => $this->token))->save($data);
			}
			else {
				$data['token'] = $this->token;
				$res = D('Home')->add($data);
			}

			if ($res) {
				$this->success('操作成功', U('Classify/set'));
			}
			else {
				$this->error('操作失败', U('Classify/set'));
			}
		}
		else {
			$this->assign('home', $home);
			$this->display();
		}
	}
}

?>
