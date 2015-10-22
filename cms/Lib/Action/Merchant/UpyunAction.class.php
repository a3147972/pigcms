<?php
class UpYun
{
	const VERSION = '2.0';
	const ED_AUTO = 'v0.api.upyun.com';
	const ED_TELECOM = 'v1.api.upyun.com';
	const ED_CNC = 'v2.api.upyun.com';
	const ED_CTT = 'v3.api.upyun.com';
	const CONTENT_TYPE = 'Content-Type';
	const CONTENT_MD5 = 'Content-MD5';
	const CONTENT_SECRET = 'Content-Secret';
	const X_GMKERL_THUMBNAIL = 'x-gmkerl-thumbnail';
	const X_GMKERL_TYPE = 'x-gmkerl-type';
	const X_GMKERL_VALUE = 'x-gmkerl-value';
	const X_GMKERL_QUALITY = 'x­gmkerl-quality';
	const X_GMKERL_UNSHARP = 'x­gmkerl-unsharp';

	private $_bucket_name;
	private $_username;
	private $_password;
	private $_timeout = 30;
	/**
     * @deprecated
     */
	private $_content_md5;
	/**
     * @deprecated
     */
	private $_file_secret;
	/**
     * @deprecated
     */
	private $_file_infos;
	protected $endpoint;

	public function __construct($bucketname, $username, $password, $endpoint = NULL, $timeout = 30)
	{
		$this->_bucketname = $bucketname;
		$this->_username = $username;
		$this->_password = md5($password);
		$this->_timeout = $timeout;
		$this->endpoint = is_null($endpoint) ? self::ED_AUTO : $endpoint;
	}

	public function version()
	{
		return self::VERSION;
	}

	public function makeDir($path, $auto_mkdir = false)
	{
		$headers = array('Folder' => 'true');

		if ($auto_mkdir) {
			$headers['Mkdir'] = 'true';
		}

		return $this->_do_request('PUT', $path, $headers);
	}

	public function delete($path)
	{
		return $this->_do_request('DELETE', $path);
	}

	public function writeFile($path, $file, $auto_mkdir = false, $opts = NULL)
	{
		if (is_null($opts)) {
			$opts = array();
		}

		if (!is_null($this->_content_md5) || !is_null($this->_file_secret)) {
			if (!is_null($this->_content_md5)) {
				$opts[self::CONTENT_MD5] = $this->_content_md5;
			}

			if (!is_null($this->_file_secret)) {
				$opts[self::CONTENT_SECRET] = $this->_file_secret;
			}
		}

		if ($auto_mkdir === true) {
			$opts['Mkdir'] = 'true';
		}

		$this->_file_infos = $this->_do_request('PUT', $path, $opts, $file);
		return $this->_file_infos;
	}

	public function readFile($path, $file_handle = NULL)
	{
		return $this->_do_request('GET', $path, NULL, NULL, $file_handle);
	}

	public function getList($path = '/')
	{
		$rsp = $this->_do_request('GET', $path);
		$list = array();

		if ($rsp) {
			$rsp = explode("\n", $rsp);

			foreach ($rsp as $item) {
				@list($name, $type, $size, $time) = explode('	', trim($item));

				if (!empty($time)) {
					$type = ($type == 'N' ? 'file' : 'folder');
				}

				$item = array('name' => $name, 'type' => $type, 'size' => intval($size), 'time' => intval($time));
				array_push($list, $item);
			}
		}

		return $list;
	}

	public function getFolderUsage($path = '/')
	{
		$rsp = $this->_do_request('GET', '/?usage');
		return floatval($rsp);
	}

	public function getFileInfo($path)
	{
		$rsp = $this->_do_request('HEAD', $path);
		return $rsp;
	}

	private function sign($method, $uri, $date, $length)
	{
		$sign = $method . '&' . $uri . '&' . $date . '&' . $length . '&' . $this->_password;
		return 'UpYun ' . $this->_username . ':' . md5($sign);
	}

	protected function _do_request($method, $path, $headers = NULL, $body = NULL, $file_handle = NULL)
	{
		$uri = '/' . $this->_bucketname . $path;
		$ch = curl_init('http://' . $this->endpoint . $uri);
		$_headers = array('Expect:');
		if (!is_null($headers) && is_array($headers)) {
			foreach ($headers as $k => $v) {
				array_push($_headers, $k . ': ' . $v);
			}
		}

		$length = 0;
		$date = gmdate('D, d M Y H:i:s \\G\\M\\T');

		if (!is_null($body)) {
			if (is_resource($body)) {
				fseek($body, 0, SEEK_END);
				$length = ftell($body);
				fseek($body, 0);
				array_push($_headers, 'Content-Length: ' . $length);
				curl_setopt($ch, CURLOPT_INFILE, $body);
				curl_setopt($ch, CURLOPT_INFILESIZE, $length);
			}
			else {
				$length = @strlen($body);
				array_push($_headers, 'Content-Length: ' . $length);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			}
		}
		else {
			array_push($_headers, 'Content-Length: ' . $length);
		}

		array_push($_headers, 'Authorization: ' . $this->sign($method, $uri, $date, $length));
		array_push($_headers, 'Date: ' . $date);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $_headers);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		if (($method == 'PUT') || ($method == 'POST')) {
			curl_setopt($ch, CURLOPT_POST, 1);
		}
		else {
			curl_setopt($ch, CURLOPT_POST, 0);
		}

		if (($method == 'GET') && is_resource($file_handle)) {
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FILE, $file_handle);
		}

		if ($method == 'HEAD') {
			curl_setopt($ch, CURLOPT_NOBODY, true);
		}

		$response = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ($http_code == 0) {
			throw new UpYunException('Connection Failed', $http_code);
		}

		curl_close($ch);
		$header_string = '';
		$body = '';
		if (($method == 'GET') && is_resource($file_handle)) {
			$header_string = '';
			$body = $response;
		}
		else {
			list($header_string, $body) = explode('' . "\r\n" . '' . "\r\n" . '', $response, 2);
		}

		if ($http_code == 200) {
			if (($method == 'GET') && is_null($file_handle)) {
				return $body;
			}
			else {
				$data = $this->_getHeadersData($header_string);
				return 0 < count($data) ? $data : true;
			}
		}
		else {
			$message = $this->_getErrorMessage($header_string);
			if (is_null($message) && ($method == 'GET') && is_resource($file_handle)) {
				$message = 'File Not Found';
			}

			switch ($http_code) {
			case 401:
				throw new UpYunAuthorizationException($message);
				break;

			case 403:
				throw new UpYunForbiddenException($message);
				break;

			case 404:
				throw new UpYunNotFoundException($message);
				break;

			case 406:
				throw new UpYunNotAcceptableException($message);
				break;

			case 503:
				throw new UpYunServiceUnavailable($message);
				break;

			default:
				throw new UpYunException($message, $http_code);
			}
		}
	}

	private function _getHeadersData($text)
	{
		$headers = explode("\r\n", $text);
		$items = array();

		foreach ($headers as $header) {
			$header = trim($header);

			if (strpos($header, 'x-upyun') !== false) {
				list($k, $v) = explode(':', $header);
				$items[trim($k)] = in_array(substr($k, 8, 5), array('width', 'heigh', 'frame')) ? intval($v) : trim($v);
			}
		}

		return $items;
	}

	private function _getErrorMessage($header_string)
	{
		list($status, $stash) = explode("\r\n", $header_string, 2);
		list($v, $code, $message) = explode(' ', $status, 3);
		return $message;
	}

	public function rmDir($path)
	{
		$this->_do_request('DELETE', $path);
	}

	public function deleteFile($path)
	{
		$rsp = $this->_do_request('DELETE', $path);
	}

	public function readDir($path)
	{
		return $this->getList($path);
	}

	public function getBucketUsage()
	{
		return $this->getFolderUsage('/');
	}

	public function setApiDomain($domain)
	{
		$this->endpoint = $domain;
	}

	public function setContentMD5($str)
	{
		$this->_content_md5 = $str;
	}

	public function setFileSecret($str)
	{
		$this->_file_secret = $str;
	}

	public function getWritedFileInfo($key)
	{
		if (!isset($this->_file_infos)) {
			return NULL;
		}

		return $this->_file_infos[$key];
	}
}

class UpyunAction extends BaseAction
{
	public $bucket;
	public $form_api_secret;
	public $upyun_domain;
	public $upload_type;

	public function _initialize()
	{
		parent::_initialize();
		$this->bucket = UNYUN_BUCKET;
		$this->form_api_secret = UNYUN_FORM_API_SECRET;
		$this->upyun_domain = UNYUN_DOMAIN;
		$this->assign('upyun_domain', 'http://' . $this->upyun_domain);
		$this->upload_type = C('upload_type') ? C('upload_type') : 'local';
		$this->siteUrl = $this->siteUrl ? $this->siteUrl : C('site_url');
	}

	public function upload()
	{
		if ($this->upload_type == 'upyun') {
			$bucket = $this->bucket;
			$form_api_secret = $this->form_api_secret;
			$options = array();
			$options['bucket'] = $bucket;
			$options['expiration'] = time() + 600;
			$options['save-key'] = '/' . $this->token . '/{year}/{mon}/{day}/' . time() . '_{random}{.suffix}';
			$options['allow-file-type'] = C('up_exts');
			$options['content-length-range'] = '0,' . (intval(C('up_size')) * 1024);

			if (intval($_GET['width'])) {
				$options['x-gmkerl-type'] = 'fix_width';
				$options['fix_width '] = $_GET['width'];
			}

			$options['return-url'] = $this->siteUrl . '/merchant.php?g=Merchant&c=Upyun&a=uploadReturn';
			$policy = base64_encode(json_encode($options));
			$sign = md5($policy . '&' . $form_api_secret);
			$this->assign('bucket', $bucket);
			$this->assign('sign', $sign);
			$this->assign('policy', $policy);

			if (!isset($_GET['from'])) {
				$this->display();
			}
			else {
				$this->display('wap');
			}
		}
		else if ($this->upload_type == 'local') {
			if (!function_exists('imagecreate')) {
				exit('php不支持gd库，请配置后再使用');
			}

			$path = (isset($_GET['path']) ? htmlspecialchars($_GET['path']) : '');

			if (IS_POST) {
				$return = $this->localUpload($path);
				echo '<script>location.href="/merchant.php?g=Merchant&c=Upyun&a=upload&error=' . $return['error'] . '&msg=' . $return['msg'] . '";</script>';
			}
			else if (!isset($_GET['from'])) {
				$this->display('local');
			}
			else {
				$this->display('waplocal');
			}
		}
	}

	public function localUploadSNExcel()
	{
		$return = $this->localUpload('', array('xls'));

		if ($return['error']) {
			$this->error($return['msg']);
		}
		else {
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']));
			chmod(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']), 511);
			$sheet = $data->sheets[0];
			$rows = $sheet['cells'];

			if ($rows) {
				$i = 0;

				foreach ($rows as $r) {
					if ($i != 0) {
						$db = M('Lottery_record');
						$where = array('token' => $this->token, 'lid' => intval($_POST['lid']), 'sn' => trim($r[1]));
						$check = $db->where($where)->find();

						if (!$check) {
							$where['prize'] = intval($r[2]);
							$db->add($where);
						}
					}

					$i++;
				}
			}

			$this->success('操作完成');
		}
	}

	public function localUploadUsecordExcel()
	{
		$token = $this->token;
		$wecha_id = $this->_post('wecha_id');
		$cardid = $this->_post('id', 'intval');
		$return = $this->localUpload('', array('xls'));

		if ($return['error']) {
			$this->error($return['msg']);
		}
		else {
			chmod(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']), 511);
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']));
			$sheet = $data->sheets[0];
			$rows = $sheet['cells'];

			if ($rows) {
				$i = 0;
				$record = M('Member_card_use_record');

				foreach ($rows as $r) {
					if ($i != 0) {
						$info['itemid'] = (int) $r[1];
						$cardSn = htmlspecialchars($r[2]);
						$wecha_id = M('Member_card_create')->where(array('token' => $this->token, 'cardid' => $cardid, 'number' => $cardSn))->getField('wecha_id');

						if (empty($wecha_id)) {
							$this->error('会员卡号必须与与已有的会员卡对应');
							exit();
						}

						$info['wecha_id'] = $wecha_id;

						if ($info['wecha_id'] == '') {
							$info['wecha_id'] = $wecha_id;
						}

						$info['staffid'] = (int) $r[3];

						if ($r[4] == '兑换') {
							$info['cat'] = 2;
						}
						else if ($r[4] == '分享') {
							$info['cat'] = 98;
						}
						else {
							$info['cat'] = 0;
						}

						$info['expense'] = (int) $r[5];
						$info['score'] = (int) $r[6];
						$info['usecount'] = (int) $r[7];

						if ($r[8] == '') {
							$r[8] = time();
						}
						else {
							$r[8] = str_replace(array('年', '月', '时', '分', '日', '秒'), array('-', '-', ':', ':', '', ''), $r[8]);
						}

						$info['time'] = strtotime($r[8]);
						$info['notes'] = $r[9];
						$info['token'] = $this->token;
						$record->add($info);
					}

					$i++;
				}
			}

			$this->success('操作完成');
		}
	}

	public function localUploadPayrecordExcel()
	{
		$token = $this->token;
		$wecha_id = $this->_post('wecha_id');
		$cardid = $this->_post('id', 'intval');
		$return = $this->localUpload('', array('xls'));

		if ($return['error']) {
			$this->error($return['msg']);
		}
		else {
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']));
			chmod(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']), 511);
			$sheet = $data->sheets[0];
			$rows = $sheet['cells'];

			if ($rows) {
				$i = 0;
				$record = M('Member_card_pay_record');

				foreach ($rows as $r) {
					if ($i != 0) {
						$info['orderid'] = ltrim(htmlspecialchars($r[1]), '单号');
						$info['ordername'] = htmlspecialchars($r[2]);
						$info['transactionid'] = ltrim(htmlspecialchars($r[3]), '单号');
						$info['paytype'] = htmlspecialchars($r[4]);

						if ($r[5] != '') {
							$r[5] = str_replace(array('年', '月', '时', '分', '日', '秒'), array('-', '-', ':', ':', '', ''), $r[5]);
							$info['createtime'] = strtotime($r[5]);
						}
						else {
							$info['createtime'] = '';
						}

						$info['price'] = htmlspecialchars($r[6]);

						if ($r[7] != '') {
							$r[7] = str_replace(array('年', '月', '时', '分', '日', '秒'), array('-', '-', ':', ':', '', ''), $r[7]);
							$info['paytime'] = strtotime($r[7]);
						}
						else {
							$info['paytime'] = '';
						}

						if ($r[8] == '交易成功') {
							$info['paid'] = 1;
						}
						else {
							$info['paid'] = 0;
						}

						$cardSn = htmlspecialchars($r[9]);
						$wecha_id = M('Member_card_create')->where(array('token' => $this->token, 'cardid' => $cardid, 'number' => $cardSn))->getField('wecha_id');

						if (empty($wecha_id)) {
							$this->error('会员卡号必须与与已有的会员卡对应');
							exit();
						}

						$info['wecha_id'] = $wecha_id;
						$info['module'] = htmlspecialchars($r[10]);

						if ($r[11] == '充值') {
							$info['type'] = 1;
						}
						else {
							$info['type'] = 0;
						}

						$info['token'] = $token;
						$record->add($info);
					}

					$i++;
				}
			}

			$this->success('操作完成');
		}
	}

	public function localUploadSchoolExcel()
	{
		$type = $this->_post('type', 'trim');
		$token = $this->token;
		$return = $this->localUpload('', array('xls'));

		if ($return['error']) {
			$this->error($return['msg']);
		}
		else {
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']));
			chmod(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']), 511);
			$sheet = $data->sheets[0];
			$rows = $sheet['cells'];

			if ($rows) {
				$title = array(
					'students' => array('s_name' => '姓名', 'age' => '年龄', 'sex' => '性别', 'birthdate' => '出生', 'area_addr' => '家庭住址', 'mobile' => '手机', 'homephone' => '固话', 'xq_name' => '学期', 'bj_name' => '班级', 'createdate' => '报名时间', 'seffectivetime' => '生效时间', 'stheendtime' => '终止时间', 'area' => '省市区', 'xq_id' => '学期序列号', 'bj_id' => '班级序列号'),
					'teacher'  => array('tname' => '姓名', 'age' => '年龄', 'sex' => '性别', 'birthdate' => '出生', 'email' => '邮箱', 'mobile' => '手机', 'homephone' => '固话', 'jiontime' => '入职时间'),
					'score'    => array('sid' => '学员学号', 'xq_id' => '学期序列号', 'qh_id' => '成绩序列号', 'km_id' => '科目序列号', 'my_score' => '分数')
					);
				$table = array('students' => 'School_students', 'teacher' => 'School_teachers', 'score' => 'school_score');
				$keys = array_flip($title[$type]);
				$field = array();
				$item = array();
				$name = array();
				$data = array();

				foreach ($rows as $key => $value) {
					if ($key == 1) {
						$count = count($value);
						$i = 1;

						for (; $i <= $count; $i++) {
							$name[] = $keys[$value[$i]];
						}
					}
					else {
						$item = $value;
					}

					if (!empty($item)) {
						$data = array_combine($name, $item);
						$data['token'] = $this->token;
						$data['sex'] = $data['sex'] == '男' ? 1 : 0;

						if ($type == 'students') {
							$data['createdate'] = time();
							$data['birthdate'] = $this->format_xls_date($data['birthdate']);
							$data['seffectivetime'] = $this->format_xls_date($data['seffectivetime']);
							$data['stheendtime'] = $this->format_xls_date($data['stheendtime']);
						}
						else if ($type == 'teacher') {
							$data['createtime'] = time();
							$data['birthdate'] = $this->format_xls_date($data['birthdate']);
							$data['jiontime'] = $this->format_xls_date($data['jiontime']);
						}
						else if ($type == 'score') {
						}

						M($table[$type])->add($data);
					}
				}

				$this->success('操作完成');
			}
		}
	}

	public function format_xls_date($date)
	{
		$arr = explode('/', $date);
		return $arr[2] . '-' . $arr[0] . '-' . $arr[1];
	}

	public function localUploadCardExcel()
	{
		$token = $this->token;
		$cardid = (int) $_POST['id'];
		$return = $this->localUpload('', array('xls'));

		if ($return['error']) {
			$this->error($return['msg']);
		}
		else {
			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('UTF-8');
			$data->read(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']));
			chmod(str_replace('http://' . $_SERVER['HTTP_HOST'], $_SERVER['DOCUMENT_ROOT'], $return['msg']), 511);
			$sheet = $data->sheets[0];
			$rows = $sheet['cells'];

			if ($rows) {
				$i = 0;

				foreach ($rows as $r) {
					if ($i != 0) {
						$db = M('Userinfo');
						$create_db = M('Member_card_create');

						if ($r[15] == '') {
							$str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
							$j = 0;

							for (; $j < 28; $j++) {
								$rand = mt_rand(0, 61);
								$r[15] .= $str[$rand];
							}
						}

						if ($r[6] == '男') {
							$r[6] = 1;
						}
						else if ($r[6] == '女') {
							$r[6] = 2;
						}
						else {
							$r[6] = 3;
						}

						$info = array('token' => $this->token, 'truename' => htmlspecialchars($r[2]), 'tel' => htmlspecialchars($r[3]), 'total_score' => (int) $r[4], 'wechaname' => htmlspecialchars($r[5]), 'sex' => $r[6], 'bornyear' => (int) $r[7], 'bornmonth' => $r[8], 'bornday' => $r[9], 'portrait' => $r[10], 'qq' => htmlspecialchars($r[11]), 'getcardtime' => strtotime($r[12]), 'expensetotal' => $r[13], 'balance' => $r[14], 'wecha_id' => $r[15]);
						$info2 = array('number' => $r[1], 'cardid' => (int) $_POST['id'], 'token' => $this->token, 'wecha_id' => $r[15]);
						$where = array('wecha_id' => $r[15], 'token' => $this->token);
						$db_exist = $db->where($where)->field('id')->find();
						$create_db_exist = $create_db->where($where)->field('id')->find();
						$number_exist = $create_db->where('cardid = ' . $cardid . ' AND number = \'' . $r[1] . '\' AND token = \'' . $this->token . '\'')->field('id,wecha_id')->find();

						if (!$db_exist) {
							$db->add($info);
						}

						if (!$create_db_exist && !$number_exist) {
							$create_db->add($info2);
						}
						else {
							if (!$create_db_exist && $number_exist && ($number_exist['wecha_id'] == '')) {
								$create_db->where('cardid = ' . $cardid . ' AND token = \'' . $token . '\' AND number = \'' . $r[1] . '\'')->save($info2);
							}
						}
					}

					$i++;
				}
			}

			$this->success('操作完成');
		}
	}

	public function uploadReturn()
	{
		$handled = 0;
		$form_api_secret = $this->form_api_secret;
		if (!isset($_GET['code']) || !isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['time'])) {
			header('HTTP/1.1 403 Not Access');
			exit('非法操作哦');
		}

		if (isset($_GET['sign'])) {
			if (md5($_GET['code'] . '&' . $_GET['message'] . '&' . $_GET['url'] . '&' . $_GET['time'] . '&' . $form_api_secret) == $_GET['sign']) {
				if ($_GET['code'] == '200') {
					$handled = 1;
					$fileUrl = 'http://' . $this->upyun_domain . $_GET['url'];
					$fileinfo = get_headers($fileUrl, 1);
					$fileinfo['Content-Type'] = $fileinfo['Content-Type'] ? $fileinfo['Content-Type'] : '';
					M('Users')->where(array('id' => $this->user['id']))->setInc('attachmentsize', intval($fileinfo['Content-Length']));
					M('Files')->add(array('token' => $this->token, 'size' => intval($fileinfo['Content-Length']), 'time' => time(), 'type' => $fileinfo['Content-Type'], 'url' => $fileUrl));

					if ($this->_get('imgfrom') == 'photo_list') {
						echo $fileUrl;
						exit();
					}
				}
				else {
					$handled = 1;
				}
			}
			else {
				header('HTTP/1.1 403 Not Access');
				exit('回调的签名错误,请检查总后台上传配置信息');
			}
		}
		else if (isset($_GET['non-sign'])) {
			if (md5($_GET['code'] . '&' . $_GET['message'] . '&' . $_GET['url'] . '&' . $_GET['time'] . '&') == $_GET['non-sign']) {
				$handled = 1;
			}
			else {
				header('HTTP/1.1 403 Not Access');
				exit('回调的签名错误,请检查总后台上传配置信息。。。');
			}
		}
		else {
			header('HTTP/1.1 403 Not Access');
			exit('回调的签名错误,请检查总后台上传配置信息...');
		}

		$this->assign('result', 1);

		if ($handled) {
			$status = $this->_status($_GET['code'], $_GET['message']);
			$this->assign('error', $status['error']);
			$this->assign('message', $status['msg']);
			$this->display('upload');
		}
	}

	public function editorUploadReturn()
	{
		$handled = 0;
		$form_api_secret = $this->form_api_secret;
		if (!isset($_GET['code']) || !isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['time'])) {
			header('HTTP/1.1 403 Not Access');
			exit();
		}

		if (isset($_GET['sign'])) {
			if (md5($_GET['code'] . '&' . $_GET['message'] . '&' . $_GET['url'] . '&' . $_GET['time'] . '&' . $form_api_secret) == $_GET['sign']) {
				if ($_GET['code'] == '200') {
					$fileUrl = $status['msg'];
					$fileinfo = get_headers($fileUrl, 1);
					M('Users')->where(array('id' => $this->user['id']))->setInc('attachmentsize', intval($fileinfo['Content-Length']));
					M('Files')->add(array('token' => $this->token, 'size' => intval($fileinfo['Content-Length']), 'time' => time(), 'type' => $fileinfo['Content-Type'], 'url' => $fileUrl));
					$handled = 1;
				}
				else {
					$handled = 1;
				}
			}
			else {
				header('HTTP/1.1 403 Not Access');
				exit();
			}
		}
		else if (isset($_GET['non-sign'])) {
			if (md5($_GET['code'] . '&' . $_GET['message'] . '&' . $_GET['url'] . '&' . $_GET['time'] . '&') == $_GET['non-sign']) {
				$handled = 1;
			}
			else {
				header('HTTP/1.1 403 Not Access');
				exit();
			}
		}
		else {
			header('HTTP/1.1 403 Not Access');
			exit();
		}

		if ($handled) {
			$status = $this->_status($_GET['code'], $_GET['message']);
			echo json_encode(array('error' => $status['error'], 'message' => $status['msg']));
		}
		else {
			echo json_encode(array('error' => 1, 'message' => '未知错误'));
		}
	}

	public function _status($code, $message)
	{
		switch ($_GET['code']) {
		default:
			$error = 1;
			break;

		case 200:
			$error = 0;
			break;
		}

		switch ($_GET['message']) {
		default:
			return array('error' => 1, 'msg' => $message);
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case '':
			break;

		case 200:
			return array('error' => 0, 'msg' => '文件上传成功');
			break;
		}

		return array('error' => 0, 'msg' => $message);
	}

	public function deleteFile()
	{
		$upyun = new UpYun($this->bucket, 'user', 'pwd');
		$upyun->deleteFile($filePath);
	}

	public function editorUpload()
	{
		echo $json->encode(array('error' => 1, 'message' => $msg));
	}

	public function kindedtiropic()
	{
		if ($this->upload_type == 'upyun') {
			$upyun_pic = new UpYun(UNYUN_BUCKET, UNYUN_USERNAME, UNYUN_PASSWORD, $api_access[0]);

			try {
				$api_access = array(UpYun::ED_AUTO, UpYun::ED_TELECOM, UpYun::ED_CNC, UpYun::ED_CTT);
				$domain_pic = 'http://' . UNYUN_DOMAIN;
				$dir_pic = '/' . $this->token . '/';
				$save_path = '';
				$save_url = '';
				$ext_arr = array(
					'image' => explode(',', C('up_exts')),
					'flash' => array('swf', 'flv'),
					'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
					'file'  => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2')
					);
				$max_size = intval(C('up_size')) * 1000;

				if (!empty($_FILES['imgFile']['error'])) {
					switch ($_FILES['imgFile']['error']) {
					case '1':
						$error = '超过php.ini允许的大小。';
						break;

					case '2':
						$error = '超过表单允许的大小。';
						break;

					case '3':
						$error = '图片只有部分被上传。';
						break;

					case '4':
						$error = '请选择图片。';
						break;

					case '6':
						$error = '找不到临时目录。';
						break;

					case '7':
						$error = '写文件到硬盘出错。';
						break;

					case '8':
						$error = 'File upload stopped by extension。';
						break;

					case '999':
					default:
						$error = '未知错误。';
					}

					$this->alert($error);
				}

				if (empty($_FILES) === false) {
					$file_name = $_FILES['imgFile']['name'];
					$tmp_name = $_FILES['imgFile']['tmp_name'];
					$file_size = $_FILES['imgFile']['size'];

					if (!$file_name) {
						$this->alert('请选择文件。');
					}

					if (@is_uploaded_file($tmp_name) === false) {
						$this->alert('上传失败。');
					}

					if ($max_size < $file_size) {
						$this->alert('上传文件大小超过限制。');
					}

					$dir_name = (empty($_GET['dir']) ? 'image' : trim($_GET['dir']));

					if (empty($ext_arr[$dir_name])) {
						$this->alert('目录名不正确。');
					}

					$temp_arr = explode('.', $file_name);
					$file_ext = array_pop($temp_arr);
					$file_ext = trim($file_ext);
					$file_ext = strtolower($file_ext);

					if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
						$this->alert('上传文件扩展名是不允许的扩展名。' . "\n" . '只允许' . implode(',', $ext_arr[$dir_name]) . '格式。');
					}

					if ($dir_name !== '') {
						$save_path .= $dir_name . '/';
						$save_url .= $dir_name . '/';
					}

					$ymd = date('Ymd');
					$save_path .= $ymd . '/';
					$save_url .= $ymd . '/';
					$new_file_name = date('YmdHis') . '_' . rand(10000, 99999) . '.' . $file_ext;
					$file_path = $save_path . $new_file_name;
					$fh = fopen($tmp_name, 'r');
					$upyun_pic->writeFile($dir_pic . $file_path, $fh, true);
					$save_url = $domain_pic . $dir_pic . $save_url;
					fclose($fh);
					$file_url = $save_url . $new_file_name;
					header('Content-type: text/html; charset=UTF-8');
					echo json_encode(array('error' => 0, 'url' => $file_url));
					exit();
				}
				else {
					$this->alert('您就先别试这里了，我们服务器禁止写入文件了，O(∩_∩)O');
				}
			}
			catch (Exception $e) {
				$this->alert($e->getCode() . ':' . $e->getMessage());
			}
		}
		else if ($this->upload_type == 'local') {
			$return = $this->localUpload();

			if ($return['error']) {
				$this->alert($return['msg']);
			}
			else {
				header('Content-type: text/html; charset=UTF-8');
				echo json_encode(array('error' => 0, 'url' => $return['msg']));
				exit();
			}
		}
	}

	public function localUpload($path = '', $filetypes = '')
	{
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize = 5 * 1024 * 1024;

		if (!$filetypes) {
			$upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
		}
		else {
			$upload->allowExts = $filetypes;
		}

		$upload->autoSub = 1;
		if (isset($_POST['width']) && intval($_POST['width'])) {
			$upload->thumb = true;
			$upload->thumbMaxWidth = $_POST['width'];
			$upload->thumbMaxHeight = $_POST['height'];
			$thumb = 1;
		}

		$upload->thumbRemoveOrigin = true;
		$firstLetter = substr($this->token, 0, 1);
		$upload->savePath = $path ? './upload/' . $path . '/' . $firstLetter . '/' . $this->token . '/' : './upload/' . $firstLetter . '/' . $this->token . '/';
		$rootpath = ($path ? '/upload/' . $path : '/upload');
		if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $rootpath) || !is_dir($_SERVER['DOCUMENT_ROOT'] . $rootpath)) {
			mkdir($_SERVER['DOCUMENT_ROOT'] . $rootpath, 511);
		}

		$firstLetterDir = $_SERVER['DOCUMENT_ROOT'] . $rootpath . '/' . $firstLetter;
		if (!file_exists($firstLetterDir) || !is_dir($firstLetterDir)) {
			mkdir($firstLetterDir, 511);
		}

		if (!file_exists($firstLetterDir . '/' . $this->token) || !is_dir($firstLetterDir . '/' . $this->token)) {
			mkdir($firstLetterDir . '/' . $this->token, 511);
		}

		$upload->hashLevel = 4;

		if (!$upload->upload()) {
			$error = 1;
			$msg = $upload->getErrorMsg();
		}
		else {
			$error = 0;
			$info = $upload->getUploadFileInfo();
			$this->siteUrl = $this->siteUrl ? $this->siteUrl : C('site_url');

			if ($thumb == 1) {
				$paths = explode('/', $info[0]['savename']);
				$fileName = $paths[count($paths) - 1];
				$msg = $this->siteUrl . substr($upload->savePath, 1) . str_replace($fileName, 'thumb_' . $fileName, $info[0]['savename']);
			}
			else {
				$msg = $this->siteUrl . substr($upload->savePath, 1) . $info[0]['savename'];
			}
		}

		if ($this->_get('imgfrom') == 'photo_list') {
			echo $msg;
			exit();
		}
		else {
			return array('error' => $error, 'msg' => $msg);
		}
	}

	public function alert($msg)
	{
		header('Content-type: text/html; charset=UTF-8');
		echo json_encode(array('error' => 1, 'message' => $msg));
		exit();
	}
}
class UpYunException extends Exception
{
	public function __construct($message, $code, Exception $previous = NULL)
	{
		parent::__construct($message, $code);
	}

	public function __toString()
	{
		return 'UpYunException' . ': [' . $this->code . ']: ' . $this->message . "\n";
	}
}
class UpYunAuthorizationException extends UpYunException
{
	public function __construct($message, $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, 401, $previous);
	}
}
class UpYunForbiddenException extends UpYunException
{
	public function __construct($message, $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, 403, $previous);
	}
}
class UpYunNotFoundException extends UpYunException
{
	public function __construct($message, $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, 404, $previous);
	}
}
class UpYunNotAcceptableException extends UpYunException
{
	public function __construct($message, $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, 406, $previous);
	}
}
class UpYunServiceUnavailable extends UpYunException
{
	public function __construct($message, $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, 503, $previous);
	}
}

?>
