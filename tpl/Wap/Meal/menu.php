<include file="Meal:header"/>
<script type="text/javascript">
var store_id = {pigcms{$store_id};
</script>
<script src="{pigcms{$static_path}js/select.js" type="text/javascript"></script>
<script>
function g(id) {
    return document.getElementById(id);
}

var cart = new OAK.Shop.Cart();

function addProduct(productId, specId,name,price,categoryId,addnum) {
    cart.addProduct(OAK.Shop.Product({id: productId, specId: specId, number: addnum, price: price, name: name,categoryId:categoryId}));
	coutss();
	$.get('wap.php?g=Wap&c=Meal&a=selectmeal&store_id={pigcms{$store_id}&mer_id={pigcms{$mer_id}',{'meal_id':productId},function(data){});
}

function reduceProduct(productId, specId,num,categoryId) {
	$("#ct"+categoryId).text('');
	$("#ct"+categoryId).removeClass("num");
    var oldnum = cart.getProductNumber({id: productId, specId: specId});
    if (oldnum !== null) {
        if (oldnum -num > 0) {
            cart.updateNumber(oldnum - num, {id: productId, specId: specId});
        } else {
            cart.deleteProduct({id: productId, specId: specId});
        }
    }
	coutss();
}
function showAll(){
    var dts = document.getElementsByTagName("dt");
    for(var i in dts){
        if(dts[i].innerText != null){
            dts[i].style.display = "";
            var dd = dts[i].nextElementSibling;
            while(dd != null && dd.tagName != 'DT' ){
                dd.style.display = "";
                dd = dd.nextElementSibling
            }
        }
    }
    showMenu(false);
}
function showProducts(categoryName){
    showAll();
    var dts = document.getElementsByTagName("dt");
    for(var i in dts){
        if(dts[i].innerText != null && dts[i].innerText != categoryName){
            dts[i].style.display = "none";
            var dd = dts[i].nextElementSibling;
            while(dd != null && dd.tagName != 'DT' ){
                dd.style.display = "none";
                dd = dd.nextElementSibling
            }
        }
    }
}
cart.showProductNum =  function(productId,specId,num){
    if (num>0) {
        g("num_" + productId+"_"+specId).className = "count";
        g("del_" + productId+"_"+specId).style.display = "";
    } else {
        g("num_"  + productId+"_"+specId).className = "count_zero";
        g("del_"  + productId+"_"+specId).style.display = "none";
    }
    g("num_" + productId+"_"+specId).innerHTML = parseInt(num);
}
cart.showTotalNum = function(){
    var quant = cart.getQuantity();
	g("cartN").innerHTML = ""+quant.totalNumber+"份 ￥"+quant.totalAmount;
	$("#cartN2").html(quant.totalNumber);
	//SetCookie("diancai645",quant.totalNumber);
};
cart.showCartInfo=function () {
	var products = cart.getProductList();
	for(var i in products){
		var product_id = products[i].id;
		var spec_id =  products[i].specId;
		if(products[i].categoryId=={pigcms{$sort_id}){
			cart.showProductNum(product_id, spec_id,cart.getProductNumber({id:product_id,specId:spec_id})||0);
		}
	}
	cart.showTotalNum();
};
cart.onAfterAdd = function(obj,num,conditions){
    cart.showProductNum(conditions.id,conditions.specId,num);
    cart.showTotalNum();
    cart.saveToCache();
};
cart.onAfterUpdate = function(obj,num,conditions){
    cart.showProductNum(conditions.id,conditions.specId,num);
    cart.showTotalNum();
    cart.saveToCache();
};
cart.onAfterDelete = function(obj,conditions){
    cart.showProductNum(conditions.id,conditions.specId,0);
    cart.showTotalNum();
    cart.saveToCache();
};
/*cart.getFromCache();
cart.showCartInfo();*/
      
function showMenu(is_show) {
    if (typeof(is_show) == "undefined") {
        if (hasClass(g("menu"), "sort_on"))
            removeClass(g("menu"), "sort_on");
        else
            addClass(g("menu"), "sort_on");
    } else {
        if (is_show) {
            addClass(g("menu"), "sort_on");
        } else {
            removeClass(g("menu"), "sort_on");
        }
    }
}

function hasClass(obj, cls) {
    return obj.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}

function addClass(obj, cls) {
    if (!this.hasClass(obj, cls)) obj.className += " " + cls;
}

function removeClass(obj, cls) {
    if (hasClass(obj, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        obj.className = obj.className.replace(reg, ' ');
    }
}
window.onload = function () {
	cart.categories = {pigcms{$categories};
// 	cart.total = 40;
	cart.getFromCache();
	cart.showCartInfo();
	coutss();
 	//setHeight();
}
function htmlit(meal_id)
{
	$.get('wap.php?g=Wap&c=Meal&a=meal_detail&store_id={pigcms{$store_id}&mer_id={pigcms{$mer_id}',{'meal_id':meal_id},function(data){
		if (data.error_code) {
		} else {
			document.getElementById('mcover').style.display='block';
			document.getElementById('Popup').style.display='block';
			document.getElementById("picsrc").src = data.data.image;
			document.getElementById("h3title").innerHTML = data.data.name;
			document.getElementById("jianjie").innerHTML = data.data.des;
		}
	}, 'json');
}
var cate_array = new Array();

function gethtml(key,cateid) {
	$("#navBar dd").each(function(){
		$(this).removeClass("active");
	});
	$("#dd"+cateid).addClass("active");
	
	if (cate_array[cateid] != null && cate_array[cateid] != '') {
		$('.ccbg').html(cate_array[cateid]);
		snums(cateid);
		change_height();
	} else {
		$.get("wap.php?g=Wap&c=Meal&a=thissort&store_id={pigcms{$store_id}&mer_id={pigcms{$mer_id}&sort_id=" + cateid, function(data){
			$('.ccbg').html(data);
			cate_array[cateid] = data;
			snums(cateid);
			change_height();
		});
	}
}
function change_height(){
	var left_height = $('#navBar').height(), right_height = $("#infoSection").height();
	if (left_height > right_height) {
		$("#infoSection").css('min-height',$('#navBar').height());
	}
}
function snums(cateid){
	var products = cart.getProductList();
	var catarr= new Array();
	for(var i in products){
		var product_id = products[i].id;
		var spec_id =  products[i].specId;
		if(products[i].categoryId==cateid){
			cart.showProductNum(product_id, spec_id,cart.getProductNumber({id:product_id,specId:spec_id})||0);
		}
	}
	cart.showTotalNum();
}

function sum(arguments) {
	var r=0;
	for (var i=0;i<arguments.length ;i++ ) {
		if(typeof(arguments[i]) != "undefined"){
			r=parseInt(arguments[i])+r;
		}
	}
	return r;
}
function coutss(){
	var products = cart.getProductList();
	var sarr =  new Array();
	for(var i in products){
		var product_id = products[i].id;
		var spec_id =  products[i].specId;
		var ctid =products[i].categoryId;
		if(typeof(sarr[ctid]) == "undefined"){
			sarr[ctid] = new Array();
		}
		sarr[ctid][product_id] = products[i].number;	 
	}
	for(var ii in sarr){
		var ssa =sarr[ii];
		var num = sum(ssa);
		 // alert(typeof(sarr[ii]));
		if(num>0){
			$("#ct"+ii).addClass("num");
			$("#ct"+ii).text(num);
		}else{
			$("#ct"+ii).removeClass("num");
		}
	}
 
}
$(document).ready(function(){
	change_height();
});
</script>
<input type="hidden" name="formhash" id="formhash" value="3989bd8c">
<div id="mcover" onclick="document.getElementById('mcover').style.display='';">
	<div id="Popup">
		<div class="imgPopup">
			<img id="picsrc" src="{pigcms{$static_path}images/qQQk5sy4bu.jpg"><h3 id="h3title"></h3>
			<p class="jianjie" id="jianjie"> </p>
		</div>
	</div>
	<a class="close" onclick="document.getElementById('mcover').style.display='';">X</a>
</div>

<div style="background-color:#f5f5f5; display:block" id="navbody">
	<div id="navBar">
		<dl>
			<!-- <dt class="searchimg" onclick="document.getElementById('searchmenu').style.display='block';document.getElementById('searchbg').style.display='block';">
				<img src="{pigcms{$static_path}images/xxyX63YryGuo-.png">搜索
			</dt> -->
			<volist name="sortlist" id="so" key="i">
			<dd id="dd{pigcms{$so['sort_id']}" <if condition="$i eq 1">class="active"</if>><a style="width:100%;" href="javascript:gethtml('', {pigcms{$so['sort_id']})">{pigcms{$so['sort_name']}</a><span id="ct{pigcms{$so['sort_id']}" class=""></span></dd>
			</volist>
			<dd></dd>
		</dl>
	</div>
   
	<!-- <form id="searchform" action="" method="get">
		<input type="hidden" name="ac" value="diancaisearch" />
		<input type="hidden" name="mer_id" value="650" />
		<input type="hidden" name="store_id" value="645" />  
		<div id="searchmenu" onclick="document.getElementById('searchmenu').style.display='';document.getElementById('searchbg').style.display=''" style=""></div>   
		<div id="searchbg">
			<span class="lt">
				<input class="sinput" type="search" id="keyword" name="keyword" value="" placeholder="输入关键词搜索" /> 
				<a class="sbtn" href="javascript:$('#searchform').submit();">搜索</a> 
			</span>
		</div>   
	</form>  -->
	<div id="infoSection">
		<if condition="$store['store_notice']">
		<div class="gonggao">
			<div class="hot"><strong>公告</strong></div>
			<div class="content">{pigcms{$store['store_notice']}</div>
		</div>
		</if>
		<section class="menu">
			<section class="list listimg">
				<dl>
			        <div class="ccbg">
			        	<volist name="meals" id="meal">
						<dd>
							<span class="count_zero" id="num_{pigcms{$meal['meal_id']}_1">0</span>
							<div class="tupian">
								<img src="{pigcms{$meal['image']}" onclick="htmlit({pigcms{$meal['meal_id']})">
								<div class="add" data-foodid="{pigcms{$meal['meal_id']}_1">
									<h3>{pigcms{$meal['name']}</h3>
									<em>{pigcms{$meal['price']}元/{pigcms{$meal['unit']}</em>
									<!--p class="dpNum">{pigcms{$meal['sell_count']}人点过</p-->
									<div onclick="addProduct('{pigcms{$meal['meal_id']}','1','{pigcms{$meal['name']}','{pigcms{$meal['price']}','{pigcms{$meal['sort_id']}',1);" class="reduce2"><span class="ico_increase">加一份</span></div>
									<div>
										<a href="javascript:reduceProduct('{pigcms{$meal['meal_id']}','1',1,'{pigcms{$meal['sort_id']}');" class="reduce" id="del_{pigcms{$meal['meal_id']}_1" style="display: none;"><span class="ico_reduce">减一份</span></a>
									</div>
								</div>
							</div>
						</dd>
						</volist>
					</div>
				</dl>
			</section>
		</section>
	</div>  
	<div class="clr"></div>  
</div>

<div class="header">
	<div class="left">已选：<span id="cartN">0份 ￥0</span>元</div>
	<div class="right"><a class="xhlbtn" href="{pigcms{:U('Meal/cart', array('mer_id' => $mer_id, 'store_id' => $store_id))}">选好了</a></div>
</div>


<script type="text/javascript">
window.shareData = {  
            "moduleName":"Meal",
            "moduleID":"0",
            "imgUrl": "{pigcms{$store.image}", 
            "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Meal/menu',array('mer_id' => $mer_id, 'store_id' => $store_id))}",
            "tTitle": "{pigcms{$store.name}",
            "tContent": "{pigcms{$store.txt_info}"
};
</script>
{pigcms{$shareScript}
<style>
#enter_im_div {
  bottom: 121px;
}
</style>
<include file="Meal:footer"/>