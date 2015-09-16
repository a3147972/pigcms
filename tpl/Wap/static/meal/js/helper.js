var iTemplate = (function(){
	var template = function(){};
	template.prototype = {
		makeList: function(tpl, json, fn){
			var res = [], $10 = [], reg = /{(.+?)}/g, json2 = {}, index = 0;
			for(var el in json){
				if(typeof fn === "function"){
					json2 = fn.call(this, el, json[el], index++)||{};
				}
				res.push(
					 tpl.replace(reg, function($1, $2){
					 	return ($2 in json2)? json2[$2]: (undefined === json[el][$2]? json[el]:json[el][$2]);
					})
				);
			}
			return res.join('');
		}
	}
	return new template();
})();


window.ajax2 = (function(){
	var _ajax2 = function(url, obj){
		return new _ajax2.fn.init(url, obj);
	}

	_ajax2.fn = _ajax2.prototype = {
		//constructor: _ajax2,
		init: function(url, obj){
			var that = this;
			this.xhr = new XMLHttpRequest();
			this.url = url;
			this.type = {'get':'GET', 'post':'POST'}[obj.type&&obj.type.toLowerCase()]||"GET";
			this.async = obj.async||false;
			this.responseType = obj.responseType||"text";
			this.data = obj.data;
			this.formData = _ajax2.serializeFormData(this.data);
			this.callback = obj.callback;
			this.timeout = obj.timeout||10000;
			this.setRequestHeader = obj.headers||{};
			//
			this.work();
			return this;
		},
		work: function(){
			var that = this;
			that.xhr.open(this.type, this.url, this.async);
			that.xhr.setRequestHeader("common", JSON.stringify({
				platform:"HTML5",
				author:"Eric_wu",
				time:+new Date()
			}) );
			//this.xhr.withCredentials = true;
			that.xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			that.xhr.upload.onprogress = function(e) {
				 if (e.lengthComputable) {
      				var percent = (e.loaded / e.total) * 100;
      				if(that.onprogress){
	      				that.onprogress.call(e, percent);
	      			}
      			}
			}
			that.xhr.onload = function(e){
				if(200 == this.status){
					that.callback.call(this, JSON.parse(this.responseText) );
					that.timeout&&clearTimeout(that.xhr.timer);
				}
			}
			if(that.timeout){
				that.xhr.timer = setTimeout(function(){
					that.xhr.abort();
					that.callback.call(that, {
						result:0,
						message: "请求超时"
					});
					clearTimeout(that.xhr.timer);
				}, that.timeout);
			}
			
			that.xhr.send(this.formData);
			return that;
		}

	}
	_ajax2.fn.init.prototype = _ajax2.fn;
	_ajax2.serializeFormData = function(data){
		var formData = new FormData();
		for(var k in data){
			formData.append(k, data[k]);
		}
		return formData;
	}

	return _ajax2;
})(this);


var scrollEvt = (function($){
	var _bottomEvt = function(args, fn){
		this.args = args;
		this.sleeping = false;
	}
	_bottomEvt.prototype = {
		constructor: _bottomEvt,
		init: function(){
			var that = this;

			return that;
		},
		start: function(){
			var that = this;
			$(function(){
				window.addEventListener("scroll", that, false);
			});
			return that;
		},
		stop: function(){
			var that = this;
			window.removeEventListener("scroll", that, false);
			return that;
		},
		sleep: function(flag, time){
			var that = this;
			that.sleeping = !!flag;
			return that;
		},
		handleEvent: function(evt){
			var that = this;
			if(!that.sleeping){
				var top = document.documentElement.scrollTop + document.body.scrollTop;   
				var textheight = $(document).height();
				if (textheight - top - $(window).height() <= 100) {
					that.args.loadData.call(that.args, evt);
				}
			}
			return that;
		}
	}

	return _bottomEvt;
})($);