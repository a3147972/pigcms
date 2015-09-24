<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.group_alias_name}订单 | {pigcms{$config.site_name}</title>
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
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.veda7cace.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ratelist.v4b84fddf.css" />
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
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-list.v04de2fe7.css" />
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
									<li class="current"><a href="{pigcms{:U('Index/meal_list')}">{pigcms{$config.meal_alias_name}订单</a></li>
									<li><a href="{pigcms{:U('Collect/index')}">我的收藏</a></li>
								</ul>
							</dd>
							<dt><strong>我的评价</strong></dt>
							<dd>
								<ul class="item-list">
									<li><a href="{pigcms{:U('Rates/index')}">待评价</a></li>
									<li><a href="{pigcms{:U('Rates/rated')}">已评价</a></li>
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
						<select class="J-orders-filter orders-filter dropdown--small" id="select_status">
							<option value="-1" <if condition="$status eq -1">selected="selected"</if>>全部状态</option>
							<option value="1" <if condition="$status eq 1">selected="selected"</if>>未消费</option>
							<option value="0" <if condition="$status eq 0">selected="selected"</if>>未付款</option>
							<option value="2" <if condition="$status eq 2">selected="selected"</if>>已使用</option>
						</select>
						<div class="orders-wrapper" id="order-list">
							<div class="orders-head">
								<div class="order-cell order-info">餐厅信息</div>
								<div class="order-cell order-quantity">数量</div>
								<div class="order-cell order-money">总价</div>
								<div class="order-cell order-status">订单状态</div>
								<div class="order-cell order-op">操作</div>
							</div>
							<volist name="order_list" id="vo">
								<div class="J-order-w">
									<div class="order-title">订单编号：<a href="{pigcms{:U('Index/meal_order_view',array('order_id'=>$vo['order_id']))}" target="_blank">{pigcms{$vo.order_id}</a></div>
									<div class="order-row">
										<div class="order-cell order-op order-cell--right">
											<if condition="$vo['paid'] eq 0">											
												<a class="btn-hot btn-mini" href="{pigcms{:U('Index/Pay/check',array('type'=>'meal','order_id'=>$vo['order_id']))}">付款</a>
											<elseif condition="$vo['status'] == 1"/>
												<a href="{pigcms{:U('Rates/meal')}">评价</a>									
											</if>
										</div>
										<div class="order-row--sub order-row--last">
											<div class="order-cell order-info">
												<div class="deal-info cf">
													<a class="img-w" href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.s_name}">
														<img src="{pigcms{$vo.image}" width="81" height="50"/>
													</a>
													<div class="info-detail">
														<a class="deal-title" href="{pigcms{$vo.url}" title="{pigcms{$vo.s_name}" target="_blank">{pigcms{$vo.s_name}</a>
														<p>下单时间：{pigcms{$vo.dateline|date='Y-m-d H:i:s',###}</p>
														<a target="_blank" class="biz-info" href="{pigcms{$vo.url}">店铺信息</a>
													</div>
												</div>
											</div>
											<div class="order-cell order-quantity">{pigcms{$vo.total}</div>
											<div class="order-cell order-money"><span class="money">¥</span>{pigcms{$vo.price}</div>
											<div class="order-cell order-status"><if condition="empty($vo['paid'])">未付款<elseif condition="empty($vo['status'])"/>未消费<elseif condition="$vo['status'] == '1'"/>已使用 <elseif condition="$vo['status'] == '2'"/>已评价</if><div><a target="_blank" href="{pigcms{:U('Index/meal_order_view',array('order_id'=>$vo['order_id']))}">订单详情</a></div></div>
										</div>
									</div>
								</div>
							</volist>
                        </div>
						<div class="paginator-wrapper"></div>
					</div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>	
	<include file="Public:footer"/>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#select_status").change(function(data){
				location.href='{pigcms{:U(User/Index/meal_list)}&status=' + $(this).val();
			});
		});
	</script>
</body>
</html>
