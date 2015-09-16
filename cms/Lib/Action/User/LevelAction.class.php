<?php
/*
 * 积分
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/29 16:09
 * 
 */
class LevelAction extends BaseAction {
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
		
		//余额记录列表
		
		$this->display();
    }

	 public function levelUpdate(){
		 $needlevel=1;
	     if(!empty($this->user_level) && isset($this->user_level[$this->now_user['level']])){
		   $needlevel=$this->user_level[$this->now_user['level']]['level']+1;
		 }
		 if(isset($this->user_level[$needlevel])){
		   if($this->now_user['score_count']>=$this->user_level[$needlevel]['integral']){
		     $levelarr=array('level'=>$needlevel);
			 $levelarr['score_count']=$this->now_user['score_count']-$this->user_level[$needlevel]['integral'];
			 if(D('User')->where(array('uid'=>$this->now_user['uid']))->save($levelarr)){
			   $this->dexit(array('error'=>0,'msg'=>'恭喜您，升级成功！'));
			 }else{
			   $this->dexit(array('error'=>1,'msg'=>'升级失败！'));
			 }
		   }else{
		     $this->dexit(array('error'=>1,'msg'=>'您当前积分不够升级所需！'));
		   }
		 }else{
		    $this->dexit(array('error'=>1,'msg'=>'没有更高等级了！'));
		 }
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