<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Tmpls/index')}">微网站</a>
			</li>
			<li class="active">底部菜单风格选择</li>
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
							<li>
								<a href="{pigcms{:U('Catemenu/index')}">底部菜单分类设置</a>
							</li>
							<li class="active">
								<a href="{pigcms{:U('Catemenu/styleSet')}">底部菜单风格选择</a>
							</li>
							<li>
								<a href="{pigcms{:U('Catemenu/plugmenu')}">菜单颜色与版权</a>
							</li>
							<li>
								<a href="{pigcms{:U('Catemenu/music')}">背景音乐设置</a>
							</li>
						</ul>
					
						<div class="tab-content">
							<div class="tab-pane active">
					            <fieldset>
									<div style="clear:both"></div>
									
									<ul class="cateradio g grid" id="grid">
										
					                     <li <if condition="$radiogroup eq 0"> class="active" </if> >
					                        <label><img src="/static/images/catemenu-style/000.png">
					                          <input class="radio" type="radio" name="radiogroup" value="0" id="radiogroup_0" <if condition="$radiogroup eq 0"> checked </if>>
					                          关闭底部导航</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 1"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/001.png">
					                          <input class="radio" type="radio" name="radiogroup" value="1" id="radiogroup_1" <if condition="$radiogroup eq 1"> checked </if>>
					                          1.左侧展开</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 2"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/002.png">
					                          <input class="radio" type="radio" name="radiogroup" value="2" id="radiogroup_2" <if condition="$radiogroup eq 2"> checked </if>>
					                          2.右侧展开</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 3"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/003.png">
					                          <input class="radio" type="radio" name="radiogroup" value="3" id="radiogroup_3" <if condition="$radiogroup eq 3"> checked </if>>
					                          3.左侧滑入</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 4"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/004.png">
					                          <input class="radio" type="radio" name="radiogroup" value="4" id="radiogroup_4" <if condition="$radiogroup eq 4"> checked </if>>
					                          4.右侧滑入</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 5"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/005.png">
					                          <input class="radio" type="radio" name="radiogroup" value="5" id="radiogroup_5" <if condition="$radiogroup eq 5"> checked </if>>
					                          5.左侧底部滑入</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 6"> class="active" </if>> 
					                        <label><img src="/static/images/catemenu-style/006.png">
					                          <input class="radio" type="radio" name="radiogroup" value="6" id="radiogroup_6" <if condition="$radiogroup eq 6"> checked </if>>
					                          6.右侧底部滑入</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 7"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/007.png">
					                          <input class="radio" type="radio" name="radiogroup" value="7" id="radiogroup_7" <if condition="$radiogroup eq 7"> checked </if>>
					                          7</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 8"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/008.png">
					                          <input class="radio" type="radio" name="radiogroup" value="8" id="radiogroup_8" <if condition="$radiogroup eq 8"> checked </if>>
					                          8</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 9"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/009.png">
					                          <input class="radio" type="radio" name="radiogroup" value="9" id="radiogroup_9" <if condition="$radiogroup eq 9"> checked </if>>
					                          9</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 10"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/010.png">
					                          <input class="radio" type="radio" name="radiogroup" value="10" id="radiogroup_10" <if condition="$radiogroup eq 10"> checked </if>>
					                          10</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 11"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/011.png">
					                          <input class="radio" type="radio" name="radiogroup" value="11" id="radiogroup_11" <if condition="$radiogroup eq 11"> checked </if>>
					                          11</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 12"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/012.png">
					                          <input class="radio" type="radio" name="radiogroup" value="12" id="radiogroup_12" <if condition="$radiogroup eq 12"> checked </if>>
					                          12</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 13"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/013.png">
					                          <input class="radio" type="radio" name="radiogroup" value="13" id="radiogroup_13" <if condition="$radiogroup eq 13"> checked </if>>
					                          13</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 14"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/014.png">
					                          <input class="radio" type="radio" name="radiogroup" value="14" id="radiogroup_14" <if condition="$radiogroup eq 14"> checked </if>>
					                          14</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 15"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/015.png">
					                          <input class="radio" type="radio" name="radiogroup" value="15" id="radiogroup_15" <if condition="$radiogroup eq 15"> checked </if>>
					                          15</label>
					                      </li>
					                      <li <if condition="$radiogroup eq 16"> class="active" </if>>
					                        <label><img src="/static/images/catemenu-style/016.png">
					                          <input class="radio" type="radio" name="radiogroup" value="16" id="radiogroup_16" <if condition="$radiogroup eq 16"> checked </if>>
					                          16</label>
					                      </li>
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
    z-index: 999;
}

</style>


<script>
$(document).ready(function(){
	$(".radio").click(function(){
		var radiostyle = $(this).val();
		$(".cateradio li").each(function(){
			$(this).removeClass("active");
		});
		$(this).parents("li").addClass("active");
		$.ajax({
			type:"get",
			url:"merchant.php?g=Merchant&c=Catemenu&a=styleChange&radiogroup="+radiostyle,
			dataType:"json",
		});
	});
});
</script>
<include file="Public:footer"/>