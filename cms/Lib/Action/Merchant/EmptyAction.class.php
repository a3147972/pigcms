<?php

class EmptyAction extends BaseAction
{
    public function index()
    {
        $this->error("您访问错了！该页面不存在。");
    }
}


?>
