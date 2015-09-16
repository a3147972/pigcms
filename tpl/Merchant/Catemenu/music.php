<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Tmpls/index')}">微网站</a>
			</li>
			<li class="active">背景音乐设置</li>
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
							<li>
								<a href="{pigcms{:U('Catemenu/plugmenu')}">菜单颜色与版权</a>
							</li>
							<li class="active">
								<a href="{pigcms{:U('Catemenu/music')}">背景音乐设置</a>
							</li>
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
								<form method="post" action="" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">背景音乐</label></label>
									<input type="text" class="col-sm-3" name="musicurl" id="musicurl" value="{pigcms{$homeInfo.musicurl}" />　
									<a class="btn btn-sm btn-success" onclick="upyunPicUpload('musicurl',0,0,'music')">上传音乐</a>
									<span class="form_tips">只支持MP3格式的音乐</span>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">背景音乐试听</label></label>
									<a style="width:120px;" id="musicurl_href" class="audio {skin:'green'}" href="{pigcms{$homeInfo.musicurl}">音乐播放</a>
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

<script type="text/javascript" src="/static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="/static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="/static/js/upyun.js"></script>

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
    </script>

<include file="Public:footer"/>