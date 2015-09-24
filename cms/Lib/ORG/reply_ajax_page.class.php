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
        $this->nowPage = !$_POST["page"] ? intval($_POST["page"]) : 1;
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

        if ($total == 1) {
            return false;
        }

        $str = "";

        if (1 < $now) {
            $str .= "<li class=\"first-page\"><a href=\"javascript:void(0);\" data-index=\"1\">首页</a></li>";
        }
        else {
            $str .= "<li class=\"first-page\"><span>首页</span></li>";
        }

        if (1 < $now) {
            $str .= "<li class=\"previous\"><a href=\"javascript:void(0);\" data-index=\"" . $url . ($now - 1) . "\">上一页<i class=\"tri\"></i></a></li>";
        }
        else {
            $str .= "<li class=\"previous\"><span><i class=\"tri disable\"></i>上一页</span></li>";
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
                    $str .= "<li><a href=\"javascript:void(0);\" data-index=\"" . $page . "\">" . $page . "</a></li>";
                }
                else {
                    break;
                }
            }
            else if ($page == $now) {
                $str .= "<li class=\"current\"><span data-index=\"" . $page . "\">" . $page . "</span></li>";
            }
        }

        if ($now != $total) {
            $str .= "<li class=\"next\"><a href=\"javascript:void(0);\" data-index=\"" . ($now + 1) . "\">下一页<i class=\"tri\"></i></a></li>";
            $str .= "<li class=\"last-page\"><a href=\"javascript:void(0);\" data-index=\"" . $total . "\">尾页</a></li>";
        }
        else {
            $str .= "<li class=\"next\"><span>下一页<i class=\"tri disable\"></i></span></li>";
            $str .= "<li class=\"last-page\"><span>尾页</span></li>";
        }

        $str .= "</ul>";
        $str .= "</div>";
        return $str;
    }
}


?>
