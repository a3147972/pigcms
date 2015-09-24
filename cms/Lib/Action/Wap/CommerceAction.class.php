<?php

class CommerceAction extends BaseAction {

    protected $merchant_session;
    protected $store;

    protected function _initialize() {

        parent::_initialize();
        $this->merchant_session = session('merchant_session');
        if (ACTION_NAME != 'login') {
            if (empty($this->merchant_session)) {
                redirect(U('Commerce/login', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
                exit();
            }
            //$this->check_merchant_file();
            //$this->init_opt();
        }
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
    }

    public function index() {
        /**  商家数据统计 * */
        $mer_id = $this->merchant_session['mer_id'];
        //粉丝数量
        $pigcms_data['fans_count'] = M('')->table(array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u'))->where("`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='$mer_id'")->count();
        //会员卡数量
        $pigcms_data['card_count'] = M('Member_card_create')->where(array('token' => $mer_id, 'wecha_id' => array('neq', '')))->count();
        //微活动数量
        $pigcms_data['lottery_count'] = M('Lottery')->where(array('mer_id' => $mer_id))->count();
        //店铺数量
        $pigcms_data['store_count'] = M('Merchant_store')->where(array('mer_id' => $mer_id))->count();
        $this->assign($pigcms_data);
		$this->assign('mer_id',$mer_id);
        $this->display();
    }

    protected function check_merchant_file() {
        $filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
        if ($filename != 'index.php') {
            $this->error('非法访问商家中心！');
        }
    }

    protected function init_opt() { /*     * **实时查找商家的权限*** */
        $tmerch = D("Merchant")->field('menus')->where(array('mer_id' => $this->merchant_session['mer_id']))->find();
        if (empty($tmerch['menus'])) {
            $this->merchant_session['menus'] = '';
        } else {
            $this->merchant_session['menus'] = explode(",", $tmerch['menus']);
        }

        /*         * **实时查找商家的权限*** */

        $this->assign('merchant_session', $this->merchant_session);
    }

    public function login() {
        if ($this->isAjax()) {

            $database_merchant = D('Merchant');
            $condition_merchant['account'] = trim($_POST['account']);
            $now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
            if (empty($now_merchant)) {
                exit(json_encode(array('error' => '2', 'msg' => '用户名不存在！', 'dom_id' => 'account')));
            }
            $pwd = md5(trim($_POST['pwd']));
            if ($pwd != $now_merchant['pwd']) {
                exit(json_encode(array('error' => '3', 'msg' => '密码错误！', 'dom_id' => 'pwd')));
            }
            if ($now_merchant['status'] == 0) {
                exit(json_encode(array('error' => '4', 'msg' => '您被禁止登录！请联系工作人员获得详细帮助。', 'dom_id' => 'account')));
            } else if ($now_merchant['status'] == 2) {
                exit(json_encode(array('error' => '5', 'msg' => '您的帐号正在审核中，请耐心等待或联系工作人员审核。', 'dom_id' => 'account')));
            }

            $data_merchant['mer_id'] = $now_merchant['mer_id'];
            $data_merchant['last_ip'] = get_client_ip(1);
            $data_merchant['last_time'] = $_SERVER['REQUEST_TIME'];
            $data_merchant['login_count'] = $now_merchant['login_count'] + 1;
            if ($database_merchant->data($data_merchant)->save()) {
                $now_merchant['login_count'] += 1;

                if (!empty($now_merchant['last_ip'])) {
                    import('ORG.Net.IpLocation');
                    $IpLocation = new IpLocation();
                    $last_location = $IpLocation->getlocation(long2ip($now_merchant['last_ip']));
                    $now_merchant['last']['country'] = iconv('GBK', 'UTF-8', $last_location['country']);
                    $now_merchant['last']['area'] = iconv('GBK', 'UTF-8', $last_location['area']);
                }
                session('merchant_session', $now_merchant);
                exit(json_encode(array('error' => '0', 'msg' => '登录成功,现在跳转~', 'dom_id' => 'account')));
            } else {
                exit(json_encode(array('error' => '6', 'msg' => '登录信息保存失败,请重试！', 'dom_id' => 'account')));
            }
        } else {
            $referer = isset($_GET['referer']) ? htmlspecialchars_decode(urldecode($_GET['referer']), ENT_QUOTES) : '';
            $this->assign('refererUrl', $referer);
            $this->display();
        }
    }

    /******登陆店员中心********/
	public function loginStaff(){
	   $id=intval($_GET['id']);
	   $store_id=intval($_GET['store_id']);
	   $mer_id = $this->merchant_session['mer_id'];
	   if(($id>0) && ($store_id>0)){
		   $store_staffDb = D('Merchant_store_staff');
	       $now_staff = $tmp=$store_staffDb->field(true)->where(array('id'=>$id,'store_id'=>$store_id,'token'=>$mer_id))->find();
		   if(!empty($tmp)){
		      session('staff_session', serialize($tmp));
			  $this->redirect(U('Storestaff/index'));
			  exit();
		   }
	   }
	   $this->error_tips('登陆失败！');
       exit();
	}
    /*     * *商家二维码** */

    public function merchantewm() {
        if (empty($this->merchant_session['qrcode_id'])) {
            $qrcode_return = D('Recognition')->get_new_qrcode('merchant', $this->merchant_session['mer_id']);
        } else {
            $qrcode_return = D('Recognition')->get_qrcode($this->merchant_session['qrcode_id']);
        }
        $this->assign('qrcodeinfo', $qrcode_return);
        $this->display();
    }

    /*     * *店员管理** */

    public function mClerk() {
        $database_merchant_store = D('Merchant_store');
        $mer_id = $this->merchant_session['mer_id'];
        $all_store = $database_merchant_store->where(array('mer_id' => $mer_id, 'status' => 1))->field('store_id,mer_id,name,status')->order('sort desc,store_id  ASC')->select();
        if (empty($all_store)) {
            $this->error('店铺不存在！');
        }
        $allstore = array();
        foreach ($all_store as $vv) {
            $allstore[$vv['store_id']] = $vv;
        }

        $m_s_staffDb = D('Merchant_store_staff');
        $staff_list = $m_s_staffDb->where(array('token' => $mer_id))->order('`id` desc')->select();
        $newAllStaff = array();
        if (!empty($staff_list)) {
            foreach ($staff_list as $sv) {
                if (isset($allstore[$sv['store_id']])) {
                    $sv['storename'] = $allstore[$sv['store_id']]['name'];
                    $sv['mer_id'] = $allstore[$sv['store_id']]['mer_id'];
                    $newAllStaff[] = $sv;
                }
            }
        }
        unset($staff_list, $allstore, $all_store);
        $this->assign('staff_list', $newAllStaff);
        $this->display();
    }

    /*     * *****删除店员******** */

    public function clerk_del() {
        $database_merchant_store = D('Merchant_store');
        $store_id = intval($_POST['storeid']);
        $id = intval($_POST['id']);
        $mer_id = $this->merchant_session['mer_id'];
        $now_store = $database_merchant_store->where(array('store_id' => $store_id, 'mer_id' => $mer_id))->find();
        if (empty($now_store)) {
            exit(json_encode(array('error' => 1, 'msg' => '店铺不存在！')));
        }

        $company_staff_db = M('Merchant_store_staff');

        if ($company_staff_db->where(array('id' => $id, 'token' => $mer_id))->delete()) {
            exit(json_encode(array('error' => 0, 'msg' => 'OK')));
        } else {
            exit(json_encode(array('error' => 1, 'msg' => '删除失败！')));
        }
    }

    /*     * *****添加店员信息******** */

    public function clerk_set() {
        $database_merchant_store = D('Merchant_store');
        $store_id = isset($_GET['store_id']) ? intval($_GET['store_id']) : 0;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $mer_id = $this->merchant_session['mer_id'];

        $company_staff_db = M('Merchant_store_staff');
        if (IS_POST) {
            if (!trim($_POST['name']) || !trim($_POST['username'])) {
                $this->error('姓名、帐号都不能为空');
            }
            $data['name'] = trim($_POST['name']);
            $data['username'] = trim($_POST['username']);
            $data['token'] = $mer_id;
            $data['time'] = time();
            $itemid = isset($_POST['id']) ? intval($_POST['id']) : 0;
            if (!($itemid > 0)) {
				$tmp=$company_staff_db->field('`id`')->where(array('username' => $data['username']))->find();
                if (!empty($tmp)) {
                    $this->error('帐号已经存在！请换一个。');
                }
                if (!trim($_POST['password'])) {
                    $this->error('密码不能为空');
                }
                $data['store_id'] = intval($_POST['store_id']);
                $data['password'] = md5(trim($_POST['password']));

                if (!$company_staff_db->add($data)) {
                    $this->error('添加失败，请重试。');
                } else {
                    $this->success('店员添加成功！', U('Commerce/mClerk'));
                }
            } else {
                /* 检测帐号 */
                $username_staff = $company_staff_db->field('`id`')->where(array('id' => $itemid))->find();
                if (empty($username_staff)) {
                    $this->error('帐号不存在！请换一个。');
                }

                if (trim($_POST['password'])) {
                    $data['password'] = md5(trim($_POST['password']));
                }
                if (!$company_staff_db->where(array('id' => $itemid))->save($data)) {
                    $this->error('修改失败，请重试。');
                } else {
                    $this->success('操作成功', U('Commerce/mClerk'));
                }
            }
        } else {

            if ($id > 0) {
                $thisItem = $company_staff_db->where(array('id' => $id, 'store_id' => $store_id))->find();
            } else {
                $thisItem = array('name' => '', 'username' => '', 'tel' => '');
            }
            $all_store = $database_merchant_store->where(array('mer_id' => $mer_id, 'status' => 1))->field('store_id,mer_id,name,status')->order('sort desc,store_id  ASC')->select();
            $this->assign('id', isset($thisItem['id']) ? $thisItem['id'] : 0);
            $this->assign('store_id', isset($thisItem['store_id']) ? $thisItem['store_id'] : 0);
            $this->assign('all_store', $all_store);
            $this->assign('item', $thisItem);
            $this->display();
        }
    }

    /*     * *****订餐***** */

    public function meal() {
        $mer_id = $this->merchant_session['mer_id'];
        $db_arr = array(C('DB_PREFIX') . 'area' => 'a', C('DB_PREFIX') . 'merchant_store' => 's');
        $store_list = D()->table($db_arr)->field(true)->where("`s`.`mer_id`='$mer_id' AND `s`.`status`!='2' AND `s`.`have_meal`='1' AND `s`.`area_id`=`a`.`area_id`")->order('`sort` DESC,`store_id` ASC')->select();
        $this->assign('store_list', $store_list);
        $this->display();
    }

    /*     * *****团购***** */

    public function group() {
        $database_group = D('Group');
        $condition_group['mer_id'] = $this->merchant_session['mer_id'];
        $group_list = $database_group->field(true)->where($condition_group)->order('`group_id` DESC')->select();
        $this->assign('group_list', $group_list);
        $this->display();
    }

    /*     * *商家二维码** */

    public function erwm() {
        $type = trim($_POST['type']);
        $id = trim($_POST['sid']);
        if ($type == 'group') {
            $pigcms_return = D('Group')->get_qrcode($id);
        } elseif ($type == 'meal') {
            $pigcms_return = D('Merchant_store')->get_qrcode($id);
        }

        if (empty($pigcms_return['qrcode_id'])) {
            $qrcode_return = D('Recognition')->get_new_qrcode($type, $id);
        } else {
            $qrcode_return = D('Recognition')->get_qrcode($pigcms_return['qrcode_id']);
        }
        exit(json_encode($qrcode_return));
    }

    /*     * *商家统计** */

    public function statistical() {
        $condition_merchant_request['mer_id'] = $this->merchant_session['mer_id'];
        $today_zero_time = mktime(0, 0, 0, date('m', $_SERVER['REQUEST_TIME']), date('d', $_SERVER['REQUEST_TIME']), date('Y', $_SERVER['REQUEST_TIME']));

        $condition_merchant_request['time'] = array(array('egt', $today_zero_time - ((7 - 1) * 86400)), array('elt', $today_zero_time));


        $request_list = M('Merchant_request')->field(true)->where($condition_merchant_request)->order('`time` ASC')->select();

        foreach ($request_list as $value) {
            $tmp_time = date('Ymd', $value['time']);
            $tmp_array[$tmp_time] = $value;
        }
        for ($i = 1; $i <= 7; $i++) {
            $tmp_time = date('Ymd', $today_zero_time - (($i - 1) * 86400));
            if (empty($tmp_array[$tmp_time])) {
                $tmp_array[$tmp_time] = array('time' => $today_zero_time - (($i - 1) * 86400));
            }
        }

        foreach ($tmp_array as $key => $value) {
            //基础统计
            $pigcms_list['xAxis_arr'][] = '"' . date('j', $value['time']) . '日"';
            $pigcms_list['follow_arr'][] = '"' . intval($value['follow_num']) . '"';
            $pigcms_list['img_arr'][] = '"' . intval($value['img_num']) . '"';
            $pigcms_list['website_hits_arr'][] = '"' . intval($value['website_hits']) . '"';
            //团购统计
            $pigcms_list['group_hits_arr'][] = '"' . intval($value['group_hits']) . '"';
            $pigcms_list['group_buy_count_arr'][] = '"' . intval($value['group_buy_count']) . '"';
            $pigcms_list['group_buy_money_arr'][] = '"' . floatval($value['group_buy_money']) . '"';
            //订餐统计
            $pigcms_list['meal_hits_arr'][] = '"' . intval($value['meal_hits']) . '"';
            $pigcms_list['meal_buy_count_arr'][] = '"' . intval($value['meal_buy_count']) . '"';
            $pigcms_list['meal_buy_money_arr'][] = '"' . floatval($value['meal_buy_money']) . '"';
        }
        //基础统计
        $pigcms_list['xAxis_txt'] = implode(',', $pigcms_list['xAxis_arr']);
        $pigcms_list['follow_txt'] = implode(',', $pigcms_list['follow_arr']);
        $pigcms_list['img_txt'] = implode(',', $pigcms_list['img_arr']);
        $pigcms_list['website_hits_txt'] = implode(',', $pigcms_list['website_hits_arr']);
        //团购统计
        $pigcms_list['group_hits_txt'] = implode(',', $pigcms_list['group_hits_arr']);
        $pigcms_list['group_buy_count_txt'] = implode(',', $pigcms_list['group_buy_count_arr']);
        $pigcms_list['group_buy_money_txt'] = implode(',', $pigcms_list['group_buy_money_arr']);
        //订餐统计
        $pigcms_list['meal_hits_txt'] = implode(',', $pigcms_list['meal_hits_arr']);
        $pigcms_list['meal_buy_count_txt'] = implode(',', $pigcms_list['meal_buy_count_arr']);
        $pigcms_list['meal_buy_money_txt'] = implode(',', $pigcms_list['meal_buy_money_arr']);
        $this->assign($pigcms_list);
        krsort($tmp_array);
        $this->assign('request_list', $tmp_array);
        $this->display();
    }

	public function logout(){
		session('merchant_session',null);
		header('Location: '.U('Commerce/login'));
	}
}

?>