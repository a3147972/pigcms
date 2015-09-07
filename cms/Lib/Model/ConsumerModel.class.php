<?php
class ConsumerModel extends BaseModel
{
    /**
     * 执行消费返利
     * @method rebate
     * @param  int $uid 会员id
     * @param int $order_money 订单支付金额
     * @return  bool 返现是否成功
     */
    public function rebate($uid, $order_money = 0)
    {
        //金额小于1则不执行返现
        if ($order_money < 1) {
            return;
        }
        $info = D('User')->where(array('uid' => $uid))->find();

        if (empty($info['recomment'])) {
            return;
        }

        $d_info = D('User')->where(array('uid' => $info['recomment']))->find();
        $d = $d_info['uid'];

        if (!empty($d_info['recomment'])) {
            $c_info = D('User')->where(array('uid' => $d_info['recomment']))->find();
            $c = $d_info['uid'];
        }

        if (!empty($c_info['recomment'])) {
            $b_info = D('User')->where(array('uid' => $c_info['recomment']))->find();
            $b = $b_info['uid'];
        }

        if (!empty($b_info['recomment'])) {
            $a_info = D('User')->where(array('uid' => $b_info['recomment']))->find();
            $a = $a_info['uid'];
        }

        $level = 0;
        if (isset($a)) {
            $level = $level + 1;
        }
        if (isset($b)) {
            $level = $level + 1;
        }
        if (isset($c)) {
            $level = $level + 1;
        }
        if (isset($d)) {
            $level = $level + 1;
        }

        $a_rebate_ratio = (float) $this->config['a_consumer_rebate'] / 100;
        $b_rebate_ratio = (float) $this->config['b_consumer_rebate'] / 100;
        $c_rebate_ratio = (float) $this->config['c_consumer_rebate'] / 100;
        $d_rebate_ratio = (float) $this->config['d_consumer_rebate'] / 100;

        $a_rebate_ratio = (float) $this->config['reg_a_rebate'] / 100;
        $b_rebate_ratio = (float) $this->config['reg_b_rebate'] / 100;
        $c_rebate_ratio = (float) $this->config['reg_c_rebate'] / 100;
        $d_rebate_ratio = (float) $this->config['reg_d_rebate'] / 100;
        switch ($level) {
            case 1:    //只有一层,则只给d返
                $d_money = number_format($order_money * $a_rebate_ratio, 2);
                $d_info['now_money'] = number_format($d_info['now_money'] + $d_money, 2);
                $data[0] = $d_info;
                break;
            case 2:    //给d和c返现
                $c_money = number_format($order_money * $a_rebate_ratio, 2);
                $d_money = number_format($order_money * $b_rebate_ratio, 2);
                $c_info['now_money'] = number_format($c_info['now_money'] + $c_money, 2);
                $d_info['now_money'] = number_format($d_info['now_money'] + $d_money, 2);
                $data[0] = $c_info;
                $data[1] = $d_info;
                break;
            case 3:    //给d,c,b返现
                $b_money = number_format($order_money * $a_rebate_ratio, 2);
                $c_money = number_format($order_money * $b_rebate_ratio, 2);
                $d_money = number_format($order_money * $c_rebate_ratio, 2);

                $b_info['now_money'] = number_format($b_info['now_money'] + $b_money, 2);
                $c_info['now_money'] = number_format($c_info['now_money'] + $c_money, 2);
                $d_info['now_money'] = number_format($d_info['now_money'] + $d_money, 2);

                $data[0] = $b_info;
                $data[1] = $c_info;
                $data[2] = $d_info;
                break;
            case 4:    //给d,c,b,a返现
                $a_money = number_format($order_money * $a_rebate_ratio, 2);
                $b_money = number_format($order_money * $b_rebate_ratio, 2);
                $c_money = number_format($order_money * $c_rebate_ratio, 2);
                $d_money = number_format($order_money * $d_rebate_ratio, 2);

                $a_info['now_money'] = number_format($a_info['now_money'] + $a_money, 2);
                $b_info['now_money'] = number_format($a_info['now_money'] + $b_money, 2);
                $c_info['now_money'] = number_format($a_info['now_money'] + $c_money, 2);
                $d_info['now_money'] = number_format($a_info['now_money'] + $d_money, 2);

                $data[0] = $a_info;
                $data[1] = $b_info;
                $data[2] = $c_info;
                $data[3] = $d_info;
                break;
        }

        $result = $this->addAll($data, array(), true);

        if ($result) {
            return $a_money + $b_money + $c_money + $d_money;
        } else {
            return false;
        }
    }

    /**
     * 营业额返利
     * @method saleRebate
     * @param  int     $mer_id      商户id
     * @param  integer    $order_money 订单金额
     * @return bool|int                成功返回返利金额,失败返回false
     */
    public function saleRebate($mer_id, $order_money = 0)
    {
        if ($order_money < 1) {
            return true;
        }

        //获取商家的推荐人
        $mer_info = D('Merchant')->where(array('mer_id'=> $mer_id))->find();

        if (empty($mer_info)) {
            return true;
        }

        $invite_type = $mer_info['invit_type'];
        $recomment = $mer_info['recomment'];

        $invite_rebate = (float) $this->config['invite_rebate'] / 100;
        $rebate_balance = number_format($order_money * $invite_rebate, 2);
        switch ($invite_type) {
            case 1:     //用户推荐
                $map['uid'] = $recomment;
                $data['now_money'] = array('exp', 'now_money+' . $rebate_balance);
                $result = D('User')->where($map)->save($data);
                break;
            case 2:     //商户推荐
                $map['mer_id'] = $recomment;
                $data['balance'] = array('exp', 'balance+'.$rebate_balance);
                $result = D('Merchant')->where($map)->save($data);
                break;
        }

        if ($result) {
            return $rebate_balance;
        } else {
            return false;
        }
    }
}
