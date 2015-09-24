<?php
class LinkAction extends BaseAction
{
	public $where;
	public $modules;
	public $arr;

	public function _initialize()
	{
		parent::_initialize();
		$this->where = array('token' => $this->token);
		$this->modules = array('Home' => '首页', 'Classify' => '网站分类', 'Group' => '团购', 'Meal' => '订餐', 'Lottery' => '大转盘', 'Guajiang' => '刮刮卡', 'Coupon' => '优惠券', 'Card' => '会员卡', 'GoldenEgg' => '砸金蛋', 'LuckyFruit' => '水果机', 'Article' => '文章', 'Weidian' => '微店');
		$this->arr = array('game', 'Red_packet');
	}

	public function insert()
	{
		$modules = $this->modules();
		$this->assign('modules', $modules);
		$this->display();
	}

	public function keywordModules()
	{
	}

	public function commondetail()
	{
		$sub = (isset($_GET['sub']) ? intval($_GET['sub']) : 1);
		$className = 'FunctionLibrary_' . $this->_get('module');

		if (class_exists($className)) {
			$classInstance = new $className($this->token, $sub);
			$o = $classInstance->index();
			$this->assign('moduleName', $o['name']);
			$fromitems = (intval($_GET['iskeyword']) ? $o['subkeywords'] : $o['sublinks']);
			$items = array();

			if ($fromitems) {
				$i = 0;

				foreach ($fromitems as $item) {
					array_push($items, array('id' => $i, 'name' => $item['name'], 'linkcode' => $item['link'], 'linkurl' => '', 'keyword' => $item['keyword']));
				}
			}
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function modules()
	{
		$t = array(
			array('module' => 'Home', 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Index/index', array('token' => $this->token), true, false, true)), 'name' => '微站首页', 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => $this->modules['Home'], 'askeyword' => 1),
			array('module' => 'Classify', 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Index/lists', array('token' => $this->token), true, false, true)), 'name' => $this->modules['Classify'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 0),
			array('module' => 'Group', 'linkcode' => '', 'name' => $this->modules['Group'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Meal', 'linkcode' => '', 'name' => $this->modules['Meal'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Lottery', 'linkcode' => '', 'name' => $this->modules['Lottery'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Guajiang', 'linkcode' => '', 'name' => $this->modules['Guajiang'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Coupon', 'linkcode' => '', 'name' => $this->modules['Coupon'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Card', 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Card/index', array('token' => $this->token), true, false, true)), 'name' => $this->modules['Card'], 'sub' => 0, 'canselected' => 1, 'linkurl' => '', 'keyword' => '会员卡', 'askeyword' => 1),
			array('module' => 'GoldenEgg', 'linkcode' => '', 'name' => $this->modules['GoldenEgg'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'LuckyFruit', 'linkcode' => '', 'name' => $this->modules['LuckyFruit'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1),
			array('module' => 'Article', 'linkcode' => '', 'name' => $this->modules['Article'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1)
			);

		if ($this->config['is_open_weidian']) {
			array_push($t, array('module' => 'Weidian', 'linkcode' => '', 'name' => $this->modules['Weidian'], 'sub' => 1, 'canselected' => 0, 'linkurl' => '', 'keyword' => '', 'askeyword' => 1));
		}

		return $t;
	}

	public function Weidian()
	{
		$data = array('token' => $this->token, 'type' => 'product,wei_page', 'site_url' => $this->config['site_url']);
		$sort_data = $data;
		$sort_data['salt'] = 'pigcms';
		ksort($sort_data);
		$sign_key = sha1(http_build_query($sort_data));
		$data['sign_key'] = $sign_key;
		$data['request_time'] = time();
		$request_url = 'http://v.meihua.com/api/store.php';
		$resultArr = json_decode($this->curl_post($request_url, $data), true);

		if (!empty($resultArr['error_code'])) {
			$this->error($resultArr['error_msg']);
		}

		if (empty($resultArr['stores'])) {
			$this->error('您的微店没有添加店铺');
		}

		$items = array();

		foreach ($resultArr['stores'] as $item) {
			array_push($items, array('id' => $item['store_id'], 'name' => $item['name'], 'linkcode' => $item['url'], 'linkurl' => '', 'keyword' => $item['name'], 'product_count' => $item['product_count'], 'wei_page_count' => $item['wei_page_count']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('weidian_store_list');
	}

	public function Weidian_page()
	{
		$data = array('token' => $this->token, 'type' => 'wei_page', 'p' => 0 < $_GET['p'] ? $_GET['p'] : 1, 'store_id' => $_GET['id'], 'page_size' => 5, 'site_url' => $this->config['site_url']);
		$sort_data = $data;
		$sort_data['salt'] = 'pigcms';
		ksort($sort_data);
		$sign_key = sha1(http_build_query($sort_data));
		$data['sign_key'] = $sign_key;
		$data['request_time'] = time();
		$request_url = 'http://v.meihua.com/api/store.php';
		$resultArr = json_decode($this->curl_post($request_url, $data), true);

		if (!empty($resultArr['error_code'])) {
			$this->error($resultArr['error_msg']);
		}

		if (empty($resultArr['stores'])) {
			$this->error('您的微店没有添加店铺');
		}

		if (empty($resultArr['stores'][0]['wei_pages'])) {
			$this->error('您的微店没有添加微页面');
		}

		$items = array();

		foreach ($resultArr['stores'][0]['wei_pages'] as $item) {
			array_push($items, array('id' => $item['page_id'], 'name' => $item['name'], 'linkcode' => $item['url'], 'linkurl' => '', 'keyword' => $item['name']));
		}

		$this->assign('list', $items);
		$Page = new Page($resultArr['stores'][0]['wei_page_count'], 5);
		$this->assign('page', $Page->show());
		$this->display('weidian_page_list');
	}

	public function Weidian_product()
	{
		$data = array('token' => $this->token, 'type' => 'product', 'p' => 0 < $_GET['p'] ? $_GET['p'] : 1, 'store_id' => $_GET['id'], 'page_size' => 5, 'site_url' => $this->config['site_url']);
		$sort_data = $data;
		$sort_data['salt'] = 'pigcms';
		ksort($sort_data);
		$sign_key = sha1(http_build_query($sort_data));
		$data['sign_key'] = $sign_key;
		$data['request_time'] = time();
		$request_url = 'http://v.meihua.com/api/store.php';
		$resultArr = json_decode($this->curl_post($request_url, $data), true);

		if (!empty($resultArr['error_code'])) {
			$this->error($resultArr['error_msg']);
		}

		if (empty($resultArr['stores'])) {
			$this->error('您的微店没有添加店铺');
		}

		if (empty($resultArr['stores'][0]['products'])) {
			$this->error('您的微店没有添加商品');
		}

		$items = array();

		foreach ($resultArr['stores'][0]['products'] as $item) {
			array_push($items, array('id' => $item['product_id'], 'name' => $item['name'], 'linkcode' => $item['url'], 'linkurl' => '', 'keyword' => $item['name']));
		}

		$this->assign('list', $items);
		$Page = new Page($resultArr['stores'][0]['product_count'], 5);
		$this->assign('page', $Page->show());
		$this->display('weidian_product_list');
	}

	public function Meal()
	{
		$this->assign('moduleName', $this->modules['Meal']);
		$db = M('Merchant_store');
		$where = array();
		$where['mer_id'] = $this->merchant_session['mer_id'];
		$where['status'] = 1;
		$where['have_meal'] = 1;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('store_id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['store_id'], 'name' => $item['name'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Meal/index', array('token' => $this->token, 'mer_id' => $item['mer_id'], 'store_id' => $item['store_id'], 'otherwc' => 1), true, false, true)), 'linkurl' => '', 'keyword' => $item['name']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function Article()
	{
		$this->assign('moduleName', $this->modules['Article']);
		$db = M('Image_text');
		$where = array();
		$where['mer_id'] = $this->merchant_session['mer_id'];
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('pigcms_id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['pigcms_id'], 'name' => $item['title'], 'linkcode' => $this->config['site_url'] . '/wap.php?g=Wap&c=Article&a=index&imid=' . $item['pigcms_id'], 'linkurl' => '', 'keyword' => $item['title']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function Group()
	{
		$this->assign('moduleName', $this->modules['Group']);
		$db = M('Group');
		$where = array();
		$where['mer_id'] = $this->merchant_session['mer_id'];
		$where['type'] = array('lt', 3);
		$where['end_time'] = array('gt', time());
		$where['begin_time'] = array('lt', time());
		$where['status'] = 1;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('group_id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['group_id'], 'name' => $item['s_name'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Group/detail', array('token' => $this->token, 'mer_id' => $item['mer_id'], 'group_id' => $item['group_id'], 'otherwc' => 1), true, false, true)), 'linkurl' => '', 'keyword' => $item['s_name']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function Classify()
	{
		$pid = (int) $_GET['pid'];
		$this->assign('moduleName', $this->modules['Classify']);
		$db = M('Classify');
		$where = $this->where;

		if ($pid != NULL) {
			$where['fid'] = $pid;
			$count = $db->where($where)->count();
			$Page = new Page($count, 10);
			$show = $Page->show();
			$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		}
		else {
			$where['fid'] = 0;
			$count = $db->where($where)->count();
			$Page = new Page($count, 10);
			$show = $Page->show();
			$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		}

		$items = array();

		foreach ($list as $k => $item) {
			$fid = $item['id'];
			array_push($items, array('id' => $item['id'], 'name' => $item['name'], 'sublink' => U('Merchant/Link/Classify', array('pid' => $item['id'], 'iskeyword' => 0), true, false, true), 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Index/lists', array('token' => $this->token, 'classid' => $item['id']), true, false, true)), 'linkurl' => '', 'keyword' => $item['keyword'], 'sub' => $db->where(array('token' => $this->token, 'fid' => $fid))->field('id,name')->select()));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function Lottery()
	{
		$moduleName = 'Lottery';
		$this->assign('moduleName', $this->modules[$moduleName]);
		$db = M($moduleName);
		$where = $this->where;
		$where['type'] = 1;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Lottery/index', array('token' => $this->token, 'id' => $item['id']), true, false, true)), 'linkurl' => '', 'keyword' => $item['keyword']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function Guajiang()
	{
		$moduleName = 'Guajiang';
		$this->assign('moduleName', $this->modules[$moduleName]);
		$db = M('Lottery');
		$where = $this->where;
		$where['type'] = 2;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Guajiang/index', array('token' => $this->token, 'id' => $item['id']), true, false, true)), 'linkurl' => '', 'keyword' => $item['keyword']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function Coupon()
	{
		$moduleName = 'Coupon';
		$this->assign('moduleName', $this->modules[$moduleName]);
		$db = M('Lottery');
		$where = $this->where;
		$where['type'] = 3;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/Coupon/index', array('token' => $this->token, 'id' => $item['id']), true, false, true)), 'linkurl' => '', 'keyword' => $item['keyword']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function LuckyFruit()
	{
		$moduleName = 'LuckyFruit';
		$this->assign('moduleName', $this->modules[$moduleName]);
		$db = M('Lottery');
		$where = $this->where;
		$where['type'] = 4;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/LuckyFruit/index', array('token' => $this->token, 'id' => $item['id']), true, false, true)), 'linkurl' => '', 'keyword' => $item['keyword']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	public function GoldenEgg()
	{
		$moduleName = 'GoldenEgg';
		$this->assign('moduleName', $this->modules[$moduleName]);
		$db = M('Lottery');
		$where = $this->where;
		$where['type'] = 5;
		$count = $db->where($where)->count();
		$Page = new Page($count, 5);
		$show = $Page->show();
		$list = $db->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order('id DESC')->select();
		$items = array();

		foreach ($list as $item) {
			array_push($items, array('id' => $item['id'], 'name' => $item['title'], 'linkcode' => str_replace('merchant.php', 'wap.php', U('Wap/GoldenEgg/index', array('token' => $this->token, 'id' => $item['id']), true, false, true)), 'linkurl' => '', 'keyword' => $item['keyword']));
		}

		$this->assign('list', $items);
		$this->assign('page', $show);
		$this->display('detail');
	}

	protected function curl_post($url, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		return curl_exec($ch);
	}
}

?>
