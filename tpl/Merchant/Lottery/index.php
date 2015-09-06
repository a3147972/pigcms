<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-empire"></i>
				<a href="{pigcms{$url}">微活动</a>
			</li>
			<li class="active">{pigcms{$tips}列表</li>
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
					<button class="btn btn-success" onclick="CreateShop()">新增{pigcms{$tips}活动</button>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="50">编号</th>
									<th id="shopList_c1" width="100">活动名称</th>
									<th id="shopList_c1" width="100">关键字</th>
									<th id="shopList_c0" width="50">有效参与人数</th>
									<th id="shopList_c3" width="100">开始时间/结束时间</th>
									<th id="shopList_c1" width="100">状态</th>
									<th id="shopList_c11" width="180">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$list">
									<volist name="list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.id}</td>
											<td>{pigcms{$vo.title}</td>
											<td>{pigcms{$vo.keyword}</td>
											<td>{pigcms{$vo.joinnum}</td>
											<td>{pigcms{$vo.statdate|date='Y-m-d',###} / {pigcms{$vo.enddate|date='Y-m-d',###}</td>
											<td><if condition="$vo['status'] eq 0"><span class="red">未开始</span><elseif condition="$vo['status'] eq 2"/><span class="red">已经结束</span><else/><span class="green">已经开始</span></if></td>
											<td class="button-column" nowrap="nowrap">
											
											
											   <a href="{pigcms{:U($activeType .'/sn',array('id'=>$vo['id']))}">SN码管理</a>　
											   <if condition="$activeType neq 'Coupon' AND 0">
											   <a href="{pigcms{:U($activeType .'/cheat',array('id'=>$vo['id']))}">作弊</a> 
											   </if>
											   <a href="
											   <if condition="$vo['status'] eq 1">				   
											   javascript:drop_confirm('你确定要结束活动吗，结束后不可再开启本活动!', '{pigcms{:U($activeType .'/endLottery',array('id'=>$vo['id']))}');<else/>{pigcms{:U($activeType .'/startLottery',array('id'=>$vo['id']))}   
											   </if>">
											   <if condition="$vo['status'] eq 0">开始活动<else/>结束活动</if>				   
											   </a>　
				  
				   
				   
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U($activeType .'/edit',array('id'=>$vo['id']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U($activeType .'/del',array('id'=>$vo['id']))}">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
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
<script type="text/javascript">
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
function CreateShop(){
	window.location.href = "{pigcms{:U($activeType . '/add')}";
}
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>
