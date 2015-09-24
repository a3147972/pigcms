<include file="Public:header" />
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li><i class="ace-icon fa fa-wechat"></i> <a
				href="{pigcms{:U('Weixin/index')}">公众号设置</a></li>
			<li>关键词回复</li>
			<li class="active">文本回复</li>
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
							<li class="active"><a href="{pigcms{:U('Weixin/txt')}"> 文字回复 </a></li>
							<li><a href="{pigcms{:U('Weixin/img')}">图文回复 </a></li>
							<!--li><a href="javascript:;">系统功能回复 </a></li-->
						</ul>
						<div class="tab-content">
							<div>
								<a href="{pigcms{:U('Weixin/txt')}" class="btn btn-success" style="margin-bottom: 20px;">返回列表</a>
							</div>
							<div class="form">
								<form class="well" id="food-form" action="" method="post">
									<p class="note">
										标有<span class="required" style="color: red;">*</span>的为必填选项
									</p>
									<div class="alert alert-danger" id="food-form_es_" <if condition="empty($error)">style="display:none"</if>><p>请更正下列输入错误:</p>
										<ul><li>{pigcms{$error}</li></ul>
									</div><br>
									<br> 关键词<span class="required" style="color: red;">*</span>：<br>
									<input class="span3" size="30" maxlength="30" name="keyword" id="keyword" type="text" value="{pigcms{$keyword['keyword']}"><br>
									<br> <input id="pigcms_id" type="hidden" value="{pigcms{$keyword['pigcms_id']}" name="pigcms_id">
									<br>
									<br>文字回复内容<span class="required" style="color: red;">*</span>:<br>
									<textarea style="width: 400px;" rows="8" maxlength="1000" id="content" name="content">{pigcms{$keyword['content']}</textarea>
									<span class="emotion"></span> <br>
									<div class="form-actions">
										<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-check bigger-110"></i> 提交</button>
									</div>
								</form>
							</div>
							<!-- form -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.comment {
	width: 680px;
	margin: 20px auto;
	position: relative
}

.comment h3 {
	height: 28px;
	line-height: 28px
}

.com_form {
	width: 100%;
	position: relative
}

.input {
	width: 99%;
	height: 60px;
	border: 1px solid #ccc
}

.com_form p {
	height: 28px;
	line-height: 28px;
	position: relative
}

span.emotion {
	width: 42px;
	height: 20px;
	display: block;
	background: url(/img/qq/icon.gif) no-repeat 2px 2px;
	padding-left: 20px;
	cursor: pointer
}

span.emotion:hover {
	background-position: 2px -28px
}

.qqFace {
	margin-top: 4px;
	background: #fff;
	padding: 2px;
	border: 1px #dfe6f6 solid;
}

.qqFace table td {
	padding: 0px;
}

.qqFace table td img {
	cursor: pointer;
	border: 1px #fff solid;
}

.qqFace table td img:hover {
	border: 1px #0066cc solid;
}
</style>

<script>
$(function(){
	$('.emotion').qqFace({
		assign:'replytext', //给那个控件赋值
		path:'/img/qq/'	//表情存放的路径
	});
	$(".btn-info").click(function(){
		var str = $(".replytext").val();
		$("#show").html(replace_em(str));
	});
});
//替换表情
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="face/$1.gif" border="0" />');
	return str;
}
</script>
<include file="Public:footer" />