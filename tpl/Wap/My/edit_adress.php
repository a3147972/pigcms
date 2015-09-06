<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>编辑收货地址</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    .btn-wrapper {
	        margin: .2rem .2rem;
	        padding: 0;
	    }
	
	    dd>label.react {
	        padding: .28rem .2rem;
	    }
	
	    .kv-line h6 {
	        width: .8rem;
	    }
	</style>  
</head>
<body id="index" data-com="pagecommon">
        <div id="tips" class="tips"></div>
        <form id="form" method="post" action="{pigcms{:U('My/edit_adress')}">
        
		    <dl class="list list-in">
		    	<dd>
		    		<dl>
		        		<dd class="dd-padding kv-line">
		        			<h6>姓名:</h6>
		        			<input name="name" type="text" class="kv-v input-weak" placeholder="最少2个字" pattern=".{2,}" data-err="姓名必须大于2个字！" value="{pigcms{$now_adress.name}">
		        		</dd>
		        		<dd class="dd-padding kv-line">
		        			<h6>电话:</h6>
		        			<input name="phone" type="tel" class="kv-v input-weak" placeholder="不少于7位" pattern="\d{3}[\d\*]{4,}" data-err="电话必须大于7位！" value="{pigcms{$now_adress.phone}">
		        		</dd>
		        		<dd class="dd-padding kv-line">
				            <h6>省份:</h6>
				            <label class="select kv-v">
				                <select name="province">
									<if condition="$now_adress">
										<volist name="province_list" id="vo">
											<option value="{pigcms{$vo.area_id}" <if condition="$vo['area_id'] eq $now_adress['province']">selected="selected"</if>>{pigcms{$vo.area_name}</option>
										</volist>
									<else/>
										<volist name="province_list" id="vo">
											<option value="{pigcms{$vo.area_id}" <if condition="$vo['area_id'] eq $now_city_area['area_pid']">selected="selected"</if>>{pigcms{$vo.area_name}</option>
										</volist>
									</if>
				                </select>
				            </label>
				        </dd>
				        <dd class="dd-padding kv-line">
				            <h6>城市:</h6>
				            <label class="select kv-v">
				                <select name="city">
									<if condition="$now_adress">
										<volist name="city_list" id="vo">
											<option value="{pigcms{$vo.area_id}" <if condition="$vo['area_id'] eq $now_adress['city']">selected="selected"</if>>{pigcms{$vo.area_name}</option>
										</volist>
									<else/>
										<volist name="city_list" id="vo">
											<option value="{pigcms{$vo.area_id}" <if condition="$vo['area_id'] eq $now_city_area['area_id']">selected="selected"</if>>{pigcms{$vo.area_name}</option>
										</volist>
									</if>
				                </select>
				            </label>
				        </dd>
				        <dd class="dd-padding kv-line">
				            <h6>区县:</h6>
				            <label class="select kv-v">
				                <select name="area">
				                    <volist name="area_list" id="vo">
				                        <option value="{pigcms{$vo.area_id}"  <if condition="$vo['area_id'] eq $now_adress['area']">selected="selected"</if>>{pigcms{$vo.area_name}</option>
				                    </volist>
				                </select>
				            </label>
				        </dd>
		        		<dd class="dd-padding kv-line">
		        			<h6>地址:</h6>
		        			<textarea name="adress" class="input-weak kv-v" placeholder="最少5个字,最多60个字,不能全部为数字" pattern="^.{5,60}$" data-err="请填写正确的地址信息！">{pigcms{$now_adress.adress}</textarea>
		        		</dd>
		        		<dd class="dd-padding kv-line">
		        			<h6>邮编:</h6>
		        			<input type="tel" name="zipcode" class="input-weak kv-v" placeholder="6位邮政编码" pattern="^\d{6}$" maxlength="6" data-err="请填写正确的邮编！" value="{pigcms{$now_adress.zipcode}"/>
		        		</dd>
		        		<dd>
			            	<label class="react">
			                	<input type="checkbox" name="default" value="1" class="mt"  <if condition="$now_adress['default']">checked="checked"</if>/>
			              		  设为默认地址
			            	</label>
			        	</dd>
			    	</dl>
		   		</dd>
			</dl>
		    <div class="btn-wrapper">
		    	<if condition="$now_adress['adress_id']">
		    		<input type="hidden" name="adress_id" value="{pigcms{$now_adress.adress_id}"/>
		    	</if>
				<button type="submit" class="btn btn-block btn-larger"><if condition="$now_adress">保存<else/>添加</if></button>
		    </div>
		</form>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}layer/layer.m.js"></script>
		<script>
			$(function(){
				$("select[name='province']").change(function(){
					show_city($(this).find('option:selected').attr('value'));
				});
				$("select[name='city']").change(function(){
					show_area($(this).find('option:selected').attr('value'));
				});

				$('#form').submit(function(){
					$('#tips').removeClass('tips-err').empty();
					var form_input = $(this).find("input[type='text'],input[type='tel'],textarea");
					$.each(form_input,function(i,item){
						var re = new RegExp($(item).attr('pattern'));
						if($(item).val().length == 0 || !re.test($(item).val())){
							$('#tips').addClass('tips-err').html($(item).attr('data-err'));
							return false;
						}

						if(i+1 == form_input.size()){
							layer.open({type:2,content:'提交中，请稍候'});
							$.post($('#form').attr('action'),$('#form').serialize(),function(result){
								layer.closeAll();
								if(result.status == 1){
									window.location.href="{pigcms{:U('My/adress',$params)}";
								}else{
									$('#tips').addClass('tips-err').html(result.info);
								}
							});
						}
					});
			
					return false;
				});
			});
			function show_city(id){
				$.post("{pigcms{:U('My/select_area')}",{pid:id},function(result){
					result = $.parseJSON(result);
					if(result.error == 0){
						var area_dom = '';
						$.each(result.list,function(i,item){
							area_dom+= '<option value="'+item.area_id+'">'+item.area_name+'</option>'; 
						});
						$("select[name='city']").html(area_dom);
						show_area(result.list[0].area_id);
					}
				});
			}
			function show_area(id){
				$.post("{pigcms{:U('My/select_area')}",{pid:id},function(result){
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
				});
			}
		</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>