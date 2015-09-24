<?php
class TestAction extends BaseAction
{
    public function index()
    {
    	$mod = new Model();
    	$sql = "SELECT COUNT( mer_id ) AS count, mer_id FROM  `pigcms_merchant_user_relation` GROUP BY mer_id";
    	$res = $mod->query($sql);
    	foreach ($res as $r) {
    		D('Merchant')->where(array('mer_id' => $r['mer_id']))->save(array('fans_count' => $r['count']));
    	}
    }
}