<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>商户登录</title>
	<meta name="description" content="{pigcms{$config.seo_description}"/>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	<style>
		#login{margin: 0.5rem 0.2rem;}
		.btn-wrapper{margin:.28rem 0;}
		dl.list{border-bottom:0;border:1px solid #ddd8ce;}
		dl.list:first-child{border-top:1px solid #ddd8ce;}
		dl.list dd dl{padding-right:0.2rem;}
		dl.list dd dl>.dd-padding, dl.list dd dl dd>.react, dl.list dd dl>dt{padding-right:0;}
	    .nav{text-align: center;}
	    .subline{margin:.28rem .2rem;}
	    .subline li{display:inline-block;}
	    .captcha img{margin-left:.2rem;}
	    .captcha .btn{margin-top:-.15rem;margin-bottom:-.15rem;margin-left:.2rem;}
	</style>
</head>
<body id="index" data-com="pagecommon">
        <!--<header  class="navbar">
            <h1 class="nav-header">商户登录 - {pigcms{$config.site_name}</h1>
        </header>-->
        <div id="container">
        	<div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
			<div id="login">
			    <form id="login_form" autocomplete="off" method="post" action="{pigcms{:U('Commerce/login')}">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input class="input-weak" type="text" name="account" id="login_account" placeholder="请输入您的商户账号"/>
			            		</dd>
			            		<dd class="dd-padding">
									<input class="input-weak" type="password" name="pwd" id="login_pwd" placeholder="请输入您的商户密码"/>
			            		</dd>
			        		</dl>
			        	</dd>
			        </dl>
			        <div class="btn-wrapper">
						<button type="submit" class="btn btn-larger btn-block">登录</button>
			        </div>
			    </form>
			</div>
		</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript">
			var static_public="{pigcms{$static_public}",static_path="{pigcms{$merchantstatic_path}",login_check="{pigcms{:U('Commerce/login')}",store_index="{pigcms{:U('Commerce/index')}";

			<if condition="!empty($refererUrl)">
			 store_index="{pigcms{$refererUrl}";
			</if>


	$(function(){
	$('#login_account').focus();
	$('#login_form').submit(function(){
		if($('#login_account').val()==''){
			alert('请输入帐 号~');
			$('#login_account').focus();
			return false;
		}else if($('#login_pwd').val()==''){
			alert('请输入密 码~');
			$('#login_pwd').focus();
		}else{
			$.post(login_check,$("#login_form").serialize(),function(result){
				//result = $.parseJSON(result);
				if(result){
					if(result.error == 0){
						//alert(result.msg);
						setTimeout(function(){
							window.parent.location = store_index;
						},1000);
					}else{
						$('#login_'+result.dom_id).focus();
						alert(result.msg);
					}
				}else{
					alert('登录出现异常，请重试！');
				}
			},'JSON');
		}
		return false;
	});
});
	</script>
	
	<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
	</body>
</html>