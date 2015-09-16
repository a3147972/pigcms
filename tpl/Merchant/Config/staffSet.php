<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Config/store')}">店铺管理</a>
			</li>
			<li>
				<a href="{pigcms{:U('Config/staff', array('store_id' => $now_store['store_id']))}">【{pigcms{$now_store.name}】 店员列表</a>
			</li>
			<li class="active"><if condition="$item">修改<else/>添加</if>店员</li>
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
									<label class="col-sm-1"><label for="name">姓名</label></label>
									<input type="text" class="col-sm-2" name="name" id="name" value="{pigcms{$item.name}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="username">帐号</label></label>
									<input type="text" class="col-sm-2" name="username" id="username" value="{pigcms{$item.username}" />
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="password">密码</label></label>
									<input type="password" class="col-sm-2" name="password" id="password" />
									<if condition="$item['password']"><span class="form_tips">(如果不修改密码请留空)</span></if>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="contact_name">电话</label></label>
									<input type="text" class="col-sm-2" name="tel" id="tel" value="{pigcms{$item.tel}" />
								</div>
								<div class="clearfix form-actions">
									<div class="col-md-9">
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