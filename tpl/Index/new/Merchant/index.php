<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$merchantarr['name']} - {pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
<script src="{pigcms{$static_path}js/navfix.js"></script>	
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link href="{pigcms{$static_path}css/table.css" type="text/css"  rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js" type="text/javascript"></script>
<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
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
</head>
<body>
<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<div class="article">
  <nav class="indexbanner"> <img src="{pigcms{$static_path}images/shop-shop_25.png" /> </nav>
  <section class="introduction">
    <div class="shop_introduction">
      <div class="section_title">
        <div class="section_txt">商家简介</div>
        <div class="section_border"><a href="{pigcms{$config.site_url}/merintroduce/{pigcms{$merid}.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="shop_introduction_txt">&nbsp;&nbsp;&nbsp;&nbsp;{pigcms{$merchantarr['txt_info']}<a href="{pigcms{$config.site_url}/merintroduce/{pigcms{$merid}.html#one0">　<span>[详细]</span> </a></div>
    </div>
    <div class="news_introduction">
      <div class="section_title">
        <div class="section_txt">新闻资讯</div>
        <div class="section_border"><a href="{pigcms{$config.site_url}/mernews/{pigcms{$merid}.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="news_list">
        <ul>
		 <volist name="introduce" id="nvv">
          <li><span><img src="{pigcms{$static_path}images/xiangqing_50.png" /></span><a href="{pigcms{$config.site_url}/newsdetail/{pigcms{$merid}.html?newsid={pigcms{$nvv['id']}">{pigcms{$nvv['title']}</a></li>
		  </volist>
        </ul>
      </div>
    </div>
    <div style="clear:both"></div>
  </section>
  <if condition="!empty($mimgs)">
  <section class="photo">
    <div class="section_title">
      <div class="section_txt">商家相册</div>
      <div class="section_border"><a href="{pigcms{$config.site_url}/mergallery/{pigcms{$merid}.html">更多>></a></div>
      <div  style="clear:both"></div>
    </div>
    <div class="shop_photo">
      <ul>
	    <volist name="mimgs" id="vo">
        <li><img src="{pigcms{$config.site_url}/{pigcms{$vo['imgstr']}" /></li>
		</volist>
      </ul>
    </div>
  </section>
  </if>
  <div class="shop_shop_list">
    <div class="shop_left">
      <section class="comment">
        <div class="section_title">
          <div class="section_txt">网友点评</div>
          <div class="section_border"><a href="/merreviews/{pigcms{$merid}.html">更多>></a></div>
          <div  style="clear:both"></div>
        </div>
        <div class="comment_table">
		<include file="merreview_index"/>
        </div>
      </section>
      <!--<section class="upcomment">
        <div class="section_title">
          <div class="section_txt">发表点评</div>
          <div class="section_border"><a href="#">更多>></a></div>
          <div  style="clear:both"></div>
        </div>
        <div class="shop_pingjia">
          <div class="shop_pinjiga_title">发表评价</div>
          <form action="" method="get">
            <div class="shop_pinjgia_form">
              <div class="shop_pingjia_form_list">
                <ul>
                  <li class="zong">总体评价:</li>
                  <li class="red">好评</li>
                  <li class="yellow">
                    <div class="pingjia_icon"><img src="images/dianpupingjia_10.png"></div>
                    <div class="pingjia_txt">中评</div>
                  </li>
                  <li class="gray">
                    <div class="pingjia_icon"> <img src="images/dianpupingjia_12.png"></div>
                    <div class="pingjia_txt">差评</div>
                  </li>
                  <li class="xing">
                    <div class="shop_pingjia_form_list_txt">星级</div>
                    <div class="shop_pingjia_form_list_icon"><span><img src="images/dianpupingjia_03.png"></span><span><img src="images/dianpupingjia_03.png"></span><span><img src="images/dianpupingjia_03.png"></span><span><img src="images/dianpupingjia_03.png"></span> <span><img src="images/dianpupingjia_05.png"></span></div>
                  </li>
                  <div style="clear:both"></div>
                </ul>
              </div>
              <div class="textarea">
                <textarea name="" cols="" rows="" class="form_textarea"></textarea>
              </div>
            </div>
            <div class="button">
              <div class="button_txt"><span>文明上网</span><span>礼貌发帖</span><span></span><span>0/300</span></div>
              <button class="form_button">提交</button>
              <div style="clear:both"></div>
            </div>
          </form>
        </div>
      </section>-->
    </div>
    <aside class="aside">
      <div class="aside_title">入驻时间： {pigcms{$merchantarr['reg_time']|date='Y-m-d H:i:s',###}</div>
      <div class="aside_num">
        <li>
          <p><span>{pigcms{$merchantarr['hits']}</span></p>
          <p>访问</p>
        </li>
        <li style="border:0">
          <p><span><a href="{pigcms{$config.site_url}/merreviews/{pigcms{$merchantarr['mer_id']}.html"><if condition="isset($reviews['count']) && ($reviews['count'] gt 0)">{pigcms{$reviews['count']}<else/>0</if></a></span></p>
          <p>评论</p>
        </li>
        <div style="clear:both"></div>
      </div>
	  <if condition="$collectid gt 0">
        <div class="aside_img2" onclick="Collect_This($(this),{pigcms{$collectid})">已收藏</div>
		<else/>
	    <div class="aside_img" onclick="Collect_This($(this),{pigcms{$collectid})">收藏商家</div>
	  </if>
      <div class="aside_fans">
        <div class="aside_fans_title"> 他的粉丝 <span>（{pigcms{$fans_count}）</span></div>
        <ul class="fans_li_img">
		  <if condition="!empty($fans_list)">
		  <volist name="fans_list" id="fv">
			<li><img src="{pigcms{$fv['avatar']}" alt="{pigcms{$fv['nickname']}" /><div>{pigcms{$fv['nickname']}</div></li>
		  </volist>
		  </if>
          <div style="clear:both"></div>
        </ul>
      </div>
	  <if condition="!empty($mer_front_center)">
      <div class="aside_shop">
        <div class="aside_shop_title">有好店铺</div>
        <ul class="ad_youhao">
		 
		  <volist name="mer_front_center" id="mad">
          <li><a href="{pigcms{$mad['url']}" title="{pigcms{$mad['name']}" target="_blank"><img src="{pigcms{$mad['pic']}"/></a></li>
		  </volist>
        </ul>
      </div>
	  </if>
    </aside>
    <div style="clear:both"></div>
  </div>
</div>
<include file="Public:footer"/>
</body>
 <script type="text/javascript">
 $('.fans_li_img li').hover(function(){
     $(this).find('div').show();
 },function(){
     $(this).find('div').hide();
 });
 var uid={pigcms{$uid};
 var merid={pigcms{$merid};
 var type='merchant_id';
 function Collect_This(obj,_id){
 $.post("{pigcms{:U('Index/Merchant/merCollect',array('merid'=>$merid))}",{uid:uid,merid:merid,id:_id},function(result){
    if(result.error){
	   alert(result.msg);
	}else{
	   alert(result.msg);
	   obj.text(result.msg1);
	   if(obj.hasClass('aside_img2')){
           obj.removeClass('aside_img2').addClass('aside_img');
	   }else{
	       obj.removeClass('aside_img').addClass('aside_img2');
	   }
	 }
   },'JSON');
 }

 </script>
</html>