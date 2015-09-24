<?php

class WapResponseHandler extends ResponseHandler
{
    public function __construct()
    {
        $this->WapResponseHandler();
    }

    public function WapResponseHandler()
    {
        parent::ResponseHandler();
    }

    public function isTenpaySign()
    {
        $keysArr = array("ver", "charset", "pay_result", "transaction_id", "sp_billno", "total_fee", "fee_type", "bargainor_id", "attach", "time_end");
        return parent::isTenpaySign($keysArr);
    }
}


?>
