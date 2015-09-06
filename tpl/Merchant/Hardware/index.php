<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-cloud"></i>
			<li class="active">微硬件</li>
			<li class="active">小票打印机</li>
		</ul>
	</div>
	<div class="alert alert-info" style="margin:10px;">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>无线订单打印机（小票打印机）是指无需人工处理，有订单的时候会自动打印订单信息的小型打印机！<br/><br/>目前只用于{pigcms{$config.meal_alias_name}。
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<div class="tab-content">
							<div class="tab-pane active">
								<a href="{pigcms{:U('Hardware/addprint')}" class="btn btn-success">创建打印机</a>
								<div id="shopList" class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th width="100">店铺名称</th>
												<th width="100">绑定账号</th>
												<th width="100">终端号</th>
												<th width="100">密钥</th>
												<th width="100">打印份数</th>
												<th width="100">打印类型</th>
												<th width="100">打印二维码</th>
												<th width="80" class="button-column">操作</th>
											</tr>
										</thead>
										<tbody>
											<if condition="$list">
												<volist name="list" id="row">
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$row.name}</td>
														<td>{pigcms{$row.username}</td>
														<td>{pigcms{$row.mcode}</td>
														<td>{pigcms{$row.mkey}</td>
														<td>{pigcms{$row.count}</td>
														<td><if condition="$row['paid']">只打印付过款的<else />无论是否付款都打印</if></td>
														<td><if condition="$row['qrcode']"><img src="{pigcms{$row['qrcode']}" width="70"/><else /></if></td>
														<td class="button-column">
															<a class="green" style="padding-right:8px;" href="{pigcms{:U('Hardware/addprint', array('pigcms_id' => $row['pigcms_id']))}" >
																<i class="ace-icon fa fa-pencil bigger-130"></i>
															</a>
															<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Hardware/delprint', array('pigcms_id' => $row['pigcms_id']))}">
																<i class="ace-icon fa fa-trash-o bigger-130"></i>
															</a>
														</td>
													</tr>
												</volist>
											<else/>
												<tr class="odd"><td class="button-column" colspan="7" >无内容</td></tr>
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
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
