<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Card/noticeSet', array('id' => $thisCard['id']))}" class="on">新增通知</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col><col> <col> <col><col><col><col> <col width="140" align="center"> </colgroup>
						<thead>
								<tr>
									<th width="100">标题</th>
									<th width="100">截止日期</th>
									<th width="100">添加时间</th>
									<th width="180">操作</th>
								</tr>
						</thead>
						<tbody>
							<if condition="$list">
								<volist name="list" id="item">
									<tr>
										<td>{pigcms{$item.title}</td>
										<td>{pigcms{$item.endtime|date="Y-m-d",###}</td>
										<td>{pigcms{$item.time|date="Y-m-d H:i:s",###}</td>
										<td class="button-column" nowrap="nowrap">
											<a href="{pigcms{:U('Card/noticeSet', array('noticeid'=>$item['id'], 'id' => $thisCard['id']))}">编辑</a>　|　
											<a class="red" href="{pigcms{:U('Card/noticeDelete', array('noticeid'=>$item['id'], 'id' => $thisCard['id']))}">删除</a>
										</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="4">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="4">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>