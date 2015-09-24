<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>{pigcms{$ctname}</title> 
  <meta name="keywords" content="{pigcms{$fcategory['seo_keywords']}" /> 
  <meta name="description" content="{pigcms{$fcategory['seo_description']}" /> 
  <meta name="location" content="" /> 
   <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/subdirectory.css" /> 
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
 </head> 
 <body> 
  <!-- topbar --> 
  <div id="site-mast" class="site-mast"><include file="topbar"/></div> 

  <div id="homeWrap" class="wrapper"> 
   <div id="header" class="mainpage"> 
	<if condition="isset($config['classify_logo']) AND !empty($config['classify_logo'])">
	 <span id="logo" style="top:10px">
	 <a href="{pigcms{$siteUrl}/classify/" target="_blank"><img src="{pigcms{$config.classify_logo}" alt="分类信息" title="分类信息" width="185" height="58" /></a>
	 </span>
	 <else/>
	 <span id="logo">
	 <a href="/" target="_blank"><img src="{pigcms{$config.site_logo}" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="{pigcms{$siteUrl}/classify/" class="classify">分类信息</a>
	 </span>
	 </if>
     <form action="{pigcms{$siteUrl}/classify/searchlist.html" method="get" name="mysearch"> 
      <div id="searchbar"> 
       <div id="saerkey"> 
        <span><input type="text" id="keyword" name="keystr" class="keyword" value="找你所找，寻你所寻" onblur="if(this.value=='')this.value='找你所找，寻你所寻',this.className='keyword'" onfocus="if(this.value=='找你所找，寻你所寻')this.value='',this.className='keyword2'" /></span> 
       </div> 
       <div class="inputcon">
        <input type="submit" class="btnall" value="搜一搜" onmousemove="this.className='btnal2'" onmouseout="this.className='btnall'" />
       </div> 
       <div class="clear"></div> 
       <div class="search-no"> 
        <span id="hot"></span>
        <span class="hot2"></span> 
       </div> 
      </div> 
     </form> 
     <a href="{pigcms{$siteUrl}/classify/selectsub.html" id="fabu" rel="nofollow"><i></i>免费发布信息</a>
     <!--<a href="{pigcms{:U('Classify/myCenter')}" id="delinfo" rel="nofollow" class="search-no">个人中心</a>---> 
    </div> 
   
   <div class="hShadow"></div> 
   <div class="navcon" id="nav"> 
    <ul class="nav2"> 
     <li><a href="{pigcms{$siteUrl}/classify/">首页</a></li> 
	 <if condition="!empty($navClassify)">
	  <volist name="navClassify" id="nav">
       <li <if condition="$nav['cid'] eq $cid">class="on"</if>><a href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$nav['cid']}.html">{pigcms{$nav['cat_name']}</a></li>
	  </volist>
	 </if>
    </ul> 
    <div id="1003" class="ad_nav"></div> 
   </div> 
  </div> 
  
    <if condition="!empty($classify_index_ad)">
    <div class="pc_banner mainpage"> 
    <ul>
	 <volist name="classify_index_ad" id="adimg">
     <li> <a href="{pigcms{$adimg['url']}" target="_blank">  <img src="{pigcms{$adimg['pic']}" alt="{pigcms{$adimg['name']}" /></a></li>
	 </volist>
    </ul> 
	
    <div class="banner_icon">
	 <volist name="classify_index_ad" id="adimg">
     <i alt="{pigcms{$i}" <if condition="$i eq 1">class="active"</if>></i>
	 </volist>
    </div> 
	<span class="banner-close" onclick="bannerClose();">&nbsp;</span>
   </div>
   </if>

  <!-- head end --> 
  <!-- main start --> 
  <div class="wb-main"> 
   <div class="wb-content mainpage"> 
    <!-- fliter start --> 
    <!-- filter end --> 
    <!-- 广告位预留 --> 
    <!--<div class="mqad clearfix">
		
		</div>--> 
   

    <!-- 职位列举 start --> 
    <div class="posExp bor clearfix" id="posExp"> 
	 <div class="title"> 
      <h2>{pigcms{$ctname}</h2> 
     </div>
	<if condition="!empty($Subdirectory2)">
	 <volist name="Subdirectory2" id="sv">
     <dl> 
      <dt> 
       <a href="{pigcms{$siteUrl}/classify/list-{pigcms{$sv['cid']}.html">{pigcms{$sv['cat_name']}</a> 
      </dt> 
      <dd> 
	  	 <if condition="!empty($sv['subdir'])">
	      <volist name="sv['subdir']" id="subv">
            <a href="{pigcms{$siteUrl}/classify/list-{pigcms{$subv['fcid']}-{pigcms{$subv['cid']}.html">{pigcms{$subv['cat_name']}</a>
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
    <!--职位列举 end --> 

   </div> 
  </div> 
  <!-- main end --> 

 	<if condition="!empty($Subdirectory2)">
	<volist name="Subdirectory2" id="ssv">
	 
	 <if condition="!empty($ssv['userinput'])">
		<div class="pet-box floor mainpage">
		<h3 class="title"><span class="title-link">
		  <php> if(!empty($ssv['subdir'])){ $mm=0;
		    foreach($ssv['subdir'] as $subv){
			   if($mm>=7) break;
			   echo  '<a target="_blank" href="$siteUrl/classify/list-'.$subv['fcid'].'-'.$subv['cid'].'.html">'.$subv['cat_name'].'</a>';
			   $mm++;
			}
		  }</php>
		 <a target="_blank" href="{pigcms{$siteUrl}/classify/list-{pigcms{$ssv['cid']}.html">更多» </a>
		</span>
		<a target="_blank" href="{pigcms{$siteUrl}/classify/list-{pigcms{$ssv['cid']}.html" class="ac-green">{pigcms{$ssv['cat_name']}</a>
		</h3>
		<ul class="pet-list clearfix">
		<volist name="ssv['userinput']" id="usv">
		<php>$imgs=unserialize($usv['imgs']);$oneImg=!empty($imgs) ? $imgs['0'] : false;</php>

		<li class="pet-list-pic">
		<a href="{pigcms{$siteUrl}/classify/{pigcms{$usv['id']}.html" target="_blank" title="{pigcms{$usv['title']}">
		<img width="140" height="106" <if condition="$oneImg"> src="{pigcms{$oneImg}" <else/> src="{pigcms{$static_path}classify/img/noimg.jpg" </if>></a>
		<div class="pet-list-name2">
		<a href="{pigcms{$siteUrl}/classify/{pigcms{$usv['id']}.html" target="_blank" title="{pigcms{$usv['title']}">{pigcms{$usv['title']}<i class="fc-orange"></i></a>
		</div>
		</li>
		</volist>
		</ul>
		</div>
		</if>
		</volist>
      </if>
	   <include file="Classify:footer"/>
 </body>
 <script  src="{pigcms{$static_path}classify/banner.js"></script> 
 <script type="text/javascript">
   $('#posExp dl').hover(function(e){
	 $(this).addClass('bgColor');
  },function(e){
	 $(this).removeClass('bgColor');
  });
  </script>
</html>