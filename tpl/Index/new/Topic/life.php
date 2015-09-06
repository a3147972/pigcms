<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<title>生活缴费 - {pigcms{$config.site_name}</title>
		<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
		<meta name="description" content="{pigcms{$config.seo_description}" />
		<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
		<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
		<link href="{pigcms{$static_path}css/activity.css"  rel="stylesheet"  type="text/css" />
		<link href="{pigcms{$static_path}css/lifeservice.css"  rel="stylesheet"  type="text/css" />
		<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
		<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
		<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
		<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
		<script src="{pigcms{$static_path}js/common.js"></script>
		<script>var service_action="{pigcms{:U('Lifeservice/post')}";<if condition="$user_session">var is_login=true;<else/>var is_login=false;</if>var login_url="{pigcms{:U('Index/Login/frame_login',array('scriptName'=>'loginAfter'))}";var recharge_url="{pigcms{:U('User/Credit/index')}";</script>
		<script src="{pigcms{$static_path}js/lifeservice.js"></script>
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
		</div>
		<div class="banner activity_banner">
			<div class="banner_img">
				<img src="{pigcms{$static_path}images/lifeservice_banner.png"/>
			</div>
        </div>
        <div class="body">
			<div class="recharge-box">
				<div class="tab">
					<php>$liveServiceTypeArr = explode(',',$config['live_service_type']);</php>
					<if condition="in_array('phone',$liveServiceTypeArr)"><a class="phone" data-type="phone">充话费</a></if>
					<if condition="in_array('flow',$liveServiceTypeArr)"><a class="flow" data-type="flow">充流量</a></if>
					<if condition="in_array('water',$liveServiceTypeArr)"><a class="water" data-type="water">缴水费</a></if>
					<if condition="in_array('electric',$liveServiceTypeArr)"><a class="electric" data-type="electric">缴电费</a></if>
					<if condition="in_array('gas',$liveServiceTypeArr)"><a class="gas" data-type="gas">缴煤气费</a></if>
				</div>
				<div class="pnl pnl-phone">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="phone_txt">充值号码：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="phone_txt" type="tel" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="phone_txt" class="tb-wt-placeholder">输入手机号码</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-denom">
							<label class="tb-wt-control" for="JCZ4">充值面值：</label>
							<div class="tb-wt-content">
								<ul>
									<li class="tb-wt-active"><span><strong>100</strong>元</span></li>
									<li class=""><span><strong>50</strong>元</span></li>
									<li class=""><span><strong>30</strong>元</span></li>
									<li class="tb-wt-drop"><span><strong>10</strong>元<s></s></span></li>
								</ul>
							</div>
						</div>
						<div class="tb-wt-row tb-wt-price">
							<label class="tb-wt-control">销售价格：</label>
							<div class="tb-wt-txt"><span>¥</span><strong>98-99.5</strong></div>
						</div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_phone_btn">立即充值</button>
							<span class="tb-wt-ad"><a href="#" target="_blank" data-spm-anchor-id="0.0.0.0">话费充50抢10元</a></span>
						</div>
					</div>
				</div>
				<div class="pnl pnl-flow">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="flow_txt">手机号码：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="flow_txt" type="tel" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="flow_txt" class="tb-wt-placeholder">输入手机号码</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-denom">
							<label class="tb-wt-control" for="JCZ4">充值类型：</label>
							<div class="tb-wt-content">
								<ul>
									<li class="tb-wt-active"><span><strong>全国</strong></span></li>
									<li><span><strong>省内</strong></span></li>
								</ul>
							</div>
						</div>
						<div class="tb-wt-row tb-wt-denom">
							<label class="tb-wt-control" for="JCZ4">充值流量：</label>
							<div class="tb-wt-content">
								<ul>
									<li class="tb-wt-active"><span><strong>60</strong>M</span></li>
									<li><span><strong>150</strong>M</span></li>
									<li><span><strong>300</strong>M</span></li>
								</ul>
							</div>
						</div>
						<div class="tb-wt-row tb-wt-price">
							<label class="tb-wt-control">销售价格：</label>
							<div class="tb-wt-txt"><span>¥</span><strong>98-99.5</strong></div>
						</div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_flow_btn">立即充值</button>
						</div>
					</div>
				</div>
				<div class="pnl pnl-water">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="water_txt">户号：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="water_txt" type="text" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="water_txt" class="tb-wt-placeholder" style="visibility:visible;">输入您的户号</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_water_btn">查询</button>
						</div>
					</div>
					<div class="tb-tip">
						<dl>
							<dt>问：怎么找到缴费户号？</dt>
							<dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd>
							<dt>问：缴费多长时间到帐？</dt>
							<dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd>
							<dt>问：怎么知道缴费成功？</dt>
							<dd>答：1、您可以在会员中心->生活订单中查看缴费状态<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd>
						</dl>
					</div>
				</div>
				<div class="pnl pnl-electric">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="electric_txt">户号：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="electric_txt" type="text" class="txt"/></div>
							<label for="electric_txt" class="tb-wt-placeholder" style="visibility:visible;">输入您的户号</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_electric_btn">查询</button>
						</div>
					</div>
					<div class="tb-tip">
						<dl>
							<dt>问：怎么找到缴费户号？</dt>
							<dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd>
							<dt>问：缴费多长时间到帐？</dt>
							<dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd>
							<dt>问：怎么知道缴费成功？</dt>
							<dd>答：1、您可以在会员中心->生活订单中查看缴费状态<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd>
						</dl>
					</div>
				</div>
				<div class="pnl pnl-gas">
					<div class="tb-wt">
						<span class="tb-wt-form-fields"></span>
						<div class="tb-wt-row tb-wt-number">
							<label class="tb-wt-control" for="gas_txt">户号：</label>
							<div class="tb-wt-content"><input autocomplete="off" id="gas_txt" type="text" class="txt"/></div>
							<span class="trigger history-trigger" title="查看充值历史"></span>
							<label for="gas_txt" class="tb-wt-placeholder" style="visibility:visible;">输入您的户号</label>
						</div>
						<div class="tb-wt-location"></div>
						<div class="tb-wt-row tb-wt-action">
							<button type="button" id="recharge_gas_btn">查询</button>
						</div>
					</div>
					<div class="tb-tip">
						<dl>
							<dt>问：怎么找到缴费户号？</dt>
							<dd>答：通过催缴单、拨打事业单位服务热线或银行缴费回执中找到户号。</dd>
							<dt>问：缴费多长时间到帐？</dt>
							<dd>答：一般会在10分钟之内到帐，月初会有一小时内的延迟。如果充值失帐，金额会回到您的帐户上。</dd>
							<dt>问：怎么知道缴费成功？</dt>
							<dd>答：1、您可以在会员中心->生活订单中查看缴费状态<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2、您在本页面再查询一次，提醒未欠费表示已成功。<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3、若您的帐号绑定过微信号，您的微信能收到我们公众号推送的缴费提醒消息</dd>
						</dl>
					</div>
				</div>
			</div>
        </div>
		<include file="Public:footer"/>
	</body>
</html>
