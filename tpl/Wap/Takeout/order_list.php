<include file="header" />
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<section class="pay_wrap">
		<div class="menu_tt"><h2>现有订单</h2></div>
		<ul class="my_order">
			<volist name="order_list" id="order">
			<li>
				<a href="{pigcms{:U('Takeout/order_detail', array('mer_id' => $mer_id,'store_id' => $order['store_id'], 'order_id' => $order['order_id']))}">
					<div>
						<div class="ico_status {pigcms{$order['css']}"><i></i>{pigcms{$order['show_status']}</div>
					</div>
					<div>
						<h3 class="highlight">{pigcms{$order['name']}</h3>
						<p>{pigcms{$order['total']}份/￥{pigcms{$order['price']}</p>
						<div>{pigcms{$order['date']}</div>
					</div>
				</a>
			</li>
			</volist>
		</ul>
	</section>
	<footer class="order_btns">
		<div class="fixed">
			<a href="{pigcms{:U('Takeout/index', array('mer_id' => $mer_id))}"><i class="ico_takeout"></i>叫外卖</a>
			<a href="javascript:;" class="on"><i class="ico_order"></i>我的订单</a>
		</div>
	</footer>
</div>
<include file="kefu" />
{pigcms{$hideScript}
</body>
</html>