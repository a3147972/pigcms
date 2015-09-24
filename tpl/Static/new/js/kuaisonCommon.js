function isIE6(){return getIEVersion() === '6'}
function getIEVersion(){
	var a=document;
	if(a.body.style.scrollbar3dLightColor!=undefined){
		if(a.body.style.opacity!=undefined){
			return "9"
		}else if(a.body.style.msBlockProgression!=undefined){
			return "8"
		}else if(a.body.style.msInterpolationMode!=undefined){
			return "7"
		}else if(a.body.style.textOverflow!=undefined){
			return "6"
		}else{
			return "IE5.5"
		}
	}
	return false;
}
//保留小数点后两位
function changeTwoDecimal_f(x){
    var f_x = parseFloat(x);
    if (isNaN(f_x)) {
        alert('function:changeTwoDecimal->parameter error');
        return false;
    }
    var f_x = Math.round(x * 100) / 100;
    var s_x = f_x.toString();
    var pos_decimal = s_x.indexOf('.');
    if (pos_decimal < 0) {
        pos_decimal = s_x.length;
        s_x += '.';
    }
    while (s_x.length <= pos_decimal + 2) {
        s_x += '0';
    }
    return s_x;
}
function addFav(o,data){
	var url = siteUrl+'request.ashx?action=addshoucang&shopid='+data.shopid+'&id='+data.productid+'&styleid='+data.styleid+'&jsoncallback=?&timer='+Math.random();
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			$(o).addClass('favok').html('收藏成功');
		}else{
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function delFav(data){
	var url = siteUrl+'request.ashx?action=delshoucang&shopid='+data.shopid+'&id='+data.productid+'&jsoncallback=?&timer='+Math.random();
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			MSGwindowShow('shopping','1','删除收藏成功！',window.location.href,'');
		}else{
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function addeditAddress(chrname,chraddress,mobile,sid,styleid,ismoren){
	var url=siteUrl+'request.ashx?action=addmyaddress&styleid='+styleid+'&id='+sid+'&ismoren='+ismoren+'&ishtml=1&chrname='+chrname+'&chraddress='+chraddress+'&mobile='+mobile+'&jsoncallback=?&timer='+Math.random();
	
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			$('#addeditNode').hide();
			$('#addeditMask').hide();
			$('#addressList').html(data[0].MSG);
			$('#addressid').val($('#addressList').find('.cur1').attr('data-id'));
		}else{
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function setmorenMyAddress(sid,ismoren,node){
	var url=siteUrl+'request.ashx?action=addmyaddress&styleid=2&id='+sid+'&ismoren='+ismoren+'&jsoncallback=?&timer='+Math.random();
	
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			node.parent().siblings('li').removeClass('ismoren1').end().parent().find('.edit').attr({'data-ismoren':'0'});
			node.parent().addClass('ismoren1').find('.edit').attr({'data-ismoren':'1'});
			node.hide();
		}else{
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function delMyAddress(sid,node){
	var url=siteUrl+'request.ashx?action=getmyaddress&delid='+sid+'&jsoncallback=?&timer='+Math.random();
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			node.parent().remove();
		}else{
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function setShoppingCart(sid,num,delid,typeid){
	var url=siteUrl+'request.ashx?action=addmyshopping&id='+sid+'&styleid='+window['GOODSTYLEID']+'&num='+num+'&shopid='+window['SHOPID']+'&ishtml='+window['ISHTML']+'&delid='+delid+'&jsoncallback=?&timer='+Math.random();
	
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			showShoppingCart(!0,data[0].MSG);
			showShoppingList(data[0].JSONMSG);
			showQison(parseFloat($('#shipmoney1').html()),parseFloat($('#chrmoneyAll').html()));
		}else{
			if(typeof typeid !== 'undefined'){
				if('increase' === typeid){
					$('#gouwuche'+sid).val(parseInt($('#gouwuche'+sid).val())-1);
				}
			}
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function getShoppingCart(ishide,delid){
	var Delid = delid || '';
	var url=siteUrl+'request.ashx?action=getmyshopping&shopid='+window['SHOPID']+'&ishtml='+window['ISHTML']+'&delid='+Delid+'&jsoncallback=?';
	$.getJSON(url,function(data){
		if(data[0].islogin === '1'){
			showShoppingCart(ishide,data[0].MSG);
			showShoppingList(data[0].JSONMSG);
			showQison(parseFloat($('#shipmoney1').html()),parseFloat($('#chrmoneyAll').html()));
		}else{
			MSGwindowShow('shopping','0',data[0].error,'','');
		}
	});
}
function showShoppingCart(ishide,html){
	$('#h_cart_inner').html(html);
	ishide&&$('#h_cart').trigger('mouseenter');
	$('#h_cart_num').html($('#ShoppingCartNumAll').attr('data-numall'));
}
function showShoppingList(jsonMSG){
	if(window['ISBL'] === '0'){
		return false;
	}else if(window['ISBL'] === '1'){
		var i=0,len = jsonMSG.length;
		$('#prolist').find('.buycar:hidden').show().end().find('.buycar2:visible').hide().end().find('.link').attr('data-showBuy','1');
		for( ;i<len;i++){
			$('#item_'+jsonMSG[i]['goodid']).find('.buycar2').show().end().find('.buycar').hide().end().find('.link').attr('data-showBuy','0');
		}
	}else if(window['ISBL'] === '2'){
		var i=0,len = jsonMSG.length;
		$('#prolist').find('.buycar').css({'display':''}).end().find('.buycar2').hide().end().find('.link').attr('data-showBuy','1');
		for( ;i<len;i++){
			$('.item_'+jsonMSG[i]['goodid']).find('.buycar2').show().end().find('.buycar').hide().end().find('.link').attr('data-showBuy','0');
		}
	}else{
		
	}
}
function showQison(val1,val2){
	
	if((val1 > 0) && (val1 > val2)){
		if(!$('#distanceNode')[0]){
			$('<div id="distanceNode" class="distanceNode"></div>').insertAfter("#submitGo");
		}
		$('#distanceNode').html('该店最小起送金额为'+val1+'元，还差' + (val1 - val2) + '元<span class="arrow"></span>').show();
		$('#submitGo').addClass('disabled').bind('click',function(e){e.preventDefault();});
	}else{
		$('#distanceNode').hide();
		$('#submitGo').removeClass('disabled').unbind('click');
	}
}
function showHide(e,objname){     
    var obj = $('#'+objname),
		inner = $('#list_nav_2013'),
		uls = inner.find('.po:visible');
	obj.toggle();
	$(e).parent().parent().toggleClass('open');
	uls.css({'display':'none'});
	uls.parent().removeClass('open');
}


(function(){
	$.fn.addressList = function(){
		var $t = $(this),addressid = $('#addressid'),addeditNode = $('#addeditNode'),addeditMask = $('#addeditMask'),s_id=$('#s_id'),s_styleid = $('#s_styleid'),s_ismoren = $('#s_ismoren');
		
		var showAddEditAddress = function(){
			var d_h = $(document).height(),
				d_w = $(window).width(),
				w_h = $(window).height(),
				t_h=addeditNode.height(),
				r_h = parseInt((w_h-t_h)/2);
			addeditMask.css({'height':d_h+'px','width':d_w+'px'});
			addeditNode.css({'top':r_h+'px'});
			$(window).bind("resize",function(){
				w_h = $(window).height();
				r_h = parseInt((w_h-t_h)/2);
				if(!isIE6()){
					addeditNode.css({'top':r_h+'px'});
				}else{
					var d = $(document).scrollTop();
					addeditNode.css({'top':d+r_h+'px'});
				}
			});
			$(window).bind("scroll",function(){
				if(!isIE6()) return;
				showWin();
			});
			function showWin(){
				var d = $(document).scrollTop();
				addeditNode.css({'top':d+r_h+'px'});
			}
		};
		setTimeout(function(){showAddEditAddress();},50);
		
		addressid.val($('input[name="sleAdress"]:checked').val());
		$t.on('mouseenter','.item:not(".ismoren1")',function(){
			$(this).find('.moren').show();
		}).on('mouseleave','.item:not(".ismoren1")',function(){
			$(this).find('.moren').hide();		 
		}).on('click','.item',function(){
			$t.find('.item').removeClass('cur1');
			$(this).addClass('cur1');
			addressid.val($(this).attr('data-id'));
		}).on('click','.moren',function(event){
			event.preventDefault();
			event.stopPropagation();
			setmorenMyAddress($(this).attr('data-id'),'1',$(this));
		}).on('click','.edit',function(event){
			event.preventDefault();
			event.stopPropagation();
			s_id.val($(this).attr('data-id'));
			s_styleid.val('1');
			//s_ismoren.val($(this).attr('data-ismoren'));
			$('#s_realname').val($(this).parent().find('.chrname').html());
			$('#s_address').val($(this).siblings('.chraddress').html());
			$('#s_phone').val($(this).siblings('.tel').html());
			addeditNode.show();
			addeditMask.show();
		}).on('click','.del',function(e){
			e.preventDefault();
			delMyAddress($(this).attr('data-id'),$(this));
		}).on('click','#addAddress_btn',function(e){
			e.preventDefault();
			s_id.val('');
			s_styleid.val('');
			//s_ismoren.val('');
			$('#myformAddress').trigger('reset');
			addeditNode.show();
			addeditMask.css({'height':$(document).height()+'px'}).show();
			
		});
		
		addeditNode.on('click','.close',function(e){
			e.preventDefault();
			$('#myformAddress').trigger('reset');
			addeditNode.hide();
			addeditMask.hide();
		});
		addeditMask.bind('click',function(){
			addeditNode.hide();
			addeditMask.hide();
		});
	}
	$.fn.pagelist2 = function(){
		var node = $(this),
			list = node.find('.link');
		list.bind('click',function(e){
			e.preventDefault();
			if($(this).attr('data-showBuy') === '1'){setShoppingCart($(this).attr('data-id'),'1','');}else{$('#h_cart').trigger('mouseenter');}
		});
	}
	$.fn.pagelist = function(){
		var node = $(this),
			list = node.find('.item'),
			dialog = $('#dialog_pro'),
			dialog_tit = $('#dialog_tit'),
			dialog_img = $('#dialog_img'),
			dialog_imgList = $('#dialog_imgList'),
			dialog_goodnum = $('#dialog_goodnum'),
			dialog_brand = $('#dialog_brand'),
			dialog_guige = $('#dialog_guige'),
			dialog_price = $('#dialog_price'),
			dialog_kcnum = $('#dialog_kcnum'),
			dialog_proid = $('#dialog_proid'),
			dialog_num = $('#dialog_num'),
			dialog_num_node = $('#dialog_num_node'),
			dialog_submit = $('#dialog_submit'),
			dialog_button = $('#dialog_button'),
			dialog_shopLink = $('#dialog_shopLink');
		
		function showPicList(txt){
			var arr = txt.split(','),len=arr.length,txt='',fristClass='',tPrev=$('#dialog_img_prev'),tNext=$('#dialog_img_next'),cellW=82,tIndex=0;
			dialog_img.attr('src',arr[0]);
			tPrev.addClass('btn_disabled').unbind('click');
			tNext.removeClass('btn_disabled').unbind('click');
			dialog_imgList.css({'left':'0'});
			
			if(len<1){
				txt += '<li class="cur"><a href="'+window['tplPath']+'images/kuaison_nofind_product2.gif" class="item"><img src="'+window['tplPath']+'images/kuaison_nofind_product2.gif" alt="" /></a><s class="arrow"></s></li>';
				dialog_imgList.html(txt);
				return;
			}
			
			for(var i=0;i<len;i++){
				if(i === 0){fristClass="cur";}else{fristClass='';}
				txt += '<li class="'+fristClass+'"><a href="'+arr[i]+'" class="item"><img src="'+arr[i]+'" alt="" /></a><s class="arrow"></s></li>';
			}
			dialog_imgList.html(txt);
			
			if(len<4){
				tNext.addClass('btn_disabled');
				return;
			}
			dialog_imgList.css({'width':cellW*len+'px'});
			
			tPrev.click(function(e){
				if(tIndex-1>-1){
					tIndex--;
					if(tIndex === 0){tPrev.addClass('btn_disabled');}
					tNext.removeClass('btn_disabled');
					dialog_imgList.animate({left:'+='+cellW},300,function(){});
				}else{
					tIndex = 0;
				}
				e.preventDefault();
			});
			tNext.click(function(e){
				if(tIndex+1<len-3){
					tIndex++;
					if(tIndex === len-4){tNext.addClass('btn_disabled');}
					tPrev.removeClass('btn_disabled');
					dialog_imgList.animate({left:'-='+cellW},300,function(){});
				}else{
					tIndex=len-4;
					
				}
				e.preventDefault();
			});
		}
		
		
		
		dialog_imgList.on('click','.item',function(e){
			e.preventDefault();
			dialog_imgList.find('.item').parent().removeClass('cur');
			$(this).parent().addClass('cur');
			dialog_img.attr('src',$(this).attr('href'));
		});
		list.each(function(){
			$(this).find('.link').bind('click',function(e){
				e.preventDefault();
				dialog_img.attr('src',window['tplPath']+'images/kuaison_nofind_product2.gif');
				showPicList($(this).attr('data-piclist'));
				dialog_tit.html($(this).attr('data-title'));
				dialog_goodnum.html($(this).attr('data-goodnum'));
				dialog_brand.html($(this).attr('data-brand'));
				dialog_guige.html($(this).attr('data-xinghao'));
				dialog_price.html($(this).attr('data-price'));
				dialog_kcnum.html($(this).attr('data-kcnum'));
				dialog_proid.val($(this).attr('data-id'));
				dialog_shopLink.attr('href',window['siteUrl']+'c'+window['SHOPID']+'_g'+$(this).attr('data-id')+'.html').removeClass('display1').addClass('display'+$(this).attr('data-isshop'));
				
				if($(this).attr('data-showBuy') === '0'){
					dialog_submit.hide();
					dialog_num_node.hide();
					dialog_button.show();
				}else{
					dialog_submit.show();
					dialog_num_node.show();
					dialog_button.hide();
				}
				var d = $(document).scrollTop(),
	   			e = $(window).height(),
				f=dialog.height();
				dialog.css({'top':parseInt((e-f)/2+d)+'px'}).show();
			});
			$(this).find('.buycar').bind('click',function(e){
				e.preventDefault();
				setShoppingCart($(this).attr('data-id'),'1','');
			});
		});
		
		dialog_submit.bind('click',function(e){
			e.preventDefault();
			if($('#header_cart').css('display') === 'none'){
				$.scrollTo( '+=80',0,function(){});
			}
			dialog.hide();
			setShoppingCart(dialog_proid.val(),dialog_num.val(),'');
		});
		dialog.find('.reduce').click(function(e){
			e.preventDefault();
			var now_node = $(this).siblings('.n_ipt'),
				now_val = parseInt(now_node.val());
			if(now_val===1){return false;}
			--now_val === 1?($(this).addClass('disabled'),now_val=1):($(this).removeClass('disabled'));
			now_node.val(now_val);
			$(this).siblings('.increase').removeClass('disabled');
		});
		dialog.find('.increase').click(function(e){
			e.preventDefault();
			var now_node = $(this).siblings('.n_ipt'),
				now_val = parseInt(now_node.val());
			if(now_val===100){return false;}
			++now_val === 100?($(this).addClass('disabled'),now_val=100):($(this).removeClass('disabled'));
			now_node.val(now_val);
			$(this).siblings('.reduce').removeClass('disabled');
		});
		dialog.find('.close').bind('click',function(e){
			e.preventDefault();
			dialog.hide();
		});
	}
	$.fn.header_cart = function(){
		//跟随滚动
		var t = $(this),
			ie6 = isIE6(),
			h = $('#header'),
			c_inner = 'h_cart_inner',
			_curInst = !1;
		$(window).bind("scroll",function(){
			var d = $(document).scrollTop();
			close_box();
			if(h.height() < d){
				if(t.is(":hidden")){t.show();} 
				if(!!ie6){
					t.css({'position':'absolute','top':d+'px'});
				}else{
					t.css({'position':'fixed'});
				}
			}else{
				if(t.is(":visible")){t.hide();} 
				t.css({'position':'relative'});
			}
		});
		
		//显示隐藏下拉
		$('#h_cart').bind('mouseenter',function(){
			_curInst = !0;
			$('#'+c_inner).slideDown('fast');
		});
		$(document).mousedown(function(event){
			_checkExternalClick(event);
		});
		function close_box(){
			_curInst = !1;
			$('#'+c_inner).slideUp('fast');
		}
		function _checkExternalClick(event){
			if(!_curInst) return;
			var $target = $(event.target);
			if(($target.parents('#' + c_inner).length == 0)){
				 close_box();
			}
		}
		//购物车操作
		$('#'+c_inner).on('click','.del', function(e){
			var sid = $(this).attr('data-id');
				getShoppingCart(!1,sid);
				e.preventDefault();
		});
		$('#'+c_inner).on('click','.reduce', function(e){
			e.preventDefault();
			var now_node = $(this).siblings('.n_ipt'),
				now_val = parseInt(now_node.val()),
				sid = $(this).attr('data-id');
			if(now_val===1){return false;}
			--now_val === 1?($(this).addClass('disabled'),now_val=1):($(this).removeClass('disabled'));
			now_node.val(now_val);
			$(this).siblings('.increase').removeClass('disabled');
			setShoppingCart(sid,now_val,'','reduce');
		});
		$('#'+c_inner).on('click','.increase', function(e){
			e.preventDefault();
			var now_node = $(this).siblings('.n_ipt'),
				now_val = parseInt(now_node.val()),
				sid = $(this).attr('data-id');
			if(now_val===100){return false;}
			++now_val === 100?($(this).addClass('disabled'),now_val=100):($(this).removeClass('disabled'));
			now_node.val(now_val);
			$(this).siblings('.reduce').removeClass('disabled');
			setShoppingCart(sid,now_val,'','increase');
		});
	}
	$.fn.keyword = function(formId,iptId,oldValue){
		var t = $(this),form = $('#'+formId),ipt = $('#'+iptId);
		ipt.focus(function(e){
			t.addClass('focus');
		});
		ipt.blur(function(e){
			t.removeClass('focus');
		});
		form.submit(function(e){
			if(ipt.val() === oldValue){
				MSGwindowShow('shopping','0','请输入关键字','','');
				ipt.focus();
				return false;
			}
		});
	}
	$.fn.slideText = function(){
		var t = $(this),
			list = t.find('.inner'),
			len = list.length-1,
			next_btn = t.find('#next'),
			prev_btn = t.find('#prev'),
			c_index = 0;
		function showIndex(increasing){
			!!increasing?(c_index<len&&(c_index++,prev_btn.removeClass('disable'))):(c_index>0&&(c_index--,next_btn.removeClass('disable')));
			list.css('display','none');
			if(c_index === len){next_btn.addClass('disable')}
			if(c_index === 0){prev_btn.addClass('disable')}
			list.eq(c_index).css('display','block');
		}
		next_btn.click(function(e){
			showIndex(!0);
			e.preventDefault();
		});
		prev_btn.click(function(e){
			showIndex(!1);
			e.preventDefault();
		});
		showIndex(c_index);
	}
	$.fn.fixed = function(can,posi){
		if(isIE6()){return false;}
		var b = $(this),h = b.height(),offset = b.offset(),top = offset.top,bottom = $('#footer').outerHeight(true),d_h = $(document).height(),w_h = $(window).height();
		if(can.height()<h){return;}
		$(window).bind("scroll",function(){
			var d = $(document).scrollTop(),h = b.height(),s_h = d_h-bottom-h,s_b = $('#footer').offset().top-h-32;
			
			if(top < d){
				if((s_h - d - posi)<0){
					b.css({'position':'absolute','top':s_b+'px'});
				}else{
					b.css({'position':'fixed','top':posi+'px'});
				}
			}else{
				b.css({'position':'relative','top':'0'});
			}
		});
	}
	$.fn.selStar = function(){
		var t = $(this),list = t.find('.s_star'),score_1 = $('#score_1');
		list.click(function(e){
			e.preventDefault();
			var val = $(this).attr('data-index');
			list.parent().removeClass().addClass('i_star_'+val);
			score_1.val(val);
		});
	};
	$.fn.selScore = function(){
		var t = $(this),list = t.find('.btn'),total_score = $('#total_score');
		list.click(function(e){
			e.preventDefault();
			var val = $(this).attr('data-index');
			list.removeClass('cur');
			$(this).addClass('cur');
			total_score.val(val);
		});
	};
	$.fn.iRenLing = function(){
		var renLingNode = $(this),renLingMask = $('#renLingMask'),renLingBtn = $('#renLingBtn');
		
		var d_h = $(document).height(),
			d_w = $(window).width(),
			w_h = $(window).height(),
			t_h=renLingNode.height(),
			r_h = parseInt((w_h-t_h)/2);
		renLingMask.css({'height':d_h+'px','width':d_w+'px'});
		renLingNode.css({'top':r_h+'px'});
		$(window).bind("resize",function(){
			w_h = $(window).height();
			r_h = parseInt((w_h-t_h)/2);
			if(!isIE6()){
				renLingNode.css({'top':r_h+'px'});
			}else{
				var d = $(document).scrollTop();
				renLingNode.css({'top':d+r_h+'px'});
			}
		});
		$(window).bind("scroll",function(){
			if(!isIE6()) return;
			showWin();
		});
		function showWin(){
			var d = $(document).scrollTop();
			renLingNode.css({'top':d+r_h+'px'});
		}
		
		renLingBtn.click(function(e){
			e.preventDefault();
			renLingNode.show();
			renLingMask.css({'height':$(document).height()+'px'}).show();
		});
		renLingNode.on('click','.close',function(e){
			e.preventDefault();
			renLingNode.hide();
			renLingMask.hide();
		});
		renLingMask.bind('click',function(){
			renLingNode.hide();
			renLingMask.hide();
		});
	}
})(jQuery);