<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Group/index')}">{pigcms{$config.group_alias_name}管理</a>
			</li>
			<li class="active">新建{pigcms{$config.group_alias_name}套餐</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="{pigcms{:U('Group/mpackageadd')}">
					   <input  name="idx" type="hidden" value="{pigcms{$mpackage['id']}"/>
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="title">套餐标示名称</label></label>
									<input class="col-sm-2" size="80" name="title" id="title" type="text" value="{pigcms{$mpackage['title']}"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="red">（必填）</span>
								</div>
							<div class="form-group">
								<label class="col-sm-1"><label for="sort">简短描述</label></label>
								<textarea id="description" name="description"  placeholder="写上一些此套餐的简短描述" rows="10" cols="50">{pigcms{$mpackage['description']|htmlspecialchars_decode=ENT_QUOTES}</textarea> 
							</div>
						<div class="space"></div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit" onclick="$(this).attr('type','text')">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
						</div>
					</form>
			</div>
		</div>
	 </div>
   </div>
</div>
<style type="text/css">
.ke-dialog-body .ke-input-text{height: 30px;}
</style>
<!--<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
/*KindEditor.ready(function(K){
			kind_editor = K.create("#description",{
				width:'400px',
				height:'400px',
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
				uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
			});
		});*/

</script>--->

<include file="Public:footer"/>
