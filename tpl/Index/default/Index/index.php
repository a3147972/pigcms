<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.seo_title}</title>
	<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
	<meta name="description" content="{pigcms{$config.seo_description}" />
	<if condition="$config['wap_redirect']">
		<script>
			if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
				<if condition="$config['wap_redirect'] eq 1">
					window.location.href = './wap.php';
				<else/>
					if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
						window.location.href = './wap.php';
					}
				</if>
			}
		</script>
	</if>
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
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/slides.v30fdb768.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/side.v4cfd6eb1.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deallist.v49c087a6.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/floor.v9bda7972.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index-slider.v7062a8fb.css" />
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico">
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	   var group_index_sort_url="{pigcms{:U('Index/group_index_sort')}";
	  </script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/index.js"></script>
</head>
<body id="index" class="pg-floor">
	<header id="site-mast" class="site-mast">
		<include file="Public:header_top"/>
		<div class="site-mast__site-nav-w">
			<div class="site-mast__site-nav">
				<div class="site-mast__site-nav-inner">
					<div class="component-cate-nav">
						<span class="mt-cates">全部分类</span>
						<div class="cate-nav">
							<volist name="all_category_list" id="vo" key="k">
								<div class="J-nav-item">
									<div class="cate-nav__item">
										<div class="nav-level1 <if condition='$k eq 1'>nav-level1--first</if>">
											<dl <if condition="$vo['cat_count'] gt 1">class="nav-level1-inner"</if>>
												<dt>
													<a class="nav-level1__label" href="{pigcms{$vo.url}" hidefocus="true" target="_blank">{pigcms{$vo.cat_name}</a>
												</dt>
												<if condition="$vo['cat_count'] gt 1">
													<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
														<dd class="nav-level1__item">
															<a class="bribe" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
														</dd>
													</volist>
												</if>
											</dl>
											<if condition="$vo['cat_count'] gt 1">
												<i class="nav-level2-indication F-glob F-glob-caret-right-small"></i>
											</if>
										</div>
										<if condition="$vo['cat_count'] gt 1">
											<div class="nav-level2 J-nav-level2" style="visibility:visible;top:0px;display:none;">
												<a class="nav-level2-label" href="{pigcms{$vo.url}" hidefocus="true" target="_blank">{pigcms{$vo.cat_name}</a>
												<div class="nav-level2-tile nav-level2-tile--first">
													<div class="nav-level2-inner">
														<volist name="vo['category_list']" id="voo" key="j">
															<a class="nav-level2__item <if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
														</volist>
													</div>
												</div>
											</div>
										</if>
									</div>
								</div>
							</volist>
						</div>
					</div>
					<nav>
						<ul class="navbar cf">
							<volist name="web_index_slider" id="vo">
								<li class="navbar__item-w"><a class="navbar__item" href="{pigcms{$vo.url}" hidefocus="true"><span class="nav-label">{pigcms{$vo.name}</span></a></li>
							</volist>
						</ul>
					</nav>
					<a target="_blank" href="{pigcms{$config.site_url}/topic/weixin.html" class="nav-inner__side"></a>
				</div>
			</div>
		</header>
		
		<div class="site-wrapper cf">
			<div class="site-wrapper__content">
				<div class="fs site-fs J-site-fs__content">
					<div class="content__cell content__cell-small content__cell--hot">
						<h3 class="label"><i class="F-glob F-glob-hot"></i><span>热门{pigcms{$config.group_alias_name}</span></h3>
						<div class="filter-strip log-mod-viewed">
							<ul class="filter-strip__list">
								<volist name="hot_group_category" id="vo">
									<li><a href="{pigcms{$vo.url}" target="_blank" <if condition="$vo['is_hot']">class="hot"</if>>{pigcms{$vo.cat_name}</a></li>
								</volist>
							</ul>
						</div>
					</div>
					<div class="content__cell content__cell-small content__cell--geo J-filter__geo">
						<h3 class="label"><i class="F-glob F-glob-position"></i><span>全部区域</span></h3>
						<div class="filter-strip log-mod-viewed">
							<a href="{pigcms{$group_category_all}" class="filter-strip__all J-geo-more" target="_blank">更多<span class="tri"></span></a>
							<ul class="filter-strip__list">
								<volist name="all_area_list" id="vo">
									<li><a href="{pigcms{$vo.url}" target="_blank">{pigcms{$vo.area_name}</a></li>
								</volist>
							</ul>
						</div>
					</div>
					<div class="content__cell  content__cell-small content__cell--area">
						<h3 class="label"><i class="F-glob F-glob-shangquan"></i><span>热门商圈</span></h3>
						<div class="filter-strip log-mod-viewed">
							<ul class="filter-strip__list">
								<volist name="hot_circle_list" id="vo">
									<li><a href="{pigcms{$vo.url}" target="_blank">{pigcms{$vo.area_name}</a></li>
								</volist>
							</ul>
						</div>
					</div>
					<div class="content__cell content__cell--slider">
						<div class="component-index-slider">
							<div class="index-slider ui-slider log-mod-viewed">
								<div class="pre-next">
									<a style="display:none;" href="javascript:;" hidefocus="true" class="mt-slider-previous sp-slide--previous" ></a>
									<a style="display:none;" href="javascript:;" hidefocus="true" class="mt-slider-next sp-slide--next"></a>
								</div>
								<div class="head ccf">
									<h2><span class="icon F-glob F-glob-star"></span>最新{pigcms{$config.group_alias_name}</h2>
									<ul class="trigger-container ui-slider__triggers mt-slider-trigger-container">
										<volist name="new_group_list" id="vo">
											<if condition="$i%2 eq 1">
												<li class="mt-slider-trigger <if condition='$i eq 1'>mt-slider-current-trigger</if>" style="margin:0 0 0 8px;"></li>
											</if>
										</volist>
									</ul>
								</div>
								<ul class="content">
									<li class="cf">
										<volist name="new_group_list" id="vo">
											<div class="<if condition='$i%2 eq 1'>left<else/>right</if>">
												<if condition='$i%2 eq 1'>
													<span class="slide__side--left"></span>
												</if>
												<em class="J-discount discount">{pigcms{$vo.discount}</em>
												<a class="link ccf" target="_blank" href="{pigcms{$vo.url}"><img class="img" width="366" height="220" src="{pigcms{$vo.list_pic}"/></a>
												<div class="title">
													<span class="slide__split--line"></span>
													<a class="xtitle link ccf" target="_blank" href="{pigcms{$vo.url}">{pigcms{$vo.merchant_name}</a>
													<p class="desc">{pigcms{$vo.s_name}</p>
												</div>
												<span class="price">¥<strong>{pigcms{$vo.price}</strong></span>
												<if condition='$i%2 eq 0'>
													<span class="slide__side--right"></span>
												</if>
											</div>
											<if condition='$i%2 eq 0 && count($new_group_list) gt $i'></li><li class="cf" style="display:none;"></if>
										</volist>
									</li>
								</ul>
							</div>
						</div> 
					</div>
				</div>
				<div class="hots J-hub log-mod-viewed">
					<div class="label">
						<a class="logo" target="_blank" href="{pigcms{$group_category_all}"></a>
					</div>
					<div class="yui3-widget mt-slider">
						<div class="deals J-hots-deals mt-slider-content">
							<div class="reco-slides J-option-content">
								<ul class="reco-slides__slides mt-slider-sheet-container">
									<li class="mt-slider-sheet mt-slider-current-sheet">
										<volist name="index_sort_group_list" id="vo">
											<div class="hotdeal <if condition='$i%4 eq 0'>hotdeal--last</if>" group-id="{pigcms{$vo.group_id}">
												<a href="{pigcms{$vo.url}" target="_blank"><img src="{pigcms{$vo.list_pic}" width="207" height="127" alt="{pigcms{$vo.s_name}"/></a>
												<a href="{pigcms{$vo.url}" title="{pigcms{$vo.s_name}" class="f1 hotdeal__title" target="_blank">{pigcms{$vo.s_name}</a>
												<div class="hotdeal__detail">
													<strong class="f4 price">¥{pigcms{$vo.price}</strong>
													<if condition="$vo['wx_cheap']">
														<span class="f1 description">微信购买立减¥{pigcms{$vo.wx_cheap}</span>
													</if>
												</div>
											</div>
											<if condition='$i%4 eq 0 && count($index_sort_group_list) gt $i'></li><li class="mt-slider-sheet" style="display:none;"></if>
										</volist>
									</li>
								</ul>
								<a href="javascript:void(0)" hidefocus="true" class="reco-slides__roll reco-slides__roll--blacksquare reco-slides__roll--blacksquare--previous mtdisable" style="opacity:0;"></a>
								<a href="javascript:void(0)" hidefocus="true" class="reco-slides__roll reco-slides__roll--blacksquare reco-slides__roll--blacksquare--next mtdisable" style="opacity:0;"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="floors cf">
					<div class="mall mall--3cols J-mall J-hub">
						<volist name="index_group_list" id="vo">
							<if condition="!empty($vo['group_list'])">
								<div class="category-floor">
									<div class="category-floor__head">
										<if condition="count($vo['category_list']) gt 1">
											<ul class="sub-categories">
												<volist name="vo['category_list']" id="voo" offset="0" length="6" key="j">
													<li class="sub-categories__cell <if condition="$j eq 6">sub-categories__cell--last</if>">
														<a target="_blank" href="{pigcms{$voo.url}" class="link">{pigcms{$voo.cat_name}</a>
													</li>
												</volist>
												<li class="sub-categories__cell sub-categories__cell--all">
													<a target="_blank" href="{pigcms{$vo.url}" class="link">全部<span class="arrow"></span></a>
												</li>
											</ul>
										</if>
										<a class="title" href="{pigcms{$vo.url}" target="_blank">{pigcms{$vo.cat_name}</a>
									</div>
									<div class="category-floor__body cf">
										<volist name="vo['group_list']" id="voo">
											<div class="deal-tile--br deal-tile <if condition='$i%3 eq 0'>deal-tile--even</if>" group-id="{pigcms{$voo.group_id}">
												<a href="{pigcms{$voo.url}" class="deal-tile__cover" hidefocus="true" target="_blank">
													<img  width="314" height="192" class="J-webp" alt="{pigcms{$voo.s_name}" src="{pigcms{$voo.list_pic}" />
													<span class="good-img-wrap">
														<span class="range-area">
															<span class="range-bg"></span>
															<span class="range-desc"><img class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']))}"/>微信扫码 手机查看</span>
														</span>
													</span>
													<span class="deal-mark">
														<if condition="$voo['tuan_type'] eq 1"><span class="deal-mark__item deal-mark__item--voucher" title="代金券">代金券</span></if>
													</span>
												</a>
												<h3 class="deal-tile__title">
													<a href="{pigcms{$voo.url}" class="w-link" title="{pigcms{$voo.s_name}"  hidefocus="true" target="_blank">
														<span class="xtitle">【{pigcms{$voo.prefix_title}】{pigcms{$voo.merchant_name}</span>
														<span class="short-title">{pigcms{$voo.group_name}</span>
													</a>
												</h3>
												<p class="deal-tile__detail">
													<span class="price">¥<strong>{pigcms{$voo.price}</strong></span>
													<span class="value"><if condition="$voo['tuan_type'] eq 2">零售价<else/>门店价</if><del class="num"><span>¥</span>{pigcms{$voo.old_price}</del></span>
													<if condition="$voo['wx_cheap']">
														<span class="wx_cheap_span">微信购买立减¥{pigcms{$voo.wx_cheap}</span>
													</if>
												</p>
												<div class="deal-tile__extra">
													<p class="extra-inner">
														<span class="sales">已售<strong class="num">{pigcms{$voo['sale_count']+$voo['virtual_num']}</strong></span>
														<if condition="$voo['reply_count']">
															<a href="{pigcms{$voo.url}#anchor-reviews" class="rate-info" hidefocus="true" target="_blank">
																<span class="rate-info__bar common-rating">
																	<span class="rate-stars" style="width:{pigcms{$voo['score_mean']/5*100}%;"></span>
																</span>
																<span class="rate-info__count">{pigcms{$voo.reply_count}次评价</span>
															</a>
														<else/>
															<span class="rate-info rate-info--noreviews">暂无评价</span>
														</if>
													</p>
												</div>
											</div>
										</volist>
									</div>
									<div class="category-floor__foot" data-mtnode="Acategory">
										<a href="{pigcms{$vo.url}" target="_blank" class="link"><span>更多{pigcms{$vo.cat_name}{pigcms{$config.group_alias_name}，请点击查看<i class="link__icon"></i></span></a>
									</div>
								</div>
							</if>
						</volist>
					</div> 
				</div>
			</div>
            <div class="J-hub elevator-wrapper" style="display:none;">
                <ul class="elevator">
					<volist name="index_group_list" id="vo">
						<if condition="!empty($vo['group_list'])">
							<li class="elevator__floor <switch name='i'><case value='2'>xiuxianyule</case><case value='3'>dianying</case><case value='4'>jiudian</case><case value='5'>shenghuo</case><case value='6'>wanggou</case><case value='7'>jiankangliren</case><case value='8'>lvyou</case><default/>meishi</switch>">
								<a class="link" hidefocus="true">
									<span>{pigcms{$vo.cat_name}</span>
								</a>
							</li>
						</if>
					</volist>
                </ul>
            </div> 
			<div class="site-wrapper__side">
				<if condition="$index_right_adver">
	        		<div class="side__block side__activity">
	        			<div class="lottery">
	            			<ul class="lotter__slider-container J-hub">
	            				<volist name="index_right_adver" id="vo">
					            <li class="slider" >
					                <a href="{pigcms{$vo.url}" title="{pigcms{$vo.name}">
					                	<img src="{pigcms{$vo.pic}" width="206" height="159" />
					                </a>
					            </li>
					            </volist>
	            			</ul>
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
	<!-- bd end -->
	<style>.holy-reco{width:980px;margin:0 auto;padding-bottom:20px;_display:none}.holy-reco__content{border:1px solid #E8E8E8;border-top:0;padding:10px;background:#FFF}.holy-reco__content a{display:inline-block;color:#666;font-size:12px;padding:0 5px;line-height:16px;white-space:nowrap;width:85px;overflow:hidden;text-overflow:ellipsis}</style>
	<div class="component-holy-reco">
		<div class="J-holy-reco holy-reco">
			<div>
				<ul class="ccf cf nav-tabs--small">
					<li class="J-holy-reco__label current"><a href="javascript:void(0)" class="tab-item">友情链接</a></li>
				</ul>
			</div>
			<div class="J-holy-reco__content holy-reco__content">
				<volist name="flink_list" id="vo">
					<a href="{pigcms{$vo.url}" title="{pigcms{$vo.info}" target="_blank">{pigcms{$vo.name}</a>
				</volist>
			</div>
		</div>
	</div>
	<include file="Public:footer"/>
</body>
</html>
