<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Tmpls/index')}">微网站</a>
			</li>
			<li class="active">菜单颜色与版权</li>
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
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">	
							<li>
								<a href="{pigcms{:U('Catemenu/index')}">底部菜单分类设置</a>
							</li>
							<li>
								<a href="{pigcms{:U('Catemenu/styleSet')}">底部菜单风格选择</a>
							</li>
							<li class="active">
								<a href="{pigcms{:U('Catemenu/plugmenu')}">菜单颜色与版权</a>
							</li>
							<li>
								<a href="{pigcms{:U('Catemenu/music')}">背景音乐设置</a>
							</li>
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
								<form method="post" action="" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><div class="plug-menu" id="plugmenucolor" style="background-color:{pigcms{$homeInfo.plugmenucolor}"><span class="close"></span></div></label></label>
									<label class="col-sm-2">请选择快捷菜单的颜色</label>
									<input type="text" name="plugmenucolor" id="themeStyle" value="{pigcms{$homeInfo.plugmenucolor}" class="col-sm-1 color" style="width: 75px; background-image: none; background-color:{pigcms{$homeInfo.plugmenucolor}; color: rgb(255, 255, 255);" onblur="document.getElementById('plugmenucolor').style.backgroundColor=document.getElementById('themeStyle').value;">
									<span class="form_tips">请在手机上查看效果!</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">设置页面版权</label></label>
									<input type="text" class="col-sm-3" name="copyright" value="{pigcms{$homeInfo.copyright}" />
									<span class="form_tips">例如：© 2001-2013 某某版权所有</span>
								</div>
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
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
	</div>
</div>
<script src="/static/js/cart/jscolor.js" type="text/javascript"></script>


<style type="text/css">
.plug-menu {
width:36px;
height:36px;
border-radius:36px;
-moz-box-shadow:0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25);
-webkit-box-shadow:0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25);
box-shadow:0 0 0 4px #FFFFFF, 0 2px 5px 4px rgba(0, 0, 0, 0.25);
background-color: FF0000;
position:relative
}
.plug-menu span {
display: block;
width:28px;
height:28px;
background: url(/static/images/photo/plugmenu.png) no-repeat;
background-size: 28px 28px;
text-indent: -999px;
position:absolute;
top:4px;
left:4px;
overflow: hidden;
}
</style>

<include file="Public:footer"/>