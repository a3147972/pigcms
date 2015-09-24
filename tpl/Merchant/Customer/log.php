<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-group"></i>
			<li class="active">粉丝管理</li>
			<li><a href="{pigcms{:U('Customer/log')}">群发列表</a></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<a class="btn btn-success" href="{pigcms{:U('Customer/send')}">创建群发</a>
					<div class="grid-view" style="padding-top:5px;">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>发送内容</th>
									<th>发送对象</th>
									<th>创建时间</th>
									<th>发送状态</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$list">
									<volist name="list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.pigcms_id}</td>
											<td><a class="label label-sm label-info" href="{pigcms{:U('Customer/txtdetail',array('id'=>$vo['c_id']))}">查看发送内容</a></td>
											<td><a class="label label-sm label-info" href="{pigcms{:U('Customer/userdetail',array('logid'=>$vo['pigcms_id']))}">查看发送对象</a></td>
											<td>{pigcms{$vo.dateline|date='Y-m-d H:i:s',###}</td>
											<td>
											<if condition="$vo['status'] eq 0"><label class="btn btn-warning">审核中</label>
											<elseif condition="$vo['status'] eq 1" /><label class="btn btn-success">已发送</label>
											<else/><label class="btn btn-danger">被拒绝</label></if>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="10" >暂无粉丝！</td></tr>
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
		$('#group_id').change(function(){
			$('#frmselect').submit();
		});
	});
</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	$(function(){
		$('.view_img_frame').click(function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看大头像',
				padding: 0,
				width: 640,
				height: 643,
				lock: true,
				resize: false,
				background:'black',
				button: null,
				fixed: false,
				close: null,
				left: '50%',
				top: '38.2%',
				opacity:'0.4'
			});
			return false;
		});
	});
</script>
<include file="Public:footer"/>