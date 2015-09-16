<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-group"></i>
			<li class="active">粉丝管理</li>
			<li><a href="{pigcms{:U('Customer/log')}">群发列表</a></li>
			<li>群发对象详情</li>
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
									<th>会员ID</th>
									<th>会员昵称</th>
									<th>手机号</th>
									<th>性别</th>
									<th>省(直辖市)</th>
									<th>城市</th>
									<th>头像</th>
									<th>发送状态</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$fans_list">
									<volist name="fans_list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.uid}</td>
											<td>{pigcms{$vo.nickname}</td>
											<td>{pigcms{$vo.phone}</td>
											<td><switch name="vo['sex']"><case value="1">男</case><case value="2">女</case><default/>未知</switch></td>
											<td>{pigcms{$vo.province}</td>
											<td>{pigcms{$vo.city}</td>
											<td><if condition="$vo['avatar']"><a href="{pigcms{$vo.avatar}" target="_blank" class="view_img_frame"><img src="{pigcms{$vo.avatar}" style="width:50px;" /></a></if></td>
											<td>
											<if condition="$vo['status'] eq 0"><label class="btn btn-warning">等待发送</label>
											<elseif condition="$vo['status'] eq 1" /><label class="btn btn-success">已发送</label>
											<else/><label class="btn btn-danger">发送失败</label></if>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="8" >暂无粉丝！</td></tr>
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
