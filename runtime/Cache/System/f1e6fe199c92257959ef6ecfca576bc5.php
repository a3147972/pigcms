<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={:C('DEFAULT_CHARSET')}" />
		<title>网站后台管理 Powered by weiwino2o</title>
		<script type="text/javascript">
			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}
			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;
 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>
	</head>
	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="<?php echo U('Home/invalid');?>" class="on">无效关键词回复</a>
				</ul>
			</div>
			<form method="post" action="" refresh="true" enctype="multipart/form-data" >
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%">
					<tr>
						<th width="160">回复类型　</th>
						<td>
						<label><input type="radio" name="type" class="type" value="0" <?php if($first['type'] == 0): ?>checked<?php endif; ?>>自定义文本</label>
						<label><input type="radio" name="type" class="type" value="1" <?php if($first['type'] == 1): ?>checked<?php endif; ?>>自定义图文</label>
						<label><input type="radio" name="type" class="type" value="2" <?php if($first['type'] == 2): ?>checked<?php endif; ?>>网站功能</label>
						<label><input type="radio" name="type" class="type" value="3" <?php if($first['type'] == 3): ?>checked<?php endif; ?>>本站推荐的<?php echo ($config["group_alias_name"]); ?></label>
						</td>
					</tr>
					<tr class="class_0" <?php if($first['type'] != 0): ?>style="display:none"<?php endif; ?>>
						<th width="160">回复内容　</th>
						<td><textarea rows="20" cols="45" name="content" id="content"><?php echo ($first["content"]); ?></textarea></td>
					</tr>
					<tr class="class_1" <?php if($first['type'] != 1): ?>style="display:none"<?php endif; ?>>
						<th width="160">回复标题　</th>
						<td><input type="text" class="input-text" name="title" id="title" value="<?php echo ($first["title"]); ?>"/></td>
					</tr>
					<tr class="class_1" <?php if($first['type'] != 1): ?>style="display:none"<?php endif; ?>>
						<th width="160">内容介绍　</th>
						<td><textarea rows="4" cols="25" name="info" id="info"><?php echo ($first["info"]); ?></textarea></td>
					</tr>
					<tr class="class_1" <?php if($first['type'] != 1): ?>style="display:none"<?php endif; ?>>
						<th width="160">外链URL　</th>
						<td>
							<input type="text" class="input-text" name="url" id="url" value="<?php echo ($first["url"]); ?>" style="width:200px;" placeholder="外链接url如：http://www.baidu.com" validate="maxlength:200,url:true"/>
							<img src="./tpl/System/Static/images/help.gif" class="tips_img" title="外链接url如：http://www.baidu.com">
							<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
						</td>
					</tr>
					<tr class="class_1" <?php if($first['type'] != 1): ?>style="display:none"<?php endif; ?>>
						<th width="160">回复图片　</th>
						<td><input type="file" class="input-text" name="pic" id="pic" value="<?php echo ($first["pic"]); ?>"/></td>
					</tr>
					<?php if($first['pic']): ?><tr class="class_1" <?php if($first['type'] != 1): ?>style="display:none"<?php endif; ?>>
							<th width="160"></th>
							<td><img src="<?php echo ($first["pic"]); ?>" width="280" height="180"></td>
						</tr><?php endif; ?>
					
					<tr class="class_2" <?php if($first['type'] != 2): ?>style="display:none"<?php endif; ?>>
						<th width="160">回复网站功能　</th>
						<td>
						<label><input type="radio" name="fromid" value="1" <?php if($first['fromid'] == 1): ?>checked<?php endif; ?>>网站首页</label>
						<label><input type="radio" name="fromid" value="2" <?php if($first['fromid'] == 2): ?>checked<?php endif; ?>><?php echo ($config["group_alias_name"]); ?>首页</label>
						<label><input type="radio" name="fromid" value="3" <?php if($first['fromid'] == 3): ?>checked<?php endif; ?>><?php echo ($config["meal_alias_name"]); ?>首页</label>
						</td>
					</tr>
					
				</table>
				<div class="btn">
					<input type="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
		<style>
			.table_form{border:1px solid #ddd;}
			.tab_ul{margin-top:20px;border-color:#C5D0DC;margin-bottom:0!important;margin-left:0;position:relative;top:1px;border-bottom:1px solid #ddd;padding-left:0;list-style:none;}
			.tab_ul>li{position:relative;display:block;float:left;margin-bottom:-1px;}
			.tab_ul>li>a {
position: relative;
display: block;
padding: 10px 15px;
margin-right: 2px;
line-height: 1.42857143;
border: 1px solid transparent;
border-radius: 4px 4px 0 0;
padding: 7px 12px 8px;
min-width: 100px;
text-align: center;
}
.tab_ul>li>a, .tab_ul>li>a:focus {
border-radius: 0!important;
border-color: #c5d0dc;
background-color: #F9F9F9;
color: #999;
margin-right: -1px;
line-height: 18px;
position: relative;
}
.tab_ul>li>a:focus, .tab_ul>li>a:hover {
text-decoration: none;
background-color: #eee;
}
.tab_ul>li>a:hover {
border-color: #eee #eee #ddd;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li>a:hover {
background-color: #FFF;
color: #4c8fbd;
border-color: #c5d0dc;
}
.tab_ul>li:first-child>a {
margin-left: 0;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul:before,.tab_ul:after{
content: " ";
display: table;
}
.tab_ul:after{
clear: both;
}
		</style>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".type").click(function(){
		$(".class_0,.class_1,.class_2").hide();
		$(".class_" + $(this).val()).show();
	});
});

function addLink(domid,iskeyword){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
</script>
	</body>
</html>