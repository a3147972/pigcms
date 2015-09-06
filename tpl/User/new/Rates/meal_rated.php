<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>已评价餐饮订单 | {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
<link href="{pigcms{$static_path}css/meal_order_list.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/category.js"></script>
<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
.category_list li:hover .bmbox {filter:alpha(opacity=50);}
.gd_box{display: none;}
</style>
<![endif]-->
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
</head>
<body id="settings" class="has-order-nav" style="position:static;">
<include file="Public:header_top"/>
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
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
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/rate-edit.vc3f9a1d2.css" />
				<include file="Public:sidebar"/>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<select class="J-orders-filter orders-filter dropdown--small">
							<option value="{pigcms{:U('Rates/rated')}">{pigcms{$config.group_alias_name}</option>
							<option value="{pigcms{:U('Rates/meal_rated')}" selected="selected">{pigcms{$config.meal_alias_name}</option>
						</select>
						<if condition="$order_list">
							<div id="order-list" class="rate-list">
								<div class="component-rate-edit mt-component--booted">
									<div class="rate-edit">
										<volist name="order_list" id="vo">
											<div class="rate-item <if condition="$i eq count($order_list)">rate-item--last</if>">
												<div class="rate-item__title">
													<a href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.name}">
														<img src="{pigcms{$vo.image}" width="120" height="80" style="border:1px solid #ccc;"/>
													</a>
												</div>
												<div class="J-rate-content rate-item__content">
													<h3 class="J-deal-title">
														<a href="{pigcms{$vo.url}" title="{pigcms{$vo.name}" target="_blank">{pigcms{$vo.name}</a>
													</h3>
													<div class="form-field J-feedback feedback cf">
														<span class="rating-bar overall-rate">
															<label class="text">我的总体评价：</label>
															<span class="widget-rating"><for start="1" end="6"><span data-id="{pigcms{$i}" class="<if condition="$vo['score'] egt $i">widget-rating-star<else/>widget-rating-star-gray</if>"></span></for></span>
															<ins class="widget-rating-intro widget-rating-tips"></ins>
														</span>
													</div>
													<div class="J-rate-wrapper rate-wrapper" pic_ids="{pigcms{$vo.pic}" order_id="{pigcms{$vo.order_id}">
														<if condition="$vo['pic_count']">
															<div class="pic-list-wrapper J-pic-list-wrapper">
																<ul class="J-pic-list pic-list cf">
																	<for start="0" end="$vo['pic_count']">
																		<li class="J-pic-thumbnail pic-item pic-item--loading"></li>
																	</for>
																</ul>
															</div>
														</if>
														<fieldset>
															<div class="area form-field text-area p-node-wordcounter-wrapper">
																<textarea name="comment" class="f-textarea" readonly="readonly" disabled="disabled" style="height:auto;">{pigcms{$vo.comment}</textarea>
															</div>
														</fieldset>
													</div>
												</div>
											</div>
										</volist>
									</div>
								</div>
							</div>
						<else/>
							<div class="notice">您没有已评价的{pigcms{$config.group_alias_name}订单</div>
						</if>
                    </div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>
	<include file="Public:footer"/>
    <script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script>
		$(function(){
			$.each($('.J-rate-wrapper'),function(i,item){
				if($(item).attr('pic_ids') != ''){
					var pigcms_pic_wrapper_dom = $(item).find('.J-pic-list-wrapper');
					var pigcms_pic_listul_dom = $(item).find('.J-pic-list');
					$.post("{pigcms{:U('Rates/ajax_get_pic')}",{pic_ids:$(item).attr('pic_ids'),order_type:1},function(result){
						if(result == '0'){
							pigcms_pic_wrapper_dom.remove();
						}else{
							result = $.parseJSON(result);
							pigcms_pic_listul_dom.empty();
							$.each(result,function(j,jtem){
								pigcms_pic_listul_dom.append('<li class="J-pic-thumbnail pic-item"><img src="'+jtem.s_image+'" width="41" height="41" alt="评论图片" big-src="'+jtem.m_image+'"/></li>');
							});
						}
					});
				}
			});
			$('.J-pic-thumbnail img').live('click',function(){
				var big_src = $(this).attr('big-src');
				window.art.dialog({
					title: '查看大图：',
					lock: true,
					fixed: true,
					opacity: '0.4',
					resize: false,
					content:'<img src="'+big_src+'" alt="评论大图"/>',
					close: null
				});
			});
			$('.J-orders-filter').change(function(){
				window.location.href = $(this).val();
			});
		});
	</script>
</body>
</html>
