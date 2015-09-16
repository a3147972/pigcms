<?php
/*
 * 团购管理
 *
 */

class GroupAction extends BaseAction{
    public function index(){
		$database_group_category = D('Group_category');
		$condition_group_category['cat_fid'] = intval($_GET['cat_fid']);
		
		$count_group_category = $database_group_category->where($condition_group_category)->count();
		import('@.ORG.system_page');
		$p = new Page($count_group_category,50);
		$category_list = $database_group_category->field(true)->where($condition_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('category_list',$category_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		if($_GET['cat_fid']){
			$condition_now_group_category['cat_id'] = intval($_GET['cat_fid']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			if(empty($now_category)){
				$this->error_tips('没有找到该分类信息！',3,U('Group/index'));
			}
			$this->assign('now_category',$now_category);
		}
		
		$this->display();
    }
	public function cat_add(){
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function cat_modify(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			if($database_group_category->data($_POST)->add()){
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
		
		$database_group_category = D('Group_category');
		$condition_now_group_category['cat_id'] = intval($_GET['cat_id']);
		$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
		if(empty($now_category)){
			$this->frame_error_tips('没有找到该分类信息！');
		}
		$this->assign('now_category',$now_category);
		$this->display();
	}
	public function cat_amend(){
		if(IS_POST){
			//上传图片
			$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
			$upload_dir = './upload/system/'.$rand_num.'/'; 
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
				$_POST['cat_pic'] = $rand_num.'/'.$uploadList[0]['savename'];
			}else{
				$this->frame_submit_tips(0,$upload->getErrorMsg());
			}
		
			$database_group_category = D('Group_category');
			if($database_group_category->data($_POST)->save()){
				$this->frame_submit_tips(1,'编辑成功！');
			}else{
				$this->frame_submit_tips(0,'编辑失败！请重试~');
			}
		}else{
			$this->frame_submit_tips(0,'非法提交,请重新提交~');
		}
	}
	public function cat_del(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			if($database_group_category->where($condition_now_group_category)->delete()){
				if(empty($now_category['cat_fid'])){
					$condition_son_group_category['cat_fid'] = $now_category['cat_id'];
					$database_group_category->where($condition_son_group_category)->delete();
					$condition_group['cat_fid'] = $now_category['cat_id'];
				}else{
					$condition_group['cat_id'] = $now_category['cat_id'];
				}
				D('Group')->where($condition_group)->delete();
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_field(){
		$database_group_category = D('Group_category');
		$condition_now_group_category['cat_id'] = intval($_GET['cat_id']);
		$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
		if(empty($now_category)){
			$this->frame_error_tips('没有找到该分类信息！');
		}
		if(!empty($now_category['cat_fid'])){
			$this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
		}
		if(!empty($now_category['cat_field'])){
			$now_category['cat_field'] = unserialize($now_category['cat_field']);
			foreach($now_category['cat_field'] as $key=>$value){
				if($value['use_field'] == 'area'){
					$now_category['cat_field'][$key]['name'] = '区域(内置)';
					$now_category['cat_field'][$key]['url'] = 'area';
				}
				if($value['use_field'] == 'price'){
					$now_category['cat_field'][$key]['name'] = '价格(内置)';
					$now_category['cat_field'][$key]['url'] = 'area';
				}
			}
		}
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	public function cat_field_add(){
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function cat_field_modify(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			
			if(!empty($now_category['cat_field'])){
				$cat_field = unserialize($now_category['cat_field']);
				foreach($cat_field as $key=>$value){
					if( (!empty($_POST['use_field']) && $value['use_field'] == $_POST['use_field']) || (!empty($_POST['url']) && $value['url'] == $_POST['url']) ){
						$this->error('字段已经添加，请勿重复添加！');
					}
				}
			}else{
				$cat_field = array();
			}
			if(count($cat_field) >= 5){
				$this->error('添加字段失败，最多5个自定义字段！');
			}
			if(empty($_POST['use_field'])){
				$post_data['name'] = $_POST['name'];
				$post_data['url'] = $_POST['url'];
				$post_data['value'] = explode(PHP_EOL,$_POST['value']);
				$post_data['type'] = $_POST['type'];
				
				//$post_data['sort'] = strval($_POST['sort']);
				//$post_data['status'] = strval($_POST['status']);
			}else{
				$post_data['use_field'] = $_POST['use_field'];
				
				//$post_data['sort'] = strval($_POST['sort']);
				//$post_data['status'] = strval($_POST['status']);
			}

			array_push($cat_field,$post_data);
			$data_group_category['cat_field'] = serialize($cat_field);
			$data_group_category['cat_id'] = $now_category['cat_id'];
			if($database_group_category->data($data_group_category)->save()){
				$this->success('添加字段成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cue_field(){
		$database_group_category = D('Group_category');
		$condition_now_group_category['cat_id'] = intval($_GET['cat_id']);
		$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
		if(empty($now_category)){
			$this->frame_error_tips('没有找到该分类信息！');
		}
		if(!empty($now_category['cat_fid'])){
			$this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
		}
		if(!empty($now_category['cue_field'])){
			$now_category['cue_field'] = unserialize($now_category['cue_field']);
		}
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	public function cue_field_add(){
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function cue_field_modify(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			
			if(!empty($now_category['cue_field'])){
				$cue_field = unserialize($now_category['cue_field']);
				foreach($cue_field as $key=>$value){
					if($value['name'] == $_POST['name']){
						$this->error('该填写项已经添加，请勿重复添加！');
					}
				}
			}else{
				$cue_field = array();
			}

			$post_data['name'] = $_POST['name'];
			$post_data['type'] = $_POST['type'];
			$post_data['sort'] = strval($_POST['sort']);

			array_push($cue_field,$post_data);
			$data_group_category['cue_field'] = serialize($cue_field);
			$data_group_category['cat_id'] = $now_category['cat_id'];
			if($database_group_category->data($data_group_category)->save()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cue_field_del(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			
			if(!empty($now_category['cue_field'])){
				$cue_field = unserialize($now_category['cue_field']);
				$new_cue_field = array();
				foreach($cue_field as $key=>$value){
					if($value['name'] != $_POST['name']){
						array_push($new_cue_field,$value);
					}
				}
			}else{
				$this->error('此填写项不存在！');
			}
			$data_group_category['cue_field'] = serialize($new_cue_field);
			$data_group_category['cat_id'] = $now_category['cat_id'];
			if($database_group_category->data($data_group_category)->save()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function store_add(){
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = intval($_GET['mer_id']);
		$merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($merchant)){
			$this->frame_error_tips('数据库中没有查询到该商户的信息！无法添加店铺。',5);
		}
		$this->assign('merchant',$merchant);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function store_modify(){
		if(IS_POST){
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['add_from'] = '1';
			$database_merchant_store = D('Merchant_store');
			if($database_merchant_store->data($_POST)->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	
	public function store_edit(){
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = intval($_GET['store_id']);
		$store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
		if(empty($store)){
			$this->frame_error_tips('数据库中没有查询到该店铺的信息！',5);
		}
		$this->assign('store',$store);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	
	public function store_amend(){
		if(IS_POST){
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$database_merchant_store = D('Merchant_store');
			if($database_merchant_store->data($_POST)->save()){
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！请检查内容是否有过修改（必须修改）后重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function store_del(){
		if(IS_POST){
			$database_merchant_store = D('Merchant_store');
			$condition_merchant_store['store_id'] = intval($_POST['store_id']);
			if($database_merchant_store->where($condition_merchant_store)->delete()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	/*待商品列表*/
	public function wait_product(){
		//搜索
		$condition_where = "`gs`.`group_id`=`g`.`group_id` AND `g`.`status`='2'";
		if ($this->system_session['area_id']) {
			$condition_where .= " AND `gs`.`area_id`='{$this->system_session['area_id']}' ";
		}
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'group_id'){
				$condition_where .= " AND `g`.`group_id`=" . intval($_GET['keyword']);
			}else if($_GET['searchtype'] == 's_name'){
				$condition_where .= " AND `g`.`s_name` LIKE '%" . $_GET['keyword'] . "%'";
			}else if($_GET['searchtype'] == 'name'){
				$condition_where .= " AND `g`.`name` LIKE '%" . $_GET['keyword'] . "%'";
			}
		}
		//指定商家
		if(!empty($_GET['mer_id'])){
			$condition_where .= " AND `g`.`mer_id`=" . intval($_GET['mer_id']);
		}
		
		$condition_table  = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_store'=>'gs');
		$condition_field  = '`g`.*,`gs`.*';

		import('@.ORG.system_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `g`.`group_id`');
		$p = new Page($count_group, 20);
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order('`g`.`group_id` DESC')->group('`g`.`group_id`')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('group_list', $group_list);

		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		
		$this->display();
	}
	/*商品管理*/
	public function product(){
		//搜索
		$condition_where = "`gs`.`group_id`=`g`.`group_id` AND `g`.`status`<>'2'";
		if ($this->system_session['area_id']) {
			$condition_where .= " AND `gs`.`area_id`='{$this->system_session['area_id']}' ";
		}
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'group_id'){
				$condition_where .= " AND `g`.`group_id`=" . intval($_GET['keyword']);
			}else if($_GET['searchtype'] == 's_name'){
				$condition_where .= " AND `g`.`s_name` LIKE '%" . $_GET['keyword'] . "%'";
			}else if($_GET['searchtype'] == 'name'){
				$condition_where .= " AND `g`.`name` LIKE '%" . $_GET['keyword'] . "%'";
			}
		}
		//指定商家
		if(!empty($_GET['mer_id'])){
			$condition_where .= " AND `g`.`mer_id`=" . intval($_GET['mer_id']);
		}
		
		$condition_table  = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_store'=>'gs');
		$condition_field  = '`g`.*,`gs`.*';

		import('@.ORG.system_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `g`.`group_id`');
		$p = new Page($count_group, 20);
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order('`g`.`group_id` DESC')->group('`g`.`group_id`')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('group_list', $group_list);

		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		
		$this->display();
	}
	/*商品编辑*/
	public function group_edit(){
		
		$this->display();
	}
	/*订单列表*/
	public function order_list(){
		//团购信息
		$database_group = D('Group');
		$condition_group['group_id'] = $_GET['group_id'];
		$now_group = $database_group->field(true)->where($condition_group)->find();
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		$this->assign('now_group',$now_group);
		
		//商家信息
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $now_group['mer_id'];
		$now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($now_merchant)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'所属的商家不存在！');
		}
		$this->assign('now_merchant',$now_merchant);
		
		//订单列表
		$group_id = $now_group['group_id'];
		$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`paid`='1' AND `o`.`group_id`='$group_id'";
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'user'=>'u');
		
		$order_count = D('')->where($condition_where)->table($condition_table)->count();
		import('@.ORG.system_page');
		$p = new Page($order_count,30);
		
		$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		if(empty($order_list)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
		}
		$this->assign('order_list',$order_list);
		
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
	}
	/*操作订单*/
	public function order_edit(){
		$this->assign('bg_color','#F3F3F3');
		
		$database_group_order = D('Group_order');
		$condition_group_order['order_id'] = $_GET['order_id'];
		$order = $database_group_order->field('`order_id`,`mer_id`')->where($condition_group_order)->find();

		$now_order = $database_group_order->get_order_detail_by_id_and_merId($order['mer_id'],$order['order_id'],false);
		if(empty($now_order)){
			$this->frame_error_tips('此订单不存在！');
		}
		if($now_order['store_id']){
			$now_store = D('Merchant_store')->field('`name`')->where(array('store_id'=>$now_order['store_id']))->find();
			$now_order['store_name'] = $now_store['name'];
		}
		
		$this->assign('now_order',$now_order);
		$this->display();
	}
	/*评论列表*/
	public function reply_list(){
		//团购信息
		$database_group = D('Group');
		$condition_group['group_id'] = $_GET['group_id'];
		$now_group = $database_group->field(true)->where($condition_group)->find();
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		$this->assign('now_group',$now_group);
		
		//商家信息
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $now_group['mer_id'];
		$now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($now_merchant)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'所属的商家不存在！');
		}
		$this->assign('now_merchant',$now_merchant);
		
		//评论列表
		$group_id = $now_group['group_id'];
		$table = array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o');
		$condition = "`r`.`order_type`='0' AND `r`.`order_id`=`o`.`order_id` AND `o`.`group_id`='$group_id'";
	
		$reply_count = D('')->table($table)->where($condition)->count();
		import('@.ORG.system_page');
		$p = new Page($reply_count,20);
		
		$reply_list = D('')->table($table)->where($condition)->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('reply_list',$reply_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
	
		$this->display();
	}
	public function reply_detail(){
		$this->assign('bg_color','#F3F3F3');
		
		$pigcms_id = $_GET['id'];
		$table = array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o');
		$condition = "`r`.`order_type`='0' AND `r`.`order_id`=`o`.`order_id` AND `r`.`pigcms_id`='$pigcms_id'";
		$reply_detail = D('')->table($table)->where($condition)->find();
		
		if(empty($reply_detail)){
			$this->frame_error_tips('该评论不存在！');
		}
		$this->assign('reply_detail',$reply_detail);
		
		if($reply_detail['pic']){
			$reply_image_class = new reply_image();
			$image_list = $reply_image_class->get_image_by_id($reply_detail['order_id'],0);
			$this->assign('image_list',$image_list);
		}
		
		$this->display();
	}
	public function reply_del(){
		$database_reply = D('Reply');
		$condition_reply['pigcms_id'] = $_POST['id'];
		$now_reply = $database_reply->field(true)->where($condition_reply)->find();
		if(empty($now_reply)){
			$this->frame_error_tips('该评论不存在！');
		}
		if($database_reply->where($condition_reply)->delete()){
			if($now_reply['pic']){
				$reply_image_class = new reply_image();
				$reply_image_class->del_image_by_id($now_reply['order_id'],0);
			}
			//减少团购一个评论数
			$database_group = D('Group');
			$condition_group['group_id'] = $now_reply['parent_id'];
			$database_group->where($condition_group)->setDec('reply_count');
			
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
	
	public function order()
	{
		$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`paid`='1' AND `m`.`mer_id`=`o`.`mer_id`";
		if(!empty($_GET['keyword'])){
			if ($_GET['searchtype'] == 'order_id') {
				$condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
			} elseif ($_GET['searchtype'] == 'name') {
				$condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
			} elseif ($_GET['searchtype'] == 'phone') {
				$condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
			} elseif ($_GET['searchtype'] == 's_name') {
				$condition_where .= " AND `g`.`s_name`='" . htmlspecialchars($_GET['keyword']) . "'";
			}
		}
		$condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m');
		
		$order_count = D('')->where($condition_where)->table($condition_table)->count();
		import('@.ORG.system_page');
		$p = new Page($order_count,30);
		
		$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		if(empty($order_list)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
		}
		$this->assign('order_list',$order_list);
		
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
	}
}