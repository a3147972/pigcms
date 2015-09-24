<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-empire"></i>
				商家推广
			</li>
			<li class="active"><a href="{pigcms{:U('Activity/index')}">平台活动列表</a></li>
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
					<button class="btn btn-success" onclick="CreateShop()">创建活动</button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="50">编号</th>
									<th id="shopList_c1" width="50">类别</th>
									<th id="shopList_c1" width="100">活动名称</th>
									<th id="shopList_c0" width="50">总商品数量</th>
									<th id="shopList_c0" width="50">已参与数量</th>
									<th id="shopList_c0" width="50">所需金钱</th>
									<th id="shopList_c0" width="50">所需积分</th>
									<th id="shopList_c3" width="100">开始时间/结束时间</th>
									<th id="shopList_c1" width="100">状态</th>
									<th id="shopList_c11" width="50">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$activity_list">
									<volist name="activity_list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.pigcms_id}</td>
											<td>{pigcms{$vo.type_txt}</td>
											<td title="{pigcms{$vo.title}">{pigcms{$vo.name}</td>
											<td>{pigcms{$vo.all_count}</td>
											<td>{pigcms{$vo.part_count}</td>
											<td>{pigcms{$vo.money}</td>
											<td>{pigcms{$vo.mer_score}</td>
											<td>{pigcms{$vo.begin_time|date='Y-m-d H:i',###} / {pigcms{$vo.end_time|date='Y-m-d H:i',###}</td>
											<td><if condition="$vo['status'] eq 0"><span class="red">待审核</span><elseif condition="$vo['status'] eq 2"/><span class="red">已结束</span><else/><span class="green">进行中</span></if></td>
											<td class="button-column" nowrap="nowrap">
												<!--a href="<if condition="$vo['status'] eq 1">				   
											   javascript:drop_confirm('你确定要结束活动吗，结束后不可再开启本活动!', '{pigcms{:U($activeType .'/endLottery',array('id'=>$vo['id']))}');<else/>{pigcms{:U($activeType .'/startLottery',array('id'=>$vo['id']))}   
											   </if>">
											   <if condition="$vo['status'] eq 0">开始活动<else/>结束活动</if>				   
											   </a-->　
												<if condition="$vo['status'] eq 2">
													<a title="查看获奖人信息" class="green yiyuan_handle_btn" style="padding-right:8px;" href="{pigcms{:U('Activity/yiyuanduobao',array('id'=>$vo['pigcms_id']))}">
														<i class="ace-icon fa fa-search bigger-130"></i>
													</a>
												</if>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
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
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
	$(function(){
		$('.yiyuan_handle_btn').live('click',function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看获奖人信息',
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
				opacity:'0.4',
			});
			return false;
		});
		
		$('#group_id').change(function(){
			$('#frmselect').submit();
		});
	});
	function CreateShop(){
		window.location.href = "{pigcms{:U('Activity/add')}";
	}
</script>
<include file="Public:footer"/>
