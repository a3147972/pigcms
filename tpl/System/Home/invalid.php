<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Home/invalid')}" class="on">无效关键词回复</a>
				</ul>
			</div>
			<form method="post" action="" refresh="true" enctype="multipart/form-data" >
				<table cellpadding="0" cellspacing="0" class="table_form" width="100%">
					<tr>
						<th width="160">回复类型　</th>
						<td>
						<label><input type="radio" name="type" class="type" value="0" <if condition="$first['type'] eq 0">checked</if>>自定义文本</label>
						<label><input type="radio" name="type" class="type" value="1" <if condition="$first['type'] eq 1">checked</if>>自定义图文</label>
						<label><input type="radio" name="type" class="type" value="2" <if condition="$first['type'] eq 2">checked</if>>网站功能</label>
						<label><input type="radio" name="type" class="type" value="3" <if condition="$first['type'] eq 3">checked</if>>本站推荐的{pigcms{$config.group_alias_name}</label>
						</td>
					</tr>
					<tr class="class_0" <if condition="$first['type'] neq 0">style="display:none"</if>>
						<th width="160">回复内容　</th>
						<td><textarea rows="20" cols="45" name="content" id="content">{pigcms{$first.content}</textarea></td>
					</tr>
					<tr class="class_1" <if condition="$first['type'] neq 1">style="display:none"</if>>
						<th width="160">回复标题　</th>
						<td><input type="text" class="input-text" name="title" id="title" value="{pigcms{$first.title}"/></td>
					</tr>
					<tr class="class_1" <if condition="$first['type'] neq 1">style="display:none"</if>>
						<th width="160">内容介绍　</th>
						<td><textarea rows="4" cols="25" name="info" id="info">{pigcms{$first.info}</textarea></td>
					</tr>
					<tr class="class_1" <if condition="$first['type'] neq 1">style="display:none"</if>>
						<th width="160">外链URL　</th>
						<td>
							<input type="text" class="input-text" name="url" id="url" value="{pigcms{$first.url}" style="width:200px;" placeholder="外链接url如：http://www.baidu.com" validate="maxlength:200,url:true"/>
							<img src="./tpl/System/Static/images/help.gif" class="tips_img" title="外链接url如：http://www.baidu.com">
							<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
						</td>
					</tr>
					<tr class="class_1" <if condition="$first['type'] neq 1">style="display:none"</if>>
						<th width="160">回复图片　</th>
						<td><input type="file" class="input-text" name="pic" id="pic" value="{pigcms{$first.pic}"/></td>
					</tr>
					<if condition="$first['pic']">
						<tr class="class_1" <if condition="$first['type'] neq 1">style="display:none"</if>>
							<th width="160"></th>
							<td><img src="{pigcms{$first.pic}" width="280" height="180"></td>
						</tr>
					</if>
					
					<tr class="class_2" <if condition="$first['type'] neq 2">style="display:none"</if>>
						<th width="160">回复网站功能　</th>
						<td>
						<label><input type="radio" name="fromid" value="1" <if condition="$first['fromid'] eq 1">checked</if>>网站首页</label>
						<label><input type="radio" name="fromid" value="2" <if condition="$first['fromid'] eq 2">checked</if>>{pigcms{$config.group_alias_name}首页</label>
						<label><input type="radio" name="fromid" value="3" <if condition="$first['fromid'] eq 3">checked</if>>{pigcms{$config.meal_alias_name}首页</label>
						</td>
					</tr>
					
				</table>
				<div class="btn">
					<input type="submit"  name="dosubmit" value="提交" class="button" />
					<input type="reset"  value="取消" class="button" />
				</div>
			</form>
		</div>
		<style>
			.table_form{border:1px solid #ddd;}
			.tab_ul{margin-top:20px;border-color:#C5D0DC;margin-bottom:0!important;margin-left:0;position:relative;top:1px;border-bottom:1px solid #ddd;padding-left:0;list-style:none;}
			.tab_ul>li{position:relative;display:block;float:left;margin-bottom:-1px;}
			.tab_ul>li>a {
position: relative;
display: block;
padding: 10px 15px;
margin-right: 2px;
line-height: 1.42857143;
border: 1px solid transparent;
border-radius: 4px 4px 0 0;
padding: 7px 12px 8px;
min-width: 100px;
text-align: center;
}
.tab_ul>li>a, .tab_ul>li>a:focus {
border-radius: 0!important;
border-color: #c5d0dc;
background-color: #F9F9F9;
color: #999;
margin-right: -1px;
line-height: 18px;
position: relative;
}
.tab_ul>li>a:focus, .tab_ul>li>a:hover {
text-decoration: none;
background-color: #eee;
}
.tab_ul>li>a:hover {
border-color: #eee #eee #ddd;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li>a:hover {
background-color: #FFF;
color: #4c8fbd;
border-color: #c5d0dc;
}
.tab_ul>li:first-child>a {
margin-left: 0;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #555;
background-color: #fff;
border: 1px solid #ddd;
border-bottom-color: transparent;
cursor: default;
}
.tab_ul>li.active>a, .tab_ul>li.active>a:focus, .tab_ul>li.active>a:hover {
color: #576373;
border-color: #c5d0dc #c5d0dc transparent;
border-top: 2px solid #4c8fbd;
background-color: #FFF;
z-index: 1;
line-height: 18px;
margin-top: -1px;
box-shadow: 0 -2px 3px 0 rgba(0,0,0,.15);
}
.tab_ul:before,.tab_ul:after{
content: " ";
display: table;
}
.tab_ul:after{
clear: both;
}
		</style>

<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".type").click(function(){
		$(".class_0,.class_1,.class_2").hide();
		$(".class_" + $(this).val()).show();
	});
});

function addLink(domid,iskeyword){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
</script>
<include file="Public:footer"/>