<?php
class ArrayToStr 
{

	public static function array_to_str($data, $paid = 0, $print_format)
	{
		if (is_array($data) && $print_format) {
			
			$payarr = array('alipay' => '支付宝', 'weixin' => '微信支付', 'tenpay' => '财付通[wap手机]', 'tenpaycomputer' => '财付通[即时到帐]', 'yeepay' => '易宝支付', 'allinpay' => '通联支付', 'daofu' => '货到付款', 'dianfu' => '到店付款', 'chinabank' => '网银在线', 'offline' => '线下支付');
			
			$print_format = preg_replace('/\{user_name\}/', $data['user_name'], $print_format);
			$print_format = preg_replace('/\{user_phone\}/', $data['user_phone'], $print_format);
			$print_format = preg_replace('/\{user_address\}/', $data['user_address'], $print_format);
			$print_format = preg_replace('/\{user_message\}/', $data['user_message'], $print_format);
			$print_format = preg_replace('/\{buy_time\}/', $data['buy_time'], $print_format);
			$print_format = preg_replace('/\{pay_time\}/', $data['pay_time'], $print_format);
			$print_format = preg_replace('/\{use_time\}/', $data['use_time'], $print_format);
			$goods_list = '';
			if (isset($data['goods_list'])) {
				foreach ($data['goods_list'] as $k => $row) {
					if ($k) {
						$goods_list .= chr(10). $row['name'] . ": ￥" . $row['price'] . " * " . $row['num'];
					} else {
						$goods_list .= $row['name'] . ": ￥" . $row['price'] . " * " . $row['num'];
					}
				}
			}
			$print_format = preg_replace('/\{goods_list\}/', $goods_list, $print_format);
			$print_format = preg_replace('/\{goods_count\}/', $data['goods_count'], $print_format);
			$print_format = preg_replace('/\{goods_price\}/', $data['goods_price'], $print_format);
			$print_format = preg_replace('/\{minus_price\}/', $data['minus_price'], $print_format);
			$print_format = preg_replace('/\{true_price\}/', $data['true_price'], $print_format);
			
			$print_format = preg_replace('/\{orderid\}/', $data['orderid'], $print_format);
			$print_format = preg_replace('/\{store_name\}/', $data['store_name'], $print_format);
			$print_format = preg_replace('/\{store_phone\}/', $data['store_phone'], $print_format);
			$print_format = preg_replace('/\{store_address\}/', $data['store_address'], $print_format);
			
			$pay_type = isset($payarr[$array['pay_type']]) ? $payarr[$array['pay_type']] : '未选择';
			$pay_status = $paid ? '已支付' : '未支付';
			$print_format = preg_replace('/\{pay_status\}/', $pay_status, $print_format);
			$print_format = preg_replace('/\{pay_type\}/', $pay_type, $print_format);
			$print_format = preg_replace('/\{print_time\}/', date('Y-m-d H:i:s'), $print_format);
			return $print_format;
			
			$msg = '';
			if (isset($array['user_name']) && $array['user_name']) 
				$msg .= chr(10).'姓名：'. $array['user_name'];
			if (isset($array['user_phone']) && $array['user_phone']) 
				$msg .= chr(10).'电话：'. $array['user_phone'];
			if (isset($array['user_address']) && $array['user_address']) 
				$msg .= chr(10).'地址：'. $array['user_address'];
			if (isset($array['buy_time']) && $array['buy_time']) 
				$msg .= chr(10).'下单时间：'. date('Y-m-d H:i:s', $array['buy_time']);
			if (isset($array['goods_list']) && $array['goods_list']) {
				$msg .= chr(10).'*******************************';
				foreach ($array['goods_list'] as $row) {
					$msg .= chr(10). $row['name'] . ": ￥" . $row['price'] . " * " . $row['num'];
				}
				$msg .= chr(10).'菜品数:' . $msg['goods_count'];
				$msg .= chr(10).'总价: ￥' . $msg['goods_count'];
				$msg .= chr(10).'*******************************';
			}
			
			if ($paid) {
				$msg .= chr(10).'订单状态：已付款';
			} else {
				$msg .= chr(10).'订单状态：未付款';
			}
			isset($array['pay_type'])&& array_key_exists($array['pay_type'],$payarr)&& $msg.=chr(10)."支付方式：".$payarr[$array['pay_type']];
			$msg .= chr(10).'※※※※※※※※※※※※※※※※';
			if (isset($array['store_name']) && $array['store_name']) 
				$msg .= chr(10).'公司名称：'.$array['store_name'];
			if (isset($array['store_phone']) && $array['store_phone']) 
				$msg .= chr(10).'公司电话：'.$array['store_phone'];
			if (isset($array['store_address']) && $array['store_address'])
				$msg .= chr(10).'公司地址：'.$array['store_address'];
			$msg .= chr(10).'打印时间：'.date("Y-m-d H:i:s");
			return $msg;
		}
	}
}
