$(function(){
	$('button').click(function(){
		if($(this).attr('for') == 'J-cart-add'){
			$('#sysmsg-error').empty().hide();
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(input_dom.val())){
				buy_error('请输入正确的购买数量');
			}else{
				if(input_dom.attr('data-max') != '0' && input_Val >= parseInt(input_dom.attr('data-max'))){
					buy_error('每人最多只能购买 '+(input_dom.attr('data-max'))+' 单');
				}else{
					input_dom.val(input_Val+1);
					$('#J-deal-buy-total,#deal-buy-total-t').html(((input_Val+1)*(group_price*10000))/10000);
				}
			}
		}else if($(this).attr('for') == 'J-cart-minus'){
			$('#sysmsg-error').empty().hide();
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(input_dom.val())){
				buy_error('请输入正确的购买数量');
			}else{
				if(input_Val <= parseInt(input_dom.attr('data-min'))){
					buy_error('最少 '+parseInt(input_dom.attr('data-min'))+' 件起售');
				}else{
					input_dom.val(input_Val-1);
					$('#J-deal-buy-total,#deal-buy-total-t').html((input_Val-1)*(group_price*10000)/10000);
				}
			}
		}
	});
	$('.J-cart-quantity').blur(function(){
		$('#sysmsg-error').empty().hide();
		if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test($(this).val())){
			buy_error('请输入正确的购买数量');
		}else{
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(input_dom.attr('data-max') != '0' && input_Val >= parseInt(input_dom.attr('data-max'))){
				buy_error('每人最多只能购买 '+(input_dom.attr('data-max'))+' 单');
			}else if(input_Val < parseInt(input_dom.attr('data-min'))){
				buy_error('最少 '+parseInt(input_dom.attr('data-min'))+' 件起售');
			}else{
				$('#J-deal-buy-total,#deal-buy-total-t').html((input_Val)*(group_price*10000)/10000);
			}
		}
	});
	$('.common-close').live('click',function(){
		$('#sysmsg-error').empty().hide();
	});
	
	$('#deal-buy-form').submit(function(){
		if(is_login == false){
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
		}
		if(has_phone == false){
			art.dialog.open(phone_url,{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'绑定手机号码',
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
		}
		$('#sysmsg-error').empty().hide();
		if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test($('.J-cart-quantity').val())){
			buy_error('请输入正确的购买数量');
			return false;
		}else{
			var input_dom = $('.J-cart-quantity');
			var input_Val = parseInt(input_dom.val());
			if(input_dom.attr('data-max') != '0' && input_Val >= parseInt(input_dom.attr('data-max'))){
				buy_error('每人最多只能购买 '+(input_dom.attr('data-max'))+' 单');
				return false;
			}else if(input_Val < parseInt(input_dom.attr('data-min'))){
				buy_error('最少 '+parseInt(input_dom.attr('data-min'))+' 件起售');
				return false;
			}
		}
	});
});

function buy_error(msg){
	$('#sysmsg-error').html('<div class="sysmsg"><span class="J-msg-content"><span class="J-tip-status tip-status tip-status--error"></span>'+msg+'</span><span class="close common-close">关闭</span></div>').show();
}
