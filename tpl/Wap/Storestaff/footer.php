		<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
	    <footer class="footermenu">
		    <ul>
		        <li>
		            <a <if condition="ACTION_NAME eq 'group_list' OR ACTION_NAME eq 'group_edit'">class="active"</if> href="{pigcms{:U('Storestaff/group_list')}">
		            <img src="{pigcms{$static_path}images/Lngjm86JQq.png">
		            <p>{pigcms{$config.group_alias_name}</p>
		            </a>
		        </li>
		        <li>
		            <a <if condition="ACTION_NAME eq 'meal_list' OR ACTION_NAME eq 'meal_edit'">class="active"</if> href="{pigcms{:U('Storestaff/meal_list')}">
		            <img src="{pigcms{$static_path}images/s22KaR0Wtc.png">
		            <p>{pigcms{$config.meal_alias_name}</p>
		            </a>
		        </li>
				<li>
		            <a id="qrcode_btn">
						<img src="{pigcms{$static_path}images/qrcode.png"/>
						<p>扫一扫</p>
		            </a>
		        </li>
		        <li>
		            <a href="javascript:;" onclick="LogOutSys()" <if condition="ACTION_NAME eq 'logout'">class="active"</if> >
		            <img src="{pigcms{$static_path}images/J0uZbXQWvJ.png">
		            <p>退出</p>
		            </a>
		        </li>
		    </ul>
		<script type="text/javascript">
		var logoutURl="{pigcms{:U('Storestaff/logout')}"
		function LogOutSys(){
			if(confirm('您确认要退出系统吗？')){
			    window.location.href=logoutURl;
			}
		}
		</script>
		</footer>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
        