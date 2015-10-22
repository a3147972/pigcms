<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
  <title><?php echo ($cat_name); ?></title> 
  <meta name="keywords" content="" /> 
  <meta name="descripiton" content="" /> 
  <script src="<?php echo C('JQUERY_FILE');?>"></script>
  <link rel="stylesheet" href="<?php echo ($static_path); ?>classify/mlist.css" /> 
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
  <?php if(!empty($conarr)): ?><div class="filter_outer" id="filter">
    <div class="con_filter">
	  <?php if(is_array($conarr)): $i = 0; $__LIST__ = $conarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><div class="f_box hide" id="nav_<?php echo ($value['input']); ?>_con">
      <div class="f_box_inner arrow">
       <ul>
		<?php if(is_array($value['data'])): $kk = 0; $__LIST__ = $value['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dv): $mod = ($kk % 2 );++$kk; if(($value['opt']==1) && ($kk==1) && (strpos($dv, '-') === false)){ $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=0-".$dv; }elseif(($value['opt']==1) && ($kk>1) && (strpos($dv, '-') === false)){ $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv."-0"; }else{ $opt="opt,ty=".$value[opt].",fd=".$value['input'].",vv=".$dv; } $opt=base64_encode($opt); ?>
         <li <?php if(!empty($original) AND ($original == $dv)): ?>class="selected"<?php endif; ?>><a href="<?php echo ($thisurl); ?>&opt=<?php echo ($opt); ?>" class="single" ><?php echo ($dv); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
       </ul>
      </div>
      <div class="f_box_inner hide"></div>
     </div><?php endforeach; endif; else: echo "" ;endif; ?>

<?php if(!empty($categorys)): ?><div class="f_box hide" id="nav_categorys_con">
      <div class="f_box_inner arrow">
       <ul>
		<?php if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i; if(!empty($cid) AND ($cid == $cv['cid'])): $thiscidsub=isset($cv['subdir3'])? $cv['subdir3'] : false; ?>
         <li class="selected"><a href="/wap.php?g=Wap&c=Classify&a=Lists&cid=<?php echo ($cv['cid']); ?>" class="single" ><?php echo ($cv['cat_name']); ?></a></li>
		 <?php else: ?>
		 <li><a href="/wap.php?g=Wap&c=Classify&a=Lists&cid=<?php echo ($cv['cid']); ?>" class="single" ><?php echo ($cv['cat_name']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
       </ul>
      </div>

	  <?php if(isset($thiscidsub) AND !empty($thiscidsub)){?>
	  <div class="f_box_inner arrow">
	  <ul>
	  <?php if(is_array($thiscidsub)): $i = 0; $__LIST__ = $thiscidsub;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub3): $mod = ($i % 2 );++$i;?><li><a href="/wap.php?g=Wap&c=Classify&a=Lists&cid=<?php echo ($cid); ?>&sub3dir=<?php echo ($sub3['cid']); ?>"><?php echo ($sub3['cat_name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	  </ul>
	  </div>
	  <?php }?>

      <div class="f_box_inner hide"></div>
     </div><?php endif; ?>

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
	  <?php if(!empty($conarr)): if(is_array($conarr)): $i = 0; $__LIST__ = $conarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><a href="javascript:;" id="nav_<?php echo ($v['input']); ?>"><?php if(!empty($original) AND ($v['input'] == $c_input)): echo ($original); else: echo ($v['name']); endif; ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	<?php if(isset($categorys) AND !empty($categorys)): ?><li><a href="javascript:;" id="nav_categorys"><?php echo ($cat_name); ?></a></li><?php endif; ?>
     </ul>
    </div>
   </div><?php endif; ?>

   <ul class="list-info">
   <?php if(!empty($listsdatas)): if(is_array($listsdatas)): $i = 0; $__LIST__ = $listsdatas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><li><a <?php if(empty($vl['jumpUrl'])): ?>href="<?php echo U('Classify/ShowDetail',array('vid'=>$vl['id']));?>" <?php else: ?> href="<?php echo ($vl['jumpUrl']); ?>"<?php endif; ?> ><?php if(isset($vl['imgthumbnail'])): ?><img class="thumbnail" src="<?php echo ($vl['imgthumbnail']); ?>" /><?php endif; ?>
      <dl>
       <dt class="tit">
        <strong <?php if(!empty($vl['btcolor'])): ?>style="color:<?php echo ($vl['btcolor']); ?>"<?php endif; ?>><?php echo ($vl['title']); ?></strong>
       </dt>
       <dd class="attr">
        <span class="attr_detail"><?php echo ($vl['input1']); ?></span>
		<span class="data_type"><?php echo ($vl['timestr']); ?></span>
       </dd>
       <dd class="attr">
        <span class="price"><?php echo ($vl['input2']); ?></span>
		<i class="data_type"><?php echo ($vl['input3']); ?></i>
       </dd>
      </dl></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	  <?php else: ?>
	  <li style="font-size: 14px;text-align: center;padding-top: 35px;"><?php if(!empty($qsearch)): ?><a href="<?php echo U('Classify/Lists',array('cid'=>$cid));?>" style="margin: 20px 90px;">没有查询到数据，点击跳到无查询状态</a><?php else: ?>没有数据！<a href="<?php echo U('Classify/fabu',array('cid'=>$fcid));?>" style="margin:20px 0px;color:rgb(151,151,168)!important;text-align:center;display:block;">点击这里快去发布吧</a><?php endif; ?></li><?php endif; ?>
   </ul>

   <?php echo ($pagebar); ?>
  </div>
  <?php if(!empty($classifyslider)): ?><link rel="stylesheet" href="<?php echo ($static_path); ?>classify/showcase.css" /> 
<style type="text/css">
 .nav-item{border: 0;}
</style>
   <!--<div class="nav-item">
    <a class="mainmenu js-mainmenu" href="<?php echo ($svv['url']); ?>"><span class="mainmenu-txt"><?php echo ($svv['name']); ?></span></a>
   </div>-->
  <div class="footermenu"> 
  <ul>
	<?php if(is_array($classifyslider)): $i = 0; $__LIST__ = $classifyslider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svv): $mod = ($i % 2 );++$i;?><li>
     <a href="<?php echo ($svv['url']); ?>">
        <!--<img src="">-->
       <p><?php echo ($svv['name']); ?></p>
        </a>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul> 
 </div><?php endif; ?>
<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
 </body>
  <script  src="<?php echo ($static_path); ?>classify/slideY.js"></script>
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