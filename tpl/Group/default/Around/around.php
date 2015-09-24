<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.site_name}附近{pigcms{$config.group_alias_name} | {pigcms{$config.site_name}</title>
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
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deals-list.v95034346.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/side.v4cfd6eb1.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/banner-index.v8c9e126d.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/search.v4c18aed1.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/global-iconfont.vbde38e74.css" />
	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
</head>
<body id="search" class="pg-search">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:search_header_top"/>
		</header>
		<div class="bdw" id="bdw">
			<div class="cf" id="bd">
				<php>if($group_list){</php>
					<div id="filter">
						<div class="filter-main">
							<div id="around-geo-area" class="around-geo-strip" style="border-top:none;">
								<p><i class="F-glob F-glob-position icon"></i>{pigcms{$_COOKIE.around_adress}
									<a href="{pigcms{:U('Around/index')}" class="modify">修改</a>
								</p>
							</div>
						</div>
						<div class="filter-sortbar">
							<div class="button-strip inline-block">
								<a href="{pigcms{$default_sort_url}" title="默认排序" class="button-strip-item inline-block button-strip-item-right <if condition="$_GET['order'] eq ''">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">默认排序</span></span></a><a href="{pigcms{$hot_sort_url}" title="销量从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <if condition="$_GET['order'] eq 'hot'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">销量</span><span class="inline-block button-img"></span></span></a><if condition="$_GET['order'] eq 'price-asc'"><a href="{pigcms{$price_desc_sort_url}" title="价格从低到高" class="button-strip-item inline-block button-strip-item-right button-strip-item-asc <if condition="$_GET['order'] eq 'price-asc'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a><else/><a href="{pigcms{$price_asc_sort_url}" title="价格从高到低" class="button-strip-item inline-block button-strip-item-right <if condition="$_GET['order'] eq 'price-desc'">button-strip-item-checked button-strip-item-desc-active<else/>button-strip-item-asc</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a></if><a href="{pigcms{$rating_sort_url}" title="评分从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <if condition="$_GET['order'] eq 'rating'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">好评</span><span class="inline-block button-img"></span></span></a><a href="{pigcms{$time_sort_url}" title="发布时间从新到旧" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc large-button  <if condition="$_GET['order'] eq 'time'">button-strip-item-checked</if>"><span class="inline-block button-outer-box"><span class="inline-block button-content">发布时间</span><span class="inline-block button-img"></span></span></a>
							</div>
						</div>
					</div>
				<php>}else{</php>
					<div id="filter">
						<div class="filter-main">
							<div id="around-geo-area" class="around-geo-strip" style="border-top:none;">
								<p><i class="F-glob F-glob-position icon"></i>{pigcms{$_COOKIE.around_adress}
									<a href="{pigcms{:U('Around/index')}" class="modify">修改</a>
								</p>
							</div>
						</div>
					</div>
					<div class="no-result">
						<img class="no-result-img" width="80" height="54" src="{pigcms{$static_path}css/img/search-no-result.v61dc2948.png" alt="搜索无结果">
						<span class="no-result-content">未找到附近的相关{pigcms{$config.group_alias_name}</span>
					</div>
					<div id="content" class="cf mall">
						<div class="mainbox cf">
							<div class="list-head cf"><h2>{pigcms{$config.group_alias_name}推荐</h2></div>
							<ul class="deals-list cf log-mod-viewed">
								<volist name="index_sort_group_list" id="vo">
									<li class="deal <if condition="$i gt 3">last-row<else/>first</if> <if condition="$i%3 eq 0">last-deal</if>">
										<a href="{pigcms{$vo.url}" class="pic" target="_blank">
											<img width="208" height="125" alt="【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}：{pigcms{$vo.group_name}" title="【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}：{pigcms{$vo.group_name}" src="{pigcms{$vo.list_pic}"/>
										</a>
										<h4><a href="{pigcms{$vo.url}" title="【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}：{pigcms{$vo.group_name}" target="_blank">【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}：{pigcms{$vo.group_name}</a></h4>
										<div class="info">
											<if condition="$vo['sale_count']+$vo['virtual_num']"><span class="total">已售<label>{pigcms{$vo['sale_count']+$vo['virtual_num']}</label></span></if>
											<strong class="price">¥{pigcms{$vo.price}</strong>
											门店价<label class="delete">{pigcms{$vo.old_price}</label>
										</div>
									</li>
								</volist>
							</ul>
						</div>
					</div>
				<php>}</php>
				<div class="site-sidebar" id="sidebar">
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
												<span class="short-title">{pigcms{$vo.group_name}</span>
											</a>
										</h3>
										<p class="deal-tile__detail"><span class="price">¥<strong>{pigcms{$vo.price}</strong></span><span class="value">门店价<del class="num">{pigcms{$vo.old_price}</del></span></p>
										<div class="deal-tile__extra">
											<p class="extra-inner">
												<span class="sales">已售<strong class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</strong></span>
												<span class="around-distance"><i class="F-glob F-glob-position"></i>距离新位置<em>约{pigcms{:round($group_around_range[$vo['group_id']]/1000,1)}公里</em></span>
											</p>
										</div>
									</div>
								</volist>
							<else/>
								
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
