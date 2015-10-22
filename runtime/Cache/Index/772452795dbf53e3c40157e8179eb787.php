<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>跳转提示</title>
	</head>
	<body id="body">
		<style>
		body {margin:0;padding:0;background:#f8f8f8}
		div { font-size:12px;}
		a:link {COLOR: #0a4173; text-decoration:none;}
		a:visited {COLOR: #0a4173; text-decoration:none;}
		a:hover {COLOR: #1274ba; text-decoration:none;}
		a:active {COLOR: #1274ba; text-decoration:none;}
		</style>
		<div style="background:#fff;font-size:14px;width:600px; margin:60px auto; line-height:48px;height:48px;text-align:center;padding:60px 30px;border:5px solid #f3f3f3">
			<?php if(isset($message)): ?><img src="<?php echo ($config["site_url"]); ?>/static/js/artdialog/skins/icons/face-smile.png" align="absmiddle" />&nbsp;&nbsp;<?php echo($message); else: ?><img src="<?php echo ($config["site_url"]); ?>/static/js/artdialog/skins/icons/face-sad.png" align="absmiddle" />&nbsp;&nbsp;<?php echo($error); endif; ?><br/><span style="font-size:12px;color:#999"><b id="wait"><?php echo($waitSecond); ?></b> 秒后将自动跳转，如果您的浏览器不能跳转</span> <a style="font-size:12px;" id="href" href="<?php echo($jumpUrl);?>">请点击</a>
		</div>
		<script type="text/javascript">
			(function(){
				var wait = document.getElementById('wait'),href = document.getElementById('href').href;
				var interval = setInterval(function(){
					var time = --wait.innerHTML;
					if(time <= 0) {
						location.href = href;
						clearInterval(interval);
					};
				}, 1000);
			})();
		</script>
	</body>
</html>