<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$user['nickname']}</title>
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
	<link href="{pigcms{$static_path}css/two.css" rel="stylesheet" type="text/css" />
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
            <h1 class="nav-header">{pigcms{$user['nickname']}</h1>
            <div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown" <if condition="$is_edit eq 1">href="{pigcms{:U('Invitation/editinfo')}"</if> >
					<span class="nav-btn">
						<if condition="$is_edit eq 1"><i class="text-icon"></i>编辑</if>
					</span>
				</a>
			</div>
        </header-->
        <div class="touXiang clr">
        	<p class="touxZuo clr"><img src="{pigcms{$user['avatar']}" width="80px" height="80px"/></p>
            <!--p class="touxYou clr"><a href="javascript:void(0)"><img src="{pigcms{$static_path}images/zan_03.png" />3196</a></p-->
        </div>
        <!--endof touXiang-->
        <div class="content clr">
        	<div class="onePart clr">
        		<if condition="$invitation">
            	<div class="diYi clr">
                    <div class="partLt clr">约会信息</div>
                    <div class="partRt clr">
                		<if condition="$invitation['activity_type'] eq 0">
                		<p class="chifan clr">约人吃饭</p>
                		<elseif condition="$invitation['activity_type'] eq 1" />
                		<p class="dianYing clr">约人看电影</p>
                		</if>
                        <p class="zhongWu clr">{pigcms{$invitation['invite_time']}</p>
                        <p class="zhongWu clr">{pigcms{$invitation['address']}</p>
                    </div>
                </div>
                </if>
                <div class="diEr clr">
                	<div class="partLt clr">基础信息</div>
                    <div class="partRt clr">
                    <if condition="$user['sex'] eq 1">
                    <p class="boy clr"><img src="{pigcms{$static_path}images/u_boy.png" />{pigcms{$user['age']}</p>
                    <else />
                    <p class="girl clr"><img src="{pigcms{$static_path}images/u_girl.png" />{pigcms{$user['age']}</p>
                    </if>
                    </div>
                </div>
                <div class="diSan clr">
                	<div class="partLt clr">交友宣言</div>
                    <div class="partRt clr">
                    	<p style="margin-top: 13px;">{pigcms{$user['message']}</p>
                    </div>
                </div>
                <!---->
            </div>
            <!---->
            <div class="twoPart clr">
            	<div class="diYi clr">
                	<div class="partLt clr">职业</div>
                    <div class="partRt clr"><p class="students" style=" background:{pigcms{$occupation['color']}; ">{pigcms{$occupation['name']}</p></div>
                </div>
            </div>
        </div>
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
            <a href="{pigcms{$im_url}">
	            <img src="{pigcms{$static_path}images/2_09.png" />
	            <p><if condition="$is_edit eq 1">消息列表<else />发消息</if></p>
            </a>
        </li>
        <if condition="$is_edit eq 1">
        <li>
            <a href="{pigcms{:U('Invitation/editinfo')}">
            <img src="{pigcms{$static_path}images/1_08.png">
            <p>编辑</p>
            </a>
        </li>
        <else />
        <li>
            <a class="add">
            <img src="{pigcms{$static_path}images/1_08.png">
            <p>发起</p>
            </a>
        </li>
        </if>
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
