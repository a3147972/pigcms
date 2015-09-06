<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={:C('DEFAULT_CHARSET')}" />
		<title>网站后台管理 Powered by pigcms.com</title>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/styles.css">
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE')}"></script>
		<link rel="stylesheet" href="{pigcms{$static_path}css/bootstrap.min.css">
		<link rel="stylesheet" href="{pigcms{$static_path}css/font-awesome.min.css">
		<link rel="stylesheet" href="{pigcms{$static_path}css/ace.min.css" id="main-ace-style">
		<link rel="stylesheet" href="{pigcms{$static_path}css/ace-skins.min.css">
		<link rel="stylesheet" href="{pigcms{$static_path}css/ace-rtl.min.css">
	</head>
	<body width="100%" <if condition="$bg_color">style="background:{pigcms{$bg_color};"</if>>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li class="active">商家相册管理</li>
			<li class="active">商家相册详情</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.red{display:inline-block; font-size: 18px;margin-left: 70px;}
				 td,th {text-align: center;}
				.lastimg img{height: 200px;}
				.lastimg div{  font-size: 16px;margin-top: 10px;}
				.lastimg a{  font-size: 16px;left: 100px;position: relative;}
				.ke-dialog-row .ke-input-text{height: 35px;}
				.pagediv .summary,.pagediv  .pager{ text-align: center;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="50%">图片</th>
									<th width="50%">图片</th>
								</tr>
							</thead>
						<tbody id="tbodyList">
							<if condition="!empty($imgs)">
							<volist name="imgs" id="vo">
							<php>if($mod==0)echo "<tr>";</php>
							<td class="lastimg"><img  src="{pigcms{$config.site_url}/{pigcms{$vo.imgstr}"><div>{pigcms{$classify[$vo['cyid']]}<a href="javascript:;" onclick="DelItem({pigcms{$vo['id']},$(this));"> 删 除 </a></div></td>
							<php>if($mod==1)echo "</tr>";</php>
							</volist>
							<else/>
								<tr class="odd"><td class="button-column" colspan="3" >无内容</td></tr>
							</if>
						</tbody>
						</table>
						<div class="pagediv">
						{pigcms{$pagebar}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function DelItem(vv,obj){
	 if(confirm("您确定要删除吗？")){
		$.ajax({
			url:"{pigcms{:U('Frontmanag/delImg')}",
			type:"post",
			data:{idx:vv},
			dataType:"JSON",
			success:function(ret){
			   if(!ret.error){
			      obj.parent('div').parent('td').remove();
			   }else{
			     alert('删除失败！');
			   }
			}
		});
  }
}
</script>
<include file="Public:footer"/>
