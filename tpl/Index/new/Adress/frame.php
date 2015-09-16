<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.v113ea197.css" />
	<style>
		html{background-color:white;}
		body{font-size:12px;background-color:white;}
		.erro_tips{margin-top:40px;text-align:center;}
		.address-list label{margin-left:3px;line-height:36px;zoom:1;}
		.address-list .selected{background:#FEF5E7;}
		.address-list li{padding-left:10px;}
	</style>
</head>
<body>
	<if condition="$error_msg">
		<div class="erro_tips">{pigcms{$error_msg}</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script>
			$(function(){
				window.parent.change_adress_frame($('#address-list').height());
				});
		</script>	
	<else/>
		<ul class="address-list" id="address-list">
			<volist name="adress_list" id="vo">
				<li <if condition="$i eq 1">class="selected"</if>>
					<input class="select-radio" type="radio" name="adress_id" autocomplete="off" id="address_{pigcms{$vo.adress_id}" value="{pigcms{$vo.adress_id}" <if condition="$i eq 1">checked="checked"</if> />
					<label class="detail" for="address_{pigcms{$vo.adress_id}" adress_id="{pigcms{$vo.adress_id}" username="{pigcms{$vo.name}" phone="{pigcms{$vo.phone}" province_txt="{pigcms{$vo.province_txt}" city_txt="{pigcms{$vo.city_txt}" area_txt="{pigcms{$vo.area_txt}" zipcode="{pigcms{$vo.zipcode}">{pigcms{$vo.name}，{pigcms{$vo.province_txt} {pigcms{$vo.city_txt} {pigcms{$vo.area_txt} {pigcms{$vo.adress}，{pigcms{$vo.zipcode}，{pigcms{$vo.phone}</label>
				</li>
			</volist>
		</ul>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script>
			$(function(){
				window.parent.change_adress_frame($('#address-list').height());
				
				var first_obj = $('#address-list li label').eq(0);
				window.parent.change_adress(first_obj.attr('adress_id'),first_obj.attr('username'),first_obj.attr('phone'),first_obj.attr('province_txt'),first_obj.attr('city_txt'),first_obj.attr('area_txt'),first_obj.attr('zipcode'));
				
				$('#address-list li label').click(function(){
					if(!$(this).closest('li').hasClass('selected')){
						$(this).closest('li').addClass('selected').siblings('li').removeClass('selected');
						window.parent.change_adress($(this).attr('adress_id'),$(this).attr('username'),$(this).attr('phone'),$(this).attr('province_txt'),$(this).attr('city_txt'),$(this).attr('area_txt'),$(this).attr('zipcode'));
					}
				});
			});
		</script>
	</if>
</body>
</html>
