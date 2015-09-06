<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Flink/modify')}" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">链接名称</th>
				<td><input type="text" class="input fl" name="name" size="20" placeholder="请输入名称" validate="maxlength:50,required:true"/></td>
			</tr>
			<tr>
				<th width="80">链接描述</th>
				<td><input type="text" class="input fl" name="info" size="30" placeholder="可不填写" tips="描述将显示在链接的title属性中，鼠标放在链接上会显示"/></td>
			</tr>
			<tr>
				<th width="80">链接网址</th>
				<td><input type="text" class="input fl" name="url" size="30" placeholder="请输入网址" validate="required:true,url:true"/></td>
			</tr>
			<tr>
				<th width="80">链接排序</th>
				<td><input type="text" class="input fl" name="sort" size="10" value="0" validate="required:true,number:true,maxlength:6" tips="数值越大，排序越前"/></td>
			</tr>
			<tr>
				<th width="80">链接状态</th>
				<td class="radio_box">
					<label style="float:left;width:60px" class="checkbox_status"><input type="radio" class="input_radio" name="status" checked="checked" value="1" validate=" maxlength:1" /> 显示</label>
					<label style="float:left;width:60px" class="checkbox_status"><input type="radio" class="input_radio" name="status" value="0" /> 隐藏</label>		
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>