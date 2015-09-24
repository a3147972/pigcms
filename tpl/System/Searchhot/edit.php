<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Searchhot/amend')}" frame="true" refresh="true">
		<input type="hidden" name="id" value="{pigcms{$search_hot.id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">关键词</th>
				<td><input type="text" class="input fl" name="name" size="20" placeholder="请输入关键词" value="{pigcms{$search_hot.name}" validate="maxlength:50,required:true"/></td>
			</tr>
			<tr>
				<th width="80">网址</th>
				<td><input type="text" class="input fl" name="url" size="30" placeholder="可不填写" value="{pigcms{$search_hot.url}" validate="url:true" tips="可以为空，默认为搜索该关键词"/></td>
			</tr>
			<tr>
				<th width="80">类型</th>
				<td>
					<select name="type">
						<option value="0" <if condition="$search_hot['type'] eq 0">selected="selected"</if>>{pigcms{$config.group_alias_name}</option>
						<option value="1" <if condition="$search_hot['type'] eq 1">selected="selected"</if>>{pigcms{$config.meal_alias_name}</option>
					</select>
					<em tips="如果填写了网址，选择类型不会影响生成的网址。" class="notice_tips"></em>
			</tr>
			<tr>
				<th width="80">链接排序</th>
				<td><input type="text" class="input fl" name="sort" size="10" value="{pigcms{$search_hot.sort}" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>