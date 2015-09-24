<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Classify/index')}">微网站</a>
			</li>
			<li class="active">添加分类</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Classify/insert')}">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">上级分类名称</label></label>
									<label class="col-sm-3">{pigcms{$thisClassify.name}
									<input type="hidden" name="fid" value="{pigcms{$fid}" />
									<input type="hidden" name="id" value="{pigcms{$info.id}" />
									</label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>分类名称</label></label>
									<input type="text" class="col-sm-3" name="name" value="{pigcms{$info.name}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">分类描述</label></label>
									<input type="text" class="col-sm-3" name="info" value="{pigcms{$info.info}" />
									<span class="form_tips">30个字简短分类描述，可为空</span>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">分类图片</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50" onchange="preview1(this)" name="img" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:417px;height:200px" id="img" src="{pigcms{$info.img}"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">外链网站或活动 </label></label>
									<input type="text" class="col-sm-3" name="url" value="{pigcms{$info.url}" id="url"/>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sorts">排序</label></label>
									<input class="col-sm-3" type="text" id="sorts" value="{pigcms{$info.sorts}" name="sorts"/>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums">是否显示</label></label>
									<div class="radio">
										<label>
											<input name="status" value="1" type="radio" class="ace" <if condition="$info['status'] eq 1 || empty($info)" >checked="checked"</if>/>
											<span class="lbl" style="z-index: 1">显示</span>
										</label>
										<label>
											<input name="status" value="0" type="radio" class="ace" <if condition="$info['status'] eq 0  && !empty($info)">checked="checked"</if>/>
											<span class="lbl" style="z-index: 1">不显</span>
										</label>
									</div>										
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">分类页模板</label></label>
									<input type="text" id="selecttpl" class="col-sm-3" value="已选择模板{pigcms{$info.tpid}" disabled />
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" onclick="chooseTpl('tpid','selecttpl',1)">选择模板</a>
									<input type="hidden" class="px" id="tpid" value="{pigcms{$info.tpid}" name="tpid" style="width:250px">
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">内容页模板</label></label>
									<input type="text" id="selectconttpl" class="col-sm-3" value="已选择模板{pigcms{$info.conttpid}" disabled />
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" onclick="chooseTpl('conttpid','selectconttpl',3)">选择模板</a>
									<input type="hidden" class="px" value="{pigcms{$info.conttpid}" id="conttpid" name="conttpid" style="width:250px">
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