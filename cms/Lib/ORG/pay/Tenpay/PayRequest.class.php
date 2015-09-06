<?php

class PayRequest extends CommonRequest
{
    public function PayRequest($secretKey)
    {
        parent::__construct($secretKey);
    }

    public function getURL()
    {
        $paraString = $this->genParaStr();
        $domain = $this->getDomain();
        return $domain . $this->PAY_OPPOSITE_ADDRESS . "?" . $paraString;
    }

    public function send()
    {
        return NULL;
    }
}

require_once "common/CommonRequest.class.php";

?>
