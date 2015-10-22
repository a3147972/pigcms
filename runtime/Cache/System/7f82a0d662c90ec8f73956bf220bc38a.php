<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={:C('DEFAULT_CHARSET')}" />
		<title>网站后台管理 Powered by weiwino2o</title>
		<script type="text/javascript">
			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}
			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;
 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>
	</head>
	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="<?php echo U('Merchant/index');?>" class="on">商户列表</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/add');?>','添加商户',600,400,true,false,false,addbtn,'add',true);">添加商户</a>
				</ul>
			</div>
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="<?php echo U('Merchant/index');?>" method="get">
							<input type="hidden" name="c" value="Merchant"/>
							<input type="hidden" name="a" value="index"/>
							筛选: <input type="text" name="keyword" class="input-text" value="<?php echo ($_GET['keyword']); ?>"/>
							<select name="searchtype">
								<option value="name" <?php if($_GET['searchtype'] == 'name'): ?>selected="selected"<?php endif; ?>>商户名称</option>
								<option value="account" <?php if($_GET['searchtype'] == 'account'): ?>selected="selected"<?php endif; ?>>商户帐号</option>
								<option value="phone" <?php if($_GET['searchtype'] == 'phone'): ?>selected="selected"<?php endif; ?>>联系电话</option>
								<option value="mer_id" <?php if($_GET['searchtype'] == 'mer_id'): ?>selected="selected"<?php endif; ?>>商家编号</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table cellspacing="0">
						<thead>
							<tr>
								<th>编号</th>
								<th>商户帐号</th>
								<th>商户名称</th>
								<th>商户余额</th>
								<th>联系电话</th>
								<th>最后登录时间</th>
								<th>访问该商户后台</th>
								<th>微官网点击数</th>
								<th>状态</th>
									<?php if($config['is_open_oauth']): ?><th>公众号网页授权状态</th><?php endif; ?>
								<th>商家账单</th>
								<th>微店账单</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($merchant_list)): if(is_array($merchant_list)): $i = 0; $__LIST__ = $merchant_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["mer_id"]); ?></td>
										<td><?php echo ($vo["account"]); ?></td>
										<td><?php echo ($vo["name"]); ?></td>
										<td><?php echo ($vo["balance"]); ?></td>
										<td><?php echo ($vo["phone"]); ?></td>
										<td><?php if($vo['last_time']): echo (date('Y-m-d H:i:s',$vo["last_time"])); else: ?>无<?php endif; ?></td>
										<td class="textcenter"><?php if($vo['status'] == 1): ?><a href="<?php echo U('Merchant/merchant_login',array('mer_id'=>$vo['mer_id']));?>" class="__full_screen_link" target="_blank">访问</a><?php else: ?><a href="javascript:alert('商户状态不正常，无法访问！请先修改商户状态。');" class="__full_screen_link">访问</a><?php endif; ?></td>
										<td class="textcenter"><?php echo ($vo["hits"]); ?></td>
										<td><?php if($vo['status'] == 1): ?><font color="green">启用</font><?php elseif($vo['status'] == 2): ?><font color="red">待审核</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td>
										<?php if($config['is_open_oauth']): ?><td><?php if($vo['is_open_oauth'] == 1): ?><font color="green">启用</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td><?php endif; ?>
										<td class="textcenter"><a href="<?php echo U('Merchant/order',array('mer_id'=>$vo['mer_id']));?>">查看账单</a></td>
										<td class="textcenter"><a href="<?php echo U('Merchant/weidian_order',array('mer_id'=>$vo['mer_id']));?>">微店账单</a></td>
										<td class="textcenter">
										<a href="<?php echo U('Merchant/store',array('mer_id'=>$vo['mer_id']));?>">店铺列表</a> |
										<a href="javascript:void(0);" onclick="window.top.show_other_frame('Group','product','mer_id=<?php echo ($vo["mer_id"]); ?>')"><?php echo ($config["group_alias_name"]); ?>列表</a> |
										<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/edit',array('mer_id'=>$vo['mer_id'],'frame_show'=>true));?>','查看详细信息',520,370,true,false,false,false,'detail',true);">查看</a> |
										<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/edit',array('mer_id'=>$vo['mer_id']));?>','编辑商户信息',600,450,true,false,false,editbtn,'edit',true);">编辑</a> |
										<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Merchant/menu',array('mer_id'=>$vo['mer_id']));?>','设置商家使用权限',700,500,true,false,false,editbtn,'edit',true);">设置商家使用权限</a> |
										<a href="javascript:void(0);" class="delete_row" parameter="mer_id=<?php echo ($vo["mer_id"]); ?>" url="<?php echo U('Merchant/del');?>">删除</a>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<tr><td class="textcenter pagebar" colspan="12"><?php echo ($pagebar); ?></td></tr>
							<?php else: ?>
								<tr><td class="textcenter red" colspan="12">列表为空！</td></tr><?php endif; ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</body>
</html>