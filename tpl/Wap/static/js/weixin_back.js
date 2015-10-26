$(function(){
	$('.taba .slide').css({'left':$('.taba .active').offset().left,'width':$('.taba .active').width()});
	$(window).resize(function(){
		$('.taba .slide').css({'left':$('.taba .active').offset().left,'width':$('.taba .active').width()});
	});

	$('#login-form').submit(function(){
		var phone = $.trim($('#login_phone').val());
		$('#login_phone').val(phone);
		if(phone.length == 0){
			$('#tips').html('请输入手机号码。').show();
			return false;
		}
		if(!/^[0-9]{11}$/.test(phone)){
			$('#tips').html('请输入11位数字的手机号码。').show();
			return false;
		}

		var password = $('#login_password').val();
		if(password.length == 0){
			$('#tips').html('请输入密码。').show();
			return false;
		}

		$.post($('#login-form').attr('action'),{phone:phone,password:password},function(result){
			if(result.status == '1'){
				window.location.href = $('#login-form').attr('location_url');
			}else{
				$('#tips').html(result.info).show();
			}
		});

		return false;
	});

	$('.taban li').click(function(){
		$(this).addClass('active').siblings('li').removeClass('active');
		$('#'+$(this).attr('tab-target')).show().siblings('form').hide();

		$('.taba .slide').css({'left':$('.taba .active').offset().left,'width':$('.taba .active').width()});
	});

	$('#reg-form').submit(function(){
		var phone = $.trim($('#reg_phone').val());
		$('#reg_phone').val(phone);
		if(phone.length == 0){
			$('#tips').html('请输入手机号码。').show();
			return false;
		}
		if(!/^[0-9]{11}$/.test(phone)){
			$('#tips').html('请输入11位数字的手机号码。').show();
			return false;
		}

		var password_type = $('#reg_password_type').val();
		if(password_type === '0'){
			var password = $('#reg_pwd_password').val();
		}else{
			var password = $('#reg_txt_password').val();
		}
		if(password.length < 6){
			$('#tips').html('请输入6位以上的密码。').show();
			return false;
		}
		var recomment = $.trim($('#recomment').val());
		var id_number = $.trim($('#id_number').val());
		var id_number_img = $.trim($('#id_number_img').val());
		var with_id_card = $.trim($('#with_id_card').val());
		var bank_name = $('#bank_name').val();
        var bank_code = $('#bank_code').val();
        var bank_address = $('#bank_address').val();
        var bank_account = $('#bank_account').val();
        var alipay_account = $('#alipay_account').val();
        var alipay_name = $('#alipay_name').val();

		$.post($('#reg-form').attr('action'),{
			phone:phone,
			password:password,
			recomment:recomment,
			id_number : id_number,
			id_number_img : id_number_img,
			with_id_card : with_id_card,
			bank_name : bank_name,
            bank_code : bank_code,
            bank_address : bank_address,
            bank_account : bank_account,
            alipay_account : alipay_account,
            alipay_name : alipay_name
		},function(result){
			if(result.status == '1'){
				window.location.href = $('#reg-form').attr('location_url');
			}else{
				$('#tips').html(result.info).show();
			}
		});
		return false;
	});


	$('#reg_changeWord').click(function(){
		if($(this).html() == '显示明文'){
			$('#reg_txt_password').val($('#reg_pwd_password').val()).show();
			$('#reg_pwd_password').hide();
			$(this).html('显示密文');
			$('#reg_password_type').val(1);
		}else{
			$('#reg_pwd_password').val($('#reg_txt_password').val()).show();
			$('#reg_txt_password').hide();
			$(this).html('显示明文');
			$('#reg_password_type').val(0);
		}
	});
});