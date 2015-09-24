$(document).ready(function(){
	$(".nav .more").click(function(){
		var offsetLeft = this.offsetLeft;
		var elm = $(">ul" ,$(this));		
		var lis =$(">ul >li" ,$(this));
		var h=lis.length*38+20;
		elm.css('height',''+(lis.length*44+20)+'px');	
		var bodywidth = $(window).width();
		var nn= $(".nav >ul >li").length;
		var nn_li_width =parseInt(bodywidth/nn);
		var elm_width =elm.width();
		if(nn_li_width>(elm_width+3)){
			elm.css('margin-left',''+(parseInt((nn_li_width-elm_width)/2))+'px');
		}
		else{
			if(offsetLeft==0){
				elm.css("margin-left","10px");
			}
			else if(offsetLeft>(bodywidth-nn_li_width-5)&offsetLeft<(bodywidth-nn_li_width+5))
			{
				elm.css("margin-left",""+(nn_li_width-elm_width-10)+"px");
			}
			else
			{
				elm.css('margin-left',''+(parseInt((nn_li_width-elm_width)/2))+'px');
			}
		}
		$(".adron" ,$(this)).css('margin-left',''+((nn_li_width-12)/2)+'px');
		$(".nav .more >ul").hide();
		$(".nav .adron").removeClass("on");	
		$(".adron" ,$(this)).addClass("on");	
		elm.show();
	});
	
});