<include file="header" />
<script type="text/javascript" src="{pigcms{$static_path}takeout/js/scroller.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<div class="container">
	<form name="cart_confirm_form" action="{pigcms{:U('Takeout/OrderPay',array('store_id'=> $store_id, 'mer_id' => $mer_id))}" method="post">
	<section class="menu_wrap pay_wrap">
		<ul class="box">
			<li>
				<a href="{pigcms{:U('My/adress',array('buy_type' => 'waimai', 'store_id'=>$store_id, 'mer_id' => $mer_id, 'current_id'=>$now_group['user_adress']['adress_id']))}">
					<strong>
						<span id="showAddres"><if condition="$now_group['user_adress']['adress_id']">{pigcms{$now_group['user_adress']['province_txt']} {pigcms{$now_group['user_adress']['city_txt']} {pigcms{$now_group['user_adress']['area_txt']} {pigcms{$now_group['user_adress']['adress']}<else/>请点击添加送餐地址</if></span><br>
						<span id="showName">{pigcms{$now_group['user_adress']['name']}</span>
						<span id="showTel">{pigcms{$now_group['user_adress']['phone']}</span>
						</strong>
					<div><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>
		<ul class="box pay_box">
			<li>
				<a href="javascript:void(0);" id="timeBtn">
					<strong>送达时间</strong>
					<span id="arriveTime">尽快送出</span>
					<div><i class="ico_arrow"></i></div>
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="remarkBtn">
					<strong>订单备注</strong>
					<span id="remarkTxt">点击添加订单备注</span>
					<div><i class="ico_arrow"></i></div>
				</a>
			</li>
		</ul>

	<ul class="menu_list order_list" id="orderList">
	 <if condition="!empty($meals)">
	  <volist name="meals" id="ditem">
		<li>
			<div>
			<if condition="!empty($ditem['image'])">
			<img src="{pigcms{$ditem['image']}" alt="">
			</if>
			</div>
			<div>
				<h3>{pigcms{$ditem['name']}</h3>
				<div>
					<div class="fr" max="-1">
					<a href="javascript:void(0);" class="btn add active"></a>
					</div>
					<input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$ditem['meal_id']}][num]" value="{pigcms{$ditem['num']}">
					<input autocomplete="off"  type="hidden" name="dish[{pigcms{$ditem['meal_id']}][price]" value="{pigcms{$ditem['price']}">
					<input autocomplete="off"  type="hidden" name="dish[{pigcms{$ditem['meal_id']}][name]" value="{pigcms{$ditem['name']}">
					<span class="count">{pigcms{$ditem['num']}</span>
					<strong>￥<span class="unit_price">{pigcms{$ditem['price']}</span></strong>
				</div>
				<if condition="$kconoff eq 1"><p style="line-height: 8px;">库存：{pigcms{$ditem['instock']}</p></if>
			</div>
	  </li>
	 </volist>
	 </if>
	</ul>
	</section>
	<footer class="order_fixed">
		<div class="fixed">
			<p><span class="fr">总计：<strong>￥<span id="totalPrice"></span></strong> / <span id="cartNum" class="has_num"></span> 份</span></p>
			<div>
				<span class="comm_btn disabled">还差 <span id="sendCondition"><if condition="$store['basic_price']">{pigcms{$store['basic_price']}<else/>0</if></span> 起送</span>
				<a href="javascript:;" class="comm_btn" id="submit_order">订单确认</a>
			</div>
			<if condition="$store['basic_price'] gt 0">
				<if condition="$store['reach_delivery_fee_type'] eq 0">
					<p style="padding:10px;color: #ff510c;"><span>温馨提示：</span>商家设定了外送的费用{pigcms{$store['delivery_fee']}元，订单金额超过{pigcms{$store['basic_price']}元的将不收取外送费用</p>
				<elseif condition="$store['reach_delivery_fee_type'] eq 1" />
					<p style="padding:10px;color: #ff510c;"><span>温馨提示：</span>商家设定了外送的费用{pigcms{$store['delivery_fee']}元</p>
				<elseif condition="$store['reach_delivery_fee_type'] eq 2" />
					<p style="padding:10px;color: #ff510c;"><span>温馨提示：</span>商家设定了外送的费用{pigcms{$store['delivery_fee']}元，订单金额超过{pigcms{$store['no_delivery_fee_value']}元的将不收取外送费用</p>
				</if>
			</if>
		</div>
	</footer>
	<div style="display:none;">
	  <input class="hidden" id="totalmoney" name="totalmoney" value="0">
	  <input class="hidden" id="totalnum" name="totalnum" value="0">
	  <input class="hidden" id="ouserName" name="ouserName" value="{pigcms{$now_group['user_adress']['name']}">
	  <input class="hidden" id="ouserTel" name="ouserTel" value="{pigcms{$now_group['user_adress']['phone']}">
	  <input class="hidden" id="ouserAddres" name="ouserAddres" value="{pigcms{$now_group['user_adress']['province_txt']} {pigcms{$now_group['user_adress']['city_txt']} {pigcms{$now_group['user_adress']['area_txt']} {pigcms{$now_group['user_adress']['adress']}">
	  <input class="hidden" id="oarrivalTime" name="oarrivalTime" value="">
	  <input class="hidden" id="omark" name="omark" value="">
	</div>
	</form>
	<div class="addres_box" id="addresBox">
		  <ul>
			<li><input class="txt" placeholder="预定人" id="userName"></li>
			<li class="get_code">
				<span><input class="txt" placeholder="手机" maxlength="11" id="userTel"></span>
			</li>
			<li class="get_code">
				<span>性别：<label><input type="radio" name="yousex" id="yousex1" value="1" checked="checked" class="sexinput"> 男 </label>
				&nbsp;&nbsp;&nbsp;
				<label><input type="radio" name="yousex" id="yousex0" value="0" class="sexinput"> 女 </label></span>
			</li>
			<li><textarea class="txt" placeholder="送餐地址" id="userAddres"></textarea></li>
			<li class="btns_wrap">
				<span><a href="javascript:void(0);" class="comm_btn higher disabled" id="cancleAddres">取消</a></span>
				<span><a href="javascript:void(0);" class="comm_btn higher" id="saveAddres">确认</a></span>
			</li>
		</ul>
	</div>
	<div id="timeBox" class="timeBox">
		<div>
			<a href="javascript:void(0);">尽快送出</a>
			<volist name="time_list" id="time">
			<a href="javascript:void(0);">{pigcms{$time}</a>
			</volist>
		</div>
	</div>

	<div class="addres_box" id="remarkBox">
		<ul>
			<li><textarea class="txt max" placeholder="请填写备注" id="userMark"></textarea></li>
			<li class="btns_wrap">
			<span><a href="javascript:void(0);" class="comm_btn higher disabled" id="cancleRemark">取消</a></span>
			<span><a href="javascript:void(0);" class="comm_btn higher" id="saveRemark">确认</a></span>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
var config  = {isForeign: false};
var addressBox = {
	init: function(){
		this.differTime = 60;
		this.box = $('#addresBox');
		this.errorMsg = {
			userName: '预定人不能为空',
			userTel: '手机不能为空',
			userAddres: '送餐地址不能为空'
		};

		var _this = this;

		$('#addresBtn').click(function(){
			_this.show.call(this, _this);
		});
		$('#saveAddres').click(function(){
			_this.save.call(this, _this);
		});
		$('#cancleAddres').click(function(){
			_this.close();
		});
	},
	show: function(obj){ /**obj是_this**$(this)是$('#addresBtn')***/
		var addressTxt = $.trim($(this).find('strong').text());
		if(addressTxt == '' || addressTxt == '请点击添加送餐地址'){
			
		}else{
			var sex=$.trim($('#ouserSex').val());
			sex=parseInt(sex);
			if(sex==0){
			  $('#yousex0').click();
			}else{
			  $('#yousex1').click();
			}
			$('#userName').val($('#showName').text());
			$('#userTel').val($('#showTel').text());
			$('#userAddres').val($('#showAddres').text());
		}

		obj.box.dialog({title: '送餐地址', closeCb: function(){
			obj.reset();
		}});
	},
	save: function(obj){
		var error = '',
			tel = $('#userTel').val();
		$('#userName, #userTel, #userAddres').each(function(){
			if(this.value == ''){
				error += obj.errorMsg[this.id] + '\n';
			}
		});

		function fillData(){
			$('#showAddres').text($('#userAddres').val());
			$('#showName').text($('#userName').val());
			$('#showTel').text(tel);

			obj.close();
		}

		// 判断是否为空
		if(error){
			alert(error);
			return false;
		}
		if(!/^.{5,20}$/gi.test(tel) || !/^(\+\s?)?(\d*\s?)?(?:\(\s?(\d+[-\s])?\d+\s?\)\s?)?\s?(\d+[-\s]?)+\d+$/gi.test(tel)){
				alert('请输入正确的手机号码');
				return false
			}
			fillData();
	},
	reset: function(){
		$('#codeWrap').hide();
		$('#userTel').attr('disabled', false);
		$('#userCode').val('');
	},
	close:function(){
		this.box.dialog('close');
		this.reset();
	}
}
$(function(){
	addressBox.init();

	var _timeBox = $('#timeBox'),
		_addresBox = $('#addresBox'),
		_remarkBox = $('#remarkBox'),
		_remarkInput = _remarkBox.find('textarea');

	// 选择送餐时间
	$('#timeBtn').bind('click', function(){
		_timeBox.dialog({title: '选择送达时间'});
	});

	_timeBox.find('a').bind('click', function(){
		$('#arriveTime').text($(this).text());
		_timeBox.dialog('close');
	});
    //性别选择
	$('#addresBox .sexinput').bind('click', function(){
		var vsex=$(this).val();
		$('#ouserSex').val(vsex);
	});
	// 添加备注
	$('#remarkBtn').bind('click', function(){
		var remark = $('#remarkTxt').text();
		if(remark == '点击添加订单备注') remark = '';
		$('#userMark').val(remark);
		_remarkBox.dialog({title: '添加备注'});
	});

	$('#cancleRemark').bind('click', function(){
		_remarkBox.dialog('close');
	});

	$('#saveRemark').bind('click', function(){
		$('#remarkTxt').text(_remarkInput.val());
		_remarkInput.val('');
		_remarkBox.dialog('close');
	});

	$("#submit_order").click(function(){
		if(!$(this).hasClass('disabled')){
			$(this).addClass('disabled');
			var money=$.trim($('#totalPrice').text());
			var tnum=$.trim($('#cartNum').text());
			money=parseFloat(money);
			tnum=parseInt(tnum);
			if(!(money>0)||!(tnum>0)){
				alert("您还没有点菜，请至少点一道菜啊");
				return false;
			}
			var wo_user_name = $.trim($("#showName").html());
			var wo_receiver_mobile = $.trim($("#showTel").html());
			var wo_receiver_address = $.trim($("#showAddres").html());
			if(wo_receiver_address == '请点击添加送餐地址') {
				wo_receiver_address = '';
			}
			if(wo_user_name == '' || wo_receiver_mobile == '' || wo_receiver_address == ''){
				alert("请完善送餐地址信息");
				$(this).removeClass('disabled');
				return false;
			}
			$('#totalmoney').val(money);
			$('#totalnum').val(tnum);
			$('#ouserName').val(wo_user_name);
			$('#ouserTel').val(wo_receiver_mobile);
			$('#ouserAddres').val(wo_receiver_address);
			var wo_delivery_time = $.trim($("#arriveTime").html());
			if(wo_delivery_time == '尽快送出'){
				wo_delivery_time = '';
			}
			$('#oarrivalTime').val(wo_delivery_time);
			var wo_memo = $.trim($("#remarkTxt").html());
			if(wo_memo == '点击添加订单备注') {
				wo_memo = '';
			}
			$('#omark').val(wo_memo);
			

			document.cart_confirm_form.submit();
		}
		return false;
	});
});
</script>
<script type="text/javascript">
var Pricing="{pigcms{$store['basic_price']}";

$(function(){
	var amountCb = $.amountCb();
	$('#orderList li').each(function(){
		var count = parseInt($(this).find('.count').text()),
			_add = $(this).find('.add'),
			i = 0;

		for(; i < count; i++){
			amountCb.call(_add, '+');
		}

		_add.amount(count, amountCb);
	});

});
</script>
<include file="kefu" />
</body>
{pigcms{$hideScript}
</html>