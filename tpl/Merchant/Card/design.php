<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li class="active">添加会员卡</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form class="form" method="post" action="" target="_top" enctype="multipart/form-data">
								<div class="content">
									<div class="msgWrap bgfc">
									<table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody>
									<tr>
									<th width="303" rowspan="6" valign="top">
										<div class="vipcard">
											<img id="cardbg" src="<if condition="$card.diybg neq ''">{pigcms{$card.diybg}<else/>{pigcms{$card.bg}</if>">
											<img id="cardlogo" class="logo" src="{pigcms{$card.logo}">
											<h1 id="vipname" style="color:{pigcms{$card.vipnamecolor};">{pigcms{$card.cardname}会员卡</h1>
											<strong class="pdo verify" id="number" style="color:{pigcms{$card.numbercolor}"><span><em>会员卡号</em>6537 1998</span></strong>
										</div>
										<span class="red">Logo宽370px高170px，背景图宽534px高318px，图片类型png。<a href="/static/images/cart_info/template.rar" class="green">请下载模板</a></span>
									</th>
									<td colspan="2">会员卡的名称：
									<input type="text" name="cardname" value="{pigcms{$card.cardname}" id="cardname" class="px" style="width:200px;" onkeyup="DivFollowingText()"> 
									<script type="text/javascript">
									function DivFollowingText()
									{
									document.getElementById("vipname").innerHTML=document.getElementById("cardname").value+'会员卡';
									}
									</script> 
									颜色：
									<input type="text" name="vipnamecolor" id="vipnamecolor" value="{pigcms{$card.vipnamecolor}" class="px color" style="width: 55px; background:{pigcms{$card.vipnamecolor}; color: rgb(255, 255, 255);" onblur="document.getElementById('vipname').style.color=document.getElementById('vipnamecolor').value;">
									</td>
									</tr>
									<tr>
									<td colspan="2">最低积分要求：
									<input type="text" name="miniscore" id="miniscore" value="{pigcms{$card.miniscore}" class="px" style="width:100px;">  只有到达(含)这个积分后才可以申领此卡</td>
									</tr>
									<tr>
									<td colspan="2">会员卡的图标：
									<input type="text" name="logo" id="logo" value="{pigcms{$card.logo}" class="px" style="width:200px;"> 
									<input type="button" onclick="document.getElementById('cardlogo').src=document.getElementById('logo').value;" value="显示效果" class="btnGrayS"> 
									<a href="###" onclick="upyunPicUpload('logo',1000,600,'card')" class="a_upload">上传</a> 
									<a href="###" onclick="viewImg('logo')">预览</a>
									</td>
									</tr>
									<tr>
									<td colspan="2">会员卡的背景：
										<select name="bg" onchange="$('#cardbg').attr('src', $(this).val());" class="pt" style="width:210px;"> 
										<option selected="">请选择会员卡背景图</option>
											<?php 
												for($i=1;$i<=23;$i++){
													$i=$i<10?'0'.$i:$i;
													$str='./static/images/card/card_bg'.$i.'.png';
													if($card['bg']==$str){
														echo $str='<option value="'.$str.'" selected="selected" >'.$i.'</option>';
													}else{
														echo $str='<option value="'.$str.'">'.$i.'</option>';
													
													}
												}
											?>
											
										</select>
										&nbsp;&nbsp;&nbsp;&nbsp;
										卡号文字颜色：
									<input type="text" name="numbercolor" id="numbercolor" value="{pigcms{$card.numbercolor}" class="px color" style="width: 55px; background-image: none; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);" onblur="document.getElementById('number').style.color=document.getElementById('numbercolor').value;">
									</td>
									</tr>
									<tr>
									<td colspan="2">自己设计背景：
										<input type="text" name="diybg" id="bgs" class="px" value="{pigcms{$card.diybg}" style="width:200px;"> 
										<input type="button" onclick="$('#cardbg').attr('src', $('#bg').val());" value="显示效果" class="btnGrayS"> 
										<a href="###" onclick="upyunPicUpload('bgs',1000,600,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('bgs')">预览</a> 背景图
									</td>
									</tr>
									<tr>
									<td colspan="2">
									首页提示文字：
									<input type="text" name="msg" value="{pigcms{$card.msg}" id="tishi2" class="px" style="width:287px;" onkeyup="DivFollowingText2()"> 请不要超过20个字。
									<script type="text/javascript">
									function DivFollowingText2()
									{
										$("#tishi").html($("#tishi2").val());
									}
									</script>
									</td>
									</tr>
									<tr>
									<th width="303" rowspan="5" valign="top">
										<div class="vipcard">
											<h3>签到头部图片</h3>
											<img id="qiandao2_src" src="<if condition="$card.qiandao neq ''">{pigcms{$card.qiandao}<else/>/static/images/cart_info/qiandao.jpg</if>" style="width:265px;height:150px;">
											<br />
											<textarea name="qiandao" class="col-sm-3" id="qiandao2" style="width:265px; height:35px" onblur="document.getElementById('qiandao2_scr').src=document.getElementById('qiandao2').value;"><if condition="$card.qiandao neq ''">{pigcms{$card.qiandao}<else/>/static/images/cart_info/qiandao.jpg</if></textarea>
											<br />
											<a href="###" onclick="upyunPicUpload('qiandao2',700,420,'card')" class="a_upload">上传</a> 
											<a href="###" onclick="viewImg('qiandao2')">预览</a>
										</div>
									</th>
									<td colspan="2"></td>
									<!--td colspan="2">
									是否短信验证：
									<input type="radio" class="px" name="is_check" value="0" <if condition="$card.is_check eq 0">checked</if>>不验证&nbsp;&nbsp;
									<input type="radio" class="px" name="is_check" value="1" <if condition="$card.is_check eq 1">checked</if>>验证  &nbsp;&nbsp;(选择后，用户领取会员卡时则必须验证，注：使用此功能必须购买短信服务)
									</td-->
									</tr>
									<tr>
									<td colspan="2">
									会员卡使用说明：<br />
									<textarea class="col-sm-3" id="info" name="info" style="width: 300px; height: 150px; display: none;">{pigcms{$card.info}</textarea>
									</td>
									</tr>
									<tr>
									<td colspan="2"><button type="submit" class="btn btn-success">保存</button></td>
									</tr>
									</tbody>
									</table>
									</div> 
									<div class="cLineB">
										<h4 style="margin-left: 96px;">各内容页头部Benner图片设置<span class="FAQ">根据你企业的特色设计内容页头部图片，完全展示出不同的会员卡风格。</span></h4>
									</div> 
									<div class="msgWrap bgfc">
								 
								  	<table class="userinfoArea" style=" margin: 0;" border="0" cellspacing="0" cellpadding="0" width="100%"><tbody>
									 <tr>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/news-2.jpg">
												<img id="news2_src" src="{pigcms{$card.Lastmsg}">
												<img src="/static/images/cart_info/news-3.jpg">
											</div>
										</td>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/vippower-2.jpg">
												<img id="vippower2_src" src="{pigcms{$card.vip}">
												<img src="/static/images/cart_info/vippower-3.jpg"></div>
										</td>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/payre.jpg">
												<img id="payre2_src" src="{pigcms{$card.payrecord}">
												<img src="/static/images/cart_info/payre-3.jpg">
											</div>
										</td>
										<td align="center" valign="top">
											<div class="banner">
												<img src="/static/images/cart_info/shopping-2.jpg">
												<img id="shopping2_src" src="{pigcms{$card.shopping}">
												<img src="/static/images/cart_info/shopping-3.jpg">
											</div>
										</td>
									</tr>
								<tr>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								</tr>
								<tr>
									<td align="center">
										<textarea name="Lastmsg" class="px" id="news2" style="width:210px; height:36px" onblur="document.getElementById('news2_src').src=document.getElementById('news2').value;">{pigcms{$card.Lastmsg}</textarea><br>
										<a href="###" onclick="upyunPicUpload('news2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('news2')">预览</a>
									</td>
									<td align="center">
										<textarea name="vip" class="px" id="vippower2" style="width:210px; height:36px" onblur="document.getElementById('vippower2_src').src=document.getElementById('vippower2').value;">{pigcms{$card.vip}</textarea><br>
										<a href="###" onclick="upyunPicUpload('vippower2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('vippower2')">预览</a>
									</td>
									<td align="center">
										<textarea name="payrecord" class="px" id="payre2" style="width:210px; height:36px" onblur="document.getElementById('payre2_src').src=document.getElementById('payre2').value;">{pigcms{$card.payrecord}</textarea><br>
										<a href="###" onclick="upyunPicUpload('payre2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('payre2')">预览</a>
									</td>
									<td align="center">
										<textarea name="shopping" class="px" id="shopping2" style="width:210px; height:36px" onblur="document.getElementById('shopping2_src').src=document.getElementById('shopping2').value;">{pigcms{$card.shopping}</textarea><br>
										<a href="###" onclick="upyunPicUpload('shopping2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('shopping2')">预览</a>
									</td>
								 </tr>
								<tr>
								<td></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								</tr>
								<tr>
								<td align="center" valign="top">
									<div class="banner">
										<img src="/static/images/cart_info/user-2.jpg">
										<img id="user2_src" src="{pigcms{$card.memberinfo}">
										<img src="/static/images/cart_info/user-3.jpg">
									</div>
								</td>
								<td align="center" valign="top">
									<div class="banner">
										<img src="/static/images/cart_info/info-2.jpg">
										<img id="info2_src" src="{pigcms{$card.membermsg}">
										<img src="/static/images/cart_info/info-3.jpg">
									</div>
								</td>
								<td align="center" valign="top">
									<div class="banner">
										<img src="/static/images/cart_info/addr-2.jpg">
										<img id="addr2_src" src="{pigcms{$card.contact}">
										<img src="/static/images/cart_info/addr-3.jpg">
									</div>
								</td>
								 <td align="center" valign="middle">
								 	<div class="banner">
										<img src="/static/images/cart_info/rech.jpg">
										<img id="rech2_src" src="{pigcms{$card.recharge}">
										<img src="/static/images/cart_info/rech-3.jpg">
									</div>
								</td> 
								</tr>
								<tr>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td align="center">上传或填写外链地址查看效果</td>
								<td>&nbsp;</td>
								</tr>
								<tr>
								<td align="center">
									<textarea name="memberinfo" class="px" id="user2" style="width:210px; height:36px" onblur="document.getElementById('user2_src').src=document.getElementById('user2').value;">{pigcms{$card.memberinfo}</textarea><br>
									<a href="###" onclick="upyunPicUpload('user2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('user2')">预览</a>
								</td>
								<td align="center">
									<textarea name="membermsg" class="px" id="info2" style="width:210px; height:36px" onblur="document.getElementById('info2_src').src=document.getElementById('info2').value;">{pigcms{$card.membermsg}</textarea><br>
									<a href="###" onclick="upyunPicUpload('info2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('info2')">预览</a>
								</td>
								<td align="center">
									<textarea name="contact" class="px" id="addr2" style="width:210px; height:36px" onblur="document.getElementById('addr2_src').src=document.getElementById('addr2').value;">{pigcms{$card.contact}</textarea><br>
									<a href="###" onclick="upyunPicUpload('addr2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('addr2')">预览</a>
								</td>
								<td align="center">
									<textarea name="recharge" class="px" id="rech2" style="width:210px; height:36px" onblur="document.getElementById('rech2_src').src=document.getElementById('rech2').value;">{pigcms{$card.recharge}</textarea><br>
									<a href="###" onclick="upyunPicUpload('rech2',700,420,'card')" class="a_upload">上传</a> <a href="###" onclick="viewImg('rech2')">预览</a>
								</td>
								</tr>
								<tr>
								<td colspan="4" align="center"><button type="submit" class="btn btn-success">保存</button></td>
								</tr>
								</tbody>
								</table>
								</div> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script src="/static/js/cart/jscolor.js" type="text/javascript"></script>
<link rel="stylesheet" href="./static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./static/kindeditor/plugins/code/prettify.css" />
<script src="./static/kindeditor/kindeditor.js" type="text/javascript"></script>
<style type="text/css">
.vipcard{
margin: 0 auto;
position: relative;
height: 159px;
text-align: left;
width: 267px;
}
#cardbg{
height: 159px;
width: 267px;
position:absolute;
border-radius: 8px;
-webkit-border-radius:8px;
-moz-border-radius:8px;
box-shadow: 0 0 4px rgba(0, 0, 0, 0.6);
-moz-box-shadow:0 0 4px rgba(0, 0, 0, 0.6);
-webkit-box-shadow:0 0 8px rgba(0, 0, 0, 0.6);
top:0;
left:0;
z-index:1;
}
.vipcard .logo {
max-height:70px;
position:absolute;
top:8px;
left:5px;
z-index:2;
}
.vipcard .verify {
display:inline-block;
height:40px;
top:105px;
right:12px;
text-align:right;
line-height:24px;
color:#000;
font-size:20px;
text-shadow:0 1px rgba(255, 255, 255, 0.2);
z-index:2;
}

.vipcard h1 {
position:absolute;
right:10px;
top:7px;
text-shadow:0 1px rgba(255, 255, 255, 0.2);
color:#000;
font-size:11px;
line-height:25px;
text-align:right;
font-weight: normal;
z-index:2;
}
.vipcard .verify span {
display:inline-block;
text-align:left;
}
.vipcard .verify em {
display:block;
line-height:13px;
font-size:10px;
font-weight:normal;
font-style:normal;
}
.pdo {
position:absolute;
top:0;
left:0;
display:inline-block;
}
.userinfoArea td {
    padding: 8px 0 0px 15px;
}
#tishi{
text-align: center;display: block;
}
.banner{
display:block; width:213px;height: 278px;overflow: hidden;
}
.banner img{
display:block; width:213px; border:0;
}
.bannerbtn{ position:relative; display:block}
.bannerbtn .qiaodaobtn{ position: absolute; display:block; bottom:0}

</style>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#info', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
items : [
'source','undo','redo','copy','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
 '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist','link', 'unlink','']
});
});
</script>
<include file="Public:footer"/>