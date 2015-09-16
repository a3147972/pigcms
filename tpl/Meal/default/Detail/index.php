<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{pigcms{$store.name}网上{pigcms{$config.meal_alias_name}_{pigcms{$store.name}电话|{pigcms{$store.name}外卖|{pigcms{$store.name}菜单 - {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$store.name}网上{pigcms{$config.meal_alias_name},{pigcms{$store.name}电话,{pigcms{$store.name}外卖,{pigcms{$store.name}菜单,{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<script type="text/javascript">
var MT = {};
MT.BOOTSTAMP = new Date().getTime();
MT.STATIC_ROOT = "{pigcms{$config.site_url}";
MT.ENV = "production";
</script>
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
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.veda7cace.css" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ratelist.v4b84fddf.css" />
<link rel="stylesheet" href="{pigcms{$static_path}css/a.css">
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/category.js"></script>
<script>var store_long="{pigcms{$store.long}";var store_lat="{pigcms{$store.lat}";</script>
	
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script src="{pigcms{$static_path}js/detail.js"></script>
<script>var get_reply_url="{pigcms{:U('Index/Reply/ajax_get_list',array('order_type'=>1,'parent_id'=>$store['store_id'],'store_count'=>0))}";var login_url="{pigcms{:U('Index/Login/frame_login')}";save_history("{pigcms{$store.name}","{pigcms{$store[images][0]}","{pigcms{:U('Detail/index',array('store_id' => $store[store_id]))}","{pigcms{$store.mean_money}","{pigcms{$config.meal_alias_name}");var collect_url="{pigcms{:U('Index/Collect/collect')}";</script>
</head>

<body id="deal-default" class="pg-deal pg-deal-default pg-deal-detail">
	<div class="triffle hidden" id="triffle">
		<a href="javascript:;" class="top1"><i class="icon i-backtop"></i></a>
	</div>
	
	<div class="shopping-cart clearfix" data-status="1" data-poiname="{pigcms{$store.name}" data-poiid="{pigcms{$store.store_id}">
		<form method="post" action="/meal/order/{pigcms{$store['store_id']}.html" id="shoppingCartForm">
			<div class="order-list">
				<div class="title">
					<span class="fl dishes">菜品<a href="javascript:;" class="clear-cart">[清空]</a></span>
					<span class="fl">份数</span>
					<span class="fl ti-price">价格</span>
				</div>
				<ul>
				</ul>
				<div class="other-charge hidden">
					<div class="clearfix packing-cost hidden">
						<span class="fl">包装盒</span>
						<span class="fr boxtotalprice">￥0</span>
					</div>
					<div class="clearfix delivery-cost">
						<span class="fl">配送费</span>
						<span class="fr shippingfee">￥0</span>
					</div>
				</div>
				<div class="privilege hidden">
				</div>
				<div class="total">共<span class="totalnumber">0</span>份，总计<span class="bill">￥0</span></div>
			</div>
			   
			<div class="footer clearfix">
				<div class="logo fl"><i class="icon i-shopping-cart"></i></div>
				<div class="brief-order fl">
					<span class="count"></span>
					<span class="price"></span>
				</div>
				<div class="fr">
					<a class="ready-pay borderradius-2" href="javascript:;">还未点菜<!--还差<span data-left="20" class="margintominprice">20</span>元起送--></a>
					<input class="go-pay borderradius-2" type="submit" value="去下单">
					<input type="hidden" value="" class="order-data" name="shop_cart">
				</div>
			</div>
		</form>
	</div>
	
	
	<div class="wrapper">
		<div class="page-header">
		<header id="site-mast" class="site-mast">
			<div class="site-mast__user-nav-w">
				<div class="site-mast__user-nav cf">
					<ul class="basic-info">
						<li class="user-info cf">
							<if condition="empty($user_session)">
								<a rel="nofollow" class="user-info__login" href="{pigcms{:U('Index/Login/index')}">登录</a>
								<a rel="nofollow" class="user-info__signup" href="{pigcms{:U('Index/Login/reg')}">注册</a>
							<else/>
								<p class="user-info__name growth-info growth-info--nav">
									<span>
										<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
									</span>
									<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
								</p>
							</if>
			            </li>
						<li class="mobile-info__item dropdown">
							<a class="dropdown__toggle" href="javascript:void(0);"><i class="icon-mobile F-glob F-glob-phone"></i>微信版<i class="tri tri--dropdown"></i></a>
							<div class="dropdown-menu dropdown-menu--app">
								<a class="app-block" href="{pigcms{$config.site_url}/topic/weixin.html">
									<span class="app-block__title">访问微信版</span>
									<span class="app-block__content" style="background:url({pigcms{$config.wechat_qrcode});background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{pigcms{$config.wechat_qrcode}',sizingMethod='scale');"></span>
								</a>
							</div>
						</li>
					</ul>
					<ul class="site-mast__user-w">
						<li class="user-orders">
			                <a href="{pigcms{:U('User/Index/index')}" rel="nofollow">我的订单</a>
			            </li>
						<li class="dropdown dropdown--account">
							<a id="J-my-account-toggle" rel="nofollow" class="dropdown__toggle" href="{pigcms{:U('User/Index/index')}">
								<span>我的信息</span>
								<i class="tri tri--dropdown"></i>
								<i class="vertical-bar"></i>
							</a>
							<ul id="J-my-account-menu" class="dropdown-menu dropdown-menu--text dropdown-menu--account account-menu">
								<li><a class="dropdown-menu__item first" rel="nofollow" href="{pigcms{:U('User/Index/index')}">我的订单</a></li>
								<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Rates/index')}">我的评价</a></li>
								<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Collect/index')}">我的收藏</a></li>
								<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Point/index')}">我的积分</a></li>
								<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Credit/index')}">帐户余额</a></li>
								<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Adress/index')}">收货地址</a></li>
							</ul>
						</li>
						<li class="dropdown dropdown--history">
							<a id="J-my-history-toggle" rel="nofollow" class="dropdown__toggle" href="javascript:void(0)">
								<span>最近浏览</span>
								<i class="tri tri--dropdown"></i>
								<i class="vertical-bar"></i>
							</a>
							<div id="J-my-history-menu" class="dropdown-menu dropdown-menu--deal dropdown-menu--history"></div>
						</li>
						<li id="J-site-merchant" class="dropdown dropdown--merchant">
							<a class="dropdown__toggle dropdown__toggle--merchant" href="javascript:void(0)">
								<span>我是商家</span>
								<i class="tri tri--dropdown"></i>
								<i class="vertical-bar"></i>
							</a>
							<div class="dropdown-menu dropdown-menu--text dropdown-menu--merchant">
								<ul>
									<li><a rel="nofollow" class="dropdown-menu__item" href="{pigcms{$config.site_url}/merchant.php">商家中心</a></li>
									<li><a rel="nofollow" class="dropdown-menu__item" href="{pigcms{$config.site_url}/merchant.php">我想合作</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
			</header>
			<div class="middle-nav">
				<div class="middlenav-wrap clearfix">
					<div class="desire fr">
						<a href="{pigcms{$config.site_url}" class="ca-lightgrey home-page"><i class="icon i-home"></i><span>主页</span></a>
						<span class="vertical-line">|</span>
						<a href="{pigcms{:U('User/Index/meal_list')}" class="ca-lightgrey check-order"><i class="icon i-basket"></i><span>我的{pigcms{$config.meal_alias_name}</span></a>
					</div>
					<h1 class="logo fl">
						<a href="{pigcms{$config.site_url}"><img src="{pigcms{$config.site_logo}" alt="{pigcms{$config.site_name}" title="{pigcms{$config.site_name}" style="width:190px;height:60px;"/></a>
					</h1>
					<form action="{pigcms{:U('Meal/Search/index')}" class="search-box__form J-search-form" name="searchForm" method="post" >
					<div class="search-box fl">
						<input type="text" class="header-search fl" value="搜索餐厅，美食">
						<a href="javascript:;" class="doSearch fl" >搜索</a>
						<div class="result-box">
							<div class="result-left fl">
								<div class="rest-words ct-black">餐厅</div>
								<div class="food-words ct-black">美食</div>
							</div>
							<div class="result-right fl">
								<ul class="rest-lists"></ul>
								<div class="line"></div>
								<ul class="food-lists"></ul>
							</div>
						</div>
						<div class="no-result">
						  没有找到相关结果，请换个关键字搜索！
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="page-wrap">
			<div class="inner-wrap">
			<script type="text/template" id="foodtype-template">
				<div class="foodtype-nav clearfix" style="display: none;">
					<i class="icon i-tagtop"></i>
					<ul>
						<volist name="sorts" id="sort">
							<if condition="empty($sort['meals']) neq true">
								<li <if condition="$i eq 1">class="active"</if> >
									<a href="javascript:;" class="type" data-anchor="{pigcms{$i}" title="{pigcms{$sort['sort_name']}" onclick="$(window).scrollTop($('#category_{pigcms{$sort.sort_id}').offset().top-50);">
										<span class="name">{pigcms{$sort['sort_name']}</span>
									</a>
								</li>
							</if>
						</volist>
					</ul>
				</div>
			</script>
			<div class="rest-info">
			<div class="right-bar fr clearfix ct-lightgrey">
				<if condition="$store['mean_money'] gt 0">
				<div class="fl ack-ti">
					<div class="nu">
						<strong>{pigcms{$store.mean_money}</strong>元
					</div>
					<div class="desc">人均消费</div>
				</div>
				</if>
				<div class="fl in-ti">
					<div class="nu">
						<strong>{pigcms{$store.score_mean}</strong>分
					</div>
					<div class="desc">餐厅评分</div>
				</div>
			</div>
			<div class="details">
				<div class="up-wrap">
					<div class="avatar fl">
						<img src="{pigcms{$store[images][0]}" width="90" height="90">
					</div>
					<div class="list">
						<div class="na">
							<a href="{pigcms{$config.site_url}/meal/{pigcms{$store.store_id}.html">
								<span>{pigcms{$store.name}</span>
								<i class="icon i-triangle-dn"></i>
							</a>
						</div>
						<div class="clearfix">
							<div class="stars clearfix">
								<span class="star-ranking fl">
									<span class="star-score" style="width: {pigcms{$store.width}px"></span>
								</span>
								<span class="fl mark ct-middlegrey">{pigcms{$store.score_mean}</span> <br>
							</div>
						</div>
					</div>
				</div> 
				<div class="rest-info-down-wrap">
					<div class="location fl">
						<span class="fl">餐厅地址：</span><span class="fl info-detail">{pigcms{$store.adress}</span>
					</div>
					<div class="delivery-time fl">
						<span class="fl">营业时间：</span><span class="fl info-detail">{pigcms{$store.office_time}</span>
					</div>
				</div>
			</div>
			
			<div class="fold-3d"></div>
			<div class="save-up-wrapper">
				<if condition="$is_collect">
			    <a href="javascript:;" class="save-up j-save-up favorite" data-poiid="{pigcms{$store.store_id}">
			      <i class="icon i-heart-22"></i>
			      <p class="ct-black">已收藏</p>
			    </a>
			    <else />
			    <a href="javascript:;" class="save-up j-save-up " data-poiid="{pigcms{$store.store_id}">
			      <i class="icon i-heart-22"></i>
			      <p class="ct-black">收藏</p>
			    </a>
			    </if>
			    <p class="cc-yellow j-save-up-people">(<span>{pigcms{$collect_count}</span>)</p>
			</div>
		</div>
		<div class="food-list fl">
				
		<div class="tab-link clearfix">
			<a href="{pigcms{$config.site_url}/meal/{pigcms{$store.store_id}.html" class="tab-item active">菜单</a>
			<a href="{pigcms{$config.site_url}/meal/reply/{pigcms{$store.store_id}.html" class="tab-item">评价</a>
			<a href="{pigcms{$config.site_url}/meal/info/{pigcms{$store.store_id}.html" class="tab-item">餐厅详情</a>
		</div>
					
		<div class="ori-foodtype-nav clearfix">
			<span class="fl title ct-middlegrey">菜品分类：</span>
			<ul>
				<volist name="sorts" id="sort">
				<if condition="$sort['meals']['pic'] OR $sort['meals']['txt']">
				<li <if condition="$i eq 1">class="active"</if> >
					<a href="javascript:;" class="type" data-anchor="{pigcms{$i}" title="{pigcms{$sort['sort_name']}">
						<span class="name">{pigcms{$sort['sort_name']}</span>
					</a>
				</li>
				</if>
				</volist>
			</ul>
		</div>
				<div class="food-nav">
					<if condition="$sorts">
					<div class="title-blank ct-deepgrey hidden" style="display:none;">
						<div class="actions clearfix fr">
						<a href="javascript:;" data-href="javascript:;" class="classic">菜品分类<i class="icon i-triangle-dn"></i></a>
						<a href="javascript:;" data-href="/meal/{pigcms{$store.store_id}.html" class="<if condition="$sort_type eq 0">active</if> default borderradius-2">默认排序</a>
						<a href="javascript:;" data-href="/meal/1/{pigcms{$store.store_id}.html" class="<if condition="$sort_type eq 1">active</if> sales borderradius-2">价格<i class="icon i-orderdown"></i></a>
						<a href="javascript:;" data-href="/meal/2/{pigcms{$store.store_id}.html" class="<if condition="$sort_type eq 2">active</if> price borderradius-2">价格<i class="icon i-orderup"></i></a>
						</div>
						<span class="tag-na">汤类</span>
					</div>
					</if>
					
					<div id="pic_list">
					<volist name="sorts" id="vo" key="y">
					<if condition="$vo['meals']['pic'] OR $vo['meals']['txt']">
					<div class="category" id="category_{pigcms{$vo.sort_id}">
						<h3 class="title title-{pigcms{$y} ct-deepgrey" title="{pigcms{$vo.sort_name}">
						<if condition="$y eq 1">
							<div class="actions clearfix fr">
								<a href="javascript:;" data-href="javascript:;" class="classic hidden">菜品分类<i class="icon i-triangle-dn"></i></a>
								<a href="javascript:;" data-href="/meal/{pigcms{$store.store_id}.html" class="<if condition="$sort_type eq 0">active</if> default 1borderradius-2">默认排序</a>
								<a href="javascript:;" data-href="/meal/1/{pigcms{$store.store_id}.html" class="<if condition="$sort_type eq 1">active</if> sales borderradius-2">价格<i class="icon i-orderdown"></i></a>
								<a href="javascript:;" data-href="/meal/2/{pigcms{$store.store_id}.html" class="<if condition="$sort_type eq 2">active</if> price borderradius-2">价格<i class="icon i-orderup"></i></a>
							</div>
						</if>
						<span class="tag-na">{pigcms{$vo.sort_name}</span>
						</h3>
						
						
						<div class="pic-food-cont clearfix">
							<volist name="vo['meals']['pic']" id="meal">
							<div class="pic-food  <if condition="$i%3 eq 0">pic-food-col2</if>" id="{pigcms{$meal['meal_id']}">
							
								<script type="text/template" id="foodcontext-{pigcms{$meal['meal_id']}">
									{
										"id": "{pigcms{$meal['meal_id']}",
										"name": "{pigcms{$meal['name']}",
										"price": "{pigcms{$meal['price']}",
										"origin_price": "{pigcms{$meal['price']}",
										"minCount": "1",
										"onSale": "1"
    								}
    							</script>
								<div class="avatar">
									<img src="{pigcms{$meal['image']}" class="food-shape scroll-loading" data-src="{pigcms{$meal['image']}" style="background-image: url({pigcms{$meal['image']});">
									<div class="description"><if condition="$meal['label']">[{pigcms{$meal['label']}]</if>　{pigcms{$meal['name']}</div>
								</div>
								<div class="np clearfix">
									<span class="name fl" title="{pigcms{$meal['name']}">{pigcms{$meal['name']}</span>
								</div>
								<div class="sale-info clearfix">
									<div class="fr zan-count">
										<!--i class="icon i-zan"></i>
										<span class="cc-oriange">(0)</span-->
									</div>
									<div class="sold-count ct-middlegrey"></div>
								</div>
								<div class="labels clearfix">
									<a href="javascript:;" class="add fr"><i class="icon i-addcart"></i></a>
									<span id="food{pigcms{$meal['meal_id']}-cart-num" class="pic-food-cart-num fr" style="display:none;">0</span>
									<div class="price fl">
										<div class="only">¥{pigcms{$meal['price']}/{pigcms{$meal['unit']}</div>
									</div>
								</div>
							</div>
							</volist>
						</div>
						<div class="text-food-cont">
						<volist name="vo['meals']['txt']" id="meal">
							<div class="text-food clearfix" id="{pigcms{$meal['meal_id']}">
							    <script type="text/template" id="foodcontext-{pigcms{$meal['meal_id']}">
									{
										"id": "{pigcms{$meal['meal_id']}",
										"name": "{pigcms{$meal['name']}",
										"price": "{pigcms{$meal['price']}",
										"origin_price": "{pigcms{$meal['price']}",
										"minCount": "1",
										"onSale": "1"
    								}
    							</script>
								<div class="fl description">
									<div class="na nodesc" title="{pigcms{$meal['name']}">{pigcms{$meal['name']}</div>
								</div>
								<div class="fr add">
									<a href="javascript:;" class="add-cart" data-id="{pigcms{$meal['meal_id']}" data-name="{pigcms{$meal['name']}" data-price="{pigcms{$meal['price']}" data-mincount="1"><i class="icon i-addcart"></i></a>
								</div>
								<div class="fr unit-price">
									<div class="only">¥{pigcms{$meal['price']}/{pigcms{$meal['unit']}</div>
								</div>
								<span id="food{pigcms{$meal['meal_id']}-cart-num" class="text-food-cart-num fr" style="display:none;">0</span>
							</div>
						</volist>
						</div>
					</div>
					</if>
					</volist>
					</div>
				</div>
			</div>
			
				<div class="widgets fr">
					<div class="widget broadcaster">
						<div class="title"><h3 style="color:#ffffff">{pigcms{$config.meal_alias_name}必读&amp;商家公告</h3></div>
						<div class="content ct-deepgrey">{pigcms{$store.txt_info}</div>
					</div>
					<div class="side-extension side-extension--history">
						<div class="side-extension__item side-extension__item--last log-mod-viewed">
							<h3><a href="javascript:;" class="clear-history J-clear">清空</a>最近浏览</h3>
							<ul class="history-list J-history-list"></ul>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				</div>
			</div>
		</div>
		<include file="Public:footer"/>
		<style>
		.new-index-triffle-w{margin-left:522px;margin-bottom: -19px;}
		</style>
		<script type="text/javascript" data-main="{pigcms{$static_path}js/restaurant" src="{pigcms{$static_path}js/r.js"></script>
	</body>
</html>