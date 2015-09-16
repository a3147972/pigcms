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
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_introduction.css">
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
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
        body{ behavior:url("csshover.htc"); 
		}
 
	 
			}
        </style>
<![endif]-->
<!--<link rel="stylesheet" href="http://bdimg.share.baidu.com/static/api/css/share_style0_16.css?v=8105b07e.css" />-->
</head>
<body>
<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<article class="article"> 
  <div class="tab1" id="tab1">
    <php>$cyname="全部资讯";</php>
    <div class="menu">
      <ul>
        <li <if condition="!($cyid gt 0)"> class="off" </if>><a href="{pigcms{$config.site_url}/mernews/{pigcms{$merid}.html">全部资讯</a></li>
		<volist name="classify" id="cyv" key="kk">
		<php>if($cyid == $cyv['id']){$cyname=$cyv['cyname'];}</php>
        <li <if condition="$cyid eq $cyv['id']"> class="off" </if>><a href="{pigcms{$config.site_url}/mernews/{pigcms{$merid}.html?cyid={pigcms{$cyv['id']}">{pigcms{$cyv['cyname']}</a></li>
		</volist>
      </ul>
    </div>
    <div class="menudiv">
      <div id="con_one_1">
        <section class="server dynamics">
          <div class="section_title">
            <div class="section_txt" style="width: 80%;height: 60px;white-space:nowrap; line-height: 50px;">{pigcms{$introduce['title']}</div>
            <div class="section_border" style="width: 17%;height: 60px;">{pigcms{$introduce['addtime']|date="Y-m-d H:i:s",###}</div>
            <div style="clear:both"></div>
          </div>
		  <div class="inner">
		  {pigcms{$introduce['content']|htmlspecialchars_decode=ENT_QUOTES}
		  </div>
		  <div style="clear:both"></div>
        </section>
      </div>

    </div>
  </div>
</article>
<div style="clear:both"></div>
<include file="Public:footer"/>
</body>
</html>