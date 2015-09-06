$(function(){
	//热门商圈
	var index_all_area_dom = $('.J-filter__geo').prop("outerHTML");
	var area_is_hover = false;
	$('.J-geo-more').live('mouseenter',function(){
		if(area_is_hover == false){
			$('.J-filter__geo').replaceWith('<div class="site-fs__cell--geowrap">'+index_all_area_dom+'</div><div class="geo-more-placeholder" style="height:49px;"></div>');
			area_is_hover = true;
		}
	});
	$('.site-fs__cell--geowrap').live('mouseleave',function(){
		$(this).replaceWith(index_all_area_dom);
		$('.geo-more-placeholder').remove();
		area_is_hover = false;
	});
	
	//图片延迟加载
	$('.lazy_img').lazyload({
		threshold:200,
		effect:'fadeIn',
		skip_invisible:false,
		failurelimit :8
	});
	
	//最新团购
	var component_slider_timer = null;
	function component_slider_play(){
		component_slider_timer = window.setInterval(function(){
			var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index();
			if(slider_index == $('.component-index-slider .mt-slider-trigger-container li').size() - 1){
				slider_index = 0;
			}else{
				slider_index++;
			}
			$('.component-index-slider .content li').eq(slider_index).css({'opacity':'0','display':'block'}).animate({opacity:1},600).siblings().hide();
			$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
		},3400);
	}
	component_slider_play();
	$('.component-index-slider').hover(function(){
		window.clearInterval(component_slider_timer);
		$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').css({'opacity':'0.6'}).show();
	},function(){
		window.clearInterval(component_slider_timer);
		component_slider_play();
		$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').css({'opacity':'0'}).hide();
	});
	$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').hover(function(){
		$(this).css({'opacity':'1'});
	});
	$('.component-index-slider .mt-slider-trigger-container li').click(function(){
		if($(this).hasClass('mt-slider-current-trigger')){
			return false;
		}
		var slider_index = $(this).index();
		$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
		$(this).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
	$('.component-index-slider .mt-slider-previous').click(function(){
		var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index()-1;
		if(slider_index < 0){
			slider_index = $('.component-index-slider .mt-slider-trigger-container li').size()-1;
		}
		$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
		$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
	$('.component-index-slider .mt-slider-next').click(function(){
		var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index()+1;
		if(slider_index == $('.component-index-slider .mt-slider-trigger-container li').size()){
			slider_index = 0;
		}
		$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
		$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
	
	//推荐团购
	$('.J-hots-deals.mt-slider-content').hover(function(){
		$('.J-hots-deals .reco-slides__roll--blacksquare').css({'opacity':'0.6'}).show();
	},function(){
		$('.J-hots-deals .reco-slides__roll--blacksquare').css({'opacity':'0'}).hide();
	});
	$('.J-hots-deals .reco-slides__roll--blacksquare--previous').click(function(){
		var slider_index = $('.J-hots-deals .reco-slides__slides .mt-slider-current-sheet').index()-1;
		if(slider_index < 0){
			slider_index = $('.J-hots-deals .reco-slides__slides .mt-slider-sheet').size()-1;
		}
		$('.J-hots-deals .reco-slides__slides .mt-slider-sheet').eq(slider_index).addClass('mt-slider-current-sheet').show().siblings().removeClass('mt-slider-current-sheet').hide();
	});
	$('.J-hots-deals .reco-slides__roll--blacksquare--next').click(function(){
		var slider_index = $('.J-hots-deals .reco-slides__slides .mt-slider-current-sheet').index()+1;
		if(slider_index == $('.J-hots-deals .reco-slides__slides .mt-slider-sheet').size()){
			slider_index = 0;
		}
		$('.J-hots-deals .reco-slides__slides .mt-slider-sheet').eq(slider_index).addClass('mt-slider-current-sheet').show().siblings().removeClass('mt-slider-current-sheet').hide();
	});
	
	//列表悬浮框
	$('.elevator__floor').eq(0).find('a').addClass('current');
	$('.elevator-wrapper').css({'top':$('.category-floor__body').eq(0).offset().top}).show();
	if($(window).width() < 1320){
		$('.elevator-wrapper').hide();
	}
	var side_history_top = $('.side-extension--history').offset().top;
	$(window).scroll(function(){
		var elevator_top = $('.category-floor__body').eq(0).offset().top - $(window).scrollTop();
		if(elevator_top < 0){
			elevator_top = 0;
		}
		$('.elevator-wrapper').css({'top':elevator_top+'px'});
		
		$('.elevator__floor a').removeClass('current');
		$('.category-floor__body').each(function(i,item){
			if($(this).offset().top - $(window).scrollTop() < 150){
				var floor_index = $(this).index('.category-floor__body');				
				$('.elevator__floor').eq(floor_index).find('a').addClass('current');
				$('.elevator__floor').eq(floor_index).siblings().find('a').removeClass('current');
				return;
			}
		});
		
		//右侧浏览记录
		if($(window).scrollTop() > side_history_top){
			$('.side-extension--history').addClass('stickyPlugin-fixed');
		}else{
			$('.side-extension--history').removeClass('stickyPlugin-fixed');
		}
	});
	$('.elevator__floor').click(function(){
		var floor_index = $(this).index('.elevator__floor');
		var elevator_top = $('.category-floor__head').eq(floor_index).offset().top;
		$(window).scrollTop(elevator_top);
	});
	
	$('.hotdeal	a').click(function(){
		var id = $(this).closest('.hotdeal').attr('group-id');
		$.post(group_index_sort_url,{id:id});
	});
	$('.deal-tile a').click(function(){
		var id = $(this).closest('.deal-tile').attr('group-id');
		$.post(group_index_sort_url,{id:id});
	});
});