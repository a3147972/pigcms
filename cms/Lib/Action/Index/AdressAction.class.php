<?php
/*
 * 选择地址
 *
 */
class AdressAction extends BaseAction{
    public function frame(){
		if(empty($this->user_session)){
			$this->assign('error_msg','请先进行登录，再刷新此页面！<a href="'.U('Index/Login/index').'" target="_blank">去登录</a>&nbsp;&nbsp;<a href="'.U('Index/Adress/frame').'" style="color:blue;">刷新</a>');
		}else{
			$adress_list = D('User_adress')->get_adress_list($this->user_session['uid']);
			if(!empty($adress_list)){
				$this->assign('adress_list',$adress_list);
			}else{
				$this->assign('error_msg','请先添加您的收货地址再点“刷新”按钮！<a href="'.U('User/Adress/index').'" target="_blank">去添加</a>&nbsp;&nbsp;<a href="'.U('Index/Adress/frame').'" style="color:blue;">刷新</a>');
			}
		}
		$this->display();
    }
}