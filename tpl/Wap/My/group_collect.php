<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>{pigcms{$config.group_alias_name}收藏列表</title>
	<meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
	<style>
		.dealcard {
			-webkit-transition: -webkit-transform .2s;
		}
		.editing .dealcard {
			-webkit-transform: translateX(1.05rem);
		}
		.del-btn {
			display: block;
			width: .45rem;
			height: .45rem;
			text-align: center;
			line-height: .45rem;
			position: absolute;
			left: -.85rem;
			top: 50%;
			background-color: #EC5330;
			color: #fff;
			-webkit-transform: translateY(-50%);
			border-radius: 50%;
			font-size: .4rem;
		}
		.no-collection {
			color: #D4D4D4;
			text-align: center;
			margin-top: 1rem;
			margin-bottom: 2.5rem;
		}
		.icon-line {
			font-size: 2.5rem;
			margin-bottom: .5rem;
		}
		.btn-wrapper .tab {
			width: 100%;
		}
		.btn-wrapper .tab li {
			width: 50%;
			box-sizing: border-box;
		}
		.btn-wrapper{
			margin:0px;
		}
		ul.tab{
			border: none;
			border-bottom:1px solid #ccc;
			height:.8rem;
		}
		.tab li.active {
			color: #fff;
		}
		.tab a.react{
			height:.8rem;
			line-height:.8rem;
		}
	</style>
</head>
<body id="index">
		<div class="btn-wrapper">
			<ul class="tab">
				<li class="active"><a class="react" href="{pigcms{:U('My/group_collect')}">{pigcms{$config.group_alias_name}</a>
				</li><li><a class="react" href="{pigcms{:U('My/group_store_collect')}">店铺</a>
				</li>
			</ul>
		</div>
        <div id="container">
			<div class="deal-container">
				<div class="deals-list" id="deals">
					<if condition="$group_list">
		    			<dl class="list list-in">
		       				<volist name="group_list" id="vo">
			        			<dd>
			        				<a href="{pigcms{$vo.url}" class="react">
										<div class="dealcard">
										        <div class="dealcard-img imgbox">
										        	<img src="{pigcms{$vo.list_pic}" style="width:100%;height:100%;">
										        </div>
										    <div class="dealcard-block-right">
										        <if condition="$vo['tuan_type'] neq 2">
													<div class="dealcard-brand single-line">{pigcms{$vo.merchant_name}</div>
													<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
												<else/>
													<div class="dealcard-brand single-line">{pigcms{$vo.s_name}</div>
													<div class="title text-block">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}</div>
												</if>
										        <div class="price">
										            <strong>{pigcms{$vo.price}</strong>
										            <span class="strong-color">元</span>
										            <if condition="$vo['wx_cheap']">
														<span class="tag">微信购买再减{pigcms{$vo.wx_cheap}元</span>
										            <else/>
										            	<del>{pigcms{$vo.old_price}元</del>
										            </if>
										            <if condition="$vo['sale_count']+$vo['virtual_num']"><span class="line-right">已售{pigcms{$vo['sale_count']+$vo['virtual_num']}</span></if>
										        </div>
										    </div>
										</div>
			       					</a>
			       				</dd>
			       			</volist>
						</dl>
						<dl class="list">
							<dd>
								<div class="pager">{pigcms{$pagebar}</div>
							</dd>
						</dl>
					<else/>	
						<div class="no-deals">您还没有收藏呢</div>
					</if>
				</div>
				<div class="shade hide"></div>
				<div class="loading hide">
			        <div class="loading-spin" style="top: 91px;"></div>
			    </div>
			</div>
		</div>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
    	<include file="Public:footer"/>
{pigcms{$hideScript}
</body>
</html>