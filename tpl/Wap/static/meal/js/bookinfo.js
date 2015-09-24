var businessHours = []	
$(window).ready(function(){
	businessHours=_sort(getBusinessHours())
	$('.date-pick').datePicker({clickInput:true});
	$('.dp-choose-date').hide();	
	if(document.getElementById("date").value.length==0){
		var myDate = new Date()
		var nowdate = ""+myDate.getFullYear()+"-"+(myDate.getMonth()+1)+"-"+myDate.getDate()+"";
		document.getElementById("date").value=nowdate;
	}
	var timetype=document.getElementById("timetype").value;
	timetype=parseInt(timetype);
	if(timetype==2){
	if(document.getElementById("time").value.length==0){
		var _nowTime=getNowtime()
		if(_nowTime.M==45){
			$("#minute_up").addClass("disabled");
			$("#minute_down").addClass("disabled");
		}
		var _str=checkTimesInBusinessHours(_nowTime.H,_nowTime.M,true,false)
		$("#hour").val(_str.H);
		$("#minute").val(_str.M);
	}
	else{
		var list=document.getElementById("time").value.split(":");
		$("#hour").val(list[0]);
		$("#minute").val(list[1]);
	}
   }
});

function _sort(List){
	if(List.length>1){
		var sDate = document.getElementById("date").value;
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

function sureTime(){
	var hour= document.getElementById("hour").value;				
	var minute= document.getElementById("minute").value;
	var time = hour+":"+minute
	document.getElementById("time").value=time;
	if(checkTime()){
		hidepopup();
	}
}

function daysBetween(DateOne,DateTwo)  
{   
    var OneMonth = DateOne.substring(5,DateOne.lastIndexOf ('-'));  
    var OneDay = DateOne.substring(DateOne.length,DateOne.lastIndexOf ('-')+1);  
    var OneYear = DateOne.substring(0,DateOne.indexOf ('-'));  
  
    var TwoMonth = DateTwo.substring(5,DateTwo.lastIndexOf ('-'));  
    var TwoDay = DateTwo.substring(DateTwo.length,DateTwo.lastIndexOf ('-')+1);  
    var TwoYear = DateTwo.substring(0,DateTwo.indexOf ('-'));  
  
    var cha=((Date.parse(OneMonth+'/'+OneDay+'/'+OneYear)- Date.parse(TwoMonth+'/'+TwoDay+'/'+TwoYear))/86400000);   
    return Math.abs(cha);  
}  
function checkTime(){
	var time =document.getElementById("time").value;
	var a = new Date();
	a=a.valueOf()+15*60 * 1000;
	myDate = new Date(a)
	var nowTime =""+myDate.getHours()+":"+myDate.getMinutes()+"";
	var nowdate = ""+myDate.getFullYear()+"-"+(myDate.getMonth()+1)+"-"+myDate.getDate()+"";
	var sDate = document.getElementById("date").value.replace("/","-").replace("/","-");	
	var diffdate = daysBetween(nowdate,sDate);
		
	var isInBs=false;
	for(i=0;i<businessHours.length;i++){
		var s =businessHours[i].stime;
		var e=businessHours[i].etime;
		if(time>=s & time<=e ){
			isInBs=true;
		}
	}
	if(isInBs){
		return isInBs;
	}else{
		alert("不在营业时间内");
		return isInBs;
	}
		
}
function cancel(){
	hidepopup();
}
takeaway=1;
function  submit_F(){
	var date_elm = document.getElementById("date");
	var time_elm = document.getElementById("time");
	var num_elm = document.getElementById("num");
	var tel_elm = document.getElementById("tel");
	var name_elm = document.getElementById("youname");
	var date = date_elm.value;
	var time = time_elm.value;
	var num = num_elm.value;
	var tel = tel_elm.value;
	var yname = name_elm.value;
	if(isNull(date))
	{
		alert("请选择就餐日期")
		return false;
	}
	else if(takeaway!=2 && isNull(time)){
		alert("请选择就餐时间")
		return false;
	}
	else if(isNull(tel)){
		alert("请填写手机号码")
		return false;
	}else if(isNull(yname)){
	   	alert("请填写顾客姓名")
		return false;
	}else{
		var is_submit = $("#is_submit").val();
		if('0' == is_submit) {
			$("#is_submit").val('1');
			//$("#form1").submit();
			return true;
		} else {
			return false;
		}		
	}
}
function isNull( str ){ 
	if ( str == "" ) return true; 	
	var regu = "^[ ]+$"; 
	var re = new RegExp(regu); 			
	return re.test(str); 
}

function checkSeatType(type){
	var money = document.getElementById("money").value;
	if(type==2&money>0){
		$("#seatTips").show();
	}
	else{
		$("#seatTips").hide();
	}
}


function checkTimesInBusinessHours(h,m,up,m_opt){
	if(m.toString().length==1){ m ="0"+m;}
	if(h.toString().length==1){ h ="0"+h;}		
	var c_time =""+h+":"+m+"";
	var sDate = document.getElementById("date").value;
	var sd_str =sDate+" "+c_time;
	var c_time_date = new Date(sd_str);
	var min_time="";
	var max_time="";
	if(businessHours.length>1){
		min_time =businessHours[0].stime;
		max_time =businessHours[businessHours.length-1].etime;
		for(var i=0;i<businessHours.length;i++){
			var b_str =sDate+" "+businessHours[i].stime;
			var a_str =sDate+" "+businessHours[i].etime;
			var B_c_time_date = new Date(b_str);
			var A_c_time_date = new Date(a_str);
			if(c_time_date>=B_c_time_date&c_time_date<=A_c_time_date){
				var f_time= formatetime(c_time,up,m_opt);
				return f_time;
			}
			else{
				if(up){
					if(i<businessHours.length-1){
						var b_str =sDate+" "+businessHours[i].etime;
						var a_str =sDate+" "+businessHours[i+1].stime;
						var B_c_time_date = new Date(b_str);
						var A_c_time_date = new Date(a_str);
						if(c_time_date>B_c_time_date&c_time_date<A_c_time_date)
						{
							c_time=businessHours[i+1].stime;
							var f_time=formatetime(c_time,up,m_opt);
							return f_time;
						}
						else {
							continue;	
						}
					}
					else{
						var b_str =sDate+" "+businessHours[businessHours.length-1].etime;
						var a_str =sDate+" "+c_time_date<businessHours[0].stime;
						var B_c_time_date = new Date(b_str);
						var A_c_time_date = new Date(a_str);
						if(c_time_date>B_c_time_date||c_time_date<A_c_time_date){
							c_time=businessHours[0].stime;
							var f_time=formatetime(c_time,up,m_opt);
							return f_time;
						}else {
							continue;	
						}
					}
				}
				else{
					if(i>0){
						var b_str =sDate+" "+businessHours[i].stime;
						var a_str =sDate+" "+businessHours[i-1].etime;
						var B_c_time_date = new Date(b_str);
						var A_c_time_date = new Date(a_str);
						if(c_time_date<B_c_time_date&c_time_date>A_c_time_date)
						{
							c_time=businessHours[i-1].etime;
							var f_time=formatetime(c_time,up,m_opt);
							return f_time;
						}
						else {
							continue;	
						}
					}
					else{
						var b_str =sDate+" "+businessHours[businessHours.length-1].etime;
						var a_str =sDate+" "+businessHours[0].stime;
						var B_c_time_date = new Date(b_str);
						var A_c_time_date = new Date(a_str);
						if(c_time_date>B_c_time_date||c_time_date<A_c_time_date){
							c_time=businessHours[businessHours.length-1].etime;
							var f_time=formatetime(c_time,up,m_opt);
							return f_time;
						}else {
							continue;	
						}
					}
				}
				
			}
		}
	}else{
		if(businessHours.length==1){
			var b_str =sDate+" "+businessHours[0].stime;
			var a_str =sDate+" "+businessHours[0].etime;
			var B_c_time_date = new Date(b_str);
			var A_c_time_date = new Date(a_str);
			if(c_time_date>=B_c_time_date&c_time_date<=A_c_time_date){
				var f_time= formatetime(c_time,up,m_opt);
				return f_time;
			}
			else if(c_time_date<B_c_time_date){
				c_time=businessHours[0].stime;
				var f_time=formatetime(c_time,up,m_opt);
				return f_time;
			}
			else{
				c_time=businessHours[0].etime;
				var f_time=formatetime(c_time,up,m_opt);
				return f_time;
			}
		}
	}
}
function getNowtime (){
	var a = new Date();
	a=a.valueOf()+15*60 * 1000;
	var myDate = new Date(a)
	var m=myDate.getMinutes();
	var h =myDate.getHours();
	if(m<15)  m=15;
	if(15<m&m<30) m=30;
	if(45>m&m>30) m=45;
	if(m>45){
		m="00";	
		h=h+1;
		if(h>23){
			h="00";
		}
	}
	return {"H":h,"M":m}
}
function formatetime(c_time,up,m_opt){	
	$("#minute_up").removeClass("disabled");
		$("#minute_down").removeClass("disabled");
	
	var _nowTime=getNowtime();
	var nowTime =""+_nowTime.H+":"+_nowTime.M+"";
	
	var myDate = new Date();
	var nowdate = ""+myDate.getFullYear()+"-"+(myDate.getMonth()+1)+"-"+myDate.getDate()+"";
	var sDate = document.getElementById("date").value.replace("/","-").replace("/","-");	
	var diffdate = daysBetween(nowdate,sDate);
	
	var _nowTime =document.getElementById("date").value+" "+nowTime;
	var _c_time =document.getElementById("date").value+" "+c_time;
	var _nowTime_date = new Date(_nowTime);
	var _c_time_date = new Date(_c_time);
	if(diffdate==0&_nowTime_date>_c_time_date){
		c_time=nowTime;
		var obj =getTimeobj(c_time);
		//var c_time=checkTimesInBusinessHours(obj.H,obj.M,true,false)
		if(!up&!m_opt){
			c_time=businessHours[businessHours.length-1].etime;
		}
		
		if(!up&m_opt)
		{
			c_time=obj.H+":45";
		}
	}
	
	
	if(getNowtime().M==45&getTimeobj(c_time).H==getNowtime().H){	
		$("#minute_up").addClass("disabled");
		$("#minute_down").addClass("disabled");
	}
	
	return getTimeobj(c_time)
}

function getTimeobj(c_time){
	var list=c_time.split(":");
	var h =list[0];
	var m = list[1];
	return {"H":h,"M":m}
}

function hourUp(){
	//event.preventDefault();
	var hour= document.getElementById("hour");
	var minute= document.getElementById("minute");
	var v =parseInt(hour.value);
	var m =parseInt(minute.value);
	if(isNaN(v)){
		v=12;
	}
	if(v==23){
		v=0;
	}
	else {
		v=v+1;
	}
	var c_time=checkTimesInBusinessHours(v,m,true,false);
	setTimestr(c_time);
}

function setTimestr(c_time){
	v=c_time.H;
	m=c_time.M
	var v_str=v.toString();
	if(v_str.length==1){
		v_str="0"+v_str;;
	}
	hour.value=v_str;	
	var m_str=m.toString();
	if(m_str.length==1){
		m_str="0"+m_str;;
	}
	minute.value=m_str;	
}

function hourDown(){
	var hour= document.getElementById("hour");
	var minute= document.getElementById("minute");
	var v =parseInt(hour.value);
	var m =parseInt(minute.value);
	if(isNaN(v)){
		v=12;
	}
	if(v==0){
		v=23;
	}
	else {
		v=v-1;
	}
	var c_time=checkTimesInBusinessHours(v,m,false,false);
	setTimestr(c_time);
}
function minuteUp(){
	var hour= document.getElementById("hour");
	var minute= document.getElementById("minute");
	var v =parseInt(hour.value);
	var m =parseInt(minute.value);
	if(isNaN(m)){
		m=0;
	}
	if(m>=45){
		m=0;
	}
	else {
		m=m+15;
	}
	var c_time=checkTimesInBusinessHours(v,m,true,true);
	setTimestr(c_time);
}
function minuteDown(){
	var hour= document.getElementById("hour");
	var minute= document.getElementById("minute");
	var v =parseInt(hour.value);
	var m =parseInt(minute.value);
	if(isNaN(m)){
		m=0;
	}
	if(m==0){
		m=45;
	}
	else {
		m=m-15;
	}
	var c_time=checkTimesInBusinessHours(v,m,false,true);
	setTimestr(c_time);
}