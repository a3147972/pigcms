<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>周边商家</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico"/>
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index">
	<!--header  class="navbar">
		<div class="nav-wrap-left">
			<a href="{pigcms{:U('Home/index')}" class="react back">
				<i class="text-icon icon-back"></i>
			</a>
		</div>
		<h1 class="nav-header">周边商家</h1>
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
				</li><li><a class="react" href="{pigcms{:U('My/index')}"><i class="text-icon">⍥</i>
					<space></space>我的</a>
				</li><li><a class="react" href="{pigcms{:U('Search/index',array('type'=>'group'))}"><i class="text-icon">⌕</i>
					<space></space>搜索</a>
			</li></ul>
		</div>
	</header-->
	<div id="around-map"></div>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common_wap.js"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=4c1bb2055e24296bbaef36574877b4e2&v=1.0"></script>
	<script type="text/javascript">
		$('#around-map').height($(window).height()-$('header').height()-$('footer').height()-53);
		var _ary = [<volist name="list" id="vo">[{pigcms{$vo['long']},{pigcms{$vo['lat']},"{pigcms{$vo['name']}","{pigcms{$vo['url']}","{pigcms{$vo['phone']}","{pigcms{$vo['adress']}","{pigcms{$vo['img']}"],</volist>];
	</script>	
	<script type="text/javascript">
		// 百度地图API功能
		var map = new BMap.Map("around-map");            // 创建Map实例
		map.centerAndZoom(new BMap.Point({pigcms{$long},{pigcms{$lat}),13);                 // 初始化地图,设置中心点坐标和地图级别。
		map.addControl(new BMap.ZoomControl());      //添加地图缩放控件
		
// 		map.setCenter('合肥');
		
		var d = getSearchListPoints();
		$.each(d,function(a,d){
			var marker = new BMap.Marker(d.point);
			map.addOverlay(marker);
			// var infoWindow = new BMap.InfoWindow('<div style="line-height:0.5rem;overflow:hidden;"><div style="float:right;margin-left:4px;width:139px;"><img id="imgDemo" src="'+d.img+'" width="139" height="104"/></div><div style="float:left;"><a href="'+d.url+'">'+d.title+'</a><br/>电话：<a href="tel:'+d.phone+'">'+d.phone+'</a><br/>地址：'+d.adress+'</div></div>');
			var infoWindow = new BMap.InfoWindow('<div style="line-height:0.5rem;overflow:hidden;"><img id="imgDemo" src="'+d.img+'" width="139" height="104" style="margin-bottom:0.2rem;"/><br/><a href="'+d.url+'" style="font-size:.35rem;">'+d.title+'</a><br/>电话：<a href="tel:'+d.phone+'">'+d.phone+'</a><br/>地址：'+d.adress+'</div>');
			marker.addEventListener("click", function(){
				this.openInfoWindow(infoWindow);
				document.getElementById('imgDemo').onload = function (){
					infoWindow.redraw();
				}
			});
		});
		function getSearchListPoints(){
			var $$=[],b;
			for(b in _ary){
				8!=_ary[b][0] && $$.push({
					point:new BMap.Point(_ary[b][0],_ary[b][1]),
					title:_ary[b][2],
					url:_ary[b][3],
					index:b,
					phone:_ary[b][4],
					adress:_ary[b][5],
					img:_ary[b][6]
				});
			}
			return $$;
		}
	</script>
	<include file="Public:footer"/>
</body>
</html>