<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Card/members', array('id' => $thisCard['id']))}">会员管理</a>|
					<a href="{pigcms{:U('Card/coupon', array('id' => $thisCard['id']))}" class="on">优惠券活动</a>|
					<a href="{pigcms{:U('Card/integral', array('id' => $thisCard['id']))}">礼品券活动</a>
					<!--a href="{pigcms{:U('Card/privilege', array('id' => $thisCard['id']))}">特权管理</a-->
				</ul>
			</div>
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Card/coupon_edit', array('id' => $thisCard['id']))}" class="on">发布优惠券</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col><col> <col> <col><col><col><col> <col width="140" align="center"> </colgroup>
						<thead>
							<tr>
								<th width="100">标题</th>
								<th width="100">属性</th>
								<th width="100">使用次数</th>
								<th width="100">创建时间</th>
								<th width="100">过期时间</th>
								<th width="100">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="$data_vip">
								<volist name="data_vip" id="list">
									<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
										<td>{pigcms{$list.title}</td>
										<td><if condition="$list.attr eq '1'">赠送卷<else/>普通卷</if></td>
										<td>{pigcms{$list.usetime}</td>
										<td>{pigcms{$list.statdate|date='Y-m-d',###}</td>
										<td>{pigcms{$list.enddate|date='Y-m-d',###}</td>
										<td class="button-column" nowrap="nowrap">
											<a href="{pigcms{:U('Card/useRecords', array('id'=>$thisCard['id'],'type'=>'coupon','itemid'=>$list['id']))}">使用统计</a>
											|
											<a class="green" style="padding-right:8px;" href="{pigcms{:U('Card/coupon_edit', array('itemid'=>$list['id'],'id'=>$thisCard['id']))}" >编辑</a>
											|
											<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/coupon_del',array('itemid'=>$list['id'],'id'=>$thisCard['id']))}">删除</a>
										</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="6">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="6">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>