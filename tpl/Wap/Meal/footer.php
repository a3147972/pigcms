<div id="enter_im_div" style="-webkit-transition: opacity 200ms ease; transition: opacity 200ms ease; opacity: 1; display: block;cursor:move;z-index: 10000;">
	<a id="enter_im" data-url="{pigcms{$kf_url}">
	<div id="to_user_list">
	<div id="to_user_list_icon_div" class="rel left">
	<em class="to_user_list_icon_em_a abs">&nbsp;</em>
	<em class="to_user_list_icon_em_b abs">&nbsp;</em>
	<em class="to_user_list_icon_em_c abs">&nbsp;</em>
	<em class="to_user_list_icon_em_d abs">&nbsp;</em>
	<em id="to_user_list_icon_em_num" class="hide abs">0</em>
	</div>
	<p id="to_user_list_txt" class="left" style="font-size:12px">联系客服</p>
	</div>
	</a>
</div>
<div class="footermenu">
    <ul>
        <li>
            <a <if condition="$class eq 2">class="active"</if> href="{pigcms{:U('Meal/menu', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
            <img src="{pigcms{$static_path}images/Lngjm86JQq.png">
            <p>菜单</p>
            </a>
        </li>
        <li>
            <a <if condition="$class eq 3">class="active"</if> href="{pigcms{:U('Meal/cart', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
            <span class="num" id="cartN2">0</span>
            <img src="{pigcms{$static_path}images/2yFKO6TwKI.png">
            <p>我的菜</p>
            </a>
        </li>
        <li>
            <a <if condition="$class eq 4">class="active"</if> href="{pigcms{:U('Meal/order', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
            <img src="{pigcms{$static_path}images/s22KaR0Wtc.png">
            <p>订单</p>
            </a>
        </li>
        <li>
            <a <if condition="$class eq 1">class="active"</if> href="{pigcms{:U('Meal/index', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
            <img src="{pigcms{$static_path}images/xxyX63YryG.png">
            <p>关于</p>
            </a>
        </li>
        <!--li>
            <a <if condition="$class eq 5">class="active"</if> href="{pigcms{:U('Meal/my', array('mer_id' => $mer_id, 'store_id' => $store_id))}">
            <img src="{pigcms{$static_path}images/J0uZbXQWvJ.png">
            <p>我的</p>
            </a>
        </li-->
    </ul>
</div>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>

<script type="text/javascript">
$(document).ready(function(){
	var mousex = 0, mousey = 0;
	var divLeft = 0, divTop = 0, left = 0, top = 0;
	document.getElementById("enter_im_div").addEventListener('touchstart', function(e){
		e.preventDefault();
		var offset = $(this).offset();
		divLeft = parseInt(offset.left,10);
		divTop = parseInt(offset.top,10);
		mousey = e.touches[0].pageY;
		mousex = e.touches[0].pageX;
		return false;
	});
	document.getElementById("enter_im_div").addEventListener('touchmove', function(event){
		event.preventDefault();
		left = event.touches[0].pageX-(mousex-divLeft);
		top = event.touches[0].pageY-(mousey-divTop)-$(window).scrollTop();
		if(top < 1){
			top = 1;
		}
		if(top > $(window).height()-(50+$(this).height())){
			top = $(window).height()-(50+$(this).height());
		}
		if(left + $(this).width() > $(window).width()-5){
			left = $(window).width()-$(this).width()-5;
		}
		if(left < 1){
			left = 1;
		}
		$(this).css({'top':top + 'px', 'left':left + 'px', 'position':'fixed'});
		return false;
	});
	document.getElementById("enter_im_div").addEventListener('touchend', function(event){
		if ((divLeft == left && divTop == top) || (top == 0 && left == 0)) {
			var url = $('#enter_im').attr('data-url');
			if (url == '' || url == null) {
				alert('商家暂时还没有设置客服');
			} else {
				location.href=$('#enter_im').attr('data-url');
			}
		}
		return false;
	});

	$('#enter_im_div').click(function(){
		var url = $('#enter_im').attr('data-url');
		if (url == '' || url == null) {
			alert('商家暂时还没有设置客服');
		} else {
			location.href=$('#enter_im').attr('data-url');
		}
	});
});
</script>
</body>
</html>