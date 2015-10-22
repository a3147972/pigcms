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
	<div id="navbar" class="navbar navbar-default">
	<div class="navbar-container" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
			<span class="sr-only">Toggle sidebar</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="navbar-header pull-left">
			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 
				<small> 
					<img src="<?php echo ($config["site_merchant_logo"]); ?>"/> <?php echo ($config["site_name"]); ?> - 商家中心
				</small>
			</a>
		</div>
		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<!--li class="red">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
						<i class="ace-icon fa fa-bell icon-animated-bell"></i> 
						<span class="badge badge-important">0</span>
					</a>
					<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单
						</li>
						<li class="dropdown-footer">
							<a href="#">查看全部未处理订单 
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>
				<li class="green">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i> 
						<span class="badge badge-success">0</span>
					</a>
		
					<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-envelope-o"></i> 0条未读消息
						</li>
						<li>
							<a href="#">
								有<span style="color: red;">0</span>条新留言
							</a>
						</li>
						<li>
							<a href="#">
								有<span style="color: red;">0</span>条新评论
							</a>
						</li>
						<li></li>
					</ul>
				</li-->
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 
						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /> 
						<span class="user-info"> <small>欢迎您，</small> <?php echo ($merchant_session["name"]); ?></span> 
						<i class="ace-icon fa fa-caret-down"></i>
					</a>
					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">
								<i class="ace-icon fa fa-link"></i> 网站首页
							</a>
						</li>
						<!--li>
							<a href="#">
								<i class="ace-icon fa fa-share-alt"></i> 推荐好友
							</a>
						</li-->
						<li>
							<a href="<?php echo U('Config/merchant');?>">
								<i class="ace-icon fa fa-user"></i> 商家设置
							</a>
						</li>
						<!--li>
							<a href="<?php echo U('Pay/index');?>"> 
								<i class="ace-icon fa fa-smile-o"></i> 对帐平台
							</a>
						</li-->
						<li class="divider"></li>
						<li>
							<a href="<?php echo U('Login/logout');?>"> 
								<i class="ace-icon fa fa-power-off"></i> 退出
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
	<div class="main-container" id="main-container">
	<div id="sidebar" class="sidebar responsive">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a class="btn btn-success" href="<?php echo U('Config/merchant');?>" title="商家设置">
				<i class="ace-icon fa fa-gear"></i>
			</a>&nbsp;
			<a class="btn btn-info" href="<?php echo U('Meal/index');?>" title="<?php echo ($config["meal_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-cutlery"></i>
			</a>&nbsp;
			<a class="btn btn-warning" href="<?php echo U('Group/index');?>" title="<?php echo ($config["group_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-desktop"></i>
			</a>&nbsp;
			<!--a class="btn btn-danger" href="<?php echo U('Pay/index');?>"> 
				<i class="ace-icon fa fa-smile-o"></i>
			</a-->
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span> <span class="btn btn-info"></span>
			<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list" style="top: 0px;">
		<?php if(is_array($merchant_menu)): $i = 0; $__LIST__ = $merchant_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["style_class"]); ?>">
				<a <?php if($vo['menu_list']): ?>href="#" class="dropdown-toggle"<?php else: ?>href="<?php echo ($vo["url"]); ?>"<?php endif; ?>> 
					<i class="menu-icon fa <?php echo ($vo["icon"]); ?>"></i>
					<span class="menu-text"><?php echo ($vo["name"]); ?></span>
					<?php if($vo['menu_list']): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
				</a>
				<b class="arrow"></b>
				<?php if($vo['menu_list']): ?><ul class="submenu">
						<?php if(is_array($vo['menu_list'])): $i = 0; $__LIST__ = $vo['menu_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li <?php if($voo['is_active']): ?>class="active"<?php endif; ?>>
								<a href="<?php echo ($voo["url"]); ?>"> 
									<i class="menu-icon fa fa-caret-right"></i> <?php echo ($voo["name"]); ?>
								</a>
								<b class="arrow"></b>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endif; ?>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<!-- /.nav-list -->

	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script>
</div>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-home home-icon"></i>
			<li class="active">首页</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-sm-12 infobox-container">
					<div style="background:#f2dede;padding:5px;margin-bottom:30px;">
						<div style="background:#f2dede;padding:5px;">
							<div class="" style="font-size:14px;" id="scrollText">
								<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['is_top']): ?><div style="float:left;">
											<span style="padding-right:30px;color:#a94442;">
												<i class="ice-icon fa fa-volume-up bigger-130"></i>
												<a href="<?php echo U('Index/news',array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a>
											</span>
										</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</div>
					</div>
					<div class="infobox" style="background:#7cbae5;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number"><?php echo ($fans_count); ?></span>
							<div class="infobox-content">粉丝</div>
						</div>
					</div>
					<div class="infobox" style="background:#cec0f4;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number"><?php echo ($card_count); ?></span>
							<div class="infobox-content">会员卡</div>
						</div>
					</div>
					<div class="infobox" style="background:#81d2cf;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number"><?php echo ($lottery_count); ?></span>
							<div class="infobox-content">微活动</div>
						</div>
					</div>
					<div class="infobox" style="background:#92bf77;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number"><?php echo ($store_count); ?></span>
							<div class="infobox-content">店铺数</div>
						</div>
					</div>
					<div class="space-18"></div>
					<!--div class="infobox infobox-pink">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-smile-o"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">2014-11-20</span>
							<div class="infobox-content">服务到期时间</div>
						</div>
					</div>
					<div class="infobox infobox-green  ">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-envelope-o"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">0</span>
							<div class="infobox-content">短信余额</div>
						</div>
					</div>
					<div class="infobox infobox-orange2  ">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cny"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">0.00</span>
							<div class="infobox-content">账户余额</div>
						</div>
					</div>
					<div class="space-18"></div>
					<div class="infobox infobox-green infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-shopping-cart"></i>
						</div>
				
						<div class="infobox-data">
							<div class="infobox-content">今日订单</div>
							<div class="infobox-content">0</div>
						</div>
					</div>
				
					<div class="infobox infobox-blue infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cny"></i>
						</div>
				
						<div class="infobox-data">
							<div class="infobox-content">今日收入</div>
							<div class="infobox-content">0</div>
						</div>
					</div>
				
					<div class="infobox infobox-grey infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-group"></i>
						</div>
				
						<div class="infobox-data">
							<div class="infobox-content">新增顾客</div>
							<div class="infobox-content">0</div>
						</div>
					</div-->
				</div>
				<div class="col-sm-12" style="height: 60px;"></div>
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="lighter smaller">
								<i class="ace-icon fa fa-star blue"></i>
								最新动态
							</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
									<div class="col-xs-12">
										<ul class="list-unstyled spaced">
											<?php if(is_array($news_list)): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
												<?php if($vo['is_top']): ?><a style="color:orange" href="<?php echo U('Index/news',array('id'=>$vo['id']));?>">
														<i class="ace-icon fa fa-arrow-up bigger-110 orange"></i>
														<span style="font-weight: bold;"><?php echo ($vo["title"]); ?></span>
													</a>
												<?php else: ?>
													<a  href="<?php echo U('Index/news',array('id'=>$vo['id']));?>"><i class="ace-icon fa fa-check bigger-110 green"></i><?php echo ($vo["title"]); ?></a><?php endif; ?>
											</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<p>欢迎大家联系系统管理员咨询或反馈。</p>
						<p>
							<a class="btn btn-sm btn-success" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank">联系管理员QQ</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var ScrollTime;
function ScrollAutoPlay(contID,scrolldir,showwidth,textwidth,steper){
	var PosInit,currPos;
	with($('#'+contID)){
		currPos = parseInt(css('margin-left'));
		if(scrolldir=='left'){
			if(currPos<0 && Math.abs(currPos)>textwidth){
				css('margin-left',showwidth);
			}
			else{
				css('margin-left',currPos-steper);
			}
		}
		else{
			if(currPos>showwidth){
				css('margin-left',(0-textwidth));
			}
			else{
				css('margin-left',currPos-steper);
			}
		}
	}
}

//--------------------------------------------左右滚动效果----------------------------------------------
/*
AppendToObj：		显示位置（目标对象）
ShowHeight：		显示高度
ShowWidth：		    显示宽度
ShowText：			显示信息
ScrollDirection：	滚动方向（值：left、right）
Steper：			每次移动的间距（单位：px；数值越小，滚动越流畅，建议设置为1px）
Interval:			每次执行运动的时间间隔（单位：毫秒；数值越小，运动越快）
*/
function ScrollText(AppendToObj,ShowHeight,ShowWidth,ShowText,ScrollDirection,Steper,Interval){
	var TextWidth,PosInit,PosSteper;
	with(AppendToObj){
		html('');
		css('overflow','hidden');
		css('height',ShowHeight+'px');
		css('line-height',ShowHeight+'px');
		css('width',ShowWidth);
	}
	if (ScrollDirection=='left'){
		PosInit = ShowWidth;
		PosSteper = Steper;
	}
	else{
		PosSteper = 0 - Steper;
	}
	if(Steper<1 || Steper>ShowWidth){Steper = 1}//每次移动间距超出限制(单位:px)
	if(Interval<1){Interval = 10}//每次移动的时间间隔（单位：毫秒）
	var Container = $('<div></div>');
	var ContainerID = 'ContainerTemp';
	var i = 0;
	while($('#'+ContainerID).length>0){
		ContainerID = ContainerID + '_' + i;
		i++;
	}
	with(Container){
	  attr('id',ContainerID);
	  css('float','left');
	  css('cursor','default');
	  appendTo(AppendToObj);
	  html(ShowText);
	  TextWidth = width();
	  css('width',ShowWidth * 2);
	  if(isNaN(PosInit)){PosInit = 0 - TextWidth;}
	  css('margin-left',PosInit);
	  mouseover(function(){
		  clearInterval(ScrollTime);
	  });
	  mouseout(function(){
		  ScrollTime = setInterval("ScrollAutoPlay('"+ContainerID+"','"+ScrollDirection+"',"+ShowWidth+','+TextWidth+","+PosSteper+")",Interval);
	  });
	}
	
	ScrollTime = setInterval("ScrollAutoPlay('"+ContainerID+"','"+ScrollDirection+"',"+ShowWidth+','+TextWidth+","+PosSteper+")",Interval);
}
</script>
<script type="text/javascript"> 
$(document).ready(function(e) {
	var start_div = $('#scrollText');
	var tmp_str = '';
	tmp_str = start_div.html();
	//ScrollTime
	ScrollText(start_div,23,start_div.width(),tmp_str,'left',1,20);//滚动字幕
});
</script>
<style>
#scrollText div a{ color: #a94442;}
</style>
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