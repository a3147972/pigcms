<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title><?php echo ($config["seo_title"]); ?></title>
		<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/ydyfx.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/index-slider.css"/>
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
		<script src="<?php echo ($static_path); ?>js/jquery.nav.js"></script>
		<script src="<?php echo ($static_path); ?>js/navfix.js"></script>	
		<script src="<?php echo ($static_path); ?>js/common.js"></script>
		<script src="<?php echo ($static_path); ?>js/index.js"></script>	
		<script src="<?php echo ($static_path); ?>js/index.slider.js"></script>	
		<?php if($config['wap_redirect']): ?><script>
				if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
					<?php if($config['wap_redirect'] == 1): ?>window.location.href = './wap.php';
					<?php else: ?>
						if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
							window.location.href = './wap.php';
						}<?php endif; ?>
				}
			</script><?php endif; ?>
		<!--[if IE 6]>
		<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
			body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc");}
			.category_list li:hover .bmbox {filter:alpha(opacity=50);}
			.gd_box{display:none;}
		</style>
		<![endif]-->
	</head>
	<body>
		<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
				</p><?php endif; ?>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
			</div>
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="<?php echo U('User/Index/index');?>">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="<?php echo U('User/Index/index');?>">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf">
	<?php $one_adver = D("Adver")->get_one_adver("index_top"); if(is_array($one_adver)): ?><div class="content">
			<div class="banner" style="background:<?php echo ($one_adver["bg_color"]); ?>">
				<div class="hot"><a href="<?php echo ($one_adver["url"]); ?>" title="<?php echo ($one_adver["name"]); ?>"><img src="<?php echo ($one_adver["pic"]); ?>" /></a></div>
			</div>
		</div><?php endif; ?>
    <div class="nav cf">
		<div class="logo">
			<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
				<img  src="<?php echo ($config["site_logo"]); ?>" />
			</a>
		</div>
		<div class="search">
			<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
				<div class="form_sec">
					<div class="form_sec_txt group"><?php echo ($config["group_alias_name"]); ?></div>
					<div class="form_sec_txt1 meal"><?php echo ($config["meal_alias_name"]); ?></div>
				</div>
				<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
</header>
		<div class="body"> 
			<div class="gd_box" style="top:1540px;margin-left:-80px;">
				<div id="gd_box">
					<div id="gd_box1">
						<div id="nav" style="background-color:#947D7B;">
							<ul>
								<?php $autoI = 0; ?>
								<?php if(is_array($index_group_list)): $i = 0; $__LIST__ = $index_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo['group_list'])): ?><li <?php if($i == 1): ?>class="current"<?php endif; ?>>
											<a class="f<?php echo ($i); ?>" onClick="scrollToId('#f<?php echo ($i); ?>');"><img src="<?php echo ($vo["cat_pic"]); ?>" />
												<div class="scroll_<?php echo ($autoI%7+1); ?>"><?php echo ($vo["cat_name"]); ?></div>
											</a>
										</li>
										<?php $autoI++; endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<article>
				<div class="menu cf">
					<div class="menu_left">
						<div class="menu_left_top"><img src="<?php echo ($static_path); ?>images/o2o1_27.png" /></div>
						<div class="list">
							<ul>
								<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
										<div class="li_top cf">
											<?php if($vo['cat_pic']): ?><div class="icon"><img src="<?php echo ($vo["cat_pic"]); ?>" /></div><?php endif; ?>
											<div class="li_txt"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></div>
										</div>
										<?php if($vo['cat_count'] > 1): ?><div class="li_bottom">
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><span><a href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
											</div>
											<div class="list_txt">
												<p><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></p>
												<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a class="<?php if($voo['is_hot']): ?>bribe<?php endif; ?>" href="<?php echo ($voo["url"]); ?>" target="_blank"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</div><?php endif; ?>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					<div class="menu_right cf">
						<div class="menu_right_top">
							<ul>
								<?php $web_index_slider = D("Slider")->get_slider_by_key("web_slider","10");if(is_array($web_index_slider)): $i = 0;if(count($web_index_slider)==0) : echo "列表为空" ;else: foreach($web_index_slider as $key=>$vo): ++$i;?><li class="ctur">
										<a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
									</li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
							</ul>
						</div>
						<div class="menu_right_bottom cf">
							<div class="mainbav">
								<div class="main_list cf">
									<div class="mainbav_left">
										<div class="mainbav_icon"><img src="<?php echo ($static_path); ?>images/o2o1_35.png" /></div>
										<div class="mainbav_txt">热门<?php echo ($config["group_alias_name"]); ?></div>
									</div>
									<div class="mainbav_list">
										<?php if(is_array($hot_group_category)): $i = 0; $__LIST__ = $hot_group_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
								<div class="main_list cf">
									<div class="mainbav_left">
										<div class="mainbav_icon"><img src="<?php echo ($static_path); ?>images/o2o1_38.png" /></div>
										<div class="mainbav_txt">全部区域</div>
									</div>
									<div class="mainbav_list">
										<?php if(is_array($all_area_list)): $i = 0; $__LIST__ = $all_area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
								<div class="main_list cf">
									<div class="mainbav_left">
										<div class="mainbav_icon"><img src="<?php echo ($static_path); ?>images/o2o1_42.png" /></div>
										<div class="mainbav_txt">热门商圈</div>
									</div>
									<div class="mainbav_list">
										<?php if(is_array($hot_circle_list)): $i = 0; $__LIST__ = $hot_circle_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							</div>
							<div class="scroll cf">
								<div class="scroll_left <?php if($now_activity): ?>activityDiv<?php endif; ?>">
									<div class="scroll_top">
										<div class="scroll_top_left">
											<div class="scroll_top_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_47.png" /></div>
											<div class="scroll_top_txt">今日特惠</div>
										</div>
										<?php if($now_activity): ?><div class="scroll_top_right"> 
												<div class="scroll_top_txt">距离结束：</div>
												<div id="divdown1">
													<div class="scroll_top_right_img_shi" id="time_j"><?php echo ($time_array['j']); ?></div>
													<div class="scroll_top_txt">天</div>
													<div class="scroll_top_right_img" id="time_h"><?php echo ($time_array['h']); ?></div>
													<div class="scroll_top_txt">时</div>
													<div class="scroll_top_right_img" id="time_m"><?php echo ($time_array['m']); ?></div>
													<div class="scroll_top_txt">分</div>
													<div class="scroll_top_right_img" id="time_s"><?php echo ($time_array['s']); ?></div>
													<div class="scroll_top_txt">秒</div>
													<div class="scroll_top_right_img" id="time_mm" style="color:red;">00</div>
												</div>
											</div>
											<script>
												function format_time(time){
													if(time < 10){
														time = '0'+time;
													}
													return time;
												}
												$(function(){				
													var timeJDom = $('#time_j');
													var timeHDom = $('#time_h');
													var timeMDom = $('#time_m');
													var timeSDom = $('#time_s');
													var timeMMDom = $('#time_mm');
													var timer = setInterval(function(){
														var timeJ = parseInt(timeJDom.html());
														var timeH = parseInt(timeHDom.html());
														var timeM = parseInt(timeMDom.html());
														var timeS = parseInt(timeSDom.html());
														var timeMM = parseInt(timeMMDom.html());
														
														if(timeMM == 0){
															if(timeS == 0){
																if(timeM == 0){
																	if(timeH == 0){
																		if(timeJ == 0){
																			clearInterval(timer);
																			window.location.reload();
																		}else{
																			timeJDom.html(format_time(timeJ-1));
																		}
																		timeHDom.html('23');
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
											</script><?php endif; ?>
									</div>
									<div id="scroll_box">
										<span class="scroll_up">up</span>
										<span class="scroll_down">down</span>
										<div class="div">
											<ul class="scroll_list">
												<?php if($now_activity): if(is_array($activity_list)): $i = 0; $__LIST__ = $activity_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="activity_li">
															<div class="scroll_article_left_top">
																<?php if($i%2 == 1): ?><div class="scroll_article_left_top_banner"><a href="<?php echo ($vo["url"]); ?>" target="_blank"><img src="<?php echo ($vo["index_pic"]); ?>" alt="<?php echo ($vo["name"]); ?>"/></a></div><?php endif; ?>
																<div class="scroll_article_article">
																	<div class="scroll_article_article_title"><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a></div>
																	<div class="scroll_article_article_txt"><?php echo ($vo["title"]); ?></div>
																	<div class="scroll_article_article_bottom">已参与人数<span><?php echo ($vo["part_count"]); ?></span>人</div>
																</div>
																<?php if($i%2 == 0): ?><div class="scroll_article_left_top_banner"><a href="<?php echo ($vo["url"]); ?>" target="_blank"><img src="<?php echo ($vo["index_pic"]); ?>" alt="<?php echo ($vo["name"]); ?>"/></a></div><?php endif; ?>
															</div>
														</li><?php endforeach; endif; else: echo "" ;endif; ?>
												<?php else: ?>	
													<?php $index_today_fav = D("Adver")->get_adver_by_key("index_today_fav","6");if(is_array($index_today_fav)): $i = 0;if(count($index_today_fav)==0) : echo "列表为空" ;else: foreach($index_today_fav as $key=>$vo): ++$i;?><li>
															<div class="scroll_article_left_top">
																<a href="<?php echo ($vo["url"]); ?>" target="_blank">
																	<img src="<?php echo ($vo["pic"]); ?>" style="width:100%;height:100%;"/>
																</a>
															</div>
														</li><?php endforeach; endif; else: echo "列表为空" ;endif; endif; ?>
											</ul>
										</div>
									</div>
								</div>
								<?php if($now_activity): ?><div class="scroll_right cf">
										<div class="scroll_right_top">
											<a href="<?php echo ($activity_url); ?>" target="_blank">
												<div class="scroll_right_top_img"><img src="<?php echo ($static_path); ?>images/o2o11_57.png"/></div>
												<div class="scroll_right_top_txt">更多活动</div>
											</a>
										</div>
										<div class="scroll_right_bottom cf">
											<div class="scroll_right_bottom_title">
												<div class="scroll_right_bottom_title_img"><img src="<?php echo ($static_path); ?>images/o2o11_74.png"/></div>
												<div class="scroll_right_bottom_title_txt">本站信息</div>
											</div>
											<ul>
												<li>
													<div class="li_img"><img src="<?php echo ($static_path); ?>images/o2o11_84.png"/></div>
													<div class="li_txt">今日新增粉丝 <span><?php echo ($index_site_info["user_count"]); ?></span></div>
												</li>
												<li>
													<div class="li_img"><img src="<?php echo ($static_path); ?>images/o2o11_94.png"/></div>
													<div class="li_txt">今日新增商家 <span><?php echo ($index_site_info["merchant_count"]); ?></span></div>
												</li>
												<li>
													<div class="li_img"><img src="<?php echo ($static_path); ?>images/o2o11_87.png"/></div>
													<div class="li_txt">今日新增店铺 <span><?php echo ($index_site_info["merchant_store_count"]); ?></span></div>
												</li>
												<li>
													<div class="li_img"><img src="<?php echo ($static_path); ?>images/o2o11_80.png"/></div>
													<div class="li_txt">今日新增<?php echo ($config["group_alias_name"]); ?> <span><?php echo ($index_site_info["group_count"]); ?></span></div>
												</li>
												<li>
													<div class="li_img"><img src="<?php echo ($static_path); ?>images/o2o11_91.png"/></div>
													<div class="li_txt">今日新增<?php echo ($config["meal_alias_name"]); ?> <span><?php echo ($index_site_info["meal_store_count"]); ?></span></div>
												</li>
											</ul>
										</div>
									</div><?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</article>
			<?php $is_near_shop = false;$near_shop_list = D("Merchant_store")->get_hot_list("8");?>
			<article class="nearby cf">
				<div class="nearby_left">
					<div class="nearby_left_top">
						<div class="nearby_left_top_img"><img src="<?php echo ($static_path); ?>images/o2o11_98.png" /></div>
						<div class="nearby_left_top_txt"><?php if($is_near_shop): ?>附近<?php echo ($config["meal_alias_name"]); else: ?>推荐<?php echo ($config["meal_alias_name"]); endif; ?></div>
					</div>
					<div class="nearby_left_bottom">
						<div class="nearby_left_img"> 
							<div class="content__cell content__cell--slider" style="width:252px;">
								<div class="component-index-slider">
									<div class="index-slider ui-slider log-mod-viewed">
										<div class="pre-next">
											<a style="opacity:0;display:none;" href="javascript:;" hidefocus="true" class="mt-slider-previous sp-slide--previous"></a>
											<a style="opacity:0;display:none;" href="javascript:;" hidefocus="true" class="mt-slider-next sp-slide--next"></a>
										</div>
										<div class="head ccf">
											<ul class="trigger-container ui-slider__triggers mt-slider-trigger-container cf">
												<?php $near_shop_adver_list = D("Adver")->get_adver_by_key("index_near_shop","3");if(is_array($near_shop_adver_list)): $i = 0;if(count($near_shop_adver_list)==0) : echo "列表为空" ;else: foreach($near_shop_adver_list as $key=>$vo): ++$i;?><li class="mt-slider-trigger <?php if($i == 1): ?>mt-slider-current-trigger<?php endif; ?>"></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
											</ul>
										</div>
										<ul class="content">
											<?php if(is_array($near_shop_adver_list)): $i = 0; $__LIST__ = $near_shop_adver_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="cf" style="opacity:1;<?php if($i != 1): ?>display:none;<?php endif; ?>">
													<a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["name"]); ?>" target="_blank"><img src="<?php echo ($vo["pic"]); ?>" /></a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="nearby_list">
					<ul>
						<?php if(is_array($near_shop_list)): $i = 0; $__LIST__ = $near_shop_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i > 4): ?>style="border-top:0px;"<?php endif; ?>>
								<div class="box">
									<div class="nearby_list_img">
										<a href="<?php echo ($vo["url"]); ?>" target="_blank">
											<img class="meal_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo ($vo["image"]); ?>" title="【<?php echo ($vo["area_name"]); ?>】<?php echo ($vo["name"]); ?>"/>
											<div class="bmbox">
												<div class="bmbox_title"> 该商家有<span> <?php echo ($vo["fans_count"]); ?> </span>个粉丝</div>
												<div class="bmbox_list">
													<div class="bmbox_list_img"><img class="qrcode_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']));?>" /></div>
													<div class="bmbox_list_li">
														<ul>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($vo["mer_id"]); ?>.html">商家</li>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["group_alias_name"]); ?></li>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li>
															<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mermap/<?php echo ($vo["mer_id"]); ?>.html">地图</li>
														</ul>
													</div>
												</div>
												<div class="bmbox_tip">微信扫码 手机查看</div>
											</div>
										</a>
										<div  class="name">【<?php echo ($vo["area_name"]); ?>】<?php echo ($vo["name"]); ?></div>
										<div class="info">
											<div class="join">已售 <span><?php echo ($vo["sale_count"]); ?></span></div>
										</div>
										<a href="<?php echo ($vo["url"]); ?>" target="_blank">
											<button class="info_but">立即进店</button>
										</a>
									</div>
								</div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<!--if condition="empty($is_near_shop)">
					<section class="nearby_box">
						<div class="nearby_box_txt"><img src="<?php echo ($static_path); ?>images/tankuang_10.png"/></div>
						<button class="nearby_box_but"><span>选取</span></button> 
						<div class="nearby_box_close"></div>
					</section>
				</if-->
			</article>
			<div class="socll" style="width:100%;z-index:99">
				<?php $autoI=0; ?>
				<?php if(is_array($index_group_list)): $i = 0; $__LIST__ = $index_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(!empty($vo['group_list'])): ?><div class="category cf sa" id="f<?php echo ($i); ?>">
							<div class="category_top cf">
								<div class="category_top_left">
									<ul>
										<li id="category_main_<?php echo ($autoI%7+1); ?>">			
											<div class="category_main_icon"><?php if($vo['cat_pic']): ?><img src="<?php echo ($vo["cat_pic"]); ?>" style="width:22px;"/><?php endif; ?></div>
											<div class="category_main_txt"><?php echo ($vo["cat_name"]); ?></div>
										</li>
										<?php if(count($vo['category_list']) > 1): if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,6,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><li><a target="_blank" href="<?php echo ($voo["url"]); ?>" class="link"><?php echo ($voo["cat_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
									</ul>
								</div>
								<a target="_blank" href="<?php echo ($vo["url"]); ?>" class="link"><div class="category_top_right">全部</div></a>
							</div>
							<div class="category_list cf">
								<ul class="cf">
									<?php if(is_array($vo['group_list'])): $k = 0; $__LIST__ = array_slice($vo['group_list'],0,8,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($k % 2 );++$k;?><li <?php if($k%4 == 0): ?>class="last--even"<?php endif; ?>>
											<div class="category_list_img">
												<a href="<?php echo ($voo["url"]); ?>" target="_blank">
													<img alt="<?php echo ($voo["s_name"]); ?>" class="deal_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo ($voo["list_pic"]); ?>"/>
													<div class="bmbox">
														<div class="bmbox_title"> 该商家有<span> <?php echo ($voo["fans_count"]); ?> </span>个粉丝</div>
														<div class="bmbox_list">
															<div class="bmbox_list_img"><img class="lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$voo['group_id']));?>" /></div>
															<div class="bmbox_list_li">
																<ul class="cf">
																	<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($voo["mer_id"]); ?>.html">商家</li>
																	<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($voo["mer_id"]); ?>.html"><?php echo ($config["group_alias_name"]); ?></li>
																	<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($voo["mer_id"]); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li>
																	<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mermap/<?php echo ($voo["mer_id"]); ?>.html">地图</li>
																</ul>
															</div>
														</div>
														<div class="bmbox_tip">微信扫码 更多优惠</div>
													</div>
												</a>
												<div class="datal" style="padding:5px 10px 5px;">
													<a href="<?php echo ($voo["url"]); ?>" target="_blank">
														<div class="category_list_title">【<?php echo ($voo["prefix_title"]); ?>】<?php echo ($voo["merchant_name"]); ?></div>
														<div class="category_list_description"><?php echo ($voo["group_name"]); ?></div>
													</a>
													<div class="deal-tile__detail cf">
														<span class="price">&yen;<strong><?php echo ($voo["price"]); ?></strong> </span>
														<span>门店价 &yen;<?php echo ($voo["old_price"]); ?></span>
														<?php if($voo['wx_cheap']): ?><div class="cheap">微信购买立减￥<?php echo ($voo["wx_cheap"]); ?></div><?php endif; ?>														
													</div>
													<div class="extra-inner">
														<div class="sales">已售<strong class="num"><?php echo ($voo['sale_count']+$voo['virtual_num']); ?></strong></div >
														<div class="noreviews">
															<?php if($voo['reply_count']): ?><a href="<?php echo ($voo["url"]); ?>#anchor-reviews" target="_blank">
																	<div class="icon"><span style="width:<?php echo ($voo['score_mean']/5*100); ?>%;" class="rate-stars"></span></div>
																	<span><?php echo ($voo["reply_count"]); ?>次评价</span>
																</a>
															<?php else: ?>
																<span>暂无评价</span><?php endif; ?>
														</div >
													</div>
												</div>
											</div>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
						</div>
						<?php $autoI++; endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
        </div>
	<!--友情链接-->
	<?php if(!empty($flink_list)): ?><style type="text/css">.component-holy-reco {clear: both; margin: 0 auto;width: 1210px; position: relative;bottom: -98px;}.holy-reco{width:100%;margin:0 auto;padding-bottom:20px;_display:none}.holy-reco .tab-item {
    color: #666;}.holy-reco__content{border:1px solid #E8E8E8;padding:10px;background:#FFF}.holy-reco__content a{display:inline-block;color:#666;font-size:12px;padding:0 5px;line-height:16px;white-space:nowrap;width:85px;overflow:hidden;text-overflow:ellipsis}.nav-tabs--small .current {background: #ededed none repeat scroll 0 0;width:80px;text-align:center;padding:0 6px;float:left;cursor:pointer;}</style>
	<div class="component-holy-reco">
		<div class="J-holy-reco holy-reco">
			<div>
				<ul class="ccf cf nav-tabs--small">
					<li class="J-holy-reco__label current"><a href="javascript:void(0)" class="tab-item">友情链接</a></li>
				</ul>
			</div>
			<div class="J-holy-reco__content holy-reco__content">
				<?php if(is_array($flink_list)): $i = 0; $__LIST__ = $flink_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["info"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</div><?php endif; ?>
	<!--友情链接--end-->
		<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead">
		<ul>
			<li>
				<a href="javascript:void(0)" class="wechat">
					<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
					<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
					<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
				</a>
			</li>
			<?php if($config['site_qq']): ?><li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
						<div class="hides qq_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
							<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<?php if($config['site_phone']): ?><li>
					<a href="javascript:void(0)" class="tel">
						<div class="hides tel_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
							<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<li>
				<a class="top_btn">
					<div class="hides btn_div">
						<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
					</div>
					<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div><?php endif; ?>
<!--leftsead end-->
	</body>
</html>