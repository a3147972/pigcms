<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>注册  - {pigcms{$config.site_name}</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

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
        <header  class="navbar">
            <div class="nav-wrap-left">
                <a class="react back" href="javascript:history.back()"><i class="text-icon icon-back"></i></a>
            </div>
            <h1 class="nav-header">{pigcms{$config.site_name}</h1>
            <div class="nav-wrap-right">
                <a class="react" href="{pigcms{:U('Home/index')}">
                    <span class="nav-btn"><i class="text-icon">⟰</i>首页</span>
                </a>
            </div>
        </header>
        <div id="container">
        	<div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
			<div id="login">
			    <form id="reg-form" action="{pigcms{:U('Login/reg')}" autocomplete="off" method="post" location_url="{pigcms{:U('My/index')}">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input id="phone" class="input-weak" type="text" placeholder="手机号" name="phone" value="" required="">
			            		</dd>
			            		<dd class="kv-line-r dd-padding">
			            			<input id="pwd_password" class="input-weak kv-k" type="password" placeholder="6位以上的密码"/>
			            			<input id="txt_password" class="input-weak kv-k" type="text" placeholder="6位以上的密码" style="display:none;"/>
			            			<input type="hidden" id="password_type" value="0"/>
			            			<button id="changeWord" type="button" class="btn btn-weak kv-v">显示明文</button>
			            		</dd>
                                <dd class="dd-padding">
                                    <input id="recomment" class="input-weak" type="text" placeholder="请输入推荐人ID" name="recomment" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <input id="id_number" class="input-weak" type="text" placeholder="请输入身份证号" name="id_number" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <img src="" alt="" style="display:none" class="review_img" width="90%">
                                    <input id="upid_number_img" class="input-weak" type="file" name="upid_number_img"onchange="upload(this)">
                                    <input type="text" name="id_number_img" id="id_number_img" style="display:none">
                                </dd>
                                <dd class="dd-padding">
                                    <img src="" alt="" style="display:none" class="review_img" width="90%">
                                    <input id="upwith_id_card" class="input-weak" type="file" name="upwith_id_card" onchange="upload(this)">
                                     <input type="text" name="with_id_card" id="with_id_card" style="display:none">
                                </dd>
			        		</dl>
			        	</dd>
			        </dl>
			        <div class="btn-wrapper">
						<button type="submit" class="btn btn-larger btn-block">注册</button>
			        </div>
			    </form>
			</div>
			<ul class="subline">
			    <li><a href="{pigcms{:U('Login/index')}">立即登录</a></li>
			</ul>
		</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
        <script src="{pigcms{$static_public}js/localResizeIMG4/lrz.bundle.js"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/reg.js"></script>
        <script>
            function upload (dom) {
                var review_img = $(dom).siblings('img.review_img');
                var text = $(dom).siblings('input[type=text]');
                lrz(dom.files[0])
                    .then(function (rst) {
                        var base64 = rst.base64;
                        $.ajax({
                            url : "{pigcms{:U('Upload/upload')}",
                            data:{
                                base64 : base64,
                            },
                            type : 'post',
                            dataType : 'json',
                            success : function (i) {
                                if (i.status == 1) {
                                    review_img.attr('src', i.path);
                                    text.attr('value', i.path);
                                    review_img.show();
                                } else {
                                    alert(i.info);
                                }
                            }
                        })
                        // 处理成功会执行
                    });
            };
        </script>
		<include file="Public:footer"/>

{pigcms{$hideScript}
	</body>
</html>