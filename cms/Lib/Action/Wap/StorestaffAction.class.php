<?php

/*
 * 店员中心 Wap版
 *
 */

class StorestaffAction extends BaseAction {

    protected $staff_session;
    protected $store;
	protected $database_store_staff;

    public function __construct() {

        parent::__construct();
        $this->staff_session = session('staff_session');
		$this->staff_session = !empty($this->staff_session) ? unserialize($this->staff_session) : false;
        if (ACTION_NAME != 'login') {
			if(empty($this->staff_session) && $this->is_wexin_browser && !empty($_SESSION['openid'])){
			   $tmpstaff=D('Merchant_store_staff')->field(true)->where(array('openid'=>trim($_SESSION['openid'])))->find();
			   if(!empty($tmpstaff)){
			     session('staff_session', serialize($tmpstaff));
				 $this->staff_session=$tmpstaff;
			   }
			}

            if (empty($this->staff_session)) {
                redirect(U('Storestaff/login', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
                exit();
            } else {
                $this->assign('staff_session', $this->staff_session);
                $database_merchant_store = D('Merchant_store');
                $condition_merchant_store['store_id'] = $this->staff_session['store_id'];
                $this->store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
                if (empty($this->store)) {
                    $this->error_tips('店铺不存在！');
                }
            }
        }
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
    }

    public function login() {
        if (IS_POST) {
            /* if(md5($_POST['verify']) != $_SESSION['merchant_store_login_verify']){
              exit(json_encode(array('error'=>'1','msg'=>'验证码不正确！','dom_id'=>'verify')));
              } */
            
            $condition_store_staff['username'] = trim($_POST['account']);
			$database_store_staff = D('Merchant_store_staff');
            $now_staff = $database_store_staff->field(true)->where($condition_store_staff)->find();

            if (empty($now_staff)) {
                exit(json_encode(array('error' => 2, 'msg' => '帐号不存在！', 'dom_id' => 'account')));
            }
            $pwd = md5(trim($_POST['pwd']));
            if ($pwd != $now_staff['password']) {
                exit(json_encode(array('error' => 3, 'msg' => '密码错误！', 'dom_id' => 'pwd')));
            }
            $data_store_staff['id'] = $now_staff['id'];
            $data_store_staff['last_time'] = $_SERVER['REQUEST_TIME'];
            if ($database_store_staff->data($data_store_staff)->save()) {
                session('staff_session', serialize($now_staff));
                exit(json_encode(array('error' => 0, 'msg' => '登录成功,现在跳转~', 'dom_id' => 'account')));
            } else {
                exit(json_encode(array('error' => 6, 'msg' => '登录信息保存失败,请重试！', 'dom_id' => 'account')));
            }
        } else {
			if($this->is_wexin_browser && !empty($_SESSION['openid'])){
			   $this->assign('openid',$_SESSION['openid']);
			}
			$referer=isset($_GET['referer']) ? htmlspecialchars_decode(urldecode($_GET['referer']),ENT_QUOTES) : '';
            $this->assign('refererUrl',$referer);
            $this->display();
        }
    }

	 /*****绑定微信下次免登陆********/
	 public function freeLogin(){
		if(IS_POST && $this->is_wexin_browser && !empty($_SESSION['openid']) && is_array($this->staff_session)){
		    $bindwx= D('Merchant_store_staff')->where(array('id'=>$this->staff_session['id'],'store_id'=>$this->staff_session['store_id']))->save(array('openid'=>trim($_SESSION['openid'])));
			echo D('Merchant_store_staff')->_sql();
			if($bindwx){
			   exit(json_encode(array('error' => 0)));
			}else{
			   exit(json_encode(array('error' => 1)));
			}
		}
		exit(json_encode(array('error' => 1)));
	 }

    public function index() {
        if (!empty($this->store['have_group'])) {
            redirect(U('Storestaff/group_list'));
        } else {
            redirect(U('Storestaff/meal_list'));
        }
        exit();
    }

    /* 团购相关 */

    protected function check_group() {
        if (empty($this->store['have_group'])) {
            $this->error_tips('您访问的店铺没有开通'.$this->config['group_alias_name'].'功能！');
        }
    }

    public function group_list() {
        $this->check_group();
        $store_id = $this->store['store_id'];
        $condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`store_id`='$store_id'";

        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o', C('DB_PREFIX') . 'user' => 'u');
        $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();
        $this->assign('order_list', $order_list);
        $this->display();
    }

    public function group_find() {
        if (IS_POST) {
            $mer_id = $this->store['mer_id'];
            $condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`mer_id`='$mer_id'";
            $find_value = $_POST['find_value'];
            $store_id = $this->store['store_id'];
            if ($_POST['find_type'] == 1 && strlen($find_value) == 14) {
                $condition_where .= " AND `o`.`group_pass`='$find_value'";
            } else {
                $condition_where .= " AND `o`.`store_id`='$store_id'";
                if ($_POST['find_type'] == 1) {
                    $condition_where .= " AND `o`.`group_pass` like '$find_value%'";
                } else if ($_POST['find_type'] == 2) {
                    $condition_where .= " AND `o`.`express_id` like '$find_value%'";
                } else if ($_POST['find_type'] == 3) {
                    $condition_where .= " AND `o`.`order_id`='$find_value'";
                } else if ($_POST['find_type'] == 4) {
                    $condition_where .= " AND `o`.`group_id`='$find_value'";
                } else if ($_POST['find_type'] == 5) {
                    $condition_where .= " AND `o`.`uid`='$find_value'";
                } else if ($_POST['find_type'] == 6) {
                    $condition_where .= " AND `u`.`nickname` like '$find_value%'";
                } else if ($_POST['find_type'] == 7) {
                    $condition_where .= " AND `o`.`phone` like '$find_value%'";
                }
            }
            $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o', C('DB_PREFIX') . 'user' => 'u');
            $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();
            if ($order_list) {
                foreach ($order_list as $key => $value) {
                    $order_list[$key]['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
                    $order_list[$key]['pay_time'] = date('Y-m-d H:i:s', $value['pay_time']);
                }
            }
            $return['list'] = $order_list;
            $return['row_count'] = count($order_list);
            echo json_encode($return);
        } else {
            $this->check_group();
            $this->display();
        }
    }

    public function group_verify() {
        $this->check_group();
        $database_group_order = D('Group_order');
        $now_order = $database_group_order->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], false);
        if (empty($now_order)) {
            $this->error('当前订单不存在！');
        } else if ($now_order['paid'] && $now_order['status'] == 0) {
            $condition_group_order['order_id'] = $now_order['order_id'];
            if (empty($now_order['third_id']) && $now_order['pay_type'] == 'offline') {
                $data_group_order['third_id'] = $now_order['order_id'];
            }
            $data_group_order['status'] = '1';
            $data_group_order['store_id'] = $this->store['store_id'];
            $data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['last_staff'] = $this->staff_session['name'];
            if ($database_group_order->where($condition_group_order)->data($data_group_order)->save()) {
            	
				$sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => $this->store['store_id'], 'type' => 'group');
				if ($this->config['sms_finish_order'] == 1 || $this->config['sms_finish_order'] == 3) {
					$sms_data['uid'] = $now_order['uid'];
					$sms_data['mobile'] = $now_order['phone'];
					$sms_data['sendto'] = 'user';
					$sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成了消费，如有任何疑意，请您及时联系本店，欢迎再次光临！';
					Sms::sendSms($sms_data);
				}
				if ($this->config['sms_finish_order'] == 2 || $this->config['sms_finish_order'] == 3) {
					$merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $merchant['phone'];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),已经完成了消费！';
					Sms::sendSms($sms_data);
				}
				
            	D('User')->add_score($now_order['uid'],floor($now_order['total_money']*C('config.user_score_get')),'购买 '.$now_order['order_name'].' 消费'.floatval($now_order['total_money']).'元 获得积分');
            	if ($now_order['merchant_balance'] > 0) {
            		D('Userinfo')->add_score($now_order['uid'], $now_order['mer_id'], $now_order['merchant_balance'], '购买 '.$now_order['order_name'].' 消费'.floatval($now_order['merchant_balance']).'元 获得积分');
            	}
                $this->success('验证成功！');
            } else {
                $this->error('验证失败！请重试。');
            }
        } else {
            $this->error('当前订单的状态并不是未消费。');
        }
    }

    protected function erroroutTips($msg, $ajax = false,$url='') {
        if ($ajax) {
            echo json_encode(array('error' => 1, 'msg' => $msg));
        } else {
            $this->error($msg,$url);
        }
        exit();
    }

    /*     * *扫二维码验证*** */

    public function group_qrcode() {
        $group_pass = trim($_GET['id']);
        $ajax = isset($_GET['ajax']) ? intval($_GET['ajax']) : false;
        if (empty($this->store['have_group'])) {
            $this->erroroutTips('您访问的店铺没有开通'.$this->config['group_alias_name'].'功能！', $ajax,U('Storestaff/group_list'));
        }
        $database_group_order = D('Group_order');
        $now_order = $database_group_order->where(array('mer_id' => $this->store['mer_id'], 'group_pass' => $group_pass))->find();
        if (empty($now_order)) {
            $this->erroroutTips('当前订单不存在！', $ajax,U('Storestaff/group_list'));
        } else if ($now_order['paid'] && $now_order['status'] == 0) {
            $condition_group_order['order_id'] = $now_order['order_id'];
            if (empty($now_order['third_id']) && $now_order['pay_type'] == 'offline') {
                $data_group_order['third_id'] = $now_order['order_id'];
            }
            $data_group_order['status'] = '1';
            $data_group_order['store_id'] = $this->store['store_id'];
            $data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['last_staff'] = $this->staff_session['name'];
            if ($database_group_order->where($condition_group_order)->data($data_group_order)->save()) {
                if ($ajax) {
                    echo json_encode(array('error' => 0, 'msg' => 'OK'));
                } else {
                    $this->success('验证成功！',U('Storestaff/group_list'));
                }
                exit();
            } else {
                $this->erroroutTips('验证失败！请重试。', $ajax,U('Storestaff/group_list'));
            }
        } else {
            $this->erroroutTips('当前订单的状态并不是未消费。', $ajax,U('Storestaff/group_list'));
        }
    }

    /*     * *扫二维码验证*** */

    public function meal_qrcode() {
        $order_id = trim($_GET['id']);
        $ajax = isset($_GET['ajax']) ? intval($_GET['ajax']) : false;
        if (empty($this->store['have_meal'])) {
            $this->erroroutTips('您访问的店铺没有开通'.$this->config['meal_alias_name'].'功能！', $ajax,U('Storestaff/meal_list'));
        }
        $store_id = intval($this->store['store_id']);
        if (!empty($order_id)) {
            if ($order = D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find()) {
                $data = array('store_uid' => $this->staff_session['id'], 'status' => 1,'use_time'=>time(),'last_staff'=>$this->staff_session['name']);
				if(empty($order['paid'])){
					$data['third_id'] = $order['order_id'];
                    $data['pay_type'] = 'offline';
                    $data['paid'] = 1;
				}
                D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->save($data);
                if ($ajax) {
                    echo json_encode(array('error' => 0, 'msg' => 'OK'));
                } else {
                    $this->success("更新成功", U('Storestaff/meal_list'));
                }
                exit();
            } else {
                $this->erroroutTips('验证失败！请重试。', $ajax,U('Storestaff/meal_list'));
            }
        } else {
            if ($ajax) {
                echo json_encode(array('error' => 1, 'msg' => '订单ID不存在！'));
            } else {
                $this->redirect(U('Storestaff/meal_list'));
            }
        }
    }

    public function group_edit() {
        $this->check_group();
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], false);
        if (empty($now_order)) {
            exit('此订单不存在！');
        }
		if(!empty($now_order['pay_type'])){
		     $now_order['paytypestr'] = D('Pay')->get_pay_name($now_order['pay_type']);
			 if(($now_order['pay_type']=='offline') && !empty($now_order['third_id']) && ($now_order['paid']==1)){
			     $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
			 }else if(($now_order['pay_type']!='offline') && ($now_order['paid']==1)){
			    $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
			 }else{
			    $now_order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
			 }
		}else{
		    $now_order['paytypestr'] = '未知';
		}
		 $this->assign('now_order', $now_order);
        //if($now_order['tuan_type'] == 2 && $now_order['paid'] == 1){
        $express_list = D('Express')->get_express_list();
        $this->assign('express_list', $express_list);
        //}
        $this->display();
    }

    public function group_express() {
        $this->check_group();
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], false);
        if (empty($now_order)) {
            $this->error('此订单不存在！');
        }
        if (empty($now_order['paid'])) {
            $this->error('此订单尚未支付！');
        }

        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['express_type'] = $_POST['express_type'];
        $data_group_order['express_id'] = $_POST['express_id'];
        $data_group_order['last_staff'] = $this->staff_session['name'];
        if ($now_order['paid'] == 1 && $now_order['status'] == 0) {
            $data_group_order['status'] = 1;
            $data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['store_id'] = $this->store['store_id'];
        }
        if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
            $this->success('修改成功！');
        } else {
            $this->error('修改失败！请重试。');
        }
    }

    public function group_remark() {
        $this->check_group();
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->store['mer_id'], $_GET['order_id'], true, false);
        if (empty($now_order)) {
            $this->error('此订单不存在！');
        }
        if (empty($now_order['paid'])) {
            $this->error('此订单尚未支付！');
        }
        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['merchant_remark'] = $_POST['merchant_remark'];
        if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
            $this->success('修改成功！');
        } else {
            $this->error('修改失败！请重试。');
        }
    }

    /* 检查是否开启订餐 */

    protected function check_meal() {
        if (empty($this->store['have_meal'])) {
            $this->error_tips('您访问的店铺没有开通'.$this->config['meal_alias_name'].'功能！');
        }
    }

    public function meal_list() {
        $this->check_meal();

        $store_id = intval($this->store['store_id']);
        $where = array('mer_id' => $this->store['mer_id'], 'store_id' => $store_id);
		$stauts=isset($_GET['st']) ? intval(trim($_GET['st'])) :false;
        $ftype = isset($_GET['ft']) ? trim($_GET['ft']) : '';
        $fvalue = isset($_GET['fv']) ? trim(htmlspecialchars($_GET['fv'])) : '';
		if(empty($ftype) && ($stauts==1)){ $where['paid']=1; $where['status']=0;$ftype='st';}
        switch ($ftype) {
            case 'oid': //订单id
                $fvalue && $where['order_id'] = array('like', "%$fvalue%");
                break;
            case 'xm':  //下单人姓名
                $fvalue && $where['name'] = array('like', "%$fvalue%");
                break;
            case 'dh':  //下单人电话
                $fvalue && $where['phone'] = array('like', "%$fvalue%");
                break;
            case 'mps': //消费码
                $fvalue && $where['meal_pass'] = array('like', "%$fvalue%");
                break;
            default:
                break;
        }
        $this->assign('ftype', $ftype);
        $this->assign('fvalue', $fvalue);

        $Meal_orderDb = D("Meal_order");
        $count = $Meal_orderDb->where($where)->count();
        import('@.ORG.merchant_page');
        $p = new Page($count, 20);
        $list = $Meal_orderDb->where($where)->order("order_id DESC")->limit($p->firstRow . ',' . $p->listRows)->select();
        foreach ($list as &$l) {
            $l['info'] = unserialize($l['info']);
        }
        $this->assign('order_list', $list);
        $this->assign('now_store', $this->store);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);

        $this->display();
    }

    public function meal_edit() {
        $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
        $store_id = intval($this->store['store_id']);
        if (IS_POST) {

            if (isset($_POST['status'])) {
                $status = intval($_POST['status']);
                if ($order = D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find()) {
                    $data = array('store_uid' => $this->staff_session['id'], 'status' => $status,'use_time'=>time(),'last_staff'=>$this->staff_session['name']);
					if(empty($order['third_id']) && $order['pay_type'] == 'offline'){
						$order['paid'] = 0;
					}
                    if ($status && $order['paid'] == 0) {//将未支付的订单，由店员改成已消费，其订单状态则修改成线下已支付！
                        $data['third_id'] = $order['order_id'];
                        $data['pay_type'] = 'offline';
                        $data['paid'] = 1;
                    }
                    
					if (D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->save($data)) {
						if ($status && $order['status'] == 0) {
							$mer_store = D('Merchant_store')->where(array('mer_id' => $this->store['mer_id'], 'store_id' => $store_id))->find();
							$msg = array();
							$msg['user_name'] = $order['name'];
							$msg['user_phone'] = $order['phone'];
							$msg['user_address'] = $order['address'];
							$msg['user_message'] = $order['note'];
							$msg['buy_time'] = date("Y-m-d H:i:s", $order['dateline']);
							$msg['goods_list'] = unserialize($order['info']);
							$msg['goods_count'] = $order['total'];
							$msg['goods_price'] = $order['price'];
							$msg['orderid'] = $order['order_id'];
							$msg['pay_status'] = '客户已消费';
							$msg['pay_type'] = $order['pay_type'];
							$msg['store_name'] = $mer_store['name'];
							$msg['store_phone'] = $mer_store['phone'];
							$msg['store_address'] = $mer_store['adress'];
							$msg = ArrayToStr::array_to_str($msg, 0, $this->config['print_format']);
							$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
							$op->printit($this->store['mer_id'], $store_id, $msg, 1);
							
							D('User')->add_score($order['uid'], floor($order['price'] * C('config.user_score_get')), '在 ' . $mer_store['name'] . ' 中消费' . floatval($order['price']) . '元 获得积分');
							if ($order['merchant_balance'] > 0) {
								D('Userinfo')->add_score($order['uid'], $order['mer_id'], $order['merchant_balance'], '在 ' . $mer_store['name'] . ' 中消费' . floatval($order['merchant_balance']) . '元 获得积分');
							}
							$sms_data = array('mer_id' => $mer_store['mer_id'], 'store_id' => $mer_store['store_id'], 'type' => 'food');
							if ($this->config['sms_finish_order'] == 1 || $this->config['sms_finish_order'] == 3) {
								$sms_data['uid'] = $order['uid'];
								$sms_data['mobile'] = $order['phone'];
								$sms_data['sendto'] = 'user';
								$sms_data['content'] = '您在 ' . $mer_store['name'] . '店中下的订单(订单号：' . $order['order_id'] . '),已经完成了消费，如有任何疑意，请您及时联系本店，欢迎再次光临！';
								Sms::sendSms($sms_data);
							}
							if ($this->config['sms_finish_order'] == 2 || $this->config['sms_finish_order'] == 3) {
								$sms_data['uid'] = 0;
								$sms_data['mobile'] = $merchant['phone'];
								$sms_data['sendto'] = 'merchant';
								$sms_data['content'] = '顾客购买的' . $order['name'] . '的订单(订单号：' . $order['order_id'] . '),已经完成了消费！';
								Sms::sendSms($sms_data);
							}
						}
						$this->success_tips('更新成功',U('Storestaff/meal_edit',array('order_id'=>$order['order_id'])));
					} else {
						$this->error_tips('更新失败，稍后再试');
					}
                } else {
                    $this->error_tips('不合法的请求');
                }
            } else {
                $this->redirect(U('Storestaff/meal_list'));
            }
        } else {
            $order = D("Meal_order")->where(array('mer_id' => $this->store['mer_id'], 'order_id' => $order_id, 'store_id' => $store_id))->find();
            $order['info'] = unserialize($order['info']);
            if ($order['store_uid']) {
                $staff = D("Merchant_store_staff")->where(array('id' => $order['store_uid']))->find();
                $order['store_uname'] = $staff['name'];
            }
            if (empty($order['third_id']) && $order['pay_type'] == 'offline') {
                $order['paid'] = 0;
            }
			if(!empty($order['pay_type'])){
				$order['paytypestr'] = D('Pay')->get_pay_name($order['pay_type']);
				if(($order['pay_type']=='offline') && !empty($order['third_id']) && ($order['paid']==1)){
					 $order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
				}else if(($order['pay_type']!='offline') && ($order['paid']==1)){
					$order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
				}else{
				 $order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
				}
			}else{
				$order['paytypestr'] = '未知';
			}
            $this->assign('order', $order);
            $this->display();
        }
    }

    public function logout() {
        session('staff_session', null);
        redirect(U('Storestaff/login'));
    }

}
