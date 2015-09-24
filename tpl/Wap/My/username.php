<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>修改昵称</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('My/myinfo')}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">修改昵称</h1>
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
        <if condition="$error">
        	<div id="tips" class="tips tips-err" style="display:block;">{pigcms{$error}</div>
        <else/>
        	<div id="tips" class="tips"></div>
        </if>
        <form id="form" method="post" action="{pigcms{:U('My/username')}">
		    <dl class="list">
		        <dd class="dd-padding">
		            <input id="username" placeholder="请填写用户名" class="input-weak" type="text" name="nickname" value="{pigcms{$now_user.nickname}">
		        </dd>
		    </dl>
		    <p class="btn-wrapper">以英文字母或汉字开头，限4-16个字符</p>
		    <div class="btn-wrapper"><button type="submit" class="btn btn-block btn-larger">修改</button></div>
		</form>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script>
			$(function(){
				$('#form').on('submit', function(e){
					$('#tips').removeClass('tips-err').hide();
			        var v = $('#username').val();
			        if(!/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-z])+/i.test(v)){
			            $('#tips').html('用户名只能以英文字母或汉字开头！').addClass('tips-err').show();
			            e.preventDefault();
			        }else if(v.length < 4 || v.length > 16){
			        	$('#tips').html('用户名限4-16个字符！').addClass('tips-err').show();
			            e.preventDefault();
			        }
			    });
			});
			function toast(msg){
				
			}
		</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>