<?php
class Meal_orderModel extends Model
{
    public function get_order_by_id($uid, $order_id, $is_web = false)
    {
        $where = array();
        $where['order_id'] = $order_id;
        $where['uid'] = $uid;
        return $this->field(true)->where($where)->find();
    }

    public function get_pay_order($uid, $order_id, $is_web = false, $type = 'meal')
    {
        $now_order = $this->get_order_by_id($uid, $order_id);
        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        }
        if ($now_order['paid'] == 1) {
            if (!$is_web) {
                if ($type == 'takeout') {
                    return array('error' => 1, 'msg' => '您已经支付过此订单！', 'url' => U('Wap/Takeout/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
                } elseif ($type == 'food') {
                    return array('error' => 1, 'msg' => '您已经支付过此订单！', 'url' => U('Wap/Food/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
                } else {
                    return array('error' => 1, 'msg' => '您已经支付过此订单！', 'url' => U('Wap/Meal/detail', array('orderid' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
                }
            } else {
                return array('error' => 1, 'msg' => '您已经支付过此订单！', 'url' => U('User/Index/meal_order_view', array('order_id' => $now_order['order_id'])));
            }
        }

        if ($is_web) {
            $info = unserialize($now_order['info']);
            foreach ($info as &$in) {
                $in['money'] = floatval($in['num'] * $in['price']);
            }
            $order_info = array(
                'order_id' => $now_order['order_id'],
                'mer_id' => $now_order['mer_id'],
                'store_id' => $now_order['store_id'],
                'uid' => $now_order['uid'],
                'balance_pay' => $now_order['balance_pay'], //平台余额支付的金额
                'merchant_balance' => $now_order['merchant_balance'], //商家余额支付的金额
                'payment_money' => $now_order['payment_money'], //在线支付的金额
                'pay_money' => $now_order['pay_money'], //订单已经完成支付的金额
                'order_type' => $type,
                'order_total_money' => floatval($now_order['price'] - $now_order['pay_money']),
                'order_content' => $info,
                'leveloff' => $now_order['leveloff'],
            );
        } else {
            $merchant_store = M("Merchant_store")->where(array('store_id' => $now_order['store_id'], 'mer_id' => $now_order['mer_id']))->find();
            $info = unserialize($now_order['info']);
            $str = '';
            foreach ($info as $val) {
                $str .= $val['name'] . '*' . $val['num'] . '<br/>';
            }
            $order_info = array(
                'order_id' => $now_order['order_id'],
                'mer_id' => $now_order['mer_id'],
                'store_id' => $now_order['store_id'],
                'uid' => $now_order['uid'],
                'balance_pay' => $now_order['balance_pay'], //平台余额支付的金额
                'merchant_balance' => $now_order['merchant_balance'], //商家余额支付的金额
                'payment_money' => $now_order['payment_money'], //在线支付的金额
                'pay_money' => $now_order['pay_money'], //订单已经完成支付的金额
                'order_type' => $type,
                'order_name' => $merchant_store['name'],
                'order_txt_type' => $str,
                'order_num' => $now_order['total'],
                'order_total_money' => floatval($now_order['price'] - $now_order['pay_money']),
                'leveloff' => $now_order['leveloff'],
            );
        }
        return array('error' => 0, 'order_info' => $order_info);
    }

    //电脑站支付前订单处理
    public function web_befor_pay($order_info, $now_user)
    {
        //判断是否需要在线支付
        if ($now_user['now_money'] < $order_info['order_total_money']) {
            $online_pay = true;
        } else {
            $online_pay = false;
        }
        //不使用在线支付，直接使用会员卡和用户余额。
        if (empty($online_pay)) {
//             $money_pay_result = D('User')->user_money($now_user['uid'],$order_info['order_total_money'],'购买 '.$order_info['order_name'].'*'.$order_info['order_num']);
            //             if($money_pay_result['error_code']){
            //                 return $money_pay_result;
            //             }
            $order_pay['balance_pay'] = $order_info['order_total_money'];
        } else {
            if (!empty($now_user['now_money'])) {
                $order_pay['balance_pay'] = $now_user['now_money'];
            }
        }

        //将已支付用户余额等信息记录到订单信息里
        if (!empty($order_pay['balance_pay'])) {
            $data_meal_order['balance_pay'] = $order_info['balance_pay'] + $order_pay['balance_pay'];
            $data_meal_order['pay_money'] = $order_info['pay_money'] + $order_pay['balance_pay'];
        }
        if (!empty($data_meal_order)) {
            $data_meal_order['last_time'] = $_SERVER['REQUEST_TIME'];
            $condition_meal_order['order_id'] = $order_info['order_id'];
            if (!$this->where($condition_meal_order)->data($data_meal_order)->save()) {
                return array('error_code' => true, 'msg' => '保存订单失败！请重试或联系管理员。');
            }
        }

        if ($online_pay) {
            return array('error_code' => false, 'pay_money' => $order_info['order_total_money'] - $now_user['now_money']);
        } else {
            $order_param = array(
                'order_id' => $order_info['order_id'],
                'pay_type' => '',
                'third_id' => '',
                'is_mobile' => 0,
                'pay_money' => 0,
            );
            $result_after_pay = $this->after_pay($order_param);
            if ($result_after_pay['error']) {
                return array('error_code' => true, 'msg' => $result_after_pay['msg']);
            }
            return array('error_code' => false, 'msg' => '支付成功！', 'url' => U('User/Index/meal_order_view', array('order_id' => $order_info['order_id'])));
        }
    }
    //手机端支付前订单处理
    public function wap_befor_pay($order_info, $now_coupon, $merchant_balance, $now_user, $type = 'meal')
    {

        //去除微信优惠的金额
        $pay_money = $order_info['order_total_money'];

        //判断优惠券
        if (!empty($now_coupon['price'])) {
            $data_meal_order['card_id'] = $now_coupon['record_id'];
            if ($now_coupon['price'] >= $pay_money) {
                $order_result = $this->wap_pay_save_order($order_info, $data_meal_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info, $type);
            }
            $pay_money -= $now_coupon['price'];
        }

        //判断商家余额
        if (!empty($merchant_balance)) {
            if ($merchant_balance >= $pay_money) {
                $data_meal_order['merchant_balance'] = $pay_money;
                $order_result = $this->wap_pay_save_order($order_info, $data_meal_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info, $type);
            } else {
                $data_meal_order['merchant_balance'] = $merchant_balance;
            }
            $pay_money -= $merchant_balance;
        }

        //判断帐户余额
        if (!empty($now_user['now_money'])) {
            if ($now_user['now_money'] >= $pay_money) {
                $data_meal_order['balance_pay'] = $pay_money;
                $order_result = $this->wap_pay_save_order($order_info, $data_meal_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info, $type);
            } else {
                $data_meal_order['balance_pay'] = $now_user['now_money'];
            }
            $pay_money -= $now_user['now_money'];
        }
        //在线支付
        $order_result = $this->wap_pay_save_order($order_info, $data_meal_order);
        if ($order_result['error_code']) {
            return $order_result;
        }
        return array('error_code' => false, 'pay_money' => $pay_money);
    }

    //手机端支付前保存各种支付信息
    public function wap_pay_save_order($order_info, $data_meal_order)
    {
        $condition_meal_order['order_id'] = $order_info['order_id'];
        $old_order = $this->where($condition_meal_order)->find();

        $pay_money = $old_order['pay_money'];
        $merchant_balance = $old_order['merchant_balance'];
        $balance_pay = $old_order['balance_pay'];
        if (isset($data_meal_order['merchant_balance']) && $data_meal_order['merchant_balance']) {
            $pay_money += $data_meal_order['merchant_balance'];
            $merchant_balance += $data_meal_order['merchant_balance'];
        }
        if (isset($data_meal_order['balance_pay']) && $data_meal_order['balance_pay']) {
            $pay_money += $data_meal_order['balance_pay'];
            $balance_pay += $data_meal_order['balance_pay'];
        }
        $card_id = 0;
        if (isset($data_meal_order['card_id']) && $data_meal_order['card_id']) {
            $card_id = $data_meal_order['card_id'];
        }
        $data_meal_order['card_id'] = $card_id;
        $data_meal_order['merchant_balance'] = $merchant_balance;
        $data_meal_order['balance_pay'] = $balance_pay;
        $data_meal_order['pay_money'] = $pay_money;
        $data_meal_order['last_time'] = $_SERVER['REQUEST_TIME'];
        if ($this->where($condition_meal_order)->data($data_meal_order)->save()) {
            return array('error_code' => false, 'msg' => '保存订单成功！');
        } else {
            return array('error_code' => true, 'msg' => '保存订单失败！请重试或联系管理员。');
        }
    }
    //如果无需调用在线支付，使用此方法即可。
    public function wap_after_pay_before($order_info, $type = 'meal')
    {
        $order_param = array(
            'order_id' => $order_info['order_id'],
            'pay_type' => '',
            'third_id' => '',
            'is_mobile' => 1,
            'pay_money' => 0,
        );
        $result_after_pay = $this->after_pay($order_param, $type);
        if ($result_after_pay['error']) {
            return array('error_code' => true, 'msg' => $result_after_pay['msg']);
        }
        if ($type == 'takeout') {
            return array('error_code' => false, 'msg' => '支付成功！', 'url' => C('config.site_url') . "/wap.php?g=Wap&c=Takeout&a=order_detail&order_id=" . $order_info['order_id'] . '&mer_id=' . $order_info['mer_id'] . '&store_id=' . $order_info['store_id']);
        } elseif ($type == 'food') {
            return array('error_code' => false, 'msg' => '支付成功！', 'url' => C('config.site_url') . "/wap.php?g=Wap&c=Food&a=order_detail&order_id=" . $order_info['order_id'] . '&mer_id=' . $order_info['mer_id'] . '&store_id=' . $order_info['store_id']);
        } else {
            return array('error_code' => false, 'msg' => '支付成功！', 'url' => C('config.site_url') . "/wap.php?g=Wap&c=Meal&a=detail&order_id=" . $order_info['order_id'] . '&mer_id=' . $order_info['mer_id'] . '&store_id=' . $order_info['store_id']);
        }
    }

    //支付前订单处理
    public function befor_pay($order_info, $now_coupon, $now_user)
    {
        //判断是否需要在线支付
        if ($now_coupon['price'] + $now_user['now_money'] < $order_info['order_total_money']) {
            $online_pay = true;
        } else {
            $online_pay = false;
        }
        //不使用在线支付，直接使用会员卡和用户余额。
        if (empty($online_pay)) {
            if (!empty($now_coupon)) {
                $coupon_pay_result = D('Member_card_coupon')->user_card($now_coupon['record_id'], $order_info['mer_id'], $now_user['uid']);
                if ($coupon_pay_result['error_code']) {
                    return $coupon_pay_result;
                }
                $order_pay['car_id'] = $now_coupon['record_id'];
            }
            if (!empty($now_user['now_money']) && $now_coupon['price'] < $order_info['order_total_money']) {
                $money_pay_result = D('User')->user_money($now_user['uid'], $order_info['order_total_money'] - $now_coupon['price']);
                if ($money_pay_result['error_code']) {
                    return $money_pay_result;
                }
                $order_pay['balance_pay'] = $now_user['now_money'];
            }
        } else {
            //校验会员卡
            if (!empty($now_coupon)) {
                $coupon_pay_result = D('Member_card_coupon')->check_card($now_coupon['record_id'], $order_info['mer_id'], $now_user['uid']);
                if ($coupon_pay_result['error_code']) {
                    return $coupon_pay_result;
                }
                $order_pay['car_id'] = $now_coupon['record_id'];
            }
            if (!empty($now_user['now_money'])) {
                $order_pay['balance_pay'] = $now_user['now_money'];
            }
        }

        //将会员卡ID，已支付用户余额等信息记录到订单信息里
        if (!empty($order_pay['car_id'])) {
            $data_meal_order['card_id'] = $order_pay['record_id'];
        }
        if (!empty($order_pay['balance_pay'])) {
            $data_meal_order['balance_pay'] = $order_pay['balance_pay'];
        }
        if (!empty($data_meal_order)) {
            $data_meal_order['last_time'] = $_SERVER['REQUEST_TIME'];
            $condition_meal_order['order_id'] = $now_order['order_id'];
            $condition_meal_order['pay_money'] = $data_meal_order['balance_pay'];
            if (!$this->where($condition_meal_order)->data($data_meal_order)->save()) {
                return array('error_code' => true, 'msg' => '保存订单失败！请重试或联系管理员。');
            }
        }

        if ($online_pay) {
            return array('error_code' => false, 'pay_money' => $order_info['order_total_money'] - $now_coupon['price'] - $now_user['now_money']);
        } else {
            $order_param = array(
                'order_id' => $order_info['order_id'],
                'pay_type' => '',
                'third_id' => '',
                'is_mobile' => 0,
                'pay_money' => $now_order['pay_money'],
            );
            $result_after_pay = $this->after_pay($order_param);
            if ($result_after_pay['error']) {
                return array('error_code' => true, 'msg' => $result_after_pay['msg']);
            }
            return array('error_code' => false, 'url' => U('User/Index/meal_order_view', array('order_id' => $order_info['order_id'])));
        }
    }

    public function after_pay($order_param, $type = 'meal')
    {
        $where['order_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($where)->find();
        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        } else if ($now_order['paid'] == 1) {

            if ($order_param['is_mobile']) {
                if ($type == 'takeout') {
                    return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('Wap/Takeout/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
                } elseif ($type == 'food') {
                    return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('Wap/Food/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
                } else {
                    return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('Wap/Meal/detail', array('orderid' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
                }
            } else {
                return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('User/Index/meal_order_view', array('order_id' => $now_order['order_id'])));
            }
//             return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('User/Index/meal_order_view',array('order_id' => $now_order['order_id'])));
        } else {

            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if (empty($now_user)) {
                return array('error' => 1, 'msg' => '没有查找到此订单归属的用户，请联系管理员！');
            }

            //判断优惠券是否正确
            if ($now_order['card_id']) {
                $now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($now_order['card_id'], $now_order['uid']);
                if (empty($now_coupon)) {
                    return $this->wap_after_pay_error($now_order, $order_param, '您选择的优惠券不存在！');
                }
            }

            //判断会员卡余额
            $merchant_balance = floatval($now_order['merchant_balance']);
            if ($merchant_balance) {
                $user_merchant_balance = D('Member_card')->get_balance($now_order['uid'], $now_order['mer_id']);
                if ($user_merchant_balance < $merchant_balance) {
                    return $this->wap_after_pay_error($now_order, $order_param, '您的会员卡余额不够此次支付！');
                }
            }
            //判断帐户余额
            $balance_pay = floatval($now_order['balance_pay']);
            if ($balance_pay) {
                if ($now_user['now_money'] < $balance_pay) {
                    return $this->wap_after_pay_error($now_order, $order_param, '您的帐户余额不够此次支付！');
                }
            }

            //如果使用了优惠券
            if ($now_order['card_id']) {
                $use_result = D('Member_card_coupon')->user_card($now_order['card_id'], $now_order['mer_id'], $now_order['uid']);
                if ($use_result['error_code']) {
                    return array('error' => 1, 'msg' => $use_result['msg']);
                }
            }

            //如果使用会员卡余额
            if ($merchant_balance) {
                $use_result = D('Member_card')->use_card($now_order['uid'], $now_order['mer_id'], $merchant_balance, '购买 ' . $now_order['order_id'] . ' 扣除会员卡余额');
                if ($use_result['error_code']) {
                    return array('error' => 1, 'msg' => $use_result['msg']);
                }
            }
            //如果用户使用了余额支付，则扣除相应的金额。
            if (!empty($balance_pay)) {
                $use_result = D('User')->user_money($now_order['uid'], $balance_pay, '购买 ' . $now_order['order_id'] . ' 扣除余额');
                if ($use_result['error_code']) {
                    return array('error' => 1, 'msg' => $use_result['msg']);
                }
            }

            //执行推荐返利
            $rebate_balance = D('Consumer')->rebate($now_order['uid'], $balance_pay);
            $rebate_balance = empty($rebate_balance) ? 0 : $rebate_balance;

            //营业额返利
            $sale_rebate = D('Consumer')->saleRebate($now_order['mer_id'], $balance_pay);
            $percent_balance = D('Merchant')->platform_get_percent($now_order['mer_id'], $balance_pay);
            //赚取金额写入商户金额
            $now_order_money = $balance_pay - $rebate_balance - $sale_rebate - $percent_balance;
            $now_order_money = $now_order_money < 0 ? 0 : $now_order_money;
            D('Merchant')->addBalance($now_order['mer_id'], $now_order_money, $order_param['order_id'], $order_param['order_type']);

            $data_meal_order = array();
            $data_meal_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_meal_order['payment_money'] = floatval($order_param['pay_money']) + $now_order['payment_money'];
            $data_meal_order['pay_type'] = $order_param['pay_type'];
            $data_meal_order['third_id'] = $order_param['third_id'];
            $data_meal_order['is_mobile_pay'] = $order_param['is_mobile'];
            $data_meal_order['pay_money'] = $now_order['price'];
            if ($now_order['meal_type'] == 0) {
//外卖不生产消费码
                $meal_pass_array = array(
                    date('y', $_SERVER['REQUEST_TIME']),
                    date('m', $_SERVER['REQUEST_TIME']),
                    date('d', $_SERVER['REQUEST_TIME']),
                    date('H', $_SERVER['REQUEST_TIME']),
                    date('i', $_SERVER['REQUEST_TIME']),
                    date('s', $_SERVER['REQUEST_TIME']),
                    mt_rand(10, 99),
                );
                shuffle($meal_pass_array);
                $data_meal_order['meal_pass'] = implode('', $meal_pass_array);
            }

            $price = $now_order['total_price'] - $now_order['minus_price'];
//             foreach (unserialize($now_order['info']) as $p) {
            //                 $price += $p['num'] * $p['price'];
            //             }
            // TODO
            //             if(!empty($now_order['leveloff'])){
            //                 $leveloff=unserialize($now_order['leveloff']);
            //                 $price=isset($leveloff['totalprice']) && $leveloff['totalprice']>0 ? round($leveloff['totalprice'],2) : $price;
            //             }

            $data_meal_order['price'] = max($price, $now_order['price']);
            $data_meal_order['paid'] = $data_meal_order['price'] == $data_meal_order['pay_money'] ? 1 : 2;

            if ($this->where($where)->save($data_meal_order)) {
                D("Merchant_store_meal")->where(array('store_id' => $now_order['store_id']))->setInc('sale_count', 1);
                foreach (unserialize($now_order['info']) as $menu) {
                    $this->add_sell_count($menu['id'], $menu['num']);
                }

                //D('User')->add_score($now_order['uid'],floor($now_order['price']*C('config.user_score_get')),'购买 '.$now_order['order_id'].' 消费'.floatval($now_order['price']).'元 获得积分');
                if ($now_user['openid'] && $order_param['is_mobile']) {
                    $keyword2 = '';
                    $pre = '';
                    foreach (unserialize($now_order['info']) as $menu) {
                        $keyword2 .= $pre . $menu['name'] . ':' . $menu['price'] . '*' . $menu['num'];
                        $pre = '\n\t\t\t';
                    }
                    if ($type == 'takeout') {
                        $href = C('config.site_url') . '/wap.php?c=Takeout&a=order_detail&order_id=' . $now_order['order_id'] . '&mer_id=' . $now_order['mer_id'] . '&store_id=' . $now_order['store_id'];
                    } elseif ($type == 'food') {
                        $href = C('config.site_url') . '/wap.php?c=Food&a=order_detail&order_id=' . $now_order['order_id'] . '&mer_id=' . $now_order['mer_id'] . '&store_id=' . $now_order['store_id'];
                    } else {
                        $href = C('config.site_url') . '/wap.php?c=Meal&a=detail&orderid=' . $now_order['order_id'] . '&mer_id=' . $now_order['mer_id'] . '&store_id=' . $now_order['store_id'];
                    }

                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                    $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => C('config.meal_alias_name') . '提醒', 'keyword2' => $now_order['order_id'], 'keyword1' => $keyword2, 'keyword3' => $now_order['price'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => C('config.meal_alias_name') . '成功，您的消费码：' . $data_meal_order['meal_pass']));
                }

                if (!(empty($data_meal_order['third_id']) && $data_meal_order['third_id'] == 'offline')) {
                    $msg = array();
                    $msg['user_name'] = $now_order['name'];
                    $msg['user_phone'] = $now_order['phone'];
                    $msg['user_address'] = $now_order['address'];
                    $msg['user_message'] = $now_order['note'];
                    $msg['buy_time'] = date('Y-m-d H:i:s', $now_order['dateline']);
                    $msg['goods_list'] = unserialize($now_order['info']);
                    $msg['goods_count'] = $now_order['total'];
                    $msg['goods_price'] = $now_order['price'];
                    $msg['orderid'] = $now_order['order_id'];
                    $msg['pay_type'] = $data_meal_order['pay_type'];

                    $store = D('Merchant_store')->field(true)->where(array('store_id' => $now_order['store_id']))->find();
                    $msg['store_name'] = $store['name'];
                    $msg['store_phone'] = $store['phone'];
                    $msg['store_address'] = $store['adress'];
                    $msg = ArrayToStr::array_to_str($msg, 1, C('config.print_format'));
                    $op = new orderPrint(C('config.print_server_key'), C('config.print_server_topdomain'));
                    $op->printit($store['mer_id'], $store['store_id'], $msg, 1);

                    $sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => $now_order['mer_id'], 'type' => 'food');
                    if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
                        $sms_data['uid'] = $now_order['uid'];
                        $sms_data['mobile'] = $now_order['phone'];
                        $sms_data['sendto'] = 'user';
                        $sms_data['content'] = '您在' . $store['name'] . '中的订单号：' . $now_order['order_id'] . ',已经完成了支付！';
                        Sms::sendSms($sms_data);
                    }
                    if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
                        $sms_data['uid'] = 0;
                        $sms_data['mobile'] = $store['phone'];
                        $sms_data['sendto'] = 'merchant';
                        $sms_data['content'] = '顾客' . $now_order['name'] . '在' . date("Y-m-d H:i:s", $data['dateline']) . '时，将订单号：' . $now_order['order_id'] . '支付成功！';
                        Sms::sendSms($sms_data);
                    }

                }
                /* 粉丝行为分析 */
                D('Merchant_request')->add_request($now_order['mer_id'], array('meal_buy_count' => $now_order['total'], 'meal_buy_money' => $now_order['price']));

                if ($order_param['is_mobile']) {
                    if ($type == 'takeout') {
                        return array('error' => 0, 'url' => U('Wap/Takeout/order_detail', array('mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'], 'order_id' => $now_order['order_id'])));
                    } elseif ($type == 'food') {
                        return array('error' => 0, 'url' => U('Wap/Food/order_detail', array('mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'], 'order_id' => $now_order['order_id'])));
                    } else {
                        return array('error' => 0, 'url' => U('Meal/detail', array('mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'], 'orderid' => $now_order['order_id'])));
                    }
                } else {
                    return array('error' => 0, 'url' => U('User/Index/meal_order_view', array('order_id' => $now_order['order_id'])));
                }
//                 return array('error'=>0,'url'=>U('Meal/detail',array('mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'], 'order_id'=>$now_order['order_id'])));
            } else {
                return array('error' => 1, 'msg' => '修改订单状态失败，请联系系统管理员！');
            }
        }
    }

    public function get_rate_order_list($uid, $is_rate = false, $is_wap = false)
    {
        $condition_where = "`o`.`uid`='$uid' AND `o`.`store_id`=`s`.`store_id`";
        if ($is_rate) {
            $condition_where .= " AND `o`.`paid`='1'";
            $condition_where .= " AND `o`.`status`='2'";
            $condition_where .= " AND `r`.`order_type`='1' AND `r`.`order_id`=`o`.`order_id`";
            $condition_table = array(C('DB_PREFIX') . 'merchant_store' => 's', C('DB_PREFIX') . 'meal_order' => 'o', C('DB_PREFIX') . 'reply' => 'r');
            $condition_field = '`o`.*,`s`.`name`,`s`.`pic_info`,`r`.*';
            $condition_order = '`r`.`pigcms_id` DESC';
        } else {
            $condition_where .= " AND `o`.`paid`='1'";
            $condition_where .= " AND `o`.`status`<2";
            $condition_table = array(C('DB_PREFIX') . 'merchant_store' => 's', C('DB_PREFIX') . 'meal_order' => 'o');
            $condition_field = '`o`.*,`s`.`name`,`s`.`pic_info`';
            $condition_order = '`o`.`dateline` DESC';
        }

        $order_list = $this->field($condition_field)->where($condition_where)->table($condition_table)->order($condition_order)->select();
        $store_image_class = new store_image();
        foreach ($order_list as &$v) {
            $images = $store_image_class->get_allImage_by_path($v['pic_info']);
            $v['image'] = $images ? array_shift($images) : array();
            $v['url'] = C('config.site_url') . '/meal/' . $v['store_id'] . '.html';
            $v['comment'] = stripslashes($v['comment']);
            if ($v['pic']) {
                $tmp_array = explode(',', $v['pic']);
                $v['pic_count'] = count($tmp_array);
            }
        }
        return $order_list;
    }
    //修改订单状态
    public function change_status($order_id, $status)
    {
        $where['order_id'] = $order_id;
        $data['status'] = $status;
        if ($this->where($where)->data($data)->save()) {
            return true;
        } else {
            return false;
        }
    }
    //获取某个时间段的订单总数
    public function get_all_oreder_count($type = 'day')
    {
        $stime = $etime = 0;
        switch ($type) {
            case 'day':
                $stime = strtotime(date("Y-m-d") . " 00:00:00");
                $etime = strtotime(date("Y-m-d") . " 23:59:59");
                break;
            case 'week':
                $d = date("w");
                $stime = strtotime(date("Y-m-d") . " 00:00:00") - $d * 86400;
                $etime = strtotime(date("Y-m-d") . " 23:59:59") + (6 - $d) * 86400;
                break;
            case 'month':
                $stime = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $etime = mktime(0, 0, 0, date("m") + 1, 1, date("Y"));
                break;
            case 'year':
                $stime = mktime(0, 0, 0, 1, 1, date("Y"));
                $etime = mktime(0, 0, 0, 1, 1, date("Y") + 1);
                break;
            default:;
        }
        $total = $this->where("`paid`=1 AND `dateline`>'$stime' AND `dateline`<'$etime'")->count();
        return $total;
    }

    //支付时，金额不够，记录到帐号
    public function wap_after_pay_error($now_order, $order_param, $error_tips)
    {
        //记录充值的金额，因为 Pay/return_url 处没有返回order的具体信息，故在此调用。
        $user_result = D('User')->add_money($now_order['uid'], $order_param['pay_money'], '在线充值');
        if ($user_result['error_code']) {
            return array('error' => 1, 'msg' => $user_result['msg']);
        } else {
            if ($order_param['is_mobile']) {
                $return_url = str_replace('/source/', '/', U('My/group_order', array('order_id' => $now_order['order_id'])));
            } else {
                $return_url = U('User/Index/group_order_view', array('order_id' => $now_order['order_id']));
            }
            return array('error' => 1, 'msg' => $error_tips . '已将您充值的金额添加到您的余额内。', 'url' => $return_url);
        }
    }

    public function get_order_by_mer_id($mer_id, $is_system = false)
    {
        if ($is_system) {
            import('@.ORG.system_page');
        } else {
            import('@.ORG.merchant_page');
        }

        $count1 = $this->where(array('mer_id' => $mer_id, 'paid' => 1, 'pay_type' => array('NEQ', 'offline'), 'status' => array('in', '1, 2')))->count();
        $count2 = D('Group_order')->where(array('mer_id' => $mer_id, 'pay_type' => array('NEQ', 'offline'), 'paid' => 1, 'status' => array('in', '1, 2')))->count();
        $p = new Page($count1 + $count2, 20);

        $mode = new Model();

        $sql = "SELECT sum(balance_pay + payment_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND pay_type<>'offline' GROUP BY is_pay_bill";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT sum(balance_pay + payment_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "group_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND pay_type<>'offline' GROUP BY is_pay_bill";
        $res = $mode->query($sql);
        $alltotal = $alltotalfinsh = 0;
        foreach ($res as $r) {
            $r['is_pay_bill'] && $alltotalfinsh += $r['price']; //已对账的总额
            $r['is_pay_bill'] || $alltotal += $r['price']; //未对账的总额
        }

        $sql = "SELECT 1 as name, order_id, info as order_name, uid, mer_id, store_id, phone, total, (balance_pay+payment_money) as price, price as order_price, dateline, paid, status, pay_type, pay_time, third_id, is_mobile_pay, balance_pay, payment_money, card_id, merchant_balance, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND pay_type<>'offline'";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT 2 as name, order_id, order_name, uid, mer_id, store_id, phone, num as total, (balance_pay+payment_money) as price, total_money as order_price, add_time as dateline, paid, status, pay_type, pay_time, third_id, is_mobile_pay, balance_pay, payment_money, card_id, merchant_balance, is_pay_bill FROM " . C('DB_PREFIX') . "group_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND pay_type<>'offline'";
        $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";

        $res = $mode->query($sql);

        $stores = D('Merchant_store')->field('store_id, name')->where(array('mer_id' => $mer_id))->select();
        $temp = array();
        foreach ($stores as $store) {
            $temp[$store['store_id']] = $store;
        }

        $total = $finshtotal = 0;
        foreach ($res as &$l) {
            $l['store_name'] = isset($temp[$l['store_id']]['name']) ? $temp[$l['store_id']]['name'] : '';
            $l['name'] == 1 && $l['order_name'] = unserialize($l['order_name']);
            $l['pay_type_show'] = D('Pay')->get_pay_name($l['pay_type'], $l['is_mobile_pay']);
            $total += $l['price']; //本页的总额
            $l['is_pay_bill'] && $finshtotal += $l['price']; //本页已对账的总额
        }
        $pagebar = $p->show();
        return array('order_list' => $res, 'pagebar' => $pagebar, 'total' => $total, 'finshtotal' => $finshtotal, 'alltotalfinsh' => $alltotalfinsh, 'alltotal' => $alltotal);
    }

    public function add_sell_count($meal_id, $sell_count)
    {
        if ($meal = D('Meal')->where(array('meal_id' => $meal_id))->find()) {
            $nowMouth = date('Ym');
            if ($nowMouth != $meal['sell_mouth']) {
                D('Meal')->where(array('meal_id' => $meal_id))->save(array('sell_count' => $sell_count, 'sell_mouth' => $nowMouth));
                empty($meal['sell_mouth']) || D('Meal_sell_log')->add(array('meal_id' => $meal_id, 'count' => $meal['sell_count'], 'mouth' => $meal['sell_mouth']));
            } else {
                D('Meal')->where(array('meal_id' => $meal_id))->setInc('sell_count', $sell_count);
            }
        }
    }

    /**
     *
     */
    public function get_offlineorder_by_mer_id($mer_id, $staff_name = '')
    {
        import('@.ORG.merchant_page');

        $where = " mer_id={$mer_id} AND paid=1 AND status IN (1,2) AND pay_type='offline'";
        $staff_name && $where .= " AND last_staff='{$staff_name}'";
        $count1 = $this->where($where)->count();
        $count2 = D('Group_order')->where($where)->count();
        $p = new Page($count1 + $count2, 20);

        $mode = new Model();

        $sql = "SELECT sum(total_price - minus_price - balance_pay - payment_money - merchant_balance) as price, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE {$where} AND total_price>0 GROUP BY is_pay_bill";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT sum(price - minus_price - balance_pay - payment_money - merchant_balance) as price, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE {$where} AND total_price=0 GROUP BY is_pay_bill";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT sum(total_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "group_order WHERE {$where} GROUP BY is_pay_bill";
        $res = $mode->query($sql);
        $alltotal = $alltotalfinsh = 0;
        foreach ($res as $r) {
            $r['is_pay_bill'] && $alltotalfinsh += $r['price']; //已对账的总额
            $r['is_pay_bill'] || $alltotal += $r['price']; //未对账的总额
        }

        $sql = "SELECT 1 as name, order_id, info as order_name, uid, mer_id, store_id, phone, total, last_staff, merchant_balance, balance_pay, payment_money, price, total_price, minus_price, use_time, dateline, paid, status, pay_type, pay_time, third_id, is_mobile_pay, card_id, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE {$where}";
        $sql .= ' UNION ALL ';
        $sql .= "SELECT 2 as name, order_id, order_name, uid, mer_id, store_id, phone, num as total, last_staff, merchant_balance, balance_pay, payment_money, 0 as price, total_money as total_price, 0 as minus_price, use_time, add_time as dateline, paid, status, pay_type, pay_time, third_id, is_mobile_pay, card_id, is_pay_bill FROM " . C('DB_PREFIX') . "group_order WHERE {$where}";
        $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";

        $res = $mode->query($sql);
        $stores = D('Merchant_store')->field('store_id, name')->where(array('mer_id' => $mer_id))->select();
        $temp = array();
        foreach ($stores as $store) {
            $temp[$store['store_id']] = $store;
        }

        $total = $finshtotal = 0;
        foreach ($res as &$l) {
            $l['store_name'] = isset($temp[$l['store_id']]['name']) ? $temp[$l['store_id']]['name'] : '';
            $l['name'] == 1 && $l['order_name'] = unserialize($l['order_name']);
            $l['pay_type_show'] = D('Pay')->get_pay_name($l['pay_type'], $l['is_mobile_pay']);

            if ($l['name'] == 1) {
                if ($l['total_price'] > 0) {
                    $price = $l['total_price'] - $l['minus_price'] - $l['merchant_balance'] - $l['balance_pay'] - $l['pay_money'];
                } else {
                    $price = $l['price'] - $l['minus_price'] - $l['merchant_balance'] - $l['balance_pay'] - $l['pay_money'];
                }
            } else {
                $price = $l['total_price'] - $l['minus_price'] - $l['merchant_balance'] - $l['balance_pay'] - $l['pay_money'];
            }
            $l['cash'] = $price;
            $total += $price; //本页的总额
            $l['is_pay_bill'] && $finshtotal += $price; //本页已对账的总额
        }
        $pagebar = $p->show();
        return array('order_list' => $res, 'pagebar' => $pagebar, 'total' => $total, 'finshtotal' => $finshtotal, 'alltotalfinsh' => $alltotalfinsh, 'alltotal' => $alltotal);
    }

    public function get_order_list($mer_id, $store_id, $where = array())
    {
        $where['mer_id'] = $mer_id;
        $where['store_id'] = $store_id;
        $count = $this->where($where)->count();
        import('@.ORG.merchant_page');
        $p = new Page($count, 20);
        $list = $this->where($where)->order("order_id DESC")->limit($p->firstRow . ',' . $p->listRows)->select();

        $tableids = array();
        foreach ($list as $l) {
            if (!in_array($l['tableid'], $tableids)) {
                $tableids[] = $l['tableid'];
            }
        }
        $tablename = array();
        if ($tableids) {
            $tables = D('Merchant_store_table')->where(array('pigcms_id' => array('in', $tableids), 'store_id' => $store_id))->select();
            foreach ($tables as $table) {
                $tablename[$table['pigcms_id']] = $table;
            }
        }

        foreach ($list as &$ll) {
            $ll['tablename'] = isset($tablename[$ll['tableid']]['name']) ? $tablename[$ll['tableid']]['name'] : '不限';
            $ll['info'] = unserialize($ll['info']);
        }

        return array('order_list' => $list, 'pagebar' => $p->show());
    }
}
