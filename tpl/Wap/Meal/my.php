<include file="Meal:header"/>
<div class="vgy_user">
	<div class="info2">
		<img class="touxiang" src="{pigcms{$static_path}images/user.png">
		<div class="infotext">
			<p class="name">普通用户</p>
			<p class="address"><a href="#">收货地址管理</a></p>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="m_order">
	<div class="mod ico_order">
		<a href="{pigcms{:U('Meal/order', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
			<p>我的订单 (<span>{pigcms{$count}</span>)</p>
			<i class="icon_gt"></i>
		</a>
	</div>
	<!-- <div class="mod ico_address">
		<a href="#">
			<p>我的资料 </p>
			<i class="icon_gt"></i>
		</a>
	</div> -->
</div>
{pigcms{$hideScript}
<include file="Meal:footer"/>