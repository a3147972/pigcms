<include file="Public:header"/>

<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-wechat"></i>
				<a href="{pigcms{:U('Weixin/index')}">公众号设置</a>
			</li>
			<li class="active">公众号绑定</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<if condition="empty($bind)">
						<if condition="$url">
							<div id="shopList" class="grid-view">
								<div class="span12" style="margin-top:10px;">
									<div class="form-actions">
										<a class="btn btn-success cert-setting-btn js-wxauth-btn" target="_blank" data-url="{pigcms{$url}" href="{pigcms{$url}"><i class="ace-icon fa fa-wechat"></i>我有微信公众号，立即设置</a>
									</div>
								</div>
							</div>
						<else />
							<div id="shopList" class="grid-view">
								<div class="span12" style="margin-top:10px;">
									<div class="form-actions">
										<a class="btn btn-error cert-setting-btn">平台还没有开启网页授权，或管理员配置错误，请联系系统管理者！</a>
									</div>
								</div>
							</div>
						</if>
					<else />
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="form-group">
									<label class="col-sm-1"><label>公众微信号</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['alias']}" type="text" style="border:none;background:white!important;" readonly="readonly"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>公众号昵称</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['nick_name']}" type="text" style="border:none;background:white!important;" readonly="readonly"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>微信账号类型</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['type_info']}" type="text" style="border:none;background:white!important;" readonly="readonly"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>公众号二维码</label></label>
									<div id="upload_pic_box"><img width="158" height="158" src="http://open.weixin.qq.com/qr/code/?username={pigcms{$bind['alias']}"/></div>
								</div>
							</div>
						</div>
					</form>
					</if>
				</div>
			</div>
		</div>
	</div>
</div>

<if condition="empty($bind)">
<script type="text/javascript">
	$(document).ready(function(){
// 		$.get('merchant.php?g=Merchant&c=Weixin&a=get_url',function(response){
// 			if (response.err_code) {
// 			} else {
// 				$('.js-wxauth-btn').attr('data-url', response.err_msg);
// 			}
// 		},'json');

		$('.js-wxauth-btn').click(function(){

// 			$(".modal").dialog({
// 			    autoOpen: false,
// 			    modal: true,
// 			    buttons: {
// 			        Ok: function () {
// 			            $(this).dialog("close");
// 			        }
// 			    }
// 			});
// 			return false;
			var url = $(this).attr('data-url');
			if(url == ''){
// 				layer_tips(1,'授权网址获取失败，请联系管理员！');
// 				return false;
			}
// 			window.open(url); 
			var html = '';
			html += '<div class="modal fade in" style="width: 400px;height:165px;margin-top:-5px; " aria-hidden="false"><div class="modal-header">';
			html += '<a class="close" data-dismiss="modal">×</a>提示</div>';
			html += '<div class="modal-body">';
			html += '<p>请在新窗口中完成微信公众号授权&nbsp;&nbsp;<a href="" target="_blank"></a></p>';
			html += '</div>';
			html += '<div class="modal-footer">';
			html += '<div style="text-align: center;">';
			html += '<button type="button" class="btn btn-success js-refresh">已成功设置</button>';
			html += '<a class="btn btn-default js-retry" href="'+url+'" target="_blank" data-loading-text="地址读取中..">授权失败，重试</a>';
			html += '</div>';
			html += '</div></div>';//<div class="modal-backdrop fade in"></div>';
			$('body').append(html);
		});
		$('.close').live('click', function(){
			$(this).parents('.modal').remove();
			$('.modal-backdrop').remove();
		});
		$('.js-refresh').live('click', function(){
			location.reload();
		});
	});
</script>
</if>

<link rel="stylesheet" href="{pigcms{$static_path}css/base.css">
<style>
.form-actions {
background-color: #fff;
}
.modal{
display:block;
}
</style>
<include file="Public:footer"/>
