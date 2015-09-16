<include file="Public:header"/>
	<form id="myform" method="post" frame="true" refresh="true">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<volist name="fans_list" id="vo">
				<tr>
					<th width="80">{pigcms{$vo.nickname}</th>
					<td><img src="{pigcms{$vo.avatar}" style="width:70px;"/></td>
				</tr>
			</volist>
		</table>
	</form>
<include file="Public:footer"/>