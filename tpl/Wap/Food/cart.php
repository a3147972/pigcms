<include file="Food:header"/>
<script type="text/javascript">
var store_id = {pigcms{$store_id};
</script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dmain.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/showdialog.js"></script>
<body onselectstart="return true;" ondragstart="return false;" style="background-color:#e5e5e5;">
<script type="text/javascript">
	var islock=false;
	function next() {
		totalPrice = parseFloat($.trim($('#allmoney').text()));
		totalNum = parseInt($.trim($('#menucount').text()));
		if((totalNum>0) && (totalPrice>0) && !islock){
			$('#totalnum').val(totalNum);
			$('#totalmoney').val(totalPrice);
			islock = true;
			document.myorderform.submit();
			islock = false;
		}
	}
var leveloff=false;
var offtyp=0,offvv=0;
<if condition="isset($level_off) AND !empty($level_off)">
	leveloff=true;
    offtyp="{pigcms{$level_off['type']}";
	offvv="{pigcms{$level_off['vv']}";
</if>

</script>
<div data-role="container" class="container myMenu">
<section data-role="body">
	<div class="main" >
		<div class="top">
			<span>
				<if condition="isset($level_off) AND !empty($level_off)">
				&nbsp;<div>会员等级：<span style="color:#FC6E05">{pigcms{$level_off['lname']}</span></div>
				<else />
				<div>我的菜单</div>	
				</if>					
				<a href="{pigcms{:U('Food/menu', array('mer_id' => $mer_id, 'store_id' => $store_id, 'orid' => $orid))}" class="add">加菜</a>
				<a href="javascript:popup();" class="clear">清空</a>
			</span>
		</div>
		<form name="myorderform" method="POST" action="{pigcms{$action_url}">
			<div class="all" id="menuList">
				<ul id="usermenu">
					<if condition="!empty($ordishs)">
					<volist name="ordishs" id="dditem">
						<li id="dish_li{pigcms{$dditem['meal_id']}">
							<div class="licontent">
								<div class="span">
									<if condition="!empty($dditem['image'])">
									<img src="{pigcms{$dditem['image']}" alt="" url="{pigcms{$dditem['image']}">
									</if>
									<if condition="$dditem['ishot'] eq 1">
									<span class="ishot" style="left: -5px;">推荐</span>
									</if>
								</div>
								<div class="menudesc">
									<h3>{pigcms{$dditem['name']}</h3>
									<p class="addmark" onclick="addmark($(this))">添加备注</p>
								</div>
								<div class="price_wrap">
									<strong>￥<span class="unit_price">{pigcms{$dditem['price']}<input type="hidden" class="tureunit_price" <if condition="isset($dditem['vip_price']) AND $dditem['vip_price'] gt 0">value="{pigcms{$dditem['vip_price']}"<else/>value="{pigcms{$dditem['price']}"</if>></span></strong>
									<div class="fr" max="-1">
										<a href="javascript:void(0);" class="btn plus" <if condition="isset($dditem['num']) && !empty($dditem['num'])">data-num="{pigcms{$dditem['num']}" <else/>data-num=""</if>></a>
									</div>
									<input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$dditem['id']}][num]" value="{pigcms{$dditem['num']}">
									<input autocomplete="off"  type="hidden" name="dish[{pigcms{$dditem['id']}][price]" value="{pigcms{$dditem['price']}">
									<input autocomplete="off"  type="hidden" name="dish[{pigcms{$dditem['id']}][name]" value="{pigcms{$dditem['name']}">
								</div>
							</div>
							<input type="text" class="markinput" placeholder="备注(30个汉字以内)" name="dish[{pigcms{$dditem['id']}][omark]" <if condition="isset($dditem['omark']) && !empty($dditem['omark'])">value="{pigcms{$dditem['omark']|htmlspecialchars_decode=ENT_QUOTES}" style="display:block;"<else/>value=""</if>>
						</li>
					</volist>
					</if>
				</ul>
			</div>
			<div class="mark">
				<!--textarea placeholder=" 备注" name="allmark">{pigcms{$allmark}</textarea-->
				<input autocomplete="off"  type="hidden" name="totalmoney" id="totalmoney" value="">
				<input autocomplete="off"  type="hidden" name="totalnum" id="totalnum" value="">
			</div>
		</form>
	</div>
</section>
<footer data-role="footer">			
	<nav class="g_nav">
		<div>
			<span class="cart"></span>
			<if condition="isset($level_off) AND !empty($level_off)">
			<span><span class="money"><del>￥<label id="allmoney">0</label></del>&nbsp;￥<label id="levelallmoney">0</label></span>/<label id="menucount">0</label>个菜</span><span style="margin-left: 60px;color: #FD7008;">{pigcms{$level_off['offstr']}</span>
			<else />
			<span> <span class="money">￥<label id="allmoney">0</label></span>/<label id="menucount">0</label>个菜</span>
			</if>
			<a href="javascript:next();" class="btn orange show" id="nextstep">下一步</a>
		</div>
	</nav>
</footer>
<div class="layer transparent"></div>
<div class="layer popup">
	<div class="dialogX">
		<div class="content">
			<div class="title">清空菜单</div>
			<div class="message">您是否要清空该菜单？</div>
		</div>
		<div class="button">
			<a class="cancel" href="javascript:cancel();">取消</a>
			<a href="{pigcms{:U('Food/cart', array('mer_id' => $mer_id, 'store_id' => $store_id,'isclean'=>1))}">确定</a>
		</div>
	</div>			
</div>
</div>

<script type="text/javascript">
$(function(){
	var amountCb = $.amountCb();
	$('#menuList li').each(function(){
		var count = parseInt($(this).find('.number').val()),
			_add = $(this).find('.plus'),
			i = 0;

		for(; i < count; i++){
			amountCb.call(_add, '+');
		}

		_add.amount(count, amountCb);
	});

});
function addmark(obj){
	obj.parent().parent().siblings(".markinput").toggle();
}
function getMyMenulist(){
	var lis =$("#usermenu li");
	var list = [];
	for(i=0;i<lis.length;i++){		
		var mark= $(".markinput",lis[i]).get(0).value;
		var count = $(".num >input",lis[i]).get(0).value;
		if(count>0){
			var id = lis[i].id;			
			var info = {'id':id,'count':count,'mark':mark}
			list.push(info);
		}
		
	}
	var allmark = $("#allmark").get(0).value;
	return {'data':list,mark:allmark};
}
</script>
<include file="kefu" />
{pigcms{$hideScript}
</body>
</html>