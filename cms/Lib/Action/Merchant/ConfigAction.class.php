<?php
class ConfigAction extends BaseAction
{
	public function merchant()
	{
		$database_merchant = D('Merchant');

		if (IS_POST) {
			$data_merchant['phone'] = $_POST['phone'];

			if (empty($data_merchant['phone'])) {
				$this->error('请输入联系人电话');
			}

			if (!empty($_POST['new_pass'])) {
				$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
				$now_merchant = $database_merchant->field('`pwd`')->where($condition_merchant)->find();

				if (md5($_POST['old_pass']) != $now_merchant['pwd']) {
					$this->error('原密码输入错误');
				}
				else if (strlen($_POST['new_pass']) < 6) {
					$this->error('新密码最少6个字符');
				}
				else if ($_POST['new_pass'] != $_POST['re_pass']) {
					$this->error('两次新密码输入不一致，请重新输入');
				}
				else {
					$data_merchant['pwd'] = md5($_POST['new_pass']);
				}
			}

			if (empty($_POST['pic'])) {
				$this->error('请至少上传一张图片');
			}

			$data_merchant['pic_info'] = implode(';', $_POST['pic']);
			$data_merchant['txt_info'] = $_POST['txt_info'];

			if (empty($data_merchant['txt_info'])) {
				$this->error('请输入商家描述信息');
			}

			$data_merchant['mer_id'] = $this->merchant_session['mer_id'];

			if ($database_merchant->data($data_merchant)->save()) {
				$this->success('保存成功！');
			}
			else {
				$this->error('保存失败！请检查是否有修改过内容后重试');
			}
		}
		else {
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$now_merchant = $database_merchant->field(true, 'pwd')->where($condition_merchant)->find();

			if (!empty($now_merchant['pic_info'])) {
				$merchant_image_class = new merchant_image();
				$tmp_pic_arr = explode(';', $now_merchant['pic_info']);

				foreach ($tmp_pic_arr as $key => $value) {
					$now_merchant['pic'][$key]['title'] = $value;
					$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
				}
			}

			$this->assign('now_merchant', $now_merchant);
			$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);
			$this->assign('merchant_group_list', $merchant_group_list);
		}

		$this->display();
	}

	public function merchant_promote()
	{
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
		$now_merchant = $database_merchant->field(true, 'pwd')->where($condition_merchant)->find();

		if (!empty($now_merchant['pic_info'])) {
			$merchant_image_class = new merchant_image();
			$tmp_pic_arr = explode(';', $now_merchant['pic_info']);

			foreach ($tmp_pic_arr as $key => $value) {
				$now_merchant['pic'][$key]['title'] = $value;
				$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
			}
		}

		$this->assign('now_merchant', $now_merchant);
		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);
		$this->assign('merchant_group_list', $merchant_group_list);
		$hits = D('Group')->get_hits_log($now_merchant['mer_id']);
		$this->assign('hits', $hits['group_list']);
		$this->assign('pagebar', $hits['pagebar']);
		$this->display();
	}

	public function merchant_indexsort()
	{
		if (IS_POST) {
			$database_merchant = D('Merchant');
			$group_indexsort = intval($_POST['group_indexsort']);

			if ($group_indexsort) {
				$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
				$now_merchant = $database_merchant->field('`storage_indexsort`')->where($condition_merchant)->find();

				if ($now_merchant['storage_indexsort']) {
					$condition_group['group_id'] = $group_indexsort;

					if (D('Group')->where($condition_group)->setInc('index_sort', $now_merchant['storage_indexsort'])) {
						$database_merchant->where($condition_merchant)->setField('storage_indexsort', '0');
					}
				}
			}

			$indexsort_groupid = intval($_POST['indexsort_groupid']);
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$database_merchant->where($condition_merchant)->setField('auto_indexsort_groupid', $indexsort_groupid);
		}
	}

	public function ajax_upload_pic()
	{
		if ($_FILES['imgFile']['error'] != 4) {
			$img_mer_id = sprintf('%09d', $this->merchant_session['mer_id']);
			$rand_num = mt_rand(10, 99) . '/' . substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
			$upload_dir = './upload/merchant/' . $rand_num . '/';

			if (!is_dir($upload_dir)) {
				mkdir($upload_dir, 511, true);
			}

			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize = 3 * 1024 * 1024;
			$upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
			$upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
			$upload->savePath = $upload_dir;
			$upload->saveRule = 'uniqid';

			if ($upload->upload()) {
				$uploadList = $upload->getUploadFileInfo();
				$title = $rand_num . ',' . $uploadList[0]['savename'];
				$merchant_image_class = new merchant_image();
				$url = $merchant_image_class->get_image_by_path($title);
				exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title)));
			}
			else {
				exit(json_encode(array('error' => 1, 'message' => $upload->getErrorMsg())));
			}
		}
		else {
			exit(json_encode(array('error' => 1, 'message' => '没有选择图片')));
		}
	}

	public function ajax_del_pic()
	{
		$merchant_image_class = new merchant_image();
		$merchant_image_class->del_image_by_path($_POST['path']);
	}

	public function store()
	{
		$mer_id = $this->merchant_session['mer_id'];
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['mer_id'] = $mer_id;
		$count_store = $database_merchant_store->where($condition_merchant_store)->count();
		$db_arr = array(C('DB_PREFIX') . 'area' => 'a', C('DB_PREFIX') . 'merchant_store' => 's');
		import('@.ORG.merchant_page');
		$p = new Page($count_store, 15);
		$store_list = D()->table($db_arr)->field(true)->where('`s`.`mer_id`=\'' . $mer_id . '\' AND `s`.`area_id`=`a`.`area_id`')->order('`sort` DESC,`store_id` ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('store_list', $store_list);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$this->display();
	}

	public function store_ajax_upload_pic()
	{
		if ($_FILES['imgFile']['error'] != 4) {
			$img_mer_id = sprintf('%09d', $this->merchant_session['mer_id']);
			$rand_num = mt_rand(10, 99) . '/' . substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);
			$upload_dir = './upload/store/' . $rand_num . '/';

			if (!is_dir($upload_dir)) {
				mkdir($upload_dir, 511, true);
			}

			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize = 3 * 1024 * 1024;
			$upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
			$upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
			$upload->savePath = $upload_dir;
			$upload->saveRule = 'uniqid';

			if ($upload->upload()) {
				$uploadList = $upload->getUploadFileInfo();
				$title = $rand_num . ',' . $uploadList[0]['savename'];
				$store_image_class = new store_image();
				$url = $store_image_class->get_image_by_path($title);
				exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title)));
			}
			else {
				exit(json_encode(array('error' => 1, 'message' => $upload->getErrorMsg())));
			}
		}
		else {
			exit(json_encode(array('error' => 1, 'message' => '没有选择图片')));
		}
	}

	public function store_ajax_del_pic()
	{
		$store_image_class = new store_image();
		$store_image_class->del_image_by_path($_POST['path']);
	}

	public function store_add()
	{
		if (IS_POST) {
			if (empty($_POST['name'])) {
				$this->error('店铺名称必填！');
			}

			if (empty($_POST['phone'])) {
				$this->error('联系电话必填！');
			}

			if (empty($_POST['long_lat'])) {
				$this->error('店铺经纬度必填！');
			}

			if (empty($_POST['adress'])) {
				$this->error('店铺地址必填！');
			}

			if (empty($_POST['pic'])) {
				$this->error('请至少上传一张图片');
			}

			$_POST['pic_info'] = implode(';', $_POST['pic']);

			if (empty($_POST['txt_info'])) {
				$this->error('请输入店铺描述信息');
			}

			$keywords = trim($_POST['keywords']);

			if (!empty($keywords)) {
				$tmp_key_arr = explode(' ', $keywords);
				$key_arr = array();

				foreach ($tmp_key_arr as $value) {
					if (!empty($value)) {
						array_push($key_arr, $value);
					}
				}

				if (5 < count($key_arr)) {
					$this->error('关键词最多5个。');
				}
			}

			$office_time = array();
			if (($_POST['office_start_time'] != '00:00') || ($_POST['office_stop_time'] != '00:00')) {
				array_push($office_time, array('open' => $_POST['office_start_time'], 'close' => $_POST['office_stop_time']));
			}

			if (($_POST['office_start_time2'] != '00:00') || ($_POST['office_stop_time2'] != '00:00')) {
				array_push($office_time, array('open' => $_POST['office_start_time2'], 'close' => $_POST['office_stop_time2']));
			}

			if (($_POST['office_start_time3'] != '00:00') || ($_POST['office_stop_time3'] != '00:00')) {
				array_push($office_time, array('open' => $_POST['office_start_time3'], 'close' => $_POST['office_stop_time3']));
			}

			$_POST['office_time'] = serialize($office_time);
			$_POST['sort'] = intval($_POST['sort']);
			$long_lat = explode(',', $_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['add_from'] = '0';
			$_POST['mer_id'] = $this->merchant_session['mer_id'];

			if ($this->config['store_verify']) {
				$_POST['status'] = '2';
			}
			else {
				$_POST['status'] = '1';
			}

			$database_merchant_store = D('Merchant_store');

			if ($merchant_store_id = $database_merchant_store->data($_POST)->add()) {
				if (!empty($key_arr)) {
					$database_keywords = D('Keywords');
					$data_keywords['third_id'] = $merchant_store_id;
					$data_keywords['third_type'] = 'Merchant_store';

					foreach ($key_arr as $value) {
						$data_keywords['keyword'] = $value;
						$database_keywords->data($data_keywords)->add();
					}
				}

				$this->success('添加成功！');
			}
			else {
				$this->error('添加失败！请重试~');
			}
		}
		else {
			$this->display();
		}
	}

	public function store_edit()
	{
		$database_merchant_store = D('Merchant_store');

		if (IS_POST) {
			if (empty($_POST['name'])) {
				$this->error('店铺名称必填！');
			}

			if (empty($_POST['phone'])) {
				$this->error('联系电话必填！');
			}

			if (empty($_POST['long_lat'])) {
				$this->error('店铺经纬度必填！');
			}

			if (empty($_POST['adress'])) {
				$this->error('店铺地址必填！');
			}

			if (empty($_POST['pic'])) {
				$this->error('请至少上传一张图片');
			}

			$_POST['pic_info'] = implode(';', $_POST['pic']);

			if (empty($_POST['txt_info'])) {
				$this->error('请输入店铺描述信息');
			}

			$keywords = trim($_POST['keywords']);

			if (!empty($keywords)) {
				$tmp_key_arr = explode(' ', $keywords);
				$key_arr = array();

				foreach ($tmp_key_arr as $value) {
					if (!empty($value)) {
						array_push($key_arr, $value);
					}
				}

				if (5 < count($key_arr)) {
					$this->error('关键词最多5个。');
				}
			}

			$office_time = array();
			if (($_POST['office_start_time'] != '00:00') || ($_POST['office_stop_time'] != '00:00')) {
				array_push($office_time, array('open' => $_POST['office_start_time'], 'close' => $_POST['office_stop_time']));
			}

			if (($_POST['office_start_time2'] != '00:00') || ($_POST['office_stop_time2'] != '00:00')) {
				array_push($office_time, array('open' => $_POST['office_start_time2'], 'close' => $_POST['office_stop_time2']));
			}

			if (($_POST['office_start_time3'] != '00:00') || ($_POST['office_stop_time3'] != '00:00')) {
				array_push($office_time, array('open' => $_POST['office_start_time3'], 'close' => $_POST['office_stop_time3']));
			}

			$_POST['office_time'] = serialize($office_time);
			$_POST['sort'] = intval($_POST['sort']);
			$long_lat = explode(',', $_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$condition_merchant_store['store_id'] = $_POST['store_id'];
			$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
			unset($_POST['store_id']);

			if ($database_merchant_store->where($condition_merchant_store)->data($_POST)->save()) {
				$data_keywords['third_id'] = $condition_merchant_store['store_id'];
				$data_keywords['third_type'] = 'Merchant_store';
				$database_keywords = D('Keywords');
				$database_keywords->where($data_keywords)->delete();

				if (!empty($key_arr)) {
					foreach ($key_arr as $value) {
						$data_keywords['keyword'] = $value;
						$database_keywords->data($data_keywords)->add();
					}
				}

				$this->success('保存成功！');
			}
			else {
				$this->error('保存失败！！您是不是没做过修改？请重试~');
			}
		}
		else {
			$condition_merchant_store['store_id'] = $_GET['id'];
			$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
			$now_store = $database_merchant_store->where($condition_merchant_store)->find();

			if (empty($now_store)) {
				$this->error('店铺不存在！');
			}

			$now_store['office_time'] = unserialize($now_store['office_time']);

			if (!empty($now_store['pic_info'])) {
				$store_image_class = new store_image();
				$tmp_pic_arr = explode(';', $now_store['pic_info']);

				foreach ($tmp_pic_arr as $key => $value) {
					$now_store['pic'][$key]['title'] = $value;
					$now_store['pic'][$key]['url'] = $store_image_class->get_image_by_path($value);
				}
			}

			$keywords = D('Keywords')->where(array('third_type' => 'Merchant_store', 'third_id' => $condition_merchant_store['store_id']))->select();
			$str = '';

			foreach ($keywords as $key) {
				$str .= $key['keyword'] . ' ';
			}

			$now_store['keywords'] = $str;
			$this->assign('now_store', $now_store);
			$this->display();
		}
	}

	public function store_status()
	{
		$database_merchant_store = D('Merchant_store');
		$data_merchant_store['status'] = $_POST['type'] == 'open' ? '1' : '0';
		$condition_merchant_store['store_id'] = $_POST['id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];

		if ($database_merchant_store->where($condition_merchant_store)->data($data_merchant_store)->save()) {
			exit('1');
		}
		else {
			exit();
		}
	}

	public function store_del()
	{
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $_GET['id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];

		if ($database_merchant_store->where($condition_merchant_store)->delete()) {
			$this->success('删除成功！');
		}
		else {
			$this->error('删除失败！');
		}
	}

	public function staff()
	{
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $_GET['store_id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		$now_store = $database_merchant_store->where($condition_merchant_store)->find();

		if (empty($now_store)) {
			$this->error('店铺不存在！');
		}

		$this->assign('now_store', $now_store);
		$condition_store_staff['token'] = $this->token;
		$condition_store_staff['store_id'] = $_GET['store_id'];
		$staff_list = D('Merchant_store_staff')->where($condition_store_staff)->order('`id` desc')->select();
		$this->assign('staff_list', $staff_list);
		$this->display();
	}

	public function staffSet()
	{
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $_GET['store_id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		$now_store = $database_merchant_store->where($condition_merchant_store)->find();

		if (empty($now_store)) {
			$this->error('店铺不存在！');
		}

		$this->assign('now_store', $now_store);
		$_POST['store_id'] = $now_store['store_id'];
		$company_staff_db = M('Merchant_store_staff');

		if (IS_POST) {
			if (!trim($_POST['name']) || !trim($_POST['username'])) {
				$this->error('姓名、帐号都不能为空');
			}

			$_POST['token'] = $this->token;
			$_POST['time'] = time();

			if (!isset($_GET['itemid'])) {
				$condition_store_staff_username['username'] = $_POST['username'];

				if ($company_staff_db->field('`id`')->where($condition_store_staff_username)->find()) {
					$this->error('帐号已经存在！请换一个。');
				}

				if (!trim($_POST['password'])) {
					$this->error('密码不能为空');
				}

				$_POST['password'] = md5($_POST['password']);

				if (!$company_staff_db->add($_POST)) {
					$this->error('添加失败，请重试。');
				}
			}
			else {
				$condition_store_staff_username['username'] = $_POST['username'];
				$username_staff = $company_staff_db->field('`id`')->where($condition_store_staff_username)->find();

				if ($username_staff['id'] != $_GET['itemid']) {
					$this->error('帐号已经存在！请换一个。');
				}

				if (!trim($_POST['password'])) {
					unset($_POST['password']);
				}
				else {
					$_POST['password'] = md5($_POST['password']);
				}

				if (!$company_staff_db->where(array('id' => intval($_GET['itemid'])))->save($_POST)) {
					$this->error('修改失败，请重试。');
				}
			}

			$this->success('操作成功', U('Config/staff', array('store_id' => $now_store['store_id'])));
		}
		else {
			if (isset($_GET['itemid'])) {
				$thisItem = $company_staff_db->where(array('id' => intval($_GET['itemid'])))->find();
			}
			else {
				$thisItem['companyid'] = 0;
			}

			$this->assign('item', $thisItem);
			$this->display('staffSet');
		}
	}

	public function staffDelete()
	{
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $_GET['store_id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		$now_store = $database_merchant_store->where($condition_merchant_store)->find();

		if (empty($now_store)) {
			$this->error('店铺不存在！');
		}

		$this->assign('now_store', $now_store);
		$company_staff_db = M('Merchant_store_staff');
		$condition_store_staff['token'] = $this->token;
		$condition_store_staff['id'] = $_GET['itemid'];

		if ($company_staff_db->where($condition_store_staff)->delete()) {
			$this->success('操作成功', U('Config/staff', array('store_id' => $now_store['store_id'])));
		}
		else {
			$this->error('操作失败，请重试。');
		}
	}
}

?>
