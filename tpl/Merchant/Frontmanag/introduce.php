<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Frontmanag/index')}">商家管理</a>
			</li>
			<li class="active">商家描述管理</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.red{display:inline-block; font-size: 18px;margin-left: 70px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateShop()">发布内容</button><span class="red">温馨提示：前端最多只显示10条</span>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="7%">编号</th>
									<th width="7%">排序</th>
									<th width="50%">标题</th>
									<th width="10%">是否发布</th>
									<th width="10%">发布时间</th>
									<th style="text-align:center">操作</th>
								</tr>
							</thead>
							<tbody id="tbodyList">
								<if condition="$introduce">
									<volist name="introduce" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.id}</td>
											<td>{pigcms{$vo.sort}</td>
											<td>{pigcms{$vo.title}</td>
											<td style="color:red;"><if condition="$vo['isfabu'] eq 1">已发布<else/>未发布 / <a class="green" href="javascript:;" onclick="FaBu({pigcms{$vo['id']},$(this))">点击发布</a></if></td>
											<td>{pigcms{$vo.addtime|date="Y-m-d H:i:s",###}</td>
											<td class="button-column" nowrap="nowrap">
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Frontmanag/fbintroduce',array('id'=>$vo['id']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>
												<a title="删除" class="red" style="padding-right:8px;" href="javascript:;" onclick="DelItem({pigcms{$vo['id']},$(this));">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="11" >无内容</td></tr>
								</if>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

function CreateShop(){
  window.location.href = "{pigcms{:U('Frontmanag/fbintroduce')}";
}
function FaBu(vv,obj){
		$.ajax({
			url:"{pigcms{:U('Frontmanag/fbStatus')}",
			type:"post",
			data:{idx:vv},
			dataType:"JSON",
			success:function(ret){
			   if(!ret.error){
			      obj.parent('td').text('已发布');
			   }else{
			     alert('发布状态修改失败！');
			   }
			}
		});
	//window.location.href = "{pigcms{:U('Frontmanag/fbintroduce')}";
}
function DelItem(vv,obj){
	 if(confirm('您确认要删除吗?')){
		$.ajax({
			url:"{pigcms{:U('Frontmanag/delintroduce')}",
			type:"post",
			data:{idx:vv},
			dataType:"JSON",
			success:function(ret){
			   if(!ret.error){
				  if($('#tbodyList').size()==1){
				    window.location.href = "{pigcms{:U('Frontmanag/introduce')}";
				  }else{
			        obj.parent().parent('td').remove();
				  }
			   }else{
			     alert('删除失败！');
			   }
			}
		});
  }
}
</script>

<include file="Public:footer"/>
