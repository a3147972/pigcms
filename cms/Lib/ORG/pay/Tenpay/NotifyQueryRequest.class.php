<?php

class NotifyQueryRequest extends RetXmlRequest
{
    public function NotifyQueryRequest($secretKey)
    {
        parent::RetXmlRequest($secretKey);
    }

    public function send()
    {
        $respone = new NotifyQueryResponse($this->retXmlHttpCall($this->VERIFY_NOTIFY_OPPOSITE_ADDRESS), $this->getSecretKey());
        return $respone;
    }
}

require_once "common/RetXmlRequest.class.php";
require_once "NotifyQueryResponse.class.php";

?>
