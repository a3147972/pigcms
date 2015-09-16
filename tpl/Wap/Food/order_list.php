<include file="Food:header" />
<script type="text/javascript" src="{pigcms{$static_path}meal/js/nav.js"></script>
<link href="{pigcms{$static_path}meal/css/nav.css" rel="stylesheet">
<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container orderList">
		<section data-role="body">
		<div>我的订单</div>
		<ul class="orderlist">
		   <if condition="!empty($orderList)">
		   <volist name="orderList" id="order">
			<li>
				<a href="{pigcms{:U('Food/order_detail', array('mer_id' => $mer_id, 'store_id' => $store_id, 'order_id' => $order['order_id']))}" class="info">
					<span class="sawtooth {pigcms{$order['css']}">{pigcms{$order['show_status']}</span>
					<label>
						<span class="name">{pigcms{$order['s_name']}</span>
						<span class="time">{pigcms{$order['otimestr']}</span>
					</label>
				</a>
				<if condition="$order['topay']">
				<a href="{pigcms{:U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'food'))}" class="btn" style="margin-right: 15px;  border-radius: 5px;">去付款</a>
				<else />
				<a><span class="icon_right"><span class="right_adron"></span></span></a>
				</if>
				<!---<if condition="isset($order['jiaxcai']) AND $order['jiaxcai']">
				  <a href="{pigcms{:U('Repast/dishMenu', array('token'=>$token, 'cid'=>$order['cid'],'orid'=>$order['oid'], 'wecha_id'=>$wecha_id))}" class="btn" style="margin-right: 100px;">去加菜</a>
				</if>-->
			</li>
			</volist>
			</if>
			</ul>
		</section>
		<footer data-role="footer">
			<nav class="nav">
				<ul class="box">
					<li>
						<a href="{pigcms{:U('Index/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
							<span class="home">&nbsp;</span>
							<label>首页</label>				
						</a>
					</li>
					<li>
						<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
							<span class="order">&nbsp;</span>
							<label>在线点餐</label>				
						</a>
					</li>
					<li>
						<a href="{pigcms{:U('Food/sureorder', array('mer_id' => $mer_id, 'store_id' => $store_id, 'deposit' => 0))}">
							<span class="book">&nbsp;</span>
							<label>在线订位</label>				
						</a>
					</li>
					<li class="on">
						<a href="{pigcms{:U('Food/order_list', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
							<span class="my">&nbsp;</span>
							<label>我的订单</label>
						</a>
					</li>
				</ul>
			</nav>
		</footer>
</div>
<include file="kefu" />
{pigcms{$hideScript}
</body>
</html>