<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Classify/attrSeting')}" frame="true" refresh="true">
		<input type="hidden" name="vid" value="{pigcms{$vid}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td>置顶设置：</td>
				<td><if condition="!empty($item) AND $item['endtoptime'] gt 0">
				  <if condition="$item['endtoptime'] gt $currenttime">
				  您已经置顶了这条消息！
				  <else/>
				  您上次设置的置顶到期时间是：{pigcms{$item['endtoptime']|date='Y-m-d H:i:s',###}，请重新确认置顶！
				  </if>
				<else/>您尚未置顶这条消息！</if></td>
			</tr>
			<tr>
				<th width="90">设置置顶时间</th>
				<td><span>置顶到 <input type="text" class="input" name="toptime" id="toptime" value="{pigcms{$datetime}" placeholder="" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})" validate="required:true" tips=""/> 结束</span></td>
			</tr>
		<tr>
			<th width="90">排序顺序</th>
			<td><span><input type="text" class="input" name="topsort" id="topsort" value="{pigcms{$item['topsort']}" style="width: 60px;"/></span>&nbsp;&nbsp;&nbsp;<span class="red">数值越大越靠前<span></td>
		</tr>
		</table>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td width="100">标题颜色设置：</td>
				<td>
				<input type="text" class="input fl" name="bt_color" id="choose_color" <if condition="!empty($item['btcolor'])">style="width:120px;background-color:{pigcms{$item['btcolor']}" <else/>style="width:120px;" </if> value="{pigcms{$item['btcolor']}" placeholder="可不填写" tips="请点击右侧按钮选择颜色，用途为如果图片尺寸小于屏幕时，会被背景颜色扩充，主要为首页使用。">
				<a href="javascript:void(0);" id="choose_color_box" style="line-height:28px;">点击选择颜色</a>
				</td>
			</tr>
		</table>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<td width="100">跳转链接设置：</td>
				<td>
				<input type="text" class="input fl" name="jumpUrl" id="jumpUrl" value="{pigcms{$item['jumpUrl']}" style="width:220px" onBlur="TextSEO(this.value)" placeholder="请填写一个完整的URL" tips="当填上URL后,点击前台展示列表里此项将跳转到您填写的链接地址">
				<p class="red">当填上URL(以http://形式开头的地址)后,点击前台展示列表里此项将跳转到您填写的链接地址,正常情况下请留空</p>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>
<script type="text/javascript">
function TextSEO(vv){
   vv=$.trim(vv);
   var pattern = /^https?:\/\//i;
   if(vv && !(pattern.test(vv))){
	   alert('URL地址格式不正确！');
   }
}
</script>