<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
		<title>约会列表</title>
	<meta name="keywords" content="{pigcms{$now_category.cat_name},{pigcms{$config.seo_keywords}" />
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>

	<link href="{pigcms{$static_path}css/public.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/one.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{background-color: #FFFFFF;}
</style>
</head>
<body id="index" data-com="pagecommon">
        <!--header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="javascript:history.go(-1)" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">我报名的</h1>
            <div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown" href="{pigcms{:U('Invitation/datelist')}">
					<span class="nav-btn">
						<i class="text-icon">≋</i>列表
					</span>
				</a>
			</div>
        </header-->


    	<div class="taBle clr my">
        	<ul>
            	<li><a href="{pigcms{:U('Invitation/mydate')}">我发起的</a></li>
                <li  class="specia clr"><a href="{pigcms{:U('Invitation/mysign')}">我报名的</a></li>
            </ul>
        </div>
        <div class="content clr">
        	<volist name="date_list" id="vo">
        	<div class="listPart clr">
            	<div class="ones clr" onclick="location.href='{pigcms{:U('Invitation/info', array('pigcms_id' => $vo['pigcms_id']))}'">
                	<div class="onesLt clr">
                    	<div class="zuoBian clr">
                        	<img src="{pigcms{$vo['avatar']}" />
                        </div>
                        <div class="youBian clr">
                        	<p class="names clr">{pigcms{$vo['nickname']}</p>
                            <p class="<if condition="$vo['sex'] eq 1">man<else />girl</if> clr">
                                <span>{pigcms{$vo['age']}岁</span>
                                {pigcms{$vo['juli']}
                            </p>
                        </div>
                    </div>
                    <if condition="$vo['pay_type'] eq 0">
                    	<div class="onesRn clr">我买单</div>
                    <elseif condition="$vo['pay_type'] eq 1" />
                    	<div class="onesRt clr">求请客</div>
                    <else />
                    	<div class="onesRa clr">AA</div>
                    </if>
                </div>
                <div class="twoes clr">
                	<div class="lefts clr">
                		<if condition="$vo['activity_type'] eq 0">
                		<p class="first clr">约人吃饭</p>
                        <p class="second clr">{pigcms{$vo['invite_time']}</p>
                        <p class="third clr">{pigcms{$vo['address']}</p>
                		<elseif condition="$vo['activity_type'] eq 1" />
                		<p class="firstNo clr">约人看电影</p>
                        <p class="secondNo clr">{pigcms{$vo['invite_time']}</p>
                        <p class="thirdNo clr">{pigcms{$vo['address']}</p>
                		</if>
                    </div>
                    <div class="rights clr">
                    	<a href="{pigcms{:U('Store/detail', array('store_id' => $vo['store_id']))}"><img src="{pigcms{$vo['store_image']}"  width="70px" height="70px"/></a>
                    </div>
                </div>
                <p class="threes clr">
                	<a href="{pigcms{:U('Invitation/info', array('pigcms_id' => $vo['pigcms_id']))}">{pigcms{$vo['look_num']}条看过&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$vo['sign_num']}条报名</a>
                </p>
                <!---->
            </div>
            </volist>
        </div>
        <!--endof content-->
        <!--p class="xuanfu clr"><img src="{pigcms{$static_path}images/1_08.png" width="50px" height="50px" class="add"/></p-->
<footer class="footermenu">
    <ul>
        <li>
            <a <if condition="ACTION_NAME eq 'datelist'">class="active"</if> href="{pigcms{:U('Invitation/datelist')}">
            <img src="{pigcms{$static_path}images/3YQLfzfunJ.png">
            <p>首页</p>
            </a>
        </li>
        <li>
            <a <if condition="in_array(ACTION_NAME, array('mydate', 'mysign'))">class="active"</if> href="{pigcms{:U('Invitation/mydate')}">
            <img src="{pigcms{$static_path}images/J0uZbXQWvJ.png">
            <p>我的</p>
            </a>
        </li>
        <li>
            <a href="{pigcms{$my_im}">
	            <img src="{pigcms{$static_path}images/2_09.png" />
	            <p>消息列表</p>
            </a>
        </li>
        <li>
            <a class="add">
            <img src="{pigcms{$static_path}images/1_08.png">
            <p>发起</p>
            </a>
        </li>
    </ul>
</footer>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
<script src="{pigcms{$static_path}js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.add').click(function(){
    	$.get("{pigcms{:U('Invitation/isrelease')}", function(data){
		    if (data.error_code) {
			    var pid = data.pigcmsid;
			    art.dialog.confirm('您有一个约会活动正在进行，只有放<br/>弃后才能发起新的约会，是否放弃？', function(){
				    $.get("{pigcms{:U('Invitation/cancel')}",{'pigcms_id':pid}, function(response){
					    if (response.error_code) {
					    	alert(response.msg);
					    } else {
							location.href="{pigcms{:U('Invitation/release_date')}";
					    }
	    			}, 'json');
    			});
   			} else {
    			location.href="{pigcms{:U('Invitation/release_date')}";
    		}
    	}, 'json');
	});
});
</script>
    </body>
</html>
