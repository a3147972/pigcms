<?php

class SearchAction extends BaseAction
{
    public function index()
    {
        if ($_GET["type"]) {
        }

        $type = ($_GET["type"] == "meal" ? 1 : 0);
        $search_hot_list = D("Search_hot")->get_list(18, $type, true);
        $this->assign("search_hot_list", $search_hot_list);
        $this->display();
    }

    public function group()
    {
        $keywords = htmlspecialchars($_REQUEST["w"]);
        $this->assign("keywords", $keywords);
        $sort = (empty($_GET["sort"]) ? "default" : $_GET["sort"]);
        $this->assign("now_sort", $sort);
        $group_return = D("Group")->get_group_list_by_keywords($keywords, $sort, true);
        
        if (empty($group_return["group_list"])) {
            $index_sort_group_list = D("Group")->get_group_list("index_sort", 6);
            $this->assign("index_sort_group_list", $index_sort_group_list);
        }
        else {
            $this->assign($group_return);
        }

        $this->display();
    }

    public function meal()
    {
        $keywords = htmlspecialchars($_REQUEST["w"]);
        $this->assign("keywords", $keywords);
        $sort = (empty($_GET["sort"]) ? "default" : $_GET["sort"]);
        $this->assign("now_sort", $sort);
        $return = D("Merchant_store")->get_list_by_search($keywords, $sort, true);
        
        if (empty($return["group_list"])) {
        }
        else {
            $this->assign($return);
        }

        $this->assign($return);
        $this->display();
    }
}


?>
