<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css">
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
<title><?php echo ($config["site_name"]); ?> - 商家中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css">
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script>


<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script>

<!-- ace scripts -->
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script>

<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script>
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
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="<?php echo ($_GET["system_file"]); ?>?c=Group&a=product">商品列表</a>
			</li>
			<li class="active">编辑商品</li>
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
								<a data-toggle="tab" href="#txtintro"><?php echo ($config["group_alias_name"]); ?>详情</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtimage">商品图片</a>
							</li>
						  <?php if(!empty($levelarr)): ?><li>
								<a data-toggle="tab" href="#levelcoupon">会员优惠</a>
							</li><?php endif; ?>
							<?php if(!empty($mpackagelist)): ?><li>
								<a data-toggle="tab" href="#relpackages">套餐设置</a>
							</li><?php endif; ?>
							<li>
								<a data-toggle="tab" href="#txtorder">状态设置</a>
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
									<input class="col-sm-3" maxlength="100" name="name" type="text" value="<?php echo ($now_group["name"]); ?>" /><span class="form_tips">商品的介绍标题，100字段以内,首页和列表页将显示。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">商品名称：</label>
									<input class="col-sm-3" maxlength="30" name="s_name" type="text" value="<?php echo ($now_group["s_name"]); ?>" /><span class="form_tips">必填。在订单页显示此名称！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">商品简介：</label>
									<textarea class="col-sm-3" rows="5" name="intro"><?php echo ($now_group["intro"]); ?></textarea><span class="form_tips">商品的简短介绍，建议为100字以下。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">关键词：</label>
									<input class="col-sm-3" maxlength="30" name="keywords" type="text" value="<?php echo ($keywords); ?>" id="keywords"/><span class="form_tips">选填。<font color="red">（用空格分隔不同的关键词，最多5个）</font>，用户在微信将按此值搜索！</span> <a href="javascript:;" id="get_key_btn">按商品名称获取</a>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1">原价：</label>
									<input class="col-sm-1" maxlength="100" name="old_price" type="text" value="<?php echo (floatval($now_group["old_price"])); ?>" /><span class="form_tips">必填。最多支持1位小数</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><?php echo ($config["group_alias_name"]); ?>价：</label>
									<input class="col-sm-1" maxlength="30" name="price" type="text" value="<?php echo (floatval($now_group["price"])); ?>" /><span class="form_tips">必填。最多支持1位小数</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">微信优惠：</label>
									<input class="col-sm-1" maxlength="30" name="wx_cheap" type="text" value="<?php echo (floatval($now_group["wx_cheap"])); ?>" /><span class="form_tips">单位元，最多支持1位小数，不填则不显示微信优惠！实际购买价=（<?php echo ($config["group_alias_name"]); ?>价-微信优惠）</span>
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1"><?php echo ($config["group_alias_name"]); ?>开始时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'<?php echo date('Y-m-d H:i:s',$now_group['begin_time']);?>',vel:'begin_time'})" value="<?php echo date('Y年m月d日 H时i分s秒',$now_group['begin_time']);?>"/>
									<input name="begin_time" id="begin_time" type="hidden" value="<?php echo date('Y-m-d H:i:s',$now_group['begin_time']);?>"/>
									<span class="form_tips">到了<?php echo ($config["group_alias_name"]); ?>开始时间，商品才会显示！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><?php echo ($config["group_alias_name"]); ?>结束时间：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'<?php echo date('Y-m-d H:i:s',$now_group['end_time']);?>',vel:'end_time'})" value="<?php echo date('Y年m月d日 H时i分s秒',$now_group['end_time']);?>"/>
									<input name="end_time" id="end_time" type="hidden" value="<?php echo date('Y-m-d H:i:s',$now_group['end_time']);?>"/>
									<span class="form_tips">超过<?php echo ($config["group_alias_name"]); ?>结束时间，会结束<?php echo ($config["group_alias_name"]); ?>！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><?php echo ($config["group_alias_name"]); ?>券有效期：</label>
									<input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'<?php echo date('Y-m-d H:i:s',$now_group['deadline_time']);?>',vel:'deadline_time'})" value="<?php echo date('Y年m月d日 H时i分s秒',$now_group['deadline_time']);?>"/>
									<input name="deadline_time" id="deadline_time" type="hidden" value="<?php echo date('Y-m-d H:i:s',$now_group['deadline_time']);?>"/><span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">使用时间限制：</label>
									<select name="is_general" class="col-sm-2">
										<option value="0" <?php if($now_group['is_general'] == 0): ?>selected="selected"<?php endif; ?>>周末、法定节假日通用</option>
										<option value="1" <?php if($now_group['is_general'] == 1): ?>selected="selected"<?php endif; ?>>周末不能使用</option>
										<option value="2" <?php if($now_group['is_general'] == 2): ?>selected="selected"<?php endif; ?>>法定节假日不能使用</option>
									</select>
								</div>
							</div>
							<div id="txtstore" class="tab-pane">
								<div class="form-group">
									<?php if(is_array($store_list)): $i = 0; $__LIST__ = $store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="radio">
											<label>
												<input class="paycheck ace" type="checkbox" name="store[]" value="<?php echo ($vo["store_id"]); ?>" id="store_<?php echo ($vo["store_id"]); ?>" <?php if(in_array($vo['store_id'],$store_arr)): ?>checked="checked"<?php endif; ?>/>
												<span class="lbl"><label for="store_<?php echo ($vo["store_id"]); ?>"><?php echo ($vo["name"]); ?> - <?php echo ($vo["area_name"]); ?>-<?php echo ($vo["adress"]); ?></label></span>
											</label>
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
							<div id="txtintro" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1"><?php echo ($config["group_alias_name"]); ?>类型：</label>
									<select name="tuan_type" class="col-sm-1">
										<option value="0" <?php if($now_group['tuan_type'] == 0): ?>selected="selected"<?php endif; ?>><?php echo ($config["group_alias_name"]); ?>券</option>
										<option value="1" <?php if($now_group['tuan_type'] == 1): ?>selected="selected"<?php endif; ?>>代金券</option>
										<option value="2" <?php if($now_group['tuan_type'] == 2): ?>selected="selected"<?php endif; ?>>实物</option>
									</select>
									<span class="form_tips">如果是<?php echo ($config["group_alias_name"]); ?>券或代金券，则会生成券密码；如果是实物，则需要填写快递单号</span>
								</div>
								<?php if(!($now_group['sale_count'] > 0)): ?><div class="form-group">
									<label class="col-sm-1">选择分类：</label>
									<select id="choose_catfid" name="cat_fid" class="col-sm-1" style="margin-right:10px;">
										<?php if(is_array($f_category_list)): $i = 0; $__LIST__ = $f_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>" <?php if($now_group['cat_fid'] == $vo['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
									<select id="choose_catid" name="cat_id" class="col-sm-1" style="margin-right:10px;">
										<?php if(is_array($s_category_list)): $i = 0; $__LIST__ = $s_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cat_id"]); ?>" <?php if($now_group['cat_id'] == $vo['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
								
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px; <?php if(!$custom_html): ?>display:none;<?php endif; ?>" id="custom_html_tips">
									<div class="form-group" style="margin-top:10px;color:red;">以下为主分类设定的特殊字段，不同分类字段不同，请选择。</div>
									<div id="custom_html"><?php if($custom_html): echo ($custom_html); endif; ?></div>
								</div>
								
								<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px; <?php if(!$cue_html): ?>display:none;<?php endif; ?>" id="cue_html_tips">
									<div class="form-group" style="margin-top:30px;color:red;">以下为主分类设定的 购买须知填写项，请填写。</div>
									<div id="cue_html"><?php if($cue_html): echo ($cue_html); endif; ?></div>
								</div>
								<?php else: ?>
								  	<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;">
									<div class="form-group" style="margin-top:10px;color:red;">此团购已经有人下单了，不可再更改它的分类及其对应内容！</div>
									<input type="hidden" name="noedittype" value="yes">
								</div><?php endif; ?>
								<div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label class="col-sm-1">&nbsp;</label><a href="javascript:;" id="editor_plan_btn">插入套餐表格</a></div>
								<div class="form-group" >
									<label class="col-sm-1">本单详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
									<textarea name="content" id="content" style="width:702px;"><?php echo ($now_group["content"]); ?></textarea>
								</div>
							</div>
							<div id="txtimage" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">上传图片</label>
									<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
									<span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">图片预览</label>
									<div id="upload_pic_box">
										<ul id="upload_pic_ul">
											<?php if(is_array($now_group['pic_arr'])): $i = 0; $__LIST__ = $now_group['pic_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="upload_pic_li"><img src="<?php echo ($vo["url"]); ?>"/><input type="hidden" name="pic[]" value="<?php echo ($vo["title"]); ?>"/><br/><a href="#" onclick="deleteImage('<?php echo ($vo["title"]); ?>',this);return false;">[ 删除 ]</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
								</div>
							</div>
							<?php if(!empty($levelarr)): ?><div id="levelcoupon" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" style="color:red;width:95%;">说明：必须设置一个会员等级优惠类型和优惠类型对应的数值，我们将结合优惠类型和所填的数值来计算该商品会员等级的优惠的幅度！</label>
								</div>
							    <?php if(is_array($levelarr)): $i = 0; $__LIST__ = $levelarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><div class="form-group">
								    <input  name="leveloff[<?php echo ($vv['level']); ?>][lid]" type="hidden" value="<?php echo ($vv['id']); ?>"/>
								    <input  name="leveloff[<?php echo ($vv['level']); ?>][lname]" type="hidden" value="<?php echo ($vv['lname']); ?>"/>
									<label class="col-sm-1"><?php echo ($vv['lname']); ?>：</label>
									优惠类型：&nbsp;
									<select name="leveloff[<?php echo ($vv['level']); ?>][type]">
										<option value="0">无优惠</option>
										<option value="1" <?php if($vv['type'] == 1): ?>selected="selected"<?php endif; ?>>百分比（%）</option>
										<option value="2" <?php if($vv['type'] == 2): ?>selected="selected"<?php endif; ?>>立减</option>
									</select>
									<input name="leveloff[<?php echo ($vv['level']); ?>][vv]" type="text" value="<?php echo ($vv['vv']); ?>" placeholder="请填写一个优惠值数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
							<div id="relpackages" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" style="color:red;width:95%;">说明：一个团购商品只能参与一个套餐！</label>
								</div>
							  <div class="form-group">
							    <?php if(!empty($mpackagelist)): ?><label class="col-sm-1">本<?php echo ($config["group_alias_name"]); ?>套餐标签：</label>
									<input class="col-sm-2" maxlength="30" name="tagname" type="text" value="<?php echo ($now_group['tagname']); ?>" />
									<label class="col-sm-1" style="margin-left:20px;">选择加入套餐：</label>
									<select name="packageid" style="width:300px;">
									<option value="0">不加入任何套餐</option>
									<?php if(is_array($mpackagelist)): $i = 0; $__LIST__ = $mpackagelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" <?php if($vo['id'] == $now_group['packageid']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
									<?php else: ?>
									<label class="col-sm-1" style="color:red;width:95%;">商家还没有套餐可选！</label><?php endif; ?>
									<span class="form_tips"></span>
							   </div>
							</div>
							<div id="txtnum" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">成功<?php echo ($config["group_alias_name"]); ?>人数要求：</label>
									<input class="col-sm-1" maxlength="20" name="success_num" type="text" value="<?php echo ($now_group["success_num"]); ?>" /><span class="form_tips">最少需要多少人购买才算<?php echo ($config["group_alias_name"]); ?>成功。</span>
								</div>
								<div class="form-group" style="display:none;">
									<label class="col-sm-1">虚拟已购买人数：</label>
									<input class="col-sm-1" maxlength="20" name="virtual_num" type="text" value="<?php echo ($now_group["virtual_num"]); ?>" /><span class="form_tips">前台购买人数会显示[ 虚拟购买人数+真实购买人数 ]</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">商品总数量：</label>
									<input class="col-sm-1" maxlength="20" name="count_num" type="text" value="<?php echo ($now_group["count_num"]); ?>" /><span class="form_tips">0表示不限制，否则产品会出现“已卖光”状态</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">ID最多购买数量：</label>
									<input class="col-sm-1" maxlength="20" name="once_max" type="text" value="<?php echo ($now_group["once_max"]); ?>" /><span class="form_tips">一个ID最多购买数量，0表示不限制</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">一次最少购买数量：</label>
									<input class="col-sm-1" maxlength="20" name="once_min" type="text" value="<?php echo ($now_group["once_min"]); ?>" /><span class="form_tips">购买数量低于此设定的不允许参团</span>
								</div>
							</div>
							<div id="txtorder" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1">手动排序：</label>
									<input class="col-sm-1" maxlength="20" name="sort" type="text" value="<?php echo ($now_group["sort"]); ?>" /><span class="form_tips">数值越高，排序越前。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">首页排序：</label>
									<input class="col-sm-1" maxlength="20" name="index_sort" type="text" value="<?php echo ($now_group["index_sort"]); ?>" /><span class="form_tips">数值越高，首页排序越前。</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><?php echo ($config["group_alias_name"]); ?>状态：</label>
									<select name="status" class="col-sm-1">
										<option value="1" <?php if($now_group['status'] == 1): ?>selected="selected"<?php endif; ?>>开启</option>
										<option value="0" <?php if($now_group['status'] == 0): ?>selected="selected"<?php endif; ?>>关闭</option>
									</select>
									<span class="form_tips">为了方便用户能查找到以前的订单，<?php echo ($config["group_alias_name"]); ?>无法删除！</span>
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
<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
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
			'source', 'fullscreen', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'table'
		],
		emoticonsPath : './static/emoticons/',
		uploadJson : "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=group/content",
		cssPath : "<?php echo ($static_path); ?>css/group_editor.css"
	});
	
	var editor = K.editor({
		allowFileManager : true
	});
	K('#J_selectImage').click(function(){
		if($('.upload_pic_li').size() >= 5){
			alert('最多上传5个图片！');
			return false;
		}
		editor.uploadJson = "<?php echo U('Group/ajax_upload_pic');?>";
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
		$.getJSON("<?php echo U('Group/ajax_get_category');?>",{cat_fid:$(this).val()},function(result){
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
				$('#choose_catid').html('<option value="0">请选择其他分类</option>');
				alert(result.msg);
			}
		});
	});
	$('#add_form').submit(function(){
		content_editor.sync();
		$('#save_btn').prop('disabled',true);
		$.post("<?php echo U('Group/frame_edit',array('group_id'=>$now_group['group_id']));?>",$('#add_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = window.location.href;
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
							html += '<p class="deal-menu-summary">价值: <span class="inline-block worth">¥</span><?php echo ($config["group_alias_name"]); ?>价： <span class="inline-block worth price">¥</span></p><br/><br/>介绍...';
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
			$.get("<?php echo U('Index/Scws/ajax_getKeywords');?>",{title:s_name.val()},function(result){
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
	$.post("<?php echo U('Group/ajax_del_pic');?>",{path:path});
	$(obj).closest('.upload_pic_li').remove();
}
</script>
	<div id="orderAlert" style="position: fixed; z-index: 999999; bottom: 5px; right: 5px; background: #e5e5e5; display: none;">
		<div style="text-align: center; margin-top: 10px; font-size: 20px; color: red;">
			<b>新订单来啦!</b> <a class="oaright" href="javascript:closeoa()">[关闭]</a>
		</div>
		<div style="margin: 20px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！
		</div>
		<div style="margin: 5px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理
		</div>
		<div class="oaright" style="bottom: 10px; margin: 5px 30px 5px 30px;">
			时间：<a id="oatime" style="text-decoration: none;"></a>
		</div>
	</div>
	<div style="position: fixed; top: -9999px; right: -9999px; display: none;" id="soundsw"></div>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> 
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
</div>

<script>
function newalert(title){
	bootbox.dialog({
		message: title, 
		buttons: {
			"success" : {
				"label" : "确认",
				"className" : "btn-sm btn-primary"
			}
		}
	});
}

function alertshow(content){
	$('#popalertwindowcontent').html(content);
	$('#popalertwindow').show();
}
</script>

<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; display: none;" id="popalertwindow">
	<div style="width: 100%; height: 100%; background: #eeeeee; filter: alpha(opacity = 50); -moz-opacity: 0.5; -khtml-opacity: 0.5; opacity: 0.5; position: absolute; z-index: 9999;"></div>
	<div style="position: relative; width: 500px; height: 200px; margin: 200px auto; filter: alpha(opacity = 100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; z-index: 10000; background: #ffffff; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #666 0px 0px 10px; -moz-box-shadow: #666 0px 0px 10px; box-shadow: #666 0px 0px 10px;">
		<div style="height: 40px;"></div>
		<div style="width: 400px; height: 90px; margin: 0px auto; color: #999999; text-align: center; font-size: 20px;">
			<table style="width: 400px; height: 90px;">
				<tbody>
					<tr>
						<td id="popalertwindowcontent"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="height: 20px;"></div>
		<div style="width: 80px; height: 40px; background: #eeeeee; margin: 0 auto; line-height: 40px; text-align: center; font-size: 20px; border: 1px solid #999999; cursor: pointer;" onclick="$(&#39;#popalertwindow&#39;).hide();">确认</div>
	</div>
</div>
</body>
</html>