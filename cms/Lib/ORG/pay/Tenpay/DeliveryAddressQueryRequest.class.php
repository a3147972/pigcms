<?php

class DeliveryAddressQueryRequest extends RetXmlRequest
{
    public function DeliveryAddressQueryRequest($secretKey)
    {
        parent::RetXmlRequest($secretKey);
    }

    public function send()
    {
        $respone = new DeliveryAddressQueryRespone($this->httpCallRetXmlStr($this->DELIVERADDRESS_QUERY_OPPOSITE_ADDRESS), $this->getInputCharset());
        return $respone;
    }
}

require_once "common/RetXmlRequest.class.php";
require_once "DeliveryAddressQueryRespone.class.php";

?>
