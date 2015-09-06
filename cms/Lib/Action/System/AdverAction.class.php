<?php
/*
 * 广告管理
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/06 16:47
 * 
 */
class AdverAction extends BaseAction{
	public function index(){
		$database_adver_category  = D('Adver_category');
		$category_list = $database_adver_category->field(true)->order('`cat_id` ASC')->select();
		$this->assign('category_list',$category_list);
		$this->display();
	}
	public function cat_add(){
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function cat_modify(){
		if(IS_POST){
			$database_adver_category  = D('Adver_category');
			if($database_adver_category->data($_POST)->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_edit(){
		$this->assign('bg_color','#F3F3F3');
		$now_category = $this->frame_check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	public function cat_amend(){
		if(IS_POST){
			$database_adver_category  = D('Adver_category');
			if($database_adver_category->data($_POST)->save()){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_del(){
		if(IS_POST){
			$database_adver_category  = D('Adver_category');
			$condition_adver_category['cat_id'] = $_POST['cat_id'];
			if($database_adver_category->where($condition_adver_category)->delete()){
				//删除所有广告
				$database_adver = D('Adver');
				$condition_adver['cat_id'] = $now_category['cat_id'];
				$adver_list = $database_adver->field(true)->where($condition_adver)->order('`id` DESC')->select();
				foreach($adver_list as $key=>$value){
					unlink('./upload/adver/'.$value['pic']); 
				}
				$database_adver->where($condition_adver)->delete();
				
				S('adver_list_'.$_POST['cat_id'],NULL);
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function adver_list(){
		$now_category = $this->check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		
		$database_adver = D('Adver');
		$condition_adver['cat_id'] = $now_category['cat_id'];
		$adver_list = $database_adver->field(true)->where($condition_adver)->order('`id` DESC')->select();
		$this->assign('adver_list',$adver_list);
		
		$this->display();
	}
	public function adver_add(){
		$this->assign('bg_color','#F3F3F3');
		$now_category = $this->frame_check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	public function adver_modify(){
		//上传图片
		$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
		$upload_dir = './upload/adver/'.$rand_num.'/'; 
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
			$_POST['pic'] = $rand_num.'/'.$uploadList[0]['savename'];
		}else{
			$this->frame_submit_tips(0,$upload->getErrorMsg());
		}
		$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
		$_POST['url'] = htmlspecialchars_decode($_POST['url']);
		$database_adver = D('Adver');
		if($database_adver->data($_POST)->add()){
			S('adver_list_'.$_POST['cat_id'],NULL);
			$this->frame_submit_tips(1,'添加成功！');
		}else{
			$this->frame_submit_tips(0,'添加失败！请重试~');
		}
	}
	public function adver_edit(){
		$this->assign('bg_color','#F3F3F3');
		
		$database_adver = D('Adver');
		$condition_adver['id'] = $_GET['id'];
		$now_adver = $database_adver->field(true)->where($condition_adver)->find();
		if(empty($now_adver)){
			$this->frame_error_tips('该广告不存在！');
		}
		$this->assign('now_adver',$now_adver);
		
		$now_category = $this->frame_check_get_category($now_adver['cat_id']);
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	
	public function adver_amend(){
		$database_adver = D('Adver');
		$condition_adver['id'] = $_POST['id'];
		$now_adver = $database_adver->field(true)->where($condition_adver)->find();
			
		if($_FILES['pic']['error'] != 4){
			//上传图片
			$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
			$upload_dir = './upload/adver/'.$rand_num.'/'; 
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
				$_POST['pic'] = $rand_num.'/'.$uploadList[0]['savename'];
			}else{
				$this->frame_submit_tips(0,$upload->getErrorMsg());
			}
		}
		$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
		$_POST['url'] = htmlspecialchars_decode($_POST['url']);
		$database_adver = D('Adver');
		if($database_adver->data($_POST)->save()){
			S('adver_list_'.$now_adver['cat_id'],NULL);
			if($_POST['pic']){
				unlink('./upload/adver/'.$now_adver['pic']); 
			}
			$this->frame_submit_tips(1,'编辑成功！');
		}else{
			$this->frame_submit_tips(0,'编辑失败！请重试~');
		}
	}
	
	public function adver_del(){
		$database_adver = D('Adver');
		$condition_adver['id'] = $_POST['id'];
		$now_adver = $database_adver->field(true)->where($condition_adver)->find();
		if($database_adver->where($condition_adver)->delete()){
			unlink('./upload/adver/'.$now_adver['pic']); 
			S('adver_list_'.$now_adver['cat_id'],NULL);
			$this->success('删除成功');
		}else{
			$this->error('删除失败！请重试~');
		}
	}
	
	protected function get_category($cat_id){
		$database_adver_category  = D('Adver_category');
		$condition_adver_category['cat_id'] = $cat_id;
		$now_category = $database_adver_category->field(true)->where($condition_adver_category)->find();
		return $now_category;
	}
	protected function frame_check_get_category($cat_id){
		$now_category = $this->get_category($cat_id);
		if(empty($now_category)){
			$this->frame_error_tips('分类不存在！');
		}else{
			return $now_category;
		}
	}
	protected function check_get_category($cat_id){
		$now_category = $this->get_category($cat_id);
		if(empty($now_category)){
			$this->error_tips('分类不存在！');
		}else{
			return $now_category;
		}
	}
}