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
<style type="text/css">
.span{
	color: #E01B1B;
	font-size: 14px;
	display: block;
	line-height: 18px;
	padding: 5px 6px;
	word-wrap: break-word;
	word-break: break-all;
	position: absolute;
	z-index: 99;
	bottom: 0;
}
</style>
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

<div id="list_uls" class="list_uls box_swipe">
	<ul>
		<li>
			<dl class="content-slide">
			<volist name="user_list" id="w">
				<dd>
					<a href=<if condition="$w['uid']">{pigcms{:U('Invitation/userinfo', array('uid' => $w['uid']))}<else/> javascript:void(0)</if>">
						<figure>
							<div><img src="{pigcms{$w['avatar']}" style="width:80px;height:80px;"/></div>
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
  
  

		
<div style="display: none;text-align: center;height: 30px;margin-top: 15px;" id="show_more" page="2"><a href="javascript:void(0);" style="color: #ED0B8C;">加载更多...</a></div>
<input type="hidden" value="1" id="pageid" />
<input type="hidden" id="canScroll" value="1" />
<input type="hidden" id="sex" value="{pigcms{$sex}" />



<link href="{pigcms{$static_path}css/footer.css" rel="stylesheet"/>		
<script src="{pigcms{$static_path}js/jquery.min1.8.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	/*---------------------加载更多--------------------*/
	var total = {pigcms{$count};
	var sex = $('#sex').val();
	var pagesize = 6;
	var t = 0;
	var pages = Math.ceil(total / pagesize);
	if (pages > 1) {
		var _page = $('#show_more').attr('page');
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				$('#show_more').show().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载中...</a>');
				if (_page > pages) {
					$('#show_more').show().html('<a href="javascript:void(0);" style="color: #ED0B8C;">没有更多了</a>').delay(2300).slideUp(1600);
					return;
				}
				if($('#canScroll').val()==0){//不要重复加载
					return;
				}
				$('#canScroll').attr('value',0);
				$.ajax({
					type : "GET",
					data : {'page' : _page, 'pagesize' : pagesize, 'sex':sex},
					url :  '/wap.php?c=Invitation&a=ajaxmore',
					dataType : "json",
					success : function(RES) {
						$('#canScroll').attr('value',1);
						$('#show_more').hide().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载更多</a>');
						data = RES.data;
						if(data.length){
							$('#show_more').attr('page',parseInt(_page)+1);
						}
						_page = $('#show_more').attr('page');
						var _tmp_html = '';
						$.each(data, function(x, y) {
							_tmp_html += '<dd><a href="/wap.php?c=Invitation&a=userinfo&uid='+ y.uid +'">';
							_tmp_html += '<figure><div><img src="'+ y.avatar +'"  style="width:80px;height:80px;"/></div>';
							_tmp_html += '<figcaption><label style="cursor:pointer;width:60px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">'+ y.nickname +'</label></figcaption>';
							_tmp_html += '</figure>';
							_tmp_html += '</a></dd>';
						});
						$('.content-slide').append(_tmp_html);
					}
				});
			}
		});
	}

});
</script>

<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
</html>