<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Classify/cat_amend')}" frame="true" refresh="true">
		<input type="hidden" name="cid" value="{pigcms{$now_category['cid']}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">分类名称</th>
				<td><input type="text" class="input fl" name="cat_name" id="cat_name" onBlur="TextSEO(this.value)" value="{pigcms{$now_category.cat_name}" size="25" placeholder="" validate="maxlength:20,required:true" tips=""/></td>
			</tr>
			<tr>
				<th width="80">短标记(url)</th>
				<td><input type="text" class="input fl" name="cat_url" id="cat_url" value="{pigcms{$now_category.cat_url}" size="25" placeholder="英文或数字" validate="maxlength:20,required:true,en_num:true" tips="只能使用英文或数字，用于网址（url）中的标记！建议使用分类的拼音"/></td>
			</tr>
			<tr>
				<th width="80">是否热门</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$now_category['is_hot'] eq 1">selected</if>"><span>是</span><input type="radio" name="is_hot" value="1" <if condition="$now_category['is_hot'] eq 1">checked="checked"</if>/></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_category['is_hot'] eq 0">selected</if>"><span>否</span><input type="radio" name="is_hot" value="0"  <if condition="$now_category['is_hot'] eq 0">checked="checked"</if> /></label></span>
					<em class="notice_tips" tips="如果选择热门，颜色会有变化"></em>
				</td>
			</tr>
			<if condition="$now_category['subdir'] neq 3">
			<tr>
				<th width="80">分类排序</th>
				<td><input type="text" class="input fl" name="cat_sort" value="{pigcms{$now_category.cat_sort}" size="10" placeholder="分类排序" validate="maxlength:6,required:true,number:true" tips="默认添加时间排序！手动排序数值越大，排序越前。"/></td>
			</tr>

			<tr>
				<th width="80">分类状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$now_category['cat_status'] eq 1">selected</if>"><span>启用</span><input type="radio" name="cat_status" value="1"  <if condition="$now_category['cat_status'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_category['cat_status'] eq 0">selected</if>"><span>关闭</span><input type="radio" name="cat_status" value="0"  <if condition="$now_category['cat_status'] eq 0">checked="checked"</if> /></label></span>
				</td>
			</tr>
			</if>
			<if condition="$now_category['subdir'] eq 2">
				<tr>
				<th width="80">允许发布时上传图片</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$now_category['isupimg'] eq 1">selected</if>"><span>允许</span><input type="radio" name="isupimg" value="1" <if condition="$now_category['isupimg'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_category['isupimg'] eq 0">selected</if>"><span>不允许</span><input type="radio" name="isupimg" value="0" <if condition="$now_category['isupimg'] eq 0">checked="checked"</if>/></label></span>
				</td>
			</tr>
			</if>
		<tr><th width="80">SEO标题：</th>
		<td><input type="text" tips="一般不超过80个字符！" validate="" style="width:260px;"  id="seo_title" name="seo_title" class="input fl" value="{pigcms{$now_category.seo_title}"></td></tr>
		<tr><th width="80">SEO关键词：</th><td><input type="text" tips="一般不超过100个字符！" validate="" style="width:260px;"  id="seo_keywords" name="seo_keywords" class="input fl" value="{pigcms{$now_category.seo_keywords}"></td></tr>
		<tr><th width="80">SEO描述：</th><td><textarea tips="一般不超过200个字符！" validate="" id="seo_description" name="seo_description" style="width:250px;height:90px;">{pigcms{$now_category.seo_description}</textarea></td></tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>
<script type="text/javascript">
function TextSEO(vv){
   vv=$.trim(vv);
   if(vv){
     var seo_title=$.trim($('#seo_title').val());
	 var seo_keywords=$.trim($('#seo_keywords').val());
	 var seo_description=$.trim($('#seo_description').val());
	 if(!seo_title) $('#seo_title').val(vv);
	 if(!seo_keywords) $('#seo_keywords').val(vv);
	 if(!seo_description) $('#seo_description').val(vv);
   }
}
</script>