<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-group"></i>
			<li class="active">粉丝管理</li>
			<li><a href="{pigcms{:U('Customer/add')}">添加客服</a></li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Customer/insert')}">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>客服名称</label></label>
									<input type="text" class="col-sm-2" name="nickname" value="{pigcms{$info.nickname}" />
									<input type="hidden" class="col-sm-2" name="pigcms_id" value="{pigcms{$info.pigcms_id}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">客服描述</label></label>
									<textarea rows="5" cols="40" name="des" class="col-sm-2">{pigcms{$info.des}</textarea>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">客服头像</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50" onchange="preview1(this)" name="head_img" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:80px;height:80px" id="head_img" src="{pigcms{$info.head_img}"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">选择粉丝</label></label>
									<input type="text" id="openid" class="col-sm-2" value="{pigcms{$info.openid}" name="openid" readonly />
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" onclick="selectFans('openid')">选择粉丝</a>
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

<script type="text/javascript">
function preview1(input){
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) { $('#head_img').attr('src', e.target.result);}
		reader.readAsDataURL(input.files[0]);
	}
}
</script>
<include file="Public:footer"/>