var show_buy_box = true;
$(function(){
	if($('.group_content table')){
		var table_dom = $('.group_content table').eq(0);
		table_dom.find('tr').eq(0).find('td').css('background','#F0F0F0');
	}
	
	/*if($('#buy_box').size() > 0){
		var buy_box_top = $('#buy_box').offset().top;
		$(window).scroll(function(){
			if(show_buy_box){
				if($(window).scrollTop() > buy_box_top+20){
					$('#buy_box').css({'position':'fixed','width':'100%','top':'0','background':'white','z-index':'9911','padding':'.28rem 0 .28rem .1rem','border-bottom':'1px solid #ddd8ce'});
				}else{
					$('#buy_box').removeAttr('style');
				}
			}
		});
	}*/

	var mySwiper;
	
	$('.view_album').click(function(){
		$('#buy_box').removeAttr('style');
		show_buy_box = false;
		var album_more = $(this).attr('data-pics');
		var album_array = album_more.split(',');
		if(is_weixin()){
			wx.previewImage({
				current:album_array[0],
				urls:album_array
			});
		}else{
			var album_html = '<div class="albumContainer h_gesture_ tap_gesture_" style="display:block;">';
				album_html += '<div class="swiper-container">';
				album_html += '		<div class="swiper-wrapper">';
			$.each(album_array,function(i,item){
				album_html += '			<div class="swiper-slide">';
				album_html += '				<img src="'+item+'"/>';
				album_html += '			</div>';
			});
				album_html += '		</div>';
				album_html += '  	<div class="swiper-pagination"></div><div class="swiper-close" onclick="close_swiper()">X</div>';
				album_html += '</div>';
			
			album_html += '</div>';
			$('body').append(album_html);
		
			mySwiper = $('.swiper-container').swiper({
				pagination:'.swiper-pagination',
				loop:true,
				grabCursor: true,
				paginationClickable: true
			});
		}
	});

	$('.btn').live('click',function(){
		if($(this).attr('data-com') == 'share'){
			if(is_weixin() === true){
				$('body').append('<div style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9998;" id="weixin_share_btn"><img src="'+static_path+'images/MgnnofmleM.png" style="position:fixed;right:18px;top:5px;max-width:60%;z-index:9999;border:0;"/></div>');
				$('#weixin_share_btn').one('click',function(){
					$(this).remove();
				});
			}else{
				var bg_height = $('body').height()>$(window).height() ? $('body').height() : $(window).height();
				var msg_dom = '<div class="msg-bg" style="height:'+bg_height+'px;"></div>';
					msg_dom+= '<div id="msg" class="msg-doc msg-option">';
					msg_dom+= '		<div class="msg-option-btns"><a class="btn msg-btn" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?title='+$(this).attr('data-share-text')+'&url='+encodeURIComponent(location.href)+'&pic='+$(this).attr('data-share-pic')+'">QQ空间</a></div>';
					msg_dom+= '		<div class="msg-option-btns"><a class="btn msg-btn" href="http://share.v.t.qq.com/index.php?c=share&a=index&title='+$(this).attr('data-share-text')+'&url='+encodeURIComponent(location.href)+'&pic='+$(this).attr('data-share-pic')+'">腾讯微博</a></div>';
					msg_dom+= '		<div class="msg-option-btns"><a class="btn msg-btn" href="http://service.weibo.com/share/share.php?title='+$(this).attr('data-share-text')+'&url='+encodeURIComponent(location.href)+'&pic='+$(this).attr('data-share-pic')+'">新浪微博</a></div>';
					msg_dom+= '		<button class="btn msg-btn-cancel" data-event="cancel" type="button">取消</button>';
					msg_dom+= '</div>';
					
				$('body').append(msg_dom);
			}
		}else if($(this).attr('data-event') == 'cancel'){
			$('.msg-bg,.msg-doc').remove();
		}
	});
	
	$('.js-fav-btn').click(function(){
		if($(this).hasClass('faved')){
			var action="del";
		}else{
			var action="add";
		}
		$.post(collect_url,{action:action,type:$(this).attr('fav-type'),id:$(this).attr('fav-id')},function(result){
			if($('.msg-toast').length>0){
				$('.msg-toast').remove();
			}
			$('body').append('<div class="msg-doc msg-toast">'+result.info+'</div>');
			if(result.status == '1'){
				if(action == 'add'){
					$('.js-fav-btn').addClass('faved');
				}else{
					$('.js-fav-btn').removeClass('faved');
				}
			}
		});
	});
});
function close_swiper(){
	$('.albumContainer').remove();
	show_buy_box = true;
}