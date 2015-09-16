<?php

class OrderQueryRequest extends RetXmlRequest
{
    public function OrderQueryRequest($secretKey)
    {
        parent::RetXmlRequest($secretKey);
    }

    public function send()
    {
        $respone = new OrderQueryResponse($this->retXmlHttpCall($this->NORMALQUERY_OPPOSITE_ADDRESS), $this->getSecretKey());
        return $respone;
    }
}

require_once "common/RetXmlRequest.class.php";
require_once "OrderQueryResponse.class.php";

?>
