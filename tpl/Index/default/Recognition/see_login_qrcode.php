<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	</head>
	<body>
		<p style="margin-top:20px;margin-bottom:20px;text-align:center;">请使用微信扫描二维码登录</p>
		<p style="text-align:center;"><img src="{pigcms{$ticket}" style="width:300px;height:300px;"/></p>
		<p id="login_status" style="margin-top:20px;display:none;text-align:center;"></p>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script>
			<?php if($_GET['referer']){ ?>var redirect_url = "{pigcms{$_GET.referer|htmlspecialchars_decode|strip_tags=###}";<?php }else{ ?>var redirect_url = window.top.location.href;<?php } ?>
			window.setTimeout(function(){
				window.location.href = window.location.href;
			},1200000);
			window.setTimeout(function(){
				ajax_weixin_login();
			},3000);
			function ajax_weixin_login(){
				$.get("{pigcms{:U('Login/ajax_weixin_login')}",{qrcode_id:{pigcms{$id}},function(result){
					if(result == 'reg_user'){
						$('#login_status').html('已扫描！请在微信公众号里点击授权登录。').css('color','green').show();
						ajax_weixin_login();
					}else if(result == 'no_user'){
						$('#login_status').html('没有查找到此用户，请重新扫描二维码！').css('color','red').show();
						window.location.href = redirect_url;
					}else if(result!=='true'){
						ajax_weixin_login();
					}else{
						$('#login_status').html('登录成功！正在跳转。').css('color','green').show();
						window.top.location.href = redirect_url;
					}
				});
			}
		</script>
	</body>
</html>