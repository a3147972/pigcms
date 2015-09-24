<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-group"></i>
			<li class="active">粉丝管理</li>
			<li><a href="{pigcms{:U('Customer/service')}">客服列表</a></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<a class="btn btn-success" href="{pigcms{:U('Customer/add')}">创建客服</a>
					<div class="grid-view" style="padding-top:5px;">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>客服名称</th>
									<th>头像</th>
									<th>创建时间</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$services">
									<volist name="services" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.pigcms_id}</td>
											<td>{pigcms{$vo.nickname}</td>
											<td><img alt="{pigcms{$vo.nickname}" src="{pigcms{$vo.head_img}" height="80"></td>
											<td>{pigcms{$vo.dateline|date='Y-m-d H:i:s',###}</td>
											<td align="center">
											
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Customer/add',array('pigcms_id'=>$vo['pigcms_id']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Customer/del',array('pigcms_id' => $vo['pigcms_id']))}">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="5" >暂无客服！</td></tr>
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