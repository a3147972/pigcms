<?php

/*
 * 商家中心前台控制器
 *
 * @  Writers    LiHongShun
 * @  BuildTime  2015/06/5
 * 
 */

class MerchantAction extends BaseAction {

    public $merid = 0;
    public $merchantDb = null;
    public $merchant_store_Db = null;
    public $merchant_store_data = null;
	public $uid = 0;
    protected function _initialize() {
        parent::_initialize();
        //print_r($_SERVER);
        $this->merid = isset($_GET['merid']) ? intval($_GET['merid']) : 0;
        if (!($this->merid > 0)) {
            $this->error_tips('商家ID不存在！',$this->config['site_url']);
        }
        $this->merchant_store_Db = D('Merchant_store');
        $merchant_mstore = $this->merchant_store_Db->where(array('mer_id' => $this->merid, 'ismain' => 1,'status'=>1))->find();
        if (empty($merchant_mstore)) {
            $this->error_tips('没有设置主店铺，请设置一个主店铺！',$this->config['site_url']);
        }
        $navmanag = D('Merchant_navcom')->where('22=22')->order('navid ASC')->select();
        $navtmp = array();
        $isindex = true;
        foreach ($navmanag as $nmvv) {
            if (($nmvv['url'] == 'mergoods') && ($merchant_mstore['have_meal'] != 1))
                continue; /*                 * 没有开通订餐去掉导航* */
			if (($nmvv['url'] == 'meractivity') && ($merchant_mstore['have_group'] != 1))
                continue; /*                 * 没有团购去掉导航* */
            if (strpos($_SERVER['REQUEST_URI'], $nmvv['url']) !== false) {
                $nmvv['currenturl'] = true;
                $isindex = false;
            } else {
                $nmvv['currenturl'] = false;
            }
            $navtmp[$nmvv['navid']] = $nmvv;
        }
        if (strpos($_SERVER['REQUEST_URI'], 'newsdetail') !== false) {
            $navtmp[2]['currenturl'] = true;
            $isindex = false;
        }
        $navset = D('Merchant_navset')->where(array('mer_id' => $this->merid))->select();
        if (!empty($navset)) {
            foreach ($navset as $vv) {
                $navtmp[$vv['navid']]['isshow'] = $vv['isshow'];
				!empty($vv['zhname']) && $navtmp[$vv['navid']]['zhname'] = $vv['zhname'];
                if ($vv['isshow'] == 0)
                    unset($navtmp[$vv['navid']]);
            }
        }
        unset($navmanag, $navset);
        $this->merchantDb = D("Merchant");
        $area = D("area")->where(array('area_id' => $merchant_mstore['area_id']))->find();
        $merchant_mstore['areastr'] = $area['area_name'];
        $merchant_mstore['office_time'] = unserialize($merchant_mstore['office_time']);
        if (!empty($merchant_mstore['office_time'])) {
            foreach ($merchant_mstore['office_time'] as $kk => $vv) {
                $timestr.= $kk > 0 ? '，' . $vv['open'] . ' - ' . $vv['close'] : $vv['open'] . ' - ' . $vv['close'];
            }
            $merchant_mstore['office_time'] = $timestr;
        }
        $this->merchant_store_data = $merchant_mstore;
        unset($area);
        $merchantarr = $this->merchantDb->where(array('mer_id' => $this->merid))->find();
        unset($merchantarr['pwd']);
        $merchantarr['imgs'] = !empty($merchantarr['pic_info']) ? $this->get_allImage_by_path($merchantarr['pic_info']) : '';
        $merchantarr['imgscount'] = !empty($merchantarr['imgs']) ? count($merchantarr['imgs']) : 0;
		$this->uid=!empty($this->user_session) && isset($this->user_session['uid']) ? $this->user_session['uid'] :0;
		//商家的星星
		$stararr=D('Merchant_score')->where(array('parent_id'=>$this->merid,'type'=>1))->find();
		if(!empty($stararr)){
		   $star=$stararr['score_all'] / $stararr['reply_count'];
		   $star=round($star,1);
		}else{
		    $star=0;
		}
		$mstore_meal = D('Merchant_store_meal')->where(array('store_id' =>$merchant_mstore['store_id']))->field('store_id,send_time')->find();
		$this->assign('mstore_meal', $mstore_meal);
		$this->assign('star', $star);
        $this->assign('navmanag', $navtmp);
        $this->assign('merchantmstore', $merchant_mstore);
        $this->assign('merchantarr', $merchantarr);
        $this->assign('merid', $this->merid);
		$this->assign('uid',$this->uid);
        $this->assign('isindex', $isindex);
    }

    public function index() {
        /*         * **粉丝*** */
        $table = array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u');
        $condition = "`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='$this->merid'";
        $fans_count = D('')->table($table)->where($condition)->count();
        $this->assign('fans_count', $fans_count);
        $fans_list = D('')->table($table)->where($condition)->order('u.uid DESC')->limit('0,12')->select();
        $this->assign('fans_list', $fans_list);
        /*         * *商家相册10张图*** */
        $merchant_imgDb = D('Merchant_imgs');
        $imgs = $merchant_imgDb->where(array('mer_id' => $this->merid))->order('id DESC')->limit('0,10')->select();
        $this->assign('mimgs', $imgs);
		$collecttmp=D('User_collect')->where(array('id'=>$this->merid,'uid'=>$this->uid,'type'=>'merchant_id'))->find();
        //商家动态
        $introduce = D('Merchant_introduce')->field('id,mer_id,title,sort,cyid,addtime')->where(array('mer_id' => $this->merid, 'isfabu' => 1, 'comefrom' => '1'))->order('sort DESC,id DESC')->limit('0,5')->select();
        $this->assign('introduce', $introduce);
		$this->assign('collectid', !empty($collecttmp) ? $collecttmp['collect_id']:0);
		
		$mer_front_center = D('Adver')->get_adver_by_key('mer_front_center', 5);
		$this->merreviews(5);
        $this->assign('mer_front_center', $mer_front_center);
		
        $this->display();
    }

    public function merintroduce() {
        $merchant_inDb = D('Merchant_introduce');
        $introduce = $merchant_inDb->where(array('mer_id' => $this->merid, 'isfabu' => 1, 'comefrom' => '0'))->order('sort DESC,id ASC')->limit('0,10')->select();
        //print_r($introduce);
        $this->assign('introduce', $introduce);
        $this->display();
    }

    public function mernews() {
        $cyid = isset($_GET['cyid']) ? intval($_GET['cyid']) : 0;
        $merchant_inDb = D('Merchant_introduce');
        $where = array('mer_id' => $this->merid, 'isfabu' => 1, 'comefrom' => '1');
        if ($cyid > 0)
            $where['cyid'] = $cyid;
        $_count = $merchant_inDb->where($where)->count();
        import('@.ORG.common_page');
        $p = new Page($_count, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $introduce = $merchant_inDb->field('id,mer_id,title,sort,cyid,addtime')->where($where)->order('sort DESC,id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $merchant_cyDb = D('Merchant_classify');
        $classify = $merchant_cyDb->where(array('mer_id' => $this->merid, 'typ' => '0'))->order('sort DESC,id ASC')->limit('0,10')->select();
        $this->assign('cyid', $cyid);
        $this->assign('classify', $classify);
        $this->assign('introduce', $introduce);
        $this->display();
    }

    public function newsdetail() {
        $newsid = isset($_GET['newsid']) ? intval($_GET['newsid']) : 0;
        $merchant_inDb = D('Merchant_introduce');
        $where = array('id' => $newsid, 'mer_id' => $this->merid, 'isfabu' => 1, 'comefrom' => '1');
        $introduce = $merchant_inDb->where($where)->find();
        $merchant_cyDb = D('Merchant_classify');
        $classify = $merchant_cyDb->where(array('mer_id' => $this->merid, 'typ' => '0'))->order('sort DESC,id ASC')->limit('0,10')->select();
        $this->assign('cyid', $introduce['cyid']);
        $this->assign('classify', $classify);
        $this->assign('introduce', $introduce);
        $this->display();
    }

    public function mergallery() {
        $cyid = isset($_GET['cyid']) ? intval($_GET['cyid']) : 0;
        $merchant_imgDb = D('Merchant_imgs');
        $where = array('mer_id' => $this->merid);
        if ($cyid > 0)
            $where['cyid'] = $cyid;
        /* $_count = $merchant_imgDb->where($where)->count();
          import('@.ORG.common_page');
          $p = new Page($_count, 16);
          $pagebar = $p->show();
          $this->assign('pagebar', $pagebar);
          $imgarr = $merchant_imgDb->where($where)->order('id DESC')->limit($p->firstRow . ',' . $p->listRows)->select(); */
        $imgarr = $merchant_imgDb->where($where)->order('id DESC')->select();
        $merchant_cyDb = D('Merchant_classify');
        $classify = $merchant_cyDb->where(array('mer_id' => $this->merid, 'typ' => '1'))->order('sort DESC,id ASC')->limit('0,10')->select();
        $this->assign('cyid', $cyid);
        $this->assign('classify', $classify);
        $this->assign('imgarr', $imgarr);
        $this->display();
    }

    public function merclient() {
        /*         * ***merchant_navcom中客户服务对应的navid 为 7***** */
        $navset = D('Merchant_navset')->where(array('navid' => 7, 'mer_id' => $this->merid))->find();
        $datatmp = array('content' => '');
        if (!empty($navset) && ($navset['intrid'] > 0)) {
            $datatmp = D('Merchant_introduce')->where(array('id' => $navset['intrid'], 'mer_id' => $this->merid, 'comefrom' => 7))->find();
        }
        $this->assign('datatmp', $datatmp);
        $this->display();
    }

    public function merjoin() {
        /*         * ***merchant_navcom中客户服务对应的navid 为 8***** */
        $navset = D('Merchant_navset')->where(array('navid' => 8, 'mer_id' => $this->merid))->find();
        $datatmp = array('content' => '');
        if (!empty($navset) && ($navset['intrid'] > 0)) {
            $datatmp = D('Merchant_introduce')->where(array('id' => $navset['intrid'], 'mer_id' => $this->merid, 'comefrom' => 7))->find();
        }
        $this->assign('datatmp', $datatmp);
        $this->display();
    }

    public function mermap() {
        $store_id = intval($_GET['sid']);
        $jointable = C('DB_PREFIX') . 'area';
        $this->merchant_store_Db->join('as ms LEFT JOIN ' . $jointable . ' as ar on ms.area_id=ar.area_id');
        $store_list = $this->merchant_store_Db->field('ms.*,ar.area_name')->where(array('ms.mer_id' => $this->merid,'ms.status' =>'1' ))->order('ms.ismain DESC,ms.store_id ASC')->select();
        $this->assign('store_id', $store_id);
        $this->assign('storelist', $store_list);
        $this->display();
    }

    /*     * *点评** */

    public function merreviews($pagesize = 0) {
		$flage=$pagesize;
        $st = intval($_GET['st']);
        $st = $st > 0 ? $st : 0;
        $level = array(1 => 'high', 2 => 'mid', 3 => 'low', 4 => 'withpic');
        $st_str = isset($level[$st]) ? $level[$st] : 'all';
        $ord = intval($_GET['ord']);
        $ord = $ord > 0 ? $ord : 0;
        $orderarr = array(1 => 'time', 2 => 'score');
        $ordstr = isset($orderarr[$ord]) ? $orderarr[$ord] : '';
        $pagesize = $pagesize > 0 ? $pagesize : 10;
        $reply_return = D('Reply')->get_reply_listByid($this->merid, 0, $st_str, $ordstr, $pagesize);
        //print_r($reply_return);
        $this->assign('st', $st);
        $this->assign('ord', $ord);
        $this->assign('reviews', $reply_return);
		if($flage==5){
		
		}else{
          $this->display();
		}
    }

    /*     * ******商家活动--团购********** */

    public function meractivity() {
        $purchase = D('Group')->get_grouplist_by_MerchantId($this->merid, 20);
        $this->assign('purchase', $purchase);
        $this->display();
    }

    public function mergoods() {
        $sid = intval($_GET['sid']);
        if ($this->merchant_store_data['have_meal'] != 1)
            $this->error_tips('商家的主店铺没有开通'.$this->config['meal_alias_name'].'功能！');
        $m_store_id = $this->merchant_store_data['store_id'];

        $ord = intval($_GET['ord']);

        switch ($ord) {
            case 1:
                $order = 'meal_id DESC';
                break;
            case 2:
                $order = 'price ASC';
                break;
            default:
                $order = 'meal_id DESC';
                $ord = 0;
                break;
        }
        $where = array('store_id' => $m_store_id, 'status' => 1);
        if ($sid > 0) {
            $where['sort_id'] = $sid;
        } else {
            $sid = 0;
        }
        $meal_Db = D('Meal');
        /*$_count = $meal_Db->where($where)->count();
        import('@.ORG.common_page');
        $p = new Page($_count, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);

        $meal_pro = D('Meal')->where($where)->order($order)->limit($p->firstRow . ',' . $p->listRows)->select();
		*/
		$meal_pro = D('Meal')->where($where)->order($order)->select();
        $meal_image_class = new meal_image();
        foreach ($meal_pro as $kk => $vv) {
            $m['image'] = !empty($vv['image']) ? $meal_pro[$kk]['image'] = $meal_image_class->get_image_by_path($vv['image'], $this->config['site_url'], 's') : '';
        }
        $meal_mulu = D('Meal_sort')->where(array('store_id' => $m_store_id))->order('sort ASC,sort_id  DESC')->select();
		
        $this->assign('ord', $ord);
        $this->assign('sortid', $sid);
        $this->assign('mstoreid', $m_store_id);
        $this->assign('meal_pro', $meal_pro);
        $this->assign('mealmulu', $meal_mulu);
        $this->display();
    }
     /******收藏******/
	 public function merCollect(){
	    if(empty($this->user_session)){
			$this->dexit(array('error'=>1,'msg'=>'请先进行登录！'));
		}
		$merid=intval($_POST['merid']);
		$id=intval($_POST['id']);
		$user_collect_Db = D('User_collect');
		if($id>0){
		   $user_collect_Db->where(array('collect_id'=>$id,'type'=>'merchant_id','id'=>$merid,'uid'=>$this->user_session['uid']))->delete();
		   $this->dexit(array('error'=>0,'msg'=>'取消收藏成功!','msg1'=>'收藏商家'));
		}else{
		   $tmp=$user_collect_Db->where(array('id'=>$merid,'uid'=>$this->user_session['uid'],'type'=>'merchant_id'))->find();
		   if(!empty($tmp)){
		        $user_collect_Db->where(array('collect_id'=>$tmp['collect_id']))->delete();
				$this->dexit(array('error'=>0,'msg'=>'取消收藏成功!','msg1'=>'收藏商家'));
		   }else{
		      	$user_collect_Db->add(array('type'=>'merchant_id','id'=>$merid,'uid'=>$this->user_session['uid']));
		        $this->dexit(array('error'=>0,'msg'=>'收藏成功','msg1'=>'已收藏'));
		   }
		}
	 }

	 /********更新一下访问************/
	 function merupview(){
		 $merid= intval($_POST['merid']);
	     $this->merchantDb->where(array('mer_id' => $merid))->setInc('hits', 1);
		 $this->dexit(array('error'=>0));
	 }
    /* 根据商品数据表的图片字段来得到图片 */

    private function get_allImage_by_path($path) {
        $tmp_pic_arr = explode(';', $path);
        foreach ($tmp_pic_arr as $key => $value) {
            $image_tmp = explode(',', $value);
            $return[$key] = C('config.site_url') . '/upload/merchant/' . $image_tmp[0] . '/' . $image_tmp['1'];
        }
        return $return;
    }
    /*     * json 格式封装函数* */

    private function dexit($data = '') {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }
}
