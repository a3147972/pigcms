<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Express/amend')}" frame="true" refresh="true">
		<input type="hidden" name="id" value="{pigcms{$express.id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">名称</th>
				<td><input type="text" class="input fl" name="name" size="20" placeholder="请输入名称" value="{pigcms{$express.name}" validate="maxlength:50,required:true"/></td>
			</tr>
			<tr>
				<th width="80">编码</th>
				<td><input type="text" class="input fl" name="code" size="20" placeholder="请输入编码" value="{pigcms{$express.code}" validate="maxlength:50,required:true,english:true" tips="以 快递100网 的快递公司编码为准，请填写准确，否则用户和商家用不了快递查询。"/></td>
			</tr>
			<tr>
				<th width="80">网址</th>
				<td><input type="text" class="input fl" name="url" size="30" placeholder="请输入网址" value="{pigcms{$express.url}" validate="required:true,url:true"/></td>
			</tr>
			<tr>
				<th width="80">排序</th>
				<td><input type="text" class="input fl" name="sort" size="10" value="{pigcms{$express.sort}" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
			</tr>
			<tr>
				<th width="80">状态</th>
				<td class="radio_box">
					<span class="cb-enable"><label class="cb-enable <if condition="$express['status'] eq 1">selected</if>"><span>启用</span><input type="radio" name="status" value="1" <if condition="$express['status'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$express['status'] eq 0">selected</if>"><span>关闭</span><input type="radio" name="status" value="0" <if condition="$express['status'] eq 0">checked="checked"</if> /></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>