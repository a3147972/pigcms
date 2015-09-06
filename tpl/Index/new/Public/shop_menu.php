<menu class="shop_menu">
  <div class="box_menu" id="mealallprolist">
    <ul>
      <li <if condition="$isindex">class="crun"</if>><a href="{pigcms{$config.site_url}/merindex/{pigcms{$merid}.html">首页</a></li>
	  <volist name="navmanag" id="nv">
      <li <if condition="$nv['currenturl']">class="crun"</if>><a href="{pigcms{$config.site_url}/{pigcms{$nv['url']}/{pigcms{$merid}.html">{pigcms{$nv['zhname']}</a></li>
	  </volist>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>
<!---<menu class="shop_menu">
  <div class="box_menu">
    <ul>
      <li class="crun"><a href="shop_shop.html">首页</a></li>
      <li><a href="shop_introduction.html">商家介绍</a></li>
      <li><a href="shop_dynamics.html">商家动态 </a></li>
      <li><a href="shop_photo.html">商家相册</a></li>
      <li><a href="shop_video.html">全景视频 </a></li>
      <li><a href="shop_goods.html">商品大全</a></li>
      <li><a href="shop_activity.html">{pigcms{$config.group_alias_name}活动 </a></li>
      <li><a href="shop_server.html">客户服务</a></li>
      <li><a href="shop_jion.html">招商加盟</a></li>
      <li><a href="shop_comment.html">网友点评</a></li>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>--->