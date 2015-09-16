<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>{pigcms{$now_category.cat_name}{pigcms{$config.group_alias_name}列表_{pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/list.css"/>
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script type="text/javascript">
		var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
		</script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script src="{pigcms{$static_path}js/list.js"></script>
		<!--[if IE 6]>
		<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
				body{behavior:url("{pigcms{$static_path}css/csshover.htc"); 
				}
				.category_list li:hover .bmbox {
		filter:alpha(opacity=50);
			 
					}
		  .gd_box{	display: none;}
		</style>
		<![endif]-->
	</head>
	<body>
		<include file="Public:header_top"/>
		<div class="body"> 
			<article>
				<div class="menu cf">
					<div class="menu_left hide">
						<div class="menu_left_top"><img src="{pigcms{$static_path}images/o2o1_27.png" /></div>
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
					<div class="menu_right cf">
						<div class="menu_right_top">
							<ul>
								<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
									<li class="ctur">
										<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
									</li>
								</pigcms:slider>
							</ul>
						</div>
					</div>
				</div>
			</article>
			<article class="menu_table">
				<if condition="$cat_option_html || $top_category">
					<div class="filter-section-wrapper">
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
						{pigcms{$cat_option_html}
					</div>
				</if>
				<div class="sort">
					<ul class="cf">
						<li><a href="{pigcms{$default_sort_url}" <if condition="$_GET['order'] eq '' || $_GET['order'] eq 'all'">class="selected"</if>>默认排序</a></li>
						<li>
							<a href="{pigcms{$hot_sort_url}"<if condition="$_GET['order'] eq 'hot'">class="selected"</if>>
								<div class="li_txt">销量</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a <if condition="$_GET['order'] eq 'price-asc'">href="{pigcms{$price_desc_sort_url}" class="selected time-asc"<elseif condition="$_GET['order'] eq 'price-desc'"/>href="{pigcms{$price_asc_sort_url}" class="selected"<else/>href="{pigcms{$price_desc_sort_url}"  class="time-asc"</if>>
								<div class="li_txt">价格</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a href="{pigcms{$rating_sort_url}" <if condition="$_GET['order'] eq 'rating'">class="selected"</if>>
								<div class="li_txt">好评</div>
								<div class="li_img"></div>
							</a>
						</li>
						<li>
							<a href="{pigcms{$time_sort_url}" <if condition="$_GET['order'] eq 'time'">class="selected"</if>>
								<div class="li_txt">发布时间</div>
								<div class="li_img"></div>
							</a>
						</li>
					</ul>
				</div>
			</article>
			<div class="category cf" id="f1">
				<div class="category_list">
					<if condition="$group_list">
						<ul>
							<volist name="group_list" id="vo">
								<li <if condition='$k%4 eq 0'>class="last--even"</if>>
									<div class="category_list_img">
										<a href="{pigcms{$vo.url}" target="_blank">
											<img alt="{pigcms{$vo.s_name}" class="deal_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$vo.list_pic}"/>
											<div class="bmbox">
												<div class="bmbox_title"> 该商家有 <span>{pigcms{$vo.fans_count}</span> 个粉丝</div>
												<div class="bmbox_list">
													<div class="bmbox_list_img"><img class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$vo['group_id']))}" /></div>
													<div class="bmbox_list_li">
														<ul class="cf">
															<li class="open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html">商家</li>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$vo.mer_id}.html">{pigcms{$config.group_alias_name}</li>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$vo.mer_id}.html">{pigcms{$config.meal_alias_name}</li>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/mermap/{pigcms{$vo.mer_id}.html">地图</li>
														</ul>
													</div>
												</div>
												<div class="bmbox_tip">微信扫码 更多优惠</div>
											</div>
										</a>
										<div class="datal">
											<a href="{pigcms{$vo.url}" target="_blank">
												<div class="category_list_title">【{pigcms{$vo.prefix_title}】{pigcms{$vo.merchant_name}</div>
												<div class="category_list_description">{pigcms{$vo.group_name}</div>
											</a>
											<div class="deal-tile__detail cf">
												<span class="price">&yen;<strong>{pigcms{$vo.price}</strong> </span>
												<span>门店价 &yen;{pigcms{$vo.old_price}</span>	
												<if condition="$vo['wx_cheap']">												
													<div class="cheap">微信购买立减￥{pigcms{$vo.wx_cheap}</div>												
												</if>
											</div>
											<div class="extra-inner">
												<div class="sales">已售<strong class="num">{pigcms{$vo['sale_count']+$vo['virtual_num']}</strong></div >
												<div class="noreviews">
													<if condition="$vo['reply_count']">
														<a href="{pigcms{$vo.url}#anchor-reviews" target="_blank">
															<div class="icon"><span style="width:{pigcms{$vo['score_mean']/5*100}%;" class="rate-stars"></span></div>
															<span>{pigcms{$vo.reply_count}次评价</span>
														</a>
													<else/>
														<span>暂无评价</span>
													</if>
												</div >
											</div>
										</div>
									</div>
								</li>
							</volist>
						</ul>
						{pigcms{$pagebar}
					<else/>
						<div style="text-align:center;height:500px;margin-top:60px;">暂无此类{pigcms{$config.group_alias_name}，请查看其他分类</div>
					</if>
				</div>
				<div class="activity">
					<div class="activity_title">热门活动</div>
					<pigcms:adver cat_key="group_list_right" limit="5" var_name="group_list_right">
						<div class="activity_img"><a href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.name}"><img src="{pigcms{$vo.pic}"/></a></div>
					</pigcms:adver>
				</div>
			</div>
        </div>
		<!--div class="extension_bottom" style="position:absolute;bottom:1400px;right:10px;margin-left:-80px;margin-top:23px;">
			<div class="extension" >
				<div class="side_extension">最近浏览</div>
				<div class="extension_history " >清空</div>
				<div  style="clear:both"></div>
				<div class="side_extension_no">暂无浏览记录</div>
			</div>
		</div-->
		<include file="Public:footer"/>
	</body>
</html>
