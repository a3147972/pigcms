<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('User/addlevel')}" frame="true" refresh="true">
		<input type="hidden" name="lid" value="{pigcms{$leveldata['id']}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td width="80">等级名称：</td>
				<td>
				<input type="text" class="input fl" name="lname" value="{pigcms{$leveldata['lname']}" placeholder="请填写一个等级名" tips="如vip1，vip2等">
				&nbsp;&nbsp;&nbsp;<span class="red">例如：1=>VIP1,2=>VIP2 等</span>
				</td>
			</tr>
			<tr>
				<td width="80">等级级别：</td>
				<td>
				<span class="input fl" style="width: 140px;">{pigcms{$leveldata['level']}</span>
				&nbsp;&nbsp;&nbsp;<span class="red">例如：1=>VIP1,2=>VIP2 等</span>
				</td>
			</tr>
			<tr>
				<td width="80">等级积分：</td>
				<td>
				<input type="text" class="input fl" name="integral" value="{pigcms{$leveldata['integral']}" placeholder="请填写一个对应数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')" tips="成为该等级会员所需要的积分数">
				&nbsp;&nbsp;&nbsp;<span class="red">客户想成为该等级会员所需要消耗的积分数</span>
				</td>
			</tr>
			<tr>
				<td width="80">等级图标：</td>
				<td>
				    <input type="hidden" name="icon" value="{pigcms{$leveldata['icon']}"/>
					<a href="javascript:void(0)" class="btn btn-sm btn-success J_selectImage">上传图片</a>
				    <img src="{pigcms{$leveldata['icon']}" width="50px" <if condition="!empty($leveldata['icon'])"> style="margin-left: 30px;"<else/>style="margin-left: 30px;display:none;"</if> />
				</td>
			</tr>
		   <tr>
				<td width="80">等级福利：</td>
				<td>优惠&nbsp;
				<select name="fltype">
				<option value="0">无</option>
				<option value="1" <if condition="$leveldata['type'] eq 1">selected="selected"</if>>百分比（%）</option>
				<option value="2" <if condition="$leveldata['type'] eq 2">selected="selected"</if>>立减</option>
				</select>
				&nbsp;&nbsp;&nbsp;
				 <input type="text" class="input" name="boon" value="{pigcms{$leveldata['boon']}" placeholder="请填写一个优惠值数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')" >
				</td>
			</tr>
			<tr>
				<td width="80">等级介绍：</td>
			   <td><textarea id="description" name="description"  placeholder="写上一些等级介绍说明文字">{pigcms{$leveldata['description']|htmlspecialchars_decode=ENT_QUOTES}</textarea></td>
			</tr>
		   <tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">

KindEditor.ready(function(K){
	var editor = K.editor({
		allowFileManager : true
	});
	 //var islock=false;
	K('.J_selectImage').click(function(){
		var obj=$(this);
		editor.uploadJson = "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=system/image";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					obj.siblings('input').val(url);
					editor.hideDialog();
					obj.siblings('img').attr('src',url).show();
					//window.location.reload();
				}
			});
		});
	   
	});

	kind_editor = K.create("#description",{
		width:'480px',
		height:'380px',
		minWidth:'480px',
		resizeType : 1,
		allowPreviewEmoticons:false,
		allowImageUpload : true,
		filterMode: true,
		items : [
			'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link'
		],
		emoticonsPath : './static/emoticons/',
		uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=system/image"
	});
});
</script>
