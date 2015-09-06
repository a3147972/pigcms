<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>我的帐户</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    #pg-account .text-icon {
	        font-size: .44rem;
	        color: #666;
	        width: .44rem;
	        text-align: center;
	        margin-right: .1rem;
	    }
	</style>
</head>
<body id="index" data-com="pagecommon">
        <if condition="$_GET['OkMsg']">
        	<div id="tips" class="tips tips-ok" style="display:block;">{pigcms{$_GET.OkMsg}</div>
        <else/>
        	<div id="tips" class="tips"></div>
        </if>
        <div id="pg-account">
		    <dl class="list">
		    	<dd>
		    		<dl>
				        <dd>
					        <a class="react" href="{pigcms{:U('My/username')}">
						        <div class="more more-weak">
						            <i class="text-icon">⍥</i>
						            <span>{pigcms{$now_user.nickname}</span>
						            <span class="more-after">修改</span>
						        </div>
					        </a>
				        </dd>
						<if condition="$now_user['phone']">
							<dd>
								<a class="react" href="{pigcms{:U('My/password')}">
									<div class="more more-weak"><span class="text-icon">⚿</span> 修改登陆密码</div>
								</a>
							</dd>
						<else/>
							<dd>
								<a class="react" href="{pigcms{:U('My/bind_user')}">
									<div class="more more-weak"><span class="text-icon">⚿</span> 绑定手机号码</div>
								</a>
							</dd>
						</if>
				        <dd>
				        	<a class="react" href="{pigcms{:U('My/adress')}">
				        	<div class="more more-weak"><span class="text-icon">⛟</span> 收货地址管理</div>
				        	</a>
				        </dd>
						<dd>
				        	<a class="react" href="{pigcms{:U('My/levelUpdate')}">
				        	<div class="more more-weak"><span class="text-icon">⍥</span> 等级管理</div>
				        	</a>
				        </dd>
						<dd>
				        	<a class="react" href="{pigcms{:U('My/recharge')}">
				        	<div class="more more-weak"><span class="text-icon">☎</span> 余额充值</div>
				        	</a>
				        </dd>
		    </dl></dd></dl>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>