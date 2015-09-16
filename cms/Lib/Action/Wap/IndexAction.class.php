<?php
function strExists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
}
class IndexAction extends BaseAction
{
	private $tpl;	//微信公共帐号信息
	private $info;	//分类信息
	public $wecha_id;
	public $copyright;
	public $company;
	//public $token;
	public $weixinUser;
	public $homeInfo;
	
	
	public function __construct()
	{
		parent::__construct();
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($this->token,array('website_hits'=>1));
		
		$homeInfo = M('Home')->where(array('token'=>$this->token))->find();
		$this->homeInfo = $homeInfo;
		$catemenu = M('Catemenu')->where(array('token'=>$this->token,'status'=>1))->order('orderss desc')->select();
		$menures = array();
		if ($catemenu) {
			$res = array();
			$rescount = 0;
			foreach ($catemenu as $val){
				$val['url'] = $this->getLink($val['url']);
				$res[$val['id']] = $val;
				if ($val['fid']==0){
					$val['vo'] = array();
					$menures[$val['id']] = $val;
					$menures[$val['id']]['k'] = $rescount;
					$rescount++;
				}
			}
			foreach ($catemenu as $val) {
				$val['url'] = $this->getLink($val['url']);
				if ($val['fid']>0) {
					array_push($menures[$val['fid']]['vo'],$val);
				}
			}
		}
		$catemenu = $menures;
		$this->bottomeMenus = $catemenu;
		$this->assign('catemenu',$this->bottomeMenus);
		
		//判断菜单风格
		$radiogroup = $homeInfo['radiogroup'];
// 		dump($homeInfo);die;
		if($radiogroup==false){
			$radiogroup=0;
		}
		$cateMenuFileName = 'tpl/Wap/Index/menuStyle'.$radiogroup.'.php';
		$this->assign('cateMenuFileName', $cateMenuFileName);
		$this->assign('radiogroup', $radiogroup);

		
		$this->assign('iscopyright', 1);//是否允许自定义版权
		$this->assign('siteCopyright', C('copyright'));//站点版权信息
		
		$where['token'] = $this->token;
		$tpl = $this->merchant_info;
		$this->weixinUser = $tpl;
		
		//父类信息
		$allClasses = M('Classify')->where(array('token' => $this->token, 'status' => 1))->order('sorts desc')->select();
		$allClasses = $this->convertLinks($allClasses);
		$info = array();
		if ($allClasses) {
			$classByID = array();
			$firstGradeCatCount = 0;
			foreach ($allClasses as $c) {
				$classByID[$c['id']] = $c;
				if ($c['fid']==0) {
					$c['sub'] = array();
					$info[$c['id']] = $c;
					$firstGradeCatCount++;
				}
			}

		
			foreach ($allClasses as $c){
				if ($c['fid']>0&&$info[$c['fid']]){
					array_push($info[$c['fid']]['sub'],$c);
				}
			}
			
			//
			if($info){
			    foreach($info as $c){
				$info[$c['id']]['key']=$firstGradeCatCount--;
				}
			}
		}
		$this->homeInfo['info'] = str_replace(array("\r\n","\"","&quot;"),array(' ','',''),$this->homeInfo['info']);
		$this->info = $info;
		$tpl['color_id'] = intval($tpl['color_id']);
		$merchant = D('Merchant')->field(true)->where(array('mer_id' => $this->token))->find();
		if (empty($tpl['wxname'])) {
			D('Merchant_info')->where(array('token' => $this->token))->save(array('wxname' => $merchant['name']));
		}
		$tpl['wxname'] = $merchant['name'];
		$this->tpl = $tpl;
		if (empty($this->homeInfo['title'])) {
			$this->homeInfo['title'] = $merchant['name'];
		}
		if (empty($this->homeInfo['info'])) {
			$this->homeInfo['info'] = $merchant['txt_info'];
		}
		if (empty($this->homeInfo['picurl'])) {
			if(!empty($merchant['pic_info'])){
				$merchant_image_class = new merchant_image();
				$tmp_pic_arr = explode(';',$merchant['pic_info']);
				foreach($tmp_pic_arr as $key=>$value){
					$this->homeInfo['picurl'] = $merchant_image_class->get_image_by_path($value);
					break;
				}
			}
		}
		$this->assign('homeInfo', $this->homeInfo);

		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->token, 'biz_id' => $this->homeInfo['id']));
	}
	
	public function classify()
	{
		$this->assign('info', $this->info);
		$this->display($this->tpl['tpltypename']);
	}
	
	public function index()
	{
		$where['token'] = $this->token;
		//
		$allflash = M('Flash')->where($where)->order('id DESC')->select();
		$allflash = $this->convertLinks($allflash);
		if($allflash == NULL){
			$allflash = array(
					array(
							"info" => "广告位描述",
							"img" => "/tpl/Wap/static/images/tour/4.jpg",
							"url" => "",
							"tip" => 1
					),
					array(
							"info" => "广告位描述",
							"img" => "/tpl/Wap/static/images/tour/3.jpg",
							"url" => "",
							"tip" => 1
					)
			);
		}
// 		dump($allflash);
		//
		$flash = array();
		$flashbg = array();
		foreach ($allflash as $af) {
			if ($af['url'] == '') {
				$af['url']='javascript:void(0)';
			}
			if ($af['tip'] == 1) {
				array_push($flash, $af);
			} elseif ($af['tip'] == 2) {
				array_push($flashbg, $af);
			}
		}
		$this->assign('flashbg', $flashbg);
		if (!$flashbg && $this->homeInfo['homeurl']) {
			$flash_db = M('Flash');
			$arr = array();
			$arr['token'] = $this->token;
			$arr['img'] = $this->homeInfo['homeurl'];
			$arr['url'] = '';
			$arr['info'] = '';
			$arr['tip'] = 2;
			if ($arr['img']) {
				$flash_db->add($arr);
			}
		}
		$info = $this->info;
		
		//$info = $this->convertLinks($info);
		$tpldata = $this->merchant_info;
		$tpldata['color_id']=intval($tpldata['color_id']);
		//获取模板信息
		include('./cms/Lib/ORG/index.Tpl.php');

		foreach ($tpl as $k=>$v) {
			if ($v['tpltypeid'] == $tpldata['tpltypeid']) {
				$tplinfo = $v;
			}
		}
			
		$tpldata['tpltypeid'] = $tplinfo['tpltypeid'];
		$tpldata['tpltypename'] = $tplinfo['tpltypename'];		
	
		foreach ($info as $k=>$v) {
		
			if ($info[$k]['url'] == '') {
				$info[$k]['url'] = U('Index/lists',array('classid' => $v['id'],'token' => $where['token']));
			}
			//解决二级分类
			if($v['sub'] != NULL){
				foreach($v['sub'] as $ke=>$va){
					if($v['sub'][$ke]['url'] == ''){
						$info[$k]['sub'][$ke]['url'] = U('Index/lists',array('classid'=>$v['sub'][$ke]['id'],'token'=>$where['token']));
					}
				}
			}
			
		}
			
		if ($tpldata['tpltypename'] == 'ktv_list' || $tpldata['tpltypename'] == 'yl_list') {
			//控制模板中的不同字段
			foreach($info as $key=>$val){
				$info[$key]['title'] = $val['name'];
				$info[$key]['pic'] = $val['img'];
				if($info[$key]['url'] == ''){
					$info[$key]['url'] = U('Index/lists', array('classid' => $val['id'],'token' => $where['token']));
				}
				
				$info[$key]['info'] = strip_tags(htmlspecialchars_decode($val['info']));
			}
		}
		if (empty($info)) {
			//$info = array(array('url' => '', 'name' => '', 'info' => ''));
			//1.看商家支持订餐还是团购
			$stores = D("Merchant_store")->field(true)->where(array('mer_id' => $this->token,  'status' => 1))->select();

			$store_image_class = new store_image();
			
			foreach ($stores as $store) {
				if ($store['have_meal']) {
					$images = $store_image_class->get_allImage_by_path($store['pic_info']);
					$img = array_shift($images);
					$info[] = array('url' => U('Meal/menu', array('mer_id' => $store['mer_id'], 'store_id' => $store['store_id'])), 'name' => $store['name'], 'info' => $store['txt_info'], 'img' => $img);
				}
			}
			$groups = D("Group")->field(true)->where(array('mer_id' => $this->token, 'begin_time' => array('lt', time()), 'end_time' => array('gt', time()), 'status' => 1))->select();
			$group_image_class = new group_image();
			foreach ($groups as $group) {
				$tmp_pic_arr = explode(';',$group['pic']);
				$img = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$info[] = array('url' => U('Group/detail', array('group_id' => $group['group_id'])), 'name' => $group['s_name'], 'info' => $group['name'], 'img' => $img);
			}
			//2.会员卡
			$card = D("Member_card_set")->field(true)->where(array('token' => $this->token))->limit("0,1")->find();
			if ($card) {
				$info[] = array('url' => U('Card/index', array('token' => $this->token)), 'name' => $card['cardname'], 'info' => $card['msg'], 'img' => $this->config['site_url'] . $card['logo']);
			}
			//3.活动
			$lotterys = D("Lottery")->field(true)->where(array('token' => $this->token, 'statdate' => array('lt', time()), 'enddate' => array('gt', time())))->select();
			foreach ($lotterys as $lottery) {
				
				switch ($lottery['type']){
					case 1:
						$info[] = array('url' => U('Lottery/index', array('token' => $this->token, 'id' => $lottery['id'])), 'name' => $lottery['title'], 'info' => $lottery['info'], 'img' => $lottery['starpicurl']);
						break;
					case 2:
						$info[] = array('url' => U('Guajiang/index', array('token' => $this->token, 'id' => $lottery['id'])), 'name' => $lottery['title'], 'info' => $lottery['info'], 'img' => $lottery['starpicurl']);
						break;
					case 3:
						$info[] = array('url' => U('Coupon/index', array('token' => $this->token, 'id' => $lottery['id'])), 'name' => $lottery['title'], 'info' => $lottery['info'], 'img' => $lottery['starpicurl']);
						break;
					case 4:
						$info[] = array('url' => U('LuckyFruit/index', array('token' => $this->token, 'id' => $lottery['id'])), 'name' => $lottery['title'], 'info' => $lottery['info'], 'img' => $lottery['starpicurl']);
						break;
					case 5:
						$info[] = array('url' => U('GoldenEgg/index', array('token' => $this->token, 'id' => $lottery['id'])), 'name' => $lottery['title'], 'info' => $lottery['info'], 'img' => $lottery['starpicurl']);
						break;
				}
			}
		}
		if (empty($info)) {
			$info[] = array('url' => '', 'name' => '商家餐饮店铺', 'info' => '描述店铺简介', 'img' => '/tpl/Wap/static/images/tour/meal.jpg');
			$info[] = array('url' => '', 'name' => '商家发布的'.$this->config['group_alias_name'], 'info' => '描述'.$this->config['group_alias_name'].'内容', 'img' => '/tpl/Wap/static/images/tour/group.jpg');
			$info[] = array('url' => '', 'name' => '商家创建的会员卡', 'info' => '描述会员卡详情', 'img' => '/tpl/Wap/static/images/tour/card.png');
			$info[] = array('url' => '', 'name' => '商家发布的促销活动', 'info' => '介绍活动内容', 'img' => '/tpl/Wap/static/images/tour/lottery.jpg');
		}
		
		D('Merchant')->where(array('mer_id' => $this->token))->setInc('hits', 1);
		$count = count($flash);
		$this->assign('flash', $flash);
		$this->assign('homeInfo', $this->homeInfo);
		$this->assign('info',$info);
		$this->assign('num', $count);
		$this->assign('flashbgcount', count($flashbg));
		$this->assign('tpl', $this->tpl);
		$this->assign('copyright', $this->copyright);
		$this->display($this->tpl['tpltypename']);
	}
	
	public function lists()
	{
		$classid = $this->_get('classid','intval');	
		$where['token'] = $this->token;
		$classify = M('classify');
		
		$homes = M('Home')->where(array('token' => $this->token))->getField('gzhurl');
		$this->assign('homes', $homes);
		//本分类信息		
		$info = $classify->where("id = $classid AND token = '$this->token'")->find();		
		//是否有子类
		$sub = $classify->where("fid = $classid AND token = '$this->token' AND status = 1")->order('sorts desc')->select();
		$sub = $this->convertLinks($sub);
		$tpldata = D('Merchant_info')->where($where)->find();
		$tpldata['color_id'] = intval($tpldata['color_id']);
		
		//获取模板信息
		include('./cms/Lib/ORG/index.Tpl.php');
		foreach ($tpl as $k => $v) {
			if ($v['tpltypeid'] == $info['tpid']) {
				$tplinfo = $v;					
			}
		}
		$tpldata['tpltypeid'] = $tplinfo['tpltypeid'];
		$tpldata['tpltypename'] = $tplinfo['tpltypename'];
		$imgdata = M('Image_text')->field('pigcms_id')->where("classid = $classid")->find();
		if(!empty($sub) AND empty($imgdata)){
			//幻灯片
			$allflash = M('Flash')->where($where)->order('id DESC')->select();
			$allflash = $this->convertLinks($allflash);
			$flashbg = $flash = array();
			foreach ($allflash as $af) {
				if ($af['url'] == '') {
					$af['url'] = 'javascript:void(0)';
				}
				if (!empty($classid)) {					
					if ($af['tip'] == 3 && $af['did'] == $classid) {
						array_push($flash, $af);
					} elseif ($af['tip'] == 4 && $af['did'] == $classid) {
						array_push($flashbg, $af);
					}
				} else {
					if ($af['tip'] == 1) {
						array_push($flash, $af);
					} elseif ($af['tip'] == 2) {
						array_push($flashbg, $af);
					}
				}
			}
			if (empty($flash)) {
				foreach($allflash as $af){
					if ($af['url'] == '') {
						$af['url'] = 'javascript:void(0)';
					}
					if ($af['tip'] == 1) {
						array_push($flash, $af);
					}
				}
			}
			$this->assign('flashbg', $flashbg);
			if (!$flashbg && $this->homeInfo['homeurl']) {
				$flash_db = M('Flash');
				$arr = array();
				$arr['token'] = $this->token;
				$arr['img'] = $this->homeInfo['homeurl'];
				$arr['url'] = '';
				$arr['info'] = '';
				$arr['tip'] = 2;
				if ($arr['img']) {
					$flash_db->add($arr);
				}
			}
			if ($tpldata['tpltypename'] == 'ktv_list' || $tpldata['tpltypename'] == 'yl_list') {
				//控制模板中的不同字段
				foreach ($sub as $key => $val) {
					$sub[$key]['title'] = $val['name'];
					$sub[$key]['pic'] = $val['img'];
					if ($sub[$key]['url'] == '') {
						$sub[$key]['url'] = U('Index/lists',array('classid' => $val['id'], 'token' => $where['token']));
					}
					$sub[$key]['info'] = strip_tags(htmlspecialchars_decode($val['info']));
				}
			}
			
			$j = count($sub);
			foreach ($sub as $ke => $va) {
				$subpid = $va['id'];
				$sub[$ke]['sub'] = M('Classify')->where("fid = $subpid")->order('sorts desc')->select();
				$sub[$ke]['sub'] = $this->convertLinks($sub[$ke]['sub']);
				if ($sub[$ke]['url'] == '') {
					$sub[$ke]['url'] = U('Index/lists',array('classid' => $va['id'],'token' => $where['token']));
					$sub[$ke]['sub'] = $this->convertLinks($sub[$ke]['sub']);
				}
				$sub[$ke]['key'] = $j--;
			}
			
			$count = count($flash);
			$this->assign('flash', $flash);
			$this->assign('num', $count);
			$this->assign('flashbgcount', count($flashbg));
			$this->assign('info', $sub);
			$this->assign('thisClassInfo', $info);
			$this->assign('tpl', $tpldata);
			$this->assign('copyright', $this->copyright);
			$this->display($tpldata['tpltypename']);
		} else {
			//无子类 在模板中显示内容列表
			$where['token'] = $this->token;
			$where['classid'] = $this->_get('classid','intval');
			$db = D('Image_text');
			$res = $db->where($where)->order('pigcms_id DESC')->select();
			$res = $this->convertLinks($res);
			//控制模板中的不同字段
			foreach ($res as $key => $val) {
				$res[$key]['id'] = $val['pigcms_id'];
				$res[$key]['name'] = $val['title'];
				$res[$key]['img'] = $val['cover_pic'];
				if ($res[$key]['url'] == '') {
					$res[$key]['url'] = U('Index/content',array('id'=>$val['pigcms_id'],'classid'=>$val['classid'],'token' => $this->token));
				}
				$res[$key]['info'] = strip_tags(htmlspecialchars_decode(mb_substr($val['digest'],0,10,'utf-8')));
			}
			//当列表页只有一篇内容,直接显示内容
			$listNum = count($res);
			if ($listNum == 1) {
				$contid = $res[0]['id'];
				$cid = $res[0]['classid'];
				$this->content($contid, $cid);
				exit;
			}
			//幻灯片
			$allflash = M('Flash')->where($where)->order('id DESC')->select();
			$allflash = $this->convertLinks($allflash);
			$flashbg = $flash = array();
			foreach ($allflash as $af) {
				if ($af['url'] == '') {
					$af['url'] = 'javascript:void(0)';
				}
				if (!empty($classid)) {					
					if ($af['tip'] == 3 && $af['did'] == $classid){
						array_push($flash, $af);
					} elseif ($af['tip'] == 4 && $af['did'] == $classid) {
						array_push($flashbg, $af);
					}
				} else {
					if ($af['tip'] == 1) {
						array_push($flash, $af);
					} elseif ($af['tip'] == 2) {
						array_push($flashbg, $af);
					}
				}
			}

			if (empty($flash)) {
				foreach ($allflash as $af) {
					if ($af['url'] == ''){
						$af['url'] = 'javascript:void(0)';
					}
					if ($af['tip'] == 1) {
						array_push($flash, $af);
					}
				}
			}

			$this->assign('flashbg', $flashbg);
			if (!$flashbg && $this->homeInfo['homeurl']) {
				$flash_db = M('Flash');
				$arr = array();
				$arr['token'] = $this->token;
				$arr['img'] = $this->homeInfo['homeurl'];
				$arr['url'] = '';
				$arr['info'] = '';
				$arr['tip'] = 2;
				if ($arr['img']) {
					$flash_db->add($arr);
				}
			}
			$count=count($flash);
			$this->assign('flash', $flash);
			$this->assign('num', $count);
			$this->assign('flashbgcount', count($flashbg));
			$this->assign('info',$res);
			$this->assign('tpl',$tpldata);
			$this->assign('copyright',$this->copyright);
			$this->assign('thisClassInfo',$info);
			$this->display($tpldata['tpltypename']);	

		}
	}

	public function content($contid = '', $cid = '')
	{
		$class = M('Classify');
		$img = M('Image_text');	
		//从模板直接浏览，或在列表方法中调用
		if($contid == '' && $cid == ''){
			$id = $this->_get('id','intval');
			$classid = $this->_get('classid','intval');
		} else {
			$id = intval($contid);
			$classid = intval($cid);
		}

		$homes = M('Home')->where(array('token' => $this->token))->getField('gzhurl');
		$this->assign('homes', $homes);
		$res = $img->where("pigcms_id = ".intval($id)." AND mer_id = '$this->token'")->find();
		$res['info'] = $res['content'];
		$res['text'] = $res['digest'];
		$res['pic'] = $this->config['site_url'] . $res['cover_pic'];
		$res['createtime'] = $res['dateline'];
		$res['showpic'] = $res['is_show'];
		$res['writer'] = $res['author'];
		if ($classid == '') {
			$classid = $res['classid'];
		}
		//增加浏览量
		
// 		$img->where("token = '$token' AND pigcms_id = ".intval($id))->setInc('click');

		$classinfo = $class->where("id = ".intval($classid)." AND token = '$this->token'")->field('conttpid')->find();
		$tplinfo = D('Merchant_info')->where("token = '$this->token'")->find();
		//获取模板
		include('./cms/Lib/ORG/cont.Tpl.php');
		foreach ($contTpl as $k => $v) {
			if ($v['tpltypeid'] == $classinfo['conttpid']) {
				$tpldata = $v;
			}
		}
		$tplinfo['tpltypeid'] = $tpldata['tpltypeid'];
		$tplinfo['tpltypename'] = $tpldata['tpltypename'];
		$lists = $img->where("classid = ".intval($classid)." AND token = '$this->token' AND id != ".intval($id))->limit(5)->order('uptatetime')->select();
		$lists = $this->convertLinks($lists);
		$this->assign('info',$this->info);			//分类信息
		$this->assign('copyright',$this->copyright);	//版权是否显示		
		$this->assign('res',$res);
		$this->assign('lists',$lists);
		$this->assign('tpl',$tplinfo);
		$this->display($tplinfo['tpltypename'] ? $tplinfo['tpltypename'] : 'content');
	}
	
	public function flash(){
		$where['token']=$this->_get('token','trim');
		$flash=M('Flash')->where($where)->select();
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->display('ty_index');
	}
	/**
	 * 获取链接
	 *
	 * @param unknown_type $url
	 * @return unknown
	 */
	public function getLink($url){
		$url=$url?$url:'javascript:void(0)';
		$urlArr=explode(' ',$url);
		$urlInfoCount=count($urlArr);
		if ($urlInfoCount>1){
			$itemid=intval($urlArr[1]);
		}
		//会员卡 刮刮卡 团购 商城 大转盘 优惠券 订餐 商家订单 表单
		if (strExists($url,'刮刮卡')){
			$link = U('Wap/Guajiang/index', array('token' => $this->token));//'/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'大转盘')){
			$link = U('Wap/Lottery/index', array('token' => $this->token));//='/index.php?g=Wap&m=Lottery&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'优惠券')){
			$link = U('Wap/Coupon/index', array('token' => $this->token));//='/index.php?g=Wap&m=Coupon&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'砸金蛋')){
			$link = U('Wap/GoldenEgg/index', array('token' => $this->token));//='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'水果机')){
			$link = U('Wap/LuckyFruit/index', array('token' => $this->token));//='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,$this->config['meal_alias_name'])){
			$link = U('Wap/Meal/index', array('token' => $this->token));//='/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,$this->config['group_alias_name'])){
			$link = U('Wap/Group/index', array('token' => $this->token));//='/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'首页')){
			$link = U('Wap/Index/index', array('token' => $this->token));//='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'网站分类')){
			$link = U('Wap/Index/lists', array('token' => $this->token));//='/index.php?g=Wap&m=Index&a=lists&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link = U('Wap/Index/lists', array('token' => $this->token, 'classid' => $itemid));//='/index.php?g=Wap&m=Index&a=lists&token='.$this->token.'&wecha_id='.$this->wecha_id.'&classid='.$itemid;
			}
		}elseif (strExists($url,'图文回复')){
			if ($itemid){
				$link = U('Wap/Index/index', array('token' => $this->token));//='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'LBS信息')){
			$link = U('Wap/Company/map', array('token' => $this->token));//='/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link = U('Wap/Company/map', array('token' => $this->token, 'companyid' => $itemid));//='/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id.'&companyid='.$itemid;
			}
		}elseif (strExists($url,'DIY宣传页')){
			//$link = U('Wap/Guanjiang/index', array('token' => $this->token, 'wecha_id' => $this->wecha_id));//='/index.php/show/'.$this->token;
		}elseif (strExists($url,'婚庆喜帖')){
			if ($itemid){
				$link = U('Wap/Wedding/index', array('token' => $this->token, 'wecha_id' => $this->wecha_id));//='/index.php?g=Wap&m=Wedding&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'投票')){
			if ($itemid){
				$link = U('Wap/Vote/index', array('token' => $this->token, 'wecha_id' => $this->wecha_id));//='/index.php?g=Wap&m=Vote&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}else {
			$link=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->wecha_id,$this->siteUrl,'&'),$url);
// 			if (!!(strpos($url,'tel')===false)&&$url!='javascript:void(0)'&&!strpos($url,'wecha_id=')){
// 				if (strpos($url,'?')){
// 					$link=$link.'&wecha_id='.$this->wecha_id;
// 				}else {
// 					$link=$link.'?wecha_id='.$this->wecha_id;
// 				}
// 			}
			
		}
		return $link;
	}
	public function convertLinks($arr){
		$i=0;
		foreach ($arr as $a){
			if ($a['url']){
				$arr[$i]['url']=$this->getLink($a['url']);
			}
			$i++;
		}
		return $arr;
	}
	public function _getPlugMenu(){
		$company_db=M('company');
		$this->company=$company_db->where(array('token'=>$this->token,'isbranch'=>0))->find();
		$plugmenu_db=M('site_plugmenu');
		$plugmenus=$plugmenu_db->where(array('token'=>$this->token,'display'=>1))->order('taxis ASC')->limit('0,4')->select();
		if ($plugmenus){
			$i=0;
			foreach ($plugmenus as $pm){
				switch ($pm['name']){
					case 'tel':
						if (!$pm['url']){
							$pm['url']='tel:/'.$this->company['tel'];
						}else {
							$pm['url']='tel:/'.$pm['url'];
						}
						break;
					case 'memberinfo':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Wap&m=Userinfo&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'nav':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'message':
						break;
					case 'share':
						break;
					case 'home':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'album':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Wap&m=Photo&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'email':
						$pm['url']='mailto:'.$pm['url'];
						break;
					case 'shopping':
						if (!$pm['url']){
							$pm['url']='/index.php?g=Wap&m=Product&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
						}
						break;
					case 'membercard':
						$card=M('member_card_create')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
						if (!$pm['url']){
							if($card==false){
								$pm['url']=rtrim($this->siteUrl,'/').U('Wap/Card/index',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
							}else{
								$pm['url']=rtrim($this->siteUrl,'/').U('Wap/Card/index',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
							}
						}
						break;
					case 'activity':
						$pm['url']=$this->getLink($pm['url']);
						break;
					case 'weibo':
						break;
					case 'tencentweibo':
						break;
					case 'qqzone':
						break;
					case 'wechat':
						$pm['url']='weixin://addfriend/'.$this->weixinUser['wxid'];
						break;
					case 'music':
						break;
					case 'video':
						break;
					case 'recommend':
						$pm['url']=$this->getLink($pm['url']);
						break;
					case 'other':
						$pm['url']=$this->getLink($pm['url']);
						break;
				}
				$plugmenus[$i]=$pm;
				$i++;
			}
			
		}else {//默认的
			$plugmenus=array();
			/*
			$plugmenus=array(
			array('name'=>'home','url'=>'/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id),
			array('name'=>'nav','url'=>'/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id),
			array('name'=>'tel','url'=>'tel:'.$this->company['tel']),
			array('name'=>'share','url'=>''),
			);
			*/
		}
		return $plugmenus;
	}
}

