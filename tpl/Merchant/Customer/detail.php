<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-comments-o comments-o-icon"></i>
			<li class="active">顾客管理</li>
			<li><a href="{pigcms{:U('Customer/fans_list')}">粉丝列表</a></li>
			<li class="active">粉丝行为统计</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="alert alert-info" style="margin-top:5px;margin-bottom:0px;">
					<b>昵称：{pigcms{$now_user.nickname}&nbsp;&nbsp;&nbsp;&nbsp;手机号：{pigcms{$now_user.phone}</b>
					<br/>
					关注时间：{pigcms{$now_user.dateline|date='Y-m-d H:i:s',###}&nbsp;&nbsp;&nbsp;&nbsp;最后登录：{pigcms{$now_user.last_time|date='Y-m-d H:i:s',###}
				</div>
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<if condition="$_GET['page'] lt 2">
						<div class="widget-box">
							<div class="widget-header">
								<h5>统计图</h5>
							</div>
							<div class="widget-body" id="main" style="text-align:center;"></div>
							<script type="text/javascript" src="{pigcms{$static_public}fushionCharts/FusionCharts.js"></script>
							<script type="text/javascript">
								var chart = new FusionCharts("{pigcms{$static_public}fushionCharts/Pie3D.swf", "ChartId", "600", "500", "0", "1");
								chart.setDataXML('<chart borderThickness="0" caption="粉丝行为统计分析" baseFontColor="666666" baseFont="宋体" baseFontSize="14" bgColor="FFFFFF" bgAlpha="0" showBorder="0" bgAngle="360" pieYScale="90"  pieSliceDepth="5" smartLineColor="666666"><volist name="chart_list" id="vo"><set label="{pigcms{$vo.name}" value="{pigcms{$vo.count}"/></volist></chart>');
								chart.render("main");
							</script>
						</div>
						<div class="alert alert-danger" style="margin-top:5px;margin-bottom:0px;">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							只有在微信端的行为才会被统计。
						</div>
					</if>
					<div class="grid-view" style="padding-top:5px;">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>行为编号</th>
									<th>事件名</th>
									<th>发生时间</th>
									<th>关键词</th>
									<th>相关链接</th>
								</tr>
							</thead>
							<tbody>
								<volist name="behavior_list" id="vo">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
										<td>{pigcms{$vo.pigcms_id}</td>
										<td>{pigcms{$vo.name}</td>
										<td>{pigcms{$vo.date|date='Y-m-d H:i:s',###	}</td>
										<td>{pigcms{$vo.keyword}</td>
										<td><if condition="$vo['url']"><a href="{pigcms{$vo.url}" target="_blank">访问链接</a></if></td>
									</tr>
								</volist>
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
<include file="Public:footer"/>
