<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>支付跳转</title>
</head>
<body style="background:#F0F0F0;">
	<div style="margin-top:150px;text-align:center;">支付跳转中,请稍等..</div>
	<if condition="$url">
		<script>window.location.href = '{pigcms{$url}';</script>
	<elseif condition="$form"/>
		{pigcms{$form}
	</if>
</body>
</html>