<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-cloud"></i>
				<a href="{pigcms{:U('Hardware/index')}">微硬件</a>
			</li>
			<li class="active">增加打印机</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tab-content">
						<div class="grid-view">
							<form enctype="multipart/form-data" class="form-horizontal" method="post">
								<input type="hidden" name="pigcms_id" value="{pigcms{$orderprint['pigcms_id']}"/>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort_name">绑定手机号</label></label>
									<input class="col-sm-2" size="20" name="mp" id="mp" type="text" value="{pigcms{$orderprint['mp']}"/>
									<span class="form_tips">绑定手机号和绑定账号只能填写一个（老的打印机【黑色机器】需填写手机号，新的打印机【白色机器】需填写绑定账号）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort_name">绑定账号</label></label>
									<input class="col-sm-2" size="20" name="username" id="username" type="text" value="{pigcms{$orderprint['username']}"/>
									<span class="form_tips">绑定手机号和绑定账号只能填写一个（老的打印机【黑色机器】需填写手机号，新的打印机【白色机器】需填写绑定账号）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">终端号</label></label>
									<input class="col-sm-2" size="20" name="mcode" id="mcode" type="text" value="{pigcms{$orderprint['mcode']}"/>
									<span class="form_tips">新的打印机点击打印机下面的黑色小按钮查看, 老的打印机在打印机底部查看</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">密钥</label></label>
									<input class="col-sm-2" size="20" name="mkey" id="mkey" type="text" value="{pigcms{$orderprint['mkey']}"/>
									<span class="form_tips">新的打印机在注册页面查看, 老的打印机在打印机底部查看</span>
								</div>
								<!--div class="form-group">
									<label class="col-sm-1"><label for="sort">默认打印的二维码</label></label>
									<input class="col-sm-2" size="20" name="qrcode" id="qrcode" type="text" value="{pigcms{$orderprint['qrcode']}"/>
									<span class="form_tips">默认打印的二维码(只能是微信二维码或是支付宝二维码的链接)【注：老的打印机不支持打印二维码，新的机器支持二维码打印】</span>
								</div-->
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">打印份数</label></label>
									<input class="col-sm-1" maxlength="2" name="count" id="count" type="text" value="{pigcms{$orderprint['count']|default='1'}"/>
									<span class="form_tips">每个订单打印几份（最多100）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="store_id">选择店面</label>
									<select name="store_id" id="store_id">
										<volist name="stores" id="store">
										<option value="{pigcms{$store['store_id']}" <if condition="$store['store_id'] eq $orderprint['store_id']">selected="selected"</if>>{pigcms{$store['name']}</option>
										</volist>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1" for="FoodType_week">打印类型</label>
									<div class="col-sm-10" style="margin-top:5px;">
										<div style="width:180px;float:left;font-size:16px;">
											<label><input type="radio" value="1" name="paid" <if condition="$orderprint['paid']">checked="checked"</if>/>只打印付过款的 </label>&nbsp;&nbsp;
										</div>
										<div style="width:180px;float:left;font-size:16px;">
											<label><input type="radio" value="0" name="paid" <if condition="$orderprint['paid'] eq 0">checked="checked"</if>/>无论是否付款都打印</label>&nbsp;&nbsp;
										</div>
									</div>
								</div>
								<if condition="$ok_tips">
									<div class="form-group" style="margin-left:0px;">
										<span style="color:blue;">{pigcms{$ok_tips}</span>				
									</div>
								</if>
								<if condition="$error_tips">
									<div class="form-group" style="margin-left:0px;">
										<span style="color:red;">{pigcms{$error_tips}</span>				
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
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<include file="Public:footer"/>
