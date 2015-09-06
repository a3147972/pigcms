<?php
class InvitcodeAction extends BaseAction
{
    /**
     * 会员注册邀请码
     * @method member
     * @return [type] [description]
     */
    public function member()
    {
        $type = 1;
        $list = $this->lists($type);
        $this->assign('list', $list['_list']);
        $this->assign('type', $type);

        $this->assign('pagebar', $list['_page']);
        $this->display();
    }

    /**
     * 商家注册邀请码
     * @method merchant
     * @return [type]   [description]
     */
    public function merchant()
    {
        $type = 2;
        $list = $this->lists($type);
        $this->assign('list', $list['_list']);
        $this->assign('type', $type);

        $this->assign('pagebar', $list['_page']);
        $this->display();
    }

    /**
     * 获取列表数据
     * @method lists
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function lists($type)
    {
        $model = D('Invitcode');

        $map['type'] = $type;

        $count = $model->where($map)->count();

        import('@.ORG.system_page');
        $p = new Page($count, 15);

        $_list = $model->where($map)->order('is_used asc,id desc')->limit($p->firstRow . ',' . $p->listRows)->select();

        $_page = $p->show();

        $list['_list'] = $_list;
        $list['_page'] = $_page;
        return $list;
    }

    /**
     * 生成验证码
     * @method create
     * @return [type] [description]
     */
    public function create()
    {
        $type = I('type', 1);

        $list = array();

        for ($i = 0; $i < 10; $i++) {
            $list[$i]['id'] = null;
            $list[$i]['code'] = create_guid();
            $list[$i]['type'] = $type;
            $list[$i]['is_used'] = 0;
            $list[$i]['utime'] = null;
            $list[$i]['ctime'] = date('Y-m-d H:i:s', time());
        }
        $result = D('Invitcode')->addAll($list);
        if ($result) {
            $this->success('生成邀请码成功');
        } else {
            $this->error('生成失败');
        }
    }
}
