<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>个人资料</title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
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
</style>
</head>
<body id="fans" >
<div class="qiandaobanner"> <img src="{pigcms{$homepic}" > </div>
<div class="cardexplain">
<li class="nob">
<div class="beizhu"><?php if ($cardid){?><if condition="$cardInfo neq false">您可以修改你的会员卡信息。以下信息将作为消费凭证，请认真填写！ <else/>填写以下信息即可领取vip会员卡,红色字必填 </if><?php }else {echo '请先完善您的个人信息，红色为必填项';}?></div>
</li>
<ul class="round">
<if condition="$cardInfo neq false">
	<li>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
	<tr>
	<th><font color='red'>会员卡号</font></th>
	<td><input  type="text" class="px" readonly value="{pigcms{$cardnum}"></td>
	</tr>
	</table>
	</li>
</if>

<if condition="$conf['wechaname'] eq 0">
<else />
<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th><font color='red'>微信昵称</font></th>
<td><input name="wechaname" onfocus="check2(this)"
onblur="check1(this)"  type="text" class="px" id="wechaname" value="{pigcms{$info.wechaname}" placeholder="请输入您的微信名称"></td>
</tr>
</table>
</li>
</if>

<if condition="$conf['tel'] eq 0">
<else />
<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th><font color='red'>手机号码</font></th>
<td><input onfocus="check2(this)"
onblur="check3(this)" name="phone"  class="px" id="phone" value="{pigcms{$info.phone}"  type="text" placeholder="手机号码"></td>
</tr>
</table>
</li>
</if>
<if condition="$fans.id eq '' and $is_check eq '1'">
<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th><font color='red'>短信验证</font></th>
<td><input name="code"  class="code" id="code" value=""  type="text" placeholder="效验码"><a class="is_check" href="javascript:void(0);"><em id="num"></em><b>点击获取效验码</b></a></td>
</tr>
</table>
</li>
</if>
<if condition="$conf['truename'] eq 0">
<else />
<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th>真实姓名</th>
<td><input name="truename"  type="text" class="px" id="truename" value="{pigcms{$info.truename}" placeholder="请输入您的真实姓名"></td>
</tr>
</table>
</li>
</if>

<if condition="$conf['qq'] eq 0">
<else />

<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th>QQ号码</th>
<td><input name="qq"  class="px" id="qq" value="{pigcms{$info.qq}"  type="text" placeholder="请输入您的QQ号码"></td>
</tr>
</table>
</li>
</if>




</ul>



<if condition="$conf['portrait'] eq 0">
<else />
<ul class="round">
<li>
<style>
.por{width:65px;float:left;height:65px;}
.por img{width:60px;height:60px;cursor:pointer}
.por img.selected{border:2px solid #f60}
</style>
<script>
function selectpor(el){
	$("#portrait").val(el.src);
	$('#pors img').removeClass('selected');
	$('#portrait_src').attr('src',el.src);
	el.className='selected';
}
</script>
<div style="padding:10px 10px 10px 0;">请设置头像</div>
<input type="hidden" value="{pigcms{$info.portrait}" id="portrait" name="portrait" size="80" />
 <a href="###" onclick="upyunWapPicUpload('portrait',200,200,'{pigcms{$Think.get.token}')" class="a_upload" style="color:red">点击这里上传</a>
<div class="por"><img src="<if condition="$info.portrait neq ''">{pigcms{$info.portrait}<else/>/static/images/portrait.jpg</if>" id="portrait_src" /></div>
<div style="clear:both"></div>
或者选择下面头像
<div style="margin:10px 0 20px 0" id="pors">
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/1.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/2.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/3.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/4.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/5.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/6.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/7.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/8.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/9.jpg" /></div>
<div class="por"><img onclick="selectpor(this)" src="{pigcms{$static_path}images/portrait/10.jpg" /></div>
<div style="clear:both"></div>
</div>
</li>
</ul>
</if>



<ul class="round">

<if condition="$conf['sex'] eq 0">
<else />
<li>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th>性别</th>
<td><select name="sex" class="dropdown-select" id="sex">
<option  class="dropdown-option">请选择你的性别</option>
<option  value="1" <if condition="$info['sex'] eq 1">selected</if>>男</option>
<option  value="2" <if condition="$info['sex'] eq 2">selected</if>> 女</option>
<option  value="3" <if condition="$info['sex'] eq 3">selected</if>>其他</option>
</select></td>
</tr>
</table>
</li>
</if>

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

<script type="text/javascript">
$('.is_check').click(function(){
	if($('#num').html() != ''){
		return false;
	}
	var phone 	= $('#phone').val();
	reg=/^0{0,1}(13[0-9]|145|15[0-9]|18[0-9])[0-9]{8}$/i;
	 if(!reg.test(phone)){   
		alert("错误,请输入11位的手机号！");
		$('#tel').css('background','red');
		return;
	 }else{
		var num = $('#num').html();
		if(num == ''){
			$.post('wap.php?g=Wap&c=Userinfo&a=get_code&token={pigcms{$token}&cardid={pigcms{$cardid}', {phone:phone},
			function(data) {
				if(data.error == 0){
					$('#num').html('60');
					$('.is_check>b').html('后重新获取');
					count_down();
				}else{
					alert(data.info);
				}
			},"json");
		}
	 }
});
function count_down(){
	var down = setInterval(function(){
		var num 	= $('#num').html();
		if(num > 0){
			$('#num').html(num-1);
		}else{
			$('#num').html('');
			$('.is_check>b').html('点击获取效验码');
			clearInterval(down);
		}
	},1000);
}
$("#showcard").bind("click",
function() {
    var btn = $(this);
    var wechaname = $("#wechaname").val();
	var tel 	  = $("#phone").val();
	var truename  = $("#truename").val();
	var qq 		  = $("#qq").val();
	var sex 	  = $("#sex").val();
	var birthday  = $("#birthday").val();	
	var address   = $("#address").val();
	//var info  	  = $("#info").val();
	//var bornyear  = $("#bornyear").val();
	//var bornmonth = $("#bornmonth").val();
	//var bornday   = $("#bornday").val();
	var portrait  = $("#portrait").val();
	//var paypass   = $("#paypass").val();
	var code   	  = $("#code").val();


<if condition="$cardid neq '' && $conf['tel'] eq 0 && $cardInfo eq false"><else />	
    if (tel == '') {
        //alert("请认真输入手机号");
        return
    }
</if>

<if condition="$cardid neq '' && $conf['wechaname'] eq 0 && $cardInfo eq false"><else />    
    if (wechaname == '') {
        alert("请认真输入微信号");
        return
    }
</if>


   
    var submitData = {
        wechaname : wechaname,
        phone 	  : tel,
        truename  : truename,
        qq        : qq,
        sex 	  : sex,
        birthday  : birthday,
        address   : address,
//         info 	  : info,
//         bornyear  : bornyear,
//         bornmonth : bornmonth,
//         bornday   : bornday,
        cardid 	  : {pigcms{$cardid},
        portrait  : portrait,
//         paypass   : paypass,
        code	  : code,
        action: "index"
    };

	
	 
	
    $.post('wap.php?g=Wap&c=Userinfo&a=index&token={pigcms{$Think.get.token}&cardid={pigcms{$Think.get.cardid}', submitData,
    function(data) {
        if(data==1){			 
			alert('个人信息保存成功');
			<?php if ($redirectUrl){?>location.href = "{pigcms{$redirectUrl}";<?php }?>
		}else if(data==2){
			alert('成功领取了会员卡');
			location.href = "{pigcms{:U('Card/card',array('token'=>$_GET['token'],'cardid'=>$_GET['cardid']))}";
		}else if(data==3){
			alert('该商家会员卡缺货了');
		}else if(data==4){
			alert('您的积分不够领取改会员卡');
		}else if(data==5){
			alert('短信验证码无效');
		}else{
			alert('没有修改相关信息，修改后再试.');
		}
    },
    "json")
});

function check1(obj){	 
	if(obj.value == ''){
		alert("请输入您的微信名称.");
		document.getElementById(obj.id).style.background="red";
		return;
	}
}

function check2(obj){   
  	document.getElementById(obj.id).style.background="white";  
}
function check3(obj){
	if(obj.value == ''){
		alert('手机号码必须填写');
		document.getElementById(obj.id).style.background="red";
		return;
	}
	reg=/^0{0,1}(13[0-9]|145|15[0-9]|18[0-9])[0-9]{8}$/i;
	  if(!reg.test(obj.value)){   
			alert("错误,请输入11位的手机号！");
			document.getElementById(obj.id).style.background="red";
			return;
	 }
}

</script>
</div>
{pigcms{$hideScript}
</body>
</html>
