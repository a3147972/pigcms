<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>约会去哪儿</title>
<meta http-equiv="Content-Type">
<meta content="text/html; charset=utf-8">
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="email=no">
<link rel="stylesheet" href="{pigcms{$static_path}css/invitation.css" type="text/css">
<link href="{pigcms{$static_path}tpl/1116/css/cate.css" rel="stylesheet" type="text/css" />
</head>
<body class="scene-body">
<section class="head-ad">
    <ul>
        <li>
            <a href="{pigcms{:U('Invitation/datelist', array('activity_type' => 0))}">
                <div class="image">
                	<img src="{pigcms{$static_path}images/meishi.png">
                </div>
            </a>
        </li>
        <li>
            <a href="{pigcms{:U('Invitation/datelist', array('activity_type' => 1))}">
                <div class="image">
                	<img src="{pigcms{$static_path}images/game.png">
                </div>
            </a>
        </li>
    </ul>
</section>
	<header>
		<h1>女神</h1>
		
		<div id="list_uls" class="list_uls box_swipe">
			<ul>
				<li>
					<dl class="content-slide" id="show_sex_2">
					<volist name="women" id="w">
						<dd>
							<a href=<if condition="$w['uid']">{pigcms{:U('Invitation/userinfo', array('uid' => $w['uid']))}<else/> javascript:void(0)</if>">
								<figure>
									<div><img class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$w['avatar']}" style="height:100px;"/></div>
									<figcaption>
										<label style="cursor:pointer;width:60px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{pigcms{$w['nickname']}</label>
									</figcaption>
								</figure>
							</a> 
						</dd>
					</volist>
					</dl>
				</li>
			</ul>
		</div>
		
	</header>
	<div style="text-align: right;height: 30px;margin-top: 15px;"><a href="javascript:;" style="color: #ED0B8C;"  id="sex_2" data-page="2">更多女神等你约...</a></div>
	<header>
		<h1>高富帅</h1>
		
		<div id="list_uls" class="list_uls box_swipe">
			<ul>
				<li>
					<dl class="content-slide" id="show_sex_1">
					<volist name="men" id="m">
						<dd>
							<a href=<if condition="$m['uid']">{pigcms{:U('Invitation/userinfo', array('uid' => $m['uid']))}<else/> javascript:void(0)</if>">
								<figure>
									<div><img  class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{$m['avatar']}" style="height:100px;"/></div>
									<figcaption>
										<label style="cursor:pointer;width:60px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{pigcms{$m['nickname']}</label>
									</figcaption>
								</figure>
							</a> 
						</dd>
					</volist>
					</dl>
				</li>
			</ul>
		</div>
	</header>
	<div style="text-align: right;height: 30px;margin-top: 15px;"><a href="javascript:;" style="color: #ED0B8C;" id="sex_1" data-page="2">查看更多高富帅...</a></div>
<i class="scroll-top clear"></i>
<div class="overlay" style="top: 0px; left: 0px; width: 100%; height: 100%; z-index: 200; position: fixed; display: none; background: rgba(0, 0, 0, 0.6);"></div>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
<script src="{pigcms{$static_path}js/jquery.min1.8.js" type="text/javascript"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("img.lazy_img").lazyload();
	
	var total1 = {pigcms{$count1};
	var total2 = {pigcms{$count2};
	var pagesize = 6;
	var pages1 = Math.ceil(total1 / pagesize);
	var pages2 = Math.ceil(total2 / pagesize);
	
	if (pages1 > 1) {
		$('#sex_1').click(function(){
			
			var _page = $('#sex_1').attr('data-page');
			
			if (_page > pages1) {
				$('#sex_1').html('没有更多了');
				return;
			}
			$('#sex_1').attr('data-page',parseInt(_page)+1);
			$.ajax({
				type : "GET",
				data : {'page' : _page, 'pagesize' : pagesize, 'sex':1},
				url :  '/wap.php?c=Invitation&a=ajaxmore',
				dataType : "json",
				success : function(RES) {
					data = RES.data;
					var _tmp_html = '';
					$.each(data, function(x, y) {
						_tmp_html += '<dd><a href="/wap.php?c=Invitation&a=userinfo&uid='+ y.uid +'">';
						_tmp_html += '<figure><div><img src="'+ y.avatar +'"  style="height:100px;"/></div>';
						_tmp_html += '<figcaption><label style="cursor:pointer;width:60px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">'+ y.nickname +'</label></figcaption>';
						_tmp_html += '</figure>';
						_tmp_html += '</a></dd>';
					});
					$('#show_sex_1').append(_tmp_html);
				}
			});
		});
	}
	if (pages2 > 1) {
		$('#sex_2').click(function(){
			var _page = $('#sex_2').attr('data-page');
			if (_page > pages2) {
				$('#sex_2').html('没有更多了');
				return;
			}
			$('#sex_2').attr('data-page',parseInt(_page)+1);
			$.ajax({
				type : "GET",
				data : {'page' : _page, 'pagesize' : pagesize, 'sex':2},
				url :  '/wap.php?c=Invitation&a=ajaxmore',
				dataType : "json",
				success : function(RES) {
					data = RES.data;
					var _tmp_html = '';
					$.each(data, function(x, y) {
						_tmp_html += '<dd><a href="/wap.php?c=Invitation&a=userinfo&uid='+ y.uid +'">';
						_tmp_html += '<figure><div><img src="'+ y.avatar +'"  style="height:100px;"/></div>';
						_tmp_html += '<figcaption><label style="cursor:pointer;width:60px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">'+ y.nickname +'</label></figcaption>';
						_tmp_html += '</figure>';
						_tmp_html += '</a></dd>';
					});
					$('#show_sex_2').append(_tmp_html);
				}
			});
		});
	}

});
</script>
</html>