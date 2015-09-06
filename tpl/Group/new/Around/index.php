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
    
<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/list.css"/>

<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/around.v2be69a85.css" />
	<script type="text/javascript">
	 var group_alias_name = "{pigcms{$config.group_alias_name}";
     var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/list.js"></script>
<script src="{pigcms{$static_path}js/group_around_map.js"></script>
</head>
<body id="index" style="position:static;">
<include file="Public:header_top"/>
	<div id="doc" class="body">
		<article>
			<div class="menu cf">
				<div class="menu_left hide">
					<div class="menu_left_top"><img src="{pigcms{$static_path}images/o2o1_27.png" /></div>
					<div class="list">
						<ul>
							<volist name="all_category_list" id="vo" key="k">
								<li>
									<div class="li_top cf">
										<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
										<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
									</div>
									<if condition="$vo['cat_count'] gt 1">
										<div class="li_bottom">
											<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
												<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
											</volist>
										</div>
										<div class="list_txt">
											<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
											<volist name="vo['category_list']" id="voo" key="j">
												<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a>
											</volist>
										</div>
									</if>
								</li>
							</volist>
						</ul>
					</div>
				</div>
				<div class="menu_right cf">
					<div class="menu_right_top">
						<ul>
							<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
								<li class="ctur">
									<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
								</li>
							</pigcms:slider>
						</ul>
					</div>
				</div>
			</div>
		</article>
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
	</div>
	<include file="Public:footer"/>
	</body>
</html>
