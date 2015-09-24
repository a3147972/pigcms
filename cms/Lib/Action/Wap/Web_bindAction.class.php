<?php
/*
 * 电脑站和微信协调登录页
 *
 */
class Web_bindAction extends BaseAction{
	public function ajax_web_login(){
		if(empty($_GET['qrcode_id'])){
			$this->error_tips('登录失败！请重新扫码。',U('Home/index'));
		}
		if(!$this->check_login_qrcode($_GET['qrcode_id'])){
			$this->error_tips('二维码已失效！请重新扫码。',U('Home/index'));
		}
		if(!empty($this->user_session)){
			if($this->change_login_qrcode($_GET['qrcode_id'])){
				$this->success_tips('登录成功！',U('Home/index'));
			}else{
				$this->error_tips('登录失败！请重新扫码。',U('Home/index'));
			}
		}else{
			redirect(U('Login/index',array('referer'=>urlencode(U('Web_bind/ajax_web_login',array('qrcode_id'=>$_GET['qrcode_id']))))));
		}
	}
	public function check_login_qrcode($qrcode_id){
		$database_login_qrcode = D('Login_qrcode');
		$condition_login_qrcode['id'] = $qrcode_id;
		if($database_login_qrcode->field('`uid`')->where($condition_login_qrcode)->find()){
			return true;
		}else{
			return false;
		}
	}
	public function change_login_qrcode($qrcode_id){
		$database_login_qrcode = D('Login_qrcode');
		$condition_login_qrcode['id'] = $qrcode_id;
		$data_login_qrcode['uid'] = $this->user_session['uid'];
		if($database_login_qrcode->where($condition_login_qrcode)->data($data_login_qrcode)->save()){
			return true;
		}else{
			return false;
		}
	}
}