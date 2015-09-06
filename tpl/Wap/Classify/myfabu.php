<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <title>我的发布</title> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mball.css" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/ucenter_v.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
  <style type="text/css">
  .hidden{display: none;}
  .showdiv{display: block;}
  	    .my-account {
	        color: #333;
	        position: relative;
	        background: -webkit-linear-gradient(top,#e1dace,#dfc8b4);
	        border-bottom: 1px solid #C0BBB2;
	        display: block;
	        height: 100px;
	        position: relative;
	        padding-right: .2rem;
	    }
	    .my-account>img {
	        height: 100%;
	        position: absolute;
	        right: 0;
	        top:0;
	        z-index: 0;
	    }
	    .my-account .user-info {
	        z-index: 1;
	        position: relative;
	        height: 100%;
	        padding: 20px 1px;
	        margin-right: .2rem;
	        box-sizing: border-box;
	        padding-left: 6.5rem;
	        font-size: .24rem;
	        color: #666;
			width: 85%;
	    }
	    .my-account .uname {
	        font-size: .3rem;
	        color: #333;
	        margin-top: .0rem;
	        margin-bottom: .12rem;
	    }
		.my-account .umoney {
	       margin-bottom: 0.06rem;
	    }
	    .my-account strong {
	        color: #FF9712;
	        font-weight: normal;
	    }
	    .my-account .avater {
	        position: absolute;
	        top: 7px;
	        left: 10px;
	        width: 80px;
	        height: 80px;
	        border-radius: 50%;
	    }
	    .my-account .more.more-weak:after {
	        border-color: #666;
	        -webkit-transform: translateY(-50%) scaleY(1.2) rotateZ(-135deg);
	    }
 </style>
 </head>
 <body class="bg"> 
  <div class="body_div"> 
  	<div>
		<a class="my-account" href="{pigcms{:U('My/myinfo')}">
			<img src="{pigcms{$static_path}images/my-photo.png">
			<img class="avater" src="<if condition="$now_user['avatar']">{pigcms{$now_user.avatar}<else/>{pigcms{$static_path}images/pic-default.png</if>" alt="{pigcms{$now_user.nickname}头像"/>
			<div class="user-info more more-weak">
			    <if condition="!empty($now_user)">
				<p class="uname">{pigcms{$now_user.nickname}<i class="level-icon level0"></i></p>
				<p class="umoney">余额：<strong>{pigcms{$now_user.now_money}</strong> 元</p>
				<p>积分：<strong>{pigcms{$now_user.score_count}</strong> 分</p>
				<else/>
				<p style="margin-top: 20px;font-size: 15px;">未登录，请点击登录！</p>
				</if>
			</div>
		</a>
		<a class="c_publish" href="{pigcms{:U('Classify/SelectSub',array('cid'=>0))}" style="top:25px;margin-right: 15px"> <i class="ico"></i>发布 </a>
	</div>

   <div class="dl_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Classify&a=index">分类信息首页</a> &gt;  <a href="{pigcms{:U('Classify/myCenter',array('uid'=>$uid))}">个人中心</a> &gt;  <a href="javascript:;" style="color: #F97D03;"> 我的发布 </a> </span> 
   </div> 
   <div class="ucenter"> 
    <ul class="u_infolst" id="userPub"> 
	  <if condition="!empty($listsdatas)">
      <volist name="listsdatas" id="vl">
     <li> <a href="{pigcms{:U('Classify/ShowDetail',array('vid'=>$vl['id']))}"> <h2>{pigcms{$vl['title']}</h2> 
       <div class="attr"> 
        <span>{pigcms{$vl['input1']}</span> <br>
		<span> {pigcms{$vl['input2']} </span> 
       </div> 
       <div class="attr"> 
        <span> {pigcms{$vl['input3']} </span> 
		<br>
		<span class="status">  <if condition="$vl['status'] eq 1"> 已审核 <else/> 未审核 </if> </span>&nbsp;&nbsp;&nbsp; 
        <span>{pigcms{$vl['timestr']}</span> 
       </div> </a> 
      <div class="arrow_hover" onclick="Show_Opt($(this));">
       <div class="arrow_border">
        <i class="arrow_down"></i>
       </div>
      </div> 
      <div class="attr_do hidden"> 
       <table class="delorappeal"> 
        <tbody>
         <tr> 
          <td class="del" onclick="delItem({pigcms{$vl['id']});"> <i class="ico_del"></i><p>删除</p> </td> 
          <!--<td class="appeal"><i class="ico_appeal"></i><p></p></td> 
          <td class="spread"><i class="ico_spread"></i><p></p></td>-->
         </tr> 
        </tbody>
       </table> 
       <div class="arrow_down_white" style="left: 49%;"></div> 
      </div> 
	  </li>
	  </volist>
	  <else/><li style="text-align: center;margin-top: 15px;">没有数据！<a href="{pigcms{:U('Classify/SelectSub',array('cid'=>0))}" style="margin: 20px 90px; color:blue !important">点击这里快去发布吧</a></if></li>
	  </if>
    </ul> 
   </div> 
      <div class="textcenter pagebar" style="height: 80px;padding-top: 35px;text-align: center;">
		{pigcms{$pagebar}
   </div>
   <!-- BODY END--> 
  </div> 
  <div class="tg-bg" id="tg-bg"></div> 
  <div style="margin-bottom: 100px;">
</div>
  <include file="Classify:footer"/>
 </body>
  <script type="text/javascript">
  function Show_Opt(obj){
    obj.next('.attr_do').toggleClass("showdiv");
  }

 function delItem(vid){
   vid=parseInt(vid);
   if(vid>0){
	  if(confirm('您确认要删除此信息吗？')){

     $.post("{pigcms{:U('Classify/delItem')}",{vid:vid},function(ret){
		 if(!ret.error){
			alert('删除成功！');
			 window.location.reload();
		 }else{
			alert('删除失败！');
		 }
	 },'JSON');

    }
   }
 }
 </script>
</html>