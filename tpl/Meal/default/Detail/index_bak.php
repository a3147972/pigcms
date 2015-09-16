<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.seo_title}</title>
	<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
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
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.veda7cace.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ratelist.v4b84fddf.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/restaurant.css" />
	
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
	<script>var get_reply_url="{pigcms{:U('Index/Reply/ajax_get_list',array('order_type'=>1,'parent_id'=>$store['store_id'],'store_count'=>0))}";save_history("{pigcms{$store.name}","{pigcms{$store[images][0]}","{pigcms{:U('Detail/index',array('store_id' => $store[store_id]))}","{pigcms{$store.mean_money}","{pigcms{$config.meal_alias_name}")</script>
</head>
<body id="deal-default" class="pg-deal pg-deal-default pg-deal-detail">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		
		<div class="shopping-cart clearfix" data-status="1" data-poiname="{pigcms{$store.name}" data-poiid="{pigcms{$store.store_id}">
			<div class="order-list" style="top: -130px;display:none">
				<div class="title">
					<span class="fl dishes">菜品<a href="javascript:;" class="clear-cart" onclick="clearCache()">[清空]</a></span>
					<span class="fl">份数</span>
					<span class="fl ti-price">价格</span>
				</div>
				<ul style="height: auto; overflow: visible;" id="menu_list">
					<!-- <li class="clearfix  food-1839319" data-fid="1839319">  
						<div class="fl na " title="青椒肉丝">青椒肉丝</div>
						<div class="fl modify clearfix">    
							<a href="javascript:;" class="fl minus">-</a>    
							<input type="text" class="fl txt-count" value="1 " maxlength="2">    
							<a href="javascript:;" class="fl plus">+</a>  
						</div>  
						<div class="fl pri "><span>¥10</span></div>
					</li> -->
					</ul>
					<div class="total">共<span class="totalnumber" id="total_count">0</span>份，总计<span class="bill" id="total_price">¥0</span></div>
  				</div>
  	    
				<div class="footer clearfix">
					<div class="logo fl"><i class="icon i-shopping-cart"></i></div>
					<div class="brief-order fl">
						<span class="count" >1份</span>
						<span class="price" >¥10</span>
					</div>
					<div class="fr">
						<input class="ready-pay borderradius-2" type="button" value="去下单" style="display: inline-block;">
					<input type="hidden" value="25348:1839319,1" class="order-data" name="shop_cart">
				</div>
			</div>
		</div>
		
		<div class="bdw" id="bdw">
			<div class="cf" id="bd">
				<div class="bread-nav">
					<a class="link--black__green" href="{pigcms{$config.site_url}">网站首页</a>
					<span>»</span>
					<a class="link--black__green" href="{pigcms{$f_category.url}">餐饮</a>
					<span>»</span>{pigcms{$store.name}
				</div>
				<div class="deal-component-container">
					<div class="deal-component-headline">
						<div class="sans-serif">
							<span class="deal-component-title-prefix">【{pigcms{$area.area_name}】</span>
							<h1 class="deal-component-title">{pigcms{$store.name}</h1>
						</div>
						<div class="deal-component-description">{pigcms{$store.txt_info}</div>
                    </div>
					<div class="deal-component-detail cf">
						<div class="deal-component-left">
							<div class="deal-component-images">
								<div class="simple-gallery">
									<div class="deal-component-cover">
										<img class="focus-view" src="{pigcms{$store[images][0]}" alt="{pigcms{$store[images][0]}" width="460" height="280"/>
									</div>
									<div class="candidates">
										<volist name="store['images']" id="vo">
											<img class="<if condition='$i eq 1'>first-image active</if>" src="{pigcms{$vo}" width="78" height="45"/>
										</volist>
									</div>
								</div>
							</div>
						</div>
						<div class="deal-component-info J-deal-component-info J-hub">
							<div class="deal-component-price cf">
								<h2 class="deal-component-price-current sans-serif orange">
									<span class="price-symbol" style="display:inline-block;vertical-align:top;margin-top:7px;font-size:18px;">¥</span>
									<strong>{pigcms{$store.mean_money}</strong>
								</h2>	
							</div>
							<div class="deal-component-rating ccf">
								<span class="item">
									<span class="">已售<span class="deal-component-rating-sold-count orange"><strong>{pigcms{$store['sale_count']}</strong></span></span>
								</span>
								<span class="item">
									<a href="#anchor-reviews"><span class="common-rating stars hidden"><span class="rate-stars" style="width:88%;"></span></span></a>
									<a href="#anchor-reviews" class="look-normal"><span><span class="deal-component-rating-stars orange">{pigcms{$store.score_mean}</span>份</span></a>
								</span>
								<span class="comments-count">
									<a href="#anchor-reviews"><span class="deal-component-rating-comment-count orange">{pigcms{$store.reply_count}</span>人评价</a>
								</span>
							</div>
							<div class="deal-component-dealer">
								<span class="deal-component-detail-leading">商家</span>
								<span class="deal-component-dealer-branches item vertical-divider"><a href="#business-info" data-anchor="#business-info" title="{pigcms{$merchant.name}">{pigcms{$merchant.name}</a></span>
								<span class="deal-component-dealer-detail"><a href="#business-info">查看地址/电话</a></span>
							</div>
							<div class="deal-component-expiry cf deal-component-inline-text-folded ">
								<span class="deal-component-detail-leading left">营业时间</span>
								<span class="deal-component-inline-text-container left">
									<span class="deal-component-inline-text-wrapper">
										<if condition="$store['office_time'] neq ''">
											<span class="deal-component-expiry-valid-through">
												<volist name="store['office_time']" id="st">
													<span class="deal-component-expiry-notice orange">{pigcms{$st.open}--{pigcms{$st.close}</span>
												</volist>
											</span>
										<else />
											<span class="deal-component-expiry-valid-through">24小时营业</span>
										</if>
										<span class="deal-component-expiry-notice-detail"></span>
									</span>
								</span>
							</div>
							<!--div class="deal-component-opening-hours cf deal-component-inline-text-folded">
								<span class="deal-component-detail-leading left">使用时间</span>
								<span class="deal-component-inline-text-container left">
									<span class="deal-component-inline-text-wrapper">
										<span>10:30至次日02:00</span>
									</span>
									
								</span>
							</div-->
							<div class="divider"></div>
							<!-- <div class="deal-component-quantity">
								<span class="deal-component-detail-leading">数量</span>
								<button for="J-cart-minus" type="button">−</button><input type="text" class="J-cart-quantity" name="q" value="{pigcms{$store.once_min}" maxlength="9" data-max="{pigcms{$store.once_max}" data-min="{pigcms{$store.once_min}"/><button for="J-cart-add" class="item" type="button">+</button>
								<span class="deal-component-quantity-warning orange"></span>
							</div> -->
							<div class="deal-component-purchase-button">
								<input type="button" class="J-mini-cart-buy mini-cart-buy basic-deal data-mod-enabled" value="点菜" onclick="$(window).scrollTop($('#anchor-detail').offset().top-50);"/>
								<!--a class="small-btn deal-component-add-favorite J-component-add-favorite item">收藏(<b class="J-fav-count">176</b>)</a>
								<a class="small-btn share-tip J-component-share-tip-dialog">分享到</a-->
							</div>
							<div class="deal-component-commitments " data-mod="da">
								<span class="deal-component-detail-leading">服务承诺</span>
								<span class="deal-component-detail-commitments">
									<a class="anytime-money-back item" title="未消费，随时退款" href="javascript:void(0);">随时退</a>
									<a class="expiring-money-back item" title="过期未消费，无条件退款" href="javascript:void(0);">过期退</a>
									<a class="instant-money-back item" title="无需等待，退款立即到账" href="javascript:void(0);">极速退</a>
									<a class="real-comment item" title="真实消费后的用户评价" href="javascript:void(0);">真实评价</a>
								</span>
							</div>
						</div>
					</div>
				</div>
				
				<div id="content" class="deal-content J-deal-content">
					<div>
						<div id="J-content-navbar" class="flat-content-navbar">
							<ul class="cf">
								<li class="content-navbar__item--current"><a class="tab-item" href="#business-info">商家位置</a></li>
								<!-- li><a class="tab-item" href="#anchor-purchaseinfo">购买须知</a></li-->
								<li><a class="tab-item" href="#anchor-detail">商家菜单</a></li>
								<li><a class="tab-item" href="#anchor-bizinfo">商家介绍</a></li>
								<li><a class="tab-item" href="#anchor-reviews">消费评价<span class="num J-hub">(0)</span></a></li>
							</ul>
							<!--div id="J-nav-buy" class="buy-group J-hub" style="display:none;">
								<a rel="nofollow" class="J-buy btn-hot buy" href="{pigcms{$config.site_url}/group/buy/{pigcms{$store.group_id}">抢购</a>
							</div-->
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
											<div id="map-canvas" class="mapbody" map_point="{pigcms{$store.long},{pigcms{$store.lat}" store_name="{pigcms{$store.name}" store_adress="{pigcms{$store.area_name}{pigcms{$store.adress}" store_phone="{pigcms{$store.phone}" frame_url="{pigcms{:U('Map/frame_map')}"></div>
											<a class="view-full J-view-full" href="javascript:void(0)" title="点击查看完整地图"><i class="view-map-icon"></i>查看完整地图</a>
											<div id="J-map-loading" class="map-loading-mask"></div>
										</div>
										<div class="biz-wrapper J-biz-wrapper biz-wrapper-nobottom inited">
											<div id="J-bizinfo-list" class="all-biz cf">
												<div class="biz-info biz-info--open">
													<h5 class="biz-info__title">
														<a class="poi-link" title="{pigcms{$vo.name}" href="javascript:void(0);">{pigcms{$store.name}</a>
													</h5>
													<div class="biz-info__content">
														<div class="biz-item field-group" title="{pigcms{$store.adress}"><label class="title-label">地址：</label>{pigcms{$store.adress}</div>
														<div class="biz-item link-item">
															<a class="view-map" href="javascript:void(0)" area_long="{pigcms{$store.long}" area_lat="{pigcms{$store.lat}">查看地图</a>
															<a class="search-path" href="javascript:void(0)" shop_name="{pigcms{$store.adress}">公交/驾车去这里</a>
														</div>
														<div class="biz-item"><span class="title-label">电话：</span>{pigcms{$store.phone}</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="blk detail">
									<h2 class="content-title" id="anchor-detail">商家菜单</h2>
									<style>
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
									
									<div class="group_content">
										<div class="food-list fl">
											<div class="informer">
												<!-- <span>餐厅尚未开始营业，您的订单会在餐厅开始营业（11:00）之后处理。</span> -->
											</div>
											
											<div class="ori-foodtype-nav clearfix">
												<span class="fl title ct-middlegrey">菜品分类：</span>
												<ul>
													<volist name="sorts" id="sort">
													<if condition="empty($sort['meals']) neq true">
													<li <if condition="$i eq 1">class="active"</if> onclick="$(this).addClass('active').siblings().removeClass('active');">
														<a href="javascript:;" class="type" data-anchor="0" title="{pigcms{$sort['sort_name']}" onclick="$(window).scrollTop($('#category_{pigcms{$sort.sort_id}').offset().top-50);">
															<span class="name">{pigcms{$sort['sort_name']}</span>
														</a>
													</li>
													</if>
													</volist>
												</ul>
											</div>
											
											<div class="food-nav">
												<volist name="sorts" id="vo">
												<if condition="empty($vo['meals']) neq true">
												<div class="category" id="category_{pigcms{$vo.sort_id}">
													<h3 class="title title-3 ct-deepgrey" title="{pigcms{$vo.sort_name}"><span class="tag-na">{pigcms{$vo.sort_name}</span></h3>
													<div class="pic-food-cont clearfix">
														<volist name="vo['meals']" id="meal">
														<div class="pic-food  <if condition="$i%3 eq 0">pic-food-col2</if>" id="{pigcms{$meal['meal_id']}">
															<div class="avatar">
																<img src="{pigcms{$meal['image']}" class="food-shape scroll-loading" data-src="{pigcms{$meal['image']}" style="background-image: url({pigcms{$meal['image']});">
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
																<a href="javascript:;" class="add fr"><i class="icon i-addcart" onclick="addProduct({pigcms{$meal['meal_id']},'{pigcms{$meal['name']}','{pigcms{$meal['price']}',1)"></i></a>
																<span id="food-cart-num_{pigcms{$meal['meal_id']}" class="pic-food-cart-num fr" style="display:none">1</span>
																<div class="price fl">
																	<div class="only">¥{pigcms{$meal['price']}/{pigcms{$meal['unit']}</div>
																</div>
															</div>
														</div>
														</volist>
													</div>
												</div>
												</if>
												</volist>
											</div>
										</div>
									</div>
									<div id="anchor-bizinfo">
										<h2 class="content-title">商家介绍</h2>
										<p class="standard-bar">{pigcms{$merchant.name}</p>
										<div class="standard-content">
											<p>{pigcms{$merchant.txt_info}</p>
											<volist name="merchant['merchant_pic']" id="vo">
												<img src="{pigcms{$vo}" alt="{pigcms{$merchant.name}" class="standard-image"/>
											</volist>
										</div>
									</div>
								</div>
								<div id="anchor-reviews" class="user-reviews J-rate-wrapper J-hub" >
									<div class="rate-overview J-hub" id="J-overview">
										<div class="overview-head content-title cf">
											<h3 class="overview-title">消费评价</h3>
											<div class="overview-feedback to-rate">
												我买过本单，<a href="{pigcms{:U('User/Rates/meal')}" target="_blank">我要评价</a>
											</div>
										</div>
										<div class="overview-detail cf J-hub">
											<div class="rating-area total-detail">
												<div class="total-group total-score">
													<span><span class="average-score">{pigcms{$store.score_mean}</span>分</span>
												</div>
											</div>
											<div class="rating-area score-detail">
												<div class="total-group">
													<span class="common-rating rating-16x16"><span class="rate-stars" style="width:{pigcms{$store['score_mean']/5*100}%"></span></span>
												</div>
											</div>
											<div class="rating-area count-detail">
												<div class="total-group total-count">共 <strong>{pigcms{$store.reply_count}</strong> 次评价</div>
											</div>
										</div>
									</div>
									<div class="rate-detail">
										<ul class="J-rate-filter rate-filter ratelist-title cf">
								            <li class="rate-filter__item">
								                <a href="#" target="_blank" data-tab="all" class="rate-filter__link J-filter-link rate-filter__link--active">全部</a>
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
								                <div class="rate-filter__subitem">
								                    <input name="withcontent" type="checkbox" checked="" class="select-checkbox J-rate-withcontent" id="with-content">
								                    <label class="withcontent-label" for="with-content">有内容的评价</label>
								                </div>
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
							      		<a class="deal-tile--small__cover" href="{pigcms{$vo.url}" target="_blank" hidefocus="true" title="【{pigcms{$vo.group_name}】{pigcms{$vo.merchant_name}{pigcms{$vo.s_name}">
							            	<img class="" width="198" height="120" src="{pigcms{$vo.list_pic}"/>
							            	<span class="deal-rank">{pigcms{$i}</span>
							            </a>
							       	 	<h4 class="deal-tile--small__title">
							            	<a class="w-link link--black__green f1" href="{pigcms{$vo.url}" target="_blank" hidefocus="true" title="【{pigcms{$vo.group_name}】{pigcms{$vo.merchant_name}{pigcms{$vo.s_name}">【{pigcms{$vo.group_name}】{pigcms{$vo.merchant_name}{pigcms{$vo.s_name}</a>
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
				<footer class="site-info-w">
				    <div class="site-info">
				        <div class="copyright">
				            <p>&copy;<span>2014</span> <a href="{pigcms{$config.site_url}">{pigcms{$config.site_name}</a> {pigcms{$config.top_domain} <if condition="!empty($config['site_icp'])"><a href="http://www.miibeian.gov.cn/" target="_blank">{pigcms{$config.site_icp}</a></if></p>
				        </div>
				    </div>
				</footer>
<script type="text/javascript">
var cart = new OAK.Shop.Cart();
// cart.store_id = {pigcms{$store.store_id};
function addProduct(productId,name,price,addnum) 
{
    cart.addProduct(OAK.Shop.Product({id: productId, number: addnum, price: price, name: name}));
	coutss();
}

function reduceProduct(productId, num) 
{
    var oldnum = cart.getProductNumber({id: productId});
    if (oldnum !== null) {
        if (oldnum -num > 0) {
            cart.updateNumber(oldnum - num, {id: productId});
        } else {
            cart.deleteProduct({id: productId});
            $("#food-cart-num_" + productId).text(0).hide();
        }
    }
	coutss();
}
cart.showProductNum =  function(productId,num){
    if (num>0) {
    	$("#food-cart-num_" + productId).text(num).show();
    } else {
    	$("#food-cart-num_" + productId).text(num).hide();
    }
}
cart.showTotalNum = function(){
    var quant = cart.getQuantity();
	$("#total_count").text(quant.totalNumber); 
	$("#total_price").text("￥"+quant.totalAmount);
};

cart.showCartInfo=function () {
	var products = cart.getProductList();
	for(var i in products){
		var product_id = products[i].id;
		cart.showProductNum(product_id,cart.getProductNumber({id:product_id})||0);
	}
	cart.showTotalNum();
};

cart.onAfterAdd = function(obj, num, conditions){
    cart.showProductNum(conditions.id, num);
    cart.showTotalNum();
    cart.saveToCache();
};

cart.onAfterUpdate = function(obj, num, conditions){
    cart.showProductNum(conditions.id, num);
    cart.showTotalNum();
    cart.saveToCache();
};

cart.onAfterDelete = function(obj,conditions){
    cart.showProductNum(conditions.id, 0);
    cart.showTotalNum();
    cart.saveToCache();
};

$(document).ready(function(){
	cart.getFromCache();
	var storeid = {pigcms{$store.store_id};
	if (storeid != cart.store_id) {
		clearCache();
		cart.store_id = storeid;
		cart.getFromCache();
	}
	cart.showCartInfo();
	coutss();
});

function snums()
{
	var products = cart.getProductList();
	for(var i in products) {
		var product_id = products[i].id;
		cart.showProductNum(product_id, cart.getProductNumber({id:product_id})||0);
	}
	cart.showTotalNum();
}

function sum(arguments)
{
	var r = 0;
	for (var i = 0; i<arguments.length ;i++ ) {
		if(typeof(arguments[i]) != "undefined"){
			r=parseInt(arguments[i])+r;
		}
	}
	return r;
}
function coutss()
{
	var products = cart.getProductList();
	var html = '';
	var k = 0;
	for(var i in products){
		var pid = products[i].id;
		var name = products[i].name;
		var num = products[i].number;
		var price = products[i].price;
		if (products[i].number > 0) {
			$("#food-cart-num_" + pid).text(products[i].number).show();
			html += '<li class="clearfix  food-' + pid + '" data-fid="' + pid + '">';
			html += '<div class="fl na " title="' + name + '">' + name + '</div>';
			html += '<div class="fl modify clearfix">';
			html += '<a href="javascript:;" class="fl minus" onclick="reduceProduct('+pid+',1)">-</a>';
			html += '<input type="text" class="fl txt-count" value="'+num+'" maxlength="2">';
			html += '<a href="javascript:;" class="fl plus" onclick="addProduct('+pid+',\''+name+'\',\''+price+'\',1)">+</a>';
			html += '</div>';
			html += '<div class="fl pri "><span>¥'+price+'</span></div>';
			html += '</li>';
			k++;
		} else {
			$("#food-cart-num_" + pid).text(products[i].number).show();
		}
	}
	var top = k * 50 * -1 -80;
	$("#menu_list").html(html);
	if (k > 0) {
		$('.borderradius-2').removeClass('ready-pay').addClass('go-pay').bind('click', function(){
			location.href='/meal/order/{pigcms{$store['store_id']}.html'
		});
		
		$(".order-list").css({'top':top + 'px','display':'block'});
	} else {
		$('.borderradius-2').removeClass('go-pay').addClass('ready-pay').unbind('click');
		$(".order-list").css({'top':top + 'px','display':'none'});
	}
}
function clearCache()
{
	var products = cart.getProductList();
	for(var i in products){
		$("#food-cart-num_" + products[i].id).text(0).hide();
	}
    cart.clear();
    cart.showCartInfo();
    coutss();
}
</script>
</body>
</html>
