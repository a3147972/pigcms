<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
<include file="Public:header" />
	<div class="mainbox">
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/main.css" />
		<if condition="$merchant_verify_count || $group_verify_count">
			<h2>您网站待审核的 商家有 <a style="cursor:pointer;color:red;" target="_top" href="{pigcms{:U('Index/index',array('module'=>'Merchant','action'=>'wait_merchant'))}">{pigcms{$merchant_verify_count}</a> 个，店铺有 <a style="cursor:pointer;color:red;" target="_top" href="{pigcms{:U('Index/index',array('module'=>'Merchant','action'=>'wait_store'))}">{pigcms{$merchant_verify_store_count}</a> 个，{pigcms{$config.group_alias_name}有 <a style="cursor:pointer;color:red;" target="_top" href="{pigcms{:U('Index/index',array('module'=>'Group','action'=>'wait_product'))}">{pigcms{$group_verify_count}</a> 个</h2>
		</if>
		<div id="Profile" class="list">
			<h1><b>个人信息</b><span>Profile&nbsp; Info</span></h1>
			<ul>
				<li><span>会员名:</span>{pigcms{$system_session.account}</li>
				<li><span>会员组:</span>超级管理员</li>
				<li><span>最后登陆时间:</span>{pigcms{$system_session.last_time|date='Y-m-d H:i:s',###}</li>
				<li><span>最后登陆IP/地址:</span>{pigcms{$system_session.last_ip|long2ip=###} / {pigcms{$system_session.last.country} {pigcms{$system_session.last.area}</li>
				<li><span>登陆次数:</span>{pigcms{$system_session.login_count}</li>
			</ul>
		</div>
		<if condition="$system_session['level'] eq 2">
		<div id="sitestats">
			<h1><b>网站统计</b><span>Site &nbsp; Stats</span></h1>
			<div>
				<ul>
					<li style="background:#457CB5;line-height:44px;color:white;font-weight:bold;">网站</li>
					<li><b>用户总数</b><br><span>{pigcms{$website_user_count}</span></li>
					<li><b>商户总数</b><br><span>{pigcms{$website_merchant_count}</span></li>
					<li><b>店铺总数</b><br><span>{pigcms{$website_merchant_store_count}</span></li>
					<li><b></b><span></span></li>
					<li><b></b><span></span></li>
					<li style="background:#3A6EA5;line-height:44px;color:white;font-weight:bold;">{pigcms{$config.group_alias_name}</li>
					<li><b>{pigcms{$config.group_alias_name}总数</b><br><span>{pigcms{$group_group_count}</span></li>
					<li><b>今日订单</b><span>{pigcms{$group_today_order_count}</span></li>
					<li><b>本周订单</b><span>{pigcms{$group_week_order_count}</span></li>
					<li><b>本月订单</b><span>{pigcms{$group_month_order_count}</span></li>
					<li><b>今年订单</b><span>{pigcms{$group_year_order_count}</span></li>
					<li style="background:#FF658E;line-height:44px;color:white;font-weight:bold;">{pigcms{$config.meal_alias_name}</li>
					<li><b>店铺总数</b><span>{pigcms{$meal_store_count}</span></li>
					<li><b>今日订单</b><span>{pigcms{$meal_today_order_count}</span></li>
					<li><b>本周订单</b><span>{pigcms{$meal_week_order_count}</span></li>
					<li><b>本月订单</b><span>{pigcms{$meal_month_order_count}</span></li>
					<li><b>今年订单</b><span>{pigcms{$meal_year_order_count}</span></li>
				</ul>
			</div>
		</div> 
		</if>
		<div id="system"  class="list">
			<h1><b>系统信息</b><span>System&nbsp; Info</span></h1>
			<ul>
				<volist name="server_info" id="vo">
					<li><span>{pigcms{$key}:</span>{pigcms{$vo}</li>
				</volist>
			</ul>
		</div>
		<if condition="$system_session['level'] eq 2">
		<div id="system"  class="list">
			<h1><b>官方动态</b><span>Soft &nbsp; Update </span></h1>
			<ul>
			<li><a target="_blank" href="http://weiwincms.taobao.com" class="STYLE1 STYLE1">微赢网络官方地址</a></li>
				<li style=" color:#FF0000"">微赢生活通o2o正式上线  当前版本V1.3</li>
				<li style=" color:#3A6EA5"">微赢视频教程即将上线 敬请期待</li>
				<li style=" color:#3A6EA5"">微赢官方邮箱 76020694@qq.com(BUG提交处)</li>
				
			</ul>
		</div>
		</if>
	</div>
	<div id="verify_merchant_list" style="display:none;">
		<table>
			<volist name="merchant_verify_list" id="vo">
				<tr>
					<td><a href="{pigcms{:U('Index/index',array('module'=>'Merchant','action'=>'index','url'=>urlencode(U('Merchant/index',array('keyword'=>$vo['mer_id'],'searchtype'=>'mer_id')))))}" target="_blank">{pigcms{$vo.name}</a></td>
				</tr>
			</volist>
		</table>
	</div>
	<div id="verify_merchant_store_list" style="display:none;">
		<table>
			<volist name="merchant_verify_store_list" id="vo">
				<tr>
					<td><a href="{pigcms{:U('Index/index',array('module'=>'Merchant','action'=>'index','url'=>urlencode(U('Merchant/store',array('mer_id'=>$vo['mer_id'])))))}" target="_blank">{pigcms{$vo.name}</a></td>
				</tr>
			</volist>
		</table>
	</div>
	<div id="verify_group_list" style="display:none;">
		<table>
			<volist name="group_verify_list" id="vo">
				<tr>
					<td><a href="{pigcms{:U('Index/index',array('module'=>'Group','action'=>'product','url'=>urlencode(U('Group/product',array('keyword'=>$vo['group_id'],'searchtype'=>'group_id')))))}" target="_blank">{pigcms{$vo.s_name}</a></td>
				</tr>
			</volist>
		</table>
	</div>
	<if condition="$system_session['level'] eq 2">
	<script type="text/javascript" src="http://www7.aliapp.com/xiaozhu/softupdate.php?soft_version={pigcms{$config.system_version}&domain={pigcms{$_SERVER.SERVER_NAME}"></script>
	</if>
<include file="Public:footer"/>