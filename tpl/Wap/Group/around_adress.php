<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>选取坐标</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico"/>
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body>
	<div id="around-map"></div>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=4c1bb2055e24296bbaef36574877b4e2&v=1.0"></script>
	<script type="text/javascript">
		$('#around-map').height($(window).height()-$('header').height()-$('footer').height()-49);
		var marker = null;
		// 百度地图API功能
		var map = new BMap.Map("around-map");            // 创建Map实例
		map.centerAndZoom({pigcms{$map_center},13);                 // 初始化地图,设置中心点坐标和地图级别。
		map.addControl(new BMap.ZoomControl());      //添加地图缩放控件	
		setTimeout(function(){
			var point = new BMap.Point(map.getCenter().lng,map.getCenter().lat);
			if(marker == null){
				marker = new BMap.Marker(new BMap.Point(map.getCenter().lng,map.getCenter().lat));  //创建标注
				map.addOverlay(marker);                 // 将标注添加到地图中
			}else{
				marker.setPosition(point);
			}
		},1000);
		var gc = new BMap.Geocoder();
		map.addEventListener("click",function(e){
			gc.getLocation(e.point, function(rs){
				if(marker == null){
					marker = new BMap.Marker();
					map.addOverlay(marker);
				}else{
					marker.setPosition(e.point);
				}
				var addComp = rs.addressComponents;
				var infoWindow = new BMap.InfoWindow('<div style="line-height:0.5rem;overflow:hidden;">' + addComp.city + addComp.district + addComp.street + '<br/><a href="javascript:void();" style="font-size:.35rem;" onclick="setSelect(\''+ addComp.city + addComp.district + addComp.street +'\',\''+e.point.lat+'\',\''+e.point.lng+'\')">查看附近{pigcms{$config.group_alias_name}</a></div>');
				marker.openInfoWindow(infoWindow);
			});
		});
		function setSelect(adress,lat,lng){
			var exp = new Date();
			exp.setTime(exp.getTime() + 365*24*60*60*1000);
			document.cookie = "around_adress=" + encodeURIComponent(adress) + ";expires=" + exp.toGMTString(); 
			document.cookie = "around_lat=" + lat + ";expires=" + exp.toGMTString(); 
			document.cookie = "around_long=" + lng + ";expires=" + exp.toGMTString(); 
			window.location.href = "{pigcms{:U('Group/around')}";
		}
	</script>
	<include file="Public:footer"/>
{pigcms{$shareScript}
</body>
</html>