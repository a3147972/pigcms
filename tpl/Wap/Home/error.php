<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>错误提示</title>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body>
        <script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>var location_url = '{pigcms{$url}';layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'{pigcms{$msg}',btn: ['确定'],end:function(){location.href=location_url;}});</script>
</body>
</html>