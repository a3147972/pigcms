<?php
/*
 * 分类信息管理
 *
 */
class ClassifyAction extends BaseAction {

    private $uid = 0;

    protected function _initialize() {
        parent::_initialize();
        $areaid = C('config.now_city');
        $Nowarea = $_SESSION['myArea' . $areaid];
        if (empty($Nowarea)) {
            $Nowarea = D('Area')->get_area_by_areaId($areaid);
            $_SESSION['myArea' . $areaid] = serialize($Nowarea);
        } else {
            $Nowarea = unserialize($Nowarea);
        }
        //导航条
        $wap_classifyslider = D('Slider')->get_slider_by_key('wap_classify', 4);
        $this->assign('classifyslider', $wap_classifyslider);
        //print_r($wap_classifyslider);
        $uid = !empty($this->user_session) ? $this->user_session['uid'] : 0;
        $this->uid = $uid > 0 ? $uid : 0;
        $this->assign('uid', $uid);
        $this->assign('Nowarea', $Nowarea);
    }

    public function index() {
        $database_Classify_category = D('Classify_category');
        $Zcategorys = $database_Classify_category->field(true)->where(array('subdir' => 1, 'cat_status' => 1))->order('`cat_sort` DESC,`cid` ASC')->select();
        if (!empty($Zcategorys)) {
            $newtmp = array();
            foreach ($Zcategorys as $vv) {
                unset($vv['cat_field']);
                $subdir_info = $this->get_Subdirectory($vv['cid'], 1);
                if (!empty($subdir_info)) {
                    $vv['subdir'] = $subdir_info;
                    $newtmp[$vv['cid']] = $vv;
                }
            }
            $Zcategorys = $newtmp;
        }
        //分类信息首页
        $classify_index_ad = D('Adver')->get_adver_by_key('classify_index_ad', 3);
        $this->assign('classify_index_ad', $classify_index_ad);
        $this->assign('Zcategorys', $Zcategorys);
        $this->display();
    }

    /*     * *个人中心** */
    public function myCenter() {
        $now_user = D('User')->get_user($this->uid);
        if (!empty($now_user)) {
            $now_user['now_money'] = floatval($now_user['now_money']);
        }
        $this->assign('now_user', $now_user);
        $this->display();
    }

    /*     * *我的发布** */

    public function myfabu() {
        if (!($this->uid > 0)) {
            $this->error_tips('请先进行登录！', U('Login/index'));
            exit();
        }
        $wherestr = 'uid=' . $this->uid;
        $userinputDb = M('Classify_userinput');
        $count_userinputDb = $userinputDb->where($wherestr)->count();
        import('@.ORG.system_page');
        $p = new Page($count_userinputDb, 20);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,imgs,input1,input2,input3,input4,expand,updatetime,status')->where($wherestr)->order('updatetime DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        //echo $userinputDb->getLastSql();
        $today = strtotime(date('Y-m-d') . " 00:00:00"); //今天
        $yesterday = $today - 86400; //昨天
        if (!empty($tmpdatas)) {
            foreach ($tmpdatas as $kk => $vv) {
                if (!empty($vv['expand'])) {
                    $expand = unserialize($vv['expand']);
                    foreach ($expand as $ek => $ev) {
                        if (empty($vv[$ek]) && isset($ev['inarr']) && ($ev['inarr'] == 1)) {
                            $vv[$ek] = '面议';
                        } else {
                            $vv[$ek] = $vv[$ek] . '&nbsp;' . $ev['unit'];
                        }
                    }
                }
                if ($vv['updatetime'] > $today) {
                    $vv['timestr'] = "今天 " . date('H:i', $vv['updatetime']);
                } elseif ($vv['updatetime'] > $yesterday) {
                    $vv['timestr'] = "昨天 " . date('H:i', $vv['updatetime']);
                } else {
                    $vv['timestr'] = date('Y-m-d H:i', $vv['updatetime']);
                }
                if (!empty($vv['imgs'])) {
                    $vv['imgs'] = unserialize($vv['imgs']);
                    $vv['imgthumbnail'] = !strpos($vv['imgs']['0'],'ttp:') ? $this->config['site_url'].$vv['imgs']['0'] :$vv['imgs']['0'];
                }
                $tmpdatas[$kk] = $vv;
            }
        }
        $now_user = D('User')->get_user($this->uid);
        if (!empty($now_user)) {
            $now_user['now_money'] = floatval($now_user['now_money']);
        }
        $this->assign('now_user', $now_user);
        $this->assign('listsdatas', $tmpdatas);
        $this->display();
    }

    public function delItem() {
        $vid = intval($_POST['vid']);
        if (($vid > 0) && ($this->uid > 0)) {
            $flag = M('Classify_userinput')->where(array('id' => $vid, 'uid' => $this->uid))->delete();
            if ($flag)
                $this->dexit(array('error' => 0, 'msg' => 'OK'));
        }
        $this->dexit(array('error' => 1, 'msg' => ''));
    }

    public function myCollect() {
        $o2oFavorite = $_COOKIE['o2oFavoriteThis'];
        $o2oFavoriteArr = !empty($o2oFavorite) ? explode('-', urldecode($o2oFavorite)) : array();
        $usercollectDb = M('Classify_usercollect');
        if ($this->uid > 0) {
            $tmp = $usercollectDb->where(array('uid' => $this->uid))->select();
            if ($tmp) {
                foreach ($tmp as $vv) {
                    $o2oFavoriteArr[] = $vv['vid'];
                }
            }
        }
        $o2oFavoriteArr = array_unique($o2oFavoriteArr);
        if (!empty($o2oFavoriteArr)) {
            $wherestr = 'id in(' . implode(',', $o2oFavoriteArr) . ')';
            $userinputDb = M('Classify_userinput');
            $count_userinputDb = $userinputDb->where($wherestr)->count();
            import('@.ORG.system_page');
            $p = new Page($count_userinputDb, 50);
            $pagebar = $p->show();
            $this->assign('pagebar', $pagebar);
            $tmpdatas = $userinputDb->field('id,uid,cid,fcid,sub3dir,title,imgs,input1,input2,input3,input4,expand,updatetime,status')->where($wherestr)->order('updatetime DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
            //echo $userinputDb->getLastSql();
            $today = strtotime(date('Y-m-d') . " 00:00:00"); //今天
            $yesterday = $today - 86400; //昨天
            if (!empty($tmpdatas)) {
                foreach ($tmpdatas as $kk => $vv) {
                    if (!empty($vv['expand'])) {
                        $expand = unserialize($vv['expand']);
                        foreach ($expand as $ek => $ev) {
                            if (empty($vv[$ek]) && isset($ev['inarr']) && ($ev['inarr'] == 1)) {
                                $vv[$ek] = '面议';
                            } else {
                                $vv[$ek] = $vv[$ek] . '&nbsp;' . $ev['unit'];
                            }
                        }
                    }
                    if ($vv['updatetime'] > $today) {
                        $vv['timestr'] = "今天 " . date('H:i', $vv['updatetime']);
                    } elseif ($vv['updatetime'] > $yesterday) {
                        $vv['timestr'] = "昨天 " . date('H:i', $vv['updatetime']);
                    } else {
                        $vv['timestr'] = date('Y-m-d H:i', $vv['updatetime']);
                    }
                    if (!empty($vv['imgs'])) {
                        $vv['imgs'] = unserialize($vv['imgs']);
                        $vv['imgthumbnail'] = !strpos($vv['imgs']['0'],'ttp:') ? $this->config['site_url'].$vv['imgs']['0'] :$vv['imgs']['0'];
                    }
                    $tmpdatas[$kk] = $vv;
                }
                $this->assign('listsdatas', $tmpdatas);
            }
        }
        $now_user = D('User')->get_user($this->uid);
        if (!empty($now_user)) {
            $now_user['now_money'] = floatval($now_user['now_money']);
        }
        $this->assign('now_user', $now_user);
        $this->display();
    }
    public function emptyC() {
        if ($this->uid > 0) {
            $flag = M('Classify_usercollect')->where(array('uid' => $this->uid))->delete();
            $this->dexit(array('error' => 1, 'msg' => $flag));
        }
        $this->dexit(array('error' => 1, 'msg' => 0));
    }
    public function collectOpt() {
        $vid = intval($_POST['vid']);
        if (($this->uid > 0) && ($vid > 0)) {
            $usercollectDb = M('Classify_usercollect');
            $tmp = $usercollectDb->where(array('uid' => $this->uid, 'vid' => $vid))->find();
            if (empty($tmp)) {
                $flag = $usercollectDb->add(array('uid' => $this->uid, 'vid' => $vid, 'addtime' => time()));
                if ($flag)
                    $this->dexit(array('error' => 0, 'msg' => $flag));
            }
            unset($tmp);
        }
        $this->dexit(array('error' => 1, 'msg' => 0));
    }

    private function get_Subdirectory($cid, $subdir, $m = 2) {
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
            $Subdirectory = $Classify_categoryDb->field(true)->where($where)->order('`cat_sort` DESC,`cid` ASC')->select();
        }
        return $Subdirectory;
    }

    /*     * **子目录列表*** */

    public function Subdirectory() {
        $cid = intval($_GET['cid']);
        $ctname = trim($_GET['ctname']);
        if ($cid > 0) {
            $Subdirectory2 = $this->get_Subdirectory($cid, 1);
            $newtmp = array();
            foreach ($Subdirectory2 as $vv) {
                unset($vv['cat_field']);
                $vv['subdir'] = $this->get_Subdirectory($vv['cid'], 2, 3);
                $newtmp[$vv['cid']] = $vv;
            }
            $Subdirectory2 = $newtmp;
            $this->assign('Subdirectory2', $Subdirectory2);
            $fcategory = $this->getTishFcid($cid);
            $ctname = !empty($fcategory) ? $fcategory['cat_name'] : $ctname;
            $this->assign('ctname', $ctname);
        } else {
            $this->redirect(U('Classify/index'));
            exit();
        }
        $this->display();
    }

    /**     * */
    private function getTishFcid($cid, $cache = true) {
        $tmpdata = $_SESSION["session_FcidInfo{$cid}"];
        $tmpdata = !empty($tmpdata) ? unserialize($tmpdata) : false;
        if ($cache && !empty($tmpdata)) {
            return $tmpdata;
        } else {
            $tmpdata = M('classify_category')->field('cid,fcid,pfcid,subdir,cat_name')->where(array('cid' => $cid))->find();
            if ($cache) {
                $_SESSION["session_FcidInfo{$cid}"] = !empty($tmpdata) ? serialize($tmpdata) : '';
            } else {
                $_SESSION["session_FcidInfo{$cid}"] = '';
            }
            return $tmpdata;
        }
    }

    private function getTishFcategory($cid, $cache = true) {
        $tmpdata = $_SESSION["session_Fcategory{$cid}"];
        $tmpdata = !empty($tmpdata) ? unserialize($tmpdata) : false;
        if ($cache && !empty($tmpdata)) {
            return $tmpdata;
        } else {
            $classify_categoryDb = M('classify_category');
            $tmp = $classify_categoryDb->field('cid,fcid,subdir')->where(array('cid' => $cid, 'subdir' => 2))->find();
            if (!empty($tmp)) {
                $tmpdata = $classify_categoryDb->field('cid,fcid,pfcid,subdir,cat_name')->where(array('fcid' => $tmp['fcid'], 'subdir' => 2))->order('`cat_sort` DESC,`cid` ASC')->select();
                foreach ($tmpdata as $kk => $vv) {
                    if ($cid == $vv['cid']) {
                        $tmpdata[$kk]['subdir3'] = $this->get_Subdirectory($cid, 2, 3);
                    }
                }
            }
            return $tmpdata;
        }
    }

    /*     * **列表页*** */

    public function Lists() {
        $cid = intval($_GET['cid']);
        $sub3dir = isset($_GET['sub3dir']) ? intval($_GET['sub3dir']) : 0;
        $opt = isset($_GET['opt']) ? trim($_GET['opt']) : '';
        if ($cid > 0) {
            $userinputDb = M('Classify_userinput');
            $where = $this->analyse_param($opt);
            $original = !empty($where) ? $where['original'] : '';
            $c_input = !empty($where) ? $where['fd'] : '';
            $wherestr = $sub3dir > 0 ? 'cid=' . $cid . ' AND sub3dir=' . $sub3dir . " AND status=1" : 'cid=' . $cid . " AND status=1";
            if (!empty($where)) {
                if ($where['ty'] == 1) {
                    $tmp = explode('-', $where['vv']);
                    if ($tmp['0'] == 0) {
                        $wherestr.=' AND ' . $where['fd'] . '>=0 AND ' . $where['fd'] . '<=' . $tmp['1'];
                    } elseif ($tmp['1'] == 0) {
                        $wherestr.=' AND ' . $where['fd'] . '>=' . $tmp['0'];
                    } else {
                        $wherestr.=' AND ' . $where['fd'] . '<=' . $tmp['0'] . " AND " . $where['fd'] . '>=' . $tmp['0'];
                    }
                } else {
                    $wherestr.=' AND ' . $where['fd'] . ' LIKE "%' . $where['vv'] . '%"';
                }
            }
            $count_userinputDb = $userinputDb->where($wherestr)->count();
            import('@.ORG.common_page');
            $p = new Page($count_userinputDb, 20);
            $pagebar = $p->show(2);
            $this->assign('pagebar', urldecode($pagebar));
			 /*             * *置顶更新处理** */
            $toparr = $userinputDb->field('id,cid,updatetime,toptime,endtoptime,topsort')->where('cid=' . $cid . ' AND status=1 AND toptime >0')->select();
            if (!empty($toparr)) {
                $currenttime = time();
                foreach ($toparr as $tvv) {
                    if ($tvv['endtoptime'] < $currenttime) {
                        $userinputDb->where(array('id' => $tvv['id']))->save(array('toptime' => 0, 'topsort' => 0));
                    }
                }
            }
            /*             * *置顶更新处理结束** */
            $tmpdatas = $userinputDb->field(true)->where($wherestr)->order('topsort DESC,toptime DESC,updatetime DESC,id DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
            $today = strtotime(date('Y-m-d') . " 00:00:00"); //今天
            $yesterday = $today - 86400; //昨天
            if (!empty($tmpdatas)) {
                foreach ($tmpdatas as $kk => $vv) {
                    if (!empty($vv['expand'])) {
                        $expand = unserialize($vv['expand']);
                        foreach ($expand as $ek => $ev) {
                            if (empty($vv[$ek]) && isset($ev['inarr']) && ($ev['inarr'] == 1)) {
                                $vv[$ek] = '面议';
                            } else {
                                $vv[$ek] = $vv[$ek] . '&nbsp;' . $ev['unit'];
                            }
                        }
                    }
                    if ($vv['updatetime'] > $today) {
                        $vv['timestr'] = "今天 " . date('H:i', $vv['updatetime']);
                    } elseif ($vv['updatetime'] > $yesterday) {
                        $vv['timestr'] = "昨天 " . date('H:i', $vv['updatetime']);
                    } else {
                        $vv['timestr'] = date('Y-m-d H:i', $vv['updatetime']);
                    }
                    if (!empty($vv['imgs'])) {
                        $vv['imgs'] = unserialize($vv['imgs']);
                        $vv['imgthumbnail'] = !strpos($vv['imgs']['0'],'ttp:') ? $this->config['site_url'].$vv['imgs']['0'] :$vv['imgs']['0'];
                    }
					unset($vv['content'],$vv['description']);
                    $tmpdatas[$kk] = $vv;
                }
            }

            $tmpcid = $this->getTishFcid($cid);
            $where_arr = $tmpcid['fcid'] > 0 ? array('cid' => $cid, 'fcid' => $tmpcid['fcid']) : array('cid' => $cid);
            $category = D('Classify_category');
            $cat_field = $category->field('cid,fcid,pfcid,subdir,cat_field')->where($where_arr)->find();
            //echo $category->getLastSql();
            $conarr = array();
            if ($cat_field['cat_field']) {
                $cat_field = unserialize($cat_field['cat_field']);
                foreach ($cat_field as $cv) {
                    if (($cv['isfilter'] == 1) && ($cv['input'] > 0)) {
                        if (($cv['type'] == 1) && ($cv['inarr'] == 1)) {
                            $conarr[] = array('opt' => 1, 'name' => $cv['name'], 'input' => 'input' . $cv['input'], 'data' => $cv['filtercon']);
                        } else {
                            if (isset($cv['use_field']) && ($cv['use_field'] == 'area')) {
                                $get_area_list = D('Area')->get_area_list();
                                $new_areas = array();
                                if ($get_area_list) {
                                    foreach ($get_area_list as $vv) {
                                        $new_areas[$vv['area_id']] = $vv['area_name'];
                                    }
                                }
                                $cv['filtercon'] = $new_areas;
                            }
                            $conarr[] = array('opt' => 0, 'name' => $cv['name'], 'input' => 'input' . $cv['input'], 'data' => $cv['filtercon']);
                        }
                    }
                }
            }
			
            if (!empty($conarr) && count($conarr) < 4) {
                $categorys = $this->getTishFcategory($cid);
                $this->assign('categorys', $categorys);
                //print_r($categorys);
            }
            $fcid = $tmpcid['fcid'] > 0 ? $tmpcid['fcid'] : $cat_field['fcid'];
            $url = '/wap.php?g=Wap&c=Classify&a=Lists&cid=' . $cid;
            $this->assign('conarr', $conarr);
            $this->assign('qsearch', $opt);
            $this->assign('thisurl', $url);
            $this->assign('cid', $cid);
            $this->assign('cat_name', $tmpcid['cat_name']);
            $this->assign('fcid', $fcid);
            $this->assign('original', $original);
            $this->assign('c_input', $c_input);
            $this->assign('listsdatas', $tmpdatas);
            $this->display();
        } else {
            $this->redirect(U('Classify/index'));
            exit();
        }
    }

    /*     * **展示页面*** */

    public function ShowDetail() {
        $vid = intval($_GET['vid']);
        $vid = $vid > 0 ? $vid : 0;
        $content = false;
        if ($vid > 0) {
            $tmpdata = M('Classify_userinput')->field(true)->where(array('id' => $vid, 'status' => 1))->find();
            if (!empty($tmpdata)) {
                $content = !empty($tmpdata['content']) ? unserialize($tmpdata['content']) : false;
                $imgarr = !empty($tmpdata['imgs']) ? unserialize($tmpdata['imgs']) : false;
                $tmpdata['updatetime'] = date('Y-m-d H:i', $tmpdata['updatetime']);
                $category = D('Classify_category');
                $mycategory = $category->field('cid,fcid,pfcid,subdir,cat_name')->where(array('cid' => $tmpdata['cid']))->find();
                $tmpdata['cat_name'] = $mycategory['cat_name'];
                unset($f_category, $mycategory);
                $tmpdata['s_c'] = array();
                if ($tmpdata['sub3dir'] > 0) {
                    $tmpdata['s_c'] = $category->field('cid,fcid,pfcid,subdir,cat_name')->where(array('cid' => $tmpdata['sub3dir']))->find();
                }
                $tmpdata['description'] = htmlspecialchars_decode($tmpdata['description'], ENT_QUOTES);
				$tmpdata['otherdesc'] = !empty($tmpdata['otherdesc']) ? htmlspecialchars_decode($tmpdata['otherdesc'], ENT_QUOTES) :'';
                $this->assign('detail', $tmpdata);
                $this->assign('content', $content);
                $this->assign('imglist', $imgarr);
                $this->assign('vid', $vid);
                $this->assign('client_ip', get_client_ip());
                $this->display();
                exit();
            }
        }
        $this->redirect(U('Classify/index'));
        exit();
    }

    /*     * **更新浏览量*** */

    public function addviews() {
        $vid = intval($_POST['vid']);
        if ($vid > 0) {
            M('Classify_userinput')->where(array('id' => $vid))->setInc('views', 1);
            echo 0;
            exit;
        }
        echo 1;
        exit;
    }

    /**
     * **统一参数解析
     * **
     * ***** */
    private function analyse_param($str) {
        if (empty($str))
            return false;
        $s_str = base64_decode(str_replace(" ", "+", $str));

        if (!$s_str || (strpos($s_str, ',ty=') === false) || (strpos($s_str, ',fd=') === false) || (strpos($s_str, ',vv=') === false))
            return false;
        $s_arr = explode(',', $s_str);
        if (count($s_arr) != 4)
            return false;
        $tmpdata = array('ty' => '', 'fd' => '', 'vv' => '', 'original' => '');
        $tmp = explode('=', $s_arr['1']);
        $tmpdata['ty'] = intval($tmp['1']); //是否需要解析vv字符串
        $tmp = explode('=', $s_arr['2']); //是否需要解析vv字符串
        $tmpdata['fd'] = trim($tmp['1']); //字段名字 input1、input2....
        $tmp = explode('=', $s_arr['3']); //是否需要解析vv字符串
        $tmpdata['original'] = $tmpdata['vv'] = trim($tmp['1']); //条件值
        if ($tmpdata['ty'] == 1) {
            /* preg_match_all('/([0-9]*-?[0-9]*)/',$tmpdata['vv'],$matches);
              $tmpdata['vv']=$matches[1][0]; */
            $tmpdata['vv'] = preg_replace('/[^0-9\-]*/', '', $tmpdata['vv']); /*             * 过滤掉不需要的字符* */
        }
        return $tmpdata;
    }

    /*     * **发表信息目录选择页面*** */

    public function SelectSub() {
        $cid = intval($_GET['cid']);
        $database_Classify_category = D('Classify_category');
        $Zcategorys = $database_Classify_category->field(true)->where(array('subdir' => 1))->order('`cat_sort` DESC,`cid` ASC')->select();
        if (!empty($Zcategorys)) {
            $newtmp = array();
            foreach ($Zcategorys as $vv) {
                unset($vv['cat_field']);
                $subdir_info = $this->get_Subdirectory($vv['cid'], $vv['subdir']);
                if (!empty($subdir_info)) {
                    $vv['subdir'] = $subdir_info;
                    $newtmp[$vv['cid']] = $vv;
                }
            }
            $Zcategorys = $newtmp;
        }
        //print_r($Zcategorys);
        $this->assign('Zcategorys', $Zcategorys);
        $this->assign('cid', $cid);
        $this->display();
    }

    /*     * *发布信息页* */

    public function fabu() {
        if (empty($this->user_session)) {
            $this->error_tips('请先进行登录！', U('Login/index'));
            exit();
        }
        $cid = intval($_GET['cid']);
        $fcid = intval($_GET['fcid']);
        if (($cid > 0) && ($fcid > 0)) {
            $cat_field = false;
            $database_Classify_category = D('Classify_category');
            $tmp = $database_Classify_category->where(array('cid' => $cid, 'fcid' => $fcid))->find();
            $subdir = $this->get_Subdirectory($tmp['cid'], 2, 3);
            if (empty($tmp)) {
                $tmp = $database_Classify_category->where(array('cid' => $fcid))->find();
            }elseif(empty($tmp['cat_field'])){
				$tmp1 = $database_Classify_category->where(array('cid' => $fcid))->find();
				$tmp['cat_field']=$tmp1['cat_field'];
			}
            if ($tmp) {
                $cat_field = !empty($tmp['cat_field']) ? unserialize($tmp['cat_field']) : false;
                if ($cat_field) {
                    foreach ($cat_field as $kk => $vv) {
                        if (isset($vv['use_field']) && ($vv['use_field'] == 'area')) {
                            $get_area_list = D('Area')->get_area_list();
                            $new_areas = array();
                            if ($get_area_list) {
                                foreach ($get_area_list as $vv) {
                                    $new_areas[$vv['area_id']] = $vv['area_name'];
                                }
                            }
                            $cat_field[$kk]['opt'] = $new_areas;
                        }
                    }
                }
            } else {
                $this->error('分类不存在！', U('Classify/SelectSub', array('cid' => $cid)));
            }
            //print_r($cat_field);
            $this->assign('subdir', $subdir);
            $this->assign('cid', $cid);
            $this->assign('fcid', $fcid);
            $this->assign('fabuset', $tmp);
            $this->assign('catfield', $cat_field);
            $this->display();
        } else {
            $this->redirect(U('Classify/SelectSub', array('cid' => $cid)));
            exit();
        }
    }

    /*     * *去除单双引号以及一些非法字符*** */

    private function Removalquotes($array) {
        //$regex="/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
        $regex = "/\'|\"|\\\|\<script|\<\/script/";
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = $this->Removalquotes($value);
                } else {
                    $value = strip_tags(trim($value));
                    $value = preg_replace($regex, '', $value);
                    $array[$key] = htmlspecialchars($value, ENT_QUOTES);
                }
            }
            return $array;
        } else {
            $array = strip_tags(trim($array));
            $array = preg_replace($regex, '', $array);
            return htmlspecialchars($array, ENT_QUOTES);
        }
    }

    /*     * *发布信息处理* */

    public function fabuTosave() {
        if (empty($this->user_session)) {
            $this->error_tips('请先进行登录！', U('Login/index'));
            exit();
        }
        $uid = $this->user_session['uid'];
        $datas = $this->Removalquotes($_POST);
        $cid = intval($datas['cid']);
        $fcid = intval($datas['fcid']);
        $sub3dir = isset($datas['subdir']) ? intval($datas['subdir']) : 0;
        $tname = $datas['tname'];
        if (empty($tname))
            $this->error('标题必须填写！');
        $lxname = $datas['lxname'];
        if (empty($lxname))
            $this->error('联系人名字必须填写！');

        $lxtel = $datas['lxtel'];
        if (empty($lxtel))
            $this->error('联系手机号必须填写！');
        if (!preg_match('/^[0-9]{5,20}$/', $lxtel))
            $this->error('联系手机号格式不正确！');
        $description = $datas['description'];
        $inputimg = isset($datas['inputimg']) ? $datas['inputimg'] : '';
        $inputs = $datas['input'];
        $newinputdatas = array();
        $inputfield = array();
        $expand = array();
        // $k=1;
        if (!empty($inputs)) {
            foreach ($inputs as $kk => $vv) {
                $iswrite = intval($vv['iswrite']);
                $input = intval($vv['input']);
                if ($iswrite && empty($vv['vv'])) {
                    $this->error('有必填项没有填写！');
                    exit();
                }
                $newinputdatas[] = $vv;
                $isfilter = intval($vv['isfilter']);
                if ($isfilter && ($input > 0) && ($input < 5)) {
                    $inputfield['input' . $input] = is_array($vv['vv']) ? implode(',', $vv['vv']) : $vv['vv'];
                    //$k++;
                    if (isset($vv['unit']) && !empty($vv['unit'])) {
                        $expand['input' . $input] = array('unit' => $vv['unit']);
                    }
                    if (isset($vv['inarr'])) {
                        if (isset($expand['input' . $input])) {
                            $expand['input' . $input]['inarr'] = intval($vv['inarr']);
                        } else {
                            $expand['input' . $input] = array('inarr' => intval($vv['inarr']));
                        }
                    }
                }
            }
        }
        unset($datas);
        $insert_datas = array('uid' => $uid, 'cid' => $cid, 'fcid' => $fcid, 'sub3dir' => $sub3dir, 'title' => $tname, 'lxname' => $lxname, 'lxtel' => $lxtel, 'imgs' => !empty($inputimg) ? serialize($inputimg) : '', 'description' => $description);
        if (!empty($inputfield))
            $insert_datas = array_merge($insert_datas, $inputfield);
        $insert_datas['content'] = !empty($newinputdatas) ? serialize($newinputdatas) : '';
        $insert_datas['addtime'] = $insert_datas['updatetime'] = time();
        $insert_datas['expand'] = !empty($expand) ? serialize($expand) : '';
        $isverify = C('config.classify_verify');
        $isverify = intval($isverify); /*         * *控制是否需要审核** */
        $insert_datas['status'] = $isverify == 1 ? 0 : 1;
        $userinputDb = M('Classify_userinput');
        $insert_id = $userinputDb->add($insert_datas);
        if ($insert_id > 0) {
            $this->success('发布成功！', U('Classify/myfabu', array('uid' => $uid)));
        } else {
            $this->error('发布失败，请重试！');
        }
    }

    /*     * *处理所搜请求* */

    public function get_Classify() {
        $kstr = $this->Removalquotes($_GET['kstr']);
        if (!empty($kstr)) {
            $categorys = M('Classify_category')->field('cid,fcid,pfcid,subdir,cat_name')->where('cat_name LIKE "%' . $kstr . '%" AND cat_status=1 AND subdir !=1')->order('`cat_sort` DESC,`cid` ASC')->select();
            $Classify_userinputDb = M('Classify_userinput');
            $newCarr = array();
            if ($categorys) {
                $i = 0;
                foreach ($categorys as $kk => $vv) {
                    $tmp = 0;
                    if ($vv['subdir'] == 2) {
                        $tmp = $Classify_userinputDb->where(array('cid' => $vv['cid'], 'fcid' => $vv['fcid']))->count();
                        //if($tmp>0){
                        $newCarr[$i]['cat_name'] = $vv['cat_name'];
                        $newCarr[$i]['tt'] = intval($tmp);
                        $newCarr[$i]['url'] = U('Classify/Lists', array('cid' => $vv['cid']));
                        //}
                    } elseif ($vv['subdir'] == 3) {
                        $tmp = $Classify_userinputDb->where(array('cid' => $vv['fcid'], 'fcid' => $vv['pfcid'], 'sub3dir' => $vv['cid']))->count();
                        //if($tmp>0){
                        $newCarr[$i]['cat_name'] = $vv['cat_name'];
                        $newCarr[$i]['tt'] = intval($tmp);
                        $newCarr[$i]['url'] = U('Classify/Lists', array('cid' => $vv['fcid'], 'sub3dir' => $vv['cid']));
                        //}
                    }
                    $i++;
                }
                $this->dexit(array('error' => 0, 'data' => $newCarr));
            }
        }
        $this->dexit(array('error' => 1, 'data' => array()));
    }

    /*     * *图片上传** */

    public function ajaxImgUpload() {
        $filename = trim($_POST['filename']);
        $img = $_POST[$filename];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imgdata = base64_decode($img);
        $getupload_dir = "/upload/images/classify/" . date('Ymd');
        $upload_dir = "." . $getupload_dir;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $newfilename = 'classify_' . date('YmdHis') . '.jpg';
        $save = file_put_contents($upload_dir . '/' . $newfilename, $imgdata);
        if ($save) {
            $this->dexit(array('error' => 0, 'data' => array('code' => 1, 'siteurl'=>$this->config['site_url'],'imgurl' =>$getupload_dir . '/' . $newfilename, 'msg' => '')));
        } else {
            $this->dexit(array('error' => 1, 'data' => array('code' => 0, 'url' => '', 'msg' => '保存失败！')));
        }
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
