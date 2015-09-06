<?php

class EmptyAction extends BaseAction
{
    public function index()
    {
        $this->error_tips("你搞错了。页面不存在！");
    }
}


?>
