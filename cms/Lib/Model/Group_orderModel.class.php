<?php
class Group_orderModel extends Model
{
    public function save_post_form($group, $uid, $order_id)
    {
        $data_group_order['group_id'] = $group['group_id'];
        $data_group_order['mer_id'] = $group['mer_id'];

        $data_group_order['num'] = intval($_POST['quantity']);
        if (empty($data_group_order['num'])) {
            return array('error' => 1, 'msg' => '请输入正确的购买数量！');
        } else if ($data_group_order['num'] < $group['once_min']) {
            return array('error' => 1, 'msg' => '您最少需要购买' . $group['once_min'] . '单！');
        } else if ($group['once_max'] != 0 && $data_group_order['num'] > $group['once_max']) {
            return array('error' => 1, 'msg' => '您最多只能购买' . $group['once_min'] . '单！');
        }
        $data_group_order['order_name'] = $group['s_name'] . '*' . $data_group_order['num'];
        $data_group_order['price'] = $group['price'];
        $data_group_order['total_money'] = $group['price'] * $data_group_order['num'];
        $data_group_order['tuan_type'] = $group['tuan_type'];
        $data_group_order['add_time'] = $_SERVER['REQUEST_TIME'];

        //实物
        if ($_POST['delivery_type'] && $group['tuan_type'] == 2) {
            $now_adress = D('User_adress')->get_one_adress($uid, $_POST['adress_id']);
            if (empty($now_adress)) {
                return array('error' => 1, 'msg' => '请先添加收货地址！');
            }
            $data_group_order['contact_name'] = $now_adress['name'];
            $data_group_order['phone'] = $now_adress['phone'];
            $data_group_order['zipcode'] = $now_adress['zipcode'];
            $data_group_order['adress'] = $now_adress['province_txt'] . ' ' . $now_adress['city_txt'] . ' ' . $now_adress['area_txt'] . ' ' . $now_adress['adress'];

            $data_group_order['delivery_type'] = $_POST['delivery_type'];
            $data_group_order['delivery_comment'] = $_POST['delivery_comment'];
        } else {

            $now_user = D('User')->get_user($uid);
            if (empty($now_user)) {
                return array('error' => 1, 'msg' => '未获取到您的帐号信息，请重试！');
            }
            $data_group_order['phone'] = $now_user['phone'];
        }
        if ($order_id) {
            $condition_group_order['order_id'] = $order_id;
            $condition_group_order['uid'] = $uid;
            $save_result = $this->where($condition_group_order)->data($data_group_order)->save();
            if ($save_result) {
                return array('error' => 0, 'msg' => '订单修改成功！', 'order_id' => $order_id);
            } else {
                return array('error' => 1, 'msg' => '订单修改失败！请重试', 'order_id' => $order_id);
            }
        } else {
            $data_group_order['uid'] = $uid;
            $Group_store = D('Group_store')->where(array('group_id' => $group['group_id']))->select();
            if (!empty($Group_store) && (count($Group_store) == 1) && ($group['tuan_type'] == 2)) {
                /****当此团购为实物且只指定一个店铺时，将店铺id直接带入保存到订单里*************/
                $data_group_order['store_id'] = $Group_store['0']['store_id'];
            }
            $order_id = $this->data($data_group_order)->add();

            if ($order_id) {
                if ($_SESSION['openid']) {
                    $href = C('config.site_url') . '/wap.php?c=My&a=group_order&order_id=' . $order_id;
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                    $model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $_SESSION['openid'], 'first' => '您好，您的订单已生成', 'keyword3' => $order_id, 'keyword1' => date('Y-m-d H:i:s'), 'keyword2' => $data_group_order['order_name'], 'remark' => '您的该次' . $this->config['group_alias_name'] . '下单成功，感谢您的使用！'));
                }
                $sms_data = array('mer_id' => $group['mer_id'], 'store_id' => 0, 'type' => 'group');
                if (C('config.sms_place_order') == 1 || C('config.sms_place_order') == 3) {
                    $sms_data['uid'] = $uid;
                    $sms_data['mobile'] = $data_group_order['phone'];
                    $sms_data['sendto'] = 'user';
                    $sms_data['content'] = '您在' . date("Y-m-d H:i:s") . '时，购买了' . $group['s_name'] . '，已成功生产订单，订单号：' . $order_id;
                    Sms::sendSms($sms_data);
                }
                if (C('config.sms_place_order') == 2 || C('config.sms_place_order') == 3) {
                    $merchant = D('Merchant')->where(array('mer_id' => $group['mer_id']))->find();
                    $sms_data['uid'] = 0;
                    $sms_data['mobile'] = $merchant['phone'];
                    $sms_data['sendto'] = 'merchant';
                    $sms_data['content'] = '有份新的' . $group['s_name'] . '被购买，订单号：' . $order_id . '请您注意查看并处理!';
                    Sms::sendSms($sms_data);
                }

                return array('error' => 0, 'msg' => '订单产生成功！', 'order_id' => $order_id);
            } else {
                return array('error' => 1, 'msg' => '订单产生失败！请重试');
            }
        }
    }
    public function get_order_detail_by_id_and_merId($mer_id, $order_id, $is_wap = false)
    {
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o', C('DB_PREFIX') . 'user' => 'u');
        $condition_where .= "`o`.`order_id`='$order_id' AND `o`.`group_id`=`g`.`group_id` AND `g`.`mer_id`='$mer_id' AND `o`.`uid`=`u`.`uid`";
        $now_order = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`,`u`.`nickname`,`u`.`phone` `user_phone`')->where($condition_where)->table($condition_table)->find();
        if (!empty($now_order)) {
            $group_image_class = new group_image();
            $tmp_pic_arr = explode(';', $now_order['pic']);
            $now_order['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
            $now_order['url'] = D('Group')->get_group_url($now_order['group_id'], $is_wap);

            $now_order['price'] = floatval($now_order['price']);
            $now_order['total_money'] = floatval($now_order['total_money']);
            $now_order['pay_type_txt'] = D('Pay')->get_pay_name($now_order['pay_type'], $now_order['is_mobile_pay']);
            if ($now_order['group_pass']) {
                $now_order['group_pass_txt'] = preg_replace('#(\d{4})#', '$1 ', $now_order['group_pass']);
            }
        }
        return $now_order;
    }
    public function get_order_detail_by_id($uid, $order_id, $is_wap = false, $check_user = true)
    {
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o');
        if ($check_user) {
            $condition_where = "`o`.`uid`='$uid' AND ";
        } else {
            $condition_where = '';
        }
        $condition_where .= "`o`.`order_id`='$order_id' AND `o`.`group_id`=`g`.`group_id`";
        $now_order = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`,`g`.`reply_count`,`g`.`score_all`,`g`.`score_mean`')->where($condition_where)->table($condition_table)->find();
        if (!empty($now_order)) {
            $group_image_class = new group_image();
            $tmp_pic_arr = explode(';', $now_order['pic']);
            $now_order['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
            $now_order['url'] = D('Group')->get_group_url($now_order['group_id'], $is_wap);
            $now_order['order_url'] = $this->get_order_url($now_order['group_id'], $is_wap);

            $now_order['price'] = floatval($now_order['price']);
            $now_order['total_money'] = floatval($now_order['total_money']);
            $now_order['pay_type_txt'] = D('Pay')->get_pay_name($now_order['pay_type'], $now_order['is_mobile_pay']);
            if ($now_order['group_pass']) {
                $now_order['group_pass_txt'] = preg_replace('#(\d{4})#', '$1 ', $now_order['group_pass']);
            }
            if ($now_order['express_type']) {
                $now_order['express_info'] = D('Express')->get_express($now_order['express_id']);
            }
        }
        return $now_order;
    }
    public function get_order_by_id($uid, $order_id)
    {
        $condition_group_order['order_id'] = $order_id;
        $condition_group_order['uid'] = $uid;
        return $this->field(true)->where($condition_group_order)->find();
    }
    public function get_pay_order($uid, $order_id, $is_web = false)
    {
        $now_order = $this->get_order_by_id($uid, $order_id);
        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        }
        if (!empty($now_order['paid'])) {
            unset($_SESSION['group_order']);
            if ($is_web) {
                return array('error' => 1, 'msg' => '您已经支付过此订单！', 'url' => U('User/Index/group_order_view', array('order_id' => $now_order['order_id'])));
            } else {
                return array('error' => 1, 'msg' => '您已经支付过此订单！', 'url' => U('My/group_order', array('order_id' => $now_order['order_id'])));
            }
        }

        $now_group = D('Group')->get_group_by_groupId($now_order['group_id']);
        if (empty($now_group)) {
            return array('error' => 1, 'msg' => '当前' . $this->config['group_alias_name'] . '不存在或已过期！');
        }

        if ($is_web) {
            $order_info = array(
                'order_id' => $now_order['order_id'],
                'mer_id' => $now_order['mer_id'],
                'order_type' => 'group',
                'order_total_money' => floatval($now_order['total_money']),
                'order_content' => array(
                    0 => array(
                        'name' => $now_group['merchant_name'] . '：' . $now_group['group_name'],
                        'num' => $now_order['num'],
                        'price' => floatval($now_order['price']),
                        'money' => floatval($now_order['num'] * $now_order['price']),
                    ),
                ),
            );
        } else {
            $order_info = array(
                'order_id' => $now_order['order_id'],
                'group_id' => $now_order['group_id'],
                'mer_id' => $now_order['mer_id'],
                'order_type' => 'group',
                //'order_txt_type'        =>    $now_group['s_name'],
                'order_name' => $now_group['s_name'],
                'order_num' => $now_order['num'],
                'order_price' => floatval($now_order['price']),
                'order_total_money' => floatval($now_order['total_money']),
            );
        }
        //实物
        if ($now_order['tuan_type'] == 2) {
            $order_info['adress'] = $now_order['contact_name'] . '，' . $now_order['adress'] . '，' . $now_order['zipcode'] . '，' . $now_order['phone'];
            switch ($now_order['delivery_type']) {
                case '1':
                    $order_info['delivery_type'] = '工作日、双休日与假日均可送货';
                    break;
                case '2':
                    $order_info['delivery_type'] = '只工作日送货';
                    break;
                case '3':
                    $order_info['delivery_type'] = '只双休日、假日送货';
                    break;
                default:
                    $order_info['delivery_type'] = '白天没人，其它时间送货';
                    break;
            }
            $order_info['delivery_comment'] = $now_order['delivery_comment'];
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
        //不使用在线支付，直接使用用户余额。
        if (empty($online_pay)) {
            $order_pay['balance_pay'] = $order_info['order_total_money'];
        } else {
            if (!empty($now_user['now_money'])) {
                $order_pay['balance_pay'] = $now_user['now_money'];
            }
        }

        //将已支付用户余额等信息记录到订单信息里
        if (!empty($order_pay['balance_pay'])) {
            $data_group_order['balance_pay'] = $order_pay['balance_pay'];
        }
        if (!empty($data_group_order)) {
            $data_group_order['wx_cheap'] = 0;
            $data_group_order['card_id'] = 0;
            $data_group_order['merchant_balance'] = 0;
            $data_group_order['last_time'] = $_SERVER['REQUEST_TIME'];
            $condition_group_order['order_id'] = $order_info['order_id'];
            if (!$this->where($condition_group_order)->data($data_group_order)->save()) {
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
            );
            $result_after_pay = $this->after_pay($order_param);
            if ($result_after_pay['error']) {
                return array('error_code' => true, 'msg' => $result_after_pay['msg']);
            }

            return array('error_code' => false, 'msg' => '支付成功！', 'url' => U('User/Index/group_order_view', array('order_id' => $order_info['order_id'])));
        }
    }
    //手机端支付前订单处理
    public function wap_befor_pay($order_info, $now_coupon, $merchant_balance, $now_user, $wx_cheap)
    {

        //去除微信优惠的金额
        $pay_money = $order_info['order_total_money'] - $wx_cheap;
        $data_group_order['wx_cheap'] = $wx_cheap;

        //判断优惠券
        if (!empty($now_coupon['price'])) {
            $data_group_order['card_id'] = $now_coupon['record_id'];
            if ($now_coupon['price'] >= $pay_money) {
                $order_result = $this->wap_pay_save_order($order_info, $data_group_order);
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
                $data_group_order['merchant_balance'] = $pay_money;
                $order_result = $this->wap_pay_save_order($order_info, $data_group_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info);
            } else {
                $data_group_order['merchant_balance'] = $merchant_balance;
            }
            $pay_money -= $merchant_balance;
        }

        //判断帐户余额
        if (!empty($now_user['now_money'])) {
            if ($now_user['now_money'] >= $pay_money) {
                $data_group_order['balance_pay'] = $pay_money;
                $order_result = $this->wap_pay_save_order($order_info, $data_group_order);
                if ($order_result['error_code']) {
                    return $order_result;
                }
                return $this->wap_after_pay_before($order_info);
            } else {
                $data_group_order['balance_pay'] = $now_user['now_money'];
            }
            $pay_money -= $now_user['now_money'];
        }
        //在线支付
        $order_result = $this->wap_pay_save_order($order_info, $data_group_order);
        if ($order_result['error_code']) {
            return $order_result;
        }
        return array('error_code' => false, 'pay_money' => $pay_money);
    }
    //手机端支付前保存各种支付信息
    public function wap_pay_save_order($order_info, $data_group_order)
    {
        $data_group_order['wx_cheap'] = !empty($data_group_order['wx_cheap']) ? $data_group_order['wx_cheap'] : 0;
        $data_group_order['card_id'] = !empty($data_group_order['card_id']) ? $data_group_order['card_id'] : 0;
        $data_group_order['merchant_balance'] = !empty($data_group_order['merchant_balance']) ? $data_group_order['merchant_balance'] : 0;
        $data_group_order['balance_pay'] = !empty($data_group_order['balance_pay']) ? $data_group_order['balance_pay'] : 0;
        $data_group_order['last_time'] = $_SERVER['REQUEST_TIME'];
        $data_group_order['submit_order_time'] = $_SERVER['REQUEST_TIME'];
        $condition_group_order['order_id'] = $order_info['order_id'];
        if ($this->where($condition_group_order)->data($data_group_order)->save()) {
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
            'is_mobile' => 0,
        );
        $result_after_pay = $this->after_pay($order_param);
        if ($result_after_pay['error']) {
            return array('error_code' => true, 'msg' => $result_after_pay['msg']);
        }
        return array('error_code' => false, 'msg' => '支付成功！', 'url' => str_replace('/source/', '/', U('My/group_order', array('order_id' => $order_info['order_id']))));
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
            $data_group_order['card_id'] = $order_pay['record_id'];
        }
        if (!empty($order_pay['balance_pay'])) {
            $data_group_order['balance_pay'] = $order_pay['record_id'];
        }
        if (!empty($data_group_order)) {
            $data_group_order['last_time'] = $_SERVER['REQUEST_TIME'];
            $condition_group_order['order_id'] = $now_order['order_id'];
            if (!$this->where($condition_group_order)->data($data_group_order)->save()) {
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
                'pay_money' => 0,
            );
            $result_after_pay = $this->after_pay($order_param);
            if ($result_after_pay['error']) {
                return array('error_code' => true, 'msg' => $result_after_pay['msg']);
            }
            return array('error_code' => false, 'url' => U('My/group_order', array('order_id' => $order_info['order_id'])));
        }
    }

    //支付之后
    public function after_pay($order_param)
    {
        unset($_SESSION['group_order']);
        $condition_group_order['order_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($condition_group_order)->find();
        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        } else if ($now_order['paid'] == 1) {
            if ($order_param['is_mobile']) {
                return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('My/group_order', array('order_id' => $now_order['order_id'])));
            } else {
                return array('error' => 1, 'msg' => '该订单已付款！', 'url' => U('User/Index/group_order_view', array('order_id' => $now_order['order_id'])));
            }
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
                $use_result = D('Member_card')->use_card($now_order['uid'], $now_order['mer_id'], $merchant_balance, '购买 ' . $now_order['order_name'] . ' 扣除会员卡余额');
                if ($use_result['error_code']) {
                    return array('error' => 1, 'msg' => $use_result['msg']);
                }
            }
            //如果用户使用了余额支付，则扣除相应的金额。

            if (!empty($balance_pay)) {
                $use_result = D('User')->user_money($now_order['uid'], $balance_pay, '购买 ' . $now_order['order_name'] . ' 扣除余额');
                if ($use_result['error_code']) {
                    return array('error' => 1, 'msg' => $use_result['msg']);
                }
            }
            //执行推荐返利
            $rebate_balance = D('Consumer')->rebate($now_order['uid'], $balance_pay);
            $rebate_balance = empty($rebate_balance) ? 0 : $rebate_balance;

            //营业额返利
            $sale_rebate = D('Consumer')->saleRebate($now_order['mer_id'], $balance_pay);
            //赚取金额写入商户金额
            $now_order_money = $balance_pay - $rebate_balance - $sale_rebate;
            $now_order_money = $now_order_money < 0 ? 0 : $now_order_money;
            D('Merchant')->addBalance($now_order['mer_id'], $now_order_money);

            $condition_group_order['order_id'] = $order_param['order_id'];
            if ($now_order['tuan_type'] < 2) {
                $group_pass_array = array(
                    date('y', $_SERVER['REQUEST_TIME']),
                    date('m', $_SERVER['REQUEST_TIME']),
                    date('d', $_SERVER['REQUEST_TIME']),
                    date('H', $_SERVER['REQUEST_TIME']),
                    date('i', $_SERVER['REQUEST_TIME']),
                    date('s', $_SERVER['REQUEST_TIME']),
                    mt_rand(10, 99),
                );
                shuffle($group_pass_array);
                $data_group_order['group_pass'] = implode('', $group_pass_array);
            }

            $data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['payment_money'] = floatval($order_param['pay_money']);
            $data_group_order['pay_type'] = $order_param['pay_type'];
            $data_group_order['third_id'] = $order_param['third_id'];
            $data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
            $data_group_order['paid'] = 1;
            if ($this->where($condition_group_order)->data($data_group_order)->save()) {
                $condition_group['group_id'] = $now_order['group_id'];
                D('Group')->where($condition_group)->setInc('sale_count', $now_order['num']);

                /* 粉丝行为分析 */
                D('Merchant_request')->add_request($now_order['mer_id'], array('group_buy_count' => $now_order['num'], 'group_buy_money' => $now_order['total_money']));

                if ($now_user['openid'] && $order_param['is_mobile']) {
                    $href = C('config.site_url') . '/wap.php?c=My&a=group_order&order_id=' . $now_order['order_id'];
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                    if ($now_order['tuan_type'] < 2) {
                        $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'] . '提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'] . '成功，您的消费码：' . $data_group_order['group_pass']));
                    } else {
                        $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'] . '提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'] . '成功，感谢您的使用'));
                    }
                }

                $sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
                if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
                    $sms_data['uid'] = $now_order['uid'];
                    $sms_data['mobile'] = $now_order['phone'];
                    $sms_data['sendto'] = 'user';
                    $sms_data['content'] = '您购买 ' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . ')已经完成支付,您的消费码：' . $data_group_order['group_pass'];
                    Sms::sendSms($sms_data);
                }
                if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
                    $merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
                    $sms_data['uid'] = 0;
                    $sms_data['mobile'] = $merchant['phone'];
                    $sms_data['sendto'] = 'merchant';
                    $sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
                    Sms::sendSms($sms_data);
                }

                if ($order_param['is_mobile']) {
                    return array('error' => 0, 'url' => str_replace('/source/', '/', U('My/group_order', array('order_id' => $now_order['order_id']))));
                } else {
                    return array('error' => 0, 'url' => U('User/Index/group_order_view', array('order_id' => $now_order['order_id'])));
                }
            } else {
                return array('error' => 1, 'msg' => '修改订单状态失败，请联系系统管理员！');
            }
        }
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
    //修改订单状态
    public function change_status($order_id, $status)
    {
        $condition_group_order['order_id'] = $order_id;
        $data_group_order['status'] = $status;
        if ($this->where($condition_group_order)->data($data_group_order)->save()) {
            return true;
        } else {
            return false;
        }
    }
    /*获得订单链接*/
    public function get_order_url($order_id, $is_wap = false)
    {
        if ($is_wap) {
            return U('My/group_order', array('order_id' => $order_id));
        } else {
            return U('User/Index/group_order_view', array('order_id' => $order_id));
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
        $total = $this->where("`paid`=1 AND `add_time`>'$stime' AND `add_time`<'$etime'")->count();
        return $total;
    }
}
