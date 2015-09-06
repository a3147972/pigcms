<!DOCTYPE html>
<html>    
<head>
<if condition="$zd['status'] eq 1">{pigcms{$zd['code']} </if>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{pigcms{$tpl.wxname}</title>
<base href="." />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/125/pigcms-ui-1-1.css" media="all">
<!-- <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/125/home-0.css" media="all"> -->
<link href="{pigcms{$static_path}css/allcss/cate25_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{pigcms{$static_path}css/125/maivl.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/116/jQuery.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/125/swipe.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/125/zepto.js"></script>
</head>


<body onselectstart="return true;" ondragstart="return false;">
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
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/125/font-awesome.css" media="all">

<div class="pigcms-page" style="display:block; ">
    <div style="-webkit-transform:translate3d(0,0,0);">
        <div id="banner_box" class="box_swipe" style="visibility: visible;margin-top:-17px;">
            <ul style="list-style: none; transition: 500ms; -webkit-transition: 500ms; -webkit-transform: translate3d(0, 0, 0);">
            <volist name="flash" id="so">
                    <li style="vertical-align: top;margin:auto">
                            <a href="{pigcms{$so.url}">
                                <img src="{pigcms{$so.img}" style="width:100%;">
                            </a>
                    </li>
            </volist>
                                   
            </ul>
            <ol>
                <volist name="flash" id="so">
                    <li <if condition="$i eq 1">class="on"</if>></li>
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
    </header>             <!--
        用户分类管理
        -->
        <div class="pigcms-content">
            <div class="pigcms-list">
                <volist name="info" id="vo">
                            <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>" class="pigcms-list-item">
                            <div class="pigcms-list-item-bg">
                            <div>
                                <img src="{pigcms{$vo.img}" alt="{pigcms{$vo.name}" style="width:100%;">
                            </div>
                            <div class="pigcms-list-item-box">
                                <div class="pigcms-list-item-line">
                                    <div class="pigcms-list-item-title">{pigcms{$vo.name}</div>
                                </div>
                            </div>
                        </div>
                      </a>
                      </volist>                                      

                            </div>
        </div>
        

                    
    </div>

<if condition="$homeInfo['copyright']">
<div class="copyright" style="text-align:center;padding:10px 0">{pigcms{$homeInfo.copyright}</div> 
</if>
 <include file="Index:styleInclude"/>
 <include file="$cateMenuFileName"/>  
<!-- share -->
<include file="Index:share" />
</body></html>