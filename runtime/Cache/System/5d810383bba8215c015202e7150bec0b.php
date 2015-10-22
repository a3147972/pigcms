<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={:C('DEFAULT_CHARSET')}" />
		<title>网站后台管理 Powered by weiwino2o</title>
		<script type="text/javascript">
			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}
			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;
 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>
	</head>
	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
	<form id="myform" method="post" action="<?php echo U('Merchant/modify');?>" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">商户帐号</th>
				<td><input type="text" class="input fl" name="account" size="25" placeholder="商户平台的帐号" validate="maxlength:20,required:true" tips="设定之后，以后不能再修改！"/></td>
			</tr>
			<tr>
				<th width="80">商户密码</th>
				<td><input type="password" id="check_pwd" check_width="180" class="input fl" name="pwd" size="25" placeholder="商户平台的密码" validate="required:true,minlength:6" tips="商户的密码很重要，填写难度较强的密码有效保护商户的信息，也可以保护网站的数据安全。"/></td>
			</tr>
			<tr>
				<th width="80">商户名称</th>
				<td><input type="text" class="input fl" name="name" size="25" placeholder="商户的公司名或..." validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">联系电话</th>
				<td><input type="text" class="input fl" name="phone" size="25" placeholder="联系人的电话" validate="required:true" tips="多个电话号码以空格分开"/></td>
			</tr>
			<tr>
				<th width="80">联系邮箱</th>
				<td><input type="text" class="input fl" name="email" size="25" placeholder="可不填写" validate="email:true" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">商户状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>启用</span><input type="radio" name="status" value="1" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>关闭</span><input type="radio" name="status" value="0" /></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">签约商家</th>
				<td>
					<span class="cb-enable"><label class="cb-enable"><span>是</span><input type="radio" name="issign" value="1"/></label></span>
					<span class="cb-disable"><label class="cb-disable  selected"><span>否</span><input type="radio" name="issign" value="0" checked="checked" /></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">认证商家</th>
				<td>
					<span class="cb-enable"><label class="cb-enable"><span>是</span><input type="radio" name="isverify" value="1" /></label></span>
					<span class="cb-disable"><label class="cb-disable  selected"><span>否</span><input type="radio" name="isverify" value="0"  checked="checked"/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">使用公众号</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>允许</span><input type="radio" name="is_open_oauth" value="1" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>禁止</span><input type="radio" name="is_open_oauth" value="0"/></label></span>
					<em class="notice_tips" tips="如果系统设置中允许所有商家都使用公众号，请禁止无效。"></em>
				</td>
			</tr>

			<tr>
				<th width="80">开微店</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>允许</span><input type="radio" name="is_open_oauth" value="1" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>禁止</span><input type="radio" name="is_open_oauth" value="0"/></label></span>
					<em class="notice_tips" tips="如果系统设置中允许所有商家都能开微店，请禁止无效。"></em>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	</body>
</html>