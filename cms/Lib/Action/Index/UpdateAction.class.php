<?php

class UpdateAction extends BaseAction{
    public function index(){
		$sql = file_get_contents('./sql.sql');
		$sqls = explode(';',$sql);
		foreach($sqls as $value){
			$value = trim($value);
			if(!empty($value)){
				dump(D('')->query($value));
				dump($value);
				echo '<br/><br/>';
			}
		}
    }
}