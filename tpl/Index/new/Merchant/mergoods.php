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
<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
<script src="{pigcms{$static_path}js/navfix.js"></script>	
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css">
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/shop_goods.css">
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	   function mealshow(vv,obj){
		  vv=parseInt(vv);
		  	obj.parent('li').siblings().removeClass('selected');
			obj.parent('li').addClass('selected');
	     if(vv>0){
			 $('#meal_prolist li').removeClass('shown').hide();
             $('#meal_prolist .meal_'+vv).addClass('shown').show();
		 }else{
		    $('#meal_prolist li').addClass('shown').show();
		 }
		 if($('#meal_prolist .shown').size()>0){
			 $('#meal_none').hide();
		 }else{
		     $('#meal_none').show();
		 }
	   }
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
<!--<link rel="stylesheet" href="http://bdimg.share.baidu.com/static/api/css/share_style0_16.css?v=8105b07e.css" />-->
</head>
<body>

<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<article class="article"> 
  <div class="tab1" id="tab1">
    <div class="ny_zblb1 menu">
          <ul style="display:block;">
            <li <if condition="$sortid eq 0">class="selected"</if>>
			 <a onclick="mealshow(0,$(this));" href="javascript:;">
              <div class="ny_zblb1_txt">全部</div>
              <div class="ny_zblb1_icon">></div>
			  </a>
            </li>
			<volist name="mealmulu" id="mlu" key="kk">
            <li <if condition="$sortid eq $mlu['sort_id']">class="selected"</if>>
			  <a onclick="mealshow({pigcms{$mlu['sort_id']},$(this));" href="javascript:;">
              <div class="ny_zblb1_txt">{pigcms{$mlu['sort_name']}</div>
              <div class="ny_zblb1_icon">></div>
			  </a>
            </li>
			</volist>
          </ul>
    </div>
    <div class="menudiv">
      <div id="con_one_1"> 
        <!--  -->
        <div id="mealprolist">
          <div class="tab">
            <div class="tab_title"> <a href="/mergoods/{pigcms{$merid}.html#mealallprolist" <if condition="$ord eq 0">class="on"</if>>全部商品</a>
			<a href="/mergoods/{pigcms{$merid}/{pigcms{$sortid}.html?ord=1#mealallprolist" <if condition="$ord eq 1">class="on"</if>>按上架时间</a>
			<a href="/mergoods/{pigcms{$merid}/{pigcms{$sortid}.html?ord=2#mealallprolist" <if condition="$ord eq 2">class="on"</if>>按商品价格</a> </div>
            <div class="tab_form">
              <!--<form action="" method="get">
                <div class="order_form">
                  <div class="order_select">
                    <input name=""  class="order_input" type="text" />
                    <div class="order_select_txt">
                      <button class="order_select_txt">搜索</button>
                    </div>
                    <div  style="clear:both"></div>
                  </div>
                </div>
                <div  style="clear:both"></div>
              </form>-->
            </div>
          </div>
          <div class="content" id="meal_prolist">
                <div class="category_list">
				<if condition="!empty($meal_pro)">
                  <ul>
					  <volist name="meal_pro" id="pv" key="kk">
						<li <if condition="$kk%4 eq 0">class="last--even meal_{pigcms{$pv['sort_id']}" <else />class="meal_{pigcms{$pv['sort_id']}" </if>>
						  
						  <a class="category_list_img" href="/meal/{pigcms{$mstoreid}.html#meal_{pigcms{$pv['meal_id']}" target="_blank">
						  <img src="{pigcms{$pv['image']}" class="proimg"/>

						  <div class="datal">
							<div class="category_list_title">{pigcms{$pv['name']}</div>
							<div class="deal-tile__detail"><span id="price">&yen;<strong>{pigcms{$pv['price']}</strong> </span>
							  <div  style="clear:both"></div>
							</div>
							<div  style="clear:both"></div>
							<!--<div class="extra-inner">
							  <div class="sales"></div >
							  <div  class="noreviews"> <span>添加到购物车</span></div >
							</div>-->
						  </div>
						   </a>
						</li>
					</volist>
					 </ul>
					 <else />
					 <div style="margin-top:10px;font-size:16px">店铺暂时未发布商品</div>
					</if>
				<div id="meal_none" style="margin-top:10px;font-size:16px" style="display:none;">该分类下没有商品！</div>
          </div>
        </div>

        <!-- 代码部分end --> 
        <!--  --> 
      </div>
    </div>
	 <!--{pigcms{$pagebar}--->
    <div  style="clear:both"></div>
  </div>
</article>    
 <div  style="clear:both"></div>
<include file="Public:footer"/>
</body>
</html>