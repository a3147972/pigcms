<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>选择类别</title> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mball.css" /> 
  <link rel="stylesheet" href="{pigcms{$static_path}classify/publishall.css" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
 </head> 
 <body> 

  <div class="dl_nav"> 
   <span> <a href="/wap.php?g=Wap&c=Classify&a=index">首页</a>&gt; <a href="javascript:;">发布</a>&gt; <a href="javascript:;"><h1>选择类别</h1></a> </span> 
  </div> 
  <hr />
  <div id="sub_lists">
 <if condition="!empty($Zcategorys)">
  <volist name="Zcategorys" id="zv">
  <dl class="business" id="ct_item_{pigcms{$zv['cid']}"> 
   <dt class="">
   {pigcms{$zv['cat_name']}
   </dt> 
   <dd> 
	<if condition="!empty($zv['subdir'])">
	<volist name="zv['subdir']" id="sv">
    <a href="{pigcms{:U('Classify/fabu',array('cid'=>$sv['cid'],'fcid'=>$sv['fcid'],'pfcid'=>$sv['pfcid']))}">{pigcms{$sv['cat_name']}</a> 
	</volist>
   </if>
   </dd> 
  </dl>
  </volist>
  <else/>
  <dl> 
   <dd style="text-align: center;font-size: 20px;height: 50px;line-height: 50px;"> 
	 请联系管理员后台添加分类！
   </dd> 
  </dl>
  </if>

 </div>
  <!--<dl class="business only exp" onclick="window.location.href=''"> 
   <dt class="job">
    发布招聘信息
   </dt> 
  </dl>----> 


  
  </div> 
  <div style="margin-bottom: 100px;">
</div>
<include file="Classify:footer"/>
  <script type="text/javascript">
	var new_nav = new function() {};
	var x;
	var old_navigator = window.navigator;
	for (x in navigator) {
		if (typeof navigator[x] == 'function') {
			eval("new_nav." + x + " = function() { return old_navigator." + x
					+ "();};");
		} else {
			eval("new_nav." + x + " = navigator." + x + ";");
		}
	}
	new_nav.userAgent = "Mozilla/5.0 (Linux; Android 4.1.1; Nexus 7 Build/JRO03D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19";
	new_nav.vendor = "";
	window.navigator = new_nav;
    $(".business dt").bind("click",
    function() {
        var $this = $(this).parent();
        if ($this.hasClass("exp")) {
            $this.removeClass("exp");
        } else {
            var scrollTop = document.body.scrollTop;
            $this.addClass("exp");
            window.scrollTo(0, scrollTop);
        }
    });
var cid=0;
<if condition="$cid gt 0">
	cid="{pigcms{$cid}";
</if>

if(cid){
 var tmplen=$('#ct_item_'+cid).size();
  $('#sub_lists .business').removeClass("exp");
 if(tmplen>0){
     $('#ct_item_'+cid).addClass("exp");
 }else{
    $('#sub_lists dl:first').addClass("exp");
 }
}else{
  $('#sub_lists dl:first').addClass("exp");
}
</script> 
 </body>
</html>