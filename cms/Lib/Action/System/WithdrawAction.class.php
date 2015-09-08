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

    public function status()
    {
        $model = D('Withdraw');

        $status = I('status');
        $id = I('id');

        $map['id'] = $id;
        $data['status'] = $status;

        $result = $model->where($map)->save($data);
        if ($result) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }
}