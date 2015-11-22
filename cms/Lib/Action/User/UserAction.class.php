<?php
class UserAction extends BaseAction
{
    public function index()
    {
        $uid = I('get.uid', session('user.uid'));
        $list = D('User')->where(array('recomment' => $uid))->select();

        $d_list = $this->selectRecomment();
        if (in_array($uid, $d_list)) {
            $this->assign('last', 1);
        }
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

    private function selectRecomment()
    {
        $b_uid_list = D('User')->where(array('recomment' => session('uid')))->field('uid')->select();
        $b_uid_list = array_column($b_uid_list, 'uid');

        //查询c
        $c_uid_list = D('User')->where(array('recomment' => array('in', $b_uid_list)))->field('uid')->select();
        $c_uid_list = array_column($c_uid_list, 'uid');

        //查询d
        $d_uid_list = D('User')->where(array('recomment' => array('in', $c_uid_list)))->field('uid')->select();
        $d_uid_list = array_column($d_uid_list, 'uid');

        return $d_uid_list;
    }

    /**
     * 个人资料
     * @method info
     */
    public function info()
    {
        if (IS_POST) {
            $model = D('User');
            $map['uid'] = session('user.uid');

            if (!$model->create()) {
                $this->error($model->getError());
            }

            $result = $model->where($map)->save();

            if ($result !== false) {
                $this->success('更新成功');
            } else {
                $this->error('更新失败');
            }
        } else {
            $info = D('User')->get_user(session('user.uid'), 'uid');
            $this->assign('info', $info);
            $this->display();
        }
    }
}
