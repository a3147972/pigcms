<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$title}列表</title>
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
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('Home/index')}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">{pigcms{$title}列表</h1>
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
					<!--li><a class="react" href="{pigcms{:U('Search/index')}"><i class="text-icon">⌕</i>
						<space></space>搜索</a>
					</li-->
				</ul>
			</div>
        </header>
        <div id="container">
	        <!--section class="banner"></section>  -->
			
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<if condition="$lottery_list">
		    			<dl class="list list-in">
		       				<volist name="lottery_list" id="vo">
			        			<dd>
			        				<a href="{pigcms{$vo.url}" class="react">
										<div class="dealcard">
											<div class="dealcard-img imgbox">
												<img src="{pigcms{$vo.starpicurl}" style="width:100%;height:100%;">
											</div>
										    <div class="dealcard-block-right">
												<div class="dealcard-brand single-line">[{pigcms{$vo.name}]{pigcms{$vo.title}</div>
												<div class="title text-block">{pigcms{$vo.info}</div>
										        <div class="price">
										            <strong>&nbsp;</strong>
										            <span class="strong-color">&nbsp;</span>
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
						<div class="no-deals">商家做活动不积极，暂时还没相应的活动</div>
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