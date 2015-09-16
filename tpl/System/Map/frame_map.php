<include file="Public:header"/>
	<script type="text/javascript">
		$(function(){
			var store_add_dom = window.top.frames['Openstore_add'];
			var store_add_frame = window.top.frames['Openstore_add'].document;
			$.getScript("http://api.map.baidu.com/getscript?v=2.0&ak=4c1bb2055e24296bbaef36574877b4e2",function(){
				var map = null;
				var oPoint = new BMap.Point({pigcms{$long_lat});
				var marker = new BMap.Marker(oPoint);
				var setPoint = function(mk,b){
					var pt = mk.getPosition();
					$('#long_lat',store_add_frame).val(pt.lng+','+pt.lat);
					(new BMap.Geocoder()).getLocation(pt,function(rs){
						addComp = rs.addressComponents;
						if (b===true){
							if(addComp.province && typeof($('#choose_province',store_add_frame)) != 'undefined'){
								$.each($('#choose_province option',store_add_frame),function(i,item){
									var text = $(item).html();
									if(text && addComp.province.indexOf(text)!=-1){
										var choose_province = $('#choose_province',store_add_frame);
										choose_province.find('option').eq(i).prop('selected',true);
										store_add_dom.show_city(choose_province.find('option:selected').attr('value'),choose_province.find('option:selected').html(),1);
										return false;
									}
								});
							}
							if(addComp.city && typeof($('#choose_city',store_add_frame)) != 'undefined'){
								$.each($('#choose_city option',store_add_frame),function(i,item){
									var text = $(item).html();
									if(text && addComp.city.indexOf(text)!=-1){
										var choose_city = $('#choose_city',store_add_frame);
										choose_city.find('option').eq(i).prop('selected',true);
										store_add_dom.show_area(choose_city.find('option:selected').attr('value'),choose_city.find('option:selected').html(),1);
										return false;
									}
								});
							}
							if(addComp.district && typeof($('#choose_area',store_add_frame)) != 'undefined'){
								$.each($('#choose_area option',store_add_frame),function(i,item){
									var text = $(item).html();
									if(text && addComp.district.indexOf(text)!=-1){
										var choose_area = $('#choose_area',store_add_frame);
										choose_area.find('option').eq(i).prop('selected',true);
										store_add_dom.show_circle(choose_area.find('option:selected').attr('value'),choose_area.find('option:selected').html(),1);
										return false;
									}
								});
							}
							$('#adress',store_add_frame).val(addComp.street + addComp.streetNumber);
						}
					});
				};
				
				map = new BMap.Map("cmmap",{"enableMapClick":false});
				map.enableScrollWheelZoom();
				marker.enableDragging();
				
				<if condition="empty($_GET['long_lat'])">
					map.centerAndZoom(oPoint, 11);
					function myFun(result){
						oPoint = new BMap.Point(result.center['lng'],result.center['lat']);
						map.centerAndZoom(oPoint,11);
						marker.setPosition(oPoint);
					}
					var myCity = new BMap.LocalCity();
					myCity.get(myFun);
				<else/>
					map.centerAndZoom(oPoint,18);
				</if>
			
	
				map.addControl(new BMap.NavigationControl());
				map.enableScrollWheelZoom();

				map.addOverlay(marker);
				
				marker.addEventListener("dragend", function(){
					setPoint(marker,true);
				});
				marker.addEventListener("click", function(e){	
					setPoint(marker,true);
				});	
				/*map.addEventListener("click",function(e){
					alert(e.point.lng + "," + e.point.lat);
				});*/
			});
		});
	</script>
	<style>.BMap_cpyCtrl{display:none;}</style>
	<div id="frame_map_tips" style="margin:0">(用鼠标滚轮可以缩放地图)&nbsp;&nbsp;&nbsp;&nbsp;拖动红色图标，左侧经纬度框内将自动填充经纬度。</div>
	<div id="cmmap" style="height:478px;"></div>
<include file="Public:footer"/>