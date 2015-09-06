<?php

class BaseAction extends Action
{
	protected $system_session;
	protected $static_path;
	protected $static_public;

	protected function _initialize()
	{
	
		$this->user_session = session('user');
		$this->assign('user_session', $this->user_session);
		$this->config = d('Config')->get_config();
		//$this->config['now_city'] = 2;
		$this->assign('config', $this->config);
		c('config', $this->config);
		$this->check_admin_file();
		$this->system_session = session('system');

		if (empty($this->system_session)) {
			header('Location: ' . u('Login/index'));
		}

		$this->assign('system_session', $this->system_session);
		$this->config = d('Config')->get_config();
		$this->assign('config', $this->config);
		c('config', $this->config);
		$this->static_path = './tpl/System/Static/';
		$this->static_public = './static/';
		$this->assign('static_path', $this->static_path);
		$this->assign('static_public', $this->static_public);
		$tmerch = d('Admin')->field('menus')->where(array('id' => $this->system_session['id']))->find();

		if (empty($tmerch['menus'])) {
			$this->system_session['menus'] = '';
		}
		else {
			$this->system_session['menus'] = explode(',', $tmerch['menus']);
		}

		$database_system_menu = d('System_menu');
		$condition_system_menu['status'] = 1;
		$condition_system_menu['show'] = 1;
		$menu_list = $database_system_menu->field(true)->where($condition_system_menu)->order('`sort` DESC,`fid` ASC,`id` ASC')->select();

		foreach ($menu_list as $key => $value) {
			if ((strtolower($value['module']) == strtolower(MODULE_NAME)) && ( strtolower($value['action']) == strtolower(ACTION_NAME))) {
				if ((false == empty($this->system_session['menus'])) && (  false == in_array($value['id'], $this->system_session['menus']))) {
					$this->error('您还没有这个使用权限，联系管理员开通！', u('Index/Index'));
				}
			}

			if (empty($value['area_access']) && (true == $this->system_session['area_id'])) {
				continue;
			}

			if ((false == empty($this->system_session['menus'])) && ( false == in_array($value['id'], $this->system_session['menus']))) {
				continue;
			}

			if (0 == $value['fid']) {
				$system_menu[$value['id']] = $value;
			}
			else {
				$system_menu[$value['fid']]['menu_list'][] = $value;
			}
		}

		$this->assign('system_menu', $system_menu);
	}

	protected function check_admin_file()
	{
		$filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);

		if ($filename == 'index.php') {
			$this->error('非法访问系统后台！');
		}
	}

	public function _empty()
	{
		exit('Fuck ! 你搞错了。');
	}

	protected function frame_main_ok_tips($tips, $time = 3, $href = '')
	{
		if ($href == '') {
			$tips = '<font color=\\"red\\">' . $tips . '</font>';
			$href = 'javascript:history.back(-1);';
			$tips .= '<br/><br/>系统正在跳转到上一个页面。';
		}

		if (!($time == 3)) {
			$tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
		}

		exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.parent.frames[\'main\'].location.href="' . $href . '";</script></head></html>');
	}

	protected function error_tips($tips, $time = 3, $href = '')
	{
		if ($href == '') {
			$tips = '<font color=\\"red\\">' . $tips . '</font>';
			$href = 'javascript:history.back(-1);';
			$tips .= '<br/><br/>系统正在跳转到上一个页面。';
		}

		if (!($time == 3)) {
			$tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
		}

		exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');location.href="' . $href . '";</script></head></html>');
	}

	protected function frame_error_tips($tips, $time = 3)
	{
		exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');window.top.closeiframe();</script></head></html>');
	}

	protected function frame_submit_tips($type, $tips, $time = 3)
	{
		if ($type) {
			exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.top.main_refresh();window.top.closeiframe();</script></head></html>');
		}
		else {
			exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');window.top.frames["Openadd"].history.back();window.top.closeiframebyid("form_submit_tips");</script></head></html>');
		}
	}

	final public function httpRequest($url, $method = 'GET', $postfields = NULL, $headers = array(), $debug = false)
	{
		$method = strtoupper($method);
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0');
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ci, CURLOPT_TIMEOUT, 7);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

		switch ($method) {
		case 'POST':
			curl_setopt($ci, CURLOPT_POST, true);

			if (!(true == empty($postfields))) {
				$tmpdatastr = (is_array($postfields) ? http_build_query($postfields) : $postfields);
				curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
			}

			break;
		default:
			curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method);
			break;
		}

		$ssl = (preg_match('/^https:\\/\\//i', $url) ? true : false);
		curl_setopt($ci, CURLOPT_URL, $url);

		if ($ssl) {
			curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
		}

		curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ci, CURLOPT_MAXREDIRS, 2);
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ci, CURLINFO_HEADER_OUT, true);
		$response = curl_exec($ci);
		$requestinfo = curl_getinfo($ci);
		$http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);

		if ($debug) {
			echo '=====post data======' . "\r\n";
			var_dump($postfields);
			echo '=====info===== ' . "\r\n";
			print_r($requestinfo);
			echo '=====response=====' . "\r\n";
			print_r($response);
		}

		curl_close($ci);
		return array($http_code, $response, $requestinfo);
	}
}


?>
