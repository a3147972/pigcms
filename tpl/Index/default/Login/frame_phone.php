<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>绑定手机号码 | {pigcms{$config.site_name}</title>
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
	<script src="{pigcms{$static_public}js/jquery.min.js"></script>
	
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
</head>
<body class="pg-unitive-login" style="background-color:#fff;">
	<div class="content" style="margin:0px auto;border:none;padding:30px;overflow:hidden;width:270px;">
	    <div class="component-login-section component-login-section--page mt-component--booted" >
		    <div class="origin-part theme--www">
			    <div class="validate-info" style="visibility:hidden"></div>
				<h2 style="margin-bottom:20px;color:#999;">为了保护您的权益，在付款之前您必须绑定手机号码！以后也可以用手机号码和密码进行登录...</h2>
		        <form id="J-login-form" method="post" class="form form--stack J-wwwtracker-form">
			        <div class="form-field form-field--icon">
			            <i class="icon icon-user"></i>
			            <input type="text" id="login-phone" class="f-text" name="phone" placeholder="手机号" value=""/>
			        </div>
			        <div class="form-field form-field--icon" >
			            <i class="icon icon-password"></i>
			            <input type="password" id="login-password" class="f-text" name="pwd" placeholder="密码"/>
			        </div>
			        <div class="form-field form-field--ops">
			            <input type="hidden" name="fingerprint" class="J-fingerprint"/>
			            <input type="hidden" name="origin" value="account-login"/>
			            <input type="submit" class="btn" id="commit" value="注册并绑定"/>
			        </div>
			    </form>
		    </div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			if($('body').height() < $(window).height()){
				$('.site-info-w').css({'position':'absolute','width':'100%','bottom':'0'});
			}
			$("#J-login-form").submit(function(){
				$('.validate-info').css('visibility','hidden');
				$('#commit').val('绑定中...').prop('disabled',true);
				var phone = $("#login-phone").val();
				var pwd = $("#login-password").val();
				if (phone == '' || phone == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>手机号不能为空').css('visibility','visible');
					$("#commit").val('注册并绑定').prop('disabled',false);
					return false;
				}
				if (pwd == '' || pwd == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>密码不能为空').css('visibility','visible');
					$("#commit").val('注册并绑定').prop('disabled',false);
					return false;
				}
				
				$.post("{pigcms{:U('Index/Login/frame_phone')}", {'phone':phone, 'pwd':pwd}, function(data){
					if (data.error_code) {
						$("#commit").val('注册并绑定').prop('disabled',false);
						$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						return false;
					} else {
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>绑定成功！正在跳转.').css('visibility','visible');
						setTimeout("window.top.location.href=window.top.location.href", 1000);
					}
				}, 'json');
				return false;
			});
		});
	</script>
</body>
</html>