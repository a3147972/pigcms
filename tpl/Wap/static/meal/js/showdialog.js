function popup(data,url){
	$('.layer').addClass("on");
	var leftN = (document.body.offsetWidth-$('.dialogX').width())/2;
	$('.layer.popup').css("left",""+leftN+"px");
	if(data!=undefined){
		showLayerData(data,url);
	}
	$('.layer').click(function(){
		//$('.layer').removeClass("on");						   
	})
}
function hidepopup(){
	$('.layer').removeClass("on");
}
function cancel(){
	hidepopup();
}
function showMessage(title,message,sureText,cancelText,sFn,cFn){
	popup();
	$(".dialogX .title").html(title);
	$(".dialogX .message").html(message);
	$(".dialogX .cancel").html(cancelText);
	$(".dialogX .sure").html(sureText);
	if(sFn!=null){
		$(".dialogX .sure").get(0).onclick=function(){sFn.call();};
	}
	if(cFn!=null){
		$(".dialogX .cancel").get(0).onclick=function(){cFn.call();};
	}
	
	
}
