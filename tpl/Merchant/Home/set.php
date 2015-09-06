<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Classify/index')}">微网站</a>
			</li>
			<li class="active">首页回复配置</li>
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
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>关键词</label></label>
									<label class="col-sm-4"><span class="required" style="color:red;">首页 或者 home —— 当用户输入该关键词时，将会触发此回复。</span></label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">回复标题</label></label>
									<input type="text" class="col-sm-3" name="title" value="{pigcms{$info.title}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">内容介绍</label></label>
									<textarea  class="col-sm-3" id="info" name="info"  style="height:125px" >{pigcms{$info.info}</textarea>
									<span class="form_tips">最多填写120个字</span>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">回复图片</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<span class="ace-file-container" data-title="选择" onclick="upyunPicUpload('picurl',720,400,'home')">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:417px;height:200px" id="picurl_src" src="{pigcms{$info.picurl}"></div>
									<input type="hidden" name="picurl" id="picurl" value="{pigcms{$info.picurl}" />
								</div>
								
								<!--div class="form-group">
									<label class="col-sm-1"><label for="contant_url">公众号链接地址 </label></label>
									<input type="text" class="col-sm-3" name="url" value="{pigcms{$info.url}" id="url"/>
									<span class="form_tips" style="color:red;">填写此链接地址可以有效帮助粉丝关注您的公众号！请填写一个微信官方公众平台群发出的文章链接。链接前加http://</span>
								</div-->
								
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

<script type="text/javascript">
function preview1(input){
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) { $('#img').attr('src', e.target.result);}
		reader.readAsDataURL(input.files[0]);
	}
}

function viewTpl(){
	var tid = $('#tpid').val();
	chooseTpl(tid,'',2);
}

function viewTpl2(){
	var tid = $('#conttpid').val();
	chooseTpl(tid,'',4);
}
</script>
<include file="Public:footer"/>