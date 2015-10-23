<?php
class HomeAction extends BaseAction
{
    public function index()
    {
        //判断是否是微信浏览器，如果是则跳转微信授权获得openid，从而读取微信提供的位置信息。
        if ($this->is_wexin_browser && !empty($_SESSION['openid'])) {
            $database_user_long_lat = D('User_long_lat');
            $condition_user_long_lat['open_id'] = $_SESSION['openid'];
            $user_long_lat = $database_user_long_lat->where($condition_user_long_lat)->find();
            if (!empty($user_long_lat) && $user_long_lat['long'] && $user_long_lat['dateline'] > $_SERVER['REQUEST_TIME'] - 3600) {
                $this->assign('user_long_lat', $user_long_lat);
            }
        }

        //手动首页排序团购
        $index_sort_group_list = D('Group')->get_group_list('index_sort', 3, true);
        $this->assign('index_sort_group_list', $index_sort_group_list);

        //顶部广告
        $wap_index_top_adver = D('Adver')->get_adver_by_key('wap_index_top', 5);
        $this->assign('wap_index_top_adver', $wap_index_top_adver);

        //中间广告
        $wap_index_center_adver = D('Adver')->get_adver_by_key('wap_index_center', 4);
        $this->assign('wap_index_center_adver', $wap_index_center_adver);

        //导航条
        $tmp_wap_index_slider = D('Slider')->get_slider_by_key('wap_slider', 0);
        $wap_index_slider = array();
        foreach ($tmp_wap_index_slider as $key => $value) {
            $tmp_i = floor($key / 8);
            $wap_index_slider[$tmp_i][] = $value;
        }
        $this->assign('wap_index_slider', $wap_index_slider);

        //最新20条团购
        // $new_group_list = D('Group')->get_group_list('new',15,true);
        $new_group_list = D('Group')->get_group_list('index_sort', 15, true);
        $this->assign('new_group_list', $new_group_list);

        //分类信息分类
        if ($this->config['wap_home_show_classify']) {
            $database_Classify_category = D('Classify_category');
            $Zcategorys = $database_Classify_category->field('`cid`,`cat_name`')->where(array('subdir' => 1, 'cat_status' => 1))->order('`cat_sort` DESC,`cid` ASC')->select();
            if (!empty($Zcategorys)) {
                $newtmp = array();
                foreach ($Zcategorys as $vv) {
                    unset($vv['cat_field']);
                    $subdir_info = $this->get_Subdirectory($vv['cid'], 1);
                    if (!empty($subdir_info)) {
                        $vv['subdir'] = $subdir_info;
                        $newtmp[$vv['cid']] = $vv;
                        if (count($vv['subdir']) % 3 != 0) {
                            $newtmp[$vv['cid']]['subEmptyCount'] = 3 - (count($vv['subdir']) % 3);
                        }
                    }

                }
                $Zcategorys = $newtmp;
            }
            $this->assign('classify_Zcategorys', $Zcategorys);
            // dump($Zcategorys);
        }
        /* 粉丝行为分析 */
        //$this->behavior(array('model'=>'Home_index'),true);

        $model = new Model();
        $sql = " select m.pic_info, m.name, m.mer_id, m.share_open from " . C('DB_PREFIX') . "merchant as m inner join " . C('DB_PREFIX') . "merchant_user_relation as r on r.mer_id=m.mer_id where r.openid='{$_SESSION['openid']}' order by r.dateline asc limit 1";
        $result = $model->query($sql);
        $now_merchant = isset($result[0]) && $result[0] ? $result[0] : null;
        if ($now_merchant) {
            $pic = '';
            if ($now_merchant['pic_info']) {
                $images = explode(";", $now_merchant['pic_info']);
                $merchant_image_class = new merchant_image();
                $images = explode(";", $images[0]);
                $pic = $merchant_image_class->get_image_by_path($images[0]);
            }
            switch ($this->config['home_share_show_open']) {
                case 0: //总关闭
                    if ($now_merchant['share_open'] == 1) {
                        $share = D('Home_share')->where(array('mer_id' => $now_merchant['mer_id']))->find();
                        if (empty($share)) {
                            $share = array('title' => str_replace('{title}', $now_merchant['name'], $this->config['home_share_txt']), 'a_name' => '进入', 'a_href' => $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);
                        }
                        $share['image'] = $pic;
                        $this->assign('share', $share);
                    } elseif ($now_merchant['share_open'] == 2) {
                        header('Location:' . $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);
                        exit();
                    }
                    break;
                case 1: //全开启首页广告
                    $share = D('Home_share')->where(array('mer_id' => $now_merchant['mer_id']))->find();
                    if (empty($share)) {
                        $share = array('title' => str_replace('{title}', $now_merchant['name'], $this->config['home_share_txt']), 'a_name' => '进入', 'a_href' => $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);
                    }
                    $share['image'] = $pic;
                    $this->assign('share', $share);
                    break;
                case 2: //全开启跳转到首页
                    header('Location:' . $this->config['site_url'] . '/wap.php?c=Index&a=index&token=' . $now_merchant['mer_id']);
                    exit();
                    break;
            }
        }
        $this->display();
    }
    public function near_info()
    {
        $condition_where = "`status`='1'";
        switch ($_POST['type']) {
            case 'merchant':
//                 $condition_where  = '';
                break;
            case 'meal':
                $condition_where .= " AND `have_meal`='1'";
                break;
            case 'group':
                $condition_where .= " AND `have_group`='1'";
                break;
            default:
                $this->error('非法访问！');
        }
        $x = $_POST['lat'];
        $y = $_POST['long'];

        import('@.ORG.longlat');
        $longlat_class = new longlat();
        $location = $longlat_class->gpsToBaidu($x, $y); //转换腾讯坐标到百度坐标
        $x = $location['lat'];
        $y = $location['lng'];
        if ($this->is_wexin_browser && !empty($_SESSION['openid'])) {
            $condition_user_long_lat['open_id'] = $_SESSION['openid'];
            $data_user_long_lat['lat'] = $x;
            $data_user_long_lat['long'] = $y;
            $data_user_long_lat['dateline'] = $_SERVER['REQUEST_TIME'];
            $database_user_long_lat = D('User_long_lat');
            if ($database_user_long_lat->field('`open_id`')->where($condition_user_long_lat)->find()) {
                $database_user_long_lat->where($condition_user_long_lat)->data($data_user_long_lat)->save();
            } else {
                $data_user_long_lat['open_id'] = $_SESSION['openid'];
                $database_user_long_lat->data($data_user_long_lat)->add();
            }
        }

        $store_list = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where($condition_where)->order('`juli` ASC')->limit('0,6')->select();

        if (!empty($store_list)) {
            $store_image_class = new store_image();
            foreach ($store_list as &$store) {
                $images = $store_image_class->get_allImage_by_path($store['pic_info']);
                $store['image'] = $images ? array_shift($images) : '';

                if ($store['juli'] > 1000) {
                    $store['juli'] = ' ' . floatval(round($store['juli'] / 1000, 1)) . ' 千米';
                } else {
                    $store['juli'] = ' ' . $store['juli'] . ' 米';
                }

                switch ($_POST['type']) {
                    case 'merchant':
                        $store['url'] = U('Index/index', array('token' => $store['mer_id']));
                        break;
                    case 'meal':
                        $store['url'] = U('Meal/menu', array('mer_id' => $store['mer_id'], 'store_id' => $store['store_id']));
                        break;
                    case 'group':
                        $store['url'] = U('Group/shop', array('store_id' => $store['store_id']));
                        break;
                    default:
                        $this->error('非法访问！');
                }
            }
            echo json_encode(array('error' => 0, 'store_list' => $store_list));
        } else {
            echo json_encode(array('error' => 1));
        }
    }

    public function group_index_sort()
    {
        $group_id = $_POST['id'];
        $database_index_group_hits = D('Index_group_hits');
        $data_index_group_hits['group_id'] = $group_id;
        $data_index_group_hits['ip'] = get_client_ip();
        if (!$database_index_group_hits->field('`group_id`')->where($data_index_group_hits)->find()) {
            $condition_group['group_id'] = $group_id;
            if (M('Group')->where($condition_group)->setDec('index_sort')) {
                if ($this->config['is_open_click_fans'] && $_SESSION['openid']) {
                    $group = M('Group')->where($condition_group)->find();
                    if (!($relation = D('Merchant_user_relation')->field(true)->where(array('openid' => $_SESSION['openid'], 'mer_id' => $group['mer_id']))->find())) {
                        D('Merchant_user_relation')->add(array('openid' => $_SESSION['openid'], 'mer_id' => $group['mer_id'], 'dateline' => time(), 'from_merchant' => 3)); //点击获取的粉丝类型
                    }
                }
                $data_index_group_hits['time'] = $_SERVER['REQUEST_TIME'];
                $database_index_group_hits->data($data_index_group_hits)->add();
            }
        }
    }
    private function get_Subdirectory($cid, $subdir, $m = 2)
    {
        $Classify_categoryDb = M('Classify_category');
        $Subdirectory = array();
        $where = false;
        if ($m == 2) {
            $where = array('fcid' => $cid, 'subdir' => 2, 'cat_status' => 1);
        } elseif ($m == 3) {
            if ($subdir == 1) {
                $where = array('pfcid' => $cid, 'subdir' => 3, 'cat_status' => 1);
            } else {
                $where = array('fcid' => $cid, 'subdir' => 3, 'cat_status' => 1);
            }
        }
        if ($where) {
            $Subdirectory = $Classify_categoryDb->field('`cid`,`cat_name`')->where($where)->order('`cat_sort` DESC,`cid` ASC')->select();
        }
        return $Subdirectory;
    }
}
