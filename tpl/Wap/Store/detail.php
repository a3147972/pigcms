<include file="Meal:header"/>
<script src="{pigcms{$static_path}js/iscroll.js" type="text/javascript"></script>
<div class="banner">
	<div id="wrapper" style="overflow: hidden;">
		<div id="scroller" style="width: 1903px; -webkit-transition: -webkit-transform 0ms; transition: -webkit-transform 0ms; -webkit-transform-origin: 0px 0px; -webkit-transform: translate3d(0px, 0px, 0px) scale(1);">
			<ul id="thelist">
				<volist name="store['images']" id="image">
				<li><p></p><img src="{pigcms{$image}" style="width: 1903px;"></li>
				</volist>
			</ul>
		</div>
	</div>
	<div id="nav">
		<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,1);return false">← prev</div>
		<ul id="indicator">
			<volist name="store['images']" id="image">
			<li>{pigcms{$i}</li>
			</volist>
		</ul>
		<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next →</div>
	</div>
	<div class="clr"></div>
</div>
<if condition="$store['store_notice']">
<div class="gonggao">
	<div class="hot"><strong>公告</strong></div>
	<div class="content">{pigcms{$store['store_notice']}</div>
</div>
</if>
<!-- <div class="segmented">
	<p class="segmented-control">
	    <a class="platform-switch control-item active" href="">热卖排行</a>
	</p>
</div> -->

<ul class="round" style="margin-top:10px">
	<li class="manage1">
		<a href="javascript:;"><span>门店名称：{pigcms{$store['name']}</span></a>
	</li>
	<li class="tel"><a href="tel:{pigcms{$store['phone']}"><span>{pigcms{$store['phone']}</span></a></li>
	<li class="addr">
		<a href="{pigcms{:U('Meal/addressinfo',array('store_id'=>$store['store_id']))};"><span>{pigcms{$store['adress']}</span></a>
	</li>
</ul>

<ul class="round">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
		<tbody>
			<tr>
				<td width="70">店铺名称：{pigcms{$store['name']}  </td>
			</tr>
			<tr>
				<td>店铺状态：<if condition="$store['status'] eq 1"><em class="ok">营业中</em><else /><em class="no">歇业中</em></if></td>
			</tr>
			
			<if condition="$group_list">
				<tr>
					<td>本店{pigcms{$config.group_alias_name}</td>
				</tr>
				<volist name="group_list" id="vo">
				<tr>
					<td><a href="{pigcms{$vo.url}" class="react">[{pigcms{$vo.prefix_title}]{pigcms{$vo.group_name}：￥{pigcms{$vo.price}</a></td>
				</tr>
				</volist>
			</if>
			
		</tbody>
	</table>
</ul>
<div class="dpinfo">
	<div class="content">
	   <span>{pigcms{$store['txt_info']}</span><br>
	</div>
</div>
   
    
<script>
var count = $("#thelist img").size();
$("#thelist img").css("width",document.body.clientWidth);
$("#scroller").css("width",document.body.clientWidth*count);
setInterval(function(){myScroll.scrollToPage('next', 0,400,count);}, 3500);
window.onresize = function(){ 
  $("#thelist img").css("width",document.body.clientWidth);
  $("#scroller").css("width",document.body.clientWidth*count);
} 

var myScroll;
function loaded() {
	myScroll = new iScroll('wrapper', {
		snap: true,
		momentum: false,
		hScrollbar: false,
		onScrollEnd: function () {
			$('#indicator > li.active').removeClass('active');
			$('#indicator > li:nth-child(' + (this.currPageX+1) + ')').addClass('active');
		}
	});
}
document.addEventListener('DOMContentLoaded', loaded, false);

</script>


<script type="text/javascript">
window.shareData = {  
            "moduleName":"Meal",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Meal/index',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
<div class="footermenu">
	<if condition="$set eq 'set'">
    <ul>
        <li>
            <a href="{pigcms{:U('Invitation/release_date', array('store_id' => $store['store_id']))}"><img src="{pigcms{$static_path}images/Lngjm86JQq.png">设为约会地点</a>
        </li>
    </ul>
    <else />
    <ul>
        <li>
            <a href="{pigcms{:U('Home/index')}"><img src="{pigcms{$static_path}images/Lngjm86JQq.png">去吃喝玩乐</a>
        </li>
    </ul>
    
    </if>
</div>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
</html>