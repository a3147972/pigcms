<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>设置密码</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index">
        <if condition="$error">
        	<div id="tips" class="tips tips-err" style="display:block;">{pigcms{$error}</div>
        <else/>
        	<div id="tips" class="tips"></div>
        </if>
        <form method="post" action="{pigcms{:U('My/password')}" id="form">
		    <dl class="list">
		    	<dd>
		    		<dl>
		    			<if condition="$now_user['pwd']">
			            	<dd class="dd-padding"><input class="input-weak" placeholder="请输入当前密码" type="password" id="currentpassword" name="currentpassword" autocomplete="off"></dd>
				        </if>
				        <dd class="dd-padding"><input class="input-weak" placeholder="请输入新密码（密码长度在6-32个字符之间）" type="password" id="password" name="password" autocomplete="off"></dd>
				        <dd class="dd-padding"><input class="input-weak" placeholder="请再输入一次新密码" type="password" id="password2" name="password2" autocomplete="off"></dd>
				    </dl>
		    	</dd>
		    </dl>
		    <div class="btn-wrapper">
				<button type="submit" class="btn btn-block btn-larger">确认提交</button>
		    </div>
		</form>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script>
			$(function(){
				$('#form').submit(function(){
					$('#tips').removeClass('tips-err').hide();
			        var old_v = $("#currentpassword");
			        var new_v = $("#password");
			        var new_v2 = $("#password2");
			        if(old_v.size() > 0 && old_v.val().length < 6){
			        	$('#tips').html('请正确填写原始密码！').addClass('tips-err').show();
			            return false;
				    }
			      	if(new_v.val().length < 6){
			      		$('#tips').html('新密码长度不符合规范！').addClass('tips-err').show();
			      		return false;
				    }
			      	if(new_v2.val() != new_v.val()){
			      		$('#tips').html('两次新密码输入不一致！').addClass('tips-err').show();
			      		return false;
				    }
			    });
			});
			function toast(msg){
				
			}
		</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>