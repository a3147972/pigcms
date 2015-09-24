<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$query_type} | 生活缴费</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/lifeservice.css?1a" rel="stylesheet"/>
</head>
<body>
	<div id="container">
		<div class="query-container">
			<div class="query_div {pigcms{$_GET.type}_ico"></div>
			<div class="area_tips">{pigcms{$now_city.area_name} {pigcms{$query_type}</div>
			<div class="area_input"><input type="tel" id="recharge_txt" placeholder="请输入您的户号" value="{pigcms{$user_info.account}"/><span class="nametip">{pigcms{$user_info.accountName}</span></div>
			<div class="area_btn"><input type="button" id="recharge_btn" value="查询"/></div>
		</div>
	</div>
	<footer>
		<a href="{pigcms{:U('Home/index')}">平台首页</a> | <a href="javascript:void(0);" id="service_help">帮助说明</a> | <a href="{pigcms{:U('My/lifeservice')}">缴费记录</a>
	</footer>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}layer/layer.m.js"></script>
	<script>var query_type="{pigcms{$_GET.type}",account="{pigcms{$user_info.account}",service_action="{pigcms{:U('Lifeservice/post')}",login_url = "{pigcms{:U('Login/index',array('referer'=>urlencode(U('Lifeservice/query',array('type'=>$_GET['type'])))))}",my_url = "{pigcms{:U('My/index')}",my_recharge_url = "{pigcms{:U('My/recharge')}",order_url="{pigcms{:U('My/lifeservice_detail')}";</script>
	<script src="{pigcms{$static_path}js/lifeservice.js?1a"></script>
	<script type="text/javascript">
		window.shareData = {
			"moduleName":"Group",
			"moduleID":"0",
			"imgUrl": "", 
			"sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Lifeservice/query',array('type'=>$_GET['type']))}",
			"tTitle": "{pigcms{$query_type}|生活缴费_{pigcms{$config.site_name}",
			"tContent": ""
		};
	</script>
	{pigcms{$shareScript}
</body>
</html>