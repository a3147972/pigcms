<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title><?php echo ($config["flseo_title"]); ?></title> 
  <meta name="Keywords" content="<?php echo ($config["flseo_keywords"]); ?>" /> 
  <meta name="Description" content="<?php echo ($config["flseo_description"]); ?>" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/release_classify_index.css" />
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/common.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/topbar.css" />
 </head> 
 <body class="newcrop"> 
  <div id="site-mast" class="site-mast"><div class="site-mast__user-nav-w">
	<div class="site-mast__user-nav cf">
		<ul class="basic-info">
			<li class="user-info cf">
				<?php if(empty($user_session)): ?><a rel="nofollow" class="user-info__login" href="<?php echo U('Index/Login/index');?>">登录</a>
					<a rel="nofollow" class="user-info__signup" href="<?php echo U('Index/Login/reg');?>">注册</a>
				<?php else: ?>
					<p class="user-info__name growth-info growth-info--nav">
						<span>
							<a rel="nofollow" href="<?php echo ($siteUrl); ?>/classify/userindex.html" class="username"><?php echo ($user_session["nickname"]); ?></a>
						</span>
						<a class="user-info__logout" href="<?php echo ($siteUrl); ?>/classify/userlogout.html">退出</a>
					</p><?php endif; ?>
            </li>
			<li id="dropdown_wx_toggle" class="mobile-info__item dropdown dropdown--open-app">
				<a class="dropdown__toggle" href="javascript:void(0);"><i class="icon-mobile F-glob F-glob-phone"></i>微信版<i class="tri tri--dropdown"></i></a>
				<div class="dropdown-menu dropdown-menu--app">
					<a class="app-block" href="/topic/weixin.html">
						<span class="app-block__title">访问微信版</span>
						<span class="app-block__content" style="background:url(<?php echo ($config["wechat_qrcode"]); ?>);background-size:100%;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo ($config["wechat_qrcode"]); ?>',sizingMethod='scale');"></span>
					</a>
				</div>
			</li>
		</ul>
		<ul class="site-mast__user-w">
			<li class="user-orders">
                <a href="<?php echo ($siteUrl); ?>/classify/selectsub.html" rel="nofollow">免费发布信息</a>
            </li>
			<li class="dropdown dropdown--account">
				<a id="J-my-account-toggle" rel="nofollow" class="dropdown__toggle" href="<?php echo ($siteUrl); ?>/classify/mycenter.html">
					<span>个人中心</span>
				</a>
			</li>

			<li id="J-site-merchant" class="dropdown dropdown--merchant">
				<a class="dropdown__toggle dropdown__toggle--merchant" href="/">
					<span>网站首页</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
 $('#dropdown_wx_toggle').hover(function(e){
    $(this).addClass('dropdown--open');
 },function(e){
    $(this).removeClass('dropdown--open');
 });
</script></div> 
  <!--<div id="1001" style="display:none"></div>
<div id="brand_top_banner" style="display:none"></div>--> 
  <div id="homeWrap" class="wrapper"> 
   <div id="header">
    <div id="headerinside" class="mainpage">
	 <?php if(isset($config['classify_logo']) AND !empty($config['classify_logo'])): ?><span id="logo" style="top:10px">
	 <a href="<?php echo ($siteUrl); ?>/classify/" target="_blank"><img src="<?php echo ($config["classify_logo"]); ?>" alt="分类信息" title="分类信息" width="185" height="58" /></a>
	 </span>
	 <?php else: ?>
	 <span id="logo">
	 <a href="/" target="_blank"><img src="<?php echo ($config["site_logo"]); ?>" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="<?php echo ($siteUrl); ?>/classify/" class="classify">分类信息</a>
	 </span><?php endif; ?>
     <form action="<?php echo ($siteUrl); ?>/classify/searchlist.html" method="get" name="mysearch"> 
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
     <a href="<?php echo ($siteUrl); ?>/classify/selectsub.html" id="fabu" rel="nofollow"><i></i>免费发布信息</a>
     <!--<a href="<?php echo U('Classify/myCenter');?>" id="delinfo" rel="nofollow" class="search-no">个人中心</a>---> 
    </div> 
   </div> 
   <div class="hShadow"></div> 
   <div class="navcon" id="nav"> 
    <ul class="nav2"> 
     <li class="on"><a href="<?php echo ($siteUrl); ?>/classify/">首页</a></li> 
	 <?php if(!empty($navClassify)): if(is_array($navClassify)): $i = 0; $__LIST__ = $navClassify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($nav['cid']); ?>.html"><?php echo ($nav['cat_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </ul> 
    <div id="1003" class="ad_nav"></div> 
   </div> 
  </div> 

  <?php if(!empty($classify_index_ad)): ?><div class="pc_banner mainpage"> 
    <ul>
	 <?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><li> <a href="<?php echo ($adimg['url']); ?>" target="_blank">  <img src="<?php echo ($adimg['pic']); ?>" alt="<?php echo ($adimg['name']); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul> 
	
    <div class="banner_icon">
	 <?php if(is_array($classify_index_ad)): $i = 0; $__LIST__ = $classify_index_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adimg): $mod = ($i % 2 );++$i;?><i alt="<?php echo ($i); ?>" <?php if($i == 1): ?>class="active"<?php endif; ?>></i><?php endforeach; endif; else: echo "" ;endif; ?>
    </div> 
	<span class="banner-close" onclick="bannerClose();">&nbsp;</span>
   </div><?php endif; ?>
  <div class="cb mainpage" id="all_listC"> 
   <div class="warp" id="Blocklist">
    <div class="c_b cbp2 cauto lh30" id="BlockLeft"> 
	<?php if(!empty($BlockLeft)): if(is_array($BlockLeft)): $i = 0; $__LIST__ = $BlockLeft;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blv): $mod = ($i % 2 );++$i;?><h2 style="position:relative;"><a href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($blv['cid']); ?>.html"><?php echo ($blv['cat_name']); ?></a></h2> 
     <div class="c_b_ews"> 
	  <?php if(is_array($blv['subdir2'])): $i = 0; $__LIST__ = $blv['subdir2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$blvs2): $mod = ($i % 2 );++$i;?><em><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($blvs2['cid']); ?>.html" <?php if($blvs2['is_hot'] == 1): ?>class="red"<?php endif; ?>><?php echo ($blvs2['cat_name']); ?></a></em>
	  	<?php if(!empty($blvs2['subdir3'])): if(!empty($blvs2['subdir3'][0])): ?><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($blvs2['cid']); ?>-<?php echo ($blvs2['subdir3'][0]['cid']); ?>.html" <?php if($blvs2['subdir3'][0]['is_hot'] == 1)echo 'class="red"' ?>><?php echo ($blvs2['subdir3'][0]['cat_name']); ?></a><?php endif; ?>
		  <?php if(!empty($blvs2['subdir3'][1])): ?><i>/</i>
		  <a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($blvs2['cid']); ?>-<?php echo ($blvs2['subdir3'][1]['cid']); ?>.html" <?php if($blvs2['subdir3'][1]['is_hot'] == 1)echo 'class="red"' ?>><?php echo ($blvs2['subdir3'][1]['cat_name']); ?></a><?php endif; endif; ?>
		  <br /><?php endforeach; endif; else: echo "" ;endif; ?>
     </div> 
     <div class="line"></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
	
    <div class="c_b2 cauto" id="BlockCenter"> 
	 <?php if(!empty($BlockCenter)): if(is_array($BlockCenter)): $i = 0; $__LIST__ = $BlockCenter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bcv): $mod = ($i % 2 );++$i;?><div class="c_b c_b_ew2"> 
      <h2 style="position:relative;"><a href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($bcv['cid']); ?>.html"><?php echo ($bcv['cat_name']); ?></a></h2> 
      <!--<div class="c_b_ew3 jf12">
	    
      </div> -->
      <!--<div id="zp_brand_wrap">
      </div>-->
	  <?php $mm=1; ?>
	  <?php if(is_array($bcv['subdir2'])): $i = 0; $__LIST__ = $bcv['subdir2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bcvs2): $mod = ($i % 2 );++$i; $getarr=$bcvs2['subdir']==3 ? $bcvs2['fcid']."-".$bcvs2['cid'] : $bcvs2['cid']; ?>
      
	  <?php if($mm % 4 == 0): ?><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($getarr); ?>.html" <?php if($bcvs2['is_hot'] == 1): ?>class="red"<?php endif; ?>><?php echo ($bcvs2['cat_name']); ?></a>
      <br />
	  <?php else: ?>
		<em><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($getarr); ?>.html" <?php if($bcvs2['is_hot'] == 1): ?>class="red"<?php endif; ?>><?php echo ($bcvs2['cat_name']); ?></a></em><?php endif; ?>
	  <?php $mm++; endforeach; endif; else: echo "" ;endif; ?>


     </div> 
	 <div class="clear"></div> 
     <div class="line"></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
     <!--<div class="c_b c_b_ew3"> 
      <div class="line"></div> 

    </div>--> 
   </div> 
   </div>

   <div id="cbright" class="cauto lh28"> 
	 <?php if(!empty($BlockRight)): if(is_array($BlockRight)): $i = 0; $__LIST__ = $BlockRight;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brv): $mod = ($i % 2 );++$i;?><div class="c_b c_b_ew3">
	<div class="h2con">
      <h2><a rel="nofollow" href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($brv['cid']); ?>.html"><?php echo ($brv['cat_name']); ?></a></h2>
      </div>
	 <div class="clear"></div>
	 <?php if(is_array($brv['subdir2'])): $i = 0; $__LIST__ = $brv['subdir2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brvs2): $mod = ($i % 2 );++$i;?><h3><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($brvs2['cid']); ?>.html" rel="nofollow" <?php if($brvs2['is_hot'] == 1): ?>class="red"<?php endif; ?>><?php echo ($brvs2['cat_name']); ?></a></h3> 
	  <?php if(!empty($brvs2['subdir3'])): $mmc=1; ?>
	  <?php if(is_array($brvs2['subdir3'])): $i = 0; $__LIST__ = $brvs2['subdir3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brvs3): $mod = ($i % 2 );++$i; if($mmc % 4 == 0): ?><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($brvs3['fcid']); ?>-<?php echo ($brvs3['cid']); ?>.html" <?php if($brvs3['is_hot'] == 1): ?>class="red"<?php endif; ?>><?php echo ($brvs3['cat_name']); ?></a>
		  <br />
		  <?php else: ?>
			<em><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($brvs3['fcid']); ?>-<?php echo ($brvs3['cid']); ?>.html" <?php if($brvs3['is_hot'] == 1): ?>class="red"<?php endif; ?>><?php echo ($brvs3['cat_name']); ?></a></em><?php endif; ?>
	    <?php $mmc++; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
    </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
   
   </div> 
  </div> 
  <div class="clear"></div>
  
  <div class="clear"></div>
 </body>
<script  src="<?php echo ($static_path); ?>classify/banner.js"></script> 
 <script type="text/javascript">
 var mainDivH=$('#all_listC').height();
 $('#all_listC .warp').height(mainDivH);
 $('#Blocklist').height(mainDivH);
 $('#BlockLeft').height(mainDivH);
 $('#BlockCenter').height(mainDivH);
 </script> 
</html>