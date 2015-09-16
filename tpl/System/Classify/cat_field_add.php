<include file="Public:header"/>
	<div id="nav" class="mainnav_title">
		<ul>
			<a href="{pigcms{:U('Classify/cat_field_add',array('cid'=>$_GET['cid'],'type'=>'0'))}" <if condition="$_GET['type'] eq 0">class="on"</if>>自定义字段</a>|
			<a href="{pigcms{:U('Classify/cat_field_add',array('cid'=>$_GET['cid'],'type'=>'1'))}" <if condition="$_GET['type'] eq 1">class="on"</if>>选择内置字段</a>
		</ul>
	</div>
	<form id="myform" method="post" action="{pigcms{:U('Classify/cat_field_modify')}" frame="true" refresh="true">
		<input type="hidden" name="cid" value="{pigcms{$_GET.cid}"/>
		<input type="hidden" name="numfilter" value="{pigcms{$isfilter}"/>
		<if condition="$_GET['type'] eq 0">
			<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
				<tr>
					<th width="80">字段名称</th>
					<td><input type="text" class="input fl" name="name" id="name" size="25" placeholder="" validate="maxlength:20,required:true" tips=""/></td>
				</tr>
				<tr>
					<th width="80">短标记(url)</th>
					<td><input type="text" class="input fl" name="url" id="url" size="25" placeholder="英文或数字" validate="maxlength:20,required:true,en_num:true" tips="只能使用英文或数字，用于网址（url）中的标记！建议使用字段的拼音"/></td>
				</tr>
				<tr>
					<th width="80">是否必填</th>
					<td>
						<span class="cb-enable"><label class="cb-enable"><span>是</span><input type="radio" name="iswrite" value="1"/></label></span>
						<span class="cb-disable"><label class="cb-disable selected"><span>否</span><input type="radio" name="iswrite" value="0" checked="checked"/></label></span>
						<span style="margin-left: 30px;color: red">客户发布信息时决定此字段客户是否必须填写</span>
					</td>
				</tr>
				<tr>
					<th width="80">字段类型</th>
					<td>
						<select name="type" onchange="ShowTextarea(this.value);">
						   <if condition="!empty($inputTypeArr)">
								<volist name="inputTypeArr" id="vo">
								<option value="{pigcms{$vo['typ']}">{pigcms{$vo['tname']}</option>
								</volist>
							</if>
						</select>
					<span style="margin-left:10px;" id="input_arr">属性：
						<select name="inarr" onchange="if(this.value==1){$('#input_unit').show();}else{$('#input_unit').hide();}">
						    <option value="0">无</option>
							<option value="1">只填写数字</option>
						</select>
					   <select name="inunit" style="display:none" id="input_unit">
					        <option value="">请选择单位</option>
							<option value="g">g</option>
							<option value="kg">kg</option>
							<option value="m">m</option>
							<option value="km">km</option>
							<option value="元">元</option>
							<option value="元/日">元/日</option>
							<option value="元/月">元/月</option>
							<option value="元/年">元/年</option>
							<option value="万">万</option>
							<option value="万元">万元</option>
							<option value="份">份</option>
							<option value="件">件</option>
							<option value="套">套</option>
							<option value="㎡">㎡</option>
							<option value="元/㎡">元/㎡</option>
						</select>
					</span>
					</td>

				</tr>
			  <tr id="valueoftype" style="display:none;">
				  <th width="80">供选择值</th>
				  <td><textarea class="input fl" style="width:250px;height:80px;" name="valueoftype" placeholder ="必须写上这个字段类型供发布者选择的值一行算一个值"></textarea></td>
			   </tr>
				<if condition="$isfilter lt 4">
				<tr>
					<th width="80">是否作为筛选</th>
					<td id="changonoff">
						<span class="cb-enable"><label class="cb-enable"><span>是</span><input type="radio" name="isfilter" value="1"/></label></span>
						<span class="cb-disable"><label class="cb-disable selected"><span>否</span><input type="radio" name="isfilter" value="0" checked="checked"/></label></span>
						<span style="margin-left: 35px;color: red">最多只能设置4个字段且设置后不可修改</span>
					</td>
				</tr>
				<tr id="myonoffShow" style="display:none;">
				  <th width="80">作为筛选字段筛选值</th>
				  <td><textarea class="input fl" style="width:250px;height:80px;" name="filtercon" placeholder ="即这个字段的可能筛选条件一行算一个筛选条件"></textarea><span class="red">(前台支持：字段类型为单文本框且属性为只填写数字情况下 这里可以写xxx-xxxx这样数字区间格式)</span></td>
			   </tr>
			   <else/>
				<tr>
				<th width="80">是否作为筛选</th>
				<td id="changonoff">
					<span class="cb-disable"><label class="cb-disable selected"><span>否</span><input type="radio" name="isfilter" value="0" checked="checked" /></label></span>
					<span style="margin-left: 35px;color: red">最多只能设置4个字段(你已经添加4个了)</span>
				</td>
			   </tr>
			   </if>
			</table>
		<else/>
			<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
				<tr>
					<th width="80">选择字段</th>
					<td>
						<select name="use_field">
							<option value="area">地区商圈</option>
							<!--option value="price">价格</option-->
						</select>
					</td>
				</tr>
				<tr>
					<th width="80">字段排序</th>
					<td><input type="text" class="input fl" name="sort" value="0" size="10" placeholder="分类排序" validate="maxlength:6,required:true,number:true" tips="默认添加时间排序！手动排序数值越大，排序越前。"/></td>
				</tr>
				<tr>
					<th width="80">字段状态</th>
					<td>
						<span class="cb-enable"><label class="cb-enable selected"><span>显示</span><input type="radio" name="status" value="1" checked="checked" /></label></span>
						<span class="cb-disable"><label class="cb-disable"><span>隐藏</span><input type="radio" name="status" value="0" /></label></span>
					</td>
				</tr>
			</table>
		</if>
		<div class="btn hidden">
			<input type="submit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<script type="text/javascript">
      $('#changonoff input[name="isfilter"]').click(function(){
			var vv=parseInt($(this).val());
			if(vv==1){
			  $('#myonoffShow').show();
			}else{
			   $('#myonoffShow').hide();
			 }
	    });

	function ShowTextarea(vv){
	  vv=parseInt(vv);
	  if(vv==2 || vv==3 || vv==4){
	     $('#valueoftype').show();
	  }else{
	     $('#valueoftype').hide();
	  }
	  if(vv==1){
	    $('#input_arr').show();
	  }else{
	    $('#input_arr').hide();
	  }
	}
	</script>
<include file="Public:footer"/>