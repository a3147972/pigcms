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
				<a href="{pigcms{:U('Card/index', array('id' => $thisCard['id']))}">{pigcms{$thisCard.cardname}</a>
			</li>
			<li>
				<a href="{pigcms{:U('Card/' . $a, array('id' => $thisCard['id']))}">{pigcms{$thisItem.title}</a>
			</li>
			
			<li class="active">使用统计</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="100">卡号</th>
									<th id="shopList_c1" width="100">姓名</th>
									<th id="shopList_c0" width="100">电话</th>
									<th id="shopList_c3" width="100">消费金额</th>
									<th id="shopList_c3" width="100">操作员</th>
									<th id="shopList_c3" width="100">备注</th>
									<th id="shopList_c3" width="100">时间</th>
									<th id="shopList_c11" width="100">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$list">
									<volist name="list" id="c">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$c.cardNum}</td>
											<td>{pigcms{$c.userName}</td>
											<td>{pigcms{$c.userTel}</td>
											<td>{pigcms{$c.expense}</td>
											<td><if condition="$c.operName eq ''">无<else/>{pigcms{$c.operName}</if></td>
											<td><if condition="$c.operName eq ''">会员卡支付或积分兑换<else/>{pigcms{$c.notes}</if></td>
											<td><nobr>{pigcms{$c.time|date='Y-m-d H:i:s',###}</nobr></td>
											<td class="button-column" nowrap="nowrap">
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/useRecord_del',array('itemid'=>$c['id'],'id'=>$thisCard['id']))}">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
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
<script type="text/javascript">
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
function CreateShop(){
	window.location.href = "{pigcms{:U('Card/design')}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
