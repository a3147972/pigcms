<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>{pigcms{$now_activity.name} - 一元夺宝 - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link href="{pigcms{$static_path}css/1yuan.css"  rel="stylesheet"  type="text/css" />
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
		<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script>var submitFormAction = "{pigcms{:U('Activity/submit',array('id'=>$now_activity['pigcms_id']))}";<if condition="$user_session">var is_login=true;<else/>var is_login=false;</if>var login_url="{pigcms{:U('Index/Login/frame_login')}";var recharge_url="{pigcms{:U('User/Credit/index')}";var get_number_list="{pigcms{:U('Index/Activity/yiyuan_number')}";</script>
		<script src="{pigcms{$static_path}js/1yuan.js"></script>
		<!--[if IE 6]>
		<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
		<script type="text/javascript">
		   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
		</script>
		<script type="text/javascript">DD_belatedPNG.fix('*');</script>
		<style type="text/css"> 
			body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
			.category_list li:hover .bmbox {filter:alpha(opacity=50);}
			.gd_box{display:none;}
		</style>
		<![endif]-->
	</head>
	<body>
		<include file="Public:header_top"/>
		<div class="body"> 
			<article>
				<div class="menu cf">
					<div class="menu_left hide">
						<div class="menu_left_top"><img src="{pigcms{$static_path}images/o2o1_27.png" /></div>
						<div class="list">
							<ul>
								<volist name="all_category_list" id="vo" key="k">
									<li>
										<div class="li_top cf">
											<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
											<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
										</div>
										<if condition="$vo['cat_count'] gt 1">
											<div class="li_bottom">
												<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
													<span><a href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a></span>
												</volist>
											</div>
											<div class="list_txt">
												<p><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></p>
												<volist name="vo['category_list']" id="voo" key="j">
													<a class="<if condition="$voo['is_hot']">bribe</if>" href="{pigcms{$voo.url}" target="_blank">{pigcms{$voo.cat_name}</a>
												</volist>
											</div>
										</if>
									</li>
								</volist>
							</ul>
						</div>
					</div>
					<div class="menu_right cf">
						<div class="menu_right_top">
							<ul>
								<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
									<li class="ctur">
										<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
									</li>
								</pigcms:slider>
							</ul>
						</div>
					</div>
				</div>
			</article>
			<div class="oneyuan cf">
				<div class="navBreadCrumb cf">
					<ul class="cf">
						<li>
							<div class="navBreadCrumb_txt"><a href="{pigcms{$config.site_url}">网站首页&nbsp;&nbsp;&gt;</a></div>
						</li>
						<li>
							<div class="navBreadCrumb_txt"><a href="{pigcms{$config.site_url}/activity/">活动列表&nbsp;&nbsp;&gt;</a></div>
						</li>
						<li>
							<div class="navBreadCrumb_txt"><a href="{pigcms{$config.site_url}/activity/1/all">一元夺宝&nbsp;&nbsp;&gt;</a></div>
						</li>
						<li style="color:#fe5842">
							<div class="navBreadCrumb_txt">奖品详情</div>
						</li>
					</ul>
				</div>
				<div class="product_table cf">
					<div class="product_img cf"> 
						<div id="slider" class="cf">
							<div class="show-box cf">
								<ul class="cf">
									<li class="show" style="display:list-item;"><img src="{pigcms{$now_activity.all_pic.0.m_image}"/></li>
								</ul>
							</div>
							<div class="minImgs">
								<div class="min-box">
									<ul class="min-box-list cf">
										<volist name="now_activity['all_pic']" id="vo">
											<li class="<if condition='$i eq 1'>cur</if>">
												<div><img src="{pigcms{$vo.s_image}" data-mpic="{pigcms{$vo.m_image}"/></div>
											</li>
										</volist>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="product_list">
						<div class="product_list_top">
							<div class="product_name">{pigcms{$now_activity.name}</div>
							<div class="product_dec">{pigcms{$now_activity.title}</div>
							<div class="cf">
								<div class="product_number cf">
									<div class="product_number_top">总需人次<span>{pigcms{$now_activity.all_count}</span></div>
									<div class="product_number_progress">
										<div class="product_number_progress_img" style="width:{pigcms{$now_activity['part_count']/$now_activity['all_count']*100}%;"></div>
									</div>
									<div class="product_number_bottom cf">
										<div class="product_number_bottom_txt_left">
											<div class="product_number_bottom_txt_num">{pigcms{$now_activity.part_count}</div>
											<div class="product_number_bottom_txt">已参与</div>
										</div>
										<div class="product_number_bottom_txt_right">
											<div class="product_number_bottom_txt_num">{pigcms{$now_activity['all_count']-$now_activity['part_count']}</div>
											<div class="product_number_bottom_txt">剩余</div>
										</div>
									</div>
								</div>
							</div>
							<if condition="$now_activity['all_count']-$now_activity['part_count'] gt 0">
								<div class="product_list_bottom cf">
									<form action="" method="get" id="buy_form">
										<div class="cf">
											<div class="input">
												<div class="product_info_list_left">参与：</div>
												<ul>
													<li><button id="J-cart-minus" class="minus" type="button">-</button></li>
													<li>
														<input name="q" class="inp" type="text" value="1" id="J-quantity" data-max="{pigcms{$now_activity['all_count']-$now_activity['part_count']}"/>
													</li>
													<li style="border:0px;"><button id="J-cart-add" class="minus" type="button">+</button></li>
												</ul>
												<span>人次</span>
											</div>
											<div class="input_txt">参与人数越高，获奖机会越大！</div>
										</div>
										<p id="error_num_tips" style="margin:10px 0 0 20px;color:#db3652;"></p>
										<div class="but cf">
											<button class="info_but"> 立即夺宝 </button>
										</div>
									</form>
								</div>
							<else/>
								<div class="product_info_top cf">
									<div class="product_info_no_tips">已经全部发放完毕</div>
								</div>
							</if>
						</div>
					</div>
				</div>
				<div class="navBreadCrumb_right">
					<div class="navBreadCrumb_right_title cf">
						<div class="navBreadCrumb_right_title_left">看了还看</div>
						<!--div class="navBreadCrumb_right_title_right"><a href="#"><span></span>换一批</a></div-->
					</div>
					<div class="navBreadCrumb_right_list">
						<ul>
							<volist name="tui_activityList" id="vo">
								<li>
									<a href="{pigcms{$vo.url}">
										<img src="{pigcms{$vo.list_pic}" alt="{pigcms{$vo.name}"/>
									</a>
									<p><a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a></p>
									<p>已有<span>{pigcms{$vo.part_count}</span>参与</p>
								</li>
							</volist>
						</ul>
					</div>
				</div>
			</div>
			<div class="table">
				<div class="tab1" id="tab1">
					<div class="menu">
						<ul class="cf">
							<li class="set_tab off" data-id="1">奖品详情</li>
							<if condition="$now_activity['part_count']">
								<li class="set_tab" data-id="2">所有参与记录</li>
							</if>
							<if condition="$user_part_list">
								<li class="set_tab showOwnBtn" data-id="3">您的参与</li>
							</if>
						</ul>
					</div>
					<div class="menudiv">
						<div id="con_one_1" style="display:block;">
							{pigcms{$now_activity.info}
						</div>
						<div id="con_one_2" style="display: none;">
							<ul class="jion cf">
								<li>
								  <div class="jion_left big"><span></span></div>
								  <div class="jion_right" style="height:80px;"></div>
								  <div class="clear"></div>
								</li>
								<volist name="part_list" id="vo">
									<li class="cf">
										<div class="jion_left day">{pigcms{$key}<span></span></div>
										<div class="jion_right"></div>
									</li>
									<volist name="vo" id="voo">
										<li class="cf">
											<div class="jion_left time">{pigcms{:date('H:i:s',$voo['time'])}.{pigcms{$voo.msec}<span></span></div>
											<div class="jion_right">
												<div class="jion_right_div" data-id="{pigcms{$voo['pigcms_id']}">
													<div class="cf">
														<div class="jion_right_icon"><img src="{pigcms{$voo.avatar}" width="20" height="20"/></div>
														<div class="jion_right_txt">
															<div class="jion_right_txt_name">{pigcms{$voo.nickname}</div>
															<div class="jion_right_txt_ip">({pigcms{$voo.ip_txt} IP：{pigcms{$voo.ip}) 参与了</div>
															<span>{pigcms{$voo.part_count}人次</span>
														</div>
														<div class="suoyou">所有夺宝号码<span></span></div>
													</div>
													<dl class="cf number_list_{pigcms{$voo['pigcms_id']}"></dl>
													<div class="jion_close"></div>
												</div>
											</div>
										</li>
									</volist>
								</volist>
								<li>
									<div class="jion_left bottom" style="border:0;"><span></span></div>
								</li>
							</ul>
						</div>
						<div id="con_one_3" style="display: none;">
							<ul class="jion cf">
								<li>
								  <div class="jion_left big"><span></span></div>
								  <div class="jion_right" style="height:80px;"></div>
								  <div class="clear"></div>
								</li>
								<volist name="user_part_list" id="vo">
									<li class="cf">
										<div class="jion_left day">{pigcms{$key}<span></span></div>
										<div class="jion_right"></div>
									</li>
									<volist name="vo" id="voo">
										<li class="cf">
											<div class="jion_left time">{pigcms{:date('H:i:s',$voo['time'])}.{pigcms{$voo.msec}<span></span></div>
											<div class="jion_right">
												<div class="jion_right_div" data-id="{pigcms{$voo['pigcms_id']}">
													<div class="cf">
														<div class="jion_right_icon"><img src="{pigcms{$voo.avatar}" width="20" height="20"/></div>
														<div class="jion_right_txt">
															<div class="jion_right_txt_name">{pigcms{$voo.nickname}</div>
															<div class="jion_right_txt_ip">({pigcms{$voo.ip_txt} IP：{pigcms{$voo.ip}) 参与了</div>
															<span>{pigcms{$voo.part_count}人次</span>
														</div>
														<div class="suoyou">所有夺宝号码<span></span></div>
													</div>
													<dl class="cf number_list_{pigcms{$voo['pigcms_id']}"></dl>
													<div class="jion_close"></div>
												</div>
											</div>
										</li>
									</volist>
								</volist>
								<li>
									<div class="jion_left bottom" style="border:0;"><span></span></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<include file="Public:footer"/>
	</body>
</html>
