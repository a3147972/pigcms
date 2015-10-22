<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>收货地址 | <?php echo ($config["site_name"]); ?></title>
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
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/account.v1a41925d.css" />
				<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/table-section.v538886b7.css" />
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
						<ul class="filter cf">
							<li class="current"><a href="<?php echo U('Adress/index');?>">收货地址</a></li>
						</ul>
						<div class="address-div">
							<div class="table-section">
								<table id="address-table" cellspacing="0" cellpadding="0">
									<tr>
										<th width="12%" class="left">收货人</th>
										<th width="44%">地址/邮编</th>
										<th width="19%">电话/手机</th>
										<th width="25%" class="right">操作</th>
									</tr>
									<?php if(is_array($user_adress_list)): $i = 0; $__LIST__ = $user_adress_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="<?php if($i == 1): ?>alt first-item<?php endif; ?> table-item">
											<td><?php echo ($vo["name"]); ?></td>
											<td class="info1"><?php echo ($vo["province_txt"]); ?> <?php echo ($vo["city_txt"]); ?> <?php echo ($vo["area_txt"]); ?> <?php echo ($vo["adress"]); ?>，<?php echo ($vo["zipcode"]); ?></td>
											<td class="consignee"><?php echo ($vo["phone"]); ?></td>
											<td class="right">
												<ul class="action hidden" adress_id="<?php echo ($vo["adress_id"]); ?>">
													<?php if($vo['default']): ?><li id="address-default"><span>默认地址</span></li><?php endif; ?>
													<li>
														<a href="javascript:void(0);" class="default">设为默认</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="delete">删除</a>&nbsp;<span class="separator">|</span>&nbsp;
													</li>
													<li><a href="javascript:void(0);" class="edit" data-params='<?php echo json_encode($vo);?>'>修改</a>
													</li>
												</ul>
											</td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								</table>
							</div>
							<div class="prompt table-section">
								<table cellspacing="0" cellpadding="0" border="0">
									<caption class="">
										<a href="javascript:void(0);" class="add">添加新地址</a>
									</caption>
									<tbody>
									</tbody>
								</table>
							</div>       
						</div>
						<?php echo ($pagebar); ?>
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
	<form id="address-form" class="form" method="post" style="display:none;">
		<input type="hidden" name="adress_id" id="adress-id" value=""/>
		<div class="address-field-list">
			<div class="form-field">
				<label for="address-province"><em>*</em> 所在地区：</label>
				<span id="area-container">
					<select id="address-province" class="address-province dropdown--small" name="province" autocomplete="off">
						<?php if(is_array($province_list)): $i = 0; $__LIST__ = $province_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select id="address-city" class="address-city dropdown--small" name="city" autocomplete="off">
						<?php if(is_array($city_list)): $i = 0; $__LIST__ = $city_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<select id="address-area" class="address-district dropdown--small" name="area" autocomplete="off">
						<?php if(is_array($area_list)): $i = 0; $__LIST__ = $area_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</span>
			</div>
			<div class="form-field">
				<label for="address-detail"><em>*</em> 街道地址：</label>
				<input type="text" maxlength="60" size="60" name="adress" id="address-detail" class="f-text address-detail" value=""/>
			</div>
			<div class="form-field">
				<label for="address-zipcode"><em>*</em> 邮政编码：</label>
				<input id="address-zipcode" class="f-text address-zipcode" type="text" maxlength="20" size="10" name="zipcode" value=""/>
			</div>
			<div class="form-field">
				<label for="address-name"><em>*</em> 收货人姓名：</label>
				<input id="address-name" type="text" maxlength="15" size="15" name="name" class="f-text address-name" value=""/>
			</div>
			<div class="form-field">
				<label for="address-phone"><em>*</em> 电话号码：</label>
				<input id="address-phone" class="f-text address-phone" type="text" maxlength="20" size="15" name="phone" value=""/>
			</div>
			<div class="form-field comfirm">
				<input type="submit" class="btn" name="commit" value="保存"/>
				<a href="javascript:void(0)" class="address-cancel inline-link">取消</a>
			</div>
		</div>
	</form>
	<style>
		#content .address-field-list .form-field .f-text{height:18px;}
		#content .address-field-list .form-field .address-city, #content .address-field-list .form-field .address-district, #content .address-field-list .form-field .address-province{margin:3px 10px 0 0;width:140px;height:30px;}
	</style>
	<script>
		var now_city = 0;
		var now_area = 0;
		$(function(){
			var address_form = '<form id="address-form" class="form" method="post" action="<?php echo U('Adress/save_adress');?>">'+$('#address-form').html()+'</form>';
			$('#address-form').remove();
			
			$('#address-table tr').hover(function(){
				if($(this).find('#address-default').size() < 1){
					$(this).find('.default').show();
				}
			},function(){
				$(this).find('.default').hide();
			});
			$('#content .table-section a').click(function(){
				var now_ul = $(this).closest('ul');
				if($(this).hasClass('default')){
					$.post("<?php echo U('Adress/set_default');?>",{adress_id:now_ul.attr('adress_id')},function(result){
						if(result.status == 1){
							$('#address-default').remove();
							now_ul.find('.default').hide();
							now_ul.prepend('<li id="address-default"><span>默认地址</span></li>');
							
						}else{
							alert(result.info);
						}
					});
				}else if($(this).hasClass('delete')){
					var now_ul = $(this).closest('ul');
					var now_tr = $(this).closest('.table-item');
					if(confirm('您确定要删除这个地址吗？')){
						$.post("<?php echo U('Adress/del_adress');?>",{adress_id:now_ul.attr('adress_id')},function(result){
							if(result.status == 1){
								now_tr.remove();
							}else{
								alert(result.info);
							}
						});
					}
				}else if($(this).hasClass('add')){
					$('#address-form').closest('.edit-form').remove();
					var now_table = $(this).closest('table');
					now_table.find('tbody').html('<tr class="edit-form"><td>'+address_form+'</td></tr>');
					now_table.find('caption').addClass('add-address').find('a').addClass('text');
				}else if($(this).hasClass('edit')){
					$('#address-form').closest('.edit-form').remove();
					var now_tr = $(this).closest('tr');
					now_tr.after('<tr class="edit-form"><td colspan="4">'+address_form+'</td></tr>');
					$('.add-address').removeClass('add-address').find('a').removeClass('text');
					
					var form_param = $.parseJSON($(this).attr('data-params'));
					$('#address-detail').val(form_param.adress);
					$('#address-zipcode').val(form_param.zipcode);
					$('#address-name').val(form_param.name);
					$('#address-phone').val(form_param.phone);
					$('#adress-id').val(form_param.adress_id);
					
					if(form_param.province != $('#address-province option:first').attr('value')){
						var has_province = false;
						$.each($('#address-province option'),function(i,item){
							if($(item).attr('value') == form_param.province){
								$(item).prop('selected',true);
								has_province = true;
								return false;
							}
						});
						if(has_province){
							now_city = form_param.city;
							now_area = form_param.area;
							show_city(form_param.province,true);
						}
					}
				}
				return false;
			});
			
			$("#address-province").live('change',function(){
				show_city($(this).find('option:selected').attr('value'),false);
			});
			$("#address-city").live('change',function(){
				show_area($(this).find('option:selected').attr('value'),false);
			});
			
			$('#address-detail').live('focusin focusout',function(event){
				if(event.type == 'focusin'){
					$(this).siblings('.inline-tip').remove();$(this).closest('.form-field').removeClass('form-field--error');
				}else{
					$(this).val($.trim($(this).val()));
					var adress = $(this).val();
					if(adress.length < 5 || adress.length > 60){
						$(this).after('<span class="inline-tip"><i class="tip-status tip-status--opinfo"></i>请填写街道地址，最少5个字，最多不能超过60个字</span>').closest('.form-field').addClass('form-field--error');
					}
				}
			});
			$('#address-zipcode').live('focusin focusout',function(event){
				if(event.type == 'focusin'){
					$(this).siblings('.inline-tip').remove();$(this).closest('.form-field').removeClass('form-field--error');
				}else{
					$(this).val($.trim($(this).val()));
					var zipcode = $(this).val();
					if(!/^\d{6}$/.test(zipcode)){
						$(this).after('<span class="inline-tip"><i class="tip-status tip-status--opinfo"></i>邮政编码填写有误，请输入6位邮政编码</span>').closest('.form-field').addClass('form-field--error');
					}
				}
			});
			$('#address-name').live('focusin focusout',function(event){
				if(event.type == 'focusin'){
					$(this).siblings('.inline-tip').remove();$(this).closest('.form-field').removeClass('form-field--error');
				}else{
					$(this).val($.trim($(this).val()));
					var name = $(this).val();
					if(name.length < 2 || name.length > 15){
						$(this).after('<span class="inline-tip"><i class="tip-status tip-status--opinfo"></i>请正确填写姓名，最少不能低于2个字，最多不能超过15个字</span>').closest('.form-field').addClass('form-field--error');
					}
				}
			});
			$('#address-phone').live('focusin focusout',function(event){
				if(event.type == 'focusin'){
					$(this).siblings('.inline-tip').remove();$(this).closest('.form-field').removeClass('form-field--error');
				}else{
					$(this).val($.trim($(this).val()));
					var phone = $(this).val();
					if(!/^[+]{0,1}(\d){1,4}[ ]{0,1}([-]{0,1}((\d)|[ ]){1,12})+$/.test(phone)){
						$(this).after('<span class="inline-tip"><i class="tip-status tip-status--opinfo"></i>请填写正确的电话号码或手机号</span>').closest('.form-field').addClass('form-field--error');
					}
				}
			});
			
			$('.address-cancel').live('click',function(){
				$(this).closest('.edit-form').remove();
				$('.add-address').removeClass('add-address').find('a').removeClass('text');
			});
			
			$('#address-form').live('submit',function(){
				$.post("<?php echo U('Adress/amend_adress');?>",$(this).serialize(),function(result){
					alert(result.info);
					if(result.status == 1){
						window.location.href = window.location.href;
					}
				});
				return false;
			});
		});
		function show_city(id,has_select){
			$.post("<?php echo U('Adress/select_area');?>",{pid:id},function(result){
				result = $.parseJSON(result);
				if(result.error == 0){
					var area_dom = '';
					$.each(result.list,function(i,item){
						area_dom+= '<option value="'+item.area_id+'">'+item.area_name+'</option>'; 
					});
					$("select[name='city']").html(area_dom);
					show_area(result.list[0].area_id,has_select);
				}
			});
		}
		function show_area(id,has_select){
			$.post("<?php echo U('Adress/select_area');?>",{pid:id},function(result){
				result = $.parseJSON(result);
				if(result.error == 0){
					var area_dom = '';
					$.each(result.list,function(i,item){
						area_dom+= '<option value="'+item.area_id+'">'+item.area_name+'</option>'; 
					});
					$("select[name='area']").html(area_dom);
				}else{
					$("select[name='area']").html('<option value="0">请手动填写区域</option>');
				}
				
				if(has_select){
					$.each($('#address-city option'),function(i,item){
						if($(item).attr('value') == now_city){
							$(item).prop('selected',true);
							has_province = true;
							return false;
						}
					});
					$.each($('#address-area option'),function(i,item){
						if($(item).attr('value') == now_area){
							$(item).prop('selected',true);
							has_province = true;
							return false;
						}
					});
				}
			});
		}
	</script>
	<style>
.btn, .btn-hot, .btn-normal {
  display: inline-block;
  vertical-align: middle;
  padding: 7px 20px 6px;
  font-size: 14px;
  font-weight: 700;
  line-height: 1.5;
  font-family: SimSun, Arial;
  letter-spacing: .1em;
  text-align: center;
  text-decoration: none;
  border-width: 0 0 1px;
  border-style: solid;
  background-repeat: repeat-x;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-user-select: -moz-none;
  -ms-user-select: none;
  -webkit-user-select: none;
  user-select: none;
  cursor: pointer;
}
.btn {
  color: #fff;
  background-color: #2db3a6;
  border-color: #0D7B71;
  filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0,
 startColorstr='#FF2EC3B4', endColorstr='#FF2DB3A6');
  background-size: 100%;
  background-image: -moz-linear-gradient(top, #2ec3b4, #2db3a6);
  background-image: -webkit-linear-gradient(top, #2ec3b4, #2db3a6);
  background-image: linear-gradient(to bottom, #2ec3b4, #2db3a6);
}
.btn-hot:active, .btn-hot:focus, .btn-hot:hover, .btn-normal:active, .btn-normal:focus, .btn-normal:hover, .btn:active, .btn:focus, .btn:hover {
  text-decoration: none;
  outline: 0;
}
.btn.hover, .btn:focus, .btn:hover {
  color: #fff;
  background-color: #2eb7aa;
  border-color: #0e8177;
  filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0,
 startColorstr='#FF38D0C3', endColorstr='#FF2EB7AA');
  background-size: 100%;
  background-image: -moz-linear-gradient(top, #38d0c3, #2eb7aa);
  background-image: -webkit-linear-gradient(top, #38d0c3, #2eb7aa);
  background-image: linear-gradient(to bottom, #38d0c3, #2eb7aa);
}		

	</style>
</body>
</html>