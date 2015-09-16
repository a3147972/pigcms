<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="format-detection" content="telephone=no" />	
		<title>微信支付</title>
		<script language="javascript">
			var param = {pigcms{:json_encode($weixin_param)};
			function callpay(){
				WeixinJSBridge.invoke("getBrandWCPayRequest",param,function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg=="get_brand_wcpay_request:ok"){
						document.getElementById("payDom").style.display="none";
						document.getElementById("successDom").style.display="";
						setTimeout("window.location.href = '{pigcms{$redirctUrl}'",2000);
					}else{
						if(res.err_msg == "get_brand_wcpay_request:cancel"){
							var err_msg = "您取消了支付";
						}else if(res.err_msg == "get_brand_wcpay_request:fail"){
							var err_msg = "支付失败<br/>错误信息："+res.err_desc;
						}else{
							var err_msg = res.err_msg +"<br/>"+res.err_desc;
						}
						document.getElementById("payDom").style.display="none";
						document.getElementById("failDom").style.display="";
						document.getElementById("failRt").innerHTML=err_msg;
					}
				});
			}
		</script>
		<link href="{pigcms{$static_path}css/weixin_pay.css" rel="stylesheet"/>
	</head>
	<body style="padding-top:20px;">
		{pigcms{$weixin_param}
		<div id="payDom" class="cardexplain">
			<ul class="round">
				<li class="title mb"><span class="none">支付信息</span></li>
				<li class="nob">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
						<tr><th>金额</th><td>{pigcms{$pay_money}元</td></tr>
					</table>
				</li>
			</ul>
			<div class="footReturn" style="text-align:center">
				<input type="button" style="margin:0 auto 20px auto;width:100%"  onclick="callpay()"  class="submit" value="点击进行微信支付" />
			</div>
		</div>
		<div id="failDom" style="display:none" class="cardexplain">
			<ul class="round">
				<li class="title mb"><span class="none">支付结果</span></li>
				<li class="nob">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
						<tr><th>支付失败</th><td><div id="failRt"></div></td></tr>
					</table>
				</li>
			</ul>
			<div class="footReturn" style="text-align:center">
				<input type="button" style="margin:0 auto 20px auto;width:100%"  onclick="callpay()"  class="submit" value="重新进行支付" />
			</div>
		</div>
		<div id="successDom" style="display:none" class="cardexplain">
			<ul class="round">
				<li class="title mb"><span class="none">支付成功</span></li>
				<li class="nob">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang"><tr><td>您已支付成功，页面正在跳转...</td></tr></table>
					<div id="failRt"></div>
				</li>
			</ul>
		</div>
	</body>
</html>