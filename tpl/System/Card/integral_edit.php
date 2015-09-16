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
editor = K.create('#info', {
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
						<td width="150">{pigcms{$thisCard.cardname}：</td>
						<td>发布礼品券</td>
					</tr>
					<tr>
						<td width="150">礼品名称：</td>
						<td><input type="text" class="input-text" value="{pigcms{$vip.title}" name="title"/></td>
					</tr>
					<tr>
						<td width="150">兑换礼品所需积分：</td>
						<td><input type="text" class="input-text" value="{pigcms{$vip.integral}" name="integral"/></td>
					</tr>
					<tr>
						<td>有效期：</td>
						<td>
							<input type="text" class="input-text" id="statdate" value="{pigcms{$vip.statdate|date='Y-m-d',###}" onClick="WdatePicker()" name="statdate" style="width:90px;"> （含）到
							<input type="text" class="input-text" id="enddate" value="{pigcms{$vip.enddate|date='Y-m-d',###}" name="enddate" onClick="WdatePicker()" style="width:90px;">（含）
						</td>
					</tr>
					<tr>
						<td>礼品券图片：</td>
						<td>
							<img src="<if condition="$vip.pic eq ''">/static/images/cart_info/lipin.jpg<else/>{pigcms{$vip.pic}</if>" id="pic_src"style="max-width:200px;"><br/>
							<input type="text" name="pic" id="pic" value="<if condition="$vip.pic eq ''">/static/images/cart_info/lipin.jpg<else/>{pigcms{$vip.pic}</if>" class="input-text" style="width:200px;"> 
							<input type="button" onclick="upyunPicUpload('pic',720,400,'card')" value="上传" class="button"/>
							<input type="button" onclick="viewImg('pic')" value="预览" class="button"/>[720*400]
						</td>
					</tr>
					<tr>
						<td valign="top">使用说明：</td>
						<td>
							<textarea name="info" id="info" rows="5" style="width: 410px; height: 250px; display: none;">{pigcms{$vip.info}</textarea>
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