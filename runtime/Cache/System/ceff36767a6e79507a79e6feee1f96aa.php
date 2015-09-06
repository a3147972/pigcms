<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={:C('DEFAULT_CHARSET')}" />
		<title>网站后台管理 Powered by pigcms.com</title>
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
	<div class="mainbox">
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/main.css" />
		<?php if($merchant_verify_count || $group_verify_count): ?><h2>您网站待审核的 商家有 <a style="cursor:pointer;color:red;" target="_top" href="<?php echo U('Index/index',array('module'=>'Merchant','action'=>'wait_merchant'));?>"><?php echo ($merchant_verify_count); ?></a> 个，店铺有 <a style="cursor:pointer;color:red;" target="_top" href="<?php echo U('Index/index',array('module'=>'Merchant','action'=>'wait_store'));?>"><?php echo ($merchant_verify_store_count); ?></a> 个，<?php echo ($config["group_alias_name"]); ?>有 <a style="cursor:pointer;color:red;" target="_top" href="<?php echo U('Index/index',array('module'=>'Group','action'=>'wait_product'));?>"><?php echo ($group_verify_count); ?></a> 个</h2><?php endif; ?>
		<div id="Profile" class="list">
			<h1><b>个人信息</b><span>Profile&nbsp; Info</span></h1>
			<ul>
				<li><span>会员名:</span><?php echo ($system_session["account"]); ?></li>
				<li><span>会员组:</span>超级管理员</li>
				<li><span>最后登陆时间:</span><?php echo (date('Y-m-d H:i:s',$system_session["last_time"])); ?></li>
				<li><span>最后登陆IP/地址:</span><?php echo (long2ip($system_session["last_ip"])); ?> / <?php echo ($system_session["last"]["country"]); ?> <?php echo ($system_session["last"]["area"]); ?></li>
				<li><span>登陆次数:</span><?php echo ($system_session["login_count"]); ?></li>
			</ul>
		</div>
		<?php if($system_session['level'] == 2): ?><div id="sitestats">
			<h1><b>网站统计</b><span>Site &nbsp; Stats</span></h1>
			<div>
				<ul>
					<li style="background:#457CB5;line-height:44px;color:white;font-weight:bold;">网站</li>
					<li><b>用户总数</b><br><span><?php echo ($website_user_count); ?></span></li>
					<li><b>商户总数</b><br><span><?php echo ($website_merchant_count); ?></span></li>
					<li><b>店铺总数</b><br><span><?php echo ($website_merchant_store_count); ?></span></li>
					<li><b></b><span></span></li>
					<li><b></b><span></span></li>
					<li style="background:#3A6EA5;line-height:44px;color:white;font-weight:bold;"><?php echo ($config["group_alias_name"]); ?></li>
					<li><b><?php echo ($config["group_alias_name"]); ?>总数</b><br><span><?php echo ($group_group_count); ?></span></li>
					<li><b>今日订单</b><span><?php echo ($group_today_order_count); ?></span></li>
					<li><b>本周订单</b><span><?php echo ($group_week_order_count); ?></span></li>
					<li><b>本月订单</b><span><?php echo ($group_month_order_count); ?></span></li>
					<li><b>今年订单</b><span><?php echo ($group_year_order_count); ?></span></li>
					<li style="background:#FF658E;line-height:44px;color:white;font-weight:bold;"><?php echo ($config["meal_alias_name"]); ?></li>
					<li><b>店铺总数</b><span><?php echo ($meal_store_count); ?></span></li>
					<li><b>今日订单</b><span><?php echo ($meal_today_order_count); ?></span></li>
					<li><b>本周订单</b><span><?php echo ($meal_week_order_count); ?></span></li>
					<li><b>本月订单</b><span><?php echo ($meal_month_order_count); ?></span></li>
					<li><b>今年订单</b><span><?php echo ($meal_year_order_count); ?></span></li>
				</ul>
			</div>
		</div><?php endif; ?>
		<div id="system"  class="list">
			<h1><b>系统信息</b><span>System&nbsp; Info</span></h1>
			<ul>
				<?php if(is_array($server_info)): $i = 0; $__LIST__ = $server_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><?php echo ($key); ?>:</span><?php echo ($vo); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
		<?php if($system_session['level'] == 2): ?><div id="system"  class="list">
			<h1><b>官方动态</b><span>Soft &nbsp; Update</span></h1>
			<ul id="official_news">
				<li>加载中...</li>
			</ul>
		</div><?php endif; ?>
	</div>
	<div id="verify_merchant_list" style="display:none;">
		<table>
			<?php if(is_array($merchant_verify_list)): $i = 0; $__LIST__ = $merchant_verify_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><a href="<?php echo U('Index/index',array('module'=>'Merchant','action'=>'index','url'=>urlencode(U('Merchant/index',array('keyword'=>$vo['mer_id'],'searchtype'=>'mer_id')))));?>" target="_blank"><?php echo ($vo["name"]); ?></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
	<div id="verify_merchant_store_list" style="display:none;">
		<table>
			<?php if(is_array($merchant_verify_store_list)): $i = 0; $__LIST__ = $merchant_verify_store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><a href="<?php echo U('Index/index',array('module'=>'Merchant','action'=>'index','url'=>urlencode(U('Merchant/store',array('mer_id'=>$vo['mer_id'])))));?>" target="_blank"><?php echo ($vo["name"]); ?></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
	<div id="verify_group_list" style="display:none;">
		<table>
			<?php if(is_array($group_verify_list)): $i = 0; $__LIST__ = $group_verify_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					<td><a href="<?php echo U('Index/index',array('module'=>'Group','action'=>'product','url'=>urlencode(U('Group/product',array('keyword'=>$vo['group_id'],'searchtype'=>'group_id')))));?>" target="_blank"><?php echo ($vo["s_name"]); ?></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
<!--	<?php if($system_session['level'] == 2): ?><script type="text/javascript" src="http://up.pigcms.cn/softupdate.php?soft_version=<?php echo ($config["system_version"]); ?>&domain=<?php echo ($_SERVER["SERVER_NAME"]); ?>"></script><?php endif; ?>-->
	</body>
</html>