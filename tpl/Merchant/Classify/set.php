<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Classify/index')}">微网站</a>
			</li>
			<li class="active">添加分类</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Classify/set')}">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="red">*</span>关键词</label></label>
									<label class="col-sm-4"><span class="red">首页 或者 home —— 当用户输入该关键词时，将会触发此回复。</span></label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name"><span class="required" style="color:red;">*</span>回复标题</label></label>
									<input type="text" name="title" value="{pigcms{$home.title}" class="col-sm-3" >
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">内容介绍</label></label>
									<textarea  class="col-sm-3" id="info" name="info"  style="height:125px" >{pigcms{$home.info}</textarea>
									<span class="form_tips">最多填写120个字</span>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">回复图片</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50" onchange="preview1(this)" name="picurl" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:417px;height:200px" id="img" src="{pigcms{$home.picurl}"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">公众号链接地址 </label></label>
									<input type="text" class="col-sm-3" id="gzhurl"  name="gzhurl" value="{pigcms{$home.gzhurl}"/>
									<span class="form_tips">填写此链接地址可以有效帮助粉丝关注您的公众号！请填写一个微信官方公众平台群发出的文章链接。</span>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">背景音乐</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50"  name="musicurl" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传"><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<if condition="$home.musicurl neq ''">
									<div><a style="width:120px;float:left" id="musicurl_src" class="audio {skin:'green'}" href="{pigcms{$home.musicurl}">音乐播放</a></div>
									</if>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-3"><label for="AutoreplySystem_img">公司Logo</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:140px;">
									<label class="ace-file-input">
										<input class="col-sm-4" id="ace-file-input" size="50" onchange="preview2(this)" name="logo" type="file">
										<span class="ace-file-container" data-title="选择">
											<span class="ace-file-name" data-title="上传图片..."><i class=" ace-icon fa fa-upload"></i></span>
										</span>
									</label>
									<div><img style="width:417px;height:200px" id="logo" src="{pigcms{$home.logo}"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sorts">第三方接口</label></label>
									<input class="col-sm-3" type="text" id="apiurl" name="apiurl" value="{pigcms{$home.apiurl}"/>
									<span class="form_tips">只适用于引用第三方3G网站的链接</span>
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

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>

<script type="text/javascript" src="/static/audioplayer/inc/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="/static/audioplayer/inc/jquery.mb.miniPlayer.js"></script>
<link rel="stylesheet" type="text/css" href="/static/audioplayer/css/miniplayer.css" title="style" media="screen"/>
<script type="text/javascript">
$(function () {
	$(".audio").mb_miniPlayer({
		width: 200,
		inLine: false,
		onEnd: playNext
	});
	function playNext(player) {
		var players = $(".audio");
		document.playerIDX = player.idx + 1 <= players.length - 1 ? player.idx + 1 : 0;
		players.eq(document.playerIDX).mb_miniPlayer_play();
	}
});
function preview1(input){
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) { $('#img').attr('src', e.target.result);}
		reader.readAsDataURL(input.files[0]);
	}
}
function preview2(input){
	if (input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) { $('#logo').attr('src', e.target.result);}
		reader.readAsDataURL(input.files[0]);
	}
}
</script>
<include file="Public:footer"/>