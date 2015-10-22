<?php
class LinkAction extends BaseAction
{
	public $modules;

	public function _initialize()
	{
		parent::_initialize();
		$this->modules = array('Home' => '首页', 'AroundGroup' => '附近团购', 'Group' => '团购', 'AroundMeal' => '附近订餐', 'Meal' => '订餐', 'Meal_order' => '订餐订单', 'Group_order' => '团购订单', 'Group_collect' => '团购收藏', 'Card_list' => '我的优惠券', 'Member' => '会员中心', 'Invitation' => '交友', 'Navigation' => '团购导航', 'Activity' => '找活动', 'Classify' => '分类信息', 'Storestaff' => '店员中心', 'NearWeiDian' => '附近微店');
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
			array('module' => 'Home', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Home/index', '', true, false, true)), 'name' => '微站首页', 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => $this->modules['Home'], 'askeyword' => 1),
			array('module' => 'Group', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/index', '', true, false, true)), 'name' => $this->modules['Group'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'AroundGroup', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/around', '', true, false, true)), 'name' => $this->modules['AroundGroup'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Meal', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/index', '', true, false, true)), 'name' => $this->modules['Meal'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'AroundMeal', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Meal_list/around', '', true, false, true)), 'name' => $this->modules['AroundMeal'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Meal_order', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/Meal_order_list', '', true, false, true)), 'name' => $this->modules['Meal_order'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Group_order', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/group_order_list', '', true, false, true)), 'name' => $this->modules['Group_order'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Group_collect', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/group_collect', '', true, false, true)), 'name' => $this->modules['Group_collect'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Card_list', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/card_list', '', true, false, true)), 'name' => $this->modules['Card_list'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Member', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/My/index', '', true, false, true)), 'name' => $this->modules['Member'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Invitation', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Invitation/datelist', '', true, false, true)), 'name' => $this->modules['Invitation'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Navigation', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Group/navigation', '', true, false, true)), 'name' => $this->modules['Navigation'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Activity', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Activity/index', '', true, false, true)), 'name' => $this->modules['Activity'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Classify', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Classify/index', '', true, false, true)), 'name' => $this->modules['Classify'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Storestaff', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Storestaff/index', '', true, false, true)), 'name' => $this->modules['Storestaff'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1)
			);

		if ($this->config['is_open_weidian']) {
			$t[] = array('module' => 'NearWeiDian', 'linkcode' => str_replace('admin.php', 'wap.php', U('Wap/Weidian/near_store_redirect', '', true, false, true)), 'name' => $this->modules['NearWeiDian'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1);
		}

		return $t;
	}
}

?>
