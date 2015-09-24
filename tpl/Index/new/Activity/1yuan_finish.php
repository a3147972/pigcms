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
				<div class="product_table m-detail m-detail-revealed cf">
					<div class="g-main">
						<div class="m-detail-main">
							<div class="m-detail-main-pic"> <img width="200" height="150" src="{pigcms{$now_activity.all_pic.0.s_image}"/> </div>
							<div class="m-detail-main-info">
								<div class="m-detail-main-title">
									<h1 title="{pigcms{$now_activity.name}">{pigcms{$now_activity.name}</h1>
								</div>
								<div class="m-detail-main-wrap m-detail-main-end">
									<h3>揭晓结果</h3>
									<div class="m-detail-main-end-luckyCode">
										<volist name="lottery_number_arr" id="vo">
											<b class="w-num w-num-{pigcms{$vo}">{pigcms{$vo}</b>
										</volist>
									</div>
								</div>
							</div>
							<div class="m-detail-main-winner">
								<div class="m-detail-main-winner-content">
									<div class="avatar"> <img width="90" height="90" src="<if condition="$lottery_user['avatar']">{pigcms{$lottery_user.avatar}<else/>{pigcms{$static_path}images/90.jpeg</if>"/> </div>
									<p class="txt-green user">恭喜 <a href="javascript:void(0)" title="{pigcms{$lottery_user.nickname}(ID:{pigcms{$lottery_user.uid})">{pigcms{$lottery_user.nickname}</a> ({pigcms{$lottery_user.last_ip_txt}) 获得了本期奖品</p>
									<p class="cid txt-green"><b>用户ID：{pigcms{$lottery_user.uid}</b> (ID为用户唯一不变标识)</p>
									<p>揭晓时间：{pigcms{$now_activity.finish_time|date='Y-m-d H:i:s',###}</p>
								</div>
								<div class="m-detail-main-winner-codes">
									<dl>
										<dt>
											<p style="margin-bottom:5px;color:#3c3c3c">奖品获得者本期总共参与了 <b class="txt-red">{pigcms{:count($lottery_part_list)}</b> 人次</p>
										</dt>
										<dd class="dd_num">Ta的号码:</dd>
										<dd class="m-detail-main-codes-list">
											<volist name="lottery_part_list" id="vo" offset="0" length="7"><span>{pigcms{$vo.number}</span></volist>  <if condition="count($lottery_part_list) gt 7">……<p><a class="m-detail-main-codes-viewWinnerCodesBtn" href="javascript:void(0)">TA的所有号码&gt;&gt;</a> </p></if>
										</dd>
									</dl>
								</div>
							</div>
							<div class="m-detail-main-codes">
								<div class="deco"></div>
								<if condition="$_SESSION['user']">
									<if condition="$user_part_list">
										<span class="total">我参与了: <b class="txt-red">{pigcms{:count($lottery_user_list)}</b>人次</span>
										<var>|</var>
										<span class="detail">夺宝号码: <volist name="lottery_user_list" id="vo" offset="0" length="7"><b>{pigcms{$vo.number}</b></volist><a class="m-detail-main-codes-viewUserCodesBtn" href="javascript:void(0)">查看更多&gt;&gt;</a></span>
									<else/>
										<p style="text-align:center">您没有参与本次夺宝。</p>
									</if>
								<else/>
									<p style="text-align:center"><a class="btn-login" href="javascript:void(0)"><b>请登录</b></a>，查看你的夺宝号码！</p>
								</if>
							</div>
							<div class="m-detail-main-rule">
								<ul class="txt">
									<li> <span class="title">计算公式</span>
										<div class="f-clear formula">
											<div class="box red-box"> 
												<b class="txt-red">{pigcms{$now_activity.lottery_number}</b><br>
												<b class="txt-red" style="font-size:12px">本期幸运号码</b>
											</div>
											<div class="operator">=</div>
											<div class="box gray-box">
												<b class="txt-red">{pigcms{$allCount}</b><br/>
												50个时间求和
												<div class="more-box"> <i class="ico ico-arrow ico-arrow-yellow"></i>
													<div class="yellow-box">奖品的最后一个号码分配完毕，公示本奖品的<span class="txt-red">最后50个参与时间</span>，并求和。</div>
												</div>
											</div>
											<div class="operator" title="取余">%</div>
											<div class="box"><b class="txt-red">{pigcms{$now_activity.all_count}</b><br/>该奖品总需人次</div>
											<div class="operator" title="相加">+</div>
											<div class="box"><b class="txt-red">10000000</b><br/>原始数</div>
										</div>
									</li>
								</ul>
							</div>
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
							<li class="set_tab off" data-id="1">中奖详情</li>
							<li class="set_tab" data-id="2">奖品详情</li>
							<if condition="$now_activity['part_count']">
								<li class="set_tab" data-id="3">所有参与记录</li>
							</if>
							<if condition="$user_part_list">
								<li class="set_tab showOwnBtn" data-id="4">您的参与</li>
							</if>
						</ul>
					</div>
					<div class="menudiv">
						<div id="con_one_1" style="display:block;">
							<div id="resultPanel" class="w-tabs-panel-item">
								<div class="m-detail-mainTab-calcRule">
									<h4><i class="ico ico-text"></i><br/>幸运号码<br/>计算规则</h4>
									<div class="ruleWrap">
										<ol class="ruleList">
											<li><span class="index">1</span>奖品的最后一个号码分配完毕后，将公示该分配时间点前本奖品的最后50个参与时间；</li>
											<li><span class="index">2</span>将这50个时间的数值进行求和（得出数值A）（每个时间按时、分、秒、毫秒的顺序组合，如20:15:25.362则为201525362）；</li>
											<li><span class="index">3</span>（数值A）除以该奖品总需人次得到的余数 + 原始数&nbsp;10000000，得到最终幸运号码，拥有该幸运号码者，直接获得该奖品。</li>
										</ol>
									</div>
								</div>
								<div class="m-detail-mainTab-resultList" cellpadding="0" cellspacing="0">
									<ul class="table_title cf">
										<li class="day">夺宝时间</li>
										<li class="user">会员帐号</li>
										<li class="gname">所在地区</li>
										<li class="number">参与人次</li>
									</ul>
									<p class="startRow"> 该奖品最后50条参与记录 </p>
									<volist name="activity_record_list" id="vo">
										<ul class="calcRow cf">
											<li class="day">{pigcms{$vo.time|date='Y-m-d',###}</li>
											<li class="time">{pigcms{$vo.time|date='H:i:s',###}.{pigcms{$vo.msec}<i class="ico ico-arrow-transfer"></i><b class="txt-red">{pigcms{$vo.time|date='His',###}{pigcms{$vo.msec}</b></li>
											<li class="user">
												<div class="f-txtabb"><a href="javascript:void(0)" title="{pigcms{$vo.nickname}(ID:{pigcms{$vo.uid})">{pigcms{$vo.nickname}</a></div>
											</li>
											<li class="gname">{pigcms{$vo.ip_txt}</li>
											<li class="number">{pigcms{$vo.part_count}人次</li>
										</ul>
									</volist>
								</div>
							</div>
						</div>
						<div id="con_one_2" style="display:none;">
							{pigcms{$now_activity.info}
						</div>
						<div id="con_one_3" style="display: none;">
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
						<div id="con_one_4" style="display:none;">
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
		<div id="WinnerCode" style="display:none;">
			<div class="w-msgbox-bd">
				<div class="m-detail-codesDetail-bd">
					<h3>奖品获得者本期总共参与了<span class="txt-red">{pigcms{:count($lottery_part_list)}</span>人次</h3>
					<div class="m-detail-codesDetail-wrap">
						<volist name="lottery_part_listArr" id="vo">
							<dl class="m-detail-codesDetail-list cf">
								<dt>{pigcms{$vo.time|date='Y-m-d H:i:s',###}.{pigcms{$vo.msec}</dt>
								<volist name="vo['list']" id="voo">
									<dd <if condition="$voo['number'] eq $now_activity['lottery_number']">class="txt-red selected"</if>>{pigcms{$voo.number}</dd>
								</volist>
							</dl>
						</volist>					
					</div>
				</div>
			</div>
		</div>
		<div id="UserCodes" style="display:none;">
			<div class="w-msgbox-bd">
				<div class="m-detail-codesDetail-bd">
					<h3>你本期总共参与了<span class="txt-red">{pigcms{:count($lottery_user_list)}</span>人次</h3>
					<div class="m-detail-codesDetail-wrap">
						<volist name="lottery_user_listArr" id="vo">
							<dl class="m-detail-codesDetail-list cf">
								<dt>{pigcms{$vo.time|date='Y-m-d H:i:s',###}.{pigcms{$vo.msec}</dt>
								<volist name="vo['list']" id="voo">
									<dd <if condition="$voo['number'] eq $now_activity['lottery_number']">class="txt-red selected"</if>>{pigcms{$voo.number}</dd>
								</volist>
							</dl>
						</volist>					
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
