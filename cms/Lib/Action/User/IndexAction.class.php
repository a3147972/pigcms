<?php
/*
 * 首页
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/20 10:54
 *
 */
class IndexAction extends BaseAction
{

    protected function _initialize()
    {
        parent::_initialize();
        //导航条
        $web_index_slider = D('Slider')->get_slider_by_key('web_slider');
        $this->assign('web_index_slider', $web_index_slider);

        //热门搜索词
        $search_hot_list = D('Search_hot')->get_list(12);
        $this->assign('search_hot_list', $search_hot_list);

        //所有分类 包含2级分类
        $all_category_list = D('Group_category')->get_category();
        $this->assign('all_category_list', $all_category_list);
    }

    public function index()
    {

        //我的团购列表
        $this->assign(D('Group')->get_order_list($this->now_user['uid'], intval($_GET['status']), false));

        $this->display();
    }

    public function group_order_view()
    {

        $now_order = D('Group_order')->get_order_detail_by_id($this->now_user['uid'], $_GET['order_id']);
        if (empty($now_order)) {
            $this->error('当前订单不存在！', U('Index/index'));
        } else {
            $this->assign('now_order', $now_order);
        }

        $this->display();
    }

    public function group_order_del()
    {
        $now_order = D('Group_order')->get_order_detail_by_id($this->now_user['uid'], $_GET['order_id']);
        if (empty($now_order)) {
            $this->error('当前订单不存在！', U('Index/index'));
        } else if ($now_order['paid']) {
            $this->error('当前订单已付款，不能删除。');
        }

        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['status'] = 4;
        if (D('Group_order')->where($condition_group_order)->data($data_group_order)->save()) {
            $this->success('删除成功！', U('Index/index'));
        } else {
            $this->error('删除失败！请重试。');
        }
    }

    public function meal_list()
    {
        $status = isset($_GET['status']) ? intval($_GET['status']) : -1;
        $where = array('uid' => $this->now_user['uid'], 'status' => array('lt', 4));
        if ($status == 0) {
            $where['paid'] = 0;
        } elseif ($status == 1) {
            $where['status'] = 0;
        } elseif ($status == 2) {
            $where['status'] = 1;
        }

        import('@.ORG.user_page');
        $count = M("Meal_order")->where($where)->count();
        $p = new Page($count, 10);

        $orders = M("Meal_order")->where($where)->order('order_id DESC')->limit($p->firstRow . ',10')->select();
        $tmp = array();
        foreach ($orders as $o) {
            $tmp[] = $o['store_id'];
        }
        if ($tmp) {
            $store_image_class = new store_image();
            $store = D('Merchant_store')->where(array('store_id' => array('in', $tmp)))->select();
            $list = array();
            foreach ($store as $v) {
                $images = $store_image_class->get_allImage_by_path($v['pic_info']);
                $v['image'] = $images ? array_shift($images) : array();
                $list[$v['store_id']] = $v;
            }
        }

        foreach ($orders as &$or) {
            $or['image'] = isset($list[$or['store_id']]['image']) ? $list[$or['store_id']]['image'] : '';
            $or['s_name'] = isset($list[$or['store_id']]['name']) ? $list[$or['store_id']]['name'] : '';
            $or['url'] = C('config.site_url') . '/meal/' . $or['store_id'] . '.html';
        }
        $this->assign('order_list', $orders);
        $this->assign('status', $status);
        $this->assign('pagebar', $p->show());

        $this->display();
    }

    public function meal_order_view()
    {
        $now_order = D('Meal_order')->get_order_by_id($this->now_user['uid'], $_GET['order_id']);
        $now_order['info'] = unserialize($now_order['info']);

        $now_order['pay_type_txt'] = D('Pay')->get_pay_name($now_order['pay_type'], $now_order['is_mobile_pay']);

        if ($now_order['meal_pass']) {
            $now_order['meal_pass_txt'] = preg_replace('#(\d{4})#', '$1 ', $now_order['meal_pass']);
        }
        if (empty($now_order)) {
            $this->error('当前订单不存在！');
        } else {
            $this->assign('now_order', $now_order);
        }

        $this->display();
    }

    public function meal_order_del()
    {
        $now_order = D('Meal_order')->get_order_by_id($this->now_user['uid'], $_GET['order_id']);
        if (empty($now_order)) {
            $this->error('当前订单不存在！');
        } else {
            D('Meal_order')->where(array('uid' => $this->now_user['uid'], 'order_id' => $_GET['order_id']))->save(array('status' => 2));
            $this->success('订单删除成功', U('User/Index/meal_list'));
        }
    }

    public function lifeservice()
    {
        import('@.ORG.user_page');
        $condition_where = array('uid' => $this->user_session['uid'], 'status' => array('neq', '0'));
        $count = D('Service_order')->where($condition_where)->count();
        $p = new Page($count, 20);

        $order_list = D('Service_order')->field(true)->where($condition_where)->order('`order_id` DESC')->limit($p->firstRow . ',10')->select();
        foreach ($order_list as &$value) {
            $value['type_txt'] = $this->lifeservice_type_txt($value['type']);
            $value['type_eng'] = $this->lifeservice_type_eng($value['type']);
            $value['infoArr'] = unserialize($value['info']);
            $value['order_url'] = U('My/lifeservice_detail', array('id' => $value['order_id']));
        }
        $this->assign('pagebar', $p->show());
        $this->assign('order_list', $order_list);
        $this->display();
    }
    public function lifeservice_detail()
    {
        $now_order = D('Service_order')->field(true)->where(array('order_id' => $_GET['order_id']))->find();
        if (empty($now_order)) {
            $this->error('当前订单不存在！');
        }
        $now_order['infoArr'] = unserialize($now_order['info']);
        $now_order['type_txt'] = $this->lifeservice_type_txt($now_order['type']);
        $now_order['type_eng'] = $this->lifeservice_type_eng($now_order['type']);
        $now_order['pay_money'] = floatval($now_order['pay_money']);
        $this->assign('now_order', $now_order);
        // dump($now_order);
        $this->display();
    }
    protected function lifeservice_type_txt($type)
    {
        switch ($type) {
            case '1':
                $type_txt = '水费';
                break;
            case '2':
                $type_txt = '电费';
                break;
            case '3':
                $type_txt = '煤气费';
                break;
            default:
                $type_txt = '生活服务';
        }
        return $type_txt;
    }
    protected function lifeservice_type_eng($type)
    {
        switch ($type) {
            case '1':
                $type_txt = 'water';
                break;
            case '2':
                $type_txt = 'electric';
                break;
            case '3':
                $type_txt = 'gas';
                break;
            default:
                $type_txt = 'life';
        }
        return $type_txt;
    }
}
