<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Area/modify')}" frame="true" refresh="true">
		<input type="hidden" name="area_type" value="{pigcms{$_GET['type']}"/>
		<input type="hidden" name="area_pid" value="{pigcms{$_GET['pid']}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">名称</th>
				<td><input type="text" class="input fl" name="area_name" id="area_name" size="20" placeholder="请输入名称" validate="maxlength:30,required:true"/></td>
			</tr>
			<if condition="$_GET['type'] eq 2 || $_GET['type'] eq 4">
				<tr>
					<th width="80">首字母</th>
					<td><input type="text" class="input fl" name="first_pinyin" id="first_pinyin" size="20" placeholder="" validate="maxlength:20,required:true" tips="名称第一个字符的小写首字母！输入名称后，若此字段为空，会自动填写（仅作为示例）"/></td>
				</tr>
			</if>
			<if condition="$_GET['type'] gt 1">
				<tr>
					<th width="80">网址标识</th>
					<td><input type="text" class="input fl" name="area_url" id="area_url" size="20" placeholder="" validate="maxlength:20,required:true" tips="一般为地区名称的小写首字母！输入名称后，若此字段为空，会自动填写（仅作为示例）"/></td>
				</tr>
			</if>
			<if condition="$_GET['type'] gt 1 && $_GET['type'] lt 4">
				<tr>
					<th width="80">IP标识</th>
					<td><input type="text" class="input fl" name="area_ip_desc" size="20" placeholder="" validate="maxlength:30,required:true" tips="一般格式为 XX省XX市XX区(县)"/></td>
				</tr>
			</if>
			<tr>
				<th width="80">排序</th>
				<td><input type="text" class="input fl" name="area_sort" size="10" value="0" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
			</tr>
			<tr>
				<th width="80">状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>显示</span><input type="radio" name="is_open" value="1" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>隐藏</span><input type="radio" name="is_open" value="0" /></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<script type="text/javascript">
		get_first_word('area_name','area_url','first_pinyin');
	</script>
<include file="Public:footer"/>