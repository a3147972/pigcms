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
        $this->nowPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        $this->listRows = $listRows;
        $this->totalPage = ceil($totalRows / $listRows);
        if (($this->totalPage < $this->nowPage) && (0 < $this->totalPage)) {
            $this->nowPage = $this->totalPage;
        }

        $this->firstRow = $listRows * ($this->nowPage - 1);
    }

    public function show()
    {
        if ($this->totalRows == 0) {
            return false;
        }

        $now = $this->nowPage;
        $total = $this->totalPage;
        $url = $_SERVER["REQUEST_URI"] . (strpos($_SERVER["REQUEST_URI"], "?") ? "" : "?");
        $parse = parse_url($url);

        if ($parse["query"]) {
            parse_str($parse["query"], $params);
            unset($params["page"]);
            $url = $parse["path"] . "?" . http_build_query($params);
        }

        $url .= "&page=";
        $str = "<div class=\"summary\">" . $this->totalRows . " 条记录 " . $now . "/" . $total . "页</div>";
        $str .= "<div class=\"pager\">";
        $str .= "<ul class=\"pagination\" id=\"yw1\">";

        if (1 < $now) {
            $str .= "<li class=\"prev\"><a href=\"" . $url . ($now - 1) . "\"><i class=\"ace-icon fa fa-angle-double-left\"></i></a></li>";
        }

        if (($now != 1) && (4 < $now) && (6 < $total)) {
            $str .= "<li class=\"page\"> … </li>";
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
                    $str .= "<li class=\"page\"><a href=\"" . $url . $page . "\" title=\"第" . $page . "页\">" . $page . "</a></li>";
                }
                else {
                    break;
                }
            }
            else if ($page == $now) {
                $str .= "<li class=\"page active\"><a href=\"" . $url . $page . "\" title=\"第" . $page . "页\">" . $page . "</a></li>";
            }
        }

        if (($total != $now) && ($now < ($total - 5)) && (10 < $total)) {
            $str .= "<li class=\"page\"> … </li><li><a href=\"" . $url . $total . "\" title=\"第" . $total . "页\">" . $total . "</a></li>";
        }

        if ($now != $total) {
            $str .= "<li class=\"next\"><a href=\"" . $url . ($now + 1) . "\"><i class=\"ace-icon fa fa-angle-double-right\"></i></a></li>";
        }

        $str .= "</ul>";
        $str .= "</div>";
        return $str;
    }
}


?>
