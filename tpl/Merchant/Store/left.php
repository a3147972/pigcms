<div id="sidebar" class="sidebar responsive">
	<ul class="nav nav-list" style="top: 0px;">
		<li class="hsub <if condition="strpos(ACTION_NAME,'group') nheq false">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text">{pigcms{$config.group_alias_name}订单管理</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="strpos(ACTION_NAME,'group') nheq false">class="active"</if>>
					<a href="{pigcms{:U('Store/group_list')}"> 
						<i class="menu-icon fa fa-caret-right"></i> {pigcms{$config.group_alias_name}订单列表
					</a>
					<b class="arrow"></b>
				</li>					
			</ul>
		</li>
		<li class="hsub <if condition="strpos(ACTION_NAME,'meal') nheq false">open active</if>">
			<a href="#" class="dropdown-toggle"> 
				<i class="menu-icon fa fa-cutlery"></i>
				<span class="menu-text">{pigcms{$config.meal_alias_name}订单管理</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li <if condition="strpos(ACTION_NAME,'meal') nheq false">class="active"</if>>
					<a href="{pigcms{:U('Store/meal_list')}">
						<i class="menu-icon fa fa-caret-right"></i> {pigcms{$config.meal_alias_name}订单列表
					</a>
					<b class="arrow"></b>
				</li>					
			</ul>
		</li>
	</ul>
	<!-- /.nav-list -->

	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script>
</div>