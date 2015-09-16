<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
        <link href="{pigcms{$static_path}css/allcss/cate1_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
        <link href="{pigcms{$static_path}css/101/iscroll.css" rel="stylesheet" type="text/css" />
	    
        <script src="{pigcms{$static_path}css/101/iscroll.js" type="text/javascript"></script>
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

    <body id="cate1">
<if condition="$invote_array">
<div class="list" style="border-top: 1px solid #ddd8ce; border-bottom: 1px solid #ddd8ce; margin-bottom: 0; background-color: #fff;z-index:100000;">
<a href="{pigcms{$invote_array.url}" style="color:#666;display:block;padding:.2rem;padding-bottom: 9px;">
<img src="{pigcms{$invote_array.avatar}" style="width:40px;  vertical-align: middle;"/>{pigcms{$invote_array.txt}
<button style="float:right;height:2.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 1.2rem;">关注我们</button>
</a>
</div>
</if>
<php>$invote_array = '';</php>
    <!--背景音乐-->
    <if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>
    
			   <div class="banner">
		<div id="wrapper">
			<div id="scroller">
				<ul id="thelist"> 
				<volist name="flash" id="so">
						<li><p>{pigcms{$so.info}</p><a href="{pigcms{$so.url}"><img src="{pigcms{$so.img}" /></a></li>
					</volist>
				</ul>
			</div>
		</div>
		<div id="nav">
			<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,3);return false">&larr; prev</div>
			<ul id="indicator">
			<volist name="flash" id="so">
			<li   <if condition="$i eq 1">class="active"</if>  >{pigcms{$i}</li>
			</volist>
			 
			</ul>
			<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next &rarr;</div>
		</div>
		<div class="clr"></div>
		</div>
        <div id="insert1"></div>
        <ul class="mainmenu">

            <volist name="info" id="vo">
                <li>
                    <div class="menubtn">
                       <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
                            <div class="menumesg">
                                <div class="menuimg"><img src="{pigcms{$vo.img}"></div>
                                <div class="menutitle">{pigcms{$vo.name}</div>
                            </div>
                        </a>
                    </div>

                </li>
            </volist>

            <div class="clr"></div>
        </ul>
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

        <div id="insert2"></div>
        <div style="display:none"> </div>

<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />

    </body></html>