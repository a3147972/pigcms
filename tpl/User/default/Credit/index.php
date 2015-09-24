<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>我的余额 | {pigcms{$config.site_name}</title>
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
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>	
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
</head>
<body id="credit" class="has-order-nav" style="position:static;">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/account.v1a41925d.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/table-section.v538886b7.css" />
				<div class="component-order-nav mt-component--booted">
					<div class="side-nav J-order-nav">
						<div class="J-side-nav__user side-nav__user cf">
							<a href="javascript:void(0);" title="帐户设置" class="J-user item user">
								<img src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/user-default-avatar.png</if>" width="30" height="30" alt="{pigcms{$now_user.nickname}头像"/>
							</a>
							<div class="item info">
								<div class="info__name" style="height:36px;line-height:36px;">{pigcms{$now_user.nickname}</div>
							</div>
						</div>
						<div class="side-nav__account cf">
							<a class="item item--first" href="{pigcms{:U('Credit/index')}" title="{pigcms{$now_user.now_money}">{pigcms{$now_user.now_money}<span>余额</span></a>
							<a class="item" href="{pigcms{:U('Point/index')}" title="{pigcms{$now_user.score_count}">{pigcms{$now_user.score_count}<span>积分</span></a>
						</div>
						<dl class="side-nav__list">
							<dt class="first-item"><strong>我的订单</strong></dt>
							<dd>
								<ul class="item-list">
									<li><a href="{pigcms{:U('Index/index')}">{pigcms{$config.group_alias_name}订单</a></li>
									<li><a href="{pigcms{:U('Index/meal_list')}">{pigcms{$config.meal_alias_name}订单</a></li>
									<li><a href="{pigcms{:U('Collect/index')}">我的收藏</a></li>
								</ul>
							</dd>
							<dt><strong>我的评价</strong></dt>
							<dd>
								<ul class="item-list">
									<li><a href="{pigcms{:U('Rates/index')}">待评价</a></li>
									<li><a href="{pigcms{:U('Rates/rated')}">已评价</a></li>
								</ul>
							</dd>
							<dt><strong>我的账户</strong></dt>
							<dd class="last">
								<ul class="item-list">
									<li><a href="{pigcms{:U('Point/index')}">我的积分</a></li>
									<li class="current"><a href="{pigcms{:U('Credit/index')}">我的余额</a></li>
									<li><a href="{pigcms{:U('Adress/index')}">收货地址</a></li>
								</ul>
							</dd>
						</dl>
					</div>
				</div>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<div class="balance">您当前的余额： <strong>¥{pigcms{$now_user.now_money}</strong></div>
						<ul class="filter cf">
							<li class="current"><a href="{pigcms{:U('Credit/index')}">余额记录</a></li>
						</ul>
						<div class="table-section">
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<th width="130">时间</th>
									<th width="auto">详情</th>
									<th width="110">金额（元）</th>
								</tr>
								<volist name="money_list" id="vo">
									<tr>
										<td>{pigcms{$vo.time|date='Y-m-d H:i:s',###}</td>
										<td class="detail">{pigcms{$vo.desc}</td>
										<if condition="$vo['type'] eq 1">
											<td class="income">+{pigcms{$vo.money}</td>
										<else/>
											<td class="expense">-{pigcms{$vo.money}</td>
										</if>
									</tr>
								</volist>
							</table>
						</div>
						{pigcms{$pagebar}
                    </div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>
	<include file="Public:footer"/>
	<style>
		.webuploader-container{
			position:relative;
		}
		.webuploader-element-invisible{
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px,1px,1px,1px);
		}
		.webuploader-pick{
			position: relative;
			display: inline-block;
			cursor: pointer;
			color: #fff;
			text-align: center;
			border-radius: 3px;
			overflow: hidden;
			width:100%;
			height:100%;
		}
		.webuploader-pick-disable{
			opacity: 0.6;
			pointer-events:none;
		}
		.p-node-wordcounter {
			position: absolute;
			padding: 1px 5px;
			line-height: 18px;
			font-size: 12px;
			color: #FFF;
			background: #0B0;
			border-radius: 0 0 3px 3px;
		}
	</style>
	<script src="{pigcms{$static_public}js/webuploader.min.js"></script>
	<script>
		$(function(){
			if ( !WebUploader.Uploader.support() ) {
				alert( '您的浏览器不支持晒图功能！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
				$('.J-pic-list-wrapper').remove();
			}
			$('.J-orders-filter').change(function(){
				window.location.href = $(this).val();
			});
			
			var pic_btn_obj = null;
			$('.J-pic-add-btn').click(function(){
				pic_btn_obj = $(this);
			});
			var  uploader = WebUploader.create({
				auto: true,
				swf: '{pigcms{$static_public}js/Uploader.swf',
				server: "{pigcms{:U('Rates/ajax_upload_pic')}",
				pick: '.J-pic-add-btn',
				accept: {
					title: 'Images',
					extensions: 'gif,jpg,jpeg,png',
					mimeTypes: 'image/*'
				}
			});
			uploader.on('fileQueued',function(file){
				if(pic_btn_obj.closest('.J-pic-list').find('.J-pic-thumbnail,.pic-item--loading').size() < 10){
					pic_btn_obj.closest('.J-pic-list-wrapper').addClass('pic-list-wrapper--withpic');
					var pic_loading_dom = $('<li>').attr('class','J-pic-thumbnail pic-item pic-item--loading loading-'+file.id);
					
					if(pic_btn_obj.closest('.J-pic-list').find('.J-pic-thumbnail').size() > 1){
						pic_btn_obj.closest('.J-pic-list').find('.J-pic-thumbnail:last').after(pic_loading_dom);
					}else{
						pic_btn_obj.closest('.J-pic-list').prepend(pic_loading_dom);
					}
				}else{
					uploader.cancelFile(file);
				}
			});
			uploader.on('uploadProgress',function(file,percentage){
				
			});
			uploader.on('uploadBeforeSend',function(block,data){
				data.order_id = pic_btn_obj.attr('order_id');
				data.order_type = 0;
			});
			
			uploader.on('uploadSuccess',function(file,response){
				if(response['result'].error_code == '0'){
					var pic_ids = $('.loading-'+response['id']).closest('.J-pic-list-wrapper').find('input[name="pic_ids"]');
					if(pic_ids.val().length == 0){
						pic_ids.val(response['result'].pigcms_id);
					}else{
						pic_ids.val(pic_ids.val()+','+response['result'].pigcms_id);
					}
					$('.loading-'+response['id']).replaceWith('<li class="J-pic-thumbnail pic-item"><img src="'+response['result'].url+'" width="41" height="41" alt="'+file.name+'"/><a href="javascript:void(0);" class="pic-item__remove" order-id="'+response['result'].order_id+'" pic-id="'+response['result'].pigcms_id+'" uploader_id="'+file.id+'" hidden="hidden" style="display:none;"></a></li>');
				}else{
					$('.loading-'+response['id']).remove();
					alert(response['error'].message);
				}
			});

			uploader.on('uploadError', function(file,reason){
				$('.loading'+file.id).remove();
				alert('上传失败！请重试。');
			});
			
			//已上传图片点击
			$('.J-pic-thumbnail').live('hover',function(event){
				if(event.type == 'mouseenter'){ 
					$(this).find('.pic-item__remove').show();
				}else{
					$(this).find('.pic-item__remove').hide();
				}
			});
			$('.pic-item__remove').live('click',function(){
				var now_dom = $(this);
				$.post("{pigcms{:U('Rates/ajax_del_pic')}",{order_id:now_dom.attr('order-id'),pic_id:now_dom.attr('pic-id')});
				var pic_ids = now_dom.closest('.J-pic-list-wrapper').find('input[name="pic_ids"]');
				pic_ids_arr = pic_ids.val().split(',');
				var new_pic_ids_arr = new Array();
				$.each(pic_ids_arr,function(i,item){
					if(item != now_dom.attr('pic-id')){
						new_pic_ids_arr.push(item);
					}
				});
				pic_ids.val(new_pic_ids_arr.join(','));
				now_dom.closest('.J-pic-thumbnail').remove();
				uploader.cancelFile(now_dom.attr('uploader_id'));
			});
	
			//星星点击
			$('.widget-rating span').mouseover(function(){
				var siblings_dom = $(this).closest('.widget-rating').find('span');
				var rate_data = $(this).attr('data-id');
				siblings_dom.removeClass('widget-rating-star').addClass('widget-rating-star-gray')
				$(this).closest('.widget-rating').find('span:lt('+rate_data+')').removeClass('widget-rating-star-gray').addClass('widget-rating-star');
			}).mouseout(function(){
				var siblings_dom = $(this).closest('.widget-rating').find('span');
				var rate_data = $(this).closest('.widget-rating').data('rate_data');
				if(parseInt(rate_data) < 1) rate_data = 0;
				siblings_dom.removeClass('widget-rating-star').addClass('widget-rating-star-gray')
				$(this).closest('.widget-rating').find('span:lt('+rate_data+')').removeClass('widget-rating-star-gray').addClass('widget-rating-star');
			}).click(function(){
				var siblings_dom = $(this).closest('.widget-rating').find('span');
				var rate_data = $(this).attr('data-id');
				$(this).closest('.widget-rating').data('rate_data',rate_data);
				$(this).closest('.J-rate-content').find('input[name="score"]').val(rate_data);
				var form_wrap = $(this).closest('.J-rate-content').find('.J-edit-wrapper');
				if(!form_wrap.hasClass('is_show')){
					form_wrap.addClass('is_show').show().find('.f-textarea').focus();
					$.post("{pigcms{:U('Rates/del_invalid_pic')}",{order_id:form_wrap.attr('order_id'),order_type:0});
				}
			});
			
			//评论文本输入
			$('.f-textarea').focus(function(){
				var wordcounter = $(this).closest('fieldset').find('.p-node-wordcounter');
				if($(this).val().length == 0){
					wordcounter.html('还可输入<strong>500</strong>个字。');
				}
				wordcounter.show();
			}).blur(function(){
				$(this).closest('fieldset').find('.p-node-wordcounter').hide();
			}).keyup(function(){
				var wordcounter = $(this).closest('fieldset').find('.p-node-wordcounter');
				var txt_length = $(this).val().length;
				if(txt_length > 500){
					wordcounter.html('已超出'+(txt_length-500)+'字。');
				}else{
					wordcounter.html('还可输入<strong>'+(500-txt_length)+'</strong>个字。');
				}
			});
			
			//表单提交
			$('.J-edit-wrapper').submit(function(){
				if($(this).find('.pic-item--loading').size() > 0){
					alert('请等待图片上传完成！');
					return false;
				}
				if($(this).find('.f-textarea').val().length < 15){
					alert('最少评论15字！');
					return false;
				}
				if($(this).find('input[name="score"]').val().length == 0){
					alert('请先评分！');
					return false;
				}
				$.post($(this).attr('action'),$(this).serialize()+'&order_type=0',function(result){
					alert(result.info);
					if(result.status == 1){
						window.location.href = window.location.href;
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>
