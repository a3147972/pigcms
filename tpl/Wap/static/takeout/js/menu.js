var menu = {
	offsetAry: [0],
	init: function(id){
		var winH = $(window).height(),
			_this = this,
			_icoMenu = $('#icoMenu'),
			_sideNav = $('#sideNav'),
			maxH = winH - (_icoMenu.parent().is(':visible') ? _icoMenu.outerHeight(true) : 0) - 45;

		this.el =  $(id);
		
		_sideNav.height(maxH);

		if(_sideNav.find('ul').height() > maxH) new Scroller('#sideNav', {scrollX: false});

		$(window).bind('scroll', function(){
			_this.scroll.call(_this);
		});

		$('#icoMenu').click(function(){
			_sideNav.toggle();
		});

		$('.menu_tt h2').each(function(){
			_this.offsetAry.push($(this).offset().top);
		});

		this.el.find('a').click(function(){
			if($(this).attr('class')=='dztj_a'){
				$('#mymenu_lists .nodztj_c').hide();
			    $('#mymenu_lists .dztj_c').show();
			}else{
				$('#mymenu_lists .nodztj_c').show();
			    $('#mymenu_lists .dztj_c').hide();
			}
			$(this).addClass('on').parent().siblings().find('a').removeClass('on');
			$(window).scrollTop(_this.offsetAry[_this.el.find('a').index(this) + 1]);
		});

		_this.offsetT = this.el.offset().top;	
	},
	getIndex: function(ary, value){
		var i = 0;
		for(; i < ary.length; i++){
			if(value >= ary[i] && value < ary[i + 1]){
				return i;
			}
		}
		return ary.length -1;
	},
	scroll: function(){
		var st = $(document).scrollTop(),
			index = this.getIndex(this.offsetAry, st),
			i = index - 1;

		if(this.curIndex !== index){ // 判断分类是否切换
			
			$('.menu_tt h2').removeClass('menu_fixed');
			this.el.find('a').removeClass('on');
			if(i >= 0){
				this.el.addClass('menu_fixed');
				$('.menu_tt').eq(i).find('h2').addClass('menu_fixed');
				this.el.find('a').eq(i).addClass('on');	
			}else{
				this.el.removeClass('menu_fixed');
			}
			this.curIndex = index;
		}
	}
}

$(function(){
	menu.init('#menuNav');

	// $('#menuWrap .add').amount(0, $.amountCb());
	$('#menuWrap .add').each(function(){
		$(this).amount(0, $.amountCb());
		for(var i = 0, num = parseInt($(this).data('num')); i < num; i++){
			$(this).click();
		}
	});

	
	var _wraper = $('#menuDetail');

	var dialogTarget;
	$('.menu_list li').click(function(e){
		var _this = $(this),
			F = function(str){return _this.find(str);},
			title = F('h3').text(),
			imgUrl = F('img').attr('url'),
			price = F('.unit_price').text(),
			sales = F('.sales strong').attr('class'),
			saleNum = F('.sale_num').text(),
			info = F('.info').text(),
			saleDesc = F('.salenum').html(),
			unit=F('.theunit').text(),
			_detailImg = _wraper.find('img');

		_wraper.find('.price').text(price).end()
			.find('.sales strong').attr('class', sales).end()
			.find('.sale_desc').html(saleDesc).end()
			.find('.info').text(info);

		_wraper.parents('.dialog').find('.dialog_tt').text(title);

		if(F('.add').length){
			$('#detailBtn').removeClass('disabled').text('来一'+unit);
		}else{
			$('#detailBtn').addClass('disabled').text('已售完');
		}

		if(imgUrl){
			_detailImg.attr('src', imgUrl).show().next().hide();
		}else{
			_detailImg.hide().next().show();
		}

		dialogTarget = _this;
		_wraper.dialog({title: title, closeBtn: true});

	});

	$('#menuWrap .price_wrap').click(function(e){
		e.stopPropagation();
	});

	$('#detailBtn').click(function(){
		// alert(dialogTarget.find('.unit_price').text());
		if(!$(this).hasClass('detail')){
			dialogTarget.find('.add ').click();
		}
	});
});