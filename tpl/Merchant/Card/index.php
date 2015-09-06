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
					<button class="btn btn-success" onclick="CreateShop()">新增会员卡</button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="100">名称</th>
									<th id="shopList_c1" width="100">卡片总数</th>
									<th id="shopList_c0" width="100">已开卡会员</th>
									<th id="shopList_c3" width="100">领卡短信验证</th>
									<th id="shopList_c11" width="180">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$cards">
									<volist name="cards" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.cardname}</td>
											<td>{pigcms{$vo.cardcount}</td>
											<td>{pigcms{$vo.usercount}</td>
											<td><if condition="$item.is_check eq '1'">开启<else/>关闭</if></td>
											<td class="button-column" nowrap="nowrap">
												<a href="{pigcms{:U('Card/members', array('id' => $vo['id']))}">会员卡管理</a> 
												|
												<a href="{pigcms{:U('Card/notice', array('id' => $vo['id']))}">会员通知</a>
												|
												<a href="{pigcms{:U('Card/exchange', array('id' => $vo['id']))}">积分设置</a> 
												|
												<a href="{pigcms{:U('Card/create', array('id' => $vo['id']))}">会员开卡</a> 

												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Card/design',array('id'=>$vo['id']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/delete',array('id'=>$vo['id']))}">
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
