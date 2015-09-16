<?php
class Offline{
	protected $order_info;
	protected $pay_money;
	protected $pay_type;
	protected $is_mobile;
	protected $pay_config;
	protected $user_info;
	
	public function __construct($order_info,$pay_money,$pay_type,$pay_config,$user_info,$is_mobile=0){
		$this->order_info = $order_info;
		$this->pay_money  = $pay_money;
		$this->pay_type   = $pay_type;
		$this->is_mobile   = $is_mobile;
		$this->pay_config = $pay_config;
		$this->user_info  = $user_info;
	}
	public function pay(){
		if($this->is_mobile){
			return $this->mobile_pay();
		}else{
			return $this->web_pay();
		}
	}
	public function mobile_pay(){
		$param = base64_encode($this->order_info['order_type'].'_'.$this->order_info['order_id']);
		header('Location:' . C('config.site_url') . '/wap.php?c=Pay&a=return_url&pay_type=offline&is_mobile=1&param=' . $param);
		exit();
	}
	public function web_pay(){
		$param = base64_encode($this->order_info['order_type'].'_'.$this->order_info['order_id']);
		header('Location:' . C('config.site_url').'/index.php?c=Pay&a=return_url&pay_type=offline&param=' . $param);
		exit();
	}
	
	public function notice_url(){
		if($this->is_mobile){
			return $this->mobile_notice();
		}else{
			return $this->web_notice();
		}
	}
	public function mobile_notice(){
		exit('success');
	}
	public function web_notice(){
		exit('success');
	}
	public function return_url(){
		$order_id = base64_decode($_GET['param']);
		$order_id_arr = explode('_',$order_id);
		$order_param['pay_type'] = 'offline';
		$order_param['is_mobile'] = $this->is_mobile;
		$order_param['order_type'] = $order_id_arr[0];
		$order_param['order_id'] = $order_id_arr[1];
		$order_param['third_id'] = 0;
		$order_param['pay_money'] = 0;
		
		return array('error' => 0,'order_param' => $order_param);
	}
}
?>