<?php if(!defined('THINK_PATH')) exit('deny access!');?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>{pigcms{$config.site_name}</title>
		<meta name="description" content="{pigcms{$config.seo_description}">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
		<link href="{pigcms{$static_path}css/index_wap.css?time=11" rel="stylesheet"/>
		<link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
	</head>
	<body id="index">
        <header class="navbar">
            <div class="nav-wrap-left">
            	<a href="{pigcms{:U('Home/index')}" class="react">
               		<span class="nav-city">首页<space></space><i class="text-icon icon-downarrow"></i></span>
           		</a>
            </div>
            <div class="box-search">
            	<a href="{pigcms{:U('Search/index')}" class="react">
                	<i class="icon-search text-icon">⌕</i>
               		<span>输入{pigcms{$config.group_alias_name}/{pigcms{$config.meal_alias_name} 搜索词</span>
           		 </a>
           	</div>
            <div class="nav-wrap-right">
                <a class="react" rel="nofollow" href="{pigcms{:U('My/index')}">
                    <span class="nav-btn">
                        <i class="text-icon">⍥</i>我的
                    </span>
                </a>
            </div>
        </header>
        <div id="container">
			<if condition="$wap_index_top_adver">
				<section class="banner">
					<div class="swiper-container swiper-container1">
						<div class="swiper-wrapper">
							<volist name="wap_index_top_adver" id="vo">
								<div class="swiper-slide">
									<a href="{pigcms{$vo.url}">
										<img src="{pigcms{$vo.pic}"/>
									</a>
								</div>
							</volist>
						</div>
						<div class="swiper-pagination swiper-pagination1"></div>
					</div>
				</section>
			</if>
			<if condition="$wap_index_slider">
				<dl class="list list-in" style="height:3.8rem;">
					<dd style="height:100%;">
						<div class="swiper-container swiper-container2">
							<div class="swiper-wrapper">
								<volist name="wap_index_slider" id="vo">
									<div class="swiper-slide">
										<ul class="icon-list">
											<volist name="vo" id="voo">
												<li class="icon">
													<a class="react" href="{pigcms{$voo.url}">
														<span class="icon-circle typeid1"><img src="{pigcms{$voo.pic}"/></span>
														<span class="icon-desc">{pigcms{$voo.name}</span>
													</a>
												</li>
											</volist>
										</ul>
									</div>
								</volist>
							</div>
							<div class="swiper-pagination swiper-pagination2"></div>
						</div>
					</dd>
				</dl>
			</if>
			<if condition="$invote_array">
				<dl class="list">
					<a href="{pigcms{$invote_array.url}" style="color:#666;display:block;padding:.2rem;">
						<img src="{pigcms{$invote_array.avatar}" style="width:0.8rem;margin-right:0.2rem;"/>
						{pigcms{$invote_array.txt}
						<button style="float:right;height:0.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 0.2rem;">关注我们</button>
					</a>
				</dl>
			<else />
				<if condition="$share">
					<dl class="list">
						<a href="{pigcms{$share.a_href}" style="color:#666;display:block;padding:.2rem;">
							<img src="{pigcms{$share.image}" style="width:0.8rem;height:0.8rem;margin-right:0.2rem;"/>
							{pigcms{$share.title}
							<button style="float:right;height:0.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 0.2rem;">{pigcms{$share['a_name']}</button>
						</a>
					</dl>
				</if>
			</if>
			<dl class="list" id="near_dom">
	    		<dd>
	    			<dl class="list">
	       				<dt style="padding-bottom:0px;padding-top:0px;" id="near_banner">
	       					<a style="border-bottom:2px solid #EE3968;color:#FF658E;" href="javascript:void(0);" onclick="get_near_info('merchant');" id="near_merchant">附近商家</a><a href="javascript:void(0);" onclick="get_near_info('group');" id="near_group">附近优惠</a><a href="javascript:void(0);" onclick="get_near_info('meal');" id="near_meal">附近{pigcms{$config.meal_alias_name}</a>
	       				</dt>
	       				<dd id="near_content">
							<div style="text-align:center;">
								<img src="{pigcms{$static_path}images/bg-loading.gif"/>
							</div>
				        </dd>
					</dl>
				</dd>
			</dl>
	    	<dl class="list qianggou">
	    		<dd>
			    	<dl>
			        	<dd class="dd-padding" style="padding:.28rem .2rem .28rem .08rem;">
			        		<div>
			           			<strong>优惠推荐</strong><space></space>
			       			</div>
			       		</dd>
				        <dd>
				        	<volist name="index_sort_group_list" id="vo">
					            <div class="qianggoucard">		
					            	<a href="{pigcms{$vo.url}" group-id="{pigcms{$vo.group_id}">		            	
						                <div class="img-container"><img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.s_name}"/></div>
						                <div class="brand"><if condition="$vo['tuan_type'] neq 2">{pigcms{$vo.merchant_name}<else/>{pigcms{$vo.s_name}</if></div>
						                <div class="campaign-price">{pigcms{$vo['price']-$vo['wx_cheap']}元</div>
						                <if condition="empty($vo['wx_cheap'])">
						               		<div class="discount-price">门店价 <del>{pigcms{$vo.old_price}元</del></div>
						               	<else/>
						               		<div class="discount-price">{pigcms{$config.group_alias_name}价<del>{pigcms{$vo.price}元</del></div>
						               	</if>
					               	</a>
					            </div>
					         </volist>
				        </dd>
			  	  	</dl>
	  	 	  	</dd>
	  	 	</dl>
			<if condition="$classify_Zcategorys">
				<dl class="list classifyDom">
					<dd>
						<dl>
							<dd class="dd-padding" style="padding:.24rem .2rem .18rem .08rem;">
								<div>
									<a style="color:red;font-weight:bold;" href="{pigcms{:U('Classify/index')}">分类信息</a>
									<a href="{pigcms{:U('Classify/SelectSub')}" class="add"><i class="ico_write"></i>发布信息</a>
								</div>
							</dd>
							<dd>
								<volist name="classify_Zcategorys" id="vo">
									<div class="classify_f_div <if condition='$i eq 1'>on</if>">
										<a href="{pigcms{:U('Classify/Subdirectory',array('cid'=>$vo['cid'],'ctname'=>urlencode($vo['cat_name'])))}">{pigcms{$vo.cat_name}</a>
									</div>
									<ul <if condition='$i neq 1'>style="display:none;"</if>>
										<volist name="vo['subdir']" id="voo">
											<li><a href="{pigcms{:U('Classify/Lists',array('cid'=>$voo['cid']))}">{pigcms{$voo.cat_name}</a></li>
										</volist>
										<if condition="$vo['subEmptyCount']">
											<for start="0" end="$vo['subEmptyCount']">
												<li></li>
											</for>
										</if>
									</ul>
								</volist>
							</dd>
						</dl>
					</dd>
				</dl>
			</if>
			<if condition="$wap_index_center_adver">
				<dl class="list">
					<dd class="huodong-padding">
						<div class="huodong-line">
							<volist name="wap_index_center_adver" id="vo">
								<div class="huodong-container">
									<a href="{pigcms{$vo.url}">
										<div class="huodong-img-wrapper"><img src="{pigcms{$vo.pic}"/></div>
									</a>
								</div>
								<if condition="$i%2 eq 0 && $i neq 4">
									</div>
									<div class="huodong-line">
								</if>
							</volist>
						</div>
					</dd>
				</dl>
			</if>
			<dl class="list">
	    		<dd>
	    			<dl class="list">
	       				<dt style="padding-bottom:0px;padding-top:0px;">
	       					<a style="width:49%;display:inline-block;text-align:center;border-bottom:2px solid #EE3968;padding-bottom:0.2rem;padding-top:0.28rem;color:#FF658E;" href="{pigcms{:U('Group/index')}">最新优惠</a>
	       					<a style="width:49%;display:inline-block;text-align:center;color:black;padding-bottom:0.2rem;padding-top:0.28rem;" href="{pigcms{:U('Meal_list/index')}">店铺{pigcms{$config.meal_alias_name}</a>
	       				</dt>
	       				<volist name="new_group_list" id="vo">
		        			<dd>
		        				<a href="{pigcms{$vo.url}" class="index_sort_a react" group-id="{pigcms{$vo.group_id}">
									<div class="dealcard">
										<div class="dealcard-img imgbox">
											<img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.s_name}" style="width:100%;height:100%;"/>
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
									           		<span class="tag">微信再减￥{pigcms{$vo.wx_cheap}</span>
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
				</dd>
	   			<dd class="db">
	   				<a class="react" href="{pigcms{$group_category_all}">
	        			<div class="more">查看全部{pigcms{$config.group_alias_name}</div>
	    			</a>
	    		</dd>
			</dl>
		</div>
		<style>
		#near_banner{padding-right:0px;}
		#near_banner a{width:33.33%;display:inline-block;text-align:center;color:black;padding-bottom:0.2rem;padding-top:0.28rem;font-size:.28rem;}
		#near_content .qianggoucard{height:auto;margin:0;padding:.2rem 0;border-bottom:1px solid #C9C4B8;}
		#near_content .qianggoucard .brand{height:.64rem;overflow:hidden;line-height:.32rem;margin-bottom:.15rem;}
		#near_content .qianggoucard .campaign-price{margin-bottom:0;color:black;font-size:.24rem;}
		</style>
		<script src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script src="{pigcms{$static_path}js/common_wap.js"></script>
		<script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
		<script>var wechat_name="{pigcms{$config.wechat_name}";var get_near_url="{pigcms{:U('Home/near_info')}";var group_index_sort_url="{pigcms{:U('Home/group_index_sort')}";<if condition="$user_long_lat">var user_long = "{pigcms{$user_long_lat.long}";var user_lat = "{pigcms{$user_long_lat.lat}";<else/>var user_long = '0';var user_lat  = '0';</if></script>
		<script src="{pigcms{$static_path}js/wap_index.js?{pigcms{$_SERVER['REQUEST_TIME']}"></script>
		
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Home",
		            "moduleID":"0",
		            "imgUrl": "{pigcms{$config.site_logo}", 
		            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Home/index')}",
		            "tTitle": "{pigcms{$config.site_name}",
		            "tContent": "{pigcms{$config.seo_description}"
		};
		</script>
		{pigcms{$shareScript}

		<include file="Public:footer"/>
	</body>
</html>