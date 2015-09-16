<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Meal/index')}">{pigcms{$config.meal_alias_name}管理</a>
			</li>
			<li class="active"><a href="{pigcms{:U('Meal/meal_sort',array('store_id'=>$now_store['store_id']))}">{pigcms{$now_store.name}</a></li>
			<li class="active">编辑分类</li>
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
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">				
							<li class="active">
								<a href="{pigcms{:U('Meal/sort_edit',array('sort_id'=>$now_sort['sort_id']))}">编辑分类</a>
							</li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-sm-1"><label for="sort_name">分类名称</label></label>
									<input class="col-sm-2" size="20" name="sort_name" id="sort_name" type="text" value="{pigcms{$now_sort.sort_name}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">店铺排序</label></label>
									<input class="col-sm-1" size="10" name="sort" id="sort" type="text" value="{pigcms{$now_sort.sort|default='0'}"/>
									<span class="form_tips">默认添加顺序排序！手动调值，数值越大，排序越前</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="is_weekshow">是否开启只星期几显示</label>
									<select name="is_weekshow" id="is_weekshow">
										<option value="0" <if condition="$now_sort['is_weekshow'] eq 0">selected="selected"</if>>关闭</option>
										<option value="1" <if condition="$now_sort['is_weekshow'] eq 1">selected="selected"</if>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="FoodType_week">星期几显示</label>
									<div class="col-sm-10" style="margin-top:5px;">
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="1" name="week[]" <if condition="in_array('1',$now_sort['week'])">checked="checked"</if>/>星期一</label>&nbsp;&nbsp;
										</div>
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="2" name="week[]" <if condition="in_array('2',$now_sort['week'])">checked="checked"</if>/>星期二</label>&nbsp;&nbsp;
										</div>
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="3" name="week[]" <if condition="in_array('3',$now_sort['week'])">checked="checked"</if>/>星期三</label>&nbsp;&nbsp;
										</div>
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="4" name="week[]" <if condition="in_array('4',$now_sort['week'])">checked="checked"</if>/>星期四</label>&nbsp;&nbsp;
										</div>
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="5" name="week[]" <if condition="in_array('5',$now_sort['week'])">checked="checked"</if>/>星期五</label>&nbsp;&nbsp;
										</div>
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="6" name="week[]" <if condition="in_array('6',$now_sort['week'])">checked="checked"</if>/>星期六</label>&nbsp;&nbsp;
										</div>
										<div style="width:80px;float:left;font-size:16px;">
											<label><input type="checkbox" value="0" name="week[]" <if condition="in_array('0',$now_sort['week'])">checked="checked"</if>/>星期日</label>&nbsp;&nbsp;
										</div>
									</div>
								</div>
								<if condition="$ok_tips">
									<div class="form-group" style="margin-left:0px;">
										<span style="color:blue;">{pigcms{$ok_tips}</span>				
									</div>
								</if>
								<if condition="$error_tips">
									<div class="form-group" style="margin-left:0px;">
										<span style="color:red;">{pigcms{$error_tips}</span>				
									</div>
								</if>
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											保存
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<include file="Public:footer"/>
