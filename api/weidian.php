<?php

function curl_post($url, $post)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

echo "\r\n";
error_reporting(0);
session_start();

if (!(true == empty($_POST['certificate']))) {
	$certificate = trim($_POST['certificate']);
	$salt = 'pigcms';
	$post_data = array();
	$post_data['certificate'] = trim($certificate);
	$post_data['app_id'] = 1;
	$sort_data = $post_data;
	$sort_data['salt'] = $salt;
	ksort($sort_data);
	$sign_key = sha1(http_build_query($sort_data));
	$post_data['sign_key'] = $sign_key;
	$post_data['request_time'] = time();
	$url = 'http://v.meihua.com/api/login.php';
	$result = json_decode(curl_post($url, $post_data), true);
	if ((0 == $result['error_code']) && (false == empty($result['return_url']))) {
		$_SESSION['status'] = 'logined';
		$_SESSION['return_url'] = $result['return_url'];
		echo json_encode(array('error_code' => 0));
		exit();
	}
	else {
		echo json_encode(array('error_code' => $result['error_code'], 'error_msg' => $result['error_msg']));
		exit();
	}
}
else if (('logined' == @$_SESSION['status']) && (false == empty($_SESSION['return_url']))) {
	echo '<html><body style="padding: 0px; margin: 0px; zoom: 1;">';
	echo '<script type="text/javascript" src="../static/weidian/js/jquery.min.js"></script>';
	echo '<script type="text/javascript" language="javascript">  ' . "\r\n\t" . '$(function(){' . "\t\r\n\t\t" . '$(window).resize(function(){' . "\r\n\t\t" . '   iFrameHeight();' . "\r\n\t\t" . '});' . "\r\n\t" . '});' . "\r\n\t" . 'function iFrameHeight() {' . "\r\n" . '        var ifm= document.getElementById("iframepage");' . "\r\n" . '            if(ifm != null) {' . "\r\n" . '            ifm.height = $(document).height();' . "\r\n" . '        }' . "\r\n" . '    }' . "\r\n\t" . '</script>';
	echo '<iframe id="iframepage" style="margin:0;" frameborder="0"  height="100%" width="100%" src="' . $_SESSION['return_url'] . '" name="iframepage" marginwidth="0" marginheight="0">';
	echo '</body></html>';
}
else {
	echo '<!DOCTYPE html>' . "\r\n" . '<html>' . "\r\n" . '<head>' . "\r\n" . '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\r\n" . '<title>登录 - 微店</title>' . "\r\n" . '<meta name="author" content="">' . "\r\n" . '<meta name="keywords" content="">' . "\r\n" . '<meta name="description" content="">' . "\r\n" . '<link href="../static/weidian/css/base.css" type="text/css" rel="stylesheet">' . "\r\n" . '<link href="../static/weidian/css/login.css" type="text/css" rel="stylesheet">' . "\r\n" . '<script type="text/javascript" src="../static/weidian/js/jquery.min.js"></script>' . "\r\n" . '<script type="text/javascript" src="../static/weidian/js/login.js"></script>' . "\r\n" . '</head>' . "\r\n" . '<body style="padding: 0px; margin: 0px;">' . "\r\n" . '<div id="loginPane" class="kd-regist">' . "\r\n\t" . '<div class="kd-regist-wrapper">' . "\r\n\t\t" . '<div class="kd-regist-title">用户登录</div>' . "\r\n\t\t" . '<div style="font-size:12px;margin-bottom:15px;">小提示：登录凭证在手机端分销管理界面获取</div>' . "\r\n\t\t" . '<div class="J_textboxPrompt input-pwd">' . "\r\n\t\t\t" . '<input id="certificate" name="certificate" type="text" autocomplete="off">' . "\r\n\t\t\t" . '<label class="input-text" style="display: block;">请输入您的登录凭证</label>' . "\r\n\t\t\t" . '<span class="icon"></span>' . "\r\n\t\t" . '</div>' . "\r\n\t\t" . '<div id="J_loginError" class="kd-form-error"></div>' . "\r\n\t\t" . '<input id="loginValidate" class="kd-form-btn" type="button" value="登' . "\t" . '录" style="width:320px;">' . "\r\n\t" . '</div>' . "\r\n" . '</div>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n";
}

?>
