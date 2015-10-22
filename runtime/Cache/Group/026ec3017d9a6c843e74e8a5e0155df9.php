<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title><?php echo ($config["site_name"]); echo ($keywords); echo ($config["group_alias_name"]); ?> | <?php echo ($config["site_name"]); ?></title>
		<meta name="keywords" content="<?php echo ($now_category["cat_name"]); ?>,<?php echo ($config["seo_keywords"]); ?>" />
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
		<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/list.css"/>	
		<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
			<script type="text/javascript">
				var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
			</script>
		<script src="<?php echo ($static_path); ?>js/common.js"></script>
		<script src="<?php echo ($static_path); ?>js/list.js"></script>
		<style>
		.category_list{
			float:none;
			width:auto;
		}
		#filter {
			margin-bottom: 10px;
		}
		#content {
			float: left;
			width: 720px;
			_display: inline;
			padding: 0;
			width: 950px;
		}
		#content .mainbox {
			background: #FFF;
			border: 1px solid #e8e8e8;
			padding: 25px;
			clear: both;
			zoom: 1;
			height: auto!important;
			min-height: 400px;
			padding: 14px 20px;
			border: 1px solid #D4D4D4;
		}
		.mainbox .list-head {
  margin-bottom: 10px;
  padding-bottom: 10px;
  border-bottom: 1px solid #DCDCDC;
}
.mainbox .list-head h2 {
  float: left;
  border: none;
  padding: 0;
  margin: 0;
  font-size: 20px;
  color: #333;
}
.deals-list .deal {
  float: left;
  padding: 30px 18px 20px 0;
  border-bottom: 1px dotted #E5E5E5;
  height: 200px;
  width: 208px;
  font-size: 12px;
}
.deals-list .deal .pic {
  display: block;
  margin: 0 auto 6px;
}
.deals-list .deal .pic img {
  vertical-align: top;
}
.deals-list h4 {
  height: 45px;
  overflow: hidden;
}
.deals-list h4 a {
  color: #666;
  font-weight: 400;
  height: 38px;
  overflow: hidden;
  display: block;
}
.deals-list .deal .info {
	float:none;
	width:auto;
  font-family: Helvetica,arial,sans-serif;
  color: #666;
}

.deals-list .deal .info .total {
  float: right;
  margin-top: 3px;
  color: #666;
  font-weight:normal;
}
.deals-list .deal .info .total label {
  color: #EF5438;
}
.deals-list .deal .info strong {
  margin-right: 5px;
  font-size: 16px;
}
.price {
  font-family: arial, sans-serif;
  color: #f76120;
}
.deals-list .deal .info .delete {
  text-decoration: line-through;
}
.deals-list .last-row {
  border-bottom: none;
  padding-bottom: 6px;
}
#sidebar {
  float: right;
  width: 240px;
  _display: inline;
}
.side-extension {
  margin-bottom: 16px;
  padding: 10px 20px;
  border: 1px solid #e8e8e8;
  background-color: #FFF;
  font-size: 12px;
}
.side-extension__item {
  display: block;
  border-bottom: 1px dotted #DDD;
  margin-bottom: 20px;
  padding-bottom: 13px;
}
.side-extension__item--last {
  border-bottom: 0;
  margin-bottom: 0;
}
.side-extension--history .side-extension__item {
  width: 198px;
}
.side-extension h3 {
  padding: 3px 0 13px;
  font-size: 16px;
}
.side-extension--history .clear-history {
  float: right;
  font-weight: 400;
  font-size: 12px;
  line-height: 24px;
}
.side-extension--history .no-history {
  height: 60px;
  width: 198px;
  line-height: 60px;
  color: #666;
  text-align: center;
}
.side-extension--history .history-list__item {
  padding: 18px 0;
  font-size: 12px;
  color: #666;
  zoom: 1;
  border-bottom: 1px dotted #DDD;
}
.side-extension--history .history-list__item a {
  color: #666;
}
.side-extension--history .history-list__item img {
  float: left;
  margin: 2px 10px 0 0;
}
.side-extension--history .history-list h5 {
  height: 32px;
  line-height: 16px;
  overflow: hidden;
  font-size: 12px;
  font-weight: 400;
}
.side-extension--history .history-list__item a {
  color: #666;
}
.side-extension--history .history-list__item p {
  padding-top: 4px;
    line-height: 18px;
}
.side-extension--history .history-list__item .price {
  padding-right: 5px;
  font: 700 12px/12px arial,sans-serif;
  color: #F76120;
}
.side-extension--history .history-list__item .old-price {
  color: #999;
}
	</style>
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
			<article>
				<div class="menu cf">
					<div class="menu_left hide">
						<div class="menu_left_top"><img src="<?php echo ($static_path); ?>images/o2o1_27.png" /></div>
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
					</div>
				</div>
			</article>
			<div class="cf" id="bd">
				<?php if($group_list){ ?>
					<div class="search-tip">
						<p>找到<span class="keyword">“<?php echo ($keywords); ?>”</span>相关<?php echo ($config["group_alias_name"]); ?><span class="count"><?php echo ($group_count); ?></span>个</p>
					</div>
					<article class="menu_table">
						<div class="sort">
							<ul class="cf">
								<li><a href="<?php echo ($default_sort_url); ?>" <?php if($_GET['order'] == '' || $_GET['order'] == 'all'): ?>class="selected"<?php endif; ?>>默认排序</a></li>
								<li>
									<a href="<?php echo ($hot_sort_url); ?>"<?php if($_GET['order'] == 'hot'): ?>class="selected"<?php endif; ?>>
										<div class="li_txt">销量</div>
										<div class="li_img"></div>
									</a>
								</li>
								<li>
									<a <?php if($_GET['order'] == 'price-asc'): ?>href="<?php echo ($price_desc_sort_url); ?>" class="selected time-asc"<?php elseif($_GET['order'] == 'price-desc'): ?>href="<?php echo ($price_asc_sort_url); ?>" class="selected"<?php else: ?>href="<?php echo ($price_desc_sort_url); ?>"  class="time-asc"<?php endif; ?>>
										<div class="li_txt">价格</div>
										<div class="li_img"></div>
									</a>
								</li>
								<li>
									<a href="<?php echo ($rating_sort_url); ?>" <?php if($_GET['order'] == 'rating'): ?>class="selected"<?php endif; ?>>
										<div class="li_txt">好评</div>
										<div class="li_img"></div>
									</a>
								</li>
								<li>
									<a href="<?php echo ($time_sort_url); ?>" <?php if($_GET['order'] == 'time'): ?>class="selected"<?php endif; ?>>
										<div class="li_txt">发布时间</div>
										<div class="li_img"></div>
									</a>
								</li>
							</ul>
						</div>
					</article>
				<?php }else{ ?>
					<div class="no-result">
						<img class="no-result-img" width="80" height="54" src="<?php echo ($static_path); ?>images/search-no-result.png" alt="搜索无结果">
						<span class="no-result-content">未找到与“<strong><?php echo ($keywords); ?></strong>”相关的<?php echo ($config["group_alias_name"]); ?>信息</span>
					</div>
					<div class="site-sidebar" id="sidebar">
						<div class="side-extension side-extension--history">
							<div class="side-extension__item side-extension__item--last log-mod-viewed">
								<h3><a href="javascript:;" class="clear-history J-clear">清空</a>最近浏览</h3>
							</div>
							<ul class="history-list J-history-list"></ul>
						</div>
					</div>
					<div id="content" class="cf mall">
						<div class="mainbox cf">
							<div class="list-head cf"><h2><?php echo ($config["group_alias_name"]); ?>推荐</h2></div>
							<ul class="deals-list cf log-mod-viewed">
								<?php if(is_array($index_sort_group_list)): $i = 0; $__LIST__ = $index_sort_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="deal <?php if($i > 4): ?>last-row<?php else: ?>first<?php endif; ?> <?php if($i%4 == 0): ?>last-deal<?php endif; ?>">
										<a href="<?php echo ($vo["url"]); ?>" class="pic" target="_blank">
											<img width="208" height="125" alt="【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?>：<?php echo ($vo["group_name"]); ?>" title="【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?>：<?php echo ($vo["group_name"]); ?>" src="<?php echo ($vo["list_pic"]); ?>"/>
										</a>
										<h4><a href="<?php echo ($vo["url"]); ?>" title="【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?>：<?php echo ($vo["group_name"]); ?>" target="_blank">【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?>：<?php echo ($vo["group_name"]); ?></a></h4>
										<div class="info">
											<?php if($vo['sale_count']+$vo['virtual_num']): ?><span class="total">已售<label><?php echo ($vo['sale_count']+$vo['virtual_num']); ?></label></span><?php endif; ?>
											<strong class="price">¥<?php echo ($vo["price"]); ?></strong>
											门店价<label class="delete"><?php echo ($vo["old_price"]); ?></label>
										</div>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				<?php } ?>
				<article class="category cf" id="f1">
					<div class="category_list">
						<?php if($group_list): ?><ul>
								<?php if(is_array($group_list)): $i = 0; $__LIST__ = $group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if($i%4 == 0): ?>class="last--even"<?php endif; ?>>
										<div class="category_list_img">
											<a href="<?php echo ($vo["url"]); ?>" target="_blank">
												<img alt="<?php echo ($vo["s_name"]); ?>" class="deal_img lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo ($vo["list_pic"]); ?>"/>
												<div class="bmbox">
													<div class="bmbox_title"> 该商家有 <span><?php echo ($vo["fans_count"]); ?></span> 个粉丝</div>
													<div class="bmbox_list">
														<div class="bmbox_list_img"><img class="lazy_img" src="<?php echo ($static_public); ?>images/blank.gif" data-original="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$vo['group_id']));?>" /></div>
														<div class="bmbox_list_li">
															<ul class="cf">
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
											<div class="datal">
												<a href="<?php echo ($vo["url"]); ?>" target="_blank">
													<div class="category_list_title">【<?php echo ($vo["prefix_title"]); ?>】<?php echo ($vo["merchant_name"]); ?></div>
													<div class="category_list_description"><?php echo ($vo["group_name"]); ?></div>
												</a>
												<div class="cf cheap_div">
													<?php if($vo['wx_cheap']): ?><div class="cheap">微信购买立减￥<?php echo ($vo["wx_cheap"]); ?></div><?php endif; ?>
												</div>
												<div class="deal-tile__detail cf">
													<span class="price">&yen;<strong><?php echo ($vo["price"]); ?></strong> </span>
													<span>门店价 &yen;<?php echo ($vo["old_price"]); ?></span>	
													<div class="cf"></div>
												</div>
												<div class="extra-inner">
													<div class="sales">已售<strong class="num"><?php echo ($vo['sale_count']+$vo['virtual_num']); ?></strong></div >
													<div class="noreviews">
														<?php if($vo['reply_count']): ?><a href="<?php echo ($vo["url"]); ?>#anchor-reviews" target="_blank">
																<div class="icon"><span style="width:<?php echo ($vo['score_mean']/5*100); ?>%;" class="rate-stars"></span></div>
																<span><?php echo ($vo["reply_count"]); ?>次评价</span>
															</a>
														<?php else: ?>
															<span>暂无评价</span><?php endif; ?>
													</div >
												</div>
											</div>
										</div>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul><?php endif; ?>
					</div>
				</article>
				<?php echo ($pagebar); ?>
			</div>
		</div>
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