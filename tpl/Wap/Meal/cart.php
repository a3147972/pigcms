<include file="Meal:header"/>
<script type="text/javascript">
var store_id = {pigcms{$store_id};
</script>
<script src="{pigcms{$static_path}js/alert.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}js/select.js" type="text/javascript"></script>
<script>
function g(id){
    return document.getElementById(id);
}
function gotoorder(){
window.location.href = window.location.href;
}
var cart = new OAK.Shop.Cart();

function clearCache(){
    cart.clear();
    cart.showCartInfo();
}
function addProduct(productId, specId,name,price,categoryId,addnum) {
 
    cart.addProduct(OAK.Shop.Product({id: productId, specId: specId, number: addnum, price: price, name: name,categoryId:categoryId}));
}
function reduceProduct(productId, specId,num) {
    var oldnum = cart.getProductNumber({id: productId, specId: specId});
    if (oldnum !== null) {
        if (oldnum -num > 0) {
            cart.updateNumber(oldnum - num, {id: productId, specId: specId});
        } else {
            cart.deleteProduct({id: productId, specId: specId});
        }
    }
}
function showTip(){
    var quant = cart.getQuantity();
    if (quant.totalAmount>=cart.total){
        g('infoForm').style.display = "";
        g('notEnoughLi').style.display = "none";
        g('emptyLi').style.display = "none";
    }else{
        g('infoForm').style.display = "none";
        if(quant.totalAmount >0){
            g('notEnoughLi').style.display = "";
            g('emptyLi').style.display = "none";
        }
        else{
            g('emptyLi').style.display = "";
            g('notEnoughLi').style.display = "none";
        }
    }
}

function getNextElement(node){
    if(node.nextSibling.nodeType == 1){    //判断下一个节点类型为1则是"元素"节点
        return node.nextSibling;
    }
    if(node.nextSibling.nodeType == 3){      //判断下一个节点类型为3则是"文本"节点  ，回调自身函数
        return getNextElement(node.nextSibling);
    }
    return null;
}

function getPreviousElement(node){
    if(node.previousSibling.nodeType == 1){    //判断下一个节点类型为1则是"元素"节点
        return node.previousSibling;
    }
    if(node.previousSibling.nodeType == 3){      //判断下一个节点类型为3则是"文本"节点  ，回调自身函数
        return getPreviousElement(node.previousSibling);
    }
    return null;
}

cart.showProductNum =  function(productId,specId,num){
    if(num>0){
        g("num_" + productId+"_"+specId).innerHTML = parseInt(num);
    }else{
        var curNode = g("li_"+productId+"_"+specId);
        var nextNode = getNextElement(curNode);
        if(!nextNode || nextNode.nodeName !='LI' || nextNode.id == 'notEnoughLi' || nextNode.id == 'emptyLi'){
            var previousNode = getPreviousElement(curNode);
            if(previousNode && previousNode.nodeName =='DT'){
                previousNode.parentNode.removeChild(previousNode);
            }
        }
        curNode.parentNode.removeChild(curNode);
    }
}

cart.showTotalNum = function(){
	var quant = cart.getQuantity();
	$("#cartN2").html(quant.totalNumber);
	// g("totalNum").innerHTML = quant.totalNumber;
// 	SetCookie("diancai645",quant.totalNumber);
	//g("cartN2").innerHTML = quant.totalNumber;
	//g("totalPrice").innerHTML = quant.totalAmount.toFixed(2);
	showTip();
};

cart.showCartInfo=function () {
    var products = cart.getProductList();
    var orderlist = g("ullist");
    products && products.sort(cart.sortAsc);
    var liststr = "";
    var currentCategory = 0;
    for(var i in products){
        if (currentCategory != products[i].categoryId) {
            liststr += "<dt>" + cart.categories[products[i].categoryId] + "</dt>";
            currentCategory = products[i].categoryId;

        }
        liststr += "<li class=\"ccbg2\" id=\"li_"+ products[i].id+"_"+ products[i].specId+"\">"+
        "<div class=\"orderdish\"><span class=\"\">"+ products[i].name+"</span><p><span class=\"price\" id=\"v_0\">"+products[i].price+"</span><span class=\"price\">元</span></p></div>"+
            "<div class=\"orderchange\">"+
                "<a href=\"javascript:addProduct("+products[i].id+","+products[i].specId+",\'"+products[i].name+"\',"+products[i].price+","+products[i].categoryId+",1"+")\" class=\"increase\"><b class=\"ico_increase\">加一份</b></a>"+
                "<span class=\"count\" id=\"num_"+products[i].id+"_"+products[i].specId+"\">"+products[i].number+"</span>"+
                "<a href=\"javascript:reduceProduct("+products[i].id+","+products[i].specId+",1)\" class=\"reduce\"><b class=\"ico_reduce\">减一份</b></a>"+
            "</div>"+
        "</li>";
 
    }
    liststr+="<li class=\"ccbg3\" id='notEnoughLi' style='display: none;'>必须要满"+cart.total+"元才能下单哦</li>"+
    "<li class=\"ccbg3\" id='emptyLi' style='display: none;'>购物车为空哦，快去挑选吧！</li>";

 liststr+="<li class=\"ccbg3\" style='display: none;'>配送费 1.00 元  ,满 10.00 元免配送费</li>"
    orderlist.innerHTML = liststr;
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
  
function submitOrder()
{
	vailReSubmit();
	if(valiForm()) {
	    return;
	}
	
	var goodsData = '';
	var goodsList = cart.getProductList();
	goodsList && goodsList.sort(cart.sortAsc);
	for (var i in goodsList) {
	    goodsData+=goodsList[i].id+','+goodsList[i].number+';';
	}
	g('goodsData').value = goodsData;

	if (goodsData == '' || goodsData == null) {
        alert("菜单空空的，先点菜吧！");
        return  false;
	}
// 	$.post("{pigcms{:U('Meal/saveorder')}", {'goodsData':goodsData, 'mer_id':$('#mer_id').val(), 'store_id':$('#store_id').val(), 'name':$('#name').val(), 'phone':$('#phone').val(), 'address':$('#address').val(), 'note':$('#note').val()}, function(data){
// 		if (data.error_code == 1) {
// 			alert(data.msg);
// 		} else {
// 			setTimeout("clearCache();window.location.href = '" + data.data + "';", 1000);
// 		}
// 	}, 'json');

	
	document.forms[0].submit();
	document.infoForm.issubmit.value=1;//不能再提交
	clearCache();
}

function valiForm()
{
    var phonePattern = /^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/;
    var mobilePattern = /^1\d{10}$/;
    var flag = false;
	if(g("name").value.length < 1){
        alert("联系人不能为空");
        return  true;
    }
	if(!(phonePattern.test(g("phone").value) || mobilePattern.test(g("phone").value))){
        alert("亲，您的联系电话格式有误！");
        return true;
    }

	/*if(g("tablenums").value.length < 1){
        alert("桌号不能为空");
        return  true;
    }*/
    return flag;
}

function vailReSubmit()
{
    if (document.infoForm.issubmit.value == 0) {
        return true;
    } else {
        alert(' 按一次就够了，请勿重复提交！请耐心等待！谢谢合作！');
        return false;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
    }
}
      
function testInPayArea()
{
	if (g("address").value == "") {
       alert("请先填写收货地址");
    } else {
        return true;
    }
    g('wxpay').checked = false;
    g('huodao').checked = true;
    return false;
}

window.onload = function(){
	cart.categories = {pigcms{$categories};
	cart.getFromCache();
	cart.showCartInfo();
}
</script>
<div class="window" id="windowcenter">
	<div id="title" class="title">消息提醒<span class="close" id="alertclose"></span></div>
	<div class="content">
		<div id="txt"></div>
		<input type="button" value="确定" id="windowclosebutton" name="确定" class="txtbtn">	
	</div>
</div>
<div id="mcover" onclick="document.getElementById('mcover').style.display='';">
	<div class="textPopup">
	    <h2>是否清空菜单？</h2>
	    <div>
	    <a class="two ok" id="ok" href="javascript:void(0)">确定</a>	
	    <a class="two" href="javascript:void(0)">取消</a>
	    </div>
	    <a class="x" onclick="document.getElementById('mcover').style.display='';">X</a>
	</div>
</div>	
<!-- <div class="header">
	<span class="pCount">请叫服务员下单</span>
	<label><i>共计：</i><b id="totalPrice" class="duiqi">106.00</b><b class="duiqi">元</b></label>
</div> -->
<div class="biaodan" style="background: white;">
	<section>
		<div class="orderlist">
			<ul id="ullist">
			</ul>
		</div>
	</section> 
</div>

 
<div class="biaodan" style="margin-top:10px;">
	<form name="infoForm" id="infoForm" method="post" action="">
		<input type="hidden" name="issubmit" value="0">
		<input type="hidden" name="goodsData" id="goodsData" value="">
		<input type="hidden" name="formhash" id="formhash" value="3989bd8c">
		<input type="hidden" name="mer_id" id="mer_id" value="{pigcms{$mer_id}">
		<input type="hidden" name="store_id" id="store_id" value="{pigcms{$store_id}">
		<div class="contact-info" style="padding:0" id="dingcai_adress_info">
			<ul>
				<li style="padding:7px 10px;">
					<a class="react" href="{pigcms{:U('My/adress',array('store_id'=>$store_id, 'mer_id' => $mer_id, 'current_id'=>$now_group['user_adress']['adress_id']))}">
						<if condition="$now_group['user_adress']['adress_id']">
							<table style="padding: 0; margin: 0; width: 100%;">
							
								<tr>
									<td width="80px">
									<label for="name" class="ui-input-text">联系人：</label>
									<input type="hidden" name="adress_id" value="{pigcms{$now_group['user_adress']['adress_id']}">
									<input type="hidden" id="name" name="name" value="{pigcms{$now_group['user_adress']['name']}">
									</td>
									<td>{pigcms{$now_group['user_adress']['name']}</td>
								</tr>
								<tr>
									<td width="80px"><label for="phone" class="ui-input-text">联系电话：</label></td>
									<input type="hidden" id="phone" name="phone" value="{pigcms{$now_group['user_adress']['phone']}">
									<td>{pigcms{$now_group['user_adress']['phone']}</td>
								</tr>
								<tr>
									<td width="80px"><label for="address" class="ui-input-text">地址：</label></td>
									<input type="hidden" id="address" name="address" value="{pigcms{$now_group['user_adress']['province_txt']} {pigcms{$now_group['user_adress']['city_txt']} {pigcms{$now_group['user_adress']['area_txt']} {pigcms{$now_group['user_adress']['adress']}">
									<td>{pigcms{$now_group['user_adress']['province_txt']} {pigcms{$now_group['user_adress']['city_txt']} {pigcms{$now_group['user_adress']['area_txt']} {pigcms{$now_group['user_adress']['adress']}</td>
								</tr>
							</table>
						<else/>
							<dl class="list">
								<dd style="padding:0px;border-bottom:none;">
									<div class="more more-weak">添加收货人地址</div>
								</dd>
							</dl>
						</if>
					</a>
				</li>
			</ul>
		</div>    
		<div class="contact-info" style="padding:0;margin-top:10px;">
			<table style="padding: 0; margin: 0; width: 100%;">
				<tr>
					<td width="80px"><label for="note" class="ui-input-text">点餐备注：</label></td>
					<td><textarea id="note" name="note" placeholder="" class="ui-input-text"></textarea></td>
				</tr>
			</table>
		</div>    
		<div class="footReturn">
			<a id="showcard" class="submit" href="javascript:submitOrder();">确定提交</a>
		</div>
	</form>
</div>
{pigcms{$hideScript}
<include file="Meal:footer"/>