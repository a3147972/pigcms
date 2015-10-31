<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Merchant/amend')}" frame="true" refresh="true">
		<input type="hidden" name="mer_id" value="{pigcms{$merchant.mer_id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">商户帐号</th>
				<td><div class="show">{pigcms{$merchant.account}</div></td>
			</tr>
			<tr>
				<th width="80">商户密码</th>
				<td><input type="password" id="check_pwd" check_width="180" check_event="keyup" class="input fl" name="pwd" value="" size="25" placeholder="不修改则不填写！" validate="minlength:6" tips="不修改则不填写！"/></td>
			</tr>
			<tr>
				<th width="80">商户名称</th>
				<td><input type="text" class="input fl" name="name" value="{pigcms{$merchant.name}" size="25" placeholder="商户的公司名或..." validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">联系电话</th>
				<td><input type="text" class="input fl" name="phone" value="{pigcms{$merchant.phone}" size="25" placeholder="联系人的电话" validate="required:true" tips="多个电话号码以空格分开"/></td>
			</tr>
			<tr>
				<th width="80">联系邮箱</th>
				<td><input type="text" class="input fl" name="email" value="{pigcms{$merchant.email}" size="25" placeholder="可不填写" validate="email:true" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">商户余额</th>
				<td><input type="text" class="input fl" name="balance" value="{pigcms{$merchant.balance}" size="25" placeholder="可不填写" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">身份证号</th>
				<td><input type="text" class="input fl" name="id_number" value="{pigcms{$merchant.id_number}" size="25" placeholder="可不填写" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">身份证照片</th>
				<td>
				<img src="{pigcms{$merchant.id_number_img}" alt="" width="100%">
				<input type="hidden" class="input fl" name="id_number_img" value="{pigcms{$merchant.id_number_img}" size="25" placeholder="可不填写" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">手持身份证照</th>
				<td>
				<img src="{pigcms{$merchant.with_id_card}" alt="" width="100%">
				<input type="hidden" class="input fl" name="with_id_card" value="{pigcms{$merchant.with_id_card}" size="25" placeholder="可不填写" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">营业执照</th>
				<td><input type="text" class="input fl" name="business" value="{pigcms{$merchant.business}" size="25" placeholder="可不填写" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">营业执照照片</th>
				<td>
				<img src="{pigcms{$merchant.business_img}" alt="" width="100%">
				<input type="hidden" class="input fl" name="business_img" value="{pigcms{$merchant.business_img}" size="25" placeholder="可不填写" tips="只供管理员后台记录，前台不显示"/></td>
			</tr>
			<tr>
				<th width="80">商户状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['status'] eq 1">selected</if>"><span>启用</span><input type="radio" name="status" value="1" <if condition="$merchant['status'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['status'] neq 1">selected</if>"><span>关闭</span><input type="radio" name="status" value="0" <if condition="$merchant['status'] neq 1">checked="checked"</if>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">签约商家</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['issign'] eq 1">selected</if>"><span>是</span><input type="radio" name="issign" value="1" <if condition="$merchant['issign'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable  <if condition="$merchant['issign'] neq 1">selected</if>"><span>否</span><input type="radio" name="issign" value="0"  <if condition="$merchant['issign'] neq 1">checked="checked"</if> /></label></span>
					<em class="notice_tips" tips="开启后商家中心会显示此商家已签约标签即商家是优质客户，所有新增的产品都无需审核"></em>
				</td>
			</tr>
			<tr>
				<th width="80">认证商家</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['isverify'] eq 1">selected</if>"><span>是</span><input type="radio" name="isverify" value="1" <if condition="$merchant['isverify'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['isverify'] neq 1">selected</if>"><span>否</span><input type="radio" name="isverify" value="0"  <if condition="$merchant['isverify'] neq 1">checked="checked"</if> /></label></span>
					<em class="notice_tips" tips="开启后商家中心会显示此商家已认证标签"></em>
				</td>
			</tr>
			<tr>
				<th width="80">使用公众号</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_open_oauth'] eq 1">selected</if>"><span>允许</span><input type="radio" name="is_open_oauth" value="1" <if condition="$merchant['is_open_oauth'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_open_oauth'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="is_open_oauth" value="0" <if condition="$merchant['is_open_oauth'] eq 0">checked="checked"</if>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">开微店</th>
				<td>
					<span class="cb-enable"><label class="cb-enable <if condition="$merchant['is_open_weidian'] eq 1">selected</if>"><span>允许</span><input type="radio" name="is_open_weidian" value="1" <if condition="$merchant['is_open_weidian'] eq 1">checked="checked"</if> /></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$merchant['is_open_weidian'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="is_open_weidian" value="0" <if condition="$merchant['is_open_weidian'] eq 0">checked="checked"</if>/></label></span>
				</td>
			</tr>
			<tr>
				<th width="80">平台抽成比例</th>
				<td><input type="text" class="input fl" name="percent" value="{pigcms{$merchant.percent}" size="5" placeholder="0" tips="平台根据商家的总销售额获取的一定比例的抽成"/></td>
			</tr>
			<tr>
				<th width="80">A消费返利</th>
				<td><input type="text" class="input fl" name="a_consumer_rebate" value="{pigcms{$merchant.a_consumer_rebate}" size="5" placeholder="{pigcms{$merchant.a_consumer_rebate}" tips=""/></td>
			</tr>
			<tr>
				<th width="80">B消费返利</th>
				<td><input type="text" class="input fl" name="b_consumer_rebate" value="{pigcms{$merchant.b_consumer_rebate}" size="5" placeholder="{pigcms{$merchant.b_consumer_rebate}" tips=""/></td>
			</tr>
			<tr>
				<th width="80">C消费返利</th>
				<td><input type="text" class="input fl" name="c_consumer_rebate" value="{pigcms{$merchant.c_consumer_rebate}" size="5" placeholder="{pigcms{$merchant.c_consumer_rebate}" tips=""/></td>
			</tr>
			<tr>
				<th width="80">D消费返利</th>
				<td><input type="text" class="input fl" name="d_consumer_rebate" value="{pigcms{$merchant.d_consumer_rebate}" size="5" placeholder="{pigcms{$merchant.d_consumer_rebate}" tips=""/></td>
			</tr>
			<tr>
				<th width="80">自身消费返利</th>
				<td><input type="text" class="input fl" name="self_consumer_rebate" value="{pigcms{$merchant.self_consumer_rebate}" size="5" placeholder="{pigcms{$merchant.self_consumer_rebate}" tips=""/></td>
			</tr>
			<tr><th colspan="2" style="color: red;text-align:center"> 超级广告设置 </th></tr>
			<tr>
				<th width="80">首页宣传状态</th>
				<td>
					<select name="share_open" class="valid">
					<option value="0" <if condition="$merchant['share_open'] eq 0">selected="selected"</if>>关闭</option>
					<option value="1" <if condition="$merchant['share_open'] eq 1">selected="selected"</if>>开启显示商家信息</option>
					<option value="2" <if condition="$merchant['share_open'] eq 2">selected="selected"</if>>开启跳转到商家微网站</option>
					</select>
				</td>
			</tr>
			<tr>
				<th width="80">广告语</th>
				<td><input type="text" class="input fl" name="a_title" value="{pigcms{$home_share.title}" size="25" placeholder="可不填写" tips="粉丝看到自己的第一次进入本站来自哪个商家的店铺"/></td>
			</tr>
			<tr>
				<th width="80">进入提示语</th>
				<td><input type="text" class="input fl" name="a_name" value="{pigcms{$home_share.a_name}" size="5" placeholder="可不填写" tips="提示粉丝进入的提示语言"/></td>
			</tr>
			<tr>
				<th width="80">进入网址</th>
				<td><input type="text" class="input fl" name="a_href" value="{pigcms{$home_share.a_href}" size="60" placeholder="可不填写" tips="跳转到指定地方的网址"  validate="url:true"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>