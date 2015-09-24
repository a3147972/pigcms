<!DOCTYPE html>
<html>
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title>{pigcms{$config.flseo_title}</title> 
  <meta name="Keywords" content="{pigcms{$config.flseo_keywords}" /> 
  <meta name="Description" content="{pigcms{$config.flseo_description}" /> 
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/release_classify_index.css" />
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/topbar.css" />
 </head> 
 <body class="newcrop"> 
  <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
  <!--<div id="1001" style="display:none"></div>
<div id="brand_top_banner" style="display:none"></div>--> 
  <div id="homeWrap" class="wrapper"> 
   <div id="header">
    <div id="headerinside" class="mainpage">
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
   </div> 
   <div class="hShadow"></div> 
   <div class="navcon" id="nav"> 
    <ul class="nav2"> 
     <li class="on"><a href="{pigcms{$siteUrl}/classify/">首页</a></li> 
	 <if condition="!empty($navClassify)">
	  <volist name="navClassify" id="nav">
       <li><a href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$nav['cid']}.html">{pigcms{$nav['cat_name']}</a></li>
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
  <div class="cb mainpage" id="all_listC"> 
   <div class="warp" id="Blocklist">
    <div class="c_b cbp2 cauto lh30" id="BlockLeft"> 
	<if condition="!empty($BlockLeft)">
	   <volist name="BlockLeft" id="blv">
     <h2 style="position:relative;"><a href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$blv['cid']}.html">{pigcms{$blv['cat_name']}</a></h2> 
     <div class="c_b_ews"> 
	  <volist name="blv['subdir2']" id="blvs2">
      <em><a href="{pigcms{$siteUrl}/classify/list-{pigcms{$blvs2['cid']}.html" <if condition="$blvs2['is_hot'] eq 1">class="red"</if>>{pigcms{$blvs2['cat_name']}</a></em>
	  	<if condition="!empty($blvs2['subdir3'])">
		  <if condition="!empty($blvs2['subdir3'][0])">
		  <a href="{pigcms{$siteUrl}/classify/list-{pigcms{$blvs2['cid']}-{pigcms{$blvs2['subdir3'][0]['cid']}.html" <php>if($blvs2['subdir3'][0]['is_hot'] == 1)echo 'class="red"'</php>>{pigcms{$blvs2['subdir3'][0]['cat_name']}</a>
		  </if>
		  <if condition="!empty($blvs2['subdir3'][1])">
		  <i>/</i>
		  <a href="{pigcms{$siteUrl}/classify/list-{pigcms{$blvs2['cid']}-{pigcms{$blvs2['subdir3'][1]['cid']}.html" <php>if($blvs2['subdir3'][1]['is_hot'] == 1)echo 'class="red"'</php>>{pigcms{$blvs2['subdir3'][1]['cat_name']}</a>
		  </if>
		  </if>
		  <br />
	  </volist>
     </div> 
     <div class="line"></div>
	 </volist>
	 </if>
    </div>
	
    <div class="c_b2 cauto" id="BlockCenter"> 
	 <if condition="!empty($BlockCenter)">
	 <volist name="BlockCenter" id="bcv">
     <div class="c_b c_b_ew2"> 
      <h2 style="position:relative;"><a href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$bcv['cid']}.html">{pigcms{$bcv['cat_name']}</a></h2> 
      <!--<div class="c_b_ew3 jf12">
	    
      </div> -->
      <!--<div id="zp_brand_wrap">
      </div>-->
	  <php>$mm=1;</php>
	  <volist name="bcv['subdir2']" id="bcvs2"> 
	   <php>$getarr=$bcvs2['subdir']==3 ? $bcvs2['fcid']."-".$bcvs2['cid'] : $bcvs2['cid'];</php>
      
	  <if condition="$mm % 4 eq 0">
      <a href="{pigcms{$siteUrl}/classify/list-{pigcms{$getarr}.html" <if condition="$bcvs2['is_hot'] eq 1">class="red"</if>>{pigcms{$bcvs2['cat_name']}</a>
      <br />
	  <else/>
		<em><a href="{pigcms{$siteUrl}/classify/list-{pigcms{$getarr}.html" <if condition="$bcvs2['is_hot'] eq 1">class="red"</if>>{pigcms{$bcvs2['cat_name']}</a></em>
	  </if>
	  <php>$mm++;</php>
	  </volist>


     </div> 
	 <div class="clear"></div> 
     <div class="line"></div> 
	</volist>
	</if>
     <!--<div class="c_b c_b_ew3"> 
      <div class="line"></div> 

    </div>--> 
   </div> 
   </div>

   <div id="cbright" class="cauto lh28"> 
	 <if condition="!empty($BlockRight)">
	 <volist name="BlockRight" id="brv">
    <div class="c_b c_b_ew3">
	<div class="h2con">
      <h2><a rel="nofollow" href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$brv['cid']}.html">{pigcms{$brv['cat_name']}</a></h2>
      </div>
	 <div class="clear"></div>
	 <volist name="brv['subdir2']" id="brvs2">
     <h3><a href="{pigcms{$siteUrl}/classify/list-{pigcms{$brvs2['cid']}.html" rel="nofollow" <if condition="$brvs2['is_hot'] eq 1">class="red"</if>>{pigcms{$brvs2['cat_name']}</a></h3> 
	  <if condition="!empty($brvs2['subdir3'])">
	  <php>$mmc=1;</php>
	  <volist name="brvs2['subdir3']" id="brvs3">
		  <if condition="$mmc % 4 eq 0">
		  <a href="{pigcms{$siteUrl}/classify/list-{pigcms{$brvs3['fcid']}-{pigcms{$brvs3['cid']}.html" <if condition="$brvs3['is_hot'] eq 1">class="red"</if>>{pigcms{$brvs3['cat_name']}</a>
		  <br />
		  <else/>
			<em><a href="{pigcms{$siteUrl}/classify/list-{pigcms{$brvs3['fcid']}-{pigcms{$brvs3['cid']}.html" <if condition="$brvs3['is_hot'] eq 1">class="red"</if>>{pigcms{$brvs3['cat_name']}</a></em>
		  </if>
	    <php>$mmc++;</php>
	 </volist>
	 </if>

	 </volist>
    </div> 
	</volist>
	</if>
   
   </div> 
  </div> 
  <div class="clear"></div>
  <include file="Classify:footer"/>
  <div class="clear"></div>
 </body>
<script  src="{pigcms{$static_path}classify/banner.js"></script> 
 <script type="text/javascript">
 var mainDivH=$('#all_listC').height();
 $('#all_listC .warp').height(mainDivH);
 $('#Blocklist').height(mainDivH);
 $('#BlockLeft').height(mainDivH);
 $('#BlockCenter').height(mainDivH);
 </script> 
</html>