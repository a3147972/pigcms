<?php

class CommonUtil
{
    public function genAllUrl($toURL, $paras)
    {
        $allUrl = NULL;

        if (NULL == $toURL) {
            exit("toURL is null");
        }

        if (strripos($toURL, "?") == "") {
            $allUrl = $toURL . "?" . $paras;
        }
        else {
            $allUrl = $toURL . "&" . $paras;
        }

        return $allUrl;
    }

    public function splitParaStr($src, $token)
    {
        $resMap = array();
        $items = explode($token, $src);

        foreach ($items as $item ) {
            $paraAndValue = explode("=", $item);

            if ($paraAndValue != "") {
                $resMap[$paraAndValue[0]] = $parameterValue[1];
            }
        }

        return $resMap;
    }

    public function trimString($value)
    {
        $ret = NULL;

        if (NULL != $value) {
            $ret = $value;

            if (strlen($ret) == 0) {
                $ret = NULL;
            }
        }

        return $ret;
    }

    public function formatQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);

        foreach ($paraMap as $k => $v ) {
            if ((NULL != $v) && ("null" != $v) && ("sign" != $k)) {
                if ($urlencode) {
                    $v = urlencode($v);
                }

                $buff .= $k . "=" . $v . "&";
            }
        }

        if (0 < strlen($buff)) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }

        return $reqPar;
    }
}


?>
