<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$now_order.type_txt}订单详情 | {pigcms{$config.site_name}</title>
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
<body id="order-detail">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<div id="content">
					<div class="mainbox mine">
						<h2>订单详情<span class="op-area"><a href="{pigcms{:U('Index/lifeservice')}">返回订单列表</a></span></h2>
						<dl class="info-section primary-info J-primary-info">
							<dt>
								<span class="info-section--title">当前订单状态：</span>
								<em class="info-section--text"><if condition="$now_order['status'] eq 1"><font color="red">充值中</font><elseif condition="$now_order['status'] eq 2"/><font color="green">缴费成功</font><elseif condition="$now_order['status'] eq 3"/><font color="red">已退款</font></if></em>
							</dt>
							<if condition="$now_order['status'] eq 1">
								<dd class="last">
									<p>您可以手动点击检测一下订单是否已经缴费成功</p>
									<div class="operation">
										<a class="btn btn-mini check_btn" href="javascript:void(0)">检测</a>
									</div>
								</dd>
							</if>
						</dl>
						<dl class="bunch-section J-coupon">
							<dt class="bunch-section__label">订单信息</dt>
							<dd class="bunch-section__content">
								<ul class="flow-list">
									<li>订单编号：{pigcms{$now_order.order_id}</li>
									<li>下单时间：{pigcms{$now_order.add_time|date='Y-m-d H:i',###}</li>
									<li>付款时间：{pigcms{$now_order.pay_time|date='Y-m-d H:i',###}</li>
									<if condition="$now_order['status'] eq 2">
										<li>到帐时间：{pigcms{$now_order.transfer_time|date='Y-m-d H:i',###}</li>
									</if>
								</ul>
							</dd>
							<dd class="bunch-section__content">
								<ul class="flow-list">
									<li>户名：{pigcms{$now_order.infoArr.accountName}</li>
									<li>户号：{pigcms{$now_order.infoArr.account}</li>
									<li>缴费地区：{pigcms{$now_order.infoArr.provinceName}&nbsp;&nbsp;{pigcms{$now_order.infoArr.cityName}</li>
									<li>缴费单位：{pigcms{$now_order.infoArr.payUnitName}</li>
								</ul>
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
		$(function(){
			$('.check_btn').click(function(){
				art.dialog({
					icon: 'face-smile',
					title: '提示信息',
					id:'recharge_lifetips_handle',
					opacity:'0.4',
					lock:true,
					fixed: true,
					resize: false,
					content: '正在请求中...'
				});
				$.post('{pigcms{$config.site_url}/wap.php?c=Lifeservice&a=post',{type:'{pigcms{$now_order.type_eng}_check',id:{pigcms{$now_order.order_id}},function(check_result){
					art.dialog.list['recharge_lifetips_handle'].close();
					if(check_result.err_code == 10001){
						alert(check_result.err_msg);
						window.location.href = window.location.href;
					}else if(check_result.err_code == 10000){
						alert('缴费正处于充值中，充值成功系统会通过公众号发消息提醒您！充值会有一定的等待时间，请稍后再继续查询订单状态。');
					}else if(check_result.err_code){
						alert(check_result.err_msg);
					}else{
						window.location.href = window.location.href;
					}
				});
			});
		});
	</script>
</body>
</html>
