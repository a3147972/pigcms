<include file="Store:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-cutlery"></i>
				{pigcms{$config.meal_alias_name}订单列表
			</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>	
						<p>
							注意:在每行的输入框里可以通过输入您想要搜索的订单的关键词<br/>
							在对应的标题下输入对应的关键词后按【Enter】即可搜索
						</p>
					</div>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="50">订单号</th>
									<th id="shopList_c1" width="50">下单人姓名</th>
									<th id="shopList_c0" width="80">下单人电话</th>
									<th width="80">消费码</th>
									<th id="shopList_c0" width="100">下单人地址</th>
									<th id="shopList_c5" width="50" >餐台信息</th>
									<th id="shopList_c5" width="50" >消费类型</th>
									<th id="shopList_c5" width="100" >验证消费</th>
									<th id="shopList_c3" width="80">下单时间</th>
									<th id="shopList_c3" width="80">订单总价</th>
									<th id="shopList_c3" width="50">优惠</th>
									<th id="shopList_c3" width="50">应收</th>
									<th id="shopList_c4" width="80">支付状态</th>
									<th id="shopList_c4" width="80">订单状态</th>
									<th id="shopList_c4" width="50">余额支付金额</th>
									<th id="shopList_c4" width="50">在线支付金额</th>
									<th id="shopList_c4" width="50">使用商户余额</th>
									<th id="shopList_c5" width="130" >菜单详情</th>
									<th id="shopList_c5" width="120" >顾客留言</th>
									<th class="button-column">操作</th>
								</tr>
							</thead>
							<tbody>
								<tr class="filters">
									<form method="post" action="" id="queryForList">
									<td><input id="order_id" name="order_id" type="text" maxlength="20" value="{pigcms{$order_id}"/></td>
									<td><input id="name" name="name" type="text" maxlength="20"  value="{pigcms{$name}"/></td>
									<td><input id="phone" name="phone" type="text" maxlength="20"  value="{pigcms{$phone}"/></td>
									<td><input id="meal_pass" name="meal_pass" type="text" maxlength="20"  value="{pigcms{$meal_pass}"/></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									</form>
								</tr>
								<volist name="order_list" id="vo">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
									
										<td><div class="tagDiv">{pigcms{$vo.order_id}</div></td>
										<td><div class="tagDiv">{pigcms{$vo.name}</div></td>
										<td><div class="shopNameDiv">{pigcms{$vo.phone}</div></td>
										<td><div class="shopNameDiv">{pigcms{$vo.meal_pass}</div></td>
										<td>{pigcms{$vo.address}</td>
										<td>{pigcms{$vo.tablename}</td>
										<td><if condition="$vo['meal_type'] eq 1">外卖<else />预定</if></td>
										<td>
										<if  condition="!empty($vo['last_staff'])">
										操作人员：<span class="red">{pigcms{$vo['last_staff']}</span><br/>消费时间：<br/>{pigcms{$vo.use_time|date="Y-m-d H:i",###}
										<else/>
										<span class="red">未验证消费</span>
										</if>
										</td>
										<td>{pigcms{$vo.dateline|date="Y-m-d H:i:s",###}</td>
										<td><if condition="$vo['total_price'] gt 0">{pigcms{$vo['total_price']}<else />{pigcms{$vo.price}</if></td>
										<td>{pigcms{$vo.minus_price}</td>
										<td>{pigcms{$vo['total_price'] - $vo['minus_price']}</td>
										<td>
											<if condition="$vo['paid'] eq 0">未支付
											<elseif condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" />
											<span class="red">线下支付　未付款</span>
											<elseif condition="$vo['paid'] eq 2"/>已付<span class="red">{pigcms{$vo.pay_money}</span>
											<elseif condition="$vo['paid'] eq 1"/><span class="green">全额支付</span>
											</if>
										</td>
										<td>
											<if condition="$vo['status'] eq 0"><span style="color: red">未使用</span>
											<elseif condition="$vo['status'] eq 1" /><span style="color: green">已使用<strong>未评价</strong></span>
											<elseif condition="$vo['status'] eq 2" /><span style="color: green">已使用<strong>已评价</strong></span>
											<elseif condition="$vo['status'] eq 3" /><span style="color: red">订单已取消</span>
											</if>
										</td>
										<td>{pigcms{$vo.balance_pay}</td>
										<td>{pigcms{$vo.payment_money}</td>
										<td>{pigcms{$vo.merchant_balance}</td>
										
										<td>
										<volist name="vo['info']" id="menu">
										{pigcms{$menu['name']}:{pigcms{$menu['price']}*{pigcms{$menu['num']}</br>
										</volist>
										</td>
										<td>{pigcms{$vo.note}</td>
									
										
										<td class="button-column" width="40">
											<a title="操作订单" class="green edit_btn" style="padding-right:8px;" href="{pigcms{:U('Store/meal_edit',array('order_id'=>$vo['order_id']))}">
												<i class="ace-icon fa fa-pencil bigger-130"></i>
											</a>
										</td>
									</tr>
								</volist>
							</tbody>
						</table>
						{pigcms{$pagebar}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
document.onkeydown = function(event_e) {
	if(window.event) event_e = window.event;  
	var int_keycode = event_e.charCode||event_e.keyCode;  
	if(int_keycode ==13 && ($('#order_id').val() != '' || $('#phone').val() != '' || $('#name').val() != '' || $('#meal_pass').val() != '')) $('#queryForList').submit();
}  
</script>
<include file="Public:footer"/>
