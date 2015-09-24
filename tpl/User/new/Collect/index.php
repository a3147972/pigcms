<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$config.group_alias_name}收藏 | {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
<link href="{pigcms{$static_path}css/meal_order_list.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/category.js"></script>
<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
.category_list li:hover .bmbox {filter:alpha(opacity=50);}
.gd_box{display: none;}
</style>
<![endif]-->
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
</head>
<body id="settings" class="has-order-nav" style="position:static;">
<include file="Public:header_top"/>
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
		<article>
			<div class="menu cf">
				<div class="menu_left hide">
					<div class="menu_left_top"><img src="{pigcms{$static_path}images/o2o1_27.png" /></div>
					<div class="list">
						<ul>
							<volist name="all_category_list" id="vo" key="k">
								<li>
									<div class="li_top cf">
										<if condition="$vo['cat_pic']"><div class="icon"><img src="{pigcms{$vo.cat_pic}" /></div></if>
										<div class="li_txt"><a href="{pigcms{$vo.url}">{pigcms{$vo.cat_name}</a></div>
									</div>
									<if condition="$vo['cat_count'] gt 1">
										<div class="li_bottom">
											<volist name="vo['category_list']" id="voo" offset="0" length="3" key="j">
												<span><a href="{pigcms{$voo.url}">{pigcms{$voo.cat_name}</a></span>
											</volist>
										</div>
									</if>
								</li>
							</volist>
						</ul>
					</div>
				</div>
				<div class="menu_right cf">
					<div class="menu_right_top">
						<ul>
							<pigcms:slider cat_key="web_slider" limit="10" var_name="web_index_slider">
								<li class="ctur">
									<a href="{pigcms{$vo.url}">{pigcms{$vo.name}</a>
								</li>
							</pigcms:slider>
						</ul>
					</div>
				</div>
			</div>
		</article>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/table-section.v538886b7.css" />
				<include file="Public:sidebar"/>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<ul class="filter cf">
							<li class="current"><a href="{pigcms{:U('Collect/index')}">{pigcms{$config.group_alias_name}收藏</a></li>
							<li><a href="{pigcms{:U('Collect/meal')}">{pigcms{$config.meal_alias_name}收藏</a></li>
						</ul>
						<if condition="$group_list">
							<div class="table-section">
								<table id="collection-list" cellspacing="0" cellpadding="0" border="0">
									<tbody>
										<tr>
											<th width="auto" class="item-info">{pigcms{$config.group_alias_name}项目</th>
											<th width="60">金额</th>
											<th width="60">状态</th>
											<th width="112">操作</th>
										</tr>
										<volist name="group_list" id="vo">
											<tr class="alt">
												<td class="deal">
													<table class="deal-info">
														<tr>
															<td class="pic">
																<a href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.s_name}"><img src="{pigcms{$vo.list_pic}" width="75" height="46"></a>
															</td>
															<td class="text">
																<a class="deal-title" href="{pigcms{$vo.url}" title="{pigcms{$vo.s_name}" target="_blank">{pigcms{$vo.s_name}</a>
															</td>
														</tr>
													</table>
												</td>
												<td><span class="money">¥</span>{pigcms{$vo.price}</td>
												<td>进行中</td>
												<td class="op"><a class="btn btn-mini" href="{pigcms{$vo.url}" target="_blank">购买</a><a class="inline-link remove-collection" href="javascript:void(0);" fav-id="{pigcms{$vo.group_id}">删除</a></td>
											</tr>
										</volist>
									</tbody>
								</table>
							</div>
						<else/>
							<div class="notice">您还没有收藏过呢，在{pigcms{$config.group_alias_name}详情页直接收藏啦，手机版也可以的！</div>
						</if>
						{pigcms{$pagebar}
					</div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>	
	<include file="Public:footer"/>
	<script>
		$(function(){
			$('.remove-collection').click(function(){
				var now_dom = $(this);
				if(confirm('确定删除该收藏？')){
					$.post("{pigcms{:U('Index/Collect/collect')}",{action:'del',type:'group_detail',id:$(this).attr('fav-id')},function(result){
						if(result.status == '1'){
							now_dom.closest('tr.alt').remove();
						}
					});
				}
			});
		});
	</script>
</body>
</html>
