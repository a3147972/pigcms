<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>支付跳转</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body>
	<!--header  class="navbar">
        <h1 class="nav-header">支付跳转</h1>
    </header-->
	<script src="{pigcms{$static_path}layer/layer.m.js"></script>
	<script>layer.open({type:2,content:'支付跳转中,请稍等',shadeClose:false});</script>
	<if condition="$url">
		<script>window.location.href = '{pigcms{$url}';</script>
	<elseif condition="$form"/>
		{pigcms{$form}
	</if>
{pigcms{$hideScript}
</body>
</html>