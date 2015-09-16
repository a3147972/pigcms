<?php

class DeliveryAddressQueryRespone extends CommonResponse
{
    public $deliveryAddresss = array();

    public function DeliveryAddressQueryRespone($xml, $charset)
    {
        $this->CommonResponse($xml, $charset, NULL, true, false);
        $this->parseDeliveryAddress($xml, $charset);
    }

    public function getUser_id()
    {
        return $this->getParameter("user_id");
    }

    public function getApp_id()
    {
        return $this->getParameter("appid");
    }

    public function getDeliveryAddresss()
    {
        return $this->deliveryAddresss;
    }

    public function setDeliveryAddresss($deliveryAddresss)
    {
        $this->deliveryAddresss = $deliveryAddresss;
    }

    public function parseDeliveryAddress($xml, $charset)
    {
        $doc = NULL;
        $xmlUtil = new XmlParseUtil();

        try {
            $doc = $xmlUtil->parseDoc($xml, $charset);
        }
        catch (Exception $e) {
            throw new SDKRuntimeException("解析xml失败:" . $xml . "," . $e);
        }

        $addresss = array();
        $root = $doc->documentElement;

        foreach ($root->childNodes as $node ) {
            if ($node->nodeName == "addressInfos") {
                foreach ($node->childNodes as $child ) {
                    if ($child->nodeName == "item") {
                        $node = $child;
                        $deliveryAddressInfo = new DeliveryAddressInfo();

                        foreach ($node->childNodes as $child ) {
                            $value = iconv("UTF-8", $charset, $child->nodeValue);
                            $this->setAddressInfoAttr($deliveryAddressInfo, $child->nodeName, $value);
                        }

                        array_push($addresss, $deliveryAddressInfo);
                    }
                }
            }
        }

        $this->setDeliveryAddresss($addresss);
    }

    public function setAddressInfoAttr($deliveryAddressInfo, $nodeName, $textContent)
    {
        if (strcmp("address", $nodeName) == 0) {
            $deliveryAddressInfo->setAddress($textContent);
        }

        if (strcmp("mobilePhone", $nodeName) == 0) {
            $deliveryAddressInfo->setMobilePhone($textContent);
        }

        if (strcmp("name", $nodeName) == 0) {
            $deliveryAddressInfo->setName($textContent);
        }

        if (strcmp("telPhone", $nodeName) == 0) {
            $deliveryAddressInfo->setTelPhone($textContent);
        }

        if (strcmp("zipCode", $nodeName) == 0) {
            $deliveryAddressInfo->setZipCode($textContent);
        }
    }
}

require_once "common/CommonResponse.class.php";
require_once "common/util/XmlParseUtil.php";
require_once "DeliveryAddressInfo.class.php";

?>
