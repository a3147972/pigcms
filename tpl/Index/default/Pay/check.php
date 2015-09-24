<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>确认订单_{pigcms{$config.site_name}</title>
    <!--[if IE 6]>
		<script src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="{pigcms{$static_path}js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.v113ea197.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.v492b572b.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/search-box.v6656b683.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/cate-nav.v4299f875.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/filter.ved243bd9.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deallist.v49c087a6.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/side.v4cfd6eb1.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/qrcode.v74a11a81.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/banner-index.v8c9e126d.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.veda7cace.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ratelist.v4b84fddf.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/table-section.v538886b7.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/buy.v7e9b9347.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/deal.v8aefdc77.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/calendar.v2624266d.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/buy-process.v708a2124.css" />
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>
	<script src="{pigcms{$static_path}js/common.js"></script>
	<script src="{pigcms{$static_path}js/category.js"></script>
	
	<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
	<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
	<style>
		.payment-bank {
			margin-top: 10px;
			border: 1px solid #DFDFDF;
			padding: 5px 0 10px 20px;
			background-color: #F5F5F5;
		}
		.payment-banktit {
			height: 20px;
			line-height: 20px;
			margin-top: 5px;
			padding: 5px 0;
			font-family: \5b8b\4f53;
			cursor: pointer;
		}
		.payment-banktit b {
			display: inline-block;
			height: 20px;
			padding-left: 17px;
			color: #333;
			font-size: 14px;
		}
		.payment-bankcen {
			padding-top: 10px;
		}
		.bank {
			width: 786px;
			padding: 15px 0 0 20px;
		}
		.payment-bankcen .bank{
			padding-top: 0;
			width: 885px;
		}
		.imgradio li {
			padding-left: 20px;
			width: 112px;
			height: 32px;
			float: left;
			position: relative;
			margin: 0 25px 15px 0;
			_display: inline;
			_zomm: 1;
		}
		.imgradio li input {
			position: absolute;
			left: 0;
			top: 10px;
		}
		.imgradio li label{
			cursor:pointer;
		}
		.payment-bankcen .bank .imgradio li {
			margin-right: 45px;
		}
		.clr {
			height: 0;
			font-size: 0;
			line-height: 0;
			clear: both;
			overflow: hidden;
		}
		.form-submit {
			margin: 30px 0 20px;
		}
	</style>
</head>
<body id="deal-buy" class="pg-buy pg-buy-process">
	<div id="doc" class="bg-for-new-index">
		<header id="site-mast" class="site-mast">
			<include file="Public:header_top"/>
		</header>
		<div class="sysmsgw common-tip" id="sysmsg-error" style="display:none;"></div>
		<div id="bdw" class="bdw" style="min-height:700px;">
    		<div id="bd" class="cf">
			    <div id="content">
			    	<div>
			    		<div class="buy-process-bar-container">
						    <ol class="buy-process-desc steps-desc">
						        <li class="step step--current">
						            1. 提交订单
						        </li>
						        <li class="step">
						            2. 选择支付方式
						        </li>
						        <li class="step">
						            3. 购买成功
						        </li>
						    </ol>
						    <div class="progress">
						        <div class="progress-bar" style="width:66.66%"></div>
						    </div>
						</div>
			    	</div>
					<div class="sysmsgw common-tip" style="margin-bottom:20px;" id="sysmsg-error">
						<div class="sysmsg">
							<span class="J-msg-content"><span class="J-tip-status tip-status"></span>在微信中付款才可以使用商家优惠券和商家会员卡。&nbsp;<if condition="$order_info['order_type'] eq 'group'"><a class="see_tmp_qrcode" href="{pigcms{:U('Index/Recognition/see_tmp_qrcode',array('qrcode_id'=>2000000000+$order_info['order_id']))}">查看订单微信二维码</a><else/><a class="see_tmp_qrcode" href="{pigcms{:U('Index/Recognition/see_tmp_qrcode',array('qrcode_id'=>3000000000+$order_info['order_id']))}" target="_blank">查看订单微信二维码</a></if></span>
							<span class="close common-close">关闭</span>
						</div>
					</div>
			        <form action="{pigcms{:U('Pay/go_pay')}" method="post" id="deal-buy-form" class="common-form J-wwwtracker-form">
			            <div class="mainbox cf" style="min-height:0px;">
			            	<div class="table-section summary-table">
			                    <table cellspacing="0" class="buy-table">
			                        <tr class="order-table-head-row">
			                        	<th class="desc">项目</th>
			                        	<th class="unit-price">单价</th>
                                        <th class="amount">数量</th>
                                        <th class="col-total">总价</th>
			                    	</tr>
				                    <volist name="order_info['order_content']" id="vo">
				                        <tr>
					                        <td class="desc">{pigcms{$vo.name}</td>
					                        <td class="money J-deal-buy-price">
					                            ¥<span id="deal-buy-price">{pigcms{$vo.price}</span>
					                        </td>
					                        <td class="deal-component-quantity ">{pigcms{$vo.num}</td>
					                        <td class="money total rightpadding col-total">
	                                            ¥<span id="J-deal-buy-total">{pigcms{$vo.money}</span>
	                                        </td>
					                    </tr>
				                    </volist>
			                        <tr>
			                        	<td style="text-align:left;">
											<strong>帐户余额</strong>：
				                            <span class="inline-block money" style="color:#EA4F01;">
				                                ¥<strong id="deal-buy-total-t">{pigcms{$now_user.now_money}</strong>
				                            </span>
										</td>
				                        <td colspan="3" class="extra-fee total-fee rightpadding">
											<strong>订单总额</strong>：
				                            <span class="inline-block money">
				                                ¥<strong id="deal-buy-total-t">{pigcms{$order_info.order_total_money}</strong>
				                            </span>
				                        </td>
			                    	</tr>
			                	</table>
			            	</div>
			            </div>
						<if condition="$pay_money gt 0">
							<div>
								<strong>还需支付</strong>：
								<span class="inline-block money" style="font-size:20px;color:#EA4F01;">
									¥<strong id="deal-buy-total-t">{pigcms{$pay_money}</strong>
								</span>
							</div>
							<div id="pay_bank_list">
								<div class="payment-bank">
									<div class="payment-banktit">
										<b class="open">选择支付方式</b>
									</div>	
									<div class="payment-bankcen">
										<div class="bank morebank">
											<ul class="imgradio">
												<volist name="pay_method" id="vo">
													<li>
														<label>
															<input type="radio" name="pay_type" value="{pigcms{$key}" <if condition="$i eq 1">checked="checked"</if>>
															<img src="{pigcms{$static_public}images/pay/{pigcms{$key}.gif" width="112" height="32" alt="{pigcms{$vo.name}" title="{pigcms{$vo.name}"/>
														</label>
													</li>
												</volist>
											</ul>
											<div class="clr"></div>
										</div>
									</div>
									<div class="clr"></div>
								</div>
							</div>
						</if>
						<div class="form-submit">
							<input type="hidden" name="order_id" value="{pigcms{$order_info.order_id}"/>
				    		<input type="hidden" name="order_type" value="{pigcms{$order_info.order_type}"/>
			                <input id="J-order-pay-button" type="submit" class="btn btn-large btn-pay" name="commit" value="去付款"/><br/>
			            </div>
			    	</form>
				</div>
    		</div>
    		<!-- bd end -->
		</div>
	</div>
	<script src="http://hf.pigcms.com/static/js/artdialog/jquery.artDialog.js"></script>
	<script src="http://hf.pigcms.com/static/js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#sysmsg-error .close').click(function(){
				$('#sysmsg-error').remove();
			});
			$('.see_tmp_qrcode').click(function(){
				var qrcode_href = $(this).attr('href');
				art.dialog.open(qrcode_href+"&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'请使用微信扫描二维码',
					padding: 0,
					width: 430,
					height: 433,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					left: '50%',
					top: '38.2%',
					opacity:'0.4'
				});
				return false;
			});
			$('#deal-buy-form').submit(function(){			
				if($('input[name="pay_type"]:checked').val() == 'weixin'){
					art.dialog({
						title: '提示信息',
						id: 'weixin_pay_tip',
						opacity:'0.4',
						lock:true,
						fixed: true,
						resize: false,
						content: '正在获取微信支付相关信息，请稍等...'
					});
					$.post($('#deal-buy-form').attr('action'),$('#deal-buy-form').serialize(),function(result){
						art.dialog.list['weixin_pay_tip'].close();			
						if(result.status == 1){
							art.dialog({
								title: '请使用微信扫码支付',
								id: 'weixin_pay_qrcode',
								width:'350px',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: '<p style="margin-top:20px;margin-bottom:20px;text-align:center;font-size:16px;color:black;">请使用微信扫描二维码进行支付</p><p style="text-align:center;"><img src="{pigcms{:U('Recognition/get_own_qrcode')}&qrCon='+result.info+'" style="width:240px;height:240px;"></p><p style="text-align:center;margin-top:20px;margin-bottom:20px;"><input id="J-order-weixin-button" type="button" class="btn btn-large btn-pay" value="已支付完成"/></p>'
							});
						}else{
							art.dialog({
								title: '错误提示：',
								id: 'weixin_pay_error',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: result.info
							});
						}
					});
					return false;
				}
			});
			$('#J-order-weixin-button').live('click',function(){
				window.location.href="{pigcms{:U('Pay/weixin_back',array('order_type'=>$order_info['order_type'],'order_id'=>$order_info['order_id']))}";
			});
		});
	</script>
	<include file="Public:footer"/>
</body>
</html>
