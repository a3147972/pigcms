<?php
class LinkAction extends BaseAction
{
	public $modules;
	
	public function _initialize() 
	{
		parent::_initialize();
		
		$this->modules = array(
								'Home' => '首页', 
								'AroundGroup' => '附近'.$this->config['group_alias_name'], 
								'Group' => $this->config['group_alias_name'], 
								'AroundMeal' => '附近'.$this->config['meal_alias_name'], 
								'Meal' => $this->config['meal_alias_name'], 
								'Meal_order' => $this->config['meal_alias_name'].'订单', 
								'Group_order' => $this->config['group_alias_name'].'订单', 
								'Group_collect' => $this->config['group_alias_name'].'收藏', 
								'Card_list' => '我的优惠券', 
								'Member' => '会员中心', 
								'Invitation' => '交友',
								'Navigation' => $this->config['group_alias_name'].'导航',
// 								'Activity_1' => '热门活动（大转盘）',
// 								'Activity_2' => '热门活动（刮刮卡）',
// 								'Activity_4' => '热门活动（水果机）',
// 								'Activity_5' => '热门活动（砸金蛋）',
								'Activity' => '找活动',
								'Classify' => '分类信息',
								'Storestaff' => '店员中心',
								'NearWeiDian' => '附近微店',
								'Takeout' => '外卖',
								'NearMerchant' => '附近商家',
								'Lifeservice' => '生活缴费',
							);
	}
	public function insert()
	{
		$modules = $this->modules();
		$this->assign('modules', $modules);
		$this->display();
	}
	public function modules()
	{
		$t = array(
		array('module' => 'Home', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Home/index', '', true, false, true)), 'name'=>'微站首页','sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>$this->modules['Home'],'askeyword'=>1),
		array('module' => 'Group', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/index', '', true, false, true)),'name'=>$this->modules['Group'],'sub'=>1,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'AroundGroup', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/around', '', true, false, true)),'name'=>$this->modules['AroundGroup'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Meal', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/index', '', true, false, true)),'name'=>$this->modules['Meal'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'AroundMeal', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/around', '', true, false, true)),'name'=>$this->modules['AroundMeal'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Meal_order', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/Meal_order_list', '', true, false, true)),'name'=>$this->modules['Meal_order'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Group_order', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/group_order_list', '', true, false, true)),'name'=>$this->modules['Group_order'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Group_collect', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/group_collect', '', true, false, true)),'name'=>$this->modules['Group_collect'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Card_list', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/card_list', '', true, false, true)),'name'=>$this->modules['Card_list'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Member', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/index', '', true, false, true)),'name'=>$this->modules['Member'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Invitation', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Invitation/datelist', '', true, false, true)),'name'=>$this->modules['Invitation'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Navigation', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/navigation', '', true, false, true)),'name'=>$this->modules['Navigation'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_1', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 1), true, false, true)),'name'=>$this->modules['Activity_1'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_2', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 2), true, false, true)),'name'=>$this->modules['Activity_2'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_4', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 4), true, false, true)),'name'=>$this->modules['Activity_4'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
// 		array('module' => 'Activity_5', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', array('type' => 5), true, false, true)),'name'=>$this->modules['Activity_5'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Activity', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', '', true, false, true)),'name'=>$this->modules['Activity'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Classify', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Classify/index', '', true, false, true)),'name'=>$this->modules['Classify'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Storestaff', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Storestaff/index', '', true, false, true)),'name'=>$this->modules['Storestaff'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Takeout', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Takeout/index', '', true, false, true)),'name'=>$this->modules['Takeout'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'NearMerchant', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Merchant/around', '', true, false, true)),'name'=>$this->modules['NearMerchant'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		array('module' => 'Lifeservice', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Lifeservice/index', '', true, false, true)),'name'=>$this->modules['Lifeservice'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1),
		);
		
		if ($this->config['is_open_weidian']) {
			$t[] = array('module' => 'NearWeiDian', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Weidian/near_store_redirect', '', true, false, true)),'name'=>$this->modules['NearWeiDian'],'sub'=>0,'canselected'=>1,'linkurl'=>'','keyword'=>'','askeyword'=>1);
		}
		
		return $t;
	}
	
	public function Group()
	{
		$this->assign('moduleName', $this->modules['Group']);
		$cat_fid = isset($_GET['cat_fid']) ? intval($_GET['cat_fid']) : 0;
		$where = array('cat_fid' => $cat_fid);
		$db = D('Group_category');
		$count      = $db->where($where)->count();
		$Page       = new Page($count, 5);
		$show       = $Page->show();
		
		$list = $db->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$items = array();
		foreach ($list as $item){
			if ($db->where(array('cat_fid' => $item['cat_id']))->find()) {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 1, 'name' => $item['cat_name'], 'linkcode'=> str_replace('admin.php', 'wap.php', U('Wap/Group/index', array('cat_url' => $item['cat_url']), true, false, true)),'sublink' => U('Link/group', array('cat_fid' => $item['cat_id']), true, false, true),'keyword' => $item['cat_name']));
			} else {
				array_push($items, array('id' => $item['cat_id'], 'sub' => 0, 'name' => $item['cat_name'], 'linkcode'=> str_replace('admin.php', 'wap.php', U('Wap/Group/index', array('cat_url' => $item['cat_url']), true, false, true)),'sublink' => '','keyword' => $item['cat_name']));
			}
		}
		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}
}
?>