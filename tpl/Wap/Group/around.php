<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>附近{pigcms{$config.group_alias_name}</title>
	<else/>
		<title>附近的{pigcms{$config.group_alias_name}列表_{pigcms{$config.site_name}</title>
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
	        <!--section class="banner"></section>  -->
			<div class="nav-bar">
			    <ul class="nav" style="padding:0rem .2rem;">
		            <li class="dropdown-toggle caret1 category"  style="text-align: left"><span class="nav-head-name">{pigcms{$adress}</span></li><a href="{pigcms{:U('Group/around_adress')}" class="modify">修改</a>
			    </ul>
			</div>		
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<if condition="$group_list">
		    			<dl class="list list-in">
		       				<volist name="group_list" id="vo">
			        			<dd>
			        				<a href="{pigcms{$vo.url}" class="react">
										<div class="dealcard">
											<div class="dealcard-img imgbox">
												<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;">
											</div>
										    <div class="dealcard-block-right">
												<if condition="$vo['tuan_type'] neq 2">
													<div class="dealcard-brand single-line">{pigcms{$vo.merchant_name}</div>
													<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
												<else/>
													<div class="dealcard-brand single-line">{pigcms{$vo.s_name}</div>
													<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
												</if>
										        <div class="price">
										            <strong>{pigcms{$vo.price}</strong>
										            <span class="strong-color">元</span>
										            <if condition="$vo['wx_cheap']">
														<span class="tag">微信再减{pigcms{$vo.wx_cheap}元</span>
										            <else/>
										            	<del>{pigcms{$vo.old_price}元</del>
										            </if>
										            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>													
										        </div>
												<if condition="isset($group_around_range[$vo['group_id']])">
													<div class="location_list">约<em>{pigcms{:round($group_around_range[$vo['group_id']]/1000,1)}</em>km</div>
												</if>
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
						<div class="no-deals">您附近暂时还没有{pigcms{$config.group_alias_name}</div>
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
$(document).ready(function(){
	$.get('http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&callback=renderReverse&location=' + lat_long + '&output=json&pois=1', function(data){
		$('.nav-head-name').html(data.result.formatted_address);
	}, 'jsonp');
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/index')}",
            "tTitle": "{pigcms{$config.group_alias_name}列表_{pigcms{$config.site_name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>