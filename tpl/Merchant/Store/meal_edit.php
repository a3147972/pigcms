<include file="Store:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-cutlery"></i>
				{pigcms{$config.meal_alias_name}订单列表
			</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="">
								<div class="form-group">
									<input type="hidden" name="order_id" value="{pigcms{$order.order_id}">
									<label class="col-sm-1"><label for="contact_name">{pigcms{$config.meal_alias_name}人姓名</label></label>
									<label class="col-sm-3">{pigcms{$order.name}</label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">{pigcms{$config.meal_alias_name}人电话</label></label>
									<label class="col-sm-3">{pigcms{$order.phone}</label>
								</div>
								<if condition="$order['address']">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">{pigcms{$config.meal_alias_name}人地址</label></label>
									<label class="col-sm-3">{pigcms{$order.address}</label>
								</div>
								</if>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">餐台号</label></label>
									<label class="col-sm-3">{pigcms{$order.tablename}</label>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">下单时间</label></label>
									<label class="col-sm-3">{pigcms{$order.dateline|date="Y-m-d H:i:s",###}</label>
								</div>
								
								<div class="form-group" style="margin-bottom:-35px;">
									<label class="col-sm-1"><label for="AutoreplySystem_img">菜单列表</label></label>
								</div>
								<div class="form-group" style="width:417px;padding-left:152px;">
									<volist name="order['info']" id="info">
									<div>{pigcms{$info['name']}:￥{pigcms{$info['price']} * {pigcms{$info['num']}</div>
									</volist>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">订单总额 </label></label>
									<label class="col-sm-3">￥<if condition="$order['total_price'] gt 0">{pigcms{$order['total_price']}<else />{pigcms{$order.price}</if></label>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">优惠金额 </label></label>
									<label class="col-sm-3">￥{pigcms{$order['minus_price']}</label>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">实收金额 </label></label>
									<label class="col-sm-3">￥{pigcms{$order['total_price'] - $order['minus_price']}</label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contant_url">顾客留言</label></label>
									<label class="col-sm-3"><if condition="$order['note']">{pigcms{$order.note|htmlspecialchars_decode=ENT_QUOTES}<else />顾客没有特殊说明</if></label>
								</div>
								
								<!--div class="form-group">
									<label class="col-sm-1"><label for="sorts">修改总价</label></label>
									<input class="col-sm-1" type="text" id="sorts" value="{pigcms{$order.price}" name="sorts"/>
								</div-->
								
								<div class="form-group">
									<label class="col-sm-1"><label for="canrqnums">是否已付款</label></label>
									<label class="col-sm-3">
										<if condition="$order['paid'] eq 0">
										<span class="lbl" style="z-index:1;color:red;">未付款</span>
										<elseif condition="$order['paid'] eq 1" />
										<span class="lbl" style="z-index:1;color:green;">已付款</span>
										<elseif condition="$order['paid'] eq 2" />
										<span class="lbl" style="z-index:1;color:green;">已付￥{pigcms{$order['pay_money']}</span>，<span class="lbl" style="z-index:1;color:red;">未付￥{pigcms{$order['price'] - $order['pay_money']}</span>
										</if>
									</label>
								</div>
								<if condition="$order['status'] eq 0" >
									<div class="form-group">
										<label class="col-sm-1"><label for="canrqnums">是否已消费</label></label>
										<div class="radio">
											<label>
												<input name="status" value="1" type="radio" <if condition="$order['status'] eq 1" >checked="checked"</if>/>
												<span class="lbl" style="z-index: 1">已消费</span>
											</label>　
											<label>
												<input name="status" value="0" type="radio" <if condition="$order['status'] eq 0">checked="checked"</if>/>
												<span class="lbl" style="z-index: 1">未消费</span>
											</label>
										</div>	
										<span class="form_tips" style="color: red">注：改成已消费状态后同时如果是未付款状态则修改成线下支付已支付，状态修改后就不能修改了</span>									
									</div>
								<else />
									<div class="form-group">
										<label class="col-sm-1"><label for="canrqnums">是否已消费</label></label>
										<label class="col-sm-3">已消费</label>
									</div>
								</if>
								<if condition="$order['store_uname']">
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_info">上次处理订单人</label></label>
									<label class="col-sm-3">{pigcms{$order.store_uname}</label>
								</div>
								</if>
								<if condition="$order['status'] eq 0" >
								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">
										<button class="btn btn-info" type="submit">
											<i class="ace-icon fa fa-check bigger-110"></i>
											保存
										</button>
									</div>
								</div>
								</if>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<include file="Public:footer"/>
