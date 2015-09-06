<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>会员中心</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    .my-account {
	        color: #333;
	        position: relative;
	        background: -webkit-linear-gradient(top,#e1dace,#dfc8b4);
	        border-bottom: 1px solid #C0BBB2;
	        display: block;
	        height: 1.6rem;
	        position: relative;
	        padding-right: .2rem;
	    }
	    .my-account>img {
	        height: 100%;
	        position: absolute;
	        right: 0;
	        top:0;
	        z-index: 0;
	    }
	    .my-account .user-info {
	        z-index: 1;
	        position: relative;
	        height: 100%;
	        padding: .28rem .2rem;
	        margin-right: .2rem;
	        box-sizing: border-box;
	        padding-left: 1.7rem;
	        font-size: .24rem;
	        color: #666;
	    }
	    .my-account .uname {
	        font-size: .3rem;
	        color: #333;
	        margin-top: .0rem;
	        margin-bottom: .12rem;
	    }
		.my-account .umoney {
	       margin-bottom: 0.06rem;
	    }
	    .my-account strong {
	        color: #FF9712;
	        font-weight: normal;
	    }
	    .my-account .avater {
	        position: absolute;
	        top: .2rem;
	        left: .3rem;
	        width: 1.2rem;
	        height: 1.2rem;
	        border-radius: 50%;
	    }
	    .my-account .more.more-weak:after {
	        border-color: #666;
	        -webkit-transform: translateY(-50%) scaleY(1.2) rotateZ(-135deg);
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
	    .level-icon{
	        vertical-align: middle;
	        margin-left: .2rem;
	    }
	</style>
</head>
<body>
	<div id="tips" class="tips"></div>
	<div>
		<a class="my-account" href="{pigcms{:U('My/myinfo')}">
			<img src="{pigcms{$static_path}images/my-photo.png">
			<img class="avater" src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像"/>
			<div class="user-info more more-weak">
				<p class="uname">{pigcms{$now_user.nickname}<i class="level-icon level0"></i></p>
				<p class="umoney">余额：<strong>{pigcms{$now_user.now_money}</strong> 元 &nbsp;&nbsp;&nbsp<span>积分：<strong>{pigcms{$now_user.score_count}</strong> 分</span></p>
				<p>等级：<php>if(isset($levelarr[$now_user['level']])){ 
						  $imgstr='';
						  if(!empty($levelarr[$now_user['level']]['icon'])) $imgstr='<img src="'.$config['site_url'].$levelarr[$now_user['level']]['icon'].'" width="15" height="15">';
						  echo ' <strong>'.$levelarr[$now_user['level']]['lname'].'</strong>';
						  }else{echo '<strong>暂无等级</strong>';}</php></p>
			</div>
		</a>
	</div>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('My/group_order_list')}">
				<div class="more more-weak">
					<i class="text-icon order-zuo order-icon">团</i>{pigcms{$config.group_alias_name}订单<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/meal_order_list')}">
				<div class="more more-weak">
					<i class="text-icon order-jiudian order-icon" style="background-color:#0092DE;">订</i>{pigcms{$config.meal_alias_name}订单<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/lifeservice')}">
				<div class="more more-weak">
					<i class="text-icon order-jiudian order-icon" style="background-color:#EA0DDF;">费</i>生活缴费订单<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('My/group_collect')}">
				<div class="more more-weak">
					<i class="text-icon order-fav order-icon" style="background-color:#F5716E;">☆</i>我的收藏<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/follow_merchant')}">
				<div class="more more-weak">
					<i class="text-icon order-fav order-icon" style="background-color:#F5716E;">商</i>我关注的商家<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/join_lottery')}">
				<div class="more more-weak">
					<i class="text-icon order-jiudian order-icon" style="background-color:#EA0DDF;">活</i>我参与的活动<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('My/card_list')}">
				<div class="more more-weak">
					<i class="text-icon order-card order-icon">□</i>我的优惠券<span class="more-after"></span>
				</div>
			</a>
		</dd>
		<dd>
			<a class="react" href="{pigcms{:U('My/cards')}">
				<div class="more more-weak">
					<i class="text-icon order-jiudian order-icon" style="background-color:#EAAD0D;">卡</i>我的会员卡<span class="more-after"></span>
				</div>
			</a>
		</dd>
	</dl>
	<if condition="isset($config['wap_home_show_classify'])">
		<dl class="list">
			<dd>
				<a class="react" href="{pigcms{:U('Classify/myCenter')}">
					<div class="more more-weak">
						<i class="text-icon order-card order-icon">□</i>我的发布<span class="more-after"></span>
					</div>
				</a>
			</dd>
		</dl>
	</if>
	<dl class="list">
		<dd>
			<a class="react" href="{pigcms{:U('Login/logout')}">
				<div class="more-weak" style="color:#FF658E;">
					<if condition="$is_wexin_browser">重新登录<else/>退出登录</if>
				</div>
			</a>
		</dd>
	</dl>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common_wap.js"></script>
	<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>