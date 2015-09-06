<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/common1.css" media="all">
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/color1.css" media="all">
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}meal/css/nav.css" media="all">
<script type="text/javascript" src="{pigcms{$static_path}meal/js/jquery_min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/main.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/helper.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/booklist.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/showdialog.js"></script>
<title>{pigcms{$config.meal_alias_name}店铺列表</title>
	
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<!-- Mobile Devices Support @begin -->
		
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes"> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<!-- Mobile Devices Support @end -->
</head>
<body onselectstart="return true;" ondragstart="return false;">
<script src="http://api.map.baidu.com/getscript?v=2.0&ak=R2iop4Bpf3nfXVAeTTEH1uep&services=&t=20150506165027"></script>
<script>
	var List={pigcms{$list};
	var total = {pigcms{$total};
	function searchList(){
		var searchStr = document.getElementById("search").value;
		var url = "{pigcms{:U('Food/index', array('mer_id' => $mer_id))}&searhkey="+encodeURIComponent(searchStr);
        window.location.href = url;
	}
</script>
	
<div data-role="container" class="container list">
	<header data-role="header" class="searchdiv" style="display: none;">	
		<form action="javascript:searchList()">
			<input type="search" value="" placeholder="请输入餐厅名或地址" class="search" id="search">
		</form>	
	</header>
	<section data-role="body" class="section_scroll_content">
		<ul class="list order" id="booklist">
		</ul>
	</section>
	<footer data-role="footer">
		<nav class="nav">
			<ul class="box">
				<li>
					<a href="{pigcms{:U('Index/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
						<span class="home">&nbsp;</span>
						<label>首页</label>				
					</a>
				</li>
				<li class="on">
					<a href="{pigcms{:U('Food/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
						<span class="order">&nbsp;</span>
						<label>在线点餐</label>				
					</a>
				</li>
				<li>
					<a href="{pigcms{:U('Food/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
						<span class="book">&nbsp;</span>
						<label>在线订位</label>				
					</a>
				</li>
				<li >
					<a href="{pigcms{:U('Food/order_list', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
						<span class="my">&nbsp;</span>
						<label>我的订单</label>
					</a>
				</li>
			</ul>
		</nav>
	</footer>
</div>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
</html>