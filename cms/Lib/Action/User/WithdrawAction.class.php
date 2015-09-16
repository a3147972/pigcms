<?php
class WithdrawAction extends BaseAction
{
    public function recharge()
    {
        $uid = session('user.uid');
        $type = 1;
        $amount = I('money');
        $user_info = D('User')->get_user($uid);
        $balance = $user_info['now_money'];

        if ($amount < 100) {
            $this->error('提现最小金额为100元');
        }

        if ($amount > $balance) {
            $this->error('提现金额不得大于自己的余额');
        }

        if ($amount % 100 != 0) {
            $this->error('请输入100的倍数');
        }

        $result = D('Withdraw')->addWithdraw($uid, $type, $amount);

        if ($result) {
            D('User')->user_money($uid, $amount, '提现申请');
            $this->success('提交申请成功');
        } else {
            $this->error('提交申请失败');
        }
    }
}
