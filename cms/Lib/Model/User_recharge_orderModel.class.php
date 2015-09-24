<?php
class User_recharge_orderModel extends Model
{
    public function get_pay_order($uid, $order_id, $is_web = false)
    {
        $now_order = $this->get_order_by_id($uid, $order_id);
        // dump($this);exit;
        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        }

        if ($is_web) {
            $order_info = array(
                'order_id' => $now_order['order_id'],
                'order_type' => 'recharge',
                'order_total_money' => floatval($now_order['money']),
                'order_content' => array(
                    0 => array(
                        'name' => '在线充值',
                        'num' => 1,
                        'price' => floatval($now_order['money']),
                        'money' => floatval($now_order['money']),
                    ),
                ),
            );
        } else {
            $order_info = array(
                'order_id' => $now_order['order_id'],
                'order_type' => 'recharge',
                'order_name' => '在线充值',
                'order_num' => 1,
                'order_price' => floatval($now_order['money']),
                'order_total_money' => floatval($now_order['money']),
            );
        }
        return array('error' => 0, 'order_info' => $order_info);
    }
    public function get_order_by_id($uid, $order_id)
    {
        $condition_user_recharge_order['uid'] = $uid;
        $condition_user_recharge_order['order_id'] = $order_id;
        return $this->field(true)->where($condition_user_recharge_order)->find();
    }
    //电脑站支付前订单处理
    public function web_befor_pay($order_info, $now_user)
    {

        $data_user_recharge_order['last_time'] = $_SERVER['REQUEST_TIME'];
        $data_user_recharge_order['submit_order_time'] = $_SERVER['REQUEST_TIME'];
        $condition_user_recharge_order['order_id'] = $order_info['order_id'];
        if (!$this->where($condition_user_recharge_order)->data($data_user_recharge_order)->save()) {
            return array('error_code' => true, 'msg' => '保存订单失败！请重试或联系管理员。');
        }
        return array('error_code' => false, 'pay_money' => $order_info['order_total_money']);

    }
    //手机端支付前订单处理
    public function wap_befor_pay($order_info, $now_coupon, $merchant_balance, $now_user)
    {

        //去除微信优惠的金额
        $pay_money = $order_info['order_total_money'];

        //判断优惠券
        if (!empty($now_coupon['price'])) {
            $data_weidian_order['card_id'] = $now_coupon['record_id'];
            if ($now_coupon['price'] >= $pay_money) {
                $order_result = $this->wap_pay_save_order($order_info, $data_weidian_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info);
            }
            $pay_money -= $now_coupon['price'];
        }

        //判断商家余额
        if (!empty($merchant_balance)) {
            if ($merchant_balance >= $pay_money) {
                $data_weidian_order['merchant_balance'] = $pay_money;
                $order_result = $this->wap_pay_save_order($order_info, $data_weidian_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info);
            } else {
                $data_weidian_order['merchant_balance'] = $merchant_balance;
            }
            $pay_money -= $merchant_balance;
        }

        //判断帐户余额
        if (!empty($now_user['now_money'])) {
            if ($now_user['now_money'] >= $pay_money) {
                $data_weidian_order['balance_pay'] = $pay_money;
                $order_result = $this->wap_pay_save_order($order_info, $data_weidian_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info);
            } else {
                $data_weidian_order['balance_pay'] = $now_user['now_money'];
            }
            $pay_money -= $now_user['now_money'];
        }
        //在线支付
        $order_result = $this->wap_pay_save_order($order_info, $data_weidian_order);
        if ($order_result['error_code']) {
            return $order_result;
        }
        return array('error_code' => false, 'pay_money' => $pay_money);
    }
    //手机端支付前保存各种支付信息
    public function wap_pay_save_order($order_info, $data_weidian_order)
    {
        $data_weidian_order['card_id'] = !empty($data_weidian_order['card_id']) ? $data_weidian_order['card_id'] : 0;
        $data_weidian_order['merchant_balance'] = !empty($data_weidian_order['merchant_balance']) ? $data_weidian_order['merchant_balance'] : 0;
        $data_weidian_order['balance_pay'] = !empty($data_weidian_order['balance_pay']) ? $data_weidian_order['balance_pay'] : 0;
        $data_weidian_order['last_time'] = $_SERVER['REQUEST_TIME'];
        $condition_weidian_order['order_id'] = $order_info['order_id'];
        if ($this->where($condition_weidian_order)->data($data_weidian_order)->save()) {
            return array('error_code' => false, 'msg' => '保存订单成功！');
        } else {
            return array('error_code' => true, 'msg' => '保存订单失败！请重试或联系管理员。');
        }
    }
    //如果无需调用在线支付，使用此方法即可。
    public function wap_after_pay_before($order_info)
    {
        $order_param = array(
            'order_id' => $order_info['order_id'],
            'pay_type' => '',
            'third_id' => '',
        );
        $result_after_pay = $this->after_pay($order_param);
        if ($result_after_pay['error']) {
            return array('error_code' => true, 'msg' => $result_after_pay['msg']);
        } else {
            return array('error_code' => false, 'msg' => '支付成功', 'url' => $result_after_pay['url']);
        }
    }
    public function after_pay($order_param)
    {
        $where['order_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($where)->find();
        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在');
        } else if ($now_order['paid'] == 1) {
            if ($order_param['is_mobile']) {
                return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('My/index'));
            } else {
                return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('User/Credit/index'));
            }
        } else {
            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if (empty($now_user)) {
                return array('error' => 1, 'msg' => '没有查找到此订单归属的用户，请联系管理员！');
            }

            $data_user_recharge_order = array();
            $data_user_recharge_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_user_recharge_order['payment_money'] = floatval($order_param['pay_money']);
            $data_user_recharge_order['pay_type'] = $order_param['pay_type'];
            $data_user_recharge_order['third_id'] = $order_param['third_id'];
            $data_user_recharge_order['paid'] = 1;
            if ($this->where($where)->save($data_user_recharge_order)) {
                D('User')->add_money($now_order['uid'], $order_param['pay_money'], '在线充值');
            } else {
                return array('error' => 1, 'msg' => '修改订单状态失败，请联系系统管理员！');
            }
        }
    }

    //支付完成，跳回到微店系统
    public function get_weidian_url($data)
    {
        if ($data['msg']) {
            $data['msg'] = urlencode($data['msg']);
        }

        $sort_data = $data;
        $sort_data['salt'] = 'pigcms';
        ksort($sort_data);
        $data['sign_key'] = sha1(http_build_query($sort_data));
        $data['request_time'] = $_SERVER['REQUEST_TIME'];

        return 'http://v.meihua.com/api/pay_callback.php?' . http_build_query($data);
    }

    //支付时，金额不够，记录到帐号
    public function wap_after_pay_error($now_order, $order_param, $error_tips)
    {
        //记录充值的金额，因为 Pay/return_url 处没有返回order的具体信息，故在此调用。
        $user_result = D('User')->add_money($now_order['uid'], $order_param['pay_money'], '在线充值');
        if ($user_result['error_code']) {
            return array('error' => 1, 'msg' => $user_result['msg']);
        } else {
            return array('error' => 1, 'msg' => $error_tips . '已将您充值的金额添加到您的余额内。');
        }
    }
}
