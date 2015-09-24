<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>门店列表</title>
	<else/>
		<title>{pigcms{$now_category.cat_name}门店列表_{pigcms{$config.site_name}</title>
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
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('Home/index')}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">门店列表</h1>
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
					<li><a class="react" href="{pigcms{:U('Search/index')}"><i class="text-icon">⌕</i>
						<space></space>搜索</a>
					</li>
				</ul>
			</div>
        </header>
        <div id="container">
	        <!--section class="banner"></section>  -->
			<div class="nav-bar">
			    <ul class="nav">
		            <li class="dropdown-toggle caret category" data-nav="category"><span class="nav-head-name"><if condition="$now_category">{pigcms{$now_category.cat_name}<else/>全部分类</if></span></li>
		            <if condition="$all_area_list">
		            	<li class="dropdown-toggle caret biz subway" data-nav="biz"><span class="nav-head-name"><if condition="$now_area">{pigcms{$now_area.area_name}<else/>全城</if></span></li>
		            </if>
		            <li class="dropdown-toggle caret sort" data-nav="sort"><span class="nav-head-name">{pigcms{$now_sort_array.sort_value}</span></li>
			    </ul>
			    <div class="dropdown-wrapper">
			        <div class="dropdown-module">
			            <div class="scroller-wrapper">
			                <div id="dropdown_scroller" class="dropdown-scroller" style="overflow:hidden;">
			                    <ul>
			                        <li class="category-wrapper">
			                            <ul class="dropdown-list">
			                            	<li data-category-id="-1" <if condition="empty($top_category)">class="active"</if>><span>全部分类</span></li>
			                            	<volist name="all_category_list" id="vo">
			                            		<li data-category-id="{pigcms{$vo.cat_url}" <if condition="$vo['cat_count'] gt 1">data-has-sub="true"<else/>onclick="list_location($(this));return false;"</if> class="<if condition="$vo['cat_count'] gt 1">right-arrow-point-right</if> <if condition="$top_category['cat_url'] eq $vo['cat_url']">active</if>">
			                            			<span>{pigcms{$vo.cat_name}</span>
			                            			<if condition="$vo['cat_count'] gt 1"><span class="quantity"><b></b></span></if>
			                            			<div class="sub_cat hide" style="display:none;">
			                            				<if condition="$vo['cat_count'] gt 1">
			                            					<ul class="dropdown-list">
				                            					<li data-category-id="{pigcms{$vo.cat_url}" onclick="list_location($(this));return false;"><div><span class="sub-name">全部</span></div></li>
				                            					<volist name="vo['category_list']" id="voo" key="j">
				                            						<li data-category-id="{pigcms{$voo.cat_url}" onclick="list_location($(this));return false;"><div><span class="sub-name">{pigcms{$voo.cat_name}</span></div></li>
				                            					</volist>
			                            					</ul>
			                            				</if>
			                            			</div>
			                            		</li>
			                            	</volist>
			                            </ul>
			                        </li>
			                        <if condition="$all_area_list">
			                        <li class="biz-wrapper">
			                            <ul class="dropdown-list">
			                            	<li data-area-id="-1" <if condition="empty($now_area_url)">class="active"</if> onclick="list_location($(this));return false;"><span>全城</span></li>
			                            	<volist name="all_area_list" id="vo">
			                            		<li data-area-id="{pigcms{$vo.area_url}" <if condition="$vo['area_url'] eq $now_area_url">class="active"</if> onclick="list_location($(this));return false;"><span>{pigcms{$vo.area_name}</span></li>
											</volist> 		
			                            </ul>
			                        </li>
			                        </if>
			                        <li class="sort-wrapper">
			                            <ul class="dropdown-list">
			                            	<volist name="sort_array" id="vo">
			                            		<li data-sort-id="{pigcms{$vo.sort_id}" <if condition="$vo['sort_id'] eq $now_sort_array['sort_id']">class="active"</if> onclick="list_location($(this));return false;"><span>{pigcms{$vo.sort_value}</span></li>
			                            	</volist>
			                            </ul>
			                        </li>
			                    </ul>
			                </div>
			                <div id="dropdown_sub_scroller" class="dropdown-sub-scroller" style="overflow: hidden;"></div>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<if condition="$store_list">
		    			<dl class="list list-in">
		       				<volist name="store_list" id="vo">
			        			<dd>
			        				<a href="{pigcms{:U('Store/detail', array('store_id' => $vo['store_id'], 'set' => 'set'))}" class="react">
										<div class="dealcard">
											<div class="dealcard-img imgbox">
												<img src="{pigcms{$vo.image}" style="width:100%;height:100%;">
											</div>
										    <div class="dealcard-block-right">
												<div class="dealcard-brand single-line">{pigcms{$vo.name}</div>
												<div class="title text-block">{pigcms{$vo.adress}</div>
										        <div class="price">
										            <strong>&nbsp;</strong>
										            <span class="strong-color">&nbsp;</span>
										            <span class="tag line-right" style="background: #075CF9;">约<em>{pigcms{$vo['juli']}</em></span>
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
						<div class="no-deals">暂您要查询的门店</div>
					</if>
				</div>
				<div class="shade hide"></div>
				<div class="loading hide">
			        <div class="loading-spin" style="top:91px;"></div>
			    </div>
			</div>
		</div>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/dropdown.js"></script>
		<script>
			var location_url = "{pigcms{:U('Store/index')}";
			var now_cat_url="<if condition="!empty($now_cat_url)">{pigcms{$now_cat_url}<else/>-1</if>";
			var now_area_url="<if condition="!empty($now_area_url) && $all_area_list">{pigcms{$now_area_url}<else/>-1</if>";
			var now_sort_id="<if condition="!empty($now_sort_array)">{pigcms{$now_sort_array.sort_id}<else/>defaults</if>";
		</script>
		<script src="{pigcms{$static_path}js/grouplist.js"></script>

<script type="text/javascript">
window.shareData = {  
            "moduleName":"Store",
            "moduleID":"0",
            "imgUrl": "", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Store/index')}",
            "tTitle": "{pigcms{$config.group_alias_name}列表_{pigcms{$config.site_name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>