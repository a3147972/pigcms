<?php
/*
 * 底部导航
 *
 */

class FooterAction extends BaseAction{
	public function index(){
		$database_footer_link = D('Footer_link');
		$link_list = $database_footer_link->order('`id` ASC')->select();
		$this->assign('link_list',$link_list);
		
		$this->display();
	}
	public function add(){
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function modify(){
		$database_footer_link = D('Footer_link');
		$_POST['content'] = fulltext_filter($_POST['content']);
		$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
		if($database_footer_link->data($_POST)->add()){
			$this->success('添加成功！');
		}else{
			$this->error('添加失败！');
		}
	}
	public function edit(){
		$database_footer_link = D('Footer_link');
		$condition_footer_link['id'] = $_GET['id'];
		$now_link = $database_footer_link->field(true)->where($condition_footer_link)->find();
		if(empty($now_link)){
			$this->frame_error_tips('数据库中没有查询到该内容！',5);
		}
		$this->assign('now_link',$now_link);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function amend(){
		$database_footer_link = D('Footer_link');
		$_POST['content'] = fulltext_filter($_POST['content']);
		$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
		if($database_footer_link->data($_POST)->save()){
			$this->success('编辑成功！');
		}else{
			$this->error('编辑失败！');
		}
	}
	public function news_del(){
		if(IS_POST){
			$database_merchant_news = D('Merchant_news');
			$condition_merchant_news['id'] = $_POST['id'];
			if($database_merchant_news->where($condition_merchant_news)->delete()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	
	public function order(){
		
		$percent = 0;
		$mer_id = isset($_GET['mer_id']) ? intval($_GET['mer_id']) : 0;
		$merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
		if ($merchant['percent']) {
			$percent = $merchant['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('percent', $percent);

		$result = D("Meal_order")->get_order_by_mer_id($mer_id, 1);
		$this->assign($result);
		$this->assign('total_percent', $result['total'] * $percent * 0.01);
		$this->assign('all_total_percent', ($result['alltotal']+$result['alltotalfinsh']) * $percent * 0.01);
		
// 		$this->assign(D("Meal_order")->get_order_by_mer_id($mer_id, 1));
		$this->assign('now_merchant', $merchant);
		$this->assign('mer_id', $mer_id);
		$this->display();
	}
	
	public function change(){
		$mer_id = isset($_GET['mer_id']) ? intval($_GET['mer_id']) : 0;
		$strids = isset($_GET['strids']) ? htmlspecialchars($_GET['strids']) : '';
		if ($strids) {
			$array = explode(',', $strids);
			$mealids = $groupids = array();
			foreach ($array as $val) {
				$t = explode('_', $val);
				if ($t[0] == 1) {
					$mealids[] = $t[1];
				} else {
					$groupids[] = $t[1];
				}
			}
			$mealids && D('Meal_order')->where(array('mer_id' => $mer_id, 'order_id' => array('in', $mealids)))->save(array('is_pay_bill' => 1));
			$groupids && D('Group_order')->where(array('mer_id' => $mer_id, 'order_id' => array('in', $groupids)))->save(array('is_pay_bill' => 1));
		}
		exit(json_encode(array('error_code' => 0)));
	}
	
	public function menu()
	{
		$this->assign('bg_color','#F3F3F3');
		
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = intval($_GET['mer_id']);
		$merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($merchant)){
			$this->frame_error_tips('数据库中没有查询到该商户的信息！');
		}
		$merchant['menus'] = explode(',', $merchant['menus']);
		$this->assign('merchant',$merchant);
		
		$menus = D('Merchant_menu')->where(array('status' => 1, 'show' => 1))->select();
		
		$list = array();
		
		foreach ($menus as $menu) {
			if (empty($menu['fid'])) {
				if (isset($list[$menu['id']])) {
					$list[$menu['id']] = array_merge($list[$menu['id']], $menu);
				} else {
					$list[$menu['id']] = $menu;
				}
			} else {
				if (isset($list[$menu['fid']])) {
					$list[$menu['fid']]['lists'][] = $menu;
				} else {
					$list[$menu['fid']]['lists'] = array($menu);
				}
			}
		}
		$this->assign('menus', $list);
		$this->display();
	}
	
	public function savemenu()
	{
		if (IS_POST) {
			$mer_id = isset($_POST['mer_id']) ? intval($_POST['mer_id']) : 0;
			$menus = isset($_POST['menus']) ? $_POST['menus'] : '';
			$menus = implode(',', $menus);
			$database_merchant = D('Merchant');
			$database_merchant->where(array('mer_id' => $mer_id))->save(array('menus' => $menus));
			$this->success('权限设置成功！');
		} else {
			$this->error('非法提交,请重新提交~');
		}
	}
	
}