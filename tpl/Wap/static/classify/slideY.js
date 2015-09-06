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
    $(function() {
        new FastClick(document.getElementById("filter"));
        new FastClick(document.getElementById("mask"));
        function listFilter() {
            this.wrap = $(".filter_outer");
            this.nav = $(".nav_filter");
            this.box = $(".f_box");
            this.mask = $("#mask");
            this._top = this.wrap.offset().top;
            this.filterID = "";
            this.filterDiv = null;
            this.isShow = false;
            this.cateArr = []
        }
        listFilter.prototype = {
            init: function() {
                var _this = this;
				this.docSwipe();
                this.mask.on("touchstart, touchmove",
                function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    return false
                });
                this.wrap.on("touchstart, touchmove",
                function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    return false
                });
                this.box.each(function() {
					 _this.conSwipe($(this));
                })
            },
            docSwipe: function() {
                var _this = this;
                var b = 0;
                var _scroll = $(window).scrollTop();
                var _curScroll = $(window).scrollTop();
                $(window).on("scroll",
                function() {
                    if (_this.isShow) return;
                    if ($(window).scrollTop() >= 43) {
						// console.log(_this._top);
						// console.log($(window).scrollTop());
                        if (b) return;
                        $("body").addClass("filter-fixed");
                        // _this.wrap.css({
                            // top: "-43px"
                        // });
                        // _this.wrap.animate({
                            // top: "0"
                        // },
                        // 300, "ease-out");
                        b = 1
                    } else {
						// console.log(_this._top);
						// console.log($(window).scrollTop());
                        b = 0;
                        $("body").removeClass("filter-fixed")
                    }
                })
            },
            conSwipe: function(obj) {
                var _this = this;
                var $ul = obj.find("ul");
                $ul.on("touchstart",
                function(e) {
					typeof(e.targetTouches) == 'undefined' && (e = e.originalEvent);
                    this.startY = e.targetTouches[0].screenY;
                    this.startTop = this.y || 0;
                    this.startTime = event.timeStamp;
                    this.moved = false;
                    this.wrapH = $(this).parents(".f_box_inner")[0].offsetHeight;
                    if (!this.maxScrollY) {
                        this.scrollerHeight = this.offsetHeight;
                        this.maxScrollY = this.wrapH - this.scrollerHeight + 1
                    }
                    this._height = this._height || $(this).parent().height() - $(this).find("li").height() * $(this).find("li").length + 1;
                    if (this.isInTransition) {
                        var matrix = window.getComputedStyle(this, null);
                        matrix = matrix["webkitTransform"].split(")")[0].split(", ");
                        this.y = matrix[13] || matrix[5];
                        this.y = Math.round(this.y);
                        this.startTop = Math.round(this.y);
                        $(this).css({
                            "-webkit-transform": "translate3d(0," + this.y + "px, 0)",
                            "-webkit-transition-duration": "0"
                        });
                        this.isInTransition = false
                    }
                });
                $ul.on("touchmove",
                function(e) {
                    e.preventDefault();
                    e.stopPropagation();
					typeof(e.targetTouches) == 'undefined' && (e = e.originalEvent);
                    this.moved = true;
                    this.y = e.targetTouches[0].screenY - this.startY + this.startTop;
                    if (this.y > 0 || this.y < this.maxScrollY) {
                        var newY = this.y - (e.targetTouches[0].screenY - this.startY) * 2 / 3;
                        this.y = this.y > 0 ? 0 : this.maxScrollY;
                        if (newY > 0 || newY < this.maxScrollY) {
                            this.y = newY
                        }
                    }
                    $(this).css({
                        "-webkit-transform": "translate3d(0," + this.y + "px, 0)",
                        "-webkit-transition-duration": "0"
                    });
                    this.isInTransition = false;
                    var timeStamp = event.timeStamp;
                    if (timeStamp - this.startTime > 300) {
                        this.startTime = timeStamp;
                        this.startY = e.targetTouches[0].screenY;
                        this.startTop = this.y
                    }
                });
                $ul.on("touchend",
                function(e) {
					typeof(e.changedTouches) == 'undefined' && (e = e.originalEvent);
                    var dist = e.changedTouches[0].screenY - this.startY;
                    this.endTime = event.timeStamp;
                    var duration = this.endTime - this.startTime;
                    if (this.moved) {
                        e.preventDefault();
                        e.stopPropagation();
                        var newY = Math.round(e.changedTouches[0].screenY);
                        this.isInTransition = true;
                        if (this.y > 0 || this.y < this.maxScrollY) {
                            _this.scrollTo(this, this.y, this.maxScrollY, 600);
                            return
                        }
                        if (duration < 300) {
                            var move = _this.calculateMoment(this.y, this.startTop, duration, this.maxScrollY, this.wrapH);
                            this.y = move.destination;
                            var time = move.duration;
                            $(this).css({
                                "-webkit-transform": "translate3d(0, " + this.y + "px, 0)",
                                "transition-timing-function": "cubic-bezier(0.1, 0.3, 0.5, 1)",
                                "-webkit-transition-duration": time + "ms"
                            })
                        }
                        return
                    }
                });
                $ul.on("transitionend",
                function() {
                    this.isInTransition = false;
                    _this.scrollTo(this, this.y, this.maxScrollY, 600)
                })
            },
            scrollTo: function(obj, y, maxY, time, sety) {
                if (y > 0 || maxY > 0) {
                    y = 0
                } else if (y < maxY) {
                    y = maxY
                } else if (sety != 0) {
                    this.y = 0;
                    y = sety
                }
                obj.isInTransition = true;
                $(obj).css({
                    "-webkit-transform": "translate3d(0, " + y + "px, 0)",
                    "transition-timing-function": "cubic-bezier(0.25, 0.46, 0.45, 0.94)",
                    "-webkit-transition-duration": time + "ms"
                })
            },
            calculateMoment: function(current, start, time, lowerMargin, wrapperSize) {
                var distance = current - start,
                speed = Math.abs(distance) / time,
                destination,
                duration;
                deceleration = 6e-4;
                destination = current + speed * speed / (2 * deceleration) * (distance < 0 ? -1 : 1);
                duration = speed / deceleration;
                if (destination < lowerMargin) {
                    destination = wrapperSize ? lowerMargin - wrapperSize / 2.5 * (speed / 8) : lowerMargin;
                    distance = Math.abs(destination - current);
                    duration = distance / speed
                } else if (destination > 0) {
                    destination = wrapperSize ? wrapperSize / 2.5 * (speed / 8) : 0;
                    distance = Math.abs(current) + destination;
                    duration = distance / speed
                }
                return {
                    destination: Math.round(destination),
                    duration: duration
                }
            },
            /*close: function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.mask.hide();
                this.box.addClass("hide");
                this.nav.find("li").removeClass("select");
                this.isShow = false;
                if ($(window).scrollTop() < this._top) {
                    $("body").removeClass("filter-fixed")
                }
            }*/
        };
        var filter = new listFilter;
        filter.init()
    })
})(FastClick || window.FastClick,jQuery,window);