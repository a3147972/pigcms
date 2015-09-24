<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>
    <meta charset="UTF-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="HandheldFriendly" content="True">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="cleartype" content="on">
    <title>{pigcms{$tpl.wxname}</title>
      
    <link rel="stylesheet" href="{pigcms{$static_path}tpl/1330/css/cate.css" />
    
    <style>
            body {
			<volist name="flashbg" id="so" offset="0" length="1"> 
                background-image: url({pigcms{$so.img});
			</volist>
                background-position: center top;
                background-repeat: no-repeat;
                background-size: 100% auto;
                background-size: cover;
            }

            #global-cart {
                display: none;
            }
        </style>
 
  <script type="text/javascript">
    var _global = {
    "fans_id": 0,
}; 

	_global.spm = {logType:"h"};	
    </script>

</head>
<body class="with-dark-footer">


<div class="container ">
	<div class="content js-mini-height">

													
			
		<div id="wxdesc" class="tpl-fbb tpl-course">
			<div class="swiper-container js-tpl-fbb">
				<div class="swiper-wrapper clearfix">
				<volist name="info" id="vo">
					<div class="swiper-slide tpl-fbb-item">
						<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
							<div class="tpl-fbb-item-wrap">
								<div class="tpl-fbb-item-name">{pigcms{$vo.name|mb_substr=###,0,5,'utf-8'}</div>
								<div class="tpl-fbb-item-line"></div>
								<div class="tpl-fbb-item-icon">
									<img src="{pigcms{$vo.img}" width="30" height="30" />
								</div>
							</div>
						</a>
					</div>
				</volist>		
							
				</div>
			</div>
		</div>
		<div class="content-sidebar"></div>
	</div>
<!--	footer	-->
	<div class="js-footer homepage-footer" style="min-height: 1px;">
		<div class="footer">
<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
		</div>
	</div>

</div>



<script src="{pigcms{$static_path}tpl/1330/js/jquery-2.0.3.min.js" ></script>
<script src="{pigcms{$static_path}tpl/1330/js/underscore-min.js"></script>
<script src="{pigcms{$static_path}tpl/1330/js/idangerous.swiper-2.4.1.min.js" ></script>
<script src="{pigcms{$static_path}tpl/1330/js/base_cb3ed940fb.js"></script>
<script src="{pigcms{$static_path}tpl/1330/js/wap_8c2dc40dcf.js" ></script>


<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />
</body>
</html>