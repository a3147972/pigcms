<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>商家中心</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<script src="{pigcms{:C('JQUERY_FILE')}"></script> 
</head>
<style type="text/css">
.m_nav{height: 50px;line-height: 50px;background: #FF658E;padding-left: 12px;color:#FFF;font-size: 16px;}
.m_nav a{color:#FFF;text-decoration:none;cursor: pointer;}
</style>
<body style="background-color:#f0efed;margin: 0;">
    <div class="m_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Commerce&a=index">商家中心</a> &gt; <a href="javascript:;" style="color:#FAFDCC;">商家二维码</a></span> 
   </div> 
	<div id="erwm" style="text-align: center; vertical-align: middle;margin:0 auto;margin-top:20px">
		<img src="{pigcms{$qrcodeinfo['qrcode']}">
	</div>
	<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
<script type="text/javascript">
 var w=$('body').width();
 if(w>320){
    w=320;
 }else{
   w=w-20;
 }
 $('#erwm img').css('width',w);

</script> 
</html>