<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/styles.css">
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.ba-bbq.min.js"></script>
<title>{pigcms{$config.site_name} - 商家中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="{pigcms{$static_path}css/bootstrap.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/font-awesome.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/jquery-ui.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/jquery-ui.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace-fonts.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace.min.css" id="main-ace-style">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace-skins.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/ace-rtl.min.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/global.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.ba-bbq.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/ace-extra.min.js"></script>


<script type="text/javascript" src="{pigcms{$static_path}js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script type="text/javascript" src="{pigcms{$static_path}js/bootbox.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery.sparkline.min.js"></script>

<!-- ace scripts -->
<script type="text/javascript" src="{pigcms{$static_path}js/ace-elements.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/ace.min.js"></script>

<script type="text/javascript" src="{pigcms{$static_path}js/jquery.yiigridview.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui-i18n.min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/jquery-ui-timepicker-addon.min.js"></script>
<style type="text/css">
html{
	background:#fff;
}
.jqstooltip {
	position: absolute;
	left: 0px;
	top: 0px;
	visibility: hidden;
	background: rgb(0, 0, 0) transparent;
	background-color: rgba(0, 0, 0, 0.6);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
	color: white;
	font: 10px arial, san serif;
	text-align: left;
	white-space: nowrap;
	padding: 5px;
	border: 1px solid white;
	z-index: 10000;
}

.jqsfield {
	color: white;
	font: 10px arial, san serif;
	text-align: left;
}

.statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {
	display: none;
}

#shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput
	{
	font-size: 12px;
	color: black;
	display: none;
	width: 100%;
}
</style>
<script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
</script>

</head>

<body class="no-skin">
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-empire"></i>
				<a href="{pigcms{$_GET.system_file}?c=Activity&a=index">活动列表</a>
			</li>
			<li class="active"><a href="{pigcms{$_GET.system_file}?c=Activity&a=activity_list&id={pigcms{$now_activity_term.activity_id}">{pigcms{$now_activity_term.name}</a></li>
			<li class="active">编辑活动</li>
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
							<form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
								<div class="form-group">
									<label class="col-sm-1"><label for="phone"><span class="required" style="color:red;">*</span>参与活动期数</label></label>
									<if condition="$now_activity['status'] eq 0">
										<select name="activity_term" class="col-sm-3">
											<volist name="activity_term_list" id="vo">
												<option value="{pigcms{$vo.activity_id}" <if condition="$now_activity['activity_term'] eq $vo['activity_id']">selected="selected"</if>>{pigcms{$vo.name} | 活动时间（{pigcms{$vo.begin_time|date='Y-m-d H:i',###} 至 {pigcms{$vo.end_time|date='Y-m-d H:i',###}）</option>
											</volist>
										</select>
									<else/>
										<span class="form_tips" style="margin-left:0px;">{pigcms{$now_activity_term.name} | 活动时间（{pigcms{$now_activity_term.begin_time|date='Y-m-d H:i',###} 至 {pigcms{$now_activity_term.end_time|date='Y-m-d H:i',###}）</if></span>&nbsp;&nbsp;&nbsp;（已开始活动不能修改活动期数）
									</if>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>活动名称</label></label>
									<input type="text" class="col-sm-3" name="name" value="{pigcms{$now_activity.name}" />
									<span class="form_tips">不超过50个字！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>活动标题</label></label>
									<input type="text" class="col-sm-3" name="title" value="{pigcms{$now_activity.title}" />
									<span class="form_tips">简短的描述一下您的活动</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone"><span class="required" style="color:red;">*</span>活动类型</label></label>
									<span class="form_tips" style="margin-left:0px;">{pigcms{$now_activity.type_txt}&nbsp;&nbsp;&nbsp;（活动类型不允许修改）</span>
								</div>
								<if condition="$now_activity['type'] eq 1">
									<div id="product_price">
										<div class="form-group">
											<label class="col-sm-1"><label for="price">商品价格</label></label>
											<if condition="$now_activity['status'] eq 0">
												<input class="col-sm-1" size="10" name="price" id="price" type="text" value=""/>
												<span class="form_tips">单位元，不能有小数，活动开始后不能修改</span>
											<else/>
												<span class="form_tips" style="margin-left:0px;"><strong style="color:red;font-size:14px;">￥{pigcms{$now_activity.price}</strong>&nbsp;&nbsp;&nbsp;&nbsp;（活动已开始，不允许修改）</span>
											</if>
										</div>
									</div>
								</if>
								<div class="form-group">
									<label class="col-sm-1">上传图片</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
									<span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！<php>if(!empty($config['activity_pic_width'])){$activity_pic_width=explode(',',$config['activity_pic_width']);echo '图片宽度建议为：'.$activity_pic_width[0].'px，';}</php><php>if(!empty($config['activity_pic_height'])){$activity_pic_height=explode(',',$config['activity_pic_height']);echo '高度建议为：'.$activity_pic_height[0].'px';}</php></span>
								</div>
								<div id="image_div">
									<div class="form-group">
										<label class="col-sm-1">图片预览</label>
										<div id="upload_pic_box">
											<ul id="upload_pic_ul">
												<volist name="now_activity['pic_arr']" id="vo">
													<li class="upload_pic_li"><img src="{pigcms{$vo.url}"/><input type="hidden" name="pic[]" value="{pigcms{$vo.title}"/><br/><a href="#" onclick="deleteImage('{pigcms{$vo.title}',this);return false;">[ 删除 ]</a></li>
												</volist>
											</ul>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="info">活动详情</label></label>
									<textarea  class="col-sm-3" id="info" name="info" style="height:125px" >{pigcms{$now_activity.info}</textarea>
								</div>				
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>活动商品数量</label></label>
									<if condition="$now_activity['type'] eq 1">
										<span class="form_tips" style="margin-left:0px;">{pigcms{$now_activity.all_count}</span>
									<else/>
										<input class="col-sm-1" size="10" name="all_count" id="all_count" type="text" value="{pigcms{$now_activity.all_count}"/>
										<span class="form_tips">一元夺宝只能设置一份</span>
									</if>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums"><span class="required" style="color:red;">*</span>参与活动限制</label></label>
									<if condition="$now_activity['type'] eq 1">
										<span class="form_tips" style="margin-left:0px;">有偿（金钱）</span>
									<else/>
										<div class="radio">
											<label>
												<input name="activity_limit" value="1" type="radio" class="ace" <if condition="$now_activity['money'] neq 0">checked="checked"</if>/>
												<span class="lbl" style="z-index: 1">有偿（金钱）</span>
											</label>
											<label>
												<input name="activity_limit" value="0" type="radio" class="ace" <if condition="$now_activity['money'] eq 0">checked="checked"</if>/>
												<span class="lbl" style="z-index: 1">无偿（积分）</span>
											</label>
										</div>
									</if>
								</div>
								<div id="limit_money" <if condition="$now_activity['money'] eq 0">style="display:none;"</if>>
									<div class="form-group">
										<label class="col-sm-1"><label for="money">消耗金钱</label></label>
										<if condition="$now_activity['type'] eq 1">
											<span class="form_tips" style="margin-left:0px;"><strong style="color:red;font-size:14px;">￥1</strong>&nbsp;&nbsp;&nbsp;&nbsp;“一元夺宝”只能设置为 一元</span>
										<else/>
											<input class="col-sm-1" size="10" name="money" id="money" type="text" value="{pigcms{$now_activity.money}"/>
											<span class="form_tips">“一元夺宝”只能设置为 一元！只能整数</span>
										</if>
									</div>
								</div>
								<div id="limit_score" <if condition="$now_activity['money'] neq 0">style="display:none;"</if>>
									<div class="form-group">
										<label class="col-sm-1"><label for="mer_score">商家积分</label></label>
										<input class="col-sm-1" size="10" name="mer_score" id="mer_score" type="text" value="{pigcms{$now_activity.mer_score}"/>
										<span class="form_tips">备注：用户消耗商家积分除以 {pigcms{$config.activity_score_scale} 的平台积分 也可参与活动</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums"><span class="required" style="color:red;">*</span>活动状态</label></label>
									<if condition="$now_activity['type'] eq 1 && $now_activity['status'] neq 0 && $now_activity['part_count'] neq 0">
										<span class="form_tips" style="margin-left:0px;">一元夺宝活动开始后，不允许更改状态</span>
									<else/>
										<div class="radio">
											<if condition="$now_activity['status'] eq 0">
												<label>
													<input name="status" value="0" type="radio" class="ace" checked="checked"/>
													<span class="lbl" style="z-index: 1">待审核</span>
												</label>
												<label>
													<input name="status" value="1" type="radio" class="ace"/>
													<span class="lbl" style="z-index: 1">已审核</span>
												</label>									
											<else/>
												<label>
													<input name="status" value="1" type="radio" class="ace" <php>if($now_activity['status'] == 1){ echo 'checked="checked"';}</php>/>
													<span class="lbl" style="z-index: 1">进行中</span>
												</label>
												<label>
													<input name="status" value="2" type="radio" class="ace" <php>if($now_activity['status'] == 2){ echo 'checked="checked"';}</php>/>
													<span class="lbl" style="z-index: 1">已结束</span>
												</label>
											</if>
										</div>
									</if>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">首页排序</label></label>
									<input type="text" class="col-sm-1" name="index_sort" value="{pigcms{$now_activity.index_sort}" />
									<span class="form_tips">排序值越高，首页排序越前</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">首页广告图</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectIndexImage">上传图片</a>
									<span class="form_tips"><if condition="$now_activity['index_pic']"><font color="red">有图</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</if>您必须上传一张首页广告图片，网站首页中才能显示该活动！尺寸建议为 435宽*186高px</span>
									<input type="hidden" name="index_pic" id="index_pic" value="{pigcms{$now_activity.index_pic}"/>
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
#upload_pic_box{margin-top:20px;height:150px;}
#upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
#upload_pic_box img{width:100px;height:70px;}
</style>
<script type="text/javascript" src="{pigcms{$static_public}js/date/WdatePicker.js"></script>
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K) {
	var content_editor = K.create("#info",{
		width:'702px',
		height:'260px',
		resizeType : 1,
		allowPreviewEmoticons:false,
		allowImageUpload : true,
		filterMode: true,
		autoHeightMode : true,
		afterCreate : function() {
			this.loadPlugin('autoheight');
		},
		items : [
			'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'table'
		],
		emoticonsPath : './static/emoticons/',
		uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=activity/content",
		cssPath : "{pigcms{$static_path}css/group_editor.css"
	});
	
	var editor = K.editor({
		allowFileManager : true
	});
	K('#J_selectImage').click(function(){
		if($('.upload_pic_li').size() >= 5){
			alert('最多上传5个图片！');
			return false;
		}
		editor.uploadJson = "{pigcms{:U('Activity/ajax_upload_pic')}";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImage(\''+title+'\',this);return false;">[ 删除 ]</a></li>');
					$('#image_div').show();
					editor.hideDialog();
				}
			});
		});
	});
	K('#J_selectIndexImage').click(function(){
		editor.uploadJson = "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=activity/index_pic";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#index_pic').val(url.replace('/upload/activity/index_pic/',''));
					editor.hideDialog();
					alert('图片上传成功');
				}
			});
		});
	});
	
	$('#activity_type').change(function(){
		if($(this).val() == 1){
			$('#all_count,#money').val('1').prop('readonly',true);
			$('input[name="activity_limit"][value="1"]').prop('checked',true);
			$('#limit_score').hide();
			$('#limit_money').show();
			$('#product_price').show();
		}else{
			$('#all_count,#money').prop('readonly',false);
			$('#product_price').hide();
		}
	});
	$('input[name="activity_limit"]').change(function(){
		if($('#activity_type').val() == 1){
			alert('一元夺宝只允许使用“有偿（金钱）”');
			$('input[name="activity_limit"][value="1"]').prop('checked',true);
		}
		if($('input[name="activity_limit"]:checked').val() == 1){
			$('#limit_score').hide();
			$('#limit_money').show();
		}else{
			$('#limit_money').hide();
			$('#limit_score').show();
		}
	});
	
	$('#add_form').submit(function(){
		content_editor.sync();
		$('#save_btn').prop('disabled',true);
		$.post("{pigcms{:U('Activity/frame_edit',array('id'=>$now_activity['pigcms_id']))}",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.reload();
			}else{
				alert(result.info);
			}
			$('#save_btn').prop('disabled',false);
		})
		return false;
	});
});
function deleteImage(path,obj){
	$(obj).closest('.upload_pic_li').remove();
}
</script>
<include file="Public:footer"/>