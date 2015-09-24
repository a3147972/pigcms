<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>餐饮订单详情 | {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/category.js"></script>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/meal_order_detail.css" />
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
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
</head>
<body>
 <include file="Public:header_top"/>
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
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
				</div>
			</div>
		</article>	
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
							  <if condition="$now_order['status'] eq '3'">
									<div class="operation">
									    <a class="btn btn-mini">已取消并退款</a>
									</div>
								<elseif condition="empty($now_order['paid']) || $now_order['status'] eq '1'" />
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
							<if condition="$now_order['paid'] && $now_order['meal_type'] neq 1 && $now_order['status'] neq 3">
								<dt class="bunch-section__label">{pigcms{$config.meal_alias_name}券</dt>
								<dd class="bunch-section__content">
									<div class="coupon-field">
										<p class="coupon-field__tip">小提示：记下或拍下{pigcms{$config.meal_alias_name}券密码向商家出示即可消费</p>
										<ul>
											<li class="invalid">{pigcms{$config.meal_alias_name}券密码：<b style="color:black;">{pigcms{$now_order.meal_pass_txt}</b><span>
											<if condition="empty($now_order['status'])">未消费<elseif condition="$now_order['status'] eq '1'"/>已使用<elseif condition="$now_order['status'] eq '2'"/>已完成</if></span></li>
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
								 <if condition="!empty($now_order['use_time'])">
										<li>消费时间：{pigcms{$now_order.use_time|date='Y-m-d H:i',###}</li>
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
			</div>
		</div>
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
