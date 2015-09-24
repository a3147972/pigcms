<?php
class UserAction extends BaseAction
{
    public function index()
    {
        $uid = I('get.uid', session('user.uid'));
        $list = D('User')->where(array('recomment' => $uid))->select();

        $this->assign('list', $list);
        $this->display();
    }
}
