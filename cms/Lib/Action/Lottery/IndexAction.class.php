<?php

class IndexAction extends BaseAction
{
    public function index()
    {
        $index_right_adver = D("Adver")->get_adver_by_key("index_right", 3);
        $this->assign("index_right_adver", $index_right_adver);
        $web_index_slider = D("Slider")->get_slider_by_key("web_slider");
        $this->assign("web_index_slider", $web_index_slider);
        $all_category_list = D("Group_category")->get_category();
        $this->assign("all_category_list", $all_category_list);
        $order = ($_GET["order"] && $_GET["order"] ? htmlspecialchars($_GET["order"]) : "id");
        $attrs = $_GET["attrs"];
        $area_url = ($_GET["area_url"] && $_GET["area_url"] ? htmlspecialchars($_GET["area_url"]) : "all");
        $cat_url = (isset($_GET["cat_url"]) ? $_GET["cat_url"] : "all");

        if ($area_url != "all") {
            $tmp_area = D("Area")->get_area_by_areaUrl($area_url, $cat_url, "meal");

            if (empty($tmp_area)) {
                $this->error("当前区域不存在！");
            }

            if ($tmp_area["area_type"] == 3) {
                $now_area = $tmp_area;
            }
            else {
                $now_circle = $tmp_area;
                $this->assign("now_circle", $now_circle);
                $now_area = D("Area")->get_area_by_areaId($tmp_area["area_pid"], true, $cat_url, "meal");

                if (empty($tmp_area)) {
                    $this->error("当前区域不存在！");
                }

                $circle_url = $now_circle["area_url"];
                $area_url = $now_area["area_url"];
            }

            $area_id = $now_area["area_id"];
            $circle_list = D("Area")->get_arealist_by_areaPid($now_area["area_id"], true, $cat_url, "meal");
            if (!empty($now_circle) && !empty($circle_list)) {
                foreach ($circle_list as &$value ) {
                    if ($value["area_id"] == $now_circle["area_id"]) {
                        $vlaue["is_hover"] = true;
                    }
                }
            }

            $this->assign("now_area", $now_area);
            $this->assign("circle_list", $circle_list);
            $now_area = D("Area")->get_area_by_areaUrl($area_url, $cat_url, "meal");

            if (empty($now_area)) {  //反转
                $this->error("当前区域不存在！");
            }

            $area_id = $now_area["area_id"];
        }
        else {
            $area_id = 0;
        }

        $index_top_adver = D("Adver")->get_adver_by_key("index_top");
        $this->assign("index_top_adver", $index_top_adver);
        $all_area_list = D("Area")->get_area_list("", "", "meal");
        $this->assign("all_area_list", $all_area_list);
        $category_list = array();
        $category_list["all"] = array("cat_name" => "全部", "cat_url" => "all", "cat_id" => 0);
        $category_list["lottery"] = array("cat_name" => "大转盘", "cat_url" => "lottery", "cat_id" => 1);
        $category_list["guajiang"] = array("cat_name" => "刮刮卡", "cat_url" => "guajiang", "cat_id" => 2);
        $category_list["luckyfruit"] = array("cat_name" => "水果达人", "cat_url" => "luckyfruit", "cat_id" => 4);
        $category_list["goldenegg"] = array("cat_name" => "砸金蛋", "cat_url" => "goldenegg", "cat_id" => 5);
        $cat_option_list[] = array("txt_desc" => "分类", "row_type" => "category", "category_list" => $category_list);
        $cat_id = 0;
        if (($cat_url != "all") && $category_list[$cat_url]) {
            $this->assign("now_category", $category_list[$cat_url]);
            $cat_id = $category_list[$cat_url]["cat_id"];
        }

        array_unshift($all_area_list, array("area_name" => "全部", "area_url" => "all"));
        $cat_option_list[] = array("txt_desc" => "区域", "row_type" => "area", "area_list" => $all_area_list);
        $this->assign("default_url", C("config.site_url") . "/lottery/all/all");
        $this->assign(D("Lottery")->get_list_by_option($area_id, $order, $cat_id));
        $cat_option_html = $this->get_cat_option_html($cat_option_list, $cat_url, $area_url, $circle_url, $order, $attrs);
        $this->assign("cat_option_html", $cat_option_html);
        $cat_sort_url = $this->get_cat_sort_url($cat_url, $area_url, $attrs);
        $this->assign($cat_sort_url);
        $this->display();
    }

    protected function get_cat_option_html($cat_option_list, $cat_url, $area_url, $circle_url, $order, $attrs)
    {
        if (!empty($attrs)) {
            $attr_tmp_arr = explode(";", $attrs);

            if (!empty($attr_tmp_arr)) {
                foreach ($attr_tmp_arr as $key => $value ) {
                    $attr_tmp_value = explode(":", $value);
                    $attrs_arr[$attr_tmp_value[0]] = $attr_tmp_value[1];
                }
            }
        }

        $cat_option_html = "";

        foreach ($cat_option_list as $key => $value ) {
            $cat_option_html .= "<div class=\"filter-label-list filter-section category-filter-wrapper log-mod-viewed " . ($key == 0 ? "first-filter" : "") . ($value["row_type"] == "custom_1" ? "filter-sect--multi" : "") . "\">";
            $cat_option_html .= "<div class=\"label has-icon\">" . $value["txt_desc"] . "：</div>";
            $cat_option_html .= "<ul class=\"filter-sect-list\">";

            if ($value["row_type"] == "category") {
                foreach ($value["category_list"] as $k => $v ) {
                    $cat_option_html .= "<li class=\"item" . ($cat_url == $v["cat_url"] ? " current" : "") . "\"><a " . ($v["is_hot"] ? "class=\"briber\"" : "") . " href=\"" . $this->get_cat_option_url($v["cat_url"], $area_url, $order, $attrs) . "\">" . $v["cat_name"] . "</a></li>";
                }
            }
            else if ($value["row_type"] == "area") {
                foreach ($value["area_list"] as $k => $v ) {
                    $cat_option_html .= "<li " . ($area_url == $v["area_url"] ? "class=\"current\"" : "") . "><a href=\"" . $this->get_cat_option_url($cat_url, $v["area_url"], $order, $attrs) . "\">" . $v["area_name"] . "</a></li>";
                }
            }
            else if ($value["row_type"] == "custom_0") {
                foreach ($value["attr_arr"] as $k => $v ) {
                    $cat_option_html .= "<li " . ((($attrs_arr[$value["custom_field"]] === NULL) && ($v["value"] == "-1")) || (($attrs_arr[$value["custom_field"]] !== NULL) && ($attrs_arr[$value["custom_field"]] == $v["value"])) ? "class=\"current\"" : "") . "><a href=\"" . $this->get_cat_option_url($cat_url, $area_url, $order, $v["url"]) . "\">" . $v["name"] . "</a></li>";
                }
            }
            else if ($value["row_type"] == "custom_1") {
                if ($attrs_arr[$value["custom_field"]] !== NULL) {
                    $custom_field_arr = explode(",", $attrs_arr[$value["custom_field"]]);
                }

                foreach ($value["attr_arr"] as $k => $v ) {
                    $cat_option_html .= "<li><a class=\"inline-block checkbox " . (in_array($k, $custom_field_arr) ? "checkbox-checked" : "") . "\" href=\"" . $this->get_cat_option_url($cat_url, $area_url, $order, $v["url"]) . "\">" . $v["name"] . "</a></li>";
                }
            }
            else if ($value["row_type"] == "circle") {
                foreach ($value["circle_list"] as $k => $v ) {
                    if ($v && $circle_url) {
                        $tmp_current = true;
                        $v["area_url"] = $area_url;
                    }
                    else if ($circle_url == $v["area_url"]) {
                        $tmp_current = true;
                    }
                    else {
                        $tmp_current = false;
                    }

                    $v["area_url"] = ($v["area_url"] ? $area_url : $v["area_url"]);
                    $cat_option_html .= "<li " . ($tmp_current ? "class=\"current\"" : "") . "><a href=\"" . $this->get_cat_option_url($cat_url, $v["area_url"], $order, $attrs) . "\">" . $v["area_name"] . "</a></li>";
                }
            }

            $cat_option_html .= "</ul>";
            $cat_option_html .= "</div>";
        }

        return $cat_option_html;
    }

    protected function get_cat_option_url($cat_url, $area_url, $order, $attrs)
    {
        if ($order) {
            if ($attrs) {
                return C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url . "/" . $order . "?attrs=" . urlencode($attrs);
            }
            else {
                return C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url . "/" . $order;
            }
        }
        else if ($attrs) {
            return C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url . "?attrs=" . urlencode($attrs);
        }
        else {
            return C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url;
        }
    }

    protected function get_cat_sort_url($cat_url, $area_url, $attrs)
    {
        if ($attrs) {
            $return["default_sort_url"] = C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url . "?attrs=" . urlencode($attrs);
            $return["time_sort_url"] = C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url . "/time?attrs=" . urlencode($attrs);
        }
        else {
            $return["default_sort_url"] = C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url;
            $return["time_sort_url"] = C("config.site_url") . "/lottery/" . $cat_url . "/" . $area_url . "/time";
        }

        return $return;
    }
}


?>
