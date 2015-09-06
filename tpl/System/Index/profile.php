<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<a href="{pigcms{:U('Index/profile')}" class="on">修改资料</a>
			</div>
			<form method="post" id="myform" action="{pigcms{:U('Index/amend_profile')}">
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%">
					<tr>
						<td  width="120">帐号</td>
						<td>{pigcms{$admin.account}</td>
					</tr>
					<tr>
						<td  width="120">真实姓名</td>
						<td><input type="text" class="input-text"  name="realname" value="{pigcms{$admin.realname}" validate="required:true" /></td>
					</tr>
					<tr>
						<td>邮箱</td>
						<td><input type="text" class="input-text"  name="email" value="{pigcms{$admin.email}" validate="required:true,email:true,minlength:1,maxlength:40" /></td>
					</tr>
					<tr>
						<td>Q Q</td>
						<td><input type="text" class="input-text"  name="qq" value="{pigcms{$admin.qq}" validate="required:true,qq:true" /></td>
					</tr>
					<tr>
						<td>手机号码</td>
						<td><input type="text" class="input-text"  name="phone" value="{pigcms{$admin.phone}"  validate="required:true,mobile:true" /></td>
					</tr>
				</table>
				<div class="btn">
					<input TYPE="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
<include file="Public:header"/>