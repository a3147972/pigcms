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

    public function merchant_index()
    {
        $map['recomment'] = session('user.uid');
        $map['invit_type'] = 1;
        $list = D('Merchant')->where($map)->select();

        $this->assign('list', $list);
        $this->display();
    }
}
