<?php
class WithdrawAction extends BaseAction
{
    public function recharge()
    {
        $uid = session('user.uid');
        $type = 1;
        $amount = I('money');
        $now_amount = session('user.now_money');

        if ($amount < 100) {
            $this->error('提现最小金额为100元');
        }

        if ($amount > $now_amount) {
            $this->error('提现金额不得大于自己的余额');
        }

        if ($amount % 100 != 0) {
            $this->error('请输入100的倍数');
        }

        $result = D('Withdraw')->addWithdraw($uid, $type, $amount);

        if ($result) {
            $this->success('提交申请成功');
        } else {
            $this->error('提交申请失败');
        }
    }
}
