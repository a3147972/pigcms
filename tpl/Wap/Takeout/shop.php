<include file="header" />
<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<style>
dl.list dt, dl.list dd{overflow:inherit}
</style>
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/swipe_min.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<header class="nav">
		<div>
			<a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}">菜单</a>
			<a href="javascript:;" class="on">门店详情</a>
		</div>
	</header>
	<section>
		<div id="imgSwipe" class="img_swipe" style="visibility: visible;">
			<ul style="width: 640px;">
				<volist name="store['images']" id="img">
				<li data-index="0" style="width: 640px; left: 0px; transition-duration: 0ms; -webkit-transition-duration: 0ms; -webkit-transform: translate3d(0px, 0px, 0px);">
				<a href=""><img src="{pigcms{$img}"></a>
				</li>
				</volist>
				<!--li data-index="1" style="width: 640px; left: 0px; transition-duration: 0ms; -webkit-transition-duration: 0ms; -webkit-transform: translate3d(0px, 0px, 0px);">
				<a href=""><img src=""></a>
				</li-->
			</ul>
			<ol id="swipeNum">
				<volist name="store['images']" id="img">
				<if condition="$i eq 1">
				<li class="on"></li>
				<else />
				<li></li>
				</if>
				</volist>
			</ol>
		</div>
		<div class="store_info">
			<!--span><strong>30</strong>送达/分钟</span-->
			<span><strong>{pigcms{$store['basic_price']}</strong>起送价/元</span>
			<span><strong>{pigcms{$store['delivery_fee']}</strong>配送费/元</span>
		</div>
		<ul class="box">
			<li>
				<a href="tel:{pigcms{$store['phone']}">
					<span><i class="ico_tel"></i></span>
					<strong>电话：{pigcms{$store['phone']}</strong>
					<span><i class="ico_arrow"></i></span>
				</a>
			</li>
			<li>
				<a href="http://api.map.baidu.com/geocoder?address={pigcms{$store['adress']}&output=html">
					<span><i class="ico_addres1"></i></span>
					<strong>{pigcms{$store['adress']}</strong>
					<span><i class="ico_arrow"></i></span>
				</a>
			</li>
		</ul>
		<ul class="box">
			<li>营业时间：<volist name="store['office_time']" id="tim"> {pigcms{$tim['open']}~{pigcms{$tim['close']}　　</volist></li>
			<li>服务半径：{pigcms{$store['delivery_radius']}公里</li>
			<li>配送区域：{pigcms{$store['delivery_area']}</li>
		</ul>
		<if condition="!empty($reply_list)">
			<ul class="box">
				<dl class="list" id="deal-feedback">
					<dd>
						<dl>
							<dt>评价<span class="pull-right"><span class="stars"><for start="0" end="5"><if condition="$store['score_mean'] gt $i"><i class="text-icon icon-star"></i><elseif condition="$store['score_mean'] gt $i-1"/><i class="text-icon icon-star-gray"><i class="text-icon icon-star-half"></i></i><else/><i class="text-icon icon-star-gray"></i></if></for><em class="star-text">{pigcms{$now_group.score_mean}</em></span></span></dt>
							<volist name="reply_list" id="vo">
								<dd class="dd-padding">
									<div class="feedbackCard">
										<div class="userInfo">
											<weak class="username">{pigcms{$vo.nickname}</weak>
										</div>
										<div class="score">
											<span class="stars"><for start="0" end="5"><if condition="$vo['score'] gt $i"><i class="text-icon icon-star"></i><else/><i class="text-icon icon-star-gray"></i></if></for></span>
								
											<weak class="time">{pigcms{$vo.add_time}</weak>
										</div>
										<div class="comment">
											<p>{pigcms{$vo.comment}</p>
										</div>
										<if condition="$vo['pics']">
											<div class="pics view_album" data-pics="<volist name="vo['pics']" id="voo">{pigcms{$voo.m_image}<if condition="count($vo['pics']) gt $i">,</if></volist>">
												<volist name="vo['pics']" id="voo">
													<span class="pic-container imgbox" style="background:none;"><img src="{pigcms{$voo.s_image}" style="width:100%;"/></span>&nbsp;
												</volist>
											</div>
										</if>
									</div>
								</dd>
							</volist>
						</dl>
					</dd>
				</dl>
			</ul>
		</if>
	<div style="display: none;text-align: center;height: 30px;margin-top: 15px;" id="show_more" page="2"><a href="javascript:void(0);" style="color: #ED0B8C;">加载更多...</a></div>
	<input type="hidden" id="canScroll" value="1" />
	</section>
	<footer class="go_menu">
		<div class="fixed">
			<a href="{pigcms{:U('Takeout/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}">立即点餐</a>
		</div>
	</footer>
</div>
<include file="kefu" />
<script type="text/javascript">
$(document).ready(function(){
	/*---------------------加载更多--------------------*/
	var total = {pigcms{$store['reply_count']};
	var pagesize = 10;
	var t = 0;
	var pages = Math.ceil(total / pagesize);
	if (pages > 1) {
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				var _page = $('#show_more').attr('page');
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
					data : {'page' : _page, 'pagesize' : pagesize, 'mer_id':{pigcms{$mer_id}, 'store_id':{pigcms{$store_id}},
					url :  '/wap.php?c=Takeout&a=ajaxreply',
					dataType : "json",
					success : function(RES) {
						$('#canScroll').attr('value',1);
						$('#show_more').hide().html('<a href="javascript:void(0);" style="color: #ED0B8C;">加载更多</a>');
						data = RES.data;
						if(data != null && data != ''){
							$('#show_more').attr('page', parseInt(_page)+1);
						}
						var _tmp_html = '';
						$.each(data, function(x, vo) {
							_tmp_html += '<dd class="dd-padding">';
							_tmp_html += '<div class="feedbackCard">';
							_tmp_html += '<div class="userInfo">';
							_tmp_html += '<weak class="username">' + vo.nickname + '</weak>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="score">';
							_tmp_html += '<span class="stars">';
							for (var i = 0; i < 5; i++) {
								if (vo.score > i) {
									_tmp_html += '<i class="text-icon icon-star"></i>';
								} else {
									_tmp_html += '<i class="text-icon icon-star-gray"></i>';
								}
							}
							_tmp_html += '</span>';
						
							_tmp_html += '<weak class="time">' + vo.add_time + '</weak>';
							_tmp_html += '</div>';
							_tmp_html += '<div class="comment">';
							_tmp_html += '<p>' + vo.comment + '</p>';
							_tmp_html += '</div>';
							if (vo.pics != null && vo.pics != '') {
								var pre = '', str = '';
								$.each(vo.pics, function(ii, voo){
									str += pre + voo['m_image'];
									pre = ',';
								});
								_tmp_html += '<div class="pics view_album" data-pics="' + str + '">';
								$.each(vo.pics, function(io, vvo){
									_tmp_html += '<span class="pic-container imgbox" style="background:none;"><img src="' + vvo.s_image + '" style="width:100%;"/></span>&nbsp;';
								});
								_tmp_html += '</div>';
							}
							_tmp_html += '</div>';
							_tmp_html += '</dd>';
						});
						$('#deal-feedback').find('dl').append(_tmp_html);
					}
				});
			}
		});
	}

});
window.shareData = {  
            "moduleName":"Takeout",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Takeout/shop',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
</body>
</html>