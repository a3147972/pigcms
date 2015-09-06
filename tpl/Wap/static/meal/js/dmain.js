$.fn.amount = function(num, callback){
	var num = typeof num === 'undefined' ? 0 : num,
		callback = callback || $.noop,
		isShow = num > 0 ? '' : ' style="display:none;"',
		activeClass = 'active';

	function add(){
		var obj = $(this).prev(),
			_num = obj.find('input'),
			curNum = parseInt(_num.val(), 10);

		var data_obj = obj.parent();
		var max = data_obj.attr("max");/**控制每个菜最多可点多少份**/
		if(null != max && max != "" && max != "-1" && curNum >= max)
		{
			return false;
		}
		
		_num.val(++curNum);
		data_obj.next(".number").val(curNum);
		if(curNum > 0){
			obj.show();
			$(this).addClass(activeClass);
		}
		return callback.call(this, '+');
	}

	function del(){
		var obj = $(this).parent(),
			_num = obj.find('input'),
			_add = obj.next(),
			curNum = parseInt(_num.val(), 10);

		_num.val(--curNum);
		obj.parent().next(".number").val(curNum);
		if(curNum < 1){
			obj.hide();
			_add.removeClass(activeClass);
		}else{
			_add.addClass(activeClass);
		}
		return callback.call(this, '-');
	}

	return this.each(function(){
		$(this).before('<span'+ isShow +'><a href="javascript:void(0);" class="btn minus '+ activeClass +'"></a><span class="num"><input type="text" readonly="true" value="'+num+'"></span></span>').bind('click', add);
		
		$(this).prev().find('.minus').bind('click', del);

		if(num > 0){
			$(this).addClass(activeClass);
		}
	});
}

$.amountCb = function(){
	//var _condition = $('#sendCondition');
	var	_total = $('#allmoney'),
		_leveltotal =$('#levelallmoney'),
		_cartNum = $('#menucount'),
		_nextstep = $('#nextstep');
		//sendCondition = parseFloat(_condition.text()).toFixed(3);
	return function(sign){
		discount=parseFloat(0); //折扣 暂时没在这里用到
		var totalPrice = parseFloat(_total.text()) || 0,
			disPrice = parseFloat(sign + 1) * parseFloat($(this).parents('li').find('.tureunit_price').val()),
			price = totalPrice + disPrice,
			number = _cartNum.text() == '' ? 0 : parseInt(_cartNum.text()),
			disNumber = number + parseInt(sign + 1);
			price = parseFloat((price).toFixed(3));
		_total.text(price);
		if(typeof(leveloff)!='undefined' && leveloff){
		   offtyp=parseInt(offtyp);
		   offvv=parseInt(offvv);
		   if(offtyp==1){
			 _leveltotal.text((price*(offvv/100)).toFixed(2));
		   }else if(offtyp==2){
		     _leveltotal.text((price-offvv).toFixed(2));
		   }
		}
		//_condition.text(parseFloat((sendCondition - price).toFixed(3)));
		_cartNum.text(disNumber);
		
		/*if(sendCondition - price <= 0){
			_condition.parent().hide().next().show();
		}else{
			_condition.parent().show().next().hide();
		}*/
		if((disNumber > 0) && (price>0)){
			_nextstep.removeClass('gray disabled');
			_nextstep.addClass('orange show');
		}else{
			_nextstep.removeClass('orange show');
			_nextstep.addClass('gray disabled');
		}
		return false;
	}
}


$(function(){
	if($('#swipeNum').length){
		new Swipe($('#imgSwipe')[0], {
			speed: 500, 
			auto: 5000, 
			callback: function(index){
				$('#swipeNum li').eq(index).addClass("on").siblings().removeClass("on");
			}
		});
	}

	$('#storeList li').click(function(e){
		if(e.target.tagName != 'A'){
			location.href = $(this).attr('href');
		}
	});
});