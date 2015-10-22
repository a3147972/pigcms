<?php
class ClassifyAction extends BaseAction
{
	public function index()
	{
		$database_Classify_category = D('Classify_category');
		$fcid = intval($_GET['fcid']);
		$pfcid = intval($_GET['pfcid']);
		$condition['fcid'] = $fcid;

		if (0 < $pfcid) {
			$condition['pfcid'] = intval($_GET['pfcid']);
		}

		$count_Classify_category = $database_Classify_category->where($condition)->count();
		import('@.ORG.system_page');
		$p = new Page($count_Classify_category, 30);
		$category_list = $database_Classify_category->field(true)->where($condition)->order('`cat_sort` DESC,`cid` ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('category_list', $category_list);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);

		if (0 < $fcid) {
			$condition_now['cid'] = $fcid;

			if (0 < $pfcid) {
				$condition_now['fcid'] = $pfcid;
			}

			$now_category = $database_Classify_category->field(true)->where($condition_now)->find();

			if (empty($now_category)) {
				$this->error_tips('没有找到该分类信息！', 3, U('Group/index'));
			}

			$this->assign('now_category', $now_category);
		}

		$this->assign('fcid', $fcid);
		$this->assign('pfcid', $pfcid);
		$this->display();
	}

	public function cat_add()
	{
		$fcid = intval($_GET['fcid']);
		$pfcid = intval($_GET['pfcid']);
		$this->assign('bg_color', '#F3F3F3');
		$this->assign('fcid', $fcid);
		$this->assign('pfcid', $pfcid);
		$this->display();
	}

	public function cat_modify()
	{
		if (IS_POST) {
			$fcid = intval($_POST['fcid']);
			$pfcid = intval($_POST['pfcid']);
			if ((0 < $fcid) && ($pfcid == 0)) {
				$_POST['subdir'] = 2;
			}

			if ((0 < $fcid) && (0 < $pfcid)) {
				$_POST['subdir'] = 3;
				$_POST['cat_sort'] = 0;
				$_POST['is_hot'] = 0;
				$_POST['cat_status'] = 1;
			}

			$datas = $this->Removalquotes($_POST);
			$database_Classify_category = D('Classify_category');
			$datas['addtime'] = $datas['updatetime'] = time();

			if ($database_Classify_category->data($datas)->add()) {
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

	public function cat_edit()
	{
		$this->assign('bg_color', '#F3F3F3');
		$database_Classify_category = D('Classify_category');
		$condition_now_Classify_category['cid'] = intval($_GET['cid']);
		$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

		if (empty($now_category)) {
			$this->frame_error_tips('没有找到该分类信息！');
		}

		$this->assign('now_category', $now_category);
		$this->display();
	}

	public function cat_amend()
	{
		if (IS_POST) {
			$database_Classify_category = D('Classify_category');
			$datas = $this->Removalquotes($_POST);

			if ($database_Classify_category->data($datas)->save()) {
				$this->success('编辑成功！');
			}
			else {
				$this->error('编辑失败！请重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}

	public function cat_del()
	{
		if (IS_POST) {
			$database_Classify_category = D('Classify_category');
			$where['cid'] = intval($_POST['cid']);
			$now_category = $database_Classify_category->field(true)->where($where)->find();

			if ($database_Classify_category->where($where)->delete()) {
				if ($now_category['subdir'] == 1) {
					$database_Classify_category->where(array('fcid' => $now_category['cid']))->delete();
					$database_Classify_category->where(array('pfcid' => $now_category['cid']))->delete();
				}
				else if ($now_category['subdir'] == 2) {
					$database_Classify_category->where(array('fcid' => $now_category['cid']))->delete();
				}

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

	public function cat_field()
	{
		$database_Classify_category = D('Classify_category');
		$condition_now_Classify_category['cid'] = intval($_GET['cid']);
		$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

		if (empty($now_category)) {
			$this->frame_error_tips('没有找到该分类信息！');
		}

		if (!empty($now_category['cat_fid'])) {
			$this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
		}

		if (!empty($now_category['cat_field'])) {
			$now_category['cat_field'] = unserialize($now_category['cat_field']);

			foreach ($now_category['cat_field'] as $key => $value) {
				if ($value['use_field'] == 'area') {
					$now_category['cat_field'][$key]['name'] = '区域(内置)';
					$now_category['cat_field'][$key]['url'] = 'area';
				}

				if ($value['use_field'] == 'price') {
					$now_category['cat_field'][$key]['name'] = '价格(内置)';
					$now_category['cat_field'][$key]['url'] = 'area';
				}
			}
		}

		$f_category = $database_Classify_category->field(true)->where(array('cid' => $now_category['fcid']))->find();
		$f_empty_cat_field = (empty($f_category) || empty($f_category['cat_field']) ? true : false);
		unset($f_category);
		$this->assign('f_empty_cat_field', $f_empty_cat_field);
		$this->assign('now_category', $now_category);
		$InputTypeArr = $this->getInputType();
		$this->assign('inputTypeArr', $InputTypeArr);
		$this->display();
	}

	public function cat_field_add()
	{
		$database_Classify_category = D('Classify_category');
		$condition_now_Classify_category['cid'] = intval($_GET['cid']);
		$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();
		$i = 0;

		if (!empty($now_category['cat_field'])) {
			$cat_field = unserialize($now_category['cat_field']);

			foreach ($cat_field as $key => $vv) {
				if (isset($vv['isfilter']) && ($vv['isfilter'] == 1)) {
					$i++;
				}
			}
		}

		$this->assign('isfilter', $i);
		$InputTypeArr = $this->getInputType();
		$this->assign('bg_color', '#F3F3F3');
		$this->assign('inputTypeArr', $InputTypeArr);
		$this->display();
	}

	public function fieldInherit()
	{
		$cid = intval($_GET['pcid']);
		$mycid = intval($_GET['cid']);
		$Classify_categoryDb = D('Classify_category');
		$pcategory = $Classify_categoryDb->field(true)->where(array('cid' => $cid))->find();
		if ($pcategory['cat_field'] && (0 < $mycid)) {
			$fg = $Classify_categoryDb->where(array('cid' => $mycid))->save(array('cat_field' => $pcategory['cat_field']));

			if ($fg) {
				$this->success('处理成功！');
				exit();
			}
		}

		$this->error('处理失败！');
	}

	private function getInputType()
	{
		$session_InputType = session('inputTypeInfo');
		if (false && !empty($session_InputType)) {
			$session_InputType = unserialize($session_InputType);
		}
		else {
			$inputtypeDb = D('Classify_inputtype');
			$session_InputType = $inputtypeDb->where('1=1')->order('id ASC')->select();

			if (!empty($session_InputType)) {
				$newarr = array();

				foreach ($session_InputType as $vv) {
					$newarr[$vv['typ']] = $vv;
				}

				$session_InputType = $newarr;
			}

			session('inputTypeInfo', serialize($session_InputType));
		}

		return $session_InputType;
	}

	public function cat_field_modify()
	{
		if (IS_POST) {
			$database_Classify_category = D('Classify_category');
			$condition_now_Classify_category['cid'] = intval($_POST['cid']);
			$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();
			$mc = 1;

			if (!empty($now_category['cat_field'])) {
				$cat_field = unserialize($now_category['cat_field']);

				foreach ($cat_field as $key => $value) {
					if ((!empty($_POST['use_field']) && ($value['use_field'] == $_POST['use_field'])) || (!empty($_POST['url']) && ($value['url'] == trim($_POST['url'])))) {
						$this->error('字段已经添加，请勿重复添加！');
					}

					if (isset($value['isfilter']) && ($value['isfilter'] == 1)) {
						$mc++;
					}
				}

				if (4 < $mc) {
					$mc = 0;
				}
			}
			else {
				$cat_field = array();
			}

			$numfilter = intval($_POST['numfilter']);

			if (empty($_POST['use_field'])) {
				$post_data['name'] = trim($_POST['name']);
				$post_data['url'] = trim($_POST['url']);
				$post_data['type'] = intval($_POST['type']);
				$post_data['isfilter'] = intval($_POST['isfilter']);
				$filtercon = trim($_POST['filtercon']);
				$post_data['iswrite'] = intval($_POST['iswrite']);
				if (($post_data['isfilter'] == 1) && !empty($filtercon)) {
					$filtercon = $this->Removalquotes($filtercon);
					$post_data['filtercon'] = explode(PHP_EOL, $filtercon);
					$post_data['input'] = $mc;
				}

				if ($post_data['type'] == 1) {
					$post_data['inarr'] = intval($_POST['inarr']);
					$post_data['inunit'] = trim($_POST['inunit']);
				}

				if (in_array($post_data['type'], array(2, 3, 4))) {
					$valueoftype = trim($_POST['valueoftype']);

					if (empty($valueoftype)) {
						$this->error('供选择值框必须填上！');
					}

					$valueoftype = $this->Removalquotes($valueoftype);
					$post_data['opt'] = explode(PHP_EOL, $valueoftype);
				}
			}
			else {
				$post_data['use_field'] = $_POST['use_field'];
				$post_data['isfilter'] = (4 < $numfilter) || ($mc == 0) ? 0 : 1;
				$post_data['type'] = 4;
				$post_data['name'] = '区域';
				$post_data['url'] = $post_data['use_field'];
				$post_data['iswrite'] = 0;
				$post_data['input'] = $mc;
			}

			array_push($cat_field, $post_data);
			$data_Classify_category['cat_field'] = serialize($cat_field);
			$data_Classify_category['cid'] = $now_category['cid'];

			if ($database_Classify_category->data($data_Classify_category)->save()) {
				$this->success('添加字段成功！');
			}
			else {
				$this->error('添加失败！请重试~');
			}
		}
		else {
			$this->error('非法提交,请重新提交~');
		}
	}

	private function Removalquotes($array)
	{
		$regex = '/\\\'|"|\\/|\\\\|\\<script|\\<\\/script/';

		if (is_array($array)) {
			foreach ($array as $key => $value) {
				if (is_array($value)) {
					$array[$key] = $this->Removalquotes($value);
				}
				else {
					$value = strip_tags(trim($value));
					$array[$key] = preg_replace($regex, '', $value);
				}
			}

			return $array;
		}
		else {
			$array = strip_tags(trim($array));
			$array = preg_replace($regex, '', $array);
			return $array;
		}
	}

	public function cue_field()
	{
		$database_Classify_category = D('Classify_category');
		$condition_now_Classify_category['cid'] = intval($_GET['cid']);
		$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

		if (empty($now_category)) {
			$this->frame_error_tips('没有找到该分类信息！');
		}

		if (!empty($now_category['cat_fid'])) {
			$this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
		}

		if (!empty($now_category['cue_field'])) {
			$now_category['cue_field'] = unserialize($now_category['cue_field']);
		}

		$this->assign('now_category', $now_category);
		$this->display();
	}

	public function cue_field_add()
	{
		$this->assign('bg_color', '#F3F3F3');
		$this->display();
	}

	public function cue_field_modify()
	{
		if (IS_POST) {
			$database_Classify_category = D('Classify_category');
			$condition_now_Classify_category['cid'] = intval($_POST['cid']);
			$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

			if (!empty($now_category['cue_field'])) {
				$cue_field = unserialize($now_category['cue_field']);

				foreach ($cue_field as $key => $value) {
					if ($value['name'] == $_POST['name']) {
						$this->error('该填写项已经添加，请勿重复添加！');
					}
				}
			}
			else {
				$cue_field = array();
			}

			$post_data['name'] = $_POST['name'];
			$post_data['type'] = $_POST['type'];
			$post_data['sort'] = strval($_POST['sort']);
			array_push($cue_field, $post_data);
			$data_Classify_category['cue_field'] = serialize($cue_field);
			$data_Classify_category['cid'] = $now_category['cid'];

			if ($database_Classify_category->data($data_Classify_category)->save()) {
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

	public function cue_field_del()
	{
		if (IS_POST) {
			$database_Classify_category = D('Classify_category');
			$condition_now_Classify_category['cid'] = intval($_POST['cid']);
			$now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

			if (!empty($now_category['cue_field'])) {
				$cue_field = unserialize($now_category['cue_field']);
				$new_cue_field = array();

				foreach ($cue_field as $key => $value) {
					if ($value['name'] != $_POST['name']) {
						array_push($new_cue_field, $value);
					}
				}
			}
			else {
				$this->error('此填写项不存在！');
			}

			$data_Classify_category['cue_field'] = serialize($new_cue_field);
			$data_Classify_category['cid'] = $now_category['cid'];

			if ($database_Classify_category->data($data_Classify_category)->save()) {
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

	public function checkList()
	{
		$isverify = C('config.classify_verify');
		$isverify = intval($isverify);
		$userinputDb = M('Classify_userinput');
		$wherestr = 'status="0"';
		$count_userinputDb = $userinputDb->where($wherestr)->count();
		import('@.ORG.system_page');
		$p = new Page($count_userinputDb, 20);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,lxname,lxtel,addtime,updatetime')->where($wherestr)->order('updatetime DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$subdir1 = $this->get_directory(1);
		$subdir2 = $this->get_directory(2);
		$ClassifyArr = array();

		if (!empty($subdir1)) {
			foreach ($subdir1 as $v1v) {
				$ClassifyArr[$v1v['cid']] = $v1v['cat_name'];
			}
		}

		$subdir2Arr = false;

		if (!empty($subdir2)) {
			foreach ($subdir2 as $v2v) {
				$ClassifyArr[$v2v['cid']] = $v2v['cat_name'];

				if ($v2v['fcid'] == $cid) {
					$subdir2Arr[] = $v2v;
				}
			}
		}

		unset($subdir1);
		unset($subdir2);
		$this->assign('isverify', $isverify);
		$this->assign('needCheck', $tmpdatas);
		$this->assign('ClassifyArr', $ClassifyArr);
		$this->display();
	}

	public function infoList()
	{
		$cid = (isset($_GET['cid']) ? intval($_GET['cid']) : 0);
		$subdir2cid = (isset($_GET['subdir2']) ? intval($_GET['subdir2']) : 0);
		$id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
		$title = (isset($_GET['title']) ? $this->Removalquotes($_GET['title']) : '');
		$userinputDb = M('Classify_userinput');
		$wherestr = 'status="1"';

		if (0 < $id) {
			$wherestr .= ' AND id=' . $id;
		}
		else {
			if ((0 < $cid) && ($subdir2cid == 0)) {
				$wherestr .= ' AND fcid=' . $cid;
			}
			else {
				if ((0 < $cid) && (0 < $subdir2cid)) {
					$wherestr .= ' AND cid=' . $subdir2cid;
				}
				else if (!empty($title)) {
					$wherestr .= ' AND title LIKE "%' . $title . '%"';
				}
			}
		}

		$count_userinputDb = $userinputDb->where($wherestr)->count();
		import('@.ORG.system_page');
		$p = new Page($count_userinputDb, 20);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,lxname,lxtel,addtime,updatetime,views,status,toptime,endtoptime')->where($wherestr)->order('updatetime DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$subdir1 = $this->get_directory(1);
		$subdir2 = $this->get_directory(2);
		$ClassifyArr = array();

		if (!empty($subdir1)) {
			foreach ($subdir1 as $v1v) {
				$ClassifyArr[$v1v['cid']] = $v1v['cat_name'];
			}
		}

		$subdir2Arr = false;

		if (!empty($subdir2)) {
			foreach ($subdir2 as $v2v) {
				$ClassifyArr[$v2v['cid']] = $v2v['cat_name'];

				if ($v2v['fcid'] == $cid) {
					$subdir2Arr[] = $v2v;
				}
			}
		}

		unset($subdir2);
		$this->assign('id', $id == 0 ? '' : $id);
		$this->assign('cid', $cid);
		$this->assign('title', $title);
		$this->assign('subdir2cid', $subdir2cid);
		$this->assign('subdir1', $subdir1);
		$this->assign('listdatas', $tmpdatas);
		$this->assign('ClassifyArr', $ClassifyArr);
		$this->assign('subdir2Arr', $subdir2Arr);
		$this->display();
	}

	public function topList()
	{
		$cid = (isset($_GET['cid']) ? intval($_GET['cid']) : 0);
		$subdir2cid = (isset($_GET['subdir2']) ? intval($_GET['subdir2']) : 0);
		$tmpdatas = array();
		if ((0 < $cid) && (0 < $subdir2cid)) {
			$userinputDb = M('Classify_userinput');
			$wherestr = 'status="1"';
			$wherestr .= ' AND cid=' . $subdir2cid . ' AND fcid=' . $cid;
			$wherestr .= ' AND toptime >0 ';
			$tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,lxname,lxtel,addtime,updatetime,views,status,endtoptime,topsort')->where($wherestr)->order('topsort DESC,toptime DESC')->select();
		}

		$subdir1 = $this->get_directory(1);
		$subdir2 = $this->get_directory(2);
		$ClassifyArr = array();

		if (!empty($subdir1)) {
			foreach ($subdir1 as $v1v) {
				$ClassifyArr[$v1v['cid']] = $v1v['cat_name'];
			}
		}

		$subdir2Arr = false;

		if (!empty($subdir2)) {
			foreach ($subdir2 as $v2v) {
				$ClassifyArr[$v2v['cid']] = $v2v['cat_name'];

				if ($v2v['fcid'] == $cid) {
					$subdir2Arr[] = $v2v;
				}
			}
		}

		unset($subdir2);
		$this->assign('cid', $cid);
		$this->assign('subdir2cid', $subdir2cid);
		$this->assign('subdir1', $subdir1);
		$this->assign('listdatas', $tmpdatas);
		$this->assign('ClassifyArr', $ClassifyArr);
		$this->assign('subdir2Arr', $subdir2Arr);
		$this->display();
	}

	public function topsort()
	{
		$cid = intval($_POST['cid']);
		$fcid = intval($_POST['fcid']);
		if ((0 < $cid) && (0 < $fcid)) {
			$ids = trim(urldecode($_POST['ids']));
			$sorts = trim(urldecode($_POST['vals']));
			$idsarr = explode(',', $ids);
			$sortsarr = explode(',', $sorts);
			if (!empty($idsarr) && is_array($idsarr) && !empty($sortsarr) && is_array($sortsarr)) {
				$userinputDb = M('Classify_userinput');

				foreach ($idsarr as $kk => $vv) {
					$userinputDb->where(array('id' => $vv, 'cid' => $cid, 'fcid' => $fcid))->save(array('topsort' => $sortsarr[$kk]));
				}

				echo json_encode(array('error' => 0));
				exit();
			}
		}

		echo json_encode(array('error' => 1));
	}

	public function attrSet()
	{
		$currenttime = time();
		$tmp = $currenttime + (7 * 24 * 3600);
		$vid = intval($_GET['vid']);
		$tmpitem = M('Classify_userinput')->field('id,toptime,endtoptime,topsort,btcolor,jumpUrl')->where(array('id' => $vid))->find();
		$datetime = (!empty($tmpitem) && ($currenttime < $tmpitem['endtoptime']) ? date('Y-m-d H:i:s', $tmpitem['endtoptime']) : date('Y-m-d H:i:s', $tmp));
		$this->assign('currenttime', $currenttime);
		$this->assign('item', $tmpitem);
		$this->assign('vid', $vid);
		$this->assign('datetime', $datetime);
		$this->assign('bg_color', '#F3F3F3');
		$this->display();
	}

	public function attrSeting()
	{
		$vid = intval($_POST['vid']);
		$toptime = $this->Removalquotes($_POST['toptime']);
		$topsort = intval($_POST['topsort']);
		$totoptime = strtotime($toptime);
		$currenttime = time();
		$bt_color = trim($_POST['bt_color']);
		$jumpUrl = trim($_POST['jumpUrl']);

		if (!preg_match('/^https?:\\/\\//i', $jumpUrl)) {
			$jumpUrl = '';
		}

		if (!preg_match('/rgb\\([0-9]{1,3},\\s*[0-9]{1,3},\\s*[0-9]{1,3}\\)/i', $bt_color)) {
			$bt_color = '';
		}

		if ((0 < $vid) && ($currenttime < $totoptime)) {
			$Classify_userinputDB = M('Classify_userinput');
			$Classify_userinputDB->where(array('id' => $vid))->save(array('toptime' => $currenttime, 'endtoptime' => $totoptime, 'topsort' => 0 < $topsort ? $topsort : 0, 'btcolor' => $bt_color, 'jumpUrl' => $jumpUrl));
			$this->success('置顶成功');
			exit();
		}

		$this->error('置顶操作失败，可能是您的设置的置顶时间小于当前时间了');
	}

	private function get_directory($subdir, $cid = 0)
	{
		$Classify_categoryDb = M('Classify_category');
		$Subdirectory = array();
		$where = false;

		if (0 < $cid) {
			$where = array('fcid' => $cid, 'subdir' => 2, 'cat_status' => 1);
		}
		else {
			$where = array('subdir' => $subdir, 'cat_status' => 1);
		}

		if ($where) {
			$Subdirectory = $Classify_categoryDb->field('cid,fcid,subdir,cat_name')->where($where)->order('`cat_sort` DESC,`cid` ASC')->select();
		}

		return $Subdirectory;
	}

	public function get2Subdir()
	{
		$cid = trim($_POST['cid']);
		$subdir2 = $this->get_directory(2, $cid);

		if (!empty($subdir2)) {
			echo json_encode($subdir2);
		}
		else {
			echo 0;
		}

		exit();
	}

	public function toVerify()
	{
		$vid = intval($_POST['vid']);

		if (0 < $vid) {
			M('Classify_userinput')->where(array('id' => $vid))->save(array('status' => 1));

			if (isset($_POST['dosubmit'])) {
				$this->success('审核成功！');
			}
			else {
				echo 0;
				exit();
			}
		}

		if (isset($_POST['dosubmit'])) {
			$this->error('审核失败！');
		}
		else {
			echo 1;
			exit();
		}
	}

	public function toNoVerify()
	{
		$vid = intval($_POST['vid']);
		$sv = intval($_POST['sv']);

		if (0 < $vid) {
			M('Classify_userinput')->where(array('id' => $vid))->save(array('status' => 0));
			echo 0;
			exit();
		}

		echo 1;
		exit();
	}

	public function CancelTop()
	{
		$vid = intval($_POST['vid']);

		if (0 < $vid) {
			$tmp = M('Classify_userinput')->where(array('id' => $vid))->save(array('toptime' => 0, 'endtoptime' => 0, 'topsort' => 0));

			if ($tmp) {
				echo 0;
				exit();
			}
			else {
				echo 1;
				exit();
			}
		}
	}

	public function delItem()
	{
		$vid = intval($_POST['vid']);

		if (0 < $vid) {
			$tmp = M('Classify_userinput')->where(array('id' => $vid))->delete();

			if ($tmp) {
				echo 0;
				exit();
			}
			else {
				echo 1;
				exit();
			}
		}
	}

	public function infodetail()
	{
		$vid = intval($_GET['vid']);
		$vid = (0 < $vid ? $vid : 0);
		$tmpdata = M('Classify_userinput')->field(true)->where(array('id' => $vid))->find();
		$content = (!empty($tmpdata['content']) ? unserialize($tmpdata['content']) : false);
		$tmpdata['updatetime'] = date('Y-m-d H:i', $tmpdata['updatetime']);
		$imgarr = (!empty($tmpdata['imgs']) ? unserialize($tmpdata['imgs']) : false);
		$this->assign('imglist', $imgarr);
		$this->assign('detail', $tmpdata);
		$this->assign('content', $content);
		$this->assign('bg_color', '#F3F3F3');
		$this->assign('vid', $vid);
		$this->display();
	}
}

?>
