<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-tablet"></i>
				<a href="{pigcms{:U('Tmpls/index')}">微网站</a>
			</li>
			<li class="active">模板选择</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">	
							<li class="active">
								<a href="javascript:void(0);">1.栏目首页风格</a>
							</li>	
							<!-- <li>
								<a href="{pigcms{:U('Config/store_add')}">2.图文列表模板风格</a>
							</li>	
							<li>
								<a href="{pigcms{:U('Config/store_add')}">3.图文详细页模板风格</a>
							</li>	
							<li>
								<a href="{pigcms{:U('Config/store_add')}">4.颜色风格&预览</a>
							</li> -->
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
					            <fieldset>
					                <div class="g filterBox">
					                  <h1>按级别选择:</h1>
					                  <ul class="filterBtn">	 					
					                  	<li class="filter" data-filter="ck"><p>我选中的模版</p><i></i></li>
					                    <li class="filter on active" data-filter="all"><p>全部模版</p><i></i></li>
					                    <li class="filter" data-filter="sub"><p>可显示两级分类</p><i></i></li>
					                    <li class="filter" data-filter="focu"><p>支持幻灯片</p><i></i></li>
					                    <li class="filter" data-filter="bg"><p>支持自定义背景</p><i></i></li>
					                    <li class="filter" data-filter="thumb"><p>带缩略图</p><i></i></li>
										<li class="filter" data-filter="filt"><p>半透明版块</p><i></i></li>
										<li class="filter" data-filter="bgs"><p>支持背景音乐</p><i></i></li>
					                    <li class="filter" data-filter="slip"><p>支持横向滑动</p><i></i></li>
					                  </ul>
					                  <h1>按行业选择:</h1>
					                  <ul class="filterBtn">
					                    <li class="filter" data-filter="mix"><p>常用模板</p><i></i></li>
					                    <li class="filter" data-filter="hotel"><p>酒店</p><i></i></li>
					                    <li class="filter" data-filter="car"><p>汽车</p><i></i></li>
					                    <li class="filter" data-filter="tour"><p>旅游</p><i></i></li>
										<li class="filter" data-filter="restaurant"><p>餐饮</p><i></i></li>
					                    <li class="filter" data-filter="estate"><p>房地产</p><i></i></li>
					                    <li class="filter" data-filter="health"><p>医疗保健</p><i></i></li>
										<li class="filter" data-filter="edu"><p>教育培训</p><i></i></li>
										<li class="filter" data-filter="beauty"><p>健身美容</p><i></i></li>
					                    <li class="filter" data-filter="wedding"><p>婚纱摄影</p><i></i></li>
					                    <li class="filter" data-filter="other"><p>其他行业</p><i></i></li>
					
					                  </ul>
					
					                </div>
									
									
									<div style="clear:both"></div>
									
									<ul class="cateradio g grid" id="grid">
										
										<volist id="tpl" name="tpl">
											<li class="mix {pigcms{$tpl.attr}<?php if($info['tpltypeid'] == $tpl['tpltypeid']){echo ' ck active';} ?>">
												<div class="mbtip">{pigcms{$tpl.tpldesinfo|default='暂无模板描述'}</div>
												<label>
													<img src="{pigcms{$config.site_url}/static/tmpls/images/loading.png" data-original="{pigcms{$config.site_url}/static/images/site/{pigcms{$tpl.tplview}">
													<input class="radio" type="radio"<if condition="$info['tpltypeid'] eq $tpl['tpltypeid']"> checked</if> name="optype" value="{pigcms{$tpl.tpltypeid}">
													模板{pigcms{$tpl.sort}
													</label>
											</li>
											
										</volist>
										<div style="clear:both"></div>
					                </ul>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<link href="/tpl/Merchant/static/css/style-1.css?id=103" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/tpl/Merchant/static/css/style_2_common.css?BPm">
<link rel="stylesheet" href="/static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="/static/kindeditor/plugins/code/prettify.css" />
<script src="/static/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="/static/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="/static/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>


<link href="/static/tmpls/css/style.css" rel="stylesheet" type="text/css" />
<link href="/static/tmpls/css/product.css" rel="stylesheet" type="text/css" />
<script src="/static/tmpls/js/jquery.tools.min.js" type="text/javascript"></script> 
<script src="/static/tmpls/js/jquery.mixitup.min.js" type="text/javascript"></script>
<script src="/static/tmpls/js/jquery.lazyload.min.js" type="text/javascript"></script>


<style>
    li .mbtip {
    display: none;
} 
.cateradio li:hover .mbtip {
    background-color: #000000;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 7px;
    box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.15);
    color: #FFFFFF;
    display: block;
    padding: 6px;
    float:right;
   /* position:relative;
    right:-140px;
    top:-325px;	*/
    width: 130px;
    text-align: left;
    z-index: 9999;
}

</style>

<script>
KindEditor.ready(function(K) {
	var editor = K.editor({
		allowFileManager : true
	});

	K('#image').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#img').val(),
				clickFn : function(url, title, width, height, border, align) {
					K('#img').val(url);
					var show_img = '<img src = "' + url + '" width="80" height="80" />';
					$('#show_img').html(show_img);
					editor.hideDialog();
				}
			});
		});
	});
});
$(function(){
	//列表hover效果
	$(".grid li").hover(function(){$(this).addClass("hover");},function(){$(this).removeClass("hover");});
	$(".prdInfo").click(function(){return false;});
	$('#grid').mixitup({layoutMode: 'grid'});
});

$(function(){
	$("img").lazyload();
});
$(".radio").click(function(){
	$(".cateradio li").each(function(){
		$(this).removeClass("active ck");
	});
	$(this).parents("li").addClass("active ck");
	var myurl='merchant.php?g=Merchant&c=Tmpls&a=add&style='+$(this).val()+'&r='+Math.random(); 
	$.ajax({url:myurl,async:false});
});
</script>
<include file="Public:footer"/>