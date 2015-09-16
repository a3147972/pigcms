<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-empire"></i>
				商家推广
			</li>
			<li class="active"><a href="{pigcms{:U('Activity/index')}">平台活动列表</a></li>
			<li class="active">添加活动</li>
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
									<select name="activity_term" class="col-sm-3">
										<volist name="activity_term_list" id="vo">
											<option value="{pigcms{$vo.activity_id}">{pigcms{$vo.name} | 活动时间（{pigcms{$vo.begin_time|date='Y-m-d H:i',###} 至 {pigcms{$vo.end_time|date='Y-m-d H:i',###}）</option>
										</volist>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>活动名称</label></label>
									<input type="text" class="col-sm-3" name="name" value="" />
									<span class="form_tips">不超过50个字！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>活动标题</label></label>
									<input type="text" class="col-sm-3" name="title" value="" />
									<span class="form_tips">简短的描述一下您的活动</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone"><span class="required" style="color:red;">*</span>活动类型</label></label>
									<select id="activity_type" name="type" class="col-sm-1">
										<option value="1">一元夺宝</option>
										<option value="2">优惠券</option>
										<option value="3">秒杀</option>
										<option value="4">红包</option>
										<option value="5">卡券</option>
									</select>
								</div>
								<div id="product_price">
									<div class="form-group">
										<label class="col-sm-1"><label for="price">商品价格</label></label>
										<input class="col-sm-1" size="10" name="price" id="price" type="text" value=""/>
										<span class="form_tips">单位元，不能有小数，活动开始后不能修改</span>
									</div>
								</div>
					
								<div class="form-group">
									<label class="col-sm-1">上传图片</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
									<span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！<php>if(!empty($config['activity_pic_width'])){$activity_pic_width=explode(',',$config['activity_pic_width']);echo '图片宽度建议为：'.$activity_pic_width[0].'px，';}</php><php>if(!empty($config['activity_pic_height'])){$activity_pic_height=explode(',',$config['activity_pic_height']);echo '高度建议为：'.$activity_pic_height[0].'px';}</php></span>
								</div>
								<div id="image_div" style="display:none;">
									<div class="form-group">
										<label class="col-sm-1">图片预览</label>
										<div id="upload_pic_box">
											<ul id="upload_pic_ul"></ul>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="info">活动详情</label></label>
									<textarea  class="col-sm-3" id="info" name="info" style="height:125px" ></textarea>
								</div>				
								<div class="form-group">
									<label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>活动商品数量</label></label>
									<input class="col-sm-1" size="10" name="all_count" id="all_count" type="text" value="1" readonly="readonly"/>
									<span class="form_tips">一元夺宝只能设置一份</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums"><span class="required" style="color:red;">*</span>参与活动限制</label></label>
									<div class="radio">
										<label>
											<input name="activity_limit" value="1" type="radio" class="ace" checked="checked"/>
											<span class="lbl" style="z-index: 1">有偿（金钱）</span>
										</label>
										<label>
											<input name="activity_limit" value="0" type="radio" class="ace" />
											<span class="lbl" style="z-index: 1">无偿（积分）</span>
										</label>
									</div>
								</div>
								<div id="limit_money">
									<div class="form-group">
										<label class="col-sm-1"><label for="money">消耗金钱</label></label>
										<input class="col-sm-1" size="10" name="money" id="money" type="text" value="1" readonly="readonly"/>
										<span class="form_tips">“一元夺宝”只能设置为 一元！只能整数</span>
									</div>
								</div>
								<div id="limit_score" style="display:none;">
									<div class="form-group">
										<label class="col-sm-1"><label for="mer_score">商家积分</label></label>
										<input class="col-sm-1" size="10" name="mer_score" id="mer_score" type="text" value=""/>
										<span class="form_tips">备注：用户消耗商家积分除以 {pigcms{$config.activity_score_scale} 的平台积分 也可参与活动</span>
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
		$.post("{pigcms{:U('Activity/add')}",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "{pigcms{:U('Activity/index')}";
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