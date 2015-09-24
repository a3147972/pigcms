<include file="Food:header"/>
<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
<style>
dl.list dt, dl.list dd{overflow:inherit}
</style>
<body onselectstart="return true;" ondragstart="return false;">
	<div data-role="container" class="container businessHours">
	<header data-role="header">	
	<if condition="isset($store['images'][0])">
	  <a href="{pigcms{:U('Food/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
	  <img src="{pigcms{$store['images'][0]}" style="width: 100%;">
	  </a>
	</if>
	</header>
	<section data-role="body" class="section_scroll_content">
		<ul class="pay">
			<li class="title"><a><span class="icon time"></span>营业时间</a></li>
			<li>
			<volist name="store['office_time']" id="row" key="i">
			{pigcms{$row['open']}-{pigcms{$row['close']}<br/>
			</volist>
			</li>
		</ul>
		<ul class="pay">
			<li class="title"><a><span class="icon mark"></span>餐厅简介</a></li>
			<li style="color:#000000;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;font-size:12px;font-style:normal;font-weight:normal;line-height:18px;">
			<php>echo html_entity_decode(htmlspecialchars_decode($store['txt_info']),ENT_QUOTES,"UTF-8");</php>
			</li>
		</ul>
		<if condition="!empty($reply_list)">
			<ul class="pay">
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
	<footer data-role="footer"></footer>
</div>
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
					url :  '/wap.php?c=Food&a=ajaxreply',
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
            "moduleName":"Food",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Food/index',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
</body>
</html>