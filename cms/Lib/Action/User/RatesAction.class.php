<?php
/*
 * 待评价
 *
 */
class RatesAction extends BaseAction {
    public function index(){
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12);
    	$this->assign('search_hot_list',$search_hot_list);

		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//我的未评价列表
		$order_list = D('Group')->get_rate_order_list($this->now_user['uid'],false,false);
		$this->assign('order_list',$order_list);
		
		$this->display();
    }
	public function rated(){
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12);
    	$this->assign('search_hot_list',$search_hot_list);

		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//我的已评价列表
		$order_list = D('Group')->get_rate_order_list($this->now_user['uid'],true,false);
		$this->assign('order_list',$order_list);

		$this->display();
    }
	public function ajax_upload_pic(){
		$dom_id = $_POST['id'];
		$order_id = $_POST['order_id'];
		$order_type = $_POST['order_type'];
		if($order_type == 0){
			$pic_filepath = 'group';
		}else{
			$pic_filepath = 'meal';
		}
		if($_FILES['file']['error'] != 4){
			$img_order_id = sprintf("%09d",$this->user_session['uid']);
			$rand_num = mt_rand(10,99).'/'.substr($img_order_id,0,3).'/'.substr($img_order_id,3,3).'/'.substr($img_order_id,6,3);
			$upload_dir = './upload/reply/'.$pic_filepath.'/'.$rand_num.'/'; 
			if(!is_dir($upload_dir)){
				mkdir($upload_dir,0777,true);
			}
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize = $this->config['reply_pic_size']*1024*1024;
			$upload->allowExts = array('jpg','jpeg','png','gif');
			$upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');
			$upload->savePath = $upload_dir; 
			$upload->thumb = true;
			$upload->thumbType = 0;
			$upload->imageClassPath = 'ORG.Util.Image';
			$upload->thumbPrefix = 'm_,s_';
			$upload->thumbMaxWidth  = $this->config['reply_pic_width'];
			$upload->thumbMaxHeight = $this->config['reply_pic_height'];
			$upload->thumbRemoveOrigin = false;
			$upload->saveRule = 'uniqid';
			if($upload->upload()){
				$uploadList = $upload->getUploadFileInfo();
				
				$database_reply_pic = D('Reply_pic');
				$data_reply_pic['name'] = $_POST['name'];
				$data_reply_pic['pic'] = $rand_num.','.$uploadList[0]['savename'];
				$data_reply_pic['uid'] = $this->user_session['uid'];
				$data_reply_pic['order_type'] = $order_type;
				$data_reply_pic['order_id'] = $order_id;
				$data_reply_pic['add_time'] = $_SERVER['REQUEST_TIME'];
				if($pigcms_id = $database_reply_pic->data($data_reply_pic)->add()){
					$reply_image_class = new reply_image();
					$url = $reply_image_class->get_image_by_path($data_reply_pic['pic'],$pic_filepath,'s');
					
					die('{"jsonrpc":"2.0","result":{"error_code":0,"pigcms_id":'.$pigcms_id.',"order_id":'.$order_id.',"url":"'.$url.'"},"id":"'.$dom_id.'"}');
				}else{
					die('{"jsonrpc":"2.0","result":{"error_code":1002,"message":"图片添加失败！请重试。"},"id":"'.$dom_id.'"}');
				}
			}else{
				die('{"jsonrpc":"2.0","result":{"error_code":1001,"message":"'.$upload->getErrorMsg().'"},"id":"'.$dom_id.'"}');
			}
		}else{
			die('{"jsonrpc":"2.0","result":{"error_code":1000,"message":"没有选择图片！"},"id":"'.$dom_id.'"}');
		}
	}
	public function ajax_del_pic(){
		$database_reply_pic = D('Reply_pic');
		$condition_reply_pic['uid'] = $this->user_session['uid'];
		$condition_reply_pic['pigcms_id'] = $_POST['pic_id'];
		$condition_reply_pic['order_id'] = $_POST['order_id'];
		$now_order = $database_reply_pic->field('`pigcms_id`,`pic`,`order_type`')->where($condition_reply_pic)->find();
		if(!empty($now_order)){
			if($now_order['order_type'] == 0){
				$pic_filepath = 'group';
			}else{
				$pic_filepath = 'meal';
			}
			
			$reply_image_class = new reply_image();
			$reply_image_class->del_image_by_path($now_order['pic'],$pic_filepath);
			
			$condition_reply_pic_del['pigcms_id'] = $now_order['pigcms_id'];
			$database_reply_pic->where($condition_reply_pic)->delete();
		}
	}
	public function ajax_get_pic(){
		$reply_image_class = new reply_image();
		$pic_list = $reply_image_class->get_image_by_ids($_POST['pic_ids'],$_POST['order_type']);
		if($pic_list){
			echo json_encode($pic_list);
		}else{
			echo '0';
		}
	}
	public function reply_to(){
		$order_type = intval($_POST['order_type']);
		if($order_type == 0){
			$now_order = D('Group_order')->get_order_detail_by_id($this->now_user['uid'],$_GET['order_id']);
			$data_reply['parent_id'] = $now_order['group_id'];
		}else{
			$now_order = D('Meal_order')->where(array('uid' => $this->now_user['uid'], 'order_id' => $_GET['order_id']))->find();
			$data_reply['parent_id'] = $now_order['store_id'];
		}
		if(empty($now_order)){
			$this->error('当前订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error('当前订单未付款！无法评论。');
		}
		if(empty($now_order['status'])){
			$this->error('当前订单未消费！无法评论。');
		}
		$score = intval($_POST['score']);
		if($score > 5 || $score < 1){
			$this->error('评分只能1到5分！');
		}
		$database_reply = D('Reply');
		$data_reply['store_id'] = $now_order['store_id'];
		$data_reply['mer_id'] = $now_order['mer_id'];
		$data_reply['score'] = $score;
		$data_reply['order_type'] = $order_type;
		$data_reply['order_id'] = intval($_GET['order_id']);
		$data_reply['anonymous'] = intval($_POST['anonymous']);
		$data_reply['comment'] = $_POST['comment'];
		$data_reply['uid'] = $this->now_user['uid'];
		$data_reply['add_time'] = $_SERVER['REQUEST_TIME'];
		$data_reply['add_ip'] = get_client_ip(1);
		$data_reply['pic'] = $_POST['pic_ids'];
		if($database_reply->data($data_reply)->add()){
			if($order_type == 0){
				D('Group')->setInc_group_reply($now_order,$score);
				D('Group_order')->change_status($now_order['order_id'],2);
			}else{
				D('Merchant_store')->setInc_meal_reply($now_order['store_id'], $score);
				D('Meal_order')->change_status($now_order['order_id'],2);
			}

			$database_merchant_score = D('Merchant_score');
			$now_merchant_score = $database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['mer_id'],'type'=>'1'))->find();
			if(empty($now_merchant_score)){
				$data_merchant_score['parent_id'] = $now_order['mer_id'];
				$data_merchant_score['type'] = '1';
				$data_merchant_score['score_all'] = $score;
				$data_merchant_score['reply_count'] = 1;
				$database_merchant_score->data($data_merchant_score)->add();
			}else{
				$data_merchant_score['score_all'] = $now_merchant_score['score_all']+$score;
				$data_merchant_score['reply_count'] = $now_merchant_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_merchant_score['pigcms_id']))->data($data_merchant_score)->save();
			}
			$now_store_score=$database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['store_id'],'type'=>'2'))->find();
			if(empty($now_store_score)){
				$data_store_score['parent_id'] = $now_order['store_id'];
				$data_store_score['type'] = '2';
				$data_store_score['score_all'] = $score;
				$data_store_score['reply_count'] = 1;
				$database_merchant_score->data($data_store_score)->add();
			}else{
				$data_store_score['score_all'] = $now_store_score['score_all']+$score;
				$data_store_score['reply_count'] = $now_store_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_store_score['pigcms_id']))->data($data_store_score)->save();
			}

			$this->success('添加评论成功！');
		}else{
			$this->error('添加评论失败！');
		}
	}
	public function del_invalid_pic(){
		if($_POST['order_type'] == 0){
			$pic_filepath = 'group';
		}else{
			$pic_filepath = 'meal';
		}
		$database_reply_pic = D('Reply_pic');
		$condition_reply_pic['uid'] = $this->user_session['uid'];
		$condition_reply_pic['order_type'] = $_POST['order_type'];
		$condition_reply_pic['order_id'] = $_POST['order_id'];
		$reply_pic_list = $database_reply_pic->field('`pic`')->where($condition_reply_pic)->select();
		if($reply_pic_list){
			$reply_image_class = new reply_image();
			foreach($reply_pic_list as $value){
				$reply_image_class->del_image_by_path($value['pic'],$pic_filepath);
			}
			$database_reply_pic->where($condition_reply_pic)->delete();
		}
	}
	
	public function meal()
	{
		//导航条
		$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
		$this->assign('web_index_slider',$web_index_slider);
		 
		//热门搜索词
		$search_hot_list = D('Search_hot')->get_list(12);
		$this->assign('search_hot_list',$search_hot_list);
	
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
	
		//我的未评价列表
		$order_list = D('Meal_order')->get_rate_order_list($this->now_user['uid'],false,false);
		$this->assign('order_list',$order_list);
	
		$this->display();
	}
	
	public function meal_rated(){
    	//导航条
    	$web_index_slider = D('Slider')->get_slider_by_key('web_slider');
    	$this->assign('web_index_slider',$web_index_slider);
    	
		//热门搜索词
    	$search_hot_list = D('Search_hot')->get_list(12);
    	$this->assign('search_hot_list',$search_hot_list);

		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);
		
		//我的已评价列表
		$order_list = D('Meal_order')->get_rate_order_list($this->now_user['uid'],true,false);
		$this->assign('order_list',$order_list);

		$this->display();
    }
	
}