<?php
class PackimageAction extends BaseAction
{
	public $new_dir;
	public $dir;

	protected function _initialize()
	{
		parent::_initialize();
		set_time_limit(0);
		$this->dir = './upload/';
		$this->new_dir = './imagepack/' . $_SERVER['HTTP_HOST'] . '/';
		$this->mknewdir($this->new_dir);
	}

	public function index()
	{
		$adver_dir = $this->dir . 'adver/';
		$new_adver_dir = $this->new_dir . 'adver/';
		$this->mknewdir($new_adver_dir);
		$adver_list = D('Adver')->field('`pic`')->select();

		foreach ($adver_list as $value) {
			if (!empty($value['pic'])) {
				$tmp_adver_dir = $new_adver_dir . dirname($value['pic']) . '/';
				$this->mknewdir($tmp_adver_dir);
				$this->newcopy($adver_dir . $value['pic'], $new_adver_dir . $value['pic']);
			}
		}

		echo '<script>window.location.href="' . U('Packimage/catemenu') . '"</script>';
	}

	public function catemenu()
	{
		$catemenu_list = D('Catemenu')->field('`picurl`')->select();

		foreach ($catemenu_list as $value) {
			if (substr($value['picurl'], 0, 9) == './upload/') {
				$tmp_picurl = substr($value['picurl'], 9);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy($value['picurl'], $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/classify') . '"</script>';
	}

	public function classify()
	{
		$classify_list = D('Classify')->field('`img`')->select();

		foreach ($classify_list as $value) {
			if (substr($value['img'], 0, 9) == './upload/') {
				$tmp_picurl = substr($value['img'], 9);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy($value['img'], $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/config') . '"</script>';
	}

	public function config()
	{
		$config_list = D('Config')->field('`value`')->select();

		foreach ($config_list as $value) {
			$ltrimstr = 'http://' . $_SERVER['HTTP_HOST'] . '/upload/';

			if (substr($value['value'], 0, strlen($ltrimstr)) == $ltrimstr) {
				$tmp_picurl = substr($value['value'], strlen($ltrimstr));
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/customer_service') . '"</script>';
	}

	public function customer_service()
	{
		$customer_service_list = D('Customer_service')->field('`head_img`')->select();

		foreach ($customer_service_list as $value) {
			if (substr($value['head_img'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['head_img'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/first') . '"</script>';
	}

	public function first()
	{
		echo '<script>window.location.href="' . U('Packimage/flash') . '"</script>';
	}

	public function flash()
	{
		$flash_list = D('Flash')->field('`img`')->select();

		foreach ($flash_list as $value) {
			if (substr($value['img'], 0, 9) == './upload/') {
				$tmp_picurl = substr($value['img'], 9);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/group') . '"</script>';
	}

	public function group()
	{
		$new_group_dir = $this->new_dir . 'group/';
		$group_list = D('Group')->field('`pic`')->select();

		foreach ($group_list as $group_value) {
			$tmp_pic_arr = explode(';', $group_value['pic']);

			foreach ($tmp_pic_arr as $key => $value) {
				$image_tmp = explode(',', $value);
				$this->mknewdir($new_group_dir . $image_tmp[0]);
				$this->newcopy('./upload/group/' . $image_tmp[0] . '/' . $image_tmp[1], $new_group_dir . $image_tmp[0] . '/' . $image_tmp[1]);
				$this->newcopy('./upload/group/' . $image_tmp[0] . '/m_' . $image_tmp[1], $new_group_dir . $image_tmp[0] . '/m_' . $image_tmp[1]);
				$this->newcopy('./upload/group/' . $image_tmp[0] . '/s_' . $image_tmp[1], $new_group_dir . $image_tmp[0] . '/s_' . $image_tmp[1]);
			}
		}

		echo '<script>window.location.href="' . U('Packimage/image_text') . '"</script>';
	}

	public function image_text()
	{
		$image_text_list = D('Image_text')->field('`cover_pic`')->select();

		foreach ($image_text_list as $value) {
			if (substr($value['cover_pic'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['cover_pic'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/invitation') . '"</script>';
	}

	public function invitation()
	{
		$invitation_list = D('Invitation')->field('`store_image`')->select();

		foreach ($invitation_list as $value) {
			$ltrimstr = 'http://' . $_SERVER['HTTP_HOST'] . '/upload/';

			if (substr($value['value'], 0, strlen($ltrimstr)) == $ltrimstr) {
				$tmp_picurl = substr($value['value'], strlen($ltrimstr));
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/lottery') . '"</script>';
	}

	public function lottery()
	{
		$lottery_list = D('Lottery')->field('`starpicurl`')->select();

		foreach ($lottery_list as $value) {
			if (substr($value['starpicurl'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['starpicurl'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/meal') . '"</script>';
	}

	public function meal()
	{
		$new_meal_dir = $this->new_dir . 'meal/';
		$meal_list = D('Meal')->field('`image`')->select();

		foreach ($meal_list as $value) {
			if (!empty($value['image'])) {
				$image_tmp = explode(',', $value['image']);
				$this->mknewdir($new_meal_dir . $image_tmp[0]);
				$this->newcopy('./upload/meal/' . $image_tmp[0] . '/' . $image_tmp[1], $new_meal_dir . $image_tmp[0] . '/' . $image_tmp[1]);
				$this->newcopy('./upload/meal/' . $image_tmp[0] . '/m_' . $image_tmp[1], $new_meal_dir . $image_tmp[0] . '/m_' . $image_tmp[1]);
				$this->newcopy('./upload/meal/' . $image_tmp[0] . '/s_' . $image_tmp[1], $new_meal_dir . $image_tmp[0] . '/s_' . $image_tmp[1]);
			}
		}

		echo '<script>window.location.href="' . U('Packimage/member_card_coupon') . '"</script>';
	}

	public function member_card_coupon()
	{
		$member_card_coupon_list = D('Member_card_coupon')->field('`pic`')->select();

		foreach ($member_card_coupon_list as $value) {
			if (substr($value['pic'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['pic'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/member_card_focus') . '"</script>';
	}

	public function member_card_focus()
	{
		$member_card_focus_list = D('Member_card_focus')->field('`img`')->select();

		foreach ($member_card_focus_list as $value) {
			if (substr($value['img'], 0, 9) == './upload/') {
				$tmp_picurl = substr($value['img'], 9);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/member_card_integral') . '"</script>';
	}

	public function member_card_integral()
	{
		$member_card_integral_list = D('Member_card_integral')->field('`pic`')->select();

		foreach ($member_card_integral_list as $value) {
			if (substr($value['pic'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['pic'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/member_card_set') . '"</script>';
	}

	public function member_card_set()
	{
		$member_card_set_list = D('Member_card_set')->field('`logo`,`bg`,`diybg`,`Lastmsg`,`vip`,`qiandao`,`shopping`,`membermsg`,`contact`,`recharge`,`payrecord`')->select();

		foreach ($member_card_set_list as $value) {
			if (substr($value['logo'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['logo'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['bg'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['bg'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['diybg'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['diybg'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['Lastmsg'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['Lastmsg'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['vip'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['vip'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['qiandao'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['qiandao'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['shopping'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['shopping'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['membermsg'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['membermsg'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['contact'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['contact'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['recharge'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['recharge'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}

			if (substr($value['payrecord'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['payrecord'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/merchant') . '"</script>';
	}

	public function merchant()
	{
		$new_merchant_dir = $this->new_dir . 'merchant/';
		$merchant_list = D('Merchant')->field('`pic_info`')->select();

		foreach ($merchant_list as $merchant_value) {
			$tmp_pic_arr = explode(';', $merchant_value['pic_info']);

			foreach ($tmp_pic_arr as $key => $value) {
				$image_tmp = explode(',', $value);
				$this->mknewdir($new_merchant_dir . $image_tmp[0]);
				$this->newcopy('./upload/merchant/' . $image_tmp[0] . '/' . $image_tmp[1], $new_merchant_dir . $image_tmp[0] . '/' . $image_tmp[1]);
			}
		}

		echo '<script>window.location.href="' . U('Packimage/merchant_store') . '"</script>';
	}

	public function merchant_store()
	{
		$new_store_dir = $this->new_dir . 'store/';
		$merchant_store_list = D('Merchant_store')->field('`pic_info`')->select();

		foreach ($merchant_store_list as $merchant_store_value) {
			$tmp_pic_arr = explode(';', $merchant_store_value['pic_info']);

			foreach ($tmp_pic_arr as $key => $value) {
				$image_tmp = explode(',', $value);
				$this->mknewdir($new_store_dir . $image_tmp[0]);
				$this->newcopy('./upload/store/' . $image_tmp[0] . '/' . $image_tmp[1], $new_store_dir . $image_tmp[0] . '/' . $image_tmp[1]);
			}
		}

		echo '<script>window.location.href="' . U('Packimage/platform') . '"</script>';
	}

	public function platform()
	{
		$platform_list = D('Platform')->field('`pic`')->select();

		foreach ($platform_list as $value) {
			if (substr($value['pic'], 0, 8) == '/upload/') {
				$tmp_picurl = substr($value['pic'], 8);
				$tmp_new_dir = $this->new_dir . dirname($tmp_picurl) . '/';
				$this->mknewdir($tmp_new_dir);
				$this->newcopy('./upload/' . $tmp_picurl, $tmp_new_dir . basename($tmp_picurl));
			}
		}

		echo '<script>window.location.href="' . U('Packimage/reply_pic') . '"</script>';
	}

	public function reply_pic()
	{
		$new_reply_dir = $this->new_dir . 'reply/';
		$reply_pic_list = D('Reply_pic')->field('`pic`')->select();

		foreach ($reply_pic_list as $value) {
			$image_tmp = explode(',', $value['pic']);
			$this->mknewdir($new_reply_dir . $image_tmp[0]);
			$this->newcopy('./upload/reply/' . $image_tmp[0] . '/' . $image_tmp[1], $new_reply_dir . $image_tmp[0] . '/' . $image_tmp[1]);
			$this->newcopy('./upload/reply/' . $image_tmp[0] . '/m_' . $image_tmp[1], $new_reply_dir . $image_tmp[0] . '/m_' . $image_tmp[1]);
			$this->newcopy('./upload/reply/' . $image_tmp[0] . '/s_' . $image_tmp[1], $new_reply_dir . $image_tmp[0] . '/s_' . $image_tmp[1]);
		}

		echo '<script>window.location.href="' . U('Packimage/slider') . '"</script>';
	}

	public function slider()
	{
		$slider_dir = $this->dir . 'slider/';
		$new_slider_dir = $this->new_dir . 'slider/';
		$this->mknewdir($new_slider_dir);
		$slider_list = D('Slider')->field('`pic`')->select();

		foreach ($slider_list as $value) {
			if (!empty($value['pic'])) {
				$tmp_slider_dir = $new_slider_dir . dirname($value['pic']) . '/';
				$this->mknewdir($tmp_slider_dir);
				$this->newcopy($slider_dir . $value['pic'], $new_slider_dir . $value['pic']);
			}
		}

		echo '图片打包完成';
	}

	public function newcopy($old, $new)
	{
		if (file_exists($old) && !file_exists($new)) {
			echo $old . '<br/>';
			echo $new . '<br/>';
			@copy($old, $new);
		}
	}

	public function mknewdir($dirname)
	{
		if (!is_dir($dirname)) {
			echo $dirname . '<br/>';
			@mkdir($dirname, 511, true);
		}
	}
}

?>
