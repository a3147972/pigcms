<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<if condition="$now_group['tuan_type'] neq 2">
			<title>{pigcms{$now_group.merchant_name}</title>
		<else/>
			<title>{pigcms{$now_group.group_name}</title>
		</if>
	<else/>
		<if condition="$now_group['tuan_type'] neq 2">
			<title>【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.s_name}</title>
		<else/>
			<title>【{pigcms{$now_group.group_name}】{pigcms{$now_group.s_name}</title>
		</if>
	</if>
	<meta name="description" content="{pigcms{$now_group.intro}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
	<link rel="shortcut icon" href="{pigcms{$config.site_url}/favicon.ico">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/group_detail_wap.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	<style>
		.swiper-slide{
			display: -webkit-box;
			display: -ms-flexbox;
			overflow: hidden;
			-webkit-box-align: center;
			-webkit-box-pack: center;
			-ms-box-align: center;
			-ms-flex-pack: justify;
		}
		.swiper-slide img{
			width:auto;
			height:auto;
			max-width:100%;
			max-height:90%;
		}
		.swiper-pagination{
			left: 0;
			top: 10px;
			text-align: center;
			bottom:auto;
			right:auto;
			width:100%;
		}
		.swiper-close{
			right:10px;
			top:5px;
			text-align:right;
			position:absolute;
			z-index:21;
			color:white;
			font-size:.7rem;
		}
		span.tag{
			background: #fdb338;
			color: #fff;
			line-height: 1.5;
			display: inline-block;
			padding: 0 .06rem;
			font-size: .24rem;
			border-radius: .06rem;
		}
		
		
		#enter_im_div {
		  bottom: 60px;
		  left:10px;
		  z-index: 11;
		  position: fixed;
		  width: 94px;
		  height:31px;
		}
		#enter_im {
		  width: 94px;
		  position: relative;
		  display: block;
		}
		a {
		  color: #323232;
		  outline-style: none;
		  text-decoration: none;
		}
		#to_user_list {
		  height: 16px;
		  padding: 7px 6px 8px 8px;
		  background-color: #00bc06;
		  border-radius: 25px;
		  /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
		}
		#to_user_list_icon_div {
		  width: 20px;
		  height: 16px;
		  background-color: #fff;
		  border-radius: 10px;
		}
		
		.rel {
		  position: relative;
		}
		.left {
		  float: left;
		}
		.to_user_list_icon_em_a {
		  left: 4px;
		}
		#to_user_list_icon_em_num {
		  background-color: #f00;
		}
		#to_user_list_icon_em_num {
		  width: 14px;
		  height: 14px;
		  border-radius: 7px;
		  text-align: center;
		  font-size: 12px;
		  line-height: 14px;
		  color: #fff;
		  top: -14px;
		  left: 68px;
		}
		.hide {
		  display: none;
		}
		.abs {
		  position: absolute;
		}
		.to_user_list_icon_em_a, .to_user_list_icon_em_b, .to_user_list_icon_em_c {
		  width: 2px;
		  height: 2px;
		  border-radius: 1px;
		  top: 7px;
		  background-color: #00ba0a;
		}
		.to_user_list_icon_em_a {
		  left: 4px;
		}
		.to_user_list_icon_em_b {
		  left: 9px;
		}
		.to_user_list_icon_em_c {
		  right: 4px;
		}
		.to_user_list_icon_em_d {
		  width: 0;
		  height: 0;
		  border-style: solid;
		  border-width: 4px;
		  top: 14px;
		  left: 6px;
		  border-color: #fff transparent transparent transparent;
		}
		#to_user_list_txt {
		  color: #fff;
		  font-size: 13px;
		  line-height: 16px;
		  padding: 1px 3px 0 5px;
		}
	</style>
	<style>.msg-bg{background:rgba(0,0,0,.4);position:absolute;top:0;left:0;width:100%;z-index:998}.msg-doc{position:fixed;left:.16rem;right:.16rem;bottom:15%;border-radius:.06rem;background:#fff;overflow:hidden;z-index:999}.msg-hd{background:#f0efed;color:#333;text-align:center;padding:.28rem 0;overflow:hidden;font-size:.4rem;border-bottom:1px solid #ddd8ce}.msg-bd{font-size:.34rem;padding:.28rem;border-bottom:1px solid #ddd8ce}.msg-toast{background:rgba(0,0,0,.8);font-size:.4rem;color:#fff;border:0;text-align:center;padding:.4rem;-webkit-animation-name:pop-hide;-webkit-animation-duration:5s;border-radius:.12rem;bottom:60%;opacity:0;pointer-events:none}.msg-confirm,.msg-alert{-webkit-animation-name:pop;-webkit-animation-duration:.3s}.msg-option{-webkit-animation-name:slideup;-webkit-animation-duration:.3s}@-webkit-keyframes pop-hide{0%{-webkit-transform:scale(0.8);opacity:0}2%{-webkit-transform:scale(1.1);opacity:1}6%{-webkit-transform:scale(1)}90%{-webkit-transform:scale(1);opacity:1}100%{-webkit-transform:scale(0.9);opacity:0}}@-webkit-keyframes pop{0%{-webkit-transform:scale(0.8);opacity:0}40%{-webkit-transform:scale(1.1);opacity:1}100%{-webkit-transform:scale(1)}}@-webkit-keyframes slideup{0%{-webkit-transform:translateY(100%)}40%{-webkit-transform:translateY(-10%)}100%{-webkit-transform:translateY(0)}}.msg-ft{display:-webkit-box;display:-ms-flexbox;font-size:.34rem}.msg-ft .msg-btn{display:block;-webkit-box-flex:1;-ms-flex:1;margin-right:-1px;border-right:1px solid #ddd8ce;height:.88rem;line-height:.88rem;text-align:center;color:#2bb2a3}.msg-btn:last-child{border-right:0}.msg-option{background:0;bottom:55px;}.msg-option div:first-child,.msg-option .msg-option-btns:first-child .btn:first-child{border-radius:.06rem .06rem 0 0;border-top:0}.msg-option .btn{width:100%;background:#fff;border:0;color:#FF658E;border-radius:0}.msg-option .msg-bd{background:#fff;border-bottom:0}.msg-option .btn{height:.8rem;line-height:.8rem;border-top:1px solid #ccc}.msg-option-btns .btn:last-child{border-radius:0 0 .06rem .06rem;border-bottom:1px solid #ccc}.msg-option .msg-btn-cancel{padding:0;margin-top:.14rem;color:#FF658E;border-radius:.06rem}.msg-dialog .msg-hd{background-color:#fff}.msg-dialog .msg-bd{background-color:#f0efed}.msg-slide{background:0;bottom:0;left:0;right:0;border-radius:0;-webkit-animation-name:slideup;-webkit-animation-duration:.3s}</style>
</head>
<body id="index">
		<if condition="$now_group['end_time'] lt $_SERVER['REQUEST_TIME']">
			<div id="tips" class="tips" style="display:block;">真遗憾！这单{pigcms{$config.group_alias_name}已经结束</div>
		</if>
		<div id="deal" class="deal">
			<div class="list">
			    <div class="album view_album" data-pics="<volist name="now_group['all_pic']" id="vo">{pigcms{$vo.m_image}<if condition="count($now_group['all_pic']) gt $i">,</if></volist>">
			        <img src="{pigcms{$now_group.all_pic.0.m_image}" alt="{pigcms{$now_group.merchant_name}"/>
			        <div class="desc">点击图片查看相册</div>
			    </div>
			    <dl class="list list-in">
			        <dd class="dd-padding buy-price" id="buy_box">
			            <div class="price">
			                <strong class="J_pricetag strong-color">{pigcms{$now_group['price']}</strong><span class="strong-color">元</span>
			                <space></space>
							<del>{pigcms{$now_group.old_price}元</del>
			            </div>
						<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
							<a class="btn buy-btn btn-large btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">立即购买</a>
						</if>
			        </dd>
			        <dd class="dd-padding buy-desc">
			            <h1><if condition="$now_group['tuan_type'] neq 2">{pigcms{$now_group.merchant_name}<else/>{pigcms{$now_group.s_name}</if></h1>
			            <p class="explain">{pigcms{$now_group.intro}</p>
			        </dd>
					<if condition="$now_group['wx_cheap']">
						<ul class="campaign-tip dd-padding">
							<li class="campaign">
								<span class="tag">减</span>&nbsp;<span>微信购买再减 {pigcms{$now_group.wx_cheap} 元</span>
							</li>
						</ul>
					</if>
					<dd class="dd-padding agreement">
			            <ul class="btn-line">
			                <li style="margin:.06rem auto 0;display:block;width:70%;">
								<a class="btn btn-large btn-strong" href="{pigcms{:U('Index/index',array('token'=>$now_group['mer_id']))}" style="font-size:.3rem;width:100%;">进入商家微官网找优惠</a>
			                </li>
			            </ul>
			        </dd>
					<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
			        <dd class="dd-padding agreement">
			            <ul class="agree">
			                <li class="active"><i class="text-icon">◐</i>支持随时退款</li><li class="active"><i class="text-icon">◑</i>支持过期退款</li>
			                <li><i class="text-icon">◒</i>剩余3天以上</li><li><i class="text-icon">◓</i>已售{pigcms{$now_group['sale_count']+$now_group['virtual_num']}</li>
			            </ul>
			            <ul class="btn-line">
			                <li><a class="btn btn-weak btn-block" data-com="share" data-share-text="在{pigcms{$config.site_name}发现一个不错的{pigcms{$config.group_alias_name}哦，您也来看看吧。仅售{pigcms{$now_group['price']-$now_group['wx_cheap']}元!{pigcms{$now_group.merchant_name}" data-share-pic="{pigcms{$now_group.all_pic.0.m_image}"><i class="text-icon icon-share"></i>  分享</a>
			                </li><li><a class="js-fav-btn btn btn-weak btn-block <if condition="$now_group['is_collect']">faved</if>" fav-type="group_detail" fav-id="{pigcms{$now_group.group_id}"><i class="text-icon icon-star"></i><i class="text-icon icon-star-empty"></i><span class="fav-text"></span></a>
			            </li>
			            </ul>
			        </dd>
					</if>
			    </dl>
			</div>
			<dl class="list">
			    <dd>
			        <dl>
			            <dt>商家信息</dt>
			            <dd class="dd-padding">
							<div class="merchant">
							    <div class="biz-detail">
							        <a class="react" href="{pigcms{:U('Group/shop',array('store_id'=>$now_group['store_list'][0]['store_id']))}">
							            <h5 class="title single-line"> {pigcms{$now_group.store_list.0.name}</h5>
							            <div class="address single-line">{pigcms{$now_group.store_list.0.area_name}{pigcms{$now_group.store_list.0.adress}</div>
							        </a>
							    </div>
							    <div class="biz-call">
							        <a class="react phone" href="javascript:void(0);" data-phone="{pigcms{$now_group.store_list.0.phone}"><i class="text-icon">✆</i></a>
							    </div>
							</div>
			            </dd>
			        </dl>
			    </dd>
			    <if condition="count($now_group['store_list']) gt 1">
			        <dd class="db">
			            <a class="react" href="{pigcms{:U('Group/branch',array('group_id'=>$now_group['group_id']))}">
			                <div class="more">查看全部{pigcms{$now_group['store_list']|count=###}家分店</div>
			            </a>
			        </dd>
		        </if>
			</dl>
			<if condition="$now_group['cue_arr']">
				<dl id="deal-terms" class="list">
					<dd>
						<dl>
							<dt>购买须知</dt>
							<dd class="dd-padding">
								<ul class="ul">
									<volist name="now_group['cue_arr']" id="vo">
										<if condition="$vo['value']">
											<li><b>{pigcms{$vo.key}：</b>{pigcms{$vo.value|nl2br=###}</li>
										</if>
									</volist>
								</ul>
							</dd>
						</dl>
					</dd>
				</dl>
			</if>
			<dl id="deal-details" class="list">
			    <dt>本单详情</dt>
                <dd class="dd-padding group_content">
                    {pigcms{$now_group.content}
                </dd>
			</dl>
			<if condition="!empty($reply_list)">
				<dl class="list" id="deal-feedback">
					<dd>
						<dl>
							<dt>评价<span class="pull-right"><span class="stars"><for start="0" end="5"><if condition="$now_group['score_mean'] gt $i"><i class="text-icon icon-star"></i><elseif condition="$now_group['score_mean'] gt $i-1"/><i class="text-icon icon-star-gray"><i class="text-icon icon-star-half"></i></i><else/><i class="text-icon icon-star-gray"></i></if></for><em class="star-text">{pigcms{$now_group.score_mean}</em></span></span></dt>
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
										<if condition="$vo['store_name']">
											<div>
												<weak>{pigcms{$vo.store_name}</weak>
											</div>
										</if>
									</div>
								</dd>
							</volist>
						</dl>
					</dd>
					<if condition="count($reply_list) gt 3">
						<dd class="buy-comments db">
							<a class="react" href="{pigcms{:U('Group/feedback',array('group_id'=>$now_group['group_id']))}">
								<div class="more">
									查看全部{pigcms{$now_group.reply_count}条评价
								</div>
							</a>
						</dd>
					</if>
				</dl>
			</if>
			<if condition="$now_group['end_time'] gt $_SERVER['REQUEST_TIME']">
				<div class="btn-wrapper">
					<a class="btn buy-btn btn-block btn-larger btn-strong" href="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">立即购买</a>
				</div>
			</if>
			<div id="recommand">
				<if condition="$merchant_group_list">
				    <dl class="list">
						<dd>
							<dl class="list">
							     <dt>商家其他{pigcms{$config.group_alias_name}</dt>
							     <volist name="merchant_group_list" id="vo">
								     <dd>
								     	<a href="{pigcms{$vo.url}" class="react">
								            <div class="simpleCard">
									            <div class="dealcard">
									          	  	<span class="dealtype-icon">团</span>
												    <div class="dealcard-block-right">
														<if condition="$vo['tuan_type'] neq 2">
															<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
														<else/>
															<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
														</if>
												        <div class="price">
												            <strong>{pigcms{$vo['price']}</strong>
												            <span class="strong-color">元</span>
												            <if condition="$vo['wx_cheap']">
												           		<span class="tag">微信立减{pigcms{$vo.wx_cheap}</span>
												            <else/>
												            	<del>{pigcms{$vo.old_price}元</del>
												            </if>
												            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>
												        </div>
												    </div>
												</div>
											</div>
								        </a>
								     </dd>
							     </volist>
							</dl>
				        </dd>
				    </dl>
			    </if>
			    <if condition="$category_group_list">
				    <dl class="list">
				        <dd>
							<dl class="list">
							    <dt>看了本{pigcms{$config.group_alias_name}的用户还看了</dt>
							    <volist name="category_group_list" id="vo">
								    <dd>
								    	<a href="{pigcms{$vo.url}" class="react">
											<div class="dealcard">
										        <div class="dealcard-img imgbox">
										        	<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;"/>
										        </div>
											    <div class="dealcard-block-right">
											        <if condition="$vo['tuan_type'] neq 2">
														<div class="dealcard-brand single-line">{pigcms{$vo.merchant_name}</div>
														<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
													<else/>
														<div class="dealcard-brand single-line">{pigcms{$vo.s_name}</div>
														<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
													</if>
											        <div class="price">
											            <strong>{pigcms{$vo['price']}</strong><span class="strong-color">元</span>
											            <if condition="$vo['wx_cheap']">
											           		<span class="tag">微信立减{pigcms{$vo.wx_cheap}</span>
											            <else/>
											            	<del>{pigcms{$vo.old_price}元</del>
											            </if>
											            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>
											        </div>
											    </div>
											</div>
								        </a>
								     </dd>
							     </volist>  
							</dl>
				        </dd>
				    </dl>
			    </if>
			</div>
		</div>
		<div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
		<a id="enter_im" data-url="{pigcms{$kf_url}">
		<div id="to_user_list">
		<div id="to_user_list_icon_div" class="rel left">
		<em class="to_user_list_icon_em_a abs">&nbsp;</em>
		<em class="to_user_list_icon_em_b abs">&nbsp;</em>
		<em class="to_user_list_icon_em_c abs">&nbsp;</em>
		<em class="to_user_list_icon_em_d abs">&nbsp;</em>
		<em id="to_user_list_icon_em_num" class="hide abs">0</em>
		</div>
		<p id="to_user_list_txt" class="left" style="font-size:12px">联系客服</p>
		</div>
		</a>
		</div>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>	
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script>var static_path="{pigcms{$static_path}";var collect_url="{pigcms{:U('Collect/collect')}";var group_id="{pigcms{$now_group.group_id}";</script>
		<script src="{pigcms{$static_path}js/group_detail.js"></script>
		<include file="Public:footer"/>
		
<script type="text/javascript">
$(document).ready(function(){
	var mousex = 0, mousey = 0;
	var divLeft = 0, divTop = 0, left = 0, top = 0;
	document.getElementById("enter_im_div").addEventListener('touchstart', function(e){
		e.preventDefault();
		var offset = $(this).offset();
		divLeft = parseInt(offset.left,10);
		divTop = parseInt(offset.top,10);
		mousey = e.touches[0].pageY;
		mousex = e.touches[0].pageX;
		return false;
	});
	document.getElementById("enter_im_div").addEventListener('touchmove', function(event){
		event.preventDefault();
		left = event.touches[0].pageX-(mousex-divLeft);
		top = event.touches[0].pageY-(mousey-divTop)-$(window).scrollTop();
		if(top < 1){
			top = 1;
		}
		if(top > $(window).height()-(50+$(this).height())){
			top = $(window).height()-(50+$(this).height());
		}
		if(left + $(this).width() > $(window).width()-5){
			left = $(window).width()-$(this).width()-5;
		}
		if(left < 1){
			left = 1;
		}
		$(this).css({'top':top + 'px', 'left':left + 'px', 'position':'fixed'});
		return false;
	});
	document.getElementById("enter_im_div").addEventListener('touchend', function(event){
		if ((divLeft == left && divTop == top) || (top == 0 && left == 0)) {
			var url = $('#enter_im').attr('data-url');
			if (url == '' || url == null) {
				alert('商家暂时还没有设置客服');
			} else {
				location.href=$('#enter_im').attr('data-url');
			}
		}
		return false;
	});

	$('#enter_im_div').click(function(){
		var url = $('#enter_im').attr('data-url');
		if (url == '' || url == null) {
			alert('商家暂时还没有设置客服');
		} else {
			location.href=$('#enter_im').attr('data-url');
		}
	});
});
</script>
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Group",
            "moduleID":"0",
            "imgUrl": "{pigcms{$now_group.all_pic.0.m_image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Group/detail', array('group_id' => $now_group['group_id']))}",
            "tTitle": "【{pigcms{$now_group.merchant_name}】{pigcms{$now_group.s_name}",
            "tContent": ""
};
</script>
{pigcms{$shareScript}
</body>
</html>