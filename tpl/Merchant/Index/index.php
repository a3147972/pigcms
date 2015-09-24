<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-home home-icon"></i>
			<li class="active">首页</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-sm-12 infobox-container">
					<div style="background:#f2dede;padding:5px;margin-bottom:30px;">
						<div style="background:#f2dede;padding:5px;">
							<div class="" style="font-size:14px;" id="scrollText">
								<volist name="news_list" id="vo">
									<if condition="$vo['is_top']">
										<div style="float:left;">
											<span style="padding-right:30px;color:#a94442;">
												<i class="ice-icon fa fa-volume-up bigger-130"></i>
												<a href="{pigcms{:U('Index/news',array('id'=>$vo['id']))}">{pigcms{$vo.title}</a>
											</span>
										</div>
									</if>
								</volist>
							</div>
						</div>
					</div>
					<div class="infobox" style="background:#7cbae5;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number">{pigcms{$fans_count}</span>
							<div class="infobox-content">粉丝</div>
						</div>
					</div>
					<div class="infobox" style="background:#cec0f4;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number">{pigcms{$card_count}</span>
							<div class="infobox-content">会员卡</div>
						</div>
					</div>
					<div class="infobox" style="background:#81d2cf;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number">{pigcms{$lottery_count}</span>
							<div class="infobox-content">微活动</div>
						</div>
					</div>
					<div class="infobox" style="background:#92bf77;">
						<div class="infobox-data" style="padding-left:0px;width:100%;text-align:center;">
							<span class="infobox-data-number">{pigcms{$store_count}</span>
							<div class="infobox-content">店铺数</div>
						</div>
					</div>
					<div class="space-18"></div>
					<!--div class="infobox infobox-pink">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-smile-o"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">2014-11-20</span>
							<div class="infobox-content">服务到期时间</div>
						</div>
					</div>
					<div class="infobox infobox-green  ">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-envelope-o"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">0</span>
							<div class="infobox-content">短信余额</div>
						</div>
					</div>
					<div class="infobox infobox-orange2  ">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cny"></i>
						</div>
						<div class="infobox-data">
							<span class="infobox-data-number">0.00</span>
							<div class="infobox-content">账户余额</div>
						</div>
					</div>
					<div class="space-18"></div>
					<div class="infobox infobox-green infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-shopping-cart"></i>
						</div>
				
						<div class="infobox-data">
							<div class="infobox-content">今日订单</div>
							<div class="infobox-content">0</div>
						</div>
					</div>
				
					<div class="infobox infobox-blue infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-cny"></i>
						</div>
				
						<div class="infobox-data">
							<div class="infobox-content">今日收入</div>
							<div class="infobox-content">0</div>
						</div>
					</div>
				
					<div class="infobox infobox-grey infobox-small infobox-dark">
						<div class="infobox-icon">
							<i class="ace-icon fa fa-group"></i>
						</div>
				
						<div class="infobox-data">
							<div class="infobox-content">新增顾客</div>
							<div class="infobox-content">0</div>
						</div>
					</div-->
				</div>
				<div class="col-sm-12" style="height: 60px;"></div>
				<div class="col-sm-6">
					<div class="widget-box">
						<div class="widget-header widget-header-flat">
							<h4 class="lighter smaller">
								<i class="ace-icon fa fa-star blue"></i>
								最新动态
							</h4>
						</div>

						<div class="widget-body">
							<div class="widget-main">
								<div class="row">
									<div class="col-xs-12">
										<ul class="list-unstyled spaced">
											<volist name="news_list" id="vo">
											<li>
												<if condition="$vo['is_top']">
													<a style="color:orange" href="{pigcms{:U('Index/news',array('id'=>$vo['id']))}">
														<i class="ace-icon fa fa-arrow-up bigger-110 orange"></i>
														<span style="font-weight: bold;">{pigcms{$vo.title}</span>
													</a>
												<else/>
													<a  href="{pigcms{:U('Index/news',array('id'=>$vo['id']))}"><i class="ace-icon fa fa-check bigger-110 green"></i>{pigcms{$vo.title}</a>
												</if>
											</li>
											</volist>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">
							<i class="ace-icon fa fa-times"></i>
						</button>
						<p>欢迎大家联系系统管理员咨询或反馈。</p>
						<p>
							<a class="btn btn-sm btn-success" href="http://wpa.qq.com/msgrd?v=3&uin={pigcms{$config.site_qq}&site=qq&menu=yes" target="_blank">联系管理员QQ</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var ScrollTime;
function ScrollAutoPlay(contID,scrolldir,showwidth,textwidth,steper){
	var PosInit,currPos;
	with($('#'+contID)){
		currPos = parseInt(css('margin-left'));
		if(scrolldir=='left'){
			if(currPos<0 && Math.abs(currPos)>textwidth){
				css('margin-left',showwidth);
			}
			else{
				css('margin-left',currPos-steper);
			}
		}
		else{
			if(currPos>showwidth){
				css('margin-left',(0-textwidth));
			}
			else{
				css('margin-left',currPos-steper);
			}
		}
	}
}

//--------------------------------------------左右滚动效果----------------------------------------------
/*
AppendToObj：		显示位置（目标对象）
ShowHeight：		显示高度
ShowWidth：		    显示宽度
ShowText：			显示信息
ScrollDirection：	滚动方向（值：left、right）
Steper：			每次移动的间距（单位：px；数值越小，滚动越流畅，建议设置为1px）
Interval:			每次执行运动的时间间隔（单位：毫秒；数值越小，运动越快）
*/
function ScrollText(AppendToObj,ShowHeight,ShowWidth,ShowText,ScrollDirection,Steper,Interval){
	var TextWidth,PosInit,PosSteper;
	with(AppendToObj){
		html('');
		css('overflow','hidden');
		css('height',ShowHeight+'px');
		css('line-height',ShowHeight+'px');
		css('width',ShowWidth);
	}
	if (ScrollDirection=='left'){
		PosInit = ShowWidth;
		PosSteper = Steper;
	}
	else{
		PosSteper = 0 - Steper;
	}
	if(Steper<1 || Steper>ShowWidth){Steper = 1}//每次移动间距超出限制(单位:px)
	if(Interval<1){Interval = 10}//每次移动的时间间隔（单位：毫秒）
	var Container = $('<div></div>');
	var ContainerID = 'ContainerTemp';
	var i = 0;
	while($('#'+ContainerID).length>0){
		ContainerID = ContainerID + '_' + i;
		i++;
	}
	with(Container){
	  attr('id',ContainerID);
	  css('float','left');
	  css('cursor','default');
	  appendTo(AppendToObj);
	  html(ShowText);
	  TextWidth = width();
	  css('width',ShowWidth * 2);
	  if(isNaN(PosInit)){PosInit = 0 - TextWidth;}
	  css('margin-left',PosInit);
	  mouseover(function(){
		  clearInterval(ScrollTime);
	  });
	  mouseout(function(){
		  ScrollTime = setInterval("ScrollAutoPlay('"+ContainerID+"','"+ScrollDirection+"',"+ShowWidth+','+TextWidth+","+PosSteper+")",Interval);
	  });
	}
	
	ScrollTime = setInterval("ScrollAutoPlay('"+ContainerID+"','"+ScrollDirection+"',"+ShowWidth+','+TextWidth+","+PosSteper+")",Interval);
}
</script>
<script type="text/javascript"> 
$(document).ready(function(e) {
	var start_div = $('#scrollText');
	var tmp_str = '';
	tmp_str = start_div.html();
	//ScrollTime
	ScrollText(start_div,23,start_div.width(),tmp_str,'left',1,20);//滚动字幕
});
</script>
<style>
#scrollText div a{ color: #a94442;}
</style>
<include file="Public:footer"/>
