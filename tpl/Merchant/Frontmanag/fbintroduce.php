<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Frontmanag/index')}">商家管理</a>
			</li>
			<li class="active">商家描述管理</li>
			<li class="active">内容发布</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form" action="/merchant.php?g=Merchant&c=Frontmanag&a=fbintroduce">
					   <input  name="idx" type="hidden" value="{pigcms{$fbintroduce['id']}"/>
					   <input  name="notitle" type="hidden" value="{pigcms{$notitle}"/>
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
							  <if condition="!$notitle">
								<div class="form-group">
									<label class="col-sm-1"><label for="title">标题</label></label>
									<input class="col-sm-2" size="80" name="title" id="title" type="text" value="{pigcms{$fbintroduce['title']}"/>
								</div>
							<div class="form-group">
									<label class="col-sm-1">是否发布</label>
									<label><input  value="1" name="isfabu" type="radio" <if condition="$fbintroduce['isfabu'] eq 1"> checked="checked" </if> />&nbsp;&nbsp;是</label>
									&nbsp;&nbsp;&nbsp;
									<label><input  value="0" name="isfabu" type="radio" <if condition="$fbintroduce['isfabu'] neq 1"> checked="checked" </if> />&nbsp;&nbsp;否</label>
							
								</div>	
							<div class="form-group">
									<label class="col-sm-1"><label for="sort">排序</label></label>
									<input class="col-sm-2" size="20" name="sort" id="sort" type="text" value="{pigcms{$fbintroduce['sort']}" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
							</div>
							<else/>
								<div class="form-group">
									<label class="col-sm-1"><label for="title">标题</label></label>
									<input class="col-sm-2" size="80" type="text" value="{pigcms{$fbintroduce['title']}导航" readonly="readonly"/>
								</div>
							</if>
							<div class="form-group">
								<label class="col-sm-1"><label for="sort">发布内容</label></label>
								<textarea id="description" name="description"  placeholder="写上一些想要发布的内容">{pigcms{$fbintroduce['content']|htmlspecialchars_decode=ENT_QUOTES}</textarea> 
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
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
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
		});

</script>

<include file="Public:footer"/>
