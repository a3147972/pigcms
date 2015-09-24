if($('.swiper-container1').size() > 0){
	var mySwiper = $('.swiper-container1').swiper({
		pagination:'.swiper-pagination1',
		loop:true,
		grabCursor: true,
		paginationClickable: true,
		autoplay:3000,
		autoplayDisableOnInteraction:false
	});
}
if($('.swiper-container2').size() > 0){
	var mySwiper2 = $('.swiper-container2').swiper({
		pagination:'.swiper-pagination2',
		loop:true,
		grabCursor: true,
		paginationClickable: true
	});
}
// if(is_weixin() == false){
	// $('body').prepend('<div style="padding:0.3rem 0;background:green;text-align:center;color:#fff;overflow:hidden;font-size:.3rem;line-height:.4rem;" id="index_weixin_ad">用微信浏览，享受更多优惠 <br/>[微信搜索公众号“<b>'+wechat_name+'</b>”]</div>');
// }
$('.classifyDom .classify_f_div').click(function(){
	if(!$(this).hasClass('on')){
		$(this).addClass('on');
		$(this).next().show();
	}else{
		$(this).removeClass('on');
		$(this).next().hide();
	}
});
$('.qianggoucard a').click(function(){
	var now_dom = $(this);
	var id = now_dom.attr('group-id');
	$.post(group_index_sort_url,{id:id},function(){
		window.location.href = now_dom.attr('href');
	});
	return false;
});
$('a.index_sort_a').click(function(){
	var now_dom = $(this);
	var id = now_dom.attr('group-id');
	$.post(group_index_sort_url,{id:id},function(){
		window.location.href = now_dom.attr('href');
	});
	return false;
});

if(user_long == '0' || user_lat == '0'){
	//检查浏览器是否支持地理位置获取 
	if (navigator.geolocation){ 
		//若支持地理位置获取,成功调用showPosition(),失败调用showError 
		var config = {enableHighAccuracy:true}; 
		navigator.geolocation.getCurrentPosition(showPosition,showError,config);
	}else{
		alert("定位失败,用户浏览器不支持或已禁用位置获取权限"); 
	}
}else{
	get_near_info('merchant');
}

/** 
* 获取地址位置成功 
*/ 
function showPosition(position){
	//获得经度纬度 
	user_lat  = position.coords.latitude;
	user_long = position.coords.longitude;
	get_near_info('merchant');
}

/** 
* 获取地址位置失败[暂不处理] 
*/ 
function showError(error){
	$('#near_dom').remove();
	switch (error.code){
		case error.PERMISSION_DENIED: 
			alert("定位失败,用户拒绝请求地理定位"); 
			break; 
		case error.POSITION_UNAVAILABLE: 
			alert("定位失败,位置信息不可用"); 
			break; 
		case error.TIMEOUT: 
			alert("定位失败,请求获取用户位置超时"); 
			break; 
		case error.UNKNOWN_ERROR:
			alert("定位失败,定位系统失效");
			break; 
	} 
}
/** 
* 获取附近商家
*/
var near_loading_content = $('#near_content').html();
function get_near_info(type){
	if(user_long == '0' || user_lat == '0'){
		alert('还未获取到您的地理位置！请稍等。');
		return false;
	}
	$('#near_'+type).css({'border-bottom':'2px solid #EE3968','color':'#FF658E'}).siblings('a').removeAttr('style');
	$('#near_content').html(near_loading_content);
	$.post(get_near_url,{type:type,'long':user_long,'lat':user_lat},function(result){
		result = $.parseJSON(result);
		var near_content = '';
		if(result.error == 0){
			$.each(result.store_list,function(i,item){
				near_content += '<div class="qianggoucard" '+(i==2 ? 'style="border-right:none;"' : '')+(i>2 ? 'style="border-bottom:none;"' : '')+' ><a href="'+item.url+'"><div class="img-container"><img src="'+item.image+'" alt="'+item.name+'"/></div><div class="brand">'+item.name+'</div><div class="campaign-price">距您约'+item.juli+'</div></a></div>';
			});
			$('#near_content').html(near_content);
		}else{
			alert('没有查找到内容！请选择其他的。');
		}
	});
}