<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{pigcms{$config.meal_alias_name}列表_{pigcms{$now_area.area_name}_{pigcms{$now_circle.area_name}_{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/css.css" type="text/css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css" rel="stylesheet" type="text/css" />
<link href="{pigcms{$static_path}css/order.css" type="text/css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/meal_list.css" type="text/css" rel="stylesheet" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/list.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
<!--[if IE 6]>
	<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
<![endif]-->
<!--[if lt IE 9]>
	<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
<![endif]-->

<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
	body{ behavior:url("csshover.htc");}
	.category_list li:hover .bmbox {filter:alpha(opacity=50);}
</style>
<![endif]-->
</head>
<body>
<include file="Public:header_top"/>
<div class="order_color">
	<a href="{pigcms{$config.site_url}/merchant.php"><img src="{pigcms{$static_path}images/dingcan_03.png" /></a>
</div>

<div class="header_list body">
	<div class="menu cf">
		<div class="menu_left hide">
			<div class="menu_left_top">
				<div class="menu_left_top_icon">
					<img src="{pigcms{$static_path}images/o2o5-24_31.png" />
				</div>  
				<div class="menu_left_top_txt">全部分类</div>
			</div>
			<div class="list">
				<ul>
					<volist name="all_category_list" id="vo" key="k">
						<li>
							<div class="li_top cf">
								<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
								<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
							</div>
							<if condition="$vo['cat_count'] gt 1">
								<div class="li_bottom">
									<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
										<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
									</volist>
								</div>
								<div class="list_txt">
									<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
									<volist name="vo['category_list']" id="voo" key="j">
										<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a>
									</volist>
								</div>
							</if>
						</li>
					</volist>
				</ul>
			</div>
		</div>
		<div class="menu_right">
			<div class="menu_right_top">
				<ul>
				<volist name="web_index_slider" id="vo">
					<li class="ctur">
						<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
					</li>
				</volist>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="banner_middle">
	<div class="banner_img"><img src="{pigcms{$static_path}images/dingcan_05.png" /></div>
</div>

<div class="menu_table">
	<menu class="order_menu">
		<ul>
			<li class="curn">
				<div class="order_menu_num">1</div>
				<div class="order_menu_txt">查找身边便利店、餐厅</div>
			</li>
			<li>
				<div class="order_menu_num">2</div>
				<div class="order_menu_txt">网上或手机下单，商家快速配送</div>
			</li>
			<li>
				<div class="order_menu_num">3</div>
				<div class="order_menu_txt">最快20分钟送达，货到付款！</div>
			</li>
			<div style="clear:both"></div>
		</ul>
	</menu>
	<div class="bdw" id="bdw">
		<div class="cf" id="bd">
			<if condition="$category_top_adver">
				<div class="J-hub ui-slider common-banner common-banner--index log-mod-viewed J-banner-stamp-active">
					<ul class="common-banner__sheets mt-slider-sheet-container">
						<volist name="category_top_adver" id="vo">
							<li class="common-banner__sheet cf mt-slider-sheet mt-slider-current-sheet" style="<if condition='$i eq 1'>opacity:1;<else/>opacity:0;display:none;</if>">
								<a class="common-banner__link" target="_blank" href="{pigcms{$vo.url}">
									<img onload="delayImg(this);" src="{pigcms{$static_public}images/empty.png" data-original="{pigcms{$vo.pic}" width="978" height="88" alt="{pigcms{$vo.name}"/>
								</a>
							</li>
						</volist>
					</ul>
					<a href="javascript:void(0)" class="common-close common-close--small close" title="关闭">关闭</a>
					<if condition="count($category_top_adver) gt 1">
						<ul class="trigger ui-slider__triggers ui-slider__triggers--translucent ui-slider__triggers--small mt-slider-trigger-container">
							<volist name="category_top_adver" id="vo">
								<li class="trigger-item mt-slider-trigger <if condition='$i eq 1'>mt-slider-current-trigger</if>"></li>
							</volist>
						</ul>
					</if>
				</div>
			</if>
		</div>
			
		<article class="menu_table">
			<if condition="$cat_option_html || $top_category">
				<div class="filter-section-wrapper">
					<if condition="$top_category || $area_list">
						<div class="filter-breadcrumb ">
							<span class="breadcrumb__item">
								<a class="filter-tag filter-tag--all" href="{pigcms{$default_url}">全部</a>
							</span>
							<php>if($top_category){</php>
							<span class="breadcrumb__crumb"></span>
							<span class="breadcrumb__item">
								<span class="breadcrumb_item__title filter-tag">{pigcms{$top_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$default_url}" class="breadcrumb-item--delete"><i></i></a>
								<span class="breadcrumb_item__option">
									<span class="option-list--wrap inline-block">
										<span class="option-list--inner inline-block">
											<a href="{pigcms{$default_url}" class="log-mod-viewed">全部</a>
											<volist name="all_category_list" id="vo">
												<a class="<if condition="$vo['cat_id'] eq $top_category['cat_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
											</volist>
										</span>
									</span>
								</span>
							</span>
							<php>}</php>
							<php>if($now_category['cat_id'] != $top_category['cat_id'] && false){</php>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag">{pigcms{$now_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$top_category.url}" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="{pigcms{$top_category.url}" class="log-mod-viewed">全部</a>
												<volist name="son_category_list" id="vo">
													<a class="<if condition="$vo['cat_id'] eq $now_category['cat_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
												</volist>
											</span>
										</span>
									</span>
								</span>
							<php>}</php>
							<php>if($now_area && $area_list){</php>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag">{pigcms{$now_area.area_name}<i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $default_url;}?>" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $default_url;}?>" class="log-mod-viewed">全部</a>
												<volist name="area_list" id="vo">
													<a class="<if condition="$vo['area_id'] eq $now_area['area_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a>
												</volist>
											</span>
										</span>
									</span>
								</span>
							<php>}</php>
						</div>
					</if>
					{pigcms{$cat_option_html}
				</div>
			</if>
		</article>
		<div id="filter">
			<div class="filter-sortbar">
				<div class="button-strip inline-block">
					<a href="{pigcms{$default_sort_url}" title="默认排序" class="button-strip-item inline-block button-strip-item-right <if condition="$_GET['order'] eq ''">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">默认排序</span></span></a>
					<a href="{pigcms{$hot_sort_url}" title="销量从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <if condition="$_GET['order'] eq 'hot'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">销量</span><span class="inline-block button-img"></span></span></a><if condition="$_GET['order'] eq 'price-asc'"><a href="{pigcms{$price_desc_sort_url}" title="价格从低到高" class="button-strip-item inline-block button-strip-item-right button-strip-item-asc <if condition="$_GET['order'] eq 'price-asc'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a><else/><a href="{pigcms{$price_asc_sort_url}" title="价格从高到低" class="button-strip-item inline-block button-strip-item-right <if condition="$_GET['order'] eq 'price-desc'">button-strip-item-checked button-strip-item-desc-active<else/>button-strip-item-asc</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a></if><a href="{pigcms{$rating_sort_url}" title="评分从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <if condition="$_GET['order'] eq 'rating'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">好评</span><span class="inline-block button-img"></span></span></a><a href="{pigcms{$time_sort_url}" title="发布时间从新到旧" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc large-button  <if condition="$_GET['order'] eq 'time'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">发布时间</span><span class="inline-block button-img"></span></span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="f1" style="width:1210px;" class="cf">
	<div class="category_list">
		<ul>
			<volist name="group_list" id="vo">
			<li <if condition='$i%4 eq 0'>class="last--even"</if>>
			<a href="{pigcms{$vo.url}" target="_blank">
				<div class="category_list_img">
					<img src="{pigcms{$vo.image}"/>
					<div class="shop_data">
						<div class="shop_state" <if condition="$vo['state']">id="shop_state"</if>><if condition="$vo['state']">营业中<else />打烊了</if> </div>
						<div class="shop_time">{pigcms{$vo['work_time']}</div>
					</div>
					<div class="bmbox">
						<div class="bmbox_title"> 该商家有<span>{pigcms{$vo['fans_count']}</span>个粉丝</div>
						<div class="bmbox_list">
							<div class="bmbox_list_img"><img  class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']))}" /></div>
							<div class="bmbox_list_li">
								<ul>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html">商家</li>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$vo.mer_id}.html">{pigcms{$config.group_alias_name}</li>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$vo.mer_id}.html">{pigcms{$config.meal_alias_name}</li>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/mermap/{pigcms{$vo.mer_id}.html">地图</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="datal">
 					<div class="shop">
						<div class="category_list_title">{pigcms{$vo.name} </div>
						<div class="shop_icon">
							<if condition="$vo['zeng']">
							<span><img src="{pigcms{$static_path}images/dingcan_20.png" title="{pigcms{$vo['zeng']}"/></span>
							</if>
							<if condition="$vo['full_money'] neq 0.00 AND $vo['minus_money'] neq 0.00">
							<span><img src="{pigcms{$static_path}images/dingcan_22.png" title="支持立减优惠，每单满{pigcms{$vo['full_money']}元减{pigcms{$vo['minus_money']}元"/></span>
							</if>
							<if condition="$vo['song']">
							<span><img src="{pigcms{$static_path}images/dingcan_24.png" title="{pigcms{$vo['song']}"/></span>
							</if>
						</div>
						<div style="clear:both"></div>
					</div>
					<div class="deal-tile__detail">
						<div class="shop_add">
							<div class="shop_add_icon"><img src="{pigcms{$static_path}images/dingcan_30.png" /> </div>
							<div class="shop_add_txt">{pigcms{$vo.adress} </div>
						</div>
						<!--div id="cheap">品牌快餐</div-->
					</div>
				</div>
			</a>
			</li>
			</volist>
		</ul>
	</div>
</div>
{pigcms{$pagebar}
<include file="Public:footer"/>
</body>
</html>