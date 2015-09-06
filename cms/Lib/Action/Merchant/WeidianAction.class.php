<?php

class WeidianAction extends BaseAction
{
    public $api_url = "";//"http://v.meihua.com/api/";

    public function index()
    {
        $database_merchant = D("Merchant");
        $condition_merchant["mer_id"] = $this->merchant_session["mer_id"];
        $now_merchant = $database_merchant->field(true, "pwd")->where($condition_merchant)->find();
        $this->assign("now_merchant", $now_merchant);
        $this->display();
    }

    public function create()
    {
        $data = array("token" => $this->merchant_session["mer_id"], "site_url" => $this->config["site_url"], "timestamp" => $_SERVER["REQUEST_TIME"], "wxname" => $this->merchant_session["name"], "phone" => $this->merchant_session["phone"], "payment_url" => $this->config["site_url"] . "/wap.php?c=Pay&a=check&type=weidian", "notify_url" => $this->config["site_url"] . "/wap.php?c=Weidian&a=api_msg", "login_url" => $this->config["site_url"] . "/wap.php?c=Weidian&a=redirect", "server_key" => "");
        $sort_data = $data;
        $sort_data["salt"] = "pigcms";
        ksort($sort_data);
        $sign_key = sha1(http_build_query($sort_data));
        $data["sign_key"] = $sign_key;
        $data["request_time"] = $_SERVER["REQUEST_TIME"];
        if(empty($this->api_url)){
            $this->error("API验证失败。");
        }
        $result = $this->curl_post($this->api_url . "oauth.php", $data);

        if (!empty($result)) {
            $json_arr = json_decode($result, true);

            if ($json_arr["error_code"]) {
                $this->error($json_arr["error_msg"]);
            }
            else {
                $database_merchant = D("Merchant");
                $condition_merchant["mer_id"] = $this->merchant_session["mer_id"];
                $data_merchant["weidian_url"] = $json_arr["return_url"];

                if ($database_merchant->where($condition_merchant)->data($data_merchant)->save()) {
                    $this->success("微店创建成功");
                }
                else {
                    $this->error("微店创建失败，请重试。");
                }
            }
        }
        else {
            $this->error("微店创建失败，请再重试。");
        }
    }

    public function manage()
    {
        $database_merchant = D("Merchant");
        $condition_merchant["mer_id"] = $this->merchant_session["mer_id"];
        $now_merchant = $database_merchant->field("`weidian_url`")->where($condition_merchant)->find();

        if (empty($now_merchant["weidian_url"])) {
            $this->error("您还未创建微店！");
        }
        else {
            $this->assign("weidian_url", $now_merchant["weidian_url"]);
        }

        $this->display();
    }

    protected function curl_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        return curl_exec($ch);
    }
}


?>
