<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <title>个人中心</title> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mball.css" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/ucenter_v.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
 </head> 
 <body> 
  <div class="body_div"> 
   <!-- BODY HEADER --> 
   <div class="c_header" style="border-bottom:1px solid #FF6C00"> 
    <a class="c_logo" href="/wap.php?g=Wap&c=Classify&a=index" style="font-size: 20px;">首页</a> 
    <a class="c_publish" href="{pigcms{:U('Classify/SelectSub',array('cid'=>0))}"> <i class="ico"></i>发布 </a> 
   </div> 
   <div class="c_logn"> 
    <if condition="!empty($user_session) && !empty($user_session['avatar'])">
    <img src="{pigcms{$user_session['avatar']}" width="43" height="43" class="fl u_img" /> 
	<else/>
	 <img src="{pigcms{$static_path}classify/center_ico.png" width="43" height="43" class="fl u_img" /> 
	</if>
     <if condition="!empty($user_session) && !empty($user_session['nickname'])">
	 <span>{pigcms{$user_session['nickname']}</span>
	 </if>
   </div> 
   <div class="c_center"> 
    <ul> 
     <li class="border_m border_r"><a class="my_publish" href="{pigcms{:U('Classify/myfabu',array('uid'=>$uid))}">我的发布</a></li> 
     <li class="border_m"><a class="my_collect" href="{pigcms{:U('Classify/myCollect',array('uid'=>$uid))}">我的收藏</a></li> 
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