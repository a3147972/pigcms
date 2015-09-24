<include file="Public:header"/>

<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-wechat"></i>
				<a href="{pigcms{:U('Weixin/index')}">公众号设置</a>
			</li>
			<li class="active">自定义菜单</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<if condition="isset($weixin['code']) AND $weixin['code'] gt 0">
					<div>
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							在设置公众号自定义菜单之前，请先在帐号设置中设置好您的AppId和AppSecret，设置方法可以点击下面的设置教程查看。
						</div>
					</div>
					<div>
						<form id="form1" name="form1" method="post" action="">
							<table class="table table-striped">
								<tbody>
									<tr>
										<th scope="col">菜单序号</th>
										<th scope="col">菜单名称</th>
										<th scope="col">触发方式</th>
										<th scope="col">消息关键词</th>
										<th scope="col">跳转网页地址</th>    
									</tr>
									<for start="1" end="4">
										<tr class="parent" data-index="{pigcms{$i}">
											<td><i class="ace-icon fa fa-plus"></i>　主菜单{pigcms{$i}</td>
											<td>
												<input name="custommenu[{pigcms{$i}][title]" type="text" class="span2 title" id="{pigcms{$i}_title" value="<if condition="isset($dlists[$i]['title'])">{pigcms{$dlists[$i]['title']}</if>">
												<input name="custommenu[{pigcms{$i}][id]" type="hidden" class="span2 id" id="{pigcms{$i}_id" value="<if condition="isset($dlists[$i]['id'])">{pigcms{$dlists[$i]['id']}</if>">
											</td>
											<td>
												<select name="custommenu[{pigcms{$i}][wxsys]" class="span2" id="{pigcms{$i}_wxsys">
													<option value="0" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 0)">selected="selected"</if>>发送消息</option>
													<option value="1" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 1)">selected="selected"</if>>跳转到网页</option>
													<option value="scancode_waitmsg" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 'scancode_waitmsg')">selected="selected"</if>>扫码带提示</option> 
													<option value="scancode_push" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 'scancode_push')">selected="selected"</if>>扫码推事件</option>
													<option value="pic_sysphoto" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 'pic_sysphoto')">selected="selected"</if>>系统拍照发图</option>
													<option value="pic_photo_or_album" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 'pic_photo_or_album')">selected="selected"</if>>拍照或者相册发图</option>
													<option value="pic_weixin" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 'pic_weixin')">selected="selected"</if>>微信相册发图</option>
													<option value="location_select" <if condition="isset($dlists[$i]['wxsys']) AND ($dlists[$i]['wxsys'] eq 'location_select')">selected="selected"</if>>发送位置</option>
												</select>
											</td>
											<td><input name="custommenu[{pigcms{$i}][keyword]" type="text" class="span2 keyword" id="{pigcms{$i}_keyword" value="<if condition="isset($dlists[$i]['keyword'])">{pigcms{$dlists[$i]['keyword']}</if>"></td>
											<td><input name="custommenu[{pigcms{$i}][url]" type="text" class="span3 url" id="{pigcms{$i}_url" value="<if condition="isset($dlists[$i]['url'])">{pigcms{$dlists[$i]['url']}</if>">　　<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('{pigcms{$i}_url',0)" data-toggle="modal">从功能库选择</a></td>
										</tr>
										<for start="1" end="6" name="k">
										<tr class="childs_{pigcms{$i} hidden">
											<td>子菜单{pigcms{$k}</td>
											<td>
												<input name="custommenu[{pigcms{$i * 10 + $k}][title]" type="text" class="span2 title" id="{pigcms{$i * 10 + $k}_title" value="<if condition="isset($dlists[$i]['list'][$k]['title'])">{pigcms{$dlists[$i]['list'][$k]['title']}</if>">
												<input name="custommenu[{pigcms{$i * 10 + $k}][id]" type="hidden" class="span2 id" id="{pigcms{$i * 10 + $k}_id" value="<if condition="isset($dlists[$i]['list'][$k]['id'])">{pigcms{$dlists[$i]['list'][$k]['id']}</if>">
											</td>
											<td>
												<select name="custommenu[{pigcms{$i * 10 + $k}][wxsys]" class="span2" id="{pigcms{$i * 10 + $k}_wxsys">
													<option value="0" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 0)">selected="selected"</if>>发送消息</option>
													<option value="1" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 1)">selected="selected"</if>>跳转到网页</option>
													<option value="scancode_waitmsg" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 'scancode_waitmsg')">selected="selected"</if>>扫码带提示</option> 
													<option value="scancode_push" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 'scancode_push')">selected="selected"</if>>扫码推事件</option>
													<option value="pic_sysphoto" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 'pic_sysphoto')">selected="selected"</if>>系统拍照发图</option>
													<option value="pic_photo_or_album" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 'pic_photo_or_album')">selected="selected"</if>>拍照或者相册发图</option>
													<option value="pic_weixin" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 'pic_weixin')">selected="selected"</if>>微信相册发图</option>
													<option value="location_select" <if condition="isset($dlists[$i]['list'][$k]['wxsys']) AND ($dlists[$i]['list'][$k]['wxsys'] eq 'location_select')">selected="selected"</if>>发送位置</option>
												</select>
											</td>
											<td><input name="custommenu[{pigcms{$i * 10 + $k}][keyword]" type="text" class="span2 keyword" id="{pigcms{$i * 10 + $k}_keyword" value="<if condition="isset($dlists[$i]['list'][$k]['keyword'])">{pigcms{$dlists[$i]['list'][$k]['keyword']}</if>"></td>
											<td><input name="custommenu[{pigcms{$i * 10 + $k}][url]" type="text" class="span2 url" id="{pigcms{$i * 10 + $k}_url" value="<if condition="isset($dlists[$i]['list'][$k]['url'])">{pigcms{$dlists[$i]['list'][$k]['url']}</if>">　　<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('{pigcms{$i * 10 + $k}_url',0)" data-toggle="modal">从功能库选择</a></td>
										</tr>
										</for>
									</for>
								</tbody>
							</table>
							<div class="form-actions">
								<button class="btn btn-success" type="button" id="save_menu">保存</button>
							</div>
						</form>
					</div>
					<else />
					<div>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
							您当前的账号是{pigcms{$weixin['errmsg']},不能创建自定义菜单！
						</div>
					</div>
					</if>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('.ace-icon').click(function(){
		var index = $(this).parents('.parent').attr('data-index');
		$(this).toggleClass('fa-plus').toggleClass('fa-minus');
		$('.childs_' + index).toggleClass('hidden');
	});

	$('#save_menu').click(function(){
		var obj = $(this);
		$('.parent').each(function(i){
			var flag = false;
			if ($(this).find('.title').val() == '') {
				$('.childs_' + parseInt(i + 1)).each(function(k){
					if ($(this).find('.title').val() != '') {
						flag = true;
						return false;
					}
				});
			}
			if (flag) {
				alert('有不规范的数据，没有父菜单有了子菜单');
				return false;
			}
		});
		obj.attr('disabled', true).val('创建中...');
		$.post('/merchant.php?g=Merchant&c=Weixin&a=savemenu', $('#form1').serialize(), function(data){
			if (data.errcode) {
				obj.attr('disabled', false).val('保存');
				alert(data.errmsg);
			} else {
				alert(data.errmsg);
				setTimeout(location.reload(), 1000);
			}
		}, 'json');
	});
});
</script>
<include file="Public:footer"/>