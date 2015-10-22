<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>待评价<?php echo ($config["group_alias_name"]); ?>订单 | <?php echo ($config["site_name"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/css.css" type="text/css"  rel="stylesheet" />
<link href="<?php echo ($static_path); ?>css/header.css"  rel="stylesheet"  type="text/css" />
<link href="<?php echo ($static_path); ?>css/meal_order_list.css"  rel="stylesheet"  type="text/css" />
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_public); ?>js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	</script>
<script src="<?php echo ($static_path); ?>js/common.js"></script>
<script src="<?php echo ($static_path); ?>js/category.js"></script>
<!--[if IE 6]>
<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
body{behavior:url("<?php echo ($static_path); ?>css/csshover.htc");}
.category_list li:hover .bmbox {filter:alpha(opacity=50);}
.gd_box{display: none;}
</style>
<![endif]-->
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
</head>
<body id="settings" class="has-order-nav" style="position:static;">
<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
				</p><?php endif; ?>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
			</div>
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="<?php echo U('User/Index/index');?>">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="<?php echo U('User/Index/index');?>">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf">
    <div class="nav cf">
		<div class="logo">
			<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
				<img src="<?php echo ($config["site_logo"]); ?>" />
			</a>
		</div>
		<div class="search">
			<form action="<?php echo U('Meal/Search/index');?>" method="post">
				<div class="form_sec">
					<div class="form_sec_txt"><?php echo ($config["group_alias_name"]); ?></div>
					<div class="form_sec_txt1"><?php echo ($config["meal_alias_name"]); ?></div>
				</div>
				<input name="w" class="input" type="text" value="<?php echo ($keywords); ?>" placeholder="请输入商品名称、地址等"/>
				<button value="" class="btnclick" type="submit"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
			</form>
			<div class="search_txt">
				<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="menu">
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
			  <div class="ment_left_txt">随时退</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
			  <div class="ment_left_txt">不满意免单</div>
			</div>
			<div class="ment_left">
			  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
			  <div class="ment_left_txt">过期退</div>
			</div>
		</div>
    </div>
</header>
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
		<article>
			<div class="menu cf">
				<div class="menu_left hide">
					<div class="menu_left_top"><img src="<?php echo ($static_path); ?>images/o2o1_27.png" /></div>
					<div class="list">
						<ul>
							<?php if(is_array($all_category_list)): $k = 0; $__LIST__ = $all_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li>
									<div class="li_top cf">
										<?php if($vo['cat_pic']): ?><div class="icon"><img src="<?php echo ($vo["cat_pic"]); ?>" /></div><?php endif; ?>
										<div class="li_txt"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["cat_name"]); ?></a></div>
									</div>
									<?php if($vo['cat_count'] > 1): ?><div class="li_bottom">
											<?php if(is_array($vo['category_list'])): $j = 0; $__LIST__ = array_slice($vo['category_list'],0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($j % 2 );++$j;?><span><a href="<?php echo ($voo["url"]); ?>"><?php echo ($voo["cat_name"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
										</div><?php endif; ?>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<div class="menu_right cf">
					<div class="menu_right_top">
						<ul>
							<?php $web_index_slider = D("Slider")->get_slider_by_key("web_slider","10");if(is_array($web_index_slider)): $i = 0;if(count($web_index_slider)==0) : echo "列表为空" ;else: foreach($web_index_slider as $key=>$vo): ++$i;?><li class="ctur">
									<a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
								</li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</article>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/rate-edit.vc3f9a1d2.css" />
				<div class="component-order-nav mt-component--booted">
	<div class="side-nav J-order-nav">
		<div class="J-side-nav__user side-nav__user cf">
			<a href="javascript:void(0);" title="帐户设置" class="J-user item user">
				<img src="<?php if($now_user['avatar']): echo ($now_user["avatar"]); else: echo ($static_path); ?>images/user-default-avatar.png<?php endif; ?>" width="30" height="30" alt="<?php echo ($now_user["nickname"]); ?>头像"/>
			</a>
			<div class="item info_nickname">
				<div class="info__name" style="height:36px;line-height:36px;"><?php echo ($now_user["nickname"]); ?></div>
			</div>
			<div>等级：<a href="<?php echo U('Level/index');?>">
				<?php if(isset($levelarr[$now_user['level']])){ $imgstr=''; if(!empty($levelarr[$now_user['level']]['icon'])) $imgstr='<img src="'.$config['site_url'].$levelarr[$now_user['level']]['icon'].'" width="15" height="15">'; echo $imgstr.' '.$levelarr[$now_user['level']]['lname']; }else{echo '暂无等级';} ?></a>
			</div>
		</div>
		<div class="side-nav__account cf">
			<a class="item item--first" href="<?php echo U('Credit/index');?>" title="<?php echo ($now_user["now_money"]); ?>"><?php echo ($now_user["now_money"]); ?><span>余额</span></a>
			<a class="item" href="<?php echo U('Point/index');?>" title="<?php echo ($now_user["score_count"]); ?>"><?php echo ($now_user["score_count"]); ?><span>积分</span></a>
		</div>
		<dl class="side-nav__list">
			<dt class="first-item"><strong>我的订单</strong></dt>
			<dd>
				<ul class="item-list">
					<li <?php if(in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('index'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/index');?>"><?php echo ($config["group_alias_name"]); ?>订单</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('meal_list'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/meal_list');?>"><?php echo ($config["meal_alias_name"]); ?>订单</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Index')) && in_array(ACTION_NAME,array('lifeservice'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Index/lifeservice');?>">缴费订单</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Collect'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Collect/index');?>">我的收藏</a></li>
				</ul>
			</dd>
			<dt><strong>我的评价</strong></dt>
			<dd>
				<ul class="item-list">
					<li <?php if(in_array(MODULE_NAME,array('Rates')) && in_array(ACTION_NAME,array('index','meal'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Rates/index');?>">待评价</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Rates')) && in_array(ACTION_NAME,array('rated','meal_rated'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Rates/rated');?>">已评价</a></li>
				</ul>
			</dd>
			<dt><strong>我的账户</strong></dt>
			<dd class="last">
				<ul class="item-list">
					<li <?php if(in_array(MODULE_NAME,array('Point'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Point/index');?>">我的积分</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Credit'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Credit/index');?>">我的余额</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Level'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Level/index');?>">我的等级</a></li>
					<li <?php if(in_array(MODULE_NAME,array('Adress'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('Adress/index');?>">收货地址</a></li>
					<li <?php if(in_array(MODULE_NAME,array('User'))): ?>class="current"<?php endif; ?>><a href="<?php echo U('User/index');?>">邀请列表</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</div>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<select class="J-orders-filter orders-filter dropdown--small">
							<option value="<?php echo U('Rates/index');?>" selected="selected"><?php echo ($config["group_alias_name"]); ?></option>
							<option value="<?php echo U('Rates/meal');?>"><?php echo ($config["meal_alias_name"]); ?></option>
						</select>
						<?php if($order_list): ?><div id="order-list" class="rate-list">
								<div class="component-rate-edit mt-component--booted">
									<div class="rate-edit">
										<?php if(is_array($order_list)): $i = 0; $__LIST__ = $order_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="rate-item <?php if($i == count($order_list)): ?>rate-item--last<?php endif; ?>">
												<div class="rate-item__title">
													<a href="<?php echo ($vo["url"]); ?>" target="_blank" title="<?php echo ($vo["s_name"]); ?>">
														<img src="<?php echo ($vo["list_pic"]); ?>" width="120" height="80" style="border:1px solid #ccc;"/>
													</a>
												</div>
												<div class="J-rate-content rate-item__content">
													<h3 class="J-deal-title">
														<a href="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["s_name"]); ?>" target="_blank"><?php echo ($vo["s_name"]); ?></a>
													</h3>
													<p class="reminding color-weaken">你为本<?php echo ($config["group_alias_name"]); ?>打几分？</p>
													<div class="form-field J-feedback feedback cf">
														<span class="rating-bar overall-rate">
															<label class="text">我的总体评价：</label>
															<span class="widget-rating"><span data-id="1" class="widget-rating-star-gray"></span><span data-id="2" class="widget-rating-star-gray"></span><span data-id="3" class="widget-rating-star-gray"></span><span data-id="4" class="widget-rating-star-gray"></span><span data-id="5" class="widget-rating-star-gray"></span></span>
															<ins class="widget-rating-intro widget-rating-tips"></ins>
														</span>
														<span class="J-rate-tip rate-tip">请点击星星打分</span>
													</div>
													<form action="<?php echo U('Rates/reply_to',array('order_id'=>$vo['order_id']));?>" order_id="<?php echo ($vo["order_id"]); ?>" method="post" class="J-edit-wrapper" style="display:none">
														<input name="score" value="" type="hidden"/>
														<p class="area-tips">（最少评论10字，您的评价将是其他用户的重要参考）亲，您觉得本<?php echo ($config["group_alias_name"]); ?>怎么样？赶快告诉其他用户吧</p>
														<div class="J-rate-wrapper rate-wrapper">
															<div class="pic-list-wrapper J-pic-list-wrapper">
																<div class="cf">
																	<p class="J-pic-count-tip pic-tip">最多传10张，在上传的时候可选择多张再同时上传</p>
																	<span class="anonymous-check">
																		<input type="checkbox" value="1" id="anonymous-checkbox-<?php echo ($i); ?>" class="select-checkbox checkbox" name="anonymous"/>
																		<label for="anonymous-checkbox-<?php echo ($i); ?>">
																			匿名评价
																		</label>
																	</span>
																</div>
																<ul class="J-pic-list pic-list cf">
																   <li class="pic-item--add pic-item J-item-add">
																		<div class="yui3-widget yui3-uploader">
																			<div class="yui3-uploader-content">
																				<a class="J-pic-add-btn" href="javascript:void(0);" tabindex="0" style="width:100%;height:100%;" order_id="<?php echo ($vo["order_id"]); ?>"><span class="add-btn-plusicon">+</span><span class="add-btn-text">晒图</span></a>
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
											</div><?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							</div>
						<?php else: ?>
							<div class="notice">您没有待评价的<?php echo ($config["group_alias_name"]); ?>订单</div><?php endif; ?>
                    </div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>
	<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
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
	<script src="<?php echo ($static_public); ?>js/webuploader.min.js"></script>
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
				swf: '<?php echo ($static_public); ?>js/Uploader.swf',
				server: "<?php echo U('Rates/ajax_upload_pic');?>",
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
				$.post("<?php echo U('Rates/ajax_del_pic');?>",{order_id:now_dom.attr('order-id'),pic_id:now_dom.attr('pic-id')});
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
					$.post("<?php echo U('Rates/del_invalid_pic');?>",{order_id:form_wrap.attr('order_id'),order_type:0});
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