<?php
class CountAction extends BaseAction{
	public function index(){
		$condition_merchant_request['mer_id'] = $this->merchant_session['mer_id'];
		
		$today_zero_time = mktime(0,0,0,date('m',$_SERVER['REQUEST_TIME']),date('d',$_SERVER['REQUEST_TIME']), date('Y',$_SERVER['REQUEST_TIME']));
		
		if(empty($_GET['day'])){
			$_GET['day'] = date('d',$_SERVER['REQUEST_TIME']);
		}
		
		if($_GET['day'] < 1){
			$this->error('日期非法！');
		}else if($_GET['day'] > 180){
			$this->error('最长只能查询180天！');
		}
		
		$condition_merchant_request['time'] = array(array('egt',$today_zero_time-(($_GET['day']-1)*86400)),array('elt',$today_zero_time));

		
		$request_list = M('Merchant_request')->field(true)->where($condition_merchant_request)->order('`time` ASC')->select();

		foreach($request_list as $value){
			$tmp_time = date('Ymd',$value['time']);
			$tmp_array[$tmp_time] = $value;
		}
		for($i=1;$i<=$_GET['day'];$i++){
			$tmp_time = date('Ymd',$today_zero_time-(($i-1)*86400));
			if(empty($tmp_array[$tmp_time])){
				$tmp_array[$tmp_time] = array('time'=>$today_zero_time-(($i-1)*86400));
			}
		}
		
		foreach($tmp_array as $key=>$value){
			//基础统计
			$pigcms_list['xAxis_arr'][]  = '"'.date('j',$value['time']).'日"';
			$pigcms_list['follow_arr'][] = '"'.intval($value['follow_num']).'"';
			$pigcms_list['img_arr'][]   = '"'.intval($value['img_num']).'"';
			$pigcms_list['website_hits_arr'][]   = '"'.intval($value['website_hits']).'"';
			//团购统计
			$pigcms_list['group_hits_arr'][] = '"'.intval($value['group_hits']).'"';
			$pigcms_list['group_buy_count_arr'][]   = '"'.intval($value['group_buy_count']).'"';
			$pigcms_list['group_buy_money_arr'][]   = '"'.floatval($value['group_buy_money']).'"';
			//订餐统计
			$pigcms_list['meal_hits_arr'][] = '"'.intval($value['meal_hits']).'"';
			$pigcms_list['meal_buy_count_arr'][]   = '"'.intval($value['meal_buy_count']).'"';
			$pigcms_list['meal_buy_money_arr'][]   = '"'.floatval($value['meal_buy_money']).'"';
		}
		//基础统计
		$pigcms_list['xAxis_txt'] = implode(',',$pigcms_list['xAxis_arr']);
		$pigcms_list['follow_txt'] = implode(',',$pigcms_list['follow_arr']);
		$pigcms_list['img_txt'] = implode(',',$pigcms_list['img_arr']);
		$pigcms_list['website_hits_txt'] = implode(',',$pigcms_list['website_hits_arr']);
		//团购统计
		$pigcms_list['group_hits_txt'] = implode(',',$pigcms_list['group_hits_arr']);
		$pigcms_list['group_buy_count_txt'] = implode(',',$pigcms_list['group_buy_count_arr']);
		$pigcms_list['group_buy_money_txt'] = implode(',',$pigcms_list['group_buy_money_arr']);
		//订餐统计
		$pigcms_list['meal_hits_txt'] = implode(',',$pigcms_list['meal_hits_arr']);
		$pigcms_list['meal_buy_count_txt'] = implode(',',$pigcms_list['meal_buy_count_arr']);
		$pigcms_list['meal_buy_money_txt'] = implode(',',$pigcms_list['meal_buy_money_arr']);
		
		$this->assign($pigcms_list);
		krsort($tmp_array);
		$this->assign('request_list',$tmp_array);
		
		$this->display();
	}
	
	public function order()
	{
		$this->assign(D("Meal_order")->get_order_by_mer_id($this->merchant_session['mer_id']));
		$this->display();
	}
	
	public function bill()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$percent = '';
		if ($this->merchant_session['percent']) {
			$percent = $this->merchant_session['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('percent', $percent);
		$merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
		$result = D("Meal_order")->get_order_by_mer_id($mer_id);
		$this->assign($result);
		$this->assign('total_percent', $result['total'] * (100 - $percent) * 0.01);
		$this->assign('all_total_percent', ($result['alltotal'] + $result['alltotalfinsh']) * (100 - $percent) * 0.01);
		$this->assign('now_merchant', $merchant);
		$this->assign('mer_id', $mer_id);
		$this->display();
	}
	
	public function clerk()
	{
		$Model = new Model();
		$sql = "SELECT s.name as store_name, s.*, m.* FROM ". C('DB_PREFIX') . "merchant_store AS s INNER JOIN ". C('DB_PREFIX') . "merchant_store_staff AS m ON s.store_id=m.store_id WHERE `s`.`mer_id`={$this->merchant_session['mer_id']}";
		$res = $Model->query($sql);
				
		$this->assign('staff_list', $res);
		$this->display();
	}
	
	public function weidian()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$percent = '';
		if ($this->merchant_session['percent']) {
			$percent = $this->merchant_session['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('percent', $percent);
		$merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
		$result = D("Weidian_order")->get_order_by_mer_id($mer_id);
		$this->assign($result);
		$this->assign('total_percent', $result['total'] * $percent * 0.01);
		$this->assign('all_total_percent', ($result['alltotal']+$result['alltotalfinsh']) * $percent * 0.01);
		$this->assign('now_merchant', $merchant);
		$this->assign('mer_id', $mer_id);
		$this->display();
	}
	
	/**
	 * 店员账单
	 */
	public function staff_bill()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$staffid = isset($_GET['staffid']) ? intval($_GET['staffid']) : 0;
		$staffs = D('Merchant_store_staff')->where(array('token' => $mer_id))->select();
		$staff_name = '';
		foreach ($staffs as $row) {
			if ($row['id'] == $staffid) $staff_name = $row['name'];
		}
		$this->assign(D("Meal_order")->get_offlineorder_by_mer_id($mer_id, $staff_name));
		$this->assign('staffid', $staffid);
		$this->assign('staffs', $staffs);
		$this->display();
		
	}
	
	public function change()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
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
	
}
?>