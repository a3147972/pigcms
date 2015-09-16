<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>店员中心</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_public}js/laytpl.js"></script>
	<script src="{pigcms{$static_path}layer/layer.m.js"></script>
    <style>
	    dl.list dd.dealcard {
	        overflow: visible;
	        -webkit-transition: -webkit-transform .2s;
	        position: relative;
	    }
	    .dealcard.orders-del {
	        -webkit-transform: translateX(1.05rem);
	    }
	    #orders .dealcard-block-right {
			margin-left:1px;
	        position: relative;
	    }
	    .dealcard small {
	        font-size: .24rem;
	        color: #9E9E9E;
	    }
	    .dealcard weak {
	        font-size: .24rem;
	        color: #999;
	        position: absolute;
	        bottom: 0;
	        left: 0;
	        display: block;
	        width: 100%;
	    }
	    .dealcard weak b {
	        color: #FDB338;
	    }
	    .dealcard weak a.btn{
	        margin: -.15rem 0;
	    }
	    .dealcard weak b.dark {
	        color: #fa7251;
	    }
	    .hotel-price {
	        color: #ff8c00;
	        font-size: .24rem;
	        display: block;
	    }
	    .del-btn {
	        display: block;
	        width: .45rem;
	        height: .45rem;
	        text-align: center;
	        line-height: .45rem;
	        position: absolute;
	        left: -.85rem;
	        top: 50%;
	        background-color: #EC5330;
	        color: #fff;
	        -webkit-transform: translateY(-50%);
	        border-radius: 50%;
	        font-size: .4rem;
	    }
	    .no-order {
	        color: #D4D4D4;
	        text-align: center;
	        margin-top: 1rem;
	        margin-bottom: 2.5rem;
	    }
	    .icon-line {
	        font-size: 2rem;
	        margin-bottom: .2rem;
	    }

	    .order-icon {
	        display: inline-block;
	        width: .5rem;
	        height: .5rem;
	        text-align: center;
	        line-height: .5rem;
	        border-radius: .06rem;
	        color: white;
	        margin-right: .25rem;
	        margin-top: -.06rem;
	        margin-bottom: -.06rem;
	        background-color: #F5716E;
	        vertical-align: initial;
	        font-size: .3rem;
	    }
	    .order-all {
	        background-color: #2bb2a3;
	    }
	    .order-zuo,.order-jiudian {
	        background-color: #F5716E;
	    }
	    .order-fav {
	        background-color: #0092DE;
	    }
	    .order-card {
	        background-color: #EB2C00;
	    }
	    .order-lottery {
	        background-color: #F5B345;
	    }
	    .color-gray{
	    	color:gray;
	    	border-color:gray;
	    }
	    .color-gray:active{
	    	background-color:gray;
	    }
		#nav-dropdown{height: 1.7rem;}
		#filtercon select{height: 100%;line-height: normal; width:100%;}
		#find_submit{
			position: absolute;
			right: 0;
			top: .15rem;
			width: 1.2rem;
			height: .7rem;;
			-webkit-box-sizing: border-box;
		}
		#filtercon{margin: 0 .15rem;}
.find_txt_div{
vertical-align: middle;
position: relative;
margin-right: 1.3rem;
margin-left: 1.8rem;
border-radius: .06rem;
border: 1px #CCC solid;
height: .7rem;
line-height: .7rem;
}
	#filtercon input{
width: 100%;
border: none;
background: rgba(255, 255, 255, 0);
outline-style: none;
display: block;
line-height: .28rem;
height: 100%;
font-size: .28rem;
padding: 0;
}
 .dealcard-block-right li{
     font-size: .266rem;
font-weight: 400;
 }
  .dealcard-block-right li.name,.dealcard-block-right li.detail{
     margin-bottom: .18rem;
 }
.dealcard-block-right .dth{font-weight: bold;}
 .ulrightdiv{
	float: right;
	position: relative;
	top: -55px;
	margin-right: 15px;
	}
	dl.list .dd-padding{padding: .28rem 0.1rem;}
.dealcard-block-right{padding: 0 10px;}
#orders a{color: #333;}
.find_div{margin:.15rem 0;}
.find_type_div{
	position: absolute;
left: 0;
top: .15rem;
width: 1.7rem;
height: .7rem;
text-align: center;
background: white;
}
</style>
</head>
<body>
	<dl class="list" style="border-top:none;margin-top:0rem;">
		<dd id="filtercon">
			<div class="find_div">
				<div class="find_type_div">
					<select name="find_type" id="find_type" class="col-sm-1">
						<optgroup label="{pigcms{$config.group_alias_name}">
							<option value="1">消费密码</option>
						</optgroup>
						<optgroup label="实物">
							<option value="2">快递单号</option>
						</optgroup>
						<optgroup label="通用">
							<option value="3">订单ID</option>
							<option value="4">{pigcms{$config.group_alias_name}ID</option>
							<option value="5">用户ID</option>
							<option value="6">用户昵称</option>
							<option value="7">手机号码</option>
						</optgroup>
					</select>
				</div>
				<div class="find_txt_div"><input name="find_value" id="find_value" type="text" /></div>
				<button class="btn" type="submit" id="find_submit">搜索</button>
			</div>
		</dd>
	</dl>
	    <div style="margin-top:.2rem;">
		    <dl class="list" id="orders">
				<volist name="order_list" id="vo">
					<dd class="dealcard dd-padding">
						<a href="{pigcms{:U('Storestaff/group_edit',array('order_id'=>$vo['order_id']))}">
							<ul class="dealcard-block-right">
								<li class="name"><span class="dth">{pigcms{$config.group_alias_name}名称：</span>
								<span class="ttd">{pigcms{$vo.s_name}</span></li>
								<li class="detail"><span class="dth">订单信息：</span><span class="xth">数量: </span><span class="td">{pigcms{$vo.num}</span>&nbsp;&nbsp;<span class="xth">总价: </span><span class="td">{pigcms{$vo.total_money} 元</span></li>
								<li><span class="dth">订单状态：</span><span>
								    <if condition="$vo['status'] eq 3">
										   <font color="red">已取消</font>
									<elseif condition="$vo['paid']" />
										<if condition="$vo['third_id'] eq '0' AND $vo['pay_type'] eq 'offline'">
										<font color="red">线下未付款</font>
											<elseif condition="$vo['status'] eq 0" />
												<font color="green">已付款</font>&nbsp;
												<php>if($vo['tuan_type'] != 2){</php>
													<font color="red">未消费</font>
													<span onclick="group_verify_btn({pigcms{$vo['order_id']},$(this));return false;" style="color:#FF658E">验证消费</span>
												<php>}else{</php>
													<font color="red">未发货</font>
												<php>}</php>
											<elseif condition="$vo['status'] eq 1"/>
												<php>if($vo['tuan_type'] != 2){</php>
													<font color="green">已消费</font>&nbsp;
												<php>}else{</php>
													<font color="green">已发货</font>&nbsp;
												<php>}</php>
												<font color="red">待评价</font>
											<else/>
												<font color="green">已完成</font>
											</if>
										<else/>
											<font color="red">未付款</font>
										</if></span></li>
							</ul>
						</a>
					</dd>

				</volist>
			</dl>
			<!--<div class="top-btn" style="display: block;left:10px;opacity: 0.8;"><a class="react" href="{pigcms{:U('Storestaff/group_list')}"><i class="text-icon">刷新</i></a></div>
			<div class="top-btn" style="display: block;left:60px"><a class="react"><i class="text-icon">⇧</i></a></div>-->
		</div>
		<script id="find_html" type="text/html">
	{{# for(var i = 0, len = d.list.length; i < len; i++){ }}
		<dd class="dealcard dd-padding">
		 <a href="{pigcms{:U('Storestaff/group_edit')}&order_id={{ d.list[i].order_id }}">
		  <ul class="dealcard-block-right">
		   <li  class="name"><span class="dth">{pigcms{$config.group_alias_name}名称：</span>
			<span class="ttd">{{ d.list[i].s_name }}</span></li>
		   <li  class="detail"><span class="dth">订单信息：</span><span class="xth">数量: </span><span class="td">{{ d.list[i].num }}</span>&nbsp;&nbsp;<span class="xth">总价: </span><span class="td">{{ d.list[i].total_money }} 元</span></li>
			<li><span class="dth">订单状态：</span><span>
				{{# if(d.list[i].paid == '1'){ }}
					{{# if(d.list[i].pay_type == 'offline' && d.list[i].third_id ==0){ }}
						<font color="red">线下未付款</font>&nbsp;
						<span onclick="group_verify_btn({{ d.list[i].order_id }},$(this));return false;" style="color:#FF658E">验证付款</span>
					{{# }else if(d.list[i].status == '0'){ }}
						<font color="green">已付款</font>&nbsp;
						{{# if(d.list[i].tuan_type != '2'){ }}
							<font color="red">未消费</font>&nbsp;
							<span onclick="group_verify_btn({{ d.list[i].order_id }},$(this));return false;" style="color:#FF658E">验证消费</span>
						{{# }else{ }}
							<font color="red">未发货</font>
						{{# } }}
					{{# }else if(d.list[i].status == '1'){ }}
						<font color="green">已消费</font>&nbsp;
						<font color="red">待评价</font>
					{{# }else{ }}
						<font color="green">已完成</font>
					{{# } }}
				{{# }else{ }}
					<font color="red">未付款</font>
				{{# } }}
				</span></li>
				</ul>
				</a>
			   </dd>
	{{# } }}
</script>
		<include file="Storestaff:footer"/>
</body>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript">
	$('#find_value').keyup(function(e){
		if(e.keyCode == 13){
			$(this).blur();
			$('#find_submit').trigger('click');
		}
	});
	$('#find_submit').click(function(){
		var find_value = $('#find_value');
		find_value.val($.trim(find_value.val()));
		if(find_value.val().length < 1){
			layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'请输入查找内容',btn: ['确定'],end:function(){find_value.focus();}});
			return false;
		}
		
		var post_type = $('#find_type').val();
		var post_value = $('#find_value').val().replace(/\s+/g,"");
		$('#find_submit').removeClass('btn-success').addClass('btn-error').prop('disabled',true);
		$('#order_html').empty();
		$('#order_list').hide();
		layer.open({
			type: 2,
			content: '正在请求中'
		});
		$.post("{pigcms{:U('Storestaff/group_find')}",{find_type:post_type,find_value:post_value},function(result){
			layer.closeAll();
			$('#find_submit').removeClass('btn-error').addClass('btn-success').prop('disabled',false).html('搜索');
			data = $.parseJSON(result);
			if(data.row_count > 0){
				laytpl(document.getElementById('find_html').innerHTML).render(data, function(html){
					document.getElementById('orders').innerHTML = html;
					$('#order_list').show();
				});
			}else{
				layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'未查找到内容！',btn: ['确定'],end:function(){find_value.focus();}});
			}
		});
		
		return false;
	});

	function group_verify_btn(oid,obj){
	  	var verify_btn = obj;
		verify_btn.html('验证中..');
		$.get("{pigcms{:U('Storestaff/group_verify')}&order_id="+oid,function(result){
			if(result.status == 1){
				layer.open({
					title:['成功提示：','background-color:#FF658E;color:#fff;'],
					content:result.info,
					btn: ['确定'],
					end:function(){window.location.href = window.location.href;}
				});
			}else{
				verify_btn.html('验证消费');
				layer.open({
					title:['错误提示：','background-color:#FF658E;color:#fff;'],
					content:result.info,
					btn: ['确定'],
					end:function(){}
				});
			}
		});
		return false;
	}

</script>
{pigcms{$shareScript}
<script type="text/javascript">
function is_mobile(){
	var ua = navigator.userAgent.toLowerCase();
	if ((ua.match(/(iphone|ipod|android|ios|ipad)/i))){
		if(navigator.platform.indexOf("Win") == 0 || navigator.platform.indexOf("Mac") == 0){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}
}
function is_weixin(){
    var ua = navigator.userAgent.toLowerCase();
    if(is_mobile() && ua.indexOf('micromessenger') != -1){  
        return true;  
    } else {  
        return false;  
    }  
}
function getParam(url,name){ 
	var reg = new RegExp("[&|?]"+name+"=([^&$]*)", "gi"); 
	var a = reg.test(url); 
	return a ? RegExp.$1 : ""; 
}
$('#qrcode_btn').click(function(){
	if(is_weixin()){
		wx.scanQRCode({
			needResult:1,
			scanType:["qrCode"],
			success:function (res){
				/*
				 * URL提示：
				 *    /wap.php?c=Storestaff&a=group_qrcode&id=(14位消费码)
				 *    /wap.php?c=Storestaff&a=meal_qrcode&id=(订单ID)
				 */
				var result = res.resultStr;
				if(result.indexOf('http://') !== 0 && result.indexOf('https://') !== 0){
					layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'您扫描的内容 “ <font color="red">'+result+'</font> ” 不是有效的验证二维码',btn: ['确定'],end:function(){}});
				}else{
					var ctype = getParam(result,'a'),id = getParam(result,'id'),c = getParam(result,'c');
					var actMode='group_qrcode';
					if(ctype == 'meal_qrcode') actMode='meal_qrcode';
					if((ctype != 'group_qrcode' && ctype != 'meal_qrcode') || id== '' || c != 'Storestaff'){
						layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'您扫描的内容不是有效的验证二维码',btn: ['确定'],end:function(){}});
					}else{
						layer.open({
							title:['提示：','background-color:#FF658E;color:#fff;'],
							content:'初次检测订单属于 <font color="red">'+(ctype == 'group_qrcode' ? '{pigcms{$config.group_alias_name}' : '{pigcms{$config.meal_alias_name}')+'</font> 订单，您是要验证消费或查看订单？',
							btn: ['验证消费', '查看订单'],
							shadeClose: false,
							yes: function(){
								layer.open({
									type: 2,
									content: '验证消费中，请稍后'
								});
								$.getJSON("/wap.php?g=Wap&c=Storestaff&a="+actMode,{type:ctype,id:id,ajax:1},function(ret){
									//layer.closeAll();
									if(!ret.error){
										layer.open({
											title:['成功提示：','background-color:#FF658E;color:#fff;'],
											content:'验证成功！是否要刷新页面？',
											btn: ['确定','取消'],
											yes: function(index){
												window.location.href='/wap.php?g=Wap&c=Storestaff&a=group_list';
												layer.close(index);
											}
										});
									}else{
										layer.open({
											title:['错误提示：','background-color:#FF658E;color:#fff;'],
											content:ret.msg,
											btn: ['确定'],
											end:function(){
												window.location.href='/wap.php?g=Wap&c=Storestaff&a=group_list';
											}
										});
									}
								});
							}, no: function(){
								if(ctype == 'group_qrcode'){
									window.location.href = "{pigcms{:U('Storestaff/group_edit')}&order_id="+getParam(result,'order_id');
								}else{
									window.location.href = "{pigcms{:U('Storestaff/meal_edit')}&order_id="+getParam(result,'id');
								}
							}
						});
					}
				}	
			}
		});
	}else{
		layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'您使用的不是微信浏览器，此功能无法使用！您可以使用浏览器自带的或其他扫描二维码工具进行扫描',btn: ['确定'],end:function(){}});
	}
	return false;
});
</script>
</html>