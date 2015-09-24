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
 </style>
 </head>
 <body class="bg"> 
  <div class="body_div"> 
   <div class="c_header"> 
    <a class="c_logo" href="/wap.php?g=Wap&c=Classify&a=index" style="font-size: 20px;">首页</a> 
    <a class="c_publish" href="{pigcms{:U('Classify/SelectSub',array('cid'=>0))}"> <i class="ico"></i>发布 </a> 
   </div> 
   <div class="dl_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Classify&a=index">首页</a> &gt;  <a href="{pigcms{:U('Classify/myCenter',array('uid'=>$uid))}">个人中心</a> &gt;  <a href="javascript:;"> 我的发布 </a> </span> 
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