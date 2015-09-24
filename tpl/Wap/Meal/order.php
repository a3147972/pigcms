<include file="Meal:header"/>
<div class="window" id="windowcenter">
	<div id="title" class="title">消息提醒<span class="close" id="alertclose"></span></div>
	<div class="content">
		<div id="txt"></div>
		<input type="button" value="确定" id="windowclosebutton" name="确定" class="txtbtn">	
	</div>
</div>
<div class="user_menu user_order">
	<ul>
		<li> 
			<a <if condition="$status eq -1 AND $paid eq -1">class="current" </if>href="{pigcms{:U('Meal/order', array('mer_id' => $mer_id, 'store_id' => $store_id))}"> 
				<img src="{pigcms{$static_path}images/tb_icon_all_ok_48.png">
				<p>全部订单</p>
			</a>
			<if condition="$allcount gt 0">
			<span class="num">{pigcms{$allcount}</span>
			</if> 
		</li>
		<li> 
			<a <if condition="$paid eq 0">class="current" </if>href="{pigcms{:U('Meal/order', array('mer_id' => $mer_id, 'store_id' => $store_id, 'paid' => 0))}"> 
				<img src="{pigcms{$static_path}images/tb_icon_all_pay_48.png">
				<p>待付款</p>
			</a> 
			<if condition="$nopaid gt 0">
			<span class="num">{pigcms{$nopaid}</span>  
			</if>
		</li>
		<li> 
			<a <if condition="$status eq 0">class="current" </if>href="{pigcms{:U('Meal/order', array('mer_id' => $mer_id, 'store_id' => $store_id, 'status' => 0))}"> 
				<img src="{pigcms{$static_path}images/tb_icon_all_deliver_48.png">
				<p>待发货</p>
			</a>  
			<if condition="$nosend gt 0">
			<span class="num">{pigcms{$nosend}</span>  
			</if>
		</li>
		<li> 
			<a <if condition="$status eq 1">class="current" </if>href="{pigcms{:U('Meal/order', array('mer_id' => $mer_id, 'store_id' => $store_id, 'status' => 1))}"> 
				<img src="{pigcms{$static_path}images/tb_icon_all_refund_48.png">
				<p>已结束</p>
			</a>   
			<if condition="$successcount gt 0">
			<span class="num">{pigcms{$successcount}</span>  
			</if>
		</li>
	</ul>
</div>
<div class="car"> 
	<volist name="orders" id="order">
	<div class="mod">
	    <h2><a href="{pigcms{:U('Meal/detail', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orderid' => $order['order_id']))}" class="car_info_a">订单号：{pigcms{$order['order_id']}<i class="icon_gt"></i></a></h2>
	    <div class="car_info">
		    <a class="car_info_a" href="{pigcms{:U('Meal/detail', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orderid' => $order['order_id']))}">
		      <p><span class="gray">下单时间：</span>{pigcms{$order['dateline']|date="Y-m-d H:i:s", ###}</p>
		      <p><span class="gray">订单金额：</span><span>￥{pigcms{$order['price']}元</span></p>
		      <p><span class="gray">订单状态：</span>
		      <if condition="$order['paid'] eq 0">
		      <span class="red">待付款</span> 
		      <elseif condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])" />
		      <span class="red">线下支付　未付款</span>
		      <elseif condition="$order['status'] eq 0" />
		      <span class="red">已付款　未使用</span>
		      <elseif condition="$order['status'] eq 1" />
		      <span class="green">已使用</span></if>
		      </p>
		    </a>
	    </div>
		<div class="car_info_b">
			<if condition="$order['paid'] eq 0">
			<a href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Meal/orderdel', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orderid' => $order['order_id']))}');">取消订单</a> 
			<a href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'meal'))}" class="zhifu">支付订单</a>  
			</if>
	    </div>
	</div>
	</volist>
</div>

<script type="text/javascript">
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
{pigcms{$hideScript}
<include file="Meal:footer"/>