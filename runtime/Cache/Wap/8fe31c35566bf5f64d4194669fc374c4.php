<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
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
        <?php if($_GET['OkMsg']): ?><div id="tips" class="tips tips-ok" style="display:block;"><?php echo ($_GET["OkMsg"]); ?></div>
        <?php else: ?>
        	<div id="tips" class="tips"></div><?php endif; ?>
        <div id="pg-account">
		    <dl class="list">
		    	<dd>
		    		<dl>
				        <dd>
					        <a class="react" href="<?php echo U('My/username');?>">
						        <div class="more more-weak">
						            <i class="text-icon">⍥</i>
						            <span><?php echo ($now_user["nickname"]); ?></span>
						            <span class="more-after">修改</span>
						        </div>
					        </a>
				        </dd>
						<?php if($now_user['phone']): ?><dd>
								<a class="react" href="<?php echo U('My/password');?>">
									<div class="more more-weak"><span class="text-icon">⚿</span> 修改登陆密码</div>
								</a>
							</dd>
						<?php else: ?>
							<dd>
								<a class="react" href="<?php echo U('My/bind_user');?>">
									<div class="more more-weak"><span class="text-icon">⚿</span> 绑定手机号码</div>
								</a>
							</dd><?php endif; ?>
				        <dd>
				        	<a class="react" href="<?php echo U('My/adress');?>">
				        	<div class="more more-weak"><span class="text-icon">⛟</span> 收货地址管理</div>
				        	</a>
				        </dd>
						<dd>
				        	<a class="react" href="<?php echo U('My/levelUpdate');?>">
				        	<div class="more more-weak"><span class="text-icon">⍥</span> 等级管理</div>
				        	</a>
				        </dd>
						<dd>
				        	<a class="react" href="<?php echo U('My/recharge');?>">
				        	<div class="more more-weak"><span class="text-icon">☎</span> 余额充值</div>
				        	</a>
				        </dd>
		    </dl></dd></dl>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
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