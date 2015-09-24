<?php
class UserModel extends BaseModel
{
    /*得到所有用户*/
    public function get_user($uid, $field = 'uid')
    {
        $condition_user[$field] = $uid;
        $now_user = $this->field(true)->where($condition_user)->find();
        if (!empty($now_user)) {
            $now_user['now_money'] = floatval($now_user['now_money']);
        }
        return $now_user;
    }
    /*帐号密码检入*/
    public function checkin($phone, $pwd)
    {
        if (empty($phone)) {
            return array('error_code' => true, 'msg' => '手机号不能为空');
        }
        if (empty($pwd)) {
            return array('error_code' => true, 'msg' => '密码不能为空');
        }
        $now_user = $this->field(true)->where(array('phone' => $phone))->find();
        if ($now_user) {
            if ($now_user['pwd'] != md5($pwd)) {
                return array('error_code' => true, 'msg' => '密码不正确!');
            }
            if (empty($now_user['status'])) {
                return array('error_code' => true, 'msg' => '该帐号被禁止登录!');
            }
            $condition_save_user['uid'] = $now_user['uid'];
            $data_save_user['last_time'] = $_SERVER['REQUEST_TIME'];
            $data_save_user['last_ip'] = get_client_ip(1);
            $this->where($condition_save_user)->data($data_save_user)->save();

            return array('error_code' => false, 'msg' => 'OK', 'user' => $now_user);
        } else {
            return array('error_code' => true, 'msg' => '手机号不存在!');
        }
    }
    /*手机号、union_id、open_id 直接登录入口*/
    public function autologin($field, $value)
    {
        $condition_user[$field] = $value;
        $now_user = $this->field(true)->where($condition_user)->find();
        if ($now_user) {
            if (empty($now_user['status'])) {
                return array('error_code' => true, 'msg' => '该帐号被禁止登录!');
            }
            $condition_save_user['uid'] = $now_user['uid'];
            $data_save_user['last_time'] = $_SERVER['REQUEST_TIME'];
            $data_save_user['last_ip'] = get_client_ip(1);
            $this->where($condition_save_user)->data($data_save_user)->save();

            return array('error_code' => false, 'msg' => 'OK', 'user' => $now_user);
        } else {
            return array('error_code' => 1001, 'msg' => '没有此用户！');
        }
    }
    /*
     *    提供用户信息注册用户，密码需要自行md5处理
     *
     *    **** 请自行处理逻辑，此处直接插入用户表 ****
     */
    public function autoreg($data_user)
    {
        $data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
        $data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);

        if ($this->data($data_user)->add()) {
            return array('error_code' => false, 'msg' => 'OK');
        } else {
            return array('error_code' => true, 'msg' => '注册失败！请重试。');
        }
    }
    /*帐号密码注册*/
    /**
     * 账号密码注册
     * @method checkreg
     * @param  string   $phone      手机号
     * @param  string   $pwd        密码
     * @param  string   $invitecode 邀请码
     * @param  string   $recomment  推荐人
     * @return bool                 是否注册成功
     */
    public function checkreg($phone, $pwd, $invitecode, $recomment = '', $id_number, $id_number_img, $with_id_card)
    {
        if (empty($phone)) {
            return array('error_code' => true, 'msg' => '手机号不能为空');
        }
        if (empty($pwd)) {
            return array('error_code' => true, 'msg' => '密码不能为空');
        }

        if (!preg_match('/^[0-9]{11}$/', $phone)) {
            return array('error_code' => true, 'msg' => '请输入有效的手机号');
        }

        if (empty($invitecode)) {
            return array('error_code' => true, 'msg' => '请输入邀请码');
        }

        if (empty($id_number)) {
            return array('error_code' => true, 'msg' => '请输入身份证号');
        }
        if (empty($id_number_img)) {
            return array('error_code' => true, 'msg' => '请上传身份证号');
        }
        if (empty($with_id_card)) {
            return array('error_code' => true, 'msg' => '请上传手持身份证');
        }

        //检测推荐人是否存在
        if (!empty($recomment)) {
            $check_recomment = $this->checkUser($recomment);
            if ($check_recomment) {
                $recomment = $check_recomment;
            } else {
                return array('error_code' => true, 'msg' => '推荐人不存在');
            }
        }

        //判断邀请码是否正确
        $checkInviteCode = D('InviteCode')->checkCode($invitecode, 1);

        if (!$checkInviteCode) {
            return array('error_code' => true, 'msg' => '邀请码不存在');
        }
        $condition_user['phone'] = $phone;
        if ($this->field('`uid`')->where($condition_user)->find()) {
            return array('error_code' => true, 'msg' => '手机号已存在');
        }

        $data_user['phone'] = $phone;
        $data_user['pwd'] = md5($pwd);

        $data_user['nickname'] = substr($phone, 0, 3) . '****' . substr($phone, 7);

        $data_user['add_time'] = $data_user['last_time'] = $_SERVER['REQUEST_TIME'];
        $data_user['add_ip'] = $data_user['last_ip'] = get_client_ip(1);
        $data_user['invitcode'] = $invitecode;
        $data_user['recomment'] = $recomment['uid'];
        $data_user['id_number'] = $id_number;
        $data_user['id_number_img'] = $id_number_img;
        $data_user['with_id_card'] = $with_id_card;

        $uid = $this->data($data_user)->add();
        if ($uid) {
            //注册成功开始返现
            if (!empty($recomment)) {
                $this->member_reg_rebate($recomment['uid']);
            }
            //更改验证码状态
            D('InviteCode')->usedCode($invitecode);
            $return = $this->checkin($phone, $pwd);

            if (empty($return['error_code'])) {
                return $return;
            } else {
                return array('error_code' => false, 'msg' => 'OK');
            }
        } else {
            return array('error_code' => true, 'msg' => '注册失败！请重试。');
        }
    }
    /*修改用户信息*/
    public function save_user($uid, $field, $value)
    {
        $condition_user['uid'] = $uid;
        $data_user[$field] = $value;
        if ($this->where($condition_user)->data($data_user)->save()) {
            return array('error' => 0, $field => $value);
        } else {
            return array('error' => 1, 'msg' => '修改失败！请重试。');
        }
    }

    /*增加用户的钱*/
    public function add_money($uid, $money, $desc)
    {
        $condition_user['uid'] = $uid;
        if ($this->where($condition_user)->setInc('now_money', $money)) {
            D('User_money_list')->add_row($uid, 1, $money, $desc);
            return array('error_code' => false, 'msg' => 'OK');
        } else {
            return array('error_code' => true, 'msg' => '用户余额充值失败！请联系管理员协助解决。');
        }
    }

    /*使用用户的钱*/
    public function user_money($uid, $money, $desc)
    {
        $condition_user['uid'] = $uid;
        if ($this->where($condition_user)->setDec('now_money', $money)) {
            D('User_money_list')->add_row($uid, 2, $money, $desc);
            return array('error_code' => false, 'msg' => 'OK');
        } else {
            return array('error_code' => true, 'msg' => '用户余额扣除失败！请联系管理员协助解决。');
        }
    }

    /*增加用户的积分*/
    public function add_score($uid, $score, $desc)
    {
        $condition_user['uid'] = $uid;
        if ($this->where($condition_user)->setInc('score_count', $score)) {
            D('User_score_list')->add_row($uid, 1, $score, $desc);
            return array('error_code' => false, 'msg' => 'OK');
        } else {
            return array('error_code' => true, 'msg' => '添加积分失败！请联系管理员协助解决。');
        }
    }

    /*使用用户的积分*/
    public function user_score($uid, $score, $desc)
    {
        $condition_user['uid'] = $uid;
        if ($this->where($condition_user)->setDec('score_count', $score)) {
            D('User_score_list')->add_row($uid, 2, $score, $desc);
            return array('error_code' => false, 'msg' => 'OK');
        } else {
            return array('error_code' => true, 'msg' => '减少积分失败！请联系管理员协助解决。');
        }
    }

    /**
     * 检测会员是否存在
     * @method checkUser
     * @param  string    $phone 会员手机号
     * @return bool           存在返回true,不存在返回false;
     */
    public function checkUser($phone)
    {
        $map['phone'] = $phone;
        $map['status'] = 1;

        $result = $this->where($map)->field('uid')->find();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    /**
     * 给推荐人返利,只返利四层
     * @method member_reg_rebate
     * @param  int            $recomment 推荐人recomment
     * @return bool                返利成功返回true
     */
    public function member_reg_rebate($recomment)
    {
        $d = $recomment;
        $d_info = $this->where(array('uid' => $d))->find();

        if (!empty($d_info['recomment'])) {
            $c = $d_info['recomment'];
            $c_info = $this->where(array('uid' => $d_info['recomment']))->find();
        }

        if (!empty($c_info['recomment']) && isset($c_info['recomment']) && !empty($c_info['recomment'])) {
            $b = $d_info['recomment'];
            $b_info = $this->where(array('uid' => $c_info['recomment']))->find();
        }

        if (!empty($b_info['recomment']) && isset($b_info['recomment']) && !empty($b_info['recomment'])) {
            $a = $b_info['recomment'];
            $a_info = $this->where(array('uid' => $b_info['recomment']))->find();
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

        $a_rebate_ratio = (float)$this->config['reg_a_rebate']/100;
        $b_rebate_ratio = (float)$this->config['reg_b_rebate']/100;
        $c_rebate_ratio = (float)$this->config['reg_c_rebate']/100;
        $d_rebate_ratio = (float)$this->config['reg_d_rebate']/100;
        $reg_invitecode_price = $this->config['reg_invitecode_price'];

        switch ($level) {
            case 1:    //只有一层,则只给d返
                $d_money = number_format($reg_invitecode_price * $a_rebate_ratio, 2);
                break;
            case 2:    //给d和c返现
                $c_money = number_format($reg_invitecode_price * $a_rebate_ratio, 2);
                $d_money = number_format($reg_invitecode_price * $b_rebate_ratio, 2);
                break;
            case 3:    //给d,c,b返现
                $b_money = number_format($reg_invitecode_price * $a_rebate_ratio, 2);
                $c_money = number_format($reg_invitecode_price * $b_rebate_ratio, 2);
                $d_money = number_format($reg_invitecode_price * $c_rebate_ratio, 2);
                break;
            case 4:    //给d,c,b,a返现
                $a_money = number_format($reg_invitecode_price * $a_rebate_ratio, 2);
                $b_money = number_format($reg_invitecode_price * $b_rebate_ratio, 2);
                $c_money = number_format($reg_invitecode_price * $c_rebate_ratio, 2);
                $d_money = number_format($reg_invitecode_price * $d_rebate_ratio, 2);
                break;
        }

        $this->startTrans();

        if (isset($d_money) && !empty($d_money)) {
            $d_result = $this->add_money($d_info['uid'], $d_money, '注册推荐返利');
        } else {
            $d_result = true;
        }
        if (isset($c_money) && !empty($c_money)) {
            $c_result = $this->add_money($c_info['uid'], $c_money, '注册推荐返利');
        } else {
            $c_result = true;
        }
        if (isset($b_money) && !empty($b_money)) {
            $b_result = $this->add_money($b_info['uid'], $b_money, '注册推荐返利');
        } else {
            $b_result = true;
        }
        if (isset($a_money) && !empty($a_money)) {
            $a_result = $this->add_money($a_info['uid'], $a_money, '注册推荐返利');
        } else {
            $a_result = true;
        }

        if ($d_result && $c_result && $b_result && $a_result) {
            $this->commit();
            return true;
        } else {
            $this->rollback();
            return false;
        }
    }
}
