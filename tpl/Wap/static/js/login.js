$(function(){
	$('#login-form').submit(function(){
		var phone = $.trim($('#phone').val());
		$('#phone').val(phone);
		if(phone.length == 0){
			$('#tips').html('请输入手机号码。').show();
			return false;
		}
		if(!/^[0-9]{11}$/.test(phone)){
			$('#tips').html('请输入11位数字的手机号码。').show();
			return false;
		}
		
		var password = $('#password').val();
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
});