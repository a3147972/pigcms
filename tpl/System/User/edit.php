<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('User/amend')}" frame="true" refresh="true">
		<input type="hidden" name="uid" value="{pigcms{$now_user.uid}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="15%">ID</th>
				<td width="35%"><div style="height:24px;line-height:24px;">{pigcms{$now_user.uid}</div></td>
				<th width="15%">微信唯一标识</th>
				<td width="35%"><div style="height:24px;line-height:24px;">{pigcms{$now_user.openid}</div></td>
			<tr/>
			<tr>
				<th width="15%">昵称</th>
				<td width="35%"><input type="text" class="input fl" name="nickname" size="20" validate="maxlength:50,required:true" value="{pigcms{$now_user.nickname}"/></td>
				<th width="15%">手机号</th>
				<td width="35%"><input type="text" class="input fl" name="phone" size="20" validate="mobile:true" value="{pigcms{$now_user.phone}"/></td>
			</tr>
			<tr>
				<th width="15%">密码</th>
				<td width="35%"><input type="password" class="input fl" name="pwd" size="20" value="" tips="不修改则不填写"/></td>
				<th width="15%">性别</th>
				<td width="35%" class="radio_box">
					<span class="cb-enable"><label class="cb-enable <if condition="$now_user['sex'] eq 1">selected</if>"><span>男</span><input type="radio" name="sex" value="1"  <if condition="$now_user['sex'] eq 1">checked="checked"</if>/></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_user['sex'] eq 2">selected</if>"><span>女</span><input type="radio" name="sex" value="2"  <if condition="$now_user['sex'] eq 2">checked="checked"</if>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="15%">省份</th>
				<td width="35%"><input type="text" class="input fl" name="province" size="20" validate="maxlength:20" value="{pigcms{$now_user.province}"/></td>
				<th width="15%">城市</th>
				<td width="35%"><input type="text" class="input fl" name="city" size="20" validate="maxlength:20" value="{pigcms{$now_user.city}"/></td>
			</tr>
			<tr>
				<th width="15%">QQ号</th>
				<td width="35%"><input type="text" class="input fl" name="qq" size="20" value="{pigcms{$now_user.qq}"/></td>
				<th width="15%">状态</th>
				<td width="35%" class="radio_box">
					<span class="cb-enable"><label class="cb-enable <if condition="$now_user['status'] eq 1">selected</if>"><span>正常</span><input type="radio" name="status" value="1"  <if condition="$now_user['status'] eq 1">checked="checked"</if>/></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_user['status'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="status" value="0"  <if condition="$now_user['status'] eq 0">checked="checked"</if>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="15%">注册时间</th>
				<td width="35%"><div style="height:24px;line-height:24px;">{pigcms{$now_user.add_time|date='Y-m-d H:i:s',###}</div></td>
				<th width="15%">注册IP</th>
				<td width="35%"><div style="height:24px;line-height:24px;">{pigcms{$now_user.add_ip|long2ip=###}</div></td>
			</tr>
			<tr>
				<th width="15%">最后访问时间</th>
				<td width="35%"><div style="height:24px;line-height:24px;">{pigcms{$now_user.last_time|date='Y-m-d H:i:s',###}</div></td>
				<th width="15%">最后访问IP</th>
				<td width="35%"><div style="height:24px;line-height:24px;">{pigcms{$now_user.last_ip|long2ip=###}</div></td>
			</tr>
			<tr>
				<th width="15%">余额</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">现在余额：￥{pigcms{$now_user.now_money|floatval=###} &nbsp;&nbsp;&nbsp;&nbsp;<select name="set_money_type"><option value="1">增加</option><option value="2">减少</option></select>&nbsp;&nbsp;<input type="text" class="input" name="set_money" size="10" validate="number:true" tips="此处填写增加或减少的额度，不是将余额变为此处填写的值"/></div></td>
			</tr>
			<tr>
				<th width="15%">身份证号</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					<input type="text" class="input fl" name="id_number" size="20" value="{pigcms{$now_user.id_number}"/>
				</div></td>
			</tr>
			<tr>
				<th width="15%">身份证照片</th>
				<td width="85%" colspan="3"><div style="height:100px;line-height:24px;"><img src="{pigcms{$now_user.id_number_img}" alt="" height="100px"></div></td>
			</tr>
			<tr>
				<th width="15%">手持身份证照</th>
				<td width="85%" colspan="3"><div style="height:100px;line-height:24px;"><img src="{pigcms{$now_user.with_id_card}" alt="" height="100px"></div></td>
			</tr>
			<tr>
				<th width="15%">身份证号</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					<input type="text" class="input fl" name="bank_name" size="20" value="{pigcms{$now_user.bank_name}"/>
				</div></td>
			</tr>
			<tr>
				<th width="15%">银行名称</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					{pigcms{$now_user.bank_name}
				</div></td>
			</tr>
			<tr>
				<th width="15%">银行卡号</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					{pigcms{$now_user.bank_code}
				</div></td>
			</tr>
			<tr>
				<th width="15%">开户行</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					{pigcms{$now_user.bank_address}
				</div></td>
			</tr>
			<tr>
				<th width="15%">户主</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					{pigcms{$now_user.bank_account}
				</div></td>
			</tr>
			<tr>
				<th width="15%">支付宝账号</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					{pigcms{$now_user.alipay_account}
				</div></td>
			</tr>
			<tr>
				<th width="15%">支付宝名称</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">
					{pigcms{$now_user.alipay_name}
				</div></td>
			</tr>
			<tr>
				<th width="15%">积分</th>
				<td width="85%" colspan="3"><div style="height:30px;line-height:24px;">现在积分：{pigcms{$now_user.score_count} &nbsp;&nbsp;&nbsp;&nbsp;<select name="set_score_type"><option value="1">增加</option><option value="2">减少</option></select>&nbsp;&nbsp;<input type="text" class="input" name="set_score" size="10" validate="number:true" tips="此处填写增加或减少的积分，不是将积分变为此处填写的值"/></div></td>
			</tr>
			<tr>
				<th width="15%">等级</th>
				<td width="85%" colspan="3">
				<div style="height:30px;line-height:24px;">现在等级：<php>if(isset($levelarr[$now_user['level']])){ echo $levelarr[$now_user['level']]['lname'];}else{echo '暂无等级';}</php> &nbsp;&nbsp;&nbsp;&nbsp;
				<if condition="!empty($levelarr)">
				请设定等级：&nbsp;&nbsp;
				<select name="level" style="width:100px;">
				<option value="0">无</option>
				<volist name="levelarr" id="vo">
				<option value="{pigcms{$vo['level']}">{pigcms{$vo['lname']}</option>
				</volist>
				</select>
				</if>
				&nbsp;&nbsp;</div>
				</td>
			</tr>
			<tr>
				<th width="15%">记录表</th>
				<td width="85%" colspan="3">
					<div style="height:30px;line-height:24px;">
						<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/money_list',array('uid'=>$now_user['uid']))}','余额记录列表',680,560,true,false,false,null,'money_list',true);">余额记录</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/score_list',array('uid'=>$now_user['uid']))}','积分记录列表',680,560,true,false,false,null,'score_list',true);">积分记录</a>
					</div>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>
