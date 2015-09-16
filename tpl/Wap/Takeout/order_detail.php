<include file="header" />
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<section>
		<ul class="my_order">
			<li>
				<a href="{pigcms{:U('Takeout/menu', array('mer_id'=>$order['mer_id'],'store_id'=>$order['store_id']))}">
					<div>
						<div class="ico_status {pigcms{$order['css']}"><i></i>{pigcms{$order['show_status']}</div>
					</div>
					<div>
						<h3 class="highlight">{pigcms{$store['name']}</h3>
						<p>{pigcms{$order['total']}份/￥{pigcms{$order['price']}</p>
						<div>{pigcms{$order['date']}</div>
					</div>
					<div class="w14"><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>
		<table class="my_menu_list">
			<thead>
				<tr>
					<th>美食列表</th>
					<th>{pigcms{$order['total']}份</th>
					<th><strong class="highlight">￥{pigcms{$order['price']}</strong></th>
				</tr>
			</thead>
			<tbody>
				<volist name="order['info']" id="info">
				<tr>
					<td>{pigcms{$info['name']}</td>
					<td>X{pigcms{$info['num']}</td>
					<td>￥{pigcms{$info['price']}</td>
				</tr>
				</volist>
			</tbody>
		</table>

		<ul class="box">
			<li>预定人：{pigcms{$order['name']}</li>
			<li>手机：{pigcms{$order['phone']}</li>
			<li>送餐地址：{pigcms{$order['address']}</li>
			<li>送餐时间：{pigcms{$order['arrive_time']}</li>
			<li>送餐费用：￥{pigcms{$order['delivery_fee']}</li>
			<li>支付方式：{pigcms{$order['paytypestr']}</li>
			<li>支付状态：<if condition="$order['paid']"><if condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])"><span style="color:red">线下未支付</span><else /><span style="color:green">已付款</span></if><else /><span style="color:red">未支付</span></if></li>
			<if condition="$order['paid']">
			<li>消费二维码：<span id="see_storestaff_qrcode" style="color:#FF658E;">查看二维码</span></li>
			</if>
		</ul>
		<ul class="box">
			<li>备注</li>
			<li><if condition="$order['note']">{pigcms{$order['note']}<else />无</if></li>
		</ul>
	</section>
	<footer class="order_fixed">
		<div class="fixed">
			<if condition="$order['paid'] neq 1">
				<div style="float: left">
					<a href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'takeout'))}" class="comm_btn" style="background-color: #5fb038;">支付订单</a>
				</div>
			</if>
			<div style="float: right">
				<if condition="$order['paid'] eq 0">
				<a class="comm_btn" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Takeout/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">取消订单</a> 
				<elseif condition="$order['paid'] eq 1 AND $order['status'] eq 0" />
				<a class="comm_btn" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">取消订单</a> 
				</if>
			</div>
			<if condition="$order['status'] eq 1">
				<div style="float: right">
					<a href="{pigcms{:U('My/meal_feedback',array('order_id' => $order['order_id']))}" class="comm_btn">去评价</a>
				</div>	
			</if>
		</div>
	</footer>
</div>
<include file="kefu" />
<script type="text/javascript">
	function drop_confirm(msg, url)
	{
		if (confirm(msg)) {
			window.location.href = url;
		}
	}
</script>
{pigcms{$hideScript}
</body>
</html>