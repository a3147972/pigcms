<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <title>分类信息</title> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mball.css" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/ucenter_v.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
 </head> 
 <body> 
 <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
  <div class="body_div" style="margin:0 auto; width: 1000px;background-color: #fff;padding-bottom: 30px; margin-top: 7px;"> 
   <!-- BODY HEADER --> 
   <div class="c_header" style="border-bottom:1px solid #FF6C00"> 
    <a class="c_logo" href="{pigcms{$siteUrl}/classify/" style="font-size: 20px;">分类信息首页</a> 
    <a class="c_publish" href="{pigcms{$siteUrl}/classify/selectsub.html"> <i class="ico"></i>发布 </a> 
   </div> 
   <div class="c_logn"> 
    <img src="{pigcms{$static_path}classify/center_ico.png" width="43" height="43" class="fl u_img" /> 
   </div> 
   <div class="c_center"> 
    <ul> 
     <li class="border_m border_r"><a class="my_publish" href="{pigcms{$siteUrl}/classify/myfabu-{pigcms{$uid}.html">我的发布</a></li> 
     <li class="border_m"><a class="my_collect" href="{pigcms{$siteUrl}/classify/mycollect-{pigcms{$uid}.html">我的收藏</a></li> 
    </ul> 
 <!----
    <ul> 
     <li class="border_m border_r"><a class="my_record" href="">浏览记录</a></li> 
	 <li class="border_m"><a class="my_back " href="">意见反馈</a></li>
    </ul> 
 --->
   </div> 
  </div> 
  <div class="tg-bg" id="tg-bg"></div>
  <div style="margin-bottom: 100px;">
</div>
  <include file="Classify:footer"/>
 </body>
</html>