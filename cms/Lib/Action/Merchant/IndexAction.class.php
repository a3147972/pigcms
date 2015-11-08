<?php
/*
 * 商户中心管理首页
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/12/26 15:00
 *
 */

class IndexAction extends BaseAction
{
    public function index()
    {
        //商家公告
        $database_merchant_news = D('Merchant_news');
        $news_list = $database_merchant_news->field(true)->order('`is_top` DESC,`add_time` DESC')->limit(10)->select();
        $this->assign('news_list', $news_list);

        /**  商家数据统计 **/
        $mer_id = $this->merchant_session['mer_id'];
        //粉丝数量
        $pigcms_data['fans_count'] = M('')->table(array(C('DB_PREFIX') . 'merchant_user_relation' => 'm', C('DB_PREFIX') . 'user' => 'u'))->where("`m`.`openid`=`u`.`openid` AND `m`.`mer_id`='$mer_id'")->count();
        //会员卡数量
        $pigcms_data['card_count'] = M('Member_card_create')->where(array('token' => $mer_id, 'wecha_id' => array('neq', '')))->count();
        //微活动数量
        $pigcms_data['lottery_count'] = M('Lottery')->where(array('mer_id' => $mer_id))->count();
        //店铺数量
        $pigcms_data['store_count'] = M('Merchant_store')->where(array('mer_id' => $mer_id, 'status' => array('neq', 4)))->count();

        $this->assign($pigcms_data);

        $this->display();
    }
    public function news($id)
    {
        $database_merchant_news = D('Merchant_news');
        $condition_merchant_news['id'] = $id;
        $now_news = $database_merchant_news->field(true)->where($condition_merchant_news)->find();
        if (empty($now_news)) {
            $this->error('当前内容不存在！');
        }
        $this->assign('now_news', $now_news);

        $this->display();
    }
}
