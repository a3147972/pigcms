<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li>
				<a href="{pigcms{:U('Card/members', array('id' => $thisCard['id']))}">会员管理</a>
			</li>
			<li class="active">【{pigcms{$thisCard.cardname}】的消费记录</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<div class="tab-content">
							<div class="tab-pane active">
								<div id="shopList" class="grid-view">
									<h5 style="margin-top:20px;">会员资料</h5>
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th id="shopList_c1" width="100">卡号</th>
												<th id="shopList_c1" width="100">微信名</th>
												<th id="shopList_c1" width="100">姓名</th>
												<th id="shopList_c0" width="100">联系电话</th>
												<th id="shopList_c0" width="100">QQ号码</th>
												<th id="shopList_c3" width="100">领卡时间</th>
												<th id="shopList_c3" width="100">积分</th>
												<th id="shopList_c3" width="100">消费总额(元)</th>
												<th id="shopList_c3" width="100">余额</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$members">
												<volist name="members" id="list">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$list.number}</td>
														<td>{pigcms{$list.wechaname}</td>
														<td>{pigcms{$list.truename}</td>
														<td>{pigcms{$list.tel}</td>
														<td>{pigcms{$list.qq}</td>
														<td><if condition="$list['getcardtime'] gt 0">{pigcms{$list.getcardtime|date='Y-m-d',###}<else/> 无时间记录</if></td>
														<td>{pigcms{$list.total_score}</td>
														<td>{pigcms{$list.expensetotal}</td>
														<td>{pigcms{$list.balance}</td>
													</tr>
												</volist>
											<else/>
												<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
											</if>
										</tbody>
									</table>
									<h5 style="margin-top:20px;">积分、线下消费记录</h5>
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th id="shopList_c1" width="100">日期</th>
												<th id="shopList_c1" width="100">金额(元)</th>
												<th id="shopList_c1" width="100">获取积分</th>
												<th id="shopList_c0" width="100">类型</th>
												<th id="shopList_c0" width="100">备注</th>
												<th id="shopList_c3" width="100">操作</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$records">
												<volist name="records" id="r">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$r.time|date='Y-m-d',###}</td>
														<td>{pigcms{$r.expense}</td>
														<td>{pigcms{$r.score}</td>
														<td><if condition="$r.cat eq 2">兑换<elseif condition="$r.cat eq 3"/>赠送<else/>消费</if></td>
														<td>{pigcms{$r.notes}</td>
														<td><a href="javascript:drop_confirm('您确定要删除吗?', '/merchant.php?g=Merchant&m=Card&a=useRecord_del&token={pigcms{$token}&itemid={pigcms{$r.id}&id={pigcms{$thisCard.id}');" class="red"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>
													</tr>
												</volist>
											<else/>
												<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
											</if>
										</tbody>
									</table>
									{pigcms{$page}
									<h5 style="margin-top:20px;">会员卡消费记录</h5>
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th id="shopList_c1" width="100">日期</th>
												<th id="shopList_c1" width="100">订单号</th>
												<th id="shopList_c1" width="100">订单名称</th>
												<th id="shopList_c0" width="100">交易金额</th>
												<th id="shopList_c0" width="100">状态</th>
												<th id="shopList_c3" width="100">操作</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$rmb">
												<volist name="rmb" id="rmb">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$rmb.createtime|date='Y-m-d H:i',###}</td>
														<td>{pigcms{$rmb.orderid}</td>
														<td>{pigcms{$rmb.ordername}</td>
														<td>{pigcms{$rmb.price}</td>
														<td><if condition="$rmb['paid'] eq 1">交易成功<else /><font color="red">未付款</font></if></td>
														<td><a href="javascript:drop_confirm('您确定要删除吗?', '/merchant.php?g=Merchant&c=Card&a=payRecord_del&pid={pigcms{$rmb.id}');" class="red"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>
													</tr>
												</volist>
											<else/>
												<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
											</if>
										</tbody>
									</table>
									{pigcms{$page2}
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
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
