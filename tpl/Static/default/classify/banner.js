/***以字符串行书输出一个OBJ**便于查看对象的值*****/
var obj2String = function(_obj) {
    var t = typeof(_obj);
    if (t != 'object' || _obj === null) {
        // simple data type
        if (t == 'string') {
            _obj = '"' + _obj + '"';
        }
        return String(_obj);
    } else {
        if (_obj instanceof Date) {
            return _obj.toLocaleString();
        }
        // recurse array or object
        var n, v, json = [],
        arr = (_obj && _obj.constructor == Array);
        for (n in _obj) {
            v = _obj[n];
            t = typeof(v);
            if (t == 'string') {
                v = '"' + v + '"';
            } else if (t == "object" && v !== null) {
                v = this.obj2String(v);
            }
            json.push((arr ? '': '"' + n + '":') + String(v));
        }
        return (arr ? '[': '{') + String(json) + (arr ? ']': '}');
    }
};

 function bannerClose(){
    $('.pc_banner').hide();
 }
function getWidth() {
    return $('.pc_banner').width();
}
var w = getWidth();

//var w =988;
$(function() {
    if ($(".pc_banner").length > 0) {
        var startX, moveX, endX;
        var index = 0;
        var x = 0;
        var count = $(".pc_banner li").length;
        $(".pc_banner ul li").css({
            width: w + "px"
        });
        $(".pc_banner ul").css({
            width: w * count + "px"
        });
        $(".pc_banner ul li").show();
        var lbTimer;
        var lunbo = function() {
            if (index >= count - 1) {
                $(".pc_banner ul").css({
                    "transition": "250ms ease",
                    "transform": "translate3d(-" + w * (1 + index) + "px,0,0)"
                });
                $(".pc_banner ul li").eq(0).css({
                    position: "relative",
                    left: w * (1 + index) + "px"
                });
                setTimeout(function() {
                    $(".pc_banner ul li").eq(0).css({
                        position: "static",
                        left: "0px"
                    });
                    $(".pc_banner ul").css({
                        "transition": "0",
                        "transform": "translate3d(0px,0,0)"
                    })
                },
                10);
                index = 0
            } else {
                $(".pc_banner ul").css({
                    "transition": "250ms ease",
                    "transform": "translate3d(-" + w * (1 + index) + "px,0,0)"
                });
                index++
            }
            $(".banner_icon i").removeClass("active");
            $(".banner_icon i").eq(index).addClass("active")
        };
        lbTimer = setInterval(lunbo, 3e3);
        $(".pc_banner").on("touchstart",
        function(event) {
            var touches = event.targetTouches;
            if (touches.length === 1) {
                var touch = touches[0];
                startX = touch.pageX
            }
            $(".pc_banner ul").css({
                "transition": "0"
            });
            clearInterval(lbTimer)
        });
        $(".pc_banner").on("touchmove",
        function(event) {
            var touches = event.targetTouches;
            if (touches.length === 1) {
                var touch = touches[0];
                moveX = touch.pageX;
                var offset = moveX - startX - w * index;
                if (index >= count - 1 && moveX - startX < 0) {
                    $(".pc_banner ul li").eq(0).css({
                        position: "relative",
                        left: w * count + "px"
                    })
                } else if (index <= 0 && moveX - startX > 0) {
                    $(".pc_banner ul li").eq(count - 1).css({
                        position: "relative",
                        left: "-" + w * count + "px"
                    })
                }
                $(".pc_banner ul").css({
                    "transform": "translate3d(" + offset + "px,0,0)"
                })
            }
            event.preventDefault()
        });
        $(".pc_banner").on("touchend",
        function(event) {
            var touches = event.changedTouches;
            if (touches.length === 1) {
                var touch = touches[0];
                endX = touch.pageX
            }
            if (endX - startX < 0 && startX - endX >= 5) {
                index++
            } else if (endX - startX > 0 && endX - startX >= 5) {
                index--
            } else {
                lbTimer = setInterval(lunbo, 3e3);
                event.preventDefault();
                window.document.location = $(".pc_banner li").eq(index).find("a").attr("href");
                return
            }
            var offset = 0 - w * index;
            $(".pc_banner ul").css({
                "transition": "250ms ease",
                "transform": "translate3d(" + offset + "px,0,0)"
            });
            if (index > count - 1) {
                index = 0
            } else if (index < 0) {
                index = count - 1
            }
            setTimeout(function() {
                $(".pc_banner ul li").eq(count - 1).css({
                    position: "static",
                    left: "0px"
                });
                $(".pc_banner ul li").eq(0).css({
                    position: "static",
                    left: "0px"
                });
                $(".pc_banner ul").css({
                    "transition": "0",
                    "transform": "translate3d(-" + index * w + "px,0,0)"
                })
            },
            10);
            lbTimer = setInterval(lunbo, 3e3);
            $(".banner_icon i").removeClass("active");
            $(".banner_icon i").eq(index).addClass("active")
        });

		$(".pc_banner .banner_icon i").on("click",
        function(event) {
			var num=$(this).attr('alt');
			num=parseInt(num);
			offset=(num-1)*w;
			offset="-"+offset;
                $(".pc_banner ul").css({
                    "transform": "translate3d(" + offset + "px,0,0)"
                })
				 $(".banner_icon i").removeClass("active");
                 $(this).addClass("active")
        });
    }
});