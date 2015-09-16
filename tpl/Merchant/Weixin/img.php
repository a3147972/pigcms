<include file="Public:header" />
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li><i class="ace-icon fa fa-wechat"></i> <a
				href="{pigcms{:U('Weixin/index')}">公众号设置</a></li>
			<li>关键词回复</li>
			<li class="active">图文回复</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
			.ace-file-input a {
				display: none;
			}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li><a href="{pigcms{:U('Weixin/txt')}">文字回复</a></li>
							<li  class="active"><a href="{pigcms{:U('Weixin/img')}">图文回复</a></li>
							<!--li><a href="">系统功能回复</a></li-->
						</ul>
							<div class="tab-content">
							<div>
							<a href="{pigcms{:U('Weixin/reply_img')}" class="btn btn-success">新建图文回复</a>
							</div>
							<div id="yw0" class="grid-view">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th id="yw0_c0">关键词</th>
									<th id="yw0_c2">图文标题</th>
									<th class="button-column" id="yw0_c3">&nbsp;</th>
								</tr>
								</thead>
								<tbody id="shopList">
								<if condition="$lists">
									<volist name="lists" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo['content']}</td>
											<td>
											<volist name="vo['list']" id="row">
											{pigcms{$row['title']} <br/>
											</volist>
											</td>
											<td nowrap="nowrap" class="center">
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Weixin/reply_img',array('pigcms_id'=>$vo['pigcms_id']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Weixin/del_img',array('pigcms_id'=>$vo['pigcms_id']))}">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="3" >无内容</td></tr>
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
<include file="Public:footer" />