<include file="Public:header" />
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li><i class="ace-icon fa fa-wechat"></i> <a
				href="{pigcms{:U('Weixin/index')}">公众号设置</a></li>
			<li>自动回复</li>
			<li class="active"><a>非关键词自动回复</a></li>
			<li>{pigcms{$tips}自动回复</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
			.ace-file-input a {
				display: none;
			}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li <if condition="$type eq 0">class="active"</if>><a href="{pigcms{:U('Weixin/auto', array('type' => 0))}">关注时回复</a></li>
							<li <if condition="$type eq 1">class="active"</if>><a href="{pigcms{:U('Weixin/auto', array('type' => 1))}">无效词自动回复</a></li>
							<li <if condition="$type eq 2">class="active"</if>><a href="{pigcms{:U('Weixin/auto', array('type' => 2))}">图片自动回复</a></li>
						</ul>
						
						<div class="tab-content">
							<form class="form-horizontal" id="food-form" action="" method="post">
								<div class="alert alert-danger" id="food-form_es_" <if condition="empty($error)">style="display:none"</if>><p>请更正下列输入错误:</p>
									<ul><li>{pigcms{$error}</li></ul>
								</div>
								<input type="hidden" id="type" name="type" value="{pigcms{$type}" />
								<div class="widget-box">
									<div class="widget-header">
										<h5>{pigcms{$tips}自动回复</h5>
									</div>
											
									<div class="widget-body" style="padding:20px;">
										<div class="form-group">
											<div class="checkbox">
												<label>
													<input class="ace" name="is_open" id="Subscribe_reply_valid" value="1" <if condition="$other['is_open'] eq 1">checked="checked"</if> type="checkbox">									
													<span class="lbl"><label for="Subscribe_reply_valid">开启{pigcms{$tips}自动回复</label></span>
												</label>
											</div>
										</div>
									</div>
								</div>					
											
								<div class="widget-box">
									<div class="widget-header">
										<h5>{pigcms{$tips}回复类型</h5>
									</div>				
									<div class="widget-body" style="padding:20px;">		
										<span id="Subscribe_reply_type">
											<input id="Subscribe_reply_type_0" value="0" <if condition="$other['reply_type'] eq 0">checked="checked"</if> type="radio" name="reply_type"> <label for="Subscribe_reply_type_0">文字回复</label><br>
											<input id="Subscribe_reply_type_1" value="1" <if condition="$other['reply_type'] eq 1">checked="checked"</if> type="radio" name="reply_type"> <label for="Subscribe_reply_type_1">图文回复</label><br>
											<!--input id="Subscribe_reply_type_2" value="2" <if condition="$other['reply_type'] eq 2">checked="checked"</if> type="radio" name="reply_type"> <label for="Subscribe_reply_type_2">系统功能回复</label><br-->
										</span>					
									</div>
								</div>					
								
								<div class="widget-box">
									<div class="widget-header">
										<h5>回复的文字内容</h5>
									</div>
											
									<div class="widget-body" style="padding:20px;">
										<textarea class="span6 autosize-transition form-control" rows="10" maxlength="1000" id="content" name="content">{pigcms{$other['content']}</textarea>						
										<span class="emotion"></span>
									</div>
								</div>
								<div class="widget-box">
									<div class="widget-header">
										<h5>回复的图文消息</h5>
									</div>
											
									<div class="widget-body" style="padding:20px;">
										<select name="source_id" id="source_id">
										<volist name="list" id="vo">
										<option value="{pigcms{$vo['pigcms_id']}" <if condition="$other['from_id'] eq $vo['pigcms_id']">selected</if>>{pigcms{$vo['list'][0]['title']}<if condition="$vo['type']">（多图）<else />（单图）</if></option>
										</volist>
										</select>					
									</div>
								</div>
								<!--div class="widget-box">
									<div class="widget-header">
										<h5>回复的系统功能</h5>
									</div>
									<div class="widget-body" style="padding:20px;">
										<select name="Subscribe[reply_system_type]" id="Subscribe_reply_system_type">
											<option value="1">开始点单</option>
											<option value="2">订单查询</option>
											<option value="3">个人信息</option>
											<option value="4">大转盘抽奖</option>
											<option value="5">会员中心</option>
											<option value="6">优惠券</option>
											<option value="7">我的邮箱</option>
											<option value="8">积分</option>
											<option value="9">签到</option>
											<option value="10">多客服</option>
											<option value="11">我的收藏</option>
											<option value="12">店铺导航</option>
										</select>					
									</div>
								</div-->
								
								<div style="clear:both;"></div>
								<div class="form-actions">
									<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									提交
									</button>
								</div>
											
							</form>			
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
<include file="Public:footer" />