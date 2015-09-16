<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
		$search_hot_list = D("Search_hot")->get_list(12, 1);//add
        $this->assign("search_hot_list", $search_hot_list);//add
		
        parent::_initialize();
    }
}


?>
