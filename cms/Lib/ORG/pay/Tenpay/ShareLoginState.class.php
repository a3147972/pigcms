<?php

class ShareLoginState extends CommonResponse
{
    public $USER_ID = "user_id";
    public $TOKEN = "token";

    public function ShareLoginState($secretKey)
    {
        try {
            unset(->parameters);
            $this->secretKey = $secretKey;

            foreach ($_GET as $k => $v ) {
                $this->setParameter($k, $v);
            }

            foreach ($_POST as $k => $v ) {
                $this->setParameter($k, $v);
            }

            $this->setParameter($this->RETCODE, "0");

            if (!$this->isRetCodeOK()) {
                throw new SDKRuntimeException("服务调用异常:" . $this->getPayInfo() . "<br>");
            }

            if (NULL == $this->getUserId()) {
                throw new SDKRuntimeException("财付通用户id未传入!<br>");
            }
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
        }

        ($this->RETCODE, NULL);
        $this->verifySign();
    }

    public function getUserId()
    {
        return $this->getParameter($this->USER_ID);
    }

    public function getToken()
    {
        return $this->getParameter($this->TOKEN);
    }
}

require_once "common/SDKRuntimeException.class.php";
require_once "common/CommonResponse.class.php";

?>
