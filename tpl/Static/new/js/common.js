// jQuery cookie
jQuery.cookie = function (key, value, options) {
    if (arguments.length > 1 && (value === null || typeof value !== "object")){
        options = jQuery.extend({}, options);
        if (value === null) {
            options.expires = -1;
        }
        if (typeof options.expires === 'number'){
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }
        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? String(value) : encodeURIComponent(String(value)),
            options.expires ? '; expires=' + options.expires.toUTCString() : '',
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

//浏览记录写入js
function save_history(name,img,url,price,type){
	var hc = name+'|&|'+img+'|&|'+url+'|&|'+price+'|&|'+type;
	var history = $.cookie('history');
	if(history != null){
		var splithtml = history.split("*&*");
		var new_arr = new Array();
		$.each(splithtml,function(i,item){
			if(item.indexOf(name) == -1){
				new_arr.push(item);
			}
		});
		new_arr = new_arr.slice(0,4);
		if(new_arr.length != 0){
			$.cookie("history",hc+"*&*"+new_arr.join('*&*'),{expires:365,path:"/"});
		}else{
			$.cookie("history",hc,{expires:365,path:"/"}); 
		}
	}else{
		$.cookie("history",hc,{expires:365,path:"/"}); 
	}
}
var meal_alias_namejs=typeof(meal_alias_name) != 'undefined' ? meal_alias_name:'订餐';
$(function(){
	$('.user-info__login').attr('href',$('.user-info__login').attr('href')+'&referer='+encodeURIComponent(window.location.href));
	$('.user-info__signup').attr('href',$('.user-info__signup').attr('href')+'&referer='+encodeURIComponent(window.location.href));
	$('.site-mast__user-nav .dropdown').hover(function(){
		$(this).addClass('dropdown--open');
		if($(this).hasClass('mobile-info__item')){
			$(this).addClass('dropdown--open-app');
		}
	},function(){
		$(this).removeClass('dropdown--open');
	});
	$('.J-nav-item').hover(function(){
		$(this).addClass('nav-active nav-hover');
		$(this).find('.J-nav-level2').show();
	},function(){
		$(this).removeClass('nav-active nav-hover');
		$(this).find('.J-nav-level2').hide();
	});
	
	$('.search form').submit(function(){
		$('.search .input').val($.trim($('.search .input').val()));
		if($('.search .input').val().length < 1){
			alert('请输入关键词');
			$('.search .input').focus();
			return false;
		}
	});
	
	//顶部广告位
	$('.J-banner-newtop .mt-slider-trigger').click(function(){
		var now_obj = $(this);
		if($(this).hasClass('mt-slider-current-trigger')){
			return false;
		}
		var slider_index = $(this).index();
		$('.J-banner-newtop .mt-slider-sheet-container li').animate({'opacity':'0'},function(){
			$('.J-banner-newtop .mt-slider-sheet-container li').eq(slider_index).css({'opacity':'1'}).show().siblings().hide();
			now_obj.addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
		});
	});
	$('.J-banner-newtop.mt-slider-content .common-close').click(function(){
		$('.J-banner-newtop.mt-slider-content').remove();
	});

	//搜索框
	$('.nav .form_sec').hover(function(){
		$(this).addClass('form_over');
	},function(){
		$(this).removeClass('form_over');
	});
	
	$('.nav .form_sec div').live('click',function(){
		if($(this).hasClass('form_sec_txt')){
			return false;
		}
		var search_form = $(this).closest('.search form');
		if($(this).hasClass('meal')){
			search_form.attr('action',search_form.attr('meal_action'));
		}
		if($(this).hasClass('group')){
			search_form.attr('action',search_form.attr('group_action'));
		}
		$(this).removeClass('form_sec_txt1').addClass('form_sec_txt').siblings().removeClass('form_sec_txt').addClass('form_sec_txt1');
		var tmp_li_0 = $('.nav .form_sec div').eq(0);
		var tmp_li_0_html = tmp_li_0.prop("outerHTML");
		tmp_li_0.prop('outerHTML',$(this).prop('outerHTML'));
		$(this).prop('outerHTML',tmp_li_0_html);
		$('.nav .form_sec').removeClass('form_over');
	});
	
	//浏览记录
	var history = $.cookie('history');
	if(history != null){
		var splithtml=history.split("*&*");
		var history_menu = ''; 
		var history_right = ''; 
		$.each(splithtml,function(i,item){
			var html_row = item.split('|&|');
			history_menu += '<li class="dropdown-menu__item"><a class="deal-link" href="'+html_row[2]+'" title="'+html_row[0]+'" target="_blank"><img class="deal-cover" src="'+html_row[1]+'" width="80" height="50"></a><h5 class="deal-title"><a class="deal-link" href="'+html_row[2]+'" title="'+html_row[0]+'" target="_blank">'+html_row[0]+'</a></h5><a class="deal-price-w" target="_blank" href="'+html_row[2]+'">'+(html_row[4]!=meal_alias_namejs ? '<em class="deal-price">¥'+html_row[3]+'</em>' : '')+'<span class="old-price color-weaken">'+html_row[4]+'</span></a></li>';
			var attr = '';
			if(splithtml.length == i+1){
				attr = 'history-list__item--last';
			}else if(i == 0){
				attr = 'history-list__item--first';
			}
			history_right += '<li class="history-list__item '+attr+'"><a href="'+html_row[2]+'" title="'+html_row[0]+'" target="_blank"><img src="'+html_row[1]+'" width="80" height="50"></a><h5><a href="'+html_row[2]+'" title="'+html_row[0]+'" target="_blank">'+html_row[0]+'</a></h5><p>'+(html_row[4]!=meal_alias_namejs ? '<em class="price">¥'+html_row[3]+'</em>' : '')+'<span class="old-price color-weaken">'+html_row[4]+'</span></p></li>';
		});
		$('#J-my-history-menu').html('<ul>'+history_menu+'</ul><div class="clear"><a class="clear__btn" href="javascript:void(0)">清空最近浏览记录</a></div>');
		$('.J-history-list').html(history_right);
	}else{
		$('.J-history-list').remove();
		$('.side-extension--history').append('<div class="no-history">暂无浏览记录</div>');
		$('#J-my-history-menu').html('<p class="dropdown-menu--empty">暂无浏览记录</p>');
	}
	
	$('.history .clear__btn,.J-clear').live('click',function(){
		$.cookie('history', null,{expires:365,path:"/"});
		$('#J-my-history-menu').html('<p class="dropdown-menu--empty">暂无浏览记录</p>');
		if($('.side-extension--history .no-history').length <= 0){
			$('.J-history-list').remove();
			$('.side-extension--history').append('<div class="no-history">暂无浏览记录</div>');
		}
	});
	
	$('.menu_left.hide').hover(function(){
		$(this).find('.list').show();
	},function(){
		$(this).find('.list').hide();
	});
	
	if($('.lazy_img').size()){
		$('.lazy_img').lazyload({
			threshold:200,
			effect:'fadeIn',
			skip_invisible:false,
			failurelimit :8
		});
	}
	if($('.extension_bottom').size()){
		$(window).scroll(function(){
			var scroH = $(this).scrollTop();/* 获取滚动条的滑动距离 */
			if(scroH >= 100){
				$(".extension_bottom").css({"position":"fixed","bottom":"100px"});
			}else if(scroH < 100){
				$(".extension_bottom").css({"position":"fixed","bottom":"+1400px"});
			}
		});
	}
	
	$('.open_windows').click(function(){
		var url = $(this).data('url');
		if(window.open(url)){
			
		}else{
			window.location.href = url;
		}
		return false;
	});
	
	
	//右侧导航 - 二维码
	$(".rightsead .wechat").hover(function(){
		$(this).find(".hides").toggle();
		$(this).find(".qrcode").toggle();
	});
	//右侧导航 - QQ
	$(".rightsead .qq").hover(function(){
		$(this).find('.shows').hide();
		$(this).find('.qq_div').show().animate({'margin-right':'0px'});
	},function(){
		$(this).find('.qq_div').css({'display':'none','margin-right':'-163px'});
		$(this).find('.shows').show();
	});
	//右侧导航 - 电话
	$(".rightsead .tel").hover(function(){
		$(this).find('.shows').hide();
		$(this).find('.tel_div').show().animate({'margin-right':'0px'});
	},function(){
		$(this).find('.tel_div').css({'display':'none','margin-right':'-163px'});
		$(this).find('.shows').show();
	});
	//右侧导航 - 回到顶部
	$(".rightsead .top_btn").hover(function(){
		$(this).find('.shows').hide();
		$(this).find('.btn_div').show().animate({'margin-right':'0px'});
	},function(){
		$(this).find('.btn_div').css({'display':'none','margin-right':'-163px'});
		$(this).find('.shows').show();
	}).click(function(){
		$("html,body").animate({scrollTop:0}, 600);
	});
	
	$(".top_btn").hide();
	$(window).scroll(function(){
		var scroH = $(this).scrollTop();/* 获取滚动条的滑动距离 */
		if(scroH >= 100){
			$(".top_btn").show();
		}else{
			$(".top_btn").hide();
		}
	});
		
	if($(window).width() < 1320){
		$('.rightsead').hide();
	}
	$(window).resize(function(){
		if($(window).width() < 1320){
			$('.rightsead').hide();
		}else{
			$('.rightsead').show();
		}
	});
});

    /*****等级升级******/
function levelToupdate(currentscore,needscore,obj){
    currentscore=parseInt(currentscore);
	needscore=parseInt(needscore);
	if(currentscore>0 && needscore>0){
	   if(currentscore<needscore){
	      alert('您当前的积分不够升级！');
		  return false;
	   }
	   if(confirm("升级会扣除您"+needscore+"积分\n您确认要升级吗？")){
	      obj.attr('onclick','return false');
		  $.post(levelToupdateUrl,{},function(ret){
			  alert(ret.msg);
			  window.location.reload();
		  },'JSON');
		  return false;
	   }
	}
}