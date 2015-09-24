<?php

class WapPayInitResponse extends CommonResponse
{
    public $serialVersionUID = -6.3435344122126E+18;

    public function WapPayInitResponse($paraMap, $secretKey)
    {
        parent::CommonResponse($paraMap, $secretKey);
    }

    public function isRetCodeOK()
    {
        return parent::isRetCodeOK();
    }

    public function getURL()
    {
        return parent::getParameter("url");
    }

    public function getMessage()
    {
        return parent::getParameter("message");
    }
}

require_once "common/CommonResponse.class.php";

?>
