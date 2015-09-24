<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>{pigcms{$config.site_name}</title>
		<meta name="description" content="{pigcms{$config.seo_description}">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="{pigcms{$static_path}css/mp_news.css" rel="stylesheet"/>
	</head>
		<body id="activity-detail" class=" ">
		<div class="rich_media container">
			<div class="header" style="display: none;"></div>
			<div class="rich_media_inner content" style="min-height: 831px;">
				<h2 class="rich_media_title" id="activity-name">{pigcms{$nowImage['title']}</h2>
				<div class="rich_media_meta_list">
					<em id="post-date" class="rich_media_meta text">{pigcms{$nowImage['now']}</em> 
					<em class="rich_media_meta text"></em> 
					<a class="rich_media_meta link nickname js-no-follow js-open-follow" href="javascript:;" id="post-user">{pigcms{$nowImage['author']}</a>
				</div>
				<div id="page-content" class="content">
					<div id="img-content">
						<if condition="$nowImage['cover_pic'] && $nowImage['is_show']">
						<div class="rich_media_thumb" id="media">
							<img onerror="this.parentNode.removeChild(this)" src="{pigcms{$nowImage['cover_pic']}">
						</div>
						</if>
						<div class="rich_media_content" id="js_content">{pigcms{$nowImage['content']}</div>
						<if condition="$nowImage['url']">
						<div class="rich_media_tool" id="js_toobar">
							<a class="media_tool_meta meta_primary" href="{pigcms{$nowImage['url']}">阅读原文</a>
						</div>
						</if>
					</div>
				</div>
			</div>
		</div>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Article",
		            "moduleID":"0",
		            "imgUrl": "{pigcms{$nowImage['cover_pic']}", 
		            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Article/index', array('imid' => $nowImage['pigcms_id']))}",
		            "tTitle": "{pigcms{$nowImage['title']}",
		            "tContent": "{pigcms{$nowImage['digest']}"
		};
		</script>
		{pigcms{$shareScript}
	</body>
</html>