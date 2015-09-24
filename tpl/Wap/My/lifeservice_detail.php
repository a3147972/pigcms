<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$now_order.type_txt}订单</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
	<style>
    .btn-wrapper {
        margin: .28rem .2rem;
    }
    .hotel-price {
        color: #ff8c00;
        font-size: 12px;
        display: block;
    }
    .dealcard .line-right {
        display: none;
    }
    .agreement li {
        display: inline-block;
        width: 50%;
        box-sizing: border-box;
        color: #666;
    }

    .agreement li:nth-child(2n) {
        padding-left: .14rem;
    }

    .agreement li:nth-child(1n) {
        padding-right: .14rem;
    }

    .agreement ul.agree li {
        height: .32rem;
        line-height: .32rem;
    }

    .agreement ul.btn-line li {
        vertical-align: middle;
        margin-top: .06rem;
        margin-bottom: 0;
    }

    .agreement .text-icon {
        margin-right: .14rem;
        vertical-align: top;
        height: 100%;
    }

    .agreement .agree .text-icon {
        font-size: .4rem;
        margin-right: .2rem;
    }


    #deal-details .detail-title {
        background-color: #F8F9FA;
        padding: .2rem;
        font-size: .3rem;
        color: #000;
        border-bottom: 1px solid #ccc;
    }

    #deal-details .detail-title p {
        text-align: center;
    }

    #deal-details .detail-group {
        font-size: .3rem;
        display: -webkit-box;
        display: -ms-flexbox;
    }

    .detail-group .left {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        display: block;
        padding: .28rem 0;
        padding-right: .2rem;
    }

    .detail-group .right {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.2rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    .detail-group .middle {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.7rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    ul.ul {
        list-style-type: initial;
        padding-left: .4rem;
        margin: .2rem 0;
    }

    ul.ul li {
        font-size: .3rem;
        margin: .1rem 0;
        line-height: 1.5;
    }
    .coupons small{
        float: right;
        font-size: .28rem;
    }
    strong {
        color: #FDB338;
    }
    .coupons-code {
        color: #666;
        text-indent: .2rem;
    }
    .voice-info {
        font-size: .3rem;
        color: #eb8706;
    }
</style>
</head>
<body id="index">
        <div id="tips" class="tips"></div>
        <div class="wrapper-list">
			<dl class="list coupons">
				<dd>
					<dl>
						<dt>{pigcms{$now_order.type_txt}订单</dt>
						<dd class="dd-padding coupons-code">户名：{pigcms{$now_order.infoArr.accountName}</dd>
						<dd class="dd-padding coupons-code">户号：{pigcms{$now_order.infoArr.account}</dd>
						<dd class="dd-padding coupons-code">金额：{pigcms{$now_order.pay_money}元</dd>
						<dd class="dd-padding coupons-code">状态：<if condition="$now_order['status'] eq 1"><font color="red">充值中</font><elseif condition="$now_order['status'] eq 2"/><font color="green">缴费成功</font><elseif condition="$now_order['status'] eq 3"/><font color="red">已退款</font></if></dd>
					</dl>
				</dd>
			</dl>
			<dl class="list">
				<dd>
					<dl>
						<dt>订单详情</dt>
						<ul class="ul">
							<li>订单编号：{pigcms{$now_order.order_id}</li>
							<li>下单时间：{pigcms{$now_order.add_time|date='Y-m-d H:i',###}</li>
							<li>支付时间：{pigcms{$now_order.pay_time|date='Y-m-d H:i',###}</li>
							<li>缴费地区：{pigcms{$now_order.infoArr.provinceName}&nbsp;&nbsp;{pigcms{$now_order.infoArr.cityName}</li>
							<li>缴费单位：{pigcms{$now_order.infoArr.payUnitName}</li>
							<if condition="$now_order['status'] eq 2">
								<li>到帐时间：{pigcms{$now_order.transfer_time|date='Y-m-d H:i',###}</li>
							</if>
						</ul>
					</dl>
				</dd>
			</dl>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<include file="Public:footer"/>
		<script>
			<if condition="$now_order['status'] eq 1">
				$(function(){
					layer.open({type: 2,content: '正在查询缴费状态,请稍等',shadeClose:false});
					$.post('{pigcms{:U('Lifeservice/post')}',{type:'{pigcms{$now_order.type_eng}_check',id:{pigcms{$now_order.order_id}},function(check_result){
						console.log(check_result);
						layer_closeAll();
						if(check_result.err_code == 10001){
							layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:check_result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
								window.location.href = window.location.href;
							}});
						}else if(check_result.err_code == 10000){
							layer.open({title:['错误提示','background-color:#FF658E;color:#fff;'],content:'缴费正处于充值中，充值成功系统会通过公众号发消息提醒您！充值会有一定的等待时间，请稍后再继续查询订单状态。',btn: ['确定']});
						}else if(check_result.err_code){
							layer_tips(check_result.err_msg);
						}else{
							layer_closeAll();
							layer.open({title:['到帐提示','background-color:#0099CC;color:#fff;'],content:check_result.err_msg,shadeClose:false,btn: ['确定'],yes:function(){
								window.location.href = window.location.href;
							}});
						}
					});
				});
			</if>
			
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
		</script>
{pigcms{$hideScript}
</body>
</html>