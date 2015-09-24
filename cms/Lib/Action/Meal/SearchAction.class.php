<?php

class SearchAction extends BaseAction
{
    public function index()
    {
        $w = htmlspecialchars($_REQUEST["w"]);
        $this->assign("keywords", $w);
        $index_right_adver = D("Adver")->get_adver_by_key("index_right", 3);
        $this->assign("index_right_adver", $index_right_adver);
        $web_index_slider = D("Slider")->get_slider_by_key("web_slider");
        $this->assign("web_index_slider", $web_index_slider);
        $all_category_list = D("Group_category")->get_category();
        $this->assign("all_category_list", $all_category_list);
        $order = ($_GET["order"] && $_GET["order"] ? htmlspecialchars($_GET["order"]) : "");
        $index_top_adver = D("Adver")->get_adver_by_key("index_top");
        $this->assign("index_top_adver", $index_top_adver);
        $return = D("Merchant_store")->get_list_by_search($w, $order);

        if (empty($return["group_list"])) { //反转
            $merchant_list = D("Merchant_store")->get_hot_list(6);
            $this->assign("merchant_list", $merchant_list);
        }
        else {
            $this->assign($return);
        }

        $cat_sort_url = $this->get_cat_sort_url($w);
        $this->assign($cat_sort_url);
        $this->display();
    }

    protected function get_cat_sort_url($keyword)
    {
        $return["default_sort_url"] = C("config.site_url") . "/meal/search/" . $keyword;
        $return["hot_sort_url"] = C("config.site_url") . "/meal/search/" . $keyword . "/hot";
        $return["price_asc_sort_url"] = C("config.site_url") . "/meal/search/" . $keyword . "/price-asc";
        $return["price_desc_sort_url"] = C("config.site_url") . "/meal/search/" . $keyword . "/price-desc";
        $return["rating_sort_url"] = C("config.site_url") . "/meal/search/" . $keyword . "/rating";
        $return["time_sort_url"] = C("config.site_url") . "/meal/search/" . $keyword . "/time";
        return $return;
    }
}


?>
