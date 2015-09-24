<include file="Public:header"/>
	<style>
		.frame_form td{line-height:24px;}
	</style>
	<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
		<tr>
			<tr>
				<th width="15%">订单编号</th>
				<td width="35%">{pigcms{$now_order.order_id}</td>
				<th width="15%">{pigcms{$config.group_alias_name}商品</th>
				<td width="35%"><a href="{pigcms{$now_order.url}" target="_blank" title="查看商品详情">{pigcms{$now_order.s_name}</a></td>
			</tr>
		</tr>
		<tr>
			<td colspan="4" style="padding-left:5px;color:black;"><b>订单信息：</b></td>
		</tr>
		<tr>
			<th width="15%">订单类型</th>
			<td width="35%"><if condition="$now_order['tuan_type'] eq '0'">{pigcms{$config.group_alias_name}券<elseif condition="$now_order['tuan_type'] eq '1'"/>代金券<else/>实物</if></td>
			<th width="15%">订单状态</th>
			<td width="35%">
				<if condition="$now_order['paid']">
					<if condition="$now_order['pay_type'] eq 'offline' AND empty($now_order['third_id'])" >
						<font color="red">线下支付&nbsp;未付款</font>
					<elseif condition="$now_order['status'] eq 0" />
						<font color="green">已付款</font>&nbsp;
						<php>if($now_order['tuan_type'] != 2){</php>
							<font color="red">未消费</font>
						<php>}else{</php>
							<font color="red">未发货</font>
						<php>}</php>
					<elseif condition="$now_order['status'] eq 1"/>
						<php>if($now_order['tuan_type'] != 2){</php>
							<font color="green">已消费</font>
						<php>}else{</php>
							<font color="green">已发货</font>
						<php>}</php>&nbsp;
						<font color="red">待评价</font>
					<else/>
						<font color="green">已完成</font>
					</if>
				<else/>
					<font color="red">未付款</font>
				</if>
			</td>
		</tr>
		<tr>
			<th width="15%">数量</th>
			<td width="35%">{pigcms{$now_order.num}</td>
			<th width="15%">总价</th>
			<td width="35%">￥ {pigcms{$now_order.total_money}</td>
		</tr>
		<tr>
			<th width="15%">下单时间</th>
			<td width="35%">{pigcms{$now_order.add_time|date='Y-m-d H:i:s',###}</td>
			<if condition="$now_order['paid']">
				<th width="15%">付款时间</th>
				<td width="35%">{pigcms{$now_order.pay_time|date='Y-m-d H:i:s',###}</td>
			<else/>
				<th width="15%"></th>
				<td width="35%"></td>
			</if>
		</tr>
		<tr>
			<th width="15%">消费密码</th>
			<td width="35%"><if condition="$now_order['group_pass']">{pigcms{$now_order.group_pass_txt}</if></td>
			<th width="15%">验证店员</th>
			<td width="35%">
				<if condition="$now_order['store_id']">
					<if condition="$now_order['store_name']">{pigcms{$now_order.store_name}<else/>店铺不存在</if>
					 (<if condition="$now_order['last_staff']">{pigcms{$now_order.last_staff}<else/>尚未验证</if>)
				<else/>
					尚未验证
				</if>
			</td>
		</tr>
		<tr>
			<th width="15%">买家留言</th>
			<td width="85%" colspan="3">{pigcms{$now_order.delivery_comment}</td>
		</tr>
		<if condition="$now_order['status'] eq 1">		
			<tr>
				<th width="15%"><if condition="$now_order['tuan_type'] neq 2">消费<else/>发货</if>时间</th>
				<td width="85%" colspan="3">{pigcms{$now_order.use_time|date='Y-m-d H:i:s',###}</td>
			</tr>
		</if>
		
		<tr>
			<td colspan="4" style="padding-left:5px;color:black;"><b>用户信息：</b></td>
		</tr>
		<tr>
			<th width="15%">用户ID</th>
			<td width="35%">{pigcms{$now_order.uid}</td>
			<th width="15%">用户昵称</th>
			<td width="35%">{pigcms{$now_order.nickname}</td>
		</tr>
		<tr>
			<th width="15%">订单手机号</th>
			<td width="35%">{pigcms{$now_order.phone}</td>
			<th width="15%">用户手机号</th>
			<td width="35%">{pigcms{$now_order.user_phone}</td>
		</tr>
		<if condition="$now_order['tuan_type'] eq 2">
			<tr>
				<td colspan="4" style="padding-left:5px;color:black;"><b>配送信息：</b></td>
			</tr>
			<tr>
				<th width="15%">收货人</th>
				<td width="35%">{pigcms{$now_order.contact_name}</td>
				<th width="15%">联系电话</th>
				<td width="35%">{pigcms{$now_order.phone}</td>
			</tr>
			<tr>
				<th width="15%">配送要求</th>
				<td width="35%">
					<switch name="now_order['delivery_type']">
						<case value="1">工作日、双休日与假日均可送货</case>
						<case value="2">只工作日送货</case>
						<case value="3">只双休日、假日送货</case>
						<case value="4">白天没人，其它时间送货</case>
					</switch>
				</td>
				<th width="15%">邮编</th>
				<td width="35%">{pigcms{$now_order.zipcode}</td>
			</tr>
			<tr>
				<th width="15%">收货地址</th>
				<td width="85%" colspan="3">{pigcms{$now_order.adress}</td>
			</tr>
		</if>
		<if condition="$now_order['paid'] eq '1'">
			<tr>
				<th width="15%">支付方式</th>
				<th width="85%" colspan="3">余额支付金额 ￥{pigcms{$now_order.balance_pay}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在线支付金额 ￥{pigcms{$now_order.payment_money}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;使用商户余额 ￥{pigcms{$now_order.merchant_balance}</th>
			</tr>
		</if>
	</table>
	<div class="btn hidden">
		<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
		<input type="reset" value="取消" class="button" />
	</div>
<include file="Public:footer"/