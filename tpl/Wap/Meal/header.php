<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{pigcms{$title}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="{pigcms{$static_path}css/diancai.css" rel="stylesheet" type="text/css">
<script src="{pigcms{$static_path}js/cookie.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/jquery.min.js" type="text/javascript"></script>
</head>
<body class="sanckbg mode_webapp">
	<div class="menu_header"> 
		<div class="menu_topbar">
			<span class="head-title">{pigcms{$title}</span>
			<span class="head_btn_left"><a href="javascript:history.go(-1);">返回</a></span>
			<a class="head_btn_right" href="{pigcms{:U('Index/index', array('token' => $mer_id))}">
				<i class="menu_header_home"></i>
			</a>
		</div>
	</div>