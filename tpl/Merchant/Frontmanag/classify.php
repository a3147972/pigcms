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
			<li class="active">新建分类</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
		  <p class="red" style="font-size: 18px;">温馨提示：商家动态、商家相册 导航下最多显示10个分类</p>
			<div class="row">
				<div class="col-xs-12">
					<form enctype="multipart/form-data" class="form-horizontal" method="post">
					  <input  name="idx" type="hidden" value="{pigcms{$classify['id']}"/>
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="cyname">分类名称</label></label>
									<input class="col-sm-2" size="30" name="cyname" id="cyname" value="{pigcms{$classify['cyname']}" type="text" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>类型</label></label>
									<select name="typ" style="height: 35px;width: 220px;">
									<option value="0" <if condition="$classify['typ'] eq 0">selected="selected"</if>>商家动态</option>
									<option value="1" <if condition="$classify['typ'] eq 1">selected="selected"</if>>商家相册</option>
									</select>
								</div>
							<div class="form-group">
									<label class="col-sm-1"><label for="sort">排序</label></label>
									<input class="col-sm-2" size="20" name="sort" id="sort" type="text" value="{pigcms{$classify['sort']}" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
							</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit" onclick="$(this).attr('type','text')">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<include file="Public:footer"/>
