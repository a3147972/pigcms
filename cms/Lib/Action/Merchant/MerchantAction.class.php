<?php
class MerchantAction extends BaseAction
{
    public function rebate()
    {
        if (IS_POST) {
            $user_id = I('post.user_id');
            $money = I('post.money');

            if (empty($user_id)) {
                $this->error('请输入用户id');
            }
            if (empty($money)) {
                $this->error('请输入消费金额');
            }

            if (session('merchant.balance') < 500) {
                $this->error('您账户余额大于500才可以进行此操作');
            }
            $mer_id = session('merchant.mer_id');
            //执行推荐返利
            $rebate_balance = D('Consumer')->rebate($mer_id, $user_id, $money);

            $rebate_balance = empty($rebate_balance) ? 0 : $rebate_balance;

            //营业额返利
            $sale_rebate = D('Consumer')->saleRebate($mer_id, $money);
            $percent_balance = D('Merchant')->platform_get_percent($now_order['mer_id'], $money);
            if ($rebate_balance !== false && $sale_rebate !== false && $percent_balance !== false) {
                $this->success('成功进行返利');
            }
        } else {
            $this->display();
        }
    }
}
