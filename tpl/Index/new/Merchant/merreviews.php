<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns=" http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title>{pigcms{$config.seo_title}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/shop_shop_header.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_path}js/jquery.nav.js"></script>
<script src="{pigcms{$static_path}js/navfix.js"></script>	
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_shop.css">
<link href="{pigcms{$static_path}css/shop.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="{pigcms{$static_path}css/shop_introduction.css"/>
<link type="text/css" rel="stylesheet" href="{pigcms{$static_path}css/footer.css"/>
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
    body{ behavior:url("csshover.htc"); }
</style>
<![endif]-->
</head>
<body>
<include file="Public:shop_header"/>
<include file="Public:shop_menu"/>
<div class="article">
  <section class="server">
    <div class="section_title">
      <div class="section_txt">网友点评</div>
      <div class="section_border"> </div>
      <div style="clear:both"></div>
    </div>  
  </section>
  <section>
            <div style="clear:both"></div>
            <article class="shop_content">
              <div class="content_left">
                <section class="appraise">
                  <div class="appraise_list">
                    <div class="appraise_title">
						<ul class="cf">
							<li class="pingfen">
							  <div class="ping"><span>{pigcms{$star}</span> 分</div>
							  <div class="appraise_icon"><div><span style="width:{pigcms{$star/5*100}%;"></span></div></div>
							</li>
							<li class="pingjia">共 <span>{pigcms{$reviews['count']}</span> 次评价</li>
							<li class="pinglun">
								<a class="fabiao" href="{pigcms{:U('User/Rates/index')}">
									<div>
										<img src="{pigcms{$static_path}images/xiangqing_54.png"/>
										<p>发表评论</p>
									</div>
								</a>
							</li>
						</ul>
                    </div>
                    <div class="appraise_li">
                      <section> 
                        
                        <!-- 代码部分begin -->
                        <div class="zzsc" style="height:auto">
                          <div class="tab">
                            <div class="tab_title"> 
							<a href="/merreviews/{pigcms{$merid}.html?st=0" <if condition="$st eq 0"> class="on"</if>>全部</a>
							<a href="/merreviews/{pigcms{$merid}.html?st=1" <if condition="$st eq 1"> class="on"</if>>好评</a>
							<a href="/merreviews/{pigcms{$merid}.html?st=2" <if condition="$st eq 2"> class="on"</if>>中评</a> 
							<a href="/merreviews/{pigcms{$merid}.html?st=3" <if condition="$st eq 3"> class="on"</if>>差评</a>
							<a href="/merreviews/{pigcms{$merid}.html?st=4" <if condition="$st eq 4"> class="on"</if>>有图</a> 
							</div>
                            <div class="tab_form">
                              <div class="form_sec">
                                  排序选择： <select name="ord" class="select" onchange="pxOrder(this.value)">
								   <option value="0">默认排序</option>
                                    <option value="1" <if condition="$ord eq 1"> selected="selected"</if>>时间排序</option>
                                    <option value="2" <if condition="$ord eq 2"> selected="selected"</if>>好评排序</option>
                                  </select>
                              </div>
                            </div>
                          </div>
                          <div class="content">
                                <div class="appraise_li-list">
                                  <dl>
								    <if condition="!empty($reviews['list'])">
									<volist name="reviews['list']" id="rv">
                                    <dd>
                                      <div class="appraise_li-list_img">
                                        <div class="appraise_li-list_icon"><img src="{pigcms{$rv['avatar']}"></div>
                                        <p>{pigcms{$rv['nickname']}</p>
                                      </div>
                                      <div class="appraise_li-list_right cf">
                                        <div class="appraise_li-list_top cf">
                                          <div class="appraise_li-list_top_icon">
											<div><span style="width:{pigcms{$rv['score']/5*100}%;"></span></div>
										  </div>
                                          <div class="appraise_li-list_data">{pigcms{$rv['add_time']}</div>
                                        </div>
                                        <div class="appraise_li-list_txt">{pigcms{$rv['comment']}</div>
										<if condition="!empty($rv['pics'])">
										<div class="pic-list J-piclist-wrapper">
										<div class="J-pic-thumbnails pic-thumbnails">
										<ul class="pic-thumbnail-list widget-carousel-indicator-list">
										<volist name="rv['pics']" id="imgs">
										 <li big-src="{pigcms{$imgs['image']}" m-src="{pigcms{$imgs['m_image']}">
										  <a hidefocus="true" href="#" class="pic-thumbnail"><img src="{pigcms{$imgs['s_image']}"></a>
										  </li>
										  </volist>
										</ul>
										 </div>
										 </div>
										</if>
                                      </div>
                                    </dd>
									</volist>
									<else />
									 <dd>暂无评论</dd>
									</if>
                                  </dl>
								  
                                </div>
								 {pigcms{$reviews['page']}
                          </div>
                        </div>
                 
                        <!-- 代码部分end --> 
                        
                      </section>
                     <!-- <div class="shop_pingjia">
                        <div class="shop_pinjiga_title">发表评价</div>
                        <form action="" method="get">
                          <div class="shop_pinjgia_form">
                            <div class="shop_pingjia_form_list">
                              <ul>
                                <li class="zong">总体评价:</li>
                                <li class="red">好评</li>
                                <li class="yellow">
                                  <div class="pingjia_icon"><img src="{pigcms{$static_path}images/dianpupingjia_10.png"></div>
                                  <div class="pingjia_txt">中评</div>
                                </li>
                                <li class="gray">
                                  <div class="pingjia_icon"> <img src="{pigcms{$static_path}images/dianpupingjia_12.png"></div>
                                  <div class="pingjia_txt">差评</div>
                                </li>
                                <li class="xing">
                                  <div class="shop_pingjia_form_list_txt">星级</div>
                                  <div class="shop_pingjia_form_list_icon"><span><img src="{pigcms{$static_path}images/dianpupingjia_03.png"></span><span><img src="{pigcms{$static_path}images/dianpupingjia_03.png"></span><span><img src="{pigcms{$static_path}images/dianpupingjia_03.png"></span><span><img src="{pigcms{$static_path}images/dianpupingjia_03.png"></span> <span><img src="{pigcms{$static_path}images/dianpupingjia_05.png"></span></div>
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
                      </div>---->
                    </div>
                    <div style="clear:both"></div>
                  </div>
                </section>
              </div>
              <!-------->
              
              <div style="clear:both"></div>
              <!--------> 
              
            </article>
          </section>
</div>
<include file="Public:footer"/>
</body>
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
  <script type="text/javascript">
    function pxOrder(vv){ 
		var urlstr=window.location.href;
	   window.location.href="/merreviews/{pigcms{$merid}.html?st={pigcms{$st}&ord="+vv;
	}
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
</html>