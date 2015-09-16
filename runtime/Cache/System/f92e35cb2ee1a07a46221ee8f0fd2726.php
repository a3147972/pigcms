<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>后台登录 - <?php echo ($config["site_name"]); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>login/login.css"/>
	</head>
	<body>
		<div id="login">
			<h1><?php echo ($config["site_name"]); ?> - 后台登录</h1>
			<form method="post" id="form">
				<p>
					<label>用户名：</label>
					<input class="text-input" type="text" name="account" id="account"/>
				</p>
				<p>
					<label>密码：</label>
					<input class="text-input" type="password" name="pwd" id="pwd"/>
				</p>
				<p>
					<label>验证码：</label>
					<input class="text-input" type="text" id="verify" style="width:60px;" maxlength="4" name="verify"/>
					<span id="verify_box">
						<img src="<?php echo U('Login/verify');?>" id="verifyImg" onclick="fleshVerify('<?php echo U('Login/verify');?>')" title="刷新验证码" alt="刷新验证码"/>
						<a href="javascript:fleshVerify('<?php echo U('Login/verify');?>')" id="fleshVerify">刷新验证码</a>
					</span>
				</p>
				<p class="btn_p">
					<input class="button" type="submit" value="登录后台">
				</p>
			</form>	
		</div>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script>
		<script type="text/javascript">
			if(self!=top){window.top.location.href="<?php echo U('Index/index');?>";}
			var static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",login_check="<?php echo U('Login/check');?>",system_index="<?php echo U('Index/index');?>";
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>login/login.js"></script>
	</body>
</html>