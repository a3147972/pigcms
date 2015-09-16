<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-cutlery"></i>
				<a href="{pigcms{:U('Count/index')}">商家账单</a>
			</li>
			<li class="active">对账列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="50">类型</th>
									<th id="shopList_c1" width="150">餐厅名称</th>
									<th id="shopList_c1" width="50">订单号</th>
									<th id="shopList_c0" width="200">订单详情</th>
									<th id="shopList_c0" width="50">数量</th>
									<th id="shopList_c3" width="50">金额</th>
									<th id="shopList_c3" width="80">余额支付金额</th>
									<th id="shopList_c4" width="80">商户余额支付金额</th>
									<th id="shopList_c4" width="50">在线支付金额</th>
									<th id="shopList_c4" width="50">优惠券</th>
									<th id="shopList_c5" width="100" >下单时间</th>
									<th id="shopList_c5" width="100" >支付时间</th>
									<th id="shopList_c5" width="100" >支付类型</th>
									<th id="shopList_c5" width="50" >状态</th>
									<th id="shopList_c5" width="50" >对账状态</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$order_list">
									<volist name="order_list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td><div class="tagDiv"><if condition="$vo['name'] eq 1">{pigcms{$config.meal_alias_name}<else />{pigcms{$config.group_alias_name}</if></div></td>
											<td><div class="tagDiv">{pigcms{$vo.store_name}</div></td>
											<td><div class="tagDiv">{pigcms{$vo.order_id}</div></td>
											<td>
											<div class="tagDiv">
											<if condition="$vo['name'] eq 1">
												<volist name="vo['order_name']" id="menu">
												{pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
												</volist>
											<else />{pigcms{$vo.order_name}</if>
											</div>
											</td>
											<td><div class="shopNameDiv">{pigcms{$vo.total}</div></td>
											<td><div class="shopNameDiv">{pigcms{$vo.price}</div></td>
											<td><div class="shopNameDiv">{pigcms{$vo.balance_pay}</div></td>
											<td><div class="shopNameDiv">{pigcms{$vo.merchant_balance}</div></td>
											<td><div class="shopNameDiv">{pigcms{$vo.payment_money}</div></td>
											<td><if condition="$vo['card_id'] eq 0">未使用<else/>已使用</if></td>
											<td>{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
											<td><if condition="$vo['pay_time'] gt 0">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</if></td>
											<td>{pigcms{$vo.pay_type}</td>
											<td><if condition="$vo['status'] eq 0">未消费<elseif condition="$vo['status'] eq 1" />未评价<elseif condition="$vo['status'] eq 2" />已完成</if></td>
											<td><if condition="$vo['is_pay_bill'] eq 0"><strong style="color: red">未对账</strong><else /><strong style="color: green"><strong type="color:green">已对账</strong></if></td>
										</tr>
									</volist>
									
									<tr class="even">
										<td colspan="15">
										本页总金额：<strong style="color: green">{pigcms{$total}</strong> 本页已出账金额：<strong style="color: red">{pigcms{$finshtotal}</strong><br/> 总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong> 总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh}</strong>
										</td>
									</tr>
										
								<else/>
									<tr class="odd"><td class="button-column" colspan="15" >您的店铺暂时还没有订单。</td></tr>
								</if>
							</tbody>
						</table>
						{pigcms{$pagebar}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<include file="Public:footer"/>
