<?php

class XmlParseUtil
{
    public function parseDoc($xmlStr, $charsetName)
    {
        $dom = new DOMDocument("1.0", $charsetName);
        $dom->loadXML($xmlStr);
        return $dom;
    }

    public function openapiXmlToMapByDoc($doc, $charset)
    {
        $doc->normalize();
        $root = $doc->documentElement;
        $nodeList = $root->childNodes;
        return $this->openapiXmlToMapByNodeList($nodeList, $charset);
    }

    public function openapiXmlToMapByNodeList($nodeList, $charset)
    {
        $hashMap = array();

        if (!empty($nodeList)) { //反转
            foreach ($nodeList as $e ) {
                if ($e->nodeType == XML_ELEMENT_NODE) {
                    $value = iconv("UTF-8", $charset, $e->nodeValue);
                    $hashMap[$e->nodeName] = $value;
                }
            }
        }

        return $hashMap;
    }

    public function openapiXmlToMap($xml, $charset)
    {
        $stringDOM = new DOMDocument();

        try {
            @stringDOM->loadXML($xml);
            return $this->openapiXmlToMapByDoc($stringDOM, $charset);
        }
        catch (Exception $e) {
            throw new SDKRuntimeException("解析xml失败:" . $xml . "," . $e . "<br>");
        }
    }

    public function getSingleValue($doc, $tagName)
    {
        $tmp_tag = $doc->getElementsByTagName($TagName);
        $tmp_value = $tmp_tag->nodeValue;
        return iconv("UTF-8", "GBK", $tmp_value);
    }
}


?>
