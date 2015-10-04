<?php

/*
 * 后台管理基础类
 *
 */

class IndexAction extends BaseAction {

    public function index() {
        $this->display();
    }

    public function main() {
        if ($this->system_session['area_id']) {
            $this->redirect(U('Index/profile'));
        }
        $server_info = array(
            '运行环境' => PHP_OS . ' ' . $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式' => php_sapi_name(),
            'MYSQL版本' => mysql_get_client_info(),
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . '秒',
            '磁盘剩余空间 ' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
        );
        $this->assign('server_info', $server_info);

        //网站统计
        $pigcms_assign['website_user_count'] = M('User')->count();
        $pigcms_assign['website_merchant_count'] = M('Merchant')->count();
        $pigcms_assign['website_merchant_store_count'] = M('Merchant_store')->count();
        //团购统计
        $pigcms_assign['group_group_count'] = M('Group')->count();
        $pigcms_assign['group_today_order_count'] = D('Group_order')->get_all_oreder_count('day');
        $pigcms_assign['group_week_order_count'] = D('Group_order')->get_all_oreder_count('week');
        $pigcms_assign['group_month_order_count'] = D('Group_order')->get_all_oreder_count('month');
        $pigcms_assign['group_year_order_count'] = D('Group_order')->get_all_oreder_count('year');
        //订餐统计
        $pigcms_assign['meal_store_count'] = M('Merchant_store_meal')->count();
        $pigcms_assign['meal_today_order_count'] = D('Meal_order')->get_all_oreder_count('day');
        $pigcms_assign['meal_week_order_count'] = D('Meal_order')->get_all_oreder_count('week');
        $pigcms_assign['meal_month_order_count'] = D('Meal_order')->get_all_oreder_count('month');
        $pigcms_assign['meal_year_order_count'] = D('Meal_order')->get_all_oreder_count('year');


        //商家待审核
        // $pigcms_assign['merchant_verify_list'] = D('Merchant')->where(array('status'=>'2','reg_time'=>array('gt',$this->system_session['last_time'])))->select();
        if ($this->system_session['area_id']) {
            $pigcms_assign['merchant_verify_count'] = D('Merchant')->where(array('status' => '2', 'area_id' => $this->system_session['area_id']))->count();
            //店铺待审核
            // $pigcms_assign['merchant_verify_store_list'] = D('Merchant_store')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();
            $pigcms_assign['merchant_verify_store_count'] = D('Merchant_store')->where(array('status' => 0, 'area_id' => $this->system_session['area_id']))->count();
            //团购待审核
            // $pigcms_assign['group_verify_list'] = D('Group')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();
            $merchants = D('Merchant')->field('mer_id')->where(array('status' => '1', 'area_id' => $this->system_session['area_id']))->select();
            $mer_ids = array();
            foreach ($merchants as $m) {
                if (!in_array($m['mer_id'], $mer_ids))
                    $mer_ids[] = $m['mer_id'];
            }

            $pigcms_assign['group_verify_count'] = 0;
            if ($mer_ids) {
                $pigcms_assign['group_verify_count'] = D('Group')->where(array('status' => '2', 'mer_id' => array('in', $mer_ids)))->count();
            }
        } else {
            $pigcms_assign['merchant_verify_count'] = D('Merchant')->where(array('status' => '2'))->count();
            //店铺待审核
            // $pigcms_assign['merchant_verify_store_list'] = D('Merchant_store')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();
            $pigcms_assign['merchant_verify_store_count'] = D('Merchant_store')->where(array('status' => 0))->count();
            //团购待审核
            // $pigcms_assign['group_verify_list'] = D('Group')->where(array('status'=>'2','last_time'=>array('gt',$this->system_session['last_time'])))->select();
            $pigcms_assign['group_verify_count'] = D('Group')->where(array('status' => '2'))->count();
        }
        $this->assign($pigcms_assign);
        $this->display();
    }

    public function pass() {
        $this->display();
    }

    public function amend_pass() {
        $old_pass = $this->_post('old_pass');
        $new_pass = $this->_post('new_pass');
        $re_pass = $this->_post('re_pass');
        if ($old_pass == '') {
            $this->error('请填写旧密码！');
        } else if ($new_pass != $re_pass) {
            $this->error('两次新密码填写不一致！');
        } else if ($old_pass == $new_pass) {
            $this->error('新旧密码不能一样！');
        }

        $database_admin = D('Admin');
        $condition_admin['id'] = $this->system_session['id'];
        $admin = $database_admin->field('`id`,`pwd`')->where($condition_admin)->find();
        if ($admin['pwd'] != md5($old_pass)) {
            $this->error('旧密码错误！');
        } else {
            $data_admin['id'] = $admin['id'];
            $data_admin['pwd'] = md5($new_pass);
            if ($database_admin->data($data_admin)->save()) {
                $this->success('密码修改成功！');
            } else {
                $this->error('密码修改失败！请重试。');
            }
        }
    }

    public function profile() {
        $database_admin = D('Admin');
        $condition_admin['id'] = $this->system_session['id'];
        $admin = $database_admin->where($condition_admin)->find();
        $this->assign('admin', $admin);
        $this->display();
    }

    public function amend_profile() {
        $database_admin = D('Admin');
        $data_admin['id'] = $this->system_session['id'];
        $data_admin['realname'] = $this->_post('realname');
        $data_admin['email'] = $this->_post('email');
        $data_admin['qq'] = $this->_post('qq');
        $data_admin['phone'] = $this->_post('phone');
        if ($database_admin->data($data_admin)->save()) {
            $this->success('资料修改成功！');
        } else {
            $this->error('资料修改失败！请检查是否有修改内容后再重试。');
        }
    }

    public function cache() {
        import('ORG.Util.Dir');
        Dir::delDirnotself('./runtime');
        $this->frame_main_ok_tips('清除缓存成功！');
    }

    public function menu() {
        $this->assign('bg_color', '#F3F3F3');

        $database = D('Admin');
        $condition['id'] = intval($_GET['admin_id']);
        $admin = $database->field(true)->where($condition)->find();
        if (empty($admin)) {
            $this->frame_error_tips('数据库中没有查询到该管理员的信息！');
        }
        $admin['menus'] = explode(',', $admin['menus']);
        $this->assign('admin', $admin);

        $menus = D('System_menu')->where(array('show' => 1, 'status' => 1))->select();
        $list = array();
        foreach ($menus as $menu) {
            if (empty($menu['fid'])) {
                if (isset($list[$menu['id']])) {
                    $list[$menu['id']] = array_merge($list[$menu['id']], $menu);
                } else {
                    $list[$menu['id']] = $menu;
                }
            } else {
                if (isset($list[$menu['fid']])) {
                    $list[$menu['fid']]['lists'][] = $menu;
                } else {
                    $list[$menu['fid']]['lists'] = array($menu);
                }
            }
        }
        $this->assign('menus', $list);

        $this->display();
    }

    public function savemenu() {
        if (IS_POST) {
            $admin_id = isset($_POST['admin_id']) ? intval($_POST['admin_id']) : 0;
            $menus = isset($_POST['menus']) ? $_POST['menus'] : '';
            $menus = implode(',', $menus);
            $database = D('Admin');
            $database->where(array('id' => $admin_id))->save(array('menus' => $menus));
            $this->success('全选设置成功！');
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    public function account() {
//      import('ORG.Net.IpLocation');
//      $IpLocation = new IpLocation();
        $admins = D('Admin')->field(true)->where(array('level' => 0))->select();
//      foreach($admins as &$value){
//          $last_location = $IpLocation->getlocation(long2ip($value['last_ip']));
//          $value['last_ip_txt'] = iconv('GBK','UTF-8',$last_location['country']);
//      }
        $this->assign('admins', $admins);
        $this->display();
    }

    public function admin() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $admin = D('Admin')->field(true)->where(array('id' => $id))->find();
        $this->assign('admin', $admin);
        $this->assign('bg_color', '#F3F3F3');
        $this->display();
    }

    public function saveAdmin() {
        if (IS_POST) {
            $database_area = D('Admin');
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $account = htmlspecialchars($_POST['account']);
            if ($database_area->where("`id`<>'{$id}' AND `account`='{$account}'")->find()) {
                $this->error('数据库中已存在相同的账号，请更换。');
            }
            unset($_POST['id']);
            $_POST['level'] = 0;
            if ($id) {
                if ($_POST['pwd']) {
                    $_POST['pwd'] = md5($_POST['pwd']);
                } else {
                    unset($_POST['pwd']);
                }
                $database_area->where(array('id' => $id))->data($_POST)->save();
                $this->success('修改成功！');
            } else {
                if (empty($_POST['pwd'])) {
                    $this->error('密码不能为空~');
                }
                $_POST['pwd'] = md5($_POST['pwd']);
                if ($database_area->data($_POST)->add()) {
                    $this->success('添加成功！');
                } else {
                    $this->error('添加失败！请重试~');
                }
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    public function update_sys() {
        D('Config')->where(array('name' => 'system_version'))->data(array('value' => $_GET['now_version']))->save();
        $this->frame_main_ok_tips('升级完成', 3, U('Index/main'));
    }

    /*     * **网站地图***** */

    public function sitemap() {
        $this->display();
    }

    /*     * **执行网站地图*****
     * *<loc>www.example1.com</loc>该页的网址。该值必须少于256个字节(必填项)。格式为<loc>您的url地址</loc>
     * *<lastmod>2010-01-01</lastmod>该文件上次修改的日期(选填项)。格式为<lastmod>年-月-日</lastmod>
     * *<changefreq> always </changefreq>页面可能发生更改的频率(选填项)
     * *有效值为：always、hourly、daily、weekly、monthly、yearly、never
     * *<priority>1.0</priority >此网页的优先级。有效值范围从 0.0 到 1.0 (选填项) 。0.0优先级最低、1.0最高。
     * *
     * */

    public function exeGenerate() {
        set_time_limit('100');
        /*         * **寻找网址*** */
        $UrlSetArr = array();
        $siteurl = $this->config['site_url'];
        $siteurl = rtrim($siteurl, '/') . '/';
        $UrlSetArr[] = array('loc' => $siteurl, 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '1.0');
        /*         * **团购***** */
        $UrlSetArr[] = array('loc' => $siteurl . 'category/all', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.9');
        $urldatatmp = M('Group_category')->field('cat_id,cat_fid,cat_name,cat_url')->where(array('cat_status' => '1'))->order('cat_id ASC')->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'category/' . $vv['cat_url'], 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.7');
            }
        }

        $jointable = C('DB_PREFIX') . 'merchant';
        $GroupDb = M('Group');
        $GroupDb->join('as grp LEFT JOIN ' . $jointable . ' as mer on grp.mer_id=mer.mer_id');
        $urldatatmp = $GroupDb->field('grp.group_id,grp.mer_id,grp.last_time')->where('grp.status="1" AND mer.status="1"')->order('grp.group_id  DESC')->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'group/' . $vv['group_id'] . '.html', 'lastmod' => !empty($vv['last_time']) ? date('Y-m-d', $vv['last_time']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.9');
            }
        }

        /*         * **订餐***** */
        $UrlSetArr[] = array('loc' => $siteurl . 'meal/all', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.9');

        $urldatatmp = M('Meal_store_category')->field('cat_id,cat_fid,cat_name,cat_url')->where(array('cat_status' => '1'))->order('cat_id ASC')->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'meal/' . $vv['cat_url'] . '/all', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.7');
            }
        }
        $urldatatmp = M('Merchant_store')->field('store_id,mer_id')->where(array('have_meal' => '1', 'status' => '1'))->order('store_id ASC')->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'meal/' . $vv['store_id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'always', 'priority' => '0.9');
            }
        }
        /*         * **分类信息***** */
        $UrlSetArr[] = array('loc' => $siteurl . 'classify/', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.9');
        $UrlSetArr[] = array('loc' => $siteurl . 'classify/selectsub.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.5');
        $urldatatmp = M('Classify_category')->field('cid,fcid,subdir,updatetime')->where(array('cat_status' => '1'))->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                if (($vv['subdir'] == 1) && ($vv['fcid'] == 0)) {
                    $UrlSetArr[] = array('loc' => $siteurl . 'classify/subdirectory-' . $vv['cid'] . '.html', 'lastmod' => !empty($vv['updatetime']) ? date('Y-m-d', $vv['updatetime']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.5');
                } elseif (($vv['subdir'] == 2) && ($vv['fcid'] > 0)) {
                    $UrlSetArr[] = array('loc' => $siteurl . 'classify/list-' . $vv['cid'] . '.html', 'lastmod' => !empty($vv['updatetime']) ? date('Y-m-d', $vv['updatetime']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.8');
                } elseif (($vv['subdir'] == 3) && ($vv['fcid'] > 0)) {
                    $UrlSetArr[] = array('loc' => $siteurl . 'classify/list-' . $vv['fcid'] . '-' . $vv['cid'] . '.html', 'lastmod' => !empty($vv['updatetime']) ? date('Y-m-d', $vv['updatetime']) : date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.8');
                }
            }
        }

        $urldatatmp = M('Classify_userinput')->field('id,cid,addtime')->where(array('status' => '1'))->order('id DESC')->limit(5000)->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'classify/' . $vv['id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.9');
            }
        }

        /*         * *****商家中心********* */
        $urldatatmp = M('Merchant')->field('mer_id')->where(array('ismain' => 1, 'status' => 1))->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'merindex/' . $vv['mer_id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.3');
            }
        }
        /*         * ******活动********** */
        $UrlSetArr[] = array('loc' => $siteurl . 'activity/', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.6');
        $urldatatmp = M('Extension_activity_list')->field('pigcms_id')->where(array('status' => '1'))->select();
        if (!empty($urldatatmp)) {
            foreach ($urldatatmp as $vv) {
                $UrlSetArr[] = array('loc' => $siteurl . 'activity/' . $vv['pigcms_id'] . '.html', 'lastmod' => date('Y-m-d'), 'changefreq' => 'monthly', 'priority' => '0.5');
            }
        }
        $this->exeGenerateFile($UrlSetArr);
    }

    private function exeGenerateFile($UrlSetArr) {
        if (!empty($UrlSetArr)) {
            $xmlfilepath = './sitemap.xml';
            $fp = fopen($xmlfilepath, "wb");
            if ($fp) {
                fwrite($fp, '<?xml version="1.0" encoding="utf-8"?>' . chr(10) . '<urlset>');
                foreach ($UrlSetArr as $uv) {
                    $linestr = chr(10) . '<url>' . chr(10) . '<loc>' . $uv ['loc'] . '</loc>' . chr(10) . '<lastmod>' . $uv['lastmod'] . '</lastmod>' . chr(10) . '<changefreq>' . $uv ['changefreq'] . '</changefreq>' . chr(10) . '<priority>' . $uv['priority'] . '</priority>' . chr(10) . '</url>';
                    fwrite($fp, $linestr);
                }
                fwrite($fp, chr(10) . '</urlset>');
                fclose($fp);
                $this->dexit(array('error' => 0, 'msg' => '生成完成！'));
            } else {
                $this->dexit(array
                    ('error' => 1, 'msg' => '网站根目录下Sitemap.xml文件不可写！'));
            }
        }
        $this->dexit(array('error' => 1, 'msg' => '没有可生成的数据'));
    }

    /*     * json 格式封装函数* */

    private function dexit($data = '') {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }

}
