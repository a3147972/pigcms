<?php
/*
 * 推广营销 - 活动列表
 *
 * @  Writers    Jaty
 * @  BuildTime  2015/06/15 14:25
 * 
 */
class ActivityAction extends BaseAction{
	public function index(){
		$database_extension_activity = D('Extension_activity');
		$activity_list = $database_extension_activity->field(true)->order('`activity_id` DESC')->select();
		$this->assign('activity_list',$activity_list);
		$this->display();
	}
	public function add(){
		//找到活动的下一个时间段
		$database_extension_activity = D('Extension_activity');
		$max_end_time = $database_extension_activity->max('end_time');
		$this->assign('next_time',($max_end_time ? $max_end_time : 0));
		
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function modify(){
		if(IS_POST){
			//上传图片
			$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
			$upload_dir = './upload/extension/'.$rand_num.'/'; 
			if(!is_dir($upload_dir)){
				mkdir($upload_dir,0777,true);
			}
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();
			$upload->maxSize = 10*1024*1024;
			$upload->allowExts = array('jpg','jpeg','png','gif');
			$upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');
			$upload->savePath = $upload_dir; 
			$upload->saveRule = 'uniqid';
			if($upload->upload()){
				$uploadList = $upload->getUploadFileInfo();
				$_POST['bg_pic'] = $rand_num.'/'.$uploadList[0]['savename'];
			}else{
				$this->frame_submit_tips(0,$upload->getErrorMsg());
			}
			$_POST['begin_time'] = strtotime($_POST['begin_time']);
			$_POST['end_time'] = strtotime($_POST['end_time']);
			$database_extension_activity = D('Extension_activity');
			if($database_extension_activity->data($_POST)->add()){
				$this->frame_submit_tips(1,'添加成功！');
			}else{
				$this->frame_submit_tips(0,'添加失败！请重试~');
			}
		}else{
			$this->frame_submit_tips(0,'非法提交,请重新提交~');
		}
	}
	public function edit(){
		$this->assign('bg_color','#F3F3F3');
		$database_extension_activity = D('Extension_activity');
		$condition_extension_activity['activity_id'] = intval($_GET['id']);
		$now_activity = $database_extension_activity->field(true)->where($condition_extension_activity)->find();
		if(empty($now_activity)){
			$this->frame_error_tips('该活动不存在！');
		}
		$this->assign('now_activity',$now_activity);
		$this->display();
	}
	public function amend(){
		if(IS_POST){
			if($_FILES['bg_pic']['error'] != 4){
				//上传图片
				$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
				$upload_dir = './upload/extension/'.$rand_num.'/'; 
				if(!is_dir($upload_dir)){
					mkdir($upload_dir,0777,true);
				}
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();
				$upload->maxSize = 10*1024*1024;
				$upload->allowExts = array('jpg','jpeg','png','gif');
				$upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');
				$upload->savePath = $upload_dir; 
				$upload->saveRule = 'uniqid';
				if($upload->upload()){
					$uploadList = $upload->getUploadFileInfo();
					$_POST['bg_pic'] = $rand_num.'/'.$uploadList[0]['savename'];
				}else{
					$this->frame_submit_tips(0,$upload->getErrorMsg());
				}
			}
			$_POST['begin_time'] = strtotime($_POST['begin_time']);
			$_POST['end_time'] = strtotime($_POST['end_time']);
			$database_extension_activity = D('Extension_activity');
			if($database_extension_activity->data($_POST)->save()){
				$this->frame_submit_tips(1,'修改成功！');
			}else{
				$this->frame_submit_tips(0,'修改失败！请重试~');
			}
		}else{
			$this->frame_submit_tips(0,'非法提交,请重新提交~');
		}
	}
	public function del(){
		// if(IS_POST){
			// $database_search_hot = D('Search_hot');
			// $condition_search_hot['id'] = intval($_POST['id']);
			// if($database_search_hot->where($condition_search_hot)->delete()){
				// S('search_hot_list',NULL);
				// $this->success('删除成功！');
			// }else{
				// $this->error('删除失败！请重试~');
			// }
		// }else{
			// $this->error('非法提交,请重新提交~');
		// }
		$this->error('活动暂时不能删除~');
	}
	
	public function activity_list(){
		$database_extension_activity = D('Extension_activity');
		$condition_extension_activity['activity_id'] = intval($_GET['id']);
		$now_activity = $database_extension_activity->field(true)->where($condition_extension_activity)->find();
		if(empty($now_activity)){
			$this->error_tips('该活动不存在');
		}
		$this->assign('now_activity',$now_activity);
		
		$database_extension_activity_list = D('Extension_activity_list');
		$condition_extension_activity_list['activity_term'] = $_GET['id'];
		$activity_list = $database_extension_activity_list->field(true)->where($condition_extension_activity_list)->order('`pigcms_id` DESC')->select();
		if(empty($activity_list)){
			$this->error_tips('该活动暂时没有商家参与');
		}
		foreach($activity_list as &$value){
			$value['type_txt'] = $this->type_txt($value['type']);
		}
		$this->assign('activity_list',$activity_list);
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
}