<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-group"></i>
			<li class="active">粉丝管理</li>
			<li><a href="{pigcms{:U('Customer/log')}">群发列表</a></li>
			<li>群发内容详情</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<div class="grid-view" style="padding-top:5px;">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>标题</th>
									<th>简介</th>
									<th>封面图</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$image_text">
									<volist name="image_text" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.pigcms_id}</td>
											<td><a href="{pigcms{$config['site_url']}/wap.php?c=Article&a=index&imid={pigcms{$vo['pigcms_id']}" target="_blank">{pigcms{$vo['title']}</a></td>
											<td>{pigcms{$vo.digest}</td>
											<td><img src="{pigcms{$vo.cover_pic}" style="width:70px;height:70px" /></td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="4" >暂无内容！</td></tr>
								</if>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<include file="Public:footer"/>
