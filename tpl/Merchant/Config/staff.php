<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Config/store')}">店铺管理</a>
			</li>
			<li class="active">【{pigcms{$now_store.name}】 店员列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">	
							<li class="active">
								<a>店员管理</a>
							</li>
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
								<button class="btn btn-success" onclick="CreateShop()">添加职员</button>　
								<a href="/store.php?g=Merchant&c=Store&a=login" class="btn btn-success" target="_blank">店员登陆</a>
								<div id="shopList" class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th width="100">帐号</th>
												<th width="100">姓名</th>
												<th width="100">电话</th>
												<th width="100">添加时间</th>
												<th width="80" class="button-column">操作</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$staff_list">
												<volist name="staff_list" id="staff">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$staff.username}</td>
														<td>{pigcms{$staff.name}</td>
														<td>{pigcms{$staff.tel}</td>
														<td>{pigcms{$staff.time|date='Y-m-d H:i:s',###}</td>
														<td class="button-column">
															<a class="green" style="padding-right:8px;" href="{pigcms{:U('Config/staffSet', array('itemid'=>$staff['id'],'store_id'=>$now_store['store_id']))}" >
																<i class="ace-icon fa fa-pencil bigger-130"></i>
															</a>
															<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Config/staffDelete',array('itemid'=>$staff['id'],'store_id'=>$now_store['store_id']))}">
																<i class="ace-icon fa fa-trash-o bigger-130"></i>
															</a>
														</td>
													</tr>
												</volist>
											<else/>
												<tr class="odd"><td class="button-column" colspan="5" >无内容</td></tr>
											</if>
										</tbody>
									</table>
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
	window.location.href = "{pigcms{:U('Config/staffSet', array('store_id' => $now_store['store_id']))}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
