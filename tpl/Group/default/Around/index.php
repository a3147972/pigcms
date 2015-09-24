<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>身边{pigcms{$config.group_alias_name}-选择位置 | {pigcms{$config.site_name}</title>
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.v113ea197.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.v492b572b.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/search-box.v6656b683.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/cate-nav.v4299f875.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/around.v2be69a85.css" />
	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script type="text/javascript">
	var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
	<script type="text/javascript">
	 var group_alias_name = "{pigcms{$config.group_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/group_around_map.js"></script>
</head>
<body id="index" style="position:static;">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<h2 style="font-size:18px;margin:20px 0;">身边{pigcms{$config.group_alias_name}</h2>
				<div class="pg-around-position">
					<div class="bd">
						<p class="location-label">我的位置：</p>
						<p class="mobile-link">
							<span class="F-glob F-glob-phone mobile-icon"></span>
							访问 <a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank">微信版</a>，随时随地查看附近{pigcms{$config.group_alias_name}
						</p>
						<p class="locate-map" id="locate-map">您可以点击地图直接定位</p>
						<div class="left-box">
							<form name="aroundForm" id="aroundForm">
								<div class="search cf">
									<input type="text" class="s-text" name="q" id="aroundQ" placeholder="请输入完整地址或公交/地铁站名" value="" autocomplete="off" />
									<input type="submit" class="s-submit" value="定位" hidefocus="true"/>
								</div>
							</form>
							<div id="result-panel" class="result-panel"></div>
						</div>
						<div id="around-map"></div>
					</div>
				</div>
			</div>
		</div>
		<include file="Public:footer"/>
	</body>
</html>
