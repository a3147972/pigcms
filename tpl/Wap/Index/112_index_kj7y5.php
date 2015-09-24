<html>
        <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{pigcms{$tpl.wxname}</title>
        <base href="." />
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no" />
        
		
        <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/114/iscroll.css" media="all">
<!-- <link href="{pigcms{$static_path}css/114/cate14_.css" rel="stylesheet" type="text/css"> -->
<link href="{pigcms{$static_path}css/allcss/cate12_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
<style>

 
</style>
<script src="{pigcms{$static_path}css/114/iscroll.js" type="text/javascript"></script>
<script type="text/javascript">
var myScroll;

function loaded() {
myScroll = new iScroll('wrapper', {
snap: true,
momentum: false,
hScrollbar: false,
onScrollEnd: function () {
document.querySelector('#indicator > li.active').className = '';
document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
}
 });
 
 
}

document.addEventListener('DOMContentLoaded', loaded, false);
</script>

</head>

<body id="cate14">
<!--背景音乐-->
<if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>
<div class="banner">
<div id="wrapper" style="overflow: hidden;">
<div id="scroller" style="width: {pigcms{$num*260}px; -webkit-transition: 0ms; transition: 0ms;">
<ul id="thelist">
               
    <volist name="flashbg" id="so">
    <li>
        <p>{pigcms{$so.info}</p>
        <img src="{pigcms{$so.img}" style="width: 260px;">
    </li>
    </volist>
 

</ul>
</div>
</div>
    <div id="nav">
<div id="prev" onClick="myScroll.scrollToPage(&#39;prev&#39;, 0,400,3);return false">← prev</div>
<ul id="indicator">
            
<volist name="flashbg" id="so">
    <li <if condition="$i eq 1">class="active"</if> ></li>
</volist>
 
</ul>
<div id="next" onClick="myScroll.scrollToPage(&#39;next&#39;, 0,400,3);return false">next →</div>
</div>
    <div class="clr"></div>
</div>

<div class="mainmenu">
<ul><div id="insert1"></div>
   
<volist name="info" id="vo">
                    <li>
                        <div class="menubtn">
                            <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">{pigcms{$vo.name}</a>
                        </div>

                    </li>
                </volist>
 

        <div id="insert2"></div>
        
        <div class="clr"></div>
</ul>
</div>

 
<div style="display:none"> </div>
<script>
var count = document.getElementById("thelist").getElementsByTagName("img").length;  

var count2 = document.getElementsByClassName("menuimg").length;
for(i=0;i<count;i++){
 document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";

 setInterval(function(){
myScroll.scrollToPage('next', 0,400,count);
},3500 );
window.onresize = function(){ 
for(i=0;i<count;i++){
document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
 document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
} 


</script>

<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>

<php>$tinvote_array = $invote_array; $invote_array='';</php>
<include file="Index:styleInclude"/>
<if condition="$tinvote_array">
<script>
	var html = '<div class="list" style="border-top: 1px solid #ddd8ce; border-bottom: 1px solid #ddd8ce; margin-top: .2rem; margin-bottom: 0; background-color: #fff;z-index:100000;"><a href="{pigcms{$tinvote_array.url}" style="color:#666;display:block;padding:.2rem;padding-bottom: 9px;">';
	html += '<img src="{pigcms{$tinvote_array.avatar}" style="width:40px;  vertical-align: middle;"/>{pigcms{$tinvote_array.txt}';
	html += '<button style="float:right;height:2.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 1.2rem;">关注我们</button>';
	html += '</a></div>';
	$('body').prepend(html);
	if ($('body').attr('id')) {
		$('#wrapper').css('top','57px');
	}
</script>
</if>
 <include file="$cateMenuFileName"/>
<!-- share -->
<include file="Index:share" />
</body></html>