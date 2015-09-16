<?php
/*
 * 渠道二维码
 *
 */
class RecognitionAction extends BaseAction{
    public function see_qrcode($type,$id){
		//判断ID是否正确，如果正确且以前生成过二维码则得到ID
		if($type == 'group'){
			$pigcms_return = D('Group')->get_qrcode($id);
		}elseif($type == 'merchant'){
			$pigcms_return = D('Merchant')->get_qrcode($id);
		}elseif($type == 'meal'){
			$pigcms_return = D('Merchant_store')->get_qrcode($id);
		}elseif($type == 'lottery'){
			$pigcms_return = D('Lottery')->get_qrcode($id);
		}else{
			exit('您查看的内容非法！无法查看二维码！');
		}
		
		if(empty($pigcms_return)){
			exit('您查看的内容不存在！无法查看二维码！');
		}
		if(empty($pigcms_return['qrcode_id'])){
			$qrcode_return = D('Recognition')->get_new_qrcode($type,$id);
		}else{
			$qrcode_return = D('Recognition')->get_qrcode($pigcms_return['qrcode_id']);
		}
		if($qrcode_return['error_code']){
			exit($qrcode_return['msg']);
		}else{
			if($_GET['img']){
				echo '<html><head><style>*{margin:0;padding:0;}</style></head><body><img src="'.$qrcode_return['qrcode'].'"/></body></html>';
			}else{
				redirect($qrcode_return['qrcode']);
			}
		}
    }
	public function see_login_qrcode(){
		$qrcode_return = D('Recognition')->get_login_qrcode();
		if($qrcode_return['error_code']){
			echo '<html><head></head><body>'.$qrcode_return['msg'].'<br/><br/><font color="red">请关闭此窗口再打开重试。</font></body></html>';
		}else{
			$this->assign($qrcode_return);
			$this->display();
		}
	}
	public function see_tmp_qrcode(){
		$qrcode_return = D('Recognition')->get_tmp_qrcode($_GET['qrcode_id']);
		if($qrcode_return['error_code']){
			echo '<html><head></head><body>'.$qrcode_return['msg'].'<br/><br/><font color="red">请关闭此窗口再打开重试。</font></body></html>';
		}else{
			$this->assign($qrcode_return);
			$this->display();
		}
	}
	
	public function get_tmp_qrcode(){
		$qrcode_return = D('Recognition')->get_tmp_qrcode($_GET['qrcode_id']);
		if($qrcode_return['error_code']){
			exit($qrcode_return['msg']);
		}else{
			redirect($qrcode_return['ticket']);
		}
	}
	
	public function get_own_qrcode(){
		$qrCon = $_GET['qrCon'];
		import('@.ORG.phpqrcode');
		QRcode::png(urldecode($qrCon),false,0,10,1);
	}
}