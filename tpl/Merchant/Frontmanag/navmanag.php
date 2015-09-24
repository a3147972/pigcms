<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Frontmanag/index')}">商家管理</a>
			</li>
			<li class="active">商家导航管理</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.red{display:inline-block; font-size: 18px;margin-left: 70px;}
				.navname input{margin-left: 30px;display:none;}
				.navname a{margin-left: 30px;padding-right:8px;}
				#tbodyList tr{height:55px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
				<span class="red">温馨提示：前端商家中心导航，可控制显示与否</span>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="7%">编号</th>
									<th width="30%">导航名</th>
									<th>是否显示</th>
								</tr>
							</thead>
							<tbody id="tbodyList">
								<if condition="$navmanag">
									<volist name="navmanag" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.navid}</td>
											<td class="navname"><span>{pigcms{$vo.zhname}</span><input type="text" value="{pigcms{$vo.zhname}">
											<a title="修改" class="green" href="javascript:;" onclick="ModifyNav($(this),{pigcms{$vo.navid},0)">
											<i class="ace-icon fa fa-pencil bigger-130"></i><span> 修改导航名</span>
											</a>
											</td>
											<td><span style="color:red;"><if condition="$vo['isshow'] eq 1">显示<else/>隐藏</if></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="green" href="javascript:;" onclick="ChangS({pigcms{$vo['navid']},{pigcms{$vo['isshow']},$(this))">点击切换</a><if condition="$vo['iscontent'] gt 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Frontmanag/fbcontent',array('navid'=>$vo['navid']))}">
											<i class="ace-icon fa fa-pencil bigger-130"></i> 修改内容
											</a></if></td>
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

function ChangS(vv,s,obj){
		$.ajax({
			url:"{pigcms{:U('Frontmanag/upnavS')}",
			type:"post",
			data:{idx:vv,num:s},
			dataType:"JSON",
			success:function(ret){
			   if(!ret.error){
			      obj.siblings('span').text(ret.msg);
			   }else{
			     alert('状态修改失败！');
			   }
			}
		});
	
}

function ModifyNav(obj,nid,s){
   if(s==1){
      var navname=obj.siblings('input').val();
	  navname=$.trim(navname);
	  if(navname){
		$.ajax({
			url:"{pigcms{:U('Frontmanag/upnavN')}",
			type:"post",
			data:{idx:nid,navm:navname},
			dataType:"JSON",
			success:function(ret){
			   if(!ret.error){
				  obj.siblings('input').val(navname).hide();
				  obj.attr("onclick",'ModifyNav($(this),'+nid+',0)');
				  obj.siblings('span').text(navname);
				  obj.find('span').text(' 修改导航名');
			   }else{
			     alert(ret.msg);
			   }
			}
		});
	  }else{
	   alert('导航名不能为空！');
	  }
   }else{
      obj.siblings('input').show();
	  obj.attr("onclick",'ModifyNav($(this),'+nid+',1)');
	  obj.find('span').text(' 保存修改');
   }
}
/*function DelItem(vv,obj){
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
}*/
</script>

<include file="Public:footer"/>
