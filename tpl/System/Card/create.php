<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="javascript:void(0);" class="on" onclick="window.top.artiframe('{pigcms{:U('Card/create_add', array('id' => $thisCard['id']))}','创建会员卡号',560,350,true,false,false,addbtn,'add',true);">创建会员卡号</a>|
					<a href="javascript:void(0);" onclick="if(confirm('确定删除吗')){$('#info').submit()}">删除</a>
				</ul>
			</div>
			<form method="post" action="" id="info">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col> <col><col><col><col> <col width="140" align="center"> </colgroup>
						<thead>
								<tr>
									<th width="50"><input type="checkbox" id="check_box"></th>
									<th width="100">会员卡号 </th>
									<th width="100">状态</th>
									<th width="100">会员资料</th>
								</tr>
						</thead>
						<tbody>
							<if condition="$data_vip">
									<volist name="data_vip" id="data_vip">
										<tr >
											<td><input type="checkbox" value="{pigcms{$data_vip.id}" class="cbitem" name="id_{pigcms{$i}"></td>
											<td>{pigcms{$data_vip.number}</td>
											<td><if condition="$data_vip['wecha_id'] eq false">空闲卡<else/><strong>使用中</strong></if></td>
											<td><a href="admin.php?g=System&c=Card&a=members&itemid={pigcms{$data_vip.id}&id={pigcms{$thisCard.id}">查看详情</a></td>
										</tr>
									</volist>
								<else/>
									<tr><td class="button-column" colspan="4" >无内容</td></tr>
								</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>


<script type="text/javascript">
$(function(){
	$("#check_box").click(function(){
		if ($(this).attr('checked')){
			$(".cbitem").attr('checked', true);
		} else {
			$(".cbitem").attr('checked', false);
		}
	});
});
function drop_confirm(msg, url)
{
	if (confirm(msg)) {
		window.location.href = url;
	}
}
</script>
<include file="Public:footer"/>