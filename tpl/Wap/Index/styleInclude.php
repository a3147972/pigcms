<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js" type="text/javascript"></script>
<if condition="$radiogroup gt 8">
<br>
<br>
</if>
<script>
function displayit(n){
	for(i=0;i<4;i++){
		if(i==n){
			var id='menu_list'+n;
			if(document.getElementById(id).style.display=='none'){
				document.getElementById(id).style.display='';
				document.getElementById("plug-wrap").style.display='';
			}else{
				document.getElementById(id).style.display='none';
				document.getElementById("plug-wrap").style.display='none';
			}
		}else{
			if($('#menu_list'+i)){
				$('#menu_list'+i).css('display','none');
			}
		}
	}
}
function closeall(){
	var count = document.getElementById("top_menu").getElementsByTagName("ul").length;
	for(i=0;i<count;i++){
		document.getElementById("top_menu").getElementsByTagName("ul").item(i).style.display='none';
	}
	document.getElementById("plug-wrap").style.display='none';
}

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
	WeixinJSBridge.call('hideToolbar');
});
</script> 

<if condition="$invote_array">
<script>
	var html = '<div class="list" style="border-top: 1px solid #ddd8ce; border-bottom: 1px solid #ddd8ce;margin-bottom: 0; background-color: #fff;z-index:100000;"><a href="{pigcms{$invote_array.url}" style="color:#666;display:block;padding:.2rem;padding-bottom: 9px;">';
	html += '<img src="{pigcms{$invote_array.avatar}" style="width:40px;  vertical-align: middle;"/>{pigcms{$invote_array.txt}';
	html += '<button style="float:right;height:2.8rem;border:none;background-color:green;color:white;border-radius:5px;padding:0 1.2rem;">关注我们</button>';
	html += '</a></div>';
	$('body').prepend(html);
	$('#cate16 .mainmenu, #cate14 .mainmenu').css('top', '61px');
	if ($('body').attr('id')) {
		$('#wrapper').css('top','57px');
	}
</script>
</if>