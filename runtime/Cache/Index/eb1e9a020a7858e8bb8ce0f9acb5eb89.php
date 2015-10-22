<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo ($merchantarr['name']); ?> - <?php echo ($config["seo_title"]); ?></title>
<meta name="keywords" content="<?php echo ($config["seo_keywords"]); ?>" />
<meta name="description" content="<?php echo ($config["seo_description"]); ?>" />
<link href="<?php echo ($static_path); ?>css/shop.css" type="text/css" rel="stylesheet">
<link href="<?php echo ($static_path); ?>css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="<?php echo ($static_path); ?>js/jquery-1.7.2.js"></script>
<script src="<?php echo ($static_path); ?>js/jquery.nav.js"></script>
<script src="<?php echo ($static_path); ?>js/navfix.js"></script>	
<link rel="stylesheet" href="<?php echo ($static_path); ?>css/shop_shop.css">
<link href="<?php echo ($static_path); ?>css/table.css" type="text/css"  rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="<?php echo ($static_path); ?>css/footer.css">
	<script type="text/javascript">
	   var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
	</script>
<script src="<?php echo ($static_path); ?>js/common.js" type="text/javascript"></script>
<!--[if IE 6]>
<script  src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js" mce_src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a.js"></script>
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
<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<?php if(empty($user_session)): ?><div class="login"><a href="<?php echo U('Index/Login/index');?>"> 登陆 </a></div>
				<div class="regist"><a href="<?php echo U('Index/Login/reg');?>">注册 </a></div>
			<?php else: ?>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="<?php echo U('User/Index/index');?>" class="username"><?php echo ($user_session["nickname"]); ?></a>
					</span>
					<a class="user-info__logout" href="<?php echo U('Index/Login/logout');?>">退出</a>
				</p><?php endif; ?>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="<?php echo ($config["site_url"]); ?>/topic/weixin.html" target="_blank">访问微信版</a></p><img src="<?php echo ($config["wechat_qrcode"]); ?>"/></div>
			</div>
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="<?php echo U('User/Index/index');?>">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="<?php echo U('User/Index/index');?>">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Index/index');?>">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Rates/index');?>">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Collect/index');?>">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Point/index');?>">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Credit/index');?>">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo U('User/Adress/index');?>">收货地址</a></li>
						</ul>
					</div>
					<div class="span">|</div>
				</li>
				<li class="li_liulan">
					<div class="li_liulan_txt"><a href="#">最近浏览</a></div>	 
					<div class="history" id="J-my-history-menu"></div> 
					<div class="span">|</div>
				</li>
				<li class="li_shop">
					<div class="li_shop_txt"><a href="#">我是商家</a></div>
					<ul class="li_txt_info_ul cf">
						<li><a class="dropdown-menu__item first" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="<?php echo ($config["site_url"]); ?>/merchant.php">我想合作</a></li>
					</ul>
				</li>
			</ul>
        </div>
    </div>
</div>
<header class="header cf">
	<div style="border-bottom: 1px solid #d9d9d9;">
		<div class="nav cf">
			<div class="logo">
				<a href="<?php echo ($config["site_url"]); ?>" title="<?php echo ($config["site_name"]); ?>">
					<img  src="<?php echo ($config["site_logo"]); ?>" />
				</a>
			</div>
			<div class="search">
				<form action="<?php echo U('Group/Search/index');?>" method="post" group_action="<?php echo U('Group/Search/index');?>" meal_action="<?php echo U('Meal/Search/index');?>">
					<div class="form_sec">
					<div class="form_sec_txt meal"><?php echo ($config["meal_alias_name"]); ?></div>
					<div class="form_sec_txt1 group"><?php echo ($config["group_alias_name"]); ?></div>
					</div>
					<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
					<button value="" class="btnclick"><img src="<?php echo ($static_path); ?>images/o2o1_20.png"  /></button>
				</form>
				<div class="search_txt">
					<?php if(is_array($search_hot_list)): $i = 0; $__LIST__ = $search_hot_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="menu">
				<div class="ment_left">
				  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_13.png" /></div>
				  <div class="ment_left_txt">随时退</div>
				</div>
				<div class="ment_left">
				  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_15.png" /></div>
				  <div class="ment_left_txt">不满意免单</div>
				</div>
				<div class="ment_left">
				  <div class="ment_left_img"><img src="<?php echo ($static_path); ?>images/o2o1_17.png" /></div>
				  <div class="ment_left_txt">过期退</div>
				</div>
			</div>
		</div>
    </div>
</header>


<div class="w-1200">
  <div class="grid_subHead clearfix">
    <div class="col_main">
      <div class="col_sub">
        <div class="shop_logo"> <!-- -->
         <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/index-slider.v7062a8fb.css"/>
  
 <script type="text/javascript">
$(function(){
 
	//最新团购
	var component_slider_timer = null;
	function component_slider_play(){
		component_slider_timer = window.setInterval(function(){
			var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index();
			if(slider_index == $('.component-index-slider .mt-slider-trigger-container li').size() - 1){
				slider_index = 0;
			}else{
				slider_index++;
			}
			$('.component-index-slider .content li').eq(slider_index).css({'opacity':'0','display':'block'}).animate({opacity:1},600).siblings().hide();
			$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
		},3400);
	}
	component_slider_play();
	$('.component-index-slider').hover(function(){
		window.clearInterval(component_slider_timer);
		$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').css({'opacity':'0.6'}).show();
	},function(){
		window.clearInterval(component_slider_timer);
		component_slider_play();
		$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').css({'opacity':'0'}).hide();
	});
	$('.component-index-slider .mt-slider-previous,.component-index-slider .mt-slider-next').hover(function(){
		$(this).css({'opacity':'1'});
	});
	$('.component-index-slider .mt-slider-trigger-container li').click(function(){
		if($(this).hasClass('mt-slider-current-trigger')){
			return false;
		}
		var slider_index = $(this).index();
		$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
		$(this).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
	$('.component-index-slider .mt-slider-previous').click(function(){
		var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index()-1;
		if(slider_index < 0){
			slider_index = $('.component-index-slider .mt-slider-trigger-container li').size()-1;
		}
		$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
		$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
	$('.component-index-slider .mt-slider-next').click(function(){
		var slider_index = $('.component-index-slider .mt-slider-trigger-container li.mt-slider-current-trigger').index()+1;
		if(slider_index == $('.component-index-slider .mt-slider-trigger-container li').size()){
			slider_index = 0;
		}
		$('.component-index-slider .content li').eq(slider_index).show().siblings().hide();
		$('.component-index-slider .mt-slider-trigger-container li').eq(slider_index).addClass('mt-slider-current-trigger').siblings().removeClass('mt-slider-current-trigger');
	});
 
 });
		
	
	/*var cookie=optCookie('view_hits');
	//if(!cookie){
	    //optCookie('view_hits',1,1);*/
	    $.post("<?php echo U('Index/Merchant/merupview',array('merid'=>$merid));?>",{uid:<?php echo ($uid); ?>,merid:<?php echo ($merid); ?>},function(ret){ },'JSON');
	//}
  	/********** 操作cookie ******
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
			return false;
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
**/
</script>
                  <div class="content__cell content__cell--slider" style=" width:300px;">
            <div class="component-index-slider">
                      <div class="index-slider ui-slider log-mod-viewed">
                <div class="pre-next"> <a style="opacity: 0; display: none;" href="javascript:;" hidefocus="true" class="mt-slider-previous sp-slide--previous"></a> <a style="opacity: 0; display: none;" href="javascript:;" hidefocus="true" class="mt-slider-next sp-slide--next"></a> </div>
                <div class="head ccf">
                    <ul class="trigger-container ui-slider__triggers mt-slider-trigger-container">
					<?php if($merchantarr['imgscount'] > 1): $imgscount=$merchantarr['imgscount']-1; for($i=0;$i<$imgscount;$i++){ echo '<li class="mt-slider-trigger"></li>'; } endif; ?>
                    <li class="mt-slider-trigger mt-slider-current-trigger"></li>
                    <div style="clear:both"></div>
                  </ul>
                   </div>
                <ul class="content">
				  <?php if(!empty($merchantarr['imgs'])): if(is_array($merchantarr['imgs'])): $i = 0; $__LIST__ = $merchantarr['imgs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgvo): $mod = ($i % 2 );++$i;?><li class="cf" <?php if($key == 0): ?>style="opacity: 1; display: block;" <?php else: ?>style="opacity: 1; display: none;"<?php endif; ?>> <img src="<?php echo ($imgvo); ?>"> </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                </div>
              </div>
            </div>
                  
       </div>
      </div>
      <div class="main_wrap">
        <div class="mian_wrap_shop">
          <div class="shop_name"><?php echo ($merchantarr['name']); ?></div>
          <div class="shop_icon_shop">
		  <?php if($merchantarr['issign'] == 1): ?><span><img src="<?php echo ($static_path); ?>images/shop-shop_03.png"></span><?php endif; ?>
		  <?php if($merchantarr['isverify'] == 1): ?><span><img src="<?php echo ($static_path); ?>images/shop-shop_05.png"></span><?php endif; ?>
		  </div>
			<div class="shop_icon_xing">
			  <div>
				<span style="width:<?php echo ($star/5*100); ?>%;"></span>
			  </div>
			</div>
          <span class="i_star i_star_3">3星</span><span class="i_qianyue display11">签约商家</span>
          <p></p>
        </div>
        <div class="main_wrap_left">
          <p class="shop_address">地址：<?php echo ($merchantmstore['areastr']); ?> - <?php echo ($merchantmstore['adress']); ?></p>
          <div class="shop_list_li">
            <ul>
              <li>交通路线：<?php echo ($merchantmstore['trafficroute']); ?></li>
              <?php if(!empty($merchantmstore['office_time'])): ?><li>营业时间：<?php echo ($merchantmstore['office_time']); ?></li><?php endif; ?>
              <li>本店特色：<?php echo ($merchantmstore['feature']); ?></li>
              <li>人均消费：<span><?php echo ($merchantmstore['permoney']); ?>元</span></li>
              <!--<li>会员折扣：6折 <span><u><a href="###" class="hs">[申请会员]</a></u></span></li>-->
              <div style="clear:both"></div>
            </ul>
          </div>
          <div class="shop_icon">
            <ul>
              <li>
                <div class="shop_icon_img"><img src="<?php echo ($static_path); ?>images/shop-shop_14.png"></div>
                <div class="shop_icon_img"><?php echo ($merchantmstore['phone']); ?></div>
              </li>
			  <?php if(!empty($merchantmstore['weixin'])): ?><li>
                <div class="shop_icon_img"><img src="<?php echo ($static_path); ?>images/shop-shop_17.png"></div>
                <div class="shop_icon_img"><?php echo ($merchantmstore['weixin']); ?></div>
              </li><?php endif; ?>
			  <?php if(!empty($merchantmstore['qq'])): ?><li>
                <div class="shop_icon_img"><img src="<?php echo ($static_path); ?>images/shop-shop_19.png"></div>
                <div class="shop_icon_img"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($merchantmstore['qq']); ?>&site=qq&menu=yes" target="_blank"><?php echo ($merchantmstore['qq']); ?></a></div>
              </li><?php endif; ?>
              <div style="clear:both"></div>
            </ul>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
    </div>
    <div class="mobile_href po_ab">
      <div class="mobile_href_img"><img src="<?php echo U('Index/Recognition/see_qrcode',array('type'=>'merchant','id'=>$merid));?>" width="150" height="150" alt=""/>
        <p>手机访问</p>
        <p></p>
      </div>
      <div style="clear:both"></div>
      <div class="shop_activity">
        <div class="shop_activity_icon"><img src="<?php echo ($static_path); ?>images/shop-shop_10.png"/></div>
        <div class="shop_activity_title"><a href="###" class="hs">同城活动</a></div>
        <?php if(!empty($mstore_meal) && ($mstore_meal['send_time'] > 0)): ?><div class="shop_activity_txt">本店开通了外送服务，最快<?php echo ($mstore_meal['send_time']); ?>分钟为您送达</div><?php else: ?><div class="shop_activity_txt" style="font-size: 12px;line-height: 22px;">欢迎光临<strong><?php echo ($merchantarr['name']); ?></strong>商家中心,您的认可是对我们最好的鼓励。</div><?php endif; ?>
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  <div style=" clear:both"></div>
  <div style=" clear:both"></div>
</div>
<menu class="shop_menu">
  <div class="box_menu" id="mealallprolist">
    <ul>
      <li <?php if($isindex): ?>class="crun"<?php endif; ?>><a href="<?php echo ($config["site_url"]); ?>/merindex/<?php echo ($merid); ?>.html">首页</a></li>
	  <?php if(is_array($navmanag)): $i = 0; $__LIST__ = $navmanag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nv): $mod = ($i % 2 );++$i;?><li <?php if($nv['currenturl']): ?>class="crun"<?php endif; ?>><a href="<?php echo ($config["site_url"]); ?>/<?php echo ($nv['url']); ?>/<?php echo ($merid); ?>.html"><?php echo ($nv['zhname']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>
<!---<menu class="shop_menu">
  <div class="box_menu">
    <ul>
      <li class="crun"><a href="shop_shop.html">首页</a></li>
      <li><a href="shop_introduction.html">商家介绍</a></li>
      <li><a href="shop_dynamics.html">商家动态 </a></li>
      <li><a href="shop_photo.html">商家相册</a></li>
      <li><a href="shop_video.html">全景视频 </a></li>
      <li><a href="shop_goods.html">商品大全</a></li>
      <li><a href="shop_activity.html"><?php echo ($config["group_alias_name"]); ?>活动 </a></li>
      <li><a href="shop_server.html">客户服务</a></li>
      <li><a href="shop_jion.html">招商加盟</a></li>
      <li><a href="shop_comment.html">网友点评</a></li>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>--->
<div class="article">
  <nav class="indexbanner"> <img src="<?php echo ($static_path); ?>images/shop-shop_25.png" /> </nav>
  <section class="introduction">
    <div class="shop_introduction">
      <div class="section_title">
        <div class="section_txt">商家简介</div>
        <div class="section_border"><a href="<?php echo ($config["site_url"]); ?>/merintroduce/<?php echo ($merid); ?>.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="shop_introduction_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($merchantarr['txt_info']); ?><a href="<?php echo ($config["site_url"]); ?>/merintroduce/<?php echo ($merid); ?>.html#one0">　<span>[详细]</span> </a></div>
    </div>
    <div class="news_introduction">
      <div class="section_title">
        <div class="section_txt">新闻资讯</div>
        <div class="section_border"><a href="<?php echo ($config["site_url"]); ?>/mernews/<?php echo ($merid); ?>.html">更多>></a></div>
        <div  style="clear:both"></div>
      </div>
      <div class="news_list">
        <ul>
		 <?php if(is_array($introduce)): $i = 0; $__LIST__ = $introduce;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nvv): $mod = ($i % 2 );++$i;?><li><span><img src="<?php echo ($static_path); ?>images/xiangqing_50.png" /></span><a href="<?php echo ($config["site_url"]); ?>/newsdetail/<?php echo ($merid); ?>.html?newsid=<?php echo ($nvv['id']); ?>"><?php echo ($nvv['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
    <div style="clear:both"></div>
  </section>
  <?php if(!empty($mimgs)): ?><section class="photo">
    <div class="section_title">
      <div class="section_txt">商家相册</div>
      <div class="section_border"><a href="<?php echo ($config["site_url"]); ?>/mergallery/<?php echo ($merid); ?>.html">更多>></a></div>
      <div  style="clear:both"></div>
    </div>
    <div class="shop_photo">
      <ul>
	    <?php if(is_array($mimgs)): $i = 0; $__LIST__ = $mimgs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($config["site_url"]); ?>/<?php echo ($vo['imgstr']); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
  </section><?php endif; ?>
  <div class="shop_shop_list">
    <div class="shop_left">
      <section class="comment">
        <div class="section_title">
          <div class="section_txt">网友点评</div>
          <div class="section_border"><a href="/merreviews/<?php echo ($merid); ?>.html">更多>></a></div>
          <div  style="clear:both"></div>
        </div>
        <div class="comment_table">
		<div class="zzsc">
	<div class="tab">
		<div class="tab_title">
			<a href="/merreviews/<?php echo ($merid); ?>.html" class="on" target="_blank">全部</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=1" target="_blank">好评</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=2" target="_blank">中评</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=3" target="_blank">差评</a>
			<a href="/merreviews/<?php echo ($merid); ?>.html?st=4" target="_blank">有图</a>
		</div>
	</div>
	<div class="content">
		<div class="appraise_li-list">
	        <dl>
				<?php if(!empty($reviews['list'])): if(is_array($reviews['list'])): $i = 0; $__LIST__ = $reviews['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rv): $mod = ($i % 2 );++$i;?><dd>
							<div class="appraise_li-list_img">
                                <div class="appraise_li-list_icon"><img src="<?php echo ($rv['avatar']); ?>"></div>
								<p><?php echo ($rv['nickname']); ?></p>
                            </div>
							<div class="appraise_li-list_right cf">
                                <div class="appraise_li-list_top cf">
                                    <div class="appraise_li-list_top_icon">
										<div><span style="width:<?php echo ($rv['score']/5*100); ?>%;"></span></div>
									</div>
                                    <div class="appraise_li-list_data"><?php echo ($rv['add_time']); ?></div>
                                </div>
                                <div class="appraise_li-list_txt"><?php echo ($rv['comment']); ?></div>
								<?php if(!empty($rv['pics'])): ?><div class="pic-list J-piclist-wrapper">
									<div class="J-pic-thumbnails pic-thumbnails">
									<ul class="pic-thumbnail-list widget-carousel-indicator-list">
									<?php if(is_array($rv['pics'])): $i = 0; $__LIST__ = $rv['pics'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgs): $mod = ($i % 2 );++$i;?><li big-src="<?php echo ($imgs['image']); ?>" m-src="<?php echo ($imgs['m_image']); ?>">
									  <a hidefocus="true" href="#" class="pic-thumbnail"><img src="<?php echo ($imgs['s_image']); ?>"></a>
									  </li><?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
									 </div>
									 </div><?php endif; ?>
                            </div>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
					<dd>暂无评论</dd><?php endif; ?>
            </dl>
		</div>
	</div>
  </div>
<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
  <script type="text/javascript">
		$('.J-piclist-wrapper li a').live('click',function(){
		var m_src = $(this).closest('li').attr('m-src');
		var big_src = $(this).closest('li').attr('big-src');
		window.art.dialog({
			title: '查看图片',
			lock: true,
			fixed: true,
			opacity: '0.4',
			resize: false,
			left: '50%',
			top: '38.2%',
			content:'<a href="'+big_src+'" target="_blank" title="新窗口打开查看原图"><img src="'+m_src+'" alt="大图"/></a>',
			close: null
		});
		return false;
	});
</script>
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
      <div class="aside_title">入驻时间： <?php echo (date('Y-m-d H:i:s',$merchantarr['reg_time'])); ?></div>
      <div class="aside_num">
        <li>
          <p><span><?php echo ($merchantarr['hits']); ?></span></p>
          <p>访问</p>
        </li>
        <li style="border:0">
          <p><span><a href="<?php echo ($config["site_url"]); ?>/merreviews/<?php echo ($merchantarr['mer_id']); ?>.html"><?php if(isset($reviews['count']) && ($reviews['count'] > 0)): echo ($reviews['count']); else: ?>0<?php endif; ?></a></span></p>
          <p>评论</p>
        </li>
        <div style="clear:both"></div>
      </div>
	  <?php if($collectid > 0): ?><div class="aside_img2" onclick="Collect_This($(this),<?php echo ($collectid); ?>)">已收藏</div>
		<?php else: ?>
	    <div class="aside_img" onclick="Collect_This($(this),<?php echo ($collectid); ?>)">收藏商家</div><?php endif; ?>
      <div class="aside_fans">
        <div class="aside_fans_title"> 他的粉丝 <span>（<?php echo ($fans_count); ?>）</span></div>
        <ul class="fans_li_img">
		  <?php if(!empty($fans_list)): if(is_array($fans_list)): $i = 0; $__LIST__ = $fans_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fv): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($fv['avatar']); ?>" alt="<?php echo ($fv['nickname']); ?>" /><div><?php echo ($fv['nickname']); ?></div></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
          <div style="clear:both"></div>
        </ul>
      </div>
	  <?php if(!empty($mer_front_center)): ?><div class="aside_shop">
        <div class="aside_shop_title">有好店铺</div>
        <ul class="ad_youhao">
		 
		  <?php if(is_array($mer_front_center)): $i = 0; $__LIST__ = $mer_front_center;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mad): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($mad['url']); ?>" title="<?php echo ($mad['name']); ?>" target="_blank"><img src="<?php echo ($mad['pic']); ?>"/></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div><?php endif; ?>
    </aside>
    <div style="clear:both"></div>
  </div>
</div>
<footer>
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead">
		<ul>
			<li>
				<a href="javascript:void(0)" class="wechat">
					<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
					<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
					<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
				</a>
			</li>
			<?php if($config['site_qq']): ?><li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
						<div class="hides qq_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
							<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<?php if($config['site_phone']): ?><li>
					<a href="javascript:void(0)" class="tel">
						<div class="hides tel_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
							<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<li>
				<a class="top_btn">
					<div class="hides btn_div">
						<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
					</div>
					<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div><?php endif; ?>
<!--leftsead end-->
</body>
 <script type="text/javascript">
 $('.fans_li_img li').hover(function(){
     $(this).find('div').show();
 },function(){
     $(this).find('div').hide();
 });
 var uid=<?php echo ($uid); ?>;
 var merid=<?php echo ($merid); ?>;
 var type='merchant_id';
 function Collect_This(obj,_id){
 $.post("<?php echo U('Index/Merchant/merCollect',array('merid'=>$merid));?>",{uid:uid,merid:merid,id:_id},function(result){
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