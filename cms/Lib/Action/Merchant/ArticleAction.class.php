<?php
class ArticleAction extends BaseAction
{
	public function index()
	{
		$count = D('Source_material')->where(array('mer_id' => $this->merchant_session['mer_id']))->count('pigcms_id');
		import('@.ORG.merchant_page');
		$p = new Page($count, 10);
		$list = D('Source_material')->where(array('mer_id' => $this->merchant_session['mer_id']))->order('pigcms_id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$it_ids = array();
		$temp = array();

		foreach ($list as $l) {
			foreach (unserialize($l['it_ids']) as $id) {
				if (!in_array($id, $it_ids)) {
					$it_ids[] = $id;
				}
			}
		}

		$result = array();
		$image_text = D('Image_text')->field('pigcms_id, title')->where(array(
	'pigcms_id' => array('in', $it_ids)
	))->order('pigcms_id asc')->select();

		foreach ($image_text as $txt) {
			$result[$txt['pigcms_id']] = $txt;
		}

		foreach ($list as &$l) {
			$l['dateline'] = date('Y-m-d H:i:s', $l['dateline']);

			foreach (unserialize($l['it_ids']) as $id) {
				$l['list'][] = isset($result[$id]) ? $result[$id] : array();
			}
		}

		$this->assign('list', $list);
		$this->assign('page', $p->show());
		$this->display();
	}

	public function select_img()
	{
		$count = D('Source_material')->where(array('mer_id' => $this->merchant_session['mer_id']))->count('pigcms_id');
		$p = new Page($count, 10);
		$image_text = D('Image_text')->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->order('pigcms_id asc')->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('list', $image_text);
		$this->assign('page', $p->show());
		$this->display();
	}

	public function del_image()
	{
		$pigcms_id = (isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0);

		if ($data = D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find()) {
			if ($data['type'] == 0) {
				$it_ids = unserialize($data['it_ids']);
				$id = (isset($it_ids[0]) ? intval($it_ids[0]) : 0);
				D('Image_text')->where(array('pigcms_id' => $id, 'mer_id' => $this->merchant_session['mer_id']))->delete();
			}

			D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->delete();
			$this->error('删除成功', U('Article/index'));
		}
		else {
			$this->error('不合法的操作');
		}
	}

	public function one()
	{
		if (IS_POST) {
			$pigcms_id = (isset($_POST['pigcms_id']) ? intval($_POST['pigcms_id']) : 0);
			$thisid = (isset($_POST['thisid']) ? intval($_POST['thisid']) : 0);
			$data['content'] = isset($_POST['content']) ? fulltext_filter($_POST['content']) : '';
			$data['title'] = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
			$data['author'] = isset($_POST['author']) ? htmlspecialchars($_POST['author']) : '';
			$data['url'] = isset($_POST['url']) ? $_POST['url'] : '';
			$data['url_title'] = isset($_POST['url_title']) ? htmlspecialchars($_POST['url_title']) : '';
			$data['cover_pic'] = isset($_POST['cover_pic']) ? htmlspecialchars($_POST['cover_pic']) : '';
			$data['digest'] = isset($_POST['digest']) ? htmlspecialchars($_POST['digest']) : '';
			$data['is_show'] = isset($_POST['is_show']) ? intval($_POST['is_show']) : 0;
			$data['classid'] = isset($_POST['classid']) ? intval($_POST['classid']) : 0;
			$data['classname'] = isset($_POST['classname']) ? htmlspecialchars($_POST['classname']) : '';

			if (empty($data['title'])) {
				$this->error('标题不能为空！');
			}

			if (empty($data['cover_pic'])) {
				$this->error('必须得有封面图！');
			}

			if (empty($data['content'])) {
				$this->error('内容不能为空！');
			}

			$data['dateline'] = time();
			$data['mer_id'] = $this->merchant_session['mer_id'];
			if ($pigcms_id && $thisid) {
				if (D('Image_text')->where(array('pigcms_id' => $thisid, 'mer_id' => $this->merchant_session['mer_id']))->data($data)->save()) {
					D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->data(array('it_ids' => serialize(array($thisid)), 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time()))->save();
					$this->success('编辑成功！');
				}
				else {
					$this->error('操作失败稍后重试！');
				}
			}
			else if ($id = D('Image_text')->data($data)->add()) {
				D('Source_material')->data(array('it_ids' => serialize(array($id)), 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time()))->add();
				$this->success('新增成功！');
			}
			else {
				$this->error('操作失败稍后重试！');
			}
		}
		else {
			$pigcms_id = (isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0);
			$image_text = array('title' => '标题', 'cover_pic' => '', 'author' => '', 'content' => '', 'digest' => '', 'url' => '', 'dateline' => time(), 'pigcms_id' => 0);

			if ($data = D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find()) {
				$it_ids = unserialize($data['it_ids']);
				$id = (isset($it_ids[0]) ? intval($it_ids[0]) : 0);
				$image_text = D('Image_text')->where(array('pigcms_id' => $id, 'mer_id' => $this->merchant_session['mer_id']))->find();
			}

			$this->assign('pigcms_id', $pigcms_id);
			$this->assign('image_text', $image_text);
			$this->display();
		}
	}

	public function multi()
	{
		if (IS_POST) {
			$ids = (isset($_POST['imgids']) ? htmlspecialchars($_POST['imgids']) : '');
			$ids = explode(',', $ids);

			if (10 < count($ids)) {
				$this->error('最多十条图文');
			}

			$pigcms_id = (isset($_POST['pigcms_id']) ? intval($_POST['pigcms_id']) : 0);
			if ($pigcms_id && ($data = D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->find())) {
				D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $this->merchant_session['mer_id']))->data(array('it_ids' => serialize($ids), 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time(), 'type' => 1))->save();
				$this->success('编辑成功！');
			}
			else {
				D('Source_material')->data(array('it_ids' => serialize($ids), 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time(), 'type' => 1))->add();
				$this->success('创建成功！');
			}
		}
		else {
			$this->display();
		}
	}

	public function editClass()
	{
		$db = D('Classify');
		$id = (int) $this->_get('id');
		$class = $db->where('token = \'' . $this->merchant_session['mer_id'] . '\' AND fid = ' . $id)->select();

		foreach ($class as $k => $v) {
			$fid = $v['id'];
			$class[$k]['sub'] = $db->where('token = \'' . $this->merchant_session . '[\'mer_id\']\' AND fid = ' . $fid)->field('id,name')->select();
			$class[$k]['pc_cat_id'] = 0;
		}

		$this->assign('class', $class);
		$this->display();
	}

	public function diytool()
	{
		$this->display();
	}
}

?>
