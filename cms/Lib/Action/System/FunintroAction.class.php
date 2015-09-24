<?php
class FunintroAction extends BackAction{
	public function index(){
		$firstNode=M('Node')->where(array('name'=>'Funintro','title'=>'功能介绍'))->order('id ASC')->find();
		$nodeExist=M('Node')->where(array('pid'=>$firstNode['id']))->find();
		if (!$nodeExist){
			$row2=array(
			'name'=>'add',
			'title'=>'添加',
			'status'=>1,
			'remark'=>'0',
			'pid'=>$firstNode['id'],
			'level'=>3,
			'sort'=>0,
			'display'=>2
			);
			M('Node')->add($row2);
		}
		//
		$map = array('type'=>0);
		$UserDB = D('Funintro');
		$count = $UserDB->where($map)->count();
		$Page       = new Page($count,10);// 实例化分页类 传入总记录数
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$nowPage = isset($_GET['p'])?$_GET['p']:1;
		$show       = $Page->show();// 分页显示输出
		$list = $UserDB->where($map)->order('id DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $li){
			$li['content'] = html_entity_decode($li['content']);
		}
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$pid=$this->_get('pid','intval');
		$db = D('Funclass');
		$where='';
		$data=$db->where($where)->select();
		$this->assign('data',$data);
		$this->assign('pid',$pid);
		$this->display();


	}
	public function add(){
		$dbs=M('Funclass');
		$fin=$dbs->where(array('agentid'=>'0'))->find();
		if($fin == ''){
			$this->error('请先添加分类');
		}
		if(IS_POST){
			$pid=$this->_POST('pid','intval');
			$db=D('Funintro');
			$class=$this->_POST('classid');
			if($class == 0){
				$this->error('请选择分类');
			}
			$list = $dbs->where(array('id'=>$class))->getField('name');
			$_POST['class']=$list;
			$db->add($_POST);
			$this->success('添加成功',U('Funintro/index',array('pid'=>$pid,'level'=>3)));exit;
		}else{
			$pid=$this->_GET('pid','intval');
			$funs=D('Funclass');
			$where='';
			$data=$funs->where($where)->select();
			$this->assign('data',$data);
			$this->assign('pid',$pid);
			$this->assign('info',array('isnew'=>0));
			$this->display();
		}
	}
	public function edit(){
		if(IS_POST){
			$pid=$this->_POST('pid','intval');
			$db=D('Funintro');
			$dbs=D('Funclass');
			$class=$this->_POST('classid');
			$list = $dbs->where(array('id'=>$class))->getField('name');
			$_POST['class']=$list;
			$db->save($_POST);
			$this->success('修改成功',U("Funintro/index",array('pid'=>$pid,'level'=>3)));exit;
		}else{
			$pid=$this->_get('pid','intval');
			$fun=M('Funintro')->where(array('id'=>intval($_GET['id'])))->find();
			$classid=$fun['classid'];
			$funs=D('Funclass');
			$where='';
			$data=$funs->where($where)->select();
			$this->assign('data',$data);
			$this->assign('classid',$classid);
			$this->assign('info',$fun);
			$this->assign('pid',$pid);
			$this->display('add');
		}
	}
	public function del(){
		if(IS_POST){
			$this->all_save();
		}else{
			$id=$this->_get('id','intval',0);
			if($id==0)$this->error('非法操作');
			$this->assign('tpltitle','编辑');
			$fun=M('Funintro')->where(array('id'=>$id))->delete();
			if($fun==false){
				$this->error('删除失败');
			}else{
				$this->success('删除成功');
			}
		}
	}
	public function addclass(){
		$id=$this->_get('pid');
		$this->assign('id',$id);
		$this->display();
	}
	public function adds(){
		$db=M('Funclass');
		$id=$this->_post('pid');
		$name=$this->_POST('name');
		$data=$db->where(array('name'=>$name,'agentid'=>'0'))->find();
		if($data != ''){
			$this->error('已有此分类',U('Funintro/addclass'));
		}
		$list=$db->add($_POST);
		if($list){
			$this->success('操作成功',U('Funintro/indexs',array('pid'=>$id,'level'=>3)));
		}else{
			$this->error('操作失败',U('Funintro/addclass',array('pid'=>$id,'level'=>3)));
		}
	}
	public function indexs(){
		$pid=$this->_get('pid','intval');
		$db=M('Funclass');
		$where='';
		$list = $db->where($where)->select();
		$this->assign('list',$list);
		$this->assign('pid',$pid);
		$this->display();
	}
	public function upsaves(){
		$db=M('Funclass');
		$id=$this->_POST('id','intval');
		$pid=$this->_POST('pid','intval');
		$list=$db->where(array('id'=>$id))->save($_POST);
		if($list){
			$dbs=D('Funintro');
			$data['class'] = $this->_POST('name');
			$dbs->where(array('classid'=>$id))->save($data);
			$this->success('操作成功',U('Funintro/indexs',array('pid'=>$pid,'level'=>3)));
		}else{
			$this->error('操作失败',U('Funintro/edits',array('pid'=>$pid,'id'=>$id)));
		}	
	}
	public function edits(){
		$id=$this->_get('pid','intval');
		$pid=$this->_get('id','intval');
		$info=D('Funclass')->where(array('id'=>$pid))->find();
		$this->assign('info',$info);
		$this->assign('id',$id);
		$this->display('addclass');
	}
	//批量设置分类。
	public function search(){
		$db = D('Funintro');
		$pid=$this->_POST('pid');
    	$test = $this->_POST('test');
    	$class= $this->_POST('class');
    	$dbs=D('Funclass');
    	$name=$dbs->where(array('id'=>$class))->getField('name');
    	$where['id']= array('in',$test);
    	if($test == 0){
    		$this->success('请选择分类',U('Funintro/index',array('pid'=>$pid,'level'=>3)));exit;
    	}
    	$data['classid']=$class;
    	$data['class']=$name;
    	$list = $db->where($where)->save($data);
    	if($list){
    		$this->success('设置成功！',U('Funintro/index',array('pid'=>$pid,'level'=>3))); 
    	}else{
    		$this->error('操作失败！',U('Funintro/index',array('pid'=>$pid,'level'=>3)));   
    	}
	}
	public function dels(){
		$id=$this->_get('id','intval',0);
		if($id==0)$this->error('非法操作');
		$fun=M('Funclass')->where(array('id'=>$id))->delete();
		if($fun==false){
			$this->error('删除失败');
		}else{
			$this->success('删除成功');
		}
	}
	
}
?>