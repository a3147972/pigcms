<!DOCTYPE html>
<html lang="zh-CN">
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="location" content="" /> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="email=no" /> 
  <meta name="format-detection" content="address=no;" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
  <title>{pigcms{$cat_name}</title> 
  <meta name="keywords" content="" /> 
  <meta name="descripiton" content="" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script>
  <link rel="stylesheet" href="{pigcms{$static_path}classify/mlist.css" /> 
  <style type="text/css">
  #commonpage{width:100%; padding-bottom: 5px;height: 52px;margin: 17px 0; text-align: center;}
	#commonpage .pages{display:inline-block;padding-top: 5px;}
	#commonpage .pages a,#commonpage .pages span{display: inline-block;height: 32px;width: 30px;line-height: 32px;border: 1px solid #eee;margin-left: 2px;background-color: #ccc;}
	#commonpage .pages a.prev{width: 43px;}
	#commonpage .pages a.next{width: 43px;}
	#commonpage .pages .current{background-color: #fe5842;color: #fff;}
</style>
 </head> 
 <body>

  <div class="body_div">
   <div id="mask"></div>
  <if condition="!empty($conarr)">
   <div class="filter_outer" id="filter">
    <div class="con_filter">
	  <volist name="conarr" id="value">
     <div class="f_box hide" id="nav_{pigcms{$value['input']}_con">
      <div class="f_box_inner arrow">
       <ul>
		<volist name="value['data']" key="kk" id="dv">
		 <php>if(($value['opt']==1) && ($kk==1) && (strpos($dv, '-') === false)){
		        $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=0-".$dv;
		    }elseif(($value['opt']==1) && ($kk>1) && (strpos($dv, '-') === false)){
			    $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv."-0";
			}else{
			    $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv;
			}

		    $opt=base64_encode($opt);
		 </php>
         <li <if condition="!empty($original) AND ($original eq $dv)">class="selected"</if>><a href="{pigcms{$thisurl}&opt={pigcms{$opt}" class="single" >{pigcms{$dv}</a></li>
		</volist>
       </ul>
      </div>
      <div class="f_box_inner hide"></div>
     </div>
	</volist>

<if condition="!empty($categorys)">
     <div class="f_box hide" id="nav_categorys_con">
      <div class="f_box_inner arrow">
       <ul>
		<volist name="categorys" id="cv">
		 <if condition="!empty($cid) AND ($cid eq $cv['cid'])">
		 <php>$thiscidsub=isset($cv['subdir3'])? $cv['subdir3'] : false;</php>
         <li class="selected"><a href="/wap.php?g=Wap&c=Classify&a=Lists&cid={pigcms{$cv['cid']}" class="single" >{pigcms{$cv['cat_name']}</a></li>
		 <else/>
		 <li><a href="/wap.php?g=Wap&c=Classify&a=Lists&cid={pigcms{$cv['cid']}" class="single" >{pigcms{$cv['cat_name']}</a></li>
		 </if>
		</volist>
       </ul>
      </div>

	  <?php if(isset($thiscidsub) AND !empty($thiscidsub)){?>
	  <div class="f_box_inner arrow">
	  <ul>
	  <volist name="thiscidsub" id="sub3">
	  <li><a href="/wap.php?g=Wap&c=Classify&a=Lists&cid={pigcms{$cid}&sub3dir={pigcms{$sub3['cid']}">{pigcms{$sub3['cat_name']}</a></li>
	  </volist>
	  </ul>
	  </div>
	  <?php }?>

      <div class="f_box_inner hide"></div>
     </div>
 </if>

     <div class="f_box f_box_more hide" id="filter-more">
      <div class="f_box_inner more_type js_more_type">
       <ul class="arrow"></ul>
      </div>
      <div class="btn_submit">
       <a href="javascript:;">筛 选</a>
      </div>
      <div class="btn_back">
       <a href="javascript:;">返 回</a>
      </div>
     </div>

    </div>

    <div class="list_filter">
     <ul class="nav_filter">
	  <if condition="!empty($conarr)">
	  <volist name="conarr" id="v">
      <li><a href="javascript:;" id="nav_{pigcms{$v['input']}"><if condition="!empty($original) AND ($v['input'] eq $c_input)">{pigcms{$original}<else/>{pigcms{$v['name']}</if></a></li>
	  </volist>
	  </if>
	<if condition="isset($categorys) AND !empty($categorys)">
	    <li><a href="javascript:;" id="nav_categorys">{pigcms{$cat_name}</a></li>
	</if>
     </ul>
    </div>
   </div>

   </if>

   <ul class="list-info">
   <if condition="!empty($listsdatas)">
    <volist name="listsdatas" id="vl">
    <li><a <if condition="empty($vl['jumpUrl'])"> href="{pigcms{:U('Classify/ShowDetail',array('vid'=>$vl['id']))}" <else/> href="{pigcms{$vl['jumpUrl']}"</if> ><if condition="isset($vl['imgthumbnail'])"><img class="thumbnail" src="{pigcms{$vl['imgthumbnail']}" /></if>
      <dl>
       <dt class="tit">
        <strong <if condition="!empty($vl['btcolor'])">style="color:{pigcms{$vl['btcolor']}"</if>>{pigcms{$vl['title']}</strong>
       </dt>
       <dd class="attr">
        <span class="attr_detail">{pigcms{$vl['input1']}</span>
		<span class="data_type">{pigcms{$vl['timestr']}</span>
       </dd>
       <dd class="attr">
        <span class="price">{pigcms{$vl['input2']}</span>
		<i class="data_type">{pigcms{$vl['input3']}</i>
       </dd>
      </dl></a></li>
	  </volist>
	  <else/>
	  <li style="font-size: 14px;text-align: center;padding-top: 35px;"><if condition="!empty($qsearch)"><a href="{pigcms{:U('Classify/Lists',array('cid'=>$cid))}" style="margin: 20px 90px;">没有查询到数据，点击跳到无查询状态</a><else/>没有数据！<a href="{pigcms{:U('Classify/fabu',array('cid'=>$fcid))}" style="margin:20px 0px;color:rgb(151,151,168)!important;text-align:center;display:block;">点击这里快去发布吧</a></if></li>
	  </if>
   </ul>

   {pigcms{$pagebar}
  </div>
  <include file="Classify:footer"/>
 </body>
  <script  src="{pigcms{$static_path}classify/slideY.js"></script>
  <script type="text/javascript">
    var idstr='';
    var maskobj=$('#mask');
    $('.nav_filter li').click(function(){
		$(this).addClass("select").siblings().removeClass("select");
        idstr = $(this).find('a').attr('id');
		$('#'+idstr+'_con').removeClass('hide').siblings().addClass("hide");
		$('#'+idstr+'_con').siblings().find('ul').removeClass('current');
		$('#'+idstr+'_con ul').addClass("current");
		maskobj.height($(document).height()).show();
		 maskobj.on("click",
          function(e) {
              setTimeout(function() {
                  closemask(e,$('#'+idstr+'_con'))
               }, 300)
           });
     });

	function closemask(e,obj) {
		e.preventDefault();
		e.stopPropagation();
		maskobj.hide();
		obj.addClass("hide");
		$(".nav_filter").find("li").removeClass("select");
		if ($(window).scrollTop() < this._top) {
			$("body").removeClass("filter-fixed")
		}
	}

   </script>
</html>