<?php
/*
 * 商户管理
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/07 14:45
 * 
 */

class MerchantAction extends BaseAction{
    public function index(){
		//搜索
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'mer_id'){
				$condition_merchant['mer_id'] = $_GET['keyword'];
			}else if($_GET['searchtype'] == 'account'){
				$condition_merchant['account'] = array('like','%'.$_GET['keyword'].'%');
			}else if($_GET['searchtype'] == 'name'){
				$condition_merchant['name'] = array('like','%'.$_GET['keyword'].'%');
			}else if($_GET['searchtype'] == 'phone'){
				$condition_merchant['phone'] = array('like','%'.$_GET['keyword'].'%');
			}
		}
		if ($this->system_session['area_id']) {
			$condition_merchant['area_id'] = $this->system_session['area_id'];
		}
		$database_merchant = D('Merchant');
		
		$count_merchant = $database_merchant->where($condition_merchant)->count();
		import('@.ORG.system_page');
		$p = new Page($count_merchant,15);
		$merchant_list = $database_merchant->field(true)->where($condition_merchant)->order('`mer_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('merchant_list',$merchant_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
    }
	public function wait_merchant(){
		$condition_merchant['status'] = 2;
		//搜索
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'mer_id'){
				$condition_merchant['mer_id'] = $_GET['keyword'];
			}else if($_GET['searchtype'] == 'account'){
				$condition_merchant['account'] = array('like','%'.$_GET['keyword'].'%');
			}else if($_GET['searchtype'] == 'name'){
				$condition_merchant['name'] = array('like','%'.$_GET['keyword'].'%');
			}else if($_GET['searchtype'] == 'phone'){
				$condition_merchant['phone'] = array('like','%'.$_GET['keyword'].'%');
			}
		}
		if ($this->system_session['area_id']) {
			$condition_merchant['area_id'] = $this->system_session['area_id'];
		}
		$database_merchant = D('Merchant');
		
		$count_merchant = $database_merchant->where($condition_merchant)->count();
		import('@.ORG.system_page');
		$p = new Page($count_merchant,15);
		$merchant_list = $database_merchant->field(true)->where($condition_merchant)->order('`mer_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('merchant_list',$merchant_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
    }
	public function add(){
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function modify(){
		if(IS_POST){
			$_POST['pwd'] = md5($_POST['pwd']);
			$_POST['reg_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['reg_ip'] = get_client_ip(1);
			$_POST['from'] = '1';
			$_POST['area_id'] = $this->system_session['area_id'];
			$database_merchant = D('Merchant');
			if ($database_merchant->field(true)->where(array('account' => htmlspecialchars($_POST['account'])))->find()) {
				$this->error('账号已存在，请更换！');
			}
			if($insert_id=$database_merchant->data($_POST)->add()){
				M('Merchant_score')->add(array('parent_id'=>$insert_id,'type'=>1));
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function edit(){
		$this->assign('bg_color','#F3F3F3');
		
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = intval($_GET['mer_id']);
		$merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($merchant)){
			$this->frame_error_tips('数据库中没有查询到该商户的信息！');
		}
		$this->assign('merchant',$merchant);
		
		$home_share = D('Home_share')->where(array('mer_id' => $condition_merchant['mer_id']))->find();
		$this->assign('home_share', $home_share);
		
		$this->display();
	}
	
	public function amend(){
		if(IS_POST){
			if($_POST['pwd']){
				$_POST['pwd'] = md5($_POST['pwd']);
			}else{
				unset($_POST['pwd']);
			}
			
    		$data['a_href'] = isset($_POST['a_href']) && $_POST['a_href'] ? htmlspecialchars_decode($_POST['a_href']) : $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $_POST['mer_id'];
    		$data['a_name'] = isset($_POST['a_name']) && $_POST['a_name'] ? htmlspecialchars($_POST['a_name']) : '进入';
    		$data['title'] = isset($_POST['a_title']) && $_POST['a_title'] ? htmlspecialchars($_POST['a_title']) : '您是' . $_POST['name'] . '的粉丝';
    		unset($_POST['a_name'], $_POST['a_title'], $_POST['a_href']);
    		
			$database_merchant = D('Merchant');
			$database_merchant->data($_POST)->save();
// 			if(){
			$home_share = D('Home_share')->where(array('mer_id' => $_POST['mer_id']))->find();
			if ($home_share) {
				D('Home_share')->where(array('mer_id' => $_POST['mer_id']))->save($data);
			} else {
				$data['mer_id'] = $_POST['mer_id'];
				D('Home_share')->add($data);
			}
			$this->success('修改成功！');
// 			}else{
// 				$this->error('修改失败！请检查内容是否有过修改（必须修改）后重试~');
// 			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function del(){
		if(IS_POST){
			$database_merchant_store = D('Merchant_store');
			$condition_merchant_store['mer_id'] = intval($_POST['mer_id']);
			if($database_merchant_store->where($condition_merchant_store)->find()){
				$this->error('商家存在店铺，请先清空店铺！');
			}
			$database_merchant = D('Merchant');
			$condition_merchant['mer_id'] = intval($_POST['mer_id']);
			if($database_merchant->where($condition_merchant)->delete()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function merchant_login(){
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $_GET['mer_id'];
		$now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($now_merchant) || $now_merchant['status'] != 1){
			exit('<html><head><script>window.top.toggleMenu(0);window.top.msg(0,"该商户的状态不存在！请查阅。",true,5);window.history.back();</script></head></html>');
		}
		if(!empty($now_merchant['last_ip'])){
			import('ORG.Net.IpLocation');
			$IpLocation = new IpLocation();
			$last_location = $IpLocation->getlocation(long2ip($now_merchant['last_ip']));
			$now_merchant['last']['country'] = iconv('GBK','UTF-8',$last_location['country']);
			$now_merchant['last']['area'] = iconv('GBK','UTF-8',$last_location['area']);
		}
		session('merchant',$now_merchant);
		$script_name = trim($_SERVER['SCRIPT_NAME'],'/');
		if($_GET['group_id']){
			redirect($this->config['site_url'].'/merchant.php?c=Group&a=frame_edit&group_id='.$_GET['group_id'].'&system_file='.$script_name);
		}else if($_GET['activity_id']){
			redirect($this->config['site_url'].'/merchant.php?c=Activity&a=frame_edit&id='.$_GET['activity_id'].'&system_file='.$script_name);
		}else{
			redirect($this->config['site_url'].'/merchant.php');
		}
	}
	/*店铺管理*/
	public function store(){
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = intval($_GET['mer_id']);
		$merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($merchant)){
			$this->error_tips('数据库中没有查询到该商户的信息！',5,U('Merchant/index'));
		}
		$this->assign('merchant',$merchant);
		
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['mer_id'] = $merchant['mer_id'];
		$count_store = $database_merchant_store->where($condition_merchant_store)->count();
		import('@.ORG.system_page');
		$p = new Page($count_store,15);
		$store_list = $database_merchant_store->field(true)->where($condition_merchant_store)->order('`sort` DESC,`store_id` ASC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('store_list',$store_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
	}
	
	public function wait_store(){
		$where = array('status' => 2);
		//搜索
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'store_id'){
				$where['store_id'] = $_GET['keyword'];
			}else if($_GET['searchtype'] == 'name'){
				$where['name'] = array('like','%'.$_GET['keyword'].'%');
			}else if($_GET['searchtype'] == 'phone'){
				$where['phone'] = array('like','%'.$_GET['keyword'].'%');
			}
		}
		if ($this->system_session['area_id']) {
			$where['area_id'] = $this->system_session['area_id'];
		}
		$database = D('Merchant_store');
		$count = $database->where($where)->count();
		import('@.ORG.system_page');
		$p = new Page($count, 15);
		$list = $database->field(true)->where($where)->order('`store_id` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
		$this->assign('store_list', $list);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		
		$this->display();
    }
	public function store_add(){
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = intval($_GET['mer_id']);
		$merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($merchant)){
			$this->frame_error_tips('数据库中没有查询到该商户的信息！无法添加店铺。',5);
		}
		$this->assign('merchant',$merchant);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function store_modify(){
		if(IS_POST){
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['add_from'] = '1';
			$database_merchant_store = D('Merchant_store');
			if($insert_id=$database_merchant_store->data($_POST)->add()){
				M('Merchant_score')->add(array('parent_id'=>$insert_id,'type'=>2));
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	
	public function store_edit(){
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = intval($_GET['store_id']);
		$store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
		if(empty($store)){
			$this->frame_error_tips('数据库中没有查询到该店铺的信息！',5);
		}
		$this->assign('store',$store);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	
	public function store_amend(){
		if(IS_POST){
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$database_merchant_store = D('Merchant_store');
			if($database_merchant_store->data($_POST)->save()){
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！请检查内容是否有过修改（必须修改）后重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function store_del(){
		if(IS_POST){
			$database_group_store = D('Group_store');
			$condition_group_store['store_id'] = intval($_POST['store_id']);
			if($database_group_store->where($condition_group_store)->find()){
				$this->error('该店铺下有'.$this->config['group_alias_name'].'，请先解除店铺与对应'.$this->config['group_alias_name'].'的关系才能删除！');
			}
			
			$database_merchant_store = D('Merchant_store');
			$condition_merchant_store['store_id'] = intval($_POST['store_id']);
			if($database_merchant_store->where($condition_merchant_store)->delete()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	
	/*商户公告*/
	public function news(){
		$database_merchant_news = D('Merchant_news');
		$news_list = $database_merchant_news->order('`is_top` DESC,`add_time` DESC')->select();
		$this->assign('news_list',$news_list);
		
		$this->display();
	}
	public function news_add(){
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function news_modify(){
		$database_merchant_news = D('Merchant_news');
		$_POST['content'] = fulltext_filter($_POST['content']);
		$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
		if($database_merchant_news->data($_POST)->add()){
			$this->success('添加成功！');
		}else{
			$this->error('添加失败！');
		}
	}
	public function news_edit(){
		$database_merchant_news = D('Merchant_news');
		$condition_merchant_news['id'] = $_GET['id'];
		$now_news = $database_merchant_news->field(true)->where($condition_merchant_news)->find();
		if(empty($now_news)){
			$this->frame_error_tips('数据库中没有查询到该条公告！',5);
		}
		$this->assign('now_news',$now_news);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function news_amend(){
		$database_merchant_news = D('Merchant_news');
		$_POST['content'] = fulltext_filter($_POST['content']);
		$_POST['add_time'] = $_SERVER['REQUEST_TIME'];
		if($database_merchant_news->data($_POST)->save()){
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
	
	public function weidian_order(){
		
		$percent = 0;
		$mer_id = isset($_GET['mer_id']) ? intval($_GET['mer_id']) : 0;
		$merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
		if ($merchant['percent']) {
			$percent = $merchant['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('percent', $percent);

		$result = D("Weidian_order")->get_order_by_mer_id($mer_id, 1);
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