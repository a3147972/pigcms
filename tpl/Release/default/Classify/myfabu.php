<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta charset="utf-8" /> 
  <title>我的发布</title> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mball.css" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/ucenter_v.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
  <style type="text/css">
  .hidden{display: none;}
  .showdiv{display: block;}
.pager {
	padding: 40px 0;
	background: #fff;
	clear: both;
	text-align: center;
	line-height: 22px;
	font-family: '宋体';
	font-size: 12px;
	zoom: 1;
}
   #pageHtml{font-size: 20px;}
   #pageHtml .current{border: 1px solid #e1e1e1;display:inline-block; height:30px;line-height:30px;width:35px;background-color:#e71;color:#fff;margin: 0 1px;padding: 0 0 0 1px;}
   #pageHtml a{height: 30px;line-height: 30px;margin: 0 1px;padding: 0 0 0 1px;display: inline-block;cursor: pointer;}
   #pageHtml .pga{ border: 1px solid #e1e1e1;width: 35px;}
 </style>
 </head>
 <body class="bg"> 
 <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
  <div class="body_div" style="margin:0 auto; width: 1000px;margin-top: 7px;"> 
   <div class="c_header"> 
    <a class="c_logo" href="{pigcms{$siteUrl}/classify/" style="font-size: 20px;">分类信息首页</a> 
    <a class="c_publish" href="{pigcms{$siteUrl}/classify/selectsub.html"> <i class="ico"></i>发布 </a> 
   </div> 
   <div class="dl_nav"> 
    <span> <a href="{pigcms{$siteUrl}/classify/">分类信息首页</a> &gt;  <a href="{pigcms{$siteUrl}/classify/mycenter.html">个人中心</a> &gt;  <a href="javascript:;" style="color: #f97d03;"> 我的发布 </a> </span> 
   </div> 
   <div class="ucenter"> 
    <ul class="u_infolst" id="userPub"> 
	  <if condition="!empty($listsdatas)">
      <volist name="listsdatas" id="vl">
     <li> <a href="{pigcms{$siteUrl}/classify/{pigcms{$vl['id']}.html"> <h2>{pigcms{$vl['title']}</h2> 
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
	  <else/><li style="text-align: center;margin-top: 15px;">没有数据！<a href="{pigcms{$siteUrl}/classify/selectsub.html" style="margin: 20px 90px; color:blue !important">点击这里快去发布吧</a></if></li>
	  </if>
    </ul> 
   </div> 
      <div class="pager mb10" id="pageHtml" style="height: 80px;padding-top: 35px;text-align: center;">
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