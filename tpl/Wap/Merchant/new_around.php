<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>附近商家</title>
	<else/>
		<title>附近的商家列表</title>
	</if>
	<meta name="keywords" content="{pigcms{$now_category.cat_name},{pigcms{$config.seo_keywords}" />
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
</head>
<body>
        <div id="container">
	        <!--section class="banner"></section>
			<div class="nav-bar">
			    <ul class="nav" style="padding:0rem .2rem;">
		            <li class="dropdown-toggle caret1 category"  style="text-align: left"><span class="nav-head-name">{pigcms{$adress}</span></li><a href="{pigcms{:U('Group/around_adress')}" class="modify">修改</a>
			    </ul>
			</div>		  -->
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<if condition="$list">
		    			<dl class="list list-in">
		       				<volist name="list" id="vo">
			        			<dd>
			        				<a href="{pigcms{$vo.url}" class="react">
										<div class="dealcard">
											<div class="dealcard-img imgbox">
												<img src="{pigcms{$vo.img}" style="width:100%;height:100%;">
											</div>
										    <div class="dealcard-block-right">
												<div class="dealcard-brand single-line">{pigcms{$vo.name}</div>
												<div class="title text-block">[{pigcms{$vo.sname}]</div>
												<div class="title text-block">{pigcms{$vo.adress}<br/>电话：{pigcms{$vo.phone}</div>
												<div class="location_list">约<em>{pigcms{:round($vo['juli']/1000,1)}</em>km</div>
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
						<div class="no-deals">您附近暂时还没有商家</div>
					</if>
				</div>
				<div class="shade hide"></div>
				<div class="loading hide">
			        <div class="loading-spin" style="top:91px;"></div>
			    </div>
			</div>
		</div>
		<script>
			var lat_long = "{pigcms{$lat_long}";
		</script>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/dropdown.js"></script>
		<script src="{pigcms{$static_path}js/grouplist.js"></script>
    	<include file="Public:footer"/>
<script type="text/javascript">
// $(document).ready(function(){
// 	$.get('http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&callback=renderReverse&location=' + lat_long + '&output=json&pois=1', function(data){
// 		$('.nav-head-name').html(data.result.formatted_address);
// 	}, 'jsonp');
// });
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Merchant",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Merchant/around')}",
            "tTitle": "附近的商家",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>