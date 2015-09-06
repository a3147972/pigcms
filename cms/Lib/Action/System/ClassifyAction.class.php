<?php

/*
 * 分类信息管理
 *
 * @  Writers    LiHongShun
 * @  BuildTime  2015/03/26 
 * @  EndTime    Unknow
 */

class ClassifyAction extends BaseAction {

    public $collectUrl = 'http://o2oclassfy-server.meihua.com';

    public function index() {
        $database_Classify_category = D('Classify_category');
        $fcid = intval($_GET['fcid']);
        $pfcid = intval($_GET['pfcid']);
        $condition['fcid'] = $fcid;
        if ($pfcid > 0) {
            $condition['pfcid'] = intval($_GET['pfcid']);
        }
        $count_Classify_category = $database_Classify_category->where($condition)->count();
        import('@.ORG.system_page');
        $p = new Page($count_Classify_category, 30);
        $category_list = $database_Classify_category->field(true)->where($condition)->order('`cat_sort` DESC,`cid` ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $this->assign('category_list', $category_list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);

        if ($fcid > 0) {
            $condition_now['cid'] = $fcid;
            if ($pfcid > 0)
                $condition_now['fcid'] = $pfcid;
            $now_category = $database_Classify_category->field(true)->where($condition_now)->find();
            if (empty($now_category)) {
                $this->error_tips('没有找到该分类信息！', 3, U('Group/index'));
            }
            $this->assign('now_category', $now_category);
        }
        $this->assign('fcid', $fcid);
        $this->assign('pfcid', $pfcid);
        $this->display();
    }

    /*     * *目录添加操作页** */

    public function cat_add() {
        $fcid = intval($_GET['fcid']);
        $pfcid = intval($_GET['pfcid']);
        $this->assign('bg_color', '#F3F3F3');
        $this->assign('fcid', $fcid);
        $this->assign('pfcid', $pfcid);
        $this->display();
    }

    /*     * *保存目录** */

    public function cat_modify() {
        if (IS_POST) {
            $fcid = intval($_POST['fcid']);
            $pfcid = intval($_POST['pfcid']);
            if (($fcid > 0) && ($pfcid == 0))
                $_POST['subdir'] = 2;
            if (($fcid > 0) && ($pfcid > 0)) {
                $_POST['subdir'] = 3;
                $_POST['cat_sort'] = 0;
                $_POST['is_hot'] = 0;
                $_POST['cat_status'] = 1;
            }
            $datas = $this->Removalquotes($_POST);
            $database_Classify_category = D('Classify_category');
            $datas['addtime'] = $datas['updatetime'] = time();
            if ($database_Classify_category->data($datas)->add()) {
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！请重试~');
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    public function cat_edit() {
        $this->assign('bg_color', '#F3F3F3');

        $database_Classify_category = D('Classify_category');
        $condition_now_Classify_category['cid'] = intval($_GET['cid']);
        $now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();
        if (empty($now_category)) {
            $this->frame_error_tips('没有找到该分类信息！');
        }
        $this->assign('now_category', $now_category);
        $this->display();
    }

    public function cat_amend() {
        if (IS_POST) {
            $database_Classify_category = D('Classify_category');
            $datas = $this->Removalquotes($_POST);
            if ($database_Classify_category->data($datas)->save()) {
                $this->success('编辑成功！');
            } else {
                $this->error('编辑失败！请重试~');
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    public function cat_del() {
        if (IS_POST) {
            $database_Classify_category = D('Classify_category');
            $where['cid'] = intval($_POST['cid']);
            $now_category = $database_Classify_category->field(true)->where($where)->find();
            if ($database_Classify_category->where($where)->delete()) {
                if ($now_category['subdir'] == 1) {
                    $database_Classify_category->where(array('fcid' => $now_category['cid']))->delete();
                    $database_Classify_category->where(array('pfcid' => $now_category['cid']))->delete();
                } elseif ($now_category['subdir'] == 2) {
                    $database_Classify_category->where(array('fcid' => $now_category['cid']))->delete();
                }
                $this->success('删除成功！');
            } else {
                $this->error('删除失败！请重试~');
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    public function cat_field() {
        $database_Classify_category = D('Classify_category');
        $condition_now_Classify_category['cid'] = intval($_GET['cid']);
        $now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();
        if (empty($now_category)) {
            $this->frame_error_tips('没有找到该分类信息！');
        }
        if (!empty($now_category['cat_fid'])) {
            $this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
        }
        if (!empty($now_category['cat_field'])) {
            $now_category['cat_field'] = unserialize($now_category['cat_field']);
            foreach ($now_category['cat_field'] as $key => $value) {
                if ($value['use_field'] == 'area') {
                    $now_category['cat_field'][$key]['name'] = '区域(内置)';
                    $now_category['cat_field'][$key]['url'] = 'area';
                }
                if ($value['use_field'] == 'price') {
                    $now_category['cat_field'][$key]['name'] = '价格(内置)';
                    $now_category['cat_field'][$key]['url'] = 'area';
                }
            }
        }
        $f_category = $database_Classify_category->field(true)->where(array('cid' => $now_category['fcid']))->find();
        $f_empty_cat_field = empty($f_category) || empty($f_category['cat_field']) ? true : false;
        unset($f_category);
        $this->assign('f_empty_cat_field', $f_empty_cat_field);
        $this->assign('now_category', $now_category);
        $InputTypeArr = $this->getInputType();
        $this->assign('inputTypeArr', $InputTypeArr);
        $this->display();
    }

    /*     * **添加字段***** */

    public function cat_field_add() {
        $database_Classify_category = D('Classify_category');
        $condition_now_Classify_category['cid'] = intval($_GET['cid']);
        $now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();
        $i = 0;
        if (!empty($now_category['cat_field'])) {
            $cat_field = unserialize($now_category['cat_field']);
            foreach ($cat_field as $key => $vv) {
                if (isset($vv['isfilter']) && ($vv['isfilter'] == 1)) {
                    $i++;
                }
            }
        }
        $this->assign('isfilter', $i);
        $InputTypeArr = $this->getInputType();
        $this->assign('bg_color', '#F3F3F3');
        $this->assign('inputTypeArr', $InputTypeArr);
        $this->display();
    }

    /*     * **编辑字段***** */

    public function cat_field_edit() {
        $cid = intval($_GET['cid']);
        $key = isset($_GET['eid']) ? intval($_GET['eid']) : false;
        if (($cid > 0) && ($key !== false) && ($key >= 0)) {
            $Classify_categoryDb = D('Classify_category');
            $now_category = $Classify_categoryDb->field(true)->where(array('cid' => $cid))->find();
            if (!empty($now_category) && !empty($now_category['cat_field'])) {
                $cat_field = unserialize($now_category['cat_field']);
                $subdir = $now_category['subdir'];
                unset($now_category);
                $i = 0;
                if (!empty($cat_field)) {
                    foreach ($cat_field as $kyy => $vv) {
                        if (isset($vv['isfilter']) && ($vv['isfilter'] == 1)) {
                            $i++;
                        }
                    }
                }
                $text = '';
                $thiscat_field = isset($cat_field[$key]) ? $cat_field[$key] : array();
                if (isset($thiscat_field['filtercon']) && !empty($thiscat_field['filtercon'])) {
                    foreach ($thiscat_field['filtercon'] as $fvv) {
                        $text.=$fvv . PHP_EOL;
                    }
                }
                $optstr = '';
                if (isset($thiscat_field['opt']) && !empty($thiscat_field['opt'])) {
                    foreach ($thiscat_field['opt'] as $ovv) {
                        $optstr.=$ovv . PHP_EOL;
                    }
                }
                $this->assign('isfilter', $i);
                $this->assign('fkey', $key);
                $this->assign('optstr', rtrim($optstr));
                $this->assign('textstr', rtrim($text));
                $this->assign('thiscat_field', $thiscat_field);
                $this->assign('cid', $cid);
                $InputTypeArr = $this->getInputType();
                $this->assign('bg_color', '#F3F3F3');
                $this->assign('inputTypeArr', $InputTypeArr);
                $this->display();
            }
        }
    }

    /*     * *继承父目录字段** */

    public function fieldInherit() {
        $cid = intval($_GET['pcid']);
        $mycid = intval($_GET['cid']);
        $Classify_categoryDb = D('Classify_category');
        $pcategory = $Classify_categoryDb->field(true)->where(array('cid' => $cid))->find();
        if (($pcategory['cat_field']) && ($mycid > 0)) {
            $fg = $Classify_categoryDb->where(array('cid' => $mycid))->save(array('cat_field' => $pcategory['cat_field']));
            if ($fg) {
                $this->success('处理成功！');
                exit();
            }
        }
        $this->error('处理失败！');
    }

    private function getInputType() {
        $session_InputType = session('inputTypeInfo');
        if (false && !empty($session_InputType)) {
            $session_InputType = unserialize($session_InputType);
        } else {
            $inputtypeDb = D('Classify_inputtype');
            $session_InputType = $inputtypeDb->where('1=1')->order('id ASC')->select();
            if (!empty($session_InputType)) {
                $newarr = array();
                foreach ($session_InputType as $vv) {
                    $newarr[$vv['typ']] = $vv;
                }
                $session_InputType = $newarr;
            }
            //echo $inputtypeDb->getLastSql();
            session('inputTypeInfo', serialize($session_InputType));
        }
        return $session_InputType;
    }

    public function cat_field_modify() {
        /*         * type值：1单文本框2单选框3复选框4下拉框5多文本框****** */
        if (IS_POST) {
            $Classify_categoryDB = D('Classify_category');
            $condition_now_Classify_category['cid'] = intval($_POST['cid']);
            $fkey = isset($_POST['fkey']) ? intval($_POST['fkey']) : false;
            $now_category = $Classify_categoryDB->field(true)->where($condition_now_Classify_category)->find();
            $mc = 1;
            if (!empty($now_category['cat_field'])) {
                $cat_field = unserialize($now_category['cat_field']);
                foreach ($cat_field as $key => $value) {
                    if (($fkey === false) && ((!empty($_POST['use_field']) && $value['use_field'] == $_POST['use_field']) || (!empty($_POST['url']) && $value['url'] == trim($_POST['url'])))) {
                        $this->error('字段已经添加，请勿重复添加！');
                    }
                    if (isset($value['isfilter']) && ($value['isfilter'] == 1)) {
                        $mc++;
                    }
                }
                if ($mc > 4)
                    $mc = 0;
            }else {
                $cat_field = array();
            }
            $numfilter = intval($_POST['numfilter']);
            //if(count($cat_field) >= 5){
            //$this->error('添加字段失败，最多5个自定义字段！');
            //}
            if (empty($_POST['use_field'])) {
                $post_data['name'] = trim($_POST['name']);
                $post_data['url'] = trim($_POST['url']);
                $post_data['type'] = intval($_POST['type']);
                $post_data['isfilter'] = intval($_POST['isfilter']);
                $filtercon = trim($_POST['filtercon']);
                $post_data['iswrite'] = intval($_POST['iswrite']);
                if (($post_data['isfilter'] == 1) && !empty($filtercon)) {
                    $filtercon = $this->Removalquotes($filtercon);
                    $post_data['filtercon'] = explode(PHP_EOL, $filtercon);
                    $post_data['input'] = $mc;
                } elseif (($post_data['isfilter'] == 1) && empty($filtercon)) {
                    $this->error('作为筛选字段筛选值必须填上');
                }
                if ($post_data['type'] == 1) {
                    $post_data['inarr'] = intval($_POST['inarr']);
                    $post_data['inunit'] = trim($_POST['inunit']);
                }
                if (in_array($post_data['type'], array(2, 3, 4))) {
                    $valueoftype = trim($_POST['valueoftype']);
                    if (empty($valueoftype))
                        $this->error('供选择值框必须填上！');
                    $valueoftype = $this->Removalquotes($valueoftype);
                    $post_data['opt'] = explode(PHP_EOL, $valueoftype);
                }
                //$post_data['status'] = strval($_POST['status']);
            }else {
                $post_data['use_field'] = $_POST['use_field'];
                $post_data['isfilter'] = $numfilter > 4 || $mc == 0 ? 0 : 1;
                $post_data['type'] = 4;
                $post_data['name'] = '区域';
                $post_data['url'] = $post_data['use_field'];
                $post_data['iswrite'] = 0;
                $post_data['input'] = $mc;
                //$post_data['sort'] = strval($_POST['sort']);
                //$post_data['status'] = strval($_POST['status']);
            }

            if (($fkey !== false) && ($fkey >= 0) && isset($cat_field[$fkey])) {
                if (($post_data['isfilter'] == 1) && !empty($filtercon)) {
                    $post_data['input'] = isset($cat_field[$fkey]['input']) && ($cat_field[$fkey]['input'] > 0) ? $cat_field[$fkey]['input'] : $post_data['input'];
                }
                $cat_field[$fkey] = $post_data;
            } else {
                array_push($cat_field, $post_data);
            }
            $data_Classify_category['cat_field'] = serialize($cat_field);
            if ($Classify_categoryDB->where(array('cid' => $now_category['cid']))->data($data_Classify_category)->save()) {
                $msg = '添加字段成功！';
                if (($fkey !== false) && ($fkey >= 0))
                    $msg = '编辑字段成功！';
                $this->success($msg);
            } else {
                $msg = '添加失败！请重试~';
                if (($fkey !== false) && ($fkey >= 0))
                    $msg = '编辑失败！请重试~';
                $this->success($msg);
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    /*     * *去除单双引号*** */

    private function Removalquotes($array) {
        //$regex = "/\'|\"|\/|\\\|\<script|\<\/script/";
        $regex = "/\'|\"|\\\|\<script|\<\/script/";
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = $this->Removalquotes($value);
                } else {
                    $value = strip_tags(trim($value));
                    $array[$key] = preg_replace($regex, '', $value);
                    //$array[$key] = htmlspecialchars($value, ENT_QUOTES);
                }
            }
            return $array;
        } else {
            $array = strip_tags(trim($array));
            $array = preg_replace($regex, '', $array);
            return $array;
            //return htmlspecialchars($array, ENT_QUOTES);
        }
    }

    public function cue_field() {
        $database_Classify_category = D('Classify_category');
        $condition_now_Classify_category['cid'] = intval($_GET['cid']);
        $now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();
        if (empty($now_category)) {
            $this->frame_error_tips('没有找到该分类信息！');
        }
        if (!empty($now_category['cat_fid'])) {
            $this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
        }
        if (!empty($now_category['cue_field'])) {
            $now_category['cue_field'] = unserialize($now_category['cue_field']);
        }
        $this->assign('now_category', $now_category);

        $this->display();
    }

    public function cue_field_add() {
        $this->assign('bg_color', '#F3F3F3');

        $this->display();
    }

    public function cue_field_modify() {
        if (IS_POST) {
            $database_Classify_category = D('Classify_category');
            $condition_now_Classify_category['cid'] = intval($_POST['cid']);
            $now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

            if (!empty($now_category['cue_field'])) {
                $cue_field = unserialize($now_category['cue_field']);
                foreach ($cue_field as $key => $value) {
                    if ($value['name'] == $_POST['name']) {
                        $this->error('该填写项已经添加，请勿重复添加！');
                    }
                }
            } else {
                $cue_field = array();
            }

            $post_data['name'] = $_POST['name'];
            $post_data['type'] = $_POST['type'];
            $post_data['sort'] = strval($_POST['sort']);

            array_push($cue_field, $post_data);
            $data_Classify_category['cue_field'] = serialize($cue_field);
            $data_Classify_category['cid'] = $now_category['cid'];
            if ($database_Classify_category->data($data_Classify_category)->save()) {
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！请重试~');
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    public function cue_field_del() {
        if (IS_POST) {
            $database_Classify_category = D('Classify_category');
            $condition_now_Classify_category['cid'] = intval($_POST['cid']);
            $now_category = $database_Classify_category->field(true)->where($condition_now_Classify_category)->find();

            if (!empty($now_category['cue_field'])) {
                $cue_field = unserialize($now_category['cue_field']);
                $new_cue_field = array();
                foreach ($cue_field as $key => $value) {
                    if ($value['name'] != $_POST['name']) {
                        array_push($new_cue_field, $value);
                    }
                }
            } else {
                $this->error('此填写项不存在！');
            }
            $data_Classify_category['cue_field'] = serialize($new_cue_field);
            $data_Classify_category['cid'] = $now_category['cid'];
            if ($database_Classify_category->data($data_Classify_category)->save()) {
                $this->success('删除成功！');
            } else {
                $this->error('删除失败！请重试~');
            }
        } else {
            $this->error('非法提交,请重新提交~');
        }
    }

    /*     * ***审核列表******** */

    public function checkList() {
        $isverify = C('config.classify_verify');
        $isverify = intval($isverify);
        $userinputDb = M('Classify_userinput');
        $wherestr = 'status="0"';
        $count_userinputDb = $userinputDb->where($wherestr)->count();
        import('@.ORG.system_page');
        $p = new Page($count_userinputDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,lxname,lxtel,addtime,updatetime')->where($wherestr)->order('updatetime DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $subdir1 = $this->get_directory(1);
        $subdir2 = $this->get_directory(2);
        $ClassifyArr = array();
        if (!empty($subdir1)) {
            foreach ($subdir1 as $v1v) {
                $ClassifyArr[$v1v['cid']] = $v1v['cat_name'];
            }
        }
        $subdir2Arr = false;
        if (!empty($subdir2)) {
            foreach ($subdir2 as $v2v) {
                $ClassifyArr[$v2v['cid']] = $v2v['cat_name'];
                if ($v2v['fcid'] == $cid)
                    $subdir2Arr[] = $v2v;
            }
        }
        unset($subdir1, $subdir2);
        $this->assign('isverify', $isverify);
        $this->assign('needCheck', $tmpdatas);
        $this->assign('ClassifyArr', $ClassifyArr);
        $this->display();
    }

    /*     * ***已审核列表******** */

    public function infoList() {
        $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
        $subdir2cid = isset($_GET['subdir2']) ? intval($_GET['subdir2']) : 0;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $title = isset($_GET['title']) ? $this->Removalquotes($_GET['title']) : '';

        $userinputDb = M('Classify_userinput');
        $wherestr = 'status="1"';
        if ($id > 0) {
            $wherestr .=' AND id=' . $id;
        } elseif (($cid > 0) && ($subdir2cid == 0)) {
            $wherestr.=' AND fcid=' . $cid;
        } elseif (($cid > 0) && ($subdir2cid > 0)) {
            $wherestr.=' AND cid=' . $subdir2cid;
        } elseif (!empty($title)) {
            $wherestr.=' AND title LIKE "%' . $title . '%"';
        }
        $count_userinputDb = $userinputDb->where($wherestr)->count();
        import('@.ORG.system_page');
        $p = new Page($count_userinputDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,lxname,lxtel,addtime,updatetime,views,status,toptime,endtoptime')->where($wherestr)->order('updatetime DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        $subdir1 = $this->get_directory(1);
        $subdir2 = $this->get_directory(2);
        $ClassifyArr = array();
        if (!empty($subdir1)) {
            foreach ($subdir1 as $v1v) {
                $ClassifyArr[$v1v['cid']] = $v1v['cat_name'];
            }
        }
        $subdir2Arr = false;
        if (!empty($subdir2)) {
            foreach ($subdir2 as $v2v) {
                $ClassifyArr[$v2v['cid']] = $v2v['cat_name'];
                if ($v2v['fcid'] == $cid)
                    $subdir2Arr[] = $v2v;
            }
        }
        unset($subdir2);
        $this->assign('id', $id == 0 ? '' : $id);
        $this->assign('cid', $cid);
        $this->assign('title', $title);
        $this->assign('subdir2cid', $subdir2cid);
        $this->assign('subdir1', $subdir1);
        $this->assign('listdatas', $tmpdatas);
        $this->assign('ClassifyArr', $ClassifyArr);
        $this->assign('subdir2Arr', $subdir2Arr);
        $this->display();
    }

    /*     * ***审核列表******** */

    public function topList() {
        $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
        $subdir2cid = isset($_GET['subdir2']) ? intval($_GET['subdir2']) : 0;
        $tmpdatas = array();
        if (($cid > 0) && ($subdir2cid > 0)) {
            $userinputDb = M('Classify_userinput');
            $wherestr = 'status="1"';

            $wherestr.=' AND cid=' . $subdir2cid . ' AND fcid=' . $cid;

            $wherestr.=' AND toptime >0 ';
            $tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,lxname,lxtel,addtime,updatetime,views,status,endtoptime,topsort')->where($wherestr)->order('topsort DESC,toptime DESC')->select();
        }
        $subdir1 = $this->get_directory(1);
        $subdir2 = $this->get_directory(2);
        $ClassifyArr = array();
        if (!empty($subdir1)) {
            foreach ($subdir1 as $v1v) {
                $ClassifyArr[$v1v['cid']] = $v1v['cat_name'];
            }
        }
        $subdir2Arr = false;
        if (!empty($subdir2)) {
            foreach ($subdir2 as $v2v) {
                $ClassifyArr[$v2v['cid']] = $v2v['cat_name'];
                if ($v2v['fcid'] == $cid)
                    $subdir2Arr[] = $v2v;
            }
        }
        unset($subdir2);
        $this->assign('cid', $cid);
        $this->assign('subdir2cid', $subdir2cid);
        $this->assign('subdir1', $subdir1);
        $this->assign('listdatas', $tmpdatas);
        $this->assign('ClassifyArr', $ClassifyArr);
        $this->assign('subdir2Arr', $subdir2Arr);
        $this->display();
    }

    /*     * *排序*** */

    public function topsort() {
        $cid = intval($_POST['cid']);
        $fcid = intval($_POST['fcid']);
        if (($cid > 0) && ($fcid > 0)) {
            $ids = trim(urldecode($_POST['ids']));
            $sorts = trim(urldecode($_POST['vals']));
            $idsarr = explode(',', $ids);
            $sortsarr = explode(',', $sorts);
            if (!empty($idsarr) && is_array($idsarr) && !empty($sortsarr) && is_array($sortsarr)) {
                $userinputDb = M('Classify_userinput');
                foreach ($idsarr as $kk => $vv) {
                    $userinputDb->where(array('id' => $vv, 'cid' => $cid, 'fcid' => $fcid))->save(array('topsort' => $sortsarr[$kk]));
                }
                echo json_encode(array('error' => 0));
                exit();
            }
        }
        echo json_encode(array('error' => 1));
    }

    /*     * **属性设置*** */

    public function attrSet() {
        $currenttime = time();
        $tmp = $currenttime + 7 * 24 * 3600;
        $vid = intval($_GET['vid']);
        $tmpitem = M('Classify_userinput')->field('id,toptime,endtoptime,topsort,btcolor,jumpUrl')->where(array('id' => $vid))->find();
        $datetime = !empty($tmpitem) && $tmpitem['endtoptime'] > $currenttime ? date('Y-m-d H:i:s', $tmpitem['endtoptime']) : date('Y-m-d H:i:s', $tmp);
        $this->assign('currenttime', $currenttime);
        $this->assign('item', $tmpitem);
        $this->assign('vid', $vid);
        $this->assign('datetime', $datetime);
        $this->assign('bg_color', '#F3F3F3');
        $this->display();
    }

    public function attrSeting() {
        $vid = intval($_POST['vid']);
        $toptime = $this->Removalquotes($_POST['toptime']);
        $topsort = intval($_POST['topsort']);
        $totoptime = strtotime($toptime);
        $currenttime = time();
        $bt_color = trim($_POST['bt_color']);
        $jumpUrl = trim($_POST['jumpUrl']);
        if (!preg_match("/^https?:\/\//i", $jumpUrl))
            $jumpUrl = '';
        if (!preg_match("/rgb\([0-9]{1,3},\s*[0-9]{1,3},\s*[0-9]{1,3}\)/i", $bt_color))
            $bt_color = '';
        if (($vid > 0) && ($totoptime > $currenttime)) {
            $Classify_userinputDB = M('Classify_userinput');
            $Classify_userinputDB->where(array('id' => $vid))->save(array('toptime' => $currenttime, 'endtoptime' => $totoptime, 'topsort' => $topsort > 0 ? $topsort : 0, 'btcolor' => $bt_color, 'jumpUrl' => $jumpUrl));
            $this->success('置顶成功');
            exit();
        }
        $this->error('置顶操作失败，可能是您的设置的置顶时间小于当前时间了');
    }

    /*     * *获取目录* */

    private function get_directory($subdir, $cid = 0) {
        $Classify_categoryDb = M('Classify_category');
        $Subdirectory = array();
        $where = false;
        if ($cid > 0) {
            $where = array('fcid' => $cid, 'subdir' => 2, 'cat_status' => 1);
        } else {
            $where = array('subdir' => $subdir, 'cat_status' => 1);
        }
        if ($where) {
            $Subdirectory = $Classify_categoryDb->field('cid,fcid,subdir,cat_name')->where($where)->order('`cat_sort` DESC,`cid` ASC')->select();
        }
        return $Subdirectory;
    }

    /*     * *获取2级子目录*** */

    public function get2Subdir() {
        $cid = trim($_POST['cid']);
        $subdir2 = $this->get_directory(2, $cid);
        if (!empty($subdir2)) {
            echo json_encode($subdir2);
        } else {
            echo 0;
        }
        exit();
    }

    /*     * **审核*** */

    public function toVerify() {
        $vid = intval($_POST['vid']);
        if ($vid > 0) {
            M('Classify_userinput')->where(array('id' => $vid))->save(array('status' => 1));
            if (isset($_POST['dosubmit'])) {
                $this->success('审核成功！');
            } else {
                echo 0;
                exit;
            }
        }
        if (isset($_POST['dosubmit'])) {
            $this->error('审核失败！');
        } else {
            echo 1;
            exit;
        }
    }

    /*     * **打入未审核*** */

    public function toNoVerify() {
        $vid = intval($_POST['vid']);
        $sv = intval($_POST['sv']);
        if ($vid > 0) {
            M('Classify_userinput')->where(array('id' => $vid))->save(array('status' => 0));
            echo 0;
            exit;
        }
        echo 1;
        exit;
    }

    /*     * **删除此项*** */

    public function CancelTop() {
        $vid = intval($_POST['vid']);
        if ($vid > 0) {
            $tmp = M('Classify_userinput')->where(array('id' => $vid))->save(array('toptime' => 0, 'endtoptime' => 0, 'topsort' => 0));
            if ($tmp) {
                echo 0;
                exit;
            } else {
                echo 1;
                exit;
            }
        }
    }

    /*     * **删除此项*** */

    public function delItem() {
        $vid = intval($_POST['vid']);
        if ($vid > 0) {
            $tmp = M('Classify_userinput')->where(array('id' => $vid))->delete();
            if ($tmp) {
                echo 0;
                exit;
            } else {
                echo 1;
                exit;
            }
        }
    }

    /*     * ***审核信息详情页******** */

    public function infodetail() {
        $vid = intval($_GET['vid']);
        $vid = $vid > 0 ? $vid : 0;
        $tmpdata = M('Classify_userinput')->field(true)->where(array('id' => $vid))->find();
        $content = !empty($tmpdata['content']) ? unserialize($tmpdata['content']) : false;
        $tmpdata['updatetime'] = date('Y-m-d H:i', $tmpdata['updatetime']);
        $imgarr = !empty($tmpdata['imgs']) ? unserialize($tmpdata['imgs']) : false;
        $this->assign('imglist', $imgarr);
        $this->assign('detail', $tmpdata);
        $this->assign('content', $content);
        $this->assign('bg_color', '#F3F3F3');
        $this->assign('vid', $vid);
        $this->display();
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

    /*     * *采集处理开始     * ***采集列表******** */

    public function pickList() {
        $db_Classify_category = D('Classify_category');
        $fcid = intval($_GET['fcid']);
        $pfcid = intval($_GET['pfcid']);
        $condition['fcid'] = $fcid;
        if ($pfcid > 0) {
            $condition['pfcid'] = intval($_GET['pfcid']);
        }
        $count_Classify_category = $db_Classify_category->where($condition)->count();
        import('@.ORG.system_page');
        $p = new Page($count_Classify_category, 30);
        $category_list = $db_Classify_category->field(true)->where($condition)->order('cat_sort DESC,cid ASC')->limit($p->firstRow . ',' . $p->listRows)->select();
        if ($fcid > 0) {
            foreach ($category_list as $kk => $vv) {
                $category_list[$kk]['pickset'] = $this->getServerSetCY($vv['cid'], $vv['fcid']);
            }
        }
        $this->assign('category_list', $category_list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        if ($fcid > 0) {
            $condition_now['cid'] = $fcid;
            if ($pfcid > 0)
                $condition_now['fcid'] = $pfcid;
            $now_category = $db_Classify_category->field(true)->where($condition_now)->find();
            if (empty($now_category)) {
                $this->error_tips('没有找到该分类信息！', 3, U('Group/index'));
            }
            $this->assign('now_category', $now_category);
        }
		$allseverfields = $this->getallfields();
        $this->assign('fcid', $fcid);
        $this->assign('pfcid', $pfcid);
		$this->assign('ishavefield', !empty($allseverfields)&& is_array($allseverfields) ? true : false);
		
        $this->display();
    }

    /*     * *****获取设置的对应服务二级分类******* */

    private function getServerSetCY($cid, $fcid) {
        $tmpCY = unserialize($_SESSION['get_Server_Set_CY']);
        if (isset($tmpCY[$fcid . '_' . $cid])) {
            return $tmpCY[$fcid . '_' . $cid];
        } else {
            $tmpdata = D('Classify_pickset')->where(array('cid' => $cid, 'fcid' => $fcid, 'mapp' => ''))->find();
            !is_array($tmpCY) && $tmpCY = array();
            $tmpCY[$fcid . '_' . $cid] = $tmpdata;
            $_SESSION['get_Server_Set_CY'] = serialize($tmpCY);
            return $tmpdata;
        }
    }

    /*     * ***获取服务器端分类******** */

    private function getallfields() {
        $session_getdata = $_SESSION['CYserverFields'];
        $getdata=json_decode($session_getdata,TRUE);
		$cityId = C('config.now_city');
        if (empty($session_getdata) || empty($getdata)) {
            $serverUrl = $this->collectUrl . '/?mx=Getdata&ac=getallField';
            $getdata = $this->httpRequest($serverUrl,'POST',array('cityId'=>$cityId));
            if (!empty($getdata['1'])) {
                $_SESSION['CYserverFields'] = $getdata['1'];
            }
            $getdata = json_decode($getdata['1'], TRUE);
        }
        return $getdata['data'];
    }

    /*     * ***获取服务器端分类******** */

    private function getfieldname($mcid, $mscid = 0) {
        $fieldnametmp = '';
        $session_fieldname = unserialize($_SESSION['fieldnameByids']);
        if (!empty($session_fieldname)) {
            if (isset($session_fieldname[$mcid]) && !empty($session_fieldname[$mcid]))
                $fieldnametmp = $session_fieldname[$mcid];
            if (isset($session_fieldname[$mcid . $mscid]) && !empty($session_fieldname[$mcid . $mscid]))
                $fieldnametmp = $session_fieldname[$mcid . $mscid];
        }
        if (!empty($fieldnametmp))
            return $fieldnametmp;
        $allseverfields = $this->getallfields();

        if (!empty($allseverfields)) {
            foreach ($allseverfields as $mvv) {
                if ($mvv['mcid'] == $mcid) {
                    if ($mscid > 0) {
                        $fieldnametmp = $mvv['subcy'][$mscid]['szhname'];
                        $session_fieldname[$mcid . $mscid] = $fieldnametmp;
                    } else {
                        $fieldnametmp = $mvv['zhname'];
                        $session_fieldname[$mscid] = $fieldnametmp;
                    }
                    break;
                }
            }

            $_SESSION['fieldnameByids'] = serialize($session_fieldname);
            return $fieldnametmp;
        }
		 return false;
    }

    /*     * ***设置更新字段页面******** */

    public function updateFiield() {

        $cid = intval($_GET['cid']);
        $fcid = intval($_GET['fcid']);
		$allseverfields = $this->getallfields();
		if(empty($allseverfields)) $this->error('抱歉暂无可更新的信息！');
        $picksetDb = D('Classify_pickset');
        $picksetarr = $picksetDb->where(array('cid' => $cid, 'fcid' => $fcid, 'mapp' => ''))->find();
        if (empty($picksetarr))
            $this->error('请先去设置更新分类！');
		
        $db_Classify_category = D('Classify_category');
        if (($cid > 0) && ($fcid > 0)) {
            $pfcategory = $db_Classify_category->field('cid,fcid,subdir,cat_name,cat_url,cat_status')->where(array('cid' => $fcid))->find();
            $now_category = $db_Classify_category->field(true)->where(array('cid' => $cid, 'fcid' => $fcid))->find();
            $cat_field = !empty($now_category['cat_field']) ? unserialize($now_category['cat_field']) : array();
            $pickset = $picksetDb->field(true)->where(array('cid' => $cid, 'fcid' => $fcid, 'mcid' => $picksetarr['mcid'], 'mscid' => $picksetarr['mscid']))->select();
            $other_field['title'] = array('name' => '标题');
            $other_field['lxname'] = array('name' => '联系人名');
            $other_field['lxtel'] = array('name' => '联系人电话');
            $other_field['description'] = array('name' => '描述说明');
            $other_field['otherdesc'] = array('name' => '其他描述');
            $other_field['imgs'] = array('name' => '图片');
            $cat_field = array_merge($other_field, $cat_field);
            if (!empty($pickset)) {
                foreach ($pickset as $vv) {
                    if (empty($vv['mapp'])) {
                        continue;
                    }
                    $tmp = unserialize($vv['mapp']);
                    $tmp['id'] = $vv['id'];
                    $tmp['mcid'] = $vv['mcid'];
                    $tmp['mscid'] = $vv['mscid'];
                    $tmp['addtime'] = $vv['addtime'];
                    $tmp['mcidname'] = $this->getfieldname($vv['mcid']);
                    $tmp['mscidname'] = $this->getfieldname($vv['mcid'], $vv['mscid']);
                    $cat_field[$tmp['fieldid']]['pickset'] = $tmp;
                }
            }


            $now_category['cat_field'] = $cat_field;
            unset($pickset);
            $this->assign('picksetarr', $picksetarr);
            $this->assign('pfcategory', $pfcategory);
            $this->assign('now_category', $now_category);

            $this->display();
        }
    }

    /*     * ***设置更新字段页面******** */

    public function getServerField() {
        $param = trim($_GET['param']);
        $param = json_decode(base64_decode($param), true);
        if (!empty($param) && is_array($param)) {
            $allseverfields = $this->getallfields();
            $id = isset($param['id']) ? $param['id'] : 0;
            $pickset = D('Classify_pickset')->field(true)->where(array('id' => $id, 'cid' => $param['cid']))->find();
            if (!empty($pickset)) {
                if (!empty($pickset['mapp'])) {
                    $mapp = unserialize($pickset['mapp']);
                    $pickset['kname'] = $mapp['kname'];
                    $pickset['kvalue'] = $mapp['kvalue'];
                } else {
                    $id = 0;
                    $pickset['kname'] = '';
                    $pickset['kvalue'] = '';
                }
                unset($pickset['mapp']);
            } else {
                $pickset = array('mcid' => 0, 'mscid' => 0, 'kname' => '', 'kvalue' => '');
            }
            $this->assign('allseverfields', $allseverfields);
            $this->assign('param', $param);
            $this->assign('pickset', $pickset);
            $this->assign('id', $id);
            $this->display();
        } else {
            $this->error('参数出错！');
        }
    }

    /*     * ***获取要更新的分类的更新数量******** */

    private function getServerCount($mscid, $mcid, $last_tid, $last_time) {
        $cityId = C('config.now_city');
        $count = 0;
        if (($mscid > 0) && ($mcid > 0)) {
            $Param = array('cityId' => $cityId, 'mcid' => $mcid, 'mscid' => $mscid, 'last_tid' => intval($last_tid), 'last_time' => intval($last_time));
            $serverUrl_Count = $this->collectUrl . '/?mx=Getdata&ac=getallCount';
            $getdata = $this->httpRequest($serverUrl_Count, 'POST', $Param);
            $getdata = json_decode($getdata['1'], TRUE);
            $count = $getdata['data'];
        }
        return $count;
    }

    /*     * ***保存对相应关系设置******** */

    public function savepickset() {
        $id = intval($_POST['id']);
        $insertdata['cid'] = intval($_POST['cid']);
        $insertdata['fcid'] = intval($_POST['fcid']);
        $insertdata['mcid'] = intval($_POST['mcid']);
        $insertdata['mscid'] = intval($_POST['mscid']);
        $kname = trim($_POST['kname']);
        $insertdata['mapp'] = isset($_POST['fieldid']) && isset($_POST['kname']) && isset($_POST['kvalue']) ? serialize(array('fieldid' => $_POST['fieldid'], 'kname' => $kname, 'kvalue' => $_POST['kvalue'])) : '';
        $insertdata['addtime'] = time();
        $picksetDB = M('Classify_pickset');
        if ($id > 0) {
            if ($kname != 'o00') {
                $id = $picksetDB->where(array('id' => $id))->save($insertdata);
            } else {
                $id = $picksetDB->where(array('id' => $id))->delete();
            }
        } else {
            if ($kname != 'o00') {
                $id = $picksetDB->add($insertdata);
            } else {
                $id = 1;
            }
        }
        if ($id) {
            $this->success('设置成功！');
        } else {
            $this->error('设置失败！');
        }
    }

    /*     * ***设置更新分类目录页面******** */

    public function getServerCy() {
        $param = trim($_GET['param']);
        $param = json_decode(base64_decode($param), true);
        if (!empty($param) && is_array($param)) {
            $allseverfields = $this->getallfields();
            $id = isset($param['id']) ? $param['id'] : 0;
            $pickset = D('Classify_pickset')->field(true)->where(array('id' => $id, 'cid' => $param['cid']))->find();
            $this->assign('allseverfields', $allseverfields);
            $this->assign('param', $param);
            $this->assign('pickset', $pickset);
            $this->assign('id', $id);
            $this->display();
        }
    }

    /*     * ***保存分类目录对相应关系设置******** */

    public function savepicksetCy() {
        $oldid = intval($_POST['oldid']);
        $insertdata['cid'] = intval($_POST['cid']);
        $insertdata['fcid'] = intval($_POST['fcid']);
        $insertdata['mcid'] = intval($_POST['mcid']);
        $insertdata['mscid'] = intval($_POST['mscid']);
        $insertdata['mapp'] = isset($_POST['fieldid']) && isset($_POST['kname']) && isset($_POST['kvalue']) ? serialize(array('fieldid' => $_POST['fieldid'], 'kname' => $_POST['kname'], 'kvalue' => $_POST['kvalue'])) : '';
        $insertdata['addtime'] = time();
        $picksetDB = M('Classify_pickset');
        if ($oldid > 0) {
            $where = array('cid' => $insertdata['cid'], 'fcid' => $insertdata['fcid'], 'mcid' => $insertdata['mcid'], 'mscid' => $insertdata['mscid']);
            $pickset = $picksetDB->field(true)->where($where)->find();
            if (!empty($pickset) && ($pickset['id'] == $oldid)) {
                
            } else {
                $ptmp = $picksetDB->field(true)->where(array('id' => $oldid))->find();
                $picksetDB->where(array('cid' => $ptmp['cid'], 'fcid' => $ptmp['fcid'], 'mcid' => $ptmp['mcid'], 'mscid' => $ptmp['mscid']))->delete();
                $_SESSION['get_Server_Set_CY'] = '';
                $oldid = $picksetDB->add($insertdata);
            }
        } else {
            $oldid = $picksetDB->add($insertdata);
        }
        if ($oldid > 0) {
            $this->success('设置成功！');
        } else {
            $this->error('设置失败！');
        }
    }

    /*     * *获取子目录**subdir自身是几极目录**$m要取几级目录** */

    private function get_Subname($cid, $fcid) {

        $SubName = unserialize($_SESSION['session_SubName']);
        if (!empty($SubName) && isset($SubName[$fcid . $cid])) {
            return $SubName[$fcid . $cid];
        }
        $SubName = !empty($SubName) ? $SubName : array();

        $Classify_categoryDb = M('Classify_category');
        $subtmp = $Classify_categoryDb->field('cid,fcid,cat_name')->where(array('cid' => $cid, 'fcid' => $fcid))->find();
        if (!empty($subtmp)) {
            $SubName[$fcid . $cid] = $subtmp['cat_name'];
            $_SESSION['session_SubName'] = serialize($SubName);
            return $subtmp['cat_name'];
        }
        return false;
    }

    /*     * ***更新字段信息显示处理页面**** DISTINCT **** */

    public function updatedata() {
        $fcid = isset($_GET['fcid']) ? intval($_GET['fcid']) : 0;
        $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
        if ($fcid > 0) {
            $where = array('pks.fcid' => $fcid, 'pks.cid' => $cid);
        } else {
            $where = array('pks.fcid' => $cid);
        }
        $newdata = array();
        $picksetDB = M('Classify_pickset');
        $jointable = C('DB_PREFIX') . 'classify_pickupdate';
        $picksetDB->join('as pks LEFT JOIN ' . $jointable . ' as pku on pks.mscid=pku.mscid');
        $tmpe = $picksetDB->field('DISTINCT pks.cid,pks.fcid,pks.mcid,pks.mscid,pku.last_tid,pku.last_time,pku.total,pku.updatetime')->where($where)->select();
        if (!empty($tmpe)) {
            foreach ($tmpe as $kk => $vv) {
                $vv['subname'] = $this->get_Subname($vv['cid'], $vv['fcid']);
                $vv['needcount'] = $this->getServerCount($vv['mscid'], $vv['mcid'], $vv['last_tid'], $vv['last_time']);
                $vv['updatetimestr'] = '';
                if (!empty($vv['updatetime'])) {
                    $vv['updatetimestr'] = date('Y-m-d', $vv['updatetime']);
                }
                $tmpe[$kk] = $vv;
            }
        }

        $mainname = $this->get_Subname($fcid, 0);
        $this->assign('mainname', $mainname);
        $this->assign('listdata', $tmpe);
        $this->assign('todaystr', date('Y-m-d'));
        $this->display();
    }

    /*     * *******执行更新************ */

    public function execupdate() {
        $param = trim($_GET['param']);
        $param = json_decode(base64_decode($param), true);
        if (!empty($param) && is_array($param)) {
            $picksetDB = M('Classify_pickset');
            $subtmp = $picksetDB->where(array('fcid' => $param['fcid'], 'cid' => $param['cid'], 'mcid' => $param['mcid'], 'mscid' => $param['mscid'], 'mapp' => array('neq', '')))->find();
            if (empty($subtmp))
                $this->error('您还没有设置任何更新对应字段！');
            unset($subtmp['mapp']);
            $param = array_merge($subtmp, $param);
            unset($subtmp);
            $subtmp = M('Classify_pickupdate')->where(array('mcid' => $param['mcid'], 'mscid' => $param['mscid']))->find();
            if (!empty($subtmp)) {
                if (!empty($subtmp['updatetime'])) {
                    $updatetime = date('Y-m-d', $subtmp['updatetime']);
                    $today = date('Y-m-d');
                    if ($updatetime == $today) {
                        $this->error('您今天已经更新过了，已经更新了' . $subtmp['total'] . '条！');
                    }
                }
                $param = array_merge($subtmp, $param);
            } else {
                $param['last_tid'] = 0;
                $param['last_time'] = 0;
            }

            $subdir3 = M('Classify_category')->field('cid,fcid,pfcid,subdir,cat_name')->where(array('fcid' => $param['cid'], 'pfcid' => $param['fcid'], 'subdir' => 3))->order('`cat_sort` DESC,`cid` ASC')->select();
            $b64param = base64_encode(json_encode(array('cid' => $param['cid'], 'fcid' => $param['fcid'], 'mcid' => $param['mcid'], 'mscid' => $param['mscid'])));
            $mainname = $this->get_Subname($param['fcid'], 0);
            $subname = $this->get_Subname($param['cid'], $param['fcid']);
            $this->assign('mainname', $mainname);
            $this->assign('subname', $subname);
            $this->assign('subdir3', $subdir3);
            $this->assign('param', $param);
            $this->assign('b64param', $b64param);
        }
        $this->display();
    }

    /*     * *******执行更新************ */

    public function execupdateing() {
        $sub3 = intval($_POST['sub3']);
        $param = trim($_POST['pm']);
        $param = json_decode(base64_decode($param), true);
        if (!empty($param) && is_array($param)) {
            $pickupdateDb = M('Classify_pickupdate');
            $subtmp = $pickupdateDb->where(array('mcid' => $param['mcid'], 'mscid' => $param['mscid']))->find();
            if (!empty($subtmp)) {
                $param['last_tid'] = $subtmp['last_tid'];
                $param['last_time'] = $subtmp['last_time'];
            } else {
                $param['last_tid'] = 0;
                $param['last_time'] = 0;
            }
            $tmpe = $this->getServerdatas($param);
            if ($tmpe && isset($tmpe['data']) && !empty($tmpe['data'])) {
                $ServerData = array();
                foreach ($tmpe['data'] as $dvv) {
                    $fieldtext = !empty($dvv['fieldtext']) ? unserialize($dvv['fieldtext']) : array();
                    unset($dvv['fieldtext']);
                    $ServerData[] = array_merge($fieldtext, $dvv);
                }
                $isverify = C('config.classify_verify');
                $isverify = intval($isverify); /*                 * *控制是否需要审核** */
                $userinputDb = M('Classify_userinput');

                $now_category = D('Classify_category')->field(true)->where(array('cid' => $param['cid'], 'fcid' => $param['fcid']))->find();
                $cat_field = !empty($now_category['cat_field']) ? unserialize($now_category['cat_field']) : array();
                $other_field['title'] = array('name' => '标题');
                $other_field['lxname'] = array('name' => '联系人名');
                $other_field['lxtel'] = array('name' => '联系人电话');
                $other_field['description'] = array('name' => '描述说明');
                $other_field['otherdesc'] = array('name' => '其他描述');
                $other_field['imgs'] = array('name' => '图片');
                $cat_field = array_merge($other_field, $cat_field);
                $pickset = M('Classify_pickset')->where(array('cid' => $param['cid'], 'fcid' => $param['fcid'], 'mcid' => $param['mcid'], 'mscid' => $param['mscid']))->select();
                $tmpset = array();
                foreach ($pickset as $vv) {
                    if (!empty($vv['mapp'])) {
                        $tmpset[] = unserialize($vv['mapp']);
                    }
                }
                $fieldset = array();
                foreach ($tmpset as $skk => $svv) {
                    /* $cat_field[$svv['fieldid']]['fieldid']=$svv['fieldid'];
                      $cat_field[$svv['fieldid']]['kname']=$svv['kname'];
                      $cat_field[$svv['fieldid']]['kvalue']=$svv['kvalue'];
                      unset($cat_field[$svv['fieldid']]['filtercon'],$cat_field[$svv['fieldid']]['opt']); */
                    if ($svv['kname'] == 'o00') {
                        $fieldset[$svv['fieldid']] = $cat_field[$svv['fieldid']];
                    } else {
                        $fieldset[$svv['fieldid']] = array_merge($cat_field[$svv['fieldid']], $svv);
                    }
                }
                $cj = 0;
                foreach ($ServerData as $sdvv) {
                    $insert_data = array();
                    $inputfield = array();
                    $contentarr = $expand = array();
                    $insert_data['uid'] = 0;
                    $insert_data['cid'] = $param['cid'];
                    $insert_data['fcid'] = $param['fcid'];
                    $insert_data['sub3dir'] = $sub3;

                    $insert_data['title'] = isset($fieldset['title']['kname']) ? $sdvv[$fieldset['title']['kname']] : '';
                    $insert_data['lxname'] = isset($fieldset['lxname']['kname']) ? $sdvv[$fieldset['lxname']['kname']] : '';
                    $insert_data['lxtel'] = isset($fieldset['lxtel']['kname']) ? $sdvv[$fieldset['lxtel']['kname']] : '';
                    $insert_data['description'] = isset($fieldset['description']['kname']) ? $sdvv[$fieldset['description']['kname']] : '';
                    $insert_data['otherdesc'] = isset($fieldset['otherdesc']['kname']) ? $sdvv[$fieldset['otherdesc']['kname']] : '';
                    $insert_data['imgs'] = isset($fieldset['imgs']['kname']) ? $sdvv[$fieldset['imgs']['kname']] : '';
                    if (strpos($insert_data['lxtel'], 'upload/telimages') !== false) {
                        $imgsrc = dirname($insert_data['lxtel']);
                        if (!is_dir('.' . $imgsrc)) {
                            mkdir('.' . $imgsrc, 0777, true);
                        }
                        $telimgarr = $this->httpRequest($this->collectUrl . $insert_data['lxtel'], 'GET');
                        if (empty($telimgarr['1'])) {
                            $telimgarr = $this->httpRequest($this->collectUrl . $insert_data['lxtel'], 'GET');
                        }
                        file_put_contents('.' . $insert_data['lxtel'], $telimgarr['1']);
                    }
                    if (!empty($insert_data['imgs'])) {
                        $imgs = unserialize($insert_data['imgs']);
                        foreach ($imgs as $imgv) {
                            $imgvsrc = dirname($imgv);
                            if (!is_dir('.' . $imgvsrc)) {
                                mkdir('.' . $imgvsrc, 0777, true);
                            }
                            $imgarr = $this->httpRequest($this->collectUrl . $imgv, 'GET');
                            if (empty($imgarr['1'])) {
                                $imgarr = $this->httpRequest($this->collectUrl . $imgv, 'GET');
                            }
                            file_put_contents('.' . $imgv, $imgarr['1']);
                        }
                    }
                    /* unset($fieldset['title'], $fieldset['lxname'], $fieldset['lxtel'], $fieldset['description'], $fieldset['otherdesc'], $fieldset['imgs']); */
                    $money = isset($sdvv['price']) ? $sdvv['price'] : (isset($sdvv['salary']) ? $sdvv['salary'] : '');
                    if (!empty($money)) {
                        $moneyarr = explode('_', $money);
                        if (isset($sdvv['price'])) {
                            $sdvv['price'] = $moneyarr[0];
                            $sdvv['price_unit'] = $moneyarr[1];
                        }
                        if (isset($sdvv['salary'])) {
                            $sdvv['salary'] = $moneyarr[0];
                            $sdvv['salary_unit'] = $moneyarr[1];
                        }
                    }

                    foreach ($fieldset as $fkk => $fvv) {
                        if (is_numeric($fkk) && isset($fvv['kname'])) {
                            if (isset($fvv['input']) && ($fvv['input'] > 0) && ($fvv['input'] < 5)) {
                                $inputfield['input' . $fvv['input']] = $sdvv[$fvv['kname']];
                                if (isset($sdvv[$fvv['kname'] . "_unit"]) && !empty($sdvv[$fvv['kname'] . "_unit"])) {
                                    $expand['input' . $fvv['input']] = array('unit' => $sdvv[$fvv['kname'] . "_unit"]);
                                }
                            }
                            $contenttmp = array('tn' => $fvv['name'], 'vv' => $sdvv[$fvv['kname']]);
                            $contenttmp['unit'] = isset($sdvv[$fvv['kname'] . "_unit"]) ? $sdvv[$fvv['kname'] . "_unit"] : '';
                            $contenttmp['inarr'] = is_numeric($sdvv[$fvv['kname']]) ? 1 : 0;
                            $contenttmp['input'] = isset($fvv['input']) ? $fvv['input'] : '';
                            $contenttmp['iswrite'] = isset($fvv['iswrite']) ? $fvv['iswrite'] : 0;
                            $contenttmp['isfilter'] = isset($fvv['isfilter']) ? $fvv['isfilter'] : 0;
                            $contenttmp['type'] = isset($fvv['type']) ? $fvv['type'] : 0;
                            $contentarr[] = $contenttmp;
                        }
                    }
                    if (!empty($inputfield))
                        $insert_data = array_merge($insert_data, $inputfield);
                    $insert_data['content'] = !empty($contentarr) ? serialize($contentarr) : '';
                    $insert_data['addtime'] = $sdvv['fabutime'];
                    $insert_data['updatetime'] = time();
                    $insert_data['expand'] = !empty($expand) ? serialize($expand) : '';
                    $insert_data['status'] = 1;
                    $insert_data['isgxid'] = $sdvv['id'];
                    $insert_id = $userinputDb->add($insert_data);
                    if ($insert_id > 0) {
                        $cj++;
                    }
                    sleep(0.5);
                }

                $pickupdate = array('cid' => $param['cid'], 'fcid' => $param['fcid'], 'mcid' => $param['mcid'], 'mscid' => $param['mscid'], 'last_tid' => $sdvv['id'], 'last_time' => $sdvv['addtime'], 'total' => $cj, 'updatetime' => time());
                if (!empty($subtmp)) {
                    $pickupdateDb->where(array('id' => $subtmp['id']))->save($pickupdate);
                } else {
                    $pickupdateDb->add($pickupdate);
                }
                $this->dexit(array('error' => 0, 'cj' => $cj));
            }
        }
        $this->dexit(array('error' => 0, 'cj' => 0));
    }

    /*     * ***获取服务器端数据******** */

    private function getServerdatas($wdata) {
        if (!empty($wdata)) {
			$cityId = C('config.now_city');
			$wdata['cityId']=$cityId;
            $serverUrl = $this->collectUrl . '/?mx=Getdata&ac=getdatas';
            $getdatas = $this->httpRequest($serverUrl, 'POST', $wdata);
            if (!empty($getdatas['1'])) {
                return json_decode($getdatas['1'], TRUE);
            }
        }
        return false;
    }

    /*     * ******采集处理结束************ */
}
