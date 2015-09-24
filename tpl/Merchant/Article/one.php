<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-file-excel-o"></i> 
				<a href="{pigcms{:U('Article/index')}">素材管理</a>
			</li>
			<li>创建单图文</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>标题</label></label>
									<input type="hidden" value="{pigcms{$pigcms_id}" name="pigcms_id" />
									<input type="hidden" value="{pigcms{$image_text['pigcms_id']}" name="thisid" />
									<input type="text" class="col-sm-3" id="title" name="title" value="{pigcms{$image_text['title']}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">作者</label></label>
									<input type="text" class="col-sm-3" name="author" value="{pigcms{$image_text['author']}" />
								</div>
								
								<div class="form-group">
									<label class="col-sm-1">封面图</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1">图片预览</label>
									<input type="hidden" name="cover_pic" id="cover_pic" value="{pigcms{$image_text['cover_pic']}"/>
									<div id="upload_pic_box">
										<ul id="upload_pic_ul">
											<if condition="$image_text['cover_pic']">
											<li class="upload_pic_li">
												<img src="{pigcms{$image_text['cover_pic']}"/><br/>
												<a href="#" onclick="deleteImage('{pigcms{$image_text['cover_pic']}',this);return false;">[ 删除 ]</a>
											</li>
											</if>
										</ul>
									<if condition="$image_text['cover_pic']">
									<label>
										<input name="is_show" value="1" type="checkbox" class="ace" <if condition="$image_text['is_show']">checked</if>>
										<span class="lbl" style="z-index: 1">封面图片显示在正文中</span>
									</label>
									</if>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="info">摘要</label></label>
									<textarea  class="col-sm-3" id="digest" name="digest" style="height:125px">{pigcms{$image_text['digest']}</textarea>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>正文</label></label>
									<textarea class="col-sm-3" id="content" name="content" style="width: 300px; height: 150px; display: none;">{pigcms{$image_text['content']}</textarea>
								</div>
		
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">外链</label></label>
									<input class="col-sm-3" name="url" id="url" type="text" value="{pigcms{$image_text['url']}"/>　
									<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
								</div>
		
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">所属类别</label></label>
									<input class="col-sm-1" name="classname" id="classname" type="text" value="{pigcms{$image_text['classname']}"/>　
									<input class="col-sm-1" name="classid" id="classid" type="hidden" value="{pigcms{$image_text['classid']}"/>
									<a href="javascript:void(0);" onclick="editClass('classid','classname',0)" class="btn btn-sm btn-success">选择所属分类</a>　
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
<style>
input.ke-input-text {
background-color: #FFFFFF;
background-color: #FFFFFF!important;
font-family: "sans serif",tahoma,verdana,helvetica;
font-size: 12px;
line-height: 24px;
height: 24px;
padding: 2px 4px;
border-color: #848484 #E0E0E0 #E0E0E0 #848484;
border-style: solid;
border-width: 1px;
display: -moz-inline-stack;
display: inline-block;
vertical-align: middle;
zoom: 1;
}
.form-group>label{font-size:12px;line-height:24px;}
#upload_pic_box{margin-top:20px;height:60px;}
#upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
#upload_pic_box img{width:100px;height:70px;}

.small_btn{
margin-left: 10px;
padding: 6px 8px;
cursor: pointer;
display: inline-block;
text-align: center;
line-height: 1;
letter-spacing: 2px;
font-family: Tahoma, Arial/9!important;
width: auto;
overflow: visible;
color: #333;
border: solid 1px #999;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
background: #DDD;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#DDDDDD');
background: linear-gradient(top, #FFF, #DDD);
background: -moz-linear-gradient(top, #FFF, #DDD);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFF), to(#DDD));
text-shadow: 0px 1px 1px rgba(255, 255, 255, 1);
box-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0 -1px 0 rgba(0, 0, 0, .09);
-moz-transition: -moz-box-shadow linear .2s;
-webkit-transition: -webkit-box-shadow linear .2s;
transition: box-shadow linear .2s;
outline: 0;
}
.small_btn:active{
border-color: #1c6a9e;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33bbee', endColorstr='#2288cc');
background: linear-gradient(top, #33bbee, #2288cc);
background: -moz-linear-gradient(top, #33bbee, #2288cc);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#33bbee), to(#2288cc));
}
</style>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>

<script type="text/javascript">
var diyTool = "{pigcms{:U('Article/diytool')}";
var editor;
KindEditor.ready(function(K) {
	editor = K.create('#content', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : true,
		uploadJson : '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
		items : ['fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr',
		 '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
		'insertunorderedlist','link', 'unlink','image','diyTool']
	});
	K('#J_selectImage').click(function(){
		if($('.upload_pic_li').size() >= 10){
			alert('最多上传10个图片！');
			return false;
		}
		editor.uploadJson = "{pigcms{:U('Config/ajax_upload_pic')}";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#upload_pic_ul').html('<li class="upload_pic_li"><img src="'+url+'"/><br/><a href="#" onclick="deleteImage(\''+title+'\',this);return false;">[ 删除 ]</a></li>');
// 					$('#show_cover_pic').attr('src', url);
					$('#upload_pic_box').find('label').remove();
					$('#upload_pic_box').append('<label><input name="is_show" value="1" type="checkbox" class="ace"><span class="lbl" style="z-index: 1">封面图片显示在正文中</span></label>');
					$('#cover_pic').val(url);
					editor.hideDialog();
				}
			});
		});
	});
});
function deleteImage(path,obj){
	$.post("{pigcms{:U('Config/ajax_del_pic')}",{path:path});
	$(obj).closest('.upload_pic_li').remove();
	$('#upload_pic_box').find('label').remove();
}
</script>
<include file="Public:footer"/>