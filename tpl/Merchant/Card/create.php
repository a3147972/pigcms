<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li class="active">会员卡列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">创建会员卡号</button>&nbsp;&nbsp;
					<button class="btn btn-danger" onclick="if(confirm('确定删除吗')){$('#info').submit()}">删除</button>
					<div id="shopList" class="grid-view">
						<form method="post" action="" id="info">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="50"><input type="checkbox" id="check_box"></th>
									<th id="shopList_c1" width="100">会员卡号 </th>
									<th id="shopList_c0" width="100">状态</th>
									<th id="shopList_c3" width="100">会员资料</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$data_vip">
									<volist name="data_vip" id="data_vip">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td><input type="checkbox" value="{pigcms{$data_vip.id}" class="cbitem" name="id_{pigcms{$i}"></td>
											<td>{pigcms{$data_vip.number}</td>
											<td><if condition="$data_vip['wecha_id'] eq false">空闲卡<else/><strong>使用中</strong></if></td>
											<td><a href="merchant.php?g=Merchant&c=Card&a=members&itemid={pigcms{$data_vip.id}&id={pigcms{$thisCard.id}">查看详情</a></td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
								</if>
							</tbody>
						</table>
						</form>
						{pigcms{$page}
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
	$("#check_box").click(function(){
		if ($(this).attr('checked')){
			$(".cbitem").attr('checked', true);
		} else {
			$(".cbitem").attr('checked', false);
		}
	});
});
function CreateShop(){
	window.location.href = "{pigcms{:U('Card/create_add', array('id' => $thisCard['id']))}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
