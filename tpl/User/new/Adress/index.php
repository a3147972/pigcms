<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>收货地址 | {pigcms{$config.site_name}</title>
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
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/account.v1a41925d.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/table-section.v538886b7.css" />
				<include file="Public:sidebar"/>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<ul class="filter cf">
							<li class="current"><a href="{pigcms{:U('Adress/index')}">收货地址</a></li>
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
									<volist name="user_adress_list" id="vo">
										<tr class="<if condition='$i eq 1'>alt first-item</if> table-item">
											<td>{pigcms{$vo.name}</td>
											<td class="info1">{pigcms{$vo.province_txt} {pigcms{$vo.city_txt} {pigcms{$vo.area_txt} {pigcms{$vo.adress}，{pigcms{$vo.zipcode}</td>
											<td class="consignee">{pigcms{$vo.phone}</td>
											<td class="right">
												<ul class="action hidden" adress_id="{pigcms{$vo.adress_id}">
													<if condition="$vo['default']"><li id="address-default"><span>默认地址</span></li></if>
													<li>
														<a href="javascript:void(0);" class="default">设为默认</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="delete">删除</a>&nbsp;<span class="separator">|</span>&nbsp;
													</li>
													<li><a href="javascript:void(0);" class="edit" data-params='{pigcms{:json_encode($vo)}'>修改</a>
													</li>
												</ul>
											</td>
										</tr>
									</volist>
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
						{pigcms{$pagebar}
                    </div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>
	<include file="Public:footer"/>
	<form id="address-form" class="form" method="post" style="display:none;">
		<input type="hidden" name="adress_id" id="adress-id" value=""/>
		<div class="address-field-list">
			<div class="form-field">
				<label for="address-province"><em>*</em> 所在地区：</label>
				<span id="area-container">
					<select id="address-province" class="address-province dropdown--small" name="province" autocomplete="off">
						<volist name="province_list" id="vo">
							<option value="{pigcms{$vo.area_id}">{pigcms{$vo.area_name}</option>
						</volist>
					</select>
					<select id="address-city" class="address-city dropdown--small" name="city" autocomplete="off">
						<volist name="city_list" id="vo">
							<option value="{pigcms{$vo.area_id}">{pigcms{$vo.area_name}</option>
						</volist>
					</select>
					<select id="address-area" class="address-district dropdown--small" name="area" autocomplete="off">
						<volist name="area_list" id="vo">
							<option value="{pigcms{$vo.area_id}">{pigcms{$vo.area_name}</option>
						</volist>
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
			var address_form = '<form id="address-form" class="form" method="post" action="{pigcms{:U('Adress/save_adress')}">'+$('#address-form').html()+'</form>';
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
					$.post("{pigcms{:U('Adress/set_default')}",{adress_id:now_ul.attr('adress_id')},function(result){
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
						$.post("{pigcms{:U('Adress/del_adress')}",{adress_id:now_ul.attr('adress_id')},function(result){
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
				$.post("{pigcms{:U('Adress/amend_adress')}",$(this).serialize(),function(result){
					alert(result.info);
					if(result.status == 1){
						window.location.href = window.location.href;
					}
				});
				return false;
			});
		});
		function show_city(id,has_select){
			$.post("{pigcms{:U('Adress/select_area')}",{pid:id},function(result){
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
			$.post("{pigcms{:U('Adress/select_area')}",{pid:id},function(result){
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
