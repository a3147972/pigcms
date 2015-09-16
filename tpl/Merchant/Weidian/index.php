<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-shopping-cart"></i>&nbsp;<a href="{pigcms{:U('Weidian/index')}">微店</a>
			</li>
			<li>微店设置</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<!--div class="alert alert-info" style="margin-top:10px;">
					<button type="button" class="close"><i class="ace-icon fa fa-times"></i></button>
					当您开启了微店，则您会得到
				</div-->
				<if condition="empty($now_merchant['weidian_url'])">
					<div class="alert alert-warning" style="margin-top:10px;">
						<button type="button" class="close"><i class="ace-icon fa fa-times"></i></button>
						您还未开启微店，请先开启。
					</div>
				</if>
				<div class="form-group">
					<label class="col-sm-1" style="line-height:40px;">管理我的微店</label>
					<div style="padding-top:4px;line-height:24px;">
						<if condition="empty($now_merchant['weidian_url'])">
							<button class="btn btn-success" id="create_shop">开启微店</button>
						<else/>
							<button class="btn btn-success" id="manage_shop">管理微店</button>
						</if>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#create_shop').click(function(){
			$.post("{pigcms{:U('Weidian/create')}",function(result){
				alert(result.info);
				if(result.status == 1){
					window.location.reload();				
				}
			});
		});
		$('#manage_shop').click(function(){
			window.location.href = "{pigcms{:U('Weidian/manage')}";
		});
	});
</script>
<include file="Public:footer"/>
