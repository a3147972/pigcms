<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}"/>
<meta name="description" content="{pigcms{$config.seo_description}"/>

<link href="{pigcms{$static_path}css/css.css" type="text/css" rel="stylesheet"/>
<link href="{pigcms{$static_path}css/header.css" rel="stylesheet" type="text/css"/>
<link href="{pigcms{$static_path}css/buy-process.css" rel="stylesheet" type="text/css"/>
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script><if condition="$user_session">var is_login=true;<else/>var is_login=false;var login_url="{pigcms{:U('Index/Login/frame_login')}";</if><if condition="$user_session['phone']">var has_phone=true;<else/>var has_phone=false;var phone_url="{pigcms{:U('Index/Login/frame_phone')}";</if></script>
<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
.category_list li:hover .bmbox {filter:alpha(opacity=50);}
.gd_box{display: none;}
</style>
<![endif]-->
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
					            <div class="mainbox cf">
					            	<div class="table-section summary-table">
					                    <table cellspacing="0" class="buy-table" id="menu_list">
					                        <tr class="order-table-head-row">
					                        	<th class="desc">名称</th>
					                        	<th class="unit-price">单价</th>
		                                        <th class="amount">数量</th>
		                                        <th class="col-total">总价</th>
					                    	</tr>
							                <volist name="food_list" id="food">    
											<tr>
												<td class="desc">{pigcms{$food['food_name']}</td>
												<td class="money J-deal-buy-price">¥<span id="deal-buy-price">{pigcms{$food['price']}</span></td>
												<td class="deal-component-quantity ">{pigcms{$food['count']}</td>
												<td class="money total rightpadding col-total">¥<span id="J-deal-buy-total">{pigcms{$food['total']}</span></td>
											</tr>
											</volist>
						
											<tr>
											 <if condition="!empty($leveloff)">
												<td>
												<span>
											    您的会员等级是：<strong style="font-size:16px;color:#FF4907">{pigcms{$leveloff['lname']}</strong>
											   </span>
											   <span style="margin-left:375px;">{pigcms{$leveloff['offstr']}</span></td>
												<td colspan="3" class="extra-fee total-fee rightpadding">
												<div>
												<del><strong>应付金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t">{pigcms{$total}</strong></span></del>
												</div>
												<div>
												<strong>优惠后应付金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t">{pigcms{$finaltotalprice}</strong></span>
												</div>
											  </td>
											 <else />
											    <td></td>
												<td colspan="3" class="extra-fee total-fee rightpadding">
												<div>
												<strong>总金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t">{pigcms{$total}</strong></span>
												</div>
												<if condition="$minus_money gt 0">
												<div>
												<strong>满￥{pigcms{$full_money}减</strong>：<span class="inline-block money">-<strong id="deal-buy-total-t">{pigcms{$minus_money}</strong></span>
												</div>
												<div>
												<strong>优惠后应付金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t">{pigcms{$total - $minus_money}</strong></span>
												</div>
												</if>
												</td>
											 </if>
											</tr>
					                	</table>
					            	</div>
					            	<input id="J-deal-buy-cardcode" type="hidden" name="cardcode" maxlength="8" value=""/>
					            	
									<if condition="$user_session">
									<div id="deal-buy-delivery" class="blk-item delivery J-deal-buy-delivery">
										<h3>收货地址<span><a target="_blank" href="{pigcms{:U('User/Adress/index')}">管理</a></span></h3>
										<div id="adress_frame_div">
											<iframe src="{pigcms{:U('Index/Adress/frame')}"></iframe>
										</div>
										
										<input id="buy-adress-id" type="hidden" name="adress_id" value=""/>
										<hr/>
										
										<input type="hidden" id="store_id" name="store_id" value="{pigcms{$store.store_id}">
										<h4>给餐厅留言<span>（根据您的喜好口味，给店家留意提醒）</span></h4>
										<input class="f-text comment" type="text" id="note" name="note" />
									</div>
									</if>
					            	<div class="blk-mobile" style="display: none">
		            					<p>您绑定的手机号码：<span class="mobile" style="color:#EE3968;">{pigcms{$pigcms_phone}</span></p>
							        </div>         
							        <div class="form-submit shopping-cart">
					                	<input type="submit" class="clear-cart btn btn-large btn-buy" id="confirmOrder" value="提交订单" >
					            	</div>
					             </div>
						</div>
		    		</div>
		    		<!-- bd end -->
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
	$(document).ready(function(){
		$("#confirmOrder").click(function(){
			if(is_login == false){
				art.dialog.open(login_url,{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('iframe_handle',iframe);
					},
					id: 'handle',
					title:'登录',
					padding: '30px',
					width: 438,
					height: 500,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					opacity:'0.4'
				});
				return false;
			}
			if(has_phone == false){
				art.dialog.open(phone_url,{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('iframe_handle',iframe);
					},
					id: 'handle',
					title:'绑定手机号码',
					padding: '30px',
					width: 438,
					height: 500,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					opacity:'0.4'
				});
				return false;
			}
			
			var products = '{pigcms{$shop_cart}';
			var phone = $("#phone").val();
			var name = $("#name").val();
			var address = $("#address").val();
			var note = $("#note").val();
			$.post("{pigcms{:U('Meal/Order/saveorder')}", {'store_id':$('#store_id').val(), 'products':products, 'address_id':$('#buy-adress-id').val(), 'note':note}, function(data){
				if (data.error_code == 1) {
					alert(data.msg);
				} else {
					$.cookie("meal_list", '', {expires:365, path:"/"});
					window.location.href = data.data;
				}
			}, 'json');
		});
	});
	</script>
	<include file="Public:footer"/>
</body>
</html>
