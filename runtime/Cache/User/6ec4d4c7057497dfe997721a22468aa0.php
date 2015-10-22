<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>我的积分 | <?php echo ($config["site_name"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
<link href="<?php echo ($static_path); ?>css/meal_order_list.css"  rel="stylesheet"  type="text/css" />
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	   var levelToupdateUrl="<?php echo ($config['site_url']); echo U('User/Level/levelUpdate');?>"
	</script>
<script src="<?php echo ($static_path); ?>js/common.js"></script>
<script src="<?php echo ($static_path); ?>js/category.js"></script>
<!--[if IE 6]>
<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc");}
.category_list li:hover .bmbox {filter:alpha(opacity=50);}
.gd_box{display: none;}
</style>
<![endif]-->
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
</head>
<body id="credit" class="has-order-nav" style="position:static;">
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
				<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
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
    <div class="nav cf">
		<div class="logo">
			<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
				<img src="<?php echo ($config["site_logo"]); ?>" />
			</a>
		</div>
		<div class="search">
			<form action="<?php echo U('Meal/Search/index');?>" method="post">
				<div class="form_sec">
					<div class="form_sec_txt"><?php echo ($config["group_alias_name"]); ?></div>
					<div class="form_sec_txt1"><?php echo ($config["meal_alias_name"]); ?></div>
				</div>
				<input name="w" class="input" type="text" value="<?php echo ($keywords); ?>" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick" type="submit"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
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
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
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
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/account.v1a41925d.css" />
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/table-section.v538886b7.css" />
				<div class="component-order-nav mt-component--booted">
	<div class="side-nav J-order-nav">
		<div class="J-side-nav__user side-nav__user cf">
			<a href="javascript:void(0);" title="帐户设置" class="J-user item user">
				<img src="<?php if($now_user['avatar']): echo ($now_user["avatar"]); else: echo ($static_path); ?>images/user-default-avatar.png<?php endif; ?>" width="30" height="30" alt="<?php echo ($now_user["nickname"]); ?>头像"/>
			</a>
			<div class="item info_nickname">
				<div class="info__name" style="height:36px;line-height:36px;"><?php echo ($now_user["nickname"]); ?></div>
			</div>
			<div>等级：<a href="<?php echo U('Level/index');?>">
				<?php if(isset($levelarr[$now_user['level']])){ $imgstr=''; if(!empty($levelarr[$now_user['level']]['icon'])) $imgstr='<img src="'.$config['site_url'].$levelarr[$now_user['level']]['icon'].'" width="15" height="15">'; echo $imgstr.' '.$levelarr[$now_user['level']]['lname']; }else{echo '暂无等级';} ?></a>
			</div>
		</div>
		<div class="side-nav__account cf">
			<a class="item item--first" href="<?php echo U('Credit/index');?>" title="<?php echo ($now_user["now_money"]); ?>"><?php echo ($now_user["now_money"]); ?><span>余额</span></a>
			<a class="item" href="<?php echo U('Point/index');?>" title="<?php echo ($now_user["score_count"]); ?>"><?php echo ($now_user["score_count"]); ?><span>积分</span></a>
		</div>
		<dl class="side-nav__list">
			<dt class="first-item"><strong>我的订单</strong></dt>
			<dd>
				<ul class="item-list">
					<li <?php if(in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('index'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/index');?>"><?php echo ($config["group_alias_name"]); ?>订单</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('meal_list'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/meal_list');?>"><?php echo ($config["meal_alias_name"]); ?>订单</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('lifeservice'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/lifeservice');?>">缴费订单</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Collect'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Collect/index');?>">我的收藏</a></li>
				</ul>
			</dd>
			<dt><strong>我的评价</strong></dt>
			<dd>
				<ul class="item-list">
					<li <?php if(in_array(MODULE_NAME,array('Rates')) && in_array(ACTION_NAME,array('index','meal'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Rates/index');?>">待评价</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Rates')) && in_array(ACTION_NAME,array('rated','meal_rated'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Rates/rated');?>">已评价</a></li>
				</ul>
			</dd>
			<dt><strong>我的账户</strong></dt>
			<dd class="last">
				<ul class="item-list">
					<li <?php if(in_array(MODULE_NAME,array('Point'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Point/index');?>">我的积分</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Credit'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Credit/index');?>">我的余额</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Level'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Level/index');?>">我的等级</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Adress'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Adress/index');?>">收货地址</a></li>
					<li <?php if(in_array(MODULE_NAME,array('User'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('User/index');?>">邀请列表</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</div>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<div class="balance">您当前的积分： <strong><?php echo ($now_user["score_count"]); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当前等级：<span><strong><?php if(isset($levelarr[$now_user['level']])){ $nextlevel=$levelarr[$now_user['level']]['level']+1;echo $levelarr[$now_user['level']]['lname'];}else{ $nextlevel=1; echo '暂无等级';} ?></strong></span></div>
						<ul class="filter cf">
							<li class="current"><a href="<?php echo U('Level/index');?>">下一等级详情</a></li>
						</ul>
						<div class="table-section">
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<th width="130">等级名称</th>
									<th width="110">消耗积分</th>
									<th width="auto">等级优惠</th>
									<th width="auto">升级</th>
								</tr>
								 <?php if(isset($levelarr[$nextlevel])): ?><tr>
										<td><?php echo ($levelarr[$nextlevel]['lname']); ?></td>
										<td><?php echo ($levelarr[$nextlevel]['integral']); ?></td>
										<td><?php if($levelarr[$nextlevel]['type'] == 1): ?>商品按原价<?php echo ($levelarr[$nextlevel]['boon']); ?>%计算<?php elseif($levelarr[$nextlevel]['type'] == 2): ?>商品价格立减<?php echo ($levelarr[$nextlevel]['boon']); ?>元<?php else: ?>无<?php endif; ?></td>
										<td><a href="javascript:void(0);" class="btn" onclick="levelToupdate(<?php echo ($now_user["score_count"]); ?>,<?php echo ($levelarr[$nextlevel]['integral']); ?>,$(this))" style="color:#FFF;">升 级</a></td>
									</tr>
									<?php else: ?>
									<tr>
									<td colspan="4">
									 <?php if($nextlevel == 1): ?>商家没有设置等级，敬请期待！
									 <?php else: ?>
									  没有更高的等级了！<?php endif; ?>
									</td>
									</tr><?php endif; ?>
							</table>
							<?php if(isset($levelarr[$now_user['level']])): ?><div style="margin-top:20px;">
							<strong><?php echo ($levelarr[$now_user['level']]['lname']); ?> 详情描述：</strong>
							 <div>
							  <?php echo (htmlspecialchars_decode($levelarr[$now_user['level']]['description'],ENT_QUOTES)); ?>
							 </div>
							</div><?php endif; ?>
							<?php if(isset($levelarr[$nextlevel])): ?><div style="margin-top:20px;">
							<strong><?php echo ($levelarr[$nextlevel]['lname']); ?> 详情描述：</strong>
							 <div>
							  <?php echo (htmlspecialchars_decode($levelarr[$nextlevel]['description'],ENT_QUOTES)); ?>
							 </div>
							</div><?php endif; ?>
						</div>
						<?php echo ($pagebar); ?>
                    </div>
				</div>
			</div> <!-- bd end -->
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
</body>
</html>