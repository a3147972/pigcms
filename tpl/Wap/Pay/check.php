<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>确认订单</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
</head>
<body>
        <div id="tips" class="tips"></div>
        <div class="wrapper-list">
			<h4 style="margin-top:.4rem">{pigcms{$order_info.order_name}</h4>
			<dl class="list">
			    <dd>
			        <dl>
			        	<if condition="$order_info['order_txt_type']">
				        	<dd class="kv-line-r dd-padding">
				                <h6>类型：</h6>
				                <p>{pigcms{$order_info.order_txt_type}</p>
				            </dd>
			            </if>
			            <if condition="$order_info['order_num']">
				            <dd class="kv-line-r dd-padding">
				                <h6>购买数量：</h6><p>{pigcms{$order_info.order_num}</p>
				            </dd>
			            </if>	
			            <if condition="$order_info['order_price']">
				            <dd class="kv-line-r dd-padding">
				                <h6>项目单价：</h6><p>{pigcms{$order_info.order_price}元</p>
				            </dd>
			            </if>
			            <dd class="kv-line-r dd-padding">
			                <h6>总额：</h6><p><strong class="highlight-price">{pigcms{$order_info.order_total_money}元</strong></p>
			            </dd>
			        </dl>
			    </dd>
			</dl>
			<if condition="$order_info['order_type'] != 'recharge'">
				<h4>结算信息</h4>
				<dl class="list">
					<dd>
						<dl>
							<if condition="$cheap_info['can_cheap']">
								<dd class="kv-line-r dd-padding">
									<h6>微信优惠：</h6><p>{pigcms{$cheap_info.wx_cheap}元</p>
								</dd>
							</if>
							<dd>
								<a class="react" href="{pigcms{:U('My/select_card',($order_info['coupon_url_param'] ? $order_info['coupon_url_param'] :$_GET))}">
									<div class="more more-weak">
										<h6>商家优惠券：</h6>
										<span class="more-after"><if condition="$now_coupon">￥{pigcms{$now_coupon.price}<else/>使用商家优惠券</if></span>
									</div>
								</a>
							</dd>
							<dd class="kv-line-r dd-padding">
								<h6>商家会员卡余额：</h6><p>{pigcms{$merchant_balance}元</p>
							</dd>
							<dd class="kv-line-r dd-padding">
								<h6>帐户余额：</h6><p>{pigcms{$now_user.now_money}元</p>
							</dd>
							<if condition="$pay_money gt 0">
								<dd class="kv-line-r dd-padding">
									<h6>还需支付：</h6>
									<p>
										<strong class="highlight-price">
											<php>if($cheap_info['can_cheap']){</php>
												<span class="need-pay">{pigcms{$pay_money-$cheap_info['wx_cheap']}</span>元
											<php>}else{</php>
												<span class="need-pay">{pigcms{$pay_money}</span>元
											<php>}</php>
										</strong>
									</p>
								</dd>
							</if>
						</dl>
					</dd>
				</dl>
			</if>
			<form action="/source{pigcms{:U('Pay/go_pay',array('showwxpaytitle1'=>1))}" method="POST" id="pay-form" class="pay-form">
				<input type="hidden" name="order_id" value="{pigcms{$order_info.order_id}"/>
				<input type="hidden" name="order_type" value="{pigcms{$order_info.order_type}"/>
				<input type="hidden" name="card_id" value="{pigcms{$now_coupon.record_id}"/>
				<div id="pay-methods-panel" class="pay-methods-panel">
					<if condition="$pay_money gt 0">
						<div id="normal-fieldset" class="normal-fieldset" style="height: 100%;">
							<h4>选择支付方式</h4>
							<dl class="list">
								<volist name="pay_method" id="vo">
									<dd class="dd-padding">
										<label class="mt"><i class="bank-icon icon-{pigcms{$key}"></i><span class="pay-wrapper">{pigcms{$vo.name}<input type="radio" class="mt" value="{pigcms{$key}" <if condition="$i eq 1">checked="checked"</if> name="pay_type"></span></label>
									</dd>
								</volist>
							</dl>		
						</div>
					</if>
					<div class="wrapper buy-wrapper">
						<button type="submit" class="btn mj-submit btn-strong btn-larger btn-block" style="display:none;">确认支付</button>
					</div>
				</div>
			</form>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>var showBuyBtn = true;</script>
		<if condition="$cheap_info['can_buy'] heq false">
			<script>layer.open({title:['提示：','background-color:#FF658E;color:#fff;'],content:'您必须关注公众号后才能购买本单！<br/>长按图片识别二维码关注：<br/><img src="{pigcms{$config.site_url}/index.php?c=Recognition&a=get_tmp_qrcode&qrcode_id={pigcms{$order_info['order_id']+2000000000}" style="width:230px;height:230px;"/>',shadeClose:false});$('button.mj-submit').remove();var showBuyBtn = false;</script>
		</if>
		<script>if(showBuyBtn){$('button.mj-submit').show();}</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>