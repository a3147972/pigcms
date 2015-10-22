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
	<form id="myform" method="post" action="<?php echo U('User/amend');?>" frame="true" refresh="true">
		<input type="hidden" name="uid" value="<?php echo ($now_user["uid"]); ?>"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="15%">ID</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php echo ($now_user["uid"]); ?></div></td>
				<th width="15%">微信唯一标识</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php echo ($now_user["openid"]); ?></div></td>
			<tr/>
			<tr>
				<th width="15%">昵称</th>
				<td width="35%"><input type="text" class="input fl" name="nickname" size="20" validate="maxlength:50,required:true" value="<?php echo ($now_user["nickname"]); ?>"/></td>
				<th width="15%">手机号</th>
				<td width="35%"><input type="text" class="input fl" name="phone" size="20" validate="mobile:true" value="<?php echo ($now_user["phone"]); ?>"/></td>
			</tr>
			<tr>
				<th width="15%">密码</th>
				<td width="35%"><input type="password" class="input fl" name="pwd" size="20" value="" tips="不修改则不填写"/></td>
				<th width="15%">性别</th>
				<td width="35%" class="radio_box">
					<span class="cb-enable"><label class="cb-enable <?php if($now_user['sex'] == 1): ?>selected<?php endif; ?>"><span>男</span><input type="radio" name="sex" value="1"  <?php if($now_user['sex'] == 1): ?>checked="checked"<?php endif; ?>/></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($now_user['sex'] == 2): ?>selected<?php endif; ?>"><span>女</span><input type="radio" name="sex" value="2"  <?php if($now_user['sex'] == 2): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="15%">省份</th>
				<td width="35%"><input type="text" class="input fl" name="province" size="20" validate="maxlength:20" value="<?php echo ($now_user["province"]); ?>"/></td>
				<th width="15%">城市</th>
				<td width="35%"><input type="text" class="input fl" name="city" size="20" validate="maxlength:20" value="<?php echo ($now_user["city"]); ?>"/></td>
			</tr>
			<tr>
				<th width="15%">QQ号</th>
				<td width="35%"><input type="text" class="input fl" name="qq" size="20" value="<?php echo ($now_user["qq"]); ?>"/></td>
				<th width="15%">状态</th>
				<td width="35%" class="radio_box">
					<span class="cb-enable"><label class="cb-enable <?php if($now_user['status'] == 1): ?>selected<?php endif; ?>"><span>正常</span><input type="radio" name="status" value="1"  <?php if($now_user['status'] == 1): ?>checked="checked"<?php endif; ?>/></label></span>
					<span class="cb-disable"><label class="cb-disable <?php if($now_user['status'] == 0): ?>selected<?php endif; ?>"><span>禁止</span><input type="radio" name="status" value="0"  <?php if($now_user['status'] == 0): ?>checked="checked"<?php endif; ?>/></label></span>
				</td>
			</tr>
			<!--tr>
				<th width="15%">手机号验证</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php if($vo['is_check_phone'] == 1): ?><font color="green">已验证</font><?php else: ?><font color="red">未验证</font><?php endif; ?></div></td>
				<th width="15%">关注微信号</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php if($vo['is_follow'] == 1): ?><font color="green">已关注</font><?php else: ?><font color="red">未关注</font><?php endif; ?></div></td>
			</tr-->
			<tr>
				<th width="15%">注册时间</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php echo (date('Y-m-d H:i:s',$now_user["add_time"])); ?></div></td>
				<th width="15%">注册IP</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php echo (long2ip($now_user["add_ip"])); ?></div></td>
			</tr>
			<tr>
				<th width="15%">最后访问时间</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php echo (date('Y-m-d H:i:s',$now_user["last_time"])); ?></div></td>
				<th width="15%">最后访问IP</th>
				<td width="35%"><div style="height:24px;line-height:24px;"><?php echo (long2ip($now_user["last_ip"])); ?></div></td>
			</tr>
			<tr>
				<th width="15%">余额</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">现在余额：￥<?php echo (floatval($now_user["now_money"])); ?> &nbsp;&nbsp;&nbsp;&nbsp;<select name="set_money_type"><option value="1">增加</option><option value="2">减少</option></select>&nbsp;&nbsp;<input type="text" class="input" name="set_money" size="10" validate="number:true" tips="此处填写增加或减少的额度，不是将余额变为此处填写的值"/></div></td>
			</tr>
			<tr>
				<th width="15%">积分</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">现在积分：<?php echo ($now_user["score_count"]); ?> &nbsp;&nbsp;&nbsp;&nbsp;<select name="set_score_type"><option value="1">增加</option><option value="2">减少</option></select>&nbsp;&nbsp;<input type="text" class="input" name="set_score" size="10" validate="number:true" tips="此处填写增加或减少的积分，不是将积分变为此处填写的值"/></div></td>
			</tr>
			<tr>
				<th width="15%">等级</th>
				<td width="85%" colspan="3">
				<div style="height:30px;line-height:24px;">现在等级：<?php if(isset($levelarr[$now_user['level']])){ echo $levelarr[$now_user['level']]['lname'];}else{echo '暂无等级';} ?> &nbsp;&nbsp;&nbsp;&nbsp;
				<?php if(!empty($levelarr)): ?>请设定等级：&nbsp;&nbsp;
				<select name="level" style="width:100px;">
				<option value="0">无</option>
				<?php if(is_array($levelarr)): $i = 0; $__LIST__ = $levelarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['level']); ?>"><?php echo ($vo['lname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select><?php endif; ?>
				&nbsp;&nbsp;</div>
				</td>
			</tr>
			<tr>
				<th width="15%">记录表</th>
				<td width="85%" colspan="3">
					<div style="height:30px;line-height:24px;">
						<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/money_list',array('uid'=>$now_user['uid']));?>','余额记录列表',680,560,true,false,false,null,'money_list',true);">余额记录</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('User/score_list',array('uid'=>$now_user['uid']));?>','积分记录列表',680,560,true,false,false,null,'score_list',true);">积分记录</a>
					</div>
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