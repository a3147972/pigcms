<include file="Food:header" />
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dmain.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/menu.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<script type="text/javascript">
$(document).ready(function(){
	$('.mylovedish').click(function(){
		var id = parseInt($(this).find('.thisdid').val());
		var islove = 0;
		if ($(this).parents('li').attr('class') == 'like') {
			islove = 1;
		}
		$.post("{pigcms{:U('Food/dolike', array('mer_id' => $mer_id, 'store_id' => $store_id))}", {meal_id:id,islove:islove}, function(msg){});
	});
});

var islock=false;
function next()
{
	totalPrice = parseFloat($.trim($('#allmoney').text()));
	totalNum = parseInt($.trim($('#menucount').text()));
	if((totalNum>0) && (totalPrice>0)){
		var data=getMenuChecklist();//[{'id':id,'count':count},{'id':id,'count':count}]
		if((data.length>0) && !islock){
			islock=true;
			$('#nextstep').removeClass('orange show').addClass('gray disabled');
			$.ajax({
				type: "POST",
				url: "{pigcms{:U('Food/processOrder', array('mer_id' => $mer_id, 'store_id' => $store_id))}",
				data: {"cart":data},
				async:true,
				success: function(res){
					islock=false;
					$('#nextstep').removeClass('gray disabled').addClass('orange show');
					if (res.error ==0) { 
					  window.location.href = "{pigcms{:U('Food/cart', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $orid))}";
					} else {
					  alert(res.msg);
					}
				},
				dataType: "json"
			  });
			}else{
				return false;
			}
		}else{
			return false;
		}
}
</script>
<div data-role="container" class="container menu">
	<section data-role="body">
		<div class="left">
			<div class="top">
				<div id="ILike"><a><span class="icon hartblckgray"></span>我喜欢</a></div>
			</div>
			<div class="top">
				<div id="all_dish"><a><span></span>全部菜</a></div>
			</div>
			<div class="content">
				<ul id="typeList"><!--class="on"-->
					<volist name="sortlist" id="so">
					<li id="li_type{pigcms{$so['sort_id']}">{pigcms{$so['sort_name']}</li>
					</volist>
				</ul>
			</div>
		</div>
		<div class="right" id="usermenu">
			<div class="all" id="menuList">
			<if condition="!empty($meals)">
				<volist name="meals" id="rowset">
					<ul id="ul_type{pigcms{$rowset['sort_id']}">
						<volist name="rowset['list']" id="meal">
						<li id="dish_li{pigcms{$meal['meal_id']}" <if condition="$meal['like']">class="like"</if>>
						 <div class="licontent">
							<div class="span showPop">
								<if condition="!empty($meal['image'])">
								<img src="{pigcms{$meal['image']}" alt="" url="{pigcms{$meal['image']}">
								</if>
							</div>
							<div class="menudesc showPop">
								<h3>{pigcms{$meal['name']}</h3>
								<p class="salenum">月售<span class="sale_num"> {pigcms{$meal['sell_count']} </span><span class="theunit"><if condition="!empty($meal['unit'])">{pigcms{$meal['unit']}<else/>份</if></span></p>
								<p class="mylovedish"> <span class="icon hart"><input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$meal['meal_id']}"></span></p>
								<div class="info">{pigcms{$meal['des']|htmlspecialchars_decode=ENT_QUOTES}</div>
							</div>
							<div class="price_wrap">
								<strong>￥<span class="unit_price">{pigcms{$meal['price']}<input type="hidden" class="tureunit_price" <if condition="isset($meal['vip_price']) AND $meal['vip_price'] gt 0">value="{pigcms{$meal['vip_price']}"<else/>value="{pigcms{$meal['price']}"</if>></span></strong>
								<div class="fr" max="-1">
									 <a href="javascript:void(0);" class="btn plus" data-num="{pigcms{$meal['num']}"></a>
								</div>
								<input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$meal['meal_id']}]" value="0">
							</div>
						</div>
						</li>
						</volist>
					</ul>
				</volist>
			</if>
			</div>
		</div>
	</section>
</div>
<footer data-role="footer">			
	<nav class="g_nav">
		<div>
			<span class="cart"></span>
			<span> <span class="money">￥<label id="allmoney">0</label> </span>/<label id="menucount">0</label>个菜</span>
			<a href="javascript:next();" class="btn gray disabled" id="nextstep">选好了</a>
		</div>
	</nav>
</footer>

<div class="menu_detail" id="menuDetail">
	<img style="display: none;">
	<div class="nopic"></div>
	<a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>
	<dl>
		<dt>价格：</dt>
		<dd class="highlight">￥<span class="price"></span></dd>
	</dl>
	<p class="sale_desc"></p>
	<dl class="desc">
		<dt>介绍：</dt>
		<dd class="info"></dd>
	</dl>
</div>
<include file="kefu" />
<script type="text/javascript">
window.shareData = {  
            "moduleName":"Food",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Food/menu',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}

</body>
</html>
