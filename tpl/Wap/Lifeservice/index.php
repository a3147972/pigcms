<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>生活缴费</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link href="{pigcms{$static_path}css/lifeservice.css?2a" rel="stylesheet"/>
</head>
<body>
	<div id="container">
		<div class="service-container">
			<ul>
				<if condition="in_array('water',$liveServiceTypeArr)">
					<li>
						<a href="{pigcms{:U('Lifeservice/query',array('type'=>'water'))}">
							<div class="ico water_ico"></div>
							<div class="txt">水费</div>
						</a>
					</li>
				</if>
				<if condition="in_array('electric',$liveServiceTypeArr)">
					<li>
						<a href="{pigcms{:U('Lifeservice/query',array('type'=>'electric'))}">
							<div class="ico electric_ico"></div>
							<div class="txt">电费</div>
						</a>
					</li>
				</if>
				<if condition="in_array('gas',$liveServiceTypeArr)">
					<li>
						<a href="{pigcms{:U('Lifeservice/query',array('type'=>'gas'))}">
							<div class="ico gas_ico"></div>
							<div class="txt">燃气费</div>
						</a>
					</li>
				</if>
			</ul>
		</div>
	</div>
	<footer>
		<a href="{pigcms{:U('Home/index')}">平台首页</a> | <a href="javascript:void(0);" id="service_help">帮助中心</a> | <a href="{pigcms{:U('My/lifeservice')}">缴费记录</a>
	</footer>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}layer/layer.m.js"></script>
	<script>var account='';</script>
	<script src="{pigcms{$static_path}js/lifeservice.js?2a"></script>
	<script type="text/javascript">
		window.shareData = {
			"moduleName":"Group",
			"moduleID":"0",
			"imgUrl": "", 
			"sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Lifeservice/index')}",
			"tTitle": "生活缴费_{pigcms{$config.site_name}",
			"tContent": ""
		};
	</script>
	{pigcms{$shareScript}
</body>
</html>