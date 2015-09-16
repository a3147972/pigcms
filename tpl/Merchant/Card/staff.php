<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li class="active">【{pigcms{$thisCard['cardname']}】的店员管理</li>
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
							<li>
								<a href="{pigcms{:U('Card/coupon', array('id' => $thisCard['id']))}">优惠券活动</a>
							</li>	
							<li>
								<a href="{pigcms{:U('Card/integral', array('id' => $thisCard['id']))}">礼品券活动</a>
							</li>
							<li>
								<a href="{pigcms{:U('Card/privilege', array('id' => $thisCard['id']))}">特权管理</a>
							</li>
							<li class="active">
								<a href="{pigcms{:U('Card/staff', array('id' => $thisCard['id']))}">店员管理</a>
							</li>
							<!-- <li>
								<a href="{pigcms{:U('Card/gifts', array('id' => $thisCard['id']))}">开卡赠送</a>
							</li> -->
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
								<button class="btn btn-success" onclick="CreateShop()">添加职员</button>
								<div id="shopList" class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th id="shopList_c1" width="100">所属店铺</th>
												<th id="shopList_c0" width="100">姓名</th>
												<th id="shopList_c3" width="100">电话</th>
												<th id="shopList_c3" width="100">添加时间</th>
												<th id="shopList_c11" width="100">操作</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$staffs">
												<volist name="staffs" id="staff">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$staff.companyName}</td>
														<td>{pigcms{$staff.name}</td>
														<td>{pigcms{$staff.tel}</td>
														<td>{pigcms{$staff.time|date='Y-m-d',###}</td>
														<td class="button-column" nowrap="nowrap">
															<a class="green" style="padding-right:8px;" href="{pigcms{:U('Card/staffSet', array('itemid'=>$staff['id'],'id'=>$thisCard['id']))}" >
																<i class="ace-icon fa fa-pencil bigger-130"></i>
															</a>
															<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/staffDelete',array('itemid'=>$staff['id'],'id'=>$thisCard['id']))}">
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
	window.location.href = "{pigcms{:U('Card/staffSet', array('id' => $thisCard['id']))}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
