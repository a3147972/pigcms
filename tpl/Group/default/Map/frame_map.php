<!doctype html>
<html>
	<head>
		<script src="http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2"></script>
		<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
		<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
		<style>body,html{margin:0;padding:0;width:100%;height:100%;overflow:hidden;font-family:'微软雅黑'}.BMapLib_SearchInfoWindow{font-size:14px;font-family:'微软雅黑'}#container{height:500px;margin:15px 15px 0;}.declaration{color:#999;font-size:12px;text-align:right;margin-right:20px;}.BMap_cpyCtrl{display:none;}.BMapLib_bubble_content{height:85px!important;}.BMapLib_trans{top:123px!important;}</style>
	</head>
	<body>
		<div id="cmmap" style="overflow:hidden;zoom:1;position:relative;">
			<div id="container"></div>
		</div>
		<p class="declaration">注：地图位置坐标仅供参考，具体情况以实际道路标识信息为准</p>
		<script type="text/javascript">
			var map = new BMap.Map('container');
			//添加缩放
			map.addControl(new BMap.NavigationControl());
			
			//定位
			var point = new BMap.Point({pigcms{$_GET['map_point']});
			map.centerAndZoom(point,18);
			
			//添加缩放条
			map.addControl(new BMap.NavigationControl());
			//启用滚轮放大缩小
			map.enableScrollWheelZoom();
			
			//标记
			var marker = new BMap.Marker(point);
			map.addOverlay(marker);
			
			var content = "<b>地址：</b>{pigcms{$_GET['store_adress']}<br/><b>电话：</b>{pigcms{$_GET['store_phone']}<br/><b>线路：</b><a href='http://map.baidu.com/m?word={pigcms{$_GET['store_adress']|urlencode=###}' target='_blank'>公交/驾车路线查询»</a>";
			//创建检索信息窗口对象
			var searchInfoWindow = null;
			searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
				title  : "{pigcms{$_GET['store_name']}",      //标题
				width  : 290,             //宽度
				height : 60,              //高度
				panel  : "panel",         //检索结果面板
				enableAutoPan : true,     //自动平移
				searchTypes   :[]
			});
			
			searchInfoWindow.open(marker); //在marker上打开检索信息串口
			marker.addEventListener("click", function(){          
				searchInfoWindow.open(marker); //开启信息窗口
			});
			
		</script>
	</body>
</html>