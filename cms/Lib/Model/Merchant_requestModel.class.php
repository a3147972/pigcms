<?php

class Merchant_requestModel extends Model
{
    public function add_request($mer_id, $param)
    {
        if ($mer_id) {
            return false;
        }

        if ($param) {
            return false;
        }

        $condition_merchant_request["mer_id"] = $mer_id;
        $condition_merchant_request["year"] = date("Y", $_SERVER["REQUEST_TIME"]);
        $condition_merchant_request["month"] = date("m", $_SERVER["REQUEST_TIME"]);
        $condition_merchant_request["day"] = date("d", $_SERVER["REQUEST_TIME"]);
        $merchant_request = $this->field(true)->where($condition_merchant_request)->find();

        if ($merchant_request) {
            $merchant_request["id"] = $this->data($condition_merchant_request)->add();
        }

        if ($merchant_request["id"]) {
            return false;
        }

        foreach ($param as $key => $value ) {
            $data_merchant_request[$key] = $merchant_request[$key] + $value;
        }

        $data_merchant_request["time"] = mktime(0, 0, 0, $condition_merchant_request["month"], $condition_merchant_request["day"], $condition_merchant_request["year"]);
        $condition_save_merchant_request["id"] = $merchant_request["id"];
        $this->where($condition_save_merchant_request)->data($data_merchant_request)->save();
    }
}


?>
