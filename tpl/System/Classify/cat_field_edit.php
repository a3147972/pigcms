<include file="Public:header"/>
	<div id="nav" class="mainnav_title">
		<ul>
			<a href="javascript:;" class="on">自定义字段</a>|
		</ul>
	</div>
	<form id="myform" method="post" action="{pigcms{:U('Classify/cat_field_modify')}" frame="true" refresh="true">
		<input type="hidden" name="cid" value="{pigcms{$cid}"/>
		<input type="hidden" name="numfilter" value="{pigcms{$isfilter}"/>
		<input type="hidden" name="fkey" value="{pigcms{$fkey}"/>
		<if condition="!isset($thiscat_field['use_field'])">
			<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
				<tr>
					<th width="80">字段名称</th>
					<td><input type="text" class="input fl" name="name" id="name" size="25" value="{pigcms{$thiscat_field['name']}" placeholder="" validate="maxlength:20,required:true" tips=""/></td>
				</tr>
				<tr>
					<th width="80">短标记(url)</th>
					<td><input type="text" class="input fl" name="url" id="url" size="25" value="{pigcms{$thiscat_field['url']}" placeholder="英文或数字" validate="maxlength:20,required:true,en_num:true" tips="只能使用英文或数字，用于网址（url）中的标记！建议使用字段的拼音"/></td>
				</tr>
				<tr>
					<th width="80">是否必填</th>
					<td>
						<span class="cb-enable"><label class="cb-enable  <php>if($thiscat_field['iswrite']==1) echo 'selected';</php>"><span>是</span><input type="radio" name="iswrite" value="1" <php>if($thiscat_field['iswrite']==1) echo 'checked="checked"';</php> /></label></span>
						<span class="cb-disable"><label class="cb-disable <php>if($thiscat_field['iswrite']!=1) echo 'selected';</php>"><span>否</span><input type="radio" name="iswrite" value="0" <php>if($thiscat_field['iswrite']!=1) echo 'checked="checked"';</php> /></label></span>
						<span style="margin-left: 30px;color: red">客户发布信息时决定此字段客户是否必须填写</span>
					</td>
				</tr>
				<tr>
					<th width="80">字段类型</th>
					<td>
						<select name="type" onchange="ShowTextarea(this.value);">
						   <if condition="!empty($inputTypeArr)">
								<volist name="inputTypeArr" id="vo">
								<option value="{pigcms{$vo['typ']}" <php>if($thiscat_field['type']==$vo['typ']) echo 'selected="selected"';</php>>{pigcms{$vo['tname']}</option>
								</volist>
							</if>
						</select>
					<span style="margin-left:10px; <php>if($thiscat_field['type']!=1) echo 'display:none;'</php>" id="input_arr">属性：
						<select name="inarr" onchange="if(this.value==1){$('#input_unit').show();}else{$('#input_unit').hide();}">
						    <option value="0" <php>if($thiscat_field['inarr']!=1) echo 'selected="selected"';</php>>无</option>
							<option value="1" <php>if($thiscat_field['inarr']==1) echo 'selected="selected"';</php>>只填写数字</option>
						</select>&nbsp;&nbsp;
	   <select name="inunit" <php>if($thiscat_field['inarr']!=1) echo 'style="display:none"';</php> id="input_unit">
			<option value="">请选择单位</option>
			<option value="g" <php>if($thiscat_field['inunit']=='g') echo 'selected="selected"';</php>>g</option>
			<option value="kg" <php>if($thiscat_field['inunit']=='kg') echo 'selected="selected"';</php>>kg</option>
			<option value="m" <php>if($thiscat_field['inunit']=='m') echo 'selected="selected"';</php>>m</option>
			<option value="km" <php>if($thiscat_field['inunit']=='km') echo 'selected="selected"';</php>>km</option>
			<option value="元" <php>if($thiscat_field['inunit']=='元') echo 'selected="selected"';</php>>元</option>
			<option value="元/日" <php>if($thiscat_field['inunit']=='元/日') echo 'selected="selected"';</php>>元/日</option>
			<option value="元/月" <php>if($thiscat_field['inunit']=='元/月') echo 'selected="selected"';</php>>元/月</option>
			<option value="元/年" <php>if($thiscat_field['inunit']=='元/年') echo 'selected="selected"';</php>>元/年</option>
			<option value="万" <php>if($thiscat_field['inunit']=='万') echo 'selected="selected"';</php>>万</option>
			<option value="万元" <php>if($thiscat_field['inunit']=='万元') echo 'selected="selected"';</php>>万元</option>
			<option value="份" <php>if($thiscat_field['inunit']=='份') echo 'selected="selected"';</php>>份</option>
			<option value="件" <php>if($thiscat_field['inunit']=='件') echo 'selected="selected"';</php>>件</option>
			<option value="套" <php>if($thiscat_field['inunit']=='套') echo 'selected="selected"';</php>>套</option>
			<option value="㎡" <php>if($thiscat_field['inunit']=='㎡') echo 'selected="selected"';</php>>㎡</option>
			<option value="元/㎡" <php>if($thiscat_field['inunit']=='元/㎡') echo 'selected="selected"';</php>>元/㎡</option>
		</select>
					</span>
					</td>

				</tr>
			  <tr id="valueoftype" <php>if($thiscat_field['type']==1 || $thiscat_field['type']==5) echo 'style="display:none;"'</php>>
				  <th width="80">供选择值</th>
				  <td><textarea class="input fl" style="width:250px;height:80px;" name="valueoftype" placeholder ="必须写上这个字段类型供发布者选择的值一行算一个值">{pigcms{$optstr}</textarea></td>
			   </tr>
				<if condition="$thiscat_field['isfilter'] eq 1">
				<tr>
					<th width="80">是否作为筛选</th>
					<td id="changonoff">
						<span class="cb-enable"><label class="cb-enable selected"><span>是</span><input type="radio" name="isfilter" value="1" checked="checked"/></label></span>
						<span style="margin-left: 35px;color: red">最多只能设置4个字段且设置后不可修改</span>
					</td>
				</tr>
				<tr id="myonoffShow" <php>if(empty($textstr)) echo 'style="display:none;"';</php>>
				  <th width="80">作为筛选字段筛选值</th>
				  <td><textarea class="input fl" style="width:250px;height:80px;" name="filtercon" placeholder ="即这个字段的可能筛选条件一行算一个筛选条件">{pigcms{$textstr}</textarea><span class="red">(前台支持：字段类型为单文本框且属性为只填写数字情况下 这里可以写xxx-xxxx这样数字区间格式)</span></td>
			   </tr>
			   <else/>
			    <php>if($isfilter <= 4){
					echo  '<th width="80">是否作为筛选</th><td id="changonoff"><span class="cb-enable"><label class="cb-enable"><span>是</span><input type="radio" name="isfilter" value="1" checked="checked"/></label></span><span class="cb-disable"><label class="cb-disable selected"><span>否</span><input type="radio" name="isfilter" value="0" checked="checked"/></label></span><span style="margin-left: 35px;color: red">最多只能设置4个字段且设置后不可修改</span></td></tr>	<tr id="myonoffShow" style="display:none;">
				    <th width="80">作为筛选字段筛选值</th>
				    <td><textarea class="input fl" style="width:250px;height:80px;" name="filtercon" placeholder ="即这个字段的可能筛选条件一行算一个筛选条件"></textarea><span class="red">(前台支持：字段类型为单文本框且属性为只填写数字情况下 这里可以写xxx-xxxx这样数字区间格式)</span></td></tr>';
					}else{
					  echo '<tr><th width="80">是否作为筛选</th><td id="changonoff"><span class="cb-disable"><label class="cb-disable selected"><span>否</span><input type="radio" name="isfilter" value="0" checked="checked" /></label></span><span style="margin-left: 35px;color: red">最多只能设置4个字段(你已经添加4个了)</span></td></tr>';
					}
				</php>

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
					<th width="80">是否必填</th>
					<td>
						<span class="cb-enable"><label class="cb-enable  <php>if($thiscat_field['iswrite']==1) echo 'selected';</php>"><span>是</span><input type="radio" name="iswrite" value="1" <php>if($thiscat_field['iswrite']==1) echo 'checked="checked"';</php> /></label></span>
						<span class="cb-disable"><label class="cb-disable <php>if($thiscat_field['iswrite']!=1) echo 'selected';</php>"><span>否</span><input type="radio" name="iswrite" value="0" <php>if($thiscat_field['iswrite']!=1) echo 'checked="checked"';</php> /></label></span>
						<span style="margin-left: 30px;color: red">客户发布信息时决定此字段客户是否必须填写</span>
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