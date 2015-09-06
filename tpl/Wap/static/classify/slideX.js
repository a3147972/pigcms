function FastClick(layer, options) {
    var oldOnClick;
    options = options || {};
    this.trackingClick = false;
    this.trackingClickStart = 0;
    this.targetElement = null;
    this.touchStartX = 0;
    this.touchStartY = 0;
    this.lastTouchIdentifier = 0;
    this.touchBoundary = options.touchBoundary || 10;
    this.layer = layer;
    this.tapDelay = options.tapDelay || 200;
    if (FastClick.notNeeded(layer)) {
        return
    }
    function bind(method, context) {
        return function() {
            return method.apply(context, arguments)
        }
    }
    var methods = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"];
    var context = this;
    for (var i = 0,
    l = methods.length; i < l; i++) {
        context[methods[i]] = bind(context[methods[i]], context)
    }
    if (deviceIsAndroid) {
        layer.addEventListener("mouseover", this.onMouse, true);
        layer.addEventListener("mousedown", this.onMouse, true);
        layer.addEventListener("mouseup", this.onMouse, true)
    }
    layer.addEventListener("click", this.onClick, true);
    layer.addEventListener("touchstart", this.onTouchStart, false);
    layer.addEventListener("touchmove", this.onTouchMove, false);
    layer.addEventListener("touchend", this.onTouchEnd, false);
    layer.addEventListener("touchcancel", this.onTouchCancel, false);
    if (!Event.prototype.stopImmediatePropagation) {
        layer.removeEventListener = function(type, callback, capture) {
            var rmv = Node.prototype.removeEventListener;
            if (type === "click") {
                rmv.call(layer, type, callback.hijacked || callback, capture)
            } else {
                rmv.call(layer, type, callback, capture)
            }
        };
        layer.addEventListener = function(type, callback, capture) {
            var adv = Node.prototype.addEventListener;
            if (type === "click") {
                adv.call(layer, type, callback.hijacked || (callback.hijacked = function(event) {
                    if (!event.propagationStopped) {
                        callback(event)
                    }
                }), capture)
            } else {
                adv.call(layer, type, callback, capture)
            }
        }
    }
    if (typeof layer.onclick === "function") {
        oldOnClick = layer.onclick;
        layer.addEventListener("click",
        function(event) {
            oldOnClick(event)
        },
        false);
        layer.onclick = null
    }
}
var deviceIsAndroid = navigator.userAgent.indexOf("Android") > 0;
var deviceIsIOS = /iP(ad|hone|od)/.test(navigator.userAgent);
var deviceIsIOS4 = deviceIsIOS && /OS 4_\d(_\d)?/.test(navigator.userAgent);
var deviceIsIOSWithBadTarget = deviceIsIOS && /OS ([6-9]|\d{2})_\d/.test(navigator.userAgent);
var deviceIsBlackBerry10 = navigator.userAgent.indexOf("BB10") > 0;
FastClick.prototype.needsClick = function(target) {
    switch (target.nodeName.toLowerCase()) {
    case "button":
    case "select":
    case "textarea":
        if (target.disabled) {
            return true
        }
        break;
    case "input":
        if (deviceIsIOS && target.type === "file" || target.disabled) {
            return true
        }
        break;
    case "label":
    case "video":
        return true
    }
    return /\bneedsclick\b/.test(target.className)
};
FastClick.prototype.needsFocus = function(target) {
    switch (target.nodeName.toLowerCase()) {
    case "textarea":
        return true;
    case "select":
        return ! deviceIsAndroid;
    case "input":
        switch (target.type) {
        case "button":
        case "checkbox":
        case "file":
        case "image":
        case "radio":
        case "submit":
            return false
        }
        return ! target.disabled && !target.readOnly;
    default:
        return /\bneedsfocus\b/.test(target.className)
    }
};
FastClick.prototype.sendClick = function(targetElement, event) {
    var clickEvent, touch;
    if (document.activeElement && document.activeElement !== targetElement) {
        document.activeElement.blur()
    }
    touch = event.changedTouches[0];
    clickEvent = document.createEvent("MouseEvents");
    clickEvent.initMouseEvent(this.determineEventType(targetElement), true, true, window, 1, touch.screenX, touch.screenY, touch.clientX, touch.clientY, false, false, false, false, 0, null);
    clickEvent.forwardedTouchEvent = true;
    targetElement.dispatchEvent(clickEvent)
};
FastClick.prototype.determineEventType = function(targetElement) {
    if (deviceIsAndroid && targetElement.tagName.toLowerCase() === "select") {
        return "mousedown"
    }
    return "click"
};
FastClick.prototype.focus = function(targetElement) {
    var length;
    if (deviceIsIOS && targetElement.setSelectionRange && targetElement.type.indexOf("date") !== 0 && targetElement.type !== "time") {
        length = targetElement.value.length;
        targetElement.setSelectionRange(length, length)
    } else {
        targetElement.focus()
    }
};
FastClick.prototype.updateScrollParent = function(targetElement) {
    var scrollParent, parentElement;
    scrollParent = targetElement.fastClickScrollParent;
    if (!scrollParent || !scrollParent.contains(targetElement)) {
        parentElement = targetElement;
        do {
            if (parentElement.scrollHeight > parentElement.offsetHeight) {
                scrollParent = parentElement;
                targetElement.fastClickScrollParent = parentElement;
                break
            }
            parentElement = parentElement.parentElement
        } while ( parentElement )
    }
    if (scrollParent) {
        scrollParent.fastClickLastScrollTop = scrollParent.scrollTop
    }
};
FastClick.prototype.getTargetElementFromEventTarget = function(eventTarget) {
    if (eventTarget.nodeType === Node.TEXT_NODE) {
        return eventTarget.parentNode
    }
    return eventTarget
};
FastClick.prototype.onTouchStart = function(event) {
    var targetElement, touch, selection;
    if (event.targetTouches.length > 1) {
        return true
    }
    targetElement = this.getTargetElementFromEventTarget(event.target);
    touch = event.targetTouches[0];
    if (deviceIsIOS) {
        selection = window.getSelection();
        if (selection.rangeCount && !selection.isCollapsed) {
            return true
        }
        if (!deviceIsIOS4) {
            if (touch.identifier === this.lastTouchIdentifier) {
                event.preventDefault();
                return false
            }
            this.lastTouchIdentifier = touch.identifier;
            this.updateScrollParent(targetElement)
        }
    }
    this.trackingClick = true;
    this.trackingClickStart = event.timeStamp;
    this.targetElement = targetElement;
    this.touchStartX = touch.pageX;
    this.touchStartY = touch.pageY;
    if (event.timeStamp - this.lastClickTime < this.tapDelay) {
        event.preventDefault()
    }
    return true
};
FastClick.prototype.touchHasMoved = function(event) {
    var touch = event.changedTouches[0],
    boundary = this.touchBoundary;
    if (Math.abs(touch.pageX - this.touchStartX) > boundary || Math.abs(touch.pageY - this.touchStartY) > boundary) {
        return true
    }
    return false
};
FastClick.prototype.onTouchMove = function(event) {
    if (!this.trackingClick) {
        return true
    }
    if (this.targetElement !== this.getTargetElementFromEventTarget(event.target) || this.touchHasMoved(event)) {
        this.trackingClick = false;
        this.targetElement = null
    }
    return true
};
FastClick.prototype.findControl = function(labelElement) {
    if (labelElement.control !== undefined) {
        return labelElement.control
    }
    if (labelElement.htmlFor) {
        return document.getElementById(labelElement.htmlFor)
    }
    return labelElement.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
};
FastClick.prototype.onTouchEnd = function(event) {
    var forElement, trackingClickStart, targetTagName, scrollParent, touch, targetElement = this.targetElement;
    if (!this.trackingClick) {
        return true
    }
    if (event.timeStamp - this.lastClickTime < this.tapDelay) {
        this.cancelNextClick = true;
        return true
    }
    this.cancelNextClick = false;
    this.lastClickTime = event.timeStamp;
    trackingClickStart = this.trackingClickStart;
    this.trackingClick = false;
    this.trackingClickStart = 0;
    if (deviceIsIOSWithBadTarget) {
        touch = event.changedTouches[0];
        targetElement = document.elementFromPoint(touch.pageX - window.pageXOffset, touch.pageY - window.pageYOffset) || targetElement;
        targetElement.fastClickScrollParent = this.targetElement.fastClickScrollParent
    }
    targetTagName = targetElement.tagName.toLowerCase();
    if (targetTagName === "label") {
        forElement = this.findControl(targetElement);
        if (forElement) {
            this.focus(targetElement);
            if (deviceIsAndroid) {
                return false
            }
            targetElement = forElement
        }
    } else if (this.needsFocus(targetElement)) {
        if (event.timeStamp - trackingClickStart > 100 || deviceIsIOS && window.top !== window && targetTagName === "input") {
            this.targetElement = null;
            return false
        }
        this.focus(targetElement);
        this.sendClick(targetElement, event);
        if (!deviceIsIOS || targetTagName !== "select") {
            this.targetElement = null;
            event.preventDefault()
        }
        return false
    }
    if (deviceIsIOS && !deviceIsIOS4) {
        scrollParent = targetElement.fastClickScrollParent;
        if (scrollParent && scrollParent.fastClickLastScrollTop !== scrollParent.scrollTop) {
            return true
        }
    }
    if (!this.needsClick(targetElement)) {
        event.preventDefault();
        this.sendClick(targetElement, event)
    }
    return false
};
FastClick.prototype.onTouchCancel = function() {
    this.trackingClick = false;
    this.targetElement = null
};
FastClick.prototype.onMouse = function(event) {
    if (!this.targetElement) {
        return true
    }
    if (event.forwardedTouchEvent) {
        return true
    }
    if (!event.cancelable) {
        return true
    }
    if (!this.needsClick(this.targetElement) || this.cancelNextClick) {
        if (event.stopImmediatePropagation) {
            event.stopImmediatePropagation()
        } else {
            event.propagationStopped = true
        }
        event.stopPropagation();
        event.preventDefault();
        return false
    }
    return true
};
FastClick.prototype.onClick = function(event) {
    var permitted;
    if (this.trackingClick) {
        this.targetElement = null;
        this.trackingClick = false;
        return true
    }
    if (event.target.type === "submit" && event.detail === 0) {
        return true
    }
    permitted = this.onMouse(event);
    if (!permitted) {
        this.targetElement = null
    }
    return permitted
};
FastClick.prototype.destroy = function() {
    var layer = this.layer;
    if (deviceIsAndroid) {
        layer.removeEventListener("mouseover", this.onMouse, true);
        layer.removeEventListener("mousedown", this.onMouse, true);
        layer.removeEventListener("mouseup", this.onMouse, true)
    }
    layer.removeEventListener("click", this.onClick, true);
    layer.removeEventListener("touchstart", this.onTouchStart, false);
    layer.removeEventListener("touchmove", this.onTouchMove, false);
    layer.removeEventListener("touchend", this.onTouchEnd, false);
    layer.removeEventListener("touchcancel", this.onTouchCancel, false)
};
FastClick.notNeeded = function(layer) {
    var metaViewport;
    var chromeVersion;
    var blackberryVersion;
    if (typeof window.ontouchstart === "undefined") {
        return true
    }
    chromeVersion = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1];
    if (chromeVersion) {
        if (deviceIsAndroid) {
            metaViewport = document.querySelector("meta[name=viewport]");
            if (metaViewport) {
                if (metaViewport.content.indexOf("user-scalable=no") !== -1) {
                    return true
                }
                if (chromeVersion > 31 && document.documentElement.scrollWidth <= window.outerWidth) {
                    return true
                }
            }
        } else {
            return true
        }
    }
    if (deviceIsBlackBerry10) {
        blackberryVersion = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/);
        if (blackberryVersion[1] >= 10 && blackberryVersion[2] >= 3) {
            metaViewport = document.querySelector("meta[name=viewport]");
            if (metaViewport) {
                if (metaViewport.content.indexOf("user-scalable=no") !== -1) {
                    return true
                }
                if (document.documentElement.scrollWidth <= window.outerWidth) {
                    return true
                }
            }
        }
    }
    if (layer.style.msTouchAction === "none") {
        return true
    }
    return false
};
FastClick.attach = function(layer, options) {
    return new FastClick(layer, options)
};

 window.FastClick = FastClick;

(function(FastClick,$,window) {
    FastClick.attach(window.document.body);
	/*window.addEventListener('load', function() {
		 FastClick.attach(document.body);
	}, false);*/
    function slideX(node, duration, width, left, clickable) {
        this._eleX = 0;
        this._index = 0;
        this._length = node.children("li").length;
        this._main = node;
        this._startX = 0;
        this._startY = 0;
        this._duration = duration;
        this._width = width;
        this._left = left;
        this._clickable = clickable;
        this._img = node.find("li img");
        $(".total_img").text(this._length)
    }
    slideX.prototype = {
        _bindEvents: function() {
            var _this = this;
            this._main.bind("touchstart",
            function(e) {
                _this._touchStart(e, _this)
            });
            this._main.bind("touchmove",
            function(e) {
                _this._touchMove(e, _this)
            });
            this._main.bind("touchend",
            function(e) {
                _this._touchEnd(e, _this)
            })
        },
        _setBigImage: function() {
            if (this._main.length > 0) {
                $(".bigimg_box ul").html(this._main.html().replace(/small/g, "big").replace(/220/g, 300).replace(/155/g, 415))
            }
            if ($(".image_area_new ul").length > 0) {
                $(".bigimg_box ul").html($(".image_area_new ul").html());
                $(".bigimg_box img").each(function(index, elem) {
                    $(elem).parent().removeAttr("style").css("width", $(window).width());
                    $(elem).removeAttr("style");
                    $(elem).css("max-width", $(window).width());
                    $(elem).css("height", "auto")
                })
            }
        },
        _click: function() {
            this._setBigImage();
            var bigimage = slideX.bind($(".bigimg_box ul"), "300ms", 320, 0, false);
            if (this._clickable) {
                var img = $(this._img.get(this._index));
                this._showImage(this._index);
                var width = parseInt($(".image_area_w").css("width"));
                $(".bigimg_box ul").css("-webkit-transform", "translateX(-" + this._index * width + "px)");
                if (typeof bigimage !== "undefined") {
                    bigimage._index = this._index;
                    bigimage._showImage(this._index);
                    bigimage._showImage(this._index + 1);
                    $(".curr_img").text(this._index + 1)
                }
                $("#viewBigImagebg").css("height", document.body.offsetHeight + 50 + "px");
                $("#viewBigImagebg, #viewBigImage").show()
            }
        },
        _showImage: function(index) {
            var img = $(this._img.get(index));
            var ref = img.attr("ref");
            if (ref) {
                if ($(".image_area_new").length > 0 && ($("#viewBigImage").css("display") == "none" || $("#viewBigImage").length == 0)) {
                    this._adjust(img, ref)
                } else {
                    img.attr("src", ref);
                    img.removeAttr("ref")
                }
            }
        },
        _adjust: function(elem, src) {
            var w = $(window).width();
            var h = w / 2;
            $(elem).parent().css({
                width: w + "px",
                height: h + "px"
            });
            var img = new Image;
            img.src = src;
            img.onload = function() {
                var RATIO = 1 / 2;
                var elemWidth = img.width;
                var elemHeight = img.height;
                var containerWidth = $(window).width();
                var containerHeight = containerWidth * RATIO;
                if (elemWidth > containerWidth) {
                    $(elem).css({
                        //width: "100%",
						height:"100%",
                        position: "relative",
                        left: "0"
                    })
                }
                if (elemHeight > containerHeight) {
                    if (elemWidth > containerWidth) {
                        elemHeight = parseInt(elemHeight * containerWidth / elemWidth)
                    }
                    //$(elem).css("top", -Math.abs(elemHeight - containerHeight) / 2 + "px")
                }
                $(elem).attr("src", src);
                $(elem).removeAttr("ref")
            }
        },
        _moveTo: function(x) {
            this._main.css({
                "-webkit-transform": "translateX(" + x + "px)"
            })
        },
        _touchStart: function(e, _this) {
            e.stopPropagation();
			typeof(e.targetTouches) == 'undefined' && (e = e.originalEvent);
            var finger0 = e.targetTouches[0];
            _this._startX = finger0.pageX;
            _this._startY = finger0.pageY;
            var transform = _this._main.css("-webkit-transform");
            var pattern = /\(|, {0,}|\)/;
            _this._eleX = transform.indexOf("translate") >= 0 ? +transform.split(pattern)[1].replace("px", "") : +transform.split(pattern)[5]
        },
        _touchMove: function(e, _this) {
            e.stopPropagation();
			typeof(e.targetTouches) == 'undefined' && (e = e.originalEvent);
            var finger0 = e.targetTouches[0];
            var endX = finger0.pageX;
            var offsetX = endX - _this._startX + _this._eleX;
            _this._main.css("-webkit-transition", "0");
            _this._moveTo(offsetX);
            if (Math.abs(endX - _this._startX) > 5) {
                e.preventDefault()
            }
        },
        _touchEnd: function(e, _this) {
			typeof(e.targetTouches) == 'undefined' && (e = e.originalEvent);
            var finger0 = e.changedTouches[0];
            var endX = finger0.pageX;
            var offsetX = endX - _this._startX;
            var offsetY = finger0.pageY - _this._startY;
            if (Math.abs(offsetY) <= 5 && Math.abs(offsetX) <= 5) {
                _this._click() 
            } else if (Math.abs(offsetX) > 5) {
                var index = offsetX > 0 ? --_this._index: ++_this._index;
                if (index < 0) {
                    index = 0;
                    _this._index = 0
                }
                if (index >= _this._length) {
                    index = _this._length - 1;
                    _this._index = _this._length - 1
                }
                _this._showImage(index);
                _this._showImage(index + 1);
                this._main.parent().parent().find(".curr_img").text(index + 1);
                _this._main.css("-webkit-transition", "150ms");
                if ($(".image_area_new").length) {
                    var _width = parseInt($(".image_area_new").css("width"));
                    _this._moveTo( - index * _width)
                } else {
                    _this._moveTo( - index * _this._width + _this._left)
                }
            }
        },
        init: function() {
            this._bindEvents();
            this._showImage(0);
            this._showImage(1)
        }
    };
    slideX.bind = function(node, duration, width, left, clickable) {
        var obj = new slideX(node, duration, width, left, clickable);
        obj.init();
        window.onresize = function() {
            if ($("#viewBigImage").css("display") == "block") {
                obj._index = $("#viewBigImage .curr_img").text() - 1;
                $(".image_area_new .curr_img").text(obj._index + 1);
                index = obj._index;
                $(".bigimg_box img").each(function(index, elem) {
                    $(elem).parent("li").css("width", $(window).width());
                    $(elem).removeAttr("style");
                    $(elem).css("max-width", $(window).width());
                    $(elem).css("height", "auto")
                });
                $(".bigimg_box ul").css({
                    "-webkit-transform": "translateX(" + index * -$(window).width() + "px)"
                })
            } else {
                index = $(".image_area_new .curr_img").text() - 1;
                obj._index = index;
                $(".image_area_new ul").css({
                    "-webkit-transform": "translateX(" + index * -$(window).width() + "px)"
                })
            }
        };
        return obj
    };
	window.slide_X=slideX;
    return slideX
})(FastClick || window.FastClick,jQuery,window);

	if ($(".image_area").length > 0) {
        slide_X.bind($(".image_area ul"), "300ms", 230, 50, true)
    }
    $(".btn_back").bind("click",
    function(e) {
        $("#viewBigImagebg, #viewBigImage").hide();
    });
 if ($(".image_area_new").length) {
      $(".image_area_new").append('<div class="imgNum"><span class="curr_img">1</span>/' + $(".image_area li").length + "</div>")
  }

/*(function(window,$) {
    function Slide(ele) {
        this.bg = $("#pp_slide");
        this.startX = 0;
        this.eleX = 0;
        this.wid = ele.wid;
        this.startp = 0;
        this.transform;
        this.touch;
        this.moveX = 0;
        this.winwid = $(window).width();
        this.marginw = (this.winwid - this.wid) / 2;
        this.imgw = this.wid * this.bg.find("li").length
    }
    Slide.prototype = {
        init: function() {
            var _this = this;
            this.bg.bind("touchstart",
            function(e) {
                _this.movestart(e, _this)
            });
            this.bg.bind("touchmove",
            function(e) {
                _this.moving(e, _this)
            });
            this.bg.bind("touchend",
            function(e) {
                _this.moveEnd(e, _this)
            })
        },
        movestart: function(e, _this) {
            e.stopPropagation();
            _this.touch = e.targetTouches[0];
            _this.startX = Number(_this.touch.pageX);
            _this.startY = Number(_this.touch.pageY);
            var transform = _this.bg.css("-webkit-transform");
            _this.startp = transform;
            var pattern = /\(|, {0,}|\)/;
            _this.eleX = transform.indexOf("translate") >= 0 ? +transform.split(pattern)[1].replace("px", "") : +transform.split(pattern)[5]
        },
        moving: function(e, _this) {
            e.stopPropagation();
            _this.touch = e.targetTouches[0];
            var x = Number(_this.touch.pageX);
            var y = Number(_this.touch.pageY);
            _this.moveX = x - _this.startX + _this.eleX;
            if (Math.abs(y - _this.startY) > 5) {
                return true
            }
            _this.bg.css({
                "-webkit-transform": "translate3d(" + _this.moveX + "px,0,0)"
            });
            if (Math.abs(x - _this.startX) > 5) {
                e.preventDefault()
            }
        },
        moveEnd: function(e, _this) {
            _this.touch = e.changedTouches[0];
            var x = Number(_this.touch.pageX);
            var y = Number(_this.touch.pageY);
            var move = x - _this.startX;
            var movey = Math.abs(y - _this.startY);
            var pattern = /\(|, {0,}|\)/;
            if (_this.startp.split(pattern)[5] == 0) _this.moveX = 0;
            else {
                _this.moveX = _this.startp.indexOf("translate3d") >= 0 ? +_this.startp.split(pattern)[1].replace("px", "") : +_this.startp.split(pattern)[5]
            }
            if (Math.abs(move) > 5) {
                if (move > 5) {
                    if (_this.moveX == 0 || _this.moveX < _this.winwid && _this.moveX > 0) {
                        _this.moveX = 0
                    } else {
                        _this.moveX += _this.wid
                    }
                } else if (move < -5) {
                    if (Math.abs(_this.moveX) >= _this.imgw - _this.wid * 3) {
                        _this.moveX = -(_this.imgw - _this.wid * 3)
                    } else {
                        _this.moveX -= _this.wid
                    }
                }
                if (this.bg.find("li").length <= 3) {
                    _this.moveX = 0
                }
                _this.bg.css({
                    "-webkit-transform": "translate3d(" + _this.moveX + "px,0,0)"
                })
            }
        }
    };
    $(function() {
        if ($("#pp_slide").length > 0) {
            var slide = new Slide({
                wid: 89
            });
            slide.init()
        }
    })
})(window,jQuery);*/

