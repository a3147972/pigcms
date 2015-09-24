<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-credit-card"></i>
				<a href="{pigcms{:U('Card/index')}">会员卡</a>
			</li>
			<li class="active">【{pigcms{$thisCard['cardname']}】的会员管理</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">	
							<li class="active">
								<a href="{pigcms{:U('Card/members', array('id' => $thisCard['id']))}">会员管理</a>
							</li>	
							<li>
								<a href="{pigcms{:U('Card/coupon', array('id' => $thisCard['id']))}">优惠券活动</a>
							</li>	
							<li>
								<a href="{pigcms{:U('Card/integral', array('id' => $thisCard['id']))}">礼品券活动</a>
							</li>
							<!-- li>
								<a href="{pigcms{:U('Card/privilege', array('id' => $thisCard['id']))}">特权管理</a>
							</li>
							<li>
								<a href="{pigcms{:U('Card/gifts', array('id' => $thisCard['id']))}">开卡赠送</a>
							</li> -->
						</ul>
					
						<div class="tab-content">
							<div class="alert alert-block alert-success">
								<button type="button" class="close" data-dismiss="alert">
									<i class="ace-icon fa fa-times"></i>
								</button>	
								<p>
									注意:在每行的输入框里可以通过输入消费金额（可以填写负数）来增减会员积分<br/>
									在卡号下面的输入框输入您要搜索的卡号后按【Enter】即可搜索
								</p>
							</div>
							<div class="tab-pane active">
								<div id="shopList" class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th id="shopList_c1" width="100">卡号</th>
												<th id="shopList_c1" width="100">姓名</th>
												<th id="shopList_c0" width="100">联系电话</th>
												<th id="shopList_c3" width="100">领卡时间</th>
												<th id="shopList_c3" width="100">积分</th>
												<th id="shopList_c3" width="100">消费总额(元)</th>
												<th id="shopList_c3" width="100">余额</th>
												<th id="shopList_c11" width="100">操作</th>
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
													<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
														<td>{pigcms{$list.number}</td>
														<td>{pigcms{$list.truename}</td>
														<td>{pigcms{$list.tel}</td>
														<td><if condition="$list['getcardtime'] gt 0">{pigcms{$list.getcardtime|date='Y-m-d',###}<else/> 无时间记录</if></td>
														<td>
															{pigcms{$list.total_score}
										                    <form method="post"  action="/merchant.php?g=Merchant&c=Card&a=memberExpense&id={pigcms{$thisCard.id}" >
										                  		<input type="text" name="money" value="0" class="px" style="width:40px;">
										                  		<input type="hidden" name="wecha_id" value="{pigcms{$list.wecha_id}">
										                   		<button type="submit" style="cursor:pointer" class="btnGrayS vm">设置</button>
															</form>
														</td>
														<td>{pigcms{$list.expensetotal}</td>
														<td>￥ {pigcms{$list.balance|floatval=###}</td>
														<td class="button-column" nowrap="nowrap">
															<a href="javascript:void(0);" onclick="memberCardRecharge({pigcms{$list.uid})"><strong>充值</strong></a> 
															|
															<a href="{pigcms{:U('Card/member',array('token'=>$token,'itemid'=>$list['id'],'id'=>$thisCard['id']))}" ><strong>消费记录</strong></a>
															|
															<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/member_del',array('itemid'=>$list['id'],'id'=>$thisCard['id']))}">
																<i class="ace-icon fa fa-trash-o bigger-130"></i>
															</a>
														</td>
													</tr>
												</volist>
											<else/>
												<tr class="odd"><td class="button-column" colspan="8" >无内容</td></tr>
											</if>
										</tbody>
									</table>
									{pigcms{$page}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>
<script type="text/javascript">
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
</script>
<include file="Public:footer"/>
