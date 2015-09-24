<?php
class ActivityAction extends BaseAction{
	public function index() {
		$now_activity = D('Extension_activity')->where(array('begin_time'=>array('lt',$_SERVER['REQUEST_TIME']),'end_time'=>array('gt',$_SERVER['REQUEST_TIME'])))->order('`activity_id` ASC')->find();	
		if(!empty($now_activity)){
			$activity_now = true;
		}else{
			$activity_now = false;
			$now_activity = D('Extension_activity')->where(array('begin_time'=>array('gt',$_SERVER['REQUEST_TIME'])))->order('`activity_id` ASC')->find();
			$this->assign('now_activity',$now_activity);
		}
		if(empty($now_activity)){
			$this->assign('jumpUrl',$this->config['site_url']);
			$this->error('暂时没有活动可供参与');
		}
		$now_activity['bg_pic'] = $this->config['site_url'].'/upload/extension/'.$now_activity['bg_pic'];
		$this->assign('now_activity',$now_activity);
		$this->assign('activity_now',$activity_now);
		
		if($now_activity['begin_time'] > $_SERVER['REQUEST_TIME']){
			$time_array['type'] = 1;
			list($time_array['d'],$time_array['h'],$time_array['m'],$time_array['s']) = explode(' ',date('j H i s',$now_activity['begin_time'] - $_SERVER['REQUEST_TIME']));
		}else{
			$time_array['type'] = 2;
			list($time_array['d'],$time_array['h'],$time_array['m'],$time_array['s']) = explode(' ',date('j H i s',$now_activity['end_time'] - $_SERVER['REQUEST_TIME']));
		}
		$this->assign('time_array',$time_array);
		
		$activity_type = $_GET['type'] ? $_GET['type'] : 'all';
		$activity_area = $_GET['area'] ? $_GET['area'] : 'all';
		
		$where_activity = '';
		if($activity_type != 'all'){
			$where_activity = ' AND `eal`.`type`='.$activity_type;
		}
		//活动商品列表
		$term_id = $now_activity['activity_id'];
		if($activity_area == 'all'){
			$tp_count = D('')->table(array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m'))->where("`eal`.`status`='1' AND `eal`.`activity_term`='$term_id' AND `eal`.`mer_id`=`m`.`mer_id`".$where_activity)->count();
			if($tp_count){
				import('@.ORG.activity_page');
				$P = new Page($tp_count,20,'page');
				$activity_list = D('')->field('`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.*,`m`.*')->table(array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m'))->where("`eal`.`status`='1' AND `eal`.`activity_term`='$term_id' AND `eal`.`mer_id`=`m`.`mer_id`".$where_activity)->order('`eal`.`pigcms_id` DESC')->limit($P->firstRow.','.$P->listRows)->select();
			}
		}else{
			$now_area = D('Area')->get_area_by_areaUrl($activity_area,$activity_type,'activity');
			if(empty($now_area)){
				$this->assign('jumpUrl',$this->config['site_url'].'/activity/');
				$this->error('当前区域不存在');
			}
			$area_id = $now_area['area_id'];
			$tp_count = D('')->field('count(distinct(`eal`.`pigcms_id`)) AS `picms_count`')->table(array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms'))->where("`eal`.`status`='1' AND `eal`.`activity_term`='$term_id' AND `eal`.`mer_id`=`m`.`mer_id` AND `ms`.`area_id`='$area_id' AND `ms`.`mer_id`=`m`.`mer_id`".$where_activity)->find();
			if($tp_count){
				import('@.ORG.activity_page');
				$P = new Page($tp_count['picms_count'],20,'page');
				$activity_list = D('')->field('`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.*,`m`.*')->table(array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms'))->where("`eal`.`status`='1' AND `eal`.`activity_term`='$term_id' AND `eal`.`mer_id`=`m`.`mer_id` AND `ms`.`area_id`='$area_id' AND `ms`.`mer_id`=`m`.`mer_id`".$where_activity)->group('`eal`.`pigcms_id`')->order('`eal`.`pigcms_id` DESC')->limit($P->firstRow.','.$P->listRows)->select();
			}
		}
		if($activity_list){
			$extension_image_class = new extension_image();
			foreach($activity_list as &$value){
				$value['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$value['pic'])),'s');
				$value['url'] = $this->config['site_url'].'/activity/'.$value['pigcms_id'].'.html';
				$value['money'] = floatval($value['money']);
			}
			$this->assign('activity_list',$activity_list);
			$this->assign('pagebar',$P->show());
		}
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		
		//所有区域
		$activity_area_list = D('Area')->get_area_list('',$activity_type,'activity');
		if(empty($activity_type)){
			$all_area_url = $this->config['site_url'].'/activity/';
		}else{
			$all_area_url = $this->config['site_url'].'/activity/'.$activity_type.'/all';
		}
		array_unshift($activity_area_list,array('area_name'=>'全部','area_url'=>'all','url'=>$all_area_url));
		$this->assign('activity_area_list',$activity_area_list);
		$this->assign('activity_type_list',$this->type_list($activity_area));
		
		$this->assign('activity_type',$activity_type);
		$this->assign('activity_area',$activity_area);
		$this->display();
	}
	public function detail(){
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		$database_extension_activity_list = D('Extension_activity_list');
		$condition_extension_activity_list['pigcms_id'] = $_GET['id'];
		$now_activity = $database_extension_activity_list->field(true)->where($condition_extension_activity_list)->find();
		if(empty($now_activity)){
			$this->assign('jumpUrl',$this->config['site_url']);
			$this->error('该活动不存在');
		}
		$extension_image_class = new extension_image();
		$now_activity['all_pic'] = $extension_image_class->get_allImage_by_path($now_activity['pic']);
		$now_activity['info'] = str_replace('<img src="/upload/activity/content/','<img src="'.$this->config['site_url'].'/upload/activity/content/',$now_activity['info']);
		$activity_id = $now_activity['pigcms_id'];
		if($now_activity['part_count']){
			$tmp_part_list = D('')->field('`ear`.`pigcms_id`,`ear`.`time`,`ear`.`msec`,`ear`.`ip`,`ear`.`part_count`,`u`.`nickname`,`u`.`avatar`')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'user'=>'u'))->where("`ear`.`activity_list_id`='$activity_id' AND `ear`.`uid`=`u`.`uid`")->order('`ear`.`pigcms_id` DESC')->select();
			$part_list = $this->convertPartList($tmp_part_list);
			$this->assign('part_list',$part_list);
			// dump($part_list);
			if($this->user_session && D('Extension_activity_record')->where(array('activity_list_id'=>$activity_id,'uid'=>$this->user_session['uid']))){
				$uid = $this->user_session['uid'];
				$tmp_user_part_list = D('')->field('`ear`.`pigcms_id`,`ear`.`time`,`ear`.`msec`,`ear`.`ip`,`ear`.`part_count`,`u`.`nickname`,`u`.`avatar`')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'user'=>'u'))->where("`ear`.`activity_list_id`='$activity_id' AND `ear`.`uid`='$uid' AND `ear`.`uid`=`u`.`uid`")->order('`ear`.`pigcms_id` DESC')->select();
				$user_part_list = $this->convertPartList($tmp_user_part_list);
				$this->assign('user_part_list',$user_part_list);
			}
		}
		$now_activity['money'] = floatval($now_activity['money']);
		$now_activity['lottery_number'] += 10000000;
		$this->assign('now_activity',$now_activity);
		// dump($now_activity);
		//找到该商品所属的活动
		$parent_activity = D('Extension_activity')->field(true)->where(array('activity_id'=>$now_activity['activity_term']))->find();
		$this->assign('parent_activity',$parent_activity);
		
		//推荐两个活动
		$tui_activityList = $database_extension_activity_list->field(true)->where(array('activity_term'=>$now_activity['activity_term'],'status'=>'1','is_finish'=>'0'))->order('RAND()')->limit(2)->select();
		$extension_image_class = new extension_image();
		foreach($tui_activityList as &$value){
			$value['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$value['pic'])),'s');
			$value['url'] = $this->config['site_url'].'/activity/'.$value['pigcms_id'].'.html';
		}
		$this->assign('tui_activityList',$tui_activityList);
		
		$tpl_name = '';
		// dump($now_activity);
		switch($now_activity['type']){
			case '1':
				if($now_activity['is_finish']){
					$activity_id = $now_activity['pigcms_id'];
					
					import('ORG.Net.IpLocation');
					$IpLocation = new IpLocation();
		
					//中奖数值
					$lottery_number_arr = array();
					for($i=0;$i<8;$i++){
						array_push($lottery_number_arr,substr($now_activity['lottery_number'],$i,1));
					}
					$this->assign('lottery_number_arr',$lottery_number_arr);
					//获奖人信息
					$lottery_user = D('User')->field('`uid`,`nickname`,`avatar`,`last_ip`')->where(array('uid'=>$now_activity['lottery_uid']))->find();
					$last_location = $IpLocation->getlocation(long2ip($lottery_user['last_ip']));
					$lottery_user['last_ip_txt'] = iconv('GBK','UTF-8',$last_location['country']);
					$this->assign('lottery_user',$lottery_user);
					//获奖人员所有购买记录
					$uid = $now_activity['lottery_uid'];
					$lottery_part_list = D('')->field('`eyr`.`record_id`,`ear`.`time`,`ear`.`msec`,`eyr`.`number`')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_yiyuanduobao_record'=>'eyr'))->where("`ear`.`activity_list_id`='$activity_id' AND `ear`.`uid`='$uid' AND `eyr`.`record_id`=`ear`.`pigcms_id`")->order('`eyr`.`pigcms_id` DESC')->select();
					shuffle($lottery_part_list);
					$lottery_part_listArr = array();
					foreach($lottery_part_list as &$value){
						$value['number']+= 10000000;
						if(empty($lottery_part_listArr[$value['record_id']])){
							$lottery_part_listArr[$value['record_id']] = array('time'=>$value['time'],'msec'=>$value['msec']);
						}
						$lottery_part_listArr[$value['record_id']]['list'][] = $value;
					}
					$this->assign('lottery_part_list',$lottery_part_list);
					$this->assign('lottery_part_listArr',$lottery_part_listArr);
					
					//当前用户所有购买记录
					if($this->user_session && $user_part_list){
						$uid = $this->user_session['uid'];
						$lottery_user_list = D('')->field('`eyr`.`record_id`,`ear`.`time`,`ear`.`msec`,`eyr`.`number`')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_yiyuanduobao_record'=>'eyr'))->where("`ear`.`activity_list_id`='$activity_id' AND `ear`.`uid`='$uid' AND `eyr`.`record_id`=`ear`.`pigcms_id`")->order('`eyr`.`pigcms_id` DESC')->select();
						shuffle($lottery_user_list);
						$lottery_user_listArr = array();
						foreach($lottery_user_list as &$value){
							$value['number']+= 10000000;
							if(empty($lottery_user_listArr[$value['record_id']])){
								$lottery_user_listArr[$value['record_id']] = array('time'=>$value['time'],'msec'=>$value['msec']);
							}
							$lottery_user_listArr[$value['record_id']]['list'][] = $value;
						}
					}
					$this->assign('lottery_user_list',$lottery_user_list);
					$this->assign('lottery_user_listArr',$lottery_user_listArr);
					
					//购买记录
					$activity_record_list = D('')->field('`ear`.*,`u`.`uid`,`u`.`nickname`')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'user'=>'u'))->where("`ear`.`activity_list_id`='$activity_id' AND `ear`.`uid`=`u`.`uid`")->order('`ear`.`pigcms_id` DESC')->limit(50)->select();
					$allCount = 0;
					foreach($activity_record_list as &$value){
						$tmp_time = date('His',$value['time']).$value['msec'];
						$allCount+=$tmp_time;
						$last_location = $IpLocation->getlocation(long2ip($value['ip']));
						$value['ip_txt'] = iconv('GBK','UTF-8',$last_location['country']);
					}
					$this->assign('activity_record_list',$activity_record_list);
					$this->assign('allCount',$allCount);
					
					$tpl_name = '1yuan_finish';
				}else{
					$tpl_name = '1yuan';
				}
				break;
			default:
				$tpl_name = 'coupon';
		}
		$this->display($tpl_name);
	}
	private function convertPartList($tmp_part_list){
		$part_list = array();
		import('ORG.Net.IpLocation');
		$IpLocation = new IpLocation();
		foreach($tmp_part_list as $value){
			$value['ip'] = long2ip($value['ip']);
			$last_location = $IpLocation->getlocation($value['ip']);
			$value['ip_txt'] = iconv('GBK','UTF-8',$last_location['country']);
			// $value['ip_txt'] = iconv('GBK','UTF-8',$last_location['area']);
			$arrKey = date('Y-m-d',$value['time']);
			if(empty($part_list[$arrKey])){
				$part_list[$arrKey] = array();
			}
			array_push($part_list[$arrKey],$value);
		}
		return $part_list;
	}
	public function submit(){
		header('Content-Type: application/json; charset=utf-8');
		$quantity = intval($_POST['q']);
		if($quantity < 1){
			exit(json_encode(array('status'=>0,'info'=>'最少需要参与1次')));
		}else if($quantity > 200){
			exit(json_encode(array('status'=>0,'info'=>'一次性最多参加200次，请分批次参与')));
		}
		if(empty($this->user_session)){
			exit(json_encode(array('status'=>-3,'info'=>'请先进行登录')));
		}
		$database_extension_activity_list = D('Extension_activity_list');
		$condition_extension_activity_list['pigcms_id'] = $_GET['id'];
		$now_activity = $database_extension_activity_list->field(true)->where($condition_extension_activity_list)->find();
		if(empty($now_activity)){
			exit(json_encode(array('status'=>0,'info'=>'该活动不存在')));
		}
		$surplus_count = $now_activity['all_count']-$now_activity['part_count'];
		if($surplus_count == 0){
			exit(json_encode(array('status'=>-2,'info'=>'该活动已经结束，点击确定按钮 刷新页面！')));
		}
		if($surplus_count < $quantity){
			exit(json_encode(array('status'=>-1,'info'=>'您最多只能参加 '.($surplus_count).' 次','count'=>$surplus_count)));
		}
		$now_activity['money'] = floatval($now_activity['money']);
		
		if(!empty($now_activity['mer_score']) && !in_array($_POST['score_type'],array('1','2'))){
			exit(json_encode(array('status'=>0,'info'=>'该活动是以积分兑换，但是您提交的积分类别有误')));
		}
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			exit(json_encode(array('status'=>0,'info'=>'未获取到您的帐号信息，请重试')));
		}
		if($now_activity['type'] == 1 && !M('User_adress')->where(array('uid'=>$this->user_session['uid']))->find()){
			exit(json_encode(array('status'=>0,'info'=>'您必须在用户中心添加一个收货地址才能进行一元夺宝')));
		}
		
		
		//判断是用钱还是用积分
		if($now_activity['money'] != 0){
			$use_money = $now_activity['money']*$quantity;
			if($now_user['now_money'] < $use_money){
				exit(json_encode(array('status'=>-4,'info'=>'您的帐户余额为 <span>'. $now_user['now_money'].'</span> 元，请先充值帐户余额')));
			}
			$save_result = D('User')->user_money($now_user['uid'],$use_money,'参加一元夺宝活动');
			if($save_result['error_code']){
				exit(json_encode(array('status'=>0,'info'=>$save_result['error_code'])));
			}
		}else{			
			if($_POST['score_type'] == '2'){
				$use_score = $now_activity['mer_score']/$this->config['activity_score_scale']*$quantity;
				if($now_user['score_count'] < $use_score){
					exit(json_encode(array('status'=>0,'info'=>'您的帐户积分为 '. $now_user['score_count'].' ，不足以兑换此奖品')));
				}
				$save_result = D('User')->user_score($now_user['uid'],$use_score,'兑换优惠券');
				if($save_result['error_code']){
					exit(json_encode(array('status'=>0,'info'=>$save_result['error_code'])));
				}
			}else{
				$use_score = $now_activity['mer_score']*$quantity;
				$database_userinfo = D('Userinfo');
				//得到商家积分
				$user_mer_score = $database_userinfo->get_score($now_user['uid'],$now_activity['mer_id']);
				if($user_mer_score < $use_score){
					exit(json_encode(array('status'=>0,'info'=>'您的商家会员卡积分为 '. $user_mer_score.' ，不足以兑换此奖品')));
				}
				$save_result = $database_userinfo->user_score($now_user['uid'],$now_activity['mer_id'],$use_score,'兑换优惠券');
				if($save_result['error_code']){
					exit(json_encode(array('status'=>0,'info'=>$save_result['error_code'])));
				}
			}
		}
		
		$save_ok = false;
		if($database_extension_activity_list->where($condition_extension_activity_list)->setInc('part_count',$quantity)){
			list($usec, $sec) = explode(" ", microtime());
			$msec = floor($usec*1000);
			if($msec < 10){
				$msec = '00'.$msec;
			}if($msec < 100){
				$msec = '0'.$msec;
			}
			$data_extension_activity_record['activity_list_id'] = $now_activity['pigcms_id'];
			$data_extension_activity_record['activity_id'] = $now_activity['activity_term'];
			$data_extension_activity_record['time'] = $sec;
			$data_extension_activity_record['msec'] = $msec;
			$data_extension_activity_record['ip'] = get_client_ip(1);
			$data_extension_activity_record['uid'] = $now_user['uid'];
			$data_extension_activity_record['part_count'] = $quantity;
			$record_id = M('Extension_activity_record')->data($data_extension_activity_record)->add();
			$save_ok = true;
		}
		if($save_ok){
			$result = array();
			switch($now_activity['type']){
				case '1':
					$result = $this->_yiyuanduobao($now_activity,$quantity,$record_id);
					exit(json_encode(array('status'=>1,'info'=>'参与成功')));
					break;
				case '2':
					$result = $this->_coupon($now_activity,$quantity,$record_id);
					exit(json_encode(array('status'=>1,'info'=>'参与成功')));
					break;
			}
		}else{
			exit(json_encode(array('status'=>0,'info'=>'系统发生异常，请联系管理员协助解决')));
		}
		
		$this->error('错误');
	}
	private function _coupon($now_activity,$quantity,$record_id){
		$database_extension_coupon_record = D('Extension_coupon_record');
		$data_all_extension_coupon_record = array();
		$data_extension_coupon_record['record_id'] = $record_id;
		$data_extension_coupon_record['activity_id'] = $now_activity['pigcms_id'];
		for($i=0;$i<$quantity;$i++){
			$coupon_pass_array = array(
				date('y',$_SERVER['REQUEST_TIME']),
				date('m',$_SERVER['REQUEST_TIME']),
				date('d',$_SERVER['REQUEST_TIME']),
				date('H',$_SERVER['REQUEST_TIME']),
				date('i',$_SERVER['REQUEST_TIME']),
				date('s',$_SERVER['REQUEST_TIME']),
				mt_rand(10,99),
				mt_rand(10,99),
			);
			shuffle($coupon_pass_array);
			$data_extension_coupon_record['number'] = implode('',$coupon_pass_array);
			array_push($data_all_extension_coupon_record,$data_extension_coupon_record);
		}
		$database_extension_coupon_record->addAll($data_all_extension_coupon_record);
		
		if($now_activity['all_count'] - $now_activity['part_count'] > $quantity){
			return false;
		}
		//修改结束信息
		D('Extension_activity_list')->where(array('pigcms_id'=>$now_activity['pigcms_id']))->data(array('is_finish'=>'1','finish_time'=>$_SERVER['REQUEST_TIME']))->save();
	}
	private function _yiyuanduobao($now_activity,$quantity,$record_id){
		//此处有三种方法，采用最简单的一种。
		//第一种 按上一次的号码累加
		//第二种 将号码输入号码池里，然后从号码池里取用户购买的数量出来
		//第三种 采用与彩票联合的方式，需要后台计划任务计算开奖时间
		$database_extension_yiyuanduobao_record = D('Extension_yiyuanduobao_record');
		$last_number = $database_extension_yiyuanduobao_record->where(array('activity_id'=>$now_activity['pigcms_id']))->order('`pigcms_id` DESC')->limit(1)->getField('number');

		if(empty($last_number)){
			$last_number = 1;
		}else{
			$last_number++;
		}
		$data_all_extension_yiyuanduobao_record = array();
		$data_extension_yiyuanduobao_record['record_id'] = $record_id;
		$data_extension_yiyuanduobao_record['activity_id'] = $now_activity['pigcms_id'];
		for($i=0;$i<$quantity;$i++){
			$data_extension_yiyuanduobao_record['number'] = $last_number+$i;
			array_push($data_all_extension_yiyuanduobao_record,$data_extension_yiyuanduobao_record);
		}
		$database_extension_yiyuanduobao_record->addAll($data_all_extension_yiyuanduobao_record);
		
		//抽奖
		//取50条最新购买记录进行判断抽奖
		if($now_activity['all_count'] - $now_activity['part_count'] > $quantity){
			return false;
		}
		$database_extension_activity_record = D('Extension_activity_record');
		$condition_extension_activity_record['activity_list_id'] = $now_activity['pigcms_id'];
		$activity_record_list = $database_extension_activity_record->field('`time`,`msec`')->where($condition_extension_activity_record)->order('`pigcms_id` DESC')->limit(50)->select();
		$allCount = 0;
		foreach($activity_record_list as $value){
			$tmp_time = date('His',$value['time']).$value['msec'];
			$allCount+=$tmp_time;
		}
		$lottery_number = fmod($allCount,$now_activity['all_count']);
		//找到数字对应的行
		$now_yiyuan_record = D('Extension_yiyuanduobao_record')->field('`record_id`')->where(array('activity_id'=>$now_activity['pigcms_id'],'number'=>$lottery_number))->find();
		
		//找到数字对应的购买列
		$now_activity_record = $database_extension_activity_record->field('`pigcms_id`,`uid`,`activity_list_id`')->where(array('pigcms_id'=>$now_yiyuan_record['record_id']))->find();
		
		//修改中奖信息
		$database_extension_activity_list = D('Extension_activity_list');
		$database_extension_activity_list->where(array('pigcms_id'=>$now_activity_record['activity_list_id']))->data(array('lottery_id'=>$now_activity_record['pigcms_id'],'lottery_uid'=>$now_activity_record['uid'],'lottery_number'=>$lottery_number,'is_finish'=>'1','finish_time'=>$_SERVER['REQUEST_TIME']))->save();
		$lottery_user = D('User')->field('`openid`,`phone`,`nickname`')->where(array('uid'=>$now_activity_record['uid']))->find();
		
		//模板消息通知、短信通知		
		if ($lottery_user['openid']) {
			$href = $this->config['site_url'].'/wap.php';
			$model = new templateNews($this->config['wechat_appid'],$this->config['wechat_appsecret']);
			$model->sendTempMsg('TM00785', array('href' => $href, 'wecha_id' => $lottery_user['openid'], 'first' => '恭喜您，您中奖了', 'program' => '一元夺宝【'.$now_activity['name'].'】', 'result' => '开奖号码:'.$lottery_number, 'remark' => '请及时上线联系商家进行兑奖！'));
		}
		
		//得到商家信息
		$now_merchant = D('Merchant')->field('`mer_id`,`phone`')->where(array('mer_id'=>$now_activity['mer_id']))->find();
		
		$sms_data = array('mer_id' =>$now_merchant['mer_id'], 'store_id' => 0, 'type' => 'activity');
		$sms_data['uid'] = $lottery_user['uid'];
		$sms_data['mobile'] = $lottery_user['phone'];
		$sms_data['sendto'] = 'user';
		$sms_data['content'] = '您参与的一元夺宝['.$now_activity['name'].']中奖了，幸运号码为：'.$lottery_number.' ，请及时上线联系商家进行兑奖！';
		Sms::sendSms($sms_data);
		
		
		$sms_data['uid'] = $lottery_user['uid'];
		$sms_data['mobile'] = $now_merchant['phone'];
		$sms_data['sendto'] = 'merchant';
		$sms_data['content'] = '您发布的一元夺宝['.$now_activity['name'].']于 '.date('m-d H时',$_SERVER['REQUEST_TIME']).' 出售成功，中奖用户手机号码为：'.$lottery_user['phone'].'，请及时联系用户领取！';
		Sms::sendSms($sms_data);
	}
	public function yiyuan_number(){
		header('Content-Type: application/json; charset=utf-8');
		$database_extension_yiyuanduobao_record = D('Extension_yiyuanduobao_record');
		$condition_extension_yiyuanduobao_record['record_id'] = $_POST['id'];
		$record_list = $database_extension_yiyuanduobao_record->field('`number`')->where($condition_extension_yiyuanduobao_record)->order('`pigcms_id` ASC')->select();
		$returnArr = array();
		// dump($database_extension_yiyuanduobao_record);
		if($record_list){
			foreach($record_list as $value){
				array_push($returnArr,$value['number']+1000000);
			}
			shuffle($returnArr);
			exit(json_encode(array('status'=>1,'number'=>$returnArr)));
		}else{
			exit(json_encode(array('status'=>0,'info'=>'该购买记录没有找到号码')));
		}
	}
	public function coupon_number(){
		header('Content-Type: application/json; charset=utf-8');
		$database_extension_activity_record = D('Extension_activity_record');
		$condition_extension_activity_record['pigcms_id'] = $_POST['id'];
		$now_record = $database_extension_activity_record->field('`pigcms_id`,`uid`')->where($condition_extension_activity_record)->find();
		if($now_record['uid'] != $this->user_session['uid']){
			exit(json_encode(array('status'=>0,'info'=>'该信息不属于您')));
		}
		
		$database_extension_coupon_record = D('Extension_coupon_record');
		$condition_extension_coupon_record['record_id'] = $_POST['id'];
		$record_list = $database_extension_coupon_record->field('`number`')->where($condition_extension_coupon_record)->order('`pigcms_id` ASC')->select();
		$returnArr = array();
		if($record_list){
			foreach($record_list as $value){
				array_push($returnArr,$value['number']);
			}
			exit(json_encode(array('status'=>1,'number'=>$returnArr)));
		}else{
			exit(json_encode(array('status'=>0,'info'=>'该购买记录没有找到号码')));
		}
	}
	/*活动类别*/
	protected function type_list($area_url=''){
		if($area_url){
			return array(
				array('name'=>'全部','type'=>'all','url'=> $this->config['site_url'].'/activity/all/'.$area_url),
				array('name'=>'一元夺宝','type'=>'1','url'=> $this->config['site_url'].'/activity/1/'.$area_url),
				array('name'=>'优惠券','type'=>'2','url'=> $this->config['site_url'].'/activity/2/'.$area_url),
				/* array('name'=>'秒杀','type'=>'3','url'=> $this->config['site_url'].'/activity/3/'.$area_url),
				array('name'=>'红包','type'=>'4','url'=> $this->config['site_url'].'/activity/4/'.$area_url),
				array('name'=>'卡券','type'=>'5','url'=> $this->config['site_url'].'/activity/5/'.$area_url), */
			);
		}else{
			return array(
				array('name'=>'全部','type'=>'all','url'=> $this->config['site_url'].'/activity/all/all'),
				array('name'=>'一元夺宝','type'=>'1','url'=> $this->config['site_url'].'/activity/1/all'),
				array('name'=>'优惠券','type'=>'2','url'=> $this->config['site_url'].'/activity/2/all'),
				/* array('name'=>'秒杀','type'=>'3','url'=> $this->config['site_url'].'/activity/3/all'),
				array('name'=>'红包','type'=>'4','url'=> $this->config['site_url'].'/activity/4/all'),
				array('name'=>'卡券','type'=>'5','url'=> $this->config['site_url'].'/activity/5/all'), */
			);
		}
	}
	protected function type_txt($type){
		switch($type){
			case '1':
				return '一元夺宝';
			case '2':
				return '优惠券';
			case '3':
				return '秒杀';
			case '4':
				return '红包';
			case '5':
				return '卡券';
		}
	}

}
?>