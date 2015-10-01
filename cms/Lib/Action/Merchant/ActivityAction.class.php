<?php
class ActivityAction extends BaseAction{
	public function index() {
		// $activity_list = D('Extension_activity_list')->where(array('mer_id'=>$this->merchant_session['mer_id']))->order('`pigcms_id` DESC')->select();
		$mer_id = $this->merchant_session['mer_id'];
		$activity_list = D('')->field('`eal`.*,`ea`.`begin_time`,`ea`.`end_time`')->table(array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'extension_activity'=>'ea'))->where("`eal`.`mer_id`='$mer_id' AND `eal`.`activity_term`=`ea`.`activity_id`")->order('`eal`.`pigcms_id` DESC')->select();
		foreach($activity_list as &$value){
			$value['type_txt'] = $this->type_txt($value['type']);
		}
		$this->assign('activity_list',$activity_list);
		// dump(D(''));
		$this->display();
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
	public function add(){
		if(IS_POST){
			if(empty($_POST['activity_term'])){
				$this->error('请选择参与活动期数');
			}
			if(empty($_POST['name'])){
				$this->error('请填写活动名称');
			}
			if(empty($_POST['title'])){
				$this->error('请填写活动标题');
			}
			if(empty($_POST['pic'])){
				$this->error('请至少上传一张照片');
			}
			$_POST['pic'] = implode(';',$_POST['pic']);
			if(empty($_POST['info'])){
				$this->error('请填写活动详情');
			}
			$_POST['info'] = fulltext_filter($_POST['info']);

			$_POST['all_count'] = intval($_POST['all_count']);
			if(empty($_POST['all_count'])){
				$this->error('请填写合法的商品数量，最低1件');
			}
			$_POST['price'] = intval($_POST['price']);
			$_POST['mer_score'] = intval($_POST['mer_score']);
			$_POST['money'] = floatval($_POST['money']);

			if($_POST['type'] == 1){
				$_POST['all_count'] = 1;
				$_POST['money'] = 1;
				$_POST['activity_limit'] = 1;
				$_POST['mer_score'] = 0;
				if(empty($_POST['price'])){
					$this->error('一元夺宝 需要设置商品价格');
				}
			}else{
				unset($_POST['price']);
			}
			if($_POST['activity_limit']){
				if(empty($_POST['money'])){
					$this->error('请填写合法的消耗金钱，需要整数');
				}
				unset($_POST['mer_score']);
			}else{
				if(empty($_POST['mer_score'])){
					$this->error('请填写合法的消耗积分，需要整数');
				}
				if($_POST['mer_score'] % $this->config['activity_score_scale']){
					$this->error('消耗积分必须是 '.$this->config['activity_score_scale'].' 的倍数');
				}
				unset($_POST['money']);
			}
			$_POST['mer_id'] = $this->merchant_session['mer_id'];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			if(D('Extension_activity_list')->data($_POST)->add()){
				$this->success('添加成功，请耐心等待管理员审核该活动。');
			}else{
				$this->error('添加失败，请重试。');
			}
		}else{
			$activity_term_list = array();
			if($this->config['activity_sign_term']){
				$activity_term_list = D('Extension_activity')->where(array('end_time'=>array('gt',$_SERVER['REQUEST_TIME']),'status'=>'1'))->order('`activity_id` ASC')->select();
			}else{
				$activity_term_list[0] = D('Extension_activity')->where(array('end_time'=>array('gt',$_SERVER['REQUEST_TIME']),'status'=>'1'))->find();
			}
			if(empty($activity_term_list) || empty($activity_term_list[0])){
				$this->error('平台暂时没有开启的活动！');
			}

			$this->assign('activity_term_list',$activity_term_list);
			$this->display();
		}
	}
	public function yiyuanduobao(){
		$database_extension_activity_list = D('Extension_activity_list');
		$condition_extension_activity_list['pigcms_id'] = $_GET['id'];
		$database_extension_activity_list = D('Extension_activity_list');
		$condition_extension_activity_list['pigcms_id'] = $_GET['id'];
		$now_activity = $database_extension_activity_list->field(true)->where($condition_extension_activity_list)->find();
		if(empty($now_activity) || $now_activity['type'] != 1 || $now_activity['status'] != 2){
			$this->assign('jumpUrl',$this->config['site_url']);
			$this->error('该活动不存在');
		}
		$now_user = D('User')->get_user($now_activity['lottery_uid']);
		$now_user_adress = D('User_adress')->get_one_adress($now_user['uid']);

		$this->assign('now_activity',$now_activity);
		$this->assign('now_user',$now_user);
		$this->assign('now_user_adress',$now_user_adress);
		$this->display();
	}

	public function frame_edit(){
		if(empty($_SESSION['system'])){
			$this->error('非法修改');
		}
		if(IS_POST){
			$now_activity = D('Extension_activity_list')->where(array('pigcms_id'=>$_GET['id']))->find();
			if(empty($now_activity)){
				$this->error('该活动不存在');
			}
			if(empty($_POST['name'])){
				$this->error('请填写活动名称');
			}
			if(empty($_POST['title'])){
				$this->error('请填写活动标题');
			}
			if(empty($_POST['pic'])){
				$this->error('请至少上传一张照片');
			}
			$_POST['pic'] = implode(';',$_POST['pic']);
			if(empty($_POST['info'])){
				$this->error('请填写活动详情');
			}
			$_POST['info'] = fulltext_filter($_POST['info']);
			if($now_activity['type'] == 1){
				$_POST['all_count'] = intval($now_activity['price']);
			}else{
				if($_POST['all_count']) $_POST['all_count'] = intval($_POST['all_count']);
				if($_POST['all_count'] > $now_activity['part_count']){
					$_POST['is_finish'] = 0;
					$_POST['finish_time'] = 0;
				}
			}
			if($_POST['price']) $_POST['price'] = intval($_POST['price']);
			if($_POST['mer_score']) $_POST['mer_score'] = intval($_POST['mer_score']);
			if($_POST['money']) $_POST['money'] = floatval($_POST['money']);

			if(isset($_POST['activity_limit'])){
				if($_POST['activity_limit']){
					if(empty($_POST['money'])){
						$this->error('请填写合法的消耗金钱，需要整数');
					}
					unset($_POST['mer_score']);
				}else{
					if(empty($_POST['mer_score'])){
						$this->error('请填写合法的消耗积分，需要整数');
					}
					if($_POST['mer_score'] % $this->config['activity_score_scale']){
						$this->error('消耗积分必须是 '.$this->config['activity_score_scale'].' 的倍数');
					}
					unset($_POST['money']);
				}
			}
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			if(D('Extension_activity_list')->where(array('pigcms_id'=>$_GET['id']))->data($_POST)->save()){
				$this->success('编辑成功');
			}else{
				$this->error('编辑失败，请重试。');
			}
		}else{
			$now_activity = D('Extension_activity_list')->where(array('pigcms_id'=>$_GET['id']))->find();
			if(empty($now_activity)){
				$this->error('该活动不存在');
			}
			if($now_activity['type'] == 1 && $now_activity['is_finish']){
				$this->error('该一元夺宝活动已售罄结束，无法编辑修改');
			}
			$extension_image_class = new extension_image();
			//图片
			$tmp_pic_arr = explode(';',$now_activity['pic']);
			foreach($tmp_pic_arr as $key=>$value){
				$now_activity['pic_arr'][$key]['title'] = $value;
				$now_activity['pic_arr'][$key]['url'] = $extension_image_class->get_image_by_path($value,'s');
			}
			$now_activity['type_txt'] = $this->type_txt($now_activity['type']);
			$now_activity['money'] = floatval($now_activity['money']);
			$this->assign('now_activity',$now_activity);


			$activity_term_list = array();
			if($this->config['activity_sign_term']){
				$activity_term_list = D('Extension_activity')->where(array('end_time'=>array('gt',$_SERVER['REQUEST_TIME']),'status'=>'1'))->order('`activity_id` ASC')->select();
			}else{
				$activity_term_list[0] = D('Extension_activity')->where(array('end_time'=>array('gt',$_SERVER['REQUEST_TIME']),'status'=>'1'))->find();
			}
			$now_activity_term = array();
			foreach($activity_term_list as $value){
				if($value['activity_id'] == $now_activity['activity_term']){
					$now_activity_term = $value;
				}
			}
			if(empty($now_activity_term)){
				$this->error('当前活动期数不存在或已过期，无法编辑该活动');
			}
			if(empty($activity_term_list) || empty($activity_term_list[0])){
				$this->error('平台暂时没有开启的活动！');
			}
			$this->assign('now_activity_term',$now_activity_term);
			$this->assign('activity_term_list',$activity_term_list);

			$this->display();
		}
	}
	public function ajax_upload_pic(){
		if($_FILES['imgFile']['error'] != 4){
			$img_mer_id = sprintf("%09d",$this->merchant_session['mer_id']);
			$rand_num = mt_rand(10,99).'/'.substr($img_mer_id,0,3).'/'.substr($img_mer_id,3,3).'/'.substr($img_mer_id,6,3);

			$upload_dir = './upload/extension/'.$rand_num.'/';
			if(!is_dir($upload_dir)){
				mkdir($upload_dir,0777,true);
			}
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize = $this->config['activity_pic_size']*1024*1024;
			$upload->allowExts = array('jpg','jpeg','png','gif');
			$upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');
			$upload->savePath = $upload_dir;
			$upload->thumb=true;
			$upload->imageClassPath = 'ORG.Util.Image';
			$upload->thumbPrefix = 'm_,s_';
			$upload->thumbMaxWidth  = $this->config['activity_pic_width'];
			$upload->thumbMaxHeight = $this->config['activity_pic_height'];
			$upload->thumbRemoveOrigin = false;
			$upload->saveRule = 'uniqid';
			if($upload->upload()){
				$uploadList = $upload->getUploadFileInfo();

				$title = $rand_num.','.$uploadList[0]['savename'];

				$extension_image_class = new extension_image();
				$url = $extension_image_class->get_image_by_path($title,'s');

				exit(json_encode(array('error' => 0,'url' =>$url,'title'=>$title)));
			}else{
				exit(json_encode(array('error' => 1,'message' =>$upload->getErrorMsg())));
			}
		}else{
			exit(json_encode(array('error' => 1,'message' =>'没有选择图片')));
		}
	}
}


?>