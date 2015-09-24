<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
			<if condition="empty($user_session)">
				<div class="login"><a href="{pigcms{:U('Index/Login/index')}"> 登陆 </a></div>
				<div class="regist"><a href="{pigcms{:U('Index/Login/reg')}">注册 </a></div>
			<else/>
				<p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
					</span>
					<a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
				</p>
			</if>
			<div class="span">|</div>
			<div class="weixin cf">
				<div class="weixin_txt"><a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank"> 微信版</a></div>
				<div class="weixin_icon"><p><span>|</span><a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank">访问微信版</a></p><img src="{pigcms{$config.wechat_qrcode}"/></div>
			</div>
        </div>
        <div class="list">
			<ul class="cf">
				<li>
					<div class="li_txt"><a href="{pigcms{:U('User/Index/index')}">我的订单</a></div>
					<div class="span">|</div>
				</li>
				<li class="li_txt_info cf">
					<div class="li_txt_info_txt"><a href="{pigcms{:U('User/Index/index')}">我的信息</a></div>
					<div class="li_txt_info_ul">
						<ul class="cf">
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Index/index')}">我的订单</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Rates/index')}">我的评价</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Collect/index')}">我的收藏</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Point/index')}">我的积分</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Credit/index')}">帐户余额</a></li>
							<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Adress/index')}">收货地址</a></li>
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
						<li><a class="dropdown-menu__item first" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">商家中心</a></li>
						<li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">我想合作</a></li>
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
				<a href="{pigcms{$config.site_url}" title="{pigcms{$config.site_name}">
					<img  src="{pigcms{$config.site_logo}" />
				</a>
			</div>
			<div class="search">
				<form action="{pigcms{:U('Group/Search/index')}" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
					<div class="form_sec">
					<div class="form_sec_txt meal">{pigcms{$config.meal_alias_name}</div>
					<div class="form_sec_txt1 group">{pigcms{$config.group_alias_name}</div>
					</div>
					<input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
					<button value="" class="btnclick"><img src="{pigcms{$static_path}images/o2o1_20.png"  /></button>
				</form>
				<div class="search_txt">
					<volist name="search_hot_list" id="vo">
						<a href="{pigcms{$vo.url}"><span>{pigcms{$vo.name}</span></a>
					</volist>
				</div>
			</div>
			<div class="menu">
				<div class="ment_left">
				  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_13.png" /></div>
				  <div class="ment_left_txt">随时退</div>
				</div>
				<div class="ment_left">
				  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_15.png" /></div>
				  <div class="ment_left_txt">不满意免单</div>
				</div>
				<div class="ment_left">
				  <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_17.png" /></div>
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
         <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index-slider.v7062a8fb.css"/>
  
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
	    $.post("{pigcms{:U('Index/Merchant/merupview',array('merid'=>$merid))}",{uid:{pigcms{$uid},merid:{pigcms{$merid}},function(ret){ },'JSON');
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
					<if condition="$merchantarr['imgscount'] gt 1">
					<php>$imgscount=$merchantarr['imgscount']-1;
					  for($i=0;$i<$imgscount;$i++){
					      echo '<li class="mt-slider-trigger"></li>';
					  }
					</php>
					</if>
                    <li class="mt-slider-trigger mt-slider-current-trigger"></li>
                    <div style="clear:both"></div>
                  </ul>
                   </div>
                <ul class="content">
				  <if condition="!empty($merchantarr['imgs'])">
				      <volist name="merchantarr['imgs']" id="imgvo">
                          <li class="cf" <if condition="$key eq 0">style="opacity: 1; display: block;" <else/>style="opacity: 1; display: none;"</if>> <img src="{pigcms{$imgvo}"> </li>
						 </volist>
					  </if>
                    </ul>
                </div>
              </div>
            </div>
                  
       </div>
      </div>
      <div class="main_wrap">
        <div class="mian_wrap_shop">
          <div class="shop_name">{pigcms{$merchantarr['name']}</div>
          <div class="shop_icon_shop">
		  <if condition="$merchantarr['issign'] eq 1">
		  <span><img src="{pigcms{$static_path}images/shop-shop_03.png"></span>
		  </if>
		  <if condition="$merchantarr['isverify'] eq 1">
		  <span><img src="{pigcms{$static_path}images/shop-shop_05.png"></span>
		  </if>
		  </div>
			<div class="shop_icon_xing">
			  <div>
				<span style="width:{pigcms{$star/5*100}%;"></span>
			  </div>
			</div>
          <span class="i_star i_star_3">3星</span><span class="i_qianyue display11">签约商家</span>
          <p></p>
        </div>
        <div class="main_wrap_left">
          <p class="shop_address">地址：{pigcms{$merchantmstore['areastr']} - {pigcms{$merchantmstore['adress']}</p>
          <div class="shop_list_li">
            <ul>
              <li>交通路线：{pigcms{$merchantmstore['trafficroute']}</li>
              <if condition="!empty($merchantmstore['office_time'])"><li>营业时间：{pigcms{$merchantmstore['office_time']}</li></if>
              <li>本店特色：{pigcms{$merchantmstore['feature']}</li>
              <li>人均消费：<span>{pigcms{$merchantmstore['permoney']}元</span></li>
              <!--<li>会员折扣：6折 <span><u><a href="###" class="hs">[申请会员]</a></u></span></li>-->
              <div style="clear:both"></div>
            </ul>
          </div>
          <div class="shop_icon">
            <ul>
              <li>
                <div class="shop_icon_img"><img src="{pigcms{$static_path}images/shop-shop_14.png"></div>
                <div class="shop_icon_img">{pigcms{$merchantmstore['phone']}</div>
              </li>
			  <if condition="!empty($merchantmstore['weixin'])">
              <li>
                <div class="shop_icon_img"><img src="{pigcms{$static_path}images/shop-shop_17.png"></div>
                <div class="shop_icon_img">{pigcms{$merchantmstore['weixin']}</div>
              </li>
			  </if>
			  <if condition="!empty($merchantmstore['qq'])">
              <li>
                <div class="shop_icon_img"><img src="{pigcms{$static_path}images/shop-shop_19.png"></div>
                <div class="shop_icon_img"><a href="http://wpa.qq.com/msgrd?v=3&uin={pigcms{$merchantmstore['qq']}&site=qq&menu=yes" target="_blank">{pigcms{$merchantmstore['qq']}</a></div>
              </li>
			  </if>
              <div style="clear:both"></div>
            </ul>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
    </div>
    <div class="mobile_href po_ab">
      <div class="mobile_href_img"><img src="{pigcms{:U('Index/Recognition/see_qrcode',array('type'=>'merchant','id'=>$merid))}" width="150" height="150" alt=""/>
        <p>手机访问</p>
        <p></p>
      </div>
      <div style="clear:both"></div>
      <div class="shop_activity">
        <div class="shop_activity_icon"><img src="{pigcms{$static_path}images/shop-shop_10.png"/></div>
        <div class="shop_activity_title"><a href="###" class="hs">同城活动</a></div>
        <if condition="!empty($mstore_meal) && ($mstore_meal['send_time'] gt 0)"><div class="shop_activity_txt">本店开通了外送服务，最快{pigcms{$mstore_meal['send_time']}分钟为您送达</div><else/><div class="shop_activity_txt" style="font-size: 12px;line-height: 22px;">欢迎光临<strong>{pigcms{$merchantarr['name']}</strong>商家中心,您的认可是对我们最好的鼓励。</div></if>
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  <div style=" clear:both"></div>
  <div style=" clear:both"></div>
</div>