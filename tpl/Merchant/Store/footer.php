	<div id="orderAlert" style="position: fixed; z-index: 999999; bottom: 5px; right: 5px; background: #e5e5e5; display: none;">
		<div style="text-align: center; margin-top: 10px; font-size: 20px; color: red;">
			<b>新订单来啦!</b> <a class="oaright" href="javascript:closeoa()">[关闭]</a>
		</div>
		<div style="margin: 20px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！
		</div>
		<div style="margin: 5px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理
		</div>
		<div class="oaright" style="bottom: 10px; margin: 5px 30px 5px 30px;">
			时间：<a id="oatime" style="text-decoration: none;"></a>
		</div>
	</div>
	<div style="position: fixed; top: -9999px; right: -9999px; display: none;" id="soundsw"></div>
	<a href="http://www.lewaimai.com/shop/index.html#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> 
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
</div>

<script>
function newalert(title){
	bootbox.dialog({
		message: title, 
		buttons: {
			"success" : {
				"label" : "确认",
				"className" : "btn-sm btn-primary"
			}
		}
	});
}

function alertshow(content){
	$('#popalertwindowcontent').html(content);
	$('#popalertwindow').show();
}
$(function(){
	//showalert();
	//window.setInterval(showalert, 30000);
})

function closeoa(){
	$("#orderAlert").slideUp();
	stopFlash();
}

function tourl(){
	location.href="/order/viewopen.html";
}

function showalert() {
	var initTime = "1415322576";
	var url = "/order/getneworder.html?initTime=1415322576";
	$.get(url,function(data){
		var list = data.split(":::");
		$("#oantnum").html(list[1]);
		if(list[0] > 0){
			var nowDate = new Date();
			var str = nowDate.getFullYear()+"-"+(nowDate.getMonth() + 1)+"-"+nowDate.getDate()+" "+nowDate.getHours()+":"+nowDate.getMinutes()+":"+nowDate.getSeconds();
			$("#oanum").html(list[0]);
			$("#oatnum,.oatnum").html(list[1]);
			$("#oatime").html(str);
			$("#orderAlert").slideUp();
			$("#orderAlert").slideDown();
			$("#soundsw").show(1000,function(){
				$("#soundsw").html('<embed src="/music/dingdong.wav" loop="0" autostart="true"></embed>');
				$("#soundsw").hide();
			});
			flashTitle("您有"+list[0]+"笔新订单");
		}
	});
}

var flashTitlePlayer = {
    start: function (msg) {
        this.title = document.title;
        if (!this.action) {
            try {
                this.element = document.getElementsByTagName('title')[0];
                this.element.innerHTML = this.title;
                this.action = function (ttl) {
                    this.element.innerHTML = ttl;
                };
            } catch (e) {
                this.action = function (ttl) {
                    document.title = ttl;
                }
                delete this.element;
            }
            this.toggleTitle = function () {
                this.action('【' + this.messages[this.index = this.index == 0 ? 1 : 0] + '】乐外卖');
            };
        }
        this.messages = [msg];
        var n = msg.length;
        var s = '';
        if (this.element) {
            var num = msg.match(/\w/g);
            if (num != null) {
                var n2 = num.length;
                n -= n2;
                while (n2 > 0) {
                    s += " ";
                    n2--;
                }
            }
        }
        while (n > 0) {
            s += '　';
            n--;
        };
        this.messages.push(s);
        this.index = 0;
        this.timer = setInterval(function () {
            flashTitlePlayer.toggleTitle();
        }, 2000);
    },
    stop: function () {
        if (this.timer) {
            clearInterval(this.timer);
            this.action(this.title);
            delete this.timer;
            delete this.messages;
        }
    }
};
function flashTitle(msg) {
    flashTitlePlayer.start(msg);
}
function stopFlash() {
    flashTitlePlayer.stop();
}
</script>

<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; display: none;" id="popalertwindow">
	<div style="width: 100%; height: 100%; background: #eeeeee; filter: alpha(opacity = 50); -moz-opacity: 0.5; -khtml-opacity: 0.5; opacity: 0.5; position: absolute; z-index: 9999;"></div>
	<div style="position: relative; width: 500px; height: 200px; margin: 200px auto; filter: alpha(opacity = 100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; z-index: 10000; background: #ffffff; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #666 0px 0px 10px; -moz-box-shadow: #666 0px 0px 10px; box-shadow: #666 0px 0px 10px;">
		<div style="height: 40px;"></div>
		<div style="width: 400px; height: 90px; margin: 0px auto; color: #999999; text-align: center; font-size: 20px;">
			<table style="width: 400px; height: 90px;">
				<tbody>
					<tr>
						<td id="popalertwindowcontent"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="height: 20px;"></div>
		<div style="width: 80px; height: 40px; background: #eeeeee; margin: 0 auto; line-height: 40px; text-align: center; font-size: 20px; border: 1px solid #999999; cursor: pointer;" onclick="$(&#39;#popalertwindow&#39;).hide();">确认</div>
	</div>
</div>
</body>
</html>