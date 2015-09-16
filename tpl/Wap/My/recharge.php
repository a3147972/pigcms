<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>余额充值</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
</head>
<body id="index">
        <if condition="$error">
        	<div id="tips" class="tips tips-err" style="display:block;">{pigcms{$error}</div>
        <else/>
        	<div id="tips" class="tips"></div>
        </if>
        <form id="form" method="post" action="{pigcms{:U('My/recharge')}">
		    <dl class="list">
		        <dd class="dd-padding">
		            <input id="money" placeholder="请填写充值金额" class="input-weak" type="text" name="money" value="{pigcms{$_GET.money}"/>
		        </dd>
		    </dl>
		    <p class="btn-wrapper">金额最多仅支持两位小数</p>
		    <div class="btn-wrapper"><button type="submit" class="btn btn-block btn-larger">充值</button></div>
		</form>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script>
			$(function(){
				$('#form').on('submit', function(e){
					$('#tips').removeClass('tips-err').hide();
					var money = parseFloat($('#money').val());
					if(isNaN(money)){
						$('#tips').html('请输入合法的金额！').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}else if(money > 10000){
						$('#tips').html('单次充值金额最高不能超过1万元').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}else if(money < 0.1){
						$('#tips').html('单次充值金额最低不能低于 0.1 元').addClass('tips-err').show();
			            e.preventDefault();
						return false;
					}
			    });
			});
		</script>
		<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>