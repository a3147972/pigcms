<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/css.css" type="text/css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css" rel="stylesheet" type="text/css" />
<link href="{pigcms{$static_path}css/order.css" type="text/css" rel="stylesheet" />
<link href="{pigcms{$static_path}css/meal_list.css" type="text/css" rel="stylesheet" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/list.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
<!--[if IE 6]>
	<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
<![endif]-->
<!--[if lt IE 9]>
	<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
<![endif]-->

<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
	body{ behavior:url("csshover.htc");}
	.category_list li:hover .bmbox {filter:alpha(opacity=50);}
</style>
<![endif]-->
<style>
#gd_box{ width:180px; height:360px;}
.gd_box2{ width:4px; height:320px; background:#dddddd; position:absolute; top:12px; right:3px;}

.search-tip {
  margin-top: 5px;
  padding: 8px 15px;
  line-height: 18px;
  border: 1px solid #D4D4D4;
  font-size: 12px;
  background-color: #F9F9F9;
  word-wrap: break-word;
}
.search-tip p {
  margin-right: 10em;
}
.search-tip .count, .search-tip .keyword {
  padding: 0 5px;
  color: #f76120;
  font-weight: 700;
}
.no-result {
  position: relative;
  height: 68px;
  padding: 45px;
  text-align: center;
  font-size: 12px;
  background: #fff;
  border: 1px solid #d4d4d4;
  margin-bottom: 16px;
}
.no-result .no-result-content {
  height: 80px;
  line-height: 80px;
  color: #333;
  padding-left: 15px;
  font-weight: 700;
}
.pg-search .no-result .no-result-content, .pg-search .no-result .no-result-img {
  display: inline-block;
  vertical-align: middle;
}
.no-result strong {
  color: #f76120;
}

</style>
</head>
<body>
<include file="Public:header_top"/>

<article class="header_list body">
	<div class="menu cf">
		<div class="menu_left hide">
			<div class="menu_left_top">
				<div class="menu_left_top_icon">
					<img src="{pigcms{$static_path}images/o2o5-24_31.png" />
				</div>  
				<div class="menu_left_top_txt">全部分类</div>
			</div>
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
								<div class="list_txt">
									<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
									<volist name="vo['category_list']" id="voo" key="j">
										<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a>
									</volist>
								</div>
							</if>
						</li>
					</volist>
				</ul>
			</div>
		</div>
		<div class="menu_right">
			<div class="menu_right_top">
				<ul>
				<volist name="web_index_slider" id="vo">
					<li class="ctur">
						<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
					</li>
				</volist>
				</ul>
			</div>
		</div>
	</div>
</article>

<article id="f1" style="width:1210px;">
	<div class="category_list" style="width:1210px;">
		<if condition="$group_list">
		<div class="search-tip">
			<p>找到<span class="keyword">“{pigcms{$keywords}”</span>相关{pigcms{$config.meal_alias_name}<span class="count">{pigcms{$meal_count}</span>个</p>
		</div>
		<ul>
			<volist name="group_list" id="vo">
			<li <if condition='$i%4 eq 0'>class="last--even"</if>>
			<a href="{pigcms{$vo.url}" target="_blank">
				<div class="category_list_img">
					<img src="{pigcms{$vo.image}"/>
					<div class="shop_data">
						<div class="shop_state" <if condition="$vo['state']">id="shop_state"</if>><if condition="$vo['state']">营业中<else />打烊了</if> </div>
						<div class="shop_time">{pigcms{$vo['work_time']}</div>
					</div>
					<div class="bmbox">
						<div class="bmbox_title"> 该商家有<span>{pigcms{$vo['fans_count']}</span>个粉丝</div>
						<div class="bmbox_list">
							<div class="bmbox_list_img"><img  class="lazy_img" src="{pigcms{$static_public}images/blank.gif" data-original="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'meal','id'=>$vo['store_id']))}" /></div>
							<div class="bmbox_list_li">
								<ul>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/merindex/{pigcms{$vo.mer_id}.html">商家</li>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/meractivity/{pigcms{$vo.mer_id}.html">{pigcms{$config.group_alias_name}</li>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/mergoods/{pigcms{$vo.mer_id}.html">{pigcms{$config.meal_alias_name}</li>
									<li class="open_windows" data-url="{pigcms{$config.site_url}/mermap/{pigcms{$vo.mer_id}.html">地图</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="datal">
 					<div class="shop">
						<div class="category_list_title">{pigcms{$vo.name} </div>
						<div class="shop_icon">
							<if condition="$vo['zeng']">
							<span><img src="{pigcms{$static_path}images/dingcan_20.png" title="{pigcms{$vo['zeng']}"/></span>
							</if>
							<if condition="$vo['full_money'] neq 0.00 AND $vo['minus_money'] neq 0.00">
							<span><img src="{pigcms{$static_path}images/dingcan_22.png" title="支持立减优惠，每单满{pigcms{$vo['full_money']}元减{pigcms{$vo['minus_money']}元"/></span>
							</if>
							<if condition="$vo['song']">
							<span><img src="{pigcms{$static_path}images/dingcan_24.png" title="{pigcms{$vo['song']}"/></span>
							</if>
						</div>
						<div style="clear:both"></div>
					</div>
					<div class="deal-tile__detail">
						<div class="shop_add">
							<div class="shop_add_icon"><img src="{pigcms{$static_path}images/dingcan_30.png" /> </div>
							<div class="shop_add_txt">{pigcms{$vo.adress} </div>
						</div>
						<!--div id="cheap">品牌快餐</div-->
					</div>
				</div>
			</a>
			</li>
			</volist>
		</ul>
		<else />
			<div class="no-result">
				<span class="no-result-content">未找到与“<strong>{pigcms{$keywords}</strong>”相关的{pigcms{$config.meal_alias_name}</span>
			</div>
		</if>
	</div>
	<div style="clear:both"></div>
</article>
{pigcms{$pagebar}
<include file="Public:footer"/>
</body>
</html>