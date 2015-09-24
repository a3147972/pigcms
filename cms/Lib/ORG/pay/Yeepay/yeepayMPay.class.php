<?php

class yeepayMPay
{
    public $useragent = "Yeepay MobilePay PHPSDK v1.1x";
    public $connecttimeout = 30;
    public $timeout = 30;
    public $ssl_verifypeer = false;
    public $http_header = array();
    public $http_code;
    public $http_info;
    public $url;
    protected $account;
    protected $merchantPublicKey;
    protected $merchantPrivateKey;
    protected $yeepayPublicKey;
    private $AESKey;
    private $RSA;
    private $AES;
    private $API_Pay_Base_Url = "http://mobiletest.yeepay.com/testpayapi/api/";
    private $API_Mobile_Pay_Base_Url = "http://mobiletest.yeepay.com/testpayapi/mobile/";
    private $API_PC_Pay_Base_Url = "http://mobiletest.yeepay.com/payweb/";
    private $API_Merchant_Base_Url = "http://mobiletest.yeepay.com/merchant/";
    static     public $carBins = array("544210", "548943", "370267", "356879", "356880", "356881", "356882", "524374", "528856", "550213", "622236", "625330", "625331", "625332", "622889", "625900", "625915", "625916", "622171", "625017", "625018", "625019", "625986", "625925", "625114", "622158", "625917", "622159", "625021", "625022", "625939", "625914", "370246", "370248", "370249", "427010", "427018", "427019", "427020", "427029", "427030", "427039", "370247", "438125", "438126", "451804", "451810", "451811", "45806", "458071", "489734", "489735", "489736", "510529", "427062", "524091", "427064", "530970", "53098", "530990", "558360", "524047", "525498", "622230", "622231", "622232", "622233", "622234", "622235", "622237", "622239", "622240", "622245", "622238", "62451804", "62451810", "62451811", "6245806", "62458071", "6253098", "628288", "628286", "622206", "526836", "513685", "543098", "458441", "622246", "622838", "403361", "404117", "404118", "404119", "404120", "404121", "463758", "519412", "519413", "520082", "520083", "552599", "558730", "514027", "622836", "622837", "628268", "625996", "625998", "625997", "625908", "625910", "625909", "356833", "356835", "409665", "409666", "409668", "409669", "409670", "409671", "409672", "512315", "512316", "512411", "512412", "514957", "409667", "438088", "552742", "553131", "514958", "622760", "628388", "518377", "622788", "625140", "622750", "622751", "625145", "622346", "622347", "544887", "557080", "436718", "436745", "489592", "532450", "532458", "436738", "436748", "552801", "558895", "559051", "622168", "628266", "628366", "622708", "622166", "531693", "356895", "356896", "356899", "625964", "625965", "625966", "622381", "622675", "622676", "622677", "5453242", "5491031", "553242", "5544033", "622812", "622810", "622811", "628310", "376968", "376969", "400360", "403391", "403392", "376966", "404158", "404159", "404171", "404172", "404173", "404174", "404157", "433667", "433668", "433669", "514906", "403393", "520108", "433666", "558916", "622678", "622679", "622680", "622688", "622689", "628206", "556617", "628209", "518212", "628208", "622687", "625978", "625979", "625980", "625981", "356837", "356838", "356839", "356840", "406254", "481699", "486497", "524090", "543159", "622161", "622570", "622650", "425862", "622658", "406252", "622655", "628201", "628202", "622657", "622685", "622659", "523959", "528709", "539867", "539868", "622637", "622638", "628318", "528708", "622636", "625967", "625968", "625969", "545392", "545393", "545431", "545447", "356859", "356857", "407405", "421869", "421870", "421871", "512466", "356856", "528948", "552288", "622600", "622601", "622602", "517636", "622621", "628258", "556610", "622603", "464580", "464581", "523952", "545217", "553161", "356858", "622623", "625912", "625913", "625911", "435744", "435745", "483536", "622525", "622526", "998801", "998802", "622902", "461982", "486493", "486494", "486861", "523036", "451289", "527414", "528057", "622901", "622922", "628212", "451290", "524070", "625084", "625085", "625086", "625087", "548738", "549633", "552398", "625082", "625083", "625960", "625961", "625962", "625963", "356851", "356852", "404738", "404739", "456418", "498451", "515672", "356850", "517650", "525998", "622177", "622277", "628222", "622500", "628221", "622176", "622276", "622228", "625993", "625957", "625958", "625971", "625970", "531659", "622157", "528020", "622155", "622156", "526855", "356868", "356869", "406365", "406366", "428911", "436768", "436769", "436770", "487013", "491032", "491033", "491034", "491035", "491036", "491037", "491038", "436771", "518364", "520152", "520382", "541709", "541710", "548844", "552794", "493427", "622555", "622556", "622557", "622558", "622559", "622560", "528931", "685800", "6858000", "558894", "625072", "625071", "628260", "628259", "522001", "622163", "622853", "628203", "622851", "622852", "356827", "356828", "356830", "402673", "402674", "486466", "519498", "520131", "524031", "548838", "622148", "622149", "622268", "356829", "622300", "628230", "622269", "625099", "356885", "356886", "356887", "356888", "356890", "439188", "439227", "479228", "479229", "521302", "356889", "545620", "545621", "545947", "545948", "552534", "552587", "622575", "622576", "622577", "622578", "622579", "545619", "622581", "622582", "545623", "370285", "370286", "370287", "370289", "439225", "518710", "518718", "628362", "439226", "628262");

    public function __construct($account, $merchantPublicKey, $merchantPrivateKey, $yeepayPublicKey)
    {
        $this->account = $account;
        $this->merchantPublicKey = $merchantPublicKey;
        $this->merchantPrivateKey = $merchantPrivateKey;
        $this->yeepayPublicKey = $yeepayPublicKey;
        $this->RSA = new Crypt_RSA();
        $this->RSA->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $this->RSA->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
        $this->AES = new Crypt_AES(CRYPT_AES_MODE_ECB);
    }

    public function pcWebPay($order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $terminal_type, $terminal_id, $paytypes, $orderexp_date, $callbackurl, $fcallbackurl, $currency, $product_name, $product_desc, $other)
    {
        $query = array("orderid" => $order_id, "transtime" => $transtime, "currency" => $currency, "amount" => $amount, "productcatalog" => $product_catalog, "productname" => $product_name, "productdesc" => $product_desc, "identityid" => (string) $identity_id, "identitytype" => $identity_type, "terminalid" => (string) $terminal_id, "terminaltype" => $terminal_type, "paytypes" => $paytypes, "orderexpdate" => $orderexp_date, "other" => $other, "userip" => $user_ip, "userua" => $user_ua, "callbackurl" => $callbackurl, "fcallbackurl" => $fcallbackurl);
        return $this->getUrl(YEEPAY_PC_API, "api/pay/request", $query);
    }

    public function webPay($order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $callbackurl, $fcallbackurl, $currency, $product_name, $product_desc, $other)
    {
        $query = array("orderid" => $order_id, "transtime" => $transtime, "currency" => $currency, "amount" => $amount, "productcatalog" => $product_catalog, "productname" => $product_name, "productdesc" => $product_desc, "identityid" => (string) $identity_id, "identitytype" => $identity_type, "other" => $other, "userip" => $user_ip, "userua" => $user_ua, "callbackurl" => $callbackurl, "fcallbackurl" => $fcallbackurl);
        return $this->getUrl(YEEPAY_MOBILE_API, "pay/request", $query);
    }

    public function creditWebPay($order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $callbackurl, $fcallbackurl, $currency, $product_name, $product_desc, $other)
    {
        $query = array("orderid" => $order_id, "transtime" => $transtime, "currency" => $currency, "amount" => $amount, "productcatalog" => $product_catalog, "productname" => $product_name, "productdesc" => $product_desc, "identityid" => (string) $identity_id, "identitytype" => $identity_type, "other" => $other, "userip" => $user_ip, "userua" => $user_ua, "callbackurl" => $callbackurl, "fcallbackurl" => $fcallbackurl);
        return $this->getUrl(YEEPAY_MOBILE_API, "pay/bankcard/credit/request", $query);
    }

    public function debitWebPay($order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $user_ua, $callbackurl, $fcallbackurl, $currency, $product_name, $product_desc, $other)
    {
        $query = array("orderid" => $order_id, "transtime" => $transtime, "currency" => $currency, "amount" => $amount, "productcatalog" => $product_catalog, "productname" => $product_name, "productdesc" => $product_desc, "identityid" => (string) $identity_id, "identitytype" => $identity_type, "other" => $other, "userip" => $user_ip, "userua" => $user_ua, "callbackurl" => $callbackurl, "fcallbackurl" => $fcallbackurl);
        return $this->getUrl(YEEPAY_MOBILE_API, "pay/bankcard/debit/request", $query);
    }

    public function bindPayRequest($bind_id, $order_id, $transtime, $amount, $product_catalog, $identity_id, $identity_type, $user_ip, $terminaltype, $terminalid, $callbackurl, $fcallbackurl, $currency, $product_name, $product_desc, $other)
    {
        $query = array("bindid" => (string) $bind_id, "orderid" => (string) $order_id, "transtime" => $transtime, "currency" => $currency, "amount" => $amount, "productcatalog" => $product_catalog, "productname" => $product_name, "productdesc" => $product_desc, "identityid" => (string) $identity_id, "identitytype" => $identity_type, "other" => $other, "userip" => $user_ip, "callbackurl" => $callbackurl, "fcallbackurl" => $fcallbackurl, "terminaltype" => $terminaltype, "terminalid" => $terminalid);
        return $this->post(YEEPAY_PAY_API, "bankcard/bind/pay/request", $query);
    }

    public function sendValidateCode($orderid)
    {
        $query = array("orderid" => (string) $orderid);
        return $this->post(YEEPAY_PAY_API, "validatecode/send", $query);
    }

    public function confirmPay($orderid, $validatecode)
    {
        $query = array("orderid" => (string) $orderid, "validatecode" => (string) $validatecode);
        return $this->post(YEEPAY_PAY_API, "async/bankcard/pay/confirm/validatecode", $query);
    }

    public function getBinds($identity_type, $identity_id)
    {
        $query = array("identityid" => (string) $identity_id, "identitytype" => $identity_type);
        return $this->get(YEEPAY_PAY_API, "bankcard/bind/list", $query);
    }

    public function bindCheck($bind_id, $cvv2)
    {
        $query = array("bindid" => $bind_id, "cvv2" => $cvv2);
        return $this->post(YEEPAY_PAY_API, "bankcard/credit/bind/check", $query);
    }

    public function bankcardCheck($cardno)
    {
        $query = array("cardno" => $cardno);
        return $this->post(YEEPAY_PAY_API, "bankcard/check", $query);
    }

    public function getPaymentResult($order_id)
    {
        $query = array("orderid" => (string) $order_id);
        return $this->get(YEEPAY_PAY_API, "query/order", $query);
    }

    public function unbind($bind_id, $identity_id, $identity_type)
    {
        $query = array("bindid" => (string) $bind_id, "identityid" => (string) $identity_id, "identitytype" => $identity_type);
        return $this->post(YEEPAY_PAY_API, "bankcard/unbind", $query);
    }

    public function refund($amount, $order_id, $origyborder_id, $currency, $cause)
    {
        $query = array("amount" => $amount, "currency" => $currency, "cause" => $cause, "orderid" => (string) $order_id, "origyborderid" => $origyborder_id);
        return $this->post(YEEPAY_MERCHANT_API, "query_server/direct_refund", $query);
    }

    public function getOrder($order_id, $yborder_id)
    {
        $query = array("orderid" => (string) $order_id, "yborderid" => $yborder_id);
        return $this->get(YEEPAY_MERCHANT_API, "query_server/pay_single", $query);
    }

    public function getClearPayData($startdate, $enddate)
    {
        $query = array("startdate" => (string) $startdate, "enddate" => (string) $enddate);
        return $this->getClearData(YEEPAY_MERCHANT_API, "query_server/pay_clear_data", $query);
    }

    public function getClearRefundData($startdate, $enddate)
    {
        $query = array("startdate" => (string) $startdate, "enddate" => (string) $enddate);
        return $this->getClearData(YEEPAY_MERCHANT_API, "query_server/refund_clear_data", $query);
    }

    public function getRefund($order_id, $yborder_id)
    {
        $query = array("orderid" => (string) $order_id, "yborderid" => $yborder_id);
        return $this->get(YEEPAY_MERCHANT_API, "query_server/refund_single", $query);
    }

    public function callback($data, $encryptkey)
    {
        return $this->parseReturn($data, $encryptkey);
    }

    protected function post($type, $method, $query)
    {
        $request = $this->buildRequest($query);
        $url = $this->getAPIUrl($type, $method);
        $data = $this->http($url, "POST", http_build_query($request));

        if ($this->http_info["http_code"] == 405) {
            throw new yeepayMPayException("此接口不支持使用POST方法请求", 1004);
        }

        return $this->parseReturnData($data);
    }

    protected function get($type, $method, $query)
    {
        $request = $this->buildRequest($query);
        $url = $this->getAPIUrl($type, $method);
        $url .= "?" . http_build_query($request);
        $data = $this->http($url, "GET");

        if ($this->http_info["http_code"] == 405) {
            throw new yeepayMPayException("此接口不支持使用GET方法请求", 1003);
        }

        return $this->parseReturnData($data);
    }

    protected function getClearData($type, $method, $query)
    {
        $request = $this->buildRequest($query);
        $url = $this->getAPIUrl($type, $method);
        $url .= "?" . http_build_query($request);
        $data = $this->http($url, "GET");

        if ($this->http_info["http_code"] == 405) {
            throw new yeepayMPayException("此接口不支持使用GET方法请求", 1003);
        }

        return $this->parseReturnClearData($data);
    }

    protected function getUrl($type, $method, $query)
    {
        $request = $this->buildRequest($query);
        $url = $this->getAPIUrl($type, $method);
        $url .= "?" . http_build_query($request);
        return $url;
    }

    protected function buildRequest($query)
    {
        if (!array_key_exists("merchantaccount", $query)) {
            $query["merchantaccount"] = $this->account;
        }

        $sign = $this->RSASign($query);
        $query["sign"] = $sign;
        $request = array();
        $request["merchantaccount"] = $this->account;
        $request["encryptkey"] = $this->getEncryptkey();
        $request["data"] = $this->AESEncryptRequest($query);
        return $request;
    }

    protected function getAPIUrl($type, $method)
    {
        if ($type == YEEPAY_MERCHANT_API) {
            return $this->API_Merchant_Base_Url . $method;
        }
        else if ($type == YEEPAY_MOBILE_API) {
            return $this->API_Mobile_Pay_Base_Url . $method;
        }
        else if ($type == YEEPAY_PC_API) {
            return $this->API_PC_Pay_Base_Url . $method;
        }
        else {
            return $this->API_Pay_Base_Url . $method;
        }
    }

    protected function http($url, $method, $postfields)
    {
        $this->http_info = array();
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array("Expect:"));
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, "getHeader"));
        curl_setopt($ci, CURLOPT_HEADER, false);
        $method = strtoupper($method);

        switch ($method) {
        case "POST":
            curl_setopt($ci, CURLOPT_POST, true);

            if (!$postfields) {
                curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
            }

            break;

        case "DELETE":
            curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "DELETE");

            if (!$postfields) {
                $url = "$url?$postfields";
            }
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);
        $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
        $this->url = $url;
        curl_close($ci);
        return $response;
    }

    protected function parseReturnClearData($data)
    {
        if (strpos($data, "data") === true) {
            $return = json_decode($data, true);
            if (array_key_exists("error_code", $return) && !array_key_exists("status", $return)) {
                throw new yeepayMPayException($return["error_msg"], $return["error_code"]);
            }

            return $this->parseReturn($return["data"], $return["encryptkey"]);
        }
        else {
            return $data;
        }
    }

    protected function parseReturnData($data)
    {
        $return = json_decode($data, true);
        if (array_key_exists("error_code", $return) && !array_key_exists("status", $return)) {
            throw new yeepayMPayException($return["error_msg"], $return["error_code"]);
        }

        return $this->parseReturn($return["data"], $return["encryptkey"]);
    }

    protected function parseReturn($data, $encryptkey)
    {
        $AESKey = $this->getYeepayAESKey($encryptkey);
        $return = $this->AESDecryptData($data, $AESKey);
        $return = preg_replace("#\"yborderid\":(\w+)\}#", "\"yborderid\":\"\1\"}", $return);
        $return = json_decode($return, true);

        if (!array_key_exists("sign", $return)) {
            if (array_key_exists("error_code", $return)) {
                throw new yeepayMPayException($return["error_msg"], $return["error_code"]);
            }

            throw new yeepayMPayException("请求返回异常", 1001);
        }
        else if (!$this->RSAVerify($return, $return["sign"])) {
            throw new yeepayMPayException("请求返回签名验证失败", 1002);
        }

        if (array_key_exists("error_code", $return) && !array_key_exists("status", $return)) {
            throw new yeepayMPayException($return["error_msg"] ? $return["error_msg"] : $return["error"], $return["error_code"]);
        }

        unset($return["sign"]);
        return $return;
    }

    protected function generateAESKey($length)
    {
        $baseString = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $AESKey = "";
        $_len = strlen($baseString);

        for ($i = 1; $i <= $length; $i++) {
            $AESKey .= $baseString[rand(0, $_len - 1)];
        }

        $this->AESKey = $AESKey;
        return $AESKey;
    }

    protected function getEncryptkey()
    {
        if (!$this->AESKey) {
            $this->generateAESKey();
        }

        $this->RSA->loadKey($this->yeepayPublicKey);
        $encryptKey = base64_encode($this->RSA->encrypt($this->AESKey));
        return $encryptKey;
    }

    protected function getYeepayAESKey($encryptkey)
    {
        $this->RSA->loadKey($this->merchantPrivateKey);
        $yeepayAESKey = $this->RSA->decrypt(base64_decode($encryptkey));
        return $yeepayAESKey;
    }

    protected function AESEncryptRequest($query)
    {
        if (!$this->AESKey) {
            $this->generateAESKey();
        }

        $this->AES->setKey($this->AESKey);
        return base64_encode($this->AES->encrypt(json_encode($query)));
    }

    protected function AESDecryptData($data, $AESKey)
    {
        $this->AES->setKey($AESKey);
        return $this->AES->decrypt(base64_decode($data));
    }

    protected function RSASign($query)
    {
        if (array_key_exists("sign", $query)) {
            unset($query["sign"]);
        }

        ksort($query);
        $this->RSA->loadKey($this->merchantPrivateKey);
        $sign = base64_encode($this->RSA->sign(join("", $query)));
        return $sign;
    }

    protected function RSAVerify($return, $sign)
    {
        if (array_key_exists("sign", $return)) {
            unset($return["sign"]);
        }

        ksort($return);
        $this->RSA->loadKey($this->yeepayPublicKey);

        foreach ($return as $k => $val ) {
            if (is_array($val)) {
                $return[$k] = self::cn_json_encode($val);
            }
        }

        return $this->RSA->verify(join("", $return), base64_decode($sign));
    }

    static public function cn_json_encode($value)
    {
        if (defined("JSON_UNESCAPED_UNICODE")) {
            return json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        else {
            $encoded = urldecode(json_encode(self::array_urlencode($value)));
            return preg_replace(array("/\\r/", "/\\n/"), array("\\r", "\\n"), $encoded);
        }
    }

    static public function array_urlencode($value)
    {
        if (is_array($value)) {
            return array_map(array("yeepayMPay", "array_urlencode"), $value);
        }
        else {
            if (is_bool($value) || is_numeric($value)) {
                return $value;
            }
            else {
                return urlencode(addslashes($value));
            }
        }
    }

    public function getHeader($ch, $header)
    {
        $i = strpos($header, ":");

        if (!$i) {
            $key = str_replace("-", "_", strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }

        return strlen($header);
    }

    static public function checkCardNo($cardno)
    {
        if (!preg_match("/^\d+$/", $cardno)) {
            return -1;
        }

        $_len = strlen($cardno);
        $_x = $cardno[$_len - 1];
        $_start = $_len - 2;
        $_sum = 0;

        for ($i = $_start; 0 <= $i; $i--) {
            if ((($_start - $i) % 2) == 0) {
                $_v = $cardno[$i] * 2;
                $_sum += intval($_v * 0.1) + ($_v % 10);
            }
            else {
                $_sum += $cardno[$i];
            }
        }

        if ((($_x + ($_sum % 10)) != 10) && (($_x + ($_sum % 10)) != 0)) {
            return -2;
        }

        foreach (self::$carBins as $carBin ) {
            if (substr($cardno, 0, strlen($carBin)) == $carBin) {
                return 1;
            }
        }

        return -3;
    }

    static public function checkValidthru(&$validthru)
    {
        if (!preg_match("/^(\d{2})(\d{2})$/", $validthru, $matches)) {
            if (!preg_match("/^(\d{2})\/(\d{2})$/", $validthru, $matches)) {
                return false;
            }

            $validthru = $matches[1] . $matches[2];
        }

        if (($matches[1] <= 12) && (13 <= $matches[2])) {
            return true;
        }

        if ((12 < $matches[1]) && ($matches[2] < 13)) {
            $validthru = $matches[2] . $matches[1];
            return true;
        }

        return false;
    }

    static public function checkCvv2($cvv2)
    {
        if (preg_match("/^\d{3}$/", $cvv2)) {
            return true;
        }

        return false;
    }
}

if (!class_exists("Crypt_Rijndael")) {
    include "Crypt_Rijndael.php";
}

if (!class_exists("Crypt_AES")) {
    include "Crypt_AES.php";
}

if (!class_exists("Crypt_DES")) {
    include "Crypt_DES.php";
}

if (!class_exists("Crypt_Hash")) {
    include "Crypt_Hash.php";
}

if (!class_exists("Crypt_RSA")) {
    include "Crypt_RSA.php";
}

if (!class_exists("Crypt_TripleDES")) {
    include "Crypt_TripleDES.php";
}

if (!class_exists("Math_BigInteger")) {
    include "Math_BigInteger.php";
}
class yeepayMPayException extends Exception
{}


define("YEEPAY_PAY_API", 1);
define("YEEPAY_MERCHANT_API", 2);
define("YEEPAY_MOBILE_API", 3);
define("YEEPAY_PC_API", 4);

?>
