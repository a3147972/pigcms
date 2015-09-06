<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="keywords" content="{pigcms{$config.site_name} 分类信息 {pigcms{$detail['title']}" /> 
  <meta name="description" content="您的信息发布平台{pigcms{$config.site_name} 分类信息 {pigcms{$detail['title']}" /> 
  <meta name="location" content="" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/base.css" />
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/detailfang.css" />
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
 
<style type="text/css">
	.descriptionImg img{
	max-width:640px;
	_width:640px; 
	overflow: visible
}
#img_smalls li{cursor:pointer;}
.description_con{line-height: 20px;}
</style> 
  <title>{pigcms{$detail['title']}</title> 
 </head> 
 <body> 

  <div id="site-mast" class="site-mast"><include file="topbar"/></div>  

  <div id="header"> 
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
   <div class="breadCrumb f12">
	<span><a href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$fcidinfo['cid']}.html">{pigcms{$fcidinfo['cat_name']}</a></span>
    <span class="crb_i"><a href="{pigcms{$siteUrl}/classify/list-{pigcms{$detail['cid']}.html"> {pigcms{$detail['cat_name']}</a> </span> 
	
	<if condition="!empty($detail['s_c'])">
    <span class="crb_i"><a href="{pigcms{$siteUrl}/classify/list-{pigcms{$detail['cid']}-{pigcms{$detail['s_c']['cid']}.html">{pigcms{$detail['s_c']['cat_name']}</a> </span>
	</if>
   </div> 
   <a href="{pigcms{$siteUrl}/classify/selectsub.html" rel="nofollow" class="postBtn fr"></a> 
  </div> 

  <div id="content" class="clearfix"> 
   <div id="main"> 
    <div class="col detailPrimary mb15"> 

     <div class="col_sub mainTitle"> 
      <div class="bigtitle"> 
       <h1> {pigcms{$detail['title']} </h1>&nbsp;
      </div> 
      <div class="mtit_con c_999 f12 clearfix" id="mtit_con_clearfix"> 
       <ul class="mtit_con_left fl"> 
        <li class="time"> {pigcms{$detail['updatetime']} </li> 
        <li class="count"><em id="totalcount">{pigcms{$detail['views']}</em></li> 
       </ul>  
	    <ul class="mtit_con_right fr" style="margin-right:50px;"> 
        <!-- hover 为鼠标划入是的状态，该状态需要脚本做处理 --> 
       
        <li class="su_kfd su_hover" id="su_kfdnew"><a class="ml_2"><i class="mtit2"></i>收藏</a></li> 

       </ul> 
	<!--=S 收藏 -->
	<div style="left: 911px; display: none; top: 20px;" id="collectBar" class="collectBox">
		<ul class="mtit_con_ul">
			<li><a title="收藏信息" href="javascript:;" onclick="FavoriteThis()">收藏到个人中心</a></li>
			<li><a href="/index.php?g=Release&c=Classify&a=savetoDesk&vid={pigcms{$detail['id']}">保存到桌面</a></li>
			<li><a href="javascript:;" id="addFavBtn">添加到浏览器收藏夹</a></li>
		</ul>
		<i class="shadow_"></i>
	</div>
	<!--=E 收藏 -->
      </div> 
     </div> 
   
     <div class="col_sub maintop mb30 clearfix"> 
    
	<if condition="!empty($imglist)">
      <div class="col_sub gallery" id="leftdiv"> 
       <div class="g_img">
        <span><img id="img1" src=""/></span>
       </div> 
       <div class="g_thumb"> 
        <a id="img_scrollLeft" class="icon_left"></a> 
        <a id="img_scrollRight" class="icon_right"></a> 
        <div class="g_thumb_main"> 
         <ul style="width: 255px;" id="img_smalls">
		  <volist name="imglist" id="imgv">
		  <php>if(!strpos($imgv,'ttp:')){ $imgv=$config['site_url'].$imgv;}
		    $imglist[$key]=$imgv;
		  </php>
          <li><img src="{pigcms{$imgv}" /></li> 
		  </volist>
         </ul> 
        </div> 
        <div class="cl"></div> 
       </div> 
      </div> 
      </if>
 
      <div class="col_sub sumary" id="rightdiv"> 
       <ul class="suUl"> 
       
		<if condition="!empty($content)">
		 <volist name="content" id="cv">
		 <if condition="$cv['type'] eq 5">
			<php>$textarr[]=$cv;continue;</php>
		</if>
          <li> 
			 <div class="su_tit">
			  {pigcms{$cv['tn']}
			 </div> 
			 <div class="su_con"> 
			 <if condition="is_array($cv['vv'])">
			 {pigcms{$cv['vv']|implode='，'}
			 <elseif condition="$cv['type'] eq 1 AND empty($cv['vv']) AND $cv['inarr'] eq 1"/>
			  面议
			 <elseif condition="$cv['type'] eq 1 AND isset($cv['unit']) AND !empty($cv['unit'])"/><strong class="price2">{pigcms{$cv['vv']}</strong> / {pigcms{$cv['unit']}<else/>{pigcms{$cv['vv']}
			 </if>
			 </div>
		   </li>
		 </volist>
		</if>
       
        <li> 
         <div class="su_tit">
          联系人
         </div>  {pigcms{$detail['lxname']}  
		 </li> 
   
      
        <li> 

         <div class="su_con"> 
          <div name="data_1" id="movebar"> 
           <ul> 
            <li class="ico_tel"> 
             <div class="su_phone"> 
			 <if condition="strpos($detail['lxtel'], 'load/telimages')">
              <span  class="arial c_e22" style="font-size:26px;font-weight:bold;margin-top: 8px;">   <img src="{pigcms{$config['site_url']}/{pigcms{$detail['lxtel']}"></span>
			  <else/>
              <span id="t_phone" class="arial c_e22" style="font-size:26px;font-weight:bold;margin-top: 8px;"> {pigcms{$detail['lxtel']} </span>
			  </if>
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
		  <if condition="!empty($textarr)">
		    <volist name="textarr" id="tt">
			   <p><span>{pigcms{$tt['tn']}：<span>{pigcms{$tt['vv']|str_replace=PHP_EOL,'<br/>',###}</p>
			</volist>
		  </if>
		  <br/>
		 <if condition="!empty($detail['otherdesc'])">
		   <div style="line-height: 30px;"><span>职位描述：</span><br/>{pigcms{$detail['otherdesc']|htmlspecialchars_decode=ENT_QUOTES}</div>
		    <br/>
		 </if>
          <div>{pigcms{$detail['description']|htmlspecialchars_decode=ENT_QUOTES}</div>
          </div> 
         </div> 
		 <if condition="!empty($imglist)">
         <div class="descriptionImg"> 
		  <volist name="imglist" id="img">
          <img src="{pigcms{$img}" /> 
		  </volist>
         </div>
		 </if>
        </div> 
       </div> 
      </div> 
     
      <div class="cl"></div> 
     </div> 
    
     
    </div> 
    <!-- =E main --> 
   </div> 
  </div>
  <include file="Classify:footer"/>
 </body>
 <script src="{pigcms{$static_path}classify/common.js"></script>

 <script type="text/javascript">
  var telph="{pigcms{$detail['lxtel']}";
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
 var c_IP="{pigcms{$client_ip}";
 var vid= "{pigcms{$vid}";
 var ipCookie=optCookie('client_ip_'+vid);
 ipCookie=parseInt(ipCookie);
 if(!(ipCookie==1)){
  $.post("{pigcms{:U('Classify/addviews')}",{vid:vid},function(data){
	data=parseInt(data);
	if(!data){
      optCookie('client_ip_'+vid,1,1);
	}
  },'JSON');
 }

var uid="{pigcms{$uid}"
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
       $.post("{pigcms{:U('Classify/collectOpt')}",{vid:vid},function(ret){
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