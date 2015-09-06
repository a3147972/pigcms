<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<if condition="$now_group['tuan_type'] neq 2">
			<title>【{pigcms{$now_group.merchant_name}团购】{pigcms{$now_group.s_name}团购|图片|价格|菜单 - {pigcms{$config.site_name}</title>
		<else/>
			<title>【{pigcms{$now_group.group_name}团购】{pigcms{$now_group.s_name}团购 - {pigcms{$config.site_name}</title>
		</if>
		<meta name="keywords" content="{pigcms{$now_group.merchant_name},{pigcms{$now_group.s_name},{pigcms{$config.site_name}" />
		<meta name="description" content="{pigcms{$now_group.intro}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/shopping.css"/>
		
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script>var store_long="{pigcms{$now_group.store_list.0.long}";var store_lat="{pigcms{$now_group.store_list.0.lat}";var get_reply_url="{pigcms{:U('Index/Reply/ajax_get_list',array('order_type'=>0,'parent_id'=>$now_group['group_id'],'store_count'=>count($now_group['store_list'])))}";var collect_url="{pigcms{:U('Index/Collect/collect')}";var login_url="{pigcms{:U('Index/Login/frame_login')}";save_history("{pigcms{$now_group.s_name}","{pigcms{$now_group.all_pic.0.m_image}","{pigcms{$now_group.url}","{pigcms{$now_group.price}","团购");</script>
		
		<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
		<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>

		<script src="{pigcms{$static_path}js/group_detail.js"></script>
	</head>
<body id="deal-default" class="pg-deal pg-deal-default pg-deal-detail">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div class="bdw" id="bdw">
			<div class="cf" id="bd">
				<div class="bread-nav">
					<a class="link--black__green" href="{pigcms{$config.site_url}">网站首页</a>
					<span>»</span>
					<a class="link--black__green" href="{pigcms{$f_category.url}">{pigcms{$f_category.cat_name}团购</a>
					<span>»</span>
					<a class="link--black__green" href="{pigcms{$s_category.url}">{pigcms{$s_category.cat_name}</a>
					<if condition="$now_group['store_list'][0]['area']">
						<span>»</span>
						<a class="link--black__green" href="{pigcms{$now_group.store_list.0.area.url}">{pigcms{$now_group.store_list.0.area.area_name}</a>
						<span>»</span>
						<a class="link--black__green" href="{pigcms{$now_group.store_list.0.circle.url}">{pigcms{$now_group.store_list.0.circle.area_name}</a>
					</if>
					<span>»</span>{pigcms{$now_group.merchant_name}</div>
				<div class="deal-component-container">
					<div class="deal-component-headline">
						<div class="sans-serif">
							<span class="deal-component-title-prefix">【{pigcms{$now_group.prefix_title}】</span>
							<if condition="$now_group['tuan_type'] neq 2">
								<h1 class="deal-component-title">{pigcms{$now_group.merchant_name}</h1>
							<else/>
								<h1 class="deal-component-title">{pigcms{$now_group.s_name}</h1>
							</if>
						</div>
						<div class="deal-component-description">{pigcms{$now_group.intro}</div>
                    </div>
					<div class="deal-component-detail cf">
						<div class="deal-component-left">
							<div class="deal-component-images">
								<div class="simple-gallery">
									<div class="deal-component-cover">
										<img class="focus-view" src="{pigcms{$now_group.all_pic.0.m_image}" alt="{pigcms{$now_group.merchant_name}" width="460" height="280"/>
									</div>
									<div class="candidates">
										<volist name="now_group['all_pic']" id="vo">
											<img class="<if condition='$i eq 1'>first-image active</if>" src="{pigcms{$vo.m_image}" width="78" height="45"/>
										</volist>
									</div>
								</div>
							</div>
						</div>
						<div class="deal-component-info J-deal-component-info J-hub">
							<div class="deal-component-price cf">
								<h2 class="deal-component-price-current sans-serif orange">
									<span class="price-symbol" style="display:inline-block;vertical-align:top;margin-top:7px;font-size:18px;">¥</span>
									<strong>{pigcms{$now_group.price}</strong>
								</h2>	
								<del class="item" style="margin-top:12px;font-size:14px;font-weight:normal">¥ {pigcms{$now_group.old_price}</del>					 
							</div>
							<if condition="$now_group['wx_cheap']">
								<div class="deal-component-campaigns-egregious-deal available-for-purchase">
				                    <a class="deal-component-campaigns-egregious-deal-popover" href="javascript:;" title="微信购买立减{pigcms{$now_group.wx_cheap}元">
				                        <div class="deal-component-campaigns-egregious-deal-popover-displayed ccf">
				                            <i class="egregious-qrcode-small-tri"></i>
				                            <i class="egregious-qrcode-small"></i>
				                            <span class="egregious-deal-popover-description"><span>微信购买再减&nbsp;&nbsp;</span>¥<em>{pigcms{$now_group.wx_cheap}</em></span>
				                        </div>
				                        <div class="J-egregious-deal-popover-details egregious-deal-popover-details">
				                            <ul>
				                                <li><i>1</i>收藏该团购单</li>
				                                <li><i>2</i>扫描关注微信号</li>
				                                <li><i>3</i>在微信号中“我的收藏”中购买</li>
				                            </ul>
				                            <i class="egregious-qrcode" style="background:url('{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$now_group['group_id']))}');background-size:100%;"></i>
				                        </div>
				                    </a>
				                </div>
			                </if>
							<div class="deal-component-rating ccf">
								<span class="item">
									<span class="">已售<span class="deal-component-rating-sold-count orange"><strong>{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</strong></span></span>
								</span>
								<span class="item">
									<a href="#anchor-reviews"><span class="common-rating stars hidden"><span class="rate-stars" style="width:88%;"></span></span></a>
									<a href="#anchor-reviews" class="look-normal"><span><span class="deal-component-rating-stars orange">{pigcms{$now_group.score_mean}</span>分</span></a>
								</span>
								<span class="comments-count">
									<a href="#anchor-reviews"><span class="deal-component-rating-comment-count orange">{pigcms{$now_group.reply_count}</span>人评价</a>
								</span>
							</div>
							<div class="deal-component-dealer">
								<span class="deal-component-detail-leading">商家</span>
								<span class="deal-component-dealer-branches item vertical-divider"><a href="#business-info" data-anchor="#business-info" title="{pigcms{$now_group.merchant_name}">{pigcms{$now_group.merchant_name}</a></span>
								<span class="deal-component-dealer-detail"><a href="#business-info">查看地址/电话</a></span>
								<a id="J-deal-qrcode-wrapper" hidefocus="true" class="deal-qrcode-wrapper hover" href="javascript:;" target="_blank">
						            <div id="J-deal-qrcode-trigger" class="deal-qrcode-trigger"> 微信扫一扫轻松购买
						                <div class="deal-qrcode-trigger-img"></div>
						                <i class="deal-qrcode-trigger-tri"></i>
						            </div>
						            <div id="J-deal-qrcode-content" class="deal-qrcode-content">
						            	<img class="deal-qrcode-content-img" src="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$now_group['group_id']))}"/>
						            	<p class="deal-qrcode-content-text"> 微信扫一扫，轻松购买！更多优惠，更多便捷。</p>
						            </div>
						            <div class="deal-qrcode-wrapper-bottom"></div>
						        </a>
							</div>
							<div class="deal-component-expiry cf deal-component-inline-text-folded ">
								<span class="deal-component-detail-leading left">有效期</span>
								<span class="deal-component-inline-text-container left">
									<span class="deal-component-inline-text-wrapper">
										<span class="deal-component-expiry-valid-through">截止到{pigcms{$now_group.end_time|date='Y.m.d',###}</span>
										<span class="deal-component-expiry-notice orange"><switch name="now_group['is_general']"><case value="0">周末、法定节假日通用</case><case value="1">周末不能使用</case><case value="2">法定节假日不能使用</case></switch></span>
										<span class="deal-component-expiry-notice-detail"></span>
									</span>
								</span>
							</div>
							<div class="divider"></div>
							<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
								<form action="{pigcms{$config.site_url}/group/buy/{pigcms{$now_group.group_id}.html" method="GET" class="J-wwwtracker-form deal-component-buy J-buy-form">
									<div class="deal-component-quantity">
										<span class="deal-component-detail-leading">数量</span>
										<button for="J-cart-minus" type="button">−</button><input type="text" class="J-cart-quantity" name="q" value="{pigcms{$now_group.once_min}" maxlength="9" data-max="{pigcms{$now_group.once_max}" data-min="{pigcms{$now_group.once_min}"/><button for="J-cart-add" class="item" type="button">+</button>
										<span class="deal-component-quantity-warning orange"></span>
									</div>
									<div class="deal-component-purchase-button">
										<input type="submit" class="J-mini-cart-buy mini-cart-buy basic-deal data-mod-enabled" value="抢购"/>
										<if condition="empty($now_group['is_collect'])">
											<a class="small-btn deal-component-add-favorite J-component-add-favorite item" fav-id="{pigcms{$now_group.group_id}">收藏(<b class="J-fav-count">{pigcms{$now_group.collect_count}</b>)</a>
										<else/>
											<a class="small-btn deal-component-add-favorite item in-favorite" title="您已经收藏过本单"><i class="F-glob F-glob-roundstar" title="roundstar"></i>已收藏(<b class="J-fav-count orange">{pigcms{$now_group.collect_count}</b>)</a>
										</if>
										<!--a class="small-btn share-tip J-component-share-tip-dialog">分享到</a-->
									</div>
								</form>
							<else/>
								<div class="deal-component-availability">
									<div class="pseudo-text-availability pngfix"></div>
									<div class="expired-at pngfix"><span class="item">{pigcms{:date('Y.m.d',$now_group['end_time'])}</span>{pigcms{:date('H:i',$now_group['end_time'])}</div>
									<a class="deal-component-availability-link" href="{pigcms{$s_category.url}">查看相关团购</a>
								</div>
							</if>
							<div class="deal-component-commitments " data-mod="da">
								<span class="deal-component-detail-leading">服务承诺</span>
								<span class="deal-component-detail-commitments"><a class="anytime-money-back item" title="未消费，随时退款" href="javascript:void(0);">随时退</a><a class="expiring-money-back item" title="过期未消费，无条件退款" href="javascript:void(0);">过期退</a><a class="instant-money-back item" title="无需等待，退款立即到账" href="javascript:void(0);">极速退</a><a class="real-comment item" title="真实消费后的用户评价" href="javascript:void(0);">真实评价</a></span>
							</div>
						</div>
					</div>
				</div>
				<div id="content" class="deal-content J-deal-content">
					<if condition="$merchant_group_list">
						<div class="J-hub">
							<div id="deal-other-biz">
								<h3 class="biz-title">该商家的其他团购
									<div class="biz-subtitle">
										<span class="biz-header-title biz-header-title--right">已售</span><span class="biz-header-title biz-header-title--middle">门店价</span><span class="biz-header-title biz-header-title--left">团购价</span>
									</div>
								</h3>
								<ul class="item-list">
									<volist name="merchant_group_list" id="vo">
										<li <if condition="$i gt 6">class="more hidden"</if>>
											<a href="{pigcms{$vo.url}" class="first" target="_blank">
												<span class="biz-title">【{pigcms{$vo.prefix_title}】{pigcms{$vo.group_name}</span>
												<span class="price">￥{pigcms{$vo.price}</span>
												<span class="value-cn">￥{pigcms{$vo.old_price} </span>
												<span class="sale">{pigcms{$vo['sale_count']+$vo['virtual_num']}</span>
											</a>
										</li>
									</volist>
									<if condition="count($merchant_group_list) gt 6">
										<li class="more-deal-trigger">
											<a class="more-deal-trigger-wrapper collapse">
												<span class="left-title">还有{pigcms{:count($merchant_group_list)-6}个</span>
												<span class="triangle"></span>
											</a>
										</li>
									</if>
								</ul>
							</div>
						</div>
					</if>
					<div>
						<div id="J-content-navbar" class="flat-content-navbar">
							<ul class="cf">
								<li class="content-navbar__item--current"><a class="tab-item" href="#business-info">商家位置</a></li>
								<if condition="$now_group['cue_arr']"><li><a class="tab-item" href="#anchor-purchaseinfo">购买须知</a></li></if>
								<li><a class="tab-item" href="#anchor-detail">本单详情</a></li>
								<li><a class="tab-item" href="#anchor-bizinfo">商家介绍</a></li>
								<li><a class="tab-item" href="#anchor-reviews">消费评价<span class="num J-hub">({pigcms{$now_group.reply_count})</span></a></li>
							</ul>
							<div id="J-nav-buy" class="buy-group J-hub" style="display:none;">
								<a rel="nofollow" class="J-buy btn-hot buy" href="{pigcms{$now_group.buy_url}">抢购</a>
							</div>
						</div>
						<div class="common-fix-placeholder" style="height:41px;display:none;"></div>
					</div>
					<div id="deal-stuff">
						<div class="mainbox cf">
							<div class="main">
								<h2 class="content-title" id="business-info">商家位置</h2>
								<div id="side-business" class="J-poi-wrapper poi-wrapper cf">
									<div class="address-list cf">
										<div class="left-content">
											<div id="map-canvas" class="mapbody" map_point="{pigcms{$now_group.store_list.0.long},{pigcms{$now_group.store_list.0.lat}" store_name="{pigcms{$now_group.store_list.0.name}" store_adress="{pigcms{$now_group.store_list.0.area_name}{pigcms{$now_group.store_list.0.adress}" store_phone="{pigcms{$now_group.store_list.0.phone}" frame_url="{pigcms{:U('Map/frame_map')}"></div>
											<a class="view-full J-view-full" href="javascript:void(0)" title="点击查看完整地图"><i class="view-map-icon"></i>查看完整地图</a>
											<div id="J-map-loading" class="map-loading-mask"></div>
										</div>
										<div class="biz-wrapper J-biz-wrapper biz-wrapper-nobottom inited">
											<div id="J-bizinfo-list" class="all-biz cf">
												<volist name="now_group['store_list']" id="vo">
													<div class="biz-info <if condition="$i eq 1">biz-info--open biz-info--first</if> <if condition="count($now_group['store_list']) eq 1">biz-info--only</if>">
														<h5 class="biz-info__title">
															<a class="poi-link" title="{pigcms{$vo.name}" href="javascript:void(0);">{pigcms{$vo.name}</a><i class="F-glob F-glob-caret-down-thin down-arrow"></i>
														</h5>
														<div class="biz-info__content">
															<div class="biz-item field-group" title="{pigcms{$vo.area_name}{pigcms{$vo.adress}"><label class="title-label">地址：</label>{pigcms{$vo.area_name}{pigcms{$vo.adress}</div>
															<div class="biz-item link-item">
																<a class="view-map" href="javascript:void(0)" map_point="{pigcms{$vo.long},{pigcms{$vo.lat}"  store_name="{pigcms{$vo.name}" store_adress="{pigcms{$vo.area_name}{pigcms{$vo.adress}" store_phone="{pigcms{$vo.phone}" frame_url="{pigcms{:U('Map/frame_map')}">查看地图</a>
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
								<div class="blk detail">
									<if condition="$now_group['cue_arr']">
										<div class="deal-term">
											<h2 class="content-title" id="anchor-purchaseinfo">购买须知</h2>
											<dl>
												<volist name="now_group['cue_arr']" id="vo">
													<if condition="$vo['value']">
														<dt>{pigcms{$vo.key}</dt><dd>{pigcms{$vo.value}</dd>
													</if>
												</volist>
											</dl>
										</div>
									</if>
									<h2 class="content-title" id="anchor-detail">本单详情</h2>
									<style>
										.BMap_cpyCtrl{display:none;}
										.group_content{padding-top:20px;}
										.group_content table { width:100%; margin-top:0px; border:none; font-size:14px; color:#222; }
										.group_content table .name { width:auto; text-align:left; border-left:none; }
										.group_content table .price { width:15%; text-align:center; }
										.group_content table .amount { width:15%; text-align:center; }
										.group_content table .subtotal { width:15%; text-align:right; border-right:none; font-family: arial, sans-serif; }
										.group_content table caption, .group_content table th, .group_content table td { padding:8px 10px; background:#FFF; border:1px solid #E8E8E8; border-top:none; word-break:break-all; word-wrap:break-word; }
										.group_content table caption { background:#F0F0F0; }
										.group_content table caption .title, .group_content table .subline .title { font-weight:bold; }
										.group_content table th { color:#333; background:#F0F0F0; font-weight:bold; border-left-style:none; border-right-style:none;}
										.group_content table td { color:#666; /*border-left-style:none; border-right-style:none;*/ border-bottom-style:dotted; }
										.group_content table .subline { background:#fff; text-align:center; border-left:none; border-right:none; }
										.group_content table .subline-left { width:22%; text-align:left;border-right: 1px #e8e8e8 dotted; }
										.deal-menu-summary { padding:0 10px 10px; text-align:right; border-bottom:1px #e8e8e8 solid; }
										.deal-menu-summary .worth { display:inline-block; min-width:10px; _width:10px; padding-right:20px; text-align:left; word-break:normal; word-wrap:normal; font-weight:bold; }
										.deal-menu-summary .price { color:#ea4f01; padding-right:0; }
										#content .deal-menu .title { padding-left:0; }
									</style>
									<div class="group_content">{pigcms{$now_group.content}</div>
									<div id="anchor-bizinfo">
										<h2 class="content-title">商家介绍</h2>
										<p class="standard-bar">{pigcms{$now_group.merchant_name}</p>
										<div class="standard-content">
											<p>{pigcms{$now_group.txt_info}</p>
											<volist name="now_group['merchant_pic']" id="vo">
												<img src="{pigcms{$vo}" alt="{pigcms{$now_group.merchant_name}" class="standard-image"/>
											</volist>
										</div>
									</div>
								</div>
								<div id="anchor-reviews" class="user-reviews J-rate-wrapper J-hub">
									<div class="rate-overview J-hub" id="J-overview">
										<div class="overview-head content-title cf">
											<h3 class="overview-title">消费评价</h3>
											<div class="overview-feedback to-rate">
												我买过本单，<a href="{pigcms{:U('User/Rates/index')}" target="_blank" rel="nofollow">我要评价</a>
											</div>
										</div>
										<div class="overview-detail cf J-hub">
											<div class="rating-area total-detail">
												<div class="total-group total-score">
													<span><span class="average-score">{pigcms{$now_group.score_mean}</span>分</span>
												</div>
											</div>
											<div class="rating-area score-detail">
												<div class="total-group">
													<span class="common-rating rating-16x16"><span class="rate-stars" style="width:{pigcms{$now_group['score_mean']/5*100}%"></span></span>
												</div>
											</div>
											<div class="rating-area count-detail">
												<div class="total-group total-count">共 <strong>{pigcms{$now_group.reply_count}</strong> 次评价</div>
											</div>
										</div>
									</div>
									<div class="rate-detail">
										<ul class="J-rate-filter rate-filter ratelist-title cf">
											<li class="rate-filter__item">
												<a href="#" data-tab="all" class="rate-filter__link J-filter-link rate-filter__link--active">全部</a>
											</li>
											<li class="rate-filter__item">
												<a href="#" data-tab="high" class="rate-filter__link J-filter-link">好评</a>
											</li>
											<li class="rate-filter__item">
												<a href="#" data-tab="mid" class="rate-filter__link J-filter-link">中评</a>
											</li>
											<li class="rate-filter__item">
												<a href="#" data-tab="low" class="rate-filter__link J-filter-link">差评</a>
											</li>
											<li class="rate-filter__item">
												<a href="#" data-tab="withpic" class="rate-filter__link J-filter-link">有图</a>
											</li>
											<li class="rate-filter__item push-right">
												<div class="filter-ordertype rate-filter__subitem">
													<select class="J-filter-ordertype dropdown--small" name="sorttype">
														<option value="default">默认排序</option>
														<option value="time">时间排序</option>
													</select>
												</div>
											</li>
										</ul>
										<div class="ratelist-content cf">
											<ul class="J-rate-list"></ul>
											<div class="paginator-wrapper"><div class="paginator J-rate-paginator"></div></div>
										</div>
									</div>
								</div>
							</div>
							<div class="deal-buy-bottom">
								<span class="price">¥<strong>{pigcms{$now_group.price}</strong></span>
								<div id="J-bottom-buy" class="btn-wrapper J-hub">
									<a rel="nofollow" class="J-buy btn-hot buy" href="{pigcms{$now_group.buy_url}">抢购</a>
								</div>
								<ul class="serif buy-bottom-text cf">
									<li>门店价<br><del class="num"><span>¥</span> {pigcms{$now_group.old_price}</del></li>
									<li>折扣<br><span class="num">{pigcms{$now_group.discount}折</span></li>
									<li>已售<br><span class="num">{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</span></li>
								</ul>
							</div>
						</div>
					</div>
					<if condition="$category_hot_group_list">
						<div class="J-bottom-list-wrapper deal-bottom-recommend" style="visibility:visible;">
							<div class="recommend-deals  recommend-skin" id="deal-bottom-list">
								<h3>你可能感兴趣的热门团购</h3>
								<div class="deal-list cf log-mod-viewed">
									<volist name="category_hot_group_list" id="vo">
										<div class="deal">
											<a href="{pigcms{$vo.url}" target="_blank">
												<img width="150" height="90" src="{pigcms{$vo.list_pic}" title="【{pigcms{$vo.prefix_title}】<if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}：</if>{pigcms{$vo.s_name}" class="pic"/>
											</a>
											<h4><a href="{pigcms{$vo.url}" title="【{pigcms{$vo.prefix_title}】<if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}：</if>{pigcms{$vo.s_name}" class="deal-title" target="_blank">【{pigcms{$vo.prefix_title}】<if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}：</if>{pigcms{$vo.s_name}</a></h4>
											<div class="info">
												<if condition="$vo['sale_count']+$vo['virtual_num']"><span class="total">已售<span class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></span></if>
												<strong class="price">¥{pigcms{$vo.price}</strong>
											</div>
										</div>
									</volist>
								</div>
							</div>
						</div>
					</if>
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
							                	<img class="topic-item__img" src="{pigcms{$vo.pic}" data-src="{pigcms{$vo.pic}" data-original="{pigcms{:U('Index/Recognition/get_tmp_qrcode',array('qrcode_id'=> 4000000000+$vo['id']))}" width="238" height="183"/>
							                </a>
								       	 	<h3 class="deal-tile--small__title" style="margin-top: 7px;">
								            	<a class="w-link link--black__green f1" style="font-weight:normal;text-align: center;">{pigcms{$vo.name}</a>
								        	</h3>
							            </li>
						            </volist>
	            				</ul>
	            			</div>
	            		</div>
            		</if>
					<if condition="$like_group_list">
						<div class="component-top-deals">
							<div class="side-extension mall--small top-reco-deals cf log-mod-viewed">
	        					<h3>看了本团购的人还看了</h3>
	        					<volist name="like_group_list" id="vo">
							        <div class="deal-tile--small <if condition="$i eq count($like_group_list)">deal-tile__last</if>">
							      		<a class="deal-tile--small__cover" href="{pigcms{$vo.url}" target="_blank" hidefocus="true" title="【{pigcms{$vo.prefix_title}】<if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}：</if>{pigcms{$vo.s_name}">
							            	<img class="" width="198" height="120" src="{pigcms{$vo.list_pic}"/>
							            	<span class="deal-rank">{pigcms{$i}</span>
							            </a>
							       	 	<h4 class="deal-tile--small__title">
							            	<a class="w-link link--black__green f1" href="{pigcms{$vo.url}" target="_blank" hidefocus="true" title="【{pigcms{$vo.prefix_title}】<if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}：</if>{pigcms{$vo.s_name}" style="font-weight:normal;">【{pigcms{$vo.prefix_title}】<if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}：</if>{pigcms{$vo.s_name}</a>
							        	</h4>
								        <p class="deal-tile--small__detail">
								            <span class="price num">¥<strong>{pigcms{$vo.price}</strong></span>
								            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="sales f1">已售<strong class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</strong></span></if>
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
			</div>
		</div>
	</div>
	<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
		<div style="position:absolute;left:44%;top:<if condition="$now_group['wx_cheap']">150<else/>244</if>px;margin-left:500px;z-index:70;_display:none;"><img src="{pigcms{$static_path}images/group_detail_spread.png"/><div style="position:absolute;width:16px;height:16px;right:26px;z-index:200;top:18px;cursor:pointer; background-repeat:no-repeat;" onclick="$(this).parent().remove();"></div></div>
	</if>
	<include file="Public:footer"/>
<script type="text/javascript">
$(document).ready(function(){
	$(".topic-item__img").mouseenter(function(){
		$(this).attr('src', $(this).attr('data-original') + '&rand=' + Math.random());
	}).mouseleave(function(){
		$(this).attr('src', $(this).attr('data-src'));
	});
});
</script>
</body>
</html>
