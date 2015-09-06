<?php
class Weixin_bindModel extends Model
{
	public function get_access_token($mer_id)
	{
		$weixin_bind = $this->where(array('mer_id' => $mer_id))->find();
		if (empty($weixin_bind)) 
			return array('errcode' => 1, 'errmsg' => '公众授权异常，请重新授权');
		$access_token = $_SESSION['authorizer_access_token'];//session('authorizer_access_token');$_SESSION['authorizer_access_token']
		if ($access_token && $access_token[0] > time()) {
			$authorizer_access_token = $access_token[1];
		} else {
			import('ORG.Net.Http');
			$result = $_SESSION['component_access_token'];//session('component_access_token');
			if ($result && $result[0] > time()) {
				$component_access_token = $result[1];
			} else {
				//获取component_access_token
				$url = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
				$data = array('component_appid' => C('config.wx_appid'), 'component_appsecret' => C('config.wx_appsecret'), 'component_verify_ticket' => C('config.wx_componentverifyticket'));
				$result = Http::curlPost($url, json_encode($data));
				if ($result['errcode']) {
					return $result;
				} else {
					$component_access_token = $result['component_access_token'];
				}
			}
			//利用刷新token 获取 authorizer_access_token
			$url = 'https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token=' . $component_access_token;
			$data = array();
			$data['component_appid'] = C('config.wx_appid');
			$data['authorizer_appid'] = $weixin_bind['authorizer_appid'];
			$data['authorizer_refresh_token'] = $weixin_bind['authorizer_refresh_token'];
			$access_data = Http::curlPost($url, json_encode($data));
			if ($access_data['errcode']) {
				return $access_data;
			} else {
				$authorizer_access_token = $access_data['authorizer_access_token'];
				$_SESSION['authorizer_access_token'] = array($access_data['expires_in'] + time(), $access_data['authorizer_access_token']);
			}
		}
		return array('errcode' => 0, 'access_token' => $authorizer_access_token);
	}
	
	
	public function get_account_type($mer_id)
	{
		// code  0：未认证的订阅号,1:认证的订阅号，2：未认证服务号，3认证服务号
		if ($weixin_bind = D('Weixin_bind')->where(array('mer_id' => $mer_id))->find()) {
			if ($weixin_bind['service_type_info'] == 0 || $weixin_bind['service_type_info'] == 1) {
				if ($weixin_bind['verify_type_info'] == -1) {
					return array('errcode' => 0, 'errmsg' => '未认证的订阅号', 'code' => 0);
				}
				return array('errcode' => 0, 'errmsg' => '认证的订阅号', 'code' => 1);
			} else {
				if ($weixin_bind['verify_type_info'] == -1) {
					return array('errcode' => 0, 'errmsg' => '未认证服务号', 'code' => 2);
				}
				return array('errcode' => 0, 'errmsg' => '认证服务号', 'code' => 3);
			}
		} else {
			return array('errcode' => 1, 'errmsg' => '公众授权异常，请重新授权');
		}
	}
	
	
}
?>