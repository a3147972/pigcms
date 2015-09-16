<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
<!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
<script src="{pigcms{$static_path}js/navfix.js"></script>	
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_introduction.css">
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js" type="text/javascript"></script>
<!--[if IE 6]>
<script  src="js/DD_belatedPNG_0.0.8a.js" mce_src="js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   /* EXAMPLE */
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

   /* string argument can be any CSS selector */
   /* .png_bg example is unnecessary */
   /* change it to what suits you! */
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
        body{ behavior:url("csshover.htc"); 
		}
 
	 
			}
        </style>
<![endif]-->
<!--<link rel="stylesheet" href="http://bdimg.share.baidu.com/static/api/css/share_style0_16.css?v=8105b07e.css">-->
</head>
<body>
<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<article class="article"> 
  <script type="text/javascript">
function setTab(name,cursel){
	cursel_0=cursel;
	for(var i=0; i<=links_len; i++){
		var menu = document.getElementById(name+i);
		var menudiv = document.getElementById("con_"+name+"_"+i);
		if(i==cursel){
			menu.className="off";
			menudiv.style.display="block";
		}
		else{
			menu.className="";
			menudiv.style.display="none";
		}
	}
}
function Next(){                                                        
	cursel_0++;
	if (cursel_0>links_len)cursel_0=0;
	setTab(name_0,cursel_0);
} 
var name_0='one';
var cursel_0=0;
var ScrollTime=300000;//循环周期（毫秒）
var links_len,iIntervalId;
window.onload=function(){
	var links = document.getElementById("tab1").getElementsByTagName('li')
	links_len=links.length-1;
	for(var i=0; i<links_len; i++){
		links[i].onmouseover=function(){
			clearInterval(iIntervalId);
			this.onmouseout=function(){
				iIntervalId = setInterval(Next,ScrollTime);;
			}
		}
	}

	document.getElementById("con_"+name_0+"_"+links_len).parentNode.onmouseover=function(){
		clearInterval(iIntervalId);
		this.onmouseout=function(){
			iIntervalId = setInterval(Next,ScrollTime);;
		}
	}
	setTab(name_0,cursel_0);
	iIntervalId = setInterval(Next,ScrollTime);
}
</script>
  <div class="tab1" id="tab1">
    <div class="menu">
      <ul>
	    <li id="one0" onclick="setTab('one',0)" class="off">商家简介</li>
		<volist name="introduce" id="vo" key="kk">
        <li id="one{pigcms{$kk}" onclick="setTab('one',{pigcms{$kk})">{pigcms{$vo['title']}</li>
		</volist>
      </ul>
    </div>
    <div class="menudiv">
      <div id="con_one_0">
        <section class="server">
          <div class="section_title">
            <div class="section_txt">商家介绍</div>
            <div class="section_border"> </div>
            <div style="clear:both"></div>
          </div>
		   &nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$merchantarr['txt_info']}
        </section>
      </div>
	<volist name="introduce" id="vo" key="kk">
      <div id="con_one_{pigcms{$kk}" style="display:none;">
       <section class="server">
          <div class="section_title">
            <div class="section_txt">{pigcms{$vo['title']}</div>
            <div class="section_border"> </div>
            <div style="clear:both"></div>
          </div>
		 {pigcms{$vo['content']|htmlspecialchars_decode=ENT_QUOTES}
        </section>
      </div>
	  </volist>
    </div>
  </div>
</article>
<div style="clear:both"></div>
<include file="Public:footer"/>
</body>
</html>