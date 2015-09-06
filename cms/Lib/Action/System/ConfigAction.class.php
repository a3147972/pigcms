<?php

class ConfigAction extends BaseAction
{
    public function index()
    {
        $database_config_group = d('Config_group');

        if (empty($_GET['galias'])) {
			$condition_config_group['status'] = '1';
		}

		$group_list = $database_config_group->field(true)->where($condition_config_group)->order('`gsort` DESC,`gid` ASC')->select();
		
		$this->assign('group_list', $group_list);

		if (empty($_GET['galias'])) {
			$gid = $this->_get('gid');
		}
		else {
			foreach ($group_list as $value) {	
				
				if($_GET['galias'] == $value['galias']){
					$gid = $value['gid'];
				}
			}

			$header_file = $_GET['header'];
			$this->assign('header_file', $header_file);
		}

		if (empty($gid)) {
			$gid = $group_list[0]['gid'];
		}

        $this->assign("gid", $gid);
        $database_config = D("Config");
        $condition_config["gid"] = $gid;
        $condition_config["status"] = "1";
        $tmp_config_list = $database_config->where($condition_config)->order("`sort` DESC")->select();
		//dump($tmp_config_list);
        foreach ($tmp_config_list as $key => $value ) {
            $config_list[$value["tab_id"]]["name"] = $value["tab_name"];
            $config_list[$value["tab_id"]]["list"][] = $value;
        }

        $this->assign($this->build_html($config_list));
        $this->display();
    }

    public function amend()
    {
        if (IS_POST) {
            $database_config = D("Config");

            foreach ($_POST as $key => $value ) {
                $data["name"] = $key;
                $data["value"] = trim(stripslashes(htmlspecialchars_decode($value)));
                $database_config->data($data)->save();

                if ($key == "wechat_sourceid") {
                    $data["name"] = "wechat_token";
                    $data["value"] = md5("pigcms_wechat_token" . $data["value"]);
                    $database_config->data($data)->save();
                }
            }

            S(C("now_city") . "config", NULL);
            $this->success("修改成功!");
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }

    public function show()
    {
        $config = D("Config")->get_config();
        $this->display();
    }

    protected function build_html($config_list)
    {
        if (is_array($config_list)) {
            $config_html = "";

            if (1 < count($config_list)) {
                $has_tab = true;
            }

            if ($has_tab) {
                $config_tab_html = "<ul class=\"tab_ul\">";
            }

            $pigcms_auto_key = 1;

            foreach ($config_list as $pigcms_key => $pigcms_value ) {
                if ($has_tab) {
                    
                    $config_tab_html .= "<li " . ($pigcms_auto_key == 1 ? "class=\"active\"" : "") . "><a data-toggle=\"tab\" href=\"#tab_" . $pigcms_key . "\">" . $pigcms_value["name"] . "</a></li>";
                }

                $config_html .= "<table cellpadding=\"0\" cellspacing=\"0\" class=\"table_form\" width=\"100%\" style=\"display:none;\" id=\"tab_" . $pigcms_key . "\">";

                foreach ($pigcms_value["list"] as $key => $value ) {
                    $tmp_type_arr = explode("&", $value["type"]);
                    $type_arr = array();

                    foreach ($tmp_type_arr as $k => $v ) {
                        $tmp_value = explode("=", $v);
                        $type_arr[$tmp_value[0]] = $tmp_value[1];
                    }

                    $config_html .= "<tr>";
                    $config_html .= "<th width=\"160\">" . $value["info"] . "：</th>";
                    $config_html .= "<td>";

                    if ($type_arr["type"] == "text") {
                        $size = (!$type_arr["size"] ? $type_arr["size"] : "60");
                        $config_html .= "<input type=\"text\" class=\"input-text\" name=\"" . $value["name"] . "\" id=\"config_" . $value["name"] . "\" value=\"" . $value["value"] . "\" size=\"" . $size . "\" validate=\"" . $type_arr["validate"] . "\" tips=\"" . $value["desc"] . "\"/>";
                    }
                    else if ($type_arr["type"] == "textarea") {
                        $rows = (!empty($type_arr["rows"]) ? $type_arr["rows"] : "4");
                        $cols = (!empty($type_arr["cols"])   ? $type_arr["cols"] : "80");
                        $config_html .= "<textarea rows=\"" . $rows . "\" cols=\"" . $cols . "\" name=\"" . $value["name"] . "\" id=\"config_" . $value["name"] . "\" validate=\"" . $type_arr["validate"] . "\" tips=\"" . $value["desc"] . "\">" . $value["value"] . "</textarea>";
                    }
                    else if ($type_arr["type"] == "radio") {
                        $radio_option = explode("|", $type_arr["value"]);

                        foreach ($radio_option as $radio_k => $radio_v ) {
                            $radio_one = explode(":", $radio_v);

                            if ($radio_k == 0) {
                                $config_html .= "<span class=\"cb-enable\"><label class=\"cb-enable " . ($value["value"] == $radio_one[0] ? "selected" : "") . "\"><span>" . $radio_one[1] . "</span><input type=\"radio\" name=\"" . $value["name"] . "\" value=\"" . $radio_one[0] . "\" " . ($value["value"] == $radio_one[0] ? "checked=\"checked\"" : "") . "/></label></span>";
                            }
                            else if ($radio_k == 1) {
                                $config_html .= "<span class=\"cb-disable\"><label class=\"cb-disable " . ($value["value"] == $radio_one[0] ? "selected" : "") . "\"><span>" . $radio_one[1] . "</span><input type=\"radio\" name=\"" . $value["name"] . "\" value=\"" . $radio_one[0] . "\" " . ($value["value"] == $radio_one[0] ? "checked=\"checked\"" : "") . "/></label></span>";
                            }
                        }

                        if ($value["desc"]) {
                            $config_html .= "<em tips=\"" . $value["desc"] . "\" class=\"notice_tips\"></em>";
                        }
                    }
                    else if ($type_arr["type"] == "image") {
                        $config_html .= "<span class=\"config_upload_image_btn\"><input type=\"button\" value=\"上传图片\" class=\"button\" style=\"margin-left:0px;margin-right:10px;\"/></span><input type=\"text\" class=\"input-text input-image\" name=\"" . $value["name"] . "\" id=\"config_" . $value["name"] . "\" value=\"" . $value["value"] . "\" size=\"48\" validate=\"" . $type_arr["validate"] . "\" tips=\"" . $value["desc"] . "\"/> ";
                    }
                    else if ($type_arr["type"] == "file") {
                        $config_html .= "<span class=\"config_upload_file_btn\" file_validate=\"" . $type_arr["file"] . "\"><input type=\"button\" value=\"上传文件\" class=\"button\" style=\"margin-left:0px;margin-right:10px;\"/></span><input type=\"text\" class=\"input-text input-file\" name=\"" . $value["name"] . "\" id=\"config_" . $value["name"] . "\" value=\"" . $value["value"] . "\" size=\"48\" readonly=\"readonly\" validate=\"" . $type_arr["validate"] . "\" tips=\"" . $value["desc"] . "\"/> ";
                    }
                    else if ($type_arr["type"] == "select") {
                        $radio_option = explode("|", $type_arr["value"]);
                        $config_html .= "<select name=\"" . $value["name"] . "\">";

                        foreach ($radio_option as $radio_k => $radio_v ) {
                            $radio_one = explode(":", $radio_v);
                            $config_html .= "<option value=\"" . $radio_one[0] . "\" " . ($value["value"] == $radio_one[0] ? "selected=\"selected\"" : "") . ">" . $radio_one[1] . "</option>";
                        }

                        $config_html .= "</select>";

                        if ($value["desc"]) {
                            $config_html .= "<em tips=\"" . $value["desc"] . "\" class=\"notice_tips\"></em>";
                        }
                    }

                    $config_html .= "</td>";
                    $config_html .= "</tr>";
                }

                $config_html .= "</table>";
                $pigcms_auto_key++;
            }

            if ($has_tab) {
                $config_tab_html .= "</ul>";
            }

            $return_config["config_html"] = $config_html;

            if ($has_tab) {
                $return_config["config_tab_html"] = $config_tab_html;
            }

            return $return_config;
        }
    }

    public function ajax_upload_pic()
    {
        if ($_FILES["imgFile"]["error"] != 4) {
            $img_admin_id = sprintf("%09d", $this->system_session["id"]);
            $rand_num = substr($img_admin_id, 0, 3) . "/" . substr($img_admin_id, 3, 3) . "/" . substr($img_admin_id, 6, 3);
            $upload_dir = "./upload/images/$rand_num/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 511, true);
            }

            import("ORG.Net.UploadFile");
            $upload = new UploadFile();
            $upload->maxSize = 3 * 1024 * 1024;
            $upload->allowExts = array("jpg", "jpeg", "png", "gif");
            $upload->savePath = $upload_dir;
            $upload->saveRule = "uniqid";

            if ($upload->upload()) {
                $uploadList = $upload->getUploadFileInfo();
                $title = $rand_num . "," . $uploadList[0]["savename"];
                exit(json_encode(array("error" => 0, "url" => $this->config["site_url"] . "/upload/images/" . $rand_num . "/" . $uploadList[0]["savename"], "title" => $title)));
            }
            else {
                exit(json_encode(array("error" => 1, "message" => $upload->getErrorMsg())));
            }
        }
        else {
            exit(json_encode(array("error" => 1, "message" => "没有选择图片")));
        }
    }

    public function ajax_upload_file()
    {
        if ($_GET["name"]) {
            exit(json_encode(array("error" => 1, "message" => "不知道您要上传到哪个配置项，请重试。")));
        }

        $now_config = D("Config")->field("`name`,`type`")->where(array("name" => $_GET["name"]))->find();

        if (empty($now_config)) {
            exit(json_encode(array("error" => 1, "message" => "您正在上传的配置项不存在，请重试。")));
        }

        $tmp_type_arr = explode("&", $now_config["type"]);
        $type_arr = array();

        foreach ($tmp_type_arr as $k => $v ) {
            $tmp_value = explode("=", $v);
            $type_arr[$tmp_value[0]] = $tmp_value[1];
        }

        $allowExts = (array_key_exists("file", $type_arr) ? explode(",", $type_arr["file"]) : array());

        if ($_FILES["imgFile"]["error"] != 4) {
            $img_admin_id = sprintf("%09d", $this->system_session["id"]);
            $rand_num = substr($img_admin_id, 0, 3) . "/" . substr($img_admin_id, 3, 3) . "/" . substr($img_admin_id, 6, 3);
            $upload_dir = "./upload/files/$rand_num/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 511, true);
            }

            import("ORG.Net.UploadFile");
            $upload = new UploadFile();
            $upload->maxSize = 10 * 1024 * 1024;
            $upload->allowExts = $allowExts;
            $upload->savePath = $upload_dir;
            $upload->saveRule = "uniqid";

            if ($upload->upload()) {
                $uploadList = $upload->getUploadFileInfo();
                $title = $rand_num . "," . $uploadList[0]["savename"];
                exit(json_encode(array("error" => 0, "url" => "./upload/files/" . $rand_num . "/" . $uploadList[0]["savename"], "title" => $title)));
            }
            else {
                exit(json_encode(array("error" => 1, "message" => $upload->getErrorMsg())));
            }
        }
        else {
            exit(json_encode(array("error" => 1, "message" => "没有选择文件")));
        }
    }

    public function im()
    {
        if (empty($this->config["site_url"])) {
            exit(json_encode(array("error_code" => true, "msg" => "先填写您网站的域名")));
        }

        if (empty($this->config["wechat_appid"]) || empty($this->config["wechat_appsecret"])) {
            exit(json_encode(array("error_code" => true, "msg" => "先设置站点的微信公众号信息")));
        }

        $array = parse_url($this->config["site_url"]);
        $host = $array["host"];
        import("ORG.Net.Http");
        $http = new Http();
        $data = array("domain" => $host, "label" => "", "from" => "2", "wx_app_id" => $this->config["wechat_appid"], "wx_app_secret" => $this->config["wechat_appsecret"], "activity_url" => $this->config["site_url"] . "/wap.php?g=Wap&c=Api&a=activity", "my_url" => $this->config["site_url"] . "/wap.php?g=Wap&c=Api&a=my", "msg_tip_url" => $this->config["site_url"] . "/wap.php?g=Wap&c=Api&a=index");
        $return["err_code"] = false ;//Http::curlPost("http://im-link.meihua.com/api/app_create.php", $data);
            
        if ($return["err_code"]) {
            exit(json_encode(array("error_code" => true, "msg" => $return["err_msg"])));
        }
        else {
            if (D("Config")->where("`name`='im_appid'")->find()) {
                D("Config")->where("`name`='im_appid'")->save(array("value" => $return["app_id"]));
            }
            else {
                D("Config")->add(array("name" => "im_appid", "value" => $return["app_id"], "gid" => 0, "status" => 1));
            }

            if (D("Config")->where("`name`='im_appkey'")->find()) {
                D("Config")->where("`name`='im_appkey'")->save(array("value" => $return["app_key"]));
            }
            else {
                D("Config")->add(array("name" => "im_appkey", "value" => $return["app_key"], "gid" => 0, "status" => 1));
            }

            S(C("now_city") . "config", NULL);
            exit(json_encode(array("error_code" => false, "msg" => "获取成功")));
        }
    }
}


?>
