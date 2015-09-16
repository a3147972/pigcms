<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$store.name} | {pigcms{$config.site_name}</title>
	<meta name="keywords" content="{pigcms{$store.name},{pigcms{$config.site_name}" />
	<meta name="description" content="{pigcms{$store.txt_info}" />
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
	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
	
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	<script><if condition="$user_session">var is_login=true;<else/>var is_login=false;var login_url="{pigcms{:U('Index/Login/frame_login')}";</if><if condition="$user_session['phone']">var has_phone=true;<else/>var has_phone=false;var phone_url="{pigcms{:U('Index/Login/frame_phone')}";</if></script>
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
		            <div class="mainbox cf">
		            	<div class="table-section summary-table">
		                    <table cellspacing="0" class="buy-table" id="menu_list">
				                <volist name="food_list" id="food">    
								<tr>
									<td class="desc">{pigcms{$food['food_name']}</td>
									<td class="money J-deal-buy-price">¥<span id="deal-buy-price">{pigcms{$food['price']}</span></td>
									<td class="deal-component-quantity ">{pigcms{$food['count']}</td>
									<td class="money total rightpadding col-total">¥<span id="J-deal-buy-total">{pigcms{$food['total']}</span></td>
								</tr>
								</volist>
			
								<tr>
									<td></td>
									<td colspan="3" class="extra-fee total-fee rightpadding"><strong>应付金额</strong>：<span class="inline-block money">¥<strong id="deal-buy-total-t">{pigcms{$total}</strong></span>
									</td>
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
		                	<input type="button" class="clear-cart btn btn-large btn-buy" id="confirmOrder" value="提交订单" >
		            	</div>
		             </div>
				</div>
    		</div>
    		<!-- bd end -->
		</div>
	</div>
	<include file="Public:footer"/>
	
<script type="text/javascript">
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
				window.location.href = data.data;
				clearCache();
			}
		}, 'json');
	});
});

</script>
</body>
</html>
