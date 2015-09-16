<!DOCTYPE html>
<html lang="zh-CN">
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
  <title>{pigcms{$ctname}</title> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mcategory.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
 </head> 
 <body style="min-height: 600px;"> 
  <div id="banner"> 
   <div id="index_down_div"> 
    <div id="pics"> 
     <ul id="datu"></ul> 
     <div class="panel_num"></div> 
    </div> 
   </div> 
  </div> 
  <div class="header"> 
   <!--<a class="logo" rel="nofollow" href="/wap.php?g=Wap&c=Classify&a=index"> <img src="{pigcms{$static_path}classify/logo_white.png" alt="" title="" width="69" height="20" /></a> 
   <a class="city_a" href=""> 
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

  <div id="house" class="house"> 
   <!--<div class="pc_banner"> 
    <a href=""> <img src="" alt="" /> </a> 
   </div>-->  
   </div> 
   <div class="warp" style=""> 
    <div class="nav_tt nav_ttbg1 tuijian warp_nav" style="margin-top: 5px;">
     <a href="javascript:void(0)">导航</a>
    </div> 
    <div class="sm_dl" style="padding-bottom: 30px;">
	<if condition="!empty($Subdirectory2)">
	<volist name="Subdirectory2" id="sv">
     <dl> 
      <dt>
       <a href="{pigcms{:U('Classify/Lists',array('cid'=>$sv['cid']))}">{pigcms{$sv['cat_name']}</a>
      </dt> 
      <dd class="zufang_link">
	   <if condition="!empty($sv['subdir'])">
	   <volist name="sv['subdir']" id="subv">
	    
        <a href="{pigcms{:U('Classify/Lists',array('cid'=>$subv['fcid'],'sub3dir'=>$subv['cid']))}">{pigcms{$subv['cat_name']}</a>

	   </volist>
	   </if>
      </dd> 
     </dl> 
	 </volist>
	 <else/>
     <dl>  
      <dd class="zufang_link" style="text-align: center;font-size: 20px;height: 50px;line-height: 50px;">
	    没有子分类！
      </dd> 
     </dl> 
     </if> 

    </div> 
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
  <script async="" src="{pigcms{$static_path}classify/myhonepage.js"></script>  
 </body>
</html>