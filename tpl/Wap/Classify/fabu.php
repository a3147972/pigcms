<!DOCTYPE html>
<html lang="zh-CN">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>信息发布</title> 
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
  <style type="text/css">
  .item .danfux{display:block;padding-left: 10px;}
  .danfux label{padding-left:10px;line-height: 25px;display: inline-block;}
  input:focus{background:#ececec;outline:0}
  </style>
 </head> 
 <body> 
  <div class="dl_nav"> 
   <span> <a href="/wap.php?g=Wap&c=Classify&a=index">首页</a>&gt; <a href="/wap.php?g=Wap&c=Classify&a=SelectSub&cid={pigcms{$fcid}">重选类别</a>&gt; <a href="javascript:;"><h1 style="color:#F76120">填写 {pigcms{$fabuset['cat_name']} 信息</h1></a> </span> 
  </div> 
  <hr /> 
  <div class="bind_mark"></div> 
  <div style="margin: 0px 0px 10px 10px;"><span>注意：有红色星号的为必填项</span></div>
  <!-- form start --> 
  <form id="mpostForm" name="mpostForm" action="{pigcms{:U('Classify/fabuTosave',array('cid'=>$cid))}" method="post" style="margin-bottom: 100px;"> 
   <ul class="list">
     <li class="item"> 
     <div class="title">
      <span><strong style="color:red;">*</strong>标题：</span>
      <div class="placeholder"></div>
     </div> 
     <div class="input"> 
      <input name="tname" id="tname"  value="" type="text" style="width: 90%;height: 30px;"/> 
     </div> 
     <div class="tip"></div>
	 </li>
	 <li class="item"> 
     <div class="title">
      <span><strong style="color:red;">*</strong>联系人名字：</span>
      <div class="placeholder"></div>
     </div> 
     <div class="input"> 
      <input name="lxname" id="lxname"  value="" type="text" style="width: 90%;height: 30px;"/> 
     </div> 
     <div class="tip"></div>
	 </li>
	<li class="item"> 
     <div class="title">
      <span><strong style="color:red;">*</strong>联系手机号：</span>
      <div class="placeholder"></div>
     </div> 
     <div class="input"> 
      <input name="lxtel" id="lxtel"  value="" onkeyup="value=value.replace(/[^1234567890]+/g,'')" placeholder="请填正确联系手机号" type="text" style="width: 90%;height: 30px;"/> 
     </div> 
     <div class="tip"></div>
	 </li>
	 <!----1单文本框--2单选框--3复选框--4下拉框--5多文本框---->
	 <if condition="!empty($subdir)">
	 <li class="item"> 
			<div class="title">
			<span>选择分类：</span>
			<div class="placeholder"></div>
			</div> 
			<div class="input"> 
			<div class="select">
			<label class="psu">请选择</label>
			<select class="decorate" name="subdir">
			<option value="">请选择</option>
			<volist name="subdir" id="opt">
			 <option value="{pigcms{$opt['cid']}">{pigcms{$opt['cat_name']}</option>
			</volist>
			</select>
			</div>
			<span></span> 
			<div class="select" style="display: none;" type="subcate">
			<label class="psu">请选择</label>
			</div>
			</div> 
			<div class="tip"></div>
		</li>
		</if>
	 <if condition="!empty($catfield)">
	  <volist name="catfield" id="vv" key="kk">
	  <if condition="$vv['type'] eq 1" >
		<li class="item"> 
			<div class="title">
			<span><php>if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>';</php>{pigcms{$vv['name']}：</span>
			<div class="placeholder"></div>
			</div> 
			<div class="input"> 
			 <input name="input[{pigcms{$kk}][vv]"  value="" type="text" <php>if($vv['inarr']==1)echo 'onkeyup="value=value.replace(/[^1234567890]+/g,'."''".')" placeholder="请填数字"';</php> <php>if(($vv['inarr']==1) && !empty($vv['inunit'])){echo 'class="inputtext01"';}else{echo 'class="inputtext02"';}</php>/> <php>if(($vv['inarr']==1) && !empty($vv['inunit']))echo "&nbsp;".$vv['inunit'];</php>
			 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][unit]"  value="{pigcms{$vv['inunit']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][inarr]"  value="{pigcms{$vv['inarr']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][type]"  value="1"  type="hidden" />
			</div> 
			<div class="tip"></div>
		</li>
	  <elseif condition="$vv['type'] eq 2" />
		<li class="item"> 
			<div class="title">
			<span>{pigcms{$vv['name']}：<php>if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>';</php></span>
			<div class="placeholder"></div>
			</div> 
			<div class="input danfux">
			<volist name="vv['opt']" id="opt">
			<label><input name="input[{pigcms{$kk}][vv]" type="radio" value="{pigcms{$opt}" /> {pigcms{$opt}</label> 
			<php>if($mod==1) echo '<br/>';</php>
			</volist>
			 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][type]"  value="2"  type="hidden" />
			</div> 
			<div class="tip"></div> 
		</li> 
	  <elseif condition="$vv['type'] eq 3" />
		<li class="item"> 
			<div class="title">
			<span>{pigcms{$vv['name']}：</span>
			<div class="placeholder"></div>
			</div> 
			<div class="input danfux"> 
			<volist name="vv['opt']" id="opt">
			 <label><input name="input[{pigcms{$kk}][vv][]" type="checkbox"  value="{pigcms{$opt}"/> {pigcms{$opt}</label>
			 
			</volist>
			 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][type]"  value="3"  type="hidden" />
			</div> 
			<div class="tip"></div> 
		</li> 
	  <elseif condition="$vv['type'] eq 4" />
		<li class="item"> 
			<div class="title">
			<span>{pigcms{$vv['name']}：<php>if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>';</php></span>
			<div class="placeholder"></div>
			</div> 
			<div class="input"> 
			<div class="select">
			<label class="psu">请选择</label>
			<select class="decorate" name="input[{pigcms{$kk}][vv]">
			<option value="">请选择</option>
			<volist name="vv['opt']" id="opt">
			 <option value="{pigcms{$opt}">{pigcms{$opt}</option>
			</volist>
			</select>
			 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][type]"  value="4"  type="hidden" />
			</div>
			<span></span> 
			<div class="select" style="display: none;" type="subcate">
			<label class="psu">请选择</label>
			</div>
			</div> 
			<div class="tip"></div>
		</li> 
	  <elseif condition="$vv['type'] eq 5" />
		<li class="item"> 
		<div class="title">
		<span>{pigcms{$vv['name']}：<php>if($vv['iswrite']>0)echo '<strong style="color:red;">*</strong>';</php></span>
		<div class="placeholder"></div>
		</div> 
		<div class="input"> 
		<textarea id="Content" name="input[{pigcms{$kk}][vv]" class="myborder"  style="width: 90%;"></textarea> 
		 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
		 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
		 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
		 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
		 <input name="input[{pigcms{$kk}][type]"  value="5"  type="hidden" />
		</div> 
		<div class="tip"></div> 
		</li> 
	  </if>
	  </volist>
	 </if>
    <li class="item"> 
		<div class="title">
		<span>说明描述：</span>
		<div class="placeholder"></div>
		</div> 
		<div class="input"> 
		<textarea id="Content" name="description" class="myborder"  placeholder="写上一些想要说明的内容" style="width: 90%;"></textarea>
		</div> 
		<div class="tip"></div> 
		</li>
  <if condition="$fabuset['isupimg'] eq 1">
    <li class="item uploadNum" id="uploadNum">还可上传<span class="leftNum orange">8</span>张图片，已上传<span class="loadedNum orange">0</span>张(非必填)</li> 
    <li class="item"> 
     <div class="upload_box"> 
      <ul class="upload_list clearfix" id="upload_list"> 
       <li class="upload_action"> <img src="{pigcms{$static_path}classify/upimg.png" /> <input type="file" accept="image/jpg,image/jpeg,image/png,image/gif" id="fileImage" name="" /> </li> 
      </ul> 
     </div>
    </li>
  </if>
   </ul> 
   <div class="post"> 
    <input type="hidden" id="Pic" name="" /> 
    <input type="hidden" name="cid" value="{pigcms{$cid}" /> 
	<input type="hidden" name="fcid" value="{pigcms{$fcid}" /> 
    <input id="btnPost" type="submit" value="发 布" onclick="return submit_FBI()"/> 
   </div> 
  </form> 
  <script src="{pigcms{$static_path}classify/exif.js"></script> 
  <script src="{pigcms{$static_path}classify/imgUpload.js"></script> 
  <!--<div id="pubOK">
   <div>
    <div class="message">
     发布成功，您可以在“个人中心-我的发布”中查看和操作该信息。
    </div>
    <div class="btn">
     <input type="button" value="我的发布" onclick="" />
     <input type="button" value="关闭" onclick="" />
    </div>
   </div>
  </div>
  <div id="pubFail">
   <div>
    <div class="message">
     信息发布失败。
    </div>
    <div class="btn">
     <input type="button" value="关闭" />
    </div>
   </div>
  </div>--->
  <include file="Classify:footer"/>
 <script type="text/javascript">
   function submit_FBI(){
	 var telnum=$.trim($('#lxtel').val());
	 if(!/^0[0-9\-]{10,13}$/.test(telnum) && !/^((\+86)|(86))?(1)\d{10}$/.test(telnum)){
		   alert('联系手机号格式不对');
	       return false;
		}else{
			return true;
		}
		//document.ostForm.submit();	
	}


        $("select").bind("change",
        function() {
            selectChange($(this))
        })
    
    function selectChange(obj, objtext) {
        var value = obj.val();
		var htmlobj=obj.get(0);		
        var text = $(htmlobj.options[htmlobj.selectedIndex]).text();
        var msg = obj.attr("msg");
        var pattern2 = obj.attr("pattern2");
        obj.parent().children("label").text(text);
            var subcate = obj.parent().parent().children("[type=subcate]");
            var selects = subcate.find("select");
            if (selects) {
                selects.remove()
            }
            if (subcate.length > 0) {
                subcate.children("label").text("请选择").parent().css("display", "none")
            }
       
    }
$(function() {
    if ($(".upload_list").length) {
        var imgUpload = new ImgUpload({
            fileInput: "#fileImage",
            container: "#upload_list",
            countNum: "#uploadNum",
			url:"http://" + location.hostname + "/wap.php?g=Wap&c=Classify&a=ajaxImgUpload"
        })
    }
});
 </script>
 </body>
</html>