<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$now_category.cat_name}{pigcms{$config.group_alias_name}列表_{pigcms{$config.site_name}</title>
	<meta name="keywords" content="{pigcms{$now_category.cat_name},{pigcms{$config.seo_keywords}" />
	<meta name="description" content="{pigcms{$config.seo_description}" />
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.v113ea197.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.v492b572b.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/search-box.v6656b683.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/cate-nav.v4299f875.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/filter.ved243bd9.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deallist.v49c087a6.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/side.v4cfd6eb1.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/banner-index.v8c9e126d.css" />
	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script type="text/javascript">
	var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
</head>
<body id="index" style="position:static;">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
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
				<div id="filter">
					<if condition="$cat_option_html || $top_category">
						<div class="filter-sortbar-outer-box filter-main--attrs">
							<if condition="$top_category || $area_list">
								<div class="filter-breadcrumb ">
									<span class="breadcrumb__item">
										<a class="filter-tag filter-tag--all" href="{pigcms{$group_category_all}">全部</a>
									</span>
									<php>if($top_category){</php>
									<span class="breadcrumb__crumb"></span>
									<span class="breadcrumb__item">
										<span class="breadcrumb_item__title filter-tag">{pigcms{$top_category.cat_name}<i class="tri"></i></span><a href="{pigcms{$group_category_all}" class="breadcrumb-item--delete"><i></i></a>
										<span class="breadcrumb_item__option">
											<span class="option-list--wrap inline-block">
												<span class="option-list--inner inline-block">
													<a href="{pigcms{$group_category_all}" class="log-mod-viewed">全部</a>
													<volist name="all_category_list" id="vo">
														<a class="<if condition="$vo['cat_id'] eq $top_category['cat_id']">current</if> log-mod-viewed" href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a>
													</volist>
												</span>
											</span>
										</span>
									</span>
									<php>}</php>
									<php>if($now_category['cat_id'] != $top_category['cat_id']){</php>
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
											<span class="breadcrumb_item__title filter-tag">{pigcms{$now_area.area_name}<i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="breadcrumb-item--delete"><i></i></a>
											<span class="breadcrumb_item__option">
												<span class="option-list--wrap inline-block">
													<span class="option-list--inner inline-block">
														<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $group_category_all;}?>" class="log-mod-viewed">全部</a>
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
							<div class="filter-section-wrapper">
								{pigcms{$cat_option_html}
							</div>
						</div>
					</if>
					<div class="filter-sortbar">
						<div class="button-strip inline-block">
							<a href="{pigcms{$default_sort_url}" title="默认排序" class="button-strip-item inline-block button-strip-item-right <if condition="$_GET['order'] eq '' || $_GET['order'] eq 'all'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">默认排序</span></span></a><a href="{pigcms{$hot_sort_url}" title="销量从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <if condition="$_GET['order'] eq 'hot'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">销量</span><span class="inline-block button-img"></span></span></a><if condition="$_GET['order'] eq 'price-asc'"><a href="{pigcms{$price_desc_sort_url}" title="价格从低到高" class="button-strip-item inline-block button-strip-item-right button-strip-item-asc <if condition="$_GET['order'] eq 'price-asc'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a><else/><a href="{pigcms{$price_asc_sort_url}" title="价格从高到低" class="button-strip-item inline-block button-strip-item-right <if condition="$_GET['order'] eq 'price-desc'">button-strip-item-checked button-strip-item-desc-active<else/>button-strip-item-asc</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a></if><a href="{pigcms{$rating_sort_url}" title="评分从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <if condition="$_GET['order'] eq 'rating'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">好评</span><span class="inline-block button-img"></span></span></a><a href="{pigcms{$time_sort_url}" title="发布时间从新到旧" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc large-button  <if condition="$_GET['order'] eq 'time'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">发布时间</span><span class="inline-block button-img"></span></span></a>
						</div>
					</div>
				</div>
				<div class="site-sidebar" id="sidebar">
					<if condition="$index_right_adver">
						<div id="J-side-topic" class="side-extension side-extension--single side-extension--topic log-mod-viewed">
							<h3>热门活动</h3>
							<div class="detail">
								<ul>
									<volist name="index_right_adver" id="vo">
							            <li class="topic-item-w">
							                <a class="topic-item" href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.name}">
							                	<img class="topic-item__img" alt="{pigcms{$vo.name}" src="{pigcms{$vo.pic}" width="238" height="183"/>
							                </a>
							            </li>
						            </volist>
	            				</ul>
	            			</div>
	            		</div>
            		</if>
					<if condition="$like_group_list">
						<div class="component-top-deals">
							<div class="side-extension mall--small top-reco-deals cf log-mod-viewed">
	        					<h3>猜你喜欢</h3>
	        					<volist name="like_group_list" id="vo">
							        <div class="deal-tile--small <if condition="$i eq count($like_group_list)">deal-tile__last</if>">
							      		<a class="deal-tile--small__cover" href="{pigcms{$vo.url}" target="_blank" hidefocus="true" title="【{pigcms{$vo.prefix_title}】{pigcms{$vo.s_name}">
							            	<img class="" width="198" height="120" src="{pigcms{$vo.list_pic}" alt="【{pigcms{$vo.prefix_title}】{pigcms{$vo.s_name}"/>
							            	<span class="deal-rank">{pigcms{$i}</span>
							            </a>
							       	 	<h4 class="deal-tile--small__title">
							            	<a class="w-link link--black__green f1" href="{pigcms{$vo.url}" target="_blank" hidefocus="true" title="【{pigcms{$vo.prefix_title}】{pigcms{$vo.s_name}">【{pigcms{$vo.prefix_title}】{pigcms{$vo.s_name}</a>
							        	</h4>
								        <p class="deal-tile--small__detail">
								            <span class="price num">¥<strong>{pigcms{$vo.price}</strong></span>
								            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="sales f1">已售<strong class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</strong></span></if><if condition="$vo['wx_cheap']"><span class="wx_cheap_span">微信再减¥{pigcms{$vo.wx_cheap}</span></if>
								        </p>
							    	</div>
						    	</volist>
	    					</div>
						</div>
					</if>
					<div class="side-extension side-extension--history">
						<div class="side-extension__item side-extension__item--last log-mod-viewed">
							<h3><a href="javascript:;" class="clear-history J-clear">清空</a>最近浏览</h3>
							<ul class="history-list J-history-list"></ul>
						</div>
					</div>
				</div>
				<div class="mall cf J-mall log-mod-viewed" id="content">
					<div class="mall cf J-mall log-mod-viewed" id="content">
						<div class="J-async-deallist cf">
							<if condition="$group_list">
								<volist name="group_list" id="vo">
									<div class="deal-tile <if condition='$i%2 eq 0'>deal-tile--even</if>">
										<a href="{pigcms{$vo.url}" class="deal-tile__cover" hidefocus="true" target="_blank">
											<img width="350" height="214" class="J-webp" alt="{pigcms{$vo.s_name}" src="{pigcms{$vo.list_pic}" />
											<span class="good-img-wrap" style="height:214px;">
												<span class="range-area">
													<span class="range-bg"></span>
													<span class="range-desc" style="margin:23px 32px 0 90px;"><img  class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$vo['group_id']))}"/>微信扫码 手机查看</span>
												</span>
											</span>
											<span class="deal-mark">
												<if condition="$vo['tuan_type'] eq 1"><span class="deal-mark__item deal-mark__item--voucher" title="代金券">代金券</span></if>
											</span>
										</a>
										<h3 class="deal-tile__title">
											<a href="{pigcms{$vo.url}" class="w-link" title="{pigcms{$vo.s_name}" hidefocus="true" target="_blank">
												<span class="xtitle">【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}</span>
												<span class="short-title">{pigcms{$vo.group_name}</span></a>
										</h3>
										<p class="deal-tile__detail"><span class="price">¥<strong>{pigcms{$vo.price}</strong></span><span class="value"><if condition="$vo['tuan_type'] eq 2">零售价<else/>门店价</if><del class="num">{pigcms{$vo.old_price}</del></span><if condition="$vo['wx_cheap']"><span class="wx_cheap_span">微信购买立减¥{pigcms{$vo.wx_cheap}</span></if></p>
										<div class="deal-tile__extra">
											<p class="extra-inner">
												<span class="sales">已售<strong class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</strong></span>
												<if condition="$vo['reply_count']">
													<a href="{pigcms{$vo.url}#anchor-reviews" class="rate-info" hidefocus="true" target="_blank">
														<span class="rate-info__bar common-rating">
															<span class="rate-stars" style="width:{pigcms{$vo['score_mean']/5*100}%;"></span>
														</span>
														<span class="rate-info__count">{pigcms{$vo.reply_count}次评价</span>
													</a>
												<else/>
													<span class="rate-info rate-info--noreviews">暂无评价</span>
												</if>
											</p>
										</div>
									</div>
								</volist>
							<else/>
								<div style="text-align:center;height:380px;margin-top:60px;">暂无此类{pigcms{$config.group_alias_name}，请查看其他分类</div>
							</if>
						</div>
					</div>
					{pigcms{$pagebar}
				</div>
			</div>
		</div>
		<include file="Public:footer"/>
	</body>
</html>
