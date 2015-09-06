function alertShow(meg, but_num, but_left, but_right, left_fn, right_fn) {
    if (!$("#alert_bg").length) {
        var alertHtml = "<div id='alert_bg' style=\" width: 100%; position: absolute; top:0px; left: 0px; z-index: 1000; background: rgba(0, 0, 0, 0.1)\"></div>" + '<div id="alert_box">' + '<div id="show_mes">信息</div>' + '<div id="but_div">' + "</div></div>";
        $("body").append(alertHtml);
        var body_height = $(document.body).css("height");
        $("#alert_bg").css("height", body_height)
    } else {
        $("#but_div").empty()
    }
    $("#show_mes").html(meg);
    if (but_num == "1") {
        $("#but_div").show();
        var lebut = '<div id="but01">' + but_left + "</div>";
        $("#but_div").append(lebut);
        $("#but01").css("width", "100%");
        $("#but01").bind("click",
        function() {
            left_fn()
        })
    }
    if (but_num == "2") {
        $("#but_div").show();
        var ttbut = '<div id="but01">' + but_left + '</div><div id="but02">' + but_right + "</div>";
        $("#but_div").append(ttbut);
        $("#but01").bind("click",
        function() {
            left_fn()
        });
        $("#but02").bind("click",
        function() {
            right_fn()
        })
    }
    if (typeof but_num == "undefined") {
        $("#but_div").hide()
    }
    $("#alert_bg").show();
    $("#alert_box").show();
    var y = parseInt($("#alert_box").get().clientHeight) / 2;
    $("#alert_box").css("margin-top", -y + "px");
    $("#but_div > div").bind("touchstart",
    function() {
        $(this).addClass("but_hover")
    });
    $("#but_div > div").bind("touchmove",
    function() {
        $(this).removeClass("but_hover")
    });
    $("#but_div > div").bind("touchend",
    function() {
        $(this).removeClass("but_hover")
    });
    $("#alert_bg").bind("touchmove",
    function(e) {
        e.preventDefault()
    });
    $("#alert_box").bind("touchmove",
    function(e) {
        e.preventDefault()
    })
}

function cancel_but() {
    $("#alert_bg").hide();
    $("#alert_box").hide()
}
function ImgUpload(cfg) {
    var _this = this;
    var _default = {
        url: '',
        fileInput: null,
        container: null,
        maxNum: 8,
        countNum: null,
        scale: 5,
        name: "img",
        progressfn: function(ev) {
            var sTemp = parseInt(ev.loaded / ev.total * 100) + "%"
        },
        success: function(data, index) {
            if (data.code === 1) {
                $("#imgShow" + index).removeClass("loading_item");
                $("#imgShow" + index).css({
                    background: "url(" + data.url + ") center center",
                    "background-size": "cover"
                });
                $("#imgShow" + index).find("img").attr("src", data.url).attr("url", data.url);
				$("#imgShow" + index).find("input").val(data.imgurl);
                _this.getItemCount()
            } else {
                alertShow(data.msg, 1, "关闭", "", cancel_but);
                $("#imgShow" + index).remove();
                _this.getItemCount()
            }
        },
        error: function(index) {
            alertShow("请求失败", 1, "关闭", "", cancel_but);
            $("#imgShow" + index).remove();
            _this.getItemCount()
        },
        timeoutfn: function(index) {
            alertShow("上传失败，请检查网络环境或压缩图片容量后上传", 1, "关闭", "", cancel_but);
            $("#imgShow" + index).remove();
            _this.getItemCount()
        },
        errFn: function(err) {
            alertShow(err, 1, "关闭", "", cancel_but)
        }
    };
    this.opt = $.extend({},
    _default, cfg);
    this.init()
}
ImgUpload.prototype = {
    constructor: ImgUpload,
    liIndex: 0,
    init: function() {
        var _this = this;
        _this.getItemCount();
        $(_this.opt.fileInput).on("change",
        function() {
            var _tar = this.files ? this.files: null;
            if (!_tar) {
                return false
            }
            var rReg = /\.(jpg)|(jpeg)|(gif)|(png)$/i;
            var maxSize = 20 * 1024 * 1024;
            var err = "";
            var file = _tar[0];
            if (file.size > maxSize) {
                err = "图片超过尺寸限制！"
            } else if (!rReg.test(file.name)) {
                err = "请上传 jpg/jpeg/gif/png格式的图片！"
            }
            if (err) {
                _this.opt.errFn && _this.opt.errFn(err);
                return false
            }
            _this.liIndex += 1;
            var loadingStr = '<li class="upload_item loading_item" id="imgShow' + _this.liIndex + '">' + '<a href="javascript:void(0);" class="upload_delete" title="删除"></a>' + '<img src="" class="upload_image loading_img" /><input type="hidden" name="inputimg[]" value=""><br>' + "</li>";
            $(_this.opt.container).prepend(loadingStr);
            getItemSize();
            _this.getItemCount();
            _this.zipImg({
                files: _tar,
                scale: _this.opt.scale,
                callback: function(tar) {
                    if (tar.constructor != Array) {
                        tar = [tar]
                    }
                    _this.submit(tar, _this.liIndex)
                }
            })
        });
        function getItemSize() {
            var uploadItem = $(".upload_item");
            var _width = uploadItem.css("width");
            uploadItem.css({
                height: _width
            })
        }
        $(window).bind("orientationchange",
        function() {
            getItemSize()
        });
        $(_this.opt.container).on("click", ".upload_delete",
        function() {
            var par = $(this).closest(".upload_item");
            par.remove();
            _this.getItemCount()
        })
    },
    zipImg: function(cfg) {
        var _this = this;
        var options = cfg; [].forEach.call(options.files,
        function(v, k) {
            var fr = new FileReader;
            fr.onload = function(e) {
                var oExif = EXIF.readFromBinaryFile(new BinaryFile(e.target.result)) || {};
                var $img = document.createElement("img");
                $img.onload = function() {
                    _this.fixDirect().fix($img, oExif, options.callback, options.scale)
                };
                $img.src = window.webkitURL.createObjectURL(v)
            };
            fr.readAsBinaryString(v)
        })
    },
    fixDirect: function() {
        var r = {};
        r.fix = function(img, a, callback, scale) {
            var n = img.naturalHeight,
            i = img.naturalWidth,
            c = 1024,
            o = document.createElement("canvas"),
            s = o.getContext("2d");
            a = a || {};
            if (n > c || i > c) {
                o.width = o.height = c
            } else {
                o.width = i;
                o.height = n
            }
            a.Orientation = a.Orientation || 1;
            r.detectSubSampling(img) && (i /= 2, n /= 2);
            var d, h;
            i > n ? (d = c, h = Math.ceil(n / i * c)) : (h = c, d = Math.ceil(i / n * c));
            var g = Math.max(o.width, o.height) / 2,
            l = document.createElement("canvas");
            if (n > c || i > c) {
                l.width = g,
                l.height = g
            } else {
                l.width = i;
                l.height = n;
                d = i;
                h = n
            }
            var m = l.getContext("2d"),
            u = r.detect(img, n) || 1;
            s.save();
            r.transformCoordinate(o, d, h, a.Orientation);
            var isUC = navigator.userAgent.match(/UCBrowser[\/]?([\d.]+)/i);
            if (isUC && $.os.android) {
                s.drawImage(img, 0, 0, d, h)
            } else {
                for (var f = g * d / i,
                w = g * h / n / u,
                I = 0,
                b = 0; n > I;) {
                    for (var x = 0,
                    C = 0; i > x;) m.clearRect(0, 0, g, g),
                    m.drawImage(img, -x, -I),
                    s.drawImage(l, 0, 0, g, g, C, b, f, w),
                    x += g,
                    C += f;
                    I += g,
                    b += w
                }
            }
            s.restore();
            a.Orientation = 1;
            img = document.createElement("img");
            img.onload = function() {
                a.PixelXDimension = img.width;
                a.PixelYDimension = img.height
            };
            callback && callback(o.toDataURL("image/jpeg", scale).substring(22))
        };
        r.detect = function(img, a) {
            var e = document.createElement("canvas");
            e.width = 1;
            e.height = a;
            var r = e.getContext("2d");
            r.drawImage(img, 0, 0);
            for (var n = r.getImageData(0, 0, 1, a).data, i = 0, c = a, o = a; o > i;) {
                var s = n[4 * (o - 1) + 3];
                0 === s ? c = o: i = o,
                o = c + i >> 1
            }
            var d = o / a;
            return 0 === d ? 1 : d
        };
        r.detectSubSampling = function(img) {
            var a = img.naturalWidth,
            e = img.naturalHeight;
            if (a * e > 1048576) {
                var r = document.createElement("canvas");
                r.width = r.height = 1;
                var n = r.getContext("2d");
                return n.drawImage(img, -a + 1, 0),
                0 === n.getImageData(0, 0, 1, 1).data[3]
            }
            return ! 1
        };
        r.transformCoordinate = function(img, a, e, r) {
            switch (r) {
            case 5:
            case 6:
            case 7:
            case 8:
                img.width = e,
                img.height = a;
                break;
            default:
                img.width = a,
                img.height = e
            }
            var n = img.getContext("2d");
            switch (r) {
            case 2:
                n.translate(a, 0),
                n.scale( - 1, 1);
                break;
            case 3:
                n.translate(a, e),
                n.rotate(Math.PI);
                break;
            case 4:
                n.translate(0, e),
                n.scale(1, -1);
                break;
            case 5:
                n.rotate(.5 * Math.PI),
                n.scale(1, -1);
                break;
            case 6:
                n.rotate(.5 * Math.PI),
                n.translate(0, -e);
                break;
            case 7:
                n.rotate(.5 * Math.PI),
                n.translate(a, -e),
                n.scale( - 1, 1);
                break;
            case 8:
                n.rotate( - .5 * Math.PI),
                n.translate( - a, 0)
            }
        };
        return r
    },
    getItemCount: function() {
        var _this = this;
        var uploadItem = $(_this.opt.container).find(".upload_item");
        var len = uploadItem.length;
        var uploadAction = $(_this.opt.container).find(".upload_action");
        if (len >= _this.opt.maxNum) {
            uploadAction.hide()
        } else {
            uploadAction.show()
        }
        if (len >= 0) {
            if ($(_this.opt.countNum).find(".leftNum")) $(_this.opt.countNum).find(".leftNum").text(_this.opt.maxNum - len);
            if ($(_this.opt.countNum).find(".loadedNum")) $(_this.opt.countNum).find(".loadedNum").text(len)
        }
    },
    submit: function(files, index) {
        var _this = this;
        var file = files[0];
        var paramObj = {
            PicPos: 1,
            filename: _this.opt.name
        };
        paramObj[_this.opt.name] = file;
        if (file == "") {
            alertShow("请升级浏览器或选择其他浏览器", 1, "关闭", "", cancel_but)
        } else {
            $.ajax({
                url: _this.opt.url + "&codetype=base64&random=" + Math.random(),
                type: "POST",
                data: paramObj,
                timeout: 4e4,
                error: function() {
                    _this.opt.error && _this.opt.error(index)
                },
                success: function(ret) {
                     ret = JSON.parse(ret);
					var imgdata=ret.data;
                    if (imgdata.imgurl && imgdata.imgurl.indexOf("jpg") != -1) {
                            imgdata.url =imgdata.siteurl+imgdata.imgurl;
                    }
                    _this.opt.success && _this.opt.success(imgdata, index)
                }
            })
        }
    }
};