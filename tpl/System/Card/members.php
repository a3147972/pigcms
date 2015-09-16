<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Card/members', array('id' => $thisCard['id']))}" class="on">会员管理</a>|
					<a href="{pigcms{:U('Card/coupon', array('id' => $thisCard['id']))}">优惠券活动</a>|
					<a href="{pigcms{:U('Card/integral', array('id' => $thisCard['id']))}">礼品券活动</a>
					<!--a href="{pigcms{:U('Card/privilege', array('id' => $thisCard['id']))}">特权管理</a-->
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col> <col><col><col><col> <col width="140" align="center"> </colgroup>
						<thead>
							<tr>
								<th width="100">卡号</th>
								<th width="100">姓名</th>
								<th width="100">联系电话</th>
								<th width="100">领卡时间</th>
								<th width="100">积分</th>
								<th width="100">消费总额(元)</th>
								<th width="100">余额</th>
								<th width="100">操作</th>
							</tr>
						</thead>
						<tbody>
							<tr class="filters">
								<td><form method="post" action=""><input name="searchkey" type="text" maxlength="20" /></form></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<if condition="$members">
								<volist name="members" id="list">
									<tr>
										<td>{pigcms{$list.number}</td>
										<td>{pigcms{$list.truename}</td>
										<td>{pigcms{$list.tel}</td>
										<td><if condition="$list['getcardtime'] gt 0">{pigcms{$list.getcardtime|date='Y-m-d',###}<else/> 无时间记录</if></td>
										<td>
											{pigcms{$list.total_score}
						                    <form method="post"  action="/admin.php?g=System&c=Card&a=memberExpense&id={pigcms{$thisCard.id}" >
						                  		<input type="text" name="money" value="0" class="px" style="width:40px;">
						                  		<input type="hidden" name="wecha_id" value="{pigcms{$list.wecha_id}">
						                   		<button type="submit" style="cursor:pointer" class="btnGrayS vm">设置</button>
											</form>
										</td>
										<td>{pigcms{$list.expensetotal}</td>
										<td>{pigcms{$list.balance}</td>
										<td class="button-column" nowrap="nowrap">
											<a href="javascript:void(0);" onclick="memberCardRecharge({pigcms{$list.uid})"><strong>充值</strong></a> 
											|
											<a href="{pigcms{:U('Card/member',array('token'=>$token,'itemid'=>$list['id'],'id'=>$thisCard['id']))}" ><strong>消费记录</strong></a>
											|
											<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/member_del',array('itemid'=>$list['id'],'id'=>$thisCard['id']))}">删除</a>
										</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="8">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>