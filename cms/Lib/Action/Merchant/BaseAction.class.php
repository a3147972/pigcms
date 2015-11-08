<?php
/*
 * 后台管理基础类
 *
 */
class BaseAction extends Action
{
    protected $merchant_session;
    protected $config;
    protected $static_path;
    protected $static_public;
    public $token;
    protected function _initialize()
    {
        $this->check_merchant_file();
        $this->merchant_session = session('merchant');
        if (empty($this->merchant_session) && MODULE_NAME != 'Store') {
            redirect(U('Login/index'));exit;
        }
        /****实时查找商家的权限****/
        $tmerch = D("Merchant")->field('menus')->where(array('mer_id' => $this->merchant_session['mer_id']))->find();
        if (empty($tmerch['menus'])) {
            $this->merchant_session['menus'] = '';
        } else {
            $this->merchant_session['menus'] = explode(",", $tmerch['menus']);
        }

        /****实时查找商家的权限****/

        $this->assign('merchant_session', $this->merchant_session);

        $this->config = D('Config')->get_config();
        $this->assign('config', $this->config);
        C('config', $this->config);

        $merchant_menu_list = S('merchant_menu_list');

        if (empty($merchant_menu_list)) {
            $database_merchant_menu = D('Merchant_menu');
            $condition_merchant_menu['status'] = 1;
            $condition_merchant_menu['show'] = 1;
            $merchant_menu_list = $database_merchant_menu->field(true)->where($condition_merchant_menu)->order('`sort` DESC, `fid` ASC,`id` ASC')->select();
            S('merchant_menu_list', $merchant_menu_list);
        }

        foreach ($merchant_menu_list as $value) {

            //****处理权限****//
            if ($value['module'] == MODULE_NAME && $value['action'] == ACTION_NAME) {
                if (!empty($this->merchant_session['menus']) && !in_array($value['id'], $this->merchant_session['menus'])) {
                    $this->error('您还没有这个使用权限，联系管理员开通！', U('Index/Index'));
                }
            }
            //****处理权限****//

            if ($value['module'] == 'Weixin' && (empty($this->config['is_open_oauth']) && empty($this->merchant_session['is_open_oauth']))) {
                continue;
            }

            if ($value['module'] == 'Weidian' && (empty($this->config['is_open_weidian']) && empty($this->merchant_session['is_open_weidian']))) {
                continue;
            }
            /**********控制商家的菜单显示************/
            if (!empty($this->merchant_session['menus']) && !in_array($value['id'], $this->merchant_session['menus'])) {
                continue;
            }

            /**********控制商家的菜单显示************/
            $select_module = explode(',', $value['select_module']);
            $select_action = explode(',', $value['select_action']);
            if (in_array(MODULE_NAME, $select_module) && (empty($value['select_action']) || in_array(ACTION_NAME, $select_action))) {
                $value['is_active'] = true;
            }
            $value['url'] = U($value['module'] . '/' . $value['action']);
            if ($value['fid'] == 0) {
                $merchant_menu[$value['id']] = $value;
            } else {

                $merchant_menu[$value['fid']]['menu_list'][] = $value;
            }
        }

        foreach ($merchant_menu as &$value) {
            $tmp_class = '';
            if ($value['is_active'] && $value['menu_list']) {
                $tmp_class = 'open';
            }
            if ($value['is_active']) {
                $tmp_class .= ' active';
            }
            if ($value['menu_list']) {
                $tmp_class .= ' hsub';
            }
            $value['style_class'] = $tmp_class;
        }

        $this->assign('merchant_menu', $merchant_menu);

        $this->token = $this->merchant_session['mer_id'];
        $this->static_path = './tpl/Merchant/static/';
        $this->static_public = './static/';
        $this->assign('static_path', $this->static_path);
        $this->assign('static_public', $this->static_public);
    }

    protected function check_merchant_file()
    {
        $filename = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
        if ($filename == 'index.php') {
            $this->error('非法访问商家中心！');
        }
    }

    public function _empty()
    {
        $this->error('您访问错了！该页面不存在。');
    }

    protected function frame_main_ok_tips($tips, $time = 2, $href = '')
    {
        if ($href == '') {
            $tips = '<font color=\"red\">' . $tips . '</font>';
            $href = 'javascript:history.back(-1);';
            $tips .= '<br/><br/>系统正在跳转到上一个页面。';
        }
        if ($time != 2) {
            $tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
        }
        exit('<html><head><script>window.top.msg(1,"' . $tips . '",true,' . $time . ');window.parent.frames[\'main\'].location.href="' . $href . '";</script></head></html>');
    }
    protected function error_tips($tips, $time = 2, $href = '')
    {
        if ($href == '') {
            $tips = '<font color=\"red\">' . $tips . '</font>';
            $href = 'javascript:history.back(-1);';
            $tips .= '<br/><br/>系统正在跳转到上一个页面。';
        }
        if ($time != 2) {
            $tips .= $time . '秒后会提示将自动关闭，可手动关闭！';
        }
        exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');location.href="' . $href . '";</script></head></html>');
    }
    protected function frame_error_tips($tips, $time = 2)
    {
        exit('<html><head><script>window.top.msg(0,"' . $tips . '",true,' . $time . ');window.top.closeiframe();</script></head></html>');
    }
}
