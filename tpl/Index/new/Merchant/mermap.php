<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
<!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
<script src="{pigcms{$static_path}js/navfix.js"></script>	
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js" type="text/javascript"></script>
<script src="http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
<style>.BMapLib_SearchInfoWindow{font-size:14px;font-family:'微软雅黑'}#container{height:500px;margin:15px 15px 0;}.declaration{color:#999;font-size:12px;text-align:right;margin-right:20px;}.BMap_cpyCtrl{display:none;}.BMapLib_bubble_content{height:85px!important;}.BMapLib_trans{top:123px!important;}
.poi-wrapper .biz-info__title {
    height: 36px;
    line-height: 36px;
    padding-right: 15px;
    position: relative;
}
#J-bizinfo-list .biz-info {float: left;margin: 20px 5px;width: 32%;}
.link-item a{color: #EE3968;}
</style>
<!--[if IE 6]>
<script  src="js/DD_belatedPNG_0.0.8a.js" mce_src="js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   /* EXAMPLE */
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

   /* string argument can be any CSS selector */
   /* .png_bg example is unnecessary */
   /* change it to what suits you! */
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
        body{ behavior:url("csshover.htc"); 
		}
 
	 
			}
        </style>
<![endif]-->
<!--<link rel="stylesheet" href="http://bdimg.share.baidu.com/static/api/css/share_style0_16.css?v=8105b07e.css" />-->
</head>
<body>
<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<div class="video">
<section class="server">
<div class="shop_video">
		<h2 class="content-title" id="business-info">商家位置</h2>
		<div id="side-business" class="J-poi-wrapper poi-wrapper cf">
			<div class="address-list cf">
				<div class="left-content">
					<div id="cmmap" style="overflow:hidden;zoom:1;position:relative;">
						<div id="container"></div>
					</div>
					<p class="declaration">注：地图位置坐标仅供参考，具体情况以实际道路标识信息为准</p>
				</div>
				<div class="biz-wrapper J-biz-wrapper biz-wrapper-nobottom inited">
					<div id="J-bizinfo-list" class="all-biz cf">
					   <php>$nowstore=$storelist['0'];</php>
						<volist name="storelist" id="vo">
						   <php>if($vo['store_id']==$store_id){$nowstore=$vo;}</php>
							<div class="biz-info <if condition="$i eq 1">biz-info--open biz-info--first</if> <if condition="count($storelist) eq 1">biz-info--only</if>">
								<h5 class="biz-info__title">
									<a class="poi-link" title="{pigcms{$vo.name}" href="javascript:void(0);">{pigcms{$vo.name}</a><i class="F-glob F-glob-caret-down-thin down-arrow"></i>
								</h5>
								<div class="biz-info__content">
									<div class="biz-item field-group" title="{pigcms{$vo.area_name}{pigcms{$vo.adress}"><label class="title-label">地址：</label>{pigcms{$vo.area_name}{pigcms{$vo.adress}</div>
									<div class="biz-item link-item">
										<a class="view-map" href="/mermap/{pigcms{$merid}.html?sid={pigcms{$vo['store_id']}">查看地图</a>
										&nbsp;&nbsp;&nbsp;
										<a class="search-path" href="javascript:void(0)" shop_name="{pigcms{$vo.adress}">公交/驾车去这里</a>
									</div>
									<div class="biz-item"><span class="title-label">电话：</span>{pigcms{$vo.phone}</div>
								</div>
							</div>
						</volist>
		
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="shop_video_list">
    </div>
  </section>
</div>
<include file="Public:footer"/>
</body>
		<script type="text/javascript">
			var map = new BMap.Map('container');
			//添加缩放
			map.addControl(new BMap.NavigationControl());
			//定位
			var point = new BMap.Point({pigcms{$nowstore['long']},{pigcms{$nowstore['lat']});
			
			map.centerAndZoom(point,18);
			
			//添加缩放条
			map.addControl(new BMap.NavigationControl());
			//启用滚轮放大缩小
			map.enableScrollWheelZoom();
			
			//标记
			var marker = new BMap.Marker(point);
			map.addOverlay(marker);
			
			var content = "<b>地址：</b>{pigcms{$vo.area_name}{pigcms{$nowstore['adress']}<br/><b>电话：</b>{pigcms{$nowstore['phone']}<br/><b>线路：</b><a href='http://map.baidu.com/m?word={pigcms{$nowstore['adress']|urlencode=###}' target='_blank'>公交/驾车路线查询»</a>";
			//创建检索信息窗口对象
			var searchInfoWindow = null;
			searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
				title  : "{pigcms{$nowstore['name']}",      //标题
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
	//商家位置
	$.each($('.search-path'),function(i,item){
		$(item).attr({'href':'http://map.baidu.com/m?word='+encodeURIComponent($(item).attr('shop_name')),'target':'_blank'});
	});
		</script>
</html>