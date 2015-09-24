<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<if condition="$is_wexin_browser">
		<title>{pigcms{$config.meal_alias_name}搜索</title>
	<else/>
		<title>【{pigcms{$keywords}】搜索_{pigcms{$config.site_name}</title>
	</if>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<style>
		#clear-history {
			margin-top: .2rem;
		}
		.search-wrapper {
			min-height: 5rem;
		}
		.search-wrapper em{
			font-style:normal;
		}
		#search-form {
			margin-top: .2rem;
			margin-bottom: .2rem;
			height: .8rem;
			position: relative;
		}
		.nav-bar {
			border-top: 1px solid #ccc;
			margin-top: .2rem;;
			display: none;
		}
		.search-dom{
			position: absolute;
			left: 0;
			top: 0;
			width: 1.4rem;
			height: 100%;
			-webkit-box-sizing: border-box;
			text-align: center;
			/*border: 1px #CCC solid;*/
			background: white;
		}
		.search-dom select{
			/*width: 1.2rem;*/
			width:100%;
			height: 100%;
			border:none;
			outline:none;
		}
		.box-search {
			vertical-align: middle;
			position: relative;
			margin-right: 1.3rem;
			margin-left: 1.5rem;
			border-radius: .06rem;
			border: 1px #CCC solid;
			background: #FFF;
			height: .8rem;
			line-height: .8rem;
			padding: 0 .7rem 0 .7rem;
			-webkit-box-sizing: border-box;
		}
		.box-search.active {
			border-color: #2bb2a3;
		}
		#search-form button {
			position: absolute;
			right: 0;
			top: 0;
			width: 1.2rem;
			height: 100%;
			-webkit-box-sizing: border-box;
		}
		#search-form input[type='text'] {
			width: 100%;
			border: none;
			background: rgba(255, 255, 255, 0);
			outline-style: none;
			display: block;
			line-height: .28rem;
			height: 100%;
			font-size: .28rem;
			padding: 0;
		}
		#search-form .icon-search {
			position: absolute;
			left: .2rem;
			font-size: .4rem;
			color: #999;
		}
		.search-suggestion {
			border-top: 1px solid #ccc;
		}
		.search-suggestion .list-item {
			background-color: #FDFDFC;
			border-bottom: 1px solid #ccc;
		}
		.search-suggestion .list-item>a {
			padding: .3rem .4rem;
		}
		.search-suggestion .list-item .result-count {
			float: right;
			color: #999;
		}	
		
		.table {
		  min-height: .8rem;
		  position: relative;
		  overflow: hidden;
		  z-index: 0;
		}
		.table:before {
		  content: '';
		  position: absolute;
		  width: 25%;
		  left: 25%;
		  height: 100%;
		  border-left: 1px solid #ddd8ce;
		  border-right: 1px solid #ddd8ce;
		}
		.table:after {
		  content: '';
		  position: absolute;
		  width: 10%;
		  left: 75%;
		  height: 100%;
		  border-left: 1px solid #ddd8ce;
		  border-right: none; 
		}
		.table.table-t3:before{
		  width: 33.33%;
		  left: 33.33%; 
		}
		.table.table-t3:after {
		  border: none; 
		}
		.table li,
		.table h4 {
		  display: inline-block;
		  width: 25%;
		  height: .8rem;
		  line-height: .8rem;
		  font-size: .28rem;
		  text-align: center;
		  border-bottom: 1px solid #ddd8ce;
		  margin-bottom: -1px;
		  float: left;
		  position: relative;
		  z-index: 10; 
		}
		.table.table-t3 li,.table.table-t3 h4 {
		  width: 33.33%; 
		}
		.table h4 {
		  margin: 0;
		  margin-bottom: -1px;
		  height: 1.6rem;
		  line-height: 1.6rem;
		  color: #B7B7B7;
		  font-size: .8rem;
		}
		.dropdown-toggle.hover{
			color:#FF658E;
		}
		.dropdown-toggle.caret.hover:after{
			border-top:.15rem solid #FF658E;
		}
	</style>
</head>
<body>
        <div id="container">
	        <div class="search-wrapper">
				<div class="wrapper">
					<form id="search-form" action="{pigcms{:U('Search/meal')}" method="post" group_action="{pigcms{:U('Search/group')}" meal_action="{pigcms{:U('Search/meal')}">
						<div class="search-dom">
							<select id="search-type">
								<option value="group">{pigcms{$config.group_alias_name}</option>
								<option value="meal" selected="selected">{pigcms{$config.meal_alias_name}</option>
							</select>
						</div>
						<div class="box-search">
							<i class="icon-search text-icon">⌕</i>
							<input id="keyword" type="text" name="w" placeholder="请输入搜索词" autocomplete="off" value="{pigcms{$keywords}"/>
						</div>
						<button type="submit" class="btn" id="search-submit">搜索</button>
					</form>
					<if condition="$search_hot_list">
						<div id="search-hot">
							<h4>搜索热词</h4>
							<ul class="box nopadding table table-t3">
								<volist name="search_hot_list" id="vo">
									<li><a class="hot-link react" href="{pigcms{$vo.url}">{pigcms{$vo.name}</a></li>
								</volist>
							</ul>
						</div>
					</if>
				</div>
				<if condition="$group_list">
					<div class="nav-bar" style="display:block;-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);">
						<ul class="nav">
							<li class="dropdown-toggle caret sort <if condition="$now_sort eq 'default'">hover</if>" data-sort="default"><span class="nav-head-name">默认排序</span></li>
							<li class="dropdown-toggle caret sort <if condition="$now_sort eq 'hot'">hover</if>" data-sort="hot"><span class="nav-head-name">销量最高</span></li>
							<li class="dropdown-toggle caret sort <if condition="$now_sort eq 'price-asc'">hover</if>" data-sort="price-asc"><span class="nav-head-name">人均消费最低</span></li>
						</ul>
					</div>
				</if>
				<div class="deal-container">
					<div class="deals-list" id="deals">
						<if condition="$group_list">
							<dl class="list list-in">
								<volist name="group_list" id="vo">
									<dd>
										<a href="{pigcms{$vo.url}" class="react">
											<div class="dealcard" data-did="3859717">
													<div class="dealcard-img imgbox">
														<img src="{pigcms{$vo.image}" style="width:100%;height:100%;">
													</div>
												<div class="dealcard-block-right">
													<div class="dealcard-brand single-line">{pigcms{$vo.name}</div>
													<div class="title text-block">[{pigcms{$vo.area_name}]{pigcms{$vo.name}</div>
													<div class="price">
														<strong>{pigcms{$vo.mean_money}</strong>
														<span class="strong-color">元</span>
														<if condition="$vo['sale_count']"><span class="line-right">已售{pigcms{$vo['sale_count']}</span></if>
													</div>
												</div>
											</div>
										</a>
									</dd>
								</volist>
							</dl>
							<if condition="$pagebar">
							<dl class="list">
								<dd>
									<div class="pager">{pigcms{$pagebar}</div>
								</dd>
							</dl>
							</if>
						<else/>	
							<div class="no-deals">没有找到相关内容，您换个关键字试试？</div>
						</if>
					</div>
					<div class="shade hide"></div>
					<div class="loading hide">
						<div class="loading-spin" style="top:91px;"></div>
					</div>
				</div>
			</div>
		</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script>
			$(function(){
				$('#search-type').change(function(){
					$('#search-form').attr('action',$('#search-form').attr($(this).val()+'_action'));
				});
				$('#keyword').bind('input',function(){
					if($('#keyword').val().length > 0){
						$('#search-submit').prop('disabled',false);
					}else{
						$('#search-submit').prop('disabled',true);
					}
				});
				$('#search-form').submit(function(){
					$('#keyword').val($.trim($('#keyword').val()));
					if($('#keyword').val().length == 0){
						alert('请输入搜索词！');
						return false;
					}
				});
				$('.dropdown-toggle.caret').click(function(){
					window.location.href = "{pigcms{:U('Search/meal',array('w'=>urlencode($keywords)))}&sort="+$(this).attr('data-sort');
				});
			});
		</script>
    	<include file="Public:footer"/>
</body>
</html>