<include file="Public:header"/>
	<style>
		.frame_form td{line-height:24px;}
	</style>
	<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
		<tr>
			<tr>
				<th width="15%">评论编号</th>
				<td width="35%">{pigcms{$reply_detail.pigcms_id}</td>
				<th width="15%">订单编号</th>
				<td width="35%"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Group/order_edit',array('order_id'=>$reply_detail['order_id']))}','查看订单详情',600,460,true,false,false,false,'order_edit',true);">{pigcms{$reply_detail.order_id}</a></td>
			</tr>
		</tr>
		<tr>
			<tr>
				<th width="15%">用户ID</th>
				<td width="35%">{pigcms{$reply_detail.uid}</td>
				<th width="15%">查看用户</th>
				<td width="35%"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/edit',array('uid'=>$reply_detail['uid']))}','查看用户信息',680,560,true,false,false,editbtn,'see_user',true);">查看用户信息</a></td>
			</tr>
		</tr>
		<tr>
			<tr>
				<th width="15%">评论打分</th>
				<td width="35%">{pigcms{$reply_detail.score}</td>
				<th width="15%">评论时间</th>
				<td width="35%">{pigcms{$reply_detail.add_time|date='Y-m-d H:i:s',###}</td>
			</tr>
		</tr>
		<tr>
			<th width="15%">评论内容：</b></th>
			<td colspan="3">{pigcms{$reply_detail.comment}</td>
		</tr>
		<if condition="$image_list">
			<tr>
				<th width="15%">评论图片：</b></th>
				<td colspan="3">
					<volist name="image_list" id="vo"><a href="{pigcms{$vo.image}" target="_blank"><img src="{pigcms{$vo.s_image}" alt="评论图片" style="width:50px;"/></a>&nbsp;&nbsp;</volist>
				</td>
			</tr>
		</if>
		<tr>
			<td colspan="4" style="padding-left:5px;color:black;"><b>商家回复：</b></td>
		</tr>
		<if condition="$reply_detail['merchant_reply_time']">
			<tr>
				<th width="15%">回复时间：</b></th>
				<td colspan="3">{pigcms{$reply_detail.merchant_reply_time|date='Y-m-d H:i:s',###}</td>
			</tr>
			<tr>
				<th width="15%">回复内容：</b></th>
				<td colspan="3">{pigcms{$reply_detail.merchant_reply_content}</td>
			</tr>
		<else/>
			<tr>
				<td colspan="4">未回复</td>
			</tr>
		</if>
	</table>
	<div class="btn hidden">
		<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
		<input type="reset" value="取消" class="button" />
	</div>
<include file="Public:footer"/>