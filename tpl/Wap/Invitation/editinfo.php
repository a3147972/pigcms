<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>{pigcms{$user['nickname']}</title>
<meta name="keywords" content="{pigcms{$now_category.cat_name},{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}">
<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name='apple-touch-fullscreen' content='yes'>
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="address=no">

<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
<link href="{pigcms{$static_path}userinfo/fans.css" rel="stylesheet" type="text/css"> 

<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script src="/static/js/upyun.js"></script>
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
<body id="index" data-com="pagecommon">
	<!--header  class="navbar">
		<div class="nav-wrap-left">
			<a href="javascript:history.go(-1)" class="react back">
				<i class="text-icon icon-back"></i>
			</a>
		</div>
		<h1 class="nav-header">{pigcms{$user['nickname']}</h1>
		<div class="nav-wrap-right">
			<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown" href="{pigcms{:U('Invitation/datelist')}">
			<span class="nav-btn">
				<i class="text-icon">≋</i>列表
			</span>
			</a>
		</div>
	</header-->

<div class="cardexplain">
	<ul class="round">
	<li>
	<style>
	.por{width:65px;float:left;height:65px;}
	.por img{width:60px;height:60px;cursor:pointer}
	.por img.selected{border:2px solid #f60}
	</style>
	<div style="padding:10px 10px 10px 0;">请设置头像</div>
	<input type="hidden" value="{pigcms{$info.avatar}" id="avatar" name="avatar" size="80" />
	 <a href="javaacript:;" onclick="upyunWapPicUpload('avatar',200,200)" class="a_upload" style="color:red">点击这里上传</a>
	<div class="por"><img src="{pigcms{$info.avatar}" id="avatar_src" /></div>
	<div style="clear:both"></div>
	</li>
	</ul>

	<ul class="round">
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>交友宣言</th>
					<td><input type="text" class="px" value="{pigcms{$info.message}" name="message" id="message" placeholder="想对附近人说点什么" /></td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>交友昵称</th>
					<td><input name="nickname" type="text" class="px" id="nickname" value="{pigcms{$info.nickname}" /></td>
				</tr>
			</table>
		</li>
		<!--li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>情感状态</th>
					<td>
						<select name="sex1" class="dropdown-select" id="sex1">
						<option  value="1" <if condition="$info['sex'] eq 1">selected</if>>保密</option>
						<option  value="2" <if condition="$info['sex'] eq 2">selected</if>> 单身</option>
						<option  value="3" <if condition="$info['sex'] eq 3">selected</if>>恋爱中</option>
						<option  value="4" <if condition="$info['sex'] eq 3">selected</if>>已婚</option>
						</select>
					</td>
				</tr>
			</table>
		</li-->
	</ul>
	<ul class="round">
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>性别</th>
					<td>
						<select name="sex" class="dropdown-select" id="sex">
						<option  value="1" <if condition="$info['sex'] eq 1">selected</if>>男</option>
						<option  value="2" <if condition="$info['sex'] eq 2">selected</if>> 女</option>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>出生年</th>
					<td>
						<select name="year" class="dropdown-select" id="year">
						<for start="1895" end="2016">
						<option value="{pigcms{$i}" <if condition="$info['year'] eq $i">selected</if>>{pigcms{$i}</option>
						</for>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>出生月</th>
					<td>
						<select name="month" class="dropdown-select" id="month">
						<for start="1" end="13">
						<option value="{pigcms{$i}" <if condition="$info['month'] eq $i">selected</if>><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
						</for>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>出生日</th>
					<td>
						<select name="day" class="dropdown-select" id="day">
						<for start="1" end="32">
						<option value="{pigcms{$i}" <if condition="$info['day'] eq $i">selected</if>><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
						</for>
						</select>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
				<tr>
					<th>职业</th>
					<td>
						<select name="occupation" class="dropdown-select" id="occupation">
						<volist name="occupations" id="o">
						<option  value="{pigcms{$o['pigcms_id']}" <if condition="$o['pigcms_id'] eq $info['occupation']">selected</if>>{pigcms{$o['name']} ({pigcms{$o['info']})</option>
						</volist>
						</select>
					</td>
				</tr>
			</table>
		</li>
	</ul>
	
	<div class="footReturn">
		<a id="showcard"  class="submit" >提交信息</a>
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
<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
<script src="{pigcms{$static_path}js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.add').click(function(){
    	$.get("{pigcms{:U('Invitation/isrelease')}", function(data){
		    if (data.error_code) {
			    var pid = data.pigcmsid;
			    art.dialog.confirm('您有一个约会活动正在进行，只有放<br/>弃后才能发起新的约会，是否放弃？', function(){
				    $.get("{pigcms{:U('Invitation/cancel')}",{'pigcms_id':pid}, function(response){
					    if (response.error_code) {
					    	alert(response.msg);
					    } else {
							location.href="{pigcms{:U('Invitation/release_date')}";
					    }
	    			}, 'json');
    			});
   			} else {
    			location.href="{pigcms{:U('Invitation/release_date')}";
    		}
    	}, 'json');
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#showcard").bind("click", function() {
	    var btn = $(this);
	    var nickname = $("#nickname").val();
		var avatar 	  = $("#avatar").val();
		var message  = $("#message").val();
		var sex 	  = $("#sex").val();
		var year  = $("#year").val();	
		var month   = $("#month").val();
		var day  	  = $("#day").val();
		var occupation  = $("#occupation").val();
	    var submitData = {
    		nickname : nickname,
    		avatar : avatar,
    		message : message,
        	sex : sex,
        	year : year,
        	month : month,
        	day : day,
        	occupation : occupation
	    };
		
	    $.post('wap.php?g=Wap&c=Invitation&a=saveinfo', submitData, function(data) {
	        if (data.error_code == 1) {			 
				alert(data.msg);
			} else {
				location.href='wap.php?g=Wap&c=Invitation&a=userinfo&uid='+ data.uid;
			}
	    },
	    "json")
	});
});
</script>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
</html>
