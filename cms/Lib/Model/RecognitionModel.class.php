<?php
class RecognitionModel extends Model{
	public function get_new_qrcode($third_type,$third_id){
		$appid     = C('config.wechat_appid');
		$appsecret = C('config.wechat_appsecret');
		
		if(empty($appid) || empty($appsecret)){
			return(array('error_code'=>true,'msg'=>'请联系管理员配置【AppId】【 AppSecret】'));
		}
		
		$qrcode_return = $this->add_new_qrcode_row($third_type,$third_id);
		
		if($qrcode_return['error_code']){
			return $qrcode_return;
		}
		
		import('ORG.Net.Http');
		$http = new Http();
		
		//微信授权获得access_token
		$access_token_array = D('Access_token_expires')->get_access_token();
		if ($access_token_array['errcode']) {
			return(array('error_code'=>true,'msg'=>'获取access_token发生错误：错误代码' . $access_token_array['errcode'] .',微信返回错误信息：' . $access_token_array['errmsg']));
			$this->error('获取access_token发生错误：错误代码' . $access_token_array['errcode'] .',微信返回错误信息：' . $access_token_array['errmsg']);
		}
		$access_token = $access_token_array['access_token'];
		
		$qrcode_url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$post_data['action_name']='QR_LIMIT_SCENE';
		$post_data['action_info']['scene']['scene_id'] = $qrcode_return['qrcode_id'];
		
		$json = $http->curlPost($qrcode_url,json_encode($post_data));
		if (!$json['errcode']){
			$qrcode_save_return = $this->save_qrcode($qrcode_return['qrcode_id'],$json['ticket'],$third_type,$third_id);
			return $qrcode_save_return;	
		}else {
			return(array('error_code'=>true,'msg'=>'发生错误：错误代码'.$json['errcode'].',微信返回错误信息：'.$json['errmsg']));
		}
	}
	
	//生成登录用的临时二维码
	public function get_login_qrcode(){
		$appid     = C('config.wechat_appid');
		$appsecret = C('config.wechat_appsecret');
		
		if(empty($appid) || empty($appsecret)){
			return(array('error_code'=>true,'msg'=>'请联系管理员配置【AppId】【 AppSecret】'));
		}
		
		$database_login_qrcode = D('Login_qrcode');
		$database_login_qrcode->where(array('add_time'=>array('lt',($_SERVER['REQUEST_TIME']-604800))))->delete();
		
		$data_login_qrcode['add_time'] = $_SERVER['REQUEST_TIME'];
		$qrcode_id = $database_login_qrcode->data($data_login_qrcode)->add();
		if(empty($qrcode_id)){
			return(array('error_code'=>true,'msg'=>'获取二维码错误！无法写入数据到数据库。请重试。'));
		}
		
		import('ORG.Net.Http');
		$http = new Http();
		
		//微信授权获得access_token
		$access_token_array = D('Access_token_expires')->get_access_token();
		if ($access_token_array['errcode']) {
			return(array('error_code'=>true,'msg'=>'获取access_token发生错误：错误代码' . $access_token_array['errcode'] .',微信返回错误信息：' . $access_token_array['errmsg']));
		}
		$access_token = $access_token_array['access_token'];
		
		$qrcode_url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$post_data['expire_seconds'] = 604800;
		$post_data['action_name'] = 'QR_SCENE';
		$post_data['action_info']['scene']['scene_id'] = $qrcode_id;
		
		$json = $http->curlPost($qrcode_url,json_encode($post_data));
		if (!$json['errcode']){
			$condition_login_qrcode['id'] = $qrcode_id;
			$data_login_qrcode['ticket'] = $json['ticket'];
			if($database_login_qrcode->where($condition_login_qrcode)->data($data_login_qrcode)->save()){
				return(array('error_code'=>false,'id'=>$qrcode_id,'ticket'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($json['ticket'])));
			}else{
				$database_login_qrcode->where($condition_login_qrcode)->delete();
				return(array('error_code'=>true,'msg'=>'获取二维码错误！保存二维码失败。请重试。'));
			}
		}else{
			$condition_login_qrcode['id'] = $qrcode_id;
			$database_login_qrcode->where($condition_login_qrcode)->delete();
			return(array('error_code'=>true,'msg'=>'发生错误：错误代码 '.$json['errcode'].'，微信返回错误信息：'.$json['errmsg']));
		}
	}
	
	//生成临时二维码
	public function get_tmp_qrcode($qrcode_id){
		$appid     = C('config.wechat_appid');
		$appsecret = C('config.wechat_appsecret');
		
		if(empty($appid) || empty($appsecret)){
			return(array('error_code'=>true,'msg'=>'请联系管理员配置【AppId】【 AppSecret】'));
		}
		
		import('ORG.Net.Http');
		$http = new Http();
		
		//微信授权获得access_token
		$access_token_array = D('Access_token_expires')->get_access_token();
		if ($access_token_array['errcode']) {
			return(array('error_code'=>true,'msg'=>'获取access_token发生错误：错误代码' . $access_token_array['errcode'] .',微信返回错误信息：' . $access_token_array['errmsg']));
		}
		$access_token = $access_token_array['access_token'];
		
		$qrcode_url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$post_data['expire_seconds'] = 604800;
		$post_data['action_name'] = 'QR_SCENE';
		$post_data['action_info']['scene']['scene_id'] = $qrcode_id;
		
		$json = $http->curlPost($qrcode_url,json_encode($post_data));
		if (!$json['errcode']){
			return(array('error_code'=>false,'id'=>$qrcode_id,'ticket'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($json['ticket'])));
		}else{
			return(array('error_code'=>true,'msg'=>'发生错误：错误代码 '.$json['errcode'].'，微信返回错误信息：'.$json['errmsg']));
		}
	}
	
	//产生一条新记录，不包含二维码的ticket
	public function add_new_qrcode_row($third_type,$third_id){
		$data_new_recognition['third_type'] = $third_type;
		$data_new_recognition['third_id'] = $third_id;
		$data_new_recognition['status'] = 0;
		$data_new_recognition['add_time'] = $_SERVER['REQUEST_TIME'];
		
		//首先查取有没有status = 0的，优先替换
		$condition_recognition['status'] = 0;
		$recognition = $this->field('`id`')->where($condition_recognition)->find();
		
		if(empty($recognition)){
			$qrcode_id = $this->data($data_new_recognition)->add();
			if($qrcode_id){
				return(array('error_code'=>false,'qrcode_id'=>$qrcode_id));
			}else{
				return(array('error_code'=>true,'msg'=>'获取失败！请重试。'));
			}
		}else{
			$condition_new_recognition['id'] = $recognition['id'];
			if($this->where($condition_new_recognition)->data($data_new_recognition)->save()){
				return(array('error_code'=>false,'qrcode_id'=>$recognition['id']));
			}else{
				return(array('error_code'=>true,'msg'=>'获取失败！请重试。'));
			}
		}
	}
	//保存二维码的ticket
	public function save_qrcode($qrcode_id,$ticket,$third_type,$third_id){
		$condition_recognition['id'] = $qrcode_id;
		$data_recognition['status'] = 1;
		$data_recognition['add_time'] = $_SERVER['REQUEST_TIME'];
		$data_recognition['ticket'] = $ticket;
		if($this->where($condition_recognition)->data($data_recognition)->save()){
			$save_return = $this->save_app_qrcode($qrcode_id,$third_type,$third_id);
			if($save_return['error_code']){
				return $save_return;
			}
			return(array('error_code'=>false,'qrcode_id'=>$qrcode_id,'qrcode'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($ticket)));
		}else{
			return(array('error_code'=>true,'msg'=>'二维码保存失败！请重试。'));
		}
	}
	//保存qrcode_id到应用
	public function save_app_qrcode($qrcode_id,$third_type,$third_id){
		if($third_type == 'group'){
			$save_return = D('Group')->save_qrcode($third_id,$qrcode_id);
		}else if($third_type == 'merchant'){
			$save_return = D('Merchant')->save_qrcode($third_id,$qrcode_id);
		}else if($third_type == 'meal'){
			$save_return = D('Merchant_store')->save_qrcode($third_id,$qrcode_id);
		}else if($third_type == 'lottery'){
			$save_return = D('Lottery')->save_qrcode($third_id,$qrcode_id);
		}
		return $save_return;
	}
	//删除qrcode_id到应用
	public function del_app_qrcode($qrcode_id,$third_type,$third_id){
		if($third_type == 'group'){
			D('Group')->del_qrcode($third_id);
			$msg = '抱歉，没有找到该'.C('config.group_alias_name').'的二维码！页面将会跳转至获取。';
		}else if($third_type == 'merchant'){
			D('Merchant')->del_qrcode($third_id);
			$msg = '抱歉，没有找到商家信息的二维码！页面将会跳转至获取。';
		}
		exit('<html><head><script type="text/javascript">alert("'.$msg.'");window.location.href=window.location.href;</script></head></html>');
	}
	//返回现存的二维码
	public function get_qrcode($qrcode_id){
		$condition_recognition['id'] = $qrcode_id;
		$recognition = $this->field('`id`,`ticket`')->where($condition_recognition)->find();
		if(empty($recognition)){
			return(array('error_code'=>true,'msg'=>'二维码不存在'));
		}else{
			return(array('error_code'=>false,'qrcode_id'=>$recognition['id'],'qrcode'=>'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($recognition['ticket'])));
		}
	}
}
?>