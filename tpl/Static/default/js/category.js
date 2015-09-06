$(function(){
	//图片延迟加载
	if($('.lazy_img').size()>0){
		$('.lazy_img').lazyload({
			threshold:200,
			effect:'fadeIn',
			skip_invisible:false,
			failurelimit :8
		});
	}
	$('.breadcrumb__item').hover(function(){
		if($(this).find('.breadcrumb_item__option').html()){
			$(this).addClass('dropdown--open');
		}
	},function(){
		$(this).removeClass('dropdown--open');
	});
	
	//分类 广告位
	$('.J-banner-stamp-active .mt-slider-trigger').click(function(){
		var now_obj = $(this);
		if($(this).hasClass('mt-slider-current-trigger')){
			return false;
		}
		var slider_index = $(this).index();
		$('.J-banner-stamp-active .mt-slider-sheet-container li').animate({'opacity':'0'},function(){
			$('.J-banner-stamp-active .mt-slider-sheet-container li').eq(slider_index).css({'opacity':'1'}).show().siblings().hide();
			now_obj.addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
		});
	});
	$('.J-banner-stamp-active .mt-slider-content .common-close').click(function(){
		$('.mt-slider-content').remove();
	});
	
	$('.component-cate-nav').hover(function(){
		$('.J-nav__trigger').addClass('nav-unfolded');
		$('.J-nav__list--delayed').show();
	},function(){
		$('.J-nav__trigger').removeClass('nav-unfolded');
		$('.J-nav__list--delayed').hide();
	});
});