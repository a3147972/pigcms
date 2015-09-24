<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Group/product')}">商品列表</a> |
					<a href="{pigcms{:U('Group/group_edit')}" class="on">编辑商品</a>
				</ul>
			</div>
			<form id="myform" method="post" action="{pigcms{:U('Group/amend')}" refresh="true">
				<ul class="tab_ul">
					<li class="active"><a data-toggle="tab" href="#tab_alipay">支付宝支付</a></li>
					<li><a data-toggle="tab" href="#tab_tenpay">财付通支付</a></li>
					<li><a data-toggle="tab" href="#tab_yeepay">银行卡支付（易宝支付）</a></li>
					<li><a data-toggle="tab" href="#tab_allinpay">银行卡支付（通联支付）</a></li>
					<li><a data-toggle="tab" href="#tab_chinabank">银行卡支付（网银在线）</a></li>
					<li><a data-toggle="tab" href="#tab_weixin">微信支付</a></li>
				</ul>
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%" id="tab_alipay">
					<tr><th width="160">开启：</th><td><span class="cb-enable"><label class="cb-enable "><span>开启</span><input type="radio" name="pay_alipay_open" value="1" /></label></span><span class="cb-disable"><label class="cb-disable selected"><span>关闭</span><input type="radio" name="pay_alipay_open" value="0" checked="checked"/></label></span></td></tr>
					<tr><th width="160">帐号：</th><td><input type="text" class="input-text" name="pay_alipay_name" id="config_pay_alipay_name" value="partnerkeypartnerkey1" size="80" validate="" tips=""/></td></tr>
					<tr><th width="160">PID：</th><td><input type="text" class="input-text" name="pay_alipay_pid" id="config_pay_alipay_pid" value="partnerkeypartnerkey2" size="80" validate="" tips=""/></td></tr>
					<tr><th width="160">KEY：</th><td><input type="text" class="input-text" name="pay_alipay_key" id="config_pay_alipay_key" value="partnerkeypartnerkey3" size="80" validate="" tips=""/></td></tr>
				</table>
				<div class="btn">
					<input TYPE="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
		<script>
			$(function(){
				$('.table_form:eq(0)').show();
				
				$('.tab_ul li a').click(function(){
					$(this).closest('li').addClass('active').siblings('li').removeClass('active');
					$($(this).attr('href')).show().siblings('.table_form').hide();
				});
			});
		</script>
		<style>
			.table_form{border:1px solid #ddd;}
			.tab_ul{margin-top:20px;border-color:#C5D0DC;margin-bottom:0!important;margin-left:0;position:relative;top:1px;border-bottom:1px solid #ddd;padding-left:0;list-style:none;}
			.tab_ul>li{position:relative;display:block;float:left;margin-bottom:-1px;}
			.tab_ul>li>a {
position: relative;
display: block;
padding: 10px 15px;
margin-right: 2px;
line-height: 1.42857143;
border: 1px solid transparent;
border-radius: 4px 4px 0 0;
padding: 7px 12px 8px;
min-width: 100px;
text-align: center;
}
.tab_ul>li>a, .tab_ul>li>a:focus {
border-radius: 0!important;
border-color: #c5d0dc;
background-color: #F9F9F9;
color: #999;
margin-right: -1px;
line-height: 18px;
position: relative;
}
.tab_ul>li>a:focus, .tab_ul>li>a:hover {
text-decoration: none;
background-color: #eee;
}
.tab_ul>li>a:hover {
border-color: #eee #eee #ddd;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li>a:hover {
background-color: #FFF;
color: #4c8fbd;
border-color: #c5d0dc;
}
.tab_ul>li:first-child>a {
margin-left: 0;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul:before,.tab_ul:after{
content: " ";
display: table;
}
.tab_ul:after{
clear: both;
}
		</style>
<include file="Public:footer"/>