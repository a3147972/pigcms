<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<a href="{pigcms{:U('Index/pass')}" class="on">修改密码</a>
			</div>
			<form id="myform" method="post" action="{pigcms{:U('Index/amend_pass')}" refresh="true">
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%">
					<tr>
						<td width="100">旧密码：</td>
						<td><input type="password" class="input-text" name="old_pass"/></td>
					</tr>
					<tr>
						<td>新密码：</td>
						<td><input type="password" class="input-text"  name="new_pass" id="password" validate="required:true,minlength:5,maxlength:20"/></td>
					</tr>
					<tr>
						<td>确认密码：</td>
						<td><input type="password" class="input-text"  name="re_pass" validate="required:true,equalTo:'#password'"/></td>
					</tr>
				</table>
				<div class="btn">
					<input type="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
<include file="Public:footer"/>