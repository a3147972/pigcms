<?php
/*
 * 商户登录
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/10 13:36
 * 
 */

class LoginAction extends Action{
	protected function _initialize(){		
	}
    public function index(){
		$this->check_merchant_file();
		
		$config = D('Config')->get_config();
		$this->assign('config',$config);

		$this->assign('static_path','./tpl/Merchant/static/');
		$this->assign('static_public','./static/');
		
		$this->display();
    }
	public function check(){
		if($this->isAjax()){
			if(md5($_POST['verify']) != $_SESSION['merchant_login_verify']){
				exit(json_encode(array('error'=>'1','msg'=>'验证码不正确！','dom_id'=>'verify')));
			}
			
			$database_merchant = D('Merchant');
			$condition_merchant['account'] = $_POST['account'];
			$now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
			if(empty($now_merchant)){
				exit(json_encode(array('error'=>'2','msg'=>'用户名不存在！','dom_id'=>'account')));
			}
			$pwd = md5($_POST['pwd']);
			if($pwd != $now_merchant['pwd']){
				exit(json_encode(array('error'=>'3','msg'=>'密码错误！','dom_id'=>'pwd')));
			}
			if($now_merchant['status'] == 0){
				exit(json_encode(array('error'=>'4','msg'=>'您被禁止登录！请联系工作人员获得详细帮助。','dom_id'=>'account')));
			}else if($now_merchant['status'] == 2){
				exit(json_encode(array('error'=>'5','msg'=>'您的帐号正在审核中，请耐心等待或联系工作人员审核。','dom_id'=>'account')));
			}
			
			$data_merchant['mer_id'] = $now_merchant['mer_id'];
			$data_merchant['last_ip'] = get_client_ip(1);
			$data_merchant['last_time'] = $_SERVER['REQUEST_TIME'];
			$data_merchant['login_count'] = $now_merchant['login_count']+1;
			if($database_merchant->data($data_merchant)->save()){
				$now_merchant['login_count'] += 1;
				
				if(!empty($now_merchant['last_ip'])){
					import('ORG.Net.IpLocation');
					$IpLocation = new IpLocation();
					$last_location = $IpLocation->getlocation(long2ip($now_merchant['last_ip']));
					$now_merchant['last']['country'] = iconv('GBK','UTF-8',$last_location['country']);
					$now_merchant['last']['area'] = iconv('GBK','UTF-8',$last_location['area']);
				}
				session('merchant',$now_merchant);
				exit(json_encode(array('error'=>'0','msg'=>'登录成功,现在跳转~','dom_id'=>'account')));
			}else{
				exit(json_encode(array('error'=>'6','msg'=>'登录信息保存失败,请重试！','dom_id'=>'account')));
			}
		}else{
			exit('deney Access !');
		}
	}
	public function reg_check(){
		if($this->isAjax()){
			if(md5($_POST['verify']) != $_SESSION['merchant_reg_verify']){
				exit(json_encode(array('error'=>'1','msg'=>'验证码不正确！','dom_id'=>'verify')));
			}
			
			//帐号
			$database_merchant = D('Merchant');
			$condition_merchant['account'] = $_POST['account'];
			$now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
			if(!empty($now_merchant)){
				exit(json_encode(array('error'=>'2','msg'=>'帐号已经存在！','dom_id'=>'account')));
			}
			
			//名称
			$condition_merchant['name'] = $_POST['name'];
			$now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
			if(!empty($now_merchant)){
				exit(json_encode(array('error'=>'3','msg'=>'商家名称已经存在！','dom_id'=>'email')));
			}
			
			//邮箱
			$condition_merchant['email'] = $_POST['email'];
			$now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
			if(!empty($now_merchant)){
				exit(json_encode(array('error'=>'4','msg'=>'邮箱已经存在！','dom_id'=>'email')));
			}
			
			//手机号
			$condition_merchant['phone'] = $_POST['phone'];
			$now_merchant = $database_merchant->field('`mer_id`')->field(true)->where($condition_merchant)->find();
			if(!empty($now_merchant)){
				exit(json_encode(array('error'=>'5','msg'=>'手机号已经存在！','dom_id'=>'phone')));
			}
			
			$config = D('Config')->get_config();
			$this->assign('config',$config);
			
			$_POST['mer_id'] = null;
			if($config['merchant_verify']){
				$_POST['status'] = 2;
			}else{
				$_POST['status'] = 1;
			}
			
			$_POST['pwd'] = md5($_POST['pwd']);
			$_POST['reg_ip'] = get_client_ip(1);
			$_POST['reg_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['login_count'] = 0;
			$_POST['reg_from'] = 0;
			if($database_merchant->data($_POST)->add()){
				if($config['merchant_verify']){
					exit(json_encode(array('error'=>'0','msg'=>'注册成功,请耐心等待审核或联系工作人员审核。~','dom_id'=>'account')));
				}else{
					exit(json_encode(array('error'=>'0','msg'=>'注册成功,请登录~','dom_id'=>'account')));
				}
			}else{
				exit(json_encode(array('error'=>'6','msg'=>'注册失败,请重试！','dom_id'=>'account')));
			}
		}else{
			exit('deney Access !');
		}
	}
	public function logout(){
		session('merchant',null);
		header('Location: '.U('Login/index'));
	}
	public function verify(){
		$verify_type = $_GET['type'];
		if(empty($verify_type)){exit;}
		import('ORG.Util.Image');
		Image::buildImageVerify(4,1,'jpeg',53,26,'merchant_'.$verify_type.'_verify');
	}
	protected function check_merchant_file(){
		$filename= substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'] ,'/')+1);
		if($filename == 'index.php'){
			$this->error('非法访问商家中心！');
		}
	}
}