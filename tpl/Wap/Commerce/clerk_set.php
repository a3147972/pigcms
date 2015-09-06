<!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <title>商家中心</title> 
  <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no" /> 
  <meta name="apple-mobile-web-app-capable" content="yes" /> 
  <meta name="apple-touch-fullscreen" content="yes" /> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black" /> 
  <meta name="format-detection" content="telephone=no" /> 
  <meta name="format-detection" content="address=no" /> 
  <script src="{pigcms{:C('JQUERY_FILE')}"></script> 
  <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
  <style type="text/css">
.m_nav{height: 50px;line-height: 50px;background: #FF658E;padding-left: 12px;color:#FFF;font-size: 16px;}
.m_nav a{color:#FFF;text-decoration:none;cursor: pointer;}
form div{height: .8rem;}
.form-group input {height: 0.5rem;} 
select{height:  0.6rem;width: 3.5rem;} 
.pselect{display:inline-block;width: 3.5rem;}
.clearfix{text-align: center;margin-top: 0.1rem;}
.yesstore{line-height: 0.6rem;}
</style>
 </head>  
 <body > 
  <div class="m_nav"> 
   <span> <a href="/wap.php?g=Wap&c=Commerce&a=index">商家中心</a> &gt; <a href="/wap.php?g=Wap&c=Commerce&a=mClerk">店员管理</a> &gt; <a href="javascript:;" style="color:#FAFDCC;">店员信息设置</a></span> 
  </div> 
  <div  style="text-align: center;margin-top: 30px;"> 
   <form action="" method="post" enctype="multipart/form-data"> 
   	 <div class="form-group">
	 <if condition="$store_id gt 0">
     <label class="yesstore">店铺：
		 <volist name="all_store" id="vo">
		   <if condition="$store_id eq $vo['store_id']">
		   <p class="pselect">{pigcms{$vo.name}</p>
		   </if>
		 </volist>
		 </label>
	 <else/>
     <label>店铺：</label>
		<select name="store_id">
		 <volist name="all_store" id="vo">
			<option value="{pigcms{$vo.store_id}">{pigcms{$vo.name}</option>
		 </volist>
	</select>
	</if>
    </div>
    <div class="form-group">
     <label for="name">姓名：</label>
     <input type="text" value="{pigcms{$item['name']}" id="name" name="name"  />
    </div>
    <div class="form-group">
     <label for="username">帐号：</label>
     <input type="text" value="{pigcms{$item['username']}" id="username" name="username"  />
    </div>
    <div class="form-group">
	<label for="password">密码：</label>
     <input type="password" id="password" name="password"  />
    </div>
    <div class="form-group">
     <label for="contact_name">电话：</label>
     <input type="text" value="{pigcms{$item['tel']}" id="tel" name="tel"  />
    </div>
    <div class="clearfix">
     <div>
	  <input type="hidden" value="{pigcms{$id}" name="id"/>
	  <if condition="$store_id gt 0">
	  <input type="hidden" value="{pigcms{$store_id}" name="store_id"/>
	  </if>
      <button type="submit" class="btn btn-info"><i></i>保存</button>
     </div>
    </div> 
   </form> 
  </div> 
  <div style="display:none;">{pigcms{$config.wap_site_footer}</div>
 </body>
</html>