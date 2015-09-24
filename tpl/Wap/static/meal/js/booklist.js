var TPL ='<li>'+
			'<a href="{storeDetailsURL}" >'+
					'<table cellpadding="0" cellspacing="0">'+
						'<tr>'+
							'<td class="img"><img src="{imgurl}"></td>'+
							'<td class="info">'+
								'<div class="name">{name}</div>'+
								'<div class="address">'+
									'<span class="icon addr"></span>'+
									'<label>{address}</label>'+
								'</div>'+	
							'</td>'+
							'<td class="opt">'+
							'<a href="{btnUrl}" onClick=\'{clickstr}\' class="btn {btnColor}">{btnText}</a>'+
							'<div>{dist_str}</div>'+
							'</td>'+
						'</tr>'+
					'</table>'+							
				'</a>'+
		'</li>';
$(window).ready(function(){
		$(".searchdiv input").get(0).oninput=function(){
			if($(".searchdiv input").val().length>0){
				if($(".searchdiv .del").length==0){
					$(".searchdiv").append("<div class='del'></div>");
					$(".searchdiv .del").click(function(){
														$(".searchdiv input").val("");
														$(".searchdiv .del").hide();
														});
				}else{
					$(".searchdiv .del").show();
				}
			}
			else{
				if($(".searchdiv .del").length>0){
					$(".searchdiv .del").hide();
				}
			}
			
		}
		
		
		getlist(false);
		getNowPosition(function(nowlat,nowlng){
			getpositionList(nowlat,nowlng);					
		});
		

});
function getpositionList(nowlat,nowlng){
	if(List.length>0)
	{
		for(var i=0;i<List.length;i++){
			var obj = List[i];
			for(key in obj){
				obj.dist=getFlatternDistance(nowlat,nowlng,parseFloat(obj.position.lat),parseFloat(obj.position.lng));
				obj.dist_str = obj.dist>1000? ((obj.dist/1000).toFixed(2)+' km'):(parseInt(obj.dist)+ " m");
			}
		}
		bubbleSort();
		getlist(true);
	}
}
function bubbleSort(){
    for(var i=0;i<List.length;i++){
        for(var j=i;j<List.length;j++){
            if(List[i]["dist"]>List[j]["dist"]){
                var temp=List[i];
                List[i]=List[j];
                List[j]=temp;
            }
        }
    }
}
function getlist(ispostion,nowlat,nowlng){
	var html='<div style="color:#888888;padding-left:10px;line-height:30px;font-size:12px;">定位中...</div>';
	if(ispostion) html="";
	if(List.length>0)
	{
		for(var i=0;i<List.length;i++){
			var li_str = TPL;
			var obj = List[i];
			
			obj.btnColor="orange";
			obj.clickstr = "";
			if(obj.isShow==1){
				obj.showList=JSON.stringify(obj.showList);
				if(!ispostion){obj.showList=JSON.stringify(obj.showList);}
				obj.clickstr = "popup("+obj.showList+",\""+obj.seeURL+"\")"
				obj.btnUrl="javascript:;"
			}else{
				obj.clickstr="javascript:;"
				
			}
			if(1==obj.btndisabled){
				obj.btnColor ="gray";
				obj.btnUrl="javascript:;"
			}
			if(!ispostion){
				obj.dist_str="";
			}
			for(key in obj){
				li_str=li_str.replace("{"+key+"}",obj[key]);
			}
			html+=li_str;
		}
		
	}
	else{		
		html="<div class='tips'>店家很忙，暂未添加门店！</div>"
	}
	if(total<10)
	{
		$(".searchdiv").hide()
	}
	$("#booklist").html(html);
}

function showLayerData(data,url){
	data =JSON.parse(data);
	if(Object.prototype.toString.call(data) === "[object String]")
	{
		data =JSON.parse(data);
	}
	var list=$("#orderInfoList");
	list.html("");
	for(var i=0;i<data.length;i++){
		 var li = document.createElement("li");
		 
		 var info ="";
		 if(data[i]["orderNum"]!=""){
			 info="预约号"+data[i]["orderNum"]+"&nbsp;"+data[i]["Pnum"]+"人&nbsp;"+data[i]["time"];
		 }
		 else{
			 if(data[i]["Pnum"]==0){
				 info=""+data[i]["time"]+"到店";
			 }
			 else{
				info=""+data[i]["Pnum"]+"人&nbsp;"+data[i]["time"]+"到店";	 
			 }
			 
		 }
		 $(li).html('<label><input  type="radio"  name="orderlist"></label>'+info);
		 var actionUrl=data[i]["actionUrl"];
		 li.onclick = function(){
		 	window.location.href=actionUrl;
		 }
		 $(list).append(li);
	}
	$(".dialogX .see").click(function(){
		window.location.href=url;							  
	});
}




function  getNowPosition(fn){
	 if (window.navigator.geolocation) {
		 var options = {
			 enableHighAccuracy: true,
		 };
		 window.navigator.geolocation.getCurrentPosition(function(position){
			var lng = position.coords.longitude;
			var lat = position.coords.latitude;
			var pos = new BMap.Point(lng, lat);
			BMap.Convertor.translate(pos,0,function(newPos){
			 	fn.call(null,newPos.lat,newPos.lng);
			});
		}, function(e){
				
		}, options);
	 } else {
		 alert("浏览器不支持html5来获取地理位置信息");
	 }		
}

(function(){
	function load_script(xyUrl, callback){
	    var head = document.getElementsByTagName('head')[0];
	    var script = document.createElement('script');
	    script.type = 'text/javascript';
	    script.src = xyUrl;
	    //借鉴了jQuery的script跨域方法
	    script.onload = script.onreadystatechange = function(){
	        if((!this.readyState || this.readyState === "loaded" || this.readyState === "complete")){
	            callback && callback();
	            // Handle memory leak in IE
	            script.onload = script.onreadystatechange = null;
	            if ( head && script.parentNode ) {
	                head.removeChild( script );
	            }
	        }
	    };
	    // Use insertBefore instead of appendChild  to circumvent an IE6 bug.
	    head.insertBefore( script, head.firstChild );
	}
	function translate(point,type,callback){
	    var callbackName = 'cbk_' + Math.round(Math.random() * 10000);    //随机函数名
	    var xyUrl = "http://api.map.baidu.com/ag/coord/convert?from="+ type + "&to=4&x=" + point.lng + "&y=" + point.lat + "&callback=BMap.Convertor." + callbackName;
	    //动态创建script标签
	    load_script(xyUrl);
	    BMap.Convertor[callbackName] = function(xyResult){
	        delete BMap.Convertor[callbackName];    //调用完需要删除改函数
	        var point = new BMap.Point(xyResult.x, xyResult.y);
	        callback && callback(point);
	    }
	}

	window.BMap = window.BMap || {};
	BMap.Convertor = {};
	BMap.Convertor.translate = translate;
})();


function getFlatternDistance(lat1,lng1,lat2,lng2){
	var EARTH_RADIUS = 6378137.0;    //单位M
	var PI = Math.PI;

	function getRad(d){
	    return d*PI/180.0;
	}

    var f = getRad((lat1 + lat2)/2);
    var g = getRad((lat1 - lat2)/2);
    var l = getRad((lng1 - lng2)/2);
    
    var sg = Math.sin(g);
    var sl = Math.sin(l);
    var sf = Math.sin(f);
    
    var s,c,w,r,d,h1,h2;
    var a = EARTH_RADIUS;
    var fl = 1/298.257;
    
    sg = sg*sg;
    sl = sl*sl;
    sf = sf*sf;
    
    s = sg*(1-sl) + (1-sf)*sl;
    c = (1-sg)*(1-sl) + sf*sl;
    
    w = Math.atan(Math.sqrt(s/c));
    r = Math.sqrt(s*c)/w;
    d = 2*w*a;
    h1 = (3*r -1)/2/c;
    h2 = (3*r +1)/2/s;
    
    return d*(1 + fl*(h1*sf*(1-sg) - h2*(1-sf)*sg));
}
