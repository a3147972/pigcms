<?php

class TenpayHttpClient
{
    public $reqContent;
    public $resContent;
    public $method;
    public $certFile;
    public $certPasswd;
    public $certType;
    public $caFile;
    public $errInfo;
    public $timeOut;
    public $responseCode;

    public function __construct()
    {
        $this->TenpayHttpClient();
    }

    public function TenpayHttpClient()
    {
        $this->reqContent = "";
        $this->resContent = "";
        $this->method = "post";
        $this->certFile = "";
        $this->certPasswd = "";
        $this->certType = "PEM";
        $this->caFile = "";
        $this->errInfo = "";
        $this->timeOut = 120;
        $this->responseCode = 0;
    }

    public function setReqContent($reqContent)
    {
        $this->reqContent = $reqContent;
    }

    public function getResContent()
    {
        return $this->resContent;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getErrInfo()
    {
        return $this->errInfo;
    }

    public function setCertInfo($certFile, $certPasswd, $certType)
    {
        $this->certFile = $certFile;
        $this->certPasswd = $certPasswd;
        $this->certType = $certType;
    }

    public function setCaInfo($caFile)
    {
        $this->caFile = $caFile;
    }

    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;
    }

    public function call()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeOut);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        $arr = explode("?", $this->reqContent);
        if ((2 <= count($arr)) && ($this->method == "post")) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_URL, $arr[0]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $arr[1]);
        }
        else {
            curl_setopt($ch, CURLOPT_URL, $this->reqContent);
        }

        if ($this->certFile != "") {
            curl_setopt($ch, CURLOPT_SSLCERT, $this->certFile);
            curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $this->certPasswd);
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, $this->certType);
        }

        if ($this->caFile != "") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_CAINFO, $this->caFile);
        }
        else {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }

        $res = curl_exec($ch);
        $this->responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($res == NULL) {
            $this->errInfo = "call http err :" . curl_errno($ch) . " - " . curl_error($ch);
            curl_close($ch);
            return false;
        }
        else if ($this->responseCode != "200") {
            $this->errInfo = "call http err httpcode=" . $this->responseCode;
            curl_close($ch);
            return false;
        }

        curl_close($ch);
        $this->resContent = $res;
        return true;
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }
}


?>
