<?php
class LotteryBaseAction extends BaseAction
{
	public $token = '';

	public function _initialize()
	{
		parent::_initialize();
		$this->token = $this->merchant_session['mer_id'];
	}

	public function index($type)
	{
		switch ($type) {
		case 1:
			$activeType = 'Lottery';
			$url = U('Lottery/index');
			$tips = '幸运大转盘';
			break;

		case 2:
			$activeType = 'Guajiang';
			$url = U('Guajiang/index');
			$tips = '刮刮卡';
			break;

		case 3:
			$activeType = 'Coupon';
			$url = U('Coupon/index');
			$tips = '优惠券';
			break;

		case 4:
			$activeType = 'LuckyFruit';
			$url = U('LuckyFruit/index');
			$tips = '水果达人';
			break;

		case 5:
			$activeType = 'GoldenEgg';
			$url = U('GoldenEgg/index');
			$tips = '砸金蛋';
			break;

		case 6:
			$activeType = 'Research';
			$url = U('Research/index');
			$tips = '有奖调研';
			break;

		case 7:
			$activeType = 'AppleGame';
			$url = U('AppleGame/index');
			break;

		case 8:
			$activeType = 'Lovers';
			$url = U('Lovers/index');
			break;

		case 9:
			$activeType = 'Autumn';
			$url = U('Autumn/index');
			break;
		}

		$this->assign('url', $url);
		$this->assign('tips', $tips);
		$this->assign('activeType', $activeType);
		$where = array('mer_id' => $this->merchant_session['mer_id'], 'type' => $type);
		$list = M('Lottery')->where($where)->select();
		$this->assign('list', $list);
	}

	public function add($type)
	{
		switch ($type) {
		case 1:
			$activeType = 'Lottery';
			$url = U('Lottery/index');
			$tips = '幸运大转盘';
			break;

		case 2:
			$activeType = 'Guajiang';
			$url = U('Guajiang/index');
			$tips = '刮刮卡';
			break;

		case 3:
			$activeType = 'Coupon';
			$url = U('Coupon/index');
			$tips = '优惠券';
			break;

		case 4:
			$activeType = 'LuckyFruit';
			$url = U('LuckyFruit/index');
			$tips = '水果达人';
			break;

		case 5:
			$activeType = 'GoldenEgg';
			$url = U('GoldenEgg/index');
			$tips = '砸金蛋';
			break;

		case 6:
			$activeType = 'Research';
			$url = U('Research/index');
			$tips = '有奖调研';
			break;

		case 7:
			$activeType = 'AppleGame';
			$url = U('AppleGame/index');
			break;

		case 8:
			$activeType = 'Lovers';
			$url = U('Lovers/index');
			break;

		case 9:
			$activeType = 'Autumn';
			$url = U('Autumn/index');
			break;
		}

		$this->assign('url', $url);
		$this->assign('type', $type);
		$this->assign('tips', $tips);
		$this->assign('activeType', $activeType);

		if (IS_POST) {
			$data = D('lottery');
			$_POST['statdate'] = strtotime($this->_post('statdate'));
			$_POST['enddate'] = strtotime($this->_post('enddate'));
			$_POST['token'] = $this->merchant_session['mer_id'];
			$_POST['mer_id'] = $this->merchant_session['mer_id'];
			$_POST['type'] = $type;
			$images = $this->upload();

			if (empty($images['error'])) {
				foreach ($images['msg'] as $image) {
					$_POST[$image['key']] = $image['savepath'] . $image['savename'];
				}
			}

			(!isset($_POST['starpicurl']) || empty($_POST['starpicurl'])) && $_POST['starpicurl'] = '/static/images/activity-' . strtolower($activeType) . '-start.jpg';
			$error = $this->checknotnull($_POST);

			if ($error['error']) {
				$this->error($error['msg']);
			}

			if ($_POST['enddate'] < $_POST['statdate']) {
				$this->error('结束时间不能小于开始时间');
			}
			else if ($data->create() != false) {
				if ($id = $data->add()) {
					$data1['third_id'] = $id;
					$data1['third_type'] = 'lottery';
					$data1['keyword'] = $this->_post('keyword');
					D('Keywords')->add($data1);

					if ($_POST['statdate'] < time()) {
						$this->_start($id);
					}

					$rid = (isset($_POST['researchid']) ? intval($_POST['researchid']) : 0);
					if (($type == 6) && $rid) {
						M('Research')->where(array('id' => $rid))->save(array('lid' => $id));
						$this->success('活设置成功', U($activeType . '/index'));
					}
					else {
						$this->success('活动创建成功，请在列表中让活动“开始”', U($activeType . '/index'));
					}
				}
				else {
					$this->error('服务器繁忙,请稍候再试');
				}
			}
			else {
				$this->error($data->getError());
			}
		}
		else {
			$now = time();
			$lottery['statdate'] = $now;
			$lottery['enddate'] = $now + (30 * 24 * 3600);
			$this->assign('lottery', $lottery);
			$this->assign('activity', strtolower($activeType));
			$type == 3 ? $this->display('Lottery:coupon') : $this->display('Lottery:add');
		}
	}

	public function edit($type)
	{
		switch ($type) {
		case 1:
			$activeType = 'Lottery';
			$url = U('Lottery/index');
			$tips = '幸运大转盘';
			break;

		case 2:
			$activeType = 'Guajiang';
			$url = U('Guajiang/index');
			$tips = '刮刮卡';
			break;

		case 3:
			$activeType = 'Coupon';
			$url = U('Coupon/index');
			$tips = '优惠券';
			break;

		case 4:
			$activeType = 'LuckyFruit';
			$url = U('LuckyFruit/index');
			$tips = '水果达人';
			break;

		case 5:
			$activeType = 'GoldenEgg';
			$url = U('GoldenEgg/index');
			$tips = '砸金蛋';
			break;

		case 6:
			$activeType = 'Research';
			$url = U('Research/index');
			$tips = '有奖调研';
			break;

		case 7:
			$activeType = 'AppleGame';
			$url = U('AppleGame/index');
			break;

		case 8:
			$activeType = 'Lovers';
			$url = U('Lovers/index');
			break;

		case 9:
			$activeType = 'Autumn';
			$url = U('Autumn/index');
			break;
		}

		$this->assign('url', $url);
		$this->assign('type', $type);
		$this->assign('tips', $tips);
		$this->assign('activeType', $activeType);

		if (IS_POST) {
			$data = D('Lottery');
			$_POST['id'] = $this->_get('id');
			$_POST['token'] = $this->merchant_session['mer_id'];
			$_POST['mer_id'] = $this->merchant_session['mer_id'];
			$_POST['statdate'] = strtotime($_POST['statdate']);
			$_POST['enddate'] = strtotime($_POST['enddate']);
			$error = $this->checknotnull($_POST);

			if ($error['error']) {
				$this->error($error['msg']);
			}

			if ($_POST['enddate'] < $_POST['statdate']) {
				$this->error('结束时间不能小于开始时间');
			}
			else {
				$where = array('id' => $_POST['id'], 'mer_id' => $_POST['mer_id'], 'type' => $type);
				$check = $data->where($where)->find();

				if ($check == false) {
					$this->error('非法操作');
				}

				$images = $this->upload();

				if (empty($images['error'])) {
					foreach ($images['msg'] as $image) {
						$_POST[$image['key']] = $image['savepath'] . $image['savename'];

						if (is_file($check[$image['key']])) {
							unlink($check[$image['key']]);
						}
					}
				}

				if ($data->where($where)->save($_POST)) {
					$data1['third_id'] = intval($_POST['id']);
					$data1['third_type'] = 'lottery';
					$da['keyword'] = htmlspecialchars($_POST['keyword']);
					D('Keywords')->where($data1)->save($da);
					$this->success('修改成功', U($activeType . '/index', array('token' => $_POST['mer_id'])));
				}
				else {
					$this->error('操作失败');
				}
			}
		}
		else {
			$id = $this->_get('id');
			$where = array('id' => $id, 'mer_id' => $this->merchant_session['mer_id']);
			$data = M('Lottery');
			$check = $data->where($where)->find();

			if ($check == false) {
				$this->error('非法操作');
			}

			$lottery = $data->where($where)->find();
			$this->assign('lottery', $lottery);
			$this->assign('activity', strtolower($activeType));
			$type == 3 ? $this->display('Lottery:coupon') : $this->display('Lottery:add');
		}
	}

	public function cheat($type)
	{
		switch ($type) {
		case 1:
			$activeType = 'Lottery';
			$url = U('Lottery/index');
			$tips = '幸运大转盘';
			break;

		case 2:
			$activeType = 'Guajiang';
			$url = U('Guajiang/index');
			$tips = '刮刮卡';
			break;

		case 3:
			$activeType = 'Coupon';
			$url = U('Coupon/index');
			$tips = '优惠券';
			break;

		case 4:
			$activeType = 'LuckyFruit';
			$url = U('LuckyFruit/index');
			$tips = '水果达人';
			break;

		case 5:
			$activeType = 'GoldenEgg';
			$url = U('GoldenEgg/index');
			$tips = '砸金蛋';
			break;

		case 6:
			$activeType = 'Research';
			$url = U('Research/index');
			$tips = '有奖调研';
			break;

		case 7:
			$activeType = 'AppleGame';
			$url = U('AppleGame/index');
			break;

		case 8:
			$activeType = 'Lovers';
			$url = U('Lovers/index');
			break;

		case 9:
			$activeType = 'Autumn';
			$url = U('Autumn/index');
			break;
		}

		$this->assign('url', $url);
		$this->assign('tips', $tips);
		$this->assign('activeType', $activeType);
		$id = intval($_GET['id']);
		$where = array('id' => $id, 'mer_id' => $this->merchant_session['mer_id']);
		$thisLottery = M('Lottery')->where($where)->find();
		$this->assign('thisLottery', $thisLottery);
		$records = M('Lottery_cheat')->where(array('lid' => $thisLottery['id']))->order('prizetype asc')->select();
		$this->assign('records', $records);
	}

	public function deleteCheat()
	{
		$record = M('Lottery_cheat')->where(array('id' => intval($_GET['id'])))->find();
		$thisLottery = M('Lottery')->where(array('id' => $record['lid']))->find();

		if ($thisLottery['token'] != $this->merchant_session['mer_id']) {
			$this->error('非法操作');
		}
		else {
			M('Lottery_cheat')->where(array('id' => intval($record['id'])))->delete();
			$this->success('删除成功');
		}
	}

	public function sn($type)
	{
		$Lottery_record_db = M('Lottery_record');
		$id = intval($this->_get('id'));
		$data = M('Lottery')->where(array('mer_id' => $this->merchant_session['mer_id'], 'id' => $id, 'type' => $type))->find();
		$this->assign('thisLottery', $data);
		$recordWhere = 'token="' . $this->merchant_session['mer_id'] . '" and lid=' . $id . ' and sn!=""';
		$record = $Lottery_record_db->where($recordWhere)->select();
		$recordcount = $data['fistlucknums'] + $data['secondlucknums'] + $data['thirdlucknums'] + $data['fourlucknums'] + $data['fivelucknums'] + $data['sixlucknums'];
		$datacount = $data['fistnums'] + $data['secondnums'] + $data['thirdnums'] + $data['fournums'] + $data['fivenums'] + $data['sixnums'];
		$sendCount = $Lottery_record_db->where(array('lid' => $id, 'sendstutas' => 1, 'islottery' => 1))->count();
		$this->assign('sendCount', $sendCount);
		$this->assign('datacount', $datacount);
		$this->assign('recordcount', $recordcount);

		if ($record) {
			$i = 0;

			foreach ($record as $r) {
				switch (intval($r['prizetype'])) {
				default:
					$record[$i]['prizeName'] = $r['prize'];
					break;

				case 1:
					$record[$i]['prizeName'] = $data['fist'];
					break;

				case 2:
					$record[$i]['prizeName'] = $data['second'];
					break;

				case 3:
					$record[$i]['prizeName'] = $data['third'];
					break;

				case 4:
					$record[$i]['prizeName'] = $data['four'];
					break;

				case 5:
					$record[$i]['prizeName'] = $data['five'];
					break;

				case 6:
					$record[$i]['prizeName'] = $data['six'];
					break;

				case 7:
					$activeType = 'AppleGame';
					break;

				case 8:
					$activeType = 'Lovers';
					break;

				case 9:
					$activeType = 'Autumn';
					break;
				}

				$i++;
			}
		}

		switch ($type) {
		case 1:
			$activeType = 'Lottery';
			$url = U('Lottery/index');
			$tips = '幸运大转盘';
			break;

		case 2:
			$activeType = 'Guajiang';
			$url = U('Guajiang/index');
			$tips = '刮刮卡';
			break;

		case 3:
			$activeType = 'Coupon';
			$url = U('Coupon/index');
			$tips = '优惠券';
			break;

		case 4:
			$activeType = 'LuckyFruit';
			$url = U('LuckyFruit/index');
			$tips = '水果达人';
			break;

		case 5:
			$activeType = 'GoldenEgg';
			$url = U('GoldenEgg/index');
			$tips = '砸金蛋';
			break;

		case 6:
			$activeType = 'Research';
			$url = U('Research/index');
			$tips = '有奖调研';
			break;

		case 7:
			$activeType = 'AppleGame';
			$url = U('AppleGame/index');
			break;

		case 8:
			$activeType = 'Lovers';
			$url = U('Lovers/index');
			break;

		case 9:
			$activeType = 'Autumn';
			$url = U('Autumn/index');
			break;
		}

		$this->assign('url', $url);
		$this->assign('tips', $tips);
		$this->assign('activeType', $activeType);
		$this->assign('record', $record);
	}

	public function sendnull()
	{
		$id = intval($this->_get('id'));
		$where = array('id' => $id, 'token' => $this->merchant_session['mer_id']);
		$data['sendtime'] = '';
		$data['sendstutas'] = 0;
		$back = M('Lottery_record')->where($where)->save($data);

		if ($back == true) {
			$this->success('已经取消');
		}
		else {
			$this->error('操作失败');
		}
	}

	public function sendprize()
	{
		$id = $this->_get('id');
		$where = array('id' => $id, 'token' => $this->merchant_session['mer_id']);
		$data['sendtime'] = time();
		$data['sendstutas'] = 1;
		$back = M('Lottery_record')->where($where)->save($data);

		if ($back == true) {
			$this->success('操作成功');
		}
		else {
			$this->error('操作失败');
		}
	}

	public function endLottery()
	{
		$id = intval($this->_get('id'));
		$where = array('id' => $id, 'token' => $this->merchant_session['mer_id']);
		$data = M('Lottery')->where($where)->save(array('status' => 0));

		if ($data != false) {
			$this->success('活动已结束');
		}
		else {
			$this->error('服务器繁忙,请稍候再试');
		}
	}

	public function startLottery()
	{
		$id = intval($this->_get('id'));
		$rt = $this->_start($id);

		if (0 < $rt) {
			$this->success('活动已经开始');
		}
		else {
			switch ($rt) {
			case -1:
				$this->error('您的免费活动创建数已经全部使用完,请充值后再使用');
				break;

			case -2:
				$this->error('服务器繁忙,请稍候再试');
				break;
			}
		}
	}

	public function _start($id)
	{
		$error = 0;
		$where = array('id' => $id, 'token' => $this->merchant_session['mer_id']);
		$data = M('Lottery')->where($where)->save(array('status' => 1));

		if ($data != false) {
			return 1;
		}
		else {
			$error = -2;
		}

		return $error;
	}

	public function del()
	{
		$id = intval($this->_get('id'));
		$where = array('id' => $id, 'token' => $this->merchant_session['mer_id']);
		$data = M('Lottery');
		$check = $data->where($where)->find();

		if ($check == false) {
			$this->error('非法操作');
		}

		$back = $data->where($wehre)->delete();

		if ($back == true) {
			$type = (isset($_GET['type']) ? intval($_GET['type']) : 0);
			M('Keyword')->where(array('pid' => $id, 'token' => $this->merchant_session['mer_id'], 'module' => 'Lottery'))->delete();
			$this->success('删除成功');
		}
		else {
			$this->error('操作失败');
		}
	}

	public function snDelete()
	{
		$db = M('Lottery_record');
		$rt = $db->where(array('id' => intval($_GET['id'])))->find();

		if ($this->token != $rt['token']) {
			exit('no permission');
		}

		switch ($rt['prize']) {
		case 1:
			M('Lottery')->where(array('id' => $rt['lid']))->setDec('fistlucknums');
			break;

		case 2:
			M('Lottery')->where(array('id' => $rt['lid']))->setDec('secondlucknums');
			break;

		case 3:
			M('Lottery')->where(array('id' => $rt['lid']))->setDec('thirdlucknums');
			break;

		case 4:
			M('Lottery')->where(array('id' => $rt['lid']))->setDec('fourlucknums');
			break;

		case 5:
			M('Lottery')->where(array('id' => $rt['lid']))->setDec('fivelucknums');
			break;

		case 6:
			M('Lottery')->where(array('id' => $rt['lid']))->setDec('sixlucknums');
			break;

		case 7:
			$activeType = 'AppleGame';
			break;

		case 8:
			$activeType = 'Lovers';
			break;

		case 9:
			$activeType = 'Autumn';
			break;
		}

		$db->where(array('id' => intval($_GET['id'])))->delete();
		$this->success('操作成功');
	}

	public function exportSN()
	{
		header('Content-Type: text/html; charset=utf-8');
		header('Content-type:application/vnd.ms-execl');
		header('Content-Disposition:filename=huizong.xls');
		$letterArr = explode(',', strtoupper('a,b,c,d,e,f,g'));
		$arr = array(
			array('en' => 'sn', 'cn' => 'SN码(中奖号)'),
			array('en' => 'prize', 'cn' => '奖项'),
			array('en' => 'sendstutas', 'cn' => '是否已发奖品'),
			array('en' => 'sendtime', 'cn' => '奖品发送时间'),
			array('en' => 'phone', 'cn' => '中奖者手机号'),
			array('en' => 'wecha_name', 'cn' => '中奖者微信码'),
			array('en' => 'time', 'cn' => '中奖时间')
			);
		$chengItem = array('piaomianjia', 'shuifei', 'yingshoujine', 'yingfupiaomianjia', 'yingfushuifei', 'yingfujine', 'dailishouru', 'fandian', 'jichangjianshefei', 'ranyoufei');
		$i = 0;
		$fieldCount = count($arr);
		$s = 0;

		foreach ($arr as $f) {
			if ($s < ($fieldCount - 1)) {
				echo iconv('utf-8', 'gbk', $f['cn']) . '	';
			}
			else {
				echo iconv('utf-8', 'gbk', $f['cn']) . "\n";
			}

			$s++;
		}

		$db = M('Lottery_record');
		$sns = $db->where(array('lid' => intval($_GET['id']), 'islottery' => 1))->order('id ASC')->select();

		if ($sns) {
			if ($sns[0]['token'] != $this->token) {
				exit('no permission');
			}

			foreach ($sns as $sn) {
				$j = 0;

				foreach ($arr as $field) {
					$fieldValue = $sn[$field['en']];

					switch ($field['en']) {
					default:
						break;

					case 'time':
					case 'sendtime':
						if ($fieldValue) {
							$fieldValue = date('Y-m-d H:i:s', $fieldValue);
						}
						else {
							$fieldValue = '';
						}

						break;

					case 'wecha_name':
					case 'prize':
						$fieldValue = iconv('utf-8', 'gbk', $fieldValue);
						break;
					}

					if ($j < ($fieldCount - 1)) {
						echo $fieldValue . '	';
					}
					else {
						echo $fieldValue . "\n";
					}

					$j++;
				}

				$i++;
			}
		}

		exit();
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
		$upload_dir = './upload/lottery/' . $rand_num . '/';

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

	private function checknotnull($data)
	{
		if (empty($data['keyword'])) {
			$msg = '关键词不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['title'])) {
			$msg = '活动名称不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['title'])) {
			$msg = '兑奖信息不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['sttxt'])) {
			$msg = '中奖提示不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['statdate']) || empty($data['enddate'])) {
			$msg = '活动时间不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['aginfo'])) {
			$msg = '重复抽奖回复不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['endtite'])) {
			$msg = '活动结束公告主题不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['fist'])) {
			$msg = '一等奖奖品设置不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['fistnums'])) {
			$msg = '一等奖奖品数量不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['allpeople'])) {
			$msg = '预计活动的人数不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['canrqnums'])) {
			$msg = '每人最多允许抽奖次数不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		if (empty($data['parssword'])) {
			$msg = '兑奖密码不能为空';
			return array('error' => 1, 'msg' => $msg);
		}

		return array('error' => 0, 'msg' => '');
	}
}

?>
