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

            $percent_balance = D('Merchant')->platform_get_percent(session('merchant.mer_id'), $money);

            $rebate_balance = D('Consumer')->getRebateMoney(session('merchant.mer_id'), $user_id, $money);

            $sale_rebate = D('Consumer')->getSaleRebate(session('merchant.mer_id'), $money);
            dump($sale_rebate);exit();
            if (session('merchant.balance') < ($percent_balance + $rebate_balance + $sale_rebate)) {
                $this->error('您账户余额大于'.$percent_balance + $rebate_balance + $sale_rebate.'才可以进行此操作');
            }
            $mer_id = session('merchant.mer_id');
            //执行推荐返利
            $rebate_balance_result = D('Consumer')->rebate($mer_id, $user_id, $money);

            $rebate_balance_result = empty($rebate_balance) ? 0 : $rebate_balance;

            //营业额返利
            $sale_rebate_result = D('Consumer')->saleRebate($mer_id, $money);

            if ($rebate_balance_result !== false && $sale_rebate_result !== false) {
                $rebate_money = $rebate_balance + $sale_rebate + $percent_balance;
                if (D('Merchant')->useBalance($mer_id, $rebate_money)) {
                    $this->success('成功进行返利');
                } else {
                    $this->error('余额不足');
                }
            }
        } else {
            $this->assign('balance', session('merchant.balance'));
            $this->display();
        }
    }
}
