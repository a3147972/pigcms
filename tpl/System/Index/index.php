<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style.css"/>
		<title>后台管理 - {pigcms{$config.site_name}</title>
		<script type="text/javascript">if(self!=top){window.top.location.href = "{pigcms{:U('Index/index')}";}var selected_module="{pigcms{:strval($_GET['module'])}",selected_action="{pigcms{:strval($_GET['action'])}",selected_url="{pigcms{:urldecode(strval(htmlspecialchars_decode($_GET['url'])))}";</script>
		<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
		<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
		<script type="text/javascript" src="{pigcms{$static_public}js/jquery.colorpicker.js"></script>
	</head>
	<body style="background:#E2E9EA">
		<div id="header" class="header">
			<div class="logo">
			<if condition="$system_session['level'] eq 2">
			<a href="#" target="_blank"><img src="{pigcms{$static_path}images/logo-pigcms.png" width="180"/></a>
			</if>
			</div>
			<div class="nav f_r"><a href="{pigcms{:U('Index/cache')}" target="main" style="color:red;">清空缓存</a><if condition="$system_session['level'] eq 2"> <i>|</i> <a href="http://www.pigcms.com" target="_blank">官方网站</a> <i>|</i> <a href="http://o2o.pigcms.com/help/" target="_blank">帮助文档</a></if> &nbsp;&nbsp; &nbsp;&nbsp;</div>
			<div class="nav">&nbsp;&nbsp;&nbsp;&nbsp;欢迎您！{pigcms{$system_session.account}  <i>|</i> [{pigcms{$system_session.show_account}]  <i>|</i> <a href="{pigcms{:U('Login/logout')}" target="_top" style="color:red;">[安全退出]</a>  <i>|</i> <a href="{pigcms{$config.site_url}" target="_blank">浏览网站</a> </div>
			<div class="topmenu">
				<ul>
					<volist name="system_menu" id="vo">
						<li><span <if condition="$i eq 1">class="current"</if>><a href="javascript:void(0);" menu_id="{pigcms{$vo.id}">{pigcms{$vo.name}</a></span></li>
					</volist>
				</ul>
			</div>
			<div class="header_footer"></div>
		</div>
		<div id="Main_content">
			<div id="MainBox" >
				<div class="main_box">
					<div id="sx" onclick="main_refresh();" title="刷新框架"></div>
					<iframe name="main" id="Main" src="{pigcms{:U('Index/main')}" frameborder="false" scrolling="auto"  width="100%" height="auto" allowtransparency="true"></iframe>
				</div>
			</div>
			<div id="leftMenuBox">
				<div id="leftMenu">
					<div style="padding-left:12px;_padding-left:10px;">	
						<volist name="system_menu" id="vo">
							<dl id="nav_{pigcms{$vo.id}">
								<dt>{pigcms{$vo.name}</dt>
								<volist name="vo['menu_list']" id="voo">
									<dd><span url="{pigcms{:U(ucfirst($voo['module']).'/'.$voo['action'])}" id="leftmenu_{pigcms{:ucfirst($voo['module'])}_{pigcms{$voo['action']}">{pigcms{$voo.name}</span></dd>
								</volist>
							</dl>
						</volist>
					</div>
				</div>
				<div id="Main_drop">
					<a href="javascript:toggleMenu(1);" class="on"><img src="{pigcms{$static_path}images/admin_barclose.gif" width="11" height="60" border="0"/></a>   
					<a href="javascript:toggleMenu(0);" class="off" style="display:none;"><img src="{pigcms{$static_path}images/admin_baropen.gif" width="11" height="60" border="0"/></a>
				</div>
			</div>
		</div>
		<if condition="$system_session['level'] eq 2">
		<div id="footer" class="footer" >Powered by vlo2o<a href="http://www.pigcms.com" target="_blank">Pigcms</a> Copyright 2015 © 信息技术有限公司 版权所有<span id="run"></span></div>
		</if>
		<script type="text/javascript" src="{pigcms{$static_path}js/index.js"></script>
	</body>
</html>