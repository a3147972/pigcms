<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="" xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <link href="{pigcms{$static_path}classify/release_classify_select01.css" type="text/css" rel="stylesheet" />
 <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
 <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/topbar.css" />
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <title>{pigcms{$fcidinfo['cat_name']}--选择小分类</title> 
 </head> 
 <body> 
 <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
   <if condition="isset($config['classify_logo']) AND !empty($config['classify_logo'])">
   <header id="postheader" style="height:60px;margin-bottom: 15px;" class="mainpage"> 
	 <span id="logo" style="top:0">
	 <a href="{pigcms{$siteUrl}/classify/" target="_blank"><img src="{pigcms{$config.classify_logo}" alt="分类信息" title="分类信息" width="180" height="58" /></a>
	 </span>
	 </header> 
	 <else/>
	<header id="postheader" style="height:58px" class="mainpage"> 
   <span id="logo" style="top:0">
	 <a href="/" target="_blank"><img src="{pigcms{$config.site_logo}" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="{pigcms{$siteUrl}/classify/" class="classify">分类信息</a>
	 </span>
	 </header> 
	 </if>
   <!--<h2 class="sub_title"><b>合肥</b> </h2>--> 

  
  <div class="flow_step_no2"> 
   <!-- s --> 
   <div class="flow_step"> 
    <ol class="cols3"> 
     <li class="step_1">
      <div>
       <i>1</i>
       <strong>{pigcms{$fcidinfo['cat_name']}</strong>
       <strong class="f12">(<a href="{pigcms{$siteUrl}/classify/selectsub.html">重选大类</a>)</strong>
       <span></span>
      </div><em class="f1"></em></li>
     <li class="step_2">
      <div>
       <i>2</i>
       <strong>选择小类</strong>
       <span></span>
      </div></li>
     <li class="step_3">
      <div>
       <i>3</i>填写信息
       <span></span>
      </div><em class="f2"></em></li>
    </ol> 
   </div> 
   <!-- e --> 
  </div> 
  <div class="minheightout w"> 
   <div class="c"></div> 
   <div class="content minheight"> 
    <ul class="post2"> 
	  <if condition="!empty($Zcategorys)">
       <volist name="Zcategorys" id="zv">
     <li><a href="{pigcms{$siteUrl}/classify/fabu-{pigcms{$zv['cid']}-{pigcms{$cid}.html">{pigcms{$zv['cat_name']}</a></li> 
	   </volist>
	 </if>
    </ul>
    <div class="c"></div> 
   </div>
   <div class="hr_s"></div> 
   <div id="pre-next">
    <a href="{pigcms{$siteUrl}/classify/selectsub.html">&laquo;重新选择大类</a>
   </div> 
  </div>
 </body>
</html>