<?php

class PayResponse extends CommonResponse
{
    public $NOTIFYID = "notify_id";

    public function PayResponse($secretKey)
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

            $this->CommonResponse($this->parameters, $this->secretKey, false);
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
        }

        $this->NOTIFYID = ("notify_id");
        unset(->parameters);
    }

    public function acknowledgeSuccess()
    {
        echo "success";
        return true;
    }

    public function getNotifyId()
    {
        return $this->NOTIFYID;
    }
}

require_once "common/CommonResponse.class.php";

?>
