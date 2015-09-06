<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Classify/index')}">微网站</a>
			</li>
			<li class="active">分类列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">新增分类</button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="100">分类名称</th>
									<th id="shopList_c1" width="100">显示顺序</th>
									<th id="shopList_c0" width="50">分类图片</th>
									<th id="shopList_c3" width="100">外链网站或活动</th>
									<th id="shopList_c1" width="100">首页显示</th>
									<th id="shopList_c1" width="100">子分类</th>
									<th id="shopList_c11" width="180" class="button-column">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$info">
									<volist name="info" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.name}</td>
											<td>{pigcms{$vo.sorts}</td>
											<td><div class="cateimg" style="margin-left:13px"><img src="{pigcms{$vo.img}" class="cateimg_small" width="50" height="50"/></div></td>
											<td>{pigcms{$vo.url}</td>
											<td><if condition="$vo['status'] eq 0">不显示<else/>显示</if></td>
											<td><a href="{pigcms{:U('Classify/index',array('fid'=>$vo['id']))}">子分类</a></td>
											<td class="button-column" nowrap="nowrap">
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Classify/edit',array('id'=>$vo['id'], 'fid'=>$vo['fid']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Classify/del',array('id'=>$vo['id']))}">
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
	window.location.href = "{pigcms{:U('Classify/add', array('fid' => $fid))}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
