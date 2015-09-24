<include file="Public:header"/>
	<div id="nav" class="mainnav_title">
		<ul>
			<a href="{pigcms{:U('Group/cat_field_add',array('cat_id'=>$_GET['cat_id'],'type'=>'0'))}" <if condition="$_GET['type'] eq 0">class="on"</if>>自定义字段</a>|
			<a href="{pigcms{:U('Group/cat_field_add',array('cat_id'=>$_GET['cat_id'],'type'=>'1'))}" <if condition="$_GET['type'] eq 1">class="on"</if>>选择内置字段</a>
		</ul>
	</div>
	<form id="myform" method="post" action="{pigcms{:U('Group/cat_field_modify')}" frame="true" refresh="true">
		<input type="hidden" name="cat_id" value="{pigcms{$_GET.cat_id}"/>
		<if condition="$_GET['type'] eq 0">
			<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
				<tr>
					<th width="80">字段名称</th>
					<td><input type="text" class="input fl" name="name" id="name" size="25" placeholder="" validate="maxlength:20,required:true" tips=""/></td>
				</tr>
				<tr>
					<th width="80">短标记(url)</th>
					<td><input type="text" class="input fl" name="url" id="url" size="25" placeholder="英文或数字" validate="maxlength:20,required:true,en_num:true" tips="只能使用英文或数字，用于网址（url）中的标记！建议使用字段的拼音"/></td>
				</tr>
				<tr>
					<th width="80">字段候选值</th>
					<td><textarea class="input fl" style="width:175px;height:54px;" name="value" tips="一行一个，将通过下拉框的模式展示候选。"></textarea></td>
				</tr>
				<!--tr>
					<th width="80">显示排序</th>
					<td><input type="text" class="input fl" name="sort" value="0" size="10" placeholder="显示排序" validate="maxlength:6,required:true,number:true" tips="默认添加时间排序！手动排序数值越大，排序越前。"/></td>
				</tr-->
				<tr>
					<th width="80">字段类型</th>
					<td>
						<select name="type">
							<option value="0">单选</option>
							<option value="1">多选</option>
						</select>
					</td>
				</tr>
				<!--tr>
					<th width="80">字段状态</th>
					<td>
						<span class="cb-enable"><label class="cb-enable selected"><span>显示</span><input type="radio" name="status" value="1" checked="checked" /></label></span>
						<span class="cb-disable"><label class="cb-disable"><span>隐藏</span><input type="radio" name="status" value="0" /></label></span>
					</td>
				</tr-->
			</table>
		<else/>
			<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
				<tr>
					<th width="80">选择字段</th>
					<td>
						<select name="use_field">
							<option value="area">地区商圈</option>
							<!--option value="price">价格</option-->
						</select>
					</td>
				</tr>
				<tr>
					<th width="80">字段排序</th>
					<td><input type="text" class="input fl" name="sort" value="0" size="10" placeholder="分类排序" validate="maxlength:6,required:true,number:true" tips="默认添加时间排序！手动排序数值越大，排序越前。"/></td>
				</tr>
				<tr>
					<th width="80">字段状态</th>
					<td>
						<span class="cb-enable"><label class="cb-enable selected"><span>显示</span><input type="radio" name="status" value="1" checked="checked" /></label></span>
						<span class="cb-disable"><label class="cb-disable"><span>隐藏</span><input type="radio" name="status" value="0" /></label></span>
					</td>
				</tr>
			</table>
		</if>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>