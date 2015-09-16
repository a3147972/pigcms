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
	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>   <style type="text/css">    .table-list p{font-size: 18px; margin-left: 25px; line-height: 1em;}	</style>		<div class="mainbox">			<div id="nav" class="mainnav_title">			 <a href="javascript:;">生成网站地图</a>			</div>						<table class="search_table" width="100%">				<tr>					<td>					<div style="margin-left: 50px;">					<span>生成网站地图</span>					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="exeGenerate()">立刻生成</button>					</div>					</td>				</tr>			</table>			<div class="table-list">			<p>生成可能需要较长时间，请不要关闭窗口，静静等待！</p>			</div>		</div><script type="text/javascript">var islock=false;function exeGenerate(){   if(islock){      alert('正在执行生成万丈地图，请勿重复点击！');	  return false;   }      islock=true;	  $('.table-list').append('<p>正在执行生成，请稍等......</p>');	  	$.ajax({			url:"<?php echo U('Index/exeGenerate');?>",			type:"post",			data:{pam:'嘿嘿！'},			dataType:"JSON",			success:function(ret){			   ret.error=parseInt(ret.error);			   islock=false;			  if(!ret.error){			    $('.table-list').append('<p>'+ret.msg+'&nbsp;&nbsp;&nbsp;<a href="<?php echo ($config["site_url"]); ?>/sitemap.xml" target="_blank" style="color:#1083F2;">访问文件</a></p>');			  }else{			     $('.table-list').append('<p>'+ret.msg+'</p>');				 alert(ret.msg);			  }			  /*setTimeout(function(){			      window.location.href="";			  },5000);*/			}		});}</script>	</body>
</html>