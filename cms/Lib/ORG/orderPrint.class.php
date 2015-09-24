<?php
class orderPrint
{
	public $serverUrl;
	
	public $key;
	
	public $topdomain;
	
	public function __construct($server_key, $server_topdomain)
	{
		
		$this->key = C('config.print_server_key');
		$this->topdomain = C('config.print_server_topdomain');
		if (!$this->topdomain) {
			$this->topdomain = $this->getTopDomain();
		}
	}
	public function printit($mer_id, $store_id = 0, $msg = '', $paid = 0, $qr = '')
	{
//exit(json_encode(array('status' => 1, 'message' => '"'.$content.'"')));
		$usePrinters = D('Orderprinter')->where(array('mer_id' => $mer_id, 'store_id' => $store_id))->find();
		
		if ($usePrinters){
		
			if (!$usePrinters['paid'] || ($usePrinters['paid'] && $paid)){
			
				 
				    $partner = $usePrinters['username'];//合作者id 42
					$apikey  = $usePrinters['mcode'];  //apikey  0b3821973c4d078980230c99f4e1a9bf6816a7bf
					$mkey    = $usePrinters['mkey'];   //mKey  终端密钥
					$code    = $usePrinters['mp'];  //打印机器码  终端号
			
			
		       	for ($i=0; $i<$usePrinters['count']; $i++)
				{
				//exit(json_encode(array('status' => 1, 'message' => '"'.$code.'"')));
				$result = $this->sendMsgToElink($msg,$apikey,$mkey,$partner,$code);
				}
			
			
			}
		}
	}
	
	 //post
public function httppost1($params) {
    $host = '114.215.116.141';
    $port = '8888';
    //需要提交的post数据
    $p = '';
    foreach ($params as $k => $v) {
        $p .= $k.'='.$v.'&';
    }
    $p = rtrim($p, '&');
    $header = "POST / HTTP/1.1\r\n";
    $header .= "Host:$host:$port\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($p) . "\r\n";
    $header .= "Connection: Close\r\n\r\n";
    $header .= $p;
    $fp = fsockopen($host, $port);
    fputs($fp, $header);
    while (!feof($fp)) {
        $str = fgets($fp);
    }
    fclose($fp);
    return $str;
}

//向易联提交信息 返回易联返回标志 
public function sendMsgToElink($msg,$apiKey,$mKey,$partner,$machine_code){
 	//dump(123);exit;
    $params = array(
            'partner'=>$partner,
            'machine_code'=>$machine_code,
            'content'=>$msg,
    );

    $sign = $this->generateSign($params,$apiKey,$mKey);
    $params['sign'] = $sign;

    $return = $this->httppost1($params);
    return $return;
}

//易联签名算法
function generateSign($params, $apiKey, $msign)
{
    
    //所有请求参数按照字母先后顺序排序
    ksort($params);
    //定义字符串开始 结尾所包括的字符串
    $stringToBeSigned = $apiKey;
    //把所有参数名和参数值串在一起
    foreach ($params as $k => $v)
    {
        $stringToBeSigned .= urldecode($k.$v);
    }
    unset($k, $v);
    //把venderKey夹在字符串的两端
    $stringToBeSigned .= $msign;
    //使用MD5进行加密，再转化成大写
    return strtoupper(md5($stringToBeSigned));
} 
}
