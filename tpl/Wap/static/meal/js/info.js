var date_elm=null;
var datetime_elm=null;

$(document).ready(function(){
	
	
	if(config.dishes_status==2){
		$("#pre label").html("取消修改");
		$("#next label").html("我同意并提交");	
		showinfo();	
		$("#pre").get(0).onclick=function(){window.history.go(-1);}
	}else if(config.dishes_status==1){
		$("#pre label").html("上一步");
		$("#next label").html("下一步");
		showinfo();	
//		$("#pre").get(0).onclick=function(){
//			config.utype=0;
//			submit_F();
//		}
		$("#next").get(0).onclick=function(){
			config.utype=1;
			submit_F();
		}
	} else {
		$("#pre label").html("重新选择餐厅");
		$("#next label").html("我同意并提交");
		var nowdate= new Date();
		var month = nowdate.getMonth()+1;
		if(month<10){ month="0"+month;}
		var date= nowdate.getDate();
		if(date<10){ date="0"+date;}
		$('.date').val(nowdate.getFullYear()+"-"+month+"-"+date)
		
		var h = nowdate.getHours();
		if(h<10){ h="0"+h;}
		var M = nowdate.getMinutes();
		if(M<10){ M="0"+M;}
		$('.datetime').val(h+":"+M);
		$("#pre").get(0).onclick=function(){window.history.go(-1);}
	}
	
	
	date_elm = $('.date').mobiscroll()["date"]({
	lang: 'zh',
	display: 'bottom',
	minWidth: 64,
	dayText: '日', monthText: '月', yearText: '年', //面板中年月日文字
	dateFormat: 'yy-mm-dd'});
	
	datetime_elm=$('.datetime').mobiscroll()["time"]({
	lang: 'zh',
	display: 'bottom',
	minWidth: 64,	
	stepMinute:15,
	dateFormat: 'yy-mm-dd'});
//	$('.datetime').eq(0).on("change", function(){
//		var requestDate = $(this).val();
//		if(!checkTime(requestDate)){
//			$(".datetime").val("");
//		}
//	});
	
			
	var selectObj=document.getElementById("select_num");
	for(var i=0;i<config.max_seat_num;i++){
		selectObj.options[i] = new Option(i+1, i+1); 
	}
	$("#select_num").val(config.seat_num_default);
	$("#input_num").html(selectObj.options[selectObj.options.selectedIndex].text);
	
	
	document.getElementById("select_num").onchange=function(){
		var obj= document.getElementById("select_num");
		$("#input_num").html(obj.options[obj.options.selectedIndex].text);
	}
	document.getElementById("select_type").onchange=function(){
		var obj= document.getElementById("select_type");
		$("#input_type").html(obj.options[obj.options.selectedIndex].text);
		if(parseFloat(config.table_fee)>0&obj.value==2){
			$(".line.mh").show();
		}
		else{
			$(".line.mh").hide();
		}
	}
});

function showinfo(){
	//editInfo:{id:'',date:'',time:'',num:2,seattype:1,tel:"",name:'',sex:0,mark:""}
	
	document.getElementById("tel").value=config.editInfo.tel;
	document.getElementById("name").value=config.editInfo.name;	
	if(config.editInfo.sex==0) document.getElementById("sex").checked=true;
	document.getElementById("mark").value=config.editInfo.mark;
	
	$("#select_num").val(config.editInfo.num);
	$("#input_num").html(config.editInfo.num);
	
	var obj= document.getElementById("select_type");
	$("#select_type").val(config.editInfo.seattype);
	$("#input_type").html(obj.options[obj.options.selectedIndex].text);

	
	$(".date").val(config.editInfo.date);
	$("#select_time .datetime").val(config.editInfo.time);
}
function _sort(){
	var List = config.businessHours;
	if(List.length>1){
		var sDate = $(date_elm).val()
		for(var i=0;i<List.length;i++){
			for(var j=i;j<List.length;j++){
				var b_str =sDate+" "+List[i]["stime"];
				var a_str =sDate+" "+List[j]["stime"];
				var B_c_time_date = new Date(b_str);
				var A_c_time_date = new Date(a_str);
				if(B_c_time_date<A_c_time_date){
					var temp=List[i];
					List[i]=List[j];
					List[j]=temp;
				}
			}
		}
	}
	return List;
}
function checkTime(time){
	var date=$(".date").val();
	var c_time = new Date();
	var arr=date.split("-")
	var _date_year=c_time.setFullYear(arr[0],arr[1],arr[2]);
	var arr1= time.split(":");
	c_time.setHours(arr1[0],arr1[1])
	
	time=new Date(_date_year);
	var _h = parseInt(arr1[0]);
	var _m = parseInt(arr1[1])+15;
	if(_m>=60){
		_h+=1;
		_m=_m-60;
	}
	if(_h>23){
		_h=23;
		_m=59;
	}
	time.setHours(_h,_m);
	if(c_time< new Date()){
		alert("预定时间已经过期");
		return false;
	}
	var businessHours=_sort();		
	var isInBs=false;
	var str = "";
	for(var i=0;i<businessHours.length;i++){
		var _arr= businessHours[i].stime.split(":");
		var _arr1= businessHours[i].etime.split(":");
		var s =new Date(_date_year);
		s.setHours(_arr[0],_arr[1])
		var e=new Date(_date_year);
		e.setHours(_arr1[0],_arr1[1])
		var _str = ""+businessHours[i].stime+"-"+businessHours[i].etime+",";
		str=str+_str;
		if(time>=s & time<=e ){
			isInBs=true;
		}
	}
	if(isInBs){
		return isInBs;
	}else{
		alert("不在营业时间:"+str.substring(0,str.length-1)+"内，请重新选择");
		return isInBs;
	}
		
}
var isajax = false;
function submit_F() {
	if (isajax == true) return false;
	isajax = true;
	var num_elm = document.getElementById("input_num");
	var type_elm = document.getElementById("select_type");
	var tel_elm = document.getElementById("tel");
	var name_elm = document.getElementById("name");
	var date = $(date_elm).val();
	var time = $(datetime_elm).val();
	var num = num_elm.innerHTML;
	var seat_type = type_elm.value;
	var tel = tel_elm.value;
	var name = name_elm.value;
	var sex=1;
	if(document.getElementById("sex").checked) sex=2;
	var mark=document.getElementById("mark").value;
	if (config.utype==1) {
		if(isNull(date))
		{
			alert("请选择就餐日期");
			isajax = false;
			return false;
		} else if(isNull(time)){
			alert("请选择就餐时间");
			isajax = false;
			return false;
		} else if(isNull(tel)){
			alert("请输入手机号码");
			isajax = false;
			return false;
		} else  if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(tel))){ 
			alert("请输入正确手机号码");
			isajax = false;
			return false;
		} else if(isNull(name)){
			alert("请输入您的姓名");
			isajax = false;
			return false;
		} else {
			
		}
	}
	//editInfo:{id:'',date:'',time:'',num:2,seattype:1,tel:"",name:'',sex:0,mark:""},//修改预订信息
	config.editInfo.date=date;
	config.editInfo.time=time;
	config.editInfo.num=num;
	config.editInfo.seattype=seat_type;
	config.editInfo.tel=tel;
	config.editInfo.name=name;
	config.editInfo.sex=sex;
	config.editInfo.mark=mark;
	layer.open({
        type: 2,
        //shade: false,
        time: 20
        //content: '加载测试中…',
    });
	$.ajax({
		type: "POST",
		url: config.postURL,
		data: {
			id:config.editInfo.id,
			date:config.editInfo.date,
			time:config.editInfo.time,
			num:config.editInfo.num,
			seattype:config.editInfo.seattype,
			tel:config.editInfo.tel,
			name:config.editInfo.name,
			sex:config.editInfo.sex,
			mark:config.editInfo.mark,	
			table_fee:config.table_fee,
			dishes_status:config.dishes_status,
			order_sn:config.order_sn,
			isdeposit:$('.paytypediv input[name=isdeposit]:checked').val(),
			utype:config.utype
		},
		async:true,
		success: function(res){
			isajax = false;
			if(res.status==0) {
				window.location.href=res.url;
			} else {
				alert(res.message);
				if(url!=""){
					window.location.href=res.url;
				}
			}
		},
		dataType: "json"
	});				
}
function isNull( str ){ 
	if ( str == "" ) return true; 	
	var regu = "^[ ]+$"; 
	var re = new RegExp(regu); 			
	return re.test(str); 
}