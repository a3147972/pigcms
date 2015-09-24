<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li class="active">【{pigcms{$thisCard['cardname']}】的优惠券列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">	
							<li>
								<a href="{pigcms{:U('Card/members', array('id' => $thisCard['id']))}">会员管理</a>
							</li>	
							<li class="active">
								<a href="{pigcms{:U('Card/coupon', array('id' => $thisCard['id']))}">优惠券活动</a>
							</li>	
							<li>
								<a href="{pigcms{:U('Card/integral', array('id' => $thisCard['id']))}">礼品券活动</a>
							</li>
							<!-- <li>
								<a href="{pigcms{:U('Card/privilege', array('id' => $thisCard['id']))}">特权管理</a>
							</li>
							<li>
								<a href="{pigcms{:U('Card/gifts', array('id' => $thisCard['id']))}">开卡赠送</a>
							</li> -->
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
								<button class="btn btn-success" onclick="CreateShop()">发布优惠券</button>
								<div id="shopList" class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th id="shopList_c1" width="100">标题</th>
												<th id="shopList_c1" width="100">属性</th>
												<th id="shopList_c0" width="100">使用次数</th>
												<th id="shopList_c3" width="100">创建时间</th>
												<th id="shopList_c3" width="100">过期时间</th>
												<th id="shopList_c11" width="100">操作</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$data_vip">
												<volist name="data_vip" id="list">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$list.title}</td>
														<td><if condition="$list.attr eq '1'">赠送卷<else/>普通卷</if></td>
														<td>{pigcms{$list.usetime}</td>
														<td>{pigcms{$list.statdate|date='Y-m-d',###}</td>
														<td>{pigcms{$list.enddate|date='Y-m-d',###}</td>
														<td class="button-column" nowrap="nowrap">
															<a href="{pigcms{:U('Card/useRecords', array('id'=>$thisCard['id'],'type'=>'coupon','itemid'=>$list['id']))}">使用统计</a>
															|
															<a class="green" style="padding-right:8px;" href="{pigcms{:U('Card/coupon_edit', array('itemid'=>$list['id'],'id'=>$thisCard['id']))}" ><i class="ace-icon fa fa-pencil bigger-130"></i></a>
															|
															<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/coupon_del',array('itemid'=>$list['id'],'id'=>$thisCard['id']))}">
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
									{pigcms{$page}
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
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
function CreateShop(){
	window.location.href = "{pigcms{:U('Card/coupon_edit', array('id' => $thisCard['id']))}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
