<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>附近的{pigcms{$config.meal_alias_name}列表_{pigcms{$config.site_name}</title>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
	<style>.navbar{background:#F03C03;border-bottom:1px solid #F03C03;}.navbar .nav-dropdown{background:#F03C03;}.nav-dropdown li{border-bottom:1px solid #FF658E;}</style>
</head>
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('Home/index')}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">附近的{pigcms{$config.meal_alias_name}店铺列表</h1>
			<div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
					<span class="nav-btn">
						<i class="text-icon">≋</i>导航
					</span>
				</a>
			</div>
			<div id="nav-dropdown" class="nav-dropdown">
				<ul>
					<li><a class="react" href="{pigcms{:U('Home/index')}"><i class="text-icon">⟰</i>
						<space></space>首页</a>
					</li>
					<li><a class="react" href="{pigcms{:U('My/index')}"><i class="text-icon">⍥</i>
						<space></space>我的</a>
					</li>
					<li><a class="react" href="{pigcms{:U('Search/index',array('type'=>'meal'))}"><i class="text-icon">⌕</i>
						<space></space>搜索</a>
					</li>
				</ul>
			</div>
        </header>
        <!--section class="banner"></section>  -->
		<div class="nav-bar">
		    <ul class="nav">
	            <li class="dropdown-toggle caret1 category"  style="text-align: left"><span class="nav-head-name"></span></li><a href="" class="modify">修改</a>
		    </ul>
		</div>
		<div class="deal-container">
			<div class="deals-list" id="deals">
			<if condition="$group_list">
    			<dl class="list list-in">
       				<volist name="group_list" id="vo">
	        			<dd>
	        				<a href="{pigcms{:U('Meal/menu', array('mer_id' => $vo['mer_id'], 'store_id' => $vo['store_id']))}" class="react">
								<div class="dealcard" data-did="{pigcms{$vo.store_id}">
							        <div class="dealcard-img imgbox">
							        	<img src="{pigcms{$vo.image}" style="width:100%;height:100%;">
							        </div>
								    <div class="dealcard-block-right">
										<div class="dealcard-brand single-line">{pigcms{$vo.name}</div>
								        <div class="title text-block">【{pigcms{$vo.area_name}】{pigcms{$vo.name}</div>
								        <div class="price">
								        	<if condition="$vo['mean_money'] gt 0">
								            <strong>{pigcms{$vo.mean_money}</strong>
								            <span class="strong-color">元</span>
								            <else />
								            <strong>&nbsp;</strong>
								            <span class="strong-color">&nbsp;</span>
								            </if>
								            <span class="tag" style="background: #075CF9;">约<em>{pigcms{:round($vo['juli']/1000,1)}</em>km</span>
								            <span class="line-right">已售{pigcms{$vo['sale_count']}</span>
								        </div>
								    </div>
								</div>
	       					</a>
	       				</dd>
	       			</volist>
				</dl>
				<if condition="$pagebar">
				<dl class="list">
					<dd>
						<div class="pager">{pigcms{$pagebar}</div>
					</dd>
				</dl>
				</if>
			<else/>	
				<div class="no-deals">暂无区域的餐饮店，请查看其他分类</div>
			</if>
			</div>
			<div class="shade hide"></div>
			<div class="loading hide">
		        <div class="loading-spin" style="top: 91px;"></div>
		    </div>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/dropdown.js"></script>
		<include file="Public:footer"/>

<script type="text/javascript">
var lat_long = "{pigcms{$lat_long}";
$(document).ready(function(){
	$.get('http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&callback=renderReverse&location=' + lat_long + '&output=json&pois=1', function(data){
		$('.nav-head-name').html(data.result.formatted_address);
	}, 'jsonp');
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Meal_list",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Meal_list/around')}",
            "tTitle": "{pigcms{$config.meal_alias_name}店铺列表_{pigcms{$config.site_name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>