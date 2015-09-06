$(function(){
	initPage_obj.getStores().getLocation();
});
window.onerror = function(e){
	//alert(JSON.stringify(e));
}

var initPage_obj = {
	res:{
		positionStr:'<div style="background:#eeeeee;color:#888888;padding-left:10px;line-height:30px;font-size:12px;">定位中...</div>',
		data:[],
		lng:0,
		lat:0
	},
	getLocation: function(){
		var that = this;
		try{
			navigator.geolocation.getCurrentPosition(function(position){
				var lng = position.coords.longitude;
				var lat = position.coords.latitude;
				var pos = new BMap.Point(lng, lat);
				that.getBMapLocation(pos);
			}, function(e){
				that.res.positionStr = '';
				that.getStores();
			}, {
				enableHighAccuracy: true
			});
		}catch(e){
			alert("get data error");
			that.res.positionStr = '';
			that.getStores();
		}
		return that;
	},
	getBMapLocation: function(pos){
		var that = this;
		 BMap.Convertor.translate(pos,0,function(newPos){
		 	that.res.lat = newPos.lat;
		 	that.res.lng = newPos.lng;
		 	that.res.positionStr = '';
		 	that.getStores();
		 });
		return that;
	},
	getStores: function(){
		var that = this;
		$.ajax({
			type: "POST",
			url: APP.urls.getStores+"#a="+Math.random(),
			data: {
				
			},
			cache:false,
			async:true,
			success: function(res){
				if(res && 1==res.result && res.data && res.data.length){
					that.res.data = res.data||[];
					if(res.data.length<10){
						$(".search").remove();
					}
					that.getStores = that.rendStoreList;
					that.getStores();
				}
			},
			error:function(e){
				that.getStores = function(){return that;};
			},
			dataType: "json"
		});
		return that;
	},
	rendStoreList: function(){
		if(this.getStores != this.rendStoreList){
			return this;
		}
		var _html = "",
			that = this,
			TPL = '<li onclick="location.href=\'{url}\';">\
					<div class="img_tt">\
						<div><div class="nopic" style="{bg_img}"></div></div>\
					</div>\
					<div class="main_info">\
						<i class="{is_rest}ico_rest"></i>\
						<h3>{name}</h3>\
						<p class="sub_title">{address}</p>\
						<div>\
							<a href="tel:{tel}">电话：{tel}</a>\
							<span class="ml13">{dist_str}</span>\
						</div>\
						<!--div>{ctime}</div-->\
					</div>\
				</li>';

		if(that.res.data.length){
			if(that.res.data.length>1){
				var now = +new Date();
				that.res.data.forEach(function(v,k){
					v.ctime = v.ctime&&parseInt(v.ctime)?parseInt(v.ctime):now;
					v._ctime = v.ctime;
					v.state = parseInt(v.state);
					v.dist = that.res.lat?getFlatternDistance(parseFloat(v.position.lat), parseFloat(v.position.lng), parseFloat(that.res.lat), parseFloat(that.res.lng) ):0;
					v._dist = v.dist;
					if(0 == v.state){
						v._dist = v.dist*(1000*10000);
						v._ctime = v.ctime*(1000*10000);
					}
				});

				var _data = that.res.data.sort(function(a1, a2){
					return that.res.lat?(a1._dist>a2._dist?1:-1):(a1._ctime>a2._ctime?1:-1);
				});
			}
		}else{
			return this;
		}

		_html = iTemplate.makeList(TPL, that.res.data, function(k,v){
			return {
				ctime: new Date(v.ctime),
				bg_img:v.img?'background-image:url('+v.img+');background-size: 100% 100%;':'',
				is_rest:1 == v.state?"not_":"",
				dist_str:v.dist?(function(){
					var _dist = v.dist>1000? ((v.dist/1000).toFixed(2)+' KM'):(parseInt(v.dist)+ " M");
					return '<i class="ico_addres"></i>距离：'+_dist;
				})():""
			}
		});
		$("#storeList").html($(that.res.positionStr + _html));
		return that;
	}
};



//2011-7-25
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