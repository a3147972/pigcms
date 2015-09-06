<!DOCTYPE html>
<html lang="zh-CN" class="index_page">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="location" content="" /> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <meta name="keywords" content="" /> 
  <meta name="description" content="" /> 
  <title>分类信息</title> 
  <link rel="apple-touch-icon-precomposed" href="" /> 
  <link rel="apple-touch-startup-image" href="" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mindex.css" /> 
  <link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <style type="text/css">
  .pc_banner img{width:100%;height:150px;}
  </style>
 </head>
 <body class="hIphone"> 
  <div class="header"> 
   <!--<a class="logo" rel="nofollow" href="/wap.php?g=Wap&c=Classify&a=index"> <img src="{pigcms{$static_path}classify/logo_white.png" alt="" width="69" height="20" /> </a> 
   <a class="city_a" href="" > 
    <div class="city">
	{pigcms{$Nowarea['area_name']}
    </div> 
    <!--<div class="city_ico"></div> </a> -->
   <div class="search "> 
    <form action="" method="get" onsubmit="return win.submit();"> 
     <div class="search_input"> 
      <a id="searchUrl" class="search_url_new" href="javascript:;" style="height: 34px; line-height: 34px;">找你所找，寻你所寻</a> 
      <span class="ico_clear body_bg" onclick="win.clear(this)"></span> 
     </div> 
     <div id="qixc" class="search_but body_bg"></div> 
    </form>
   </div> 
  </div> 
  <div id="index"> 
<!--
   <div class="pc_banner"> 
    <if condition="false AND !empty($classify_index_ad)">
    <ul>
	 <volist name="classify_index_ad" id="adimg">
     <li> <a href="{pigcms{$adimg['url']}" />  <img src="{pigcms{$adimg['pic']}" alt="{pigcms{$adimg['name']}" /></a></li>
	 </volist>
    </ul> 
	
    <div class="banner_icon">
	 <volist name="classify_index_ad" id="adimg">
     <i></i>
	 </volist>
    </div> 
	</if>
   </div> --->

 <if condition="!empty($classify_index_ad)">
<section class="banner" style="height:150px;">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<volist name="classify_index_ad" id="adimg">
				<div class="swiper-slide">
					<a href="{pigcms{$adimg['url']}">
						<img src="{pigcms{$adimg['pic']}" alt="{pigcms{$adimg['name']}"/>
					</a>
				</div>
			</volist>
		</div>
		<div class="swiper-pagination"></div>
	</div>
</section>
</if>

   <div class="nav_top"> 
    <ul class="nav3"> 
	 <li style="border-right:1px solid #e0e0e0;"><a href="{pigcms{:U('Classify/SelectSub',array('cid'=>0))}" rel="nofollow">发布信息</a></li> 
     <li><a href="{pigcms{:U('Classify/myCenter',array('uid'=>$uid))}" rel="nofollow">个人中心</a></li>
    </ul> 
    <!--广告位--> 
    <div id="wangmeng_homepage_top_container" style="display: block;">
     <div id="homepage_top">
     </div>
    </div> 
    <!--广告位结束--> 
   </div> 
   <div class="index_nav_dl"> 
    <if condition="!empty($Zcategorys)">
	 <volist name="Zcategorys" id="zv">
    <dl> 
     <dt class="zp"> 
      <a href="{pigcms{:U('Classify/Subdirectory',array('cid'=>$zv['cid'],'ctname'=>urlencode($zv['cat_name'])))}"><!--<i class="ico"></i>--> {pigcms{$zv['cat_name']}<i class="arrow_r"></i></a> 
		<a href="{pigcms{:U('Classify/SelectSub',array('cid'=>$zv['cid']))}#ct_item_{pigcms{$zv['cid']}"  class="todo"><i class="ico_write"></i>发布信息</a>  
     </dt> 
     <dd>
	  <if condition="!empty($zv['subdir'])">
	  <php>$tt=count($zv['subdir']);</php>
	  <volist name="zv['subdir']" id="sv" mod="3" key="m">
	    <if condition="$mod eq 0">
         <div class="link4"> 
	    </if><a href="{pigcms{:U('Classify/Lists',array('cid'=>$sv['cid']))}">{pigcms{$sv['cat_name']}</a>&nbsp; 
	    <if condition="$mod eq 2 OR $m eq $tt">
         </div>
	    </if>
	  </volist>
	  </if> 
      <div class="sale3"> 
      </div> 
     </dd> 
    </dl>
	</volist>
   </if>
    <dl class="service" id="wangmeng_homepage_btm_container8"></dl> 
   </div> 
  </div>
  <!-- 搜索框 -->
<div class="search_container">
    <form action="" method="get" onsubmit="win.getData();return false;">
        <div class="search_input">
            <input type="text" name="key" class="input_keys" id="keyWords1" value="" onblur="win.blur()" onfocus="win.focus()" onkeyup="win.getData()" autocomplete="off">
            <i class="search_icon"></i>
        </div>
        <div class="search_cancel" onclick="win.cancel()">取消</div>
    </form>
    <div class="search_ajax"> </div>
    <div class="no_search">  
    <div class="hot_word">
	</div>
	</div>
</div>
<div style="margin-bottom: 100px;">
</div>
<include file="Classify:footer"/>
  <!--<div id="tipsDiv">正在获取位置信息...</div>---> 
   <script async="" src="{pigcms{$static_path}classify/myhonepage.js"></script> 
   <script src="{pigcms{$static_path}js/idangerous.swiper.min.js"></script>
   <script>
   var mySwiper = $('.swiper-container').swiper({
	pagination:'.swiper-pagination',
    loop:true,
    grabCursor: true,
    paginationClickable: true
});
</script>
 </body>
</html>