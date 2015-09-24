<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{pigcms{$store.name}介绍_{pigcms{$store.name}地图|{pigcms{$store.name}在哪 - {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$store.name}介绍,{pigcms{$store.name}地图,{pigcms{$store.name}在哪,{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<script src="{pigcms{$static_path}js/analytics.js"></script>
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
<script src="{pigcms{$static_path}js/select.js"></script>
<script>var get_reply_url="{pigcms{:U('Index/Reply/ajax_get_list',array('order_type'=>1,'parent_id'=>$store['store_id'],'store_count'=>0))}";save_history("{pigcms{$store.name}","{pigcms{$store[images][0]}","{pigcms{:U('Detail/index',array('store_id' => $store[store_id]))}","{pigcms{$store.mean_money}","{pigcms{$config.meal_alias_name}");var collect_url="{pigcms{:U('Index/Collect/collect')}";</script>
<style type="text/css">
.paginator-wrapper {
margin-top: 20px;
margin-bottom: 20px;
text-align: center;
clear: both;
}
</style>
<script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="restaurant" src="{pigcms{$static_path}js/restaurant.js"></script>
</head>

<body id="deal-default" class="pg-deal pg-deal-default pg-deal-detail">
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
						<a href="/" class="ca-lightgrey home-page"><i class="icon i-home"></i><span>主页</span></a>
						<span class="vertical-line">|</span>
						<a href="" class="ca-lightgrey check-order"><i class="icon i-basket"></i><span>我的{pigcms{$config.meal_alias_name}</span></a>
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
							<a href="/meal/{pigcms{$store.store_id}.html">
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
			<div class="tab-link clearfix " id="J-content-navbar">
				<a href="{pigcms{$config.site_url}/meal/{pigcms{$store.store_id}.html" class="tab-item">菜单</a>
				<a href="{pigcms{$config.site_url}/meal/reply/{pigcms{$store.store_id}.html" class="tab-item">评价</a>
				<a href="{pigcms{$config.site_url}/meal/info/{pigcms{$store.store_id}.html" class="tab-item active">餐厅详情</a>
			</div>
			<div class="tab-link clearfix">
				<div id="side-business" class="J-poi-wrapper poi-wrapper cf">
					<h1 style="font:18px 黑体;margin-bottom:5px;">餐厅地图：</h1>
					<div class="address-list cf" id="map-canvas"></div>
				</div>
				<div class="standard-content">
					<h1 style="font:18px 黑体;margin-top:30px;margin-bottom:5px;">餐厅介绍：</h1>
					<p class="storedetail">名称：{pigcms{$store.name}</p>
					<p class="storedetail">电话：{pigcms{$store.phone}</p>
					<p class="storedetail">地址：{pigcms{$store.adress}</p>
					<p class="storedetail">介绍：{pigcms{$merchant.txt_info}</p>
					<!--volist name="merchant['merchant_pic']" id="vo">
						<img src="{pigcms{$vo}" alt="{pigcms{$merchant.name}" class="standard-image"/>
					</volist-->
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
		<include file="Public:footer"/>
	</div>
	<style>
	.storedetail{margin:5px 0;font: 14px/24px helvetica neue,helvetica,arial,simsun,"微软雅黑",Hiragino Sans GB,sans-serif;color: #666;}
	.standard-image, .standard-img {
		display: block;
		margin: 10px 0;
	}
	.poi-wrapper .mapbody {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 30px;
		width: 683px;
	}
	.poi-wrapper .left-content {
		width: 683px;
	}
	.address-list{
		height: 270px;
		width: 683px;
	}
	</style>
	<script type="text/template" id="foodtype-template"></script>
<script type="text/javascript" data-main="{pigcms{$static_path}" src="{pigcms{$static_path}js/r.js"></script>
<script type="text/javascript">
$(function(){
$.getScript("http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2",function(){
	var map = null;
	var oPoint = new BMap.Point(store_long,store_lat);
	var marker = new BMap.Marker(oPoint);
	
	map = new BMap.Map("map-canvas",{"enableMapClick":false});
	map.enableScrollWheelZoom();
	marker.enableDragging();
	
	map.centerAndZoom(oPoint, 17);

	map.addControl(new BMap.NavigationControl());
	map.enableScrollWheelZoom();

	map.addOverlay(marker);
});
});
</script>
</body>
</html>