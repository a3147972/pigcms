<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<script type="text/javascript" src="{pigcms{$static_path}takeout/js/jquery1.8.3.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/main.js"></script>

<title>外卖店铺列表</title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta content="telephone=no, address=no" name="format-detection">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<style  type="text/css">
.search input, .ico_takeout, .ico_order, .ico_addres, .ico_tel, .ico_arrow, .ico_addres1, .ico_menu i, .menu_list .btn, .cart_num, .ico_close, .pay_type li input:checked::after, .dialog_close, .ico_status i, .shopping_cart .cart_bg, .ico_rest{display: inline-block; background: url({pigcms{$static_path}takeout/image/s.png) no-repeat; background-size: 150px auto;}
.fixed, .store_list li, .box, .box li, .side_nav, .side_nav a, .menu_tt h2, .menu_list li, .menu_list .btn, .menu_list .num, .pay_type, .timeBox div, .timeBox a, .txt, .my_order li, .detail_tools, .my_menu_list, .my_menu_list th, .my_menu_list td, .store_info, .ico_menu_wrap, .menu_wrap.skin1 .menu_nav{-webkit-border-image: url({pigcms{$static_path}takeout/image/border.gif) 2 stretch;}
.store_list .img_tt > div{display: block; width: 62px; height: 62px; padding: 6px; background: url({pigcms{$static_path}takeout/image/img_bg.png) no-repeat; background-size: cover;}
.nopic{background: #e4e4e4 url({pigcms{$static_path}takeout/image/nopic.png) center center no-repeat; background-size: 61px auto; border-radius: 3px;}
.sales{display: inline-block; width: 66px; height: 10px; background: url({pigcms{$static_path}takeout/image/star.png) 0 0 repeat-x; background-size: 14px auto; margin-left: 4px; vertical-align: -1px;}
.sales strong{display: inline-block; width: 0; height: 10px; background: url({pigcms{$static_path}takeout/image/star.png) 0 -12px repeat-x; background-size: 14px auto; vertical-align: top;}
.menu_wrap.skin1 .menu_nav{right: auto; left: 0; width: 84px; padding-left: 10px; background: url({pigcms{$static_path}takeout/image/nav_bg.jpg) no-repeat; background-size: 100% 100%; border-width: 0 1px 0 0;}
.ico_success, .ico_failure{display: inline-block; width: 88px; height: 88px; border: 2px solid #ff5f32; border-radius: 88px; background: url({pigcms{$static_path}takeout/image/success.png) -2px -2px no-repeat; background-size: 92px auto;}
.ico_score, .ico_score strong{background: url({pigcms{$static_path}takeout/image/star1.png) repeat-x; background-size: 33px auto;}
.ico_scored, .ico_scored strong{background: url({pigcms{$static_path}takeout/image/star2.png) repeat-x; background-size: 15px auto;}
</style>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}takeout/css/main.css" media="all">
</head>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/index.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/helper.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<script src="http://api.map.baidu.com/getscript?v=2.0&ak=R2iop4Bpf3nfXVAeTTEH1uep&services=&t=20150506165027"></script>
<script>
function searchList()
{
	var search_content = $.trim($("#searchTxt").val());
	var pattern = /[`~!@#$%^&*()=|{}':;',\\.<>《》\/?~！@#￥……&*（）—|{}【】‘；：”“'。，、？]/;
	if(pattern.test(search_content)){
		alert('搜索关键字不能包含特殊字符');
		return false;
	}         
	var url = "";
	if(null != search_content && search_content != "") url = "{pigcms{:U('Takeout/index', array('mer_id' => $mer_id))}&searhkey="+encodeURIComponent(search_content);
	else url = "{pigcms{:U('Takeout/index', array('mer_id' => $mer_id))}";
	location.href = url;
}
var uri = "{pigcms{:U('Takeout/store_list', array('mer_id' => $mer_id, 'searhkey' => $searhkey))}";
var APP = {
	urls:{
		getStores: uri
	}
}
</script>
	<div class="container">
		<header class="search">
			<form action="javascript:searchList()">
				<input type="search" placeholder="搜索店名或地址" id="searchTxt" value="{pigcms{$searhkey}">
			</form>
		</header>
		<section>
			<ul class="store_list" id="storeList"></ul>
		</section>
		<footer class="order_btns">
			<div class="fixed">
				<a href="{pigcms{:U('Takeout/index', array('mer_id'=>$mer_id))}" class="on"><i class="ico_takeout"></i>叫外卖</a> 
				<a href="{pigcms{:U('Takeout/order_list', array('mer_id'=>$mer_id))}"><i class="ico_order"></i>我的订单</a>
			</div>
		</footer>
	</div>
	<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
</html>