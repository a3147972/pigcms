<?php

class OrderQueryResponse extends CommonResponse
{
    public function OrderQueryResponse($paraMap, $secretKey)
    {
        $this->CommonResponse($paraMap, $secretKey);
    }
}

require_once "common/CommonResponse.class.php";

?>
