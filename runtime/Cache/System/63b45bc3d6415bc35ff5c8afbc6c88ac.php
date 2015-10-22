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
	<form id="myform" method="post" action="<?php echo U('Merchant/store_amend');?>" frame="true" refresh="true">
		<input type="hidden" name="store_id" value="<?php echo ($store["store_id"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">店铺名称</th>
				<td><input type="text" class="input fl" name="name" value="<?php echo ($store["name"]); ?>" size="25" placeholder="店铺名称" validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">联系电话</th>
				<td><input type="text" class="input fl" name="phone" size="25" value="<?php echo ($store["phone"]); ?>" placeholder="店铺的电话" validate="required:true" tips="多个电话号码以空格分开"/></td>
			</tr>
			<tr>
				<th width="80">店铺经纬度</th>
				<td id="choose_map" default_long_lat="<?php echo ($store["long"]); ?>,<?php echo ($store["lat"]); ?>"></td>
			</tr>
			<tr>
				<th width="80">店铺所在地</th>
				<td id="choose_cityarea" province_id="<?php echo ($store["province_id"]); ?>" city_id="<?php echo ($store["city_id"]); ?>" area_id="<?php echo ($store["area_id"]); ?>" circle_id="<?php echo ($store["circle_id"]); ?>"></td>
			</tr>
			<tr>
				<th width="80">店铺地址</th>
				<td><input type="text" class="input fl" name="adress" id="adress" value="<?php echo ($store["adress"]); ?>" size="25" placeholder="店铺的地址" validate="required:true"/></td>
			</tr>
			<tr>
				<th width="80">店铺排序</th>
				<td><input type="text" class="input fl" name="sort" size="5" value="<?php echo ($store["sort"]); ?>" validate="required:true,number:true,maxlength:6" tips="默认添加顺序排序！手动调值，数值越大，排序越前"/></td>
			</tr>
			<tr>
				<th width="80"><?php echo ($config["meal_alias_name"]); ?>功能</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($store['have_meal'] == 1): ?>selected<?php endif; ?>"><span>开启</span><input type="radio" name="have_meal" value="1" <?php if($store['have_meal'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($store['have_meal'] == 0): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="have_meal" value="0" <?php if($store['have_meal'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80"><?php echo ($config["group_alias_name"]); ?>功能</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($store['have_group'] == 1): ?>selected<?php endif; ?>"><span>开启</span><input type="radio" name="have_group" value="1" <?php if($store['have_group'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($store['have_group'] == 0): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="have_group" value="0" <?php if($store['have_group'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">店铺状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <?php if($store['status'] == 1): ?>selected<?php endif; ?>"><span>启用</span><input type="radio" name="status" value="1" <?php if($store['status'] == 1): ?>checked="checked"<?php endif; ?> /></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($store['status'] == 0): ?>selected<?php endif; ?>"><span>关闭</span><input type="radio" name="status" value="0" <?php if($store['status'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
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