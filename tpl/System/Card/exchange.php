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
editor = K.create('#cardinfo2', {
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
						<td>积分设置</td>
					</tr>
					<tr>
						<td width="100">每天签到奖励：</td>
						<td><input type="text" class="input-text" name="everyday" value="{pigcms{$exchange.everyday}"/>积分</td>
					</tr>
					<tr>
						<td>消费1元奖励：</td>
						<td>
							<input type="text" class="input-text" id="reward" value="{pigcms{$exchange.reward}" name="reward">积分
						</td>
					</tr>
					<tr>
						<td valign="top">积分规则说明：</td>
						<td>
							<textarea  class="col-sm-3" id="cardinfo2" name="cardinfo2"  style="height:125px" >{pigcms{$exchange.cardinfo2}</textarea>
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