<?php
class MerchantAction extends BaseAction{
	public function around(){
		if ($_SESSION['openid'] && ($long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find())) {
			$list = D('Merchant')->get_merchants_by_long_lat($long_lat['lat'], $long_lat['long'], $this->config['merchant_around_range']);
			$this->assign('list', $list);
			$this->assign('lat', $long_lat['lat']);
			$this->assign('long', $long_lat['long']);
		}else{
			$this->error_tips('没有获取到您的地理位置，正在返回首页',U('Home/index'));
		}
		$this->display('new_around');
	}
}
?>