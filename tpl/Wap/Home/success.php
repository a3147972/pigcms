<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>成功提示</title>
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	</head>
	<body>
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{$url}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">成功提示</h1>
            <div class="nav-wrap-right">
                <a class="react" rel="nofollow" href="{pigcms{:U('My/index')}">
                    <span class="nav-btn">
                        <i class="text-icon">⍥</i>我的
                    </span>
                </a>
            </div>
        </header>
        <script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>var location_url = '{pigcms{$url}';layer.open({title:['成功提示','background-color:#8DCE16;color:#fff;'],content:'{pigcms{$msg}',end:function(){location.href=location_url;}});</script>
	</body>
</html>