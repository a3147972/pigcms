<?php

class GoldenEggAction extends LotteryBaseAction
{
    public $lotteryType;
    public $lotteryTypeName;

    public function _initialize()
    {
        parent::_initialize();
        $this->lotteryType = 5;
        $this->lotteryTypeName = "砸金蛋";
        $this->assign("lotteryTypeName", $this->lotteryTypeName);
    }

    public function cheat()
    {
        parent::cheat(5);
        $this->display("Lottery:cheat");
    }

    public function index()
    {
        parent::index($this->lotteryType);
        $this->display("Lottery:index");
    }

    public function sn()
    {
        parent::sn($this->lotteryType);
        $this->display("Lottery:sn");
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
