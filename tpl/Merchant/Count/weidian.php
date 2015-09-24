<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
			<li class="active">商家账单</li>
			<li class="active">商家的微店对账</li>
		</ul>
	</div>
	<div class="alert alert-info" style="margin:10px;">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>只统计已付款日期超过十天的订单
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-sm-12">
					<div class="tabbable" style="margin-top:20px;">
								<div class="row">					
									<div class="col-xs-12">		
										<div class="grid-view">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th><input type="checkbox" id="all_select"/></th>
														<th>类型</th>
														<th>订单号</th>
														<th>订单详情</th>
														<th>数量</th>
														<th>金额</th>
														<th>余额支付金额</th>
														<th>在线支付金额</th>
														<th>商户余额支付金额</th>
														<th>优惠券</th>
														<th>下单时间</th>
														<th>支付时间</th>
														<th>支付类型</th>
														<th>对账状态</th>
													</tr>
												</thead>
												<tbody>
													<if condition="$order_list">
														<volist name="order_list" id="vo">
															<tr>
																<td><if condition="$vo['is_pay_bill'] eq 0"><input type="checkbox" value="{pigcms{$vo.name}_{pigcms{$vo.order_id}" class="select" data-price="{pigcms{$vo.price}"/></if></td>
																<td>微店</td>
																<td>{pigcms{$vo.order_id}</td>
																<td>{pigcms{$vo.order_name}</td>
																<td>{pigcms{$vo.total}</td>
																<td>{pigcms{$vo.order_price}</td>
																<td>{pigcms{$vo.balance_pay}</td>
																<td>{pigcms{$vo.payment_money}</td>
																<td>{pigcms{$vo.merchant_balance}</td>
																<td><if condition="$vo['card_id'] eq 0">未使用<else/>已使用</if></td>
																<td>{pigcms{$vo.add_time|date="Y-m-d H:i:s",###}</td>
																<td><if condition="$vo['pay_time'] gt 0">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</if></td>
																<td>{pigcms{$vo.pay_type_show}</td>
																<td><if condition="$vo['is_pay_bill'] eq 0"><strong style="color: red">未对账</strong><else /><strong style="color: green"><strong type="color:green">已对账</strong></if></td>
															</tr>
														</volist>
														<input type="hidden" id="percent" value="{pigcms{$percent}" />
														<tr class="even">
															<td colspan="16">
															<if condition="$percent">
															平台的抽成比例：<strong style="color: green">{pigcms{$percent}%</strong> <br/>
															本页总金额：<strong style="color: green">{pigcms{$total}</strong>　本页已出账金额：<strong style="color: red">{pigcms{$finshtotal} * {pigcms{$percent}%</strong><br/> 
															总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong>　总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh} * {pigcms{$percent}%</strong><br/>
															<strong>本页平台应获取的抽成金额：</strong><strong style="color: green">{pigcms{$total_percent}</strong><br/>
															<strong>平台应获取的总抽成金额：</strong><strong style="color: red">{pigcms{$all_total_percent}</strong><br/>
															<else />
																本页总金额：<strong style="color: green">{pigcms{$total}</strong>　本页已出账金额：<strong style="color: red">{pigcms{$finshtotal}</strong><br/> 
																总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong>　总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh}</strong><br/>
															
															</if>
															
															</td>
														</tr>
														<tr class="odd">
															<td colspan="14" id="show_count"></td>
														</tr>
														<tr><td class="textcenter pagebar" colspan="14">{pigcms{$pagebar}</td></tr>	
													<else/>
														<tr class="odd"><td class="textcenter red" colspan="14" >该的店铺暂时还没有订单。</td></tr>
													</if>
												</tbody>
											</table>
										</div>						
									</div>
									<!--div class="col-xs-2" style="margin-top: 15px;">
										<a class="btn btn-success" href="#">导出成excel</a>
									</div-->
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#all_select').click(function(){
		if ($(this).attr('checked')){
			$('.select').attr('checked', true);
		} else {
			$('.select').attr('checked', false);
		}
		total_price();
	});
	$('.select').click(function(){total_price();});
});


function total_price()
{
	var total = 0;
	$('.select').each(function(){
		if ($(this).attr('checked')) {
			total += parseFloat($(this).attr('data-price'));
		}
	});
	total = Math.round(total * 100)/100;
	var percent = $('#percent').val();
	if (total > 0) {
		$('#show_count').html('账单总计金额：<strong style=\'color:red\'>￥' + total + '</strong>, 平台对改商家的抽成比例是：<strong style=\'color:green\'>' + percent + '%</strong>, 平台应得金额：<strong style=\'color:green\'>￥' + Math.round(total * percent) /100 + '</strong>,商家应得金额:<strong style=\'color:red\'>￥' + Math.round((total - Math.round(total * percent) /100) * 100)/100 + '</strong>');
	} else {
		$('#show_count').html('');
	}
}
</script>
<include file="Public:footer"/>
