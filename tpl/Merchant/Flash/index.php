<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Classify/index')}">微网站</a>
			</li>
			<li class="active"><if condition="$tip eq 1">幻灯片<else />背景图</if>列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">新增<if condition="$tip eq 1">幻灯片<else />背景图</if></button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<if condition="$tip eq 1"><th id="shopList_c1" width="100">幻灯片描述</th></if>
									<th id="shopList_c1" width="100"><if condition="$tip eq 1">幻灯片<else />背景图</if>图片</th>
									<if condition="$tip eq 1"><th id="shopList_c3" width="100">幻灯片外链地址</th></if>
									<th id="shopList_c11" width="100">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$info">
									<volist name="info" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<if condition="$tip eq 1"><td>{pigcms{$vo.info}</td></if>
											<td><div class="cateimg" style="margin-left:13px"><img src="{pigcms{$vo.img}" class="cateimg_small" width="50" height="50"/></div></td>
											<if condition="$tip eq 1"><td>{pigcms{$vo.url}</td></if>
											<td class="button-column" nowrap="nowrap">
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Flash/edit',array('id'=>$vo['id'], 'tip'=>$vo['tip']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Flash/del',array('id'=>$vo['id']))}">
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
<script type="text/javascript">
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
function CreateShop(){
	window.location.href = "{pigcms{:U('Flash/add', array('tip' => $tip))}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
