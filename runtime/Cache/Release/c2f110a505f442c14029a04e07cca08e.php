<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="keywords" content="<?php echo ($config["site_name"]); ?> 分类信息 <?php echo ($detail['title']); ?>" /> 
  <meta name="description" content="您的信息发布平台<?php echo ($config["site_name"]); ?> 分类信息 <?php echo ($detail['title']); ?>" /> 
  <meta name="location" content="" /> 
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/base.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/detailfang.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>classify/common.css" />
 
<style type="text/css">
	.descriptionImg img{
	max-width:640px;
	_width:640px; 
	overflow: visible
}
#img_smalls li{cursor:pointer;}
.description_con{line-height: 20px;}
</style> 
  <title><?php echo ($detail['title']); ?></title> 
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

  <div id="header"> 
	<?php if(isset($config['classify_logo']) AND !empty($config['classify_logo'])): ?><span id="logo" style="top:10px">
	 <a href="<?php echo ($siteUrl); ?>/classify/" target="_blank"><img src="<?php echo ($config["classify_logo"]); ?>" alt="分类信息" title="分类信息" width="185" height="58" /></a>
	 </span>
	 <?php else: ?>
    <span id="logo">
	 <a href="/" target="_blank"><img src="<?php echo ($config["site_logo"]); ?>" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="<?php echo ($siteUrl); ?>/classify/" class="classify">分类信息</a>
	 </span><?php endif; ?>
   <div class="breadCrumb f12">
	<span><a href="<?php echo ($siteUrl); ?>/classify/subdirectory-<?php echo ($fcidinfo['cid']); ?>.html"><?php echo ($fcidinfo['cat_name']); ?></a></span>
    <span class="crb_i"><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($detail['cid']); ?>.html"> <?php echo ($detail['cat_name']); ?></a> </span> 
	
	<?php if(!empty($detail['s_c'])): ?><span class="crb_i"><a href="<?php echo ($siteUrl); ?>/classify/list-<?php echo ($detail['cid']); ?>-<?php echo ($detail['s_c']['cid']); ?>.html"><?php echo ($detail['s_c']['cat_name']); ?></a> </span><?php endif; ?>
   </div> 
   <a href="<?php echo ($siteUrl); ?>/classify/selectsub.html" rel="nofollow" class="postBtn fr"></a> 
  </div> 

  <div id="content" class="clearfix"> 
   <div id="main"> 
    <div class="col detailPrimary mb15"> 

     <div class="col_sub mainTitle"> 
      <div class="bigtitle"> 
       <h1> <?php echo ($detail['title']); ?> </h1>&nbsp;
      </div> 
      <div class="mtit_con c_999 f12 clearfix" id="mtit_con_clearfix"> 
       <ul class="mtit_con_left fl"> 
        <li class="time"> <?php echo ($detail['updatetime']); ?> </li> 
        <li class="count"><em id="totalcount"><?php echo ($detail['views']); ?></em></li> 
       </ul>  
	    <ul class="mtit_con_right fr" style="margin-right:50px;"> 
        <!-- hover 为鼠标划入是的状态，该状态需要脚本做处理 --> 
       
        <li class="su_kfd su_hover" id="su_kfdnew"><a class="ml_2"><i class="mtit2"></i>收藏</a></li> 

       </ul> 
	<!--=S 收藏 -->
	<div style="left: 911px; display: none; top: 20px;" id="collectBar" class="collectBox">
		<ul class="mtit_con_ul">
			<li><a title="收藏信息" href="javascript:;" onclick="FavoriteThis()">收藏到个人中心</a></li>
			<li><a href="/index.php?g=Release&c=Classify&a=savetoDesk&vid=<?php echo ($detail['id']); ?>">保存到桌面</a></li>
			<li><a href="javascript:;" id="addFavBtn">添加到浏览器收藏夹</a></li>
		</ul>
		<i class="shadow_"></i>
	</div>
	<!--=E 收藏 -->
      </div> 
     </div> 
   
     <div class="col_sub maintop mb30 clearfix"> 
    
	<?php if(!empty($imglist)): ?><div class="col_sub gallery" id="leftdiv"> 
       <div class="g_img">
        <span><img id="img1" src=""/></span>
       </div> 
       <div class="g_thumb"> 
        <a id="img_scrollLeft" class="icon_left"></a> 
        <a id="img_scrollRight" class="icon_right"></a> 
        <div class="g_thumb_main"> 
         <ul style="width: 255px;" id="img_smalls">
		  <?php if(is_array($imglist)): $i = 0; $__LIST__ = $imglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgv): $mod = ($i % 2 );++$i; if(!strpos($imgv,'ttp:')){ $imgv=$config['site_url'].$imgv;} $imglist[$key]=$imgv; ?>
          <li><img src="<?php echo ($imgv); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
         </ul> 
        </div> 
        <div class="cl"></div> 
       </div> 
      </div><?php endif; ?>
 
      <div class="col_sub sumary" id="rightdiv"> 
       <ul class="suUl"> 
       
		<?php if(!empty($content)): if(is_array($content)): $i = 0; $__LIST__ = $content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i; if($cv['type'] == 5): $textarr[]=$cv;continue; endif; ?>
          <li> 
			 <div class="su_tit">
			  <?php echo ($cv['tn']); ?>
			 </div> 
			 <div class="su_con"> 
			 <?php if(is_array($cv['vv'])): echo (implode($cv['vv'],'，')); ?>
			 <?php elseif($cv['type'] == 1 AND empty($cv['vv']) AND $cv['inarr'] == 1): ?>
			  面议
			 <?php elseif($cv['type'] == 1 AND isset($cv['unit']) AND !empty($cv['unit'])): ?><strong class="price2"><?php echo ($cv['vv']); ?></strong> / <?php echo ($cv['unit']); else: echo ($cv['vv']); endif; ?>
			 </div>
		   </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
       
        <li> 
         <div class="su_tit">
          联系人
         </div>  <?php echo ($detail['lxname']); ?>  
		 </li> 
   
      
        <li> 

         <div class="su_con"> 
          <div name="data_1" id="movebar"> 
           <ul> 
            <li class="ico_tel"> 
             <div class="su_phone"> 
			 <?php if(strpos($detail['lxtel'], 'load/telimages')): ?><span  class="arial c_e22" style="font-size:26px;font-weight:bold;margin-top: 8px;">   <img src="<?php echo ($config['site_url']); ?>/<?php echo ($detail['lxtel']); ?>"></span>
			  <?php else: ?>
              <span id="t_phone" class="arial c_e22" style="font-size:26px;font-weight:bold;margin-top: 8px;"> <?php echo ($detail['lxtel']); ?> </span><?php endif; ?>
             </div> </li> 
           </ul> 
          </div> 

         </div> 
         <div class="cb"></div> </li> 
        <!---<li>
         <div class="safe-advice">
          <i class="safe-icon"></i>
          <span class="advies_span"></span>
         </div> </li> -->
       </ul> 
      </div> 
      <div style="padding-top:20px;" class="col_sub description"> 
       <div style="width: 100%; background-color: rgb(255, 255, 255); position: static;" class="des_tit" id="float"> 
        <ul class="desMenu clearfix"> 
         <a href="javascript:;" rel="nofollow" class="cur"><span>说明描述信息</span></a>
        </ul> 
        <a href="" class="exchangeHelp"></a> 
       </div> 
       <div class="des_con" id="fyms"> 

        <div class="cur"> 
         <div class="descriptionBox  maincon" id="miaoshu1" name="data_2"> 
          <div class="description_con" name="data_2">
		  <?php if(!empty($textarr)): if(is_array($textarr)): $i = 0; $__LIST__ = $textarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tt): $mod = ($i % 2 );++$i;?><p><span><?php echo ($tt['tn']); ?>：<span><?php echo (str_replace(PHP_EOL,'<br/>',$tt['vv'])); ?></p><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		  <br/>
		 <?php if(!empty($detail['otherdesc'])): ?><div style="line-height: 30px;"><span>职位描述：</span><br/><?php echo (htmlspecialchars_decode($detail['otherdesc'],ENT_QUOTES)); ?></div>
		    <br/><?php endif; ?>
          <div><?php echo (htmlspecialchars_decode($detail['description'],ENT_QUOTES)); ?></div>
          </div> 
         </div> 
		 <?php if(!empty($imglist)): ?><div class="descriptionImg"> 
		  <?php if(is_array($imglist)): $i = 0; $__LIST__ = $imglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><img src="<?php echo ($img); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
         </div><?php endif; ?>
        </div> 
       </div> 
      </div> 
     
      <div class="cl"></div> 
     </div> 
    
     
    </div> 
    <!-- =E main --> 
   </div> 
  </div>
  
 </body>
 <script src="<?php echo ($static_path); ?>classify/common.js"></script>

 <script type="text/javascript">
  var telph="<?php echo ($detail['lxtel']); ?>";
   if(telph){
      var telarr=telph.split('');
	  var tmp='';
	  for(m=0;m<telarr.length;m++){ 
	     if(m==3 || m==7){
		    tmp=tmp+' '+telarr[m];
		 }else{
		   tmp+=telarr[m];
		 }
	  }
	  $('#t_phone').text(tmp);
   }
  var rightdivH=$('#rightdiv').height();
  var leftdiv=$('#leftdiv').height();
  var tmpH=rightdivH-leftdiv-80;
  if(tmpH>0){
    $('#leftdiv').css('margin-top',tmpH/2);
  }

  $('#su_kfdnew').hover(function(e){
	 $(this).addClass('hover');
     $('#collectBar').show();
  },function(e){
	  //var cElement=e.target||window.event.srcElement;
	  //var jqElement=$(cElement);
	  //$(this).removeClass('hover');
     //$('#collectBar').hide();
  });

 $('#mtit_con_clearfix').hover(function(e){
 
 },function(e){
   	 $('#su_kfdnew').removeClass('hover');
     $('#collectBar').hide();
 });

  /***给数组原型上添加一个去重函数***/
 Array.prototype.unique = function()
{
	var n = {},r=[]; //n为hash表，r为临时数组
	for(var i = 0; i < this.length; i++) //遍历当前数组
	{
		if (!n[this[i]]) //如果hash表中没有当前项
		{
			n[this[i]] = true; //存入hash表
			r.push(this[i]); //把当前数组的当前项push到临时数组里面
		}
	}
	return r;
}
 var c_IP="<?php echo ($client_ip); ?>";
 var vid= "<?php echo ($vid); ?>";
 var ipCookie=optCookie('client_ip_'+vid);
 ipCookie=parseInt(ipCookie);
 if(!(ipCookie==1)){
  $.post("<?php echo U('Classify/addviews');?>",{vid:vid},function(data){
	data=parseInt(data);
	if(!data){
      optCookie('client_ip_'+vid,1,1);
	}
  },'JSON');
 }

var uid="<?php echo ($uid); ?>"
  /*****收藏处理*******/
 function FavoriteThis(){
   uid=parseInt(uid);
   var vidstr=optCookie('o2oFavoriteThis');
   var FavoriteArr=new Array();
   var flag=false;
   if(vidstr){
	   s_vid=vid.toString();
	  if(vidstr.indexOf(s_vid) > -1){
	    alert('您已经收藏了此页！');
	  }else{
	    var FavoriteArr=vidstr.split('-');
		typeof(FavoriteArr)=='object' && FavoriteArr instanceof Array && FavoriteArr.push(vid);
		FavoriteArr=FavoriteArr.unique();
		var Cookiestr = FavoriteArr.join("-");
		optCookie('o2oFavoriteThis',Cookiestr,365);
		alert('收藏成功！');
		flag=true;
	  }
   }else{
     FavoriteArr.push(vid);
	 FavoriteArr=FavoriteArr.unique();
	 var Cookiestr=FavoriteArr.join("-");
	 optCookie('o2oFavoriteThis',Cookiestr,365);
	 alert('收藏成功了！');
	 flag=true;
   }

   if(flag && (uid>0)){
       $.post("<?php echo U('Classify/collectOpt');?>",{vid:vid},function(ret){
	   },'JSON');
   }
 }
 	/********** 操作cookie ********/
	 function optCookie(a, b, c)
	{
		if(typeof(b) == 'undefined')
		{
			var e='';
			a = a + '=';
			b = document.cookie.split(';');
			for(c = 0; c < b.length; c ++)
			{
				for(e = b[c]; e.charAt(0) == ' ';) e = e.substring(1, e.length);
				if(e.indexOf(a) == 0) return decodeURIComponent(e.substring(a.length, e.length));
			};
			return 0;
		}
		else
		{
			var f = '';
			if(c)
			{
				f = new Date();
				f.setTime(f.getTime() + c * 24 * 60 * 60 * 1000);
				f = '; expires=' + f.toGMTString();
			};
			document.cookie = a + '=' + encodeURIComponent(b) + f + '; path=/' +'';
	   };
   }

 </script>
</html>