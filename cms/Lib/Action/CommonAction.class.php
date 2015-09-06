<?php

class CommonAction extends Action
{
    protected $user_session;
    protected $config;
    protected $common_url;
    protected $static_path;
    protected $static_public;
    protected $user_level;

    protected function _initialize()
    {


		$this->user_session = session('user');
		$this->assign('user_session', $this->user_session);
		$this->config = d('Config')->get_config();
		$this->config['now_city'] = 424;
		$this->assign('config', $this->config);
		c('config', $this->config);
		$levelDb = m('User_level');
		$tmparr = $levelDb->where('22=22')->order('id ASC')->select();
		$levelarr = array();
		if ($tmparr) {
			foreach ($tmparr as $vv) {
				$levelarr[$vv['level']] = $vv;
			}
		}
		$this->user_level = $levelarr;
		unset($tmparr);
		unset($levelarr);
		$this->assign('levelarr', $this->user_level);
		$this->common_url['group_category_all'] = c('config.site_url') . '/category/all/all';
		$this->static_path = $this->config['site_url'] . '/tpl/Static/' . c('DEFAULT_THEME') . '/';
		$this->static_public = $this->config['site_url'] . '/static/';
		$this->assign('static_path', $this->static_path);
		$this->assign('static_public', $this->static_public);
        $this->assign($this->common_url);
		
		

    }

    protected function get_uri_param()
    {
        $uri_arr = explode("?", $_SERVER["REQUEST_URI"]);
        if (!empty($uri_arr[1])) {
            $uri_tmp = explode("&", $uri_arr[1]);

            foreach ($uri_tmp as $key => $value ) {
                $tmp_arr = explode("=", $value);
                $return[$tmp_arr[0]] = $tmp_arr[1];
            }

            return $return;
        }
        else {
            return false;
        }
    }

    protected function error_tips($msg, $url)
    {
        $this->assign("jumpUrl", $url);
        $this->error($msg);
    }
	protected function editor_alert($msg)
	{
		exit(json_encode(array('error' => 1, 'message' => $msg)));
	}
	protected function ok_jsonp_return($json_arr)
	{
		$json_arr['err_code'] = 0;
		exit($_GET['callback'] . '(' . json_encode($json_arr) . ')');
	}
	public function get_encrypt_key($array, $app_key)
	{
		$new_arr = array();
		ksort($array);
		foreach ($array as $key => $value) {
			$new_arr[] = $key . '=' . $value;
		}
		$new_arr[] = 'app_key=' . $app_key;
		$string = implode('&', $new_arr);
		return md5($string);
	}
	protected function get_im_encrypt_key($array, $app_key)
	{
		$new_arr = array();
		ksort($array);
		foreach ($array as $key => $value) {
			$new_arr[] = $key . '=' . $value;
		}
		$new_arr[] = 'app_key=' . $app_key;
		$string = implode('&', $new_arr);
		return md5($string);
	}
}


?>
