<?php
/*
 * 短信发送记录
 *
 */

class SmsAction extends BaseAction
{
    public function index()
    {
		$count = D("Sms_record")->count();
		import('@.ORG.system_page');
		$p = new Page($count, 20);
		$mod = new Model();
		$sql = "SELECT a.name, b.* FROM ". C('DB_PREFIX') . "merchant AS a INNER JOIN ". C('DB_PREFIX') . "sms_record AS b ON a.mer_id=b.mer_id ORDER BY pigcms_id DESC LIMIT {$p->firstRow}, {$p->listRows}";
		$res = $mod->query($sql);
		
		$status = array('0' =>'发送成功', '-1' => '验证失败未购买', '-2' => '短信不足', '-3' => '操作失败', '-4' => '非法字符', '-5' => '内容过多', '-6' => '号码过多', '-7' => '频率过快', '-8' => '号码内容空', '-9' => '账号冻结', '-10' => '禁止频繁单条发送', '-11' => '系统暂定发送', '-12' => '有错误号码', '-13' => '定时时间不对', '-14' => '账号被锁，10分钟后登录', '-15' => '连接失败', '-16' => '禁止接口发送', '-17' => '绑定IP不正确', '-18' => '系统升级', '-19' => '域名不对', '-20' => 'key不匹配', '-21' => '用户不存在', '-22' => '余额不足', '-100' => '发送的token不合法');
		
		$this->assign('record_list', $res);
		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		$this->assign('status', $status);
		$this->display();
    }
}