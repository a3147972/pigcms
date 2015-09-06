<include file="Food:header" />
<body onselectstart="return true;" ondragstart="return false;">
<div data-role="container" class="container orderDetails processing pay_over">
	<header data-role="header">	
		<div class="title">我的订单
	        <div class="editbtndiv" id="processing">
        	<if condition="$order['cancel'] eq 1">
				<span onclick="javascript:drop_confirm('你确定要退款吗？', '{pigcms{:U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');" class="cancel">退款</span>
			</if>
			<if condition="$order['cancel'] eq 2">
				<span onclick="javascript:drop_confirm('你确定要删除订单吗？', '{pigcms{:U('Food/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');" class="cancel">删除</span>
			</if>
			<if condition="$order['jiaxcai']">
				<span onclick="location.href='{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $order['order_id']))}'" class="edit">编辑</span>
			</if>
			</div>
		</div>
		<ul class="orderlist">
			<li>
				<a href="{pigcms{:U('Food/shop', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
					<div class="info">
					   	<span class="sawtooth {pigcms{$order['css']}">{pigcms{$order['show_status']}</span>
						<label>
							<span class="name">{pigcms{$store['name']}</span>
							<span class="time">{pigcms{$order['otimestr']}</span>
						</label>
					</div>
					<div><span class="right_adron"></span></div>
				</a>
			</li>
		</ul>
		<ul class="pay" style="padding-right: 20px;">
			<li>流水号<label>{pigcms{$order['order_id']}</label></li>
			<li>订单号<label>{pigcms{$order['orderid']}</label></li>
			<li>餐桌情况<label>{pigcms{$order['tablename']}</label></li>
			<li>人数<label>{pigcms{$order['num']}人</label></li>
			<li>姓名<label>{pigcms{$order['name']} <if condition="$order['sex'] eq 2">女士<else/>先生</if></label></li>
			<li>联系电话<label>{pigcms{$order['phone']}</label></li>
			<li>预约时间<label>{pigcms{$order['arrive_time'] | date="Y-m-d H:i",###}</label></li>
			<if condition="$order['paid'] eq 1">
			<li>消费二维码<label><a id="see_storestaff_qrcode" style="color:#FF658E;">查看二维码</a></label></li>
			</if>
		</ul>	
		<!--div class="paybtn">
			<if condition="$order['topay']">
			<a href="{pigcms{:U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'food'))}" class="btn orange bigfont left">去付款</a>
			</if>
			<if condition="$order['jiaxcai']">
			<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $order['order_id']))}" class="btn orange bigfont right">去加菜</a>
			</if>
			<if condition="$order['cancel'] eq 1">
			<a href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('My/meal_order_refund', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');" class="btn orange bigfont right">取消订单</a>
			</if>
			<if condition="$order['cancel'] eq 2">
			<a href="javascript:drop_confirm('你确定要取消订单吗？', '{pigcms{:U('Food/orderdel', array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'orderid' => $order['order_id']))}');" class="btn orange bigfont right">删除订单</a>
			</if>
		</div-->
	</header>
	<section data-role="body" class="section_scroll_content">
		<div class="menulist ">
			<div>我的菜单</div>
			<label></label>		
			<span>
				<span></span>
				<if condition="!empty($meallist) AND is_array($meallist)">
				<div class="list">
					<ul>
					<volist name="meallist" id="dishs">
						<li>
							<span class="col1">{pigcms{$dishs['name']}<if condition="isset($dishs['isadd']) AND $dishs['isadd']"><sup><i style="color:green;margin-left:5px;"><strong>加菜</strong></i></sup></if></span>
							<span class="col2">×{pigcms{$dishs['num']}</span>
							<span class="col3">￥{pigcms{$dishs['price']}</span>
							<if condition="isset($dishs['omark']) && !empty($dishs['omark'])">
							<div style="line-height: 18px;float: left;"><span style="color:#ef7f2c">备注：</span><span>{pigcms{$dishs['omark']|htmlspecialchars_decode=ENT_QUOTES}</span></div>
							</if>
						</li>
					  </volist>
					<if condition="isset($order['note']) && !empty($order['note'])">
					<li>
						<span style="color:#ef7f2c">购物车备注：</span><span style="line-height: 18px;float:none;">{pigcms{$order['note']|htmlspecialchars_decode=ENT_QUOTES}</span></span>
					</li>
					</if>
					</ul>
				<else/>
				  <div class="tips" style="display:block;">亲，您还没有点菜喔！</div>
				  	<div class="list">
					<ul>
					</ul>
				</if>
					<div>
						<span class="col1">合计</span>
						<span class="col2">&nbsp;&nbsp;{pigcms{$order['total']}</span>
						<span class="col3">￥<if condition="$order['total_price'] gt 0">{pigcms{$order['total_price']}<else />{pigcms{$order['price']}</if></span>
						<if condition="$order['minus_price'] gt 0">
						<span class="col1">优惠</span>
						<span class="col2">-￥{pigcms{$order['minus_price']}</span>
						<span class="col3">=￥{pigcms{$order['total_price'] - $order['minus_price']}</span>
						</if>
						<if condition="!empty($order['leveloff'])">
						<span class="col1">会员等级</span>
						<span class="col2">{pigcms{$order['leveloff']['lname']}</span>
						<span class="col3" style="text-align: center;">{pigcms{$order['leveloff']['offstr']}</span>
						</if>
						<if condition="$order['paid'] eq 2">
						<span class="col1">备注</span>
						<span class="col2">已支付 {pigcms{$order['pay_money']}</span>
						<span class="col3">未支付 <php>echo ($order['price']-$order['pay_money']);</php></span>
						</if>
						<span class="col1">支付方式</span>
						<span class="col2">{pigcms{$order['paytypestr']}</span>
						<span class="col3 no_fontcolor">{pigcms{$order['paidstr']}</span>
						<if condition="$order['status'] gt 0 && $order['status'] lt 3 && !empty($order['last_staff'])">
						 <span class="col2"><if condition="$order['tuan_type'] neq 2">消费<else/>发货</if>时间</span>
						 <span class="col1" style="color: #ef7f2c;">{pigcms{$order['use_time']|date='Y-m-d H:i:s',###}</span>
						 
						 <span class="col2">操作店员</span>
						 <span class="col1"  style="color: #ef7f2c;">{pigcms{$order['last_staff']}</span>
						</if>
				   		<if condition="$order['status'] eq 3">
						<span class="col2">订单操作</span>
						<span class="col3">已取消并退款</span>
						</if>
					</div>
				</div>
				<label class="line"><span></span></label>
			</span>	 
		</div>
	</section>
	<if condition="$order['topay']">
		<footer data-role="footer">
			<div class="btndiv_fixed">
				<a href="{pigcms{:U('Pay/check', array('order_id' => $order['order_id'], 'type'=>'food'))}" class="btn orange bigfont">去付款</a>
			</div>	
		</footer>
	<elseif condition="$order['status'] eq 1" />
		<footer data-role="footer">
			<div class="btndiv_fixed">
				<a href="{pigcms{:U('My/meal_feedback',array('order_id' => $order['order_id']))}" class="btn orange bigfont">去评价</a>
			</div>	
		</footer>
	</if>
</div>
<include file="kefu" />
<script src="{pigcms{$static_public}js/jquery.qrcode.min.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<script type="text/javascript">
	$(function(){
		$('#see_storestaff_qrcode').click(function(){
			var qrcode_width = $(window).width()*0.6 > 256 ? 256 : $(window).width()*0.6;
			layer.open({
				title:['消费二维码','background-color:#8DCE16;color:#fff;'],
				content:'生成的二维码仅限提供给商家店铺员工扫描验证消费使用！<br/><br/><div id="qrcode"></div>',
				success:function(){
					$('#qrcode').qrcode({
						width:qrcode_width,
						height:qrcode_width,
						text:"{pigcms{$config.site_url}/wap.php?c=Storestaff&a=meal_qrcode&id={pigcms{$order.order_id}"
					});
				}
			});
			$('.layermbox0 .layermchild').css({width:qrcode_width+30+'px','max-width':qrcode_width+30+'px'});
		});
	});
	function drop_confirm(msg, url) {
		if (confirm(msg)) {
			window.location.href = url;
		}
	}
</script>
{pigcms{$hideScript}
</body>
</html>