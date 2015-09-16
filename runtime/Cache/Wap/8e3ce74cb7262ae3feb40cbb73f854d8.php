<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>登录 - <?php echo ($config["site_name"]); ?></title>
	<meta name="description" content="<?php echo ($config["seo_description"]); ?>"/>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name='apple-touch-fullscreen' content='yes'/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>

    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/index_wap.css" rel="stylesheet"/>
	<link href="<?php echo ($static_path); ?>css/idangerous.swiper.css" rel="stylesheet"/>
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
            <h1 class="nav-header"><?php echo ($config["site_name"]); ?></h1>
            <div class="nav-wrap-right">
                <a class="react" href="<?php echo U('Home/index');?>">
                    <span class="nav-btn"><i class="text-icon">⟰</i>首页</span>
                </a>
            </div>
        </header>
        <div id="container">
        	<div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
			<div id="login">
			    <form id="login-form" autocomplete="off" method="post" action="<?php echo U('Login/index');?>" location_url="<?php echo ($referer); ?>">
			        <dl class="list list-in">
			        	<dd>
			        		<dl>
			            		<dd class="dd-padding">
			            			<input id="phone" class="input-weak" type="text" placeholder="手机号" name="phone" value="<?php echo ($_COOKIE["login_name"]); ?>" required=""/>
			            		</dd>
			            		<dd class="dd-padding">
			            			<input id="password" class="input-weak" type="password" placeholder="请输入您的密码" name="password" required=""/>
			            		</dd>
			        		</dl>
			        	</dd>
			        </dl>
			        <div class="btn-wrapper">
						<button type="submit" class="btn btn-larger btn-block">登录</button>
			        </div>
			    </form>
			</div>
			<ul class="subline">
			    <li><a href="<?php echo U('Login/reg');?>">立即注册</a></li>
			</ul>
		</div>
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<!--script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
		<script>
			if(is_weixin()){var location_url = "<?php echo U('Login/weixin');?>";layer.open({title:'提示',content:'跳转到微信登录',end:function(){window.location.href=location_url;}});window.location.href = location_url}
		</script-->
		<script src="<?php echo ($static_path); ?>js/login.js"></script>
				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
	    <footer class="footermenu">
		    <ul>
		        <li>
		            <a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
		            <img src="<?php echo ($static_path); ?>images/3YQLfzfunJ.png">
		            <p>首页</p>
		            </a>
		        </li>
		        <li>
		            <a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
		            <img src="<?php echo ($static_path); ?>images/Lngjm86JQq.png">
		            <p><?php echo ($config["group_alias_name"]); ?></p>
		            </a>
		        </li>
		        <li>
		            <a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal'))): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index');?>">
		            <img src="<?php echo ($static_path); ?>images/s22KaR0Wtc.png">
		            <p><?php echo ($config["meal_alias_name"]); ?></p>
		            </a>
		        </li>
		        <li>
		            <a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png">
		            <p>我的</p>
		            </a>
		        </li>
		    </ul>
		</footer>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        

<?php echo ($hideScript); ?>
	</body>
</html>