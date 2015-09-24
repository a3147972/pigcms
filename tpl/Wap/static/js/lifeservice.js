$(function(){
	if(account != ''){
		$('#recharge_txt').bind('input',function(){
			if($('#recharge_txt').val() == account){
				$('.nametip').show();
			}else if($('#recharge_txt').val() != account){
				$('.nametip').hide();
			}
		});
	}
	$('footer').css({'top':$(window).height()-40});
	$('#service_help').click(function(){
		var tipHeight = $(window).height()-91;
		layer.open({type:1,title:['缴费帮助说明','background-color:#0099CC;color:#fff;'],style:'max-width:100%;height:100%;',content:'<div class="tb-tip" style="padding:20px;height:'+tipHeight+'px;overflow-y: auto;"><dl><dt>问：怎么找到缴费户号？</dt><dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd><dt>问：缴费多长时间到帐？</dt><dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd><dt>问：怎么知道缴费成功？</dt><dd>答：1、您可以在会员中心-&gt;生活订单中查看缴费状态<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd></dl></div>'});
	});
	$('#recharge_btn').click(function(){
		$('#recharge_txt').val($.trim($('#recharge_txt').val()));
		if($('#recharge_txt').val() == ''){
			layer_tips('请输入您的户号');
			return false;
		}
		layer.open({type: 2,content: '查询中，请稍等',shadeClose:false});
		var data = {type:query_type,account:$('#recharge_txt').val()};
		$.post(service_action,data,function(result){
			if(result.err_code == 99){
				layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
					window.location.href = login_url;
				}});
				return false;
			}else if(result.err_code){
				layer_tips(result.err_msg);
				return false;
			}
			layer_closeAll();
			if(data.type == 'water' || data.type == 'electric' || data.type == 'gas'){
				layer.open({title:['查询结果','background-color:#0099CC;color:#fff;'],style:'width:260px;',content:'<div class="rbox-table confirm-table"><table><tr><th><span>缴费项目:</span></th><td><span>&nbsp;&nbsp;'+result.payType+'</span></td></tr><tr><th><span>缴费地区:</span></th><td><span>&nbsp;&nbsp;'+result.provinceName+' '+result.cityName+'</span></td></tr><tr><th><span>收费单位:</span></th><td><span>&nbsp;&nbsp;'+result.payUnitName+'</span></td></tr><tr><th><span>缴费号码:</span></th><td><span>&nbsp;&nbsp;'+result.account+'</span></td></tr><tr><th><span>户名:</span></th><td><span>&nbsp;&nbsp;'+result.accountName+'</span></td></tr><tr><th><span>欠费金额:</span></th><td><span style="color:#ff6600">&nbsp;&nbsp;'+result.balance+'</span>元</td></tr></table></div>',shadeClose:false,btn: ['缴费','取消'],yes: function(){
					layer.open({type: 2,content: '缴费中，请稍等',shadeClose:false});
					$.post(service_action,{type:data.type+'_recharge',id:result.orderId,balance:result.balance},function(recharge_result){
						if(recharge_result.err_code == 99){
							layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:recharge_result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
								window.location.href = login_url;
							}});
						}else if(recharge_result.err_code == 98){
							layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:recharge_result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
								window.location.href = my_recharge_url+"&money="+recharge_result.recharge_money;
							}});
						}else if(recharge_result.err_code){
							layer_tips(recharge_result.err_msg);
						}else{
							layer_closeAll();
							// layer.open({title:['缴费提示','background-color:#0099CC;color:#fff;'],content:'<b>提交订单成功</b><br/>充值会有一定的等待时间，等稍后在我的订单中查询订单状态',shadeClose:false,btn: ['确定']});
							layer.open({title:['缴费提示','background-color:#0099CC;color:#fff;'],content:'<b>提交订单成功</b><br/>请问您现在是否需要查询缴费是否已经到帐？',shadeClose:false,btn: ['确定','取消'],yes:function(){
								var layerIndex =layer.open({type: 2,content: '查询中，请稍等',shadeClose:false});
								setTimeout(function(){
									$.post(service_action,{type:data.type+'_check',id:result.orderId},function(check_result){
										console.log(check_result);
										if(check_result.err_code == 99){
											layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:check_result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
												window.location.href = login_url;
											}});
										}else if(check_result.err_code == 10000){
											layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:'缴费正处于充值中，充值成功我们会通过公众号发消息提醒您！充值会有一定的等待时间，请稍后在我的订单中查询订单状态。',shadeClose:false,btn: ['确定'],yes:function(){
												window.location.href = order_url+'&id='+result.orderId;
											}});
										}else if(check_result.err_code){
											layer_tips(check_result.err_msg);
										}else{
											layer_closeAll();
											layer.open({title:['到帐提示','background-color:#0099CC;color:#fff;'],content:check_result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
												window.location.href = order_url+'&id='+result.orderId;
											}});
										}
									});
								},3500);
							}});
						}
					});
				}});
			}
		});
	});
});

function layer_tips(msg){
	layer_closeAll();
	layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:msg,shadeClose:false,btn: ['确定']});
}
function layer_closeAll(){
	try{
		layer.closeAll();
	}catch(e){
		$('.layermbox').remove();
	}
}