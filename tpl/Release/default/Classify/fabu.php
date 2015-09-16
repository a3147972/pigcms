<!DOCTYPE html>
<html class="" xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>信息发布</title> 
  <link type="text/css" rel="stylesheet" href="{pigcms{$static_path}classify/fabuinput.css" media="all" /> 
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/postui7.css" media="all" />  
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
			kind_editor = K.create("#description",{
				width:'400px',
				height:'320px',
				resizeType : 1,
				allowPreviewEmoticons:false,
				allowImageUpload : true,
				filterMode: true,
				items : [
					'source', '|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link'
				],
				emoticonsPath : './static/emoticons/',
				uploadJson : "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news"
			});
		});
	</script>
<style type="text/css">
.webuploader-container {
    position: relative;
}
.J-pic-thumbnail , .pic-item--add{ height: 110px;width: 120px;}

.webuploader-element-invisible {
    clip: rect(1px, 1px, 1px, 1px);
    position: absolute !important;
}
.pic-item--add .add-btn-plusicon {
   border: 1px dashed #ccc;
    color: #e4e4e4;
    display: block;
    font-size: 130px;
    height: 100px;
    line-height: 100px;
    padding: 3px 0;
    text-align: center;
    text-shadow: 0 -1px #d0d0d0;
}
#picupimg li {float:left;margin-right: 15px;margin-right: 15px; position: relative;}

.pic-item__remove {
    background-color: #1F1E1E;
    bottom: 1px;
    height: 23px;
    left: 0;
    position: absolute;
    width: 120px;
	opacity: 0.5;
	font-size: 24px;
   text-align: right;
   line-height: 23px;
}
#picupimg a:link, #picupimg a:visited{
 color:#FFF;
}
#postheader {
    margin: 5px auto;
    width: 1200px;
	position: relative;
}

a {
    color: #15c;
    cursor: pointer;
    text-decoration: none;
}
a:hover{color: red;}
.expand{margin-left:130px;}
</style>
 </head> 
 <body> 
 <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
     <if condition="isset($config['classify_logo']) AND !empty($config['classify_logo'])">
	 <header id="postheader" style="height:60px;margin-bottom: 15px;">
	 <span id="logo" style="top:12px;">
	 <a href="{pigcms{$siteUrl}/classify/" target="_blank"><img src="{pigcms{$config.classify_logo}" alt="分类信息" title="分类信息" width="180" height="58" /></a>
	 </span>
	 </header> 
	 <else/>
	 <header id="postheader" style="height:58px">
	 <span id="logo" style="top:12px;">
	 <a href="/" target="_blank"><img src="{pigcms{$config.site_logo}" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="{pigcms{$siteUrl}/classify/" class="classify">分类信息</a>
	 </span>
	 </header> 
	 </if>
   <!--<h2 class="sub_title"><b>合肥</b></h2>--> 
  
  <section id="stepbar" class="step_n_2">
   <div class="step"> 
    <ol class="cols3">
     <li class="step_1"><span class="num">1</span><span class="maintxt">{pigcms{$cat_name}</span><span class="subtxt">（<a href="{pigcms{$siteUrl}/classify/selectsub.html">重选类别</a>）</span><span class="l"></span><span class="r"></span></li>
     <li class="step_2"><span class="num">2</span><span class="maintxt">填写详情</span><span class="subtxt">（<a href="{pigcms{$siteUrl}/classify/select2sub-{pigcms{$fcid}.html">重选小类别</a>）</span><span class="l"></span><span class="r"></span></li>
     <li class="step_3"><span class="num">3</span><span class="maintxt">填写详情</span><span class="l"></span><span class="r"></span></li>
    </ol> 
   </div>
  </section> 
  <div id="contentPost" class="mb15"> 
   <!-- =S expand 详细描述 --> 
   <form action="{pigcms{:U('Classify/fabuTosave',array('cid'=>$cid))}" name="aspnetForm" method="post"> 
    <section class="expand"> 
     <table class="formTable" id="formTb"> 
      <colgroup>
       <col width="110" /> 
       <col width="*" /> 
      </colgroup>
      <tbody>
	   <tr>
        <th><em class="red">*</em>标题：</th>
        <td><input name="tname" id="tname"  value="" type="text" class="txt" style="width: 350px;"/> <span class="msg_Tip"></span></td>
       </tr> 
	<if condition="!empty($subdir)">
			<tr>
			<th>选择分类：</th>
			<td>
			<select name="subdir" style="width: 270px;">
			<option value="">请选择</option>
				<volist name="subdir" id="opt">
			     <option value="{pigcms{$opt['cid']}">{pigcms{$opt['cat_name']}</option>
			   </volist>
			</select>
			<span class="msg_Tip"></span>
			</td>
			</tr>
		</if>
	 <!----1单文本框--2单选框--3复选框--4下拉框--5多文本框---->
	 <if condition="!empty($catfield)">
	  <volist name="catfield" id="vv" key="kk">
	  <if condition="$vv['type'] eq 1" >
		<tr> 
        <th><php>if($vv['iswrite']>0)echo '<em class="red">*</em>';</php>{pigcms{$vv['name']}：</th> 
        <td> 
          <input type="text" name="input[{pigcms{$kk}][vv]" autocomplete="off" style="width: 350px;" class="txt"  <php>if($vv['inarr']==1)echo 'onkeyup="value=value.replace(/[^1234567890]+/g,'."''".')" placeholder="请填数字"';</php> > <php>if(($vv['inarr']==1) && !empty($vv['inunit']))echo "&nbsp;".$vv['inunit'];</php> 
          <span class="msg_Tip"></span> 
			 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][unit]"  value="{pigcms{$vv['inunit']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][inarr]"  value="{pigcms{$vv['inarr']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][type]"  value="1"  type="hidden" />
		 </td> 
       </tr>
	   <elseif condition="$vv['type'] eq 2" />
			<tr>
			<th><php>if($vv['iswrite']>0)echo '<em class="red">*</em>';</php>{pigcms{$vv['name']}：</th>
			<td>
			
				<volist name="vv['opt']" id="opt">
				<label class="mr15"><input name="input[{pigcms{$kk}][vv]" type="radio" value="{pigcms{$opt}"  class="base"/> {pigcms{$opt}</label> 
				</volist>
				<span class="msg_Tip"></span>
				<input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			    <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			   <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			   <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			   <input name="input[{pigcms{$kk}][type]"  value="2"  type="hidden" />
			</td>
			</tr>
	   <elseif condition="$vv['type'] eq 3" />
			<tr>
			<th><php>if($vv['iswrite']>0)echo '<em class="red">*</em>';</php>{pigcms{$vv['name']}：</th>
			<td>
			
				<volist name="vv['opt']" id="opt">
				<label class="mr15"><input name="input[{pigcms{$kk}][vv][]" type="checkbox" value="{pigcms{$opt}"  class="base"/> {pigcms{$opt}</label> 
				</volist>
				<span class="msg_Tip"></span>
				<input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			    <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			    <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			    <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			   <input name="input[{pigcms{$kk}][type]"  value="3"  type="hidden" />
			</td>
			</tr>
	   <elseif condition="$vv['type'] eq 4" />
			<tr>
			<th><php>if($vv['iswrite']>0)echo '<em class="red">*</em>';</php>{pigcms{$vv['name']}：</th>
			<td>
			<select name="input[{pigcms{$kk}][vv]" style="width: 270px;">
			<option value="">请选择</option>
			<volist name="vv['opt']" id="opt">
			 <option value="{pigcms{$opt}">{pigcms{$opt}</option>
			</volist>
			</select>
			<span class="msg_Tip"></span>
			 <input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			 <input name="input[{pigcms{$kk}][type]"  value="4"  type="hidden" />
			</td>
			</tr>
	   <elseif condition="$vv['type'] eq 5" />
			<tr>
			<th><php>if($vv['iswrite']>0)echo '<em class="red">*</em>';</php>{pigcms{$vv['name']}：</th>
			<td>
			<textarea id="Content" name="input[{pigcms{$kk}][vv]" style="width: 350px;height:130px"></textarea> 
			<input name="input[{pigcms{$kk}][tn]"  value="{pigcms{$vv['name']}"  type="hidden" />
			<input name="input[{pigcms{$kk}][input]"  value="{pigcms{$vv['input']}"  type="hidden" />
			<input name="input[{pigcms{$kk}][iswrite]"  value="{pigcms{$vv['iswrite']}"  type="hidden" />
			<input name="input[{pigcms{$kk}][isfilter]"  value="{pigcms{$vv['isfilter']}"  type="hidden" />
			<input name="input[{pigcms{$kk}][type]"  value="5"  type="hidden" />
			</td>
			</tr>
	   </if>
	   </volist>
     </if>
      <tr> 
        <th><em class="red">*</em>联系人</th> 
        <td> <input name="lxname" id="lxname" class="txt" type="text" style="width: 350px;"/> <span class="msg_Tip"></span> </td> 
       </tr> 
       <tr> 
        <th><em class="red">*</em>联系电话</th> 
        <td><input class="txt" id="lxtel" name="lxtel"  type="text" onkeyup="value=value.replace(/[^1234567890]+/g,'')" placeholder="请填正确联系手机号" style="width: 350px;"/> <span class="msg_Tip"></span></td> 
       </tr>
	   	<tr>
			<th>说明描述：</th>
			<td>
			<textarea id="description" name="description"  placeholder="写上一些想要说明的内容"></textarea> 
			</td>
	</tr>
 <if condition="$fabuset['isupimg'] eq 1">
	   <tr>
          <th>上传图片</th>
                <td style="line-height: 30px; padding-bottom: 0px;">
			<ul class="J-pic-list pic-list cf" id="picupimg">
			   <li class="pic-item--add pic-item J-item-add">
					<div class="yui3-widget yui3-uploader">
						<div class="yui3-uploader-content">
							<a class="J-pic-add-btn" href="javascript:void(0);" tabindex="0" style="width:100%;height:100%;"><span class="add-btn-plusicon">+</span><span class="add-btn-text" style="display: none;">上传图片</span></a>
						</div>
					</div>
				</li>
			</ul>
             </td>
           </tr> 
		  </if>
       <tr> 
        <th>&nbsp;</th> 
        <td style="padding-top:35px;">
		    <input type="hidden" name="cid" value="{pigcms{$cid}" /> 
	        <input type="hidden" name="fcid" value="{pigcms{$fcid}" /> 
		<span class="fabubtn1"><input class="fabu1" value="确认并发布" type="submit" /></span> </td> 
       </tr> 
      </tbody>
     </table> 
    </section> 
 
   </form> 
   <!-- =E expand --> 
  </div> 
  <!-- =E content --> 
  <!-- =S footer --> 
  <!-- =E footer --> 
  <div style="display:none"> 
   <input class="base" value="1" name="IsBiz" type="checkbox" /> 
  </div> 
  
  <script src="{pigcms{$static_public}js/webuploader.min.js"></script>
  <script type="text/javascript">
   $('.pic-item--add .add-btn-plusicon').hover(function(e){
	 $(this).addClass('hover');
     
  },function(e){

  });
		$(function(){
			if ( !WebUploader.Uploader.support() ) {
				alert( '您的浏览器不支持晒图功能！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
				$('.J-pic-list-wrapper').remove();
			}
			$('.J-orders-filter').change(function(){
				window.location.href = $(this).val();
			});
			
			var pic_btn_obj = null;
			$('.J-pic-add-btn').click(function(){
				pic_btn_obj = $(this);
			});
			var  uploader = WebUploader.create({
				auto: true,
				swf: '{pigcms{$static_public}js/Uploader.swf',
				server: "{pigcms{:U('Classify/ajax_upload_pic')}",
				pick: '.J-pic-add-btn',
				accept: {
					title: 'Images',
					extensions: 'gif,jpg,jpeg,png',
					mimeTypes: 'image/*'
				}
			});
			uploader.on('fileQueued',function(file){
				if(pic_btn_obj.closest('.J-pic-list').find('.J-pic-thumbnail,.pic-item--loading').size() < 10){
					pic_btn_obj.closest('.J-pic-list-wrapper').addClass('pic-list-wrapper--withpic');
					var pic_loading_dom = $('<li>').attr('class','J-pic-thumbnail pic-item pic-item--loading loading-'+file.id);
					
					if(pic_btn_obj.closest('.J-pic-list').find('.J-pic-thumbnail').size() > 1){
						pic_btn_obj.closest('.J-pic-list').find('.J-pic-thumbnail:last').after(pic_loading_dom);
					}else{
						pic_btn_obj.closest('.J-pic-list').prepend(pic_loading_dom);
					}
				}else{
					uploader.cancelFile(file);
				}
			});
			uploader.on('uploadProgress',function(file,percentage){
				
			});
			uploader.on('uploadBeforeSend',function(block,data){
				
			});
			
			uploader.on('uploadSuccess',function(file,response){
				if(response.error == '0'){
					//if(response.data){
					  $.each(response.data,function(kk,vv){
					     $('.loading-'+response.id).replaceWith('<li class="J-pic-thumbnail pic-item"><input type="hidden" name="inputimg[]" value="'+response.imgurl+vv.savename+'"><img src="'+response.urlpath+vv.savename+'" width="120" height="110"/><a href="javascript:void(0);" class="pic-item__remove" uploader_id="'+file.id+'" hidden="hidden" style="display:none;">X&nbsp;</a></li>');
					  });
					//}
				}else{
					$('.loading-'+response.id).remove();
					alert(response.data);
				}
			});

			uploader.on('uploadError', function(file,reason){
				$('.loading'+file.id).remove();
				alert('上传失败！请重试。');
			});
			
			//已上传图片点击
			$('.J-pic-thumbnail').live('hover',function(event){
				if(event.type == 'mouseenter'){ 
					$(this).find('.pic-item__remove').show();
				}else{
					$(this).find('.pic-item__remove').hide();
				}
			});
			$('.pic-item__remove').live('click',function(){
				var now_dom = $(this);
				//$.post("{pigcms{:U('Rates/ajax_del_pic')}",{order_id:now_dom.attr('order-id'),pic_id:now_dom.attr('pic-id')});
				now_dom.closest('.J-pic-thumbnail').remove();
				uploader.cancelFile(now_dom.attr('uploader_id'));
			});
	
		
		});
  </script> 
  
 </body>
</html>