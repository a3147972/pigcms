$(function(){
	//$('#container').height($(window).height()-$('header').height()-$('footer').height()-5).css('overflow-y','scroll');
	$('.nav-dropdown-btn').click(function(){
		if($('#nav-dropdown').hasClass('active')){
			$('#nav-dropdown').removeClass('active');
		}else{
			$('#nav-dropdown').addClass('active');
		}
		return false;
	});
	$('body').bind('click',function(e){
		$('#nav-dropdown').removeClass('active');
	});
	
	$(window).scroll(function(){
		if($(window).scrollTop()>150){
			$('.top-btn').show();
		}else{
			$('.top-btn').hide();
		}
	});
	
	$('.top-btn').click(function(){
		$(window).scrollTop(0);
	});
	
	$('.phone').click(function(){
		if($(this).attr('data-phone')){
			var bg_height = $('body').height()>$(window).height() ? $('body').height() : $(window).height();
			var msg_dom = '<div class="msg-bg" style="height:'+bg_height+'px;"></div>';
			msg_dom+= '<div id="msg" class="msg-doc msg-option">';
			msg_dom+= '<div class="msg-bd">拨打电话</div>';
			msg_dom+= '		<div class="msg-option-btns" style="margin-top:0px;"><a class="btn msg-btn" href="tel:'+$(this).attr('data-phone')+'">'+$(this).attr('data-phone')+'</a></div>';
			msg_dom+= '		<button class="btn msg-btn-cancel" data-event="cancel" type="button">取消</button>';
			msg_dom+= '</div>';
			
			$('body').append(msg_dom);
		}
	});
	$('.msg-btn-cancel').live('click',function(){
		$('.msg-doc,.msg-bg').remove();
	});
});

function is_weixin(){
    var ua = navigator.userAgent.toLowerCase();
    if(is_mobile() && ua.match(/MicroMessenger/i)=="micromessenger") {  
        return true;  
    } else {  
        return false;  
    }  
}

function is_mobile(){
	if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))){
		if((navigator.platform.indexOf("Win") == 0) || (navigator.platform.indexOf("Mac") == 0) || ((navigator.platform.indexOf("Linux") == 0) || (navigator.platform == 'X11'))){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}
}