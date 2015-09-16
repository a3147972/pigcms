<!DOCTYPE html>
<html><head>
<if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>{pigcms{$tpl.wxname}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
<link href="{pigcms{$staticPath}{pigcms{$static_path}tpl/1331/css/cate28_0.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{pigcms{$staticPath}{pigcms{$static_path}tpl/1331/css/reset.css" media="all">
<script type="text/javascript" src="{pigcms{$staticPath}{pigcms{$static_path}tpl/1331/js/maivl.js"></script>
<script type="text/javascript" src="{pigcms{$staticPath}{pigcms{$static_path}tpl/com/js/jquery.min.js"></script>
<script type="text/javascript" src="{pigcms{$staticPath}{pigcms{$static_path}tpl/1331/js/swipe.js"></script>
<script type="text/javascript" src="{pigcms{$staticPath}{pigcms{$static_path}tpl/1331/js/zepto.js"></script>
<link rel="stylesheet" type="text/css" href="{pigcms{$staticPath}{pigcms{$static_path}tpl/1331/css/font-awesome.css" media="all">
<style>
.box li{text-align:center; background-color:#727170; height:42px; line-height:42px;border-right:1px #fff solid;}
.box li:last-child {border-right:0;}
.box li a{color:#fff; font-family:"Microsoft Yahei";font-size:14px;}
.list_ul div{border:0;border-radius:0; -webkit-box-shadow:0 0 0 rgba(0,0,0,0); -webkit-background-size: 100% 100%;}
<volist name="flashbg" id="so" offset="0" length="1">
.list_ul{margin:0;padding:10px;background:url('{pigcms{$so.img}');background-size: 100% auto;}
</volist>
.list_ul .title{font-family:"Microsoft Yahei";font-size:14px;color:#000;line-height: 25px;}
</style>
</head>
<!--music-->
        <if condition="$homeInfo['musicurl'] neq false">
            <include file="Index:music"/>
        </if>
    <body onselectstart="return true;" ondragstart="return false;">
<div class="body">
    <div style="-webkit-transform:translate3d(0,0,0);">
        <div id="banner_box" class="box_swipe" style="visibility: visible;">
            <ul id="thelist" style="list-style: none; -webkit-transition: 500ms; transition: 500ms; width: 2560px;">
            <volist name="flash" id="so">    
                    <li style="vertical-align: top;display: table-cell;"><a href="{pigcms{$so.url}">
                        <img src="{pigcms{$so.img}" style="width:100%;"></a>
                    </li>
            </volist>                    
            </ul>
            <ol>
            <volist name="flash" id="so">
                <li <if condition="$i eq 1">class="on"</if> ></li>
            	</volist>
            </ol>
        </div>
    </div>
        <script>
        $(function(){
            new Swipe(document.getElementById('banner_box'), {
                speed:500,
                auto:3000,
                callback: function(){
                    var lis = $(this.element).next("ol").children();
                    lis.removeClass("on").eq(this.index).addClass("on");
                }
            });
        });
    </script>
<header>
    <div class="snower">
        <script type="text/javascript"></script>
    </div>
</header>

    <section>
    <nav>
            <ul class="nav_links box">
            <volist name="info" id="vo"> 
                <if condition="$i lt 5">
                    <li style="widows: 25%;">
                        <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
                            {pigcms{$vo.name}
                        </a>
                    </li>
                </if>
            </volist>
            </ul>
        </nav>
        <ul class="list_ul"">
        <volist name="info" id="vo"> 
        <if condition="$i gt 4">
        <li>
        <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
            <figure>
                <div style="background-image:url({pigcms{$vo.img});">&nbsp;</div>
            </figure>
            <figure>
                <span class="title">{pigcms{$vo.name}</span>
            </figure>
        </a>
        </li>
        </if>
        </volist>
        </ul>
    </section>  

<div class="js-footer homepage-footer" style="min-height: 1px;">
        <div class="footer">
<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
        </div>
    </div>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />
</body>
</html>