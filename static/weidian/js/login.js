$(function(){
	$('.J_textboxPrompt input').live('focusin focusout',function(event){
		if(event.type == 'focusin'){
			$(this).siblings('.input-text').hide();
		}else{
			if($(this).val().length == 0){
				$(this).siblings('.input-text').show();
			}
		}
	});
	$('#certificate').keyup(function(e){
		if(e.keyCode == 13){
			$('#loginValidate').trigger('click');
		}
	});
	
	$('#loginValidate').click(function(){
		$('label.validator_error').remove();
		var is_validate = true;
		var certificate = $('#certificate').val();
		if($.trim(certificate).length == 0){
			$('.input-pwd').append('<label class="validator_error"><span>请输入登陆凭证</span></label>');
			is_validate = false;
		}
		
		if(is_validate == false){
			$('label.validator_error:eq(0)').siblings('input').focus();
			return false;
		}else{
			$.post('./weidian.php',{'certificate':certificate},function(result){
				var result = eval ('('+result+')');
				if(result.error_code != 0){
					alert(result.error_msg,0);
					return false;
				}else{
					window.location.href = './weidian.php';
					return false;
				}
			});
		}
	});
});