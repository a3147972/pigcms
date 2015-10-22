<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title><?php echo ($now_group["s_name"]); ?> | <?php echo ($config["site_name"]); ?></title>
	<meta name="keywords" content="<?php echo ($now_group["merchant_name"]); ?>,<?php echo ($now_group["s_name"]); ?>,<?php echo ($config["site_name"]); ?>" />
	<meta name="description" content="<?php echo ($now_group["intro"]); ?>" />
	<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
	<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/buy-process.css" />
	<script type="text/javascript">
	 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	</script>
	<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
	<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
	<script src="<?php echo ($static_path); ?>js/common.js"></script>
	<script src="<?php echo ($static_path); ?>js/group_buy.js"></script>
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
			body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc"); 
			}
			.category_list li:hover .bmbox {
	filter:alpha(opacity=50);
		 
				}
	  .gd_box{	display: none;}
	</style>
	<![endif]-->
	<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
	<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<script>var group_price=<?php echo ($now_group["price"]); ?>;var finalprice=<?php echo ($finalprice); ?>;<?php if($user_session): ?>var is_login=true;<?php else: ?>var is_login=false;var login_url="<?php echo U('Index/Login/frame_login');?>";<?php endif; if($user_session['phone']): ?>var has_phone=true;<?php else: ?>var has_phone=false;var phone_url="<?php echo U('Index/Login/frame_phone');?>";<?php endif; ?></script>
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
	<div class="body pg-buy-process"> 
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
		<article>
			<div class="sysmsgw common-tip" id="sysmsg-error" style="display:none;"></div>
			<div id="bdw" class="bdw" style="min-height:700px;">
				<div id="bd" class="cf">
					<div id="content">
						<div>
							<div class="buy-process-bar-container">
								<ol class="buy-process-desc steps-desc">
									<li class="step step--current">
										1. 提交订单
									</li>
									<li class="step">
										2. 选择支付方式
									</li>
									<li class="step">
										3. 购买成功
									</li>
								</ol>
								<div class="progress">
									<div class="progress-bar" style="width:33.33%"></div>
								</div>
							</div>
						</div>
						<form action="<?php echo ($config["site_url"]); ?>/group/buy/<?php echo ($now_group["group_id"]); ?>.html" method="post" id="deal-buy-form" class="common-form J-wwwtracker-form">
							<div class="mainbox cf">
								<div class="table-section summary-table">
									<table cellspacing="0" class="buy-table" id="menu_list">
										<tr class="order-table-head-row">
											<th class="desc">名称</th>
											<th class="unit-price">单价</th>
											<th class="amount">数量</th>
											<th class="col-total">总价</th>
										</tr> 
										<tr>
											<td class="desc">
												<a href="<?php echo ($now_group["url"]); ?>" target="_blank">
													<?php echo ($now_group["merchant_name"]); ?>：<?php echo ($now_group["group_name"]); ?>
												</a>
											</td>
											<td class="money J-deal-buy-price">¥<span id="deal-buy-price"><?php echo ($now_group["price"]); ?></span></td>
											<td class="deal-component-quantity ">
												<button for="J-cart-minus" class="minus" data-action="-" type="button">-</button><input type="text" autocomplete="off" class="f-text J-quantity J-cart-quantity" maxlength="9" name="q" data-max="<?php echo ($now_group["once_max"]); ?>" data-min="<?php echo ($now_group["once_min"]); ?>" value="<?php echo ($num); ?>"/><button for="J-cart-add" class="item plus" data-action="+" type="button">+</button>
											</td>
											<td class="money total rightpadding col-total">¥<span id="J-deal-buy-total"><?php echo ($total_price); ?></span></td>
										</tr>
										<?php if(!empty($leveloff)): ?><tr>
											<td class="desc" colspan="4">
											  <span>
											  您的会员等级是：<strong style="font-size:16px;color:#FF4907"><?php echo ($leveloff['lname']); ?></strong>
											  </span>
											  <span style="margin-left:450px;"><?php echo ($leveloff['offstr']); ?>&nbsp;&nbsp;优惠后单价为 <strong style="font-size:16px;color:#FF4907">¥<?php echo ($leveloff['price']); ?></strong>
											  </span>
											  <span class="total-fee" style="left:320px"><strong style="font-size:16px;color:#FF4907">¥<span id="levelofftotal"><?php echo ($total_off_price); ?></span></strong></span>
											</td>
										 </tr><?php endif; ?>
										<tr>
											<td></td>
											<td colspan="3" class="extra-fee total-fee rightpadding"><strong>应付金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t"><?php echo ($total_off_price); ?></strong></span>
											</td>
										</tr>
									</table>
								</div>
								<input id="J-deal-buy-cardcode" type="hidden" name="cardcode" maxlength="8" value=""/>							
								<?php if($user_session): if($now_group['tuan_type'] == 2): ?><div id="deal-buy-delivery" class="blk-item delivery J-deal-buy-delivery">
											<h3>收货地址<span><a target="_blank" href="<?php echo U('User/Adress/index');?>">管理</a></span></h3>
											<div id="adress_frame_div">
												<iframe src="<?php echo U('Index/Adress/frame');?>"></iframe>
											</div>
											
											<input id="buy-adress-id" type="hidden" name="adress_id" value=""/>
											<hr/>
											
											<input type="hidden" id="store_id" name="store_id" value="<?php echo ($store["store_id"]); ?>"/>
											<h4>给餐厅留言<span>（根据您的喜好口味，给店家留意提醒）</span></h4>
											<input class="f-text comment" type="text" id="note" name="note" />
										</div><?php endif; endif; ?>
								<?php if($user_session['phone']): ?><div class="blk-mobile">
										<p>您绑定的手机号码：<span class="mobile" style="color:#EE3968;"><?php echo ($pigcms_phone); ?></span></p>
									</div><?php endif; ?>									
								<div class="form-submit shopping-cart">
									<input type="submit" class="clear-cart btn btn-large btn-buy" id="confirmOrder" value="提交订单" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</article>
	</div>
	<script>
	function change_adress_frame(frame_height){
		$('#adress_frame_div').height(frame_height).find('iframe').css({'opacity':'1','filter':'alpha(opacity=100)'});
	}
	function change_adress(adress_id,username,phone,province_txt,city_txt,area_txt,zipcode){
		$('#buy-adress-id').val(adress_id);
	}
	</script>
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