<?php
/*
 * 团购内页
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/06 16:47
 * 
 */
class DetailAction extends BaseAction{
    public function index(){
    	//右侧广告
//     	$index_right_adver = D('Adver')->get_adver_by_key('index_right',3);
//     	$this->assign('index_right_adver',$index_right_adver);
    	
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12,0);
    	$this->assign('search_hot_list',$search_hot_list);
		
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id'],'hits-setInc');
		if(empty($now_group)){
			$this->group_noexit_tips($this->config['group_alias_name'].'不存在。');
		}
		//商家的活动
		$lotterys = D("Lottery")->field(true)->where(array('token' => $now_group['mer_id'], 'statdate' => array('lt', time()), 'enddate' => array('gt', time())))->select();
		foreach ($lotterys as $lottery) {
			$index_right_adver[] = array('name' => $lottery['title'], 'pic' => $lottery['starpicurl'], 'url' => 'javascript:void(0);', 'id' => $lottery['id']);
		}
		$this->assign('index_right_adver',$index_right_adver);
		if($now_group['cue']){
			$now_group['cue_arr'] = unserialize($now_group['cue']);
		}
		if(!empty($now_group['pic_info'])){
			$merchant_image_class = new merchant_image();
			$now_group['merchant_pic'] = $merchant_image_class->get_allImage_by_path($now_group['pic_info']);
		}
		
		if(!empty($this->user_session)){
			$database_user_collect = D('User_collect');
			$condition_user_collect['type'] = 'group_detail';
			$condition_user_collect['id'] = $now_group['group_id'];
			$condition_user_collect['uid'] = $this->user_session['uid'];
			if($database_user_collect->where($condition_user_collect)->find()){
				$now_group['is_collect'] = true;
			}
		}
		
		$this->assign('now_group',$now_group);
		
		$f_category = D('Group_category')->get_category_by_id($now_group['cat_fid']);
		if(empty($f_category)){
			$this->group_noexit_tips($this->config['group_alias_name'].'上级分类不存在。');
		}
		$this->assign('f_category',$f_category);
		
		$s_category = D('Group_category')->get_category_by_id($now_group['cat_id']);
		if(empty($s_category)){
			$this->group_noexit_tips($this->config['group_alias_name'].'分类不存在。');
		}
		$this->assign('s_category',$s_category);

		if($now_group['packageid']>0){
		   $packages=M('Group_packages')->where(array('id' => $now_group['packageid'], 'mer_id' => $now_group['mer_id']))->find();
		   if(!empty($packages['groupidtext'])){
		      $mpackages = unserialize($packages['groupidtext']);
		   }else{
		      $mpackages = false;
		   }
			$this->assign('mpackages',$mpackages);
		}

		//商家团购列表
		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_group['mer_id'],0,false,$now_group['group_id']);
		$this->assign('merchant_group_list',$merchant_group_list);
		
		//猜您喜欢
		$like_group_list = D('Group')->get_grouplist_by_catId($now_group['cat_id'],$now_group['cat_fid'],5);
		foreach($like_group_list as $key=>$value){
			if($value['group_id'] == $now_group['group_id']){
				unset($like_group_list[$key]);
			}
		}
		$this->assign('like_group_list',$like_group_list);
		
		//分类下最热门团购，销售量
		$category_hot_group_list = D('Group')->get_grouplist_by_catId($now_group['cat_id'],$now_group['cat_fid'],4,false,'`sale_count` DESC');
		foreach($category_hot_group_list as $key=>$value){
			if($value['group_id'] == $now_group['group_id']){
				unset($category_hot_group_list[$key]);
			}
		}
		$this->assign('category_hot_group_list',$category_hot_group_list);
		
		$this->display();
    }
    public function buy(){
    	//判断登录
    	// if(empty($this->user_session)){
    		// $this->assign('jumpUrl',U('Index/Login/index'));
    		// $this->error('请先登录！');
    	// }
    	
    	//现在的团购
   		 $now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
		if(empty($now_group)){
			$this->group_noexit_tips();
		}
		
		if($now_group['begin_time'] > $_SERVER['REQUEST_TIME']){
			$this->error_tips('此单'.$this->config['group_alias_name'].'还未开始！');
		}
		if($now_group['type'] > 2){
			$this->error_tips('此单'.$this->config['group_alias_name'].'已结束！');
		}
		//用户等级 优惠
		$level_off=false;
		$finalprice=0;
		if(!empty($this->user_level) && !empty($this->user_session) && isset($this->user_session['level'])){
			$leveloff=!empty($now_group['leveloff']) ? unserialize($now_group['leveloff']) :'';
			/****type:0无优惠 1百分比 2立减*******/
			if(!empty($leveloff) && is_array($leveloff) && isset($this->user_level[$this->user_session['level']]) && isset($leveloff[$this->user_session['level']])){
				$level_off=$leveloff[$this->user_session['level']];
				if($level_off['type']==1){
				  $finalprice=$now_group['price']*($level_off['vv']/100);
				  $finalprice=$finalprice>0 ? $finalprice : 0;
				  $pigcms_assign['total_off_price'] = $pigcms_assign['num']*$finalprice; 
				  $level_off['offstr']='单价按原价'.$level_off['vv'].'%来结算';
				}elseif($level_off['type']==2){
				  $finalprice=$now_group['price']-$level_off['vv'];
				  $finalprice=$finalprice>0 ? $finalprice : 0;
				  $pigcms_assign['total_off_price'] = $pigcms_assign['num']*$finalprice;
				  $level_off['offstr']='单价立减'.$level_off['vv'].'元';
				}
			}
		}
		unset($leveloff);
    	if(IS_POST){
    		$_POST['quantity'] = $_POST['q'];
			$finalprice > 0 && $now_group['price']=round($finalprice,2);
    		$result = D('Group_order')->save_post_form($now_group,$this->user_session['uid'],0);
			if($result['error'] == 1){
				$this->error($result['msg']);
			}
    		redirect(U('Index/Pay/check',array('order_id'=>$result['order_id'],'type'=>'group')));
    	}else{
	    	$pigcms_get = $this->get_uri_param();

	    	$this->assign('now_group',$now_group);
	    	
	    	if($pigcms_get['q'] < $now_group['once_min']){
	    		$pigcms_assign['num'] = $now_group['once_min'];
	    	}else{
	    		$pigcms_assign['num'] = $pigcms_get['q'];
	    	}
	    	$pigcms_assign['total_price'] = $pigcms_assign['num']*$now_group['price'];

	    	$pigcms_assign['pigcms_phone'] = substr($this->user_session['phone'],0,3).'****'.substr($this->user_session['phone'],7);
	    	$pigcms_assign['total_off_price'] = $finalprice > 0 ? round(($pigcms_assign['num']*$finalprice),2) : $pigcms_assign['total_price'];
			is_array($level_off) && $level_off['price']=round($finalprice,2);
			$this->assign('leveloff',$level_off);
			$this->assign('finalprice',$finalprice);
	    	$this->assign($pigcms_assign);
	    	//导航条
	    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
	    	$this->assign('web_index_slider',$web_index_slider);
	    	 
			//热门搜索词
			$search_hot_list = D('Search_hot')->get_list(12,0);
			$this->assign('search_hot_list',$search_hot_list);
			
	    	//所有分类 包含2级分类
	    	$all_category_list = D('Group_category')->get_category();
	    	$this->assign('all_category_list',$all_category_list);
	    	$this->display();
    	}
    }
	public function group_noexit_tips($fix){
		$this->assign('jumpUrl',$this->config['site_url']);
		$this->error('您不能查看该商品！'.$fix);
	}
}