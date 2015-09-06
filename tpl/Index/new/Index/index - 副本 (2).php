<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>{pigcms{$config.seo_title}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ydyfx.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index-slider.css"/>
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
		<script src="{pigcms{$static_path}js/navfix.js"></script>	
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script src="{pigcms{$static_path}js/index.js"></script>	
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
			<div class="gd_box" style="position:absolute;top:2400px;margin-left:-80px;margin-top:123px;">
				<div id="gd_box">
					<div id="gd_box1">
						<div id="nav" style="background-color:#ff8a7a;">
							<ul>
								<php>$autoI = 0;</php>
								<volist name="index_group_list" id="vo">
									<if condition="!empty($vo['group_list'])">
										<li <if condition="$i eq 1">class="current"</if>>
											<a class="f{pigcms{$i}" onClick="scrollToId('#f{pigcms{$i}');"><img src="{pigcms{$vo.cat_pic}" />
												<div class="scroll_{pigcms{$autoI%7+1}">{pigcms{$vo.cat_name}</div>
											</a>
										</li>
										<php>$autoI++;</php>
									</if>
								</volist>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<article>
				<div class="menu cf">
					<div class="menu_left">
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
						<div class="menu_right_bottom cf">
							<div class="mainbav">
								<div class="main_list">
									<div class="mainbav_left">
										<div class="mainbav_icon"><img src="{pigcms{$static_path}images/o2o1_35.png" /></div>
										<div class="mainbav_txt">热门团购</div>
									</div>
									<div class="mainbav_list">
										<volist name="hot_group_category" id="vo">
											<span><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></span>
										</volist>
									</div>
									<div  style="clear:both"></div>
								</div>
								<div class="main_list">
									<div class="mainbav_left">
										<div class="mainbav_icon"><img src="{pigcms{$static_path}images/o2o1_38.png" /></div>
										<div class="mainbav_txt">全部区域</div>
									</div>
									<div class="mainbav_list">
										<volist name="all_area_list" id="vo">
											<span><a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a></span>
										</volist>
									</div>
									<div  style="clear:both"></div>
								</div>
								<div class="main_list">
									<div class="mainbav_left">
										<div class="mainbav_icon"><img src="{pigcms{$static_path}images/o2o1_42.png" /></div>
										<div class="mainbav_txt">热门商圈</div>
									</div>
									<div class="mainbav_list">
										<volist name="hot_circle_list" id="vo">
											<span><a href="{pigcms{$vo.url}">{pigcms{$vo.area_name}</a></span>
										</volist>
									</div>
								</div>
							</div>
							<div class="scroll cf">
								<div class="scroll_left">
									<div class="scroll_top">
										<div class="scroll_top_left">
											<div class="scroll_top_left_img"><img src="{pigcms{$static_path}images/o2o1_47.png" /></div>
											<div class="scroll_top_txt">今日特惠</div>
										</div>
										<div class="scroll_top_right"> 
											<script language="javascript" type="text/javascript"> 
											var interval = 1000; 
											function ShowCountDown(year,month,day,divname) 
											{ 
											var now = new Date(); 
											var endDate = new Date(year, month-1, day); 
											var leftTime=endDate.getTime()-now.getTime(); 
											var leftsecond = parseInt(leftTime/1000); 
											//var day1=parseInt(leftsecond/(24*60*60*6)); 
											var day1=Math.floor(leftsecond/(60*60*24)); 
											var hour=Math.floor((leftsecond-day1*24*60*60)/3600); 
											var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60); 
											var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60); 
											var hao= leftsecond%60; 
											var cc = document.getElementById(divname); 
											cc.innerHTML ="<div class='scroll_top_right_img_shi'>"+hour+"</div>"+"<div class='scroll_top_txt'>时</div><div class='scroll_top_right_img'>"+minute+"</div>"+" <div class='scroll_top_txt'>分</div><div class='scroll_top_right_img'>"+second+"</div>"+"  <div class='scroll_top_txt'>秒</div><div class='scroll_top_right_img' style='color:red;'>"+hao+"</div>"; 
											} 
											window.setInterval(function(){ShowCountDown(2010,4,20,'divdown1');}, interval); 
											</script>
											<div class="scroll_top_txt">距离结束：</div>
											<div id="divdown1"></div>
										</div>
									</div>
									<include file="Public:scroll"/>
								</div>
								<div class="scroll_right cf">
									<div class="scroll_right_top">
										<div class="scroll_right_top_img"><img src="{pigcms{$static_path}images/o2o11_57.png" /></div>
										<div class="scroll_right_top_txt">下期预告</div>
									</div>
									<div class="scroll_right_bottom cf">
										<div class="scroll_right_bottom_title">
											<div class="scroll_right_bottom_title_img"><img src="{pigcms{$static_path}images/o2o11_74.png" /></div>
											<div class="scroll_right_bottom_title_txt">本站信息</div>
										</div>
										<ul>
											<li>
												<div class="li_img"><img src="{pigcms{$static_path}images/o2o11_80.png" /></div>
												<div class="li_txt">今日新增粉丝<span>789</span>位</div>
											</li>
											<li>
												<div class="li_img"><img src="{pigcms{$static_path}images/o2o11_84.png" /></div>
												<div class="li_txt">今日新增粉丝<span>789</span>位</div>
											</li>
											<li>
												<div class="li_img"><img src="{pigcms{$static_path}images/o2o11_87.png" /></div>
												<div class="li_txt">今日新增粉丝<span>789</span>位</div>
											</li>
											<li>
												<div class="li_img"><img src="{pigcms{$static_path}images/o2o11_91.png" /></div>
												<div class="li_txt">今日新增粉丝<span>789</span>位</div>
											</li>
											<li>
												<div class="li_img"><img src="{pigcms{$static_path}images/o2o11_94.png" /></div>
												<div class="li_txt">今日新增粉丝<span>789</span>位</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
			<pigcms:near_shop limit="8"/>
			<article class="nearby cf">
				<div class="nearby_left">
					<div class="nearby_left_top">
						<div class="nearby_left_top_img"><img src="{pigcms{$static_path}images/o2o11_98.png" /></div>
						<div class="nearby_left_top_txt"><if condition="$is_near_shop">附近快店<else/>推荐快店</if></div>
					</div>
					<div class="nearby_left_bottom">
						<div class="nearby_left_img"> 
							<script>
								$(function(){
									//最新团购
									var component_slider_timer = null;
									function component_slider_play(){
										component_slider_timer = window.setInterval(function(){
											var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index();
											if(slider_index == $('.component-index-slider .mt-slider-trigger-container li').size() - 1){
												slider_index = 0;
											}else{
												slider_index++;
											}
											$('.component-index-slider .content li').eq(slider_index).css({'opacity':'0','display':'block'}).animate({opacity:1},600).siblings().hide();
											$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
										},3400);
									}
									component_slider_play();
									$('.component-index-slider').hover(function(){
										window.clearInterval(component_slider_timer);
										$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').css({'opacity':'0.6'}).show();
									},function(){
										window.clearInterval(component_slider_timer);
										component_slider_play();
										$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').css({'opacity':'0'}).hide();
									});
									$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').hover(function(){
										$(this).css({'opacity':'1'});
									});
									$('.component-index-slider .mt-slider-trigger-container li').click(function(){
										if($(this).hasClass('mt-slider-current-trigger')){
											return false;
										}
										var slider_index = $(this).index();
										$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
										$(this).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
									});
									$('.component-index-slider .mt-slider-previous').click(function(){
										var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index()-1;
										if(slider_index < 0){
											slider_index = $('.component-index-slider .mt-slider-trigger-container li').size()-1;
										}
										$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
										$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
									});
									$('.component-index-slider .mt-slider-next').click(function(){
										var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index()+1;
										if(slider_index == $('.component-index-slider .mt-slider-trigger-container li').size()){
											slider_index = 0;
										}
										$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
										$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
									});
								});
							</script>
							<div class="content__cell content__cell--slider" style="width:252px;">
								<div class="component-index-slider">
									<div class="index-slider ui-slider log-mod-viewed">
										<div class="pre-next"> <a style="opacity: 0; display: none;" href="javascript:;" hidefocus="true" class="mt-slider-previous sp-slide--previous"></a> <a style="opacity: 0; display: none;" href="javascript:;" hidefocus="true" class="mt-slider-next sp-slide--next"></a> </div>
										<div class="head ccf">
											<ul class="trigger-container ui-slider__triggers mt-slider-trigger-container cf">
												<pigcms:adver cat_key="index_near_shop" limit="3" var_name="adver_list">
													<li class="mt-slider-trigger <if condition='$i eq 1'>mt-slider-current-trigger</if>"></li>
												</pigcms:adver>
											</ul>
										</div>
										<ul class="content">
											<volist name="adver_list" id="$vo">
												<li class="cf" style="opacity:1;<if condition='$i neq 1'>display:none;</if>">
													<a href="{pigcms{$vo.url}" title="{pigcms{$vo.name}"><img src="{pigcms{$vo.pic}" /></a>
												</li>
											</volist>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="nearby_list">
					<ul>
						<volist name="near_shop_list" id="vo">
						<li <if condition="$i gt 4">style="border-top:0px;"</if>>
							<div class="box">
								<div class="nearby_list_img">
									<a href="{pigcms{$vo.url}" target="_blank">
										<img class="meal_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$vo.image}" title="【{pigcms{$vo.area_name}】{pigcms{$vo.name}"/>
										<div class="bmbox">
											<div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
											<div class="bmbox_list">
												<div class="bmbox_list_img"><img class="qrcode_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']))}" /></div>
												<div class="bmbox_list_li">
													<ul>
														<li>活动</li>
														<li>店铺</li>
														<li>优惠券</li>
														<li>活动</li>
													</ul>
												</div>
											</div>
											<div class="bmbox_tip">微信扫码 手机查看</div>
										</div>
									</a>
									<div  class="name">【{pigcms{$vo.area_name}】{pigcms{$vo.name}</div>
									<div class="info">
										<div class="join">已有<span>50</span>人参加</div>
									</div>
									<a href="{pigcms{$vo.url}" target="_blank">
										<button class="info_but">立即进店</button>
									</a>
								</div>
							</div>
						</li>
						</volist>
					</ul>
				</div>
			</article>
			<article class="nearby">
				<div class="menu">
				  <div class="main_list">
			<div class="mainbav_left">
					  <div class="mainbav_icon"><img src="{pigcms{$static_path}images/o2o1_42.png" /></div>
					  <div class="mainbav_txt">热门商圈</div>
					</div>
			<div class="mainbav_list"><span><a href="###">万达广场 </a></span><span><a href="###">天鹅湖万达广场 </a></span><span><a href="###">白水坝 </a></span><span><a href="###">国购广场 </a></span><span><a href="###">宁国路 </a></span><span><a href="###">皖河支路美食街 </a></span><span><a href="###">天鹅湖银泰城 </a></span><span><a href="###">三里庵</a></span> </div>
			<div  style="clear:both"></div>
		  </div>
				</div>
    <div  style="clear:both"></div>
    <div class="nearby_left">
              <div class="nearby_left_top2">
        <div class="nearby_left_top_img"><img src="images/o2o5-24_132.png" /></div>
        <div class="nearby_left_top_txt">附近活动</div>
      </div>
              <div class="nearby_left_bottom">
        <div class="nearby_left_titile" style="display:none"> 全球甜蜜之旅 </div>
        <div class="nearby_left_txt" style="display:none"> 全场包邮低至9.9元 </div>
        <div class="nearby_left_img">                  
        <!-- -->
 
                  <div class="content__cell content__cell--slider" style=" width:252px;">
            <div class="component-index-slider">
                      <div class="index-slider ui-slider log-mod-viewed">
                <div class="pre-next"> <a style="opacity: 0; display: none;" href="javascript:;" hidefocus="true" class="mt-slider-previous sp-slide--previous"></a> <a style="opacity: 0; display: none;" href="javascript:;" hidefocus="true" class="mt-slider-next sp-slide--next"></a> </div>
                <div class="head ccf">
                          <ul class="trigger-container ui-slider__triggers mt-slider-trigger-container">
                    <li class="mt-slider-trigger" ></li>
                    <li class="mt-slider-trigger" ></li>
                    <li class="mt-slider-trigger mt-slider-current-trigger" ></li>
                    <li class="mt-slider-trigger" ></li>
                    <li class="mt-slider-trigger" ></li>
                    <li class="mt-slider-trigger" ></li>
                    <div  style="clear:both"></div>
                  </ul>
                        </div>
                <ul class="content">
                          <li class="cf" style="opacity: 1; display: none;"> <img src="images/2.jpg" /> </li>
                          <li class="cf" style="opacity: 1; display: none;"> <img   src="images/o2o5-24_120.png" /> </li>
                          <li class="cf" style="display: block; opacity: 1;"> <img   src="images/o2o5-24_1_135.png" /> </li>
                          <li class="cf" style="display: none; opacity: 1;"> <img   src="images/o2o5-24_120.png" /> </li>
                          <li class="cf" style="opacity: 1; display: none;"> <img   src="images/o2o5-24_1_135.png" /> </li>
                          <li class="cf" style="opacity: 1; display: none;"> <img src="images/3.jpg" /></li>
                        </ul>
              </div>
                    </div>
          </div>
                  
                  <!-- -->  </div>
 
      </div>
            </div>
    <div class="nearby_list">
              <ul>
        <li>
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_106.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">新学院帆布双肩包</div>
            <div class="join">已有<span>50</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <li>
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_108.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">红米Note后盖背贴 </div>
            <div class="join">已有<span>10</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <li>
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_110.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">新学院帆布双肩包</div>
            <div class="join">已有<span>50</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <li>
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_112.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">新学院帆布双肩包</div>
            <div class="join">已有<span>50</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <div  style="clear:both"></div>
        <li style="border-top:0">
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_106.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">新学院帆布双肩包</div>
            <div class="join">已有<span>50</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <li style="border-top:0">
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_108.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">红米Note后盖背贴 </div>
            <div class="join">已有<span>10</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <li style="border-top:0">
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_110.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">新学院帆布双肩包</div>
            <div class="join">已有<span>50</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                </li>
        <li style="border-top:0">
                  <div class="nearby_list_img">
                  <img src="images/o2o11_4_112.png" />
                  <div class="bmbox">
            <div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
            <div class="bmbox_list">
                      <div class="bmbox_list_img"><img src="images/o2o11_1_115.png" /></div>
                      <div class="bmbox_list_li">
                <ul>
                          <li>活动</li>
                          <li>会员卡</li>
                          <li>优惠券</li>
                          <li>活动</li>
                        </ul>
              </div>
                    </div>
          </div>
                  <div class="info">
            <div  class="name">新学院帆布双肩包</div>
            <div class="join">已有<span>50</span>人参加</div>
          </div>
                  <button class="info_but">立即购买</button>
                  <div  
        </li>
      </ul>
            </div>
    <div  style="clear:both"></div>
  </article>
          <div  class="socll" style="  width:100%;   z-index:99">
<php>$autoI=0;</php>
<volist name="index_group_list" id="vo">
	<if condition="!empty($vo['group_list'])">
		<article class="category" id="f{pigcms{$i}"  class="sa" >
			<div class="category_top cf">
				<div class="category_top_left">
					<ul>
						<li id="category_main_{pigcms{$autoI%7+1}">			
							<div class="category_main_icon"><if condition="$vo['cat_pic']"><img src="{pigcms{$vo.cat_pic}" style="width:22px;"/></if></div>
							<div class="category_main_txt">{pigcms{$vo.cat_name}</div>
						</li>
						<if condition="count($vo['category_list']) gt 1">
							<volist name="vo['category_list']" id="voo" offset="0" length="6" key="j">
								<li><a target="_blank" href="{pigcms{$voo.url}" class="link">{pigcms{$voo.cat_name}</a></li>
							</volist>
						</if>
					</ul>
				</div>
				<a target="_blank" href="{pigcms{$vo.url}" class="link"><div class="category_top_right">全部</div></a>
			</div>
			<div class="category_list">
				<ul class="cf">
					<volist name="vo['group_list']" id="voo" offset="0" length="8" key="k">
						<li <if condition='$k%4 eq 0'>class="last--even"</if>>
							<div class="category_list_img">
								<a href="{pigcms{$voo.url}" target="_blank">
									<img alt="{pigcms{$voo.s_name}" class="deal_img lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$voo.list_pic}"/>
									<div class="bmbox">
										<div class="bmbox_title"> 该商家有<span>465</span>个粉丝</div>
										<div class="bmbox_list">
											<div class="bmbox_list_img"><img class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']))}" /></div>
											<div class="bmbox_list_li">
												<ul class="cf">
													<li>活动</li>
													<li>店铺</li>
													<li>优惠券</li>
													<li>活动</li>
												</ul>
											</div>
										</div>
										<div class="bmbox_tip">微信扫码 手机查看</div>
									</div>
								</a>
								<div class="datal" style="padding:5px 10px 5px;">
									<a href="{pigcms{$voo.url}" target="_blank">
										<div class="category_list_title">【{pigcms{$voo.prefix_title}】{pigcms{$voo.merchant_name}</div>
										<div class="category_list_description">{pigcms{$voo.group_name}</div>
									</a>
									<div class="cf cheap_div">
									<if condition="$voo['wx_cheap']">
										<div class="cheap">微信购买立减￥{pigcms{$voo.wx_cheap}</div>
									</if>
									</div>
									<div class="deal-tile__detail cf">
										<span class="price">&yen;<strong>{pigcms{$voo.price}</strong> </span>
										<span>门店价 &yen;{pigcms{$voo.old_price}</span>	
									</div>
									<div class="extra-inner">
										<div class="sales">已售<strong class="num">{pigcms{$voo['sale_count']+$voo['virtual_num']}</strong></div >
										<div class="noreviews">
											<if condition="$voo['reply_count']">
												<a href="{pigcms{$voo.url}#anchor-reviews" target="_blank">
													<div class="icon"><span style="width:{pigcms{$voo['score_mean']/5*100}%;" class="rate-stars"></span></div>
													<span>{pigcms{$voo.reply_count}次评价</span>
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
			</div>
		</article>
		<php>$autoI++;</php>
	</if>
</volist>
  </div>
        </div>
<div class="extension_bottom"  style="position: absolute; bottom: 1400px;    right: 10px;  margin-left: -80px;  margin-top: 23px;">
          <div class="extension" >
    <div class="side_extension">最近浏览</div>
    <div class="extension_history " >清空</div>
    <div  style="clear:both"></div>
    <div class="side_extension_no">暂无浏览记录</div>
  </div>
          <a href="javascript:scroll(0,0)">
          <div class="go_top"><img src="{pigcms{$static_path}images/o2o5-24_68.png" width="42px;" />
    <div class="go_top_txt">返回<br />
              顶部</div>
  </div>
        </div>
</a>
<include file="Public:footer"/>
</body>
</html>
