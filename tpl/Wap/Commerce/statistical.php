<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>商家中心</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
	<link rel="stylesheet" href="{pigcms{$merchantstatic_path}css/bootstrap.min.css">
	<script src="{pigcms{:C('JQUERY_FILE')}"></script>

    <style type="text/css">
.m_nav{height: 50px;line-height: 50px;background: #FF658E;padding-left: 12px;color:#FFF;font-size: 16px;}
.m_nav a{color:#FFF;text-decoration:none;cursor: pointer;}
.btn-weak{padding:0 .2rem;}
</style>
</head>
<body>
    <div class="m_nav"> 
    <span> <a href="/wap.php?g=Wap&c=Commerce&a=index">商家中心</a> &gt; <a href="javascript:;" style="color:#FAFDCC;">数据统计</a></span> 
   </div> 
	<div class="tabbable" style="margin-top: 10px;">
		<ul class="nav nav-tabs" id="myTab">
			<li class="active" id="basic_">
				<a  href="#basicinfo" title="二维码、关注、微官网 统计">
					基础统计
				</a>
			</li>
			<li id="group_">
				<a  href="#groupinfo" title="{pigcms{$config.group_alias_name}统计">
					{pigcms{$config.group_alias_name}统计
				</a>
			</li>
			<li id="meal_">
				<a  href="#mealinfo" title="{pigcms{$config.meal_alias_name}统计">
					{pigcms{$config.meal_alias_name}统计
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="basic_info" class="tab-pane active">
				<div class="widget-box">
					<div class="widget-header">
						<h3 style="margin-left: 2rem;">统计图</h3>
					</div>
					<div class="widget-body" id="main" style="height:300px;width:100%;"></div>
				</div>	
				<div class="row">					
					<div class="col-xs-12">		
						<div class="grid-view">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="25%" style="text-align:center;">时间</th>
										<th width="18%">关注数</th>
										<th width="28%">扫描二维码数</th>
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
				</div>
			</div>
			<div id="group_info" class="tab-pane" style="display:block;">
				<div class="widget-box">
					<div class="widget-header">
						<h3 style="margin-left: 2rem;">统计图</h3>
					</div>
					<div class="widget-body" id="group_main" style="height:300px;width:100%;"></div>
				</div>	
				<div class="row">					
					<div class="col-xs-12">		
						<div class="grid-view">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="26%" style="text-align:center;">时间</th>
										<th width="22%">页面点击</th>
										<th width="22%">购买数量</th>
										<th width="30%">总金额</th>
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
			<div id="meal_info" class="tab-pane" style="display:block;">
				<div class="widget-box">
					<div class="widget-header">
						<h3 style="margin-left: 2rem;">统计图</h3>
					</div>
					<div class="widget-body" id="meal_main" style="height:300px;width:100%;"></div>
				</div>	
				<div class="row">					
					<div class="col-xs-12">		
						<div class="grid-view">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="26%" style="text-align:center;">时间</th>
										<th width="22%">页面点击</th>
										<th width="22%">购买数量</th>
										<th width="30%">总金额</th>
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
	<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
</body>
<script src="{pigcms{$merchantstatic_path}js/echarts-plain.js"></script>
<script type="text/javascript">
    $('#myTab li').click(function(){
			$('#myTab li').removeClass('active');
			$(this).addClass('active');
			var idstr=$(this).attr('id');
		    $('.tab-content .tab-pane').removeClass('active');
			$('#'+idstr+'info').addClass('active');	
		});
    var myChart = echarts.init(document.getElementById('main')); 
    var option = {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['关注数','扫描二维码数','微官网点击数'],
            x: 'center'
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
        /*title : {
            text: '{pigcms{$config.group_alias_name}相关统计图',
            x:'left'
        },*/
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['页面点击数','购买次数','总金额'],
            x: 'center'
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
        /*title : {
            text: '{pigcms{$config.meal_alias_name}相关统计图',
            x:'left'
        },*/
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['页面点击数','购买次数','总金额'],
            x: 'center'
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
</html>