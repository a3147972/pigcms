<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Slider/cat_amend')}" frame="true" refresh="true">
		<input type="hidden" name="cat_id" value="{pigcms{$now_category.cat_id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">分类名称</th>
				<td><input type="text" class="input fl" name="cat_name" value="{pigcms{$now_category.cat_name}" size="10" placeholder="请输入名称" validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">分类标识</th>
				<td><input type="text" class="input fl" name="cat_key" value="{pigcms{$now_category.cat_key}" size="10" placeholder="分类标识" validate="maxlength:15,required:true,english:true"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>