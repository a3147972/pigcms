<?php

class Page
{
    public $rollPage = 5;
    public $parameter;
    public $url = "";
    public $listRows = 20;
    public $firstRow;
    protected $totalPages;
    protected $totalRows;
    protected $nowPage;
    protected $coolPages;
    protected $config = array("header" => "条记录", "prev" => "上一页", "next" => "下一页", "first" => "第一页", "last" => "最后一页", "theme" => " %totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%");
    protected $varPage;

    public function __construct($totalRows, $listRows, $parameter, $url)
    {
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        $this->varPage = C("VAR_PAGE") ? C("VAR_PAGE") : "p";

        if (!empty($listRows)) {
            $this->listRows = intval($listRows);
        }

        $this->totalPages = ceil($this->totalRows / $this->listRows);
        $this->coolPages = ceil($this->totalPages / $this->rollPage);
        $this->nowPage = !empty($_GET[$this->varPage]) ? intval($_GET[$this->varPage]) : 1;

        if ($this->nowPage < 1) {
            $this->nowPage = 1;
        }
        else {
            if (!empty($this->totalPages) && ($this->totalPages < $this->nowPage)) {
                $this->nowPage = $this->totalPages;
            }
        }

        $this->firstRow = $this->listRows * ($this->nowPage - 1);
    }

    public function setConfig($name, $value)
    {
        if ($this->config[$name]) {
            $this->config[$name] = $value;
        }
    }

    public function show()
    {
        if (0 == $this->totalRows) {
            return "";
        }

        $p = $this->varPage;
        $nowCoolPage = ceil($this->nowPage / $this->rollPage);

        if ($this->url) {
            $depr = C("URL_PATHINFO_DEPR");
            $url = rtrim(U("/" . $this->url, "", false), $depr) . $depr . "__PAGE__";
        }
        else {
            if ($this->parameter && is_string($this->parameter)) {
                parse_str($this->parameter, $parameter);
            }
            else if (is_array($this->parameter)) {
                $parameter = $this->parameter;
            }
            else if ($this->parameter) {
                unset($_GET[C("VAR_URL_PARAMS")]);
                $var = (!$_POST ? $_POST : $_GET);

                if ($var) {
                    $parameter = array();
                }
                else {
                    $parameter = $var;
                }
            }

            $parameter[$p] = "__PAGE__";
            $url = U("", $parameter);
        }

        $upRow = $this->nowPage - 1;
        $downRow = $this->nowPage + 1;

        if (0 < $upRow) {
            $upPage = "<a href='" . str_replace("__PAGE__", $upRow, $url) . "'>" . $this->config["prev"] . "</a>";
        }
        else {
            $upPage = "";
        }

        if ($downRow <= $this->totalPages) {
            $downPage = "<a href='" . str_replace("__PAGE__", $downRow, $url) . "'>" . $this->config["next"] . "</a>";
        }
        else {
            $downPage = "";
        }

        if ($nowCoolPage == 1) {
            $theFirst = "";
            $prePage = "";
        }
        else {
            $preRow = $this->nowPage - $this->rollPage;
            $prePage = "<a href='" . str_replace("__PAGE__", $preRow, $url) . "' >上" . $this->rollPage . "页</a>";
            $theFirst = "<a href='" . str_replace("__PAGE__", 1, $url) . "' >" . $this->config["first"] . "</a>";
        }

        if ($nowCoolPage == $this->coolPages) {
            $nextPage = "";
            $theEnd = "";
        }
        else {
            $nextRow = $this->nowPage + $this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a href='" . str_replace("__PAGE__", $nextRow, $url) . "' >下" . $this->rollPage . "页</a>";
            $theEnd = "<a href='" . str_replace("__PAGE__", $theEndRow, $url) . "' >" . $this->config["last"] . "</a>";
        }

        $linkPage = "";

        for ($i = 1; $i <= $this->rollPage; $i++) {
            $page = (($nowCoolPage - 1) * $this->rollPage) + $i;

            if ($page != $this->nowPage) {
                if ($page <= $this->totalPages) {
                    $linkPage .= "<a href='" . str_replace("__PAGE__", $page, $url) . "'>" . $page . "</a>";
                }
                else {
                    break;
                }
            }
            else if ($this->totalPages != 1) {
                $linkPage .= "<span class='current'>" . $page . "</span>";
            }
        }

        $pageStr = str_replace(array("%header%", "%nowPage%", "%totalRow%", "%totalPage%", "%upPage%", "%downPage%", "%first%", "%prePage%", "%linkPage%", "%nextPage%", "%end%"), array($this->config["header"], $this->nowPage, $this->totalRows, $this->totalPages, $upPage, $downPage, $theFirst, $prePage, $linkPage, $nextPage, $theEnd), $this->config["theme"]);
        return $pageStr;
    }
}


?>
