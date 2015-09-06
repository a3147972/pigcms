<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <title>{pigcms{$cat_name}</title> 
  <meta name="keywords" content="{pigcms{$classify['seo_keywords']}" /> 
  <meta name="description" content="{pigcms{$classify['seo_description']}" /> 
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/base.css" />
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/listui.css" />
  <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}classify/common.css" />
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <style type="text/css">
   #pageHtml{font-size: 20px;}
   #pageHtml .current{border: 1px solid #e1e1e1;display:inline-block; height:30px;line-height:30px;width:35px;background-color:#e71;color:#fff;margin: 0 1px;padding: 0 0 0 1px;}
   #pageHtml a{height: 30px;line-height: 30px;}
   #pageHtml .pga{ border: 1px solid #e1e1e1;width: 35px;}
  </style>
 </head> 
 <body> 
  <div id="site-mast" class="site-mast"><include file="topbar"/></div> 
  <!--<div id="header"> 
   <span id="logo">
	 <a href="/" target="_blank"><img src="{pigcms{$config.site_logo}" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="{pigcms{$siteUrl}/classify/" class="classify">分类信息</a>
	 </span>
   <span class="fl"><a href="{pigcms{:U('Classify/SelectSub',array('cid'=>0))}" target="_blank" class="postBtn" rel="nofollow"></a></span> 
   <div class="nav">
    <a href="{pigcms{$siteUrl}/classify/">首页</a> 
	<if condition="!empty($fcidinfo)">
    <cite></cite>&nbsp; 
    <a href="{pigcms{:U('Classify/Subdirectory',array('cid'=>$fcidinfo['cid']))}">{pigcms{$fcidinfo['cat_name']}</a> 
	</if>
    <cite></cite>&nbsp; 
    <a href="{pigcms{:U('Classify/Lists',array('cid'=>$cid,'subdir'=>$sub3dir))}">{pigcms{$cat_name}</a> 
   </div> 
  </div> -->
  <div id="homeWrap" class="wrapper"> 
   <div id="header"  class="mainpage"> 
    <div id="headerinside">
     <if condition="isset($config['classify_logo']) AND !empty($config['classify_logo'])">
	 <span id="logo" style="top:10px">
	 <a href="{pigcms{$siteUrl}/classify/" target="_blank"><img src="{pigcms{$config.classify_logo}" alt="分类信息" title="分类信息" width="180" height="58" /></a>
	 </span>
	 <else/>
	 <span id="logo">
	 <a href="/" target="_blank"><img src="{pigcms{$config.site_logo}" alt="分类信息" title="分类信息" width="160" height="45" /></a>
	 <a href="{pigcms{$siteUrl}/classify/" class="classify">分类信息</a>
	 </span>
	 </if>
     <form action="{pigcms{$siteUrl}/classify/searchlist.html" method="get" name="mysearch"> 
      <div id="searchbar"> 
       <div id="saerkey"> 
        <span><input type="text" id="keyword" name="keystr" class="keyword" value="找你所找，寻你所寻" onblur="if(this.value=='')this.value='找你所找，寻你所寻',this.className='keyword'" onfocus="if(this.value=='找你所找，寻你所寻')this.value='',this.className='keyword2'" /></span> 
       </div> 
       <div class="inputcon">
        <input type="submit" class="btnall" value="搜一搜" onmousemove="this.className='btnal2'" onmouseout="this.className='btnall'" />
       </div> 
       <div class="clear"></div> 
       <div class="search-no"> 
        <span id="hot"></span>
        <span class="hot2"></span> 
       </div> 
      </div> 
     </form> 
     <a href="{pigcms{$siteUrl}/classify/selectsub.html" id="fabu" rel="nofollow"><i></i>免费发布信息</a>
     <!--<a href="{pigcms{:U('Classify/myCenter')}" id="delinfo" rel="nofollow" class="search-no">个人中心</a>---> 
    </div> 
   </div> 
   <div class="hShadow"></div> 
   <div class="navcon" id="nav"> 
    <ul class="nav2"> 
     <li><a href="{pigcms{$siteUrl}/classify/">首页</a></li> 
	 <if condition="!empty($navClassify)">
	  <volist name="navClassify" id="nav">
       <li <if condition="$nav['cid'] eq $fcid">class="on"</if>><a href="{pigcms{$siteUrl}/classify/subdirectory-{pigcms{$nav['cid']}.html">{pigcms{$nav['cat_name']}</a></li>
	  </volist>
	 </if>
    </ul> 
    <div id="1003" class="ad_nav"></div> 
   </div> 
  </div> 
  
    <if condition="!empty($classify_index_ad)">
    <div class="pc_banner mainpage"> 
    <ul>
	 <volist name="classify_index_ad" id="adimg">
     <li> <a href="{pigcms{$adimg['url']}" target="_blank">  <img src="{pigcms{$adimg['pic']}" alt="{pigcms{$adimg['name']}" /></a></li>
	 </volist>
    </ul> 
	
    <div class="banner_icon">
	 <volist name="classify_index_ad" id="adimg">
     <i alt="{pigcms{$i}" <if condition="$i eq 1">class="active"</if>></i>
	 </volist>
    </div> 
	<span class="banner-close" onclick="bannerClose();">&nbsp;</span>
   </div>
    </if>

  <div id="brand_list_top_banner"></div> 
  <div id="selection" class="mainpage" style="padding-top:15px;margin-top:10px">
       <if condition="!empty($otherList)">
		<div id="searchtree">
		<i class="line"></i>
		<dl class="selectbar2 clearfix">
		<dd class="clearfix">
		<ul class="s_ul">
		<volist name="otherList" id="olv">
		  <php>if(!($olv['tt'] > 0)) continue;</php>
		 <if condition="$olv['cid'] eq $cid AND $olv['sub3dir'] eq $sub3dir">
		     <li class="selected_wrap"><strong>{pigcms{$olv['cat_name']}<i>（{pigcms{$olv['tt']}）</i></strong></li>
			<else/>
			<li><a href="{pigcms{$olv['url']}">{pigcms{$olv['cat_name']}</a><i>（{pigcms{$olv['tt']}）</i></li>
		 </if>
		 
		</volist>
		
		</ul>
		<!--<span class="morebtn b1" name="cateswitch"><a href="javascript:void(0);"></a></span>-->
		</dd>
		</dl>
		<i class="line"></i>
		</div>
	    </if>

    <if condition="!empty($subdir3all)">
   <dl class="secitem"> 
    <dt>
	类别： 
    </dt> 
    <dd>
	 <a <if condition="$sub3dir eq 0">class="select"</if> href="{pigcms{$siteUrl}/classify/list-{pigcms{$cid}.html">不限</a> 
	 <volist name="subdir3all"  id="s3c">
	   <a <if condition="$sub3dir eq $s3c['cid']">class="select"</if> href="{pigcms{$siteUrl}/classify/list-{pigcms{$cid}-{pigcms{$s3c['cid']}.html">{pigcms{$s3c['cat_name']}</a> 
	 </volist>
	</dd>
	</dl> 
	</if>

 	<if condition="!empty($conarr)">
	<php>$jsonarr=array();</php>
	 <volist name="conarr" id="value">
	 <php>$jsonarr[$value['input']]=array();</php>
   <dl class="secitem"> 
    <dt>
	{pigcms{$value['name']}： 
    </dt> 
    <dd>
	<a <if condition="!isset($mywhere[$value['input']])">class="select"</if> href="javascript:;" onclick="ProcessInquiryStr('{pigcms{$value['input']}','');">不限</a> 
	<volist name="value['data']" key="kk" id="dv">
		 <php>$dv=trim($dv);if(($value['opt']==1) && ($kk==1) && (strpos($dv, '-') === false)){
		        $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=0-".$dv;
		    }elseif(($value['opt']==1) && ($kk>1) && (strpos($dv, '-') === false)){
			    $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv."-0";
			}else{
			    $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv;
			}

		    $opt=base64_encode($opt);
			$jsonarr[$value['input']][]=$opt;
		 </php>
     
      <a  <if condition="isset($mywhere[$value['input']]) AND ($mywhere[$value['input']] eq $dv || str_replace(array('0-','-0'),'',$mywhere[$value['input']]) eq $dv)">class="select"</if> href="javascript:;" onclick="ProcessInquiryStr('{pigcms{$value['input']}','{pigcms{$opt}');">{pigcms{$dv}</a>
	 </volist>
    </dd> 
   </dl> 

     </volist>
   </if>
   <br /> 
   <!-- =S header-search --> 
   <div id="SearchForm" class="header-search"> 
   
     <span class="search-input fl"><input class="but-wd c_000" id="keyword1" autocomplete="off" maxlength="100" type="text" <if condition="isset($qstr) AND !empty($qstr)">value="{pigcms{$qstr}"</if>/></span> 
     <span class="fl"><input type="button" id="searchbtn1" class="but-bl" value="搜本类" onclick="ToSearchWord(1);" /></span> 
	 <span class="selfcata"><input type="button" id="searchbtn2" class="but-bl" onclick="ToSearchWord(2);" value="搜全站"></span>
   </div> 

   <!-- =E header-search --> 
   <i class="shadow"></i> 
   <input style="display: none;" id="selected" type="hidden" /> 
  <div class="barct"> </div>
  </div> 
  <div class="tabsbar mainpage"> 
   <div class="list-tabs"> 
    <a title="{pigcms{$cat_name}" class="sel" href="{pigcms{$siteUrl}/classify/list-{pigcms{$cid}-{pigcms{$sub3dir}.html"><span><h1>{pigcms{$cat_name}</h1></span></a> 
   </div> 
  </div> 
  <!-- =S mainlist --> 
  <div id="mainlist" class="clearfix pr mainpage"> 
   <!-- =S infolist 左侧列表主体 --> 
   <div id="infolist"> 
    <div class="filterbar"> </div> 
    <table class="tbimg" cellpadding="0" cellspacing="0"> 
     <tbody> 
	   <if condition="!empty($listsdatas)">
        <volist name="listsdatas" id="vl">
      <tr> 
       <td class="img"> 
	    <a <if condition="empty($vl['jumpUrl'])"> href="{pigcms{$siteUrl}/classify/{pigcms{$vl['id']}.html" <else/> href="{pigcms{$vl['jumpUrl']}"</if> target="_blank"> <if condition="isset($vl['imgthumbnail'])"><img src="{pigcms{$vl['imgthumbnail']}" alt="" /><else/><img src="{pigcms{$static_path}classify/img/noimg.jpg" alt="" /></if> </a>
	   </td> 
       <td class="t"> 
	   <a <if condition="empty($vl['jumpUrl'])"> href="{pigcms{$siteUrl}/classify/{pigcms{$vl['id']}.html" <else/> href="{pigcms{$vl['jumpUrl']}"</if> target="_blank" class="t"><span class="bt" <if condition="!empty($vl['btcolor'])">style="color:{pigcms{$vl['btcolor']}"</if>> <if condition="isset($qstr) AND !empty($qstr)"> {pigcms{$vl['title']|str_replace=$qstr,'<b>'.$qstr.'</b>',###}<else/>{pigcms{$vl['title']}</if></span>
	   <if condition="$vl['toptime'] gt 0">
	   &nbsp;<span class="ico ding"></span>
	   </if>
	   </a>
	   <i class="clear"></i> 
	   <p><if condition="isset($qstr) AND !empty($qstr)">{pigcms{$vl['input1']|str_replace=$qstr,'<b class="showsearch">'.$qstr.'</b>',###}<else/>{pigcms{$vl['input1']}</if></p> <p><if condition="isset($qstr) AND !empty($qstr)">{pigcms{$vl['input2']|str_replace=$qstr,'<b class="showsearch">'.$qstr.'</b>',###}<else/>{pigcms{$vl['input2']}</if></p><i class="clear"></i> </td> 

       <td class="tc"><if condition="isset($qstr) AND !empty($qstr)">{pigcms{$vl['input3']|str_replace=$qstr,'<b class="showsearch">'.$qstr.'</b>',###}<else/>{pigcms{$vl['input3']}</if></td>
	   
       <td>
			<p style="float:right;color:#ff7201;">{pigcms{$vl['timestr']}</p>
			<if condition="isset($qstr) AND !empty($qstr)">{pigcms{$vl['input4']|str_replace=$qstr,'<b class="showsearch">'.$qstr.'</b>',###}<else/>{pigcms{$vl['input4']}</if>
		</td> 
      </tr>
	  </volist>
	  <else/>
      <tr> 
	  <td colspan=3 style="text-align:center;font-size: 25px;font-weight: bold;text-align: center; height: 100px;line-height: 100px;">没有数据！</td>
      </tr>
	  </if>
      
     </tbody> 
    </table> 

    <div class="pager mb10" id="pageHtml"> 
		{pigcms{$pagebar}
    </div> 
   </div> 
  
  </div> 
  <include file="Classify:footer"/>
  <div class="clear"></div>
 </body>
 <script  src="{pigcms{$static_path}classify/banner.js"></script> 
  <script type="text/javascript">
  var optJsonData={};
  var RequestUrl='{pigcms{$thisurl}';
  var optStr=window.location.search;
  <php>if(isset($jsonarr) && !empty($jsonarr)) echo 'optJsonData='.json_encode($jsonarr).';';</php>

   function ProcessInquiryStr(typ,optv){
	  var pi_Str='';
	  if(optStr.indexOf('opt=')>-1){
        var tmp =optStr.split('opt=');
	    var opt_str=$.trim(tmp[1]);
		opt_str=opt_str.replace(/&page=\d+/,'');
		var optArr=opt_str ? opt_str.split('-') : new Array();
		var tmpstr='';
		var flage=false;
		for(i=0;i<optArr.length;i++){
		   $.each(optJsonData,function(kk,vv){
		       tmpstr='ff|'+vv.join('|')+'|ff';
			   if(tmpstr.indexOf(optArr[i])>0){
			       if(kk==typ){
					  if(optv){
				        optArr[i]=optv;
					  }else{
					    optArr.splice(i,1);
					  }
					  flage=true;
				   }
			   }
		   
		   });
		}
		if(!flage && optv){
		   optArr.push(optv);
		}
		if(optArr.length>1){
		  pi_Str=optArr.join('-');
		}else if(optArr.length==1){
		   pi_Str=optArr[0];
		}else{
		   pi_Str='';
		}
	  }else{
	    pi_Str=optv;
	  }
	  if(pi_Str){
		  window.location.href=RequestUrl+'?opt='+pi_Str;
		}else{
		  window.location.href=RequestUrl;
		}
	  
    }
  </script>
     <script type="text/javascript">
		$(document).ready(function () {
		    $("#keyword1").keydown(function () {
		        $("#keyword1").attr("style","color: rgb(0, 0, 0);"); //黑色
		    });
			$("#keyword1").click(function() { 
    			if($.trim($(this).val()) == "输入类别或关键字") { 
    				$(this).val("");
    				$(this).attr("style", "color:rgb(153, 153, 153);"); //灰色
    			}
    		});
    		$("#keyword1").blur(function() { 
    			if($.trim($(this).val()) == "") { 
    				$(this).val("输入类别或关键字");
    				$(this).attr("style", "color:rgb(153, 153, 153);"); //灰色
    			}
    		});
		});

		function ToSearchWord(ty) {
    		var keyword = $.trim($("#keyword1").val());
    		if(keyword == "" || keyword == "输入类别或关键字") {
    			$("#keyword1").val("输入类别或关键字");
    			$("#keyword1").attr("style","color: rgb(153, 153, 153);"); //灰色
    			return false;
    		}else{
				 if(ty==1){
				    window.location.href="{pigcms{$siteUrl}/classify/searchlist-{pigcms{$cid}-{pigcms{$sub3dir}.html?keystr="+keyword;
				 }else if(ty==2){
				    window.location.href="{pigcms{$siteUrl}/classify/searchlist.html?keystr="+keyword;
				 }
			}
    		return true;
    	}
	  </script> 
</html>