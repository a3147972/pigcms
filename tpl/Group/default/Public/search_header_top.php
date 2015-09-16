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
							<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
						</span>
						<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
					</p>
				</if>
            </li>
			<li class="mobile-info__item dropdown">
				<a class="dropdown__toggle" href="javascript:void(0);"><i class="icon-mobile F-glob F-glob-phone"></i>微信版<i class="tri tri--dropdown"></i></a>
				<div class="dropdown-menu dropdown-menu--app">
					<a class="app-block" href="javascript:void(0);">
						<span class="app-block__title">访问微信版</span>
						<span class="app-block__content" style="background:url({pigcms{$config.wechat_qrcode});background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='{pigcms{$config.wechat_qrcode}',sizingMethod='scale');"></span>
					</a>
				</div>
			</li>
		</ul>
		<ul class="site-mast__user-w">
			<li class="user-orders">
                <a href="{pigcms{:U('User/Index/index')}" rel="nofollow">我的订单</a>
            </li>
			<li class="dropdown dropdown--account">
				<a id="J-my-account-toggle" rel="nofollow" class="dropdown__toggle" href="{pigcms{:U('User/Index/index')}">
					<span>我的信息</span>
					<i class="tri tri--dropdown"></i>
					<i class="vertical-bar"></i>
				</a>
				<ul id="J-my-account-menu" class="dropdown-menu dropdown-menu--text dropdown-menu--account account-menu">
					<li><a class="dropdown-menu__item first" rel="nofollow" href="{pigcms{:U('User/Index/index')}">我的订单</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Rates/index')}">我的评价</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Collect/index')}">我的收藏</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Point/index')}">我的积分</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Credit/index')}">帐户余额</a></li>
					<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Adress/index')}">收货地址</a></li>
				</ul>
			</li>
			<li class="dropdown dropdown--history">
				<a id="J-my-history-toggle" rel="nofollow" class="dropdown__toggle" href="javascript:void(0)">
					<span>最近浏览</span>
					<i class="tri tri--dropdown"></i>
					<i class="vertical-bar"></i>
				</a>
				<div id="J-my-history-menu" class="dropdown-menu dropdown-menu--deal dropdown-menu--history"></div>
			</li>
			<li id="J-site-merchant" class="dropdown dropdown--merchant">
				<a class="dropdown__toggle dropdown__toggle--merchant" href="javascript:void(0)">
					<span>我是商家</span>
					<i class="tri tri--dropdown"></i>
					<i class="vertical-bar"></i>
				</a>
				<div class="dropdown-menu dropdown-menu--text dropdown-menu--merchant">
					<ul>
						<li><a rel="nofollow" class="dropdown-menu__item" href="{pigcms{$config.site_url}/merchant.php">商家中心</a></li>
						<li><a rel="nofollow" class="dropdown-menu__item" href="{pigcms{$config.site_url}/merchant.php">我想合作</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>
<if condition="$index_top_adver">
	<div class="yui3-widget mt-slider">
		<div class="J-hub J-banner-newtop ui-slider common-banner common-banner--newtop log-mod-viewed J-banner-stamp-active mt-slider-content">
			<ul class="common-banner__sheets mt-slider-sheet-container">
				<volist name="index_top_adver" id="vo">
					<li class="common-banner__sheet cf mt-slider-sheet mt-slider-current-sheet" style="<if condition='$i eq 1'>opacity:1;<else/>opacity:0;display:none;</if>">
						<a class="common-banner__link" target="_blank" href="{pigcms{$vo.url}">
							<img src="{pigcms{$vo.pic}" width="980" height="60" alt="{pigcms{$vo.name}"/>
						</a>
					</li>
				</volist>
			</ul>
			<a href="javascript:void(0)" class="common-close common-close--small close" title="关闭">关闭</a>
			<ul class="trigger ui-slider__triggers ui-slider__triggers--translucent ui-slider__triggers--small mt-slider-trigger-container">
				<volist name="index_top_adver" id="vo">
					<li class="trigger-item mt-slider-trigger <if condition='$i eq 1'>mt-slider-current-trigger</if>"></li>
				</volist>
			</ul>
		</div>
	</div>
</if>
<div class="site-mast__branding cf">
	<div class="site_logo" style="float:left;margin-top:25px;">
		<a href="{pigcms{$config.site_url}"><img src="{pigcms{$config.site_logo}" alt="{pigcms{$config.site_name}" title="{pigcms{$config.site_name}" style="width:190px;height:60px;"/></a>
	</div>
	<div class="component-search-box">
		<div class="J-search-box search-box ">
			<form action="{pigcms{:U('Group/Search/index')}" class="search-box__form J-search-form" name="searchForm" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
				<div class="search-box__tabs-container">
					<span class="tri"></span>
					<ul class="J-search-box__tabs search-box__tabs">
						<li class="search-box__tab J-search-box__tab--meal search-box__tab--current">{pigcms{$config.group_alias_name}</li>
						<li class="search-box__tab J-search-box__tab--group">{pigcms{$config.meal_alias_name}</li>
					</ul>
				</div>
				<input tabindex="1" type="text" name="w" autocomplete="off" class="s-text search-box__input J-search-box__input" value="{pigcms{$keywords}" placeholder="请输入商品名称、地址等"/>
				<input type="submit" class="s-submit search-box__button" hidefocus="true" value="搜&nbsp;&nbsp;索"  data-mod="sr"/>
			</form>
			<div class="J-search-box__hot search-box__hot log-mod-viewed">
				<div class="s-hot" id="J-deal-hot-query">	
					<volist name="search_hot_list" id="vo">
						<a class="hot-link <if condition='$i eq 1'>hot-link--first</if>" href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
					</volist>
				</div>
			</div>
		</div>
	</div>
	<a class="site-commitment">
		<span class="commitment-item"><i class="F-glob F-glob-commitment-retire"></i>随时退</span>
		<span class="commitment-item"><i class="F-glob F-glob-commitment-free"></i>不满意免单</span>
		<span class="commitment-item"><i class="F-glob F-glob-commitment-expire"></i>过期退</span>
	</a> 
</div>
<div class="site-mast__site-nav-w">
	<div class="site-mast__site-nav">
		<div class="site-mast__site-nav-inner">
			<div class="component-cate-nav">
				<span class="mt-cates J-nav__trigger">全部分类<i class="F-glob F-glob-caret-down"></i><i class="F-glob F-glob-caret-up"></i></span>
				<div class="cate-nav J-nav__list J-nav__list--delayed log-mod-viewed" style="display:none;">
					<volist name="all_category_list" id="vo" key="k">
						<div class="J-nav-item">
							<div class="cate-nav__item">
								<div class="nav-level1 <if condition='$k eq 1'>nav-level1--first</if>">
									<dl <if condition="$vo['cat_count'] gt 1">class="nav-level1-inner"</if>>
										<dt>
											<a class="nav-level1__label" href="{pigcms{$vo.url}" hidefocus="true" target="_blank">{pigcms{$vo.cat_name}</a>
										</dt>
										<if condition="$vo['cat_count'] gt 1">
											<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
												<dd class="nav-level1__item">
													<a class="bribe" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
												</dd>
											</volist>
										</if>
									</dl>
									<if condition="$vo['cat_count'] gt 1">
										<i class="nav-level2-indication F-glob F-glob-caret-right-small"></i>
									</if>
								</div>
								<if condition="$vo['cat_count'] gt 1">
									<div class="nav-level2 J-nav-level2" style="visibility:visible;top:0px;display:none;">
										<a class="nav-level2-label" href="{pigcms{$vo.url}" hidefocus="true" target="_blank">{pigcms{$vo.cat_name}</a>
										<div class="nav-level2-tile nav-level2-tile--first">
											<div class="nav-level2-inner">
												<volist name="vo['category_list']" id="voo" key="j">
													<a class="nav-level2__item <if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
												</volist>
											</div>
										</div>
									</div>
								</if>
							</div>
						</div>
					</volist>
				</div>
			</div>
			<nav>
				<ul class="navbar cf">
					<volist name="web_index_slider" id="vo">
						<li class="navbar__item-w"><a class="navbar__item" href="{pigcms{$vo.url}" hidefocus="true"><span class="nav-label">{pigcms{$vo.name}</span></a></li>
					</volist>
				</ul>
			</nav>
			<a target="_blank" href="#" class="nav-inner__side"></a>
		</div>
	</div>
</div>