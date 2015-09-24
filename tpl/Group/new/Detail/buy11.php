<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$now_group.s_name} | {pigcms{$config.site_name}</title>
	<meta name="keywords" content="{pigcms{$now_group.merchant_name},{pigcms{$now_group.s_name},{pigcms{$config.site_name}" />
	<meta name="description" content="{pigcms{$now_group.intro}" />
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.v113ea197.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.v492b572b.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/search-box.v6656b683.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/cate-nav.v4299f875.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/filter.ved243bd9.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deallist.v49c087a6.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/side.v4cfd6eb1.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/banner-index.v8c9e126d.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.veda7cace.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ratelist.v4b84fddf.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/table-section.v538886b7.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/buy.v7e9b9347.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.v8aefdc77.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/calendar.v2624266d.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/buy-process.v708a2124.css" />
		<script type="text/javascript">
	var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
	
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	
	<script>var group_price={pigcms{$now_group.price};<if condition="$user_session">var is_login=true;<else/>var is_login=false;var login_url="{pigcms{:U('Index/Login/frame_login')}";</if><if condition="$user_session['phone']">var has_phone=true;<else/>var has_phone=false;var phone_url="{pigcms{:U('Index/Login/frame_phone')}";</if></script>
	<script src="{pigcms{$static_path}js/group_buy.js"></script>
	<style>.pg-buy-process .site-mast__branding{height:112px;}</style>
</head>
<body id="deal-buy" class="pg-buy pg-buy-process">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
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
			                    <table cellspacing="0" class="buy-table">
			                        <tr class="order-table-head-row">
			                        	<th class="desc">项目</th>
			                        	<th class="unit-price">单价</th>
                                        <th class="amount">数量</th>
                                        <th class="col-total">总价</th>
			                    	</tr>
			                        <tr>
				                        <td class="desc">
				                        	<a href="{pigcms{$now_group.url}" target="_blank">{pigcms{$now_group.merchant_name}：{pigcms{$now_group.group_name}</a>
				                        </td>
				                        <td class="money J-deal-buy-price">
				                            ¥<span id="deal-buy-price">{pigcms{$now_group.price}</span>
				                        </td>
				                        <td class="deal-component-quantity ">
				                            <button for="J-cart-minus" class="minus" data-action="-" type="button">-</button><input type="text" autocomplete="off" class="f-text J-quantity J-cart-quantity" maxlength="9" name="q" data-max="{pigcms{$now_group.once_max}" data-min="{pigcms{$now_group.once_min}" value="{pigcms{$num}"/><button for="J-cart-add" class="item plus" data-action="+" type="button">+</button>
				                        </td>
				                        <td class="money total rightpadding col-total">
                                            ¥<span id="J-deal-buy-total">{pigcms{$total_price}</span>
                                        </td>
				                    </tr>
			                        <tr>
			                        	<td></td>
				                        <td colspan="3" class="extra-fee total-fee rightpadding">
				                            <strong>应付金额</strong>：
				                            <span class="inline-block money">
				                                ¥<strong id="deal-buy-total-t">{pigcms{$total_price}</strong>
				                            </span>
				                        </td>
			                    	</tr>
			                	</table>
			            	</div>
							<if condition="$user_session">
								<if condition="$now_group['tuan_type'] eq 2">
									<div id="deal-buy-delivery" class="blk-item delivery J-deal-buy-delivery">
										<h3>收货地址<span><a target="_blank" href="{pigcms{:U('User/Adress/index')}">管理</a></span></h3>
										<div id="adress_frame_div">
											<iframe src="{pigcms{:U('Index/Adress/frame')}"></iframe>
										</div>
										<input id="buy-adress-id" type="hidden" name="adress_id" value=""/>
										<hr/>
										<h4>希望送货的时间</h4>
										<ul class="delivery-type">
											<li>
												<input checked="checked" id="delivery_type-1" value="1" type="radio" name="delivery_type" class="select-radio">
												<label for="delivery_type-1">工作日、双休日与假日均可送货</label>
											</li>
											<li>
												<input id="delivery_type-2" value="2" type="radio" name="delivery_type" class="select-radio">
												<label for="delivery_type-2">只工作日送货(双休日、假日不用送，写字楼/商用地址客户请选择)</label>
											</li>
											<li>
												<input id="delivery_type-3" value="3" type="radio" name="delivery_type" class="select-radio">
												<label for="delivery_type-3">只双休日、假日送货(工作日不用送)</label>
											</li>
											<li>
												<input id="delivery_type-4" value="4" type="radio" name="delivery_type" class="select-radio">
												<label for="delivery_type-4">白天没人，其它时间送货 (特别安排可能会超出预计送货天数)</label>
											</li>
										</ul>
										<hr>
										<h4>配送说明<span>（快递公司由商家根据情况选择，请不要指定。其他要求配送公司会尽量协调）</span></h4>
										<input class="f-text comment" type="text" id="delivery_comment" name="delivery_comment" />
									</div>
								</if>
								<if condition="$user_session['phone']">
									<div class="blk-mobile">
										<p>您绑定的手机号码：<span class="mobile" style="color:#EE3968;">{pigcms{$pigcms_phone}</span></p>
									</div>
								</if>
							</if>
					        <div class="form-submit">
			                	<input type="submit" class="btn btn-large btn-buy" name="buy" value="提交订单" />
			            	</div>
			             </div>
			    	</form>
				</div>
    		</div>
    		<!-- bd end -->
		</div>
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
