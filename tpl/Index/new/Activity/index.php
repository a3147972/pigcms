<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>活动列表 - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link href="{pigcms{$static_path}css/activity.css"  rel="stylesheet"  type="text/css" />
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script>
			function format_time(time){
				if(time < 10){
					time = '0'+time;
				}
				return time;
			}
			$(function(){				
				var timeHDom = $('#time_h');
				var timeMDom = $('#time_m');
				var timeSDom = $('#time_s');
				var timeMMDom = $('#time_mm');
				var timer = setInterval(function(){
					var timeH = parseInt(timeHDom.html());
					var timeM = parseInt(timeMDom.html());
					var timeS = parseInt(timeSDom.html());
					var timeMM = parseInt(timeMMDom.html());					
					if(timeMM == 0){
						if(timeS == 0){
							if(timeM == 0){
								if(timeH == 0){
									clearInterval(timer);
									window.location.reload();
								}else{
									timeHDom.html(format_time(timeH-1));
								}
								timeMDom.html('59');
							}else{
								timeMDom.html(format_time(timeM-1));
							}
							timeSDom.html('59');
						}else{
							timeSDom.html(format_time(timeS-1));
						}
						timeMMDom.html('90');
					}else{
						timeMMDom.html(format_time(timeMM-1));
					}
				},10);
			});
		</script>
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
			body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
			.category_list li:hover .bmbox {filter:alpha(opacity=50);}
			.gd_box{display:none;}
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
													<span><a href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a></span>
												</volist>
											</div>
											<div class="list_txt">
												<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
												<volist name="vo['category_list']" id="voo" key="j">
													<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
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
		</div>
		<div class="banner activity_banner">
			<div class="banner_img">
				<img src="{pigcms{$now_activity.bg_pic}"/>
				<div class="banner_list">
					<div class="banner_list_txt">距<if condition="$time_array['type'] eq 1">开始<else/>结束</if></div>
					<div id="divdown1">
						<div class="banner_list_data" id="time_h">{pigcms{$time_array['h']}</div><div class="banner_list_icon"></div>
						<div class="banner_list_data" id="time_m">{pigcms{$time_array['m']}</div><div class="banner_list_icon"></div>
						<div class="banner_list_data" id="time_s">{pigcms{$time_array['s']}</div><div class="banner_list_icon"></div>
						<div class="banner_list_data" id="time_mm" style="color:red">00</div>
					</div>
				</div>
			</div>
        </div>
        <div class="body">
			<div class="menu_table">
				<div class="nearby cf">
					<div class="category cf">
						<div class="cate">区域：</div>
						<div class="cate_cate">
							<volist name="activity_area_list" id="vo">
								<span><a href="{pigcms{$vo.url}" <if condition="$activity_area eq $vo['area_url']">style="color:red;"</if>>{pigcms{$vo.area_name}</a></span>
							</volist>
						</div>
					</div>
					<div class="category cf" style="border:0;">
						<div class="cate">类别：</div>
						<div class="cate_cate">
							<volist name="activity_type_list" id="vo">
								<span><a href="{pigcms{$vo.url}" <if condition="$activity_type eq $vo['type']">style="color:red;"</if>>{pigcms{$vo.name}</a></span>
							</volist>
						</div>
					</div>
				</div>
			</div>
			<div class="category cf" id="f1">
				<div class="category_list">
					<if condition="$activity_list">
						<ul class="cf">
							<volist name="activity_list" id="vo">
								<li <if condition="$i%4 eq 0">class="last--even"</if>>
									<div class="category_list_img">
										<a href="{pigcms{$vo.url}" target="_blank">
											<img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.product_name}"/>			
											<if condition="$vo['is_finish']">
												<div class="bmbox">
													<div class="bmbox_tips">该活动已经售罄结束</div>
												</div>
											<else/>
												<!--div class="bmbox">
													<div class="bmbox_title"> 该商家有<span>{pigcms{$vo.fans_count}</span>个粉丝</div>
													<div class="bmbox_list">
														<div class="bmbox_list_img"><img src="images/o2o11_1_115.png"></div>
														<div class="bmbox_list_li">
															<ul>
																<li>活动</li>
																<li>会员卡</li>
																<li>优惠券</li>
																<li>活动</li>
																<div style="clear:both"></div>
															</ul>
														</div>
													</div>
												</div-->
											</if>
										</a>
										<div class="datal">
											<div class="category_list_title"><a href="{pigcms{$vo.url}" target="_blank">{pigcms{$vo.name}</a><if condition="$vo['is_finish']"><span class="finish_tip">【已结束】</span></if></div>
											<div class="category_list_description">{pigcms{$vo.title}</div>
											<div class="deal-tile__detail cf" style="border-bottom:0;">
												<if condition="$vo['type'] eq 1">
													<span id="people">总需 <strong>{pigcms{$vo.price}</strong> 人次</span>
												<else/>
													<span id="price"><if condition="$vo['money']">¥<strong>{pigcms{$vo.money}</strong><else/><strong>{pigcms{$vo.mer_score}</strong> 积分</if></span>
												</if>
												<div style="float:right;">已参与 <strong class="num" style="color:#fe5842;">{pigcms{$vo.part_count}</strong></div>
											</div>
										</div>
									</div>
								</li>
							</volist>
						</ul>
						{pigcms{$pagebar}
					<else/>
						<div style="text-align:center;height:400px;margin-top:80px;">暂无此类活动，请查看其他分类</div>
					</if>
				</div>
			</div>
        </div>
		<include file="Public:footer"/>
	</body>
</html>
