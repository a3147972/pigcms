<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>【{pigcms{$now_store.name}】查看线路_{pigcms{$config.site_name}</title>
	
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index" data-com="pagecommon">
		<iframe id="frame_src" style="width:100%;height:100%;border:none;" src="http://weixianchang.duapp.com/dh.php?lat={pigcms{$now_store.lat}&lng={pigcms{$now_store.long}&title={pigcms{:urlencode($now_store['name'])}&a={pigcms{:urlencode($now_store['area_name'].$now_store['adress'])}"></iframe>
		
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script>
		$(function(){
			$('#frame_src').height($(window).height()-$('.footermenu ul').height()-4);
		});
		</script>
		<include file="Public:footer"/>
</body>
</html>