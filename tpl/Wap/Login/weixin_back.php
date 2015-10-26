<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>绑定帐号</title>
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
            <h1 class="nav-header">绑定帐号</h1>
            <div class="nav-wrap-right">
                <a class="react" href="{pigcms{:U('Home/index')}">
                    <span class="nav-btn"><i class="text-icon">⟰</i>首页</span>
                </a>
            </div>
        </header>
        <div id="container">
        	<div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
			<div id="login">
				<dl class="list">
					<dd class="nav">
						<ul class="taba taban noslide" data-com="tab">
							<li class="active" tab-target="login-form"><a class="react">绑定已有帐号</a>
							</li><li tab-target="reg-form"><a class="react">注册新帐号</a>
						</li><div class="slide" style="left:0px;width:0px;"></div>
						</ul>
					</dd>
				</dl>
			    <form id="login-form" autocomplete="off" method="post" action="{pigcms{:U('Login/weixin_bind')}" location_url="{pigcms{$referer}">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input id="login_phone" class="input-weak" type="tel" placeholder="手机号" name="phone" value="" required=""/>
			            		</dd>
			            		<dd class="dd-padding">
			            			<input id="login_password" class="input-weak" type="password" placeholder="请输入您的密码" name="password" required=""/>
			            		</dd>
			        		</dl>
			        	</dd>
			        </dl>
			        <div class="btn-wrapper">
						<button type="submit" class="btn btn-larger btn-block">绑定</button>
			        </div>
			    </form>
				<form id="reg-form" action="{pigcms{:U('Login/weixin_bind_reg')}" autocomplete="off" method="post" location_url="{pigcms{$referer}" style="display:none;">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input id="reg_phone" class="input-weak" type="tel" placeholder="手机号" name="phone" value="" required=""/>
			            		</dd>
			            		<dd class="kv-line-r dd-padding">
			            			<input id="reg_pwd_password" class="input-weak kv-k" type="password" placeholder="6位以上的密码"/>
			            			<input id="reg_txt_password" class="input-weak kv-k" type="text" placeholder="6位以上的密码" style="display:none;"/>
			            			<input type="hidden" id="reg_password_type" value="0"/>
			            			<button id="reg_changeWord" type="button" class="btn btn-weak kv-v">显示明文</button>
			            		</dd>
			            		<dd class="dd-padding">
			            			<input id="recomment" class="input-weak" type="text" placeholder="请输入推荐人ID" name="recomment" value="" required=""/>
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
                                <dd class="dd-padding">
                                    <input id="bank_name" class="input-weak" type="text" placeholder="请输入银行名称" name="bank_name" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <input id="bank_code" class="input-weak" type="text" placeholder="请输入银行卡号" name="bank_code" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <input id="bank_address" class="input-weak" type="text" placeholder="请输入开户行" name="bank_address" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <input id="bank_account" class="input-weak" type="text" placeholder="请输入开户人" name="bank_account" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <input id="alipay_account" class="input-weak" type="text" placeholder="请输入支付宝账号" name="alipay_account" value="">
                                </dd>
                                <dd class="dd-padding">
                                    <input id="alipay_name" class="input-weak" type="text" placeholder="请输入支付宝姓名" name="alipay_name" value="">
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
		<script src="{pigcms{$static_public}js/localResizeIMG4/lrz.bundle.js"></script>
		<script src="{pigcms{$static_path}js/weixin_back.js"></script>
		<script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>
		<if condition="!$config['weixin_login_bind']">
			$(document).ready(function(){
				layer.open({
					title:['提醒：','background-color:#8DCE16;color:#fff;'],
					content:'您可以直接将微信号作为用户登录，以后将无法绑定以前注册的手机号。<br/>如果您以前注册过账号，建议您绑定！',
					btn: ['绑定', '不绑定'],
					shadeClose: false,
					no: function(){
						layer.open({content: '你点了不绑定，正在跳转！', time:3});
						window.location.href = "{pigcms{:U('Login/weixin_nobind')}";
					}
				});
				return false;
			});
		  </if>
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
