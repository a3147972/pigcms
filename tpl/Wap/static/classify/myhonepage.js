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
function getWidth() {
    return $(window).width()
}
var w = getWidth();
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
                    "-webkit-transition": "250ms ease",
                    "-webkit-transform": "translate3d(-" + w * (1 + index) + "px,0,0)"
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
                        "-webkit-transition": "0",
                        "-webkit-transform": "translate3d(0px,0,0)"
                    })
                },
                250);
                index = 0
            } else {
                $(".pc_banner ul").css({
                    "-webkit-transition": "250ms ease",
                    "-webkit-transform": "translate3d(-" + w * (1 + index) + "px,0,0)"
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
                "-webkit-transition": "0"
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
                    "-webkit-transform": "translate3d(" + offset + "px,0,0)"
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
                "-webkit-transition": "250ms ease",
                "-webkit-transform": "translate3d(" + offset + "px,0,0)"
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
                    "-webkit-transition": "0",
                    "-webkit-transform": "translate3d(-" + index * w + "px,0,0)"
                })
            },
            250);
            lbTimer = setInterval(lunbo, 3e3);
            $(".banner_icon i").removeClass("active");
            $(".banner_icon i").eq(index).addClass("active")
        })
    }
});
$(function() {
    var GetUrl = "http://" + location.hostname + "/wap.php?g=Wap&c=Classify&a=get_Classify";
    var key_arr = [];
    var key_url_arr = [];
    var souFloatDis = false;
    var cityid = "";
    var cateid = "";
    var citylist = "";
    var catelist = "";
    var catename = "";
    var keyfrom = "";
    function tabDataSave() {
        var conTop = document.body.clientHeight + "px";
        $(".search_container").css({
            display: "block",
            height: conTop,
            top: "0px"
        });
        if ($(".bban").length && $(".bban").css("display") == "block") {
            $(".bban").hide();
            souFloatDis = true
        }
        $(".search_ajax").html("");
        $("#keyWords1").val("");
        var inputValue = "";
        if ($("#searchUrl").html() != "" && $("#searchUrl").html() != "请输入关键词") {
            inputValue = $("#searchUrl").html();
            $(".no_search").show();
            $("#keyWords1").attr("placeholder", inputValue)
        } else {
            inputValue = "搜索关键词";
            $(".no_search").show();
            $("#keyWords1").attr("placeholder", inputValue);
            if ($("#delBtn").length) {
                $("#delBtn").remove()
            }
        }
        if ($("#keyWords1").length) {
            $("#keyWords1").get(0).focus()
        }
    }
    function TipWindow(containerID, keywordID, tipvalue) {
        this.containerID = containerID;
        this.keywordID = keywordID;
        this.cacheinputvalue = {};
        this.tipvalue = tipvalue;
        this.clear = function(im) {
            $(".s_suggest").hide();
            $(im).hide();
            $("." + this.containerID).hide();
            $("#" + this.keywordID).get(0).focus();
            $("#" + this.keywordID).val(" ");
            $(".ico_clear").hide()
        };
        if ($(".nav").length) {
            $("#searchUrl").css({
                height: "34px",
                "line-height": "34px"
            })
        } else {
            $("#searchUrl").css({
                height: "33px",
                "line-height": "33px"
            })
        }
        $("#searchUrl").bind("click", tabDataSave);
        $(".search_but").bind("click", tabDataSave);
        this.close = function() {
            if ($("#" + this.keywordID).val() == "") {
                $("#" + this.keywordID).val(this.oldvalue);
                if (this.oldvalue == this.tipvalue) {
                    $("#" + this.keywordID).css("color", "#333");
                    $("#" + this.keywordID).css("fontSize", "12px");
                    $("#" + this.keywordID).css("font-weight", "normal")
                }
            }
            $("." + this.containerID).hide()
        };
        this.cancel = function() {
            $(".search_container").css("display", "none");
            $(".search_ajax").html("");
            if ($(".bban").length && souFloatDis == true) {
                $(".bban").show()
            }
            $("#keyWords1").val("");
            showHis = false
        };
        this.getData = function(e) {
            showHis = true;
            var v = $("#" + this.keywordID).val();
            if (trim(v).length == 0) {
                if (document.getElementById("delBtn")) {
                    $("#delBtn").remove()
                }
            } else {
                if (!document.getElementById("delBtn")) {
                    var eleDiv = document.createElement("div");
                    var eleInput = document.getElementById(this.keywordID);
                    insertAfter(eleDiv, eleInput);
                    $(eleDiv).attr({
                        "class": "delBtn",
                        id: "delBtn",
                        onClick: "win.delEvent(this)"
                    })
                }
            }
            if (v.length == 1 && v == " " || v == "") {
                $("." + this.containerID).hide();
                $(".ico_clear").hide()
            } else {
                var data = this.cacheinputvalue[v];
                if (data != null && data != undefined) {
                    this.creat(v)
                } else {
                    $.getJSON(GetUrl, {
                        kstr: v
                    },
                    function(ret) {
                        win.cacheinputvalue[v] = ret.data;
                        win.creat(v)
                    })
                }
            }
        };
        this.creat = function(nkey) {
		     var dataarr = this.cacheinputvalue[nkey];
            $("." + this.containerID).html("").hide();
            $(".no_search").hide();
            var showHtml = "<ul id='search_mes'>";
			  if (dataarr && dataarr.length) {
                var i = 0;
                var j = 1;
                for (i = 0; i < dataarr.length; i++) {
                    if (!dataarr[i]) {
                        continue
                    }
                    if (j > 20) {
                        break
                    }
                    var liStr = dataarr[i];
                    showHtml += "<li><a href='"+liStr.url+"'><span class='search_wd'>"+liStr.cat_name.replace(nkey,'<span class="searchFont">'+nkey+'</span>')+"</span><span>" + liStr.tt + "条</span></a></li>";
                    j++
                }
                showHtml += "</ul>";
                $("." + this.containerID).html(showHtml);
                $("." + this.containerID).show();
            }
		};
        var showHis = false;
        this.focus = function() {
            $("#" + this.keywordID).css("color", "#374565");
            $("#" + this.keywordID).css("fontSize", "17px");
            var v = $("#" + this.keywordID).val();
            if ($(".search_icon").length > 0) {
                $(".search_icon").hide();
                $("#" + this.keywordID).css("text-indent", "5px")
            }
            $(".ico_clear").show()
        };
        this.blur = function(e) {};
        this.delEvent = function(obj) {
            pre(obj).value = "";
            pre(obj).focus();
            obj.parentNode.removeChild(obj);
            $("." + this.containerID).hide();
            if (catelist == "sou") {
                $(".no_search").show()
            }
        }
    }
    function trim(str) {
        return str.replace(/^(\s|\u00A0)+/, "").replace(/(\s|\u00A0)+$/, "")
    }
    function insertAfter(newElement, targetElement) {
        var parent = targetElement.parentNode;
        if (parent.lastChild == targetElement) {
            parent.appendChild(newElement)
        } else {
            parent.insertBefore(newElement, targetElement.nextSibling)
        }
    }
    function pre(obj) {
        return obj.previousElementSibling || obj.previousSibling
    }
    window.win = new TipWindow("search_ajax", "keyWords1", "找不到？搜搜看吧")
});
