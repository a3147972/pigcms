$(function(){
	
	//解析table
	if($('.group_content table')){
		var table_dom = $('.group_content table').eq(0);
		table_dom.find('tr').eq(0).find('td').css('background','#F0F0F0');
	}
	
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
	
	//图片选择
	$('.candidates img').hover(function(){
		if($(this).hasClass('active')){
			return false;
		}
		$(this).addClass('active').siblings().removeClass('active');
		$('.deal-component-cover .focus-view').attr('src',$(this).attr('src'));
	});
	
	//其他团购
	$('.more-deal-trigger').click(function(){
		$('#deal-other-biz li.hidden').removeClass('hidden');
		$(this).remove();
	});
	
	//商家位置
	$.each($('.search-path'),function(i,item){
		$(item).attr({'href':'http://map.baidu.com/m?word='+encodeURIComponent($(item).attr('shop_name')),'target':'_blank'});
	});

	//收藏事件
	$('.j-save-up').click(function(){
		var now_dom = $(this);
		$.post(collect_url,{action:'add',type:'meal_detail',id:$(this).attr('data-poiid')},function(result){
			if(result.status == '1'){
				var now_fav_num = parseInt($('.j-save-up-people span').html());
				now_dom.addClass('favorite').attr('title','您已经收藏过本单');
				now_dom.find(".ct-black").html('已收藏');
				$('.j-save-up-people span').html(now_fav_num + 1);
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
		$('.rate-filter__item a').removeClass('rate-filter__link--active');
		$(this).addClass('rate-filter__link--active');
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
		var big_src = $(this).closest('li').attr('data-src');
		window.art.dialog({
			title: '查看图片：',
			lock: true,
			fixed: true,
			opacity: '0.4',
			resize: false,
			content:'<img src="'+big_src+'" alt="大图"/>',
			close: null
		});
		return false;
	});
});
function get_reply_list(page){
	$('.ratelist-content').prepend('<div class="loading-surround--large ratelist-content__loading J-list-loading"></div>');
	$('.J-rate-list').empty();
	$('.J-rate-paginator').empty();
	
	$.post(get_reply_url,{tab:$('.rate-filter__link--active').attr('data-tab'),order:$('.J-filter-ordertype').val(),page:page},function(result){
		$('.J-list-loading').remove();
		if(result == '0'){
			$('.J-rate-list').html('<li class="norate-tip">暂无该类型评价</li>');
		}else{
			result = $.parseJSON(result);
			$('.J-rate-paginator').html(result.page);
			$.each(result.list,function(i,item){
				var item_html = '<li class="J-ratelist-item rate-list__item"><div class="info cf"><div class="rate-status"><span class="common-rating"><span class="rate-stars" style="width:'+(parseInt(item.score)/5*100)+'%"></span></span></div><div class="user-info"><span class="name">'+item.nickname+'</span></div><span class="time">'+item.add_time+'</span></div><div class="J-normal-view"><p class="content">'+item.comment+'</p>';
				if(item.pics){
					item_html+= '<div class="pic-list J-piclist-wrapper"><div class="J-pic-thumbnails pic-thumbnails"><ul class="pic-thumbnail-list widget-carousel-indicator-list">';
					$.each(item.pics,function(j,jtem){
						item_html+= '<li data-src="'+jtem.m_image+'"><a class="pic-thumbnail" href="#" hidefocus="true"><img src="'+jtem.s_image+'"></a></li>';
					});
					item_html+= '</ul></div></div>';
				}
				if(item.merchant_reply_content != ''){
					item_html+= '<p class="biz-reply">商家回复：'+item.merchant_reply_content+'</p>';
				}
				item_html+= '</div>'+(item.store_name ? '<p class="shopname">'+item.store_name+'</p>' : '')+'</li>';
				$('.J-rate-list').append(item_html);
			});
		}
		if(page>1){alert(page);$(window).scrollTop($('.J-rate-filter').offset().top+50);}
	});
}