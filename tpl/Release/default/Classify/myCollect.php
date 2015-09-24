<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <title>我的收藏</title> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mball.css" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/ucenter_v.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
 </head> 
 <body> 
  <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
  <div class="body_div" style="margin:0 auto; width: 1000px;background-color: #fff;padding-bottom: 30px;margin-top: 7px;"> 
   <div class="c_header"> 
    <a class="c_logo" href="{pigcms{$siteUrl}/classify/" style="font-size: 20px;">分类信息首页</a> 
    <a class="c_publish" href="{pigcms{$siteUrl}/classify/selectsub.html"> <i class="ico"></i>发布 </a> 
   </div> 
   <div class="dl_nav"> 
    <span> <a href="{pigcms{$siteUrl}/classify/">分类信息首页</a> &gt; <a href="{pigcms{$siteUrl}/classify/mycenter.html" rel="nofollow">个人中心</a> &gt; <a href="javascript:;" rel="nofollow" style="color: #f97d03;">我的收藏</a> </span> 
   </div> 

   <!--<ul class="infolist_tab">
    <li class="local">我的收藏</li>
   </ul>-->
   <div class="ucenter"> 
    <ul class="u_infolst" id="userFav">
	  <if condition="!empty($listsdatas)">
      <volist name="listsdatas" id="vl">
      <li><a href="{pigcms{$siteUrl}/classify/{pigcms{$vl['id']}.html"><h2>{pigcms{$vl['title']}</h2>
       <div class="attr">
        <span>{pigcms{$vl['input1']}</span><br>
		<span>{pigcms{$vl['input2']} </span><br>
        <span>{pigcms{$vl['timestr']}</span>
       </div></a></li>
	   </volist>
	    <div class="u_paging"> 
		<span class="btn_clear w_auto" onclick="emptyC();">清空</span> 
		</div> 
	   <else/>
	   <li style="height: 50px;text-align: center;margin-top: 20px;font-size: 16px;">您还没有收藏任何数据</li>
	   </if>
    </ul> 
      <!--<div class="textcenter pagebar" style="height: 80px;padding-top: 35px;text-align: center;">
		{pigcms{$pagebar}
    </div>-->

   </div> 
 
  </div> 
  <div style="margin-bottom: 100px;">
</div>
  <include file="Classify:footer"/>
  <script type="text/javascript">
   var uid="{pigcms{$uid}"
   function emptyC(){
      optCookie('o2oFavoriteThis','');
	  $.post("{pigcms{:U('Classify/emptyC')}",{uid:uid},function(ret){
	  },'JSON');
	  $('#userFav li').remove();
	  alert('清空成功！');
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
 </body>
</html>