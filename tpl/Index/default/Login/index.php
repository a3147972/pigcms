<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>登录 | {pigcms{$config.site_name}</title>
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.v113ea197.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.v492b572b.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/login.v7e870f72.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/login-section.vfa22738e.css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
	<script src="{pigcms{$static_public}js/jquery.min.js"></script>
</head>
<body id="login" class="theme--www" style="position: static;">
	<header id="site-mast" class="site-mast site-mast--mini">
	    <div class="site-mast__branding cf">
			<a href="{pigcms{$config.site_url}"><img src="{pigcms{$config.site_logo}" alt="{pigcms{$config.site_name}" title="{pigcms{$config.site_name}" style="width:190px;height:60px;"/></a>
	    </div>
	</header>
	<div class="site-body pg-login cf">
	    <div class="promotion-banner">
	        <img src="{pigcms{$static_path}css/img/web_login/{pigcms{:mt_rand(1,4)}.jpg" width="480" height="370">
	    </div>
	    <div class="component-login-section component-login-section--page mt-component--booted" >
		    <div class="origin-part theme--www">
			    <div class="validate-info" style="visibility:hidden"></div>
		        <h2>账号登录</h2>
		        <form id="J-login-form" method="post" class="form form--stack J-wwwtracker-form">
			        <div class="form-field form-field--icon">
			            <i class="icon icon-user"></i>
			            <input type="text" id="login-phone" class="f-text" name="phone" placeholder="手机号" value="{pigcms{$_COOKIE.login_name}"/>
			        </div>
			        <div class="form-field form-field--icon" >
			            <i class="icon icon-password"></i>
			            <input type="password" id="login-password" class="f-text" name="pwd" placeholder="密码"/>
			        </div>
			        <div class="form-field form-field--ops">
			            <input type="hidden" name="fingerprint" class="J-fingerprint"/>
			            <input type="hidden" name="origin" value="account-login"/>
			            <input type="submit" class="btn" id="commit" value="登录"/>
			        </div>
			    </form>
			    <p class="signup-guide">还没有账号？<a href="{pigcms{:U('Login/reg',array('referer'=>urlencode($referer)))}">免费注册</a></p>
		    </div>
		</div>
	</div>
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			if($('body').height() < $(window).height()){
				$('.site-info-w').css({'position':'absolute','width':'100%','bottom':'0'});
			}
			$("#J-login-form").submit(function(){
				$('.validate-info').css('visibility','hidden');
				$('#commit').val('登录中...').prop('disabled',true);
				var phone = $("#login-phone").val();
				var pwd = $("#login-password").val();
				if (phone == '' || phone == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>手机号不能为空').css('visibility','visible');
					$("#commit").val('登录').prop('disabled',false);
					return false;
				}
				if (pwd == '' || pwd == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>密码不能为空').css('visibility','visible');
					$("#commit").val('登录').prop('disabled',false);
					return false;
				}

				$.post("{pigcms{:U('Index/Login/index')}", {'phone':phone, 'pwd':pwd}, function(data){
					if (data.error_code) {
						$("#commit").val('登录').prop('disabled',false);
						$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						return false;
					} else {
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>登录成功！正在跳转.').css('visibility','visible');
						setTimeout("location.href='{pigcms{$referer}'", 1000);
					}
				}, 'json');
				return false;
			});
		});
	</script>
	<include file="Public:footer"/>
</body>
</html>