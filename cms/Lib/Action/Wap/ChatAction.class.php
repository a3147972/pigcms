<?php
/*
 * 商户和微信通信接口
 */
class ChatAction extends CommonAction{
	public function index(){
		$wechat = new Chat($this->config);
		$data = $wechat->request();
		
		list($content, $type) = $this->reply($data);
		if ($content) {
			$wechat->response($content, $type);
		} else {
			exit();
		}
		
	}
	
	public function get_ticket(){
		//获取 component_verify_ticket 每十分钟微信服务本服务器请求一次
		$wechat = new Chat($this->config);
		$data = $wechat->request();
		// 	print_r($data);die;
		if(isset($data['InfoType'])) {
			if ($data['InfoType'] == 'component_verify_ticket') {
				if (isset($data['ComponentVerifyTicket']) && $data['ComponentVerifyTicket']) {
					if ($config = D('Config')->where("`name`='wx_componentverifyticket'")->find()) {
						D('Config')->where("`name`='wx_componentverifyticket'")->data(array('value' => $data['ComponentVerifyTicket']))->save();
					} else {
						D('Config')->data(array('name' => 'wx_componentverifyticket', 'value' => $data['ComponentVerifyTicket'], 'type' => 'type=text', 'gid' => 0, 'tab_id' => 0))->add();
					}
					S(C('now_city') . 'config', null);
					exit('success');
				}
			} elseif ($data['InfoType'] == 'unauthorized') {
				if (isset($data['AuthorizerAppid']) && $data['AuthorizerAppid']) {
					D('Weixin_bind')->where("`authorizer_appid`='{$data['AuthorizerAppid']}'")->delete();
					exit('success');
				}
			}
		}
	}
	
	
	private function get_access_token($auth_code)
	{
		import('ORG.Net.Http');
		$url = 'https://api.weixin.qq.com/cgi-bin/component/api_component_token';
		$data = array('component_appid' => $this->config['wx_appid'], 'component_appsecret' => $this->config['wx_appsecret'], 'component_verify_ticket' => $this->config['wx_componentverifyticket']);
		$result = Http::curlPost($url, json_encode($data));
		if ($result['errcode']) {
			return false;
		}
		//获取 authorizer_appid
		$url = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=' . $result['component_access_token'];//
		$data = array('component_appid' => $this->config['wx_appid'], 'authorization_code' => $auth_code);
		$result1 = Http::curlPost($url, json_encode($data));

		if ($result1['errcode']) {
			return false;
		}
		return $result1['authorization_info']['authorizer_access_token'];
	}
    private function reply($data)
    {
    	$keyword = isset($data['Content']) ? $data['Content'] : (isset($data['EventKey']) ? $data['EventKey'] : '');
    	
    	if($data['ToUserName'] == 'gh_3c884a361561'){
    		if ($data['MsgType'] == 'event') {
    			return array($data['Event'] . 'from_callback', 'text');
    		}
    		
    		if ($keyword == 'TESTCOMPONENT_MSG_TYPE_TEXT') {
    			return array('TESTCOMPONENT_MSG_TYPE_TEXT_callback', 'text');
    		}
    		if (strstr($keyword, 'QUERY_AUTH_CODE:')) {
    			$t = explode(':', $keyword);
    			$query_auth_code = $t[1];
    			$access_token = $this->get_access_token($query_auth_code);
    			$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $access_token;
    			$str = '{"touser":"'. $data['FromUserName'] .'", "msgtype":"text", "text":{"content":"' . $query_auth_code . '_from_api"}}';
    			import('ORG.Net.Http');
    			Http::curlPost($url, $str);
    		}
    	}
    	
		$mer_id = 0;
		if ($bind = D('Weixin_bind')->where(array('user_name' => $data['ToUserName']))->find()) {
			$mer_id = $bind['mer_id'];
		} else {
			return false;
		}
		
    	if ($data['MsgType'] == 'event') {
    		$id = $data['EventKey'];
    		switch (strtoupper($data['Event'])) {
    			case 'SCAN':
		    		return $this->scan($id, $data['FromUserName'], $mer_id);
		    		break;
    			case 'CLICK':
		    		$return = $this->special_keyword($id, $data, $mer_id);
		    		return $return;
    				break;
    			case 'SUBSCRIBE':
					$this->route();
    				if (isset($data['Ticket'])) {
    					$id = substr($data['EventKey'], 8);
    					return $this->scan($id, $data['FromUserName'], $mer_id);
    				}
    				if ($mer_id) {
    					if ($other = D('Reply_other')->where(array('type' => 0, 'mer_id' => $mer_id))->find()) {
    						if ($other['reply_type'] == 0) {
    							return array($other['content'], 'text');
    						} else {
    							return $this->txt_img($other['from_id'], $mer_id);
    						}
    					} else {
    						return array("感谢您的关注，我们将竭诚为您服务！", 'text');
    					}
    				}
    				$first = D("First")->field(true)->find();
    				if ($first) {
    					if ($first['type'] == 0) {
    						return array($first['content'], 'text');
    					} elseif ($first['type'] == 1) {
    						$return[] = array($first['title'], $first['info'], $this->config['site_url'] . $first['pic'], $first['url']);
    					} elseif ($first['type'] == 2) {
    						if ($first['fromid'] == 1) {
    							return $this->special_keyword('首页', $data);
    						} elseif ($first['fromid'] == 2) {
    							return $this->special_keyword($this->config['group_alias_name'], $data);
    						} else {
    							return $this->special_keyword($this->config['meal_alias_name'], $data);
    						}
    					} elseif ($first['type'] == 3) {
    						$group_list = D('Group')->field(true)->order('index_sort DESC')->limit('0, 9')->select();
					    	$group_image_class = new group_image();
					    	foreach ($group_list as $g) {
					    		$tmp_pic_arr = explode(';',$g['pic']);
					    		$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
    							$return[] = array('['.$this->config['group_alias_name'].']' . $g['s_name'], $g['name'], $image, $this->config['site_url'] . "/wap.php?g=Wap&c=Group&a=detail&group_id={$g['group_id']}");
    						}
    						return array($return, 'news');
    					}
    				} else {
    					return array("感谢您的关注，我们将竭诚为您服务！", 'text');
    				}
    				break;
    			case 'UNSUBSCRIBE':
					$this->route();
    				return array("BYE-BYE", 'text');
    				break;
    			case 'LOCATION':
    				if ($long_lat = D("User_long_lat")->field(true)->where(array('open_id' => $data['FromUserName']))->find()) {
    					D("User_long_lat")->where(array('open_id' => $data['FromUserName']))->save(array('long' => $data['Longitude'], 'lat' => $data['Latitude'], 'dateline' => time()));
    				} else {
    					D("User_long_lat")->add(array('long' => $data['Longitude'], 'lat' => $data['Latitude'], 'dateline' => time(), 'open_id' => $data['FromUserName']));
    				}
    				break;
				default:
					//return array("亲，此号暂停测试，请搜索【pigcms】进行关注测试", 'text');
    		}
    	} elseif ($data['MsgType'] == 'text') {
    		$content = $data['Content'];
    		if (strtolower($content) == 'go') {
    			$t_data = $this->route();
// 				header("Content-type: text/xml");
// 				exit($t_data);
    		}
    		$return = $this->special_keyword($content, $data, $mer_id);
    		return $return;
    	} elseif ($data['MsgType'] == 'image' && $mer_id) {
			if ($other = D('Reply_other')->where(array('type' => 2, 'mer_id' => $mer_id))->find()) {
				if ($other['reply_type'] == 0) {
					return array($other['content'], 'text');
				} else {
					return $this->txt_img($other['from_id'], $mer_id);
				}
			} else {
				return false;
			}
    	} elseif ($data['MsgType'] == 'location') {
    		$x = $data['Location_X'];
    		$y = $data['Location_Y'];
//     		if ($flag == 1) {//餐饮
	    		$meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where('`have_meal`=1')->order("juli ASC")->limit("0, 10")->select();
	    		$store_image_class = new store_image();
	    		foreach ($meals as $meal) {
	    			$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
	    			$meal['image'] = $images ? array_shift($images) : '';
	    			$len = $meal['juli'] >= 1000 ? number_format($meal['juli'] / 1000, 2) . '千米' : $meal['juli'] . '米';
	    			$return[] = array($meal['name'] . "[{$meal['adress']}]约{$len}", $meal['txt_info'], $this->config['site_url'] . $meal['image'], $this->config['site_url'] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id={$meal['mer_id']}&store_id={$meal['store_id']}");
	    		}
//     		} elseif ($flag == 2) {//团购
	    		$meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where('`have_group`=1')->order("juli ASC")->limit("0, 10")->select();
	    		$store_image_class = new store_image();
	    		foreach ($meals as $meal) {
	    			$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
	    			$meal['image'] = $images ? array_shift($images) : '';
	    			$len = $meal['juli'] >= 1000 ? number_format($meal['juli'] / 1000, 2) . '千米' : $meal['juli'] . '米';
	    			$return[] = array($meal['name'] . "[{$meal['adress']}]约{$len}", $meal['txt_info'], $this->config['site_url'] . $meal['image'], $this->config['site_url'] . "/wap.php?g=Wap&c=Group&a=shop&store_id={$meal['store_id']}");
	    		}
//     		} else {
//     			return array("没有相应的附近消息", 'text');
//     		}
			if (count($return) > 10) {
				$return = array_slice($return, 0, 9);
			}
    		return array($return, 'news');
    	} else {
//     		({$company['address']}大约{$company['juli']}米)
//     		return array("亲，此号暂停测试，请搜索【pigcms】进行关注测试", 'text');
    	}
    	return false;
    }
	
    private function scan($id, $openid = '', $mer_id = 0)
    {
//     	return array($id, 'text');
    	if ($id > 4000000000 && $openid) {
    		$id -= 4000000000;
    		if ($lottery = D("Lottery")->field(true)->where(array('id' => $id))->find()) {
    			switch ($lottery['type']){
    				case 1:
    					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Lottery&a=index&token={$lottery['mer_id']}&id={$lottery['id']}");
    					break;
    				case 2:
    					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Guajiang&a=index&token={$lottery['mer_id']}&id={$lottery['id']}");
    					break;
    				case 3:
    					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Coupon&a=index&token={$lottery['mer_id']}&id={$lottery['id']}");
    					break;
    				case 4:
    					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=LuckyFruit&a=index&token={$lottery['mer_id']}&id={$lottery['id']}");
    					break;
    				case 5:
    					$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=GoldenEgg&a=index&token={$lottery['mer_id']}&id={$lottery['id']}");
    					break;
    			}
    			return array($return, 'news');
    		}
    		return array("很抱歉，暂时获取不到该二维码的信息!", 'text');
    	} elseif ($id > 3000000000 && $openid) {
    		$id -= 3000000000;
    		if ($meal_order = D('Meal_order')->field('order_id, mer_id, store_id')->where(array('order_id' => $id))->find()) {
    			return array('<a href="' . $this->config['site_url'] . '/wap.php?c=Meal&a=detail&orderid=' . $id  . '&mer_id=' . $meal_order['mer_id'] . '&store_id=' . $meal_order['store_id'] . '">查看'.$this->config['meal_alias_name'].'订单详情</a>', 'text');
    		} else {
    			return array('获取不到该订单信息', 'text');
    		}
    	} elseif ($id > 2000000000 && $openid) {
    		$id -= 2000000000;
    		return array('<a href="' . $this->config['site_url'] . '/wap.php?c=My&a=group_order&order_id=' . $id  . '">查看'.$this->config['group_alias_name'].'订单详情</a>', 'text');
    	} elseif ($id > 1000000000 && $openid) {
    		if ($user = D('User')->field('uid')->where(array('openid' => $openid))->find()) {
    			D('Login_qrcode')->where(array('id' => $id))->save(array('uid' => $user['uid']));
    			return array('登陆成功', 'text');
    		} else {
    			D('Login_qrcode')->where(array('id' => $id))->save(array('uid' => -1));
    			$return[] = array('点击授权登录', '', $this->config['site_url'] . '/static/logo.jpg', $this->config['site_url'] . '/wap.php?c=Web_bind&a=ajax_web_login&qrcode_id=' . $id);
    			return array($return, 'news');
    		}
    	}
    	
    	if ($recognition = M("Recognition")->field(true)->where(array('id' => $id))->find()) {
    		switch ($recognition['third_type']) {
    			case 'group':
    				$now_group = D("Group")->field(true)->where(array('group_id' => $recognition['third_id']))->find();
    				$group_image_class = new group_image();
    				$tmp_pic_arr = explode(';',$now_group['pic']);
    				$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
    				$return[] = array('['.$this->config['group_alias_name'].']' . $now_group['s_name'], $now_group['name'], $image, $this->config['site_url'] . "/wap.php?g=Wap&c=Group&a=detail&group_id={$now_group['group_id']}");
    				$this->saverelation($openid, $now_group['mer_id'], 0);
    				$return = $this->other_message($return, $now_group['mer_id'], $now_group['group_id']);
    				break;
    			case 'merchant':
    				$now_merchant = D("Merchant")->field(true)->where(array('mer_id' => $recognition['third_id']))->find();
    				$pic = '';
    				if ($now_merchant['pic_info']) {
    					$images = explode(";", $now_merchant['pic_info']);
    					$merchant_image_class = new merchant_image();
    					$images = explode(";", $images[0]);
    					$pic = $merchant_image_class->get_image_by_path($images[0]);
    				}
    				$return[] = array('[商家]' . $now_merchant['name'], $now_merchant['txt_info'], $this->config['site_url'] . $pic, $this->config['site_url'] . "/wap.php?g=Wap&c=Index&a=index&token={$recognition['third_id']}");
    				$return = $this->other_message($return, $now_merchant['mer_id']);
    				$this->saverelation($openid, $now_merchant['mer_id'], 1);
    				break;
    			case 'meal':
    				$now_store = D("Merchant_store")->field(true)->where(array('store_id' => $recognition['third_id']))->find();
    				$store_image_class = new store_image();
    				$images = $store_image_class->get_allImage_by_path($now_store['pic_info']);
    				$now_store['image'] = $images ? array_shift($images) : '';
    				$return[] = array('['.$this->config['meal_alias_name'].']' . $now_store['name'], $now_store['txt_info'], $this->config['site_url'] . $now_store['image'], $this->config['site_url'] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id={$now_store['mer_id']}&store_id={$now_store['store_id']}");
    				$this->saverelation($openid, $now_store['mer_id'], 0);
    				$return = $this->other_message($return, $now_store['mer_id'], 0, $now_store['store_id']);
    				break;
    		}
    	}

		if ($return) {
			return array($return, 'news');
		}
		return array("很抱歉，暂时获取不到该二维码的信息!", 'text');
    }
    
    
    private function other_message($return, $token, $group_id = 0, $store_id = 0)
    {
    	//商家的其他团购
    	$group_list = D("Group")->field(true)->where("`mer_id`='{$token}' AND `group_id`<>'{$group_id}'")->select();
    	$group_image_class = new group_image();
    	foreach ($group_list as $g) {
    		$tmp_pic_arr = explode(';',$g['pic']);
    		$image = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
    		$return[] = array('['.$this->config['group_alias_name'].']' . $g['s_name'], $g['name'], $image, $this->config['site_url'] . "/wap.php?g=Wap&c=Group&a=detail&group_id={$g['group_id']}");
    	}
		if (count($return) > 10) {
			return array_slice($return, 0, 9);
		}
    	//商家的会员卡
		if ($card = D("Member_card_set")->field(true)->where(array('token' => $token))->limit("0,1")->find()) {
			$return[] = array('[会员卡]' . $card['cardname'], $card['msg'], $this->config['site_url'] . $card['logo'], $this->config['site_url'] . "/wap.php?c=Card&a=index&token={$token}");
		}
		if (count($return) > 10) {
			return array_slice($return, 0, 9);
		}
    	//商家的活动
    	$lotterys = D("Lottery")->field(true)->where(array('token' => $token, 'statdate' => array('lt', time()), 'enddate' => array('gt', time())))->select();
    	foreach ($lotterys as $lottery) {
    		switch ($lottery['type']){
    			case 1:
    				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Lottery&a=index&token={$token}&id={$lottery['id']}");
    				break;
    			case 2:
    				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Guajiang&a=index&token={$token}&id={$lottery['id']}");
    				break;
    			case 3:
    				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Coupon&a=index&token={$token}&id={$lottery['id']}");
    				break;
    			case 4:
    				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=LuckyFruit&a=index&token={$token}&id={$lottery['id']}");
    				break;
    			case 5:
    				$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=GoldenEgg&a=index&token={$token}&id={$lottery['id']}");
    				break;
    		}
    	}
		if (count($return) > 10) {
			return array_slice($return, 0, 9);
		}
    	//商家的餐饮
    	$stores = D("Merchant_store")->field(true)->where("`mer_id`='{$token}' AND `status`=1 AND `store_id`<>'{$store_id}'")->select();
    	$store_image_class = new store_image();
    	foreach ($stores as $store) {
    		if ($store['have_meal']) {
    			$images = $store_image_class->get_allImage_by_path($store['pic_info']);
    			$img = array_shift($images);
    			$return[] = array('['.$this->config['meal_alias_name'].']' . $store['name'], $store['txt_info'], $this->config['site_url'] . $img, $this->config['site_url'] . "/wap.php?c=Meal&a=menu&mer_id={$store['mer_id']}&store_id={$store['store_id']}");
    		}
    	}
		if (count($return) > 10) {
			return array_slice($return, 0, 9);
		} else {
			return $return;
		}
    	
    }
    
    private function txt_img($pigcms_id, $mer_id)
    {
    	if ($data = D('Source_material')->where(array('pigcms_id' => $pigcms_id, 'mer_id' => $mer_id))->find()) {
    		$it_ids = unserialize($data['it_ids']);
    		if ($data['type'] == 0) {
    			$id = isset($it_ids[0]) ? intval($it_ids[0]) : 0;
    			$image_text = D('Image_text')->where(array('pigcms_id' => $id))->find();
    			$url = $this->config['site_url'] . '/wap.php?g=Wap&c=Article&a=index&imid=' . $image_text['pigcms_id'];
    			$return[] = array($image_text['title'], $image_text['digest'], $this->config['site_url'] . $image_text['cover_pic'], $url);
    		} else {
    			$image_texts = D('Image_text')->where(array('pigcms_id' => array('in', $it_ids)))->select();
    			foreach ($image_texts as $image) {
    				$url = $this->config['site_url'] . '/wap.php?g=Wap&c=Article&a=index&imid=' . $image['pigcms_id'];
    				$return[] = array($image['title'], $image['digest'], $this->config['site_url'] . $image['cover_pic'], $url);
    			}
    		}
    		return array($return, 'news');
    	} else {
    		return array("没有找到相关的应答", 'text');
    	}
    }
    private function special_keyword($key, $data = array(), $mer_id = 0)
    {
    	$return = array();

		//关键字回复
		if ($mer_id) {
			if ($keyobj = D('Keyword')->where(array('mer_id' => $mer_id, 'content' => $key))->find()) {
				if ($keyobj['table'] == 'Text') {
					$text = D('Text')->where(array('pigcms_id' => $keyobj['from_id']))->find();
					return array($text['content'], 'text');
				} else {
					return $this->txt_img($keyobj['from_id'], $mer_id);
				}
			} elseif ($other = D('Reply_other')->where(array('type' => 1, 'mer_id' => $mer_id))->find()) {
				if ($other['reply_type'] == 0) {
					return array($other['content'], 'text');
				} else {
					return $this->txt_img($other['from_id'], $mer_id);
				}
			}
		}
		
    	if ($key == '附近'.$this->config['group_alias_name'] || $key == '附近'.$this->config['meal_alias_name']) {
			$dateline = time() - 3600 * 2;
    		if ($long_lat = D("User_long_lat")->field(true)->where("`open_id`='{$data['FromUserName']}' AND `dateline`>'{$dateline}'")->find()) {
	    		$x = $long_lat['lat'];
	    		$y = $long_lat['long'];
    			if ($key == '附近'.$this->config['meal_alias_name']) {
		    		$meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where('`have_meal`=1')->order("juli ASC")->limit("0, 10")->select();
		    		$store_image_class = new store_image();
		    		foreach ($meals as $meal) {
		    			$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
		    			$meal['image'] = $images ? array_shift($images) : '';
		    			$len = $meal['juli'] >= 1000 ? number_format($meal['juli'] / 1000, 1) . '千米' : $meal['juli'] . '米';
		    			$return[] = array($meal['name'] . "[{$meal['adress']}]约{$len}", $meal['txt_info'], $this->config['site_url'] . $meal['image'], $this->config['site_url'] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id={$meal['mer_id']}&store_id={$meal['store_id']}");
		    		}
    			} else {
		    		$meals = D("Merchant_store")->field("*, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where('`have_group`=1')->order("juli ASC")->limit("0, 10")->select();
		    		$store_image_class = new store_image();
		    		foreach ($meals as $meal) {
		    			$images = $store_image_class->get_allImage_by_path($meal['pic_info']);
		    			$meal['image'] = $images ? array_shift($images) : '';
		    			$len = $meal['juli'] >= 1000 ? number_format($meal['juli'] / 1000, 1) . '千米' : $meal['juli'] . '米';
		    			$return[] = array($meal['name'] . "[{$meal['adress']}]约{$len}", $meal['txt_info'], $this->config['site_url'] . $meal['image'], $this->config['site_url'] . "/wap.php?g=Wap&c=Group&a=shop&store_id={$meal['store_id']}");
		    		}
    			}
    		}
    		if ($return) {
    			return array($return, 'news');
    		} else {
    			return array("主人【小猪猪】已经接收到你的指令请发送您的地理位置(对话框右下角点击＋号，然后点击“位置”)给我哈", 'text');
    		}
    		
    	}
    	
    	if ($key == '交友') {
    		$return[] = array("交友约会", "结交一些朋友吃喝玩乐", $this->config['site_url'] . '/static/images/jiaoyou.jpg', $this->config['site_url'] . "/wap.php?c=Invitation&a=datelist");
    		return array($return, 'news');
    	}
//     	if ($key == '平台会员卡') {
//     		$admin = D('Admin')->field('id')->where(array('status' => 1))->order('id ASC')->limit('0,1')->find();
//     		$return[] = array('平台会员卡', '平台会员卡', '', $this->config['site_url'] . "/wap.php?c=Card&a=index&token=s{$admin['id']}");
//     		return array($return, 'news');
//     	}
    	$platform = D("Platform")->field(true)->where(array('key' => $key))->find();
    	if ($platform) {
    		$return[] = array($platform['title'], $platform['info'], $this->config['site_url'] . $platform['pic'], $platform['url']);
    	} else {
    		$keys = D("Keywords")->field(true)->where(array('keyword' => $key))->order('id DESC')->limit('0,9')->select();
    		$lotteryids = $mealids = $groupids = array();
    		foreach ($keys as $k) {
    			if ($k['third_type'] == 'group') {
    				$groupids[] = $k['third_id'];
    			} elseif ($k['third_type'] == 'Merchant_store') {
    				$mealids[] = $k['third_id'];
    			} elseif ($k['third_type'] == 'lottery') {
    				$lotteryids[] = $k['third_id'];
    			}
    		}
    		if ($groupids) {
    			$list = D("Group")->field(true)->where(array('group_id' => array('in', $groupids)))->select();
    			$group_image_class = new group_image();
    			foreach ($list as $li) {
    				$image = $group_image_class->get_image_by_path($li['pic'], 's');
    				$return[] = array($li['s_name'], $li['name'], $image, $this->config['site_url'] . "/wap.php?g=Wap&c=Group&a=detail&group_id={$li['group_id']}");
    			}
    		}
    		if ($mealids) {
    			$list = D("Merchant_store")->field(true)->where(array('store_id' => array('in', $mealids)))->select();
    			$store_image_class = new store_image();
    			foreach ($list as $now_store) {
    				$images = $store_image_class->get_allImage_by_path($now_store['pic_info']);
    				$now_store['image'] = $images ? array_shift($images) : '';
    				$return[] = array($now_store['name'], $now_store['txt_info'], $this->config['site_url'] . $now_store['image'], $this->config['site_url'] . "/wap.php?g=Wap&c=Meal&a=menu&mer_id={$now_store['mer_id']}&store_id={$now_store['store_id']}");
    			}
    		}
    		if ($lotteryids) {
    			$lotterys = D("Lottery")->field(true)->where(array('id' => array('in', $lotteryids), 'statdate' => array('lt', time()), 'enddate' => array('gt', time())))->select();
    			foreach ($lotterys as $lottery) {
    				switch ($lottery['type']){
    					case 1:
    						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Lottery&a=index&token={$lottery['token']}&id={$lottery['id']}");
    						break;
    					case 2:
    						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Guajiang&a=index&token={$lottery['token']}&id={$lottery['id']}");
    						break;
    					case 3:
    						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=Coupon&a=index&token={$lottery['token']}&id={$lottery['id']}");
    						break;
    					case 4:
    						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=LuckyFruit&a=index&token={$lottery['token']}&id={$lottery['id']}");
    						break;
    					case 5:
    						$return[] = array('[活动]' . $lottery['title'], $lottery['info'], $this->config['site_url'] . $lottery['starpicurl'], $this->config['site_url'] . "/wap.php?c=GoldenEgg&a=index&token={$lottery['token']}&id={$lottery['id']}");
    						break;
    				}
    			}
    		}
    	}
    	
    	if ($return) {
    		return array($return, 'news');
    	}
    	return array('亲，暂时没有找到与“' . $key . '”相关的内容！请更换内容。', 'text');
    }
    
    
    private function saverelation($openid, $mer_id, $from_merchant)
    {
    	$relation = D('Merchant_user_relation')->field('mer_id')->where(array('openid' => $openid, 'mer_id' => $mer_id))->find();
    	$where = array('img_num' => 1);
    	if (empty($relation)) {
    		$relation = array('openid' => $openid, 'mer_id' => $mer_id, 'dateline' => time(), 'from_merchant' => $from_merchant);
    		D('Merchant_user_relation')->add($relation);
    		$where['follow_num'] = 1;
    		$from_merchant && D('Merchant')->update_group_indexsort($mer_id);
    	} elseif (empty($relation['from_merchant']) && $from_merchant) {
    		D('Merchant')->update_group_indexsort($mer_id);
    		D('Merchant_user_relation')->where(array('openid' => $openid, 'mer_id' => $mer_id))->save(array('from_merchant' => $from_merchant));
    	}
    	D('Merchant_request')->add_request($mer_id, $where);
    }
    //连接路由操作
    private function route()
    {
		
		$nonce = isset($_REQUEST['nonce']) ? $_REQUEST['nonce'] : '';
		$sTimeStamp = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp'] : time();
		$msg_signature = isset($_REQUEST['msg_signature']) ? $_REQUEST['msg_signature'] : '';
		$xml = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		import("@.ORG.aes.WXBizMsgCrypt");
		$pc = new WXBizMsgCrypt($this->config['wx_token'], $this->config['wx_encodingaeskey'], $this->config['wx_appid']);
		$sMsg = "";
		$pc->decryptMsg($msg_signature, $sTimeStamp, $nonce, $xml, $sMsg);
		
		$data = $this->api_notice_increment('http://we-cdn.net', $sMsg);
		$data = str_replace('<?xml version="1.0"?>', '', $data);
		$encryptMsg = "";
		$pc->encryptMsg($data, $sTimeStamp, $nonce, $encryptMsg);
		return $encryptMsg;
    }
    
    private function api_notice_increment($url, $data)
    {
    	$ch = curl_init();
		$headers = array(
				"User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
				"Accept-Language: en-us,en;q=0.5",
				"Referer:http://mp.weixin.qq.com/",
 				'Content-type: text/xml'
		);
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$tmpInfo = curl_exec($ch);
    	curl_close($ch);
    	if (curl_errno($ch)) {
    		return false;
    	} else {
    		return $tmpInfo;
    	}
    }
}