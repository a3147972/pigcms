<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-flag-o"></i>
				<a href="{pigcms{:U('Catemenu/index')}">微网站</a>
			</li>
			<li class="active">添加底部菜单</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Catemenu/insert')}">
								<if condition="$fid neq 0">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">上级菜单名称</label></label>
									<label class="col-sm-3">{pigcms{$thisCatemenu.name}</label>
								</div>
								</if>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>菜单名称</label></label>
									<input type="text" class="col-sm-3" name="name" value="{pigcms{$info.name}" />
									<input type="hidden" name="fid" value="{pigcms{$fid}" />
									<input type="hidden" name="id" value="{pigcms{$info.id}" />
								</div>
								
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">图标地址</label></label>
								</div>
								
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50" onchange="preview1(this)" name="img" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<input type="hidden" name="picurl" id="picurl" value="{pigcms{$info.picurl}"/>
									<div><img style="background:#eee;width:50px;height:50px" id="img" src="{pigcms{$info.picurl}"></div>
								</div>
								
								<div class="form-group" style="padding-left:140px;">
									<label class="ace-file-input">您可以点击下面这些图片作为图标（直接点击即可）</label>
									<div style="background:#eee;width:570px;margin:10px 0;text-align:center">
									  <?php
									  for ($i=1;$i<20;$i++){
									  	echo '<img onclick="document.getElementById(\'img\').src=this.src;document.getElementById(\'picurl\').value=this.src;" style="width:30px;cursor:pointer;" src="/static/images/photo/plugmenu'.$i.'.png" />';
									  }
									  ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">外链网站或活动 </label></label>
									<input type="text" class="col-sm-3" name="url" value="{pigcms{$info.url}" id="url"/>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="orderss">排序</label></label>
									<input class="col-sm-3" type="text" id="orderss" value="{pigcms{$info.orderss}" name="orderss"/>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums">是否显示</label></label>
									<div class="radio">
										<label>
											<input name="status" value="0" type="radio" class="ace" <if condition="$info['status'] eq 0" >checked</if>>
											<span class="lbl" style="z-index: 1">不显</span>
										</label>
										<label>
											<input name="status" value="1" type="radio" class="ace" <if condition="$info['status'] eq 1" >checked</if>>
											<span class="lbl" style="z-index: 1">显示</span>
										</label>
									</div>										
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
		$("#picurl").val('');
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