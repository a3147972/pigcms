$(function(){
	$('#login_account').focus();
	$('#login_form').submit(function(){
		notice('正在登录中~','loading');
		if($('#login_account').val()==''){
			notice('请输入帐 号~','error');
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
							window.parent.location = store_index;
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
});
function login_fleshVerify(url){
	var time = new Date().getTime();
	$('#login_verifyImg').attr('src',url+"&time="+time);
}
function notice(msg,pic){
	if($(window).height() > $('body').height()){
		$('.notice').remove();
		$('body').append('<div class="notice"><img src="'+static_path+'login/img/'+pic+'.gif" />'+msg+'</div>');
		setTimeout(function(){
			$('.notice').remove();
		},5000);
	}else{
		if(pic != 'loading'){
			alert(msg);
		}
	}
}