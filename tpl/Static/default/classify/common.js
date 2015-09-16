(function(window,$) {
    var img_smalls = $("#img_smalls"),
    img1 = $("#img1");
    var conf = {
        showPicCnt: 4,
        tinyPicOutWidth: 51,
        tinyTo: "small"
    };
        var _picCount = img_smalls.find("li").length,
        picWidth = conf["tinyPicOutWidth"],
        showPicCnt = conf["showPicCnt"],
        ulWidth = conf["tinyPicOutWidth"] * showPicCnt,
        clk_pic_type = conf["tinyTo"];
		var firstImgUrl=$("#img_smalls li:first").addClass('hover').find('img').attr('src');
		 img1.attr("src", firstImgUrl);
        img_smalls.find("img").click(function() {
            img1.attr("src", this.src.replace("tiny", clk_pic_type));
        });
        img_smalls.css("width", _picCount * picWidth);
        $("#img_scrollLeft").click(function() {
            var currentPosition = $("#img_smalls").position().left;
            if (currentPosition < 0 && !$("#img_smalls").is(":animated")) {
                $("#img_smalls").animate({
                    left: "+=" + ulWidth + "px"
                })
            }
        });
        $("#img_scrollRight").click(function() {
            if (_picCount > showPicCnt) {
                var maxPosition = -((Math.ceil(_picCount / showPicCnt) - 1) * ulWidth);
                var currentPosition = img_smalls.position().left;
                if (currentPosition > maxPosition && !img_smalls.is(":animated")) {
                    img_smalls.animate({
                        left: "-=" + ulWidth + "px"
                    })
                }
            }
        });
        $(".g_thumb ul > li").click(function() {
            $(this).addClass("hover").siblings().removeClass("hover")
        })
})(window,jQuery);

$("#addFavBtn").click(function() {
	toAddFavorite(location.href,'my-Favorite-Classify');
})
function toAddFavorite(sURL, sTitle) {
	try {
		window.external.addFavorite(sURL, sTitle)
	} catch(e) {
		try {
			window.sidebar.addPanel(sTitle, sURL, "")
		} catch(e) {
			alert("加入收藏失败，请使用Ctrl+D进行添加")
		}
	}
}