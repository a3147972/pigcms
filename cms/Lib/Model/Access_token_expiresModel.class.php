<?php
class Access_token_expiresModel extends Model
{
	public function get_access_token()
	{
		$access_obj = $this->field(true)->find();
		$now = intval(time());
		if ($access_obj && intval($access_obj['expires_in']) > ($now + 1200)) {
			$url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=' . $access_obj['access_token'];
			$json = json_decode($this->curlGet($url));
			if (isset($json->ip_list)) {
				return array('errcode' => 0, 'access_token' => $access_obj['access_token']);
			}
		}
		
		$appid = C('config.wechat_appid');
		$appsecret = C('config.wechat_appsecret');
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.trim($appid).'&secret='.trim($appsecret);
		$json = json_decode($this->curlGet($url));
		if (isset($json->access_token) && $json->access_token) {
			if ($access_obj) {
				$this->where(array('id' => $access_obj['id']))->save(array('access_token' => $json->access_token, 'expires_in' => intval($json->expires_in + $now)));
			} else {
				$this->add(array('access_token' => $json->access_token, 'expires_in' => intval($json->expires_in + $now)));
			}
			return array('errcode' => 0, 'access_token' => $json->access_token);
		} else {
			return array('errcode' => $json->errcode, 'errmsg' => $json->errmsg);
		}
	}
	
	function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
	
}
?>