<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>{pigcms{$now_group.s_name} | {pigcms{$config.site_name}</title>
	<meta name="keywords" content="{pigcms{$now_group.merchant_name},{pigcms{$now_group.s_name},{pigcms{$config.site_name}" />
	<meta name="description" content="{pigcms{$now_group.intro}" />
	<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
	<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/buy-process.css" />
	<script type="text/javascript">
	 var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
	<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/group_buy.js"></script>
	<!--[if IE 6]>
	<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
	<script type="text/javascript">
	   /* EXAMPLE */
	   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

	   /* string argument can be any CSS selector */
	   /* .png_bg example is unnecessary */
	   /* change it to what suits you! */
	</script>
	<script type="text/javascript">DD_belatedPNG.fix('*');</script>
	<style type="text/css"> 
			body{behavior:url("{pigcms{$static_path}css/csshover.htc"); 
			}
			.category_list li:hover .bmbox {
	filter:alpha(opacity=50);
		 
				}
	  .gd_box{	display: none;}
	</style>
	<![endif]-->
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	<script>var group_price={pigcms{$now_group.price};var finalprice={pigcms{$finalprice};<if condition="$user_session">var is_login=true;<else/>var is_login=false;var login_url="{pigcms{:U('Index/Login/frame_login')}";</if><if condition="$user_session['phone']">var has_phone=true;<else/>var has_phone=false;var phone_url="{pigcms{:U('Index/Login/frame_phone')}";</if></script>
</head>
<body>
 <include file="Public:header_top"/>
	<div class="body pg-buy-process"> 
		<article>
			<div class="menu cf">
				<div class="menu_left hide">
					<div class="menu_left_top"><img src="{pigcms{$static_path}images/o2o1_27.png" /></div>
					<div class="list">
						<ul>
							<volist name="all_category_list" id="vo" key="k">
								<li>
									<div class="li_top cf">
										<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
										<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
									</div>
									<if condition="$vo['cat_count'] gt 1">
										<div class="li_bottom">
											<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
												<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
											</volist>
										</div>
									</if>
								</li>
							</volist>
						</ul>
					</div>
				</div>
				<div class="menu_right cf">
					<div class="menu_right_top">
						<ul>
							<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
								<li class="ctur">
									<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
								</li>
							</pigcms:slider>
						</ul>
					</div>
				</div>
			</div>
		</article>
		<article>
			<div class="sysmsgw common-tip" id="sysmsg-error" style="display:none;"></div>
			<div id="bdw" class="bdw" style="min-height:700px;">
				<div id="bd" class="cf">
					<div id="content">
						<div>
							<div class="buy-process-bar-container">
								<ol class="buy-process-desc steps-desc">
									<li class="step step--current">
										1. 提交订单
									</li>
									<li class="step">
										2. 选择支付方式
									</li>
									<li class="step">
										3. 购买成功
									</li>
								</ol>
								<div class="progress">
									<div class="progress-bar" style="width:33.33%"></div>
								</div>
							</div>
						</div>
						<form action="{pigcms{$config.site_url}/group/buy/{pigcms{$now_group.group_id}.html" method="post" id="deal-buy-form" class="common-form J-wwwtracker-form">
							<div class="mainbox cf">
								<div class="table-section summary-table">
									<table cellspacing="0" class="buy-table" id="menu_list">
										<tr class="order-table-head-row">
											<th class="desc">名称</th>
											<th class="unit-price">单价</th>
											<th class="amount">数量</th>
											<th class="col-total">总价</th>
										</tr> 
										<tr>
											<td class="desc">
												<a href="{pigcms{$now_group.url}" target="_blank">
													{pigcms{$now_group.merchant_name}：{pigcms{$now_group.group_name}
												</a>
											</td>
											<td class="money J-deal-buy-price">¥<span id="deal-buy-price">{pigcms{$now_group.price}</span></td>
											<td class="deal-component-quantity ">
												<button for="J-cart-minus" class="minus" data-action="-" type="button">-</button><input type="text" autocomplete="off" class="f-text J-quantity J-cart-quantity" maxlength="9" name="q" data-max="{pigcms{$now_group.once_max}" data-min="{pigcms{$now_group.once_min}" value="{pigcms{$num}"/><button for="J-cart-add" class="item plus" data-action="+" type="button">+</button>
											</td>
											<td class="money total rightpadding col-total">¥<span id="J-deal-buy-total">{pigcms{$total_price}</span></td>
										</tr>
										<if condition="!empty($leveloff)">
										<tr>
											<td class="desc" colspan="4">
											  <span>
											  您的会员等级是：<strong style="font-size:16px;color:#FF4907">{pigcms{$leveloff['lname']}</strong>
											  </span>
											  <span style="margin-left:450px;">{pigcms{$leveloff['offstr']}&nbsp;&nbsp;优惠后单价为 <strong style="font-size:16px;color:#FF4907">¥{pigcms{$leveloff['price']}</strong>
											  </span>
											  <span class="total-fee" style="left:320px"><strong style="font-size:16px;color:#FF4907">¥<span id="levelofftotal">{pigcms{$total_off_price}</span></strong></span>
											</td>
										 </tr>
										</if>
										<tr>
											<td></td>
											<td colspan="3" class="extra-fee total-fee rightpadding"><strong>应付金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t">{pigcms{$total_off_price}</strong></span>
											</td>
										</tr>
									</table>
								</div>
								<input id="J-deal-buy-cardcode" type="hidden" name="cardcode" maxlength="8" value=""/>							
								<if condition="$user_session">
									<if condition="$now_group['tuan_type'] eq 2">
										<div id="deal-buy-delivery" class="blk-item delivery J-deal-buy-delivery">
											<h3>收货地址<span><a target="_blank" href="{pigcms{:U('User/Adress/index')}">管理</a></span></h3>
											<div id="adress_frame_div">
												<iframe src="{pigcms{:U('Index/Adress/frame')}"></iframe>
											</div>
											
											<input id="buy-adress-id" type="hidden" name="adress_id" value=""/>
											<hr/>
											
											<input type="hidden" id="store_id" name="store_id" value="{pigcms{$store.store_id}"/>
											<h4>给餐厅留言<span>（根据您的喜好口味，给店家留意提醒）</span></h4>
											<input class="f-text comment" type="text" id="note" name="note" />
										</div>
									</if>
								</if>
								<if condition="$user_session['phone']">
									<div class="blk-mobile">
										<p>您绑定的手机号码：<span class="mobile" style="color:#EE3968;">{pigcms{$pigcms_phone}</span></p>
									</div>  
								</if>									
								<div class="form-submit shopping-cart">
									<input type="submit" class="clear-cart btn btn-large btn-buy" id="confirmOrder" value="提交订单" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</article>
	</div>
	<script>
	function change_adress_frame(frame_height){
		$('#adress_frame_div').height(frame_height).find('iframe').css({'opacity':'1','filter':'alpha(opacity=100)'});
	}
	function change_adress(adress_id,username,phone,province_txt,city_txt,area_txt,zipcode){
		$('#buy-adress-id').val(adress_id);
	}
	</script>
	<include file="Public:footer"/>
</body>
</html>
