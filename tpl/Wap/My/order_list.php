<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>订单列表</title>
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
	        font-size: .6rem;
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
	    
	    
	    
	    .table {
		    width: 100%;
			border-bottom: 2px solid #d8d8d8;
		}
		.table li {
			width: 50%;
			float: left;
			text-align: center;
			height: 50px;
			line-height: 50px;
			font-size: 14px;
		}
		.table li a {
			color: #888888;
			display: block;
		}

		.table .specia a {
			color: #32acdd;
			border-bottom: 2px solid #32acdd;
		}
		dl.list {
			border-bottom: 1px solid #ddd8ce;
			margin-top: -1px;
			background-color: #fff;
		}
	</style>
</head>
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('My/index')}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">订单列表</h1>
            <div class="nav-wrap-right">
                <a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
                    <span class="nav-btn">
                        <i class="text-icon">≋</i>导航
                    </span>
                </a>
            </div>
            <div id="nav-dropdown" class="nav-dropdown">
                <ul>
                    <li><a class="react" href="{pigcms{:U('Home/index')}"><i class="text-icon">⟰</i>
                        <space></space>首页</a>
                    </li>
                    <li><a class="react" href="{pigcms{:U('My/index')}"><i class="text-icon">⍥</i>
                        <space></space>我的</a>
                    </li>
                    <li><a class="react" href="{pigcms{:U('Search/index',array('type'=>'meal'))}"><i class="text-icon">⌕</i>
                        <space></space>搜索</a>
                	</li>
                </ul>
            </div>
        </header>
        <div id="tips" class="tips"></div>
        <dl class="list">
		    <dd class="table">
				<ul >
					<li class="<if condition="intval($type) eq 1">specia</if>">
					<a href="{pigcms{:U('My/order_list', array('type' => 1))}" >{pigcms{$config.group_alias_name}订单</a>
					</li>
					<li class="<if condition="intval($type) eq 2">specia</if>">
					<a href="{pigcms{:U('My/order_list', array('type' => 2))}">餐饮订单</a>
					</li>
				</ul>
			</dd>
		</dl>
		<if condition="$order_list">
			<if condition="$type eq 1">
			    <div style="margin-top:.2rem;">
				    <dl class="list" id="orders">
				    	<dd>
				    		<dl>
				    			<volist name="order_list" id="vo">
									<dd class="dealcard dd-padding" onclick="window.location.href = '{pigcms{$vo.order_url}';">
							            <div class="dealcard-img imgbox">
							            	<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;"/>
							            </div>
					                    <div class="dealcard-block-right">
					                        <div class="dealcard-brand single-line">{pigcms{$vo.s_name}</div>
					                        <small>总价：{pigcms{$vo.total_money} 元&nbsp;&nbsp;数量：{pigcms{$vo.num}</small>
					                        <weak>
					                        	<if condition="empty($vo['paid'])">
					                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('type'=>'group','order_id'=>$vo['order_id']))}">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/group_order_del',array('order_id'=>$vo['order_id']))}');">删除订单</a>
					                        	<elseif condition="$vo['pay_type'] eq 'offline' AND empty($vo['third_id'])"/>
			                        				<a class="btn btn-weak color-gray">线下未付款</a>　
			                        				<!--a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/group_order_refund',array('order_id'=>$vo['order_id']))}');">取消订单</a-->
					                        	<elseif condition="empty($vo['status'])"/>
					                        		<a class="btn btn-weak color-gray">未消费</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/group_order_refund',array('order_id'=>$vo['order_id']))}');">取消订单</a>
					                        	<elseif condition="$vo['status'] eq '1'"/>
					                        		<a class="btn btn-weak" href="{pigcms{:U('My/group_feedback',array('order_id'=>$vo['order_id']))}">去评价</a>
												<elseif condition="$vo['status'] eq '2'"/>
					                        		<a class="btn btn-weak" href="{pigcms{:U('My/group_feedback',array('order_id'=>$vo['order_id']))}">已完成</a>
					                        	</if>
					                        </weak>
					                    </div>
					                </dd>
						        </volist>
						    </dl>
				    	</dd>
				    </dl>
				</div>
			<else />
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
					                        <small>总&nbsp;&nbsp;&nbsp;&nbsp;价：{pigcms{$order['price']} 元&nbsp;&nbsp;数量：{pigcms{$order['total']}</small>　<small style="color: green"><if condition="$order['meal_type']">外卖<else />{pigcms{$config.meal_alias_name}</if></small>
					                        <weak>
					                        	<if condition="empty($order['paid'])">
					                        		<if condition="$order['meal_type'] eq 1">
					                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'takeout'))}">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Takeout/orderdel',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">删除订单</a>
					                        		<else />
					                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'food'))}">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Food/orderdel',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">删除订单</a>
					                        		</if>
					                        		
					                        	<elseif condition="$order['pay_type'] eq 'offline' AND empty($order['third_id'])"/>
					                        		<a class="btn btn-weak color-gray">线下未付</a>
					                        	<elseif condition="$order['status'] eq '1'"/>
					                        		<a class="btn btn-weak" href="{pigcms{:U('My/meal_feedback',array('order_id'=>$order['order_id']))}">去评价</a>
					                        	<elseif condition="$order['paid'] eq 2"/>
					                        		<a class="btn btn-weak color-strong" href="{pigcms{:U('Pay/check',array('order_id' => $order['order_id'], 'type'=>'food'))}">付款</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/meal_order_refund',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">取消订单</a>
					                        	<elseif condition="$order['paid'] eq 1 AND $order['status'] eq 0"/>
					                        		<a class="btn btn-weak color-gray">未消费</a>　
					                        		<a class="btn btn-weak color-gray" href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/meal_order_refund',array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');">取消订单</a>
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
		<else />
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