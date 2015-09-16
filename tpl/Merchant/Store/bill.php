<include file="Store:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
			<li class="active">验证的账单</li>
		</ul>
	</div>
	<div class="alert alert-info" style="margin:10px;">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>只统计验证的线下支付的订单（即收取顾客的现金）
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
														<th>类型</th>
														<th>餐厅名称</th>
														<th>订单号</th>
														<th>订单详情</th>
														<th>数量</th>
														<th>总金额</th>
														<th>余额支付金额</th>
														<th>在线支付金额</th>
														<th>商户余额支付金额</th>
														<th>收取现金</th>
														<th>优惠券</th>
														<th>下单时间</th>
														<th>支付时间</th>
														<th>验证（消费）时间</th>
														<th>验证人</th>
														<th>状态</th>
														<th>对账状态</th>
													</tr>
												</thead>
												<tbody>
													<if condition="$order_list">
														<volist name="order_list" id="vo">
															<tr>
																<td><if condition="$vo['name'] eq 1">{pigcms{$config.meal_alias_name}<else />{pigcms{$config.group_alias_name}</if></td>
																<td>{pigcms{$vo.store_name}</td>
																<td>{pigcms{$vo.order_id}</td>
																<td>
																
																<if condition="$vo['name'] eq 1">
																	<volist name="vo['order_name']" id="menu">
																	{pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
																	</volist>
																<else />{pigcms{$vo.order_name}</if>
																</td>
																<td>{pigcms{$vo.total}</td>
																<td><if condition="$vo['total_price'] gt 0">{pigcms{$vo.total_price}<else />{pigcms{$vo.price}</if></td>
																<td>{pigcms{$vo.balance_pay}</td>
																<td>{pigcms{$vo.payment_money}</td>
																<td>{pigcms{$vo.merchant_balance}</td>
																<td><strong style="color: green">{pigcms{$vo.cash}</strong></td>
																<td><if condition="$vo['card_id'] eq 0">未使用<else/>已使用</if></td>
																<td>{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
																<td><if condition="$vo['pay_time'] gt 0">{pigcms{$vo.pay_time|date="Y-m-d H:i:s",###}</if></td>
																<td><if condition="$vo['use_time'] gt 0">{pigcms{$vo.use_time|date="Y-m-d H:i:s",###}</if></td>
																<td>{pigcms{$vo.last_staff}</td>
																<td>
																	<if condition="$vo['paid'] eq 0">
																		未付款
																	<else />
																		<if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])">线下未支付
																		<elseif condition="$vo['status'] eq 0" />未消费
																		<elseif condition="$vo['status'] eq 1" />未评价
																		<elseif condition="$vo['status'] eq 2" />已完成
																		</if>
																	</if>
																</td>
																<td><if condition="$vo['is_pay_bill'] eq 0"><strong style="color: red">未对账</strong><else /><strong style="color: green"><strong type="color:green">已对账</strong></if></td>
															</tr>
														</volist>
														<input type="hidden" id="percent" value="{pigcms{$percent}" />
														<tr class="even">
															<td colspan="18">
																本页总金额：<strong style="color: green">{pigcms{$total}</strong>　本页已出账金额：<strong style="color: red">{pigcms{$finshtotal}</strong><br/> 
																总金额：<strong style="color: green">{pigcms{$alltotal+$alltotalfinsh}</strong>　总已出账金额：<strong style="color: red">{pigcms{$alltotalfinsh}</strong><br/>
															</td>
														</tr>
														<tr class="odd">
															<td colspan="18" id="show_count"></td>
														</tr>
														<tr><td class="textcenter pagebar" colspan="18">{pigcms{$pagebar}</td></tr>	
													<else/>
														<tr class="odd"><td class="textcenter red" colspan="18" >暂时没有线下支付的账单。</td></tr>
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
	$('#staff_id').change(function(){
		location.href = "{pigcms{:U('Count/staff_bill')}&staffid=" + $(this).val();
	});
	$('.btn-success').click(function(){
		var strids = '';
		var pre = ''
		$('.select').each(function(){
			if ($(this).attr('checked')) {
				strids += pre + $(this).val();
				pre = ',';
			}
		});
		if (strids.length > 0) {
			$.get("{pigcms{:U('Count/change')}", {strids:strids}, function(data){
				if (data.error_code == 0) {
					location.reload();
				}
			}, 'json');
		}
	});
});


function total_price()
{
	var total = 0;
	$('.select').each(function(){
		if ($(this).attr('checked')) {
			total += parseFloat($(this).attr('data-price'));
		}
	});
	if (total > 0) {
		$('#show_count').html('账单总计金额：<strong style=\'color:red\'>￥' + total + '</strong>');
	} else {
		$('#show_count').html('');
	}
}
</script>
<include file="Public:footer"/>
