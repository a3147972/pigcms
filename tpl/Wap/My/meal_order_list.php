<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$config.meal_alias_name}订单列表</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    dl.list dd.dealcard {
	        overflow: visible;
	        -webkit-transition: -webkit-transform .2s;
	        position: relative;
	    }
	    .dealcard.orders-del {
	        -webkit-transform: translateX(1.05rem);
	    }
	    .dealcard-block-right {
	        height: 1.68rem;
	        position: relative;
	    }
	    .dealcard .dealcard-brand {
	        margin-bottom: .18rem;
	    }
	    .dealcard small {
	        font-size: .24rem;
	        color: #666;
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
	    .orderindex li {
	        display: inline-block;
	        width: 25%;
	        text-align:center;
	        position: relative;
	    }
	    .orderindex li .react {
	        padding: .28rem 0;
	    }
	    .orderindex .text-icon {
	        display: block;
	        font-size: .4rem;
	        margin-bottom: .18rem;
	    }
	    .orderindex .amount-icon {
	        position: absolute;
	        left: 50%;
	        top: .16rem;
	        color: white;
	        background: #EC5330;
	        border-radius: 50%;
	        padding: .08rem .06rem;
	        min-width: .28rem;
	        font-size: .24rem;
	        margin-left: .1rem;
	        display: none;
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
	    .orderindex li .react.hover{
	    	color:#FF658E;
	    }
	</style>
</head>
<body id="index">
        <div id="tips" class="tips"></div>
        <dl class="list" style="margin-top:0rem;">
		    <dd>
				<ul class="orderindex">
					<li><a href="{pigcms{:U('My/meal_order_list')}" class="react <if condition="empty($_GET['status'])">hover</if>">
						<i class="text-icon">⌺</i>
						<span>全部</span>
					</a>
					</li><li><a href="{pigcms{:U('My/meal_order_list',array('status'=>-1))}" class="react <if condition="$_GET['status'] == '-1'">hover</if>">
						<i class="text-icon">⌸</i>
						<span>待付款</span>
					</a>
					</li><li><a href="{pigcms{:U('My/meal_order_list',array('status'=>1))}" class="react <if condition="$_GET['status'] == '1'">hover</if>">
						<i class="text-icon">⌻</i>
						<span>未消费</span>
					</a>
					</li><li><a href="{pigcms{:U('My/meal_order_list',array('status'=>2))}" class="react <if condition="$_GET['status'] == '2'">hover</if>">
						<i class="text-icon">⌹</i>
						<span>待评价</span>
					</a>
					</li>
				</ul>
			</dd>
		</dl>
		<if condition="$order_list">
	    <div style="margin-top:.2rem;">
		    <dl class="list" id="orders">
		    	<dd>
		    		<dl>
		    			<volist name="order_list" id="order">
		    				<if condition="$order['meal_type']">
							<dd class="dealcard dd-padding" onclick="window.location.href = '{pigcms{:U('Takeout/order_detail', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'order_id' => $order['order_id']))}';">
					        <else />
					        <dd class="dealcard dd-padding" onclick="window.location.href = '{pigcms{:U('Food/order_detail', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'order_id' => $order['order_id']))}';">
					        </if>
					            <div class="dealcard-img imgbox">
					            	<img src="{pigcms{$order.image}" style="width:100%;height:100%;"/>
					            </div>
			                    <div class="dealcard-block-right">
			                        <div class="dealcard-brand single-line">{pigcms{$order['name']}</div>
			                        <small>订单号：{pigcms{$order['order_id']}</small>
			                        <br/>
			                        <small>总&nbsp;&nbsp;&nbsp;&nbsp;价：<if condition="$order['total_price'] gt 0">{pigcms{$order['total_price'] - $order['minus_price']}<else />{pigcms{$order['price']}</if> 元&nbsp;&nbsp;数量：{pigcms{$order['total']}</small>　<small style="color: green"><if condition="$order['meal_type']">外卖<else />{pigcms{$config.meal_alias_name}</if></small>
			                        <weak>
									<if condition="$order['status'] eq 3">
			                        		<a class="btn btn-weak color-gray">已取消并退款</a>
			                        	<elseif condition="empty($order['paid'])" />
			                        		<if condition="$order['meal_type'] eq 1">
			                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'takeout'))}">付款</a>
			                        		<else />
			                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'food'))}">付款</a>
			                        		</if>
			                        		
			                        	<elseif condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])"/>
			                        		<a class="btn btn-weak color-gray">线下未付</a>
			                        	<elseif condition="$order['paid'] eq 2"/>
			                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'food'))}">付款</a>
			                        	<elseif condition="$order['paid'] eq 1 AND empty($order['status'])"/>
			                        		<a class="btn btn-weak color-gray">未消费</a>
			                        	<elseif condition="$order['status'] eq '1'"/>
			                        		<a class="btn btn-weak" href="{pigcms{:U('My/meal_feedback',array('order_id'=>$order['order_id']))}">去评价</a>
			                        	<elseif condition="$order['paid'] eq 1 AND $order['status'] gt 0"/>
			                        		<a class="btn btn-weak color-gray">已消费</a>
			                        	</if>
			                        </weak>
			                    </div>
			                </dd>
				        </volist>
				    </dl>
		    	</dd>
		    </dl>
		</div>
		</if>
<script type="text/javascript">
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>

<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>