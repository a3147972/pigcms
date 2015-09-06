<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-shopping-cart"></i>&nbsp;<a href="{pigcms{:U('Weidian/index')}">微店</a>
			</li>
			<li>微店管理</li>
			<!--li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{pigcms{$weidian_url}" target="_blank">新页面打开微店管理页面</a></li-->
		</ul>
	</div>
	<!-- 内容头部 -->
	<iframe src="{pigcms{$weidian_url}" style="width:100%;height:100%;border:0;" id="weidian_url"></iframe>
	
</div>
<script type="text/javascript">
	$(function(){
		$('#weidian_url').height($(window).height()-$('#navbar').height()-$('#breadcrumbs').height()-8);
	});
</script>
<include file="Public:footer"/>