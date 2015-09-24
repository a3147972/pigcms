$(function(){
	$.getScript("http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2",function(){
		var map = null;
		var oPoint = new BMap.Point(store_long,store_lat);
		var marker = new BMap.Marker(oPoint);
		
		map = new BMap.Map("map-canvas",{"enableMapClick":false});
		map.enableScrollWheelZoom();
		map.enableKeyboard();
		marker.enableDragging();
		
		map.centerAndZoom(oPoint, 17);

		map.addControl(new BMap.NavigationControl());
		map.enableScrollWheelZoom();

		map.addOverlay(marker);
	});
	
	$('#map-canvas').on('mousewheel',function(){
        return false;
	});
	
	
	//解析table
	if($('.group_content table')){
		var table_dom = $('.group_content table').eq(0);
		table_dom.find('tr').eq(0).find('td').css('background','#F0F0F0');
	}
	
	$('#J-deal-qrcode-wrapper').one('hover',function(){
		$(this).removeClass('hover');
	});
	
	$('.J-view-full').click(function(){
		var map_dom = $('#map-canvas');
		var map_url = map_dom.attr('frame_url')+'&map_point='+map_dom.attr('map_point')+'&store_name='+encodeURIComponent(map_dom.attr('store_name'))+'&store_adress='+encodeURIComponent(map_dom.attr('store_adress'))+'&store_phone='+map_dom.attr('store_phone');
		art.dialog.open(map_url, {
			init: function(){
				var iframe = this.iframe.contentWindow;
				window.top.art.dialog.data('iframe_map', iframe);
			},
			id: 'iframe_map',
			title: '查看地图',
			padding: "20",
			width: "800px",
			height: "559px",
			background:'white',
			lock: true,
			button: null,
			opacity:'0.4'
		});
	});
	
	$('.view-map').click(function(){
		var map_dom = $(this);
		var map_url = map_dom.attr('frame_url')+'&map_point='+map_dom.attr('map_point')+'&store_name='+encodeURIComponent(map_dom.attr('store_name'))+'&store_adress='+encodeURIComponent(map_dom.attr('store_adress'))+'&store_phone='+map_dom.attr('store_phone');
		art.dialog.open(map_url, {
			init: function(){
				var iframe = this.iframe.contentWindow;
				window.top.art.dialog.data('iframe_map', iframe);
			},
			id: 'iframe_map',
			title: '查看地图',
			padding: "20",
			width: "800px",
			height: "559px",
			background:'white',
			lock: true,
			button: null,
			opacity:'0.4'
		});
	});
	
	$('.map_txt .biz-info').mouseover(function(){
		if(!$(this).hasClass('biz-info--open')){
			$(this).addClass('biz-info--open').siblings('.biz-info').removeClass('biz-info--open');
		}
	});
	
	//图片选择
	$('.min-box-list li').hover(function(){
		if($(this).hasClass('cur')){
			return false;
		}
		$(this).addClass('cur').siblings().removeClass('cur');
		$('#slider .show-box img').attr('src',$(this).find('img').attr('src'));
	});
	
	//其他团购
	$('.more-deal-trigger').click(function(){
		$('#deal-other-biz li.hidden').removeClass('hidden');
		$(this).remove();
	});
	
	var navbar_top = $('#J-content-navbar').offset().top;
	//悬浮条
	$(window).scroll(function(){
		if($(window).scrollTop() > navbar_top){
			$('#J-content-navbar').addClass('common-fixed');
			$('.common-fix-placeholder,#J-nav-buy').show();
		}else{
			$('#J-content-navbar').removeClass('common-fixed');
			$('.common-fix-placeholder,#J-nav-buy').hide();
		}
		$('#J-content-navbar ul li a').each(function(i,item){
			if($($(this).attr('href')).offset().top - $(window).scrollTop() < 90){
				$(this).closest('li').addClass('current').siblings().removeClass('current');
			}
		});
	});
	$('#J-content-navbar ul li a').click(function(){
		$(window).scrollTop($($(this).attr('href')).offset().top-70);
		return false;
	});
	
	$('button').click(function(){
		if($(this).attr('for') == 'J-cart-add'){
			$('.deal-component-quantity-warning').empty();
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(input_dom.val())){
				$('.deal-component-quantity-warning').html('请输入正确的购买数量');
			}else{
				if(input_dom.attr('data-max') != '0' && input_Val >= parseInt(input_dom.attr('data-max'))){
					$('.deal-component-quantity-warning').html('每人最多只能购买 '+(input_dom.attr('data-max'))+' 单');
				}else{
					input_dom.val(input_Val+1);
				}
			}
		}else if($(this).attr('for') == 'J-cart-minus'){
			$('.deal-component-quantity-warning').empty();
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(input_dom.val())){
				$('.deal-component-quantity-warning').html('请输入正确的购买数量');
			}else{
				if(input_Val <= parseInt(input_dom.attr('data-min'))){
					$('.deal-component-quantity-warning').html('最少 '+parseInt(input_dom.attr('data-min'))+' 件起售');
				}else{
					input_dom.val(input_Val-1);
				}
			}
		}
	});
	$('.J-cart-quantity').blur(function(){
		$('.deal-component-quantity-warning').empty();
		if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test($(this).val())){
			$('.deal-component-quantity-warning').html('请输入正确的购买数量');
		}else{
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(input_dom.attr('data-max') != '0' && input_Val >= parseInt(input_dom.attr('data-max'))){
				$('.deal-component-quantity-warning').html('每人最多只能购买 '+(input_dom.attr('data-max'))+' 单');
			}else if(input_Val < parseInt(input_dom.attr('data-min'))){
				$('.deal-component-quantity-warning').html('最少 '+parseInt(input_dom.attr('data-min'))+' 件起售');
			}
		}
	});
	
	$('.see_anchor').click(function(){
		$(window).scrollTop($('#'+$(this).data('anchor')).offset().top-120);
	});
	//商家位置
	$.each($('.search-path'),function(i,item){
		$(item).attr({'href':'http://map.baidu.com/m?word='+encodeURIComponent($(item).attr('shop_name')),'target':'_blank'});
	});
	
	
	//收藏事件
	$('.J-component-add-favorite').click(function(){
		var now_dom = $(this);
		$.post(collect_url,{action:'add',type:'group_detail',id:$(this).attr('fav-id')},function(result){
			if(result.status == '1'){
				now_dom.removeClass('J-component-add-favorite').addClass('yi').attr('title','您已经收藏过本单').html('已收藏');
			}else if(result.info == 'login'){
				art.dialog.open(login_url,{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('iframe_handle',iframe);
					},
					id: 'handle',
					title:'登录',
					padding: '30px',
					width: 438,
					height: 500,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					opacity:'0.4'
				});
				return false;
			}else{
				alert(result.info);
			}
		});
	});
	
	//评论事件
	get_reply_list(1);
	$('.rate-filter__item a').click(function(){
		$(this).addClass('on').siblings().removeClass('on');
		get_reply_list(1);
		return false;
	});
	$('.J-filter-ordertype').change(function(){
		get_reply_list(1);
	});
	$('.J-rate-paginator a').live('click',function(){
		get_reply_list($(this).attr('data-index'));
	});
	$('.J-piclist-wrapper li a').live('click',function(){
		var m_src = $(this).closest('li').attr('m-src');
		var big_src = $(this).closest('li').attr('big-src');
		window.art.dialog({
			title: '查看图片',
			lock: true,
			fixed: true,
			opacity: '0.4',
			resize: false,
			left: '50%',
			top: '38.2%',
			content:'<a href="'+big_src+'" target="_blank" title="新窗口打开查看原图"><img src="'+m_src+'" alt="大图"/></a>',
			close: null
		});
		return false;
	});
});
function get_reply_list(page){
	$('.ratelist-content').prepend('<div class="loading-surround--large ratelist-content__loading J-list-loading"></div>');
	$('.J-rate-list').empty();
	$('.J-rate-paginator').empty();
	
	$.post(get_reply_url,{tab:$('.rate-filter__item .on').attr('data-tab'),order:$('.J-filter-ordertype').val(),page:page},function(result){
		$('.J-list-loading').remove();
		if(result == '0'){
			$('.J-rate-list').html('<li class="norate-tip">暂无该类型评价</li>');
		}else{
			result = $.parseJSON(result);
			$('.J-rate-paginator').html(result.page);
			$.each(result.list,function(i,item){
				var item_html = '<dd class="cf"><div class="appraise_li-list_img"><div class="appraise_li-list_icon"><img src="'+(item.avatar ? item.avatar : site_url+'/static/images/portrait.jpg')+'" /></div><p>'+item.nickname+'</p></div><div class="appraise_li-list_right cf"><div class="appraise_li-list_top cf"><div class="appraise_li-list_top_icon"><div><span style="width:'+(parseInt(item.score)/5*100)+'%"></span></div></div><div class="appraise_li-list_data">'+item.add_time+'</div></div><div class="appraise_li-list_txt">'+item.comment+'</div>';
				if(item.pics){
					item_html+= '<div class="pic-list J-piclist-wrapper"><div class="J-pic-thumbnails pic-thumbnails"><ul class="pic-thumbnail-list widget-carousel-indicator-list">';
					$.each(item.pics,function(j,jtem){
						item_html+= '<li m-src="'+jtem.m_image+'" big-src="'+jtem.image+'"><a class="pic-thumbnail" href="#" hidefocus="true"><img src="'+jtem.s_image+'"></a></li>';
					});
					item_html+= '</ul></div></div>';
				}
				if(item.merchant_reply_content != ''){
					item_html+= '<p class="biz-reply">商家回复：'+item.merchant_reply_content+'</p>';
				}
				item_html+= ''+(item.store_name ? '<p class="shopname">'+item.store_name+'</p>' : '')+'</dd>';
				$('.J-rate-list').append(item_html);
			});
		}
		if(page>1){$(window).scrollTop($('.J-rate-filter').offset().top+50);}
	});
}