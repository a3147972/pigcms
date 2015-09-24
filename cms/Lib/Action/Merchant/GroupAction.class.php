<?php

/*
 * 团购
 */

class GroupAction extends BaseAction {
    /* 团购列表 */

    public function index() {
        $database_group = D('Group');
        $condition_group['mer_id'] = $this->merchant_session['mer_id'];
        $group_count = $database_group->where($condition_group)->count();

        import('@.ORG.merchant_page');
        $p = new Page($group_count, 20);
        $group_list = $database_group->field(true)->where($condition_group)->order('`group_id` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();

        $group_image_class = new group_image();
        foreach ($group_list as $key => $value) {
            $tmp_pic_arr = explode(';', $value['pic']);
            $group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
        }
        $this->assign('group_list', $group_list);

        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);

        $this->display();
    }

    public function add() {
        if (IS_POST) {

            if (empty($_POST['name'])) {
                $this->error('请填写商品标题');
            }
            if (empty($_POST['s_name'])) {
                $this->error('请填写商品名称');
            }
            if (empty($_POST['intro'])) {
                $this->error('请填写商品简介');
            }

            //判断关键词
            $keywords = trim($_POST['keywords']);
            if (!empty($keywords)) {
                $tmp_key_arr = explode(' ', $keywords);
                $key_arr = array();
                foreach ($tmp_key_arr as $value) {
                    if (!empty($value)) {
                        array_push($key_arr, $value);
                    }
                }
                if (count($key_arr) > 5) {
                    $this->error('关键词最多5个。');
                }
            }

            if (empty($_POST['old_price'])) {
                $this->error('请填写商品原价');
            }
            if (empty($_POST['price'])) {
                $this->error('请填写商品' . $this->config['group_alias_name'] . '价');
            }
            if (empty($_POST['store'])) {
                $this->error('请至少选择一家店铺');
            }
            if (empty($_POST['content'])) {
                $this->error('请填写本单详情');
            }
            if (empty($_POST['pic'])) {
                $this->error('请至少上传一张照片');
            }
            if (empty($_POST['success_num'])) {
                $this->error('成功' . $this->config['group_alias_name'] . '人数要求至少为1人');
            }
            isset($_POST['tagname']) && $_POST['tagname'] = trim($_POST['tagname']);
            $packageid = isset($_POST['packageid']) ? intval($_POST['packageid']) : 0;
            $leveloff = isset($_POST['leveloff']) ? $_POST['leveloff'] : false;
            unset($_POST['leveloff']);
            $_POST['pic'] = implode(';', $_POST['pic']);

            if ($_POST['cue_field']) {
                $cue_field = array();
                foreach ($_POST['cue_field']['value'] as $key => $value) {
                    array_push($cue_field, array('key' => $_POST['cue_field']['key'][$key], 'value' => $value));
                }
                $_POST['cue'] = serialize($cue_field);
            }
            if (is_array($_POST['custom'])) {
                foreach ($_POST['custom'] as $key => $value) {
                    if (is_array($value)) {
                        $_POST[$key] = implode(',', $value);
                    } else {
                        $_POST[$key] = $value;
                    }
                }
            }

            $_POST['content'] = fulltext_filter($_POST['content']);
            $_POST['discount'] = $_POST['price'] / $_POST['old_price'] * 10;

            $_POST['mer_id'] = $this->merchant_session['mer_id'];
            if ($this->config['group_verify']) {
                $_POST['status'] = $this->merchant_session['issign'] ? 1 : 2;
            } else {
                $_POST['status'] = 1;
            }

            $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
            $_POST['begin_time'] = strtotime($_POST['begin_time']);
            $_POST['end_time'] = strtotime($_POST['end_time']);
            $_POST['deadline_time'] = strtotime($_POST['deadline_time']);


            //店铺信息
            $database_merchant_store = D('Merchant_store');
            foreach ($_POST['store'] as $key => $value) {
                $condition_merchant_store['store_id'] = $value;
                $tmp_group_store = $database_merchant_store->field('`store_id`,`province_id`,`city_id`,`area_id`,`circle_id`')->where($condition_merchant_store)->find();
                if (!empty($tmp_group_store)) {
                    $data_group_store_arr[] = $tmp_group_store;
                }
                //给店铺添加分类
                if (!($store_catgory = D('Store_category')->field(true)->where(array('cat_id' => intval($_POST['cat_fid']), 'store_id' => $value))->find())) {
                    D('Store_category')->add(array('cat_id' => intval($_POST['cat_fid']), 'store_id' => $value));
                }
            }

            if (empty($data_group_store_arr)) {
                $this->error('您选择的店铺信息不正确！请重试。');
            } else if ($_POST['tuan_type'] == 2) {
                $_POST['prefix_title'] = '购物';
            } else if (count($data_group_store_arr) == 1) {
                $circle_info = D('Area')->get_area_by_areaId($data_group_store_arr[0]['circle_id']);
                if (empty($circle_info)) {
                    $this->error('您选择的店铺区域商圈信息不正确！请修改店铺资料后重试。');
                }
                $_POST['prefix_title'] = $circle_info['area_name'];
            } else {
                $_POST['prefix_title'] = count($data_group_store_arr) . '店通用';
            }

            $newleveloff = array();
            if (!empty($leveloff)) {
                foreach ($leveloff as $kk => $vv) {
                    $vv['type'] = intval($vv['type']);
                    $vv['vv'] = intval($vv['vv']);
                    if (($vv['type'] > 0) && ($vv['vv'] > 0)) {
                        $vv['level'] = $kk;
                        $newleveloff[$kk] = $vv;
                    }
                }
            }

            $_POST['leveloff'] = !empty($newleveloff) ? serialize($newleveloff) : '';
            if ($leveloff === false)
                unset($_POST['leveloff']);
            $database_group = D('Group');
            if ($group_id = $database_group->data($_POST)->add()) {
                $database_group_store = D('Group_store');
                foreach ($data_group_store_arr as $key => $value) {
                    $data_group_store = $value;
                    $data_group_store['group_id'] = $group_id;
                    $database_group_store->data($data_group_store)->add();
                }

                //判断关键词
                if (!empty($key_arr)) {
                    $database_keywords = D('Keywords');
                    $data_keywords['third_id'] = $group_id;
                    $data_keywords['third_type'] = 'group';
                    foreach ($key_arr as $value) {
                        $data_keywords['keyword'] = $value;
                        $database_keywords->data($data_keywords)->add();
                    }
                }

                //添加或删除到套餐
                if ($packageid > 0) {
                    $mpackageDb = M('Group_packages');
                    $mpackage = $mpackageDb->where(array('id' => $packageid, 'mer_id' => $this->merchant_session['mer_id']))->find();
                    if (!empty($mpackage)) {
                        $mpackage['groupidtext'] = !empty($mpackage['groupidtext']) ? unserialize($mpackage['groupidtext']) : array();
                        $mpackage['groupidtext'][$group_id] = $_POST['tagname'];
                        $mpackageDb->where(array('id' => $mpackage['id']))->save(array('groupidtext' => serialize($mpackage['groupidtext'])));
                    }
                }
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！请重试。');
            }
        } else {
            $database_group_category = D('Group_category');
            $condition_f_group_category['cat_fid'] = 0;
            $f_category_list = $database_group_category->field('`cat_id`,`cat_name`,`cat_field`,`cue_field`')->where($condition_f_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $this->assign('f_category_list', $f_category_list);
            if (empty($f_category_list)) {
                $this->error('管理员没有添加' . $this->config['group_alias_name'] . '分类！');
            }

            $condition_s_group_category['cat_fid'] = $f_category_list[0]['cat_id'];
            $condition_s_group_category['cat_status'] = 1;
            $s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $this->assign('s_category_list', $s_category_list);
            if (empty($s_category_list)) {
                $this->error($f_category_list[0]['cat_name'] . ' 分类下没有添加子分类！');
            }

            if (!empty($f_category_list[0]['cat_field'])) {
                $cat_field = unserialize($f_category_list[0]['cat_field']);
                $custom_html = '';
                foreach ($cat_field as $key => $value) {
                    if (empty($value['use_field'])) {
                        $custom_html .= '<div class="form-group"><label class="col-sm-1">' . $value['name'] . '：</label>';
                        if ($value['type'] == 0) {
                            $custom_html .= '<select name="custom[custom_' . $key . ']" class="col-sm-1">';
                            foreach ($value['value'] as $k => $v) {
                                $custom_html .= '<option value="' . $k . '">' . $v . '</option>';
                            }
                            $custom_html .= '</select>';
                        } else {
                            foreach ($value['value'] as $k => $v) {
                                $custom_html .= '<label style="margin-right:30px;"><input class="ace" type="checkbox" name="custom[custom_' . $key . '][]" value="' . $k . '" id="custom_' . $key . '_' . $k . '"/><span class="lbl"><label for="custom_' . $key . '_' . $k . '">&nbsp;' . $v . '</label></span></label>';
                            }
                        }
                        $custom_html .= '</div>';
                    }
                }
            }
            $this->assign('custom_html', $custom_html);

            if (!empty($f_category_list[0]['cue_field'])) {
                $cue_field = unserialize($f_category_list[0]['cue_field']);
                $cue_html = '';
                foreach ($cue_field as $key => $value) {
                    $cue_html .= '<div class="form-group"><label class="col-sm-1">' . $value['name'] . '：</label>';
                    if ($value['type'] == 0) {
                        $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><input type="text" class="col-sm-4" name="cue_field[value][]"/>';
                    } else {
                        $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><textarea class="col-sm-4" rows="5" name="cue_field[value][]"></textarea>';
                    }
                    $cue_html .= '</div>';
                }
            }
            $this->assign('cue_html', $cue_html);

            $mer_id = $this->merchant_session['mer_id'];
            $db_arr = array(C('DB_PREFIX') . 'area' => 'a', C('DB_PREFIX') . 'merchant_store' => 's');
            $store_list = D()->table($db_arr)->field('a.`area_name`,s.`adress`,`s`.`name`,`s`.`store_id`')->where("`s`.`mer_id`='$mer_id' AND `s`.`status`='1' AND `s`.`have_group`='1' AND `s`.`area_id`=`a`.`area_id`")->order('`sort` DESC,`store_id` ASC')->select();
            if (empty($store_list)) {
                $this->error('您暂时还没有能添加' . $this->config['group_alias_name'] . '信息的店铺！');
            }
            $this->assign('store_list', $store_list);
            $levelDb = M('User_level');
            $tmparr = $levelDb->where('22=22')->order('id ASC')->select();
            $levelarr = array();
            if ($tmparr && $this->config['level_onoff'] && $this->config['group_level_onoff']) {
                foreach ($tmparr as $vv) {
                    $levelarr[$vv['level']] = $vv;
                }
            }
            unset($tmparr);
            $this->assign('levelarr', $levelarr);
            $mpackageDb = M('Group_packages');
            $mpackagelist = $mpackageDb->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->order('id DESC')->select();
            $this->assign('mpackagelist', $mpackagelist);
            $this->display();
        }
    }

    public function frame_edit() {
        if (empty($_SESSION['system'])) {
            $this->error('非法修改');
        }

        $database_group = D('Group');
        $condition_group['group_id'] = $_GET['group_id'];
        $now_group = $database_group->field(true)->where($condition_group)->find();
        if (empty($now_group)) {
            $this->error('该' . $this->config['group_alias_name'] . '不存在！');
        }
        if (IS_POST) {
            if (empty($_POST['name'])) {
                $this->error('请填写商品标题');
            }
            if (empty($_POST['s_name'])) {
                $this->error('请填写商品名称');
            }
            if (empty($_POST['intro'])) {
                $this->error('请填写商品简介');
            }

            //判断关键词
            $keywords = trim($_POST['keywords']);
            if (!empty($keywords)) {
                $tmp_key_arr = explode(' ', $keywords);
                $key_arr = array();
                foreach ($tmp_key_arr as $value) {
                    if (!empty($value)) {
                        array_push($key_arr, $value);
                    }
                }
                if (count($key_arr) > 5) {
                    $this->error('关键词最多5个。');
                }
            }

            if (empty($_POST['old_price'])) {
                $this->error('请填写商品原价');
            }
            if (empty($_POST['price'])) {
                $this->error('请填写商品' . $this->config['group_alias_name'] . '价');
            }
            if (empty($_POST['store'])) {
                $this->error('请至少选择一家店铺');
            }
            if (empty($_POST['content'])) {
                $this->error('请填写本单详情');
            }
            if (empty($_POST['pic'])) {
                $this->error('请至少上传一张照片');
            }
            if (empty($_POST['success_num'])) {
                $this->error('成功' . $this->config['group_alias_name'] . '人数要求至少为1人');
            }
            $leveloff = isset($_POST['leveloff']) ? $_POST['leveloff'] : false;
            isset($_POST['tagname']) && $_POST['tagname'] = trim($_POST['tagname']);
            $packageid = isset($_POST['packageid']) ? intval($_POST['packageid']) : 0;

            unset($_POST['leveloff']);
            $_POST['pic'] = implode(';', $_POST['pic']);

            $_POST['content'] = fulltext_filter($_POST['content']);
            $_POST['discount'] = $_POST['price'] / $_POST['old_price'] * 10;

            $_POST['sort'] = intval($_POST['sort']);
            $_POST['index_sort'] = intval($_POST['index_sort']);

            $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
            $_POST['begin_time'] = strtotime($_POST['begin_time']);
            $_POST['end_time'] = strtotime($_POST['end_time']);
            $_POST['deadline_time'] = strtotime($_POST['deadline_time']);

            if ($_POST['cue_field']) {
                $cue_field = array();
                foreach ($_POST['cue_field']['value'] as $key => $value) {
                    array_push($cue_field, array('key' => $_POST['cue_field']['key'][$key], 'value' => $value));
                }
                $_POST['cue'] = serialize($cue_field);
            }
            if (!isset($_POST['noedittype']) && isset($_POST['cat_fid']) && isset($_POST['cat_id'])) {
                $_POST['custom_0'] = $_POST['custom_1'] = $_POST['custom_2'] = $_POST['custom_3'] = $_POST['custom_4'] = '';

                if (isset($_POST['custom']) && !empty($_POST['custom'])) {
                    foreach ($_POST['custom'] as $key => $value) {
                        if (is_array($value)) {
                            $_POST[$key] = implode(',', $value);
                        } else {
                            $_POST[$key] = $value;
                        }
                    }
                }
            }
            //店铺信息
            $database_merchant_store = D('Merchant_store');
            foreach ($_POST['store'] as $key => $value) {
                $condition_merchant_store['store_id'] = $value;
                $tmp_group_store = $database_merchant_store->field('`store_id`,`province_id`,`city_id`,`area_id`,`circle_id`')->where($condition_merchant_store)->find();
                if (!empty($tmp_group_store)) {
                    $data_group_store_arr[] = $tmp_group_store;
                }
            }
            if (empty($data_group_store_arr)) {
                $this->error('您选择的店铺信息不正确！请重试。');
            } else if ($_POST['tuan_type'] == 2) {
                $_POST['prefix_title'] = '购物';
            } else if (count($data_group_store_arr) == 1) {
                $circle_info = D('Area')->get_area_by_areaId($data_group_store_arr[0]['circle_id']);
                $_POST['prefix_title'] = $circle_info['area_name'];
            } else {
                $_POST['prefix_title'] = count($data_group_store_arr) . '店通用';
            }

            $group_id = $now_group['group_id'];
            $condition_save_group['group_id'] = $group_id;
            $newleveloff = array();
            if (!empty($leveloff)) {
                foreach ($leveloff as $kk => $vv) {
                    $vv['type'] = intval($vv['type']);
                    $vv['vv'] = intval($vv['vv']);
                    if (($vv['type'] > 0) && ($vv['vv'] > 0)) {
                        $vv['level'] = $kk;
                        $newleveloff[$kk] = $vv;
                    }
                }
            }

            $_POST['leveloff'] = !empty($newleveloff) ? serialize($newleveloff) : '';
            if ($leveloff === false)
                unset($_POST['leveloff']);
            if ($database_group->where($condition_save_group)->data($_POST)->save()) {
                $database_group_store = D('Group_store');
                $condition_group_store['group_id'] = $group_id;
                $database_group_store->where($condition_group_store)->delete();

                foreach ($data_group_store_arr as $key => $value) {
                    $data_group_store = $value;
                    $data_group_store['group_id'] = $group_id;
                    $database_group_store->data($data_group_store)->add();
                }

                //判断关键词
                $database_keywords = D('Keywords');
                $condition_keywords['third_id'] = $group_id;
                $condition_keywords['third_type'] = 'group';
                $database_keywords->where($condition_keywords)->delete();

                if (!empty($key_arr)) {
                    $data_keywords['third_id'] = $group_id;
                    $data_keywords['third_type'] = 'group';
                    foreach ($key_arr as $value) {
                        $data_keywords['keyword'] = $value;
                        $database_keywords->data($data_keywords)->add();
                    }
                }
                //添加或删除到套餐
                $mpackageDb = M('Group_packages');
                if ($now_group['packageid'] > 0) {
                    $mpackage = $mpackageDb->where(array('id' => $now_group['packageid'], 'mer_id' => $now_group['mer_id']))->find();
                    if (!empty($mpackage)) { /*                     * **删除原有的**** */
                        $mpackage['groupidtext'] = !empty($mpackage['groupidtext']) ? unserialize($mpackage['groupidtext']) : array();
                        unset($mpackage['groupidtext'][$group_id]);
                        $mpackage['groupidtext'] = !empty($mpackage['groupidtext']) ? serialize($mpackage['groupidtext']) : '';
                        $mpackageDb->where(array('id' => $mpackage['id']))->save(array('groupidtext' => $mpackage['groupidtext']));
                    }
                }
                if ($packageid > 0) { /*                 * ****现在编辑处理**** */
                    $mpackage2 = $mpackageDb->where(array('id' => $packageid, 'mer_id' => $now_group['mer_id']))->find();
                    if (!empty($mpackage2)) {
                        $mpackage2['groupidtext'] = !empty($mpackage2['groupidtext']) ? unserialize($mpackage['groupidtext']) : array();
                        $mpackage2['groupidtext'][$group_id] = $_POST['tagname'];
                        $mpackageDb->where(array('id' => $mpackage2['id']))->save(array('groupidtext' => serialize($mpackage2['groupidtext'])));
                    }
                }
                $this->success('编辑成功！');
            } else {
                $this->error('编辑失败！请重试。');
            }
        } else {
            //图片
            $group_image_class = new group_image();
            $tmp_pic_arr = explode(';', $now_group['pic']);
            foreach ($tmp_pic_arr as $key => $value) {
                $now_group['pic_arr'][$key]['title'] = $value;
                $now_group['pic_arr'][$key]['url'] = $group_image_class->get_image_by_path($value, 's');
            }
            if ($now_group['cue']) {
                $now_group['cue_arr'] = unserialize($now_group['cue']);
            }
            $this->assign('now_group', $now_group);

            //关键词
            $database_keywords = D('Keywords');
            $conditon_keywords['third_id'] = $now_group['group_id'];
            $conditon_keywords['third_type'] = 'group';
            $keywords_list = $database_keywords->field('`keyword`')->where($conditon_keywords)->order('`id` ASC')->select();
            if (!empty($keywords_list)) {
                $keywords_arr = array();
                foreach ($keywords_list as $value) {
                    $keywords_arr[] = $value['keyword'];
                }
                $keywords = implode(' ', $keywords_arr);
                $this->assign('keywords', $keywords);
            }

            //所属店铺
            $database_group_store = D('Group_store');
            $condition_group_store['group_id'] = $now_group['group_id'];
            $store_list = $database_group_store->field(true)->where($condition_group_store)->select();
            $store_arr = array();
            foreach ($store_list as $value) {
                $store_arr[] = $value['store_id'];
            }
            $this->assign('store_arr', $store_arr);



            //分类
            $database_group_category = D('Group_category');
            $condition_f_group_category['cat_fid'] = 0;
            $condition_f_group_category['cat_status'] = 1;
            $f_category_list = $database_group_category->field('`cat_id`,`cat_name`,`cat_field`,`cue_field`')->where($condition_f_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $this->assign('f_category_list', $f_category_list);
            if (empty($f_category_list)) {
                $this->error('管理员没有添加' . $this->config['group_alias_name'] . '分类！');
            }

            foreach ($f_category_list as $value) {
                if ($value['cat_id'] == $now_group['cat_fid']) {
                    $now_f_category = $value;
                    break;
                }
            }

            $condition_s_group_category['cat_fid'] = $now_group['cat_fid'];
            $condition_s_group_category['cat_status'] = 1;
            $s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            $this->assign('s_category_list', $s_category_list);
            if (empty($s_category_list)) {
                $this->error($f_category_list[0]['cat_name'] . ' 分类下没有添加子分类！');
            }
            if (!empty($now_f_category['cat_field'])) {
                $cat_field = unserialize($now_f_category['cat_field']);
                $custom_html = '';
                foreach ($cat_field as $key => $value) {
                    if (empty($value['use_field'])) {
                        $custom_html .= '<div class="form-group"><label class="col-sm-1">' . $value['name'] . '：</label>';
                        if ($value['type'] == 0) {
                            $custom_html .= '<select name="custom[custom_' . $key . ']" class="col-sm-1">';
                            foreach ($value['value'] as $k => $v) {
                                $custom_html .= '<option value="' . $k . '"';
                                if ($now_group['custom_' . $key] == $k) {
                                    $custom_html .=' selected=selected';
                                }
                                $custom_html .= ' >' . $v . '</option>';
                            }
                            $custom_html .= '</select>';
                        } else {
                            $checkVarr = explode(',', $now_group['custom_' . $key]);
                            $checkVarr = !empty($checkVarr) ? $checkVarr : array();
                            foreach ($value['value'] as $k => $v) {
                                $custom_html .= '<label style="margin-right:30px;"><input class="ace" type="checkbox" name="custom[custom_' . $key . '][]" value="' . $k . '" id="custom_' . $key . '_' . $k . '"';
                                if (in_array($k, $checkVarr)) {
                                    $custom_html .=' checked=checked';
                                }
                                $custom_html .= ' /><span class="lbl"><label for="custom_' . $key . '_' . $k . '">&nbsp;' . $v . '</label></span></label>';
                            }
                        }
                        $custom_html .= '</div>';
                    }
                }
            }
            $this->assign('custom_html', $custom_html);

            if (!empty($now_f_category['cue_field'])) {
                $cue_field = unserialize($now_f_category['cue_field']);
                $cue_html = '';
                foreach ($cue_field as $key => $value) {
                    $cue_html .= '<div class="form-group"><label class="col-sm-1">' . $value['name'] . '：</label>';
                    if ($value['type'] == 0) {
                        $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><input type="text" class="col-sm-4" name="cue_field[value][]" value="' . (!empty($now_group['cue_arr'][$key]['value']) ? $now_group['cue_arr'][$key]['value'] : '') . '"/>';
                    } else {
                        $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><textarea class="col-sm-4" rows="5" name="cue_field[value][]">' . (!empty($now_group['cue_arr'][$key]['value']) ? $now_group['cue_arr'][$key]['value'] : '') . '</textarea>';
                    }
                    $cue_html .= '</div>';
                }
            }
            $this->assign('cue_html', $cue_html);

            $mer_id = $this->merchant_session['mer_id'];
            $db_arr = array(C('DB_PREFIX') . 'area' => 'a', C('DB_PREFIX') . 'merchant_store' => 's');
            $store_list = D()->table($db_arr)->field('a.`area_name`,s.`adress`,`s`.`name`,`s`.`store_id`')->where("`s`.`mer_id`='$mer_id' AND `s`.`status`='1' AND `s`.`have_group`='1' AND `s`.`area_id`=`a`.`area_id`")->order('`sort` DESC,`store_id` ASC')->select();
            if (empty($store_list)) {
                $this->error('您暂时还没有能添加' . $this->config['group_alias_name'] . '信息的店铺！');
            }
            $this->assign('store_list', $store_list);
            $leveloff = !empty($now_group['leveloff']) ? unserialize($now_group['leveloff']) : false;

            $levelDb = M('User_level');
            $tmparr = $levelDb->where('22=22')->order('id ASC')->select();
            $levelarr = array();
            if ($tmparr && $this->config['level_onoff']) {
                foreach ($tmparr as $vv) {
                    if (!empty($leveloff) && isset($leveloff[$vv['level']])) {
                        $vv['vv'] = $leveloff[$vv['level']]['vv'];
                        $vv['type'] = $leveloff[$vv['level']]['type'];
                    } else {
                        $vv['vv'] = '';
                        $vv['type'] = '';
                    }
                    $levelarr[$vv['level']] = $vv;
                }
            }
            unset($tmparr);
            $this->assign('levelarr', $levelarr);
            $mpackageDb = M('Group_packages');
            $mpackagelist = $mpackageDb->field(true)->where(array('mer_id' => $now_group['mer_id']))->order('id DESC')->select();
            $this->assign('mpackagelist', $mpackagelist);
            $this->display();
        }
    }

    public function ajax_get_category() {
        $database_group_category = D('Group_category');
        $condition_now_group_category['cat_id'] = $_GET['cat_fid'];
        $condition_now_group_category['cat_status'] = 1;
        $now_category = $database_group_category->field('`cat_field`,`cue_field`')->where($condition_now_group_category)->find();
        if (empty($now_category)) {
            $return['error'] = 1;
            $return['msg'] = '该分类不存在！';
        } else {
            $condition_s_group_category['cat_fid'] = $_GET['cat_fid'];
            $condition_s_group_category['cat_status'] = 1;
            $s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
            if (empty($s_category_list)) {
                $return['error'] = 1;
                $return['msg'] = '该分类下没有添加子分类！请勿选择。';
            } else {
                if (!empty($now_category['cat_field'])) {
                    $cat_field = unserialize($now_category['cat_field']);
                    $custom_html = '';
                    foreach ($cat_field as $key => $value) {
                        if (empty($value['use_field'])) {
                            $custom_html .= '<div class="form-group"><label class="col-sm-1">' . $value['name'] . '：</label>';
                            if ($value['type'] == 0) {
                                $custom_html .= '<select name="custom[custom_' . $key . ']" class="col-sm-1" style="margin-right:10px;">';
                                foreach ($value['value'] as $k => $v) {
                                    $custom_html .= '<option value="' . $k . '">' . $v . '</option>';
                                }
                                $custom_html .= '</select>';
                            } else {
                                foreach ($value['value'] as $k => $v) {
                                    $custom_html .= '<label style="margin-right:30px;"><input class="ace" type="checkbox" name="custom[custom_' . $key . '][]" value="' . $k . '" id="custom_' . $key . '_' . $k . '"/><span class="lbl"><label for="custom_' . $key . '_' . $k . '">&nbsp;' . $v . '</label></span></label>';
                                }
                            }
                            $custom_html .= '</div>';
                        }
                    }
                    $return['custom_html'] = $custom_html;
                } else {
                    $return['custom_html'] = '';
                }

                if (!empty($now_category['cue_field'])) {
                    $cue_field = unserialize($now_category['cue_field']);
                    $cue_html = '';
                    foreach ($cue_field as $key => $value) {
                        $cue_html .= '<div class="form-group"><label class="col-sm-1">' . $value['name'] . '：</label>';
                        if ($value['type'] == 0) {
                            $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><input type="text" class="col-sm-4" name="cue_field[value][]"/>';
                        } else {
                            $cue_html .= '<input type="hidden" name="cue_field[key][]" value="' . $value['name'] . '"/><textarea class="col-sm-4" rows="5" name="cue_field[value][]"></textarea>';
                        }
                        $cue_html .= '</div>';
                    }
                    $return['cue_html'] = $cue_html;
                } else {
                    $return['cue_html'] = '';
                }

                $return['error'] = 0;
                $return['cat_list'] = $s_category_list;
            }
        }
        exit(json_encode($return));
    }

    public function ajax_upload_pic() {
        if ($_FILES['imgFile']['error'] != 4) {
            $img_mer_id = sprintf("%09d", $this->merchant_session['mer_id']);
            $rand_num = mt_rand(10, 99) . '/' . substr($img_mer_id, 0, 3) . '/' . substr($img_mer_id, 3, 3) . '/' . substr($img_mer_id, 6, 3);

            $upload_dir = './upload/group/' . $rand_num . '/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize = $this->config['group_pic_size'] * 1024 * 1024;
            $upload->allowExts = array('jpg', 'jpeg', 'png', 'gif');
            $upload->allowTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/gif');
            $upload->savePath = $upload_dir;
            $upload->thumb = true;
            $upload->imageClassPath = 'ORG.Util.Image';
            $upload->thumbPrefix = 'm_,s_';
            $upload->thumbMaxWidth = $this->config['group_pic_width'];
            $upload->thumbMaxHeight = $this->config['group_pic_height'];
            $upload->thumbRemoveOrigin = false;
            $upload->saveRule = 'uniqid';
            if ($upload->upload()) {
                $uploadList = $upload->getUploadFileInfo();

                $title = $rand_num . ',' . $uploadList[0]['savename'];

                $group_image_class = new group_image();
                $url = $group_image_class->get_image_by_path($title, 's');

                exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title)));
            } else {
                exit(json_encode(array('error' => 1, 'message' => $upload->getErrorMsg())));
            }
        } else {
            exit(json_encode(array('error' => 1, 'message' => '没有选择图片')));
        }
    }

    public function ajax_del_pic() {
        $group_image_class = new group_image();
        $group_image_class->del_image_by_path($_POST['path']);
    }

    public function order_list() {

        $mer_id = $this->merchant_session['mer_id'];
        $group_id = intval($_GET['group_id']);

        //团购列表
        $group_list = D('Group')->get_grouplist_by_MerchantId($mer_id);
        $this->assign('group_list', $group_list);

        //当前团购信息
        foreach ($group_list as $value) {
            if ($value['group_id'] == $group_id) {
                $now_group = $value;
                break;
            }
        }
        if (empty($now_group)) {
            $this->error('当前' . $this->config['group_alias_name'] . '不存在！');
        }
        $this->assign('now_group', $now_group);


        //订单列表
        $condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`paid`='1' AND `o`.`group_id`='$group_id' AND `o`.`mer_id`='$mer_id'";
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'group_order' => 'o', C('DB_PREFIX') . 'user' => 'u');

        $order_count = D('')->where($condition_where)->table($condition_table)->count();
        import('@.ORG.merchant_page');
        $p = new Page($order_count, 30);

        $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $this->assign('order_list', $order_list);

        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);

        $this->display();
    }

    public function order_detail() {
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->merchant_session['mer_id'], $_GET['order_id'], false);

        if (empty($now_order)) {
            exit('此订单不存在！');
        }
        if (!empty($now_order['pay_type'])) {
            $now_order['paytypestr'] = D('Pay')->get_pay_name($now_order['pay_type']);
            if (($now_order['pay_type'] == 'offline') && !empty($now_order['third_id']) && ($now_order['paid'] == 1)) {
                $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else if (($now_order['pay_type'] != 'offline') && ($now_order['paid'] == 1)) {
                $now_order['paytypestr'] .='<span style="color:green">&nbsp; 已支付</span>';
            } else {
                $now_order['paytypestr'] .='<span style="color:red">&nbsp; 未支付</span>';
            }
        } else {
            $now_order['paytypestr'] = '未知';
        }
        $this->assign('now_order', $now_order);
        if ($now_order['tuan_type'] == 2 && $now_order['paid'] == 1) {
            $express_list = D('Express')->get_express_list();
            $this->assign('express_list', $express_list);

            //得到该订单归属团购的店铺列表
            $group_store_list = D('Group_store')->get_storelist_by_groupId($now_order['group_id']);
            $this->assign('group_store_list', $group_store_list);
        }
        $this->display();
    }

    public function order_store_id() {
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->merchant_session['mer_id'], $_GET['order_id'], true, false);
        if (empty($now_order)) {
            $this->error('此订单不存在！');
        }
        if (empty($now_order['paid'])) {
            $this->error('此订单尚未支付！');
        }
        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['store_id'] = $_POST['store_id'];
        if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
            $this->success('修改成功！');
        } else {
            $this->error('修改失败！请重试。');
        }
    }

    public function group_remark() {
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($this->merchant_session['mer_id'], $_GET['order_id'], true, false);
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

    /*     * ****套餐管理页**开始****** */

    public function mpackage() {
        $mpackageDb = M('Group_packages');
        $_count = $mpackageDb->where(array('mer_id' => $this->merchant_session['mer_id']))->count();
        import('@.ORG.merchant_page');
        $p = new Page($_count, 20);
        $mpackagelist = $mpackageDb->field(true)->where(array('mer_id' => $this->merchant_session['mer_id']))->order('id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->assign('mpackagelist', $mpackagelist);
        $this->display();
    }

    public function mpackageadd() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $mpackageDb = M('Group_packages');
        if (IS_POST) {
            $_POST['title'] = trim($_POST['title']);
            if (empty($_POST['title']))
                $this->error('套餐标示名称不能为空，必须填上');
            $id = isset($_POST['idx']) ? intval($_POST['idx']) : $id;
            unset($_POST['idx']);
            $_POST['mer_id'] = $this->merchant_session['mer_id'];
            if ($id > 0) {
                $tmpid = $mpackageDb->where(array('id' => $id))->save($_POST);
                $this->success('修改成功！', U('Group/mpackage'));
                exit();
            } else {
                $tmpid = $mpackageDb->add($_POST);
                $this->success('保存成功！', U('Group/mpackage'));
                exit();
            }
            $this->error('保存失败');
            exit();
        } else {
            $mpackage = $mpackageDb->where(array('id' => $id))->find();
            $this->assign('mpackage', !empty($mpackage) ? $mpackage : array('id' => 0, 'title' => '', 'description' => ''));
            $this->display();
        }
    }

    /*     * ****套餐管理页**结束**** */
}
