$(function(){
	$('.recharge-box .tab a').click(function(){
		$(this).addClass('on').siblings('a').removeClass('on');
		$('.pnl-'+$(this).data('type')).show().siblings('.pnl').hide();
	});
	$('.recharge-box .tb-wt-denom li').click(function(){
		$(this).addClass('tb-wt-active').siblings('li').removeClass('tb-wt-active');
	});
	$('.tb-wt-content .txt').focus(function(){
		$(this).closest('.tb-wt-row').find('.tb-wt-placeholder').hide();
	}).blur(function(){
		if($(this).val() == ''){
			$(this).closest('.tb-wt-row').find('.tb-wt-placeholder').show();
		}
	});
	$('.recharge-box .tab a').eq(0).addClass('on').trigger('click');
	
	//水费查询
	$('#recharge_water_btn').click(function(){
		$('#water_txt').val($.trim($('#water_txt').val()));
		if($('#water_txt').val() == ''){
			err_tips($(this),'请输入您的户号',0);
			return false;
		}
		life_service($(this),{type:'water',account:$('#water_txt').val()});
	});
	//电费查询
	$('#recharge_electric_btn').click(function(){
		$('#electric_txt').val($.trim($('#electric_txt').val()));
		if($('#electric_txt').val() == ''){
			err_tips($(this),'请输入您的户号',0);
			return false;
		}
		life_service($(this),{type:'electric',account:$('#electric_txt').val()});
	});
	//煤气费查询
	$('#recharge_gas_btn').click(function(){
		$('#gas_txt').val($.trim($('#gas_txt').val()));
		if($('#gas_txt').val() == ''){
			err_tips($(this),'请输入您的户号',0);
			return false;
		}
		life_service($(this),{type:'gas',account:$('#gas_txt').val()});
	});
});
var service_water = false;
function life_service(obj,data){
	if(is_login == false){
		login_bar();
		return false;
	}
	$(obj).hide();
	err_tips(obj,'正在查询中，请稍候…',1);
	if(service_water == true){
		return false;
	}
	service_water = true;
	$.post(service_action,data,function(result){
		$(obj).show();
		service_water = false;
		err_tips(obj,'',0);
		if(result.err_code == 99){
			login_bar();
			return false;
		}else if(result.err_code){
			err_tips(obj,result.err_msg,0);
			return false;
		}
		
		if(data.type == 'water' || data.type == 'electric' || data.type == 'gas'){
			art.dialog({
				id: 'recharge_life_handle',
				title:'查询结果',
				padding: '30px',
				width: 500,
				height: 300,
				lock: true,
				resize: false,
				background:'black',
				padding:0,
				fixed: false,
				opacity:'0.4',
				content:'<div class="rbox-table confirm-table"><table><tr><th><span>缴费项目:</span></th><td><span>'+result.payType+'</span></td></tr><tr><th><span>缴费地区:</span></th><td><span>'+result.provinceName+' '+result.cityName+'</span></td></tr><tr><th><span>收费单位:</span></th><td><span>'+result.payUnitName+'</span></td></tr><tr><th><span>缴费号码:</span></th><td><span>'+result.account+'</span></td></tr><tr><th><span>户名:</span></th><td><span>'+result.accountName+'</span></td></tr><tr><th><span>欠费金额:</span></th><td><span style="color:#ff6600">'+result.balance+'</span>元</td></tr></table></div>',
				ok:function(){
					art.dialog({
						icon: 'face-smile',
						title: '提示信息',
						id:'recharge_lifetips_handle',
						opacity:'0.4',
						lock:true,
						fixed: true,
						resize: false,
						content: '正在请求中...'
					});
					$.post(service_action,{type:data.type+'_recharge',id:result.orderId,balance:result.balance},function(recharge_result){
						if(recharge_result.err_code == 99){
							login_bar();
							return false;
						}else if(recharge_result.err_code == 98){
							art.dialog.list['recharge_lifetips_handle'].close();
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
								content:'<div class="recharge_tips"><p>'+recharge_result.err_msg+'</p><a class="btn" href="'+recharge_url+'" target="_blank">充值</a></div>'
							});
						}else if(recharge_result.err_code){
							if(recharge_result.err_code == 1009 || recharge_result.err_code == 1010){
								art.dialog.list['recharge_life_handle'].close();
							}
							art.dialog.list['recharge_lifetips_handle'].close();
							art.dialog({
								icon: 'error',
								time: 10,
								title: '提示信息',
								id:'recharge_lifeerrortips_handle',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: recharge_result.err_msg
							});
							return false;
						}else{
							art.dialog.list['recharge_lifetips_handle'].close();
							art.dialog.list['recharge_life_handle'].close();
							art.dialog({
								icon: 'succeed',
								time: 10,
								title: '提示信息',
								id:'recharge_lifeerrorsuccess_handle',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: '提交订单成功<br/>充值会有一定的等待时间，等稍后在我的订单中查询订单状态'
							});
							return false;
						}
						
					});
					return false;
				},
				okVal:'缴费'
			});
		}
	});
}
function loginAfter(){
	is_login = true;
	var list = art.dialog.list;
	for(var i in list){
		list[i].close();
	};
}
function err_tips(obj,msg,err){
	if(obj.siblings('.tb-wt-err').size() > 0){
		obj.siblings('.tb-wt-err').html(msg);
	}else{
		obj.after('<span class="tb-wt-err">'+msg+'</span>');
	}
	if(err == 1){
		obj.siblings('.tb-wt-err').addClass('blue');
	}else{
		obj.siblings('.tb-wt-err').removeClass('blue');
	}
}

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
		opacity:'0.4'
	});
}