	<if condition="ACTION_NAME eq 'index'">
		<script type="text/javascript">
			window.shareData = {  
		            "moduleName":"Index",
		            "moduleID":"0",
		            "imgUrl": "{pigcms{$homeInfo.picurl}", 
		            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Index/index',array('token' => $mer_id))}",
		            "tTitle": "{pigcms{$homeInfo.title}",
		            "tContent": "{pigcms{$homeInfo.info}"
			};
		</script>
	<else />
		<script type="text/javascript">
		window.shareData = {  
	            "moduleName":"NewsList",
	            "moduleID":"{pigcms{$_GET['classid']|intval}",
	            "imgUrl": "{pigcms{$thisClassInfo.img}", 
	            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Index/lists',array('token' => $mer_id,'classid'=>$_GET['classid']))}",
	            "tTitle": "{pigcms{$thisClassInfo.name}",
	            "tContent": "{pigcms{$thisClassInfo.info}"
		};
		</script>	
	
	</if>
	
{pigcms{$shareScript}

<div style="display:none;">{pigcms{$config.wap_site_footer}</div>