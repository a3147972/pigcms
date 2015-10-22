<?php
class LuckyFruitAction extends LotteryBaseAction
{
	public $lotteryType;
	public $lotteryTypeName;

	public function _initialize()
	{
		parent::_initialize();
		$this->lotteryType = 4;
		$this->lotteryTypeName = '水果达人';
		$this->assign('lotteryTypeName', $this->lotteryTypeName);
	}

	public function cheat()
	{
		parent::cheat(4);
		$this->display('Lottery:cheat');
	}

	public function index()
	{
		parent::index($this->lotteryType);
		$this->display('Lottery:index');
	}

	public function sn()
	{
		parent::sn($this->lotteryType);
		$this->display('Lottery:sn');
	}

	public function add()
	{
		parent::add($this->lotteryType);
	}

	public function edit()
	{
		parent::edit($this->lotteryType);
	}
}

?>
