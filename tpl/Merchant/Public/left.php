<div id="sidebar" class="sidebar responsive">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a class="btn btn-success" href="{pigcms{:U('Config/merchant')}" title="商家设置">
				<i class="ace-icon fa fa-gear"></i>
			</a>&nbsp;
			<a class="btn btn-info" href="{pigcms{:U('Meal/index')}" title="{pigcms{$config.meal_alias_name}管理"> 
				<i class="ace-icon fa fa-cutlery"></i>
			</a>&nbsp;
			<a class="btn btn-warning" href="{pigcms{:U('Group/index')}" title="{pigcms{$config.group_alias_name}管理"> 
				<i class="ace-icon fa fa-desktop"></i>
			</a>&nbsp;
			<!--a class="btn btn-danger" href="{pigcms{:U('Pay/index')}"> 
				<i class="ace-icon fa fa-smile-o"></i>
			</a-->
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span> <span class="btn btn-info"></span>
			<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list" style="top: 0px;">
		<volist name="merchant_menu" id="vo">
			<li class="{pigcms{$vo.style_class}">
				<a <if condition="$vo['menu_list']">href="#" class="dropdown-toggle"<else/>href="{pigcms{$vo.url}"</if>> 
					<i class="menu-icon fa {pigcms{$vo.icon}"></i>
					<span class="menu-text">{pigcms{$vo.name}</span>
					<if condition="$vo['menu_list']">
						<b class="arrow fa fa-angle-down"></b>
					</if>
				</a>
				<b class="arrow"></b>
				<if condition="$vo['menu_list']">
					<ul class="submenu">
						<volist name="vo['menu_list']" id="voo">
							<li <if condition="$voo['is_active']">class="active"</if>>
								<a href="{pigcms{$voo.url}"> 
									<i class="menu-icon fa fa-caret-right"></i> {pigcms{$voo.name}
								</a>
								<b class="arrow"></b>
							</li>
						</volist>
					</ul>
				</if>
			</li>
		</volist>
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