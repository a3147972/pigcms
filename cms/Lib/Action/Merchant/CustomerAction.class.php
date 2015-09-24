<?php
class CustomerAction extends BaseAction
{
	public function fans_list()
	{
		$mer_id = $this->merchant_session['mer_id'];
		$table = array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u');
		$condition = '`m`.`openid`=`u`.`openid` AND `m`.`mer_id`=\'' . $mer_id . '\'';

		if ($_GET['page'] < 2) {
			$man_condition = $condition . ' AND `u`.`sex`=\'1\'';
			$pigcms_assign['man_count'] = D('')->table($table)->where($man_condition)->count();
			$woman_condition = $condition . ' AND `u`.`sex`=\'2\'';
			$pigcms_assign['woman_count'] = D('')->table($table)->where($woman_condition)->count();
			$unsexman_condition = $condition . ' AND `u`.`sex`=\'0\'';
			$pigcms_assign['unsexman_count'] = D('')->table($table)->where($unsexman_condition)->count();
			$this->assign($pigcms_assign);
		}

		$fans_count = D('')->table($table)->where($condition)->count();
		import('@.ORG.merchant_page');
		$p = new Page($fans_count, 20);
		$fans_list = D('')->table($table)->where($condition)->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('fans_list', $fans_list);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$condition_behavior['mer_id'] = $mer_id;
		$condition_behavior['date'] = array('gt', $_SERVER['REQUEST_TIME'] - (7 * 86400));
		$behavior_list = M('Behavior')->field('`pigcms_id`,`store_id`,`biz_id`,`date`,`model`,`keyword`')->where($condition_behavior)->order('`date` DESC')->select();

		if (!empty($behavior_list)) {
			$module_list = $this->module_list();
			$chart_list = array();

			foreach ($behavior_list as $value) {
				if (key_exists($value['model'], $chart_list)) {
					$chart_list[$value['model']]['count']++;
				}
				else {
					$chart_list[$value['model']]['count'] = 1;
				}
			}

			asort($chart_list);

			if ($chart_list) {
				foreach ($chart_list as $key => $value) {
					if (key_exists($key, $module_list)) {
						$chart_list[$key]['name'] = $module_list[$key];
					}
					else {
						$chart_list[$key]['name'] = '未知';
					}
				}
			}

			$this->assign('chart_list', $chart_list);
		}

		$this->display();
	}

	public function detail()
	{
		$uid = $_GET['uid'];
		$mer_id = $this->merchant_session['mer_id'];
		$table = array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u');
		$condition = '`m`.`openid`=`u`.`openid` AND `m`.`mer_id`=\'' . $mer_id . '\' AND `u`.`uid`=\'' . $uid . '\'';
		$database_user = D('User');
		$condition_user['uid'] = $_GET['uid'];
		$now_user = D('')->table($table)->where($condition)->find();

		if (empty($now_user)) {
			$this->error('用户不存在或没关注该商家。');
		}

		$this->assign('now_user', $now_user);
		$condition_behavior['openid'] = $now_user['openid'];
		$condition_behavior['mer_id'] = $this->merchant_session['mer_id'];
		$behavior_list = M('Behavior')->field('`pigcms_id`,`store_id`,`biz_id`,`date`,`model`,`keyword`')->where($condition_behavior)->order('`date` DESC')->select();

		if (empty($behavior_list)) {
			$this->error('该用户没有产生过行为！');
		}

		$module_list = $this->module_list();
		$index_page = $this->config['site_url'] . '/index.php';

		foreach ($behavior_list as $key => $value) {
			if ($value['model'] == 'Group_detail') {
				$behavior_list[$key]['url'] = $index_page . '?g=Group&c=Detail&a=index&group_id=' . $value['biz_id'];
			}
			else if ($value['model'] == 'Group_feedback') {
				$behavior_list[$key]['url'] = U('Message/group_reply', array('group_id' => $value['biz_id']));
			}
			else if ($value['model'] == 'Group_shop') {
				$behavior_list[$key]['url'] = U('Config/store_edit', array('id' => $value['store_id']));
			}

			if (key_exists($value['model'], $module_list)) {
				$behavior_list[$key]['name'] = $module_list[$value['model']];
			}
			else {
				$behavior_list[$key]['name'] = '未知';
			}
		}

		$this->assign('behavior_list', $behavior_list);
		$chart_list = array();

		foreach ($behavior_list as $value) {
			if (key_exists($value['model'], $chart_list)) {
				$chart_list[$value['model']]['count']++;
			}
			else {
				$chart_list[$value['model']]['count'] = 1;
			}
		}

		asort($chart_list);

		if ($chart_list) {
			foreach ($chart_list as $key => $value) {
				if (key_exists($key, $module_list)) {
					$chart_list[$key]['name'] = $module_list[$key];
				}
				else {
					$chart_list[$key]['name'] = '未知';
				}
			}
		}

		$this->assign('chart_list', $chart_list);
		$this->display();
	}

	protected function module_list()
	{
		return array('Home_index' => '首页', 'Search_group' => '团购搜索', 'Search_meal' => '订餐搜索', 'Group_index' => '团购列表', 'Group_detail' => '团购内页', 'Group_feedback' => '团购评论列表', 'Group_branch' => '团购页店铺列表', 'Group_buy' => '团购订单提交页', 'Group_shop' => '团购店铺介绍页', 'Group_addressinfo' => '店铺地图页', 'Group_get_route' => '店铺路线页', 'Pay_group' => '团购确认订单页', 'Pay_meal' => '订餐确认订单页', 'Meal_index' => '订餐店铺介绍页', 'Meal_menu' => '店铺订餐菜单', 'Meal_thissort' => '订餐菜品分类', 'Meal_cart' => '确认点餐页', 'Meal_saveorder' => '提交点餐页', 'Meal_detail' => '订单详情页', 'Meal_my' => '订餐记录页', 'Meal_order' => '订餐订单列表', 'Meal_selectmeal' => '订餐点菜事件');
	}

	public function send()
	{
		$mer_id = $this->merchant_session['mer_id'];

		if (IS_POST) {
			$source_id = (isset($_POST['source_id']) ? intval($_POST['source_id']) : 0);

			if (empty($source_id)) {
				$this->error('发送内容不能为空。');
			}

			$data = array('mer_id' => $mer_id, 'c_id' => $source_id, 'dateline' => time());
			$openid_arr = $_POST['openid'];

			if (empty($openid_arr)) {
				$this->error('发送对象不能为空。');
			}

			$id = D('Send_log')->add($data);

			if (empty($id)) {
				$this->error('创建群发失败。');
			}

			$user = array('log_id' => $id);

			foreach ($openid_arr as $openid) {
				$user['openid'] = $openid;
				D('Send_user')->add($user);
			}

			$this->success('创建群发成功,等待管理员审核', U('Customer/log'));
		}
		else {
			$table = array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u');
			$condition = '`m`.`openid`=`u`.`openid` AND `m`.`mer_id`=\'' . $mer_id . '\'';
			$fans_list = D('')->table($table)->where($condition)->limit('0, 24')->select();
			$this->assign('fans_list', $fans_list);
			$list = D('Source_material')->where(array('mer_id' => $this->merchant_session['mer_id']))->order('pigcms_id DESC')->select();
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
			$this->display();
		}
	}

	public function ajaxsend()
	{
		$table = array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u');
		$condition = '`m`.`openid`=`u`.`openid` AND `m`.`mer_id`=\'' . $this->merchant_session['mer_id'] . '\'';
		$page = (isset($_GET['page']) ? intval($_GET['page']) : 2);
		$offset = 24;
		$start = ($page - 1) * $offset;
		$fans_list = D('')->table($table)->where($condition)->limit($start . ', ' . $offset)->select();

		if ($fans_list) {
			exit(json_encode(array('data' => $fans_list, 'page' => $page, 'error_code' => 0)));
		}
		else {
			exit(json_encode(array('error_code' => 1)));
		}
	}

	public function log()
	{
		$count = D('Send_log')->where(array('mer_id' => $this->merchant_session['mer_id']))->count();
		import('@.ORG.merchant_page');
		$p = new Page($count, 20);
		$log_list = D('Send_log')->where(array('mer_id' => $this->merchant_session['mer_id']))->order('pigcms_id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$this->assign('list', $log_list);
		$this->display();
	}

	public function txtdetail()
	{
		$id = (isset($_GET['id']) ? intval($_GET['id']) : 0);
		$source = D('Source_material')->where(array('pigcms_id' => $id))->find();
		$ids = unserialize($source['it_ids']);
		$image_text = D('Image_text')->field(true)->where(array(
	'pigcms_id' => array('in', $ids)
	))->select();
		$this->assign('image_text', $image_text);
		$this->display();
	}

	public function userdetail()
	{
		$id = (isset($_GET['logid']) ? intval($_GET['logid']) : 0);
		$table = array(C('DB_PREFIX') . 'send_user' => 's', C('DB_PREFIX') . 'user' => 'u');
		$condition = '`s`.`openid`=`u`.`openid` AND `s`.`log_id`=\'' . $id . '\'';
		$fans_count = D('')->table($table)->where($condition)->count();
		import('@.ORG.merchant_page');
		$p = new Page($fans_count, 20);
		$fans_list = D('')->table($table)->where($condition)->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('fans_list', $fans_list);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$this->display();
	}

	public function service()
	{
		$services = D('Customer_service')->where(array('mer_id' => $this->merchant_session['mer_id']))->select();
		$this->assign('services', $services);
		$this->display();
	}

	public function add()
	{
		$id = (isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0);
		$service = D('Customer_service')->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $id))->find();
		$this->assign('info', $service);
		$this->display();
	}

	public function selectfans()
	{
		$search = (isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '');
		$table = array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u');
		$condition = '`m`.`openid`=`u`.`openid` AND `m`.`mer_id`=\'' . $this->merchant_session['mer_id'] . '\'';

		if ($search) {
			$condition .= ' AND `u`.`nickname` LIKE \'%' . $search . '%\'';
		}

		$count = D('')->table($table)->where($condition)->count();
		$Page = new Page($count, 5);
		$fans_list = D('')->table($table)->where($condition)->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $fans_list);
		$this->assign('page', $Page->show());
		$this->display();
	}

	public function insert()
	{
		$db = D('Customer_service');
		$id = (isset($_POST['pigcms_id']) ? intval($_POST['pigcms_id']) : 0);
		$openid = htmlspecialchars($_POST['openid']);

		if (empty($openid)) {
			$this->error('还没有选择粉丝');
		}

		$nickname = htmlspecialchars($_POST['nickname']);

		if (empty($nickname)) {
			$this->error('客服名称不能为空');
		}

		$obj = $db->where(array('openid' => $openid))->find();
		if ($obj && ($obj['pigcms_id'] != $id)) {
			$this->error('该粉丝已经是客服了，请重新选择');
		}

		$des = htmlspecialchars($_POST['des']);
		$obj = $db->where(array('nickname' => $nickname, 'mer_id' => $this->merchant_session['mer_id']))->find();
		if ($obj && ($obj['pigcms_id'] != $id)) {
			$this->error('客服名称已存在，请确认');
		}

		$data = array('nickname' => $nickname, 'des' => $des, 'openid' => $openid, 'mer_id' => $this->merchant_session['mer_id'], 'dateline' => time());
		$images = $this->upload();

		if (empty($images['error'])) {
			foreach ($images['msg'] as $image) {
				$data[$image['key']] = substr($image['savepath'] . $image['savename'], 1);
			}
		}

		if ($id) {
			$res = $db->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $id))->save($data);
		}
		else {
			$res = $db->add($data);
		}

		$this->topost();

		if ($res) {
			$this->success('操作成功', U('Customer/service'));
		}
		else {
			$this->error('操作失败', U('Customer/service'));
		}
	}

	public function del()
	{
		$db = D('Customer_service');
		$id = (isset($_GET['pigcms_id']) ? intval($_GET['pigcms_id']) : 0);
		$db->where(array('mer_id' => $this->merchant_session['mer_id'], 'pigcms_id' => $id))->delete();
		$this->topost();
		$this->success('删除成功', U('Customer/service'));
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

	private function topost()
	{
		$servicedata = array();
		$services = D('Customer_service')->where(array('mer_id' => $this->merchant_session['mer_id']))->select();

		foreach ($services as $v) {
			$t = array();
			$t['nickname'] = $v['nickname'];
			$t['avatar'] = $this->config['site_url'] . $v['head_img'];
			$t['openid'] = $v['openid'];
			$t['desc'] = $v['des'];
			$servicedata[] = $t;
		}

		$data['label'] = $this->merchant_session['mer_id'];
		$data['app_id'] = $this->config['im_appid'];
		$data['data'] = $servicedata;
		$data['key'] = $this->set_key(array('app_id' => $this->config['im_appid']), $this->config['im_appkey']);
		$todata = json_decode($this->https_request('http://im-link.meihua.com/api/app_service.php', $data), true);

		if ($todata['err_code'] != 0) {
			$this->error($todata['err_msg']);
			exit();
		}
	}

	private function set_key($data, $app_key)
	{
		$new_arr = array();
		ksort($data);

		foreach ($data as $k => $v) {
			$new_arr[] = $k . '=' . $v;
		}

		$new_arr[] = 'app_key=' . $app_key;
		$str = implode('&', $new_arr);
		return md5($str);
	}

	protected function https_request($url, $data = NULL)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

		if (!empty($data)) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		}

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
}

?>
