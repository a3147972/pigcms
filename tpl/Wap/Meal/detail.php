<include file="Meal:header"/>
<div> 
	<ul class="round">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
			<tbody>
				<tr>
					<th>菜品名称</th>
					<th class="cc">单价</th>
					<th class="cc">购买份数</th>
					<th class="rr">价格</th>
				</tr>
				<volist name="meallist" id="row">
				<tr>
					<td>{pigcms{$row['name']}</td>
					<td class="cc">{pigcms{$row['price']}</td>
					<td class="cc">{pigcms{$row['num']}</td>
					<td class="rr">￥{pigcms{$row['num'] * $row['price']}</td>
				</tr>
				</volist>
				<tr>
					<td>商品总价</td>
					<td class="cc"></td>
					<td class="cc"></td>
					<td class="rr">￥{pigcms{$order['price']}</td>
				</tr>
				<!-- <tr>
					<td>配送费</td>
					<td class="cc"></td>
					<td class="cc"></td>
					<td class="rr">￥1.00</td>
				</tr> -->
				<tr>
					<td>总计</td>
					<td class="cc"></td>
					<td class="cc"></td>
					<td class="rr"><span class="price">￥{pigcms{$order['price']}</span></td>
				</tr>
			</tbody>
		</table>
	</ul>
	<ul class="round">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
			<tbody>
				<tr>
					<td width="70">订单编号：{pigcms{$order['order_id']}</td>
				</tr>
				<tr>
					<td>下单时间：{pigcms{$order['dateline']|date="Y-m-d H:i:s",###}</td>
				</tr>
				<tr>
					<td>订单金额： <span class="price">￥{pigcms{$order['price']}</span></td>
				</tr>
				<tr>
					<td>订单状态：
		      <if condition="$order['paid'] eq 0">
		      <span class="red">待付款</span> 
		      <elseif condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])" />
		      <span class="red">线下支付　未付款</span>
		      <elseif condition="$order['status'] eq 0" />
		      <span class="red">已付款　未使用</span>
		      <elseif condition="$order['status'] eq 1" />
		      <span class="green">已使用</span></if>
		      </td>
				</tr>
				<if condition="($order['paid'] eq 1 AND $order['pay_type'] neq 'offline') OR ($order['paid'] eq 1 AND $order['pay_type'] eq 'offline' AND $order['third_id'])" />
				<tr>
					<td>消费二维码：<a id="see_storestaff_qrcode" style="color:#FF658E;">查看二维码</a></td>
				</tr>
				<tr>
					<td>消费码：{pigcms{$order['meal_pass']}</td>
				</tr>
				</if>
			</tbody>
		</table>
	</ul>
	<ul class="round">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
			<tbody>
				<tr>
					<td>联系人 ：{pigcms{$order['name']}</td>
				</tr>
				<!-- <tr>
					<td>桌号 ：二楼蒙古包</td>
				</tr> -->
				<tr>
					<td>联系电话 ： {pigcms{$order['phone']}</td>
				</tr>
				<tr>
					<td>地址 ：{pigcms{$order['address']}</td>
				</tr>
				<tr>
					<td>点餐备注 ：{pigcms{$order['note']}</td>
				</tr>
				<!-- <tr>
					<td>预定人数 ：{pigcms{$order['num']}</td>
				</tr> -->

			</tbody>
		</table>
	</ul>
</div>
<div class="footReturn">
	<ul>
		<if condition="$order['paid'] eq 0">
		<li class="footerbtn"><a class="del right3" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Meal/orderdel', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orderid' => $order['order_id']))}');">取消订单</a></li> 
		<li class="footerbtn"><a class="submit left3" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'meal'))}" class="zhifu">支付订单</a></li>  
		<elseif condition="$order['status'] eq 0"/>
		<li class="footerbtn"><a class="del right3" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/meal_order_refund', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orderid' => $order['order_id']))}');">取消订单</a></li> 
		</if>
	</ul>
	<div class="clr"></div>
	<div class="window" id="windowcenter">
		<div id="title" class="wtitle">操作成功<span class="close" id="alertclose"></span></div>
		<div class="content">
			<div id="txt"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
function drop_confirm(msg,url){
	if (confirm(msg)){
		window.location.href = url;
	}
}
</script>
<script src="{pigcms{$static_public}js/jquery.qrcode.min.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<script>
	$(function(){
		$('#see_storestaff_qrcode').click(function(){
			var qrcode_width = $(window).width()*0.6 > 256 ? 256 : $(window).width()*0.6;
			layer.open({
				title:['消费二维码','background-color:#8DCE16;color:#fff;'],
				content:'生成的二维码仅限提供给商家店铺员工扫描验证消费使用！<br/><br/><div id="qrcode"></div>',
				success:function(){
					$('#qrcode').qrcode({
						width:qrcode_width,
						height:qrcode_width,
						text:"{pigcms{$config.site_url}/wap.php?c=Storestaff&a=meal_qrcode&id={pigcms{$order.order_id}"
					});
				}
			});
			$('.layermbox0 .layermchild').css({width:qrcode_width+30+'px','max-width':qrcode_width+30+'px'});
		});
	});
</script>
{pigcms{$hideScript}
<include file="Meal:footer"/>