<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>商家中心</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script> 
    <style>
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
		.infoview{background-color: #fff;padding:0.3rem 0;height: 1.1rem;}
		.infoview li{float: left;width: 24%;}
		.infoview .li{border-left: 2px solid #e5e5e5;height: 100%;}
		.infoview li p{text-align:center;line-height: 30px;font-size: 16px}
	</style>
</head>
<body>
	<ul class="infoview">
			<li>
					<p class="p1">{pigcms{$fans_count}</p>
					<p class="p2">粉丝</p>
			</li>
			<li class="li">
					<p class="p1">{pigcms{$card_count}</p>
					<p class="p2">会员卡</p>
			</li>
			<li class="li">
					<p class="p1">{pigcms{$lottery_count}</p>
					<p class="p2">微活动</p>
			</li>
			<li class="li">
					<p class="p1">{pigcms{$store_count}</p>
					<p class="p2">店铺数</p>
			</li>
		</ul>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('Commerce/merchantewm')}">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#0092DE;">码</i>商家二维码<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('Commerce/mClerk')}">
				<div class="more more-weak">
					<i class="text-icon order-fav order-icon" style="background-color:#F5716E;">员</i>店员管理<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('Commerce/statistical')}">
				<div class="more more-weak">
					<i class="text-icon order-fav order-icon" style="background-color:green;">计</i>统计<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('Commerce/meal')}">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#f60">订</i>{pigcms{$config.meal_alias_name}管理<span class="more-after"></span>
				</div>
			</a>
	    </dd>
		<dd>
			<a class="react" href="{pigcms{:U('Commerce/group')}">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#f60">团</i>{pigcms{$config.group_alias_name}列表<span class="more-after"></span>
				</div>
			</a>
	</dd>
	</dl>
		<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('Index/index',array('token'=>$mer_id))}">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#FF658E">站</i>微网站<span class="more-after"></span>
				</div>
			</a>
	    </dd>

	</dl>

	<dl class="list">
	 <dd>
			<a class="react" href="javascript:;" onclick="LogOutSys()">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon" style="background-color:#EB2C00">O</i>退出<span class="more-after"></span>
				</div>
			</a>
	    </dd>
	</dl>
	<script type="text/javascript">
		var logoutURl="{pigcms{:U('Commerce/logout')}"
		function LogOutSys(){
			if(confirm('您确认要退出系统吗？')){
			    window.location.href=logoutURl;
			}
		}
		</script>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
</html>