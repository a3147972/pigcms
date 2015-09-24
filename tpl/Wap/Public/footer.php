		<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
		<if condition="empty($no_gotop)">
			<div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div>
		</if>
	    <footer class="footermenu">
		    <ul>
		        <li>
		            <a <if condition="MODULE_NAME eq 'Home'">class="active"</if> href="{pigcms{:U('Home/index')}">
		            <img src="{pigcms{$static_path}images/3YQLfzfunJ.png">
		            <p>首页</p>
		            </a>
		        </li>
		        <li>
		            <a <if condition="MODULE_NAME eq 'Group'">class="active"</if> href="{pigcms{:U('Group/index')}">
		            <img src="{pigcms{$static_path}images/Lngjm86JQq.png">
		            <p>{pigcms{$config.group_alias_name}</p>
		            </a>
		        </li>
		        <li>
		            <a <if condition="in_array(MODULE_NAME,array('Meal_list','Meal'))">class="active"</if> href="{pigcms{:U('Meal_list/index')}">
		            <img src="{pigcms{$static_path}images/s22KaR0Wtc.png">
		            <p>{pigcms{$config.meal_alias_name}</p>
		            </a>
		        </li>
		        <li>
		            <a <if condition="in_array(MODULE_NAME,array('My','Login'))">class="active"</if> href="{pigcms{:U('My/index')}">
		            <img src="{pigcms{$static_path}images/J0uZbXQWvJ.png">
		            <p>我的</p>
		            </a>
		        </li>
		    </ul>
		</footer>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
        