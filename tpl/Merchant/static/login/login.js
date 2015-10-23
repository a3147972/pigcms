$(function(){
	$('#switch_btn a').click(function(){
		$(this).addClass('on').siblings('a').removeClass('on');
		$('#'+$(this).attr('types')+'_form').show().siblings('form').hide();
	});
	$('#login_account').focus();
	$('#login_form').submit(function(){
		notice('正在登录中~','loading');
		if($('#login_account').val()==''){
			notice('请输入帐号~','error');
			$('#login_account').focus();
			return false;
		}else if($('#login_pwd').val()==''){
			notice('请输入密码~','error');
			$('#login_pwd').focus();
		}else if($('#login_verify').val().length!=4){
			notice('请输入4位验证码~','error');
			$('#login_verify').focus();
		}else{
			$.post(login_check,$("#login_form").serialize(),function(result){
				result = $.parseJSON(result);
				if(result){
					if(result.error == 0){
						notice(result.msg,'ok');
						setTimeout(function(){
							window.parent.location = merchant_index;
						},1000);
					}else{
						$('#login_'+result.dom_id).focus();
						notice(result.msg,'error');
					}
				}else{
					notice('登录出现异常，请重试！','error');
				}
			});
		}
		return false;
	});
	$('#reg_form').submit(function(){
		notice('正在注册中~','loading');
		if($('#reg_account').val().length<6){
			notice('请输入至少 6 个字符的帐号~','error');
			$('#reg_account').focus();
			return false;
		}else if(!/^\w+$/.test($('#reg_account').val())){
			notice('帐号只能输入英文和数字和下划线~','error');
			$('#reg_account').focus();
		}else if($('#reg_pwd').val().length < 6){
			notice('请输入至少 6 个字符的密码~','error');
			$('#reg_pwd').focus();
		}else if($('#reg_name').val() == ''){
			notice('商户名称必填~','error');
			$('#reg_name').focus();
		}else if($('#reg_phone').val().length < 1 || !/^[0-9]{11}$/.test($('#reg_phone').val())){
			notice('请输入正确的手机号码~','error');
			$('#reg_phone').focus();
		}else if($('#reg_verify').val().length!=4){
			notice('请输入4位验证码~','error');
			$('#reg_verify').focus();
		}else{
			$.post(reg_check,$("#reg_form").serialize(),function(result){
				result = $.parseJSON(result);
				if(result){
					if(result.error == 0){
						notice(result.msg,'ok');
						alert(result.msg);
						window.location.reload();
					}else{
						$('#login_'+result.dom_id).focus();
						notice(result.msg,'error');
					}
				}else{
					notice('登录出现异常，请重试！','error');
				}
			});
		}
		return false;
	});
});
function login_fleshVerify(url){
	var time = new Date().getTime();
	$('#login_verifyImg').attr('src',url+"&time="+time);
}
function reg_fleshVerify(url){
	var time = new Date().getTime();
	$('#reg_verifyImg').attr('src',url+"&time="+time);
}
var notice_timer = null;
function notice(msg,pic){
	if($(window).height() > $('body').height()){
		if(notice_timer) clearTimeout(notice_timer);
		$('.notice').remove();
		$('body').append('<div class="notice"><img src="'+static_path+'login/img/'+pic+'.gif" />'+msg+'</div>');
		notice_timer = setTimeout(function(){
			$('.notice').remove();
		},5000);
	}else{
		if(pic != 'loading'){
			alert(msg);
		}
	}
}