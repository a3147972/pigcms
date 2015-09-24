<include file="Public:header"/>
<script type="text/javascript" src="./static/js/jquery.min.js"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="/tpl/System/static/js/upyun.js"></script>
<script type="text/javascript" src="/static/js/date/WdatePicker.js"></script>

<link rel="stylesheet" href="./static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./static/kindeditor/plugins/code/prettify.css" />
<script src="./static/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="./static/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="./static/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<script>

var editor;
KindEditor.ready(function(K) {
editor = K.create('#content', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/admin.php?g=System&c=Upyun&a=kindedtiropic',
items : [
'source','undo','redo','copy','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
 '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|','emoticons', 'link', 'unlink']
});
});
</script>
		<div class="mainbox">
			<form id="myform" method="post" action="" refresh="true" enctype="multipart/form-data" >
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%">
					<tr>
						<td width="100">{pigcms{$thisCard.cardname}：</td>
						<td>设置会员卡通知</td>
					</tr>
					<tr>
						<td width="100">标题：</td>
						<td><input type="text" class="input-text" value="{pigcms{$thisNotice.title}" name="title"/></td>
					</tr>
					<tr>
						<td>有效期：</td>
						<td>
							<input type="text" class="input-text" id="endtime" value="{pigcms{$thisNotice.endtime|date="Y-m-d",###}" name="endtime" onClick="WdatePicker()" style="width:90px;">
						</td>
					</tr>
					<tr>
						<td valign="top">使用说明：</td>
						<td>
							<textarea  class="col-sm-3" id="content" name="content"  style="height:125px" >{pigcms{$thisNotice.content}</textarea>
						</td>
					</tr>
				</table>
				<div class="btn">
					<input type="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
<include file="Public:footer"/>