<?php if (!defined('THINK_PATH')) exit(); if(!defined('THINK_PATH')) exit('deny access!');?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo ($config["site_name"]); ?></title>
		<meta name="description" content="<?php echo ($config["seo_description"]); ?>">
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name='apple-touch-fullscreen' content='yes'>
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="address=no">

		<link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
		<link href="<?php echo ($static_path); ?>css/index_wap.css?time=11" rel="stylesheet"/>
		<link href="<?php echo ($static_path); ?>css/idangerous.swiper.css" rel="stylesheet"/>
	</head>
	<body id="index">
        <header class="navbar">
            <div class="nav-wrap-left">
            	<a href="<?php echo U('Home/index');?>" class="react">
               		<span class="nav-city">首页<space></space><i class="text-icon icon-downarrow"></i></span>
           		</a>
            </div>
            <div class="box-search">
            	<a href="<?php echo U('Search/index');?>" class="react">
                	<i class="icon-search text-icon">⌕</i>
               		<span>输入<?php echo ($config["group_alias_name"]); ?>/<?php echo ($config["meal_alias_name"]); ?> 搜索词</span>
           		 </a>
           	</div>
            <div class="nav-wrap-right">
                <a class="react" rel="nofollow" href="<?php echo U('My/index');?>">
                    <span class="nav-btn">
                        <i class="text-icon">⍥</i>我的
                    </span>
                </a>
            </div>
        </header>
        <div id="container">
			<?php if($wap_index_top_adver): ?><section class="banner">
					<div class="swiper-container swiper-container1">
						<div class="swiper-wrapper">
							<?php if(is_array($wap_index_top_adver)): $i = 0; $__LIST__ = $wap_index_top_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
									<a href="<?php echo ($vo["url"]); ?>">
										<img src="<?php echo ($vo["pic"]); ?>"/>
									</a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<div class="swiper-pagination swiper-pagination1"></div>
					</div>
				</section><?php endif; ?>
			<?php if($wap_index_slider): ?><dl class="list list-in" style="height:3.8rem;">
					<dd style="height:100%;">
						<div class="swiper-container swiper-container2">
							<div class="swiper-wrapper">
								<?php if(is_array($wap_index_slider)): $i = 0; $__LIST__ = $wap_index_slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
										<ul class="icon-list">
											<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li class="icon">
													<a class="react" href="<?php echo ($voo["url"]); ?>">
														<span class="icon-circle typeid1"><img src="<?php echo ($voo["pic"]); ?>"/></span>
														<span class="icon-desc"><?php echo ($voo["name"]); ?></span>
													</a>
												</li><?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<div class="swiper-pagination swiper-pagination2"></div>
						</div>
					</dd>
				</dl><?php endif; ?>
			<?php if($invote_array): ?><dl class="list">
					<a href="<?php echo ($invote_array["url"]); ?>" style="color:#666;display:block;padding:.2rem;">
						<img src="<?php echo ($invote_array["avatar"]); ?>" style="width:0.8rem;margin-right:0.2rem;"/>
						<?php echo ($invote_array["txt"]); ?>
						<button style="float:right;height:0.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 0.2rem;">关注我们</button>
					</a>
				</dl>
			<?php else: ?>
				<?php if($share): ?><dl class="list">
						<a href="<?php echo ($share["a_href"]); ?>" style="color:#666;display:block;padding:.2rem;">
							<img src="<?php echo ($share["image"]); ?>" style="width:0.8rem;height:0.8rem;margin-right:0.2rem;"/>
							<?php echo ($share["title"]); ?>
							<button style="float:right;height:0.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 0.2rem;"><?php echo ($share['a_name']); ?></button>
						</a>
					</dl><?php endif; endif; ?>
			<dl class="list" id="near_dom">
	    		<dd>
	    			<dl class="list">
	       				<dt style="padding-bottom:0px;padding-top:0px;" id="near_banner">
	       					<a style="border-bottom:2px solid #EE3968;color:#FF658E;" href="javascript:void(0);" onclick="get_near_info('merchant');" id="near_merchant">附近商家</a><a href="javascript:void(0);" onclick="get_near_info('group');" id="near_group">附近优惠</a><a href="javascript:void(0);" onclick="get_near_info('meal');" id="near_meal">附近<?php echo ($config["meal_alias_name"]); ?></a>
	       				</dt>
	       				<dd id="near_content">
							<div style="text-align:center;">
								<img src="<?php echo ($static_path); ?>images/bg-loading.gif"/>
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
				        	<?php if(is_array($index_sort_group_list)): $i = 0; $__LIST__ = $index_sort_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="qianggoucard">		
					            	<a href="<?php echo ($vo["url"]); ?>" group-id="<?php echo ($vo["group_id"]); ?>">		            	
						                <div class="img-container"><img src="<?php echo ($vo["list_pic"]); ?>" alt="<?php echo ($vo["s_name"]); ?>"/></div>
						                <div class="brand"><?php if($vo['tuan_type'] != 2): echo ($vo["merchant_name"]); else: echo ($vo["s_name"]); endif; ?></div>
						                <div class="campaign-price"><?php echo ($vo['price']-$vo['wx_cheap']); ?>元</div>
						                <?php if(empty($vo['wx_cheap'])): ?><div class="discount-price">门店价 <del><?php echo ($vo["old_price"]); ?>元</del></div>
						               	<?php else: ?>
						               		<div class="discount-price"><?php echo ($config["group_alias_name"]); ?>价<del><?php echo ($vo["price"]); ?>元</del></div><?php endif; ?>
					               	</a>
					            </div><?php endforeach; endif; else: echo "" ;endif; ?>
				        </dd>
			  	  	</dl>
	  	 	  	</dd>
	  	 	</dl>
			<?php if($classify_Zcategorys): ?><dl class="list classifyDom">
					<dd>
						<dl>
							<dd class="dd-padding" style="padding:.24rem .2rem .18rem .08rem;">
								<div>
									<a style="color:red;font-weight:bold;" href="<?php echo U('Classify/index');?>">分类信息</a>
									<a href="<?php echo U('Classify/SelectSub');?>" class="add"><i class="ico_write"></i>发布信息</a>
								</div>
							</dd>
							<dd>
								<?php if(is_array($classify_Zcategorys)): $i = 0; $__LIST__ = $classify_Zcategorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="classify_f_div <?php if($i == 1): ?>on<?php endif; ?>">
										<a href="<?php echo U('Classify/Subdirectory',array('cid'=>$vo['cid'],'ctname'=>urlencode($vo['cat_name'])));?>"><?php echo ($vo["cat_name"]); ?></a>
									</div>
									<ul <?php if($i != 1): ?>style="display:none;"<?php endif; ?>>
										<?php if(is_array($vo['subdir'])): $i = 0; $__LIST__ = $vo['subdir'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Classify/Lists',array('cid'=>$voo['cid']));?>"><?php echo ($voo["cat_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
										<?php if($vo['subEmptyCount']): $__FOR_START_4804__=0;$__FOR_END_4804__=$vo['subEmptyCount'];for($i=$__FOR_START_4804__;$i < $__FOR_END_4804__;$i+=1){ ?><li></li><?php } endif; ?>
									</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							</dd>
						</dl>
					</dd>
				</dl><?php endif; ?>
			<?php if($wap_index_center_adver): ?><dl class="list">
					<dd class="huodong-padding">
						<div class="huodong-line">
							<?php if(is_array($wap_index_center_adver)): $i = 0; $__LIST__ = $wap_index_center_adver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="huodong-container">
									<a href="<?php echo ($vo["url"]); ?>">
										<div class="huodong-img-wrapper"><img src="<?php echo ($vo["pic"]); ?>"/></div>
									</a>
								</div>
								<?php if($i%2 == 0 && $i != 4): ?></div>
									<div class="huodong-line"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</dd>
				</dl><?php endif; ?>
			<dl class="list">
	    		<dd>
	    			<dl class="list">
	       				<dt style="padding-bottom:0px;padding-top:0px;">
	       					<a style="width:49%;display:inline-block;text-align:center;border-bottom:2px solid #EE3968;padding-bottom:0.2rem;padding-top:0.28rem;color:#FF658E;" href="<?php echo U('Group/index');?>">最新优惠</a>
	       					<a style="width:49%;display:inline-block;text-align:center;color:black;padding-bottom:0.2rem;padding-top:0.28rem;" href="<?php echo U('Meal_list/index');?>">店铺<?php echo ($config["meal_alias_name"]); ?></a>
	       				</dt>
	       				<?php if(is_array($new_group_list)): $i = 0; $__LIST__ = $new_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
		        				<a href="<?php echo ($vo["url"]); ?>" class="index_sort_a react" group-id="<?php echo ($vo["group_id"]); ?>">
									<div class="dealcard">
										<div class="dealcard-img imgbox">
											<img src="<?php echo ($vo["list_pic"]); ?>" alt="<?php echo ($vo["s_name"]); ?>" style="width:100%;height:100%;"/>
										</div>
									    <div class="dealcard-block-right">
											<?php if($vo['tuan_type'] != 2): ?><div class="dealcard-brand single-line"><?php echo ($vo["merchant_name"]); ?></div>
												<div class="title text-block">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div>
											<?php else: ?>
												<div class="dealcard-brand single-line"><?php echo ($vo["s_name"]); ?></div>
												<div class="title text-block">[<?php echo ($vo["prefix_title"]); ?>]<?php echo ($vo["group_name"]); ?></div><?php endif; ?>
									        <div class="price">
									            <strong><?php echo ($vo["price"]); ?></strong>
									            <span class="strong-color">元</span>
									            <?php if($vo['wx_cheap']): ?><span class="tag">微信再减￥<?php echo ($vo["wx_cheap"]); ?></span>
									            <?php else: ?>
									            	<del><?php echo ($vo["old_price"]); ?>元</del><?php endif; ?>
									            <?php if($vo['sale_count']+$vo['virtual_num']): ?><span class="line-right">已售<?php echo ($vo['sale_count']+$vo['virtual_num']); ?></span><?php endif; ?>
									        </div>
									    </div>
									</div>
		       					</a>
		       				</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</dl>
				</dd>
	   			<dd class="db">
	   				<a class="react" href="<?php echo ($group_category_all); ?>">
	        			<div class="more">查看全部<?php echo ($config["group_alias_name"]); ?></div>
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
		<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>
		<script src="<?php echo ($static_path); ?>js/idangerous.swiper.min.js"></script>
		<script>var wechat_name="<?php echo ($config["wechat_name"]); ?>";var get_near_url="<?php echo U('Home/near_info');?>";var group_index_sort_url="<?php echo U('Home/group_index_sort');?>";<?php if($user_long_lat): ?>var user_long = "<?php echo ($user_long_lat["long"]); ?>";var user_lat = "<?php echo ($user_long_lat["lat"]); ?>";<?php else: ?>var user_long = '0';var user_lat  = '0';<?php endif; ?></script>
		<script src="<?php echo ($static_path); ?>js/wap_index.js?<?php echo ($_SERVER['REQUEST_TIME']); ?>"></script>
		
		<script type="text/javascript">
		window.shareData = {  
		            "moduleName":"Home",
		            "moduleID":"0",
		            "imgUrl": "<?php echo ($config["site_logo"]); ?>", 
		            "sendFriendLink": "<?php echo ($config["site_url"]); echo U('Home/index');?>",
		            "tTitle": "<?php echo ($config["site_name"]); ?>",
		            "tContent": "<?php echo ($config["seo_description"]); ?>"
		};
		</script>
		<?php echo ($shareScript); ?>

				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
	    <footer class="footermenu">
		    <ul>
		        <li>
		            <a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
		            <img src="<?php echo ($static_path); ?>images/3YQLfzfunJ.png">
		            <p>首页</p>
		            </a>
		        </li>
		        <li>
		            <a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
		            <img src="<?php echo ($static_path); ?>images/Lngjm86JQq.png">
		            <p><?php echo ($config["group_alias_name"]); ?></p>
		            </a>
		        </li>
		        <li>
		            <a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal'))): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index');?>">
		            <img src="<?php echo ($static_path); ?>images/s22KaR0Wtc.png">
		            <p><?php echo ($config["meal_alias_name"]); ?></p>
		            </a>
		        </li>
		        <li>
		            <a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
		            <img src="<?php echo ($static_path); ?>images/J0uZbXQWvJ.png">
		            <p>我的</p>
		            </a>
		        </li>
		    </ul>
		</footer>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        
	</body>
</html>