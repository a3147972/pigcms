<?php

class Chat
{
    private $_config = "";
    private $nonce = "";
    private $sTimeStamp = "";
    private $msg_signature = "";
    public $data = array();

    public function __construct($config)
    {
        $this->nonce = $_REQUEST["nonce"] ? $_REQUEST["nonce"] : "";
        $this->sTimeStamp = $_REQUEST["timestamp"] ? $_REQUEST["timestamp"] : time();
        $this->msg_signature = $_REQUEST["msg_signature"] ? $_REQUEST["msg_signature"] : "";
        $this->_config = $config;
        $xml = file_get_contents("php://input");
        $this->data = $this->decodeMsg($xml);
    }

    public function encodeMsg($sRespData)
    {
        import("@.ORG.aes.WXBizMsgCrypt");
        $pc = new WXBizMsgCrypt($this->_config["wx_token"], $this->_config["wx_encodingaeskey"], $this->_config["wx_appid"]);
        $sRespData = str_replace("<?xml version=\"1.0\"?>", "", $sRespData);
        $encryptMsg = "";
        $errCode = $pc->encryptMsg($sRespData, $this->sTimeStamp, $this->nonce, $encryptMsg);

        if ($errCode == 0) {
            return $encryptMsg;
        }
        else {
            return $errCode;
        }
    }

    public function decodeMsg($msg)
    {
        import("@.ORG.aes.WXBizMsgCrypt");
        $pc = new WXBizMsgCrypt($this->_config["wx_token"], $this->_config["wx_encodingaeskey"], $this->_config["wx_appid"]);
        $sMsg = "";
        $errCode = $pc->decryptMsg($this->msg_signature, $this->sTimeStamp, $this->nonce, $msg, $sMsg);

        if ($errCode == 0) {
            $data = array();
            $xml = new SimpleXMLElement($sMsg);
            $xml || exit();

            foreach ($xml as $key => $value ) {
                $data[$key] = strval($value);
            }

            return $data;
        }
        else {
            return $errCode;
        }
    }

    public function request()
    {
        return $this->data;
    }

    public function response($content, $type, $flag)
    {
        $this->data = array("ToUserName" => $this->data["FromUserName"], "FromUserName" => $this->data["ToUserName"], "CreateTime" => NOW_TIME, "MsgType" => $type);
        $this->{$type}($content);
        $this->data["FuncFlag"] = $flag;
        $xml = new SimpleXMLElement("<xml></xml>");
        $this->data2xml($xml, $this->data);
        if ($_GET["encrypt_type"] && ($_GET["encrypt_type"] == "aes")) {
            exit($this->encodeMsg($xml->asXML()));
        }
        else {
            exit($xml->asXML());
        }
    }

    private function text($content)
    {
        $this->data["Content"] = $content;
    }

    private function music($music)
    {
        $music["HQMusicUrl"] = $music[3];
        $music["MusicUrl"] = $music[2];
        $music["Description"] = $music[1];
        $music["Title"] = $music[0];
        $this->data["Music"] = $music;
    }

    private function news($news)
    {
        $articles = array();

        foreach ($news as $key => $value ) {
            $articles[$key]["Url"] = $value[3];
            $articles[$key]["PicUrl"] = $value[2];
            $articles[$key]["Description"] = $value[1];
            $articles[$key]["Title"] = $value[0];

            if (9 <= $key) {
                break;
            }
        }

        $this->data["ArticleCount"] = count($articles);
        $this->data["Articles"] = $articles;
    }

    private function transfer_customer_service($content)
    {
        $this->data["Content"] = "";
    }

    private function data2xml($xml, $data, $item)
    {
        foreach ($data as $key => $value ) {
            is_numeric($key) && ($key = $item);
            if (is_array($value) || is_object($value)) {
                $child = $xml->addChild($key);
                $this->data2xml($child, $value, $item);
            }
            else if (is_numeric($value)) {
                $child = $xml->addChild($key, $value);
            }
            else {
                $child = $xml->addChild($key);
                $node = dom_import_simplexml($child);
                $node->appendChild($node->ownerDocument->createCDATASection($value));
            }
        }
    }

    private function auth($token)
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if (trim($tmpStr) == trim($signature)) {
            return true;
        }
        else {
            return false;
        }
    }
}


?>
