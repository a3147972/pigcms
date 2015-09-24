if(!Array.prototype.map)
Array.prototype.map = function(fn,scope) {
	var result = [],ri = 0;
	for (var i = 0,n = this.length; i < n; i++){
		if(i in this){
			result[ri++]  = fn.call(scope ,this[i],i,this);
		}
	}
	return result;
};
var getWindowWH = function(){
	  return ["Height","Width"].map(function(name){
	  return window["inner"+name] ||
		document.compatMode === "CSS1Compat" && document.documentElement[ "client" + name ] || document.body[ "client" + name ]
	});
}
window.onload = function (){
	if(!+"\v1" && !document.querySelector) { //IE6 IE7
		document.body.onresize = resize;
	} else { 
	  window.onresize = resize; 
	}
	function resize() {
		wSize();
		return false;
	}
}
function wSize(){
	var str=getWindowWH();
	var strs= new Array();
	strs=str.toString().split(","); //字符串分割
	var h = strs[0] - 95-30;
	$('#leftMenu').height(h);
	$('#Main').height(h); 
}
wSize();

function toggleMenu(doit){
	if(doit==1){
		$('#Main_drop a.on').hide();
		$('#Main_drop a.off').show();
		$('#MainBox .main_box').css('margin-left','24px');
		$('#leftMenu').hide();
	}else{
		$('#Main_drop a.off').hide();
		$('#Main_drop a.on').show();
		$('#leftMenu').show();
		$('#MainBox .main_box').css('margin-left','224px');
	}
}	
$(function(){
	$('#leftMenu dl').hide();
	if(selected_module != '' && selected_action != ''){
		show_other_frame(selected_module,selected_action,'',selected_url);
	}else{
		$('#nav_1').show();
		$('#nav_1 dd:first').addClass('on');
	}
	$('#leftMenu dd span').click(function(){
		window.main.location.href = $(this).attr('url');
		$('#leftMenu dd').removeClass('on');
		$(this).closest('dd').addClass('on');
	});
	$('.topmenu li span a').click(function(){
		toggleMenu(0);
		$('.topmenu li span').removeClass('current');
		$(this).closest('span').addClass('current');
		$('#leftMenu dl').hide();
		var menu_id = $(this).attr('menu_id');
		$('#nav_'+menu_id).show();
		$('#leftMenu dl dd').removeClass('on');
		$('#nav_'+menu_id+' dd').eq(0).addClass('on');
		window.main.location.href = $('#nav_'+menu_id+' dd span:first').attr('url');
	});
});

//刷新父级页面
function top_refresh(){
    window.top.location.reload();
}
//刷新框架页面
function main_refresh(){
    window.main.location.reload();
}

//关闭所有框架
function closeiframe(){
	var list = window.art.dialog.list;
	for (var i in list){
		if(i.substring(0,3)!=="msg"){
			list[i].close();
		};
	};
}

//关闭指定ID的框架
function closeiframebyid(id){
	var list = window.art.dialog.list;
	for (var i in list){
		if(i == id){
			list[i].close();
		};
	};
}

//将指定框架移到左边
function change_frame_position_left(name){
	var window_width = $(window).width();
	if(window_width<1200){
		var frame_left = '0%';
	}else if(window_width<1350){
		var frame_left = '10%';
	}else if(window_width<1500){
		var frame_left = '15%';
	}else{
		var frame_left = '20%';
	}
	window.top.art.dialog.list[name].position(frame_left,'38.2%');
}

//得到右边框架的左边
function get_frame_position_left(name,width){	
	var window_width = $(window).width();
	if(window_width<1200){
		var frame_left = width;
	}else if(window_width<1350){
		var frame_left = (window_width*0.1)+width;
	}else if(window_width<1500){
		var frame_left = (window_width*0.15)+width;
	}else{
		var frame_left = (window_width*0.20)+width;
	}
	return frame_left;
}



//art弹框组件
function artiframe(url, title, width, height, lock, resize, background, button, id, fixeds, closefun, left, top, padding){
	if (!width) width = 'auto';
    if (!height) height = 'auto';
    if (!lock) lock = false;
    if (!resize) resize = false;
    if (!background) background = 'black';
    if (!closefun) closefun = null;
    if (!button) button = null;
    if (!left) left = '50%';
    if (!top) top = '38.2%';
    if (!id) id = null;
    if (!fixeds) fixeds = false;
    if (!padding) padding = 0;
    art.dialog.open(url, {
        init: function(){
            var iframe = this.iframe.contentWindow;
            window.top.art.dialog.data('iframe' + id, iframe);
        },
        id: id,
        title: title,
        padding: padding,
        width: width,
        height: height,
        lock: lock,
        resize: resize,
        background: background,
        button: button,
        fixed: fixeds,
        close: closefun,
        left: left,
        top: top,
		opacity:'0.4'
    });
}

//art信息提示
function msg(status,msg,lock,time){
	var list = window.art.dialog.list;
	for (var i in list){
		if(i == 'form_submit_tips'){
			list[i].close();
		}
	};
    if(lock){
        lock = true;
    }else{
        lock = false;
    }
    if (!time){
        time = 2;
    }
    if(status == 2){
        ico = 'face-smile';
    }else if(status){
        ico = 'succeed';
    }else{
        ico = 'error';
    }
	if(status == 2){
        id = 'form_submit_tips';
    }else{
		id = 'msg' + Math.random();
	}
    art.dialog({
        icon: ico,
        time: time,
        /*background: '#FFF',*/
        title: '提示信息',
        id: id,
		opacity:'0.4',
        lock: lock,
        fixed: true,
        resize: false,
        content: msg
    });
}

function updateMsg(title,content,url){
    art.dialog({
        title: title,
        id:'system_update',
		opacity:'0.4',
        lock: true,
        fixed: true,
        resize: false,
		height:'400px',
		padding:'10px',
        content: content,
		ok:function(){
			window.main.location.href = url;
		}
    });
}
//打开颜色框
function showTopColorPanel(frameName,ttop,thei,tleft,txt){
	txtobj = $('#'+txt,window.frames[frameName].document);
	$("#colorpanel").css({
		top:$("iframe[name^='"+frameName+"']").offset().top + ttop + thei + 5,
		left:$("iframe[name^='"+frameName+"']").offset().left + tleft,
		'z-index':'19999',
	});
	$("#colorpanel").show();
	$("#CT tr td").unbind("click").mouseover(function(){
		var aaa=$(this).css("background-color");
		$("#DisColor").css("background-color",aaa);
		$("#HexColor").val(aaa);
	}).click(function(){
		var aaa=$(this).css("background-color");
		txtobj.val(aaa);
		txtobj.css("background-color",aaa);
		$("#colorpanel").hide();
	});
	$()
	$("#_clean").click(function(){
		$("#colorpanel").hide();
		txtobj.val('');
	});
	$("#_cclose").click(function(){$("#colorpanel").hide();}).css({"font-size":"12px","padding-left":"10px"});
	$('#HexColor').keypress(function(e){if(e.keyCode==13){$("#colorpanel").hide();txtobj.val($(this).val());}}).css({'width':'90px'});
}

//展现指定的main框架
function show_other_frame(module,action,param,url){
	var now_dom = $('#leftmenu_'+module+'_'+action);
	var index = $('#leftMenu dl').index(now_dom.closest('dl'));
	$('.topmenu li span').removeClass('current').eq(index).addClass('current');
	// alert($('#leftMenu dl').eq(index).html());
	$('#leftMenu dl').eq(index).show().siblings('dl').hide();
	now_dom.closest('dd').addClass('on');
	if(url){
		window.main.location.href = url;
	}else{
		window.main.location.href = now_dom.attr('url')+'&'+param;
	}
}