<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Merchant/news_amend')}" frame="true" refresh="true">
		<input type="hidden" name="id" value="{pigcms{$now_news.id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">标题</th>
				<td><input type="text" class="input fl" name="title" value="{pigcms{$now_news.title}" size="75" placeholder="公告标题" validate="maxlength:50,required:true"/></td>
			</tr>
			<tr>
				<th width="80">内容</th>
				<td>
					<textarea name="content" id="content">{pigcms{$now_news.content}</textarea>
				</td>
			</tr>
			<tr>
				<th width="80">置顶</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$now_news['is_top'] eq 1">selected</if>"><span>是</span><input type="radio" name="is_top" value="1"  <if condition="$now_news['is_top'] eq 1">checked="checked"</if>/></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_news['is_top'] eq 0">selected</if>"><span>否</span><input type="radio" name="is_top" value="0"  <if condition="$now_news['is_top'] eq 0">checked="checked"</if>/></label></span>
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
				height:'320px',
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