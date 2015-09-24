<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="location" content="" /> 
  <meta charset="utf-8" /> 
  <title>信息展示</title> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <meta name="description" content="" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mdetailzufang.css" /> 
   <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <!--<script src="./house_common_final.js" async=""></script> -->
  <!--<script async="" src="/share.js"></script>
<link rel="stylesheet"
href="http://bdimg.share.baidu.com/static/api/css/share_style0_32.css?v=93286870.css">--> 
 </head> 
 <body> 
  <div class="body_div"  style="margin-bottom: 30px;"> 
   <div class="dl_nav" style="padding: 5px;"> 
    <span> <a href="/wap.php?g=Wap&c=Classify&a=index">首页</a>&gt; <a href="{pigcms{:U('Classify/Lists',array('cid'=>$detail['cid']))}">{pigcms{$detail['cat_name']}</a><if condition="!empty($detail['s_c'])">&gt; <a href="{pigcms{:U('Classify/Lists',array('cid'=>$detail['cid'],'sub3dir'=>$detail['s_c']['cid']))}"><h1>{pigcms{$detail['s_c']['cat_name']}</h1></a> </if></span> 
   </div> 
   <!--<div class="header">
	<a class="logo">
	<img src="" alt="" width="69" height="20">
	</a>
	<a class="city_a" href="">
	<div class="city"></div>
	<div class="city_ico"></div>
	</a>
	<a class="h_btn h_search" id="h_search" href="javascript:;" rel="nofollow">搜索<span class="bbmes" style="display: none;">0</span></a>
	<a class="h_btn h_post" href="" rel="nofollow">发布</a>
	</div>--> 
   <div class="detail_w detail_w_new"> 
     <php>$share_img='';</php>
	  <if condition="!empty($imglist)">
      <div class="image_area_w image_area_w_new">
	  <div class="image_area image_area_new">
	  <ul>
	  <volist name="imglist" id="imgv">
	  <php>if(!strpos($imgv,'ttp:')){ $imgv=$config['site_url'].$imgv;}
	   if($key==0){
	       $share_img=$imgv;
	   }
	  </php>
	  <li><img src="{pigcms{$imgv}" ref="{pigcms{$imgv}"></li>
	  </volist>
	  </ul>
	  <div class="panel_num"></div>
	  <a href="javascript:history.go(-1)" class="backToP"></a>
	  <div class="imgNum"><span class="curr_img">1</span>/<php>echo count($imglist);</php></div></div>
	  </div>
	  </if>
    <div class="tit_area"> 
     <div class="left_tit"> 
      <h1 class="tit">{pigcms{$detail['title']}</h1> 
      <div class="status_bar"> 
       <span class="date">{pigcms{$detail['updatetime']}</span>&nbsp;&nbsp;&nbsp; 
       <span class="browse_num"><span id="totalcount">{pigcms{$detail['views']}</span>人浏览</span> 
      </div> 
     </div> 
     <div class="right_store" onclick="FavoriteThis();"> 
      <span class="btn_Favorite btn_Favorite_new"><i class="ico"></i>收藏</span> 
     </div> 
    </div> 
    <!--<div id="managebg" class="hide">
     <div id="managedialog">
      <i class="ico"></i>
      <h3></h3>
      <div class="phone" id="13031169596">
       <span id="number">13031169596</span>
       <input id="getcode" type="button" value="获取验证码" />
      </div>
      <div class="tip tip1">
       <i class="tipico"></i>
       <span class="tiptext">短信验证码已发送至您的手机</span>
      </div>
      <div class="validcode">
       <input id="code" type="number" placeholder="验证码" />
      </div>
      <div class="tip tip2">
       <i class="tipico"></i>
       <span class="tiptext">验证码失效或错误，请重试</span>
      </div>
      <input id="done" type="button" value="" />
     </div>
    </div>--> 
    <!--tit end--> 
    <!-- detail list start --> 
    <ul class="attr_info fang fang_new"> 
	 <if condition="!empty($content)">
	 <volist name="content" id="vv">
	 <if condition="$vv['type'] eq 5">
	 <php>$textarr[]=$vv;continue;</php>
	 </if>
	 <li>{pigcms{$vv['tn']}&nbsp;&nbsp;<span><if condition="is_array($vv['vv'])">{pigcms{$vv['vv']|implode=','}			 <elseif condition="$vv['type'] eq 1 AND empty($vv['vv']) AND $vv['inarr'] eq 1"/>面议<elseif condition="$vv['type'] eq 1 AND isset($vv['unit']) AND !empty($vv['unit'])"/><strong class="price2">{pigcms{$vv['vv']}</strong> / {pigcms{$vv['unit']}<else/>{pigcms{$vv['vv']}</if>&nbsp;&nbsp;</span></li>
	 </volist>
	 </if>

    </ul> 
    <!-- detail list end --> 
	<if condition="strpos($detail['lxtel'], 'load/telimages')">
        <div class="agent_con">
		<p>联系人：{pigcms{$detail['lxname']}</p>
		<p>联系电话：<img src="{pigcms{$config['site_url']}/{pigcms{$detail['lxtel']}"></p>
		</div> 
	<else/>
    <div class="agent_con"> 
     <ul class="agent_info"> 
      <li><a class="agent_name" href="tel:{pigcms{$detail['lxtel']}" data-click-from="telephone_num">{pigcms{$detail['lxname']}</a>&nbsp;</li> 
      <li><a class="fred" href="tel:{pigcms{$detail['lxtel']}" data-click-from="telephone_num">{pigcms{$detail['lxtel']}</a>&nbsp;<!--<span class="txt_c f12">归属地:</span>--></li> 
     </ul> 
    </div> 
    <div class="connection_con"> 
     <p class="connection"><a data-click-from="telephone_ico" href="tel:{pigcms{$detail['lxtel']}" class="fangico dianhua "><i></i>电话联系</a><a href="sms:{pigcms{$detail['lxtel']}" class="fangico duanxin online" data-click-from="shortmessage" id="contact_sms"><i></i>短信联系</a></p> 
    </div> 
	</if>
    <dl class="detail_txt detail_txt_new"> 
	<if condition="isset($textarr)">
	<br/>
	<volist name="textarr" id="tt">
     <dt class="title_css">
		{pigcms{$tt['tn']}
     </dt> 
	  <dd class="house_describe"> 
      <!--<ul class="setting"> 
       <li><i></i>床</li> 
      </ul> -->
      <div id="describe"> 
	  {pigcms{$tt['vv']|str_replace=PHP_EOL,'<br/>',###}
      </div> 
     </dd> 
	</volist>
	</if>

 <if condition="!empty($detail['otherdesc'])">
     <br/>
     <dt class="title_css">
       职位描述
     </dt> 
	 <dd class="house_describe"> 
      <div id="describe"> 
		{pigcms{$detail['otherdesc']|htmlspecialchars_decode=ENT_QUOTES}
      </div> 
     </dd> 
	</if>
	<if condition="!empty($detail['description'])">
     <dt class="title_css">
       说明描述 
     </dt> 
     <dd class="house_describe"> 
      <div id="describe"> 
		{pigcms{$detail['description']|htmlspecialchars_decode=ENT_QUOTES}
      </div> 
     </dd> 
	 </if>
    </dl> 
   </div> 
   <!--<div id="contactbar">
    <div class="landlord">
     <p class="llname">杨经理（经纪人）</p>
     <p class="llnumber">13031169596-北京</p>
    </div>
    <a href="tel:13031169596" id="contact_phone" >电话</a>
    <a href="sms:13031169596"  id="contact_sms">短信</a>
    <a href="javascript:;" id="contact_bb"  class="net-online">在线沟通</a>
   </div>--> 
   <!--
   <div id="yzfbg" class="hide">
    <div id="yzfdialog">
     <i class="ico"></i>
     <h3>验证您的手机</h3>
     <div class="phone">
      <input id="phonenumber" maxlength="11" type="number" placeholder="手机号" />
      <input id="btngetcode" type="button" value="获取验证码" />
     </div>
     <div class="tip tip1">
      <i class="tipico"></i>
      <span class="tiptext"></span>
     </div>
     <div class="validcode">
      <input id="phonecode" type="number" placeholder="验证码" />
     </div>
     <div class="tip tip2">
      <i class="tipico"></i>
      <span class="tiptext"></span>
     </div>
     <input id="btndone" type="button" value="完成" />
    </div>
   </div> 
---> 
    <div id="viewBigImagebg"></div>
   <div id="viewBigImage">
    <div class="bigimg_topbar">
     <div class="btn_back">
      <span>返回</span>
     </div>
     <div class="bigimg_num">
      <span class="curr_img">1</span>/
      <span class="total_img"><php>echo count($imglist);</php></span>
     </div>
    </div>
    <div class="bigimg_box">
     <ul></ul>
    </div>
   </div>

  </div>
  <div style="margin-bottom: 100px;">
</div>
  <include file="Classify:footer"/>
 </body>
 <script  src="{pigcms{$static_path}classify/slideX.js"></script>
 <script type="text/javascript">
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
window.shareData = {  
			"moduleName":"Classify",
			"moduleID":"0",
			"imgUrl": "{pigcms{$share_img}", 
			"sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Classify/ShowDetail', array('vid' => $vid))}",
			"tTitle": "{pigcms{$detail['title']}",
			"tContent": "{pigcms{$detail['title']}"
};
 </script>
 {pigcms{$shareScript}
</html>