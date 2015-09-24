<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
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