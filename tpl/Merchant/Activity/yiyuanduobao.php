<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
		<title>{pigcms{$config.site_name} - 一元夺宝详情页</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/group_edit.css"/>
	</head>
	<body>
		<table>
			<tr>
				<th width="15%">中奖号码</th>
				<td width="35%">{pigcms{$now_activity.lottery_number}</td>
				<th width="15%">中奖时间</th>
				<td width="35%">{pigcms{$now_activity.finish_time|date='Y-m-d H:i:s',###}</td>
			</tr>
				<tr>
					<td colspan="4" style="padding-left:5px;color:black;"><b>用户信息：</b></td>
				</tr>
				<tr>
					<th width="15%">用户ID</th>
					<td width="35%">{pigcms{$now_user.uid}</td>
					<th width="15%">用户名</th>
					<td width="35%">{pigcms{$now_user.nickname}</td>
				</tr>
				<tr>
					<th width="15%">联系电话</th>
					<td width="35%">{pigcms{$now_user.phone}</td>
					<th width="15%">&nbsp;</th>
					<td width="35%">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" style="padding-left:5px;color:black;"><b>配送信息：</b></td>
				</tr>
				<if condition="$now_user_adress">
					<tr>
						<th width="15%">收货人</th>
						<td width="35%">{pigcms{$now_user_adress.name}</td>
						<th width="15%">联系电话</th>
						<td width="35%">{pigcms{$now_user_adress.phone}</td>
					</tr>
					<tr>
						<th width="15%">邮编</th>
						<td width="85%" colspan="3">{pigcms{$now_user_adress.zipcode}</td>
					</tr>
					<tr>
						<th width="15%">收货地址</th>
						<td width="85%" colspan="3">{pigcms{$now_user_adress.province_txt}&nbsp;{pigcms{$now_user_adress.city_txt}&nbsp;{pigcms{$now_user_adress.area_txt}&nbsp;{pigcms{$now_user_adress.adress}</td>
					</tr>
				<else/>
					<tr>
						<td width="100%" colspan="4">请联系该用户添加收货地址</td>
					</tr>
				</if>
		</table>
		<script type="text/javascript">
			$(function(){
				$('#merchant_remark_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("{pigcms{:U('Group/group_remark',array('order_id'=>$now_order['order_id']))}",{merchant_remark:$('#merchant_remark').val()},function(result){
						$('#merchant_remark_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});
				$('#store_id_btn').click(function(){
					$(this).html('提交中...').prop('disabled',true);
					$.post("{pigcms{:U('Group/order_store_id',array('order_id'=>$now_order['order_id']))}",{store_id:$('#order_store_id').val()},function(result){
						$('#store_id_btn').html('修改').prop('disabled',false);
						alert(result.info);
					});
				});
			});
		</script>
	</body>
</html>