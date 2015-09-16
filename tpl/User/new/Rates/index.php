<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>待评价{pigcms{$config.group_alias_name}订单 | {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
<link href="{pigcms{$static_path}css/meal_order_list.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/category.js"></script>
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
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
</head>
<body id="settings" class="has-order-nav" style="position:static;">
<include file="Public:header_top"/>
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
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
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/rate-edit.vc3f9a1d2.css" />
				<include file="Public:sidebar"/>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<select class="J-orders-filter orders-filter dropdown--small">
							<option value="{pigcms{:U('Rates/index')}" selected="selected">{pigcms{$config.group_alias_name}</option>
							<option value="{pigcms{:U('Rates/meal')}">{pigcms{$config.meal_alias_name}</option>
						</select>
						<if condition="$order_list">
							<div id="order-list" class="rate-list">
								<div class="component-rate-edit mt-component--booted">
									<div class="rate-edit">
										<volist name="order_list" id="vo">
											<div class="rate-item <if condition="$i eq count($order_list)">rate-item--last</if>">
												<div class="rate-item__title">
													<a href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.s_name}">
														<img src="{pigcms{$vo.list_pic}" width="120" height="80" style="border:1px solid #ccc;"/>
													</a>
												</div>
												<div class="J-rate-content rate-item__content">
													<h3 class="J-deal-title">
														<a href="{pigcms{$vo.url}" title="{pigcms{$vo.s_name}" target="_blank">{pigcms{$vo.s_name}</a>
													</h3>
													<p class="reminding color-weaken">你为本{pigcms{$config.group_alias_name}打几分？</p>
													<div class="form-field J-feedback feedback cf">
														<span class="rating-bar overall-rate">
															<label class="text">我的总体评价：</label>
															<span class="widget-rating"><span data-id="1" class="widget-rating-star-gray"></span><span data-id="2" class="widget-rating-star-gray"></span><span data-id="3" class="widget-rating-star-gray"></span><span data-id="4" class="widget-rating-star-gray"></span><span data-id="5" class="widget-rating-star-gray"></span></span>
															<ins class="widget-rating-intro widget-rating-tips"></ins>
														</span>
														<span class="J-rate-tip rate-tip">请点击星星打分</span>
													</div>
													<form action="{pigcms{:U('Rates/reply_to',array('order_id'=>$vo['order_id']))}" order_id="{pigcms{$vo.order_id}" method="post" class="J-edit-wrapper" style="display:none">
														<input name="score" value="" type="hidden"/>
														<p class="area-tips">（最少评论10字，您的评价将是其他用户的重要参考）亲，您觉得本{pigcms{$config.group_alias_name}怎么样？赶快告诉其他用户吧</p>
														<div class="J-rate-wrapper rate-wrapper">
															<div class="pic-list-wrapper J-pic-list-wrapper">
																<div class="cf">
																	<p class="J-pic-count-tip pic-tip">最多传10张，在上传的时候可选择多张再同时上传</p>
																	<span class="anonymous-check">
																		<input type="checkbox" value="1" id="anonymous-checkbox-{pigcms{$i}" class="select-checkbox checkbox" name="anonymous"/>
																		<label for="anonymous-checkbox-{pigcms{$i}">
																			匿名评价
																		</label>
																	</span>
																</div>
																<ul class="J-pic-list pic-list cf">
																   <li class="pic-item--add pic-item J-item-add">
																		<div class="yui3-widget yui3-uploader">
																			<div class="yui3-uploader-content">
																				<a class="J-pic-add-btn" href="javascript:void(0);" tabindex="0" style="width:100%;height:100%;" order_id="{pigcms{$vo.order_id}"><span class="add-btn-plusicon">+</span><span class="add-btn-text">晒图</span></a>
																			</div>
																		</div>
																	</li>
																</ul>
																<input type="hidden" name="pic_ids" value=""/>
															</div>
															<fieldset>
																<div class="area form-field text-area p-node-wordcounter-wrapper">
																	<textarea rows="5" name="comment" class="f-textarea"></textarea>
																	<span class="p-node-wordcounter" style="bottom:1px;left:10px;display:none;" hidden=""></span>
																</div>
															</fieldset>
															<div id="J-feedback-error-info" class="error-info" style="display:none;">
																<i class="error-info__icon"></i>
																<span class="error-info__msg"></span>
															</div>
														</div>
														<p class="color-weaken">* 请上传原创、真实、合法的图片，如果发现用户上传的图片有侵权内容，我们有权先行删除</p>
														<div class="J-operate operate">
															<input type="submit" class="btn btn-small btn-hot" value="发表评价">
															<a href="javascript:void(0)" class="J-cancel-edit cancel-edit" hidden="" style="display:none">取消</a>
															<span class="J-tip-wrapper tip-wrapper"></span>
														</div>
														<p class="tips"></p>
													</form>
												</div>
											</div>
										</volist>
									</div>
								</div>
							</div>
						<else/>
							<div class="notice">您没有待评价的{pigcms{$config.group_alias_name}订单</div>
						</if>
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
				if($(this).find('.f-textarea').val().length < 10){
					alert('最少评论10字！');
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
