<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="" xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <link href="{pigcms{$static_path}classify/release_classify_select01.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
   <style type="text/css">
   .current .ym-submnu{display:block;}
   .current  a.p_a_gljl{background:none;}
.ym-tab2 {
    line-height: 40px;
    text-indent: 10px;
    }
	.current li.post_ym_li{ height:auto; width:auto;}
	.current li.post_ym_li a{ *text-indent:0;}
	.current li.post_ym_li.w_65{width:60%}
	.current li.post_ym_li.w_35{width:40%}
	.post_ym_li dl{font-size:14px; color:#000; font-family:simsun;}
	.post_ym_li dl dt{ font-weight:bold; clear:both;}
	.post_ym_li dl dd{ height:30px; margin:0; padding:0;}
	.post_ym_li dl dd .w_50{ float:left; width:48%; overflow:hidden;}
</style>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/topbar.css" />
  <title>选择大分类</title> 
 </head> 
 <body> 
  <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
     <if condition="isset($config['classify_logo']) AND !empty($config['classify_logo'])">
	  <header id="postheader" style="height:60px;margin-bottom: 15px;" class="mainpage"> 
	 <span id="logo" style="top:0">
	 <a href="{pigcms{$siteUrl}/classify/" target="_blank"><img src="{pigcms{$config.classify_logo}" alt="分类信息" title="分类信息" width="185" height="58" /></a>
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
  <div class="flow_step_no1"> 
   <!-- s --> 
   <div class="flow_step"> 
    <ol class="cols3"> 
     <li class="step_1">
      <div>
       <i>1</i>
       <strong>选择大类</strong>
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
 
   <div class="content minheight" id="ymenu-side"> 
    <ul class="ym-mainmnu"> 
	<if condition="!empty($Zcategorys)">
	<volist name="Zcategorys" id="zvv">
     <li class="ym-tab"><a href="{pigcms{$siteUrl}/classify/Select2Sub-{pigcms{$zvv['cid']}.html">{pigcms{$zvv['cat_name']}</a> 
      <ul class="ym-submnu"> 
	   <if condition="!empty($zvv['subdir'])">
	     <volist name="zvv['subdir']" id="svv">
           <li><a href="{pigcms{$siteUrl}/classify/fabu-{pigcms{$svv['cid']}-{pigcms{$svv['fcid']}.html">{pigcms{$svv['cat_name']}</a></li>
	     </volist>
	   </if>
      </ul> </li> 
	  </volist>
    </if>

    </ul>
	
    <div class="c"></div> 
    <!--<div class="psearch"> 
     <div class="pshead">
      <em>搜索栏</em>
      <input value="二手手机" style="color:black" defaultvalue="请输入关键字查找您要发布的分类" class="pstxt" id="cateKey" type="text" />
      <input value="帮我推荐类别" class="psbtn" id="btn_cateSearch" type="button" />
     </div> 
     <div id="psbox" class="psbox" style=""> 
      <ul>
       <li>找到与“二手手机”相关的类别共 <b>2</b> 个，请选择适合的类目发布：</li>
       <li><a href="">aaa﹥<font style="color:red;">bbb</font></a></li>
       <li><a href="">cccc﹥dddd</a></li>
      </ul> 
     </div> 
     <div id="cateSearch_cannel" class="pscannel" style="display: block;">
      <em>取消</em>
     </div> 
    </div>--> 
   </div>
   <div class="hr_s"></div> 
  </div> 
  <include file="Classify:footer"/>
 </body>
 
<script type="text/javascript">
 /**
* 延迟显示插件lazyShow
*/
(function(a){a.fn.lazyShow=function(c){var b=a.extend({current:"hover",delay:10},c||{});a.each(this,function(){var f=null,e=null,d=false;a(this).bind("mouseover",function(){if(d){clearTimeout(e)}else{var g=a(this);f=setTimeout(function(){g.addClass(b.current);d=true},b.delay)}}).bind("mouseout",function(){if(d){var g=a(this);e=setTimeout(function(){g.removeClass(b.current);d=false},b.delay)}else{clearTimeout(f)}})})}})(jQuery);
	// 自动切换超链接
    $(document).ready(function() {
	$("#ymenu-side > .ym-mainmnu > .ym-tab").lazyShow({ current: "current",delay: 120});
    });
	</script>
</html>