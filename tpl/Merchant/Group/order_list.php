<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-comments-o comments-o-icon"></i>
			<li class="active"><a href="{pigcms{:U('Group/index')}">{pigcms{$config.group_alias_name}列表</a></li>
			<li>{pigcms{$now_group.s_name}</li>
			<li>订单列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<form id="frmselect" method="get" action="" style="margin-bottom:0;">
					<input type="hidden" name="c" value="Group"/>
					<input type="hidden" name="a" value="order_list"/>
					<select id="group_id" name="group_id">
						<volist name="group_list" id="vo">
							<option value="{pigcms{$vo.group_id}" <if condition="$_GET['group_id'] eq $vo['group_id']">selected="selected"</if>>{pigcms{$vo.s_name}</option>
						</volist>
					</select>
				</form>
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>订单编号</th>
									<th>{pigcms{$config.group_alias_name}名称</th>
									<th>订单信息</th>
									<th>订单类型</th>
									<th>用户信息</th>
									<th>订单状态</th>
									<th class="button-column">操作</th>
								</tr>
							</thead>
							<tbody>
								<volist name="order_list" id="vo">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
										<td width="100">{pigcms{$vo.order_id}</td>
										<td width="200"><a href="{pigcms{$config.site_url}/index.php?g=Group&c=Detail&group_id={pigcms{$vo.group_id}" target="_blank">{pigcms{$vo.s_name}</a></td>
										<td width="150">
											数量：{pigcms{$vo.num}<br/>
											总价：{pigcms{$vo.total_money}<br/>
										</td>
										<td width="200">
											<switch name="vo['tuan_type']">
												<case value="0">{pigcms{$config.group_alias_name}券</case>
												<case value="1">代金券</case>
												<case value="2">实物</case>
											</switch>
										</td>
										<td width="200">
											用户ID：{pigcms{$vo.uid}<br/>
											用户名：{pigcms{$vo.nickname}<br/>
											<!--用户手机号：{pigcms{$vo.phone}<br/-->
											订单手机号：{pigcms{$vo.group_phone}<br/>
										</td>
										<td width="200">
										<if condition="$vo['status'] eq 3">
												<font color="red">已取消</font>
											<elseif condition="$vo['paid']" />
												<if condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])" >
													<font color="red">线下支付&nbsp;未付款</font>
												<elseif condition="$vo['status'] eq 0" />
													<font color="green">已付款</font>&nbsp;
													<php>if($vo['tuan_type'] != 2){</php>
														<font color="red">未消费</font>
													<php>}else{</php>
														<font color="red">未发货</font>
													<php>}</php>
												<elseif condition="$vo['status'] eq 1"/>
													<php>if($vo['tuan_type'] != 2){</php>
														<font color="green">已消费</font>
													<php>}else{</php>
														<font color="green">已发货</font>
													<php>}</php>&nbsp;
													<font color="red">待评价</font>
												<else/>
													<font color="green">已完成</font>
												</if>
											<else/>
												<font color="red">未付款</font>
											</if><br/>
											下单时间：{pigcms{$vo['add_time']|date='Y-m-d H:i:s',###}<br/>
											<if condition="$vo['paid']">付款时间：{pigcms{$vo['pay_time']|date='Y-m-d H:i:s',###}</if>
										</td>
										<td class="button-column" width="40">
											<a title="操作订单" class="green handle_btn" style="padding-right:8px;" href="{pigcms{:U('Group/order_detail',array('order_id'=>$vo['order_id']))}">
												<i class="ace-icon fa fa-search bigger-130"></i>
											</a>
										</td>
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
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
	$(function(){
		$('.handle_btn').live('click',function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'操作订单',
				padding: 0,
				width: 720,
				height: 520,
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
		
		$('#group_id').change(function(){
			$('#frmselect').submit();
		});
	});
</script>
<include file="Public:footer"/>
