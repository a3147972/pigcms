<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
		<title>约会详情</title>
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
	<link href="{pigcms{$static_path}css/four.css" rel="stylesheet" type="text/css" />
	<link href="{pigcms{$static_path}css/one.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{background-color: #FFFFFF;}
</style>
</head>
<body>
        <!--header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="javascript:history.go(-1)" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">详情</h1>
            <div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown"  href="{pigcms{:U('Invitation/datelist')}">
					<span class="nav-btn">
						<i class="text-icon">≋</i>列表
					</span>
				</a>
			</div>
        </header-->
        <div class="xianKuang clr">
        	<div class="shang clr">
            	<div class="shangLt clr">
                	<div class="zuoBian clr">
                    	<img src="{pigcms{$user['avatar']}" />
                    </div>
                    <div class="youBian clr">
                    	<p class="names clr">{pigcms{$user['nickname']}</p>
                        <p class="<if condition="$user['sex'] eq 1">man<else />girl</if> clr">
                            <span class="ages">{pigcms{$user['age']}&nbsp;&nbsp;{pigcms{$invitation['juli']}</span>
                            <!--span class="students">学生</span-->
                        </p>
                    </div>
                </div>
                <if condition="$invitation['pay_type'] eq 0">
                    <div class="onesRn clr">我买单</div>
                <elseif condition="$invitation['pay_type'] eq 1" />
                    <div class="onesRt clr">求请客</div>
                <else />
                    <div class="onesRa clr">AA</div>
                </if>
            </div>
            <!--endof shang -->
            <div class="xia clr">
            	<div class="twoes clr">
                	<div class="lefts clr">
                		<if condition="$invitation['activity_type'] eq 0">
                		<p class="first clr">约人吃饭</p>
                        <p class="second clr">{pigcms{$invitation.invite_time}</p>
                        <p class="third clr">{pigcms{$invitation['address']}</p>
                		<elseif condition="$invitation['activity_type'] eq 1" />
                		<p class="firstNo clr">约人看电影</p>
                        <p class="secondNo clr">{pigcms{$invitation.invite_time}</p>
                        <p class="thirdNo clr">{pigcms{$invitation['address']}</p>
                		</if>
                    </div>
                    <div class="rights clr">
                    	<img src="{pigcms{$invitation['store_image']}" width="80px" height="80px"/>
                    </div>
                </div>
                <p class="adrees clr">{pigcms{$store['adress']}</p>
                <p class="activity clr"><if condition="$invitation['note']">{pigcms{$invitation['note']}<else />无约会说明</if></p>
                <if condition="$invitation['obj_sex'] eq 0">
                 <p class="nosex clr">不限</p>
                <elseif condition="$invitation['obj_sex'] eq 1" />
                 <p class="myboy clr">限男生</p>
                <else />
                 <p class="mygirl clr">限妹子</p>
                </if>
               
                <p class="peoples clr">{pigcms{$invitation['look_num']}条看过&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$invitation['sign_num']}条报名<if condition="$invitation['status']"><span style="float: right;margin-right:20px">已结束</span></if></p>
                <!--endof twoes-->
            </div>
        </div>
        <!--endof xianKUang-->
        <if condition="$looks">
        <div class="seen clr">
        	<p class="nearly clr">最近看过的人</p>
            <div class="renMen clr" style="margin-left: -30px;">
            	<volist name="looks" id="look">
            	<a href="{pigcms{:U('Invitation/userinfo', array('uid' => $look['uid']))}"><img src="{pigcms{$look['avatar']}" width="50px" height="50px"/></a>
            	</volist>
            </div>
        </div>
        </if>
        <!--end-->
<footer class="footermenu">
    <ul>
        <li>
            <a <if condition="ACTION_NAME eq 'datelist'">class="active"</if> href="{pigcms{:U('Invitation/datelist')}">
            <img src="{pigcms{$static_path}images/3YQLfzfunJ.png">
            <p>首页</p>
            </a>
        </li>
        <li>
            <a <if condition="in_array(ACTION_NAME,array('mydate','mysign'))">class="active"</if> href="{pigcms{:U('Invitation/mydate')}">
            <img src="{pigcms{$static_path}images/J0uZbXQWvJ.png">
            <p>我的</p>
            </a>
        </li>
        <li>
            <a href="{pigcms{$im_url}">
	            <img src="{pigcms{$static_path}images/2_09.png" />
	            <p>发消息</p>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)" id="sign_or_out">
	            <img src="{pigcms{$static_path}images/flower_11.png" />
	            <p id="sign_html"><if condition="$sign">放弃报名<else />我想报名</if></p>
            </a>
        </li>
    </ul>
</footer>
<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>
<script src="{pigcms{$static_path}js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script src="/static/js/alert.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#sign_or_out').click(function(){
		$.post("{pigcms{:U('Invitation/sign', array('pigcms_id' => $invitation['pigcms_id']))}", function(data){
			if (data.error_code) {
				alert(data.msg);
			} else {
				if (data.status) {
					$('#sign_html').html('放弃报名');
				} else {
					$('#sign_html').html('我想报名');
				}
			}
		}, 'json');
	});
	$('#cancel').click(function(){
		art.dialog.confirm('你确认取消约会？', function(){
			$.get("{pigcms{:U('Invitation/cancel', array('pigcms_id' => $invitation['pigcms_id']))}", function(data){
				if (data.error_code) {
					alert(data.msg);
				} else {
					$('.peoples').after('<span style="float: right;margin-right:20px">已结束</span>');
				}
			}, 'json');
		});
		return false;
	});
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
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
    </body>
</html>
