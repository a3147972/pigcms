<?php
class SendAction extends BaseAction
{
	public function index()
	{
		$table = array(C('DB_PREFIX') . 'merchant' => 'm', C('DB_PREFIX') . 'send_log' => 's');
		$condition = '`m`.`mer_id`=`s`.`mer_id`';

		if ($this->system_session['area_id']) {
			$condition .= '`m`.`area_id`=\'' . $this->system_session['area_id'] . '\'';
		}

		$log_list = D('')->table($table)->where($condition)->order('s.status ASC, s.pigcms_id DESC')->select();
		$this->assign('list', $log_list);
		$this->display();
	}

	public function send_del()
	{
		$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0);

		if (D('Send_log')->where(array('pigcms_id' => $id))->save(array('status' => 2))) {
			$this->success('拒绝成功');
		}
		else {
			$this->error('请删除该分类下的子分类');
		}
	}

	public function info()
	{
		$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0);
		$table = array(C('DB_PREFIX') . 'send_user' => 's', C('DB_PREFIX') . 'user' => 'u');
		$condition = '`s`.`openid`=`u`.`openid` AND `s`.`log_id`=\'' . $id . '\'';
		$fans_list = D('')->table($table)->where($condition)->select();
		$this->assign('fans_list', $fans_list);
		$this->display();
	}

	public function txtinfo()
	{
		$id = (isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0);
		$source = D('Source_material')->where(array('pigcms_id' => $id))->find();
		$ids = unserialize($source['it_ids']);
		$image_text = D('Image_text')->field(true)->where(array(
	'pigcms_id' => array('in', $ids)
	))->select();
		$this->assign('image_text', $image_text);
		$this->display();
	}

	public function send()
	{
		if (IS_GET) {
			$id = (isset($_GET['send']) ? intval($_GET['send']) : 0);

			if (empty($id)) {
				$this->error('没有发送内容');
			}

			$log = D('Send_log')->where(array('pigcms_id' => $id))->find();

			if (empty($log)) {
				$this->error('没有发送内容');
			}

			$user = D('Send_user')->where(array('log_id' => $id, 'status' => 0))->find();

			if (empty($user)) {
				D('Send_log')->where(array('pigcms_id' => $id))->save(array('status' => 1));
				$this->success('发送完成', U('Send/index'));
				exit();
			}

			$source = D('Source_material')->where(array('pigcms_id' => $log['c_id']))->find();

			if (empty($source)) {
				$this->error('没有发送内容');
			}

			$ids = unserialize($source['it_ids']);
			$image_text = D('Image_text')->field(true)->where(array(
	'pigcms_id' => array('in', $ids)
	))->select();
			$str = '{"touser":"' . $user['openid'] . '","msgtype":"news","news":{"articles": [';
			$pre = '';

			foreach ($image_text as $txt) {
				$url = $this->config['site_url'] . '/wap.php?g=Wap&c=Article&a=index&imid=' . $txt['pigcms_id'];
				$str .= $pre . '{"title":"' . $txt['title'] . '", "description":"' . $txt['digest'] . '", "url":"' . $url . '", "picurl":"' . $this->config['site_url'] . $txt['cover_pic'] . '"}';
				$pre = ',';
			}

			$str .= ']}}';
			$access_token_array = D('Access_token_expires')->get_access_token();

			if ($access_token_array['errcode']) {
				$this->error('获取access_token发生错误：错误代码' . $access_token_array['errcode'] . ',微信返回错误信息：' . $access_token_array['errmsg']);
			}

			$access_token = $access_token_array['access_token'];
			$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $access_token;
			import('ORG.Net.Http');
			$rt = Http::curlPost($url, $str);

			if ($rt['errcode']) {
				D('Send_user')->where(array('log_id' => $id, 'openid' => $user['openid']))->save(array('status' => 2, 'sendtime' => time()));
			}
			else {
				D('Send_user')->where(array('log_id' => $id, 'openid' => $user['openid']))->save(array('status' => 1, 'sendtime' => time()));
			}

			$this->success('不要关闭窗口，发送还在进行中...', U('Send/send', array('send' => $id)));
			exit();
		}
		else {
			$this->error('非法操作');
		}
	}

	public function api_notice_increment($url, $data)
	{
		$ch = curl_init();
		$header[] = 'Accept-Charset: utf-8';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno = curl_errno($ch);

		if ($errorno) {
			return array('rt' => false, 'errorno' => $errorno);
		}
		else {
			$js = json_decode($tmpInfo, 1);

			if ($js['errcode'] == '0') {
				return array('rt' => true, 'errorno' => 0);
			}
			else {
				$errmsg = GetErrorMsg::wx_error_msg($js['errcode']);
				$this->error('发生错误：错误代码' . $js['errcode'] . ',微信返回错误信息：' . $errmsg);
			}
		}
	}

	public function curlGet($url)
	{
		$ch = curl_init();
		$header = 'Accept-Charset: utf-8';
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}

	private function _get_sys($type = '', $key = '')
	{
		$wxsys = array('扫码带提示', '扫码推事件', '系统拍照发图', '拍照或者相册发图', '微信相册发图', '发送位置');

		if ($type == 'send') {
			$wxsys = array('扫码带提示' => 'scancode_waitmsg', '扫码推事件' => 'scancode_push', '系统拍照发图' => 'pic_sysphoto', '拍照或者相册发图' => 'pic_photo_or_album', '微信相册发图' => 'pic_weixin', '发送位置' => 'location_select');
			return $wxsys[$key];
			exit();
		}

		return $wxsys;
	}
}

?>
