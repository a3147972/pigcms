<include file="Public:header"/>
   <style type="text/css">
   #popCyDiv{margin: 10px 0 0 30px}
   #popCyDiv select{width: 200px;}
   #popCyDiv div{ float: left;width: 230px;}
   #popCyDiv span{margin-bottom: 10px;display:inline-block;}
   #popCyDiv option{font-size: 16px;padding: 5px;}
   .desctitle{font-size: 16px;margin: 5px 0 0 15px;}
   </style>
    <div class="desctitle">请给 <span style="color:red;">{pigcms{$param['cyname']}</span> 选择对应更新二级分类</div>
	<div class="desctitle" style="color:red;">注意：如果您是再次更换选择二级分类，那么您在之前分类下的更新字段设置将被删除</div>
	<if condition="!empty($allseverfields) AND is_array($allseverfields)"> 
	<form id="myform" name="myform" method="post" action="{pigcms{:U('Classify/savepicksetCy')}" frame="true" refresh="true">
	<div id="popCyDiv">
	  <div id="Cymain">
	  <span>请点击选择一级分类：</span>
	   <select id="Classify1" size="15" onchange="GetSubSelect(this.value)">
	    <volist name="allseverfields" id="vv">
		    <php>$subcy[$vv['mcid']]=$vv['subcy'];</php>
            <option value="{pigcms{$vv['mcid']}" <if condition="$pickset['mcid'] eq $vv['mcid']"> selected="selected"</if>>{pigcms{$vv['zhname']}</option>
		</volist>
	   </select>
	  </div>
	  
	  <if condition="$pickset['mscid'] gt 0">
	  <div id="Cysub"> 
	  <span>请点击选择二级分类：</span>
	  <select size="15" onclick="GetFiledSelect(this.value,{pigcms{$pickset['mcid']})">
	   <volist name="subcy[$pickset['mcid']]" id="mvv">
	      <option value="{pigcms{$mvv['cid']}" <if condition="$pickset['mscid'] eq $mvv['cid']"> selected="selected"</if>>{pigcms{$mvv['szhname']}</option>
	   </volist>
	   </select>
	   </div>
	   	  <div id="Cyfield">
		     <span>{pigcms{$subcy[$pickset['mcid']][$pickset['mscid']]['szhname']} 所有字段：</span>
			 <select size="15">
		   	   <volist name="subcy[$pickset['mcid']][$pickset['mscid']]['fields']" id="fvv">
				<option value="{pigcms{$key}">{pigcms{$fvv}</option>
			</volist>
			</select>
		  </div>
	   <else/>
		  <div id="Cysub" style="display:none;"> </div>
	   	  <div id="Cyfield" style="display:none;"> </div>
	  </if>
	  
	</div>
	<div style="display:none;">
	   <input type="hidden" name="oldid" value="{pigcms{$id}"/>
	   <input type="hidden" name="cid" value="{pigcms{$param['cid']}"/>
	   <input type="hidden" name="fcid" value="{pigcms{$param['fcid']}"/>
	   <input type="hidden" id="mcid" name="mcid" value="{pigcms{$pickset['mcid']}"/>
	   <input type="hidden" id="mscid" name="mscid" value="{pigcms{$pickset['mscid']}"/>
	</div>
		<div class="btn hidden">
			<input  type="submit" id="dosubmit"  name="dosubmit" class="button"  value="提交" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<else/>
	<br/>
	<br/>
	<div class="desctitle" style="color:red;">抱歉暂无可更新的信息！</div>
  </if>
<script type="text/javascript">
var SubSelectData=<php> echo json_encode($subcy);</php>;
function GetSubSelect(vv){
	var html ='<span>请点击选择二级分类：</span><select size="15" onclick="GetFiledSelect(this.value,'+vv+')">';
	var getSub=SubSelectData[vv];
	if(getSub){
	  $.each(getSub,function(i,v){
	    html+='<option value="'+v.cid+'">'+v.szhname+'</option>';
	  });
	}
	html+='</select>';
	$('#Cysub').html(html).show();
	$('#Cyfield').hide();
}

function GetFiledSelect(cid,mcid){
	$('#mcid').val(mcid);
    $('#mscid').val(cid);
   var getFileds=SubSelectData[mcid][cid]['fields'];
	var html ='<span>'+SubSelectData[mcid][cid]['szhname']+' 所有字段：</span><select size="15">';
    if(getFileds){
	  	 $.each(getFileds,function(kk,vv){
	       html+='<option value="'+kk+'">'+vv+'</option>';
	     });
	}
	html+='</select>';
	$('#Cyfield').html(html).show();
}

function insert_datas(obj,mcid,cid){
  $('#mcid').val(mcid);
  $('#mscid').val(cid);
  $('#kname').val(obj.value);
  $('#kvalue').val($(obj.options[obj.selectedIndex]).text());
}

function SubmitForm(){
   document.getElementById('myform').submit();
}
</script>

<include file="Public:footer"/>