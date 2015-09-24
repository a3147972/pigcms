<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>餐饮订单详情 | {pigcms{$config.site_name}</title>
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
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order.v1227a5ac.css" />
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
</head>
<body id="order-detail">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<div id="content">
					<div class="mainbox mine">
						<h2>订单详情<span class="op-area"><a href="{pigcms{:U('Index/meal_list')}">返回订单列表</a></span></h2>
						<dl class="info-section primary-info J-primary-info">
							<dt>
								<span class="info-section--title">当前订单状态：</span>
								<em class="info-section--text"><if condition="empty($now_order['paid'])">未付款<elseif condition="empty($now_order['status'])"/>未消费<elseif condition="$now_order['status'] == '1'"/>已使用<elseif condition="$now_order['status'] == '2'"/>已完成</if></em>
								<div style="float:right;"><a class="see_tmp_qrcode" href="{pigcms{:U('Index/Recognition/see_tmp_qrcode',array('qrcode_id'=>3000000000+$now_order['order_id']))}">查看微信二维码</a></div>
							</dt>
							<dd class="last">
								<if condition="empty($now_order['paid']) || $now_order['status'] eq '1'">
									<div class="operation">
										<if condition="empty($now_order['paid'])">
											<a class="btn btn-mini" href="{pigcms{:U('Index/Pay/check',array('type'=>'meal','order_id'=>$now_order['order_id']))}">付款</a>
											<a class="inline-link J-order-cancel" href="{pigcms{:U('Index/meal_order_del',array('order_id'=>$now_order['order_id']))}">删除</a>
										<elseif condition="$now_order['status'] eq '1'"/>
											<a class="btn btn-mini" href="{pigcms{:U('Rates/meal')}">评价</a>
										</if>
									</div>
								</if>
							</dd>
						</dl>
						<dl class="bunch-section J-coupon">
							<if condition="$now_order['paid'] && $now_order['meal_type'] neq 1">
								<dt class="bunch-section__label">{pigcms{$config.meal_alias_name}券</dt>
								<dd class="bunch-section__content">
									<div class="coupon-field">
										<p class="coupon-field__tip">小提示：记下或拍下{pigcms{$config.meal_alias_name}券密码向商家出示即可消费</p>
										<ul>
											<li class="invalid">{pigcms{$config.meal_alias_name}券密码：<b style="color:black;">{pigcms{$now_order.meal_pass_txt}</b><span><if condition="empty($now_order['status'])">未消费<elseif condition="$now_order['status'] == '1'"/>已使用<elseif condition="$now_order['status'] == '2'"/>已完成</if></span></li>
										</ul>
									</div>
								</dd>
							</if>
							<dt class="bunch-section__label">订单信息</dt>
							<dd class="bunch-section__content">
								<ul class="flow-list">
									<li>订单编号：{pigcms{$now_order.order_id}</li>
									<li>下单时间：{pigcms{$now_order.dateline|date='Y-m-d H:i:s',###}</li>
									<if condition="$now_order['paid']">
										<li>付款方式：{pigcms{$now_order.pay_type_txt}</li>
										<li>付款时间：{pigcms{$now_order.pay_time|date='Y-m-d H:i:s',###}</li>
									</if>
								</ul>
								<if condition="$now_order['meal_type'] eq 1">
									<ul>
										<li class="invalid">送餐信息：{pigcms{$now_order.name}，{pigcms{$now_order.phone}，{pigcms{$now_order.address}</li>
									</ul>
								</if>
							</dd>
							
							<dt class="bunch-section__label">{pigcms{$config.meal_alias_name}信息</dt>
							<dd class="bunch-section__content">
								<table cellspacing="0" cellpadding="0" border="0" class="info-table">
									<tbody>
										<tr>
											<th class="left" width="100">菜品名称</th>
											<th width="50">单价</th>
											<th width="10"></th>
											<th width="30">数量</th>
											<th width="10"></th>
											<th width="54">支付金额</th>
										</tr>
										<volist name="now_order['info']" id="v">
										<tr>
											<td class="left">{pigcms{$v.name}</td>
											<td><span class="money">¥</span>{pigcms{$v.price}</td>
											<td>x</td>
											<td>{pigcms{$v.num}</td>
											<td>=</td>
											<td class="total"><span class="money">¥</span>{pigcms{$v['price'] * $v['num']}</td>
										</tr>
										</volist>
									</tbody>
								</table>
							</dd>
												</dl>
					</div>
				</div>

			</div> <!-- bd end -->
		</div>
	</div>	
	<include file="Public:footer"/>
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.see_tmp_qrcode').click(function(){
				var qrcode_href = $(this).attr('href');
				art.dialog.open(qrcode_href+"&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'请使用微信扫描二维码',
					padding: 0,
					width: 430,
					height: 433,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					left: '50%',
					top: '38.2%',
					opacity:'0.4'
				});
				return false;
			});
		});
	</script>
</body>
</html>
