<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li>
				<a href="{pigcms{:U('Card/privilege', array('id' => $thisCard['id']))}">【{pigcms{$thisCard['cardname']}】</a>
			</li>
			<li class="active">添加会员特权</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="">
								<div class="form-group">
									<label class="col-sm-4"><label for="contact_name">{pigcms{$thisCard.cardname}：发布会员特权 </label></label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>特权名称</label></label>
									<input type="text" class="col-sm-3" name="title" value="{pigcms{$vip.title}" />
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="adress">有效期</label></label>
									<div class="radio">
										<label>
											<input name="type" value="1" type="radio" class="ace" onclick="document.getElementById('cktime').style.display='none';" value="1" <if  condition="$vip['statdate'] eq false">checked="checked"</if>>
											<span class="lbl" style="z-index: 1">无时间期限</span>
										</label>
										<label>
											<input name="type" value="0" type="radio" class="ace" <if  condition="$vip['statdate'] neq false">checked="checked"</if> onclick="document.getElementById('cktime').style.display='';;">
											<span class="lbl" style="z-index: 1">选择时间期限</span>
										</label>
									</div>										
								</div>

								<div class="form-group" id="cktime" <if  condition="$vip['statdate'] eq false">style="display:none"</if>>
									<label class="col-sm-1"><label for="adress"></label></label>
									<input type="text" class="hasDatepicker" id="statdate" value="{pigcms{$vip.statdate|date='Y-m-d',###}" onClick="WdatePicker()" name="statdate" />
									到
									<input type="text" class="hasDatepicker" id="enddate" value="{pigcms{$vip.enddate|date='Y-m-d',###}" name="enddate" onClick="WdatePicker()"/>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="endinfo">使用说明</label></label>
									<textarea  class="col-sm-3" id="info" name="info"  style="height:125px" >{pigcms{$vip.info}</textarea>
								</div>
								
								
								
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											保存
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script type="text/javascript" src="/static/js/date/WdatePicker.js"></script>

<link rel="stylesheet" href="./static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./static/kindeditor/plugins/code/prettify.css" />
<script src="./static/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="./static/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="./static/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script type="text/javascript">

var editor;
KindEditor.ready(function(K) {
editor = K.create('#info', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
items : [
'source','undo','redo','copy','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
 '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'image','emoticons', 'link', 'unlink']
});
});
</script>
<include file="Public:footer"/>