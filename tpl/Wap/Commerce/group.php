<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>商家中心</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}layer/layer.m.js"></script>
    <style>
	    dl.list dd.dealcard {
	        overflow: visible;
	        -webkit-transition: -webkit-transform .2s;
	        position: relative;
	    }
	    .dealcard.orders-del {
	        -webkit-transform: translateX(1.05rem);
	    }
	    #orders .dealcard-block-right {
			margin-left:1px;
	        position: relative;
	    }
	    .dealcard small {
	        font-size: .24rem;
	        color: #9E9E9E;
	    }
	    .dealcard weak {
	        font-size: .24rem;
	        color: #999;
	        position: absolute;
	        bottom: 0;
	        left: 0;
	        display: block;
	        width: 100%;
	    }
	    .dealcard weak b {
	        color: #FDB338;
	    }
	    .dealcard weak a.btn{
	        margin: -.15rem 0;
	    }
	    .dealcard weak b.dark {
	        color: #fa7251;
	    }
	    .hotel-price {
	        color: #ff8c00;
	        font-size: .24rem;
	        display: block;
	    }
	    .del-btn {
	        display: block;
	        width: .45rem;
	        height: .45rem;
	        text-align: center;
	        line-height: .45rem;
	        position: absolute;
	        left: -.85rem;
	        top: 50%;
	        background-color: #EC5330;
	        color: #fff;
	        -webkit-transform: translateY(-50%);
	        border-radius: 50%;
	        font-size: .4rem;
	    }
	    .no-order {
	        color: #D4D4D4;
	        text-align: center;
	        margin-top: 1rem;
	        margin-bottom: 2.5rem;
	    }
	    .icon-line {
	        font-size: 2rem;
	        margin-bottom: .2rem;
	    }

	    .order-icon {
	        display: inline-block;
	        width: .5rem;
	        height: .5rem;
	        text-align: center;
	        line-height: .5rem;
	        border-radius: .06rem;
	        color: white;
	        margin-right: .25rem;
	        margin-top: -.06rem;
	        margin-bottom: -.06rem;
	        background-color: #F5716E;
	        vertical-align: initial;
	        font-size: .3rem;
	    }
	    .order-all {
	        background-color: #2bb2a3;
	    }
	    .order-zuo,.order-jiudian {
	        background-color: #F5716E;
	    }
	    .order-fav {
	        background-color: #0092DE;
	    }
	    .order-card {
	        background-color: #EB2C00;
	    }
	    .order-lottery {
	        background-color: #F5B345;
	    }
	    .color-gray{
	    	color:gray;
	    	border-color:gray;
	    }
	    .color-gray:active{
	    	background-color:gray;
	    }

 .dealcard-block-right li{
     font-size: .266rem;
font-weight: 400;
 }
  .dealcard-block-right li.name,.dealcard-block-right li.detail{
     margin-bottom: .18rem;
 }
.dealcard-block-right .dth{font-weight: bold;}
 .ulrightdiv{
	float: right;
	position: relative;
	top: -55px;
	margin-right: 10px;
	}
	dl.list .dd-padding{padding: .28rem 0.1rem;}
.dealcard-block-right{padding: 0 10px;}
#orders ul a{color: blue;}
.find_div{margin:.15rem 0;}
.find_type_div{
	position: absolute;
left: 0;
top: .15rem;
width: 1.7rem;
height: .7rem;
text-align: center;
background: white;
}
.m_nav{height: 50px;line-height: 50px;background: #FF658E;padding-left: 12px;color:#FFF;font-size: 16px;}
.m_nav a{color:#FFF;text-decoration:none;cursor: pointer;}
.btn-weak{padding:0 .2rem;}
</style>
</head>
<body>
    <div class="m_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Commerce&a=index">商家中心</a> &gt; <a href="javascript:;" style="color:#FAFDCC;">{pigcms{$config.group_alias_name}管理</a></span> 
   </div> 
	    <div style="margin-top:.2rem;">
		    <dl class="list" id="orders">
			<if condition="!empty($group_list)">
				<volist name="group_list" id="vo">
					<dd class="dealcard dd-padding">
							<ul class="dealcard-block-right">
								<li class="detail"><span class="dth">{pigcms{$config.group_alias_name}名称：</span><span class="ttd">{pigcms{$vo.name}</span></li>
								<li class="detail"><span class="dth">{pigcms{$config.group_alias_name}价格：</span><span class="ttd">￥{pigcms{$vo.price}元</span></li>
								<li class="detail"><span class="dth">销售概览：</span><span class="ttd">已经售出{pigcms{$vo.sale_count} 份</span></li>
								<li class="name"><span class="dth">结束时间：</span>
								<span class="ttd">{pigcms{$vo.end_time|date='Y-m-d H:i:s',###}</span></li>
								<li class="name"><span class="dth">店铺二维码：</span>
								<span class="ttd"><a href="javascript:;" onclick="See_ErWM({pigcms{$vo.group_id});">查看二维码</a></span></li>
							</ul>
					</dd>

				</volist>
				<else/>
				<dd style="font-size: 25px;font-weight: bold;height: 1.5rem;"><p style="text-align: center; margin-top: 0.4rem;">没有信息</p></dd>
				</if>
			</dl>
	
		</div>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
<script type="text/javascript">
var ewmUrl="{pigcms{:U('Commerce/erwm')}";
function See_ErWM(id){
var w=$('body').width();
imgw=w-80;
$.post(ewmUrl,{sid:id,type:'group'},function(ret){
	  if(!ret.error_code && ret.qrcode){
		 layer.open({title:['二维码：','background-color:#FF658E;color:#fff;'],content:'<div ><img src="'+ret.qrcode+'" style="width:'+imgw+'px"></div>',btn: ['确定'],end:function(){}});
		 w=w-50;
		 $('.layermchild').css('max-width',w);
	  }else{
		 layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:'二维码获取失败！',btn: ['确定'],end:function(){}});
	  }
   },'JSON');
 }
</script>
</html>