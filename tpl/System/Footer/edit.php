<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Footer/amend')}" frame="true" refresh="true">
		<input type="hidden" name="id" value="{pigcms{$now_link.id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">名称</th>
				<td><input type="text" class="input fl" name="name" value="{pigcms{$now_link.name}" size="30" validate="maxlength:50,required:true" tips="网站底部显示的名称"/></td>
			</tr>
			<tr>
				<th width="80">标题</th>
				<td><input type="text" class="input fl" name="title" value="{pigcms{$now_link.title}" size="50" validate="maxlength:50" tips="介绍页的内容标题，不填写则以名称显示"/></td>
			</tr>
			<tr>
				<th width="80">自定义链接</th>
				<td><input type="text" class="input fl" name="url" value="{pigcms{$now_link.url}" size="60" validate="maxlength:200" tips="若设置了此项，点击导航将会跳转到设定的链接"/></td>
			</tr>
			<tr>
				<th width="80">内容</th>
				<td>
					<textarea name="content" id="content">{pigcms{$now_link.content}</textarea>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
	<script type="text/javascript">
		KindEditor.ready(function(K){
			kind_editor = K.create("#content",{
				width:'402px',
				height:'300px',
				resizeType : 1,
				allowPreviewEmoticons:false,
				allowImageUpload : true,
				filterMode: true,
				items : [
					'source', 'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link'
				],
				emoticonsPath : './static/emoticons/',
				uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
			});
		});
	</script>
<include file="Public:footer"/>