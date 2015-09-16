<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Meal/index')}">{pigcms{$config.meal_alias_name}管理</a>
			</li>
			<li class="active">编辑{pigcms{$config.meal_alias_name}信息</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
				#levelcoupon select {width:150px;margin-right: 20px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#basicinfo">基本信息</a>
							</li>
							<li>
								<a data-toggle="tab" href="#category">选择分类</a>
							</li>
							<!--li>
								<a data-toggle="tab" href="#pay">支付方式</a>
							</li>
							<li>
								<a data-toggle="tab" href="#delivertime">配送时间</a>
							</li-->
							<li>
								<a data-toggle="tab" href="#promotion">促销活动</a>
							</li>
						  <if condition="!empty($levelarr)">
							<li>
								<a data-toggle="tab" href="#levelcoupon">会员优惠</a>
							</li>
							</if>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<div class="tab-content">				
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label for="Config_notice">店铺公告</label></label>
									<textarea class="col-sm-3" rows="4" name="store_notice" id="Config_notice">{pigcms{$store_meal.store_notice}</textarea>
								</div>
								<div class="form-group">
								</div>
								<div class="form-group">
									<label class="col-sm-1">预订金</label>
									<input class="col-sm-1" size="10" maxlength="10" name="deposit" id="Config_deposit" type="text" value="{pigcms{$store_meal.deposit}" />元
								</div>
								<div class="form-group">
									<label class="col-sm-1">人均消费</label>
									<input class="col-sm-1" size="10" maxlength="10" name="mean_money" id="Config_mean_money" type="text" value="{pigcms{$store_meal.mean_money}" />元<span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1">起送价格</label>
									<input class="col-sm-1" size="10" maxlength="10" name="basic_price" id="Config_basicprice" type="text" value="{pigcms{$store_meal.basic_price}" />元<span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="Config_delivery_fee">外送费</label>
									<input class="col-sm-1" size="10" maxlength="10" name="delivery_fee" id="Config_delivery_fee" type="text" value="{pigcms{$store_meal.delivery_fee}"/>元<span class="required">*</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="Config_send_time">送达时间</label>
									<input class="col-sm-1" size="10" maxlength="10" name="send_time" id="Config_send_time" type="text" value="{pigcms{$store_meal.send_time}"/>分钟
								</div>
								<style>
									#perioddeliveryfeebox{
										margin:10px;
										height:auto;
									}
									.perioddeliveryfeeitem{
										margin:10px 0px;
									}
								</style>
								<div class="form-group">
									<div class="radio">
										<label>
											<input class="" name="delivery_fee_valid" id="Config_delivery_fee_valid" value="1" type="checkbox" <if condition="$store_meal['delivery_fee_valid']">checked="checked"</if>/>
											<span class="lbl"><label for="Config_delivery_fee_valid">不足起送价格收取外送费照样送</label></span>
										</label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label bolder blue">达到起送价格</label>
									<div class="radio">
										<label>
											<input name="reach_delivery_fee_type" value="0" type="radio" class="" <if condition="$store_meal['reach_delivery_fee_type'] eq 0">checked="checked"</if>/>
											<span class="lbl" style="z-index: 1">免外送费</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="reach_delivery_fee_type" value="1" type="radio" class="" <if condition="$store_meal['reach_delivery_fee_type'] eq 1">checked="checked"</if>/>
											<span class="lbl" style="z-index: 1">照样收取外送费</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="reach_delivery_fee_type" value="2" type="radio" class="" <if condition="$store_meal['reach_delivery_fee_type'] eq 2">checked="checked"</if>/>
											<span class="lbl" style="z-index: 1">达到</span><input size="10" maxlength="10" name="no_delivery_fee_value" id="Config_no_delivery_fee_value" type="text" value="{pigcms{$store_meal.no_delivery_fee_value}"/><span class="lbl" style="z-index: 1">元免外送费</span>
										</label>
									</div>											
								</div>
								<div class="form-group"></div>
								<div class="form-group">
									<label class="col-sm-1" for="Config_delivery_radius">服务距离</label>
									<input class="col-sm-1" size="10" maxlength="10" name="delivery_radius" id="Config_delivery_radius" type="text" value="{pigcms{$store_meal.delivery_radius}"/>公里
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="Config_area">配送区域</label></label>
									<textarea class="col-sm-3" rows="4" name="delivery_area" id="Config_area">{pigcms{$store_meal.delivery_area}</textarea>
								</div>
							</div>
							<div id="category" class="tab-pane">
								<volist name="category_list" id="vo">
									<div class="form-group">
										<div class="radio">
											<label>
												<span class="lbl"><label style="color: red">{pigcms{$vo.cat_name}：</label></span>
											</label>
											<volist name="vo['list']" id="child">
												<label>
													<input class="cat_class" type="checkbox" name="store_category[]" value="{pigcms{$vo.cat_id}-{pigcms{$child.cat_id}" id="Config_store_category_{pigcms{$child.cat_id}" <if condition="in_array($child['cat_id'],$relation_array)">checked="checked"</if>/>
													<span class="lbl"><label for="Config_store_category_{pigcms{$child.cat_id}">{pigcms{$child.cat_name}</label></span>
												</label>
											</volist>
										</div>
									</div>
								</volist>
							</div>
							<div id="pay" class="tab-pane">
								<if condition="$config['store_open_payone']">
									<div class="form-group">
										<div class="radio">
											<label>
												<input class="paycheck " type="checkbox" name="openpayone" value="1" id="Config_openpayone" onclick="check(this);" <if condition="$store_meal['openpayone'] eq 1">checked="checked"</if>/>
												<span class="lbl"><label for="Config_openpayone">货到付款</label></span>
											</label>
										</div>
									</div>
								</if>
								<div class="form-group">
									<div class="radio">
										<label>
											<input class="paycheck " type="checkbox" name="openpaytwo" value="1" id="Config_openpaytwo" onclick="check(this);" <if condition="$store_meal['openpaytwo'] eq 1">checked="checked"</if>/>
											<span class="lbl"><label for="Config_openpaytwo">余额支付</label></span>
										</label>
									</div>
								</div>
								<if condition="$config['store_open_paythree']">
									<div class="form-group">
										<div class="radio">
											<label>
												<input class="paycheck " type="checkbox" name="openpaythree" value="1" id="Config_openpaythree" onclick="check(this);" <if condition="$store_meal['openpaythree'] eq 1">checked="checked"</if>/>
												<span class="lbl"><label for="Config_openpaythree">在线支付</label></span>
											</label>
										</div>
									</div>
								</if>
							</div>
							<div id="delivertime" class="tab-pane">
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									<p>外卖有个特点，就是顾客消费的时间段比较集中，例如中午11点至12点半，晚上5点至6点半，都是点外卖的高峰期。对于某些订单量较大的商家或者多店铺运营者来说，如果顾客都临时下单，很难保证订单的及时配送，可能会导致顾客投诉与抱怨，引起顾客流失。为此，我们提供了店铺配送时间的功能设置。<br/><br/>每个店铺最多可以配置20个配送时间段，顾客在下单的时候，必须选择其中一个时间段。并且可以设置一个最少提前多少分钟下单，例如设置了最少提前30分钟下单，那么选择11:30-12:00时间段配送的顾客，至少要在11点之前下单，否则无法进入订单支付结算页面。
									</p>
								</div>
								<div class="form-group">
									<label class="col-sm-2" for="Config_opendelivertime">是否开启配送时间限制</label>
									<select name="open_deliver_time" id="Config_opendelivertime">
										<option value="0" <if condition="$store_meal['open_deliver_time'] eq 0">selected="selected"</if>>关闭</option>
										<option value="1" <if condition="$store_meal['open_deliver_time'] eq 1">selected="selected"</if>>开启</option>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-2" for="Config_delivertimerange">最少提前多少分钟下单</label>
									<input class="col-sm-1" size="10" maxlength="3" name="deliver_time_range" id="Config_delivertimerange" type="text" value="{pigcms{$store_meal.deliver_time_range}" />分钟	
								</div>
								<div class="widget-box">
									<div class="widget-header">
										<h5>配送时间段</h5>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<volist name="store_meal['deliver_time']" id="vo">
												<div style="margin:10px;width:400px;float:left;">({pigcms{$i})
													<input id="delivertime_{pigcms{$i}_start" type="text" value="{pigcms{$vo.start}" name="deliver_time[{pigcms{$i}][start]"/> 至 <input id="delivertime_{pigcms{$i}_stop" type="text" value="{pigcms{$vo.stop}" name="deliver_time[{pigcms{$i}][stop]"/>
												</div>
											</volist>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>
								<div style="clear:both;"></div>
							</div>
							
							<div id="promotion" class="tab-pane">
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									<p>赠和送都是商家和消费者的线下互动，如商家赠送一些小礼品呀，购物券之类的。满、减(消费超过多少元立减多少元)，如果商家没有填写就没有这个优惠！</p>
								</div>
								<div class="form-group">
									<label class="col-sm-1">赠</label>
									<textarea class="col-sm-3" rows="4" name="zeng" id="Config_zeng">{pigcms{$store_meal.zeng}</textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1">满（金额）</label>
									<input class="col-sm-1" size="10" maxlength="10" name="full_money" id="Config_mean_full_money" type="text" value="{pigcms{$store_meal.full_money}" />
									<label class="col-sm-1">减（金额）</label>
									<input class="col-sm-1" size="10" maxlength="10" name="minus_money" id="Config_mean_minus_money" type="text" value="{pigcms{$store_meal.minus_money}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1">送</label>
									<textarea class="col-sm-3" rows="4" name="song" id="Config_song">{pigcms{$store_meal.song}</textarea>
								</div>
								<div style="clear:both;"></div>
							</div>

							<if condition="!empty($levelarr)">
							<div id="levelcoupon" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1" style="color:red;width:95%;">说明：必须设置一个会员等级优惠类型和优惠类型对应的数值，我们将结合优惠类型和所填的数值来计算该商品会员等级的优惠的幅度！</label>
								</div>
							    <volist name="levelarr" id="vv">
								  <div class="form-group">
								    <input  name="leveloff[{pigcms{$vv['level']}][lid]" type="hidden" value="{pigcms{$vv['id']}"/>
								    <input  name="leveloff[{pigcms{$vv['level']}][lname]" type="hidden" value="{pigcms{$vv['lname']}"/>
									<label class="col-sm-1">{pigcms{$vv['lname']}：</label>
									优惠类型：&nbsp;
									<select name="leveloff[{pigcms{$vv['level']}][type]">
										<option value="0">无优惠</option>
										<option value="1" <if condition="$vv['type'] eq 1">selected="selected"</if>>百分比（%）</option>
										<!--<option value="2">立减</option>-->
									</select>
									<input name="leveloff[{pigcms{$vv['level']}][vv]" type="text" value="{pigcms{$vv['vv']}" placeholder="请填写一个优惠值数字" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
								</div>
								</volist>
							</div>
							</if>

							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function check(obj){
	var length = $('.paycheck:checked').length;
	if(length == 0){
		$(obj).attr('checked','checked');
		bootbox.alert('最少要选择一种支付方式');
	}			
}
$(function($){
	<volist name="store_meal['deliver_time']" id="vo">
		$('#delivertime_{pigcms{$i}_start').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
		$('#delivertime_{pigcms{$i}_stop').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	</volist>

	$('#edit_form').submit(function(){
		$.post("{pigcms{:U('Meal/store_edit',array('store_id'=>$store_meal['store_id']))}",$('#edit_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "{pigcms{:U('Meal/store_edit',array('store_id'=>$store_meal['store_id']))}";
			}else{
				alert(result.info);
			}
		})
		return false;
	});
});
</script>
<include file="Public:footer"/>
