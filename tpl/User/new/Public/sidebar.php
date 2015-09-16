<div class="component-order-nav mt-component--booted">
	<div class="side-nav J-order-nav">
		<div class="J-side-nav__user side-nav__user cf">
			<a href="javascript:void(0);" title="帐户设置" class="J-user item user">
				<img src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/user-default-avatar.png</if>" width="30" height="30" alt="{pigcms{$now_user.nickname}头像"/>
			</a>
			<div class="item info_nickname">
				<div class="info__name" style="height:36px;line-height:36px;">{pigcms{$now_user.nickname}</div>
			</div>
			<div>等级：<a href="{pigcms{:U('Level/index')}">
				<php>if(isset($levelarr[$now_user['level']])){
				$imgstr='';
				if(!empty($levelarr[$now_user['level']]['icon'])) $imgstr='<img src="'.$config['site_url'].$levelarr[$now_user['level']]['icon'].'" width="15" height="15">';
				echo $imgstr.' '.$levelarr[$now_user['level']]['lname'];
				}else{echo '暂无等级';}</php></a>
			</div>
		</div>
		<div class="side-nav__account cf">
			<a class="item item--first" href="{pigcms{:U('Credit/index')}" title="{pigcms{$now_user.now_money}">{pigcms{$now_user.now_money}<span>余额</span></a>
			<a class="item" href="{pigcms{:U('Point/index')}" title="{pigcms{$now_user.score_count}">{pigcms{$now_user.score_count}<span>积分</span></a>
		</div>
		<dl class="side-nav__list">
			<dt class="first-item"><strong>我的订单</strong></dt>
			<dd>
				<ul class="item-list">
					<li <if condition="in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('index'))">class="current"</if>><a href="{pigcms{:U('Index/index')}">{pigcms{$config.group_alias_name}订单</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('meal_list'))">class="current"</if>><a href="{pigcms{:U('Index/meal_list')}">{pigcms{$config.meal_alias_name}订单</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('lifeservice'))">class="current"</if>><a href="{pigcms{:U('Index/lifeservice')}">缴费订单</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Collect'))">class="current"</if>><a href="{pigcms{:U('Collect/index')}">我的收藏</a></li>
				</ul>
			</dd>
			<dt><strong>我的评价</strong></dt>
			<dd>
				<ul class="item-list">
					<li <if condition="in_array(MODULE_NAME,array('Rates')) && in_array(ACTION_NAME,array('index','meal'))">class="current"</if>><a href="{pigcms{:U('Rates/index')}">待评价</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Rates')) && in_array(ACTION_NAME,array('rated','meal_rated'))">class="current"</if>><a href="{pigcms{:U('Rates/rated')}">已评价</a></li>
				</ul>
			</dd>
			<dt><strong>我的账户</strong></dt>
			<dd class="last">
				<ul class="item-list">
					<li <if condition="in_array(MODULE_NAME,array('Point'))">class="current"</if>><a href="{pigcms{:U('Point/index')}">我的积分</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Credit'))">class="current"</if>><a href="{pigcms{:U('Credit/index')}">我的余额</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Level'))">class="current"</if>><a href="{pigcms{:U('Level/index')}">我的等级</a></li>
					<li <if condition="in_array(MODULE_NAME,array('Adress'))">class="current"</if>><a href="{pigcms{:U('Adress/index')}">收货地址</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</div>