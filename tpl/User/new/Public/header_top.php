<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<if condition="empty($user_session)">
				<div class="login"><a href="{pigcms{:U('Index/Login/index')}"> 登陆 </a></div>
				<div class="regist"><a href="{pigcms{:U('Index/Login/reg')}">注册 </a></div>
			<else/>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
					</span>
					<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
				</p>
			</if>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="{pigcms{$config.site_url}/topic/weixin.html"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="{pigcms{$config.site_url}/topic/weixin.html">访问微信版</a></p><img src="{pigcms{$config.wechat_qrcode}"/></div>
			</div>
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="{pigcms{:U('User/Index/index')}">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="{pigcms{:U('User/Index/index')}">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Index/index')}">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Rates/index')}">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Collect/index')}">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Point/index')}">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Credit/index')}">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Adress/index')}">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf">
    <div class="nav cf">
		<div class="logo">
			<a href="{pigcms{$config.site_url}" title="{pigcms{$config.site_name}">
				<img src="{pigcms{$config.site_logo}" />
			</a>
		</div>
		<div class="search">
			<form action="{pigcms{:U('Meal/Search/index')}" method="post">
				<div class="form_sec">
					<div class="form_sec_txt">{pigcms{$config.group_alias_name}</div>
					<div class="form_sec_txt1">{pigcms{$config.meal_alias_name}</div>
				</div>
				<input name="w" class="input" type="text" value="{pigcms{$keywords}" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick" type="submit"><img src="{pigcms{$static_path}images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<volist name="search_hot_list" id="vo">
					<a href="{pigcms{$vo.url}"><span>{pigcms{$vo.name}</span></a>
				</volist>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
</header>