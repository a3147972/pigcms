<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Adver/cat_modify')}" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">分类名称</th>
				<td><input type="text" class="input fl" name="cat_name" size="10" placeholder="请输入名称" validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">分类标识</th>
				<td><input type="text" class="input fl" name="cat_key" size="10" placeholder="分类标识" validate="maxlength:20,required:true" tips="如果是团购分类头部展示的广告，请填写<br/> cat_(分类ID)_top"/></td>
			</tr>
			<tr>
				<th width="80">分类类型</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>wap站</span><input type="radio" name="cat_type" value="0" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>pc站</span><input type="radio" name="cat_type" value="1" /></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>