<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Group/index')}">{pigcms{$config.group_alias_name}管理</a>
			</li>
			<li class="active">商品列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">添加商品</button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="120">编号</th>
									<th>名称（悬浮查看商品标题、图片）</th>
									<th>价格</th>
									<th>销售概览</th>
									<th>时间</th>
									<th>查看数</th>
									<th>评论数</th>
									<th>查看二维码</th>
									<th>运行状态</th>
									<th width="100">{pigcms{$config.group_alias_name}状态</th>
									<th width="200" style="text-align:center;">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$group_list">
									<volist name="group_list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.group_id}</td>
											<td><a href="{pigcms{$config.site_url}/index.php?g=Group&c=Detail&group_id={pigcms{$vo.group_id}" target="_blank" data-title="{pigcms{$vo.name}" data-pic="{pigcms{$vo.list_pic}" class="group_name">{pigcms{$vo.s_name}</a></td>
											<td>{pigcms{$config.group_alias_name}价：￥{pigcms{$vo.price}元<br/>原价：￥{pigcms{$vo.old_price}元</td>
											<td>售出：{pigcms{$vo.sale_count} 份<br/>库存： <if condition="$vo['count_num']">{pigcms{$vo.count_num}<else/>无限制</if><br/>虚拟：{pigcms{$vo.virtual_num} 人</td>
											<td>开始时间：{pigcms{$vo.begin_time|date='Y-m-d H:i:s',###}<br/>结束时间：{pigcms{$vo.end_time|date='Y-m-d H:i:s',###}<br/>{pigcms{$config.group_alias_name}券有效期：{pigcms{$vo.deadline_time|date='Y-m-d H:i:s',###}</td>
											<td>{pigcms{$vo.hits}</td>
											<td>{pigcms{$vo.reply_count}</td>
											<td><a href="{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=group&id={pigcms{$vo.group_id}&img=1" class="see_qrcode">查看二维码</a></td>
											<!--td><switch name="vo['type']"><case value="1">进行中，未开团</case><case value="2">进行中，已开团</case><case value="3">已结束，团购成功</case><case value="4">已结束，团购结束</case></switch></td-->
											<td>
												<if condition="$vo['begin_time'] gt $_SERVER['REQUEST_TIME']">
													未开团
												<elseif condition="$vo['end_time'] lt $_SERVER['REQUEST_TIME']"/>
													已结束
												<else/>
													进行中
												</if>
											</td>
											<td><switch name="vo['status']"><case value="0"><font color="red">关闭</font></case><case value="1"><font color="green">正常</font></case><case value="2"><font color="red">审核中</font></case></switch></td>
											<td style="text-align:center;"><a style="width: 60px;" class="label label-sm label-info" title="评论列表" href="{pigcms{:U('Message/group_reply',array('group_id'=>$vo['group_id']))}">评论列表</a>&nbsp;&nbsp;&nbsp;<a style="width: 60px;" class="label label-sm label-info" title="订单列表" href="{pigcms{:U('Group/order_list',array('group_id'=>$vo['group_id']))}">订单列表</a></td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="11" >您没有添加过商品！</td></tr>
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
	function CreateShop(){
		window.location.href = "{pigcms{:U('Group/add')}";
	}
	$(function(){
		$('.group_name').hover(function(){
			var top = $(this).offset().top;
			var left = $(this).offset().left+$(this).width()+10;
			$('body').append('<div id="group_name_div" style="position:absolute;z-index:5555;background:white;top:'+top+'px;left:'+left+'px;border:1px solid #ccc;padding:10px;"><div style="margin-bottom:10px;"><b>商品标题：</b>'+$(this).data('title')+'</div><div><b>商品图片：</b><img src="'+$(this).data('pic')+'" style="width:180px;"/></div></div>');
		},function(){
			$('#group_name_div').remove();
		});	
		$('.see_qrcode').click(function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看渠道二维码',
				padding: 0,
				width: 430,
				height: 433,
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
