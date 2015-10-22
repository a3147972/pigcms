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
	<form id="myform" method="post" action="<?php echo U('Merchant/savemenu');?>" frame="true" refresh="true">
		<input type="hidden" name="mer_id" value="<?php echo ($merchant["mer_id"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
		<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rowset): $mod = ($i % 2 );++$i;?><tr>
				<th>
					<label><input type="checkbox" class="menu_<?php echo ($rowset['id']); ?> father_menu" value="<?php echo ($rowset['id']); ?>" name="menus[]" <?php if(in_array($rowset['id'], $merchant['menus'])): ?>checked<?php endif; ?>/>　<?php echo ($rowset['name']); ?></label>
				</th>
				<td>
					<?php if(is_array($rowset['lists'])): $i = 0; $__LIST__ = $rowset['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><label><input type="checkbox" class="child_menu_<?php echo ($row['fid']); ?> child_menu" value="<?php echo ($row['id']); ?>"  name="menus[]" data-fid="<?php echo ($row['fid']); ?>"  <?php if(in_array($row['id'], $merchant['menus'])): ?>checked<?php endif; ?> />　<?php echo ($row['name']); ?></label>　<?php endforeach; endif; else: echo "" ;endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<tr><td colspan="2"><label><input type="checkbox" id="all"/> 全选</label></td></tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#all').click(function(){
		if ($(this).attr('checked')) {
			$('.father_menu, .child_menu').attr('checked', true);
		} else {
			$('.father_menu, .child_menu').attr('checked', false);
		}
	});
	$('.father_menu').click(function(){
		var fid = $(this).val();
		if ($(this).attr('checked')) {
			$('.child_menu_' + fid).attr('checked', true);
		} else {
			$('.child_menu_' + fid).attr('checked', false);
		}
	});
	$('.child_menu').click(function(){
		var fid = $(this).attr('data-fid');
		if ($(this).attr('checked')) {
			$('.menu_' + fid).attr('checked', true);
		} else {
			var flag = false;
			$('.child_menu_' + fid).each(function(){
				if ($(this).attr('checked')) {
					flag = true;
				}
			});
			$('.menu_' + fid).attr('checked', flag);
		}
	});
});
</script>
	</body>
</html>