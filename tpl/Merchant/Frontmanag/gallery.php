<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Frontmanag/index')}">商家管理</a>
			</li>
			<li class="active">商家相册管理</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.red{display:inline-block; font-size: 18px;margin-left: 70px;}
				 td,th {text-align: center;}
				.lastimg img{height: 100px;}
				.ke-dialog-row .ke-input-text{height: 35px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateClassify()">新建分类</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="red">温馨提示：发布动态、相册必需要有分类！</span>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="7%">编号</th>
									<th width="7%">排序</th>
									<th width="15%">分类名称</th>
									<th width="25%">图片</th>
									<th width="10%">查看图集</th>
									<th style="text-align:center">操作</th>
								</tr>
							</thead>
							<tbody id="tbodyList">
								<if condition="!empty($classifyarr)">
									<volist name="classifyarr" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.id}</td>
											<td>{pigcms{$vo.sort}</td>
											<td>{pigcms{$vo.cyname}</td>
											<td class="lastimg"><if condition="!empty($vo['lastimg'])"><img src="{pigcms{$config.site_url}/{pigcms{$vo.lastimg}"><else/>暂无图片</if></td>
											<td><a href="{pigcms{:U('Frontmanag/allpic',array('cyid'=>$vo['id']))}" class="see_imgsC">查看图集</a></td>
											<td class="button-column" nowrap="nowrap">
											   <input type="hidden" value="{pigcms{$vo.id}"/>
											 	<a href="javascript:void(0)" class="btn btn-sm btn-success J_selectImage">上传图片</a>
												<span class="form_tips"></span>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="11" >无内容</td></tr>
								</if>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
function CreateClassify(){
	window.location.href = "{pigcms{:U('Frontmanag/classify')}";
}
KindEditor.ready(function(K){
	var editor = K.editor({
		allowFileManager : true
	});
	 //var islock=false;
	K('.J_selectImage').click(function(){
		var cyid=$(this).siblings('input').val();
		//var imgobj=$(this).parent('td').siblings('.lastimg').find('img');
		var imgobj=$(this).parent('td').siblings('.lastimg');
		editor.uploadJson = "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=merchant/news";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$.post("{pigcms{:U('Frontmanag/save_pic')}",{imgurl:url,cyid:cyid},function(){
					    //islock=false;
						if(imgobj.find('img').size()>0){
						   imgobj.find('img').attr('src',"{pigcms{$config.site_url}/"+url);
						}else{
						  imgobj.html('<img src="{pigcms{$config.site_url}/'+url+'">');
						}
					});
					/*$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImage(\''+title+'\',this);return false;">[ 删除 ]</a></li>');*/
					editor.hideDialog();
					//window.location.reload();
				}
			});
		});
	   
	});
});
</script>

<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	$(function(){
		$('.see_imgsC').click(function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看图集',
				padding: 0,
				width: 800,
				height: 700,
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
