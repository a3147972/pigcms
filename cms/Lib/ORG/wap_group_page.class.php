<?php

class Page
{
    public $firstRow;
    public $nowPage;
    public $totalPage;
    public $totalRows;
    public $page_rows;
    public $page_val;

    public function __construct($totalRows, $listRows, $page_val)
    {
        $this->totalRows = $totalRows;
        $this->nowPage = !empty($_GET[$page_val]) ? intval($_GET[$page_val]) : 1;//手机团购不显示 原因 !empty
        $this->listRows = $listRows;
        $this->page_val = $page_val;
        $this->totalPage = ceil($totalRows / $listRows);
        if (($this->totalPage < $this->nowPage) && (0 < $this->totalPage)) {
            $this->nowPage = $this->totalPage;
        }

        $this->firstRow = $listRows * ($this->nowPage - 1);
    }

    public function show()
    {
        if ($this->totalPage < 2) {
            return false;
        }

        $now = $this->nowPage;
        $total = $this->totalPage;
        $page_val = $this->page_val;
        $url = $_SERVER["REQUEST_URI"] . (strpos($_SERVER["REQUEST_URI"], "?") ? "" : "?");
        $parse = parse_url($url);

        if ($parse["query"]) {
            parse_str($parse["query"], $params);
            unset($params[$page_val]);

            if (!empty($params)) {
                $url = $parse["path"] . "?" . http_build_query($params) . "&" . $page_val . "=";
            }
            else {
                $url = $parse["path"] . "?" . $page_val . "=";
            }
        }
        else {
            $url .= "" . $page_val . "=";
        }

        $str .= "";

        if (1 < $now) {
            $str .= "<a href=\"" . $url . ($now - 1) . "\" class=\"btn btn-weak\">上一页</a>";
        }
        else {
            $str .= "<a class=\"btn btn-weak btn-disabled\">上一页</a>";
        }

        $str .= "&nbsp;<span class=\"pager-current\">" . $now . "</span>&nbsp;";

        if ($now != $total) {
            $str .= "<a href=\"" . $url . ($now + 1) . "\" class=\"btn btn-weak\">下一页</a>";
        }
        else {
            $str .= "<a class=\"btn btn-weak btn-disabled\">下一页</a>";
        }

        return $str;
    }
}


?>
