<?php
class WithdrawAction extends BaseAction
{
    public function index()
    {
        $model = D('Withdraw');

        $count = $model->count();
        import('@.ORG.system_page');
        $p = new Page($count, 15);
        $list = $model->field(true)->order('id desc')->limit($p->firstRow . ',' . $p->listRows)->select();

        $this->assign('list', $list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }

    /**
     * 申请处理
     * @method status
     * @return [type] [description]
     */
    public function status()
    {
        $model = D('Withdraw');

        $status = I('status');
        $id = I('id');

        $map['id'] = $id;
        $data['status'] = $status;

        $result = $model->where($map)->save($data);
        if ($result) {
            if ($status == -1) {        //申请驳回则返还金额
                $info = $model->where($map)->find();
                switch($info['type']) {
                    case 1: //返还会员的钱
                        $result  = D('User')->add_money($info['uid'], $info['amount'], '提现申请驳回返还金额');
                        break;
                    case 2:
                        $result = D('Merchant')->addBalance($info['uid'], $info['amount']);
                        break;
                }
            }
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }
}