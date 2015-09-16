<?php
class GuajiangAction extends LotteryBaseAction
{
	public function _initialize()
	{
		parent::_initialize();
	}

	public function cheat()
	{
		parent::cheat(2);
		$this->display('Lottery:cheat');
	}

	public function index()
	{
		parent::index(2);
		$this->display('Lottery:index');
	}

	public function sn()
	{
		parent::sn(2);
		$this->display('Lottery:sn');
	}

	public function add()
	{
		parent::add(2);
	}

	public function edit()
	{
		parent::edit(2);
	}
}

?>
