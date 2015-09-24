<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>发布约会</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
<link href="{pigcms{$static_path}userinfo/fans.css" rel="stylesheet" type="text/css"> 
<script src="{pigcms{$static_path}js/cookie.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script src="/static/js/alert.js"></script>
<style>
.footFix{width:100%;text-align:center;position:fixed;left:0;bottom:0;z-index:99;}
#footReturn a, #footReturn2 a {
display: block;
line-height: 41px;
color: #fff;
text-shadow: 1px 1px #282828;
font-size: 14px;
font-weight: bold;
}
#footReturn, #footReturn2 {
z-index: 89;
display: inline-block;
text-align: center;
text-decoration: none;
vertical-align: middle;
cursor: pointer;
width: 100%;
outline: 0 none;
overflow: visible;
Unknown property name.-moz-box-sizing: border-box;
box-sizing: border-box;
padding: 0;
height: 41px;
opacity: .95;
border-top: 1px solid #181818;
box-shadow: inset 0 1px 2px #b6b6b6;
background-color: #515151;
Invalid property value.background-image: -ms-linear-gradient(top,#838383,#202020);
background-image: -webkit-linear-gradient(top,#838383,#202020);
Invalid property value.background-image: -moz-linear-gradient(top,#838383,#202020);
Invalid property value.background-image: -o-linear-gradient(top,#838383,#202020);
background-image: -webkit-gradient(linear,0% 0,0% 100%,from(#838383),to(#202020));
Invalid property value.filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#838383',endColorstr='#202020');
Unknown property name.-ms-filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#838383',endColorstr='#202020');
}
.code{float:100%;float:left;margin:8px 10px 0 5px;padding:5px;width:80px;}
.is_check{float:left;margin:8px 0;padding:2px 10px;font-size:12px;border:1px solid #c1c1c1;background:#e6e6e6;border-radius:3px;}
.is_check:hover{background:#c1c1c1;}
#num{padding-right:5px;}
.window .title{background-image: linear-gradient(#179f00, #179f00);}
body{background-color: #FFFFFF;}
		</style>
</head>
<body>
	<!--header  class="navbar">
		<div class="nav-wrap-left">
			<a href="javascript:history.go(-1)" class="react back">
				<i class="text-icon icon-back"></i>
			</a>
		</div>
		<h1 class="nav-header">发布约会</h1>
		<div class="nav-wrap-right">
			<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
				<span class="nav-btn"></span>
			</a>
		</div>
	</header-->
	<div class="cardexplain">

	<ul class="round">
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>约会类型</th>
					<td>
						<select name="activity_type" class="dropdown-select" id="activity_type">
							<option value="0">吃饭 </option>
							<option value="1">看电影</option>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>时间</th>
					<td>
						<select id="date" name="date" class="dropdown-select">
							<volist name="date" id="d">
							<option value="{pigcms{$d[0]}">{pigcms{$d[1]} </option>
							</volist>
						</select>
					</td>
					<td>
						<select id="hour" name="hour" class="dropdown-select">
							<for start="0" end="24">
							<option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>" <if condition="$i eq 18">selected</if>><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
							</for>
						</select>
					</td>
					<td>
						<select id="minute" name="minute" class="dropdown-select">
							<for start="0" end="60">
							<option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
							</for>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>地点</th>
					<td>
						<a class="react" id="react_address" href="{pigcms{:U('Store/index', array('cat_url' => 'meishi'))}" href-data="{pigcms{:U('Store/index', array('cat_url' => 'dianying'))}">
							<div class="more more-weak">
							<input name="address" type="text" class="px" id="address" value="<if condition="$store['name']">{pigcms{$store['name']}<else />请选择</if>" />
							</div>
						</a>
						<input type="hidden" name="store_id" id="store_id" value="{pigcms{$store['store_id']}"/>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>性别</th>
					<td>
						<select name="obj_sex" class="dropdown-select" id="obj_sex">
							<option value="0">不限 </option>
							<option value="1">限男生</option>
							<option value="2">限妹子</option>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>类型</th>
					<td>
						<select name="pay_type" class="dropdown-select" id="pay_type">
							<option value="0">我买单</option>
							<option value="1">求请客</option>
							<option value="2">AA</option>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>其他说明</th>
					<td>
						<input name="note" type="text" class="px" id="note" value="" placeholder="请填写"/>
					</td>
				</tr>
			</table>
		</li>
	</ul>
	<div class="footReturn">
		<a id="showcard"  class="submit" >发布约会</a>
		<div class="window" id="windowcenter" >
			<div id="title" class="wtitle"><span class="close" id="alertclose"></span></div>
			<div class="content">
				<div id="txt"></div>
			</div>
		</div>
	</div>
	<div style="height:60px;" id="msg">&nbsp;</div>
</div>
<footer class="footermenu">
    <ul>
        <li>
            <a <if condition="ACTION_NAME eq 'datelist'">class="active"</if> href="{pigcms{:U('Invitation/datelist')}">
            <img src="{pigcms{$static_path}images/3YQLfzfunJ.png">
            <p>首页</p>
            </a>
        </li>
        <li>
            <a <if condition="in_array(ACTION_NAME, array('mydate', 'mysign'))">class="active"</if> href="{pigcms{:U('Invitation/mydate')}">
            <img src="{pigcms{$static_path}images/J0uZbXQWvJ.png">
            <p>我的</p>
            </a>
        </li>
        <li>
            <a href="{pigcms{$my_im}">
	            <img src="{pigcms{$static_path}images/2_09.png" />
	            <p>消息列表</p>
            </a>
        </li>
        <li>
            <a class="add">
            <img src="{pigcms{$static_path}images/1_08.png">
            <p>发起</p>
            </a>
        </li>
    </ul>
</footer>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
<script type="text/javascript">
<if condition="$store">
SetCookie('store_id', '{pigcms{$store.store_id}');
SetCookie('address', '{pigcms{$store.name}');
</if>
$(document).ready(function(){
	if (getCookie('minute') != null) $('#minute').val(getCookie('minute'));
	if (getCookie('hour') != null) $('#hour').val(getCookie('hour'));
	if (getCookie('date') != null) $('#date').val(getCookie('date'));
	if (getCookie('store_id') != null) $('#store_id').val(getCookie('store_id'));
	if (getCookie('pay_type') != null) $('#pay_type').val(getCookie('pay_type'));
	if (getCookie('obj_sex') != null) $('#obj_sex').val(getCookie('obj_sex'));
	if (getCookie('address') != null) $('#address').val(getCookie('address'));
	if (getCookie('note') != null) {
		$('#note').val(getCookie('note'));
// 		$('#note_html').val(getCookie('note'));
	}

	$('#note').keyup(function(){
		SetCookie($(this).attr('id'), $(this).val());
	});
	$('#showcard').click(function(){
		if ($("#store_id").val() < 1) {
			alert('还没有选择地点');
			return false;
		}
		$.post("{pigcms{:U('Invitation/save_date')}", {'minute':$('#minute').val(), 'hour':$('#hour').val(), 'date':$('#date').val(), 'store_id':$('#store_id').val(), 'obj_sex':$('#obj_sex').val(), 'pay_type':$('#pay_type').val()}, function(data){
			if (data.error_code) {
				alert(data.msg);
			} else {
				delCookie('store_id');
				delCookie('address');
				delCookie('minute');
				delCookie('hour');
				delCookie('date');
				delCookie('pay_type');
				delCookie('obj_sex');
				delCookie('note');
				location.href="{pigcms{:U('Invitation/mydate')}";
			}
		}, 'json');
	});
	
	$('select').change(function(){
		SetCookie($(this).attr('id'), $(this).val());
		if ($(this).attr('id') == 'activity_type') {
			if ($(this).val() == 0) {
				$('#react_address').attr('href', "{pigcms{:U('Store/index', array('cat_url' => 'meishi'))}");
			} else {
				$('#react_address').attr('href', "{pigcms{:U('Store/index', array('cat_url' => 'dianying'))}");
			}
		} 
	});
});
</script>
</body>
</html>