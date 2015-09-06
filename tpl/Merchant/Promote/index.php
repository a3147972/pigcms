<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-qrcode"></i>
				<a href="{pigcms{:U('Promote/index')}">商家推广</a>
			</li>
			<li>商家推广二维码</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="form-group">
					<label class="col-sm-1">商家推广二维码</label>
					<div style="padding-top:4px;line-height:24px;"><a href="{pigcms{$config.site_url}/index.php?g=Index&c=Recognition&a=see_qrcode&type=merchant&id={pigcms{$now_merchant.mer_id}&img=1" class="see_qrcode">查看二维码</a></div>
				</div>
				<div class="col-xs-12">
					<div style="border:1px solid #c5d0dc;padding-left:22px;margin-bottom:10px;margin-top:20px;">
						<div class="alert alert-info" style="margin-top:10px;">
							<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>首页排序值是用户通过您的商户二维码关注平台公众号来进行获取累加的一种值。该值越高，您的{pigcms{$config.group_alias_name}信息则将有可能在首页展示。<br/>现在系统设置的扫描一次累加的值为（{pigcms{$config.merchant_qrcode_indexsort}）！在首页中被点击一次，将会扣除一点值。<br/>您可以设置将储存自动增长给哪个{pigcms{$config.group_alias_name}，也可以不选择，若不选择{pigcms{$config.group_alias_name}则会累加值到商家帐号上。
						</div>
						<div class="form-group" style="margin-top:10px;color:red;">您现在的首页排序储存值为 {pigcms{$now_merchant.storage_indexsort}</div>
						<if condition="$merchant_group_list">
							<div class="form-group">
								<label class="col-sm-2">将储存值转给：</label>
								<select name="group_indexsort" id="group_indexsort">
									<option value="0">不转</option>
									<volist name="merchant_group_list" id="vo">
										<option value="{pigcms{$vo.group_id}">[{pigcms{$vo.index_sort}] {pigcms{$vo.s_name}</option>
									</volist>
								</select>
							</div>
							<div class="form-group">
								<label class="col-sm-2">将选中{pigcms{$config.group_alias_name}设置为自动增长：</label>
								<select name="indexsort_groupid" id="indexsort_groupid">
									<option value="0">不设置</option>
									<volist name="merchant_group_list" id="vo">
										<option value="{pigcms{$vo.group_id}" <if condition="$vo['group_id'] eq $now_merchant['auto_indexsort_groupid']">selected="selected"</if>>[{pigcms{$vo.index_sort}] {pigcms{$vo.s_name}</option>
									</volist>
								</select>
							</div>
							<div class="form-group">
								<button id="indexsort_edit_btn" class="small_btn">修改</button>
							</div>
						<else/>
							<div class="form-group" style="margin-top:10px;color:red;">请您先添加{pigcms{$config.group_alias_name}信息！</div>
						</if>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
input.ke-input-text {
background-color: #FFFFFF;
background-color: #FFFFFF!important;
font-family: "sans serif",tahoma,verdana,helvetica;
font-size: 12px;
line-height: 24px;
height: 24px;
padding: 2px 4px;
border-color: #848484 #E0E0E0 #E0E0E0 #848484;
border-style: solid;
border-width: 1px;
display: -moz-inline-stack;
display: inline-block;
vertical-align: middle;
zoom: 1;
}
.form-group>label{font-size:12px;line-height:24px;}
#upload_pic_box{margin-top:20px;height:150px;}
#upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
#upload_pic_box img{width:100px;height:70px;}

.small_btn{
margin-left: 10px;
padding: 6px 8px;
cursor: pointer;
display: inline-block;
text-align: center;
line-height: 1;
letter-spacing: 2px;
font-family: Tahoma, Arial/9!important;
width: auto;
overflow: visible;
color: #333;
border: solid 1px #999;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
background: #DDD;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#DDDDDD');
background: linear-gradient(top, #FFF, #DDD);
background: -moz-linear-gradient(top, #FFF, #DDD);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFF), to(#DDD));
text-shadow: 0px 1px 1px rgba(255, 255, 255, 1);
box-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0 -1px 0 rgba(0, 0, 0, .09);
-moz-transition: -moz-box-shadow linear .2s;
-webkit-transition: -webkit-box-shadow linear .2s;
transition: box-shadow linear .2s;
outline: 0;
}
.small_btn:active{
border-color: #1c6a9e;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33bbee', endColorstr='#2288cc');
background: linear-gradient(top, #33bbee, #2288cc);
background: -moz-linear-gradient(top, #33bbee, #2288cc);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#33bbee), to(#2288cc));
}
</style>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	$(function(){
		$('#indexsort_edit_btn').click(function(){
			$(this).prop('disabled',true).html('提交中...');
			$.post("{pigcms{:U('Config/merchant_indexsort')}",{group_indexsort:$('#group_indexsort').val(),indexsort_groupid:$('#indexsort_groupid').val()},function(result){
				alert('处理完成！正在刷新页面。');
				window.location.href = window.location.href;
			});
		});
		$('.see_qrcode').click(function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看渠道二维码',
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
	});
</script>
<include file="Public:footer"/>
