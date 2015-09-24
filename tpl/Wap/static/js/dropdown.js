$(function(){
	$('.dropdown-toggle').click(function(){	
		if($(this).hasClass('active')){
			close_dropdown();
			return false;
		}
		close_dropdown();
		$(window).scrollTop($(this).offset().top+2);

		$('.deal-container .shade').removeClass('hide');
		
		$(this).addClass('active');
		var nav = $(this).attr('data-nav');
		$('.dropdown-wrapper').addClass(nav+' active');
		$('.'+nav+'-wrapper').addClass('active');
		$('#dropdown_scroller,.dropdown-module,#dropdown_sub_scroller').height($('#dropdown_scroller').height());
		
		if($('.deal-container').height() < $('#dropdown_scroller').height()){
			$('.deal-container .shade').height($('#dropdown_scroller').height()+150+'px');
		}else{
			$('.deal-container .shade').removeAttr('style');
		}
		
		if($('.'+nav+'-wrapper').find('.active').attr('data-has-sub')){
			$('#dropdown_sub_scroller').html($('.'+nav+'-wrapper').find('.active').find('.sub_cat').html()).css('left','3.2rem');
			$('#dropdown_scroller').width('3.2rem');
		}
	});
	$('.deal-container .shade').click(function(){
		close_dropdown();
	});
	
//	$('.category-wrapper ul>li').click(function(){
//		$('#dropdown_sub_scroller').css({'overflow':'hide','overflow-y':''});
//		$('.category-wrapper ul>li').removeClass('active');	
//		if($(this).attr('data-has-sub')){
//			$(this).addClass('active');
//			$('#dropdown_sub_scroller').html($(this).find('.sub_cat').html()).css('left','3.2rem');
//			$('#dropdown_scroller').width('3.2rem');
//			if($('#dropdown_sub_scroller ul').height() > $('#dropdown_sub_scroller').height()){
//				$('#dropdown_sub_scroller').css({'overflow':'','overflow-y':'scroll'});
//			}
//		}
//	});
	
	$('.biz-wrapper ul>li, .category-wrapper ul>li').click(function(){
		$('#dropdown_sub_scroller').css({'overflow':'hide','overflow-y':''});
		$('.biz-wrapper ul>li, .category-wrapper ul>li').removeClass('active');	
		if($(this).attr('data-has-sub')){
			$(this).addClass('active');
			$('#dropdown_sub_scroller').html($(this).find('.sub_cat').html()).css('left','3.2rem');
			$('#dropdown_scroller').width('3.2rem');
			if($('#dropdown_sub_scroller ul').height() > $('#dropdown_sub_scroller').height()){
				$('#dropdown_sub_scroller').css({'overflow':'','overflow-y':'scroll'});
			}
		}
	});
	$(document).on('click','.dropdown-list li',function(){
		if(!$(this).attr('data-has-sub')){
			list_location($(this));
		}
	});
	/*$('.dropdown-list li').live('click',function(){
		if(!$(this).attr('data-has-sub')){
			list_location($(this));
		}
	});*/
});
function close_dropdown(){
	$('#dropdown_scroller,#dropdown_sub_scroller').css('width','');
	$('.dropdown-toggle').removeClass('active');
	$('.dropdown-wrapper').prop('class','dropdown-wrapper');
	$('#dropdown_scroller,.dropdown-module').css('height','');
	$('.deal-container .shade').addClass('hide');
	$('#dropdown_sub_scroller').css('left','100%');
	$('#dropdown_scroller>ul>li').removeClass('active');
}