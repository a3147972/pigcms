<?php

class HttpClientUtil
{
    public $_fp;
    public $_url;
    public $_host;
    public $_protocol;
    public $_uri;
    public $_port;

    public function httpClientCall($allUrl, $charset)
    {
        $this->_url = $allUrl;
        $this->_scan_url();
        $crlf = "\r\n";
        $response = "";
        $req = "GET " . $this->_uri . " HTTP/1.0" . $crlf . "Host: " . $this->_host . $crlf . $crlf;

        try {
            $this->_fp = fsockopen(($this->_protocol == "https" ? "ssl://" : "") . $this->_host, $this->_port);
            fwrite($this->_fp, $req);
            while (is_resource($this->_fp) && $this->_fp && !feof($this->_fp)) {
                $response .= fread($this->_fp, 1024);
            }
        }
        catch (Exception $e) {
            fclose($this->_fp);
            throw new SDKRuntimeException(("http请求失败:" + $e) . getMessage());
        }
        catch (SDKRuntimeException $e) {
            exit($e->errorMessage());
        }

        $pos = ($response, $crlf . $crlf);

        if ($pos === false) {
            return $response;
        }

        $header = substr($response, 0, $pos);
        $body = substr($response, $pos + (2 * strlen($crlf)));
        $headers = array();
        $lines = explode($crlf, $header);

        foreach ($lines as $line ) {
            if (($pos = strpos($line, ":")) !== false) {
                $headers[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos + 1));
            }
        }

        if ($headers["location"]) {
            $http = new HTTPRequest($headers["location"]);
            return $http->DownloadToString($http);
        }
        else {
            return $body;
        }
    }

    public function _scan_url()
    {
        $req = $this->_url;
        $pos = strpos($req, "://");
        $this->_protocol = strtolower(substr($req, 0, $pos));
        $req = substr($req, $pos + 3);
        $pos = strpos($req, "/");

        if ($pos === false) {
            $pos = strlen($req);
        }

        $host = substr($req, 0, $pos);

        if (strpos($host, ":") !== false) {
            $this->_port = explode(":", $host)[1];
            $this->_host = explode(":", $host)[0];
        }
        else {
            $this->_host = $host;
            $this->_port = $this->_protocol == "https" ? 443 : 80;
        }

        $this->_uri = substr($req, $pos);

        if ($this->_uri == "") {
            $this->_uri = "/";
        }
    }
}


?>
