<?php
/*
 * 生活服务
 *
 */
class LifeserviceAction extends BaseAction{
    public function post(){
		if(IS_POST && IS_AJAX){
			
		}else{
			exit(json_encode(array('error_code'=>1000,'err_msg'=>'非法访问')));
		}
    }
}