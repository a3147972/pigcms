<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>商家中心 - <?php echo ($config["site_name"]); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>login/new_login.css"/>
		<script type="text/javascript">if(self!=top){window.top.location.href = "<?php echo U('Login/index');?>";}</script>
	</head>
	<body>
		<div class="W_header_line"></div>
		<div id="hdw">
			<div id="hd" style="background-image:url(<?php echo ($config["site_logo"]); ?>);">商家中心 - <?php echo ($config["site_name"]); ?></div>
		</div>
		<div id="login">
			<div id="switch_btn">
				<a class="login_p on" types="login">商户登录</a>
				<span class="vline">|</span>
				<a class="reg_p" types="reg">商户注册</a>
				<div class="clear"></div> 
			</div>
			<div id="box">
				<div style="float:left;">
					<form method="post" id="login_form">
						<p>
							<label>帐 号：</label>
							<input class="text-input" type="text" name="account" id="login_account"/>
							<span class="check">* 长度为6~16位字符</span>
						</p>
						<p>
							<label>密码：</label>
							<input class="text-input" type="password" name="pwd" id="login_pwd"/>
							<span class="check">* 长度为大于6位字符</span>
						</p>
						<p>
							<label>验证码：</label>
							<input class="text-input" type="text" id="login_verify" style="width:60px;" maxlength="4" name="verify"/>&nbsp;&nbsp;
							<span class="verify_box">
								<img src="<?php echo U('Login/verify',array('type'=>'login'));?>" id="login_verifyImg" onclick="login_fleshVerify('<?php echo U('Login/verify',array('type'=>'login'));?>')" title="刷新验证码" alt="刷新验证码"/>&nbsp;
								<a href="javascript:login_fleshVerify('<?php echo U('Login/verify',array('type'=>'login'));?>')">刷新验证码</a>
							</span>
						</p>
						<p class="btn_login"><input type="submit" value="登 录" class="login_btn"/></p>
					</form>
					<form method="post" id="reg_form">
						<p>
							<label>帐 号：</label>
							<input class="text-input" type="text" name="account" id="reg_account"/>
							<span class="check">* 长度为6~16位字符</span>
						</p>
						<p>
							<label>密 码：</label>
							<input class="text-input" type="password" name="pwd" id="reg_pwd"/>
							<span class="check">* 长度为大于6位字符</span>
						</p>
						<p>
							<label>商家名称：</label>
							<input class="text-input" type="text" name="name" id="reg_name"/>
						</p>
						<p>
							<label>所在区域：</label>
							<span id="choose_cityarea"></span>
						</p>
						<p>
							<label>邮 箱：</label>
							<input class="text-input" type="text" name="email" id="reg_email"/>
							<span class="check">* 必填</span>
						</p>
						<p>
							<label>手机号：</label>
							<input class="text-input" type="text" name="phone" id="reg_phone"/>
							<span class="check">* 必填</span>
						</p>
						<p>
							<label>验证码：</label>
							<input class="text-input" type="text" id="reg_verify" style="width:60px;" maxlength="4" name="verify"/>&nbsp;&nbsp;
							<span class="verify_box">
								<img src="<?php echo U('Login/verify',array('type'=>'reg'));?>" id="reg_verifyImg" onclick="reg_fleshVerify('<?php echo U('Login/verify',array('type'=>'reg'));?>')" title="刷新验证码" alt="刷新验证码"/>&nbsp;
								<a href="javascript:reg_fleshVerify('<?php echo U('Login/verify',array('type'=>'reg'));?>')">刷新验证码</a>
							</span>
						</p>
						<p class="btn_login"><input type="submit" value="注 册" class="login_btn"></p>
					</form>
				</div>
				<div style="float:right;font-size:12px;">
					<?php if($config['site_phone']): ?><p>客服电话 ：<?php echo ($config["site_phone"]); ?></p><?php endif; ?>
					<?php if($config['site_qq']): ?><p>客服 Q Q ：<?php echo ($config["site_qq"]); ?></p><?php endif; ?>
					<?php if($config['site_email']): ?><p>联系邮箱 ：<?php echo ($config["site_email"]); ?></p><?php endif; ?>
				</div>
			</div>
		</div>
		<div class="copyright">
			<p style="float:left;"><a href="<?php echo ($config["site_url"]); ?>"><?php echo ($config["site_name"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(!empty($config['site_icp'])): ?><a href="http://www.miibeian.gov.cn/" target="_blank"><?php echo ($config["site_icp"]); ?></a><?php endif; ?></p>
			<p style="float:right;">Copyright &copy; <span>2015</span>&nbsp;<?php echo ($config["top_domain"]); ?></p>
		</div>
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script>
		<script type="text/javascript">
			var static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",login_check="<?php echo U('Login/check');?>",reg_check="<?php echo U('Login/reg_check');?>",merchant_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>", show_circle = 1;
		</script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>login/login.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/area.js"></script>
		<style>
		.col-sm-1 {
		  border: 1px solid #ccc;
		  color: #333;
		  -moz-border-radius: 2px;
		  -webkit-border-radius: 2px;
		  border-radius: 6px;
		  padding: 6px;
		  outline: 0;
		  box-shadow: 0px 1px 1px 0px #eaeaea inset;
		}
		</style>
	</body>
</html>