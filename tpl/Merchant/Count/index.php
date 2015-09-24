<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
			<li class="active">商家账单</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-success" onclick="location_count(0)">本月统计</button>&nbsp;&nbsp;
					<button class="btn btn-success" onclick="location_count(7)">最近一周</button>&nbsp;&nbsp;
					<button class="btn btn-success" onclick="location_count(30)">最近三十天</button>
					<div class="tabbable" style="margin-top:20px;">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#basicinfo" title="二维码、关注、微官网 统计">
									基础统计
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#groupinfo" title="{pigcms{$config.group_alias_name}统计">
									{pigcms{$config.group_alias_name}统计
								</a>
							</li>
							<li>
								<a data-toggle="tab" href="#mealinfo" title="{pigcms{$config.meal_alias_name}统计">
									{pigcms{$config.meal_alias_name}统计
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<div class="widget-box">
									<div class="widget-header">
										<h5>统计图</h5>
									</div>
									<div class="widget-body" id="main" style="padding:20px;height:400px;width:100%;"></div>
								</div>	
								<div class="row">					
									<div class="col-xs-12">		
										<div class="grid-view">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>时间</th>
														<th>关注数</th>
														<th>扫描二维码数</th>
														<th>微官网点击数</th>
													</tr>
												</thead>
												<tbody>
													<volist name="request_list" id="vo">
														<tr class="<if condition='$i%2 eq 0'>even<else/>odd</if>">
															<td style="width: 120px">{pigcms{$vo.time|date='Y-m-d',###}</td>
															<td style="width: 120px">{pigcms{$vo.follow_num|intval=###}</td>
															<td style="width: 120px">{pigcms{$vo.img_num|intval=###}</td>
															<td>{pigcms{$vo.website_hits|intval=###}</td>
														</tr>
													</volist>
												</tbody>
											</table>
										</div>						
									</div>
									<!--div class="col-xs-2" style="margin-top: 15px;">
										<a class="btn btn-success" href="#">导出成excel</a>
									</div-->
								</div>
							</div>
							<div id="groupinfo" class="tab-pane" style="display:block;">
								<div class="widget-box">
									<div class="widget-header">
										<h5>统计图</h5>
									</div>
									<div class="widget-body" id="group_main" style="padding:20px;height:400px;width:100%;"></div>
								</div>	
								<div class="row">					
									<div class="col-xs-12">		
										<div class="grid-view">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>时间</th>
														<th>页面点击数</th>
														<th>购买数量</th>
														<th>总金额</th>
													</tr>
												</thead>
												<tbody>
													<volist name="request_list" id="vo">
														<tr class="<if condition='$i%2 eq 0'>even<else/>odd</if>">
															<td style="width: 120px">{pigcms{$vo.time|date='Y-m-d',###}</td>
															<td style="width: 120px">{pigcms{$vo.group_hits|intval=###}</td>
															<td style="width: 120px">{pigcms{$vo.group_buy_count|intval=###}</td>
															<td>￥{pigcms{$vo.group_buy_money|floatval=###}</td>
														</tr>
													</volist>
												</tbody>
											</table>
										</div>						
									</div>
									<!--div class="col-xs-2" style="margin-top: 15px;">
										<a class="btn btn-success" href="#">导出成excel</a>
									</div-->
								</div>
							</div>
							<div id="mealinfo" class="tab-pane" style="display:block;">
								<div class="widget-box">
									<div class="widget-header">
										<h5>统计图</h5>
									</div>
									<div class="widget-body" id="meal_main" style="padding:20px;height:400px;width:100%;"></div>
								</div>	
								<div class="row">					
									<div class="col-xs-12">		
										<div class="grid-view">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>时间</th>
														<th>页面点击数</th>
														<th>购买数量</th>
														<th>总金额</th>
													</tr>
												</thead>
												<tbody>
													<volist name="request_list" id="vo">
														<tr class="<if condition='$i%2 eq 0'>even<else/>odd</if>">
															<td style="width: 120px">{pigcms{$vo.time|date='Y-m-d',###}</td>
															<td style="width: 120px">{pigcms{$vo.meal_hits|intval=###}</td>
															<td style="width: 120px">{pigcms{$vo.meal_buy_count|intval=###}</td>
															<td>￥{pigcms{$vo.meal_buy_money|floatval=###}</td>
														</tr>
													</volist>
												</tbody>
											</table>
										</div>						
									</div>
									<!--div class="col-xs-2" style="margin-top: 15px;">
										<a class="btn btn-success" href="#">导出成excel</a>
									</div-->
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{pigcms{$static_path}js/echarts-plain.js"></script>
<script type="text/javascript">
	function location_count(day){
		window.location.href = "{pigcms{:U('Count/index')}&day="+day;
	}
    var myChart = echarts.init(document.getElementById('main')); 
    var option = {
        title : {
            text: '本月关注、扫描二维码、微官网点击统计图',
            x:'left'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['关注数','扫描二维码数','微官网点击数'],
            x: 'right'
        },
        toolbox: {
            show : false,
            feature : {
                mark : {show: false},
                dataView : {show: false, readOnly: false},
                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore : {show: false} ,
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [{pigcms{$xAxis_txt}]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'关注数',
                type:'line',
                tiled: '总量',
                data: [{pigcms{$follow_txt}]
            },    
            {
                "name":'扫描二维码数',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$img_txt}]
            },
			{
                "name":'微官网点击数',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$website_hits_txt}]
            }

        ]

    };                 
    myChart.setOption(option); 
	
	
	var group_myChart = echarts.init(document.getElementById('group_main')); 
    var group_option = {
        title : {
            text: '{pigcms{$config.group_alias_name}相关统计图',
            x:'left'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['页面点击数','购买次数','总金额'],
            x: 'right'
        },
        toolbox: {
            show : false,
            feature : {
                mark : {show: false},
                dataView : {show: false, readOnly: false},
                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore : {show: false} ,
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [{pigcms{$xAxis_txt}]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'页面点击数',
                type:'line',
                tiled: '总量',
                data: [{pigcms{$group_hits_txt}]
            },    
            {
                "name":'购买次数',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$group_buy_count_txt}]
            },
			{
                "name":'总金额',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$group_buy_money_txt}]
            }

        ]

    };                 
    group_myChart.setOption(group_option); 
	
	var meal_myChart = echarts.init(document.getElementById('meal_main')); 
    var meal_option = {
        title : {
            text: '{pigcms{$config.meal_alias_name}相关统计图',
            x:'left'
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['页面点击数','购买次数','总金额'],
            x: 'right'
        },
        toolbox: {
            show : false,
            feature : {
                mark : {show: false},
                dataView : {show: false, readOnly: false},
                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore : {show: false} ,
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [{pigcms{$xAxis_txt}]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'页面点击数',
                type:'line',
                tiled: '总量',
                data: [{pigcms{$meal_hits_txt}]
            },    
            {
                "name":'购买次数',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$meal_buy_count_txt}]
            },
			{
                "name":'总金额',
                "type":'line',
                "tiled": '总量',
                data:[{pigcms{$meal_buy_money_txt}]
            }

        ]

    };                 
    meal_myChart.setOption(meal_option); 
	
	$('.tab-pane').removeAttr('style');
</script>
<include file="Public:footer"/>
