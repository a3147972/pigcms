<if condition="!empty($classifyslider)">
<link rel="stylesheet" href="{pigcms{$static_path}classify/showcase.css" /> 
<style type="text/css">
 .nav-item{border: 0;}
</style>
   <!--<div class="nav-item">
    <a class="mainmenu js-mainmenu" href="{pigcms{$svv['url']}"><span class="mainmenu-txt">{pigcms{$svv['name']}</span></a>
   </div>-->
  <div class="footermenu"> 
  <ul>
	<volist name="classifyslider" id="svv">

   <li>
     <a href="{pigcms{$svv['url']}">
        <!--<img src="">-->
       <p>{pigcms{$svv['name']}</p>
        </a>
      </li>
   </volist>
  </ul> 
 </div>

</if>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>