$(function(){
	var local = null;
	var marker = null;
	var infoWindow = null;
	var search_point =[];
	var info_opts = {
		width : 220,
		height: 72,
		title : "",
		enableMessage:false,
		message:""
	};
	$('#around-map').on('mousewheel',function(){
        return false;
	});
	$.getScript("http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2",function(){
		var map = new BMap.Map("around-map",{"enableMapClick":false});
		var oPoint = new BMap.Point(116.331398,39.897445);
		var setPoint = function(mk){
			var pt = mk.getPosition();
			(new BMap.Geocoder()).getLocation(pt,function(rs){
				addComp = rs.addressComponents;
				infoWindow = new BMap.InfoWindow('<div class="infowin-box">位置：<em class="poi-address">'+ addComp.city + addComp.district + addComp.street +'</em><p style="text-align:center;"><a href="javascript:setSelect(\''+ addComp.city + addComp.district + addComp.street +'\',\''+pt.lat+'\',\''+pt.lng+'\');" class="J-show-around-deals btn btn-normal btn-small" hidefocus="true" style="color:black;">查看附近'+group_alias_name+'</a></p></div>',info_opts);
				marker.openInfoWindow(infoWindow);
			});
		};
		
		map.addEventListener("click",function(e){
			if(!e.overlay){
				if(marker == null){
					marker = new BMap.Marker(new BMap.Point(e.point.lng,e.point.lat),{icon:new BMap.Icon("http://map.baidu.com/image/markers_new.png", new BMap.Size(25, 37), {anchor: new BMap.Size(12,15), imageOffset: new BMap.Size(0,-156)}),enableMassClear:false});
					//marker.enableDragging();
					map.addOverlay(marker);
				}else{
					marker.setPosition(new BMap.Point(e.point.lng,e.point.lat));
				}
				setPoint(marker);
			}
		});
		
		map.enableScrollWheelZoom();

		map.centerAndZoom(oPoint, 12);
			function myFun(result){
				oPoint = new BMap.Point(result.center['lng'],result.center['lat']);
				map.centerAndZoom(oPoint,12);
			}
			var myCity = new BMap.LocalCity();
			myCity.get(myFun);
					

		map.addControl(new BMap.NavigationControl());
		map.enableScrollWheelZoom();

		local = new BMap.LocalSearch(map,{
			pageCapacity:10,
			onSearchComplete:function(results){
				search_point = [];
				var search_count = results.getCurrentNumPois();
				if(search_count > 0){
					var result_panel = '<p class="search-number">共有'+search_count+'条结果</p><ol>';
					for(var i=0;i<search_count;i++){
						var now_poi = results.getPoi(i);
						result_panel += '<li class="result-item" data-lng="'+now_poi.point.lng+'" data-lat="'+now_poi.point.lat+'" data-title="'+now_poi.title+'" data-content="'+now_poi.address+'"><span class="icon icon-'+i+'"></span><a class="J-show-around-deals btn-selected" href="javascript:;">查看附近'+group_alias_name+'</a><h3>'+now_poi.title+'</h3><p class="desc">地址：'+now_poi.address+'</p></li>';
						
						if(i == 0){
							map.centerAndZoom(new BMap.Point(now_poi.point.lng,now_poi.point.lat),15);
						}
						
						var search_marker = new BMap.Marker(new BMap.Point(now_poi.point.lng,now_poi.point.lat),{icon:new BMap.Icon("http://map.baidu.com/image/markers_new.png", new BMap.Size(19, 27), {anchor: new BMap.Size(10,9), imageOffset: new BMap.Size(i*-24,-199)})});
						search_point[i] = search_marker;
						var pt = new BMap.Point(now_poi.point.lng,now_poi.point.lat);
						map.addOverlay(search_marker);
					}
					result_panel += '</ol>';
					$('#result-panel').html(result_panel);
					
					$.each(search_point,function(i,item){
						(function(){
							var index = i;
							search_point[i].addEventListener('click', function(){
								$('#result-panel .result-item').eq(i).click();
								//var pt = search_point[i].getPosition();
								// (new BMap.Geocoder()).getLocation(pt,function(rs){
									// addComp = rs.addressComponents;
									// infoWindow = new BMap.InfoWindow('<div class="infowin-box">位置：<em class="poi-address">'+ addComp.city + addComp.district + addComp.street +'</em><p style="text-align:center;"><a href="javascript: void(0);" class="J-show-around-deals btn btn-normal btn-small" hidefocus="true" onclick="setSelect(this,'+pt.lat+','+pt.lng+')">查看附近团购</a></p></div>',info_opts);
									// search_point[i].openInfoWindow(infoWindow);
								// });
							});    
						})();
					});
				}
			}
		});
		var around_ac = new BMap.Autocomplete({
				'input':'aroundQ',
				'location':'合肥',
				onSearchComplete:function(results){
					
				}
			});
		around_ac.addEventListener("onconfirm", function(e){    //鼠标点击下拉列表后的事件
			map.clearOverlays();
			local.search($('#aroundQ').val());
		});
		
		$('#result-panel .result-item').live('mouseover mouseout click',function(e){
			if(e.type == 'mouseover'){
				$(this).addClass('selected');
				var a = $(this).index();
				$.each($('#result-panel .result-item'),function(i,item){
					if(i == a){
						search_point[i].setIcon(new BMap.Icon("http://map.baidu.com/image/markers_new.png", new BMap.Size(26,36), {anchor: new BMap.Size(14,13), imageOffset: new BMap.Size(i*-34,-73)}));
						search_point[i].setZIndex(3);
					}else if($(item).data('is_selected') != 1){
						search_point[i].setIcon(new BMap.Icon("http://map.baidu.com/image/markers_new.png", new BMap.Size(19, 27), {anchor: new BMap.Size(10,9), imageOffset: new BMap.Size(i*-24,-199)}));
						search_point[i].setZIndex(1);
					}
				});
				
			}else if(e.type == 'mouseout'){
				if($(this).data('is_selected') != 1){
					$(this).removeClass('selected');
				}
			}else{
				$('#result-panel .result-item').data('is_selected',0).removeClass('selected');
				$(this).data('is_selected',1).addClass('selected').mouseover();
				var a = $(this).index();
				var pt = search_point[a].getPosition();
				(new BMap.Geocoder()).getLocation(pt,function(rs){
					addComp = rs.addressComponents;
					infoWindow = new BMap.InfoWindow('<div class="infowin-box">位置：<em class="poi-address">'+ addComp.city + addComp.district + addComp.street +'</em><p style="text-align:center;"><a href="javascript:setSelect(\''+ addComp.city + addComp.district + addComp.street +'\',\''+pt.lat+'\',\''+pt.lng+'\');" class="J-show-around-deals btn btn-normal btn-small" hidefocus="true" style="color:black;">查看附近'+group_alias_name+'</a></p></div>',info_opts);
					search_point[a].openInfoWindow(infoWindow);
				});
				map.panTo(search_point[a].getPosition());
				search_point[a].setZIndex(2);
			}
		});
		$('#aroundForm').submit(function(){
			map.clearOverlays();
			local.search($('#aroundQ').val());
			return false;
		});
		
		$('.J-show-around-deals').live('click',function(event){
			var result_item = $(this).closest('.result-item');
			setSelect(result_item.attr('data-title'),result_item.attr('data-lat'),result_item.attr('data-lng'));
			event.stopPropagation();
		});
	});
});

function setSelect(adress,lat,lng){
    var exp = new Date(); 
    exp.setTime(exp.getTime() + 365*24*60*60*1000);
	document.cookie = "around_adress=" + encodeURIComponent(adress) + ";expires=" + exp.toGMTString(); 
	document.cookie = "around_lat=" + lat + ";expires=" + exp.toGMTString(); 
	document.cookie = "around_long=" + lng + ";expires=" + exp.toGMTString(); 
	window.location.href = '/group/around/';
}