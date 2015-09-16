<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>已评价{pigcms{$config.group_alias_name}订单 | {pigcms{$config.site_name}</title>
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
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/filter.ved243bd9.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deallist.v49c087a6.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/side.v4cfd6eb1.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/banner-index.v8c9e126d.css" />
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
</head>
<body id="orders" class="has-order-nav" style="position:static;">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/rate-edit.vc3f9a1d2.css" />
				<div class="component-order-nav mt-component--booted">
					<div class="side-nav J-order-nav">
						<div class="J-side-nav__user side-nav__user cf">
							<a href="javascript:void(0);" title="帐户设置" class="J-user item user">
								<img src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/user-default-avatar.png</if>" width="30" height="30" alt="{pigcms{$now_user.nickname}头像"/>
							</a>
							<div class="item info">
								<div class="info__name" style="height:36px;line-height:36px;">{pigcms{$now_user.nickname}</div>
							</div>
						</div>
						<div class="side-nav__account cf">
							<a class="item item--first" href="{pigcms{:U('Credit/index')}" title="{pigcms{$now_user.now_money}">{pigcms{$now_user.now_money}<span>余额</span></a>
							<a class="item" href="{pigcms{:U('Point/index')}" title="{pigcms{$now_user.score_count}">{pigcms{$now_user.score_count}<span>积分</span></a>
						</div>
						<dl class="side-nav__list">
							<dt class="first-item"><strong>我的订单</strong></dt>
							<dd>
								<ul class="item-list">
									<li><a href="{pigcms{:U('Index/index')}">{pigcms{$config.group_alias_name}订单</a></li>
									<li><a href="{pigcms{:U('Index/meal_list')}">{pigcms{$config.meal_alias_name}订单</a></li>
									<li><a href="{pigcms{:U('Collect/index')}">我的收藏</a></li>
								</ul>
							</dd>
							<dt><strong>我的评价</strong></dt>
							<dd>
								<ul class="item-list">
									<li><a href="{pigcms{:U('Rates/index')}">待评价</a></li>
									<li class="current"><a href="{pigcms{:U('Rates/rated')}">已评价</a></li>
								</ul>
							</dd>
							<dt><strong>我的账户</strong></dt>
							<dd class="last">
								<ul class="item-list">
									<li><a href="{pigcms{:U('Point/index')}">我的积分</a></li>
									<li><a href="{pigcms{:U('Credit/index')}">我的余额</a></li>
									<li><a href="{pigcms{:U('Adress/index')}">收货地址</a></li>
								</ul>
							</dd>
						</dl>
					</div>
				</div>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<select class="J-orders-filter orders-filter dropdown--small">
							<option value="{pigcms{:U('Rates/rated')}" selected="selected">{pigcms{$config.group_alias_name}</option>
							<option value="{pigcms{:U('Rates/meal_rated')}">{pigcms{$config.meal_alias_name}</option>
						</select>
						<if condition="$order_list">
							<div id="order-list" class="rate-list">
								<div class="component-rate-edit mt-component--booted">
									<div class="rate-edit">
										<volist name="order_list" id="vo">
											<div class="rate-item <if condition="$i eq count($order_list)">rate-item--last</if>">
												<div class="rate-item__title">
													<a href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.s_name}">
														<img src="{pigcms{$vo.list_pic}" width="81" height="50" style="border:1px solid #ccc;"/>
													</a>
												</div>
												<div class="J-rate-content rate-item__content">
													<h3 class="J-deal-title">
														<a href="{pigcms{$vo.url}" title="{pigcms{$vo.s_name}" target="_blank">{pigcms{$vo.s_name}</a>
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
					$.post("{pigcms{:U('Rates/ajax_get_pic')}",{pic_ids:$(item).attr('pic_ids'),order_type:0},function(result){
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
