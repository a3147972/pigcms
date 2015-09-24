<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-empire"></i>
				<a href="{pigcms{$url}">微活动</a>
			</li>
			<li class="active"><a href="{pigcms{$url}">{pigcms{$thisLottery['title']}</a></li>
			<li class="active">作弊管理</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div style="background:#fefbe4;border:1px solid #f3ecb9;color:#993300;padding:10px;margin-top:5px;">使用方法：在需要中奖的微信里向本公众号发送“cheat {pigcms{$thisLottery.id} {pigcms{$thisLottery.parssword} 获奖等级 备注”（参数分别是：cheat 活动id 兑奖密码 获奖等级 备注），比如想让王局长获得一等奖那么就用王局长的手机发送“cheat {pigcms{$thisLottery.id} {pigcms{$thisLottery.parssword} 1 王局长”，收集好信息后，王局长在抽奖的时候就会中奖了</div>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="100">wechat id</th>
									<th id="shopList_c1" width="100">奖项</th>
									<th id="shopList_c0" width="100">备注</th>
									<th id="shopList_c11" width="100">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$records">
									<volist name="records" id="record">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$record.wecha_id}</td>
											<td>{pigcms{$record.prizetype}</td>
											<td>{pigcms{$record.intro}</td>
											<td class="button-column" nowrap="nowrap">
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U($activeType .'/deleteCheat',array('id'=>$record['id']))}">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="4" >无内容</td></tr>
								</if>
							</tbody>
						</table>
						{pigcms{$pagebar}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
</script>
<include file="Public:footer"/>
