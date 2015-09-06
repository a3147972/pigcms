<?php

class NotifyQueryResponse extends CommonResponse
{
    public function NotifyQueryResponse($paraMap, $secretKey)
    {
        $this->CommonResponse($paraMap, $secretKey);
    }
}

require_once "common/CommonResponse.class.php";

?>
