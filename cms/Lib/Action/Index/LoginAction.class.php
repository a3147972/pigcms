<?php

class LoginAction extends BaseAction
{
    public function index()
    {
        if (IS_POST) {
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
            $result = D('User')->checkin($phone, $pwd);
            if (empty($result['error_code'])) {
                session('user', $result['user']);
            }
            exit(json_encode($result));
        } else {
            $pigcms_assign['referer'] = !empty($_GET['referer']) ? strip_tags(htmlspecialchars_decode($_GET['referer'])) : (!empty($_SERVER['HTTP_REFERER']) ? strip_tags($_SERVER['HTTP_REFERER']) : U('Index/Index/index'));
            $pigcms_assign['url_referer'] = urlencode($pigcms_assign['referer']);
            $this->assign($pigcms_assign);

            $this->display();
        }
    }

    public function reg()
    {
        if (IS_POST) {
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
            $invitecode = isset($_POST['invitecode']) ? $_POST['invitecode'] : '';
            $recomment = isset($_POST['recomment']) ? $_POST['recomment'] : '';
            $result = D('User')->checkreg($phone, $pwd, $invitecode, $recomment);

            if (!empty($result['user'])) {
                session('user', $result['user']);
            }
            exit(json_encode($result));
        } else {
            $pigcms_assign['referer'] = !empty($_GET['referer']) ? strip_tags(htmlspecialchars_decode($_GET['referer'])) : (!empty($_SERVER['HTTP_REFERER']) ? strip_tags($_SERVER['HTTP_REFERER']) : U('Index/Index/index'));
            $pigcms_assign['url_referer'] = urlencode($pigcms_assign['referer']);
            $this->assign($pigcms_assign);

            $this->display();
        }
    }

    public function forgetpwd()
    {
        $accphone = isset($_GET['accphone']) ? trim($_GET['accphone']) : '';
        $this->assign('accphone', $accphone);
        $this->display();
    }

    /*     * *生成短信**** */

    public function Generate()
    {
        $phone = trim($_POST['phone']);
        $tmpid = intval($_POST['tmpid']);
        $vfycode = trim($_POST['vfycode']);
        if (empty($phone)) {
            exit(json_encode(array('error_code' => 1, 'msg' => '手机账号不能为空')));
        }

        if (!is_numeric($phone) || (strlen($phone) != 11)) {
            exit(json_encode(array('error_code' => 1, 'msg' => '请输入正确手机账号')));
        }

        $Userarr = M('User')->where(array('phone' => $phone))->find();
        if (empty($Userarr)) {
            exit(json_encode(array('error_code' => 3, 'msg' => '手机账号不存在，请先去注册吧！')));
        }

        $user_modifypwdDb = M('User_modifypwd');
        if (($tmpid > 0) && !empty($vfycode)) {
            $modifypwd = $user_modifypwdDb->where(array('vfcode' => $vfycode, 'telphone' => $phone))->find();
            if (!empty($modifypwd)) {
                $nowtime = time();
                if ($modifypwd['expiry'] > $nowtime) {
                    $tmpstr = base64_encode(json_encode(array('uid' => $Userarr['uid'], 'phone' => $phone, 'vfycode_id' => $modifypwd['id'])));
                    $encrystr = Encryptioncode($tmpstr, 'ENCODE');
                    session($phone . 'Generate_Pwd_Modify', $tmpstr);
                    exit(json_encode(array('error_code' => 2, 'msg' => $insert_id, 'urlpm' => $encrystr)));
                }
            }
            exit(json_encode(array('error_code' => 1, 'msg' => '验证错误！')));
        } else {
            $vcode = createRandomStr(12);
            //$content=$this->config['site_name'].'您的验证码是：'.$vcode.' 此验证码20分钟内有效。';
            $content = '您的验证码是：' . $vcode . ' 此验证码20分钟内有效。';
            Sms::sendSms(array('mer_id' => 0, 'store_id' => 0, 'content' => $content, 'mobile' => $phone, 'uid' => 0, 'type' => 'mfypwd'));
            $addtime = time();
            $expiry = $addtime + 20 * 60; /*             * **二十分钟有效期*** */
            $data = array('telphone' => $phone, 'vfcode' => $vcode, 'expiry' => $expiry, 'addtime' => $addtime);
            $insert_id = $user_modifypwdDb->add($data);
            //$datastr=base64_encode(json_encode($data));
            //$encrystr=Encryptioncode($datastr,'ENCODE');
            //session($phone.'Generate_Pwd_Modify',$encrystr);
            exit(json_encode(array('error_code' => 0, 'id' => $insert_id)));
        }
    }

    /*     * *修改密码**** */

    public function pwdModify()
    {
        $pm = trim($_GET['pm']);
        if (!empty($pm)) {
            $pm = str_replace(' ', '+', $pm);
            $tmpstr = Encryptioncode($pm, 'DECODE');
            $modfyinfo = json_decode(base64_decode($tmpstr), true);
            if (!empty($modfyinfo)) {
                $phone = $modfyinfo['phone'];
                $tmp = session($phone . 'Generate_Pwd_Modify');
                if ($tmp) {
                    $modifypwd = M('User_modifypwd')->where(array('id' => $modfyinfo['vfycode_id'], 'telphone' => $phone))->find();
                    $nowtime = time();
                    if ($modifypwd['expiry'] < $nowtime) {
                        $this->error('链接时间已经过期失效了', U('Index/Login/index'));
                        exit();
                    }
                    $this->assign('pm', $pm);
                    $this->display();
                    exit();
                }
            }
        }
        redirect(U('Index/Login/index'));
    }

    /*     * *修改密码**** */

    public function pwdModifying()
    {
        $pm = trim($_GET['pm']);
        $newpwd = trim($_POST['newpwd']);
        $new_pwd = trim($_POST['new_pwd']);
        if ($newpwd != $new_pwd) {
            exit(json_encode(array('error_code' => 1, 'msg' => '两次密码输入不一样！')));
        }
        if (!empty($pm)) {
            $pm = str_replace(' ', '+', $pm);
            $tmpstr = Encryptioncode($pm, 'DECODE');
            $modfyinfo = json_decode(base64_decode($tmpstr), true);
            if (!empty($modfyinfo)) {
                $phone = $modfyinfo['phone'];
                $tmp = session($phone . 'Generate_Pwd_Modify');
                if ($tmp) {
                    if (M('User')->where(array('uid' => $modfyinfo['uid'], 'phone' => $phone))->save(array('pwd' => md5($newpwd)))) {
                        session($phone . 'Generate_Pwd_Modify', null);
                        exit(json_encode(array('error_code' => 0, 'msg' => '密码修改成功！')));
                    } else {
                        exit(json_encode(array('error_code' => 2, 'msg' => '密码修改失败！')));
                    }
                }
            }
        }
        //exit(json_encode(array('error_code' => 2, 'msg' => '参数出错！')));
    }

    public function weixin()
    {
        $weixin_state = md5(uniqid());
        $_SESSION['weixin']['state'] = $weixin_state;
        $_SESSION['weixin']['referer'] = !empty($_GET['referer']) ? htmlspecialchars_decode($_GET['referer']) : $this->config['site_url'];

        $return_url = $this->config['site_url'] . '/source/web_weixin_back.php';
        redirect('https://open.weixin.qq.com/connect/qrconnect?appid=' . $this->config['login_weixin_appid'] . '&redirect_uri=' . $return_url . '&response_type=code&scope=snsapi_login&state=' . $weixin_state . '#wechat_redirect');
    }

    public function weixin_back()
    {
        $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : $this->config['site_url'];
        if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $_SESSION['weixin']['state'])) {
            unset($_SESSION['weixin']['state']);
            import('ORG.Net.Http');
            $http = new Http();
            $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['login_weixin_appid'] . '&secret=' . $this->config['login_weixin_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');

            $jsonrt = json_decode($return, true);
            if ($jsonrt['errcode']) {
                $error_msg_class = new GetErrorMsg();
                $this->error('授权发生错误：' . $error_msg_class->wx_error_msg($jsonrt['errcode']), $this->config['site_url'] . '/index.php?c=Login&a=index');
            }

            $return = $http->curlGet('https://api.weixin.qq.com/sns/userinfo?access_token=' . $jsonrt['access_token'] . '&openid=' . $jsonrt['openid'] . '&lang=zh_CN');
            $jsonrt = json_decode($return, true);
            if ($jsonrt['errcode']) {
                $error_msg_class = new GetErrorMsg();
                $this->error('授权发生错误：' . $error_msg_class->wx_error_msg($jsonrt['errcode']), $this->config['site_url'] . '/index.php&c=Login&a=index');
            }

            /* 优先使用 unionid 登录 */
            if (!empty($jsonrt['unionid'])) {
                $this->autologin('union_id', $jsonrt['unionid'], $referer);
            }
            /* 再次使用 openid 登录 */
            $this->autologin('openid', $jsonrt['openid'], $referer);

            /* 注册用户 */
            $data_user = array(
                'web_openid' => $jsonrt['openid'],
                'union_id' => ($jsonrt['unionid'] ? $jsonrt['unionid'] : ''),
                'nickname' => $jsonrt['nickname'],
                'sex' => $jsonrt['sex'],
                'province' => $jsonrt['province'],
                'city' => $jsonrt['city'],
                'avatar' => $jsonrt['headimgurl'],
            );
            $_SESSION['weixin']['user'] = $data_user;
            $this->assign('referer', $referer);
            $this->display();
        } else {
            $this->error('访问异常！请重新登录。', $this->config['site_url'] . '/index.php?c=Login&a=index');
        }
    }

    public function weixin_bind()
    {
        if (empty($_SESSION['weixin']['user'])) {
            $this->error('微信授权失效，请重新登录！');
        }
        $login_result = D('User')->checkin($_POST['phone'], $_POST['pwd']);
        if ($login_result['error_code']) {
            exit(json_encode($login_result));
        } else {
            $now_user = $login_result['user'];
            $condition_user['uid'] = $now_user['uid'];
            $data_user['web_openid'] = $_SESSION['weixin']['user']['web_openid'];
            if ($_SESSION['weixin']['user']['union_id']) {
                $data_user['union_id'] = $_SESSION['weixin']['user']['union_id'];
            }
            if (empty($now_user['avatar'])) {
                $data_user['avatar'] = $_SESSION['weixin']['user']['avatar'];
            }
            if (empty($now_user['sex'])) {
                $data_user['sex'] = $_SESSION['weixin']['user']['sex'];
            }
            if (empty($now_user['province'])) {
                $data_user['province'] = $_SESSION['weixin']['user']['province'];
            }
            if (empty($now_user['city'])) {
                $data_user['city'] = $_SESSION['weixin']['user']['city'];
            }

            if (D('User')->where($condition_user)->data($data_user)->save()) {
                unset($_SESSION['weixin']);
                session('user', $now_user);
                setcookie('login_name', $now_user['phone'], $_SERVER['REQUEST_TIME'] + 10000000, '/');

                $this->success('登录成功！');
            } else {
                $this->error('绑定失败！请重试。');
            }
        }
    }

    public function weixin_nobind()
    {
        if (empty($_SESSION['weixin']['user'])) {
            $this->error('微信授权失效，请重新登录！');
        }
        $reg_result = D('User')->autoreg($_SESSION['weixin']['user']);
        if ($reg_result['error_code']) {
            $this->error($reg_result['msg']);
        } else {
            $login_result = D('User')->autologin('web_openid', $_SESSION['weixin']['user']['web_openid']);
            if ($login_result['error_code']) {
                $this->error($login_result['msg'], $this->config['site_url'] . '/index.php?c=Login&a=index');
            } else {
                $now_user = $login_result['user'];
                session('user', $now_user);
                $referer = !empty($_SESSION['weixin']['referer']) ? $_SESSION['weixin']['referer'] : $this->config['site_url'];

                unset($_SESSION['weixin']);
                $this->success('登录成功！', $referer);
                exit;
            }
        }
    }

    public function logout()
    {
        session('user', null);
        $pigcms_referer = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U('Index/Index/index');
        redirect($pigcms_referer);
    }

    protected function autologin($field, $value, $referer)
    {
        $result = D('User')->autologin($field, $value);
        if (empty($result['error_code'])) {
            $now_user = $result['user'];
            session('user', $now_user);
            $this->success('登录成功！', $referer);
            exit;
        } else if ($result['error_code'] && $result['error_code'] != 1001) {
            $this->error($result['msg'], U('Login/index'));
        }
    }

    public function frame_login()
    {
        $pigcms_assign['referer'] = !empty($_GET['referer']) ? strip_tags($_GET['referer']) : (!empty($_SERVER['HTTP_REFERER']) ? strip_tags($_SERVER['HTTP_REFERER']) : U('Index/Index/index'));
        $pigcms_assign['url_referer'] = urlencode($pigcms_assign['referer']);
        $this->assign($pigcms_assign);

        $this->display();
    }

    public function ajax_weixin_login()
    {
        for ($i = 0; $i < 6; $i++) {
            $database_login_qrcode = D('Login_qrcode');
            $condition_login_qrcode['id'] = $_GET['qrcode_id'];
            $now_qrcode = $database_login_qrcode->field('`uid`')->where($condition_login_qrcode)->find();
            if (!empty($now_qrcode['uid'])) {
                if ($now_qrcode['uid'] == -1) {
                    $data_login_qrcode['uid'] = 0;
                    $database_login_qrcode->where($condition_login_qrcode)->data($data_login_qrcode)->save();
                    exit('reg_user');
                }
                $database_login_qrcode->where($condition_login_qrcode)->delete();
                $result = D('User')->autologin('uid', $now_qrcode['uid']);
                if (empty($result['error_code'])) {
                    session('user', $result['user']);
                    exit('true');
                } else if ($result['error_code'] == 1001) {
                    exit('no_user');
                } else if ($result['error_code']) {
                    exit('false');
                }
            }
            if ($i == 5) {
                exit('false');
            }
            sleep(3);
        }
    }

    public function frame_phone()
    {
        if (empty($this->user_session)) {
            echo json_encode(array('error_code' => true, 'msg' => '请先进行登录！'));
            exit;
        }
        if (!empty($this->user_session['phone'])) {
            echo json_encode(array('error_code' => true, 'msg' => '您已经绑定过手机号！不允许多次绑定。'));
            exit;
        }
        if (IS_POST) {
            if (empty($_POST['phone'])) {
                echo json_encode(array('error_code' => true, 'msg' => '请输入手机号码！'));
                exit;
            }
            if (empty($_POST['pwd'])) {
                echo json_encode(array('error_code' => true, 'msg' => '请输入密码！'));
                exit;
            }
            $database_user = D('User');
            $condition_user['phone'] = $_POST['phone'];
            if ($database_user->field('`uid`')->where($condition_user)->find()) {
                echo json_encode(array('error_code' => true, 'msg' => '手机号码已经存在！'));
                exit;
            }
            $condition_save_user['uid'] = $this->user_session['uid'];
            $data_save_user['phone'] = $_POST['phone'];
            $data_save_user['pwd'] = md5($_POST['pwd']);
            if ($database_user->where($condition_save_user)->data($data_save_user)->save()) {
                $_SESSION['user']['phone'] = $_POST['phone'];
                echo json_encode(array('error_code' => false, 'msg' => '手机号码绑定成功！'));
                exit;
            } else {
                echo json_encode(array('error_code' => true, 'msg' => '手机号码绑定失败！请重试。'));
                exit;
            }
        }

        $this->display();
    }
}
