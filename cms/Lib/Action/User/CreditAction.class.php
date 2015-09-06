<?php
/*
 * 余额
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/29 14:06
 * 
 */
class CreditAction extends BaseAction {
    public function index(){
		//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12);
    	$this->assign('search_hot_list',$search_hot_list);

		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//余额记录列表
		$this->assign(D('User_money_list')->get_list($this->now_user['uid']));
		
		$this->display();
    }
	public function recharge(){
		$data_user_recharge_order['uid'] = $this->now_user['uid'];
		$money = floatval($_GET['money']);
		if(empty($money) || $money > 10000){
			$this->error('请输入有效的金额！最高不能超过1万元。');
		}
		$data_user_recharge_order['money'] = $money;
		// $data_user_recharge_order['order_name'] = '帐户余额在线充值';
		$data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
		if($order_id = D('User_recharge_order')->data($data_user_recharge_order)->add()){
			redirect(U('Index/Pay/check',array('order_id'=>$order_id,'type'=>'recharge')));
		}
	}
}