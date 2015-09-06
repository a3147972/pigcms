<?php
class UserinfoAction extends BaseAction{
	public function __construct(){
		parent::__construct();
		session('wapupload',1);

		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		$this->wecha_id = $this->user_session['uid'];
	}
	
	public function index()
	{
		$cardid = intval($this->_get('cardid'));
		$conf = M('Member_card_custom')->where(array('token' => $this->token))->find();
		empty($conf) && $conf = array('wechaname' => 1, 'tel' => 1, 'truename' => 1, 'qq' => 1, 'paypass' => 1, 'portrait' => 1, 'sex' => 1, 'bornyear' => 1, 'bornmonth' => 1, 'bornday' => 1);
		$this->assign('conf', $conf);
		
		$where = array();
		$where['wecha_id'] = $this->wecha_id;
		$where['token'] = $this->token;
		
		$cardInfoRow['wecha_id'] = $this->wecha_id;
		$cardInfoRow['token'] = $this->token;
		$cardInfoRow['cardid'] = $cardid;
		$cardinfo = D('Member_card_create')->where($cardInfoRow)->find(); //是否领取过
		$this->assign('cardInfo', $cardinfo);

		$thisCard = M('Member_card_set')->where(array('token' => $this->token, 'id' => intval($_GET['cardid'])))->find();
		if (!$thisCard && $cardid) {
			exit();
		}
		
		$user = D('User')->where(array('uid' => $this->user_session['uid']))->find();
		$userinfo = D('Userinfo')->where($where)->find();
		$userinfo && $user = array_merge($user, $userinfo);
		if ($thisCard['memberinfo'] != false) {
			$img = $thisCard['memberinfo'];			
		} else {
			$img = 'tpl/Wap/static/images/fans.jpg';
		}
		
		
		$this->assign('cardnum', $cardinfo['number']);
		$this->assign('is_check', $thisCard['is_check']);
		$this->assign('homepic', $img);
		$this->assign('info', $user);
		$this->assign('cardid', $cardid);

		if (isset($_GET['redirect'])) {
			$urlinfo = explode('|', $_GET['redirect']);
			$parmArr = explode(',', $urlinfo[1]);
			$parms = array('token' => $cardInfoRow['token'], 'wecha_id' => $cardInfoRow['wecha_id']);
			if ($parmArr) {
				foreach ($parmArr as $pa) {
					$pas = explode(':', $pa);
					$parms[$pas[0]]=$pas[1];
				}
			}
			$redirectUrl = U($urlinfo[0], $parms);
			$this->assign('redirectUrl', $redirectUrl);
		}
		//
		if(IS_POST){
			//如果有post提交，说明是修改
			$info = $userdata = array();
			$userdata['truename'] = isset($_POST['truename']) ? htmlspecialchars($_POST['truename']) : '';
			$userdata['qq'] = isset($_POST['qq']) ? htmlspecialchars($_POST['qq']) : '';
			D('User')->where(array('uid' => $this->user_session['uid']))->save($userdata);
			
			
			$info['wechaname'] = isset($_POST['wechaname']) ? htmlspecialchars($_POST['wechaname']) : '';
			$info['portrait'] = isset($_POST['portrait']) ? htmlspecialchars($_POST['portrait']) : '';
			
			$info['wecha_id'] = $where['wecha_id'];
			$info['token'] = $where['token'];
			
 			if ($cardid == 0) {
 				if ($userinfo) {
 					M('Userinfo')->where($where)->save($info);
 				} else {
 					M('Userinfo')->add($info);
 				}
 				echo 1;exit;
 			} else {
 				if ($cardinfo) { //如果Member_card_create 不为空，说明领过卡，但是可以修改会员信息
 					if(M('Userinfo')->where($where)->save($info)){
 						echo 1;
 						exit;
 					}else{
 						echo 0;
 						exit;
 					}
 				} else {
 					if ($thisCard['is_check'] == '1') {
 						$code = $this->_post('code','trim,strtolower');
 						if($this->_check_code($code) == false){
 							echo 5;
 							exit;
 						}
 					}
 					$card = M('Member_card_create')->field('id,number')->where("token='".$this->token."' and cardid=".intval($_POST['cardid'])." and wecha_id = ''")->order('id ASC')->find();
 					$userScore = 0;
 					if ($userinfo) {
 						$userScore = intval($userInfo['total_score']);
 					}
 					if (!$card) {
 						echo 3;
 						exit;
 					} else {
 						if (intval($thisCard['miniscore']) == 0 || $userScore > intval($thisCard['minscore'])) {
 							M('Member_card_create')->where($where)->delete();
 							$card_up=M('Member_card_create')->where(array('id'=>$card['id']))->save(array('wecha_id'=> $this->wecha_id));
 							$info['getcardtime']=time();
 							if ($userinfo) {
 								M('Userinfo')->where($where)->save($info);
 							} else {
 								$uid = M('Userinfo')->data($info)->add();
 							}
							$now = time();
							$coupons = M('Member_card_coupon')->where(array('cardid' => $cardid, 'token' => $this->token, 'attr' => 1,'statdate'=>array('lt', $now),'enddate'=>array('gt', $now)))->select();
							$ids = $data = array();
							$data['token'] = $this->token;
							$data['wecha_id'] = $this->wecha_id;
							$data['cardid'] = $cardid;
							$records = M('Member_card_coupon_record')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cradid' => $cardid, 'attr' => 1))->select();
							foreach ($records as $r) {
								$ids[] = $r['coupon_id'];
							}
							$data['add_time'] = $now;
							$data['is_use'] = '0';
							foreach ($coupons as $c) {
								if (!in_array($c['id'], $ids)) {
									$data['coupon_type'] = '1';
									$data['coupon_id']	= $c['id'];
									M('Member_card_coupon_record')->add($data);
								}
							}
 							echo 2;exit;
 						}else {
 							echo 4;exit;
 						}
 					} 
 				}
 			}
		}else {
			$this->display();	
		}

		
    } //end function index
   	
    function get_code(){
    	$code_db 	= M('Sms_code');
    	$code 		= $this->_create_code();
    	$phone 		= $this->_post('phone');
    	$data['code'] 			= $code;
    	$data['token'] 			= $this->token;
    	$data['wecha_id'] 		= $this->wecha_id;
    	$data['create_time'] 	= time();
    	$data['action'] 		= 'userCard';
    	
    	$action 	= GROUP_NAME.'-'.MODULE_NAME.'-'.ACTION_NAME;
    	$result 	= array();
	
    	$where 		= array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'action'=>$action);
    	$last_info 	= $code_db->where($where)->order('create_time desc')->find();
    	if(($last_info['create_time']+60) > time()){
    		$result['error']	= -1;
    		$result['info']		= '请不要频繁获取效验码';
    	}else{
    		$code_db->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'action'=>$action,'is_use'=>'0'))->save(array('is_use'=>'1'));	
    		if($code_db->add($data)){
    			$msg 	= '您的领卡效验码为：'.$code.'，验证码5分钟内有效，如非本人操作，请无视这条消息。';
    			$result['error']	= 0;
    			$result['info']		= '';
    			
//     			Sms::sendSms($this->token,$msg,$phone);
    		}
    		
    	}
    	
    	echo json_encode($result);
    }
    
    /* @param  intval length 效验码长度
     * @param  string type  效验码类型  number数字, string字母, mingle数字、字母混合
     * @return string
     */
	function randString($length=4,$type="number"){
		$array = array(
			'number' => '0123456789',
			'string' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'mixed' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		);
		$string = $array[$type];
		$count = strlen($string)-1;
		$rand = '';
		for ($i = 0; $i < $length; $i++) {
			$rand .= $string[mt_rand(0, $count)];
		}
		return $rand;
	}
    /* @param  string code 效验码
     * @param  string time 过期时间
     * @return boolean
     */
    function _check_code($code,$time=300){
    	$code_db 	= M('Sms_code');
    	$action 	= 'userCard';
    	$last_time 	= time()-$time;
    	$where 		= array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'action'=>$action,'is_use'=>'0','create_time'=>array('gt',$last_time));
    	$true_code 	= $code_db->where($where)->getField('code');
    	
    	if(!empty($true_code) && $true_code == $code){
    		return true;
    	}else{
    		return false;
    	}
    }
}
?>