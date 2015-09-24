<?php

class Page
{
    public $firstRow;
    public $nowPage;
    public $totalPage;
    public $totalRows;
    public $page_rows;

    public function __construct($totalRows, $listRows)
    {
        $this->totalRows = $totalRows;
        $this->nowPage = !empty($_GET["page"]) ? intval($_GET["page"]) : 1;
        $this->listRows = $listRows;
        $this->totalPage = ceil($totalRows / $listRows);
        if (($this->totalPage < $this->nowPage) && (0 < $this->totalPage)) {
            $this->nowPage = $this->totalPage;
        }

        $this->firstRow = $listRows * ($this->nowPage - 1);
    }

    public function show()
    {
        if ($this->totalRows <= 1) {
            return false;
        }

        $now = $this->nowPage;
        $total = $this->totalPage;
        $url = $_SERVER["REQUEST_URI"] . (strpos($_SERVER["REQUEST_URI"], "?") ? "" : "?");
        $parse = parse_url($url);

        if ($parse["query"]) {
            parse_str($parse["query"], $params);
            unset($params["page"]);
 
            if (!empty($params)) { //反转
                $url = $parse["path"] . "?" . http_build_query($params) . "&page=";
            }
            else {
                $url = $parse["path"] . "?page=";
            }
        }
        else {
            $url .= "page=";
        }

        $str .= "<div class=\"paginator-wrapper\">";
        $str .= "<ul class=\"paginator paginator--notri\">";

        if (2 < $now) {
            $str .= "<li class=\"previous\"><a href=\"" . $url . "1\">首页</a></li>";
        }

        if (1 < $now) {
            $str .= "<li class=\"previous\"><a href=\"" . $url . ($now - 1) . "\"><i class=\"tri\"></i>上一页</a></li>";
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($now <= 1) {
                $page = $i;
            }
            else if (($total - 1) < $now) {
                $page = ($total - 5) + $i;
            }
            else {
                $page = ($now - 3) + $i;
            }

            if (($page != $now) && (0 < $page)) {
                if ($page <= $total) {
                    $str .= "<li><a href=\"" . $url . $page . "\" title=\"第" . $page . "页\">" . $page . "</a></li>";
                }
                else {
                    break;
                }
            }
            else if ($page == $now) {
                $str .= "<li class=\"current\"><a>" . $page . "</a></li>";
            }
        }

        if ($now != $total) {
            $str .= "<li class=\"next\"><a href=\"" . $url . ($now + 1) . "\"><i class=\"tri\"></i>下一页</a></li>";
            $str .= "<li class=\"next\"><a href=\"" . $url . $total . "\"><i class=\"tri\"></i>尾页</a></li>";
        }

        $str .= "</ul>";
        $str .= "</div>";
        return $str;
    }
}


?>
