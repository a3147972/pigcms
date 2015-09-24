<div class="site-mast__user-nav-w">
	<div class="site-mast__user-nav cf">
		<ul class="basic-info">
			<li class="user-info cf">
				<if condition="empty($user_session)">
					<a rel="nofollow" class="user-info__login" href="{pigcms{:U('Index/Login/index')}">登录</a>
					<a rel="nofollow" class="user-info__signup" href="{pigcms{:U('Index/Login/reg')}">注册</a>
				<else/>
					<p class="user-info__name growth-info growth-info--nav">
						<span>
							<a rel="nofollow" href="{pigcms{$siteUrl}/classify/userindex.html" class="username">{pigcms{$user_session.nickname}</a>
						</span>
						<a class="user-info__logout" href="{pigcms{$siteUrl}/classify/userlogout.html">退出</a>
					</p>
				</if>
            </li>
			<li id="dropdown_wx_toggle" class="mobile-info__item dropdown dropdown--open-app">
				<a class="dropdown__toggle" href="javascript:void(0);"><i class="icon-mobile F-glob F-glob-phone"></i>微信版<i class="tri tri--dropdown"></i></a>
				<div class="dropdown-menu dropdown-menu--app">
					<a class="app-block" href="/topic/weixin.html">
						<span class="app-block__title">访问微信版</span>
						<span class="app-block__content" style="background:url({pigcms{$config.wechat_qrcode});background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{pigcms{$config.wechat_qrcode}',sizingMethod='scale');"></span>
					</a>
				</div>
			</li>
		</ul>
		<ul class="site-mast__user-w">
			<li class="user-orders">
                <a href="{pigcms{$siteUrl}/classify/selectsub.html" rel="nofollow">免费发布信息</a>
            </li>
			<li class="dropdown dropdown--account">
				<a id="J-my-account-toggle" rel="nofollow" class="dropdown__toggle" href="{pigcms{$siteUrl}/classify/mycenter.html">
					<span>个人中心</span>
				</a>
			</li>

			<li id="J-site-merchant" class="dropdown dropdown--merchant">
				<a class="dropdown__toggle dropdown__toggle--merchant" href="/">
					<span>网站首页</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
 $('#dropdown_wx_toggle').hover(function(e){
    $(this).addClass('dropdown--open');
 },function(e){
    $(this).removeClass('dropdown--open');
 });
</script>