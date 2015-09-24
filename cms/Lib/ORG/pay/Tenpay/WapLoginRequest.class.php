<?php

class WapLoginRequest extends CommonRequest
{
    public $serialVersionUID = 1.7438016780421E+16;
    public $WAP_LOGIN_ADDRESS = "https://wap.tenpay.com/cgi-bin/wapmainv2.0/loginsh_gate.cgi";
    public $SANDBOX_WAP_LOGIN_ADDRESS = "http://sandwap.tenpay.com/cgi-bin/wapmainv2.0/loginsh_gate.cgi";
    public $SIGN_ENCRYPT_KEYID = "sign_encrypt_keyid";
    public $VSERSION = "version";
    public $CHTYPE = "chtype";

    public function WapLoginRequest($secretKey)
    {
        parent::__construct($secretKey);
        parent::setParameter($this->SIGN_ENCRYPT_KEYID, "0");
        parent::setParameter($this->VSERSION, "1.0");
        parent::setParameter($this->CHTYPE, "0");
        parent::setParameter($this->INPUT_CHARSET, "GBK");
    }

    public function getDomain()
    {
        $domain = NULL;

        if (parent::isInSandBox()) {
            $domain = $this->SANDBOX_WAP_LOGIN_ADDRESS;
        }
        else {
            $domain = $this->WAP_LOGIN_ADDRESS;
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
