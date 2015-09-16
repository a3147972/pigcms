<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<title>{pigcms{$config.seo_title}</title>
	<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
	<meta name="description" content="{pigcms{$config.seo_description}" />
	<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
	<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
	<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
	<script src="{pigcms{$static_path}js/navfix.js"></script>	
	<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
	<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
	<link rel="stylesheet" href="{pigcms{$static_path}css/shop_activity.css">
		<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{$static_path}js/common.js" type="text/javascript"></script>
	<!--[if IE 6]>
		<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   /* EXAMPLE */
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

		   /* string argument can be any CSS selector */
		   /* .png_bg example is unnecessary */
		   /* change it to what suits you! */
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
		body{ behavior:url("csshover.htc"); }
		</style>
	<![endif]-->
</head>
<body>
	<include file="Public:shop_header"/>
	<include file="Public:shop_menu"/>
	<div class="article cf">
		<section class="server">
			<div class="section_title cf">
				<div class="section_txt">{pigcms{$config.group_alias_name}活动</div>
				<div class="section_border"></div>
			</div>
			<article class="category" id="f1">
				<div class="category_list">
				   <if condition="!empty($purchase)">
					<ul class="cf">
							<volist name="purchase" id="pv" key="kk">
								<li <if condition="$kk%4 eq 0">class="last--even" <else/> class="border1" </if>>
								   <a href="{pigcms{$pv['url']}" target="_blank">
										<div class="category_list_img"> 
											<img src="{pigcms{$pv['list_pic']}" class="proimg"/>
											<div class="bmbox">
												<div class="bmbox_title">该商家有 <span>{pigcms{$pv['fans_count']}</span> 个粉丝</div>
												<div class="bmbox_list">
													<div class="bmbox_list_img"><img src="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'group','id'=>$pv['group_id']))}" class="ewm"></div>
													<div class="bmbox_list_li">
														<ul>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$merid}.html">商家</li>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$merid}.html">{pigcms{$config.group_alias_name}</li>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$merid}.html">{pigcms{$config.meal_alias_name}</li>
															<li class="open_windows" data-url="{pigcms{$config.site_url}/mermap/{pigcms{$merid}.html">地图</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</a>
									<div class="datal cf">
										<a href="{pigcms{$pv['url']}" target="_blank">
											<div class="category_list_title">【{pigcms{$pv['prefix_title']}】{pigcms{$pv['s_name']}</div>
											<div class="category_list_description">{pigcms{$pv['group_name']}</div>
										</a>
										<div class="deal-tile__detail cf">
											<span id="price">¥<strong>{pigcms{$pv['price']}</strong> </span>
											<span>门店价¥{pigcms{$pv['old_price']}</span>
											<if condition="$pv['wx_cheap']">
												<div class="cheap">微信购买立减￥{pigcms{$pv['wx_cheap']}</div>
											</if>
										</div>
										<div class="extra-inner">
											<div class="sales">
												<div class="actity_txt"> 已售 <span>{pigcms{$pv['sale_count']+$pv['virtual_num']}</span></div>
											</div>
										</div>
									</div>
								</li>
							</volist>
					    </ul>
					<else />
					 <div style="margin-top:10px;font-size:16px">暂无{pigcms{$config.group_alias_name}商品</div>
					</if>
				</div>
			</article>
		</section>
	</div>
	<include file="Public:footer"/>
</body>
</html>