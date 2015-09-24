function MSGwindowShow(action,showid,str,url,formcode){
	var sys_tips = '<div class="sys_tips" id="sys_tips" style="display:none;"><div class="hd" id="sys_tips_title"></div><div class="bd"><p id="sys_tips_info"></p><div class="btn"><a href="#" class="btn2" id="sys_tips_submit">确定</a></div></div></div>';
	if(!$('#sys_tips')[0]){
		$('body').append(sys_tips);
	}
	var pay_tips = $('#pay_tips'),sys_tips = $('#sys_tips'),sys_tips_title = $('#sys_tips_title'),sys_tips_info = $('#sys_tips_info'),sys_tips_submit = $('#sys_tips_submit');
	if(action === "pay"){
		$('#have_login').hide();
		if(showid=="2"){//正常提交
			if(document.getElementById('formcode')){
				document.getElementById('formcode').value=formcode;//赋值code
				document.forms['submitpay'].submit();//提交支付
				//这里添加支付中信息提示窗口
				pay_tips.show();
				var w_h = $(window).height(),d_h = pay_tips.height(),s_h = $(document).scrollTop(),top_val = (w_h-d_h)/2+s_h;
				pay_tips.css({'top':top_val+'px'});
			}
		}else if(showid=="1"){//成功提示加跳转
			if(!!win){win.close();}
			showConsole('恭喜您！',!0);
		}else if(showid=="0"){//提示不跳转
			if(!!win){win.close();}
			showConsole('温馨提示',!1);
		}else if(showid=="4"){//错误提示不跳转
			if(!!win){win.close();}
			showConsole('出错了',!1);
		}else{//提示加跳转
			if(!!win){win.close();}
			showConsole('温馨提示',!0);
		}
		if(document.getElementById('formcode')){
			document.getElementById('formcode').value="payok";//设置默认值防止二次提交
		}
	}else{
		if(showid=="0"){ //只提示不跳转
			showConsole('提示',false);
		}else if(showid=="1"){ //提示加跳转
			showConsole('提示',true);
		}else if(showid=="2"){ //直接跳转
			windowlocationhref(url);
		}
		else if(showid=="3"){ //错误信息加跳转
			showConsole('出错了',true);
		}else if(showid=="4"){ //错误信息加只提示不跳转
			showConsole('出错了',false);
		}else{
			return false;
		}
	}
	
	function showConsole(tit,isredirect){
		sys_tips_info.html(str);
		sys_tips_title.html(tit);
		sys_tips_submit.bind('click',function(e){
			e.preventDefault();
			sys_tips.hide();
			isredirect&&windowlocationhref(url);
		});
		sys_tips.show();
		var w_h = $(window).height(),d_h = sys_tips.height(),s_h = $(document).scrollTop(),top_val = (w_h-d_h)/2+s_h;
		sys_tips.css({'top':top_val+'px'});
	}
}
function windowlocationhref(url){
	if(url.length > 5){window.location.href=url;}
}
function weixinX4(){
	var weixinImg = $('#weixinImg');
	if(weixinImg.attr('src')===''){return;}
	var pnode = $('#weixinX4'),node = pnode.find('.node');
	pnode.hover(function(){node.toggle()});
}
function showMap(mapdomid){
	var wrap_node = document.createElement('div');
	wrap_node.setAttribute('class','map_iframe');
	wrap_node.id='map_iframe';
	wrap_node.style.display='none';
	
	var myiframe = '<a href="javascript:close_map();" class="close_map">关闭</a><iframe src="'+nowdomain+'ezmarker/map.aspx?action=shop&id='+mapdomid+'" scrolling="no" frameBorder="0" width="700" height="500"></iframe>';
	if(document.getElementById('map_iframe')){
		document.getElementById('map_iframe').style.display='block';
		return false;
	}
	wrap_node.innerHTML=myiframe;
	document.getElementsByTagName('body')[0].appendChild(wrap_node);
	document.getElementById('map_iframe').style.display='block';
	return false;
}
function close_map(){
	document.getElementById('map_iframe').style.display='none';
}
function loginout(siteUrl){
	var url = siteUrl+"request.ashx?action=loginout&json=1&jsoncallback=?&date=" + new Date();
	$.getJSON(url,function(data){
		
		if(data[0].islogin === '0'){
			if(data[0].bbsopen === "open"){
				var   f=document.createElement("IFRAME")   
				f.height=0;   
				f.width=0;   
				f.src=data[0].bbsloginurl;
				if (f.attachEvent){
					f.attachEvent("onload", function(){
						window.location.reload();
					});
				} else {
					f.onload = function(){
						window.location.reload();
					};
				}
				document.body.appendChild(f);
			}else{
				window.location.reload();
			}
		}else{
			alert("对不起，操作失败！");
		}
	}).error(function(){alert("对不起，操作失败！");});
}
function is_login(siteUrl,tplPath){
	var url = siteUrl+"request.ashx?action=islogin&json=1&jsoncallback=?&date=" + new Date(),
		node = $("#login_info"),txt='',txt_cm='';
	var hash = '?from='+encodeURIComponent(window.location.href);
	var sj_btn = "";
	
	if(typeof siteUrl !== 'undefined'){window['siteUrl'] = siteUrl;}
	if(typeof tplPath !== 'undefined'){window['tplPath'] = tplPath;}
	
	$.getJSON(url,function(data){
		if(data[0].islogin==="1"){
			if(data[0].jibie === '1'||data[0].jibie === '2'||parseInt(data[0].manageshopid)>0){
				sj_btn = " <a href=\""+siteUrl+"member/userindex_s.aspx\" class=\"shangjia\" target=\"_blank\">商家平台</a>";
			}
			txt=txt_cm="<span class=\"login_success\"><span class=\"username\">"+data[0].name+"</span>，您好！<a href=\""+siteUrl+"member/index.html\">管理</a>"+sj_btn+" <a href=\"javascript:loginout('"+siteUrl+"');\">退出</a></span>";
			txt+="<input value=\"1\" id=\"isLogin\" type=\"hidden\" /><input value=\""+data[0].jibie+"\" id=\"user_jibie\" type=\"hidden\" />";
			if(data[0].shopid>0 && data[0].getnewmyorder==='0'){
				orderPolling();
			}
			if(data[0].shopid>0 && data[0].getnewmyorder==='1'){
				hasNewOrder();
			}
		}else{
			txt="<a href=\""+siteUrl+"member/login.html"+hash+"\" class=\"sys_btn\">登录</a><a href=\""+siteUrl+"member/register.html\" class=\"sys_btn\">注册</a><input value=\"0\" id=\"isLogin\" type=\"hidden\" />";
			txt_cm="<li class=\"bor\">您好，先登录再发言！<a a href=\""+siteUrl+"member/login.html"+hash+"\">登录</a></li><li>还没有账号？<a href=\""+siteUrl+"member/register.html\">免费注册</a></li><li class=\"yellow\" id=\"youke\" style=\"display:none;\">网友：</li><li class=\"youke_li\" style=\"float:right;\"><input value=\"1\" id=\"commentyouke\" name=\"commentyouke\" type=\"checkbox\" style=\"vertical-align:middle;\" /> 游客直接发表 </li>";
		}
		node.prepend(txt);
		$(document).ready(function(){
			var cm_node = $("#login_info_cm");
			cm_node[0]&&cm_node.html(txt_cm);
			var node2 = $("#login_info2");
			node2[0]&&node2.prepend(txt);
		});
	}).error(function(err){
		//alert(err);
	});
}
var orderPollingFrame = (function(){       
	return function(callback,speed){       
		window.setTimeout(callback, speed);
	};       
})();   
function orderPolling(notplay){
	orderPollingFrame(orderPolling,60000);
	//轮询处       
	var url = window['siteUrl']+'request.ashx?action=getnewmyorder&jsoncallback=?&timer='+Math.random();
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			
			hasNewOrder(notplay);
		}else{
			$('#newOrderId:visible').hide();
		}
	}); 
}
function hasNewOrder(notplay){
	var newOrderId='newOrderId';
	var node = $("#login_info");
	var newOrderNode = '<a href="'+window['siteUrl']+'member/manage_order.aspx" target="_blank" class="'+newOrderId+'" style="display:none;" id="'+newOrderId+'"><span class="arrow"></span>有新订单</a>';
	if(!$('#'+newOrderId)[0]){
		$.ajax({url:window['tplPath']+"js/jquery.jplayer.min.js",dataType:'script'}).done(function(){
			setTimeout(function(){
				$('body').append('<div id="jquery_jplayer"></div>');
				window['my_jPlayer'] = $("#jquery_jplayer");
				
				my_jPlayer.jPlayer({
						ready: function (event) {
							$(this).jPlayer("setMedia",{mp3: window['tplPath']+'images/message.mp3'});
							if(typeof notplay === 'undefined'){window['my_jPlayer'].jPlayer('play');}
						},
						swfPath: window['tplPath']+"js", // jquery.jplayer.swf 文件存放的位置
						supplied: "mp3",
						wmode: "window"
				});
				
			},200);
		});
		node.addClass('po_re').append(newOrderNode);
		$('#'+newOrderId).show().bind('click',function(){$(this).hide();setTimeout(function(){orderPolling(!0);},2000);});
	}else{
		$('#'+newOrderId).show();
		if(typeof notplay === 'undefined'){window['my_jPlayer'].jPlayer('play');}
	}
}
function isIE6(){return getIEVersion() === '6'}
function getIEVersion(){
	var a=document;
	if(a.body.style.scrollbar3dLightColor!=undefined){
		if(a.body.style.opacity!=undefined){
			return "9"
		}else if(a.body.style.msBlockProgression!=undefined){
			return "8"
		}else if(a.body.style.msInterpolationMode!=undefined){
			return "7"
		}else if(a.body.style.textOverflow!=undefined){
			return "6"
		}else{
			return "IE5.5"
		}
	}
	return false;
}
$.returnTop=function(node){
	var node = $('<a href="#" alt="返回顶端" id="returnTop">返回顶端</a>');
	$(document).ready(function(){$('body').append(node)});
	var b = node.click(function(event){
		event.preventDefault();
		$("html,body").animate({scrollTop: 0},300);
	}),
	c = null;
	$(window).bind("scroll",function(){
	   var d = $(document).scrollTop(),
	   e = $(window).height();
	   0 < d ? b.css("bottom", "10px") : b.css("bottom", "-200px");
	   isIE6() && (b.hide(),clearTimeout(c),c = setTimeout(function(){
			0 < d ? b.show() : b.hide();
			clearTimeout(c);
		},
		300), b.css("top", d + e - 51))
	});
}