<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>绑定手机号码</title>
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
			/*#login{margin: 0.5rem 0.2rem;}*/
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
        <header  class="navbar">
            <div class="nav-wrap-left">
                <a class="react back" href="javascript:history.back()"><i class="text-icon icon-back"></i></a>
            </div>
            <h1 class="nav-header">绑定手机号码</h1>
            <div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
					<span class="nav-btn">
						<i class="text-icon">≋</i>导航
					</span>
				</a>
			</div>
			<div id="nav-dropdown" class="nav-dropdown">
				<ul>
					<li><a class="react" href="{pigcms{:U('Home/index')}"><i class="text-icon">⟰</i>
						<space></space>首页</a>
					</li>
					<li><a class="react" href="{pigcms{:U('My/index')}"><i class="text-icon">⍥</i>
						<space></space>我的</a>
					</li>
					<li><a class="react" href="{pigcms{:U('Search/index')}"><i class="text-icon">⌕</i>
						<space></space>搜索</a>
					</li>
				</ul>
			</div>
        </header>
        <div id="container">
        	<div id="tips"></div>
			<div id="login">
				<form id="reg-form" action="{pigcms{:U('My/bind_user')}" autocomplete="off" method="post" location_url="{pigcms{$referer}">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input id="reg_phone" class="input-weak" type="text" placeholder="手机号" name="phone" value="" required=""/>
			            		</dd>
			            		<dd class="kv-line-r dd-padding">
			            			<input id="reg_pwd_password" class="input-weak kv-k" type="password" placeholder="设置一个6位以上的密码"/>
			            			<input id="reg_txt_password" class="input-weak kv-k" type="text" placeholder="设置一个6位以上的密码" style="display:none;"/>
			            			<input type="hidden" id="reg_password_type" value="0"/>
			            			<button id="reg_changeWord" type="button" class="btn btn-weak kv-v">显示明文</button>
			            		</dd>
			        		</dl>
			        	</dd>
			        </dl>
			        <div class="btn-wrapper">
						<button type="submit" class="btn btn-larger btn-block">注册并绑定</button>
			        </div>
			    </form>
			</div>
		</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/bind_user.js"></script>
		<include file="Public:footer"/>
	</body>
</html>