<?php

class WapJumpToTenpayRequest extends CommonRequest
{
    public $serialVersionUID = 5.8676854107439E+18;
    public $WAP_JUMP_TO_TENPAY_ADDRESS = "https://wap.tenpay.com/cgi-bin/wapmainv2.0/wm_clientlogin.cgi";
    public $SANDBOX_WAP_JUMP_TO_TENPAY_ADDRESS = "http://sandwap.tenpay.com/cgi-bin/wapmainv2.0/wm_clientlogin.cgi";

    public function WapJumpToTenpayRequest($secretKey)
    {
        parent::__construct($secretKey);
    }

    public function getDomain()
    {
        $domain = NULL;

        if (parent::isInSandBox()) {
            $domain = $this->SANDBOX_WAP_JUMP_TO_TENPAY_ADDRESS;
        }
        else {
            $domain = $this->WAP_JUMP_TO_TENPAY_ADDRESS;
        }

        return $domain;
    }

    public function getURL()
    {
        $url = $this->getDomain() . "?" . parent::genParaStr();
        return $url;
    }

    public function send()
    {
        return NULL;
    }
}

require_once "common/CommonRequest.class.php";
require_once "common/CommonResponse.class.php";

?>
