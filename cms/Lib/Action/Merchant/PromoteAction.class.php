<?php
class PromoteAction extends BaseAction
{
	public function index()
	{
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
		$now_merchant = $database_merchant->field(true, 'pwd')->where($condition_merchant)->find();

		if (!empty($now_merchant['pic_info'])) {
			$merchant_image_class = new merchant_image();
			$tmp_pic_arr = explode(';', $now_merchant['pic_info']);

			foreach ($tmp_pic_arr as $key => $value) {
				$now_merchant['pic'][$key]['title'] = $value;
				$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
			}
		}

		$this->assign('now_merchant', $now_merchant);
		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);
		$this->assign('merchant_group_list', $merchant_group_list);
		$this->display();
	}

	public function info()
	{
		$hits = D('Group')->get_hits_log($this->merchant_session['mer_id']);

		if (!empty($hits)) {
			import('ORG.Net.IpLocation');
			$IpLocation = new IpLocation();

			foreach ($hits['group_list'] as &$hit) {
				$last_location = $IpLocation->getlocation($hit['ip']);
				$hit['ip_txt'] = iconv('GBK', 'UTF-8', $last_location['country']);
			}
		}

		$this->assign('hits', $hits['group_list']);
		$this->assign('pagebar', $hits['pagebar']);
		$this->display();
	}
}

?>
