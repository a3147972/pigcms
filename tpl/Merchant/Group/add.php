<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Group/index')}">{pigcms{$config.group_alias_name}管理</a>
			</li>
			<li class="active">添加商品</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
				#levelcoupon select {width:150px;margin-right: 20px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">				
							<li class="active">
								<a data-toggle="tab" href="#basicinfo">基本信息</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtstore">选择店铺</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtintro">{pigcms{$config.group_alias_name}详情</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtimage">商品图片</a>
							</li>
							<if condition="!empty($levelarr)">
							<li>
								<a data-toggle="tab" href="#levelcoupon">会员优惠</a>
							</li>
							</if>
							<li>
								<a data-toggle="tab" href="#relpackages">套餐设置</a>
							</li>
							<li style="display:none;">
								<a data-toggle="tab" href="#txtnum">数量设置</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
						<div class="tab-content">				
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1">商品标题：</label>
									<input class="col-sm-3" maxlength="100" name="name" type="text" value="" /><span class="form_tips">商品的介绍标题，100字段以内,首页和列表页将显示。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">商品名称：</label>
									<input class="col-sm-3" maxlength="30" name="s_name" type="text" value="" /><span class="form_tips">必填。在订单页显示此名称！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">商品简介：</label>
									<textarea class="col-sm-3" rows="5" name="intro"></textarea><span class="form_tips">商品的简短介绍，建议为100字以下。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">关键词：</label>
									<input class="col-sm-3" maxlength="30" name="keywords" type="text" value="" id="keywords"/><span class="form_tips">选填。<font color="red">（用空格分隔不同的关键词，最多5个）</font>，用户在微信将按此值搜索！</span> <a href="javascript:;" id="get_key_btn">按商品名称获取</a>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1">原价：</label>
									<input class="col-sm-1" maxlength="100" name="old_price" type="text" value="" /><span class="form_tips">必填。最多支持1位小数</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">{pigcms{$config.group_alias_name}价：</label>
									<input class="col-sm-1" maxlength="30" name="price" type="text" value="" /><span class="form_tips">必填。最多支持1位小数</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">微信优惠：</label>
									<input class="col-sm-1" maxlength="30" name="wx_cheap" type="text" value="" /><span class="form_tips">单位元，最多支持1位小数，不填则不显示微信优惠！实际购买价=（{pigcms{$config.group_alias_name}价-微信优惠）</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1">{pigcms{$config.group_alias_name}开始时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])}',vel:'begin_time'})" value="{pigcms{:date('Y年m月d日 H时i分s秒',$_SERVER['REQUEST_TIME'])}"/>
									<input name="begin_time" id="begin_time" type="hidden" value="{pigcms{:date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])}"/>
									<span class="form_tips">到了{pigcms{$config.group_alias_name}开始时间，商品才会显示！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">{pigcms{$config.group_alias_name}结束时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',strtotime('+1 day'))}',vel:'end_time'})" value="{pigcms{:date('Y年m月d日 H时i分s秒',strtotime('+1 day'))}"/>
									<input name="end_time" id="end_time" type="hidden" value="{pigcms{:date('Y-m-d H:i:s',strtotime('+1 day'))}"/>
									<span class="form_tips">超过{pigcms{$config.group_alias_name}结束时间，会结束{pigcms{$config.group_alias_name}！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">{pigcms{$config.group_alias_name}券有效期：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',strtotime('+7 day'))}',vel:'deadline_time'})" value="{pigcms{:date('Y年m月d日 H时i分s秒',strtotime('+7 day'))}"/>
									<input name="deadline_time" id="deadline_time" type="hidden" value="{pigcms{:date('Y-m-d H:i:s',strtotime('+7 day'))}"/><span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">使用时间限制：</label>
									<select name="is_general" class="col-sm-2">
										<option value="0">周末、法定节假日通用</option>
										<option value="1">周末不能使用</option>
										<option value="2">法定节假日不能使用</option>
									</select>
								</div>
							</div>
							<div id="txtstore" class="tab-pane">
								<div class="form-group">
									<volist name="store_list" id="vo">
										<div class="radio">
											<label>
												<input class="paycheck ace" type="checkbox" name="store[]" value="{pigcms{$vo.store_id}" id="store_{pigcms{$vo.store_id}" checked="checked"/>
												<span class="lbl"><label for="store_{pigcms{$vo.store_id}">{pigcms{$vo.name} - {pigcms{$vo.area_name}-{pigcms{$vo.adress}</label></span>
											</label>
										</div>
									</volist>
								</div>
							</div>
							<div id="txtintro" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">{pigcms{$config.group_alias_name}类型：</label>
									<select name="tuan_type" class="col-sm-1">
										<option value="0">{pigcms{$config.group_alias_name}券</option>
										<option value="1">代金券</option>
										<option value="2">实物</option>
									</select>
									<span class="form_tips">如果是{pigcms{$config.group_alias_name}券或代金券，则会生成券密码；如果是实物，则需要填写快递单号</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">选择分类：</label>
									<select id="choose_catfid" name="cat_fid" class="col-sm-1" style="margin-right:10px;">
										<volist name="f_category_list" id="vo">
											<option value="{pigcms{$vo.cat_id}">{pigcms{$vo.cat_name}</option>
										</volist>
									</select>
									<select id="choose_catid" name="cat_id" class="col-sm-1" style="margin-right:10px;">
										<volist name="s_category_list" id="vo">
											<option value="{pigcms{$vo.cat_id}">{pigcms{$vo.cat_name}</option>
										</volist>
									</select>
								</div>
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="custom_html_tips">
									<div class="form-group" style="margin-top:10px;color:red;">以下为主分类设定的特殊字段，不同分类字段不同，请选择。</div>
									<div id="custom_html">{pigcms{$custom_html}</div>
								</div>
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;" id="cue_html_tips">
									<div class="form-group" style="margin-top:30px;color:red;">以下为主分类设定的 购买须知填写项，请填写。</div>
									<div id="cue_html">{pigcms{$cue_html}</div>
								</div>
								<div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label class="col-sm-1">&nbsp;</label><a href="javascript:;" id="editor_plan_btn">插入套餐表格</a></div>
								<div class="form-group" >
									<label class="col-sm-1">本单详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
									<textarea name="content" id="content" style="width:702px;"></textarea>
								</div>
							</div>
							<div id="txtimage" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">上传图片</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
									<span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！<php>if(!empty($config['group_pic_width'])){$group_pic_width=explode(',',$config['group_pic_width']);echo '图片宽度建议为：'.$group_pic_width[0].'px，';}</php><php>if(!empty($config['group_pic_height'])){$group_pic_height=explode(',',$config['group_pic_height']);echo '高度建议为：'.$group_pic_height[0].'px';}</php></span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">图片预览</label>
									<div id="upload_pic_box">
										<ul id="upload_pic_ul"></ul>
									</div>
								</div>
							</div>
							<if condition="!empty($levelarr)">
							<div id="levelcoupon" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" style="color:red;width:95%;">说明：必须设置一个会员等级优惠类型和优惠类型对应的数值，我们将结合优惠类型和所填的数值来计算该商品会员等级的优惠的幅度！</label>
								</div>
							    <volist name="levelarr" id="vv">
								  <div class="form-group">
								    <input  name="leveloff[{pigcms{$vv['level']}][lid]" type="hidden" value="{pigcms{$vv['id']}"/>
								    <input  name="leveloff[{pigcms{$vv['level']}][lname]" type="hidden" value="{pigcms{$vv['lname']}"/>
									<label class="col-sm-1">{pigcms{$vv['lname']}：</label>
									优惠类型：&nbsp;
									<select name="leveloff[{pigcms{$vv['level']}][type]">
										<option value="0">无优惠</option>
										<option value="1">百分比（%）</option>
										<option value="2">立减</option>
									</select>
									<input name="leveloff[{pigcms{$vv['level']}][vv]" type="text" placeholder="请填写一个优惠值数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
								</div>
								</volist>
							</div>
							</if>
							<div id="relpackages" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" style="color:red;width:95%;">说明：一个团购商品只能参与一个套餐！</label>
								</div>
							  <div class="form-group">
									<label class="col-sm-1">本{pigcms{$config.group_alias_name}套餐标签：</label>
									<input class="col-sm-2" maxlength="30" name="tagname" type="text" value="" />
									<if condition="!empty($mpackagelist)">
									<label class="col-sm-1" style="margin-left:20px;">选择加入套餐：</label>
									<select name="packageid" style="width:300px;">
									<option value="0">不加入任何套餐</option>
									<volist name="mpackagelist" id="vo">
									  <option value="{pigcms{$vo['id']}">{pigcms{$vo['title']}</option>
									</volist>
									</select>
									<else />
									<label class="col-sm-2" style="color:red;">您还没有套餐可选，<a href="{pigcms{:U('Group/mpackageadd')}">请点击这里去新建吧</a></label>
									</if>
									<span class="form_tips"></span>
							   </div>
							</div>

							<div id="txtnum" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">成功{pigcms{$config.group_alias_name}人数要求：</label>
									<input class="col-sm-1" maxlength="20" name="success_num" type="text" value="1" /><span class="form_tips">最少需要多少人购买才算{pigcms{$config.group_alias_name}成功。</span>
								</div>
								<div class="form-group" style="display:none;">
									<label class="col-sm-1">虚拟已购买人数：</label>
									<input class="col-sm-1" maxlength="20" name="virtual_num" type="text" value="0" /><span class="form_tips">前台购买人数会显示[ 虚拟购买人数+真实购买人数 ]</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">商品总数量：</label>
									<input class="col-sm-1" maxlength="20" name="count_num" type="text" value="0" /><span class="form_tips">0表示不限制，否则产品会出现“已卖光”状态</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">ID最多购买数量：</label>
									<input class="col-sm-1" maxlength="20" name="once_max" type="text" value="0" /><span class="form_tips">一个ID最多购买数量，0表示不限制</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">一次最少购买数量：</label>
									<input class="col-sm-1" maxlength="20" name="once_min" type="text" value="1" /><span class="form_tips">购买数量低于此设定的不允许参团</span>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit" id="save_btn">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>
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
	var content_editor = K.create("#content",{
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
		uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=group/content",
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
		editor.uploadJson = "{pigcms{:U('Group/ajax_upload_pic')}";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImage(\''+title+'\',this);return false;">[ 删除 ]</a></li>');
					editor.hideDialog();
				}
			});
		});
	});
	
	$('#choose_catfid').change(function(){
		$.getJSON("{pigcms{:U('Group/ajax_get_category')}",{cat_fid:$(this).val()},function(result){
			if(result.error == 0){
				var catid_html = '';
				$.each(result.cat_list,function(i,item){
					catid_html += '<option value="'+item.cat_id+'">'+item.cat_name+'</option>';
				});
				$('#choose_catid').html(catid_html);
				if(result.custom_html == ''){
					$('#custom_html_tips').hide();
				}else{
					$('#custom_html_tips').show();
				}
				if(result.cue_html == ''){
					$('#cue_html_tips').hide();
				}else{
					$('#cue_html_tips').show();
				}
				$('#custom_html').html(result.custom_html);
				$('#cue_html').html(result.cue_html);
			}else{
				// $('#choose_catid').html('<option value="0">请选择其他分类</option>');
				
				alert(result.msg);
				$('#choose_catfid option').eq(0).prop('selected',true);
				$('#choose_catfid').trigger('change');
			}
		});
	});
	$('#add_form').submit(function(){
		content_editor.sync();
		$('#save_btn').prop('disabled',true);
		$.post("{pigcms{:U('Group/add')}",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "{pigcms{:U('Group/index')}";
			}else{
				alert(result.info);
			}
			$('#save_btn').prop('disabled',false);
		})
		return false;
	});
	
	$('#editor_plan_btn').click(function(){
		var dialog = K.dialog({
				width : 200,
				title : '输入欲插入表格行数',
				body : '<div style="margin:10px;"><input id="edit_plan_input" style="width:100%;"/></div>',
				closeBtn : {
						name : '关闭',
						click : function(e) {
							dialog.remove();
						}
				},
				yesBtn : {
						name : '确定',
						click : function(e){
							var value = $('#edit_plan_input').val();
							if(!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value)){
								alert('请输入数字！');
								return false;
							}
							value = parseInt(value);
							var html = '<table class="deal-menu">';
							html += '<tr><th class="name" colspan="2">套餐内容</th><th class="price">单价</th><th class="amount">数量/规格</th><th class="subtotal">小计</th></tr>';
							for(var i=0;i<value;i++){
								html += '<tr><td class="name" colspan="2">内容'+(i+1)+'</td><td class="price">¥</td><td class="amount">1份</td><td class="subtotal">¥</td></tr>';
							}
							html += '</table>';
							html += '<p class="deal-menu-summary">价值: <span class="inline-block worth">¥</span>{pigcms{$config.group_alias_name}价： <span class="inline-block worth price">¥</span></p><br/><br/>介绍...';
							content_editor.appendHtml(html);
							
							dialog.remove();
						}
				},
				noBtn : {
						name : '取消',
						click : function(e) {
							dialog.remove();
						}
				}
		});
	});
	
	$('#get_key_btn').click(function(){
		var s_name = $('input[name="s_name"]');
		s_name.val($.trim(s_name.val()));
		$('#keywords').val($.trim($('#keywords').val()));
		if(s_name.val().length == 0){
			alert('请先填写商品名称！');
			s_name.focus();
		}else if($('#keywords').val().length != 0){
			alert('请先删除您填写的关键词！');
			$('#keywords').focus();
		}else{
			$.get("{pigcms{:U('Index/Scws/ajax_getKeywords')}",{title:s_name.val()},function(result){
				result = $.parseJSON(result);
				if(result.num == 0){
					alert('您的商品名称没有提取到关键词，请手动填写关键词！');
					$('#keywords').focus();
				}else{
					$('#keywords').val(result.list.join(' ')).focus();
				}
			});
		}
	});
});
function deleteImage(path,obj){
	$.post("{pigcms{:U('Group/ajax_del_pic')}",{path:path});
	$(obj).closest('.upload_pic_li').remove();
}
</script>
<include file="Public:footer"/>