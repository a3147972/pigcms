// JavaScript Document
;
(function($) {
	$.fn.navfix = function(mtop, zindex, color) {
		var nav = $(this),
			mtop = mtop,
			zindex = zindex,
			dftop = nav.offset().top,
 
			dfleft = nav.offset().left - $(window).scrollLeft(),
			dfcss = new Array;
			dfcss[0] = nav.css("position"), dfcss[1] = nav.css("top"), dfcss[2] = nav.css("left"), dfcss[3] = nav.css("zindex"),$(window).scroll(function(e){
			$(this).scrollTop() > dftop ? $.browser.msie && $.browser.version == "6.0" ? nav.css({
				position: "absolute",
				top: eval(document.documentElement.scrollTop),
			 
				"z-index": zindex,
				background: color
			}) : nav.css({
				position: "fixed",
				top: mtop + "px",			
				 
				"z-index": zindex,
				background: color
			}) : nav.css({
				position: dfcss[0],
				top: dfcss[1],
			 left:'0',
				"z-index": dfcss[3],
				background: 'none'
			})
		})
	}
})(jQuery)