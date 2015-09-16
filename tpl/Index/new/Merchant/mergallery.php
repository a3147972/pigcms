<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
<!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
<script src="{pigcms{$static_path}js/navfix.js"></script>
<script src="{pigcms{$static_path}js/jquery.quicksand.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/jquery.easing.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/script.js" type="text/javascript"></script>
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_introduction.css">
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
<link type="text/css" href="{pigcms{$static_path}css/shop_photo.css" rel="stylesheet" >
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js" type="text/javascript"></script>
<style type="text/css">
#commonpage{width:98%;}
</style>
<!--[if IE 6]>
<script  src="js/DD_belatedPNG_0.0.8a.js" mce_src="js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   /* EXAMPLE */
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

   /* string argument can be any CSS selector */
   /* .png_bg example is unnecessary */
   /* change it to what suits you! */
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
        body{ behavior:url("csshover.htc"); 
		}
 
	 
			}
        </style>
<![endif]-->
 
</head>
<body>
<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<article class="article"> 

<div class="wrapper">
  <div class="portfolio-content">
    <ul class="portfolio-categ filter">
      <li class="all <if condition="!($cyid gt 0)">active</if>"> 全部图片 </li>
	  <volist name="classify" id="cyv" key="kk">
      <li class="cat-item-{pigcms{$cyv['id']} <if condition="$cyid eq $cyv['id']">active</if>">{pigcms{$cyv['cyname']}</li>
	  </volist>
    </ul>
    <div class="imgshowdiv">
    <ul class="portfolio-area">
	  <volist name="imgarr" id="imgv">
		  <li class="portfolio-item2" data-id="id-{pigcms{$key}" data-type="cat-item-{pigcms{$imgv[cyid]}">
			<div> <span class="image-block"> <a class="image-zoom" href="{pigcms{$config.site_url}/{pigcms{$imgv[imgstr]}" rel="prettyPhoto[gallery]"><img width="190" height="190" src="{pigcms{$config.site_url}/{pigcms{$imgv[imgstr]}"> </a> </span> </div>
		  </li>
	  </volist>
    </ul>
	<div style="clear:both"></div>
	</div>
    <!--end portfolio-area -->  <div style="clear:both"></div>
  </div>
  <!--end portfolio-content --> 
 
  <div style="clear:both"></div>
</div>
</article>
<include file="Public:footer"/>

</body></html>