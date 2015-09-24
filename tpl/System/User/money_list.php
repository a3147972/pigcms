<include file="Public:header"/>
<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
	<tr>
		<th width="180">时间</th>
		<th>详情</th>
		<th>金额（元）</th>
	</tr>
	<volist name="money_list" id="vo">
		<tr>
			<th width="180">{pigcms{$vo.time|date='Y-m-d H:i:s',###}</th>
			<th>{pigcms{$vo['desc']}</th>
			<th><if condition="$vo['type'] eq 1"><font color="#2bb8aa">+{pigcms{$vo.money}</font><else/><font color="#f76120">-{pigcms{$vo.money}</font></if></th>
		</tr>
	</volist>
	<tr><td class="textcenter pagebar" colspan="3" style="border-bottom:1px solid #ccc;">{pigcms{$pagebar}</td></tr>
</table>
<include file="Public:footer"/>