<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($config["meal_alias_name"]); ?>列表_<?php echo ($now_area["area_name"]); ?>_<?php echo ($now_circle["area_name"]); ?>_<?php echo ($config["seo_title"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/css.css" type="text/css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/header.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($static_path); ?>css/order.css" type="text/css" rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/meal_list.css" type="text/css" rel="stylesheet" />
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_path); ?>js/jquery.nav.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	</script>
<script src="<?php echo ($static_path); ?>js/common.js"></script>
<script src="<?php echo ($static_path); ?>js/list.js"></script>
<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
<!--[if IE 6]>
	<script src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
<![endif]-->
<!--[if lt IE 9]>
	<script src="<?php echo ($static_path); ?>js/html5shiv.min-min.v01cbd8f0.js"></script>
<![endif]-->

<!--[if IE 6]>
<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
	body{ behavior:url("csshover.htc");}
	.category_list li:hover .bmbox {filter:alpha(opacity=50);}
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
			<form action="<?php echo U('Meal/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
				<div class="form_sec">
					<div class="form_sec_txt meal"><?php echo ($config["meal_alias_name"]); ?></div>
					<div class="form_sec_txt1 group"><?php echo ($config["group_alias_name"]); ?></div>
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
<div class="order_color">
	<a href="<?php echo ($config["site_url"]); ?>/merchant.php"><img src="<?php echo ($static_path); ?>images/dingcan_03.png" /></a>
</div>

<div class="header_list body">
	<div class="menu cf">
		<div class="menu_left hide">
			<div class="menu_left_top">
				<div class="menu_left_top_icon">
					<img src="<?php echo ($static_path); ?>images/o2o5-24_31.png" />
				</div>  
				<div class="menu_left_top_txt">全部分类</div>
			</div>
			<div class="list">
				<ul>
					<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
							<div class="li_top cf">
								<?php if($vo['cat_pic']): ?><div class="icon"><img src="<?php echo ($vo["cat_pic"]); ?>" /></div><?php endif; ?>
								<div class="li_txt"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></div>
							</div>
							<?php if($vo['cat_count'] > 1): ?><div class="li_bottom">
									<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><span><a href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
								<div class="list_txt">
									<p><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></p>
									<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><a class="<?php if($voo['is_hot']): ?>bribe<?php endif; ?>" href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
								</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div class="menu_right">
			<div class="menu_right_top">
				<ul>
				<?php if(is_array($web_index_slider)): $i = 0; $__LIST__ = $web_index_slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ctur">
						<a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="banner_middle">
	<div class="banner_img"><img src="<?php echo ($static_path); ?>images/dingcan_05.png" /></div>
</div>

<div class="menu_table">
	<menu class="order_menu">
		<ul>
			<li class="curn">
				<div class="order_menu_num">1</div>
				<div class="order_menu_txt">查找身边便利店、餐厅</div>
			</li>
			<li>
				<div class="order_menu_num">2</div>
				<div class="order_menu_txt">网上或手机下单，商家快速配送</div>
			</li>
			<li>
				<div class="order_menu_num">3</div>
				<div class="order_menu_txt">最快20分钟送达，货到付款！</div>
			</li>
			<div style="clear:both"></div>
		</ul>
	</menu>
	<div class="bdw" id="bdw">
		<div class="cf" id="bd">
			<?php if($category_top_adver): ?><div class="J-hub ui-slider common-banner common-banner--index log-mod-viewed J-banner-stamp-active">
					<ul class="common-banner__sheets mt-slider-sheet-container">
						<?php if(is_array($category_top_adver)): $i = 0; $__LIST__ = $category_top_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="common-banner__sheet cf mt-slider-sheet mt-slider-current-sheet" style="<?php if($i == 1): ?>opacity:1;<?php else: ?>opacity:0;display:none;<?php endif; ?>">
								<a class="common-banner__link" target="_blank" href="<?php echo ($vo["url"]); ?>">
									<img onload="delayImg(this);" src="<?php echo ($static_public); ?>images/empty.png" data-original="<?php echo ($vo["pic"]); ?>" width="978" height="88" alt="<?php echo ($vo["name"]); ?>"/>
								</a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<a href="javascript:void(0)" class="common-close common-close--small close" title="关闭">关闭</a>
					<?php if(count($category_top_adver) > 1): ?><ul class="trigger ui-slider__triggers ui-slider__triggers--translucent ui-slider__triggers--small mt-slider-trigger-container">
							<?php if(is_array($category_top_adver)): $i = 0; $__LIST__ = $category_top_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="trigger-item mt-slider-trigger <?php if($i == 1): ?>mt-slider-current-trigger<?php endif; ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul><?php endif; ?>
				</div><?php endif; ?>
		</div>
			
		<article class="menu_table">
			<?php if($cat_option_html || $top_category): ?><div class="filter-section-wrapper">
					<?php if($top_category || $area_list): ?><div class="filter-breadcrumb ">
							<span class="breadcrumb__item">
								<a class="filter-tag filter-tag--all" href="<?php echo ($default_url); ?>">全部</a>
							</span>
							<?php if($top_category){ ?>
							<span class="breadcrumb__crumb"></span>
							<span class="breadcrumb__item">
								<span class="breadcrumb_item__title filter-tag"><?php echo ($top_category["cat_name"]); ?><i class="tri"></i></span><a href="<?php echo ($default_url); ?>" class="breadcrumb-item--delete"><i></i></a>
								<span class="breadcrumb_item__option">
									<span class="option-list--wrap inline-block">
										<span class="option-list--inner inline-block">
											<a href="<?php echo ($default_url); ?>" class="log-mod-viewed">全部</a>
											<?php if(is_array($all_category_list)): $i = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['cat_id'] == $top_category['cat_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
										</span>
									</span>
								</span>
							</span>
							<?php } ?>
							<?php if($now_category['cat_id'] != $top_category['cat_id'] && false){ ?>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag"><?php echo ($now_category["cat_name"]); ?><i class="tri"></i></span><a href="<?php echo ($top_category["url"]); ?>" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="<?php echo ($top_category["url"]); ?>" class="log-mod-viewed">全部</a>
												<?php if(is_array($son_category_list)): $i = 0; $__LIST__ = $son_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['cat_id'] == $now_category['cat_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</span>
										</span>
									</span>
								</span>
							<?php } ?>
							<?php if($now_area && $area_list){ ?>
								<span class="breadcrumb__crumb"></span>
								<span class="breadcrumb__item">
									<span class="breadcrumb_item__title filter-tag"><?php echo ($now_area["area_name"]); ?><i class="tri"></i></span><a href="<?php if($now_category['url']){echo $now_category['url'];}else if($top_category['url']){echo $top_category['url'];}else{echo $default_url;}?>" class="breadcrumb-item--delete"><i></i></a>
									<span class="breadcrumb_item__option">
										<span class="option-list--wrap inline-block">
											<span class="option-list--inner inline-block">
												<a href="<?php if($top_category['url']){echo $top_category['url'];}else{echo $default_url;}?>" class="log-mod-viewed">全部</a>
												<?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="<?php if($vo['area_id'] == $now_area['area_id']): ?>current<?php endif; ?> log-mod-viewed" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["area_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											</span>
										</span>
									</span>
								</span>
							<?php } ?>
						</div><?php endif; ?>
					<?php echo ($cat_option_html); ?>
				</div><?php endif; ?>
		</article>
		<div id="filter">
			<div class="filter-sortbar">
				<div class="button-strip inline-block">
					<a href="<?php echo ($default_sort_url); ?>" title="默认排序" class="button-strip-item inline-block button-strip-item-right <?php if($_GET['order'] == ''): ?>button-strip-item-checked<?php endif; ?>"><span class="inline-block button-outer-box"><span class="inline-block button-content">默认排序</span></span></a>
					<a href="<?php echo ($hot_sort_url); ?>" title="销量从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <?php if($_GET['order'] == 'hot'): ?>button-strip-item-checked<?php endif; ?>"><span class="inline-block button-outer-box"><span class="inline-block button-content">销量</span><span class="inline-block button-img"></span></span></a><?php if($_GET['order'] == 'price-asc'): ?><a href="<?php echo ($price_desc_sort_url); ?>" title="价格从低到高" class="button-strip-item inline-block button-strip-item-right button-strip-item-asc <?php if($_GET['order'] == 'price-asc'): ?>button-strip-item-checked<?php endif; ?>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a><?php else: ?><a href="<?php echo ($price_asc_sort_url); ?>" title="价格从高到低" class="button-strip-item inline-block button-strip-item-right <?php if($_GET['order'] == 'price-desc'): ?>button-strip-item-checked button-strip-item-desc-active<?php else: ?>button-strip-item-asc<?php endif; ?>"><span class="inline-block button-outer-box"><span class="inline-block button-content">价格</span><span class="inline-block button-img"></span></span></a><?php endif; ?><a href="<?php echo ($rating_sort_url); ?>" title="评分从高到低" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc <?php if($_GET['order'] == 'rating'): ?>button-strip-item-checked<?php endif; ?>"><span class="inline-block button-outer-box"><span class="inline-block button-content">好评</span><span class="inline-block button-img"></span></span></a><a href="<?php echo ($time_sort_url); ?>" title="发布时间从新到旧" class="button-strip-item inline-block button-strip-item-right button-strip-item-desc large-button  <?php if($_GET['order'] == 'time'): ?>button-strip-item-checked<?php endif; ?>"><span class="inline-block button-outer-box"><span class="inline-block button-content">发布时间</span><span class="inline-block button-img"></span></span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="f1" style="width:1210px;" class="cf">
	<div class="category_list">
		<ul>
			<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i%4 == 0): ?>class="last--even"<?php endif; ?>>
			<a href="<?php echo ($vo["url"]); ?>" target="_blank">
				<div class="category_list_img">
					<img src="<?php echo ($vo["image"]); ?>"/>
					<div class="shop_data">
						<div class="shop_state" <?php if($vo['state']): ?>id="shop_state"<?php endif; ?>><?php if($vo['state']): ?>营业中<?php else: ?>打烊了<?php endif; ?> </div>
						<div class="shop_time"><?php echo ($vo['work_time']); ?></div>
					</div>
					<div class="bmbox">
						<div class="bmbox_title"> 该商家有<span><?php echo ($vo['fans_count']); ?></span>个粉丝</div>
						<div class="bmbox_list">
							<div class="bmbox_list_img"><img  class="lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']));?>" /></div>
							<div class="bmbox_list_li">
								<ul>
									<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($vo["mer_id"]); ?>.html">商家</li>
									<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/meractivity/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["group_alias_name"]); ?></li>
									<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mergoods/<?php echo ($vo["mer_id"]); ?>.html"><?php echo ($config["meal_alias_name"]); ?></li>
									<li class="open_windows" data-url="<?php echo ($config["site_url"]); ?>/mermap/<?php echo ($vo["mer_id"]); ?>.html">地图</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="datal">
 					<div class="shop">
						<div class="category_list_title"><?php echo ($vo["name"]); ?> </div>
						<div class="shop_icon">
							<?php if($vo['zeng']): ?><span><img src="<?php echo ($static_path); ?>images/dingcan_20.png" title="<?php echo ($vo['zeng']); ?>"/></span><?php endif; ?>
							<?php if($vo['full_money'] != 0.00 AND $vo['minus_money'] != 0.00): ?><span><img src="<?php echo ($static_path); ?>images/dingcan_22.png" title="支持立减优惠，每单满<?php echo ($vo['full_money']); ?>元减<?php echo ($vo['minus_money']); ?>元"/></span><?php endif; ?>
							<?php if($vo['song']): ?><span><img src="<?php echo ($static_path); ?>images/dingcan_24.png" title="<?php echo ($vo['song']); ?>"/></span><?php endif; ?>
						</div>
						<div style="clear:both"></div>
					</div>
					<div class="deal-tile__detail">
						<div class="shop_add">
							<div class="shop_add_icon"><img src="<?php echo ($static_path); ?>images/dingcan_30.png" /> </div>
							<div class="shop_add_txt"><?php echo ($vo["adress"]); ?> </div>
						</div>
						<!--div id="cheap">品牌快餐</div-->
					</div>
				</div>
			</a>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div>
<?php echo ($pagebar); ?>
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
<div class="rightsead">
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
</div>
<!--leftsead end-->
</body>
</html>