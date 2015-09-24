/*
* 
*  DragList.js
*  @author fuweiyi <fuwy@foxmail.com>
*  
*/
(function($){
	$.fn.DragList=function(setting){
		var _setting = {
			frame : $(this),
			dgLine : 'DLL',
			dgButton : 'DLB',
			id : 'action-id',
			linePre : 'toplist_',
			lineHighlight : '#ffffcc',
			tipsOpacity : 80,
			tipsOffsetLeft : 20,
			tipsOffsetTop : 0,
			JSONUrl : '',
			JSONData : {},
			maskLoaddingIcon : '',
			maskBackgroundColor : '#999',
			maskOpacity : 30,
			maskColor : '#000',
			maskLoadIcon:'',
		};
		var setting = $.extend(_setting,setting); 

		var dgid='',thisIndex,thisLineTop=0,topDistance,downDistance;
		var tbodyHeight=setting.frame.outerHeight();
		var lineNum=$("."+setting.dgLine).length;
		var lineHeight=Math.ceil(tbodyHeight/lineNum);

		$("."+setting.dgButton).mousedown(function(e){
			dgid=$(this).attr(setting.id);
			thisIndex=$("#"+setting.linePre+dgid).index();
			var left=e.pageX+setting.tipsOffsetLeft;
			var top=e.pageY+setting.tipsOffsetTop;
			thisLineTop=$("#"+setting.linePre+dgid).offset().top;
			topDistance=thisIndex*lineHeight;
			downDistance=(lineNum-thisIndex-1)*lineHeight;
			$("#"+setting.linePre+dgid).css('background',setting.lineHighlight);
			dg_tips(left,top);
			$('body').css('cursor','move');
			unselect();
			setting.frame.mousemove(function(e){
				$("#dgf").css({"left":e.pageX+setting.tipsOffsetLeft+'px',"top":e.pageY+'px'});
			});
		});
	
		$('body').mouseup(function(e){
			if(thisLineTop>0){
				var moveDistance=e.pageY-thisLineTop;
				if(moveDistance<0){
					if(thisIndex!=0){
						moveDistance=Math.abs(moveDistance);
						if(moveDistance>lineHeight/2){
							if(moveDistance>topDistance){
								focusIndex=0;
							}else{
								focusIndex=thisIndex-Math.ceil(moveDistance/lineHeight);
							}
							$("."+setting.dgLine).eq(focusIndex).before($("#"+setting.linePre+dgid));
							dg_update(thisIndex,focusIndex);
						}
					}
				}else{
					if(thisIndex!=lineNum-1){
						if(moveDistance>lineHeight/2+lineHeight){
							if(moveDistance>downDistance){
								focusIndex=lineNum-1;
							}else{
								focusIndex=thisIndex+Math.ceil(moveDistance/lineHeight)-1;
							}
							$("."+setting.dgLine).eq(focusIndex).after($("#"+setting.linePre+dgid));
							dg_update(thisIndex,focusIndex);
						}
					}
				}
				$("#dgf").remove();
				$("#"+setting.linePre+dgid).css('background','');
				dgid='';
				thisLineTop=0;
				$('body').css('cursor','default');
				onselect();
			}
		});
		
		function dg_update(thisIndex,focusIndex){
			dg_mask();
			var m=sublist=$('#drag_table .drag_line').size();
			//var start=thisIndex<focusIndex?thisIndex:focusIndex;
			//var end=thisIndex<focusIndex?focusIndex:thisIndex;
			var ids='',vals='';
			for(var i=1;i<=sublist;i++){
				ids+=m==1 ? $("."+setting.dgLine).eq(i-1).attr(setting.id):$("."+setting.dgLine).eq(i-1).attr(setting.id)+',';
				vals+=m==1 ? m : m+',';
				m--;
			}
			ids=ids ? ids :'';
			vals=vals ? vals :'';
			/*$.getJSON(setting.JSONUrl,{'do':'changeorders','ids':ids,'vals':vals},function(d){
				$("#dg_mask").remove();	
			});*/
			$.post(setting.JSONUrl,{'do':'changeorders',cid:Cid,fcid:fCid,'ids':ids,'vals':vals},function(ret){
				$("#dg_mask").remove();	
				 //window.location.reload();
			},'JSON');
		}
		
		function dg_mask(){
			var W=setting.frame.outerWidth();
			var H=setting.frame.outerHeight();
			var top=setting.frame.offset().top;
			var left=setting.frame.offset().left;
			var mask="<div id='dg_mask'><img src='"+setting.maskLoadIcon+"' alt='' /> 正在使劲的保存...</div>";
			$('body').append(mask);
			$("#dg_mask").css({"background":"#999","position":'absolute','width':W+'px','height':H+'px','line-height':H+'px','top':top+'px','left':left+'px','filter':'alpha(opacity='+setting.maskOpacity+')','moz-opacity':setting.maskOpacity/100,'opacity':setting.maskOpacity/100,'text-align':'center','color':'#000'});
		}
		
		function dg_tips(left,top){
			var floatdiv="<div id='dgf' style='padding:5px 10px;border:1px solid #444;background-color:#fff;filter:alpha(opacity="+setting.tipsOpacity+");moz-opacity:"+setting.tipsOpacity/100+";opacity:"+setting.tipsOpacity/100+";position:absolute;left:"+left+"px;top:"+top+"px;'>移动一条记录</div>";
			$('body').append(floatdiv);
		}
		
		function unselect(){
			$('body').each(function() {           
				$(this).attr('unselectable', 'on').css({
					'-moz-user-select':'none',
					'-webkit-user-select':'none',
					'user-select':'none'
				}).each(function() {
					this.onselectstart = function() { return false; };
				});
			});
		}
		
		function onselect(){
			$('body').each(function() {           
				$(this).attr('unselectable', '').css({
					'-moz-user-select':'',
					'-webkit-user-select':'',
					'user-select':''
				});
			}).each(function() {
					this.onselectstart = function() { return true; };
				});
		}
	}
})(jQuery);
