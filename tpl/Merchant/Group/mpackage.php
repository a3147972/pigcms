<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Group/index')}">{pigcms{$config.group_alias_name}管理</a>
			</li>
			<li class="active">{pigcms{$config.group_alias_name}套餐管理列表</li>
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
					<button class="btn btn-success" onclick="CreatePackage()">新建一个套餐</button>
					<span class="red" style="margin-left:30px;">在这里建立一个套餐标示，然后将某几个团购加入到同一个套餐里标示里，他们就属于一个套餐了</span>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="120">编号</th>
									<th>套餐名称</th>
									<th>简短描述</th>
								</tr>
							</thead>
							<tbody>
								<if condition="!empty($mpackagelist)">
									<volist name="mpackagelist" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.id}</td>
											<td>{pigcms{$vo.title}</td>
											<td>{pigcms{$vo.description}</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="4" >您还没有套餐！</td></tr>
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
	function CreatePackage(){
		window.location.href = "{pigcms{:U('Group/mpackageadd')}";
	}

</script>
<include file="Public:footer"/>
