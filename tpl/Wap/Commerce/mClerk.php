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
	top: -65px;
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
.loginStaff{float: right;
position: relative;
top: -23px;
right: -110px}
</style>
</head>
<body>
    <div class="m_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Commerce&a=index">商家中心</a> &gt; <a href="javascript:;" style="color:#FAFDCC;">店员管理</a></span> 
	<a class="btn" style="float:right;border: 1px solid;margin-right: 12px;top:.2rem;color:#FFF;position: relative;" href="{pigcms{:U('Commerce/clerk_set')}">添 加</a>
   </div> 
	    <div style="margin-top:.2rem;">
		    <dl class="list" id="orders">
				<volist name="staff_list" id="vo">
					<dd class="dealcard dd-padding">
							<ul class="dealcard-block-right">
								<li class="detail"><span class="dth">店员帐号：</span><span class="ttd">{pigcms{$vo.username}</span></li>
								<li class="detail"><span class="dth">店员姓名：</span><span class="ttd">{pigcms{$vo.name}</span></li>
								<li class="detail"><span class="dth">店员电话：</span><span class="ttd"><a  href="tel:{pigcms{$vo.tel}">{pigcms{$vo.tel}</a></span></li>
								<li class="name"><span class="dth">所属店铺：</span>
								<span class="ttd">{pigcms{$vo.storename}</span></li>
							</ul>
							<!--<a class="ulrightdiv btn btn-weak" onclick="delstore({pigcms{$vo['id']},{pigcms{$vo['store_id']},$(this))">删除</a>--->
							<a class="ulrightdiv btn btn-weak" href="{pigcms{:U('Commerce/loginStaff',array('id'=>$vo['id'],'store_id'=>$vo['store_id']))}">登陆</a>
							<a class="ulrightdiv btn btn-weak" href="{pigcms{:U('Commerce/clerk_set',array('id'=>$vo['id'],'store_id'=>$vo['store_id']))}">编辑</a>
					</dd>

				</volist>
			</dl>
	
		</div>
		<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
<script type="text/javascript">
var delUrl="{pigcms{:U('Commerce/clerk_del')}";
function delstore(id,store_id,obj){
		layer.open({
		title:['删除提示：','background-color:#FF658E;color:#fff;'],
		content:'<p style="width:180px;">您确认要删除此项吗？</p>',
		btn: ['确定','取消'],
		yes: function(index){
			layer.close(index);
		   $.post(delUrl,{id:id,storeid:store_id},function(ret){
		      if(!ret.error){
			     obj.parent('dd').remove();
			  }else{
			     layer.open({title:['错误提示：','background-color:#FF658E;color:#fff;'],content:ret.msg,btn: ['确定'],end:function(){}});
			  }
		   },'JSON');
		}
	});	
 }
</script>
</html>