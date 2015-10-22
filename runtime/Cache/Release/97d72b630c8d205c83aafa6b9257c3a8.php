<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title><?php echo ($cat_name); ?></title> 
  <meta name="keywords" content="<?php echo ($classify['seo_keywords']); ?>" /> 
  <meta name="description" content="<?php echo ($classify['seo_description']); ?>" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/base.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/listui.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/common.css" />
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <style type="text/css">
   #pageHtml{font-size: 20px;}
   #pageHtml .current{border: 1px solid #e1e1e1;display:inline-block; height:30px;line-height:30px;width:35px;background-color:#e71;color:#fff;margin: 0 1px;padding: 0 0 0 1px;}
   #pageHtml a{height: 30px;line-height: 30px;}
   #pageHtml .pga{ border: 1px solid #e1e1e1;width: 35px;}
  </style>
 </head> 
 <body> 
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
  <!--<div id="header"> 
   <span id="logo">
	 <a href="/" target="_blank"><img src="<?php echo ($config["site_logo"]); ?>" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="<?php echo ($siteUrl); ?>/classify/" class="classify">分类信息</a>
	 </span>
   <span class="fl"><a href="<?php echo U('Classify/SelectSub',array('cid'=>0));?>" target="_blank" class="postBtn" rel="nofollow"></a></span> 
   <div class="nav">
    <a href="<?php echo ($siteUrl); ?>/classify/">首页</a> 
	<?php if(!empty($fcidinfo)): ?><cite></cite>&nbsp; 
    <a href="<?php echo U('Classify/Subdirectory',array('cid'=>$fcidinfo['cid']));?>"><?php echo ($fcidinfo['cat_name']); ?></a><?php endif; ?>
    <cite></cite>&nbsp; 
    <a href="<?php echo U('Classify/Lists',array('cid'=>$cid,'subdir'=>$sub3dir));?>"><?php echo ($cat_name); ?></a> 
   </div> 
  </div> -->
  <div id="homeWrap" class="wrapper"> 
   <div id="header"  class="mainpage"> 
    <div id="headerinside">
     <?php if(isset($config['classify_logo']) AND !empty($config['classify_logo'])): ?><span id="logo" style="top:10px">
	 <a href="<?php echo ($siteUrl); ?>/classify/" target="_blank"><img src="<?php echo ($config["classify_logo"]); ?>" alt="分类信息" title="分类信息" width="180" height="58" /></a>
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
     <li><a href="<?php echo ($siteUrl); ?>/classify/">首页</a></li> 
	 <?php if(!empty($navClassify)): if(is_array($navClassify)): $i = 0; $__LIST__ = $navClassify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php if($nav['cid'] == $fcid): ?>class="on"<?php endif; ?>><a href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($nav['cid']); ?>.html"><?php echo ($nav['cat_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
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

  <div id="brand_list_top_banner"></div> 
  <div id="selection" class="mainpage" style="padding-top:15px;margin-top:10px">
       <?php if(!empty($otherList)): ?><div id="searchtree">
		<i class="line"></i>
		<dl class="selectbar2 clearfix">
		<dd class="clearfix">
		<ul class="s_ul">
		<?php if(is_array($otherList)): $i = 0; $__LIST__ = $otherList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$olv): $mod = ($i % 2 );++$i; if(!($olv['tt'] > 0)) continue; ?>
		 <?php if($olv['cid'] == $cid AND $olv['sub3dir'] == $sub3dir): ?><li class="selected_wrap"><strong><?php echo ($olv['cat_name']); ?><i>（<?php echo ($olv['tt']); ?>）</i></strong></li>
			<?php else: ?>
			<li><a href="<?php echo ($olv['url']); ?>"><?php echo ($olv['cat_name']); ?></a><i>（<?php echo ($olv['tt']); ?>）</i></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		
		</ul>
		<!--<span class="morebtn b1" name="cateswitch"><a href="javascript:void(0);"></a></span>-->
		</dd>
		</dl>
		<i class="line"></i>
		</div><?php endif; ?>

    <?php if(!empty($subdir3all)): ?><dl class="secitem"> 
    <dt>
	类别： 
    </dt> 
    <dd>
	 <a <?php if($sub3dir == 0): ?>class="select"<?php endif; ?> href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($cid); ?>.html">不限</a> 
	 <?php if(is_array($subdir3all)): $i = 0; $__LIST__ = $subdir3all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s3c): $mod = ($i % 2 );++$i;?><a <?php if($sub3dir == $s3c['cid']): ?>class="select"<?php endif; ?> href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($cid); ?>-<?php echo ($s3c['cid']); ?>.html"><?php echo ($s3c['cat_name']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	</dd>
	</dl><?php endif; ?>

 	<?php if(!empty($conarr)): $jsonarr=array(); ?>
	 <?php if(is_array($conarr)): $i = 0; $__LIST__ = $conarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i; $jsonarr[$value['input']]=array(); ?>
   <dl class="secitem"> 
    <dt>
	<?php echo ($value['name']); ?>： 
    </dt> 
    <dd>
	<a <?php if(!isset($mywhere[$value['input']])): ?>class="select"<?php endif; ?> href="javascript:;" onclick="ProcessInquiryStr('<?php echo ($value['input']); ?>','');">不限</a> 
	<?php if(is_array($value['data'])): $kk = 0; $__LIST__ = $value['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dv): $mod = ($kk % 2 );++$kk; $dv=trim($dv);if(($value['opt']==1) && ($kk==1) && (strpos($dv, '-') === false)){ $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=0-".$dv; }elseif(($value['opt']==1) && ($kk>1) && (strpos($dv, '-') === false)){ $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv."-0"; }else{ $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv; } $opt=base64_encode($opt); $jsonarr[$value['input']][]=$opt; ?>
     
      <a  <?php if(isset($mywhere[$value['input']]) AND ($mywhere[$value['input']] == $dv || str_replace(array('0-','-0'),'',$mywhere[$value['input']]) == $dv)): ?>class="select"<?php endif; ?> href="javascript:;" onclick="ProcessInquiryStr('<?php echo ($value['input']); ?>','<?php echo ($opt); ?>');"><?php echo ($dv); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
    </dd> 
   </dl><?php endforeach; endif; else: echo "" ;endif; endif; ?>
   <br /> 
   <!-- =S header-search --> 
   <div id="SearchForm" class="header-search"> 
   
     <span class="search-input fl"><input class="but-wd c_000" id="keyword1" autocomplete="off" maxlength="100" type="text" <?php if(isset($qstr) AND !empty($qstr)): ?>value="<?php echo ($qstr); ?>"<?php endif; ?>/></span> 
     <span class="fl"><input type="button" id="searchbtn1" class="but-bl" value="搜本类" onclick="ToSearchWord(1);" /></span> 
	 <span class="selfcata"><input type="button" id="searchbtn2" class="but-bl" onclick="ToSearchWord(2);" value="搜全站"></span>
   </div> 

   <!-- =E header-search --> 
   <i class="shadow"></i> 
   <input style="display: none;" id="selected" type="hidden" /> 
  <div class="barct"> </div>
  </div> 
  <div class="tabsbar mainpage"> 
   <div class="list-tabs"> 
    <a title="<?php echo ($cat_name); ?>" class="sel" href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($cid); ?>-<?php echo ($sub3dir); ?>.html"><span><h1><?php echo ($cat_name); ?></h1></span></a> 
   </div> 
  </div> 
  <!-- =S mainlist --> 
  <div id="mainlist" class="clearfix pr mainpage"> 
   <!-- =S infolist 左侧列表主体 --> 
   <div id="infolist"> 
    <div class="filterbar"> </div> 
    <table class="tbimg" cellpadding="0" cellspacing="0"> 
     <tbody> 
	   <?php if(!empty($listsdatas)): if(is_array($listsdatas)): $i = 0; $__LIST__ = $listsdatas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><tr> 
       <td class="img"> 
	    <a <?php if(empty($vl['jumpUrl'])): ?>href="<?php echo ($siteUrl); ?>/classify/<?php echo ($vl['id']); ?>.html" <?php else: ?> href="<?php echo ($vl['jumpUrl']); ?>"<?php endif; ?> target="_blank"> <?php if(isset($vl['imgthumbnail'])): ?><img src="<?php echo ($vl['imgthumbnail']); ?>" alt="" /><?php else: ?><img src="<?php echo ($static_path); ?>classify/img/noimg.jpg" alt="" /><?php endif; ?> </a>
	   </td> 
       <td class="t"> 
	   <a <?php if(empty($vl['jumpUrl'])): ?>href="<?php echo ($siteUrl); ?>/classify/<?php echo ($vl['id']); ?>.html" <?php else: ?> href="<?php echo ($vl['jumpUrl']); ?>"<?php endif; ?> target="_blank" class="t"><span class="bt" <?php if(!empty($vl['btcolor'])): ?>style="color:<?php echo ($vl['btcolor']); ?>"<?php endif; ?>> <?php if(isset($qstr) AND !empty($qstr)): echo (str_replace($qstr,'<b>'.$qstr.'</b>',$vl['title'])); else: echo ($vl['title']); endif; ?></span>
	   <?php if($vl['toptime'] > 0): ?>&nbsp;<span class="ico ding"></span><?php endif; ?>
	   </a>
	   <i class="clear"></i> 
	   <p><?php if(isset($qstr) AND !empty($qstr)): echo (str_replace($qstr,'<b class="showsearch">'.$qstr.'</b>',$vl['input1'])); else: echo ($vl['input1']); endif; ?></p> <p><?php if(isset($qstr) AND !empty($qstr)): echo (str_replace($qstr,'<b class="showsearch">'.$qstr.'</b>',$vl['input2'])); else: echo ($vl['input2']); endif; ?></p><i class="clear"></i> </td> 

       <td class="tc"><?php if(isset($qstr) AND !empty($qstr)): echo (str_replace($qstr,'<b class="showsearch">'.$qstr.'</b>',$vl['input3'])); else: echo ($vl['input3']); endif; ?></td>
	   
       <td>
			<p style="float:right;color:#ff7201;"><?php echo ($vl['timestr']); ?></p>
			<?php if(isset($qstr) AND !empty($qstr)): echo (str_replace($qstr,'<b class="showsearch">'.$qstr.'</b>',$vl['input4'])); else: echo ($vl['input4']); endif; ?>
		</td> 
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	  <?php else: ?>
      <tr> 
	  <td colspan=3 style="text-align:center;font-size: 25px;font-weight: bold;text-align: center; height: 100px;line-height: 100px;">没有数据！</td>
      </tr><?php endif; ?>
      
     </tbody> 
    </table> 

    <div class="pager mb10" id="pageHtml"> 
		<?php echo ($pagebar); ?>
    </div> 
   </div> 
  
  </div> 
  
  <div class="clear"></div>
 </body>
 <script  src="<?php echo ($static_path); ?>classify/banner.js"></script> 
  <script type="text/javascript">
  var optJsonData={};
  var RequestUrl='<?php echo ($thisurl); ?>';
  var optStr=window.location.search;
  <?php if(isset($jsonarr) && !empty($jsonarr)) echo 'optJsonData='.json_encode($jsonarr).';'; ?>

   function ProcessInquiryStr(typ,optv){
	  var pi_Str='';
	  if(optStr.indexOf('opt=')>-1){
        var tmp =optStr.split('opt=');
	    var opt_str=$.trim(tmp[1]);
		opt_str=opt_str.replace(/&page=\d+/,'');
		var optArr=opt_str ? opt_str.split('-') : new Array();
		var tmpstr='';
		var flage=false;
		for(i=0;i<optArr.length;i++){
		   $.each(optJsonData,function(kk,vv){
		       tmpstr='ff|'+vv.join('|')+'|ff';
			   if(tmpstr.indexOf(optArr[i])>0){
			       if(kk==typ){
					  if(optv){
				        optArr[i]=optv;
					  }else{
					    optArr.splice(i,1);
					  }
					  flage=true;
				   }
			   }
		   
		   });
		}
		if(!flage && optv){
		   optArr.push(optv);
		}
		if(optArr.length>1){
		  pi_Str=optArr.join('-');
		}else if(optArr.length==1){
		   pi_Str=optArr[0];
		}else{
		   pi_Str='';
		}
	  }else{
	    pi_Str=optv;
	  }
	  if(pi_Str){
		  window.location.href=RequestUrl+'?opt='+pi_Str;
		}else{
		  window.location.href=RequestUrl;
		}
	  
    }
  </script>
     <script type="text/javascript">
		$(document).ready(function () {
		    $("#keyword1").keydown(function () {
		        $("#keyword1").attr("style","color: rgb(0, 0, 0);"); //黑色
		    });
			$("#keyword1").click(function() { 
    			if($.trim($(this).val()) == "输入类别或关键字") { 
    				$(this).val("");
    				$(this).attr("style", "color:rgb(153, 153, 153);"); //灰色
    			}
    		});
    		$("#keyword1").blur(function() { 
    			if($.trim($(this).val()) == "") { 
    				$(this).val("输入类别或关键字");
    				$(this).attr("style", "color:rgb(153, 153, 153);"); //灰色
    			}
    		});
		});

		function ToSearchWord(ty) {
    		var keyword = $.trim($("#keyword1").val());
    		if(keyword == "" || keyword == "输入类别或关键字") {
    			$("#keyword1").val("输入类别或关键字");
    			$("#keyword1").attr("style","color: rgb(153, 153, 153);"); //灰色
    			return false;
    		}else{
				 if(ty==1){
				    window.location.href="<?php echo ($siteUrl); ?>/classify/searchlist-<?php echo ($cid); ?>-<?php echo ($sub3dir); ?>.html?keystr="+keyword;
				 }else if(ty==2){
				    window.location.href="<?php echo ($siteUrl); ?>/classify/searchlist.html?keystr="+keyword;
				 }
			}
    		return true;
    	}
	  </script> 
</html>