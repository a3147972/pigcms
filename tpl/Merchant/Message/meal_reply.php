<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-comments-o comments-o-icon"></i>
			<li class="active">顾客交流</li>
			<li><a href="{pigcms{:U('Message/meal_reply')}">{pigcms{$config.meal_alias_name}评论</a></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<form id="frmselect" method="get" action="" style="margin-bottom:0;">
					<input type="hidden" name="c" value="Message"/>
					<input type="hidden" name="a" value="meal_reply"/>
					<select id="group_id" name="store_id">
						<option value="all">全部店铺</option>
						<volist name="store_list" id="vo">
							<option value="{pigcms{$vo.store_id}" <if condition="$_GET['store_id'] eq $vo['store_id']">selected="selected"</if>>{pigcms{$vo.name}</option>
						</volist>
					</select>
				</form>
				<div class="col-xs-12" style="padding-left:0px;padding-right:0px;">
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="70">顾客ID</th>
									<th width="190">订单号</th>
									<th>评论内容</th>
									<th width="150">评论时间</th>
									<th width="80">评论打分</th>
									<th width="80">是否回复</th>
									<th class="button-column">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$reply_list">
									<volist name="reply_list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.uid}</td>
											<td>{pigcms{$vo.order_id}</td>
											<td>{pigcms{$vo.comment|msubstr=###,0,50}</td>
											<td>{pigcms{$vo.add_time|date='Y-m-d H:i:s',###}</td>
											<td>{pigcms{$vo.score}</td>
											<td><if condition="$vo['merchant_reply_time']">已回复<else/>未回复</if></td>
											<td><a style="width: 60px;" class="label label-sm label-info" title="评论列表" href="{pigcms{:U('Message/meal_reply_detail',array('id'=>$vo['pigcms_id']))}">评论详情</a></td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="7" >暂无评论！</td></tr>
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
<include file="Public:footer"/>
