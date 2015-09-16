<include file="Public:header"/>
<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
	<tr>
		<th width="180">菜品名称</th>
		<th>单价</th>
		<th>数量</th>
	</tr>
	<volist name="order['info']" id="vo">
	<tr>
		<th width="180">{pigcms{$vo['name']}</th>
		<th>{pigcms{$vo['price']}</th>
		<th>{pigcms{$vo['num']}</th>
	</tr>
	</volist>
	<tr>
		<th colspan="3">支付状态:　
		<if condition="empty($order['paid'])">未支付
		<elseif condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])" />线下未支付
		<elseif condition="$order['paid'] eq 2"  /><span style="color:green">已付￥{pigcms{$order['pay_money']}</span>，<span style="color:red">未付￥{pigcms{$order['price'] - $order['pay_money']}</span>
		<else /><span style="color:green">全额支付</span>
		</if>
		</th>
	</tr>
	<tr>
		<th colspan="3">余额支付金额:￥ {pigcms{$order['balance_pay']}</th>
	</tr>
	<tr>
		<th colspan="3">在线支付金额:￥ {pigcms{$order['payment_money']}</th>
	</tr>
	<tr>
		<th colspan="3">使用商户余额:￥ {pigcms{$order['merchant_balance']}</th>
	</tr>
	<tr>
		<td colspan="3" style="line-height:22px;padding-top:15px;">
		姓名：{pigcms{$order['name']}<br/>
		电话：{pigcms{$order['phone']}<br/>
		地址：{pigcms{$order['address']}
		</td>
	</tr>
</table>
<include file="Public:footer"/>