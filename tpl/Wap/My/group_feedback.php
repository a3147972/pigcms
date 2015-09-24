<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$config.group_alias_name}评价</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/wap_pay_check.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/wap_uploadimg.css" rel="stylesheet"/>
<style>
    h6 {
        font-size: .3rem;
        font-weight: normal;
        margin-bottom: .2rem;
    }
    .btn-wrapper {
        margin: .28rem .2rem;
    }
    .score {
        position: relative;
    }
    .score:before,
    .score span:after {
        content: '★★★★★';
        position: absolute;
        font-family: 'base_icon';
        font-size: .5rem;
        color: #e9e9e9;
        letter-spacing: .4rem;
        line-height: 1em;
        left: 0;
    }
    .score input {
        opacity: .0;
        width: 100%;
        height: 100%;
        -webkit-appearance: initial;
        outline: none;
        z-index: 3;
    }
    .score label {
        display: inline-block;
        width: .84rem;
        height: .5rem;
    }
    .score span {
        position: absolute;
        visibility: hidden;
        color: #f49231;
        top: 0;
        left: 0;
        width: 100%;
        line-height: 1.9em;
        font-size: 14px;
        pointer-events: none;
        text-align: right;
    }

    .score span:after {
        color: #f49231;
    }
    .score input:checked + span {
        visibility: visible;
    }
    .score_1:checked + span:after {
        content: '★';
    }
    .score_2:checked + span:after {
        content: '★★';
    }
    .score_3:checked + span:after {
        content: '★★★';
    }
    .score_4:checked + span:after {
        content: '★★★★';
    }
    textarea {
        width: 100%;
    }
    .react .kv-line {
        margin: 0;
    }
</style>
</head>
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="javascript:history.back()" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">{pigcms{$config.group_alias_name}评价</h1>
            <div class="nav-wrap-right">
                <a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
                    <span class="nav-btn">
                        <i class="text-icon">≋</i>导航
                    </span>
                </a>
            </div>
            <div id="nav-dropdown" class="nav-dropdown">
                <ul>
                    <li><a class="react" href="{pigcms{:U('Home/index')}"><i class="text-icon">⟰</i>
                        <space></space>首页</a>
                    </li><li><a class="react" href="{pigcms{:U('My/index')}"><i class="text-icon">⍥</i>
                        <space></space>我的</a>
                    </li><li><a class="react" href="{pigcms{:U('Search/index',array('type'=>'group'))}"><i class="text-icon">⌕</i>
                        <space></space>搜索</a>
                </li></ul>
            </div>
        </header>
        <div id="tips" class="tips"></div>
        <form id="form" method="post" action="{pigcms{:U('My/group_feedback',array('order_id'=>$now_order['order_id']))}">
			<dl class="list">
				<dd class="dd-padding">
					<h6>评分</h6>
					<div class="score">
						<label>
							<input type="radio" class="score_1" value="1" name="score"/>
							<span><b>1</b>分</span>
						</label>
						<label>
							<input type="radio" class="score_2" value="2" name="score"/>
							<span><b>2</b>分</span>
						</label>
						<label>
							<input type="radio" class="score_3" value="3" name="score"/>
							<span><b>3</b>分</span>
						</label>
						<label>
							<input type="radio" class="score_4" value="4" name="score"/>
							<span><b>4</b>分</span>
						</label>
						<label>
							<input type="radio" class="score_5" value="5" name="score" checked="checked"/>
							<span><b>5</b>分</span>
						</label>
					</div>
				</dd>
			</dl>
			<dl class="list">
				<dd>
					<dl>
						<dd class="dd-padding">
							<textarea name="comment" class="input-weak" placeholder="最少评论10字，您的评价将是其他用户的重要参考" style="height:4.2em;text-indent:0rem;"></textarea>
						</dd>

						 <dd class="item uploadNum" id="uploadNum">还可上传<span class="leftNum orange">8</span>张图片，已上传<span class="loadedNum orange">0</span>张(非必填)</dd> 
						<dd class="item"> 
						 <div class="upload_box"> 
						  <ul class="upload_list clearfix" id="upload_list"> 
						   <li class="upload_action"> <img src="{pigcms{$static_path}classify/upimg.png" /> <input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name="" /> </li> 
						  </ul> 
						 </div>
						</dd>

						<dd>
							<label class="react">
								<div class="kv-line-r">
									<h6>匿名评价</h6>
									<input type="checkbox" name="anonymous" value="1" class="choose mt kv-v"/>
								</div>
							</label>
						</dd>
					</dl>
				</dd>
			</dl>
			<div class="btn-wrapper"><button type="submit" class="btn btn-larger btn-block btn-strong">发布</button></div>
		</form>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		 <script src="{pigcms{$static_path}classify/exif.js"></script> 
		 <script src="{pigcms{$static_path}classify/imgUpload.js"></script> 
		<script>
			$(function(){
				$('#form').submit(function(){
					$('#tips').hide();
					if($('textarea[name="comment"]').val().length < 10){
						$('#tips').html('最少评论10字，您的评价将是其他用户的重要参考').show();
						return false;
					}
				});
			});
		$(function() {
		if ($(".upload_list").length) {
        var imgUpload = new ImgUpload({
            fileInput: "#fileImage",
            container: "#upload_list",
            countNum: "#uploadNum",
			url:"http://" + location.hostname + "/wap.php?g=Wap&c=My&a=ajaxImgUpload&ml=group"
		  })
		 }
	});
		</script>	
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>