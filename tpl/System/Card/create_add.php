<include file="Public:header"/>
	<form id="myform" method="post" action="" enctype="multipart/form-data" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">{pigcms{$thisCard.cardname}：</th>
				<td>创建会员卡</td>
			</tr>
			<tr>
				<th width="80">卡号英文编号</th>
				<td><input type="text" class="input fl" name="title" style="width:200px;" placeholder="卡号英文编号" validate="maxlength:200,required:true" tips="例：BSD-65535 BSD就是英文编号"/></td>
			</tr>
			<tr>
				<th width="80">卡号生成开始数</th>
				<td><input type="text" class="input fl" name="stat" style="width:200px;" placeholder="卡号生成开始数" validate="maxlength:200,required:true" tips="最小起始卡为:1"/></td>
			</tr>
			<tr>
				<th width="80">卡号生成结束数</th>
				<td><input type="text" class="input fl" name="end" style="width:200px;" placeholder="卡号生成结束数" validate="maxlength:200,required:true" tips="最大结束卡号为:65535"/></td>
			</tr>
			
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>