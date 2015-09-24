<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">微网站</a>
			</li>
			<li>
				<a href="{pigcms{:U('Card/staff', array('id' => $thisCard['id']))}">【{pigcms{$thisCard['cardname']}】</a>
			</li>
			<li class="active">添加店员</li>
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
									<label class="col-sm-1"><label for="contact_name">姓名</label></label>
									<input type="text" class="col-sm-3" name="name" value="{pigcms{$item.name}" />
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">用户名</label></label>
									<input type="text" class="col-sm-3" name="username" value="{pigcms{$item.username}" />
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">密码</label></label>
									<input type="password" class="col-sm-3" name="password" value="" />
									<span class="form_tips">(修改时如果不想修改密码请留空)</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">电话</label></label>
									<input type="text" class="col-sm-3" name="tel" value="{pigcms{$item.tel}" />
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="adress">所属店铺</label></label>
									<select name="store_id" class="pt">
										<option value="0" <if condition="$item['store_id'] eq 0">selected</if>>请选择</option>
										<volist id="company" name="companys">
											<option value="{pigcms{$company.store_id}" <if condition="$item['store_id'] eq $company['store_id']">selected</if>>{pigcms{$company.name}</option>
										</volist>                            
									</select>
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
$(function(){
	 $('.type').change(function(){
		 if($(this).val() == 1){ 
			 $('#pic_src').attr('src','/static/images/cart_info/youhui.jpg');
			 $('#pic').val('/static/images/cart_info/youhui.jpg');
			 $('#cktime').css('display','none');
		 }else{
			 $('#pic_src').attr('src','/static/images/cart_info/daijin.png');
			 $('#pic').val('/static/images/cart_info/lipin.jpg');
			 $('#cktime').css('display','');
		 }
	 });
});

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