<?php
class CouponAction extends LotteryBaseAction
{
	public function _initialize()
	{
		parent::_initialize();
	}

	public function index()
	{
		parent::index(3);
		$this->display('Lottery:index');
	}

	public function sn()
	{
		parent::sn(3);
		$this->display('Lottery:sn');
	}

	public function add()
	{
		parent::add(3);
	}

	public function edit()
	{
		parent::edit(3);
	}
}

?>
