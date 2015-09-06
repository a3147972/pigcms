<?php

class WapNotifyResponseHandler extends ResponseHandler
{
    public function __construct()
    {
        $this->WapNotifyResponseHandler();
    }

    public function WapNotifyResponseHandler()
    {
        parent::ResponseHandler();
    }

    public function isTenpaySign()
    {
        $keysArr = array("ver", "charset", "bank_type", "bank_billno", "pay_result", "pay_info", "purchase_alias", "bargainor_id", "transaction_id", "sp_billno", "total_fee", "fee_type", "attach", "time_end");
        return parent::isTenpaySign($keysArr);
    }
}


?>
