<?php

class MicroBlogSendRequest extends CommonRequest
{
    /**
     * 
     */
    public $serialVersionUID = -6.9496097325023E+18;
    /** 发送微博确认页面URL定义  **/
    public $QQ_MICROBLOG_URL = "/gateway/microBlogSendConfirm.htm";

    public function MicroBlogSendRequest($secretKey)
    {
        parent::__construct(secretKey);
    }

    public function toHTML()
    {
        $microBlogContent = parent::getParameter("content");

        if ($microBlogContent == "") {
            throw Exception("microBlogContent不能为空!");
        }

        $stringBuilder = "<link href=\"https://wallet.tenpay.com/mblog/css/release_button.css\" rel=\"stylesheet\" type=\"text/css\" />";
        $stringBuilder = "<a href=\"" . $this->getURL() . "\" target=\"_blank\" class=\"release-txmblog\" title=\"转播到腾讯微博\"><span>转播到腾讯微博</span></a>";
        return $stringBuilder;
    }

    public function getURL()
    {
        $fromUrl = parent::getParameter("fromUrl");

        if ($fromUrl == NULL) {
            parent::setParameter("fromUrl", $this->getRequestURL(request));
        }

        $paraString = parent::genParaStr();
        $domain = parent::getDomain();
        return $domain . $this->QQ_MICROBLOG_URL . "?" . $paraString;
    }

    public function getRequestURL($request)
    {
        if ($_SERVER["HTTPS"] != "") {
            $builder = "https://" . $_SERVER["SERVER_NAME"];
        }
        else {
            $builder = "http://" . $_SERVER["SERVER_NAME"];
        }

        if ((0 < $_SERVER["SERVER_PORT"]) && ($_SERVER["SERVER_PORT"] != 80)) {
            $builder = $builder . ":" . $_SERVER["SERVER_PORT"];
        }

        $builder = $_SERVER["SERVER_NAME"];
        return $builder;
    }

    public function getInputCharset()
    {
        return parent::getInputCharset();
    }

    public function setParameter($key, $value)
    {
        parent::setParameter($key, $value);
    }

    public function send()
    {
        throw new Exception();
    }
}

require_once "common/CommonRequest.class.php";
require_once "common/CommonResponse.class.php";
require_once "common/SDKRuntimeException.class.php";

?>
