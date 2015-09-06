<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>优惠导航</title>
		<meta name="description" content="{pigcms{$config.seo_description}">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">
		<link href="{pigcms{$static_path}css/iconfont.css" rel="stylesheet"/>
		<link href="{pigcms{$static_path}css/group_navigation.css" rel="stylesheet"/>
		<style>
		.footermenu ul li a img{
			vertical-align: middle;
			border: 0;
		}
		</style>
	</head>
	<body>
		<div class="body" style="position:relative;overflow:hidden;">
			<!--搜索--->
			<form id="searchbox" method="post" action="{pigcms{:U('Search/group')}">
				<input placeholder="输入关键字搜索" class="placeholder" id="keyword" name="w" value="" type="text"/>
				<button id="btnfj" type="button" onclick="window.location.href='{pigcms{:U('Group/around')}'">附近</button>
				<button id="submit" type="submit"><i class="iconfont icon-050"></i></button>
			</form>

			<!----主要内容---->
			<div class="main" style="margin-bottom:10px;">
				<div class="hot">
					<h3><img src="{pigcms{$static_path}images/hot.jpg"/>热门</h3>
					<ul>
						<volist name="wap_center_adver" id="vo">
							<li><div><a href="{pigcms{$vo.url}"><img src="{pigcms{$vo.pic}"/></a></div></li>
						</volist>
						<div style="clear: both;"></div>
					</ul>
				</div>
				<volist name="all_category_list" id="vo">
					<div class="park">
						<h3>
							<div>
								<div></div>
								<div>{pigcms{$vo.cat_name}</div>
							</div>
						</h3>
						<ul>
							<volist name="vo['category_list']" id="voo" offset="0" length="11">
								<li><div><a href="{pigcms{:U('Group/index',array('cat_url'=>$voo['cat_url']))}" <if condition="$voo['is_hot']">style="color:red;"</if>>{pigcms{$voo.cat_name}</a></div></li>
							</volist>
							<if condition="count($vo['category_list']) gt 11">
								<li><div><a href="{pigcms{:U('Group/index',array('cat_url'=>$vo['cat_url']))}" style="color:rgb(104,104,181);">更多></a></div></li>
							</if>
							<div style="clear:both;"></div>
						</ul>
					</div>
				</volist>
			</div>
			<include file="Public:footer"/>
		</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script>
			$(function(){
				$('#searchbox').submit(function(){
					if($('#keyword').val() == ''){
						window.location.href = "{pigcms{:U('Group/index')}";
						return false;
					}
				});
			});
		</script>
		
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Group",
		            "moduleID":"0",
		            "imgUrl": "{pigcms{$config.site_logo}", 
		            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/navigation')}",
		            "tTitle": "优惠导航",
		            "tContent": "网罗全网优惠，查找全城优惠一站搞定"
		};
		</script>
		{pigcms{$shareScript}
	</body>
</html>