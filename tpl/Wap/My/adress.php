<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>收货地址管理</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <style>
	    .address-container {
	        font-size: .3rem;
	        -webkit-box-flex: 1;
	    }
	    .kv-line h6 {
	        width: 4em;
	    }
	    .btn-wrapper {
	        margin: .2rem .2rem;
	        padding: 0;
	    }
	
	    .address-wrapper a {
	        display: -webkit-box;
	        display: -moz-box;
	        display: -ms-flex-box;
	    }
	
	    .address-select {
	        display: -webkit-box;
	        display: -moz-box;
	        display: -ms-flex-box;
	        padding-right: .2rem;
	        -webkit-box-align: center;
	        -webkit-box-pack: center;
	        -moz-box-align: center;
	        -moz-box-pack: center;
	        -ms-box-align: center;
	        -ms-flex-pack: justify;
	    }
	
	    .list.active dd {
	        background-color: #fff5e3;
	    }
	
	    .confirmlist {
	        display: -webkit-box;
	        display: -moz-box;
	        display: -ms-flex-box;
	    }
	
	    .confirmlist li {
	        -ms-flex: 1;
	        -moz-box-flex: 1;
	        -webkit-box-flex: 1;
	        height: .88rem;
	        line-height: .88rem;
	        border-right: 1px solid #C9C3B7;
	        text-align: center;
	    }
	
	    .confirmlist li a {
	        color: #2bb2a3;
	    }
	
	    .confirmlist li:last-child {
	        border-right: none;
	    }
	</style>
</head>
<body id="index" data-com="pagecommon">
        <header  class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{$back_url}" class="react back">
               		<i class="text-icon icon-back"></i>
           		</a>
            </div>
            <h1 class="nav-header">收货地址管理</h1>
            <div class="nav-wrap-right">
                <a class="react nav-dropdown-btn" data-com="dropdown" data-target="nav-dropdown">
                    <span class="nav-btn">
                        <i class="text-icon">≋</i>导航
                    </span>
                </a>
            </div>
            <div id="nav-dropdown" class="nav-dropdown">
                <ul>
                    <li><a class="react" href="{pigcms{:U('Home/index')}"><i class="text-icon">⟰</i>
                        <space></space>首页</a>
                    </li>
                    <li><a class="react" href="{pigcms{:U('My/index')}"><i class="text-icon">⍥</i>
                        <space></space>我的</a>
                    </li>
                    <li><a class="react" href="{pigcms{:U('Search/index',array('type'=>'group'))}"><i class="text-icon">⌕</i>
                        <space></space>搜索</a>
                	</li>
                </ul>
            </div>
        </header>
        <div id="tips" class="tips"></div>
        <div class="wrapper btn-wrapper">
		    <a class="address-add btn btn-larger btn-warning btn-block" href="{pigcms{:U('My/edit_adress',$_GET)}">添加新地址</a>
		</div>
		<volist name="adress_list" id="vo">
			<dl class="list <if condition="$vo['default']">active</if>">
		        <dd class="address-wrapper <if condition="!$vo['select_url']">dd-padding</if>">
		        	<if condition="$vo['select_url']">
		           		<a class="react" href="{pigcms{$vo.select_url}">
		                <div class="address-select"><input class="mt" type="radio" name="addr" <if condition="$vo['adress_id'] eq $_GET['current_id']">checked="checked"</if>/></div>
			         </if>
			            <div class="address-container">
			                <div class="kv-line">
			                    <h6>姓名：</h6><p>{pigcms{$vo.name}</p>
			                </div>
			                <div class="kv-line">
			                    <h6>手机：</h6><p>{pigcms{$vo.phone}</p>
			                </div>
			                <div class="kv-line">
			                    <h6>省市：</h6><p>{pigcms{$vo.province_txt} {pigcms{$vo.city_txt}</p>
			                </div>
			                <div class="kv-line">
			                    <h6>地址：</h6><p>{pigcms{$vo.area_txt} {pigcms{$vo.adress}</p>
			                </div>
			                <div class="kv-line">
			                    <h6>邮编：</h6><p>{pigcms{$vo.zipcode}</p>
			                </div>
			            </div>
			        <if condition="$vo['select_url']">
		            	</a>
		            </if>
		        </dd>
		        <dd>
	                <ul class="confirmlist">
	                    <li><a class="react" href="{pigcms{$vo.edit_url}">编辑</a></li><li><a class="react mj-del" href="{pigcms{$vo.del_url}">删除</a></li>
	                </ul>
		        </dd>
		    </dl>
	    </volist>
    	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script>
			$(function(){
				$('.mj-del').click(function(){
					var now_dom = $(this);
					if(confirm('您确定要删除此地址吗？')){
						$.post(now_dom.attr('href'),function(result){
							if(result.status == '1'){
								now_dom.closest('dl').remove();
							}else{
								alert(result.info);
							}
						});
					}
					return false;
				});
				$('.address-wrapper input.mt').click(function(){
					window.location.href = $(this).closest('a').attr('href');
				});
			});
		</script>
		<include file="Public:footer"/>

{pigcms{$hideScript}
</body>
</html>