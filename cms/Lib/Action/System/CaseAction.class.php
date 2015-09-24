<?php
class CaseAction extends BackAction{
	public function index(){
		$db=D('Case');
		$where='';
		S('case',null);
		if (!C('agent_version')){
			$case=$db->where('status=1')->limit(32)->select();
		}else {
			$case=$db->where('status=1 AND agentid=0')->limit(32)->select();
			$where=array('agentid'=>0);
		}
		
		S('case',$case);
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
		$this->assign('info',$info);
		$this->assign('page',$page->show());
		$pid=$this->_get('pid','intval');
		$this->assign('pid',$pid);
		$this->display();
	}
	public function add(){
		$db=M('Caseclass');
		$data=$db->where(array('agentid'=>'0'))->find();
		if($data == ''){
			$this->error('请先添加分类');
		}
		$pid=$this->_get('pid','intval');
		$where='';
		$list=$db->where($where)->select();
		$this->assign('list',$list);
		$this->assign('pid',$pid);
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$pid=$this->_get('pid','intval');
		$info=D('Case')->find($id);
		$this->assign('info',$info);

		$db=M('Caseclass');
		$where='';
		$list=$db->where($where)->select();
		$this->assign('pid',$pid);
		$this->assign('list',$list);
		$this->display('add');
	}
	
	public function del(){
		$db=D('Case');
		$pid=$this->_get('pid','intval');
		$id=$this->_get('id','intval');
		if($db->delete($id)){
			$this->success('操作成功',U(MODULE_NAME.'/index',array('pid'=>$pid,'level'=>3)));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index',array('pid'=>$pid,'level'=>3)));
		}
	}
	
	public function insert(){
		$thumb['width']='48';
		$thumb['height']='48';
		//$arr=$this->_upload($_FILES['img'],$dir='',$thumb);
		/*
		if($arr['error']===0){
			$_POST['img']=C('site_url').$arr['info'][0]['savepath'].$arr['info'][0]['savename'];
		}else{
			$this->error($arr['info'],U('Case/index'));
		}
		*/
		$db=D('Case');
		$id=$this->_POST('class');
		$pid=$this->_POST('pid','intval');
		$dbs=M('Caseclass');
		$list=$dbs->where(array('id'=>$id,'agentid'=>'0'))->find();
		if($list == ''){
			$this->error('请选择分类');
		}
		$data['classid']=$list['name'];
		$data['name']=$this->_POST('name');
		$data['class']=$this->_POST('class');
		$data['timg']=$this->_POST('timg');
		$data['img']=$this->_POST('img');
		$data['url']=$this->_POST('url');
		$data['status']=$this->_POST('status');

		if($db->add($data)){
			$this->success('操作成功',U('Case/index',array('pid'=>$pid,'level'=>3)));
		}else{
			$this->error('操作失败',U('Case/index',array('pid'=>$pid,'level'=>3)));
		}
	}
	
	public function upsave(){
		$db=D('Case');
		/*
		if($_POST['img']!=false){
			$thumb['width']='48';
			$thumb['height']='48';
			//$arr=$this->_upload($_FILES['img'],$dir='',$thumb);
			if($arr['error']===0){
				$_POST['img']=C('site_url').$arr['info'][0]['savepath'].$arr['info'][0]['savename'];
			}else{
				$this->error($arr['info'],U('Case/index'));
			}
			unlink($arr['info'][0]['savepath'].$arr['info'][0]['savename']);
		}
		*/
		$id=$this->_POST('class');
		$pid=$this->_POST('pid','intval');
		$cid=$this->_POST('id');

		$dbs=M('Caseclass');
		$list=$dbs->where(array('id'=>$id))->find();
		$data['classid']=$list['name'];
		$data['name']=$this->_POST('name');
		$data['class']=$this->_POST('class');
		$data['timg']=$this->_POST('timg');
		$data['img']=$this->_POST('img');
		$data['url']=$this->_POST('url');
		$data['status']=$this->_POST('status');
		$slet = $db->where(array('id'=>$cid))->save($data);
		if($slet){
			$this->success('操作成功',U('Case/index',array('pid'=>$pid,'level'=>3)));
		}else{
			$this->error('操作失败',U('Case/index',array('pid'=>$pid,'level'=>3)));
		}
	}
	
	//案例分类
	public function addclass(){
		$id=$this->_get('pid');
		$this->assign('id',$id);
		$this->display();
	}

	public function adds(){
		$db=M('Caseclass');
		$id=$this->_post('pid');
		$name=$this->_POST('name');
		$data=$db->where(array('name'=>$name))->find();
		if($data != ''){
			$this->error('已有此分类',U('Case/addclass'));
		}
		$list=$db->add($_POST);
		if($list){
			$this->success('操作成功',U('Case/indexs',array('pid'=>$id,'level'=>3)));
		}else{
			$this->error('操作失败',U('Case/addclass',array('pid'=>$id,'level'=>3)));
		}
	}

	public function upsaves(){
		$db=M('Caseclass');
		$id=$this->_POST('id','intval');
		$pid=$this->_POST('pid','intval');
		$list=$db->where(array('id'=>$id))->save($_POST);
		if($list){
			$dbs=D('Case');
			$data['classid'] = $this->_POST('name');
			$dbs->where(array('class'=>$id))->save($data);
			$this->success('操作成功',U('Case/indexs',array('pid'=>$pid,'level'=>3)));
		}else{
			$this->error('操作失败',U('Case/edits',array('pid'=>$pid,'id'=>$id)));
		}	
	}

	public function indexs(){
		$pid=$this->_get('pid','intval');
		$db=M('Caseclass');
		$where='';
		$list=$db->where($where)->select();
		$this->assign('list',$list);
		$this->assign('pid',$pid);
		$this->display();
	}

	public function edits(){
		$id=$this->_get('pid','intval');
		$pid=$this->_get('id','intval');
		$info=D('Caseclass')->find($pid);
		$this->assign('info',$info);
		$this->assign('id',$id);
		$this->display('addclass');
	}
	
	public function dels(){
		$db=D('Caseclass');
		$pid=$this->_get('pid','intval');
		$id=$this->_get('id','intval');
		if($db->delete($id)){
			$dbs=D('Case');
			$data['classid'] = '';
			$data['class'] ='0';
			$dbs->where(array('class'=>$id))->save($data);
			$this->success('操作成功',U(MODULE_NAME.'/indexs',array('pid'=>$pid,'level'=>3)));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/indexs',array('pid'=>$pid,'level'=>3)));
		}
	}
}