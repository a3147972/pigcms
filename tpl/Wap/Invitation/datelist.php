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
            <h1 class="nav-header">约会</h1>
            <div class="nav-wrap-right">
				<a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown" href="{pigcms{:U('Invitation/mydate')}">
					<span class="nav-btn">
						<i class="text-icon">≋</i>我的
					</span>
				</a>
			</div>
        </header-->


    	<div class="taBle clr">
        	<ul>
            	<li><a href="{pigcms{:U('Invitation/index')}">发现</a></li>
                <li class="specia clr"><a href="{pigcms{:U('Invitation/datelist')}">约会</a></li>
                <!--li><a href="javascript:void(0)">热聊</a></li-->
            </ul>
        </div>
        <div class="content clr">
        	<volist name="date_list" id="vo">
        	<div class="listPart clr" onclick="location.href='{pigcms{:U('Invitation/info', array('pigcms_id' => $vo['pigcms_id']))}'" data-url="{pigcms{:U('Invitation/info', array('pigcms_id' => $vo['pigcms_id']))}">
            	<div class="ones clr">
                	<div class="onesLt clr">
                    	<div class="zuoBian clr">
                        	<img src="{pigcms{$vo['avatar']}" class="userinfo" data-url="{pigcms{:U('Invitation/userinfo', array('uid' => $vo['uid']))}"/>
                        </div>
                        <div class="youBian clr">
                        	<p class="names clr">{pigcms{$vo['nickname']}</p>
                            <p class="<if condition="$vo['sex'] eq 1">man<else />girl</if> clr">
                                <span>{pigcms{$vo['age']}</span>
                                {pigcms{$vo['juli']}
                            </p>
                        </div>
                    </div>
                    <a href="{pigcms{:U('Invitation/info', array('pigcms_id' => $vo['pigcms_id']))}">
	                    <if condition="$vo['pay_type'] eq 0">
	                    	<div class="onesRn clr">我买单</div>
	                    <elseif condition="$vo['pay_type'] eq 1" />
	                    	<div class="onesRt clr">求请客</div>
	                    <else />
	                    	<div class="onesRa clr">AA</div>
	                    </if>
                    </a>
                </div>
                <div class="twoes clr" style="height: 61px;">
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
                    	<img src="{pigcms{$vo['store_image']}"  width="70px" height="70px" data-url="{pigcms{:U('Store/detail', array('store_id' => $vo['store_id']))}" class="buessinfo"/>
                    </div>
                </div>
                <p class="threes clr">
                	<a href="{pigcms{:U('Invitation/info', array('pigcms_id' => $vo['pigcms_id']))}">{pigcms{$vo['look_num']}条看过&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$vo['sign_num']}条报名</a>
                </p>
            </div>
            </volist>
        </div>
        <!--endof content-->
<a class="more" id="show_more" page="2" style="display: none;" href="javascript:void(0);">加载更多</a>
<input type="hidden" value="1" id="pageid" />
<input type="hidden" id="canScroll" value="1" />
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
<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>		
<script src="{pigcms{$static_path}js/jquery.min1.8.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*---------------------加载更多--------------------*/
	var total = {pigcms{$count};
	var activity_type = '{pigcms{$activity_type}';
	var pagesize = 10;
	var pages = Math.ceil(total / pagesize);
	if (pages > 1) {
		var _page = $('#show_more').attr('page');
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				$('#show_more').show().html('加载中...');
				if (_page > pages) {
					$('#show_more').show().html('没有更多了').delay(2300).slideUp(1600);
					return;
				}
				if($('#canScroll').val()==0){//不要重复加载
					return;
				}
				$('#canScroll').attr('value',0);
				$.ajax({
					type : "GET",
					data : {'page' : _page, 'pagesize' : pagesize, 'activity_type':activity_type},
					url :  '/wap.php?c=Invitation&a=ajaxlist',
					dataType : "json",
					success : function(RES) {
						$('#canScroll').attr('value',1);
						$('#show_more').hide().html('加载更多');
						data = RES.data;
						if(data.length){
							$('#show_more').attr('page',parseInt(_page)+1);
						}
						_page = $('#show_more').attr('page');
						var _tmp_html = '';
						$.each(data, function(x, y) {
							_tmp_html += '<div class="listPart clr" data-url="/wap.php?c=Invitation&a=info&pigcms_id='+ y.pigcms_id +'">';
							_tmp_html += '<div class="ones clr">';
							_tmp_html += '<div class="onesLt clr">';
							_tmp_html += '<div class="zuoBian clr">';
							_tmp_html += '<img src="' + y.avatar + '" class="userinfo" data-url="/wap.php?c=Invitation&a=userinfo&uid='+ y.pigcms_id +'"/>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="youBian clr">';
							_tmp_html += '<p class="names clr">' + y.nickname + '</p>';
							if (y.sex == 1) {
								_tmp_html += '<p class="man clr">';
							} else {
								_tmp_html += '<p class="girl clr">';
							}
							_tmp_html += '<span>'+y.age+'岁</span>';
							_tmp_html += y.juli;
                            _tmp_html += '</p>';
                            _tmp_html += '</div>';
							_tmp_html += '</div>';
							if (y.pay_type == 0) {
								_tmp_html += '<div class="onesRn clr">我买单</div>';
							} else if (y.pay_type == 1) {
								_tmp_html += '<div class="onesRt clr">求请客</div>';
							} else {
								_tmp_html += '<div class="onesRa clr">AA</div>';
							}
							_tmp_html += '</div><div class="twoes clr"><div class="lefts clr">';
							if (y.activity_type == 0) {
								_tmp_html += '<p class="first clr">约人吃饭</p>';
								_tmp_html += '<p class="second clr">' + y.invite_time + '</p>';
								_tmp_html += '<p class="third clr">' + y.address + '</p>';
								
							} else if (y.activity_type == 1) {
								_tmp_html += '<p class="firstNo clr">约人看电影</p>';
								_tmp_html += '<p class="secondNo clr">' + y.invite_time + '</p>';
								_tmp_html += '<p class="thirdNo clr">' + y.address + '</p>';
							}
							_tmp_html += '</div>';
							_tmp_html += '<div class="rights clr">';
							_tmp_html += '<img src="' + y.store_image + '"  width="80px" height="80px" data-url="/wap.php?c=Store&a=detail&store_id=' + y.store_id + '" class="buessinfo"/>';
							_tmp_html += '</div>';
							_tmp_html += '</div>';
							_tmp_html += '<p class="threes clr">';
							_tmp_html += y.look_num + '条看过&nbsp;&nbsp;&nbsp;&nbsp;' + y.sign_num + '条报名</p></div>';
						});
						$('.content').append(_tmp_html);
					}
				});
			}
		});
	}
	$('.listPart').live('click', function(e){
		var parent = e.target;
		if ($(parent).attr('class') == 'userinfo') {
			location.href=$(parent).attr('data-url');
			return false;
		} else if ($(parent).attr('class') == 'buessinfo') {
			location.href=$(parent).attr('data-url');
			return false;
		} else {
			location.href=$(this).attr('data-url');
			return false;
		}
	});
	$('.add').live('click', function(){
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
