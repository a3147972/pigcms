$(function(){
	$('#J-cart-minus').click(function(){
		if(parseInt($('#J-quantity').val()) <= 1){
			$('#J-quantity').val('1');
			$('#error_num_tips').html('最少需要参与 1 次');		
		}else{
			$('#error_num_tips').empty();
			$('#J-quantity').val(parseInt($('#J-quantity').val()) - 1);
		}
		return false;
	});
	$('#J-cart-add').click(function(){
		var now = parseInt($('#J-quantity').val());
		var max = parseInt($('#J-quantity').data('max'));
		if(now > 200){
			$('#J-quantity').val(200);
			$('#error_num_tips').html('一次性最多参加200次，请分批次参与');		
		}else if(now >= max){
			$('#J-quantity').val(max);
			$('#error_num_tips').html('最多只能参与 '+max+' 次');		
		}else{
			$('#error_num_tips').empty();
			$('#J-quantity').val(now + 1);
		}
		return false;
	});
	$('#J-quantity').blur(function(){
		var now = parseInt($('#J-quantity').val());
		$('#J-quantity').val(now);
		var max = parseInt($('#J-quantity').data('max'));
		if(now < 1){
			$('#J-quantity').val('1');
			$('#error_num_tips').html('最少需要参与 1 次');		
		}else if(now > 200){
			$('#J-quantity').val(200);
			$('#error_num_tips').html('一次性最多参加200次，请分批次参与');		
		}else if(now > max){
			$('#J-quantity').val(max);
			$('#error_num_tips').html('最多只能参与 '+max+' 次');		
		}else{
			$('#error_num_tips').empty();
		}
		return false;
	});
	
	var submit_now = false;
	$('#buy_form').submit(function(){
		//检测购买的值
		var now = parseInt($('#J-quantity').val());
		$('#J-quantity').val(now);
		var max = parseInt($('#J-quantity').data('max'));
		if(now < 1){
			$('#J-quantity').val('1');
			$('#error_num_tips').html('最少需要参与1次');
			return false;
		}else if(now > 200){
			$('#J-quantity').val(200);
			$('#error_num_tips').html('一次性最多参加200次，请分批次参与');
			return false;
		}else if(now > max){
			$('#J-quantity').val(max);
			$('#error_num_tips').html('最多只能参与 '+max+' 次');
			return false;
		}else{
			$('#error_num_tips').empty();
		}
		if(is_login == false){
			login_bar();
			return false;
		}
		if(submit_now == false){
			submit_now = true;
			$.post(submitFormAction,{q:$('#J-quantity').val()},function(result){
				submit_now = false;
				if(result.status != -4){
					alert(result.info);
				}else{
					art.dialog({
						id: 'recharge_handle',
						title:'帐户余额不足',
						padding: '30px',
						width: 320,
						height: 120,
						lock: true,
						resize: false,
						background:'black',
						fixed: false,
						opacity:'0.4',
						content:'<div class="recharge_tips"><p>'+result.info+'</p><a class="btn" href="'+recharge_url+'" target="_blank">充值</a></div>'
					});
				}
				if(result.status == 1){
					window.location.href = '?showOwn=1';
				}else{
					if(result.status == -3){
						login_bar();
					}else if(result.status == -2){
						window.location.reload();
					}else if(result.status == -1){
						$('#J-quantity').data('max',result.count);
						alert($('#J-quantity').data('max'));
					}
				}
			});
		}
		return false;
	});
	
	$('.set_tab').click(function(){
		$(this).addClass('off').siblings('li').removeClass('off');
		$('#con_one_'+$(this).data('id')).show().siblings('div').hide();
	});
	if(location.search.indexOf('showOwn') != -1){
		$('.showOwnBtn').trigger('click');
	}
	
	$('.min-box-list li img').hover(function(){
		$('#slider .show-box li img').attr('src',$(this).data('mpic'));
		$(this).closest('li').addClass('cur').siblings('li').removeClass('cur');
	});
	
	$(".suoyou").click(function(){
		var rightDiv = $(this).closest('.jion_right_div');
		rightDiv.toggleClass('tanchu');
		if($.trim(rightDiv.find('.number_list').html()) == ''){
			$.post(get_number_list,{id:rightDiv.data('id')},function(result){
				if(result.status == 1){
					var numberHtml = '';
					$.each(result.number,function(i,item){
						numberHtml += '<dd>'+item+'</dd>';
					});
					$('.number_list_'+rightDiv.data('id')).html(numberHtml);
				}else{
					alert(result.info);
				}
			});
		}
	});
	$(".jion_close").click(function(){
		$(this).closest('.jion_right_div').removeClass('tanchu');
	});
	$('.m-detail-main-codes-viewWinnerCodesBtn').click(function(){
		art.dialog({
			id: 'WinnerCodes_handle',
			title:'所有号码',
			padding: '30px',
			width: 500,
			height: 588,
			lock: true,
			resize: false,
			background:'white',
			fixed: false,
			opacity:'0.4',
			content:$('#WinnerCode').html(),
		});
	});
	$('.m-detail-main-codes-viewUserCodesBtn').click(function(){
		art.dialog({
			id: 'UserCodes_handle',
			title:'所有号码',
			padding: '30px',
			width: 500,
			height: 588,
			lock: true,
			resize: false,
			background:'white',
			fixed: false,
			opacity:'0.4',
			content:$('#UserCodes').html(),
		});
	});
	$('.btn-login').click(function(){
		login_bar();
	});
});

function login_bar(){
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
		opacity:'0.4',
	});
}