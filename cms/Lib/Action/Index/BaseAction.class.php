<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
        parent::_initialize();
	
   }

    public function _empty()
    {
        exit("你搞错了。");
    }
}


?>
